<?php
class   Afterresultreport extends CI_Controller {

		function Afterresultreport()
		{
		parent::__construct();
		$this->template->add_js('js/report/staticreport.js');	
		$this->template->add_js('js/report/reportjs.js');	
		$this->load->library('HTML2PDF');
		$this->load->model('report/prereport_model');
		$this->template->write_view('menu', 'menu', '');
		if($this->session->userdata('USER_GROUP') == '')
			{
				header ( "Location: ". base_url(). 'index.php/welcome' );		
			}
		}
		
		function school_wise_result_interface()
		{
		  $school							=	$this->General_Model->prepare_select_box_data('school_master','school_code,school_code','','Select School');
		   $fair							=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','Select Fair','fairId');
		  $this->Contents				=	array();
		  $this->Contents['school']		=	$school;
		  $this->Contents['fair']		=	$fair;
		  $this->template->write_view('content','result/afterresult_report/school_wise_result_interface',$this->Contents);
		  $this->template->load();
		}
		
		function school_wise_result_all_interface(){
			$school							=	$this->General_Model->prepare_select_box_data('school_master','school_code,school_code','','Select School');
		   $fair							=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','Select Fair','fairId');
		  $this->Contents				=	array();
		  $this->Contents['school']		=	$school;
		  $this->Contents['fair']		=	$fair;
		  $this->template->write_view('content','result/afterresult_report/school_wise_result_all_interface',$this->Contents);
		  $this->template->load();
			
	}//school_wise_result_all_interface()
	
	function total_points_interface()
		{
			$this->load->model('report/afterresult_model');
			$this->template->add_js('js/result.js');	
			$this->Contents=array();
			$fair							=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','Select Fair','fairId');
			$this->Contents['fair']		=	$fair;
			$this->template->write_view('content','result/afterresult_report/rpt_total_points_interface',$this->Contents);
			
			$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','fest_id != 0','Select Category','fest_id');
			$this->Contents['fest']		=	$fest;
			
			$this->template->write_view('content','result/afterresult_report/rpt_item_wise_total_points_interface',$this->Contents);
					
			$this->template->load();		
			
		}
		
		function status_of_sasthramela_interface()
		{
		 $fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','fest_id != 0','Select Festival','fest_id');
		 $fair							=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','Select Fair','fairId');
		  $this->Contents				=	array();
		  $fest[0]                      =   "All Categories";
		  $this->Contents['fest']		=	$fest;
		  $this->Contents['fair']		=	$fair;
		  $date_array					=	$this->General_Model->get_fest_date_array();
		  $date_array['All']			=	'All Dates';
		  $this->Contents['date_array']	=	$date_array;
		  $this->template->write_view('content','result/afterresult_report/status_of_sasthramela_interface',$this->Contents);
		  $this->template->load();
		 
	   }
	   
	function higherlevel_result()
	{
	 	if($this->Session_Model->check_user_permission(8)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','fest_id != 0','Select Festival','fest_id');
		$fair							=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','Select Fair','fairId');
	    $this->Contents					=	array();
		//$fest= Array_Remove($fest, 8, 2);

	    $fest['All']                    =   "All festivals";
	    $this->Contents['fest']			=	$fest;
		$this->Contents['fair']			=	$fair;
	    $this->template->write_view('content','result/afterresult_report/higherlevel_result',$this->Contents);
	    $this->template->load();
	
	}


}

?>