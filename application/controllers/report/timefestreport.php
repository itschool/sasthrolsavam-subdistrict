<?php
class Timefestreport extends CI_Controller {

		public function __construct()
		{
		parent::__construct();
		$this->template->add_js('js/report/staticreport.js');	
		$this->template->add_js('js/result.js');
		$this->load->library('HTML2PDF');
		$this->load->model('report/prereport_model');
		$this->template->write_view('menu', 'menu', '');
		$this->load->model('report/timefest_model');
		}
		
		function timefest_result_confidential(){ 	
		  $this->template->add_js('js/popcalendar.js');
		  $this->template->add_css('style/calendar.css');
		  
		  $resultFest=$this->input->post('resultFest');
		  $resultFair=$this->input->post('resultFair');
		   
		  
		  $fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','fest_id != 0','Select Festival','fest_id');
		  $fair							=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','Select Fair','fairId');
	
		  $this->Contents				=	array();
		  $this->Contents['fest']		=	$fest;
		  $this->Contents['fair']		=	$fair;
		 
		 
		  
				if($resultFair == 4 && $this->input->post('radioLabel') == 'exhib'){  
					//$resultFest						=	0;
					//echo "<br><br><br>---".$resultFest;
					$this->confidential_exhb($resultFest,$resultFair);
					redirect('test/nodata');
				}
				else {   
					$resultFest						=	$resultFest	;
					 $this->template->write_view('content','report/timeof_fest_report/timeoffest',$this->Contents);
				
		//echo '<br><br>'.$resultFest	;
			   if($resultFest){
					$resultdet                   = $this->timefest_model->timefestconfidential($resultFest,$resultFair);
					$this->Contents['resultdet'] =  $resultdet;
					$this->Contents['fest']      =  $resultFest;
					$this->Contents['fest_id']   =  $this->input->post('resultFest');
					$this->Contents['fair']      =  $resultFair;
					
					if(count($resultdet)>0){
				 $this->template->write_view('content','report/timeof_fest_report/timeoffestview',$this->Contents);
			   			}
					}
					elseif($resultFest  ==0)
				   {
				   	
					$this->confidential_exhb($this->input->post('resultFest'),$resultFair);
					
				   }
					
			  }//if  
			   
		  $this->template->load();
	 
	}
	
	function confidential_exhb($resultFest,$resultFair)
	{
		$festresult                   = $this->timefest_model->timefestconfidential_exb($resultFest,$resultFair);
		 $this->Contents['festresult'] =  $festresult;
		 $this->Contents['fest_id']   =  $resultFest;
		if(count($festresult)>0){
				$content =  $this->load->view('report/timeof_fest_reportpdf/timefest_result_confidential_all_e',$this->Contents,true);
				
				 $html2pdf = new CI_HTML2PDF('P','A4', 'en');
				  $html2pdf->pdf->SetDisplayMode('fullpage');
				  $html2pdf->WriteHTML($content, '');
				  $html2pdf->Output('Confidential_Report_All.pdf', 'I');
			   }
			   /*else {
				redirect('test/nodata');
			}*/
	}


}	
	
?>