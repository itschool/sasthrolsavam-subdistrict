<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	
	public function __construct()
    {
		parent::__construct(); 
		$this->load->model('General_Model');
		$this->load->model('Import_Model');
		$this->load->model('Session_Model');
		$this->load->model('school/Registration_Model');
		$this->load->model('login/Login_Model');
		$this->load->model('School_Details_Model');
		$this->load->library('session');
		$this->load->library('javascript');
			
		
		
	}//end function  function __construct
	function index()
	{
		
		$this->load->view('login/login');				
	}
	
	function home()
	{
		//$this->load->view('login/login');	
		
		if($this->session->userdata('USER_TYPE')=='')
		{
			header ( "Location: ". base_url(). 'index.php/welcome' );
		}
		else
		{
		//echo '<br><br><br>'.$this->session->userdata('USER_TYPE');
		    /********** itsadmin **************/
			if($this->session->userdata('USER_TYPE')==1)
			{				
				$this->template->write_view('menu', 'menu', '');
				$this->template->write_view('content','welcome_message');	
				$this->template->load();  
			}						
			
		
			
			/********* Sub-District Admin **************/
			if($this->session->userdata('USER_TYPE')==4)
			{
				$table	=	'participant_item_details';
				
				$table_value	=	$this->Import_Model->is_table_empty($table);
				//echo empty($table_value);
				if(!empty($table_value)) {
					/*if(!is_define_sciencefair($this->session->userdata('SUB_DISTRICT')) && $this->session->userdata('USER_GROUP')=='A')
					{
						$this->Content['admin_action']			= 'EDIT';
						$this->Content['sciencefair_id']			= 1;
						$this->Content['selected_sciencefair']	= $this->General_Model->get_data('sub_dist_sciencefair_master', '*', array('sub_district_code'=>$this->session->userdata('SUB_DISTRICT')));
						$this->Content['sciencefair_details']	= $this->General_Model->get_data('sub_dist_sciencefair_master', '*', array('sub_district_code'=>$this->session->userdata('SUB_DISTRICT')));
					$this->template->write_view('content','admin/sub_dist_sciencefair_view',$this->Content);	
					}
				else
				{*/
					//$this->Registration_Model->update_participant_item_details_structure();
					$this->template->write_view('menu', 'menu', '');
					$this->template->write_view('content','welcome_message');	
				//	}
					$this->template->load();  
				 //redirect('welcome/clustdetails'); 
				 // echo "yes";
				 } else {  
				 	//$this->template->write_view('menu', 'menu', ''); 
				 	$this->template->write_view('content','import/import_csv_data');		 
					$this->template->load();
				 
				    }
		
			}
			
			/********* Cluster User **************/
			if($this->session->userdata('USER_TYPE')==5)
			{
				redirect('welcome/cluster_schools');										
			}		
				
			//$this->template->load();
						
			
		}			
	}
	
	function rep_table()
	{
	
		mysql_query('REPAIR TABLE participant_item_details');
		echo "<br />OK";
	}
	
	
	function checkLogin()
	{	   
		$data['heading'] = 'Home';
		if(isset($_POST['login']))
		{		
			$aryUser=$this->Login_Model->getLoginDetails();
			//echo '<br><br><br><br><br><br><br><br><br>';
		//	print_r($aryUser);
			 //echo "yesss";
			if(count($aryUser) > 0 and is_array($aryUser))
			{		
				//itsadmin
				//if($aryUser[0]['user_type']==1){
				$newdata = array(
							   'USERNAME'		=>  $aryUser[0]['user_name'],
							   'USERID'			=>  $aryUser[0]['user_id'],
							   'USER_GROUP'		=>  $aryUser[0]['user_group'],
							   'USER_TYPE'		=>  $aryUser[0]['user_type'],
							   'CHANGE_PASS'	=>  $aryUser[0]['is_change_password'],
							   'SUB_DISTRICT'	=>  $aryUser[0]['sub_district_code'],
							   'DISTRICT_CODE'	=>  $aryUser[0]['rev_district_code'],
							   'FAIR_TYPE'		=>  $aryUser[0]['fair_right'],
							   'logged_in'		=>  TRUE
								 );
				$this->session->set_userdata($newdata);	
				//echo "<br /><br />--->".$aryUser[0]['is_change_password'];
				
				if($aryUser[0]['is_change_password']=='N')
				{			 
				    $data['logindata']		=	$this->Login_Model->getLoginData();
					$is_saved				=	$data['logindata'][0]['name'];
					if($is_saved)
						$this->template->write_view('content','change_myPassword',$data);
					else
					$this->template->write_view('content','login/change_password');		 
					$this->template->load();
				}
				else
				{		
					redirect('welcome/home');
				}			
		    	
			} //end count($aryUser) > 0 and is_array($aryUser
			else
			{
				$s['error']	=	"Sorry, we can't identify your login details. Did you make a mistake when typing the User name / Password? ";
				$this->load->view('login/login',$s);
			}
	  	}//end isset($_POST['login']
  }//end function checkLogin	
	
	

  
  function cluster_schools($clusterId = '')
  {
  
  		$this->Contents	=	array();
		//$this->template->write('title', '');
		 /* if($this->input->post('hidClusterId') ){
		  	$clusterId	=	$this->input->post('hidClusterId') ;
		  }else {
		  		$clusterId	=	'';
		  }*/
		//$USERID		=	$this->session->userdata('USERID');
		//echo "<br />->".$clusterId;
		$cluster	=	$this->School_Details_Model->clusterdetails($clusterId);
		$school		=	$this->School_Details_Model->schooldetails($clusterId);
		$particip	=	$this->School_Details_Model->schoolpartcip();
		$this->Contents['cluster']	=	$cluster;
		$this->Contents['school']	=	$school;
		/*echo '<br><br><br>';
		print_r($this->Contents['school']);*/
		$this->Contents['part']		=	$particip;
		
		if(count($school)>0)
		{
			$this->template->write_view('menu', 'menu', '');	
			 $this->template->write_view('content','login/clusterschool_details',$this->Contents);	
			 $this->template->load();
		} 
  
  }	
	

	/* function for list the user cluster details*/
	function clustdetails($sub_district=0) {	
			
		if($sub_district==0)
			{
				$sub_district = $this->session->userdata('SUB_DISTRICT');
				$userId 	= $this->session->userdata('USERID');
			}
		else
		{
			$user_id	= $this->General_Model->get_data('user_master', 'user_id', array("sub_district_code" => $sub_district,"user_type"=>4), 'user_name');
			//var_dump($user_id);
			$userId		=	$user_id[0]['user_id'];
			
		
		}
		 
		$this->Contents=array();
		
		$this->Contents['cluster_details']	= $this->General_Model->get_data('user_master', '*', array("sub_district_code" => $sub_district,"user_type"=>5), 'user_name');
		//var_dump($this->Contents['cluster_details']);
			
			$cluster	= $this->School_Details_Model->clusterdetails($userId);
			$this->Contents['cluster']		=	$cluster;
		/*$sub_admin					=	$this->School_Details_Model->get_sub_admin_details ($sub_district);
		$this->Contents['sub_admin']	=	$sub_admin;*/
		
		if (is_array($this->Contents['cluster_details']) && count($this->Contents['cluster_details']) >0)
		{
			$i=0;
			foreach ($this->Contents['cluster_details'] as $key => $cluster_details)
			{
			
				$clusters[$i]=	$this->School_Details_Model->get_cluster_details($cluster_details['user_id']);
				
				$i++;
			}//foreach
			$this->Contents['clusters']		=	$clusters;
			
			//var_dump($clusters);
		}//if
		$nonclust     =   $this->School_Details_Model->get_unclustersch_count($sub_district);
		//var_dump($nonclust);
		$this->Contents['nonclust']	    =	$nonclust;
		
		$this->Contents['sub_dist_det']	=	$this->School_Details_Model->getSubDistrictDetails($sub_district);
				
		$this->template->write_view('menu', 'menu', '');	
		$this->template->write_view('content', 'login/clusters', $this->Contents);
		$this->template->load();
	}

	function nonclustdetails()
	{
		$this->Session_Model->is_user_logged();
		$subdist=$this->input->post('hidClusterId');
		
		$this->Contents=array();
		
		
		$val                        =   $this->login_model->nonclustdetails_sname($subdist);
		$nonschool                  =   $this->login_model->nonclustdetails_nosname($subdist);
		
		$this->Contents['val']	  		=	 $val;
		$this->Contents['nonschool']	=    $nonschool ;
		
		$this->template->write_view('content', 'login/nonclustschool', $this->Contents);
		$this->template->load();
	}
	
	function district_details($rev_district=0)
	{
			if($rev_district==0)
			{
				$rev_district = $this->session->userdata('DISTRICT_CODE');
			}
			
			$userId 	= $this->session->userdata('USERID');
			$cluster	= $this->School_Details_Model->clusterdetails($userId);
			$this->Content['dist_details']		=	$cluster;
			//var_dump($this->Contents['dist_details']);
			$district_details		 = $this->General_Model->get_data('rev_district_master', '*', array("rev_district_code" => $rev_district), 'rev_district_code');
			
			$this->Content['district_name']			= $district_details[0]['rev_district_name'];
			$this->Content['sub_district_details']	= $this->General_Model->get_data('sub_district_master', '*', array("rev_district_code" => $rev_district), 'sub_district_name');
			
			
			if (is_array($this->Content['sub_district_details']) && count($this->Content['sub_district_details']) >0)
			{
				$i=0;
				foreach ($this->Content['sub_district_details'] as $key => $sub_district_details)
				{
				
					$sub_details[$i]=	$this->School_Details_Model->get_sub_school_details($sub_district_details['sub_district_code']);
					$i++;
				}//foreach
				
			}//if
			
			
			$this->Content['sub_details'] 	=	$sub_details;
			$this->template->write_view('menu', 'menu', '');	
			$this->template->write_view('content','login/district_details',$this->Content);	
			$this->template->load();
			
	}
	
	function admin_details()
	{
			
			
		if ($this->session->userdata('USER_TYPE')==0 || $this->session->userdata('USER_TYPE')==1)
		{
			$this->Content['district_details']	= $this->General_Model->get_data('rev_district_master', '*', array(),'rev_district_code');
													
			if (is_array($this->Content['district_details']) && count($this->Content['district_details']) >0)
			{
				$i=0;
				foreach ($this->Content['district_details'] as $key => $district_details)
				{
				
					$dist_details[$i]=	$this->School_Details_Model->get_district_school_details($district_details['rev_district_code']);
					$i++;
				}//foreach
				
			}//if
			
			$this->Content['dist_details'] 	=	$dist_details;
			$this->template->write_view('menu', 'menu', '');	
			$this->template->write_view('content', 'login/admin_details', $this->Content);
			
		}
		else redirect ('welcome');		$this->template->load();
		
	
				
				/*$data		=	array();
				$details	=	$this->School_Details_Model->getSchooldetails_District_level();
				$data['districts']	=	$details;
				$this->template->write_view('content','login/admin_details',$data);
				$this->template->load();*/			
	}
	
		function change_password(){ 
		//$this->template->write_view('menu', 'menu', '');	
			if($this->session->userdata('USER_TYPE')==''){ 
			//echo '<br><br><br>sfsfswe';
			header ( "Location: ". base_url(). 'index.php/welcome' );
			}
			else{
			       
					$this->form_validation->set_rules('password', '', 'trim|required');
					$this->form_validation->set_rules('newPassword', '', 'trim|required');
					$this->form_validation->set_rules('retype_password', '', 'trim|required');
					$this->form_validation->set_rules('name', '', 'trim|required');
					$this->form_validation->set_rules('mobile', '', 'trim|required');
					$this->form_validation->set_rules('email', '', 'trim|required|valid_email');
					
					$logindata		=	$this->Login_Model->getLoginData();
					$password	=	$logindata[0]['password'];
					if ($this->form_validation->run() == false)
					{
					       
							$error	=	 validation_errors();
							$this->template->write('error',$error);	
							//$this->template->load();	
							$this->template->write_view('content','login/change_password');			 
							$this->template->load();
					}
					else if($password!=get_encr_password($_POST['password'])){
							$data['error']	=	 'Current Password You Entered is not Correct';
							$this->template->write('error',$data);		
							$this->template->write_view('content','login/change_password');			 
							//$this->template->load();
					}
					else if($this->input->post('newPassword')!=$this->input->post('retype_password')){
							$data['error']	=	 'New Password And Retype Password is not Matching';
							$this->template->write('error',$data);		 
							$this->template->write_view('content','login/change_password');		
					}
					else
					{
						$aryUser=$this->Login_Model->change_Password();
						$msg	=	'Your Password has been Changed';
						//$this->template->write_view('content','login/change_password');	
						 
						
					}
					$this->home();	
					
				}//else
				}//function		
				
				function change_password1(){ 
		$this->template->write_view('menu', 'menu', '');	
			if($this->session->userdata('USER_TYPE')==''){ 
			//echo '<br><br><br>sfsfswe';
			header ( "Location: ". base_url(). 'index.php/welcome' );
			}
			else{
					$this->form_validation->set_rules('password', '', 'trim|required');
					$this->form_validation->set_rules('newPassword', '', 'trim|required');
					$this->form_validation->set_rules('retype_password', '', 'trim|required');
					$this->form_validation->set_rules('name', '', 'trim|required');
					$this->form_validation->set_rules('mobile', '', 'trim|required');
					$this->form_validation->set_rules('email', '', 'trim|required|valid_email');
					
					$logindata		=	$this->Login_Model->getLoginData();
					$datas['logindata']		=	$this->Login_Model->getLoginData();
					$password	=	$logindata[0]['password'];
					if ($this->form_validation->run() == false)
					{
					       
							$error	=	 validation_errors();
							$this->template->write('error',$error);	
							//$this->template->load();	
							$this->template->write_view('content','change_myPassword.php',$datas);			 
							$this->template->load();
					}
					else if($password!=get_encr_password($_POST['password'])){
							$data	=	 'Current Password You Entered is not Correct';
							$this->template->write('error',$data);		
							$this->template->write_view('content','change_myPassword.php',$datas);	
							$this->template->load();		 
							//$this->template->load();
					}
					else if($this->input->post('newPassword')!=$this->input->post('retype_password')){
							$data	=	 'New Password And Retype Password is not Matching';
							$this->template->write('error',$data);		 
							$this->template->write_view('content','change_myPassword.php',$datas);
							$this->template->load();		
					}
					else if(($this->input->post('newPassword')==$this->input->post('retype_password')) && ($this->input->post('newPassword')==$this->input->post('password'))){
							$data	=	 'Old Password And New Password is Same';
							$this->template->write('error',$data);		 
							$this->template->write_view('content','change_myPassword.php',$datas);
							$this->template->load();		
					}
					else
					{
						$aryUser=$this->Login_Model->change_Password();
						$datas['logindata']		=	$this->Login_Model->getLoginData();
						$data	=	'Your Password has been Changed';
						$this->template->write('sucess',$data);	
						$this->template->write_view('content','change_myPassword.php',$datas);
						$this->template->load();		
						
					}
				//	 $this->home();
					
				}//else
				}//function		
		function change_password_afterlogin(){
		
		$this->template->write_view('menu', 'menu', '');	
				if($this->session->userdata('USER_TYPE')==''){
				header ( "Location: ". base_url(). 'index.php/welcome' );
				}
				else{
				$data	=	array();
				$data['heading']		=	'Welcome/ChangePassword';
				$data['logindata']		=	$this->Login_Model->getLoginData();//echo md5($data['logindata'][0]['password']);
				$this->template->write_view('content','change_myPassword',$data);		 
				$this->template->load();
				}
				}//function			
	
	function logout(){
		$aryUser=$this->Login_Model->logoutUser();
		$this->index();
	}			
	
	function confirmFair($schoolcode,$fairid)
	{
		$Fair_confirm	=	 $this->Registration_Model->confirm_fair($schoolcode,$fairid);
		redirect('welcome/cluster_schools');
	
	}
	
	function resetFair($schoolcode,$fairid)
	{
		$Fair_confirm	= $this->Registration_Model->reset_fair($schoolcode,$fairid);
		$user_id		= $this->General_Model->get_data('user_cluster', 'user_id', array("school_code " => $schoolcode));
		$user_id		= $user_id[0]['user_id'];
		redirect('welcome/cluster_schools/'.$user_id);	
	}
	
	function confirm_sub_dist_schools($checks)
	{
	    //echo "<br /><br />hoiiiiiiiiiiii";
		$message	=	array();
		if($this->session->userdata('USER_TYPE')==4){
			$message['error']	=	$this->School_Details_Model->confirm_sub_dist_schools($checks);
		}
		
		if($message['error']) { $this->template->write_view('error','error/error_message',$message); }
		else {	$this->template->write_view('sucess','Confirmed Successfully');		}
		$this->clustdetails();
		
	}
	
	
	function import_interface()
	{
		$this->template->write_view('menu', 'menu', '');
		$this->template->write_view('content','import/import_csv_data');		 
		$this->template->load();
	
	}
	
	/*function upda()
	{
	   $this->db->query('delete from participant_item_details  where fairId = 5');
	
	}*/
	
	function upda()
	{
	   $this->db->query("update participant_item_details set participant_id =1216 where pi_id = 1216");
	
	}
	
	/*function update_pwd()
	{
	    $this->db->query("update user_master set password ='4513fc8314c9570d3ce16d440303c571' where user_name = 'thiruvananthapuram_north'");
	
	}
	
	function update_exb()
	{
				
		$this->db->query("update participant_item_details set is_captain ='Y' where participant_id = 1050 and fairId=4 and fest_id=0 and school_code=44076");
		
		$this->db->query("update participant_item_details set is_captain ='Y' where participant_id = 1293 and fairId=4 and fest_id=0 and school_code=44234");
	
	}*/
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
?>