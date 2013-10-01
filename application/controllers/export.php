<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Export extends CI_Controller {
	
	public function __construct()
    {
		parent::__construct(); 
		$this->template->add_js('js/admin/admin.js');
		$this->load->model('export_model');
		$this->template->write_view('menu', 'menu', '');
		$this->load->helper('csv/csv');
		$this->Contents = array();
		$this->load->model('General_Model');
				
	}//end function  function __construct
	
	function index()
	{			
		$this->export_sub_district_data();
		
	}

	function export_sub_district_data($checks)
	{
	
		if($this->session->userdata('USER_TYPE') != 4){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$sub_dist_code			=	$this->session->userdata('SUB_DISTRICT');
		
		$confirm_data_entry	= $this->General_Model->get_data('result_master', 'is_finalized', array('is_finalized' => 'Y'));
			if(is_array($confirm_data_entry) && count($confirm_data_entry) > 0 && 'Y' == @$confirm_data_entry[0]['is_finalized'])
			{
				$name_csv			=	"sasthramela_sub_dist_data_".$sub_dist_code;
				$export_array		= $this->export_model->get_sub_dist_school_export_data();
				array_to_csv($export_array,$name_csv.'.csv');
			}
			
			else
			{
				redirect('welcome/clustdetails');
			}
		
		 redirect ('welcome');
	}
	function export_district_data ()
	{
		if($this->Session_Model->check_user_permission(8)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->Contents			=	array();		
		$sub_dist_code			=	$this->session->userdata('SUB_DISTRICT');
		$dist_code				=	$this->session->userdata('DISTRICT_CODE');
		$fair					=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','Select Fair','fairId');
		$this->Contents['fair']	=	$fair;
		$fairid		=	$this->input->post('cmbFairType');
		if($fairid == 4){
			//$work_type	=	$this->input->post('hidworktype');
		}
		else{
			//$worktype	=	0;
		}
		if ($this->session->userdata('USER_GROUP') == 'A' && $this->session->userdata('USER_TYPE')==4)
		{
			if('' != $this->input->post('hidExport') && 'TRUE' == $this->input->post('hidExport'))
			{				
				$fair	=	$this->input->post('cmbFairType');				
				$name_csv			= "sasthramela_sub_dist_data_".$sub_dist_code."+".$fair;
				
				$export_array		= $this->export_model->get_district_export_data($fairid);
				array_to_csv($export_array,$name_csv.'.csv');
			}
			else
			{
				$this->template->write_view('content', 'export/district_data', $this->Contents);
				$this->template->load();
			}
		}
		else redirect ('welcome');
	}
}
?>