<?php
class Resultindex extends CI_Controller{

	function __construct()
	{
		parent::__construct();
		//$this->Session_Model->is_user_logged(true);
		$this->template->write_view('menu', 'menu', '');
		$this->template->add_js('js/stages.js');	
		$this->template->add_js('js/report/staticreport.js');
		$this->load->model('report/resultindex_model');
		$this->load->model('report/prereport_model');
		$this->template->add_js('js/report/reportjs.js');	
		$this->load->library('HTML2PDF');
	}
	
	function rankwise_result()
	{
		 //echo "<br><br>hiii";
		$this->Contents=array();
		$this->template->write('title', '');
		$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','fest_id != 0','Select Festival','fest_id');
		 $fair							=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','Select Fair','fairId');
		$this->Contents				=	array();
		$this->Contents['fest']		=	$fest;
		$this->Contents['fair']		=	$fair;
		$date_array					=	$this->General_Model->get_fest_date_array();
	    $date_array['All']			=	'All Dates';
	    $this->Contents['date_array']		=	$date_array;
		$this->template->write_view('content', 'report/publishresult/rankwise', $this->Contents);
		$this->template->load();
	}
	
	function rankwise_report()
	{
		 
		 $this->Contents     		  =	 	 array();
		 $exb	=	0; 		
		if($this->input->post('cmbFairType') == 4 && $this->input->post('radioLabel') == 'exhib'){  
			$festId	=	$this->input->post('cmbCateType'); 
			$exb	=	1; 		
		}
		else {   
			$festId	=	$this->input->post('cmbCateType');    
		}
		 
		 $fairId    				  =		$this->input->post('cmbFairType');
		 $item    				      =		$this->input->post('cbo_item');
		 $rank   	    	 		  =		$this->input->post('rank');
		 $date   	    	 		  =		$this->input->post('txtDate');
		 $rankwise           		  =  	$this->resultindex_model->rankwise_report($festId,$item,$rank,$date,$fairId,$exb); 
		 $this->Contents['rankwise']  =  $rankwise;
		 $this->Contents['rank']      =  $rank ; 
		 
			if(count($rankwise)>0){
				$content   =   $this->load->view('report/publishresult/rankwise_report',$this->Contents,true);
				$html2pdf  =   new CI_HTML2PDF('P','A4', 'en');
				$html2pdf->pdf->SetDisplayMode('fullpage');
				$html2pdf->WriteHTML($content, '');
				$html2pdf->Output('project_urls.pdf', 'I');
			}
			else{
				redirect('test/nodata');
			}
	}
	
	function gradewise_result()
	{
		$this->Contents=array();
		$this->template->write('title', '');
		$fest						=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','fest_id != 0','Select Festival','fest_id');
		$fair						=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','Select Fair','fairId');
		$this->Contents				=	array();
		//$fest['ALL']='All Festival';
		$this->Contents['fest']		=	$fest;
		$this->Contents['fair']		=	$fair;
		$this->template->write_view('content', 'report/publishresult/gradewiseresult', $this->Contents);
		$this->template->load();
	}
	
	function grade_report()
	{
		 $this->Contents     		  =	 	 array();
		 
		 $fair    				  	  =		$this->input->post('cmbFairType');
		 
		 $exb=0;
		 if($fair == 4 && $this->input->post('radioLabel') == 'exhib'){  
			$festId						=	$this->input->post('cmbCateType');
			$exb=1;
		 }
		 else {   
			$festId						=	$this->input->post('cmbCateType');
		 }
		//echo '<br>fair------>'.$fair.'<br>festId------>'.$festId;
		 $item                        =     $this->input->post('cbo_item');
		 $grade 	    	 		  =		$this->input->post('grade');
		 
		 $fair_name					  =		$this->prereport_model->get_FairName($fair);
		 $gradewise           		  =  	$this->resultindex_model->gradewiseparticip_report($fair,$festId,$item,$grade,$exb); 
		
		 $this->Contents['gradewise'] =  	$gradewise ;
		 $this->Contents['grade']     =  	$grade ; 
		 $this->Contents['fair_name'] = 	$fair_name[0]['fairName'];
		// print_r($gradewise);
	 		if(count($gradewise)>0){
			$content   =   $this->load->view('report/publishresult/gradewise_report',$this->Contents,true);
			$html2pdf  =   new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('project_urls.pdf', 'I');
			}
			else{
				redirect('test/nodata');
			}
	}
	
	function report_press_timewise()
	{
			$this->Contents=array();
			$this->template->write('title', '');
			$this->Contents['date_array']		=	$this->General_Model->get_result_date_array();
			$fair								=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','Select Fair','fairId');
		$this->Contents['fair']					=	$fair;
			
			$this->template->write_view('content', 'report/publishresult/timewise_report_index', $this->Contents);
			$this->template->write_view('content', 'report/publishresult/numwise_timereport_index', $this->Contents);
			$this->template->load();
	
	
	}
	
	
}

?>