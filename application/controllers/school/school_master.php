<?php
class School_Master extends CI_Controller {

	function School_Master()
	{
		parent::__construct(); 
		$this->template->add_js('js/school_master.js');	
		$this->load->model('school/School_Master_Model');
		$this->load->model('General_Model');
		$this->load->model('Session_Model');
		$this->template->write_view('menu', 'menu', '');
		//$this->Session_Model->is_user_logged();
	}
	function index($message = array())
	{
		//echo '<br><br><br>';
		//var_dump($this->session->userdata);
		//var_dump($_POST["UserIdty"]);
		
		if (count(@$message['error_array']) > 0)
		{
			$error_msg		=	'';
			foreach(@$message['error_array'] as $error)
			{
				//$this->template->write('error',$error.'<br>');
				$error_msg		.=	$error.'<br />';	
			}
			$data['error']		=	$error_msg;
			$this->template->write_view('error','error/error_message',$data);
			//$this->Content['error_msg']	=	$error_msg;
		}
		if(!isset($this->Content))
		$this->Content				=	array();
		$this->Content['districts']		=	$this->General_Model->prepare_select_box_data('rev_district_master', 'rev_district_code, rev_district_name','','Select District','rev_district_code');

		if ($this->session->userdata('DISTRICT_CODE') and !$this->session->userdata('SUB_DISTRICT'))
		{
		
		    //echo "<br />hellooooooooooooo";
			$_POST['cmbDistrictFilter']		=	$this->session->userdata('DISTRICT_CODE');
			$this->Content['edu_districts']	=		$this->General_Model->prepare_select_box_data('edu_district_master','edu_district_code,edu_district_name',array('rev_district_code' => $_POST['cmbDistrictFilter']),'--Select Edu District');
			$this->Content['sub_districts']	=	$this->General_Model->get_subdistrict_details_combo(trim($_POST['cmbDistrictFilter']));
		}
		//echo "<br />hellooooooooooooo";
		if(@$_POST["UserIdty"]!=''){
		$this->template->write_view('content', 'school/add_school_details', $this->Content);
		}
		$this->Content['retvalue']	=	$this->School_Master_Model->exist_school_details();
		

		if(count($this->Content['retvalue'])>0 || isset($_POST['filter'])){
			if(isset($_POST['cmbDistrictFilter']) && trim($_POST['cmbDistrictFilter']) != 0) {
				$this->Content['sub_districts']	=	$this->General_Model->get_subdistrict_details_combo(trim($_POST['cmbDistrictFilter']));
			}
			
			if(isset($_POST['cmbSubDistrictFilter']) && trim($_POST['cmbSubDistrictFilter']) != 0) 			{
			   $sub_code	=	$_POST['cmbSubDistrictFilter'];
				$this->Content['retvalue']	=	$this->General_Model->get_data('school_master','*',array('sub_district_code' => $sub_code),'school_code');
			//var_dump($this->Content);
			}
			//var_dump($this->Content['retvalue']);
			
		}
		//var_dump($this->Content);
		$this->template->write_view('content', 'school/list_school_details',$this->Content);
		$this->template->load();
	}
	
	function add_school_details()
	{
		$message		=	$this->School_Master_Model->save_school_details();
		if (!$message)
		{
			$this->template->write('sucess', 'School details saved successfully');
		}
		$this->index($message);
	}
	
	function edit_school_detials()
	{
		$this->Content['selected_school']	=	$this->School_Master_Model->selected_school_details();
		//$this->Content['edu_districts']	=		$this->General_Model->prepare_select_box_data('edu_district_master','edu_district_code,edu_district_name',array('rev_district_code' => $this->Content['selected_school'][0]['rev_district_code']),'--Select Edu District');
		//$this->Content['subdistricts']	=		$this->General_Model->prepare_select_box_data('sub_district_master','sub_district_code,sub_district_name',array('edu_district_code' => $this->Content['selected_school'][0]['edu_district_code']),'--Select Sub District --');
		//$this->Content['subdistricts']	=		$this->General_Model->get_subdistrict_details_combo($this->Content['selected_school'][0]['rev_district_code']);
		//$this->Content['schools']		=		$this->General_Model->get_school_details_combo($this->Content['selected_user'][0]['sub_district_code']);
		$this->index();
	}
	
	function update_school_detials()
	{
		$userId	=	$this->input->post('hidUserId');
		$message		=	$this->School_Master_Model->update_school_details();
		if (!$message)
		{
			$this->template->write('sucess', 'School details updated successfully');
		}
		$this->index($message);
	}
}
	?>