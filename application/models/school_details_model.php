<?php

class School_Details_Model extends CI_Model{
	function School_Details_Model()
	{
		parent::__construct();
	}
	
	function getLoginDetails()
	{
		$this->db->select('*');
		$this->db->where('user_name', $this->input->post('txtUserName'));
		$this->db->where('password', get_encr_password($this->input->post('txtPassword')));
		$query	= $this->db->get('user_master');
		$result	= $query->result_array();
		return $result;
	} 
	function getUserdetails($userName)
	{
		$this->db->select('*');
		$this->db->where('user_name', $userName);
		$query	= $this->db->get('user_master');
		$result	= $query->result_array();
		return $result;
	} 
	
	
	function getRevDistrictDetails($id)
	{
		$this->db->select('*');
		$this->db->where('rev_district_code', $id);
		$query	= $this->db->get('rev_district_master');
		$result	= $query->result_array();
		return $result;
	}
	function getEduDistrictDetails($id)
	{
		$this->db->select('*');
		$this->db->where('edu_district_code', $id);
		$query	= $this->db->get('edu_district_master');
		$result	= $query->result_array();
		return $result;
	}
	function getSubDistrictDetails($id)
	{
		$this->db->select('*');
		$this->db->where('sub_district_code', $id);
		$query	= $this->db->get('sub_district_master');
		$result	= $query->result_array();
		return $result;
	}
	function getEduDistrictRevenuedistrictWise($rev_district_code)
	{
		$this->db->select('*');
		$this->db->where('rev_district_code',$rev_district_code);
		$query	= $this->db->get('edu_district_master');
		$result	= $query->result_array();
		return $result;
	}
	function getSubDistrictsRevenuedistrictWise($rev_district_code)
	{
		$this->db->select('*');
		$this->db->where('rev_district_code',$rev_district_code);
		$query	= $this->db->get('sub_district_master');
		$result	= $query->result_array();
		return $result;
	}
	function getSchoolsEdudistrictWise($edu_district_code)
	{
			$this->db->select('S.*');
			$this->db->from('school_master as S');
			$this->db->join('school_class as SC','S.school_code=SC.school_code');
			$this->db->where('SC.class LIKE ','%HS%');
			$this->db->where('S.edu_district_code',$edu_district_code);
			$query	= $this->db->get();
			$result	= $query->result_array();
			return $result;
	}
	///////////////////////////////////////////////////////////////////
	
	function get_district_school_details($dist)
	{
		$this->db->where('SM.rev_district_code',$dist);
		$total_school	=	$this->db->count_all_results('school_master SM');
		
				
		$this->db->select('count(DISTINCT PD.school_code) as count ');
		$this->db->where('SM.rev_district_code',$dist);
		$this->db->where('PD.fairId',1);
		$this->db->from('school_master SM');
		$this->db->join('school_details AS SD','SM.school_code = SD.school_code');
		$this->db->join('participant_item_details AS PD','PD.school_code = SD.school_code');
		$science_query	=	$this->db->get();
		$science_result	=	$science_query->result_array();
		$science_entered	=	$science_result[0]['count'];
		
		$this->db->select('count(DISTINCT PD.school_code) as count ');
		$this->db->where('SM.rev_district_code',$dist);
		$this->db->where('PD.fairId',2);
		$this->db->from('school_master SM');
		$this->db->join('school_details AS SD','SM.school_code = SD.school_code');
		$this->db->join('participant_item_details AS PD','PD.school_code = SD.school_code');
		$maths_query	=	$this->db->get();
		$maths_result	=	$maths_query->result_array();
		$maths_entered	=	$maths_result[0]['count'];
		
		$this->db->select('count(DISTINCT PD.school_code) as count ');
		$this->db->where('SM.rev_district_code',$dist);
		$this->db->where('PD.fairId',3);
		$this->db->from('school_master SM');
		$this->db->join('school_details AS SD','SM.school_code = SD.school_code');
		$this->db->join('participant_item_details AS PD','PD.school_code = SD.school_code');
		$socialscience_query	=	$this->db->get();
		$socialscience_result	=	$socialscience_query->result_array();
		$socialscience_entered	=	$socialscience_result[0]['count'];
		
		$this->db->select('count(DISTINCT PD.school_code) as count ');
		$this->db->where('SM.rev_district_code',$dist);
		$this->db->where('PD.fairId',4);
		$this->db->from('school_master SM');
		$this->db->join('school_details AS SD','SM.school_code = SD.school_code');
		$this->db->join('participant_item_details AS PD','PD.school_code = SD.school_code');
		$we_query	=	$this->db->get();
		$we_result	=	$we_query->result_array();
		$we_entered	=	$we_result[0]['count'];
		
		$this->db->select('count(DISTINCT PD.school_code) as count ');
		$this->db->where('SM.rev_district_code',$dist);
		$this->db->where('PD.fairId',5);
		$this->db->from('school_master SM');
		$this->db->join('school_details AS SD','SM.school_code = SD.school_code');
		$this->db->join('participant_item_details AS PD','PD.school_code = SD.school_code');
		$it_query	=	$this->db->get();
		$it_result	=	$it_query->result_array();
		$it_entered	=	$it_result[0]['count'];
		
		$this->db->where('SM.rev_district_code',$dist);
		$this->db->where('SD.fairScience','Y');
		$this->db->join('school_details AS SD','SM.school_code = SD.school_code');
		$science_confirm	=	$this->db->count_all_results('school_master SM');
		
		$this->db->where('SM.rev_district_code',$dist);
		$this->db->where('SD.fairMathematics','Y');
		$this->db->join('school_details AS SD','SM.school_code = SD.school_code');
		$maths_confirm	=	$this->db->count_all_results('school_master SM');
		
		$this->db->where('SM.rev_district_code',$dist);
		$this->db->where('SD.fairSocialScience','Y');
		$this->db->join('school_details AS SD','SM.school_code = SD.school_code');
		$socialscience_confirm	=	$this->db->count_all_results('school_master SM');
		
		$this->db->where('SM.rev_district_code',$dist);
		$this->db->where('SD.fairWorkExp','Y');
		$this->db->join('school_details AS SD','SM.school_code = SD.school_code');
		$we_confirm	=	$this->db->count_all_results('school_master SM');
		
		$this->db->where('SM.rev_district_code',$dist);
		$this->db->where('SD.fairITmela','Y');
		$this->db->join('school_details AS SD','SM.school_code = SD.school_code');
		$it_confirm	=	$this->db->count_all_results('school_master SM');
	
		$result['total_school']				=	$total_school;
		
		$result['science_entered']			=	$science_entered;
		$result['maths_entered']			=	$maths_entered;
		$result['socialscience_entered']	=	$socialscience_entered;
		$result['we_entered']				=	$we_entered;
		$result['it_entered']				=	$it_entered;
		
		$result['science_confirm']			=	$science_confirm;
		$result['maths_confirm']			=	$maths_confirm;
		$result['socialscience_confirm']	=	$socialscience_confirm;
		$result['we_confirm']				=	$we_confirm;
		$result['it_confirm']				=	$it_confirm;
		
		return $result;
	}		
	
	
	function get_sub_school_details($subdist=''){
	
		$this->db->select('count(DISTINCT SM.school_code) as count ');
		$this->db->where('SM.sub_district_code',$subdist);
		$total_school	=	$this->db->count_all_results('school_master AS SM');
		
		/*$this->db->where('sub_district_code',$subdist);
		$cluster_school	=	$this->db->count_all_results('user_cluster');*/
		$this->db->select('count(DISTINCT PD.school_code) as count ');
		$this->db->where('SM.sub_district_code',$subdist);
		$this->db->where('PD.fairId',1);
		$this->db->from('school_master SM');
		$this->db->join('school_details AS SD','SM.school_code = SD.school_code');
		$this->db->join('participant_item_details AS PD','PD.school_code = SD.school_code');
		$science_query	=	$this->db->get();
		$science_result	=	$science_query->result_array();
		$science_entered	=	$science_result[0]['count'];
		
		$this->db->select('count(DISTINCT PD.school_code) as count ');
		$this->db->where('SM.sub_district_code',$subdist);
		$this->db->where('PD.fairId',2);
		$this->db->from('school_master SM');
		$this->db->join('school_details AS SD','SM.school_code = SD.school_code');
		$this->db->join('participant_item_details AS PD','PD.school_code = SD.school_code');
		$maths_query	=	$this->db->get();
		$maths_result	=	$maths_query->result_array();
		$maths_entered	=	$maths_result[0]['count'];
		
		$this->db->select('count(DISTINCT PD.school_code) as count ');
		$this->db->where('SM.sub_district_code',$subdist);
		$this->db->where('PD.fairId',3);
		$this->db->from('school_master SM');
		$this->db->join('school_details AS SD','SM.school_code = SD.school_code');
		$this->db->join('participant_item_details AS PD','PD.school_code = SD.school_code');
		$socialscience_query	=	$this->db->get();
		$socialscience_result	=	$socialscience_query->result_array();
		$socialscience_entered	=	$socialscience_result[0]['count'];
		
		$this->db->select('count(DISTINCT PD.school_code) as count ');
		$this->db->where('SM.sub_district_code',$subdist);
		$this->db->where('PD.fairId',4);
		$this->db->from('school_master SM');
		$this->db->join('school_details AS SD','SM.school_code = SD.school_code');
		$this->db->join('participant_item_details AS PD','PD.school_code = SD.school_code');
		$we_query	=	$this->db->get();
		$we_result	=	$we_query->result_array();
		$we_entered	=	$we_result[0]['count'];
		
		$this->db->select('count(DISTINCT PD.school_code) as count ');
		$this->db->where('SM.sub_district_code',$subdist);
		$this->db->where('PD.fairId',5);
		$this->db->from('school_master SM');
		$this->db->join('school_details AS SD','SM.school_code = SD.school_code');
		$this->db->join('participant_item_details AS PD','PD.school_code = SD.school_code');
		$it_query	=	$this->db->get();
		$it_result	=	$it_query->result_array();
		$it_entered	=	$it_result[0]['count'];
			
		
		
		$this->db->where('SM.sub_district_code',$subdist);
		$this->db->where('SD.fairScience','Y');
		$this->db->join('school_details AS SD','SM.school_code = SD.school_code');
		$science_confirm	=	$this->db->count_all_results('school_master SM');
		
		$this->db->where('SM.sub_district_code',$subdist);
		$this->db->where('SD.fairMathematics','Y');
		$this->db->join('school_details AS SD','SM.school_code = SD.school_code');
		$maths_confirm	=	$this->db->count_all_results('school_master SM');
		
		$this->db->where('SM.sub_district_code',$subdist);
		$this->db->where('SD.fairSocialScience','Y');
		$this->db->join('school_details AS SD','SM.school_code = SD.school_code');
		$socialscience_confirm	=	$this->db->count_all_results('school_master SM');
		
		$this->db->where('SM.sub_district_code',$subdist);
		$this->db->where('SD.fairWorkExp','Y');
		$this->db->join('school_details AS SD','SM.school_code = SD.school_code');
		$we_confirm	=	$this->db->count_all_results('school_master SM');
		
		$this->db->where('SM.sub_district_code',$subdist);
		$this->db->where('SD.fairITmela','Y');
		$this->db->join('school_details AS SD','SM.school_code = SD.school_code');
		$it_confirm	=	$this->db->count_all_results('school_master SM');
	
		$result['total_school']				=	$total_school;
		
		$result['science_entered']			=	$science_entered;
		$result['maths_entered']			=	$maths_entered;
		$result['socialscience_entered']	=	$socialscience_entered;
		$result['we_entered']				=	$we_entered;
		$result['it_entered']				=	$it_entered;
		
		$result['science_confirm']			=	$science_confirm;
		$result['maths_confirm']			=	$maths_confirm;
		$result['socialscience_confirm']	=	$socialscience_confirm;
		$result['we_confirm']				=	$we_confirm;
		$result['it_confirm']				=	$it_confirm;
		
		return $result;
		
	}
	
	function get_sub_admin_details($sub_district_code)
	{
		$this->db->where('sub_district_code',$sub_district_code);
		$this->db->where('user_group','A');
		$user_master	=	$this->db->get('user_master');
		return $user_master->result_array();
	}
	
	function get_cluster_details ($userid) {
	
	/*
	
		//$user_id		=	$this->session->userdata('USERID');
		//$subdist		=	$this->input->post('sel_sub_district_id');
		if (empty($subdist)) $subdist	= $this->session->userdata('SUB_DISTRICT') ;
		
		$this->db->select('UM.user_id, UM.user_name,
		COUNT(UC.school_code) AS total, COUNT(SD.school_code) AS data_entered, COUNT(SF.is_finalize) AS finialized');
		$this->db->from('user_cluster AS UC');
		$this->db->join('user_master AS UM','UM.user_id = UC.user_id');
		$this->db->join('school_details AS SD','SD.school_code = UC.school_code','LEFT');
		$this->db->join('school_details AS SF',"SF.school_code = UC.school_code AND SF.is_finalize = 'Y'",'LEFT');
		//$this->db->where('UM.user_id',$user_id);
		$this->db->where('UM.sub_district_code',$subdist);
		$this->db->order_by('SD.is_finalize, data_entered');
		$this->db->group_by('UM.user_id');
		$school_details		=	$this->db->get();
		return $school_details->result_array();
	
	*/
		
		if (empty($subdist)) $subdist	= $this->session->userdata('SUB_DISTRICT') ;
		
		$this->db->where('UC.user_id',$userid);
		$total_school	=	$this->db->count_all_results('user_cluster AS UC');
		$username		= $this->session->userdata('USERNAME') ;
		/*$this->db->select('*');
		$this->db->where('user_name',$username);
		$this->db->from('user_master');
		$details_query		=	$this->db->get();
		$details			=	$details_query->result_array();*/
		//$science_entered	=	$science_result[0]['count'];
			
		$this->db->select('count(DISTINCT PD.school_code) as count ');
		$this->db->where('UC.user_id',$userid);
		$this->db->where('PD.fairId',1);
		$this->db->from('user_cluster AS UC');
		$this->db->join('school_details AS SD','UC.school_code = SD.school_code');
		$this->db->join('participant_item_details AS PD','PD.school_code = SD.school_code');
		$science_query	=	$this->db->get();
		$science_result	=	$science_query->result_array();
		$science_entered	=	$science_result[0]['count'];
		
		$this->db->select('count(DISTINCT PD.school_code) as count ');
		$this->db->where('UC.user_id',$userid);
		$this->db->where('PD.fairId',2);
		$this->db->from('user_cluster AS UC');
		$this->db->join('school_details AS SD','UC.school_code = SD.school_code');
		$this->db->join('participant_item_details AS PD','PD.school_code = SD.school_code');
		$maths_query	=	$this->db->get();
		$maths_result	=	$maths_query->result_array();
		$maths_entered	=	$maths_result[0]['count'];
		
		$this->db->select('count(DISTINCT PD.school_code) as count ');
		$this->db->where('UC.user_id',$userid);
		$this->db->where('PD.fairId',3);
		$this->db->from('user_cluster AS UC');
		$this->db->join('school_details AS SD','UC.school_code = SD.school_code');
		$this->db->join('participant_item_details AS PD','PD.school_code = SD.school_code');
		$socialscience_query	=	$this->db->get();
		$socialscience_result	=	$socialscience_query->result_array();
		$socialscience_entered	=	$socialscience_result[0]['count'];
		
		$this->db->select('count(DISTINCT PD.school_code) as count');
		$this->db->where('UC.user_id',$userid);
		$this->db->where('PD.fairId',4);
		$this->db->from('user_cluster AS UC');
		$this->db->join('school_details AS SD','UC.school_code = SD.school_code');
		$this->db->join('participant_item_details AS PD','PD.school_code = SD.school_code');
		$we_query	=	$this->db->get();
		$we_result	=	$we_query->result_array();
		$we_entered	=	$we_result[0]['count'];
		
		$this->db->select('count(DISTINCT PD.school_code) as count ');
		$this->db->where('UC.user_id',$userid);
		$this->db->where('PD.fairId',5);
		$this->db->from('user_cluster AS UC');
		$this->db->join('school_details AS SD','UC.school_code = SD.school_code');
		$this->db->join('participant_item_details AS PD','PD.school_code = SD.school_code');
		$it_query	=	$this->db->get();
		$it_result	=	$it_query->result_array();
		$it_entered	=	$it_result[0]['count'];
		
		$this->db->select('DISTINCT UC.school_code');
		$this->db->where('UC.user_id',$userid);
		$this->db->where('SD.fairScience','Y');
		$this->db->join('school_details AS SD','UC.school_code = SD.school_code');
		$science_confirm	=	$this->db->count_all_results('user_cluster UC');
		
		$this->db->select('DISTINCT UC.school_code');
		$this->db->where('UC.user_id',$userid);
		$this->db->where('SD.fairMathematics','Y');
		$this->db->join('school_details AS SD','UC.school_code = SD.school_code');
		$maths_confirm	=	$this->db->count_all_results('user_cluster UC');
		
		$this->db->select('DISTINCT UC.school_code');
		$this->db->where('UC.user_id',$userid);
		$this->db->where('SD.fairSocialScience','Y');
		$this->db->join('school_details AS SD','UC.school_code = SD.school_code');
		$socialscience_confirm	=	$this->db->count_all_results('user_cluster UC');
		
		$this->db->select('DISTINCT UC.school_code');
		$this->db->where('UC.user_id',$userid);
		$this->db->where('SD.fairWorkExp','Y');
		$this->db->join('school_details AS SD','UC.school_code = SD.school_code');
		$we_confirm	=	$this->db->count_all_results('user_cluster UC');
		
		$this->db->select('DISTINCT UC.school_code');
		$this->db->where('UC.user_id',$userid);
		$this->db->where('SD.fairITmela','Y');
		$this->db->join('school_details AS SD','UC.school_code = SD.school_code');
		$it_confirm	=	$this->db->count_all_results('user_cluster UC');
	
		$result['total_school']				=	$total_school;
		
		$result['science_entered']			=	$science_entered;
		$result['maths_entered']			=	$maths_entered;
		$result['socialscience_entered']	=	$socialscience_entered;
		$result['we_entered']				=	$we_entered;
		$result['it_entered']				=	$it_entered;
		
		$result['science_confirm']			=	$science_confirm;
		$result['maths_confirm']			=	$maths_confirm;
		$result['socialscience_confirm']	=	$socialscience_confirm;
		$result['we_confirm']				=	$we_confirm;
		$result['it_confirm']				=	$it_confirm;
		//$result['details']					=	$details;
		return $result;
		
	}
	
	
	function get_unclustersch_count($subdist)
	{	
		$user_id		=	$this->session->userdata('USERID');
		if (empty($subdist)) $subdist	= $this->session->userdata('SUB_DISTRICT') ;
		//echo "--->".$subdist;	
		$this->db->select('count( m.school_code ) AS mcode');
		$this->db->from('school_master m');
		$this->db->where("m.sub_district_code",$subdist);
		$this->db->where("m.school_code NOT IN (SELECT c.school_code FROM user_cluster c JOIN school_master t ON c.school_code = t.school_code AND t.sub_district_code ='$subdist')");
		$school_details		=	$this->db->get();
		return $school_details->result_array();
	}
	
	function get_unclustersch_finentry($subdist)
	{
		$this->db->select(' count(w.master_confirm) AS school_data_confirmed,count( m.data_entered_flag ) AS ent,count( m2.is_finalize ) AS fin ');
		$this->db->from('school_details m');
		$this->db->join('school_master AS w',"w.school_code = m.school_code AND w.master_confirm = 'Y' AND w.sub_district_code ='$subdist'");
		$this->db->join('school_details AS m2',"m.school_code = m2.school_code AND m2.is_finalize = 'Y'",'LEFT');
		$this->db->where("m.school_code NOT IN (SELECT c.school_code FROM user_cluster c JOIN school_master t ON c.school_code = t.school_code AND t.sub_district_code ='$subdist')");
		$this->db->where('m.data_entered_flag','Y');
		$ret=$this->db->get();
		return $ret->result_array();
		

	}
	////////////////////////////////////////////////////////
   //load district		
	function loadajax_district(){
		$this->db->select('*');
		$this->db->from('rev_district_master');
		$query	= $this->db->get();
		return  $query->result_array();
	}	
	
	function get_usersDetails(){
			$query	=	$this->db->query("select * from user_master");
			if(is_object($query)){
			if($query->num_rows()>0){
			return $query->result_array();
			}
			else{
			return 'null';
			}
			}
	}//function	
			
	
	function getSchoolDetails($school_code)
	{
		$this->db->where('school_code', $school_code);
		$query	= $this->db->get('school_details');
		$result	= $query->result_array();
		return $result;
	} 
	
	function save_createdUser(){
			$district		=	$_POST['district'];			
			$txtusername	=	$_POST['txtusername'];	
			$txtpassword	=	$_POST['txtpassword'];
			$md5password	=	get_encr_password($txtpassword);	
			
			if($_POST['usertype']=='state_admin'){  
			$usertype	=	'1';
			$query	=	$this->db->query("select * from user_master where user_name='$txtusername'");
			if(is_object($query)){
			if($query->num_rows()==0){
			$query	=	"insert into user_master(user_name,password,generated_password,user_type) values('$txtusername','$md5password','$txtpassword','$usertype')";
			mysql_query($query);
			}
			}
			}
			
			if($_POST['usertype']=='district'){  
			$usertype	=	'2';
			
			$query	=	$this->db->query("select * from user_master where user_name='$txtusername'");
			if(is_object($query)){
			if($query->num_rows()==0){
			$query	=	"insert into user_master(user_name,password,generated_password,user_type,rev_district_code) values('$txtusername','$md5password','$txtpassword','$usertype','$district')";
			mysql_query($query);
			}
			}
			}		
			if($_POST['usertype']=='aeo'){
			$usertype	=	'4';
			$sub_district		=	$_POST['sub_district'];	
			
			$query	=	$this->db->query("select * from user_master where user_name='$txtusername'");
			if(is_object($query)){
			if($query->num_rows()==0){
			$query	=	"insert into user_master(user_name,password,generated_password,user_type,rev_district_code,sub_district_code) values('$txtusername','$md5password','$txtpassword','$usertype','$district','$sub_district')";
			mysql_query($query);
			}
			}
			}	
			
						
			}//function
			

			
	function schooldetails($userId='')
	{		
		$user_id		=	$userId ? $userId : $this->session->userdata('USERID');
		$subdist		=	$this->session->userdata('SUB_DISTRICT');
		$usrtype        =   $this->session->userdata('USER_TYPE');
		//echo "<br />-->".$user_id;
		if (3 > $usrtype)
		{
			//echo "<br />-->".$user_id;
			//$user_id		=	$this->input->post('hidClusterId');
			$this->db->select('sub_district_code');
			$this->db->where ('user_id', $user_id);
			$this->db->group_by('user_id');
			$result		= $this->db->get('user_cluster');
			$result		= $result->result_array();
			//var_dump($result);
			$subdist	= $result[0]['sub_district_code'];
		}
		
		$this->db->select('sd.school_code, sd.sub_district_code, sm.school_name,dt.is_finalize,sm.master_confirm');
		$this->db->from('user_cluster AS sd');
		$this->db->join('school_master AS sm','sm.school_code = sd.school_code');
		$this->db->join('sub_district_master AS su','su.sub_district_code=sm.sub_district_code');
		$this->db->join('school_details AS dt','dt.school_code=sd.school_code','LEFT');
		
		$this->db->where('sd.user_id',$user_id);
		$this->db->where('sd.sub_district_code',$subdist);
		$this->db->order_by('sd.school_code');
		$school_details		=	$this->db->get();
		return $school_details->result_array();
	}
	function clusterdetails($userId='')
	{
		
		$user_id		=	$userId ? $userId : $this->session->userdata('USERID');
		$usrtype        =   $this->session->userdata('USER_TYPE');
		
		//echo "<br />-------->".$this->input->post('hidClusterId');
		$this->db->select('user_name, name, mobile, email');
		$this->db->where('user_id', $user_id);
		$user_details		=	$this->db->get('user_master');
		return $user_details->result_array();
	}
	
	
	function schoolpartcip()
	{
		/*$this->db->select('sd.school_code');
		$this->db->from('school_details AS sd');
		$this->db->where('school_address1','""');
		$this->db->order_by('sd.school_code');*/
		$school_details		=	$this->db->query('SELECT `sd`.`school_code` FROM (`school_details` AS sd) WHERE 	data_entered_flag != "Y" ORDER BY `sd`.`school_code`');
		return $school_details->result_array();
	}
		
	function confirm_sub_dist_schools($checks)
	{	
		
		$sub_district_code		=	$this->session->userdata('SUB_DISTRICT');	
		$this->db->select('count(DISTINCT PD.school_code) as count ');
		$this->db->where('SM.sub_district_code',$sub_district_code);
		$this->db->where('PD.fairId',$checks);	
		$this->db->from('school_master SM');
		$this->db->join('school_details AS SD','SM.school_code = SD.school_code');
		$this->db->join('participant_item_details AS PD','PD.school_code = SD.school_code');
		$entered_query	=	$this->db->get();
		$entered_result	=	$entered_query->result_array();
		$cnt_entered	=	$entered_result[0]['count'];		
		
			
		$this->db->select('count(SD.school_code) as count ');
		$this->db->where('SM.sub_district_code',$sub_district_code);
		if($checks==1)
					$this->db->where('SD.fairScience','Y');		
		else if($checks==2)
					$this->db->where('SD.fairMathematics','Y');
		else if($checks==3)
					$this->db->where('SD.fairSocialScience','Y');
		else if($checks==4)
					$this->db->where('SD.fairWorkExp','Y');	
		else if($checks==5)
					$this->db->where('SD.fairITmela','Y');	
		
		$this->db->from('school_details SD');
		$this->db->join('school_master AS SM','SM.school_code = SD.school_code');
		$confirmed_query	=	$this->db->get();
		$confirmed_result	=	$confirmed_query->result_array();
		$cnt_confirmed		=	$confirmed_result[0]['count'];		
		
	
		
		/*echo "<br><br><br>cnt_finalize_school is :";
		echo $cnt_finalize_school;*/
		
		if ($cnt_entered > $cnt_confirmed)
		{
				if($checks==1){
				$event	=	"Science Fair";
				}
				if($checks==2){ 
				$event	=	"Mathematics Fair";
				}
				if($checks==3){ 
				$event	=	"Social Science Fair";
				}
				if($checks==4){ 
				$event	=	"Work expo Fair";
				}
				if($checks==5){ 
				$event	=	"IT Fair";
				}
				
			$nt_confirm_school	=	$cnt_entered - $cnt_confirmed;
			$error_array		=	array();
			$error_array		=	$nt_confirm_school.' schools are yet to confirm the data entry list in '.$event;
			//$return_array['error_array']	=	$error_array;
			return $error_array;
		}
		else
		{
			$data								=	array();
			
			if($checks==1)
			{	
				$sub_district_master_field		=	'science_confirm_data_entry';
			} if($checks==2){
				$sub_district_master_field		=	'maths_confirm_data_entry ';
			} if($checks==3){
				$sub_district_master_field		=	'social_confirm_data_entry';
			}if($checks==4){
				$sub_district_master_field		=	'worexpo_confirm_data_entry';
			}if($checks==5){
				$sub_district_master_field		=	'it_confirm_data_entry';
			}		
			
			$data[$sub_district_master_field]	=	'Y';
			$this->db->where('sub_district_code',$sub_district_code);
			$this->db->update('sub_district_master',$data);		
		}
	}
	
	//load district		
	/*function loadajax_district(){
		$this->db->select('*');
		$this->db->from('rev_district_master');
		$query	= $this->db->get();
		return  $query->result_array();
	}		*/
	
	//load subdistrict
	function loadajax_subdistrict($district){
		$this->db->select('*');
		$this->db->where('rev_district_code', $district);
		$this->db->from('sub_district_master');
		$query	= $this->db->get();
		$result	= $query->result_array();
		echo "<select name='sub_district' id='sub_district'  class='inputbox' style='width:321px;' onclick='return suubofsub_usercreation();'>";
		echo "<option value=''>Select Subdistrict</option>";
		foreach($result as $row){
		$sub_district_code	=	$row['sub_district_code'];
		$sub_district_name	=	$row['sub_district_name'];
		
		echo "<option value=".$sub_district_code.">".$sub_district_name."</option>";
		}
		echo "</select>";
	}
	
	//load school		
	function loadajax_school($district){
		$this->db->select('*');
		$this->db->where('rev_district_code', $district);
		$this->db->where('school_type', 'A');
		$this->db->from('school_master');
		$query	= $this->db->get();
		$result	= $query->result_array();
		echo "<select name='school' id='school'  class='inputbox' style='width:321px;' onclick='return suubofsub_usercreation();'>";
		echo "<option value=''>Select School</option>";
		foreach($result as $row){
		$school_code	=	$row['school_code'];
		$school_name	=	$row['school_name'];
		
		echo "<option value=".$school_code.">".$school_code.' - '.$school_name."</option>";
		}
		echo "</select>";
	}		

	
	function loadajax_edudistrict($district){
		$this->db->select('*');
		$this->db->where('rev_district_code', $district);
		$this->db->from('edu_district_master');
		$query	= $this->db->get();
		$result	= $query->result_array();
		echo "<select name='edu_district' id='edu_district'  class='inputbox' style='width:321px;' onclick='return suubofsub_usercreation();'>";
		echo "<option value=''>Select Education District</option>";
		foreach($result as $row){
		$edu_district_code	=	$row['edu_district_code'];
		$edu_district_name	=	$row['edu_district_name'];
		
		echo "<option value=".$edu_district_code.">".$edu_district_name."</option>";
		}
		echo "</select>";
	}
			
	
}//class

?>