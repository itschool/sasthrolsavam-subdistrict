<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Allotment extends CI_Controller {
	
	public function __construct()
    {
		parent::__construct(); 
		$this->load->model('General_Model');
		$this->load->model('Session_Model');
		$this->load->library('session');
		$this->load->library('javascript');
		$this->load->model('ground/Allotment_Model');
		$this->template->add_js('js/ground/ground.js');	
		//$this->load->helper('General_Model');
		
			
	}//end function  function __construct
	
		
	function index($item_code = '')
	{
		  $this->template->write_view('menu', 'menu', '');
		   //echo '<br><br><br><br>gggg'.$item_code;
		  //$fest= array(0 => "Select", 1 => "LP", 2 => "UP", 3 => "HS", 4 => "HSS/VHSS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
		  //$fair= array(0 => "Select", 1 => "Science Fair", 2 => "Maths Fair", 3 => "Socialscience Fair", 4 => "Workexperience Fair",5 => "IT Fair");		 
		  
		 $fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','fest_id >0 ','Select Festival','fest_id');
		// $fest_wrkexp					=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Festival','fest_id');
		$fair							=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','Select Fair','fairId');
		  
		  $this->Content['fest']		=	$fest;
		 // $this->Content['fest_wrkexp']	=	$fest_wrkexp;
		  $this->Content['fair']		=	$fair;
		  
		   $this->Content['item_details'] =	array(0 => "---Select---");
		 
		  
		if($this->Session_Model->check_user_permission(3)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$item_code                          =   $this->input->post('txtItemCode');
		if($item_code!='')
		{
		//echo '<br><br><br>dddddddd';
		//print_r($_POST);
			 $fest_id	=	($this->input->post('cmbFestType')) ?  $this->input->post('cmbFestType') : (($this->input->post('txtFestId')) ? $this->input->post('txtFestId') : '') ;
		  
		  	 $fair_id	=	($this->input->post('cmbFairType')) ?  $this->input->post('cmbFairType') : (($this->input->post('txtFairId')) ? $this->input->post('txtFairId') : '') ;
			//echo '<br><br><br>dddddddd'.$fest_id;
		  $this->Content['fest_id']         =     $fest_id;
		  $this->Content['fair_id']         =     $fair_id;
		  $this->Content['item_id']         =     $item_code;
		  $this->Content['grounds']			=	  $this->Allotment_Model->get_grounds();
		  //$item_details	=	$this->General_Model->prepare_select_box_data('item_master', 'item_code, item_name','fairId ='.$fair_id.' and fest_id='.$fest_id,'----Select----','item_code');
		  $item_details	      =		$this->General_Model->prepare_select_box_data_special('item_master','item_code,item_name','item_code,CONCAT_WS(\' - \',item_code,item_name ) as item_name',array('fest_id' => $fest_id,'fairId' => $fair_id),'Select Item','item_code');
		   $this->Content['item_details']	= $item_details;
		  
		}
		//echo '<br><br><br>gggg==='.$item_code;
		//$this->Content['no_of_clusters']	=	$this->General_Model->get_settings(1);
		$this->Content['interval_bw_items']	=	$this->General_Model->get_settings(2);
		$this->Content['no_of_judges']		=	$this->General_Model->get_settings(3);
		//$this->Content['alloted_records']	=	$this->Allotment_Model->get_alloted_item_details($item_code);
		//$this->Content['stages']			=	$this->Allotment_Model->get_stages();
		$this->Content['is_edit']			=	'yes';
		$this->Content['alloted_details']	=	0;
		if($item_code)
		{
			//echo '<br><br><br>sdsss'.$item_code;
			$this->Content['selected_item']		=	$this->Allotment_Model->get_item_details($item_code);
			$this->Content['alloted_records']	=	$this->Allotment_Model->get_alloted_item_details($item_code);
			$this->Content['alloted_details']	=	1;
			//$this->Content['cluster_master_details']	=	$this->Allotment_Model->get_cluster_master_details($item_code);
		}
		$this->Content['date_array']		=	$this->General_Model->get_fest_date_array();
		$this->Content['hour_array']		=	$this->General_Model->get_hour_array();
		$this->Content['min_array']			=	$this->General_Model->get_min_array();
		$this->template->write_view('content', 'ground/allotment', $this->Content);
		$this->template->load();
	}
	
	function groundallot_duration()
	{
		if($this->Session_Model->check_user_permission(31)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		
		$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Festival','fest_id');
		
		$fest['ALL']               ='All Festival';
		
		$this->Contents				=	array();
		$this->Contents['fest']		=	$fest;
		$this->template->write_view('content','report/prereport/groundallot_duration',$this->Contents);
		$this->template->load();
	  
	}
		
	function get_item_details($fair_id,$fest_id,$wrkexp_type=0)
	{
	//if($wrkexp_type==2)$fest_id=0;
	//echo $fest_id;
		//$item_details	=	$this->General_Model->prepare_select_box_data('item_master', 'item_code,item_name','item_code,CONCAT_WS(\' - \',item_code,item_name ) as item_name',array('fairId' => $fair_id,'fest_id' => $fest_id),'----Select----','item_code');
		
		if($wrkexp_type==2)
		{
		$item_details	      =		$this->General_Model->get_exhibition_schools($fair_id,$fest_id);
		}
		else
		{
		$item_details	      =		$this->General_Model->prepare_select_box_data_special('item_master','item_code,item_name','item_code,CONCAT_WS(\' - \',item_code,item_name ) as item_name',array('fest_id' => $fest_id,'fairId' => $fair_id),'Select Item','item_code');
		}
	//	print_r($item_details);
		echo form_dropdown("cmbItemType",$item_details,@$item_id, 'class="input_box" id="cmbItemType" onChange="javascript:fetch_participant_details()"'  );
	
	}
	
	function get_participant_details($fair_id,$fest_id,$item_id)
	{
	//echo '<br><br><br>$fair_id='.$fair_id.'$fest_id=='.$fest_id.'$item_id='.$item_id;
		 /* $fest= array(0 => "Select", 1 => "LP", 2 => "UP", 3 => "HS", 4 => "HSS/VHSS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
		  $fair= array(0 => "Select", 1 => "Science Fair", 2 => "Maths Fair", 3 => "Socialscience Fair", 4 => "Workexperience Fair",5 => "IT Fair");	*/	
		$itemlength = strlen($item_id);
		
		$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','fest_id >0 ','Select Festival','fest_id');
		//$fest_wrkexp					=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Festival','fest_id');
		$fair							=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','Select Fair','fairId');
		 
		$this->Content['fest']		=	$fest;
		$this->Content['fair']		=	$fair;
		//$this->Content['fest_wrkexp']		=	$fest_wrkexp;
		
		$this->Content['fest_id']		=	$fest_id;
		$this->Content['fair_id']		=	$fair_id;
		$this->Content['item_id']		=	$item_id;
		
		//$this->Content['item_details']	=	$this->General_Model->prepare_select_box_data('item_master', 'item_code, item_name','fairId ='.$fair_id.' and fest_id='.$fest_id,'----Select----','item_id');
		if($itemlength ==5)$this->Content['item_details']	      =		$this->General_Model->get_exhibition_schools($fair_id,$fest_id);
		else $this->Content['item_details']	      =		$this->General_Model->prepare_select_box_data_special('item_master','item_code,item_name','item_code,CONCAT_WS(\' - \',item_code,item_name ) as item_name',array('fest_id' => $fest_id,'fairId' => $fair_id),'Select Item','item_code');
		
		  
		$this->Content['selected_item']		=	$this->Allotment_Model->get_item_details($item_id);
		$this->Content['interval_bw_items']	=	$this->General_Model->get_settings(2);
		$this->Content['no_of_judges']		=	$this->General_Model->get_settings(3);
		$this->Content['is_edit']			=	'yes';
		$this->Content['grounds']			=	$this->Allotment_Model->get_grounds();
		$this->Content['alloted_records']	=	$this->Allotment_Model->get_alloted_item_details($item_id);
		//echo '<br><br><br>';
		//print_r($this->Content['alloted_records']);
		
		$this->Content['date_array']		=	$this->General_Model->get_fest_date_array();
		$this->Content['hour_array']		=	$this->General_Model->get_hour_array();
		$this->Content['min_array']			=	$this->General_Model->get_min_array();
		
		$this->load->view('ground/allotment', $this->Content);
	}

	function save_allotment () 
	{
		if($this->Session_Model->check_user_permission(3)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->form_validation->set_rules('cmbGround', 'Select Ground', 'required');
		$this->form_validation->set_rules('txtDate', 'Select Date', 'required');
		$this->form_validation->set_rules('txtHour', 'Enter Hour', 'required');
		$this->form_validation->set_rules('txtMin', 'Enter Minute', 'required');
		$this->form_validation->set_rules('cmbNoOfJudges', 'Select Number of judges', 'required');
		
		if ($this->form_validation->run() == false)
		{
			$this->template->write('error', validation_errors().'<br>');
			$this->index();
			return;
		}else{
			$this->Allotment_Model->save_allotment ();
			$this->index($this->input->post('hidItemId'));
		}
	}
	
	function update_allotment ()
	{
		if($this->Session_Model->check_user_permission(3)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->form_validation->set_rules('cmbGround', 'Select Ground', 'required');
		$this->form_validation->set_rules('txtDate', 'Select Date', 'required');
		$this->form_validation->set_rules('txtHour', 'Enter Hour', 'required');
		$this->form_validation->set_rules('txtMin', 'Enter Minute', 'required');
		$this->form_validation->set_rules('cmbNoOfJudges', 'Select Number of judges', 'required');
		
		if ($this->form_validation->run() == false)
		{
			$this->template->write('error', validation_errors().'<br>');
			$this->index();
			return;
		}else{
			$this->Allotment_Model->update_allotment ();
			$this->index($this->input->post('hidItemId'));
		}
	}

}
/* End of file Allotment.php */
/* Location: ./application/controllers/ground/Allotment.php */
?>