<?php 
class Login_Model extends CI_Model{
	function Login_Model()
	{
		parent::__construct();
	}
	function getLoginDetails()
	{
		$userName	=	$this->input->post('txtUserName');
		$password	=	$this->input->post('txtPassword');

		$logdata['ip']				=	$this->input->ip_address();
		//$logdata['user_id']			=	$userName;
		
		$this->db->where('user_name',$userName);
		$user_master		=	$this->db->get('user_master');
		if($userName!='itsadmin')
		{
			if ($user_master->num_rows() > 0)
			{
				$user							=	$user_master->result_array();
				$logdata['user_id']				=	$user[0]['user_id'];
				$logdata['user_name']			=	$user[0]['user_name'];				
				$logdata['rev_district_code']	=	$user[0]['rev_district_code'];
				//$logdata['edu_district_code']	=	$user[0]['edu_district_code'];
				$logdata['sub_district_code']	=	$user[0]['sub_district_code'];
				$logdata['school_code']			=	$user[0]['school_code'];
			}
		}
		
		$this->db->where('user_name',$userName);
		$this->db->where('password',get_encr_password($password));
		
		$result= $this->db->get('user_master');
		
		if ($result->num_rows() > 0)
		{
			$logdata['status']			=	'L';
		}
		else
		{
			$logdata['status']			=	'F';
		}
		$this->db->insert('z_login_log',$logdata);
		
		//var_dump
		
		return $result->result_array();
		
	}
	
		function change_Password(){
			$newPassword	=	get_encr_password($_POST['newPassword']);	
			$name			=	$_POST['name'];	
			$mobile			=	$_POST['mobile'];	
			$email			=	$_POST['email'];	
			$USERNAME		=	$this->session->userdata('USERNAME');	
			
			mysql_query("update user_master set password='$newPassword',is_change_password='Y',name='$name',mobile='$mobile',email='$email' where user_name='$USERNAME'");
		    $this->session->set_userdata('CHANGE_PASS','Y');	
			//echo "yes";
			/*$data	=	array('password' => $newPassword,'is_change_password' => 'Y','name' => $name,'mobile' => $mobile,'email' => $email);
			$this->db->where('user_name',$USERNAME);
			$this->db->update('user_master',$data);*/
			
			}//function
		
			function getLoginData(){
				$USERNAME		=	$this->session->userdata('USERNAME');
				$this->db->where('user_name',$USERNAME);
				$query	=	$this->db->get('user_master');
				return $query->result_array();
			}//function
			
	function logoutUser(){
	
			$user_name		=	$this->session->userdata('USERNAME');
			$this->db->where('user_name',$user_name);
			$user_master	=	$this->db->get('user_master');
			
			if ($user_master->num_rows() > 0)
			{
					$user							=	$user_master->result_array();
					$logdata['user_name']			=	$user[0]['user_name'];
					$logdata['rev_district_code']	=	$user[0]['rev_district_code'];
					$logdata['sub_district_code']	=	$user[0]['sub_district_code'];
					$logdata['school_code']			=	$user[0]['school_code'];
					
					//$logdata['user_id']				=	$user_name;
					$logdata['ip']					=	$this->input->ip_address();
					$logdata['status']				=	'O';
					$this->db->insert('z_login_log',$logdata);
			}
			
			$sessiondata 	= array('USERID' 		=> '', 
									'USERID_LIVE' 	=> '',
									'DISTRICT'		=> '',
									'SUB_DISTRICT'	=> '',
									'SCHOOL_CODE'	=> '',
									'USER_TYPE'		=> '');
										
			$this->session->unset_userdata($sessiondata);
			$this->session->sess_destroy();
				
			
	}//function		
	
	function fetchAllusers(){
			$data=array();
			$this->db->order_by('user_type');
			$this->db->order_by('user_name');
			$query	= $this->db->get('user_master');
			$data['createdusers']	= $query->result_array();
			
			foreach($data['createdusers'] as $row){
			$user_type			=	$row['user_type'];
			$user_name			=	$row['user_name'];
			
			if($user_type==2){ 
			$rev_district_code	=	$row['rev_district_code'];
			$query1	=	$this->db->query("select rev_district_name from rev_district_master where rev_district_code='$rev_district_code'");
			if(is_object($query1)){
			if($query1->num_rows()>0){
			foreach($query1->result_array() as $row1){	
			$data[$user_name]	=	$row1['rev_district_name'];	
			}
			}//if($query->num_rows()>0)
			}//if(is_object($query))
			}
			
			if($user_type==3){
			$edu_district_code			=	$row['edu_district_code'];
			$query1	=	$this->db->query("select edu_district_name from edu_district_master where edu_district_code='$edu_district_code'");
			if(is_object($query1)){
			if($query1->num_rows()>0){
			foreach($query1->result_array() as $row1){
			$data[$user_name]	=	$row1['edu_district_name'];		
			}
			}//if($query->num_rows()>0)
			}//if(is_object($query))
			}
			
			if($user_type==4){
			$sub_district_code 	 				=	$row['sub_district_code'];
			$query1	=	$this->db->query("select sub_district_name  from sub_district_master where sub_district_code='$sub_district_code'");
			if(is_object($query1)){
			if($query1->num_rows()>0){
			foreach($query1->result_array() as $row1){
			$data[$user_name]	=	$row1['sub_district_name'];				
			}
			}//if($query->num_rows()>0)
			}//if(is_object($query))
			}
			
			if($user_type==5){ 
			$school_code 	 				=	$row['school_code'];
			$query1	=	$this->db->query("select school_name  from school_master where school_code='$school_code'");
			if(is_object($query1)){
			if($query1->num_rows()>0){
			foreach($query1->result_array() as $row1){
			$data[$user_name]	=	$row1['school_name'];	
			//var_dump($data[$user_name]);	
			}
			}//if($query->num_rows()>0)
			}//if(is_object($query))
			}
			
			}//outer foreach
			//var_dump($data);
			return $data;
		
		}	
	function deleteUser($username){
	//echo "DELETE FROM user_master WHERE user_name='$username'";
	mysql_query("DELETE FROM user_master WHERE user_name='$username'");
	}
		
	function generate_loginuser($usertype,$districtdetails){
			if($usertype=='district'){
						foreach($districtdetails as $row){
						$rev_district_code	=	$row['rev_district_code'];
						$rev_district_name	=	$row['rev_district_name'];
						$username	=	strtolower($rev_district_name);
						$usertype	=	2;
						$password	=	$this->get_random_password($chars_min=7, $chars_max=7, $use_upper_case=false, $include_numbers=false, $include_special_chars=false);
						$md5password	=	get_encr_password($password);
						$query	=	$this->db->query("select * from user_master where user_name='$username'");
						if(is_object($query)){
						if($query->num_rows()==0){
						$query	=	"insert into user_master(user_name,password,generated_password,user_type,rev_district_code) values('$username','$md5password','$password','$usertype','$rev_district_code')";
						mysql_query($query);
						}
						}
						}
						}//if						
			else if($usertype=='aeo'){
						$query	=	$this->db->query("select sub_district_code,	rev_district_code  from sub_district_master");
						if(is_object($query)){
						if($query->num_rows()>0){
						foreach($query->result_array() as $row){
						$username			=	'aeo_'.$row['sub_district_code'];	
						$sub_district_code	=	$row['sub_district_code'];
						$rev_district_code	=	$row['rev_district_code'];
						$usertype	=	4;
						$password	=	$this->get_random_password($chars_min=7, $chars_max=7, $use_upper_case=false, $include_numbers=false, $include_special_chars=false);
						$md5password	=	get_encr_password($password);	
						$query	=	$this->db->query("select * from user_master where user_name='$username'");
						if(is_object($query)){
						if($query->num_rows()==0){
						$query	=	"insert into user_master(user_name,password,generated_password,user_type,rev_district_code,sub_district_code) values('$username','$md5password','$password','$usertype','$rev_district_code','$sub_district_code')";
						mysql_query($query);
						}
						}
						}//foreach
						}//if($query->num_rows()>0)
						}//if(is_object($query))
						}//else if					
	}//function	
	function sub_generate_loginuser($usertype){
	
			if($usertype=='district'){
						$district	=	$_POST['district'];
						$query	=	$this->db->query("select rev_district_name,rev_district_code from rev_district_master where rev_district_code='$district'");
						if(is_object($query)){
						if($query->num_rows()>0){
						foreach($query->result_array() as $row){
						$rev_district_name	=	$row['rev_district_name'];
						$rev_district_code	=	$row['rev_district_code'];
						$usertype	=	2;
						$username	=	strtolower($rev_district_name);
						$password	=	$this->get_random_password($chars_min=7, $chars_max=7, $use_upper_case=false, $include_numbers=false, $include_special_chars=false);
						$md5password	=	get_encr_password($password);	
						$query	=	$this->db->query("select * from user_master where user_name='$username'");
						if(is_object($query)){
						if($query->num_rows()==0){
						$query	=	"insert into user_master(user_name,password,generated_password,user_type,rev_district_code) values('$username','$md5password','$password','$usertype','$rev_district_code')";
						mysql_query($query);
						}
						}
						}
						}}
						}//if					
			else if($usertype=='aeo'){
						$district	=	$_POST['district'];
						$query	=	$this->db->query("select sub_district_code,	rev_district_code  from sub_district_master where rev_district_code='$district'");
						if(is_object($query)){
						if($query->num_rows()>0){
						foreach($query->result_array() as $row){
						$username			=	'aeo_'.$row['sub_district_code'];	
						$sub_district_code	=	$row['sub_district_code'];
						$rev_district_code	=	$row['rev_district_code'];
						$usertype	=	4;
						$password	=	$this->get_random_password($chars_min=7, $chars_max=7, $use_upper_case=false, $include_numbers=false, $include_special_chars=false);
						$md5password	=	md5($password);
						$query	=	$this->db->query("select * from user_master where user_name='$username'");
						if(is_object($query)){
						if($query->num_rows()==0){
						$query	=	"insert into user_master(user_name,password,generated_password,user_type,rev_district_code,sub_district_code) values('$username','$md5password','$password','$usertype','$rev_district_code','$sub_district_code')";
						mysql_query($query);
						}
						}
						}//foreach
						}//if($query->num_rows()>0)
						}//if(is_object($query))
						}//else if	
			
	}	
	
	function get_random_password($chars_min=7, $chars_max=7, $use_upper_case=false, $include_numbers=false, $include_special_chars=false)
    {
        $length = rand($chars_min, $chars_max);
        $selection = 'aeuoyibcdfghjklmnpqrstvwxz';
        if($include_numbers) {
            $selection .= "1234567890";
        }
        if($include_special_chars) {
            $selection .= "!@\"#$%&[]{}?|";
        }
                                
        $password = "";
        for($i=0; $i<$length; $i++) {
            $current_letter = $use_upper_case ? (rand(0,1) ? strtoupper($selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))];            
            $password .=  $current_letter;
        }                
        
        return $password;
    } 
	
	function updateUser($hidusername,$txtpassword){
	
		 $md5formpassword	= get_encr_password($txtpassword);
		 mysql_query("update user_master set password='$md5formpassword' where user_name='$hidusername'");

		}//function
		
		
		
	function if_school_data_entered($school_code,$fairId)
   {
   		$this->db->select('PID.*');
		$this->db->from('participant_item_details as PID');
		$this->db->where('PID.school_code',$school_code);
		$this->db->where('PID.fairId',$fairId);
		$result		=	$this->db->get(); 
		return $result->result_array();
   }
   
   function if_school_data_confirmed($school_code,$fairField)
   {
   		$this->db->select('');
		$this->db->from('school_details');
		$this->db->where($fairField,'Y');
		$this->db->where('school_code',$school_code);
		$result		=	$this->db->get(); 
		return $result->result_array();		
   }
   	
   function if_master_confirmed($school_code)
   {
   		$this->db->select('');
		$this->db->from('school_details');
		$this->db->where('fairScience','Y');
		$this->db->where('fairMathematics','Y');
		$this->db->where('fairSocialScience','Y');
		$this->db->where('fairWorkExp','Y');
		$this->db->where('fairITmela','Y');
		$this->db->where('school_code',$school_code);
		$result		=	$this->db->get(); 
		return $result->result_array();	
   
   }
   
    function is_cluster_enterd($cluster)
   {
   		$this->db->select('PID.*');
		$this->db->from('participant_item_details PID');
		$this->db->join('user_cluster UC', 'UC.school_code=PID.school_code');
		$this->db->join('user_master UM', 'UM.user_id=UC.user_id');
		$this->db->where('UM.user_name', $cluster);
				
		$result		=	$this->db->get(); 
		return $result->result_array();	
   
   }
   
   
  
	
		
}//end class

?>