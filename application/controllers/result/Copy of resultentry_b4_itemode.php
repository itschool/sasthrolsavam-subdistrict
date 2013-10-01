<?php
class Resultentry extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Session_Model');
		$this->template->add_js('js/result.js');
		$this->template->add_js('js/common.js');
		$this->template->write_view('menu', 'menu');
		$this->load->model('result/Result_Model');
	}
	
	function index($message=array(), $item_code = '')
	{
		if($this->Session_Model->check_user_permission(12)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		if (count(@$message['error_array']) > 0)
		{
			$error_msg		=	'';
			foreach(@$message['error_array'] as $error)
			{
				$this->template->write('error',$error.'<br>');
				$error_msg		.=	$error.'\n';	
			}
			$this->Content['error_msg']	=	$error_msg;
		}
		
		$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','fest_id != 0','Select Festival','fest_id');
		$fair							=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','','fairId');
		
		$this->Content['fest']		=	$fest;
		$this->Content['fair']		=	$fair;
		
		$item_code		= (empty($item_code))? $this->input->post('hidItemId'):$item_code;
		if($item_code)
		{
			$this->Content['selected_item']			=	$this->Result_Model->get_item_details_result($item_code);
			
			$this->Content['selected_item_list']	=	$this->Result_Model->get_item_result_list($item_code);
			
			
			if(is_array($this->Content['selected_item_list'])  && count($this->Content['selected_item_list']) > 0)
			{
				$this->Content['show_conirm_button']	=	($this->Result_Model->check_confirm_item($item_code))?'yes':'no';
			}
			else 
			{
				$this->Content['show_conirm_button']	=	'yes';
			}
			$selected_fest_fair			=	$this->General_Model->get_data('item_master','*', array('item_code' => $item_code));
		
			$fairid			=	$selected_fest_fair[0]['fairId'];
			$festid			=	$selected_fest_fair[0]['fest_id'];
			$this->Content['selected_fair_id']			=	$fairid;
			$this->Content['selected_fest_id']			=	$festid;
			$this->Content['selected_item_id']			=	$item_code;
			$this->Content['selected_fair_name']		=	$this->General_Model->get_data('science_master','fairName', array('fairId' => $fairid));
			$this->Content['selected_fest_name']			=	$this->General_Model->get_data('festival_master','fest_name', array('fest_id' => $festid));
			$this->Content['selected_item_name']			=	$this->General_Model->get_data('item_master','item_name', array('item_code' => $item_code));
			
			$this->Content['absentee_list']		= $this->Result_Model->get_absentee_list($item_code);
			$this->Content['add_edit']			= ($this->Content['show_conirm_button'] == 'no')? 'no': 'yes';
		}
		if(!isset($this->Content))
			$this->Content	= array();
		$this->template->write_view('content', 'result/resultentry', $this->Content);
		$this->template->load();
	}
	
	function get_item_details_result($item_id)
	{		
		
		$this->Content['selected_item']			=	$this->Result_Model->get_item_details_result($item_id);
		$this->Content['selected_item_list']	=	$this->Result_Model->get_item_result_list($item_id);
		if(is_array($this->Content['selected_item_list'])  && count($this->Content['selected_item_list']) > 0)
		{
			$this->Content['show_conirm_button']	=	($this->Result_Model->check_confirm_item($item_id))?'yes':'no';
		}
		else 
		{
			$this->Content['show_conirm_button']	=	'yes';
		}
		
		$selected_fest_fair			=	$this->General_Model->get_data('item_master','*', array('item_code' => $item_id));
		
		$fairid			=	$selected_fest_fair[0]['fairId'];
		$festid			=	$selected_fest_fair[0]['fest_id'];
		$this->Content['selected_fair_id']			=	$fairid;
		$this->Content['selected_fest_id']			=	$festid;
		$this->Content['selected_item_id']			=	$item_id;
		$this->Content['selected_fair_name']			=	$this->General_Model->get_data('science_master','fairName', array('fairId' => $fairid));
		$this->Content['selected_fest_name']			=	$this->General_Model->get_data('festival_master','fest_name', array('fest_id 	' => $festid));
		$this->Content['selected_item_name']			=	$this->General_Model->get_data('item_master','item_name', array('item_code' => $item_id));
		
		$fest		=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','fest_id != 0','Select Festival','fest_id');
	
	
		$fair							=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','Select Fair','fairId');
		$this->Content['fest']		=	$fest;
		 $this->Content['fair']		=	$fair; 
		 
		$this->Content['absentee_list']		= $this->Result_Model->get_absentee_list($item_id);
		$this->Content['add_edit']	= ($this->Content['show_conirm_button'] == 'no')? 'no': 'yes';
		$this->load->view('result/bulk_result_entry', $this->Content);
	}
	
	function save_result_entry()
	{
		if($this->Session_Model->check_user_permission(12)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->Content['show_conirm_button'] = 'yes';
		$this->Content['add_edit']	= 'yes';
		$message	=	$this->Result_Model->save_result_details();
		$this->index($message);
	}
	
	function save_bulk_result_entry()
	{
		if($this->Session_Model->check_user_permission(12)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		//echo '<br><br><br>dddddd';
		$this->Content['show_conirm_button'] = 'yes';
		$this->Content['add_edit']	= 'no';
		$itemcode	=	$this->input->post('hidItemId');	
		$message	=	$this->Result_Model->save_bulk_result_details();
		$this->bulk_result_entry($message);
	}
	
	
	function edit_result_entry () {
		if($this->Session_Model->check_user_permission(12)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->Content['show_conirm_button'] = 'yes';
		$this->Content['add_edit']	= 'yes';
		$this->Content['selected_result']	=	$this->Result_Model->get_selected_result_details();
		$this->index();
	}
	
	
	
	function delete_result_entry () {
		if($this->Session_Model->check_user_permission(12)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->Content['show_conirm_button'] = 'yes';
		$this->Content['add_edit']	= 'yes';
		$this->Result_Model->delete_result();
		$this->index();
	}
	
	function delete_bulk_result_entry () {
		if($this->Session_Model->check_user_permission(12)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->Content['show_conirm_button'] = 'yes';
		$this->Content['add_edit']	= 'yes';
		$this->Result_Model->delete_result();
		$this->bulk_result_entry();
		//$this->index(); 
	}
	
	function confirm_bulk_result_entry()
	{
		if($this->Session_Model->check_user_permission(12)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		if ('' != $this->input->post('hidItemId') || '' != $this->input->post('hidFestid'))
		{
			//echo '<br><br>jjjjjjj'.$this->input->post('hidFestid');
			
			if($this->input->post('hidItemId') != 'exb')
			{	
				$item_id	=   $this->input->post('hidItemId');
				$is_conf	=	$this->Result_Model->set_confirm_result($item_id); }
			else { 
				$item_id	=	$this->input->post('hidFestid');
				$is_conf	=	$this->Result_Model->set_confirm_result_exb($item_id); 			
			}
			if($is_conf)
			{
				//echo '<br><br>fffff';
				$this->Content['show_conirm_button']	= 'yes';
				$this->Content['add_edit']				= 'yes';
				if($this->input->post('hidItemId') != 'exb'){
				   $this->Content['absentee_list']			= $this->Result_Model->get_absentee_list($this->input->post('hidItemId'));
				}else {
					$festid	=	$this->input->post('hidFestid');	
				  	$this->Content['absentee_list']			= $this->Result_Model->get_absentee_list_exb($festid);
				  }
				$this->template->write('message', 'Result details confirmed successfully');
			}
			else
			{
				//echo '<br><br>rrrrrr';
				$this->Content['show_conirm_button'] = 'no';
				$this->Content['add_edit']	= 'no';
				$this->template->write('error', 'Failed to confirm Result details');
			}
			$this->bulk_result_entry(array(), $this->input->post('hidItemId'));
		}
		else redirect('resultentry/bulk_result_entry');
	
	
	}
	
	function confirm_result_entry ()
	{
	//
		if($this->Session_Model->check_user_permission(12)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		if ('' != $this->input->post('hidItemId'))
		{
			//echo '<br><br>jjjjjjj'.$this->input->post('hidItemId');
			if($this->Result_Model->set_confirm_result($this->input->post('hidItemId')))
			{
				//echo '<br><br>fffff';
				$this->Content['show_conirm_button']	= 'yes';
				$this->Content['add_edit']				= 'yes';
				$this->Content['absentee_list']			= $this->Result_Model->get_absentee_list($this->input->post('hidItemId'));
				$this->template->write('message', 'Result details confirmed successfully');
			}
			else
			{
				//echo '<br><br>rrrrrr';
				$this->Content['show_conirm_button'] = 'no';
				$this->Content['add_edit']	= 'no';
				$this->template->write('error', 'Failed to confirm Result details');
			}
			$this->index(array(), $this->input->post('hidItemId'));
		}
		else redirect('result/resultentry');
	}
	
	function item_result_list()
	{
		if($this->Session_Model->check_user_permission(12)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->Contents				=	array();
		$fest	= $this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','fest_id != 0','','fest_id');
		$fair	= $this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','','fairId');
		$this->Contents['fest']		=	$fest;
		$this->Contents['fair']		=	$fair;
		$this->template->write_view('content', 'result/festival_type_list', $this->Contents);
		$fest_id	= $this->input->post('cmbFestType');
		$fair_id	= $this->input->post('cmbFairType');
		//echo "<br />--".$this->input->post('radioLabel');
		if($fair_id == 4 && $this->input->post('radioLabel') == 'exhib'){  
				$fest_id						=	0;
		}
		else {   
				$fest_id						=	$fest_id;
		}
		
		if($fair_id)
		{
			//echo '<br><br>festtype---->'.$fest_id;
			$this->Contents	= array();	
			$fairname	=	$this->General_Model->get_data('science_master','*', array('fairId' => $fair_id));	
			$festname	=	$this->General_Model->get_data('festival_master','*', array('fest_id' => $fest_id));		 
			$this->Contents['fairname']	=	$fairname;
			$this->Contents['festname']	=	$festname;
			$this->Contents['fest']		=	$this->General_Model->get_data('festival_master', 'fest_name', array('fest_id' => $fest_id));
			if($this->input->post('radioLabel') != 'exhib'){
				$itempart	   =   $this->Result_Model->get_item_result($fest_id,$fair_id);
				$single        =   $this->Result_Model->get_item_result_single($fest_id,$fair_id);
				$this->Contents['itempart']	= 	$itempart;
				$this->Contents['single']   =   $single;
				if(count($itempart)>0 || count($single)>0)
				{
					$this->template->write_view('content','result/item_result_details',$this->Contents);
				}
			}
			else {
				$single       =   $this->Result_Model->get_item_result_single_exb();
				$this->Contents['single']   =   $single;
				if(count($single)>0)
				{
					$this->template->write_view('content','result/item_result_details_exb',$this->Contents);
				}
			}
			
		}
		$this->template->load();

	}
	
	function bulk_result_entry($message=array(),$item_code = '')
	{	
		
		
		//	print_r($_POST);
		if($this->Session_Model->check_user_permission(12)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		if (is_array($message) && count(@$message['error_array']) > 0)
		{
			$error_msg		=	'';
			foreach(@$message['error_array'] as $error)
			{
				$this->template->write('error',$error.'<br>');
				$error_msg		.=	$error.'\n';	
			}
			$this->Content['error_msg']	=	$error_msg;
		}
		
		$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','fest_id != 0','Select Festival','fest_id');
		$fair							=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','','fairId');
		$items							=	$this->General_Model->prepare_select_box_data('item_master','item_code,item_name','item_code =0','','');
		$this->Content['fest']		=	$fest;
		$this->Content['fair']		=	$fair;
		
		$item_code		= (empty($item_code))? $this->input->post('hidItemId'):$item_code;
		
	//	@$items	      =		$this->General_Model->prepare_select_box_data_special('item_master','item_code,item_name','item_code,CONCAT_WS(\' - \',item_code,item_name ) as item_name',array('fest_id' => 1 ,'fairId' => 1),'Select Item','item_code');
		$this->Content['selected_item_id']			=	$item_code;
		
		//echo '<br><br><br><br>hhhhhhsssssss'.$item_code;
		//echo '<br><br><br><br>gggg'.$this->input->post('hidItemId');
		//echo '<br><br><br><br>dhhhhhhhh'.$item_code;
		//if($item_code==410)$item_code='exb';
		if($item_code)
		{
		
		
			//echo '<br><br><br><br>ssjjjjjjsssss'.$item_code;
			if($item_code != 'exb') 
			{
				$this->Content['selected_item']		=	$this->Result_Model->get_item_details_result($item_code);			
				
				$this->Content['selected_item_dtls']=	$this->Result_Model->get_item_result_list_bulk($item_code);
				
				$this->Content['participant_list']	=	$this->Result_Model->get_bulk_participant_details_result($item_code);	
				if(is_array($this->Content['selected_item'])  && count($this->Content['selected_item']) > 0)
				{	
				   	
					$this->Content['show_conirm_button']	=	($this->Result_Model->check_confirm_item($item_code))?'yes':'no';
				}
				else 
				{
					$this->Content['show_conirm_button']	=	'yes';
				}
				$selected_fest_fair			=	$this->General_Model->get_data('item_master','*', array('item_code' => $item_code));
				$fairid			=	$selected_fest_fair[0]['fairId'];
				$festid			=	$selected_fest_fair[0]['fest_id'];
				$this->Content['selected_item_id']			=	$item_code;
				$this->Content['selected_item_name']		=	$this->General_Model->get_data('item_master','item_name', array('item_code' => $item_code));
				$this->Content['absentee_list']		= $this->Result_Model->get_absentee_list($item_code);
			
			}
			else
			{
				//echo '<br><br><br><br>sssssss'.$this->input->post('hidItemId');
					$festid	=	$this->input->post('hidFestid');
					//echo '<br><br><br><br>sssssss'.$festid;
					$this->Content['selected_item']		=	$this->Result_Model->get_item_details_result_exb($festid);
					$this->Content['selected_item_dtls']=	$this->Result_Model->get_item_result_list_bulk_exb($festid);
					//var_dump($this->Content['selected_item_dtls']);
					$this->Content['participant_list']	=	$this->Result_Model->get_bulk_participant_details_result_exb($festid);
					if(is_array($this->Content['selected_item'])  && count($this->Content['selected_item']) > 0)
					{						
						 //echo "heeeee";			
						$this->Content['show_conirm_button']	=	($this->Result_Model->check_confirm_item_exb($festid))?'yes':'no';
					}
					else 
					{
						 //echo "hoooo";	
						$this->Content['show_conirm_button']	=	'yes';
					}	
					$fairid			=	4;		
					$this->Content['absentee_list']		= $this->Result_Model->get_absentee_list_exb($festid);	
					
					
			}	
		//$this->Content['selected_item_id']			=	$item_id;	
			//if($fairid && $festid)
	
			//	else	@$items	      =		array(0 => 'Select Item');
					 
					  
			$this->Content['selected_fair_id']			=	$fairid;
			$this->Content['selected_fest_id']			=	$festid;
			
			$this->Content['selected_fair_name']		=	$this->General_Model->get_data('science_master','fairName', array('fairId' => $fairid));
			$this->Content['selected_fest_name']		=	$this->General_Model->get_data('festival_master','fest_name', array('fest_id' => $festid));
			
			if($this->input->post('hidedit') == '1')
			{
				$this->Content['add_edit']='yes';
			}
			else{ 
				$this->Content['add_edit']='no';
			}
			
		}
		 $this->Content['items']		=	$items; 
	//	echo '<br><br><br>yyy=='.$item_code;
	//	print_r($this->Content);
		if(!isset($this->Content))
			$this->Content	= array();
		$this->template->write_view('content', 'result/resultentry_bulk', $this->Content);
		$this->template->load();	
		
	}
	
	
	function get_item_details_bulk_result($item_id)
	{		//echo '<br><br><br><br>sssssss'.$item_id;
			//print_r($_POST);
		
		$this->Content['selected_item']			=	$this->Result_Model->get_item_details_result($item_id);
		//$this->Content['selected_item_list']	=	$this->Result_Model->get_item_result_list_bulk($item_id);
		$this->Content['selected_item_dtls']	=	$this->Result_Model->get_item_result_list_bulk($item_id);
		$this->Content['participant_list']	=	$this->Result_Model->get_bulk_participant_details_result($item_id);			
			//var_dump($this->Content['participant_list']);
		if(is_array($this->Content['selected_item'])  && count($this->Content['selected_item']) > 0)
		{
		//echo 'a';
		//print_r($this->Result_Model->check_confirm_item($item_id));
			$this->Content['show_conirm_button']	=	($this->Result_Model->check_confirm_item($item_id))?'yes':'no';
		}
		else 
		{
		//echo 'b';
			$this->Content['show_conirm_button']	=	'yes';
			
				
		}
		
		//echo '<br><br><br>fair ==='.$fairid.'----'.$festid;
		$selected_fest_fair			=	$this->General_Model->get_data('item_master','*', array('item_code' => $item_id));
		if($selected_fest_fair)	
		{
		$fairid			=	$selected_fest_fair[0]['fairId'];
		$festid			=	$selected_fest_fair[0]['fest_id'];
		}
		else
		{
		$fairid			=	0;
		$festid			=	0;
		}
		
		$this->Content['selected_fair_id']			=	$fairid;
		$this->Content['selected_fest_id']			=	$festid;
		$this->Content['selected_item_id']			=	$item_id;
		$this->Content['selected_fair_name']			=	$this->General_Model->get_data('science_master','fairName', array('fairId' => $fairid));
		$this->Content['selected_fest_name']			=	$this->General_Model->get_data('festival_master','fest_name', array('fest_id 	' => $festid));
		//$this->Content['selected_item_name']			=	$this->General_Model->get_data('item_master','item_name', array('item_code' => $item_id));
		$this->Content['selected_item_name']			=	$this->General_Model->get_data('item_master','item_name', array('item_code' => $item_id));
		
		$fest		=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','fest_id != 0','Select Festival','fest_id');
	
	//$items		=	$this->General_Model->prepare_select_box_data('item_master','item_code,item_name','fest_id = '.$festid,'Select item','item_code');
	if($fairid && $festid)
	@$items	      =		$this->General_Model->prepare_select_box_data_special('item_master','item_code,item_name','item_code,CONCAT_WS(\' - \',item_code,item_name ) as item_name',array('fest_id' => $festid ,'fairId' => $fairid),'Select Item','item_code');
	else 	$items							=	$this->General_Model->prepare_select_box_data('item_master','item_code,item_name','item_code =0','','');
	
		$fair							=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','Select Fair','fairId');
		$this->Content['fest']		=	$fest;
		 $this->Content['fair']		=	$fair; 
		  $this->Content['items']		=	$items; 
		$this->Content['absentee_list']		= $this->Result_Model->get_absentee_list($item_id);
		//echo "<br />..........".$this->input->post('hidedit');
		if($this->input->post('hidedit') == '1')
			{
				$this->Content['add_edit']='yes';
				/*$this->template->write_view('content', 'result/resultentry_bulk', $this->Content);
				$this->template->load();*/
			}
			else{ 
				$this->Content['add_edit']='no';
			}
			//var_dump($this->Content);
		$this->load->view('result/resultentry_bulk', $this->Content);
	}
	
	
	
	function get_exib_details_bulk_result($festid)
	{		//echo '<br><br><br><br>sssssssuuuuuu'.$festid;
			
		
		$this->Content['selected_item']			=	$this->Result_Model->get_item_details_result_exb($festid);
		//var_dump($this->Content['selected_item']);		
		$this->Content['selected_item_dtls']	=	$this->Result_Model->get_item_result_list_bulk_exb($festid);
		//var_dump($this->Content['selected_item_dtls']);		
		$this->Content['participant_list']	=	$this->Result_Model->get_bulk_participant_details_result_exb($festid);			
		//var_dump($this->Content['participant_list']);
		
		if(is_array($this->Content['selected_item'])  && count($this->Content['selected_item']) > 0)
		{		
		    //echo "yess";
			$this->Content['show_conirm_button']	=	($this->Result_Model->check_confirm_item_exb($festid))?'yes':'no';
		}
		else 
		{	
			$this->Content['show_conirm_button']	=	'yes';		
		}
		//var_dump($this->Content['show_conirm_button']);
		//$selected_fest_fair			=	$this->General_Model->get_data('item_master','*', 'length(item_code) > 3');
		
		$fairid			=	4;
		$this->Content['selected_fair_id']			=	$fairid;
		$this->Content['selected_fest_id']			=	$festid;
		//$this->Content['selected_item_id']			=	$item_id;
		$this->Content['selected_fair_name']			=	$this->General_Model->get_data('science_master','fairName', array('fairId' => $fairid));
		$this->Content['selected_fest_name']			=	$this->General_Model->get_data('festival_master','fest_name', array('fest_id 	' => $festid));
		//$this->Content['selected_item_name']			=	$this->General_Model->get_data('item_master','item_name', array('item_code' => $item_id));
		
		$fest		=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','fest_id != 0','Select Festival','fest_id');
	
	
		$fair							=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','Select Fair','fairId');
		$this->Content['fest']		=	$fest;
		 $this->Content['fair']		=	$fair; 
		 
		$this->Content['absentee_list']		= $this->Result_Model->get_absentee_list_exb($festid);
		//var_dump($this->Content['absentee_list']);
		
		if($this->input->post('hidedit') == '1')
			{
				$this->Content['add_edit']='yes';
				
			}
			else{ 
				$this->Content['add_edit']='no';
			}
		$this->load->view('result/resultentry_bulk', $this->Content);
	}
	
	
}
?>