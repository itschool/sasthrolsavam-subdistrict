<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_Cluster extends CI_Controller {

	public function __construct(){
					parent::__construct(); 
					//$this->load->library('javascript');	
					//$this->template->add_js('js/user/user_cluster.js');
					$this->load->model('School_Details_Model');
					$this->load->model('admin/User_Cluster_Model');
					$this->load->model('login/Login_Model');
					$this->load->library('session');	
					$this->template->write_view('menu', 'menu', '');											
					}
	
	public function index()
	{
	//$this->load->view('login');
	}
	function cluster_creation(){
		$this->Content	=	array();
		$this->Content['heading']	=	'Home/Cluster Creation';
		$this->Content['schools']					=	$this->User_Cluster_Model->get_Schools();
		$this->Content['selected_cluster']			=	$this->User_Cluster_Model->select_cluster_user_details();
		$this->Content['selected_cluster_schools']	=	$this->User_Cluster_Model->get_selected_Schools();
		$this->Content['entered_school']			=	$this->User_Cluster_Model->get_entered_school();
		$this->Content['existing_cluster']			=	$this->User_Cluster_Model->existing_cluster_details();
		
		
		$this->template->write_view('content','admin/user_cluster_list',$this->Content);
		$this->template->load();
  }
  function save_user_cluster(){
		if($this->session->userdata('USER_TYPE')!=4){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		if($this->User_Cluster_Model->check_username_exists('', $this->input->post('txtNewUserName')))
		{
			$this->template->write('error', 'User name already exists');
			$this->cluster_creation();
			return ;
		}
		
		$this->User_Cluster_Model->save_cluster_users();
		$this->template->write('sucess', 'User details saved sucessfully');
		$this->cluster_creation();
	}
	function edit_user_cluster(){
		if($this->session->userdata('USER_TYPE')!=4){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->Content['selected_cluster']			=	$this->User_Cluster_Model->select_cluster_user_details();
		$this->Content['selected_cluster_schools']	=	$this->User_Cluster_Model->get_selected_Schools();
		$this->cluster_creation();
	}
	function update_user_cluster(){
		if($this->session->userdata('USER_TYPE')!=4){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->User_Cluster_Model->update_user_cluster_details();
		$this->template->write('sucess', 'User details updated sucessfully');
		$this->cluster_creation();
	}
	function delete_user_cluster(){
		if($this->session->userdata('USER_TYPE')!=4){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->User_Cluster_Model->delete_cluster_user_details();
		$this->template->write('mesage', 'Cluster deleted sucessfully');
		$this->cluster_creation();
	}
}//end Class
?>