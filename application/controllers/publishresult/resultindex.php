<?php

class Resultindex extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		//$this->Session_Model->is_user_logged(true);
		$this->load->model('Session_Model');
		$this->template->write_view('menu', 'menu', '');
		$this->template->add_js('js/ground/ground.js');	
		$this->load->model('publishresult/resultindex_model');
		
		$this->template->add_js('js/report/reportjs.js');	
		$this->load->library('HTML2PDF');
		//$this->load->model('photos/Photos_Model');	
	}
	function resultview()
	{
		if($this->Session_Model->check_user_permission(45)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->Contents=array();
		$this->template->write('title', '');
		$fair							=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','','fairId');
		$this->Contents['fair']			=	$fair;
		$fest							=	$this->General_Model->get_data('festival_master','fest_id,fest_name','fest_id != 0','fest_id');
		$this->Contents['fest']         =    $fest;
		
		
		$this->template->write_view('content', 'report/publishresult/resultview', $this->Contents);
		$this->template->load();
		
	}
	
	function result_declared()
	{
		//echo "<br /><br />joooooooo";
		if($this->Session_Model->check_user_permission(45)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$fesid          = 	$this->input->post('hidfestId');
		$fair           = 	$this->input->post('cmbFairType');
		if($fair == 4){
			$work_type      = 	$this->input->post('radioLabel');
		}else{
			$work_type      = 	"no";
		}
		//echo "<br /><br />fesid-------->".$fesid."<br /><br />fair-------->".$fair."-----------".$work_type;
		
		$this->Contents  = 	array();
		//$this->template->write('title', '');
		if($work_type == 'no' || $work_type == 'spot'){
			$details         = 	$this->resultindex_model->result_rank($fesid,$fair);
			$this->Contents['details']   =  $details;
			$this->load->view('report/publishresult/result_declared', $this->Contents);
		}
		else if($work_type == 'exhib'){
			$details         = 	$this->resultindex_model->result_rank_exb($fesid,$fair);
			$this->Contents['wrk']   =  'exb';
			$this->Contents['details']   =  $details;
			$this->load->view('report/publishresult/result_declared', $this->Contents);
		}
		else if($work_type == 'all')
		{
			//echo "llll";
			$details         = 	$this->resultindex_model->result_rank($fesid,$fair);
			$details2        = 	$this->resultindex_model->result_rank_exb($fesid,$fair);
			//var_dump($details2);
			$this->Contents['details2']   =  $details2;
			$this->Contents['details']   =  $details;
			$this->load->view('report/publishresult/result_declared_work_aggr', $this->Contents);
		
		}
	   // var_dump($details);
	
		
		
	}
	
	function schoolpoints()
	{
		
		if($this->Session_Model->check_user_permission(45)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->Contents = 	array();
		$festid			=	$this->input->post('hidfestId');
		$fair           = 	$this->input->post('cmbFairType');
		
		if($fair == 4){
			$work_type      = 	$this->input->post('radioLabel');
		}else{
			$work_type      = 	"no";
		}
		$this->template->write('title', '');
		$this->Contents['fairId']   =  $fair;
		
		if($work_type == 'no' || $work_type == 'spot'){
			$details1        = 	$this->resultindex_model->schoolpoints($festid,$fair,1);
			$details2        = 	$this->resultindex_model->schoolpoints($festid,$fair,0);
			$this->Contents['overall_details']   =  $details1;
			$this->Contents['runnerup_details']  =  $details2;
			$this->load->view('report/publishresult/schoolpoints', $this->Contents);
				
		}
		else if($work_type == 'exhib'){
			$details        = 	$this->resultindex_model->schoolpoints($festid,$fair,0);
			$this->Contents['wrk']   =  'exb';
			$this->Contents['overall_details']   =  $details;
			$this->Contents['runnerup_details']  =  $details;
			$this->load->view('report/publishresult/schoolpoints', $this->Contents);
				
		}
		else if($work_type == 'all')
		{
			//echo "llll";
			$details 	     = 	$this->resultindex_model->schoolpoints_work_aggr($festid,$fair,0);
			//$details2        = 	$this->resultindex_model->schoolpoints_exb($festid,$fair);			
			//var_dump($details2);
			//$this->Contents['details2']   =  $details2;
			$this->Contents['overall_details']   =  $details;
			$this->Contents['runnerup_details']  =  $details;
			$this->Contents['wrk']   =  'all';
			$this->load->view('report/publishresult/schoolpoints', $this->Contents);			
		}		
	}
	
	function schoolpoints_detailed($festid,$fair,$schoolcode)
	{		
		if($this->Session_Model->check_user_permission(45)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}	
		//echo "<br /><br /><br />-->".$festid."-----".$fair."-----".$schoolcode;	
		$this->Contents = 	array();
		$this->template->write('title', '');
		$point_details        = 	$this->resultindex_model->schoolpoints_details($festid,$fair,$schoolcode);
		$overall_details        = 	$this->resultindex_model->schoolpoints_overallchampions($festid,$fair,$schoolcode);
		/*echo "<br /><br />1----><br />";
		var_dump($point_details);	
		echo "<br /><br />2----><br />";
		var_dump($overall_details);	*/
		$this->Contents['festName']   =  $this->General_Model->get_data('festival_master','fest_id,fest_name',array('fest_id' => $festid),'');
		$this->Contents['fairName']   =  $this->General_Model->get_data('science_master','fairId,fairName',array('fairId' => $fair),'');
		$this->Contents['schoolName'] =  $this->General_Model->get_data('school_master','school_code,school_name',array('school_code' => $schoolcode),'');
		$this->Contents['details']   =  $point_details;
		$this->Contents['overall_details']   =  $overall_details;
		$this->load->view('report/publishresult/schoolpoints_details', $this->Contents);
	}
	
	function allresults()
	{
		if($this->Session_Model->check_user_permission(45)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$fair           = 	$this->input->post('cmbFairType');
		if($fair == 4){
			$work_type      = 	$this->input->post('radioLabel');
		}else{
			$work_type      = 	"no";
		}
		
		$this->Contents  = 	array();
		$this->Contents['fairid']	=	$fair;
		$this->template->write('title', '');
		$fair           = 	$this->input->post('cmbFairType');
		
		
		
		if($work_type == 'no' || $work_type == 'spot'){
			$details         = 	$this->resultindex_model->allresults($fair);
			$this->Contents['details']   =  $details;
			$this->load->view('report/publishresult/allresults', $this->Contents);
				
		}
		else if($work_type == 'exhib'){
			$details         = 	$this->resultindex_model->allresults_exb($fair);
			$this->Contents['wrk']   =  'exb';
			$this->Contents['details']   =  $details;
			//var_dump($details);
			$this->load->view('report/publishresult/allresults', $this->Contents);
				
		}
		else if($work_type == 'all')
		{
			//echo "llll";
			$details         	= 	$this->resultindex_model->allresults($fair);
			$details2         	= 	$this->resultindex_model->allresults_exb($fair);
			$this->Contents['details']  	 =  $details;
			$this->Contents['details2']   	 =  $details2;
			$this->Contents['wrk']   =  'all';
			$this->load->view('report/publishresult/allresults_work_aggr', $this->Contents);			
		}		
		
	}
	
	function overallchampions()
	{
		if($this->Session_Model->check_user_permission(45)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->Contents  = 	array();
		$this->template->write('title', '');
		$fair           = 	$this->input->post('cmbFairType');
		
		 //print_r($details);
		//echo "<br /><br />-----".$fair;
		
		$this->Contents['fairname']         = 	$this->General_Model->get_data('science_master','fairId,fairName',array('fairId' => $fair),'');
		
		if($fair == 4){
			$work_type      = 	$this->input->post('radioLabel');
		}else{
			$work_type      = 	"no";
		}
		$this->template->write('title', '');
		$this->Contents['fairId']   =  $fair;
		
		if($work_type == 'no' || $work_type == 'spot'){
			$details1         = 	$this->resultindex_model->overallchampions($fair,1);
			$details2         = 	$this->resultindex_model->overallchampions($fair,0);
			$this->Contents['overall_details']   =  $details1;
			$this->Contents['runnerup_details']  =  $details2;
			$this->load->view('report/publishresult/overallchampions', $this->Contents);
				
		}
		
		else if($work_type == 'exhib'){
			$details1         = 	$this->resultindex_model->overallchampions($fair,0);
			$this->Contents['wrk']   =  'exb';
			$this->Contents['overall_details']   =  $details1;
			$this->Contents['runnerup_details']  =  $details1;
		$this->load->view('report/publishresult/overallchampions', $this->Contents);
				
		}
		
		else if($work_type == 'all')
		{
			$details1         = 	$this->resultindex_model->overallchampions_work_aggr($fair);
			$this->Contents['wrk']   =  'all';
			$this->Contents['overall_details']   =  $details1;
			$this->Contents['runnerup_details']  =  $details1;
		$this->load->view('report/publishresult/overallchampions', $this->Contents);			
		}		
		
	}
	
	function festwise_overallchampions()
	{
		if($this->Session_Model->check_user_permission(45)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->Contents  = 	array();
		$this->template->write('title', '');
		$fair           = 	$this->input->post('cmbFairType');
		$fest           = 	$this->input->post('hidfestId');
		//echo "<br /><br />--------->$fair"." ----->".$fest;
		
		
		
		if($fair == 4){
			$work_type      = 	$this->input->post('radioLabel');
		}else{
			$work_type      = 	"no";
		}
		$this->template->write('title', '');
		$this->Contents['fairId']   =  $fair;
		
		if($work_type == 'no' || $work_type == 'spot'){
			$details         = 	$this->resultindex_model->festwise_overallchampions($fair,$fest);
			$this->Contents['details']   =  $details;
			$this->load->view('report/publishresult/festwise_overallchampions', $this->Contents);
				
		}
		
		else if($work_type == 'exhib'){
			$details        = 	$this->resultindex_model->festwise_overallchampions($fair,$fest);
			$this->Contents['wrk']   =  'exb';
			$this->Contents['details']   =  $details;
			$this->load->view('report/publishresult/festwise_overallchampions', $this->Contents);
				
		}
		
		else if($work_type == 'all')
		{
			$details         = 	$this->resultindex_model->festwise_overallchampions_work_aggr($fair,$fest);
			$this->Contents['details']   =  $details;
			$this->Contents['wrk']   =  'all';
			$this->load->view('report/publishresult/festwise_overallchampions', $this->Contents);			
		}		
		
		 //print_r($details);
		//echo "<br /><br />-----".$fair;
		
		
	}
	
	function festval_status()
	{
		if($this->Session_Model->check_user_permission(45)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->Contents  = 	array();
		$this->template->write('title', '');
		$fair             = 	$this->input->post('cmbFairType');
		$this->Contents['fairname']         = 	$this->General_Model->get_data('science_master','fairId,fairName',array('fairId' => $fair),'');
		//$this->Contents['fairid']         = 	$this->General_Model->get_data('science_master','fairName',array('fairId' => $fair),'');
		//var_dump($this->Contents['fairname']);
		$details1         = 	$this->resultindex_model->festval_status1($fair);
		$details2         = 	$this->resultindex_model->festival_status2($fair);
		
		//print_r($details);
		$this->Contents['details1']   =  $details1;
		$this->Contents['details2']   =  $details2;
		
		$this->template->write_view('content', 'report/publishresult/festival_status', $this->Contents);
		$this->template->load();
	}
	
	function festival_allitem()
	{
		if($this->Session_Model->check_user_permission(45)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->Contents  = 	array();
		$this->template->write('title', '');
		$fest= $this->input->post('hidfestid');
		$fair= $this->input->post('hidfairid');
		$this->Contents['fairname']         = 	$this->General_Model->get_data('science_master','fairId,fairName',array('fairId' => $fair),'');
		$totitem         = 	$this->resultindex_model->festval_allitems($fest,$fair);
		//print_r($totitem);
		$this->Contents['totitem']   =  $totitem;
		$this->load->view('report/publishresult/festival_allitem', $this->Contents);
	}
	function finished_item()
	{
		if($this->Session_Model->check_user_permission(45)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->Contents  = 	array();
		$this->template->write('title', '');
		$fest= $this->input->post('hidfestid');
		$fair= $this->input->post('hidfairid');
		$this->Contents['fairname']         = 	$this->General_Model->get_data('science_master','fairId,fairName',array('fairId' => $fair),'');
		$totitem         = 	$this->resultindex_model->finished_allitems($fest,$fair);
		//print_r($totitem);
		$this->Contents['totitem']   =  $totitem;
		$this->load->view('report/publishresult/finished_allitem', $this->Contents);
	}
	function incomplete_item()
	{
		if($this->Session_Model->check_user_permission(45)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->Contents  = 	array();
		$this->template->write('title', '');
		$fest= $this->input->post('hidfestid');
		$fair= $this->input->post('hidfairid');
		$this->Contents['fairname']         = 	$this->General_Model->get_data('science_master','fairId,fairName',array('fairId' => $fair),'');
		$totitem         = 	$this->resultindex_model->incomplete_allitems($fest,$fair);
		//print_r($totitem);
		$this->Contents['totitem']   =  $totitem;
		$this->load->view('report/publishresult/incomplete_item', $this->Contents);
	}
}

?>