<?php
class Science_entry extends CI_Controller{ 
	function Science_entry()
	{
		parent::__construct(); 
		$this->load->model('Session_Model');
		$this->load->model('login/Login_Model');
		$this->load->model('school/Registration_Model');
		$this->load->model('science/Science_Model');
		$this->load->library('session');
		$this->load->library('javascript');
		$this->template->add_js('js/registration_script.js');
	}
	
	function index()
	{
		//$this->template->write_view('content','maths/test');		 
		//$this->template->load();
	}
	function science_entry_save()
	{		
		$this->form_validation->set_rules('txtboys', 'Number of Boys', 'trim|required');
		$this->form_validation->set_rules('txtgirls', 'Number of girls', 'trim|required');
		//$this->form_validation->set_rules('escorting_teacher_num', 'Number of Escorting Teacher', 'trim|required');
	
		$schoolcode=(int)$this->input->post('schoolcode');	
		$category=(int)$this->input->post('festid');
		$fairid	=	1;
		$this->Content['item_details']		=	 $this->Registration_Model->get_item_details($category,$fairid);
		if ($this->form_validation->run() == false)
		{			
			//echo "no";
			/*$maths_details['0']['txtboys']	=	(int)$this->input->post('txtboys');		
			$maths_details['0']['txtgirls']		=	(int)$this->input->post('txtgirls');
			$maths_details['0']['escorting']	=	(int)$this->input->post('escorting');
			$error	=	 validation_errors();
			$formvalidation_flag=1;
			$this->Content['error']	=	$error;*/			
					
		}
		
		else
		{
			$science_details						=	 $this->Science_Model->save_science_details($schoolcode,$category,$fairid,$this->Content['item_details']);
		}
		
		$this->template->write_view('content','science/science_entry');
		$this->template->load();
		//redirect('./school/registration/school_entry/'.$schoolcode."/".$category."/1/".science_details);
	}
}

?>