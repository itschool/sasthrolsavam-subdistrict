<?php
class Session_Model extends CI_Model{
	function Session_Model(){
		parent::__construct();
	}
	/* Set the session values */
	function set_session($session_data){
	
		if(!is_array($session_data)) return false;
		$this->session->set_userdata($session_data);
	}
	/* Check user is logged in*/
	function is_user_logged($redirect = true){
		if( trim($this->session->userdata('USERID')) == ''  ||   trim($this->session->userdata('USERID_LIVE')) == '' ){
			if($redirect == true){
				//$uri = 'http'. (@$_SERVER['HTTPS'] ? 's' : '') .'://'. $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
				//$set_session_data 	= array('REQUEST_URI' => $uri);
				//$this->set_session($set_session_data);
				//echo "YYYYYYYYYYYYYYYYYYYYYYYYYYYYYYY";
				header ( "Location: ". base_url(). 'index.php/login' );
			}
		}else if(trim($this->session->userdata('CHANGEPWD')) != 'Y'){
			header ( "Location: ". base_url(). 'login/change_password/' );
		}else{
			return true; 
		}
		return false;
	}
	
	function check_user_permission($fun_id){
		if($this->session->userdata('USER_GROUP')=='W'){
			return true;
		}else{
			$user_id = (int)$this->session->userdata('USERID');
			$where = "user_id = '".$user_id."' AND (";

			$functionalities	=	explode(',', $fun_id);
			foreach($functionalities AS $value)
				$where	.=	"rf_id = '".$value."' OR ";
			$where	=	substr($where,0,strlen($where)-3).")";	
			$this->db->where($where);	
			$query = $this->db->get('user_rights');
			if($query->num_rows() > 0){
				return true;
			}else{
				return false;
			}
		}
		return false;
	}
	
	function check_user_permissions($fun_id){
		if($this->session->userdata('USER_GROUP')=='W'){
			return true;
		}else{
			$user_id = (int)$this->session->userdata('USERID');
			$where = "user_id = '".$user_id."' AND (";

			$functionalities	=	explode(',', $fun_id);
			foreach($functionalities AS $value)
				$where	.=	"rf_id = '".$value."' OR ";
			$where	=	substr($where,0,strlen($where)-3).")";	
			$this->db->where($where);	
			$query = $this->db->get('user_rightss');
			if($query->num_rows() > 0){
				return true;
			}else{
				return false;
			}
		}
		return false;
	}
	
	
	
}
?>