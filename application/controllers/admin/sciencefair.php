<?php
class Sciencefair extends CI_Controller {
	
	public function __construct()
    {
		parent::__construct(); 
		
		$this->load->library('session');
		$this->load->library('javascript');
		
		$this->load->model('General_Model');
	
		$this->load->model('Session_Model');
		
		$this->load->model('admin/Sciencefair_Model');
		$this->template->add_js('js/admin/admin.js');
			
		$this->template->add_js('js/popcalendar.js');
	  	$this->template->add_css('styles/calendar.css');
		//$this->Session_Model->is_user_logged(true);
		
		
		//$this->Content=array();
		//$this->template->write_view('left_panel', 'menu_left', '');
	}
	
	function index()
	{
	//	if (is_define_sciencefair ($this->session->userdata('SUB_DISTRICT')))
		//echo '<br><br><br>xsxxx';
		
		/*if (0 == $this->session->userdata('USER_TYPE') || 1 == $this->session->userdata('USER_TYPE'))
		{
			$this->Content['sciencefair_details']	= $this->General_Model->get_data('science_master', '*', array(),'fairId desc');
			if (!isset($this->Content['admin_action']) || (isset($this->Content['admin_action']) && $this->Content['admin_action'] == 'ADD'))
			{
				if ($this->General_Model->is_record_exists('science_master',"status = 'O'"))
				{
					$this->Content['add_edit_sciencefair']	= 'no'; 
				}
			}
			$this->template->write_view('content', 'admin/sciencefair_view', $this->Content);
		}
		if (2 == $this->session->userdata('USER_TYPE'))
		{
			$this->Content['edit_sciencefair']	= 'no'; 
			if (isset($this->Content['admin_action']) && $this->Content['admin_action']== 'EDIT')
			{
				$this->Content['edit_sciencefair']	= 'yes'; 
			}
			$this->Content['sciencefair_details']	= $this->General_Model->get_data('dist_science_master', '*', 
														array("rev_district_code" => $this->session->userdata('DISTRICT')),
														'kalolsavam_id desc');
			$this->template->write_view('content', 'admin/dist_kalolsavam_view', $this->Content);
		}*/
		if ($this->session->userdata('USER_TYPE')==4 || $this->session->userdata('USER_TYPE')==1)
		{
			$this->Content['edit_sciencefair']	= 'no'; 
			$this->Content['sciencefair_details']	= $this->General_Model->get_data('sub_dist_sciencefair_master', '*', array("sub_district_code" => $this->session->userdata('SUB_DISTRICT')),'sciencefair_id desc');
			
			$sciencefair_details_count = count($this->Content['sciencefair_details']);
			
			
			//if (isset($this->Content['admin_action']) && $this->Content['admin_action']== 'EDIT')
			if ((isset($this->Content['admin_action']) && $this->Content['admin_action']== 'EDIT') || $sciencefair_details_count==0)
			{
				$this->Content['edit_sciencefair']	= 'Yes'; 
			}
			
			$this->template->write_view('menu', 'menu', '');
			$this->template->write_view('content', 'admin/sub_dist_sciencefair_view', $this->Content);
		}
		$this->template->load();
	}
	
	function edit_sciencefair ()
	{
		if('' != $this->input->post('sel_sciencefair_id') || (isset($this->Content['sel_sciencefair_id']) && !empty($this->Content['sel_sciencefair_id'])))
		{
			$this->Content['admin_action']			= 'EDIT';
			$this->Content['sciencefair_id']			= ('' == $this->input->post('sel_sciencefair_id')) ? $this->Content['sel_sciencefair_id']:$this->input->post('sel_sciencefair_id');
			
			
			/*if (0 == $this->session->userdata('USER_TYPE') || 1 == $this->session->userdata('USER_TYPE'))
			{
				$this->Content['selected_sciencefair']	= $this->General_Model->get_data('sub_dist_sciencefair_master', '*', array('sub_dist_sciencefair_id'=>$this->Content['sciencefair_id']));
			}*/
			if (2 == $this->session->userdata('USER_TYPE'))
			{
				$this->Content['selected_sciencefair']	= $this->General_Model->get_data('dist_sciencefair_master', '*', array('dist_sciencefair_id'=>$this->Content['sciencefair_id']));
			}
			if (4 == $this->session->userdata('USER_TYPE') || 1 == $this->session->userdata('USER_TYPE'))
			{
				$this->Content['selected_sciencefair']	= $this->General_Model->get_data('sub_dist_sciencefair_master', '*', array('sub_dist_sciencefair_id'=>$this->Content['sciencefair_id']));
			}
			$this->index();
		}
		else redirect ('admin/sciencefair');
	}
	function add_sciencefair()
	{print_r($_POST);
		if (isset($_POST['txtSciencefairVenue']))
		{
			//if (!$this->General_Model->is_record_exists('sub_dist_sciencefair_master',"status = 'O'"))
			if (!$this->General_Model->is_record_exists('sub_dist_sciencefair_master',"status = 'O'"))
			{
				$data['sciencefair_name']	=	trim($this->input->post('txtSciencefairName'));
				$data['sciencefair_year']	=	trim($this->input->post('txtSciencefairYear'));
				$data['venue']				=	trim($this->input->post('txtSciencefairVenue'));
				$data['status']				=	"O";
				/*if (isset($_FILES['kalolsavamLogo']['name']) && !empty($_FILES['kalolsavamLogo']['name']))
				{
					$image_name	= $this->General_Model->upload_logo_image ('kalolsavamLogo', 'kalolsavam'.substr(fncUuid(), 10), 'state');
					if (!$image_name)
					{
						$this->template->write('error', $this->upload->display_errors());
					}
					else $data['logo_name']		= $image_name;
				}*/
				
				if ($this->Sciencefair_Model->save_sciencefair_details($data, 'ADD'))
					$this->template->write('message', 'Sasthrolsavam details saved successfully');
				else $this->template->write('message', 'Failed to add Sasthrolsavam details');
			}
			$this->index();
		}
		else redirect ('admin/sciencefair');
	}
	
	
	
	function update_sciencefair()
	{
		if (isset($_POST['sciencefair_id']))
		{	
			if(trim($this->input->post('txtStartDate')) == '' || trim($this->input->post('txtEndDate')) == '')
			{
				$this->Content['sel_sciencefair_id'] = trim($this->input->post('sciencefair_id'));
				$this->template->write('error', 'Please enter Start Date and End Date');
				$this->edit_sciencefair();
				return;
			}
			else if(date(trim($this->input->post('txtStartDate'))) > date(trim($this->input->post('txtEndDate'))))
			{
				$this->Content['sel_sciencefair_id'] = trim($this->input->post('sciencefair_id'));
				$this->template->write('error', 'End Date is must be greater value than Start Date ');
				$this->edit_sciencefair();
				return;
			}
			else
			{
					
				$file_upload	= FALSE;
				if (isset($_FILES['sciencefairLogo']['name']) && !empty($_FILES['sciencefairLogo']['name'])) $file_upload	= TRUE;
				
				/*if (0 == $this->session->userdata('USER_TYPE') || 1 == $this->session->userdata('USER_TYPE'))
				{
					if ($this->General_Model->is_record_exists('sciencefair_master',"status = 'O' AND sciencefair_id = ".$this->input->post('sciencefair_id')))
					{
						if ($file_upload)
						{
						
							$image_name	= $this->General_Model->upload_logo_image('sciencefairLogo', 'sciencefair'.substr(fncUuid(), 10), 'state');
							
							if (!$image_name)
							{
								$this->template->write('error', $this->upload->display_errors());
							}
							else
							{
								$prev_image_name		= $this->General_Model->get_single_column_value ('sciencefair_master', 'logo_name', 'sciencefair_id = '.$this->input->post('sciencefair_id'));
								if (isset($prev_image_name) && is_array($prev_image_name) && count($prev_image_name) > 0)
									$prev_image_name = $prev_image_name[0];
								else $prev_image_name ='';
								$data['logo_name']		= $image_name;
							}
						}
						
						$data['sciencefair_id']		=	$this->input->post('sciencefair_id');
						$data['sciencefair_name']	=	trim($this->input->post('txtSciencefairName'));
						$data['sciencefair_year']	=	trim($this->input->post('txtSciencefairYear'));
						$data['venue']				=	trim($this->input->post('txtSciencefairVenue'));
						$data['start_date']			=	trim($this->input->post('txtStartDate'));
						$data['end_date']			=	trim($this->input->post('txtEndDate'));
						$data['status']				=	"O";
						if ($this->Sciencefair_Model->save_sciencefair_details ($data, 'EDIT'))
						{
	
							if (isset($prev_image_name) && !empty($prev_image_name))
							{
								unlink_sciencefair_logo ($prev_image_name, 'state');
							}
							$this->template->write('message', 'Sciencefair details saved successfully');
						}
						else $this->template->write('error', 'Failed to save Sciencefair details');
					}
				}*/
				if (2 == $this->session->userdata('USER_TYPE'))
				{
					if ($this->General_Model->is_record_exists('dist_sciencefair_master', "status = 'O' AND dist_sciencefair_id = ".$this->input->post('sciencefair_id')))
					{
						$data['venue']					=	trim($this->input->post('txtSciencefairVenue'));
						$data['dist_sciencefair_id']	=	$this->input->post('sciencefair_id');
						$data['start_date']				=	trim($this->input->post('txtStartDate'));
						$data['end_date']				=	trim($this->input->post('txtEndDate'));
						if ($file_upload)
						{
							$image_name	= $this->General_Model->upload_logo_image ('sciencefairLogo', 'dist_sciencefair'.substr(fncUuid(), 10), 'dist');
							if (!$image_name)
							{
								$this->template->write('error', $this->upload->display_errors());
							}
							else $data['logo_name']		= $image_name;
						}
						
						
						if ($this->Sciencefair_Model->update_dist_sciencefair_details ($data))
							$this->template->write('message', 'Sciencefair details saved successfully');
						else $this->template->write('error', 'Failed to save Sciencefair details');
					}
				}
				if (4 == $this->session->userdata('USER_TYPE') || 1 == $this->session->userdata('USER_TYPE'))
				{
					if ($this->General_Model->is_record_exists('sub_dist_sciencefair_master', "status = 'O' AND sub_dist_sciencefair_id = ".$this->input->post('sciencefair_id')))
					{
						$data['venue']					=	trim($this->input->post('txtSciencefairVenue'));
						$data['sub_dist_sciencefair_id']=	$this->input->post('sciencefair_id');
						$data['start_date']				=	trim($this->input->post('txtStartDate'));
						$data['end_date']				=	trim($this->input->post('txtEndDate'));
						if ($file_upload)
						{
							$image_name	= $this->General_Model->upload_logo_image ('sciencefairLogo', 'sub_dist_sciencefair'.substr(fncUuid(), 10), 'sub_dist');
							
														
							if (!$image_name)
							{
								$this->template->write('error', $this->upload->display_errors());
							}
							else $data['logo_name']		= $image_name;
						}
						
						if ($this->Sciencefair_Model->update_sub_dist_sciencefair_details ($data))
							$this->template->write('message', 'Sciencefair details saved successfully');
						else $this->template->write('error', 'Failed to save Sciencefair details');
					}
				}
			}
			$this->index();
		}
		else redirect ('admin/sciencefair');
	}
}

?>