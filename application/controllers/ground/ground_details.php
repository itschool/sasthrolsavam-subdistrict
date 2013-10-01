<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ground_Details extends CI_Controller {
	
	public function __construct()
    {
		parent::__construct(); 
		$this->load->model('General_Model');
		$this->load->model('Session_Model');
		$this->load->library('session');
		$this->load->library('javascript');
		
		$this->template->add_js('js/ground/ground.js');	
		$this->load->model('ground/Ground_Model');
		
			
	}//end function  function __construct
	function index()
	{
		if(!@$this->Content)
			$this->Content	=	array();
		$this->template->write_view('menu', 'menu', '');
		$this->Content['ground_array']		=	$this->Ground_Model->get_ground_name_array();
		$this->template->write_view('content', 'ground/add_ground', $this->Content);
		
		$this->Content['grounds']	=	$this->Ground_Model->get_ground();
		if(count($this->Content['grounds'])>0){
			$this->template->write_view('content', 'ground/grounds',$this->Content);
		}
		$this->template->load();
	}
	
	function add_ground()
	{
		if($this->Session_Model->check_user_permission(19)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		//$this->form_validation->set_rules('txtGroundName', 'Ground Name', 'required');
		//$this->form_validation->set_rules('txtGroundName', 'txtGroundName', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('txtGroundDescription', 'Venue Description', 'required');
		
		if ($this->form_validation->run() == false)
		{
			$this->template->write('error', validation_errors().'<br>');
			$this->index();
			return;
		}else{
			if($this->Ground_Model->check_groundname_exists('', $this->input->post('txtGroundName')))
			{
				$this->template->write('error', 'Venue name already exists');
				$this->index();
				return ;
			}
			
			$this->Ground_Model->save_ground_details();
			$this->template->write('sucess', 'Venue details saved successfully');
			$this->index();
		}
	}
	
	function edit_ground_detials()
	{
		if($this->Session_Model->check_user_permission(19)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->Content['selected_ground']	=	$this->Ground_Model->select_ground_details();
		$this->index();
	}
	
	function update_ground_detials()
	{
		if($this->Session_Model->check_user_permission(19)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->form_validation->set_rules('txtGroundName', 'Venue Name', 'required');
		$this->form_validation->set_rules('txtGroundName', 'Venue Description', 'required');
		
		if ($this->form_validation->run() == false)
		{
			$this->template->write('error', validation_errors().'<br>');
			return;
		}else{
		
			$groundId	=	$this->input->post('hidGdId');
			if($this->Ground_Model->check_groundname_exists($groundId, $this->input->post('txtGroundName')))
			{
				$this->template->write('error', 'Venue name already exists');
				$this->index();
				return;
			}
			$this->Ground_Model->update_ground_details();
			$this->template->write('sucess', 'Venue details updated successfully');
			$this->index();
		}
	}

}
/* End of file ground_details.php */
/* Location: ./application/controllers/ground/ground_details.php */
?>