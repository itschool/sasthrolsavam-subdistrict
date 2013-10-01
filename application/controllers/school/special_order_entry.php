<?php
class Special_Order_Entry extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//$this->Session_Model->is_user_logged(true);
		
		$this->load->model('General_Model');
		$this->load->model('Session_Model');
		$this->load->model('school/Registration_Model');
		$this->Content['is_edit']	=	'yes';
	}
	
	function index($message = array())
	{
	
		if($this->Session_Model->check_user_permission(20)==false ){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		if (count(@$message['error_array']) > 0)
		{
			foreach(@$message as $error)
			{
				$this->template->write('error',$error.'<br>');
			}
		}
		$schoolCode	=	'';
		if($this->input->post('hidSchoolId')){
			$schoolCode	=	$this->input->post('hidSchoolId');
		}
	
		if($schoolCode){
			//echo '<br><br><br>tttttt';
			$this->Content['school_show']			=	'show';
			$this->Content['school_details']		= 	$this->Registration_Model->get_school_details($schoolCode);
			$this->Content['participant_details']	= 	$this->Registration_Model->get_special_order_participant_details($schoolCode);
			//$this->Content['Photo']				=	$this->Photos_Model->get_special_entry_photo($this->Content);
			//$this->Content['participants']			= 	$this->General_Model->get_participant_details_combo($schoolCode);
			$this->Content['orders']				= 	$this->General_Model->prepare_select_box_data('special_order_master','spo_id, spo_title','','Select Order','spo_id');
			$fest									=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','fest_id >0 ','Select Festival','fest_id');
			$fair									=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','Select Fair','fairId');
			$this->Content['fest']		=	$fest;
		 	$this->Content['fair']		=	$fair; 
			
		} else {
			$this->Content = array();
		}
		
		$this->template->write_view('menu', 'menu');
		$this->template->write_view('content', 'school/special_order_entry', $this->Content);
		$this->template->load();
	}

	function get_school_details($code){
	
	    //echo "<br /><br />yesss";
		$school_details							=	 $this->Registration_Model->get_school_details($code);
		//var_dump($code);
		$this->Content['participant_details']	=	 $this->Registration_Model->get_special_order_participant_details($code);
		
		$this->Content['participants']			= 	$this->General_Model->get_participant_details_combo($code);
		$this->Content['orders']				= 	$this->General_Model->prepare_select_box_data('special_order_master','spo_id, spo_title','','Select Order','spo_id');
		$this->Content['school_details']		=	$school_details;
		$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','fest_id >0 ','Select Festival','fest_id');
		$fair							=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','Select Fair','fairId');
		$this->Content['fest']		=	$fest;
		$this->Content['fair']		=	$fair; 
		
		if ((int)@$school_details[0]['sd_id'] > 0)
		{
			$this->Content['school_show']	=	'show';
		}
		else
		{
			$this->Content['school_show']	=	'';
		}
		$this->load->view('school/special_order_entry', $this->Content);
	}
	
	function get_itemcode_details($code){
	
	    //echo "<script>hiiiiiiiii<script>";
	  //echo "<br /><br /><br />kooooooooooooooooooo".$code;
		$school_code	=	$this->input->post('sch_code');
		$item_details	= 	$this->General_Model->get_data('item_master','*',array('item_code' => $code));
		$capt_details	= 	$this->General_Model->get_data('participant_item_details','*',array('item_code' => $code,'school_code' => $school_code,'is_captain' => 'Y'));
		
		$this->Content['item_det']		=	$item_details;
		$this->Content['capt_det']		=	$capt_details;
		$school_details					=	 $this->Registration_Model->get_school_details($school_code);
		$this->Content['school_details']	=	$school_details;
			//	var_dump($this->Content);
		$this->load->view('school/group_entry',$this->Content);
	}
	
	
	function save_participant () {
		if($this->Session_Model->check_user_permission(20)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$save_participant		=	$this->Registration_Model->save_special_order_participant_details();
		$this->index($save_participant);
	}
	
	function edit_participant_detials($team=0) {
	//echo '<br><br>hhhh';
	//print_r($_POST);
		if($this->Session_Model->check_user_permission(20)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$code=$this->input->post('hidItemId');
		$this->Content['selected_participant']	=	 $this->Registration_Model->get_special_order_participant_details_itemwise($this->input->post('hidSchoolId'),$code,$team);
		//echo '<br><br><br>';
		//print_r($this->Content['selected_participant']);
		$this->Content['selected_fair_id']		=	$this->Content['selected_participant'][0]['fairId'];
		$this->Content['selected_fest_id']		=	$this->Content['selected_participant'][0]['fest_id'];
		$this->Content['item_details']	      =		$this->General_Model->prepare_select_box_data_special('item_master','item_code,item_name','item_code,CONCAT_WS(\' - \',item_code,item_name ) as item_name',array('fest_id' => $this->Content['selected_fest_id'] ,'fairId' => $this->Content['selected_fair_id']),'Select Item','item_code');
		
		$this->Content['selected_item_code']	=	$this->Content['selected_participant'][0]['item_code'];
		
		$this->Content['item_info']	=	$this->General_Model->get_data('item_master','*',array('item_code' => $code));
		//echo '<br><br><br><br>';
		//print_r($_POST);
		$admn					=	$this->Content['selected_participant'][0]['admn_no'];
		$school_code			=	$this->input->post('hidSchoolId');
		
		$this->Content['show_edit']	=	 "show";
		$this->index();
	}
	
	function update_participant_detials($team) {
		if($this->Session_Model->check_user_permission(20)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		//echo '<br><br><br>ddddddddd'; 
		//$update_participant		=	$this->Registration_Model->save_special_order_participant_details();
		$update_participant		=	$this->Registration_Model->update_special_order_participant_details($team);
		
		$this->index($update_participant);
	}
	
	function delete_participant_detials () {
		if($this->Session_Model->check_user_permission(20)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$delete_participant		=	$this->Registration_Model->delete_special_order_participant_details();
		$this->index($delete_participant);
	}
	
	function get_parti_photo()
	{
		$filen	=	$this->input->post('fileName');
		$path	=	$this->Photos_Model->get_Photo($filen);
		echo "<img src='".$path."' width='70' height='70'>";	
		//echo $path;	
	}
	
	
		function get_admn_wise_part_details($schoolcode,$admn,$fest_id,$admn_category=0){
	
		 $admn_no=$admn;
		 if($fest_id==4){
			 $admn_fest1=str_split($admn,1);
			 $admn_fest= $admn_fest1[0];
			 if($admn_fest!='H' && $admn_fest!='V'){
			 
			 $admn_no=$admn_category.$admn;
			 }
			 if($admn_fest=="H" && $admn_category=="V"){
			 $adno=substr($admn,1,strlen($admn));
			 $admn_no=$admn_category.$adno;
			 }
			 if($admn_fest=="V" && $admn_category=="H"){
			 $adno=substr($admn,1,strlen($admn));
			 $admn_no=$admn_category.$adno;
			 }
			 }
			
		$participant_details		=	$this->Registration_Model->get_admn_wise_participant_details($schoolcode,$admn_no);
	//	print_r($participant_details);
		if(($participant_details))
		{
			echo $participant_details[0]['participant_name'].'<br>'.$participant_details[0]['class'].'<br>'.$participant_details[0]['gender'].'<br>'.$participant_details[0]['fest_id'];
		}
		
	}
}
?>