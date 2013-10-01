<?php
class Timefestreportpdf extends CI_Controller {

		public function __construct()
		{
		parent::__construct();
		$this->template->add_js('js/report/staticreport.js');	
		$this->template->add_js('js/report/reportjs.js');	
		$this->load->library('HTML2PDF');
		$this->load->model('report/prereport_model');
		$this->load->model('report/timefest_model');
		
		}
		
	
	function confidential($flag = 0,$itemcode = 0,$festival = 0,$fair = 0)
	{
	    $this->load->model('report/timefest_model');
		
		$this->Contents=array();
		$this->template->write('title', '');
		if($flag != 1)
		{
			$itemcode						=	$this->input->post('hiditemcode');
			$festival						=	$this->input->post('hidFestcode');
			$fair							=	$this->input->post('hidFaircode');
		}
		
		$date							=	$this->input->post('txtDate');
		$fairname						= 	$this->timefest_model->fetch_fairname($fair);
	    $festname						= 	$this->timefest_model->fetch_festname($festival);
		$retdat							= 	$this->timefest_model->timeoffest_result($itemcode);
	    $participated					= 	$this->timefest_model->timeoffest_count($itemcode);
	    $absentee_list					= 	$this->timefest_model->timeoffest_result_absentee($itemcode);
		 $absentee	= explode(',', $absentee_list);
		
		
		 
		               if($itemcode=='ALL'){ 
					             $absenteeall= $this->timefest_model->timeoffest_result_absentee_all($festival,$fair);
					             $festresult= $this->timefest_model->fetch_fest_all_result($festival,$fair);
					            // $festcount= $this->timefest_model->fetch_fest_all_result_count($festival);  
					                  
									  
									  
									  
									  if(count($festresult)>0){
									  $this->Contents['fairname']     =$fairname;
								  	  $this->Contents['festresult']		=	$festresult;
									    $this->Contents['absenteeall']	=	$absenteeall;						  
								      $content	=	$this->load->view('report/timeof_fest_reportpdf/timefest_result_confidential_all',$this->Contents,true);                                	  $html2pdf = new CI_HTML2PDF('P','A4', 'en');
		                              $html2pdf->pdf->SetDisplayMode('fullpage');
		                              $html2pdf->WriteHTML($content, '');
		                              $html2pdf->Output('Confidential_Report_All.pdf', 'I');
										
										 }
					   
					    }
				
		if(count($retdat)>0){
			$this->Contents['judjes_count']	= $retdat[0]['no_of_judges'];
			$this->Contents['itemcode']		=$itemcode;
			$this->Contents['festname']     =$festname;
			$this->Contents['fairname']     =$fairname;
			$this->Contents['retdat']       =$retdat;
			$this->Contents['participated'] =$participated;
			$this->Contents['absentee']     =$absentee;		
			$content	=	$this->load->view('report/timeof_fest_reportpdf/timefest_result_confidential',$this->Contents,true);
		
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('Confidential_Report.pdf', 'I');
	    }
	     else
		 {
		
		 	redirect('test/nodata');
		 
		 }
		 
	   
	
	}	
		
}
?>