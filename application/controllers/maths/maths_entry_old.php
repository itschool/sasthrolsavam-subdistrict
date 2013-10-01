<?php
class Maths_entry extends CI_Controller{ 
	function Maths_entry()
	{
		parent::__construct(); 
		$this->load->model('Session_Model');
		$this->load->model('login/Login_Model');
		$this->load->model('school/Registration_Model');
		$this->load->model('maths/Maths_entry_Model');
		$this->load->library('session');
		$this->load->library('javascript');
		$this->template->add_js('js/common.js');
	}
	
	function index()
	{
		//$this->template->write_view('content','maths/test');		 
		//$this->template->load();
	}
	function save_details(){
	
	$this->form_validation->set_rules('txtboys', 'Number of Boys', 'trim|required');
	$this->form_validation->set_rules('txtgirls', 'Number of girls', 'trim|required');
	//$this->form_validation->set_rules('escorting', 'Number of Escorting Teacher', 'trim|required');
	
			$schoolcode=(int)$this->input->post('schoolcode');	
			$category=(int)$this->input->post('festid');
			if($category==1)	$this->Content['classsectionary'] = array(0=>"Std",1=>1,2=>2,3=>3,4=>4);
			else if($category==2)$this->Content['classsectionary'] = array(0=>"Std",5=>5,6=>6,7=>7);
			else if($category==3)$this->Content['classsectionary'] = array(0=>"Std",8=>8,9=>9,10=>10);
			else if($category==4)$this->Content['classsectionary'] = array(0=>"Std",11=>11,12=>12);
			$fairid=2;
			$item_count=(int)$this->input->post('item_count');
			
			$school_details						=	 $this->Registration_Model->get_school_details($schoolcode);
			$this->Content['school_details']	=	$school_details;		
			$this->Content['item_details']		=	 $this->Registration_Model->get_item_details($category,$fairid);
			$this->Content['category']=$category;
			$this->Content['Heading'] = (int)$this->input->post('heading');	
			$this->Content['flag']	=	1;
	if ($this->form_validation->run() == false)
		{	
			$maths_details['0']['txtboys']		=	(int)$this->input->post('txtboys');		
			$maths_details['0']['txtgirls']		=	(int)$this->input->post('txtgirls');
			$maths_details['0']['escorting']		=(int)$this->input->post('escorting');
			$error	=	 validation_errors();
			$formvalidation_flag=1;
			$this->Content['error']	=	$error;
			//if($this->Content['flag']==1)
		//	$this->Content['school_details']	=	$school_details;
		
			//$this->template->write_view('content','maths/maths_entry_form',$this->Content);
			//$this->template->write_view('content','school/school_entry',$this->Content);
			//var_dump($school_details); 				
		}
		else
		{
		$maths_details_save						=	 $this->Maths_entry_Model->save_maths_details($schoolcode,$category,$fairid,$this->Content['item_details']);
		if($maths_details_save)
			{
			    $sucess="Participants Details Inserted Successfully";
				$this->Content['sucess']	=	$sucess;
			
				
			}
		$maths_details=$this->Maths_entry_Model->get_maths_details($schoolcode,$category,$fairid);
		
		$this->Content['maths_details']=$maths_details;
		$this->Content['parti_flag']=1;
		
		}
		$maths_details=$this->uri->uri_to_assoc(6);
		//redirect('./school/registration/school_entry/'.$schoolcode.'/'.$category.'/2/'.$maths_details);
		 $this->template->write_view('content','school/school_entry',$this->Content);	
		 $this->template->write_view('content','maths/maths_entry_form',$this->Content);
		 $this->template->load();
	}
	}
	
	
	?>