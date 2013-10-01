<?php

class Ground_Model extends CI_Model{

	function Ground_Model()
	{
		parent::__construct();
	}
	
	function get_ground_name_array()
	{
		$ground_array		=	array();
		$ground_array[0]		=	'Select';
		for($i = 1; $i <=50; $i++)
		{
			$ground_name					=	'Venue '.$i;
			$ground_array[$ground_name]		=	$ground_name;
		}
		return $ground_array;
	}
	
	function get_ground()
	{
		$this->db->from('ground_master');
		$this->db->order_by('ground_name', 'ASC');
		$this->db->select('*');
		$result		=	$this->db->get(); 
		return $result->result_array();
	}
	
	function save_ground_details()
	{
		$data['ground_name']			=	$this->input->post('txtGroundName');
		$data['ground_desc']			=	$this->input->post('txtGroundDescription');
		$this->db->insert('ground_master',$data);
		return $this->db->insert_id();
	}
	
		
	function check_groundname_exists($id='', $groundname)
	{

		if($id != '')
			$this->db->where('ground_id != "'.$id.'"');
		$this->db->where('ground_name = "'.$groundname.'"');
		$this->db->select('ground_id');
		$this->db->from('ground_master');
		$result	=	$this->db->get();
		if(count($result->result_array()) > 0)
		{
			return true;
		}
		else 
		{
			return false;
		}
	}
	
	function select_ground_details() 
	{
	
		$this->db->where('ground_id', $this->input->post('hidGroundId'));
		$this->db->from('ground_master');
		$this->db->select('*');
		$result		=	$this->db->get(); 
		return $result->result_array();
	}
	
	function update_ground_details()
	{
		$groundId	=	$this->input->post('hidGdId');
		$data['ground_name']			=	$this->input->post('txtGroundName');
		$data['ground_desc']			=	$this->input->post('txtGroundDescription');
		$this->db->where('ground_id', $groundId);
		$this->db->update('ground_master',$data);
	}
	
}



?>