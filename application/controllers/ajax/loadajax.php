<?php
class Loadajax extends CI_Controller  {

	function Loadajax()
	{
		parent::__construct(); 
		$this->load->model('General_Model');
		//$this->load->model('report/Masterreport_Model');
		//$this->load->model('login/Login_Model');
	}
	
	function fetch_item_from_festival($fest_id,$fairid)
	{		
	//echo '<br>ffffff';
		$item_details	      =		$this->General_Model->prepare_select_box_data_special('item_master','item_code,item_name','item_code,CONCAT_WS(\' - \',item_code,item_name ) as item_name',array('fest_id' => $fest_id,'fairId' => $fairid),'Select Item','item_code');
		//print_r($item_details);
		//$item_details['ALL']  = 'ALL Item';
		echo form_dropdown('cbo_item',$item_details,'','id="cbo_item" class="input_box"');		
	}
	
	function fetch_item_from_participantt($fest_id,$fairid)
	{		
		$item_details	      =		$this->General_Model->prepare_select_box_data_special('item_master','item_code,item_name','item_code,CONCAT_WS(\' - \',item_code,item_name ) as item_name',array('fest_id' => $fest_id ,'fairId' => $fairid),'Select Item','item_code');
		$item_details['ALL']  = 'ALL Item';
		echo form_dropdown('cbo_item',$item_details,'','id="cbo_item" class="input_box"');		
	}
	
	function fetch_item_from_participant_codegen($fest_id,$fairid)
	{		
		$item_details	      =		$this->General_Model->prepare_select_box_data_special_exhb('item_master','item_code,item_name','item_code,CONCAT_WS(\' - \',item_code,item_name ) as item_name',array('fest_id' => $fest_id ,'fairId' => $fairid),'Select Item','item_code');
		//$item_details['ALL']  = 'ALL Item';
		echo form_dropdown('cbo_item',$item_details,'','id="cbo_item" class="input_box"');		
	}
	
	
	function fetch_items_for_result_entry($fest_id,$fairid)
	{		
		//echo "<br />hellllllllooooooooooo";
		$item_details	      =		$this->General_Model->prepare_select_box_data_special('item_master','item_code,item_name','item_code,CONCAT_WS(\' - \',item_code,item_name ) as item_name',array('fest_id' => $fest_id ,'fairId' => $fairid),'Select Item','item_code');
	    echo form_dropdown('txtItemCode',$item_details,'','id="txtItemCode" class="input_box"  onchange="javascript:fetch_item_details_result()" onBlur="javascript:fetch_item_details_result()" onkeyup="javascript:fetch_item_details_result()" ');		
	}
	
	function fetch_items_for_bulk_result_entry($fest_id,$fairid)
	{		
		//echo "<br />hellllllllooooooooooo";
		$item_details	      =		$this->General_Model->prepare_select_box_data_special('item_master','item_code,item_name','item_code,CONCAT_WS(\' - \',item_code,item_name ) as item_name',array('fest_id' => $fest_id ,'fairId' => $fairid),'Select Item','item_code');
		echo form_dropdown('cbo_item1',$item_details,'','id="cbo_item1" class="input_box"  onchange="javascript:fetch_bulk_item_details_result(this.value)" onBlur="javascript:fetch_bulk_item_details_result(this.value)" onkeyup="javascript:fetch_bulk_item_details_result(this.value)" ');		
	}
	
	function fetch_items_for_special_order($fest_id,$fairid,$wrkexp_type=0)
	{		
		//echo "<br />hellllllllooooooooooo";
		
	/*	if($fairid==4){//workexperience
			if($wrkexp_type==2){//exhibition
				
			$fest_id =0;
				}
			else {
			//onthespot
				
				
				}
		}*/
		
		if($fairid==2)
			$item_details	      =		$this->General_Model->prepare_select_box_data_special('item_master','item_code,item_name','item_code,CONCAT_WS(\' - \',item_code,item_name ) as item_name',array('fest_id' => $fest_id ,'fairId' => $fairid,'is_quiz'=>'N'),'Select Item','item_code');
		else $item_details	      =		$this->General_Model->prepare_select_box_data_special('item_master','item_code,item_name','item_code,CONCAT_WS(\' - \',item_code,item_name ) as item_name',array('fest_id' => $fest_id ,'fairId' => $fairid),'Select Item','item_code');		
		
		echo form_dropdown('txtItemCode_1',$item_details,'','id="txtItemCode_1" class="input_box"  onchange="javascript:fetch_item_code_details()" onBlur="javascript:fetch_item_code_details()" onkeyup="javascript:fetch_item_code_details()" ');		
		
		
	}
	
	
	
	
	function get_edu_district_details ($district_id) {
	//echo "<br>lllllll<br>";
	//$district_id	=	$this->input->post('district');
		$name	=	(isset($_POST['name']) && trim($_POST['name']) != '') ? trim($_POST['name']) : 'cmbEduDistrict';
		$function =	(isset($_POST['function']) && trim($_POST['function']) != '') ? trim($_POST['function']) : 'loadSubDistrict';
		$item_details	=		$this->General_Model->prepare_select_box_data('edu_district_master','edu_district_code,edu_district_name',array('rev_district_code' => $district_id),'Select Education District');
		//var_dump($item_details);
		echo form_dropdown($name, $item_details,'', 'id="'.$name.'" class="input_box" onChange="javascript:'.$function.'();"');
	}
	
	function get_subdistrict_details_of_edu_district($edu_district_id)
	{
		
		$name	=	(isset($_POST['name']) && trim($_POST['name']) != '') ? trim($_POST['name']) : 'cmbSubDistrict';
		$function =	(isset($_POST['function']) && trim($_POST['function']) != '') ? trim($_POST['function']) : 'loadSchool';
		$item_details	=	$this->General_Model->prepare_select_box_data('sub_district_master','sub_district_code,sub_district_name',array('edu_district_code' => $edu_district_id),'Select subdistrict');
		echo form_dropdown($name, $item_details,'', 'id="'.$name.'" class="input_box" onChange="javascript:'.$function.'();"');
	}
	
	function get_subdistrict_details_small($district_id,$name,$function)
	{
	
		$item_details	=	$this->General_Model->get_subdistrict_details_combo($district_id);
		
		echo form_dropdown($name, @$item_details,'', 'id="'.$name.'" class="select_box_medium"');
	}
	
	function get_subdistrict_details($district_id)
	{
		//$district_id	=	$this->input->post('district');
		$name	=	(isset($_POST['name']) && trim($_POST['name']) != '') ? trim($_POST['name']) : 'cmbSubDistrict';
		$function =	(isset($_POST['function']) && trim($_POST['function']) != '') ? trim($_POST['function']) : 'loadSchool';
		$item_details	=	$this->General_Model->get_subdistrict_details_combo($district_id);
		echo form_dropdown($name, $item_details,'', 'id="'.$name.'" class="input_box" onChange="javascript:'.$function.'();"');
	}
	
	function get_school_details($subdistrict_id)
	{
	//echo '<br><br><br>trr'.$subdistrict_id;
		//$subdistrict_id	=	$this->input->post('subdistrict');
		$name	=	(isset($_POST['name']) && trim($_POST['name']) != '') ? trim($_POST['name']) : 'cmbSchool';
		$item_details	=	$this->General_Model->get_school_details_combo($subdistrict_id);
		//print_r($item_details);
		echo form_dropdown($name, $item_details,'', 'id="'.$name.'" class="input_box"');
	}
	
	function check_sub_dist_admin_exist ()
	{
	//echo '<br><br><br>ffffffff'.$this->session->userdata('USERID');
		//if (1 == $this->session->userdata('USERID'))
	//	{
echo '<div class="generate_button" style="width:190px;height:12px;margin-left:180px;"  onClick="javascript:generateSubDistAdmin (); return false;">Generate Sub-District Admins</div>';
	//	}
	}
	
	function check_code_gen_admin_exist ()
	{
	//echo '<br><br><br>ffffffff'.$this->session->userdata('USERID');
		//if (1 == $this->session->userdata('USERID'))
	//	{
echo '<div class="generate_button" style="width:190px;height:12px;margin-left:180px;"  onClick="javascript:generateCodeGenAdmin (); return false;">Generate Code Generator </div>';
	//	}
	}
	
	function fetch_school_from_festival($schoolcode){//pratheeksha
			
				if($schoolcode!=""){
					$where='school_code='.$schoolcode;
					$item_details	=		$this->General_Model->fetch_data('school_master','school_name,school_code',$where);
					if(count($item_details)>0)
					echo "School Name : ".$item_details[0]['school_name'];	
				}//if($fest_id!="")
				
	}//fetch_school_from_festival()
	
	function fetch_team_item_from_festival($cateid,$fairid,$exb=0){
			if($exb==2)
			{
			$item_details	      =	$this->General_Model->get_exhibition_schools_rpt($fairid,$cateid);
			echo form_dropdown('cbo_item',$item_details,'','id="cbo_item" class="input_box" onchange="javascript:fetch_team_captain_from_item(this.value)" onClick="javascript:fetch_team_captain_from_item(this.value)"');	
			}
			else
			{
			$item_details	      =		$this->General_Model->prepare_select_box_data_special('item_master','item_code,item_name','item_code,CONCAT_WS(\' - \',item_code,item_name ) as item_name',array('fairId' => $fairid,'fest_id' => $cateid),'Select Item','item_code');
			echo form_dropdown('cbo_item',$item_details,'','id="cbo_item" class="input_box" onchange="javascript:fetch_team_captain_from_item(this.value)" onClick="javascript:fetch_team_captain_from_item(this.value)"');	
			}
	}//fetch_team_item_from_festival()
	
	function fetch_team_captain_from_item($itemid){
			$itemlength= strlen($itemid);
			$cap_details	      =	 $this->General_Model->get_item_captains_array($itemid,$itemlength);
			echo form_dropdown('cbo_cap',$cap_details,'','id="cbo_cap" class="input_box"');		
	}
	
	function reset_result_confirmation_status($item_code)
	{
		if($this->session->userdata('USER_GROUP') == 'A' || $this->session->userdata('USER_GROUP') == 'W' || $this->session->userdata('USER_GROUP') == 'U')
		{
			$this->load->model('result/result_model');
			if($this->result_model->reset_result_confirmation_status($item_code))
			{
				echo 'No';
			}
		}
	}
	function reset_result_confirmation_status_exb($fest)
	{
		if($this->session->userdata('USER_GROUP') == 'A' || $this->session->userdata('USER_GROUP') == 'W' || $this->session->userdata('USER_GROUP') == 'U')
		{
			//echo "hhhhhhhh";
			$this->load->model('result/result_model');
			if($this->result_model->reset_result_confirmation_status_exb($fest))
			{
				echo 'No';
			}
		}
	}
	
	function fetch_higherlevel($fest_id,$fairid)
	{
		//$fest_id	          =	 $this->input->post('fest_id');
		
		if($fest_id!='All' and $fest_id != 'ALL'){
		//echo "<br />l<br />";
		$item_fetch	      =		$this->General_Model->prepare_select_box_data_special('item_master','item_code,item_name','item_code,CONCAT_WS(\' - \',item_code,item_name ) as item_name',array('fest_id' => $fest_id,'fairId' => $fairid),'Select Item','item_code');
		
		$item_fetch['ALL']  = 'ALL Item';
		
		//var_dump($item_fetch);
		
		echo form_dropdown('cbo_item',$item_fetch,'','id="cbo_item" class="input_box"');	
		}
		else
		{
		$item_fetch['ALL']  = 'All Items';
		echo form_dropdown('cbo_item',$item_fetch,'','id="cbo_item" class="input_box"');
		
		}	
	}


function get_participant_details ($participant_id){
		$this->Contents = array();
		$this->load->model('certificate/certificate_model');
		$this->Contents['participant_id'] = 	$participant_id;
		$participant_details	=	$this->certificate_model->get_participant_details_with_id($participant_id);
	
		if (is_array($participant_details) && count($participant_details) > 0)
		{
			$this->Contents['participant_details']	=	$participant_details[0]['participant_name'].',&nbsp;'.$participant_details[0]['school_name'];
			//echo "<input type='hidden' name='cmbFairType' id='cmbFairType'  value='".$participant_details[0]['fairId']."' />";
			echo "<input type='hidden' name='schoolcode' id='schoolcode'  value='".$participant_details[0]['school_code']."' />";
			//echo "<input type='hidden' name='captainId' id='captainId'  value='".$participant_details[0]['participant_id']."' />";
			
			/*if($participant_details[0]['fairId']==4 && $participant_details[0]['fest_id']==0){ 
				echo "<input type='hidden' name='radioLabel' id='radioLabel'  value='exhib' />";
			}*/
			if($participant_details[0]['fairId']==4 && $participant_details[0]['fest_id']!=0){
				echo "<input type='hidden' name='radioLabel' id='radioLabel'  value='spot' />";
			}
			
			$item_details_array	=	$this->certificate_model->get_participant_item_details($participant_id,$participant_details[0]['school_code'],'',$participant_details[0]['fest_id']);
			if(is_array($item_details_array) && count($item_details_array) > 0)
			{
			$this->Contents['item_drop_down']	=	form_dropdown('item_code', $item_details_array, '', 'class="input_box" id="item_code"');
			}
			
		}
		
		$contents	=	$this->load->view('certificate/participant_item_details', $this->Contents);
		echo $contents;
	}

	function get_school_items ($fair,$fest_id,$school_code,$checkvalue=''){
			$this->load->model('certificate/certificate_model');
			
			if($fair==4){
				  if($checkvalue != 'exhib'){
					if (0 != $fest_id){
						echo $this->certificate_model->get_school_item_details($fair,$school_code, $fest_id,$checkvalue);
					}
					else{
						echo '<select  class="input_box"  name="item_code" id="item_code" ><option value="0">All Items</option></select>';
					}
				  }
				  else{
					  	echo '<select  class="input_box"  name="item_code" id="item_code" disabled="disabled"><option value="0">All Items</option></select>';
				  }	
			}
			else{
				if (0 != $fest_id){ 
						echo $this->certificate_model->get_school_item_details($fair,$school_code, $fest_id);
				}
				else{
						echo '<select  class="input_box"  name="item_code" id="item_code" ><option value="0">All Items</option></select>';
				}
			}
	}
	

	function get_school_captains ($fair,$item_code, $school_code){
			$this->load->model('certificate/certificate_model');
			$captain_array	=	$this->certificate_model->get_captains_details ($item_code, $school_code);
			if (is_array($captain_array) && count($captain_array) > 0){
				echo form_dropdown('captain_id', $captain_array, '', 'class="input_box" id="captain_id" onChange=javascript:get_school_group_participants(this.value);');
			}
			else{
				echo '<select  class="input_box"  name="captain_id" id="captain_id" ><option value="0">All Participant</option></select>';
			}
	}
	
	function get_all_group_participants ($item_code,$captain_id, $school_code=''){
			$this->load->model('certificate/certificate_model');
			if (!empty($captain_id) && 0 != $captain_id)
			{
				echo $this->certificate_model->get_group_participants ($item_code, $captain_id, $school_code);
			}
			else
			{
				echo '<select  class="input_box"  name="participant_id" id="participant_id" ><option value="0">All Participant</option></select>';
			}
	}
	


	function get_attended_school_items ($fair,$fest_id,$school_code,$checkvalue=''){
			$this->load->model('certificate/certificate_model');
			
			if($fair==4){
				  if($checkvalue != 'exhib'){
					if (0 != $fest_id){
						echo $this->certificate_model->get_attended_school_item_details($fair,$school_code, $fest_id,$checkvalue);
					}
					else{
						echo '<select  class="input_box"  name="item_code" id="item_code" ><option value="0">All Items</option></select>';
					}
				  }
				  else{
					  	$fest_id	= 0;
						echo $this->certificate_model->get_attended_school_item_details($fair,$school_code, $fest_id,$checkvalue);
				  }	
			}
			else{
				if (0 != $fest_id){ 
						echo $this->certificate_model->get_attended_school_item_details($fair,$school_code, $fest_id);
				}
				else{
						echo '<select  class="input_box"  name="item_code" id="item_code" ><option value="0">All Items</option></select>';
				}
			}
	}


function get_attended_school_captains ($fair,$item_code, $school_code){
			$this->load->model('certificate/certificate_model');
			$captain_array	=	$this->certificate_model->get_attended_captains_details ($item_code, $school_code);
			if (is_array($captain_array) && count($captain_array) > 0){
				echo form_dropdown('captain_id', $captain_array, '', 'class="input_box" id="captain_id" onChange=javascript:get_school_group_participants(this.value);');
			}
			else{
				echo '<select  class="input_box"  name="captain_id" id="captain_id" ><option value="0">All Participant</option></select>';
			}
	}	
	
/*function get_attended_participant_details ($participant_id){

		$this->Contents = array();
		$this->load->model('certificate/certificate_model');
		$this->Contents['participant_id'] = 	$participant_id;
		$participant_details	=	$this->certificate_model->get_participant_details_with_id($participant_id);
		if (is_array($participant_details) && count($participant_details) > 0)
		{
			$this->Contents['participant_details']	=	$participant_details[0]['school_name'];
			echo "<input type='hidden' name='cmbFairType' id='cmbFairType'  value='".$participant_details[0]['fairId']."' />";
			echo "<input type='hidden' name='schoolcode' id='schoolcode'  value='".$participant_details[0]['school_code']."' />";
			echo "<input type='hidden' name='captainId' id='captainId'  value='".$participant_details[0]['participant_id']."' />";
			
			if($participant_details[0]['fairId']==4 && $participant_details[0]['fest_id']==0){ 
				echo "<input type='hidden' name='radioLabel' id='radioLabel'  value='exhib' />";
			}
			if($participant_details[0]['fairId']==4 && $participant_details[0]['fest_id']!=0){
				echo "<input type='hidden' name='radioLabel' id='radioLabel'  value='spot' />";
			}
			
		}
		$item_details_array	=	$this->certificate_model->get_participant_item_details($participant_id,$participant_details[0]['school_code'],$participant_details[0]['fairId'],$participant_details[0]['item_code']);
		if(is_array($item_details_array) && count($item_details_array) > 0)
		{
			$this->Contents['item_drop_down']	=	form_dropdown('item_code', $item_details_array, '', 'class="input_box" id="item_code"');
		}
		$contents	=	$this->load->view('certificate/participant_item_details', $this->Contents);
		echo $contents;
	}	
*/



}//class




?>