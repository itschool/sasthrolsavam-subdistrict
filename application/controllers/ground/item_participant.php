<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Item_Participant extends CI_Controller {
	
	public function __construct()
    {
		parent::__construct(); 
		$this->load->model('General_Model');
		$this->load->model('Session_Model');
		$this->load->library('session');
		$this->load->library('javascript');
		$this->template->add_js('js/ground/ground.js');	
		$this->load->model('ground/Participant_Model');
		$this->load->model('ground/Allotment_Model');
		
		//$this->Session_Model->is_user_logged();
		//$this->Session_Model->check_user_permission('1');
	}
	function participant_nodetails($message = '')
	{
		$this->template->write_view('menu', 'menu', '');	
		 $this->Contents				=	array();
		 //$fest= $this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','','fest_id');
		 /* $fest= array(0 => "Select", 1 => "LP", 2 => "UP", 3 => "HS", 4 => "HSS/VHSS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
		  $fair= array(0 => "Select", 1 => "Science Fair", 2 => "Maths Fair", 3 => "Socialscience Fair", 4 => "Workexperience Fair",5 => "IT Fair");	*/	 
		  
		$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','fest_id >0 ','Select Festival','fest_id');
		$fair							=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','Select Fair','fairId');
		
		  $this->Contents['fest']		=	$fest;
		  $this->Contents['fair']		=	$fair;
		  $fest_id	=	($this->input->post('cmbFestType')) ?  $this->input->post('cmbFestType') : (($this->input->post('txtFestId')) ? $this->input->post('txtFestId') : '') ;
		  
		  $fair_id	=	($this->input->post('cmbFairType')) ?  $this->input->post('cmbFairType') : (($this->input->post('txtFairId')) ? $this->input->post('txtFairId') : '') ;
			
		 $this->Contents['fair_id']         =     $fair_id;
		
		 //if(@$fair_id==4 && @$_POST['cmbWrkexpType']==2){$fest_id=0;}
		 	
		  $this->Contents['fest_id']         =     $fest_id;
		  
		//  echo '<br><br><br>festid=='.$fest_id.'<br>fairid=='.$fair_id;
		// print_r($_POST);
		  $this->template->write_view('content', 'ground/participant_nodetails', $this->Contents);	
		  
			if($fest_id || $fair_id){
				 //echo '<br><br><br>festid=='.$fest_id.'<br>fairid=='.$fair_id;
				 $this->Contents	= array();
				 
				 $fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','fest_id >0 ','Select Festival','fest_id');
				 $fair							=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','Select Fair','fairId');
		
				/* $fest= array(0 => "Select", 1 => "LP", 2 => "UP", 3 => "HS", 4 => "HSS/VHSS");	 
		 		 $fair= array(0 => "Select", 1 => "Science Fair", 2 => "Maths Fair", 3 => "Socialscience Fair", 4 => "Workexperience Fair",5 => "IT Fair");*/	
				 			
				 
				 $this->Contents['fest']	   =	$fest;
				 $this->Contents['fair']	   =	$fair;
				
				
				if(@$fair_id==4 && @$_POST['cmbWrkexpType']==2)
				{
				//echo '<br><br><br>ffffffffffff';
				 $itempart					   =	$this->Participant_Model->get_item_exhibition_participant($fest_id,$fair_id);
				 $single					   =	$this->Participant_Model->get_item_exhibition_participant_single($fest_id,$fair_id);
				}
				else
				{
				 $itempart					   =	$this->Participant_Model->get_item_participant($fest_id,$fair_id);
				 $single					   =	$this->Participant_Model->get_item_participant_single($fest_id,$fair_id);
				 
				
				 }

			  $this->Contents['itempart']   =	$itempart;
			  $this->Contents['single']     =    $single;
				 
					 if(count($itempart)>0 or count($single)>0){
					 	$this->Contents['date_array']		=	$this->General_Model->get_fest_date_array();
						$this->Contents['hour_array']		=	$this->General_Model->get_hour_array(false);
						$this->Contents['min_array']		=	$this->General_Model->get_min_array(false);
						$this->Contents['grounds']			=	$this->Allotment_Model->get_grounds();
						$this->Contents['interval_bw_items']=	$this->General_Model->get_settings(2);
						$this->Contents['no_of_judges']		=	$this->General_Model->get_settings(3);
						$this->template->write_view('content','ground/item_allot_details',$this->Contents);
					    //$this->template->write_view('content','ground/participant_details',$this->Contents);
			 		 }
			 	 }
			$this->template->load();
		}
	function get_item_details($fair_id,$fest_id)
	{
		$item_details	=	$this->General_Model->prepare_select_box_data('item_master', 'item_code, item_name','fairId ='.$fair_id.' and fest_id='.$fest_id,'Select','item_code');
	
		echo form_dropdown("cmbItemType",$item_details,@$item_id, 'class="input_box" id="cmbItemType" '  );
	
	}
		
	function ground_allot_fest_all()
	{
		$this->load->model('ground/Allotmentfest_Model');
		$fest_id		=	$this->input->post('cmbFestType'); 
		//echo '<br><br><br>bb==='.$fest_id;
		//echo '<br><br><br>';
		//print_r($_POST);
		if ($fest_id || ($this->input->post('cmbFairType')==4 && $this->input->post('cmbWrkexpType')==2) )
		{
		//echo '<br><br><br>fffffffff';
			$this->Allotmentfest_Model->update_allotment($fest_id);
		}
		$this->participant_nodetails();
	}
}