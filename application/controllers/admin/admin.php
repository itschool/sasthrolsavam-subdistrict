<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller {

	public function __construct(){
					parent::__construct(); 
					$this->load->library('javascript');	
					$this->template->add_js('js/admin/user_cluster.js');	
					$this->load->model('School_Details_Model');
					
					$this->load->model('General_Model');
				
					$this->load->model('Session_Model');
					
					$this->load->model('login/Login_Model');
					$this->load->library('session');
					//$this->template->write_view('menu', 'menu', '');								
					}
	
	public function index()
	{
	//$this->load->view('login');
	}
	
	function user_creation($msg=''){


			if($this->session->userdata('USER_TYPE')!=1  && $this->session->userdata('USER_TYPE')==''){
				header ( "Location: ". base_url(). 'index.php/welcome' );
				}
			else{
				$allUsers					=	$this->Login_Model->fetchAllusers();
				$data['allUsers']			=	$allUsers;
				$data['districtdetails']	=	$this->School_Details_Model->loadajax_district();
				$data['userdetails']		=	$this->School_Details_Model->get_usersDetails();
				$data['heading']			=	'Admin/User Creation';
				if($msg!=''){
				$data['sucess']	=	 'User Creation Successfull';
				}
				$this->template->write_view('menu', 'menu', '');
				$this->template->write_view('content','admin/user_creation',$data);		 
				$this->template->load();
				}
	}//function
	
		function save_createdUser(){
				if($this->session->userdata('USER_TYPE')!=1  && $this->session->userdata('USER_TYPE')==''){
					header ( "Location: ". base_url(). 'index.php/welcome' );
					}
				else{
						$this->form_validation->set_rules('txtusername', '', 'trim|required');
						$this->form_validation->set_rules('txtpassword', '', 'trim|required');
						if($_POST['usertype']=='district'){
						$this->form_validation->set_rules('district', '', 'trim|required');  
						}						
						if($_POST['usertype']=='aeo'){
						$this->form_validation->set_rules('district', '', 'trim|required');
						$this->form_validation->set_rules('sub_district', '', 'trim|required');    
						}						
						if ($this->form_validation->run() == false)
						{
								$data['error']	=	 validation_errors();
								$this->template->write_view('error','error/error_message',$data);		 
								$this->template->load();
						}
						else
						{	
							$aryUser	=	$this->School_Details_Model->save_createdUser();
							$msg	=	'User Creation Successfull';
							$this->user_creation($msg);
						}
						}//else
		}//function
						
	function deleteUser($username){ 
	$this->Login_Model->deleteUser($username);
	
				$allUsers					=	$this->Login_Model->fetchAllusers();
				$data['allUsers']			=	$allUsers;
				$data['districtdetails']	=	$this->School_Details_Model->loadajax_district();
				$data['userdetails']		=	$this->School_Details_Model->get_usersDetails();
				$data['sucess']					=	'User deletion Succesfully';
				$data['heading']			=	'Admin/User Creation';
				$this->template->write_view('content','admin/user_creation',$data);		 
				$this->template->load();
	}
	function generate_admin($usertype){ 
			if($this->session->userdata('USER_TYPE')!=1  && $this->session->userdata('USER_TYPE')==''){
				header ( "Location: ". base_url(). 'index.php/welcome' );
				}
			else{
				$data['districtdetails']	=	$this->School_Details_Model->loadajax_district();
				$aryUser					=	$this->Login_Model->generate_loginuser($usertype,$data['districtdetails']);
				$msg	=	'User Creation Successfull';
				$this->user_creation($msg);
				}
				}//function	
				
	function sub_generate_admin($usertype){
			if($this->session->userdata('USER_TYPE')!=1  && $this->session->userdata('USER_TYPE')==''){
				header ( "Location: ". base_url(). 'index.php/welcome' );
				}
			else{
				$aryUser					=	$this->Login_Model->sub_generate_loginuser($usertype);
				$msg	=	'User Creation Successfull';
				$this->user_creation($msg);
				}
	}//function	
	function userCreation_districtDeoAeoSchool($msg=''){
				if($this->session->userdata('USER_TYPE')!=2 && $this->session->userdata('USER_TYPE')==''){
					header ( "Location: ". base_url(). 'index.php/welcome' );
					}
				else{
					$data['allUsers']		=	$this->Login_Model->get_createdUsers_itsadmin();
					
					if($this->session->userdata('USER_TYPE')==2){
					$data['heading']			=	'District/View User';
					}
					else if($this->session->userdata('USER_TYPE')==3){
					$data['heading']			=	'DEO/View User';
					}
					else if($this->session->userdata('USER_TYPE')==4){
					$data['heading']			=	'AEO/View User';
					}
					if($msg!=''){
					$data['sucess']				=	'Updation Succesfull';
					}
					$this->template->write_view('content','district/userCreation_district',$data);		 
					$this->template->load();
					}
	 }//function	
					
	function updateUser(){
			$this->Login_Model->updateUser($_POST['hidusername'],$_POST['txtpassword']);
			if($this->session->userdata('USER_TYPE')==1){
			$allUsers						=	$this->Login_Model->fetchAllusers();
			$data['allUsers']			=	$allUsers;
			$data['districtdetails']	=	$this->School_Details_Model->loadajax_district();
			$data['userdetails']		=	$this->School_Details_Model->get_usersDetails();
			$data['sucess']				=	'Updation Succesfull';
			$data['heading']			=	'Admin/User Creation';
			$this->template->write_view('content','admin/user_creation',$data);		 
			$this->template->load();
			}
			if($this->session->userdata('USER_TYPE')!=1 && $this->session->userdata('USER_TYPE')!=5){
					$msg	=	'Updation Succesfull';
					$this->userCreation_districtDeoAeoSchool($msg);
					}
	}//function
	function loadajax_subdistrict($district){
			$aryUser=$this->School_Details_Model->loadajax_subdistrict($district);
			}	
	function loadajax_school($district){
			$aryUser=$this->School_Details_Model->loadajax_school($district);
			}
	function loadajax_edudistrict($district){
			$aryUser=$this->School_Details_Model->loadajax_edudistrict($district);
			}		
}
?>