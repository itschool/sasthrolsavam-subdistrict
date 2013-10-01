<?php

class Participant_Model extends CI_Model{

	function Participant_Model()
	{
		parent::__construct();
	}
	function get_item_participant($festtype,$fairtype)
	{
		$this->db->select('count( p.participant_id ) AS cpt, p.item_code, i.item_type, i.item_name, i.is_off_stage, f.fest_name,g.start_time,g.ground_id, g.no_of_judges,gm.ground_name, gm.ground_desc');
		$this->db->from('participant_item_details AS p');
		$this->db->join('item_master AS i','i.item_code = p.item_code');
		$this->db->join('festival_master AS f','f.fest_id = i.fest_id');
		$this->db->join('ground_item_master AS g','g.item_code= p.item_code','LEFT');
		$this->db->join('ground_master AS gm','gm.ground_id = g.ground_id','LEFT');
		$this->db->where('p.fest_id',$festtype);
		$this->db->where('p.fairId',$fairtype);
		$this->db->where('p.is_captain','Y');
		$this->db->where('i.item_type','G');
		$this->db->group_by('p.item_code');
		$this->db->order_by('p.item_code');
		$getdet		=	$this->db->get();
		return $getdet->result_array();
	}
	
	function get_item_exhibition_participant($festtype,$fairtype)
	{
		if($fairtype	==	4 && @$_POST['cmbWrkexpType'] == 2) {
			$limit	=	$this->exhibition_cate($fairtype,$festtype);
	    }		
		$this->db->select('PID.school_code,PID.school_code as cpt,PID.school_code as item_code,SD.school_name as item_name,SD.school_name,GIM.*');
		$this->db->from('participant_item_details AS PID');
		$this->db->join('school_master AS SD','PID.school_code = SD.school_code');
		$this->db->join('ground_item_master AS GIM ','GIM.item_code = PID.school_code','LEFT');
		$this->db->join('ground_master AS GM ','GM.ground_id = GIM.ground_id','LEFT');
		if($fairtype	==	4 && @$_POST['cmbWrkexpType'] == 2) {		      
			$this->db->join('school_details AS S',"SD.school_code = S.school_code AND ".$limit."");			
			$this->db->where('PID.fest_id','0'); 
		}		
		if($fairtype	!=	4) {			
			$this->db->where('PID.fest_id',$festtype); 
		}
		$this->db->where('PID.fairId',$fairtype);
		$this->db->group_by('PID.school_code');
		$school_details		=	$this->db->get();
		return $school_details->result_array();
	}
	function exhibition_cate($cmbFairType,$cmbCateType)
	{
		if($cmbFairType == 4){
			if($cmbCateType	==	1)
			{	$limit	=	'(S.class_end = 4 )'; }
			if($cmbCateType	==	2)
			{	$limit	=	'(S.class_end = 7 OR S.class_end = 5)'; }
			if($cmbCateType	==	3)
			{	$limit	=	'(S.class_end = 8 OR S.class_end = 10)'; }
			if($cmbCateType	==	4)
			{	$limit	=	'S.class_end = 12'; }
		}			
		return $limit;		
	}
	function get_item_exhibition_participant_single($festtype,$fairtype)
	{
	//echo '<br><br><br>'.$festtype.'---'.$fairtype;
	
		if($fairtype	==	4 && @$_POST['cmbWrkexpType'] == 2) {
			$limit	=	$this->exhibition_cate($fairtype,$festtype);
	    }		
		$this->db->select('PID.school_code,PID.school_code as cpt,SD.school_code as item_code,SD.school_name as item_name,SD.school_name,GIM.start_time,GIM.ground_id,GIM.no_of_judges,GM.ground_name,GM.ground_desc');
		$this->db->from('participant_item_details AS PID');
		$this->db->join('school_master AS SD','PID.school_code = SD.school_code');
		$this->db->join('ground_item_master AS GIM ','GIM.item_code = PID.school_code','LEFT');
		$this->db->join('ground_master AS GM ','GM.ground_id = GIM.ground_id','LEFT');
		if($fairtype	==	4 && @$_POST['cmbWrkexpType'] == 2) {		      
			$this->db->join('school_details AS S',"SD.school_code = S.school_code AND ".$limit."");			
			$this->db->where('PID.fest_id','0'); 
		}		
		if($fairtype	!=	4) {			
			$this->db->where('PID.fest_id',$festtype); 
		}
		$this->db->where('PID.fairId',$fairtype);
		$this->db->group_by('PID.school_code');
		$school_details		=	$this->db->get();
		return $school_details->result_array();
		
	
	
		/*$this->db->select('count( p.school_code) AS cpt, p.item_code, p.school_code, i.item_code,i.item_name, i.is_off_stage, f.fest_name,g.start_time,g.ground_id, g.no_of_judges,gm.ground_name, gm.ground_desc');
		$this->db->from('participant_item_details AS p');
		$this->db->join('item_master AS i','i.item_code = p.item_code');
		$this->db->join('festival_master AS f','f.fest_id = i.fest_id');
		$this->db->join('ground_item_master AS g','g.item_code= p.item_code','LEFT');
		$this->db->join('ground_master AS gm','gm.ground_id = g.ground_id','LEFT');
		$this->db->where('p.fest_id',$festtype);
		$this->db->where('p.fairId',$fairtype);
		$this->db->where('p.is_captain','Y');
		$this->db->where('i.item_type','S');
		$this->db->group_by('p.item_code');
		$this->db->order_by('p.item_code');
		$getdet		=	$this->db->get();
		return $getdet->result_array();*/
	}
	
	function get_item_participant_single($festtype,$fairtype)
	{
		$this->db->select('count( p.participant_id ) AS cpt, p.item_code, i.item_type, i.item_name, i.is_off_stage, f.fest_name,g.start_time,g.ground_id, g.no_of_judges,gm.ground_name, gm.ground_desc');
		$this->db->from('participant_item_details AS p');
		$this->db->join('item_master AS i','i.item_code = p.item_code');
		$this->db->join('festival_master AS f','f.fest_id = i.fest_id');
		$this->db->join('ground_item_master AS g','g.item_code= p.item_code','LEFT');
		$this->db->join('ground_master AS gm','gm.ground_id = g.ground_id','LEFT');
		$this->db->where('p.fest_id',$festtype);
		$this->db->where('p.fairId',$fairtype);
		$this->db->where('p.is_captain','Y');
		$this->db->where('i.item_type','S');
		$this->db->group_by('p.item_code');
		$this->db->order_by('p.item_code');
		$getdet		=	$this->db->get();
		return $getdet->result_array();
	}
	

}



?>