<?php
class Ajax2 extends CI_Controller {
	function Ajax2()
	{
		parent::__construct();
		$this->load->model('report/Prereport_Model');		
	}

function fetch_school_from_festival($fest_id)
	{
		if($fest_id!="")
		{
		$where='school_code='.$fest_id;
		$item_details	=		$this->General_Model->fetch_data('school_master','school_name,school_code',$where);
		if(count($item_details)>0)
		echo "School Name : ".$item_details[0]['school_name'];	
		}	
	}
	
}

?>