<?php
class Timefest_model extends CI_Model{
	function Timefest_model()
	{
		parent::__construct();
	}
	
	
	
	
	function timefestconfidential($resfest,$resfair)
	{
	//echo "<br><br>enterrr";
		$this->db->select('r.item_code, I.item_name,I.item_type,f.fest_name,s.fairName');
		$this->db->from('result_master AS r');
		$this->db->join('item_master AS I',"I.item_code = r.item_code and I.fest_id='$resfest' and I.fairId='$resfair'");
		$this->db->join('festival_master AS f',"f.fest_id =I.fest_id");
		$this->db->join('science_master AS s',"s.fairId =I.fairId");
		$this->db->where('r.is_finish','Y');
		$this->db->group_by('r.item_code');
		$this->db->order_by('r.item_code');
		$details	=	$this->db->get();
		return  $details->result_array();
	
	}
	function timefestconfidential_exb($resfest,$resfair)
	{
	//echo "<br><br>enterrr";
		//$limit	=	$this->exhibition_category($resfair,$resfest);
		$this->db->select('r.item_code, r.total_mark,r.rank,r.grade,sp.total_point as point,r.percentage,r.marks,sm.school_name,sm.school_code,p.*');
		$this->db->from('result_master AS r');
		$this->db->join('participant_item_details AS p',"p.school_code =r.item_code");
		$this->db->join('science_master AS sc',"sc.fairId =r.fairId");
		$this->db->join('school_details AS S',"S.school_code = r.item_code");
		$this->db->join('school_point_details AS sp',"sp.item_code = r.item_code");
		$this->db->join('school_master AS sm',"sm.school_code =S.school_code");
		$this->db->where('r.is_finish','Y');
		$this->db->where('r.fest_id',$resfest);
		$this->db->where('p.fest_id',0);
		$this->db->where('p.is_captain','Y');
		$this->db->group_by('r.item_code');
		$this->db->order_by('r.total_mark','DESC');
		$this->db->order_by('r.item_code');
		$details	=	$this->db->get();
		return  $details->result_array();
	
	}
	
	function fetch_festname($festid)
		{   
			$this->db->where('fm.fest_id',$festid);
			$this->db->select('fm.fest_name');
			$this->db->from('festival_master AS fm');
			$details	=	$this->db->get();
			return  $details->result_array();
		}
		
	
	
	function timeoffest_count($itemcode)
	{  
		 $this->db->where('pi.item_code',$itemcode);
		 $this->db->select('count(pi.item_code) as picount');
		 $this->db->from('participant_item_details AS pi');
		 $this->db->where('pi.is_captain','Y');
	     $details	=	$this->db->get();	
         return  $details->result_array();
	}
	
	function timeoffest_result_absentee($itemcode)
	{   
		$this->db->where('ab.item_code',$itemcode);
		$this->db->select('ab.participent_id_csv ');
		$this->db->from('item_absentee_master AS ab');
		
		$details	=	$this->db->get();
		if($details->num_rows() > 0)
		{
			$absentee   = $details->result_array();
			return $absentee[0]['participent_id_csv'];
		}
		return '';
	
	    
	}
	
	function fetch_fairname($fairid)
		{   
			$this->db->where('sm.fairId',$fairid);
			$this->db->select('sm.fairName');
			$this->db->from('science_master AS sm');
			$details	=	$this->db->get();
			return  $details->result_array();
		}
		
	function timeoffest_result_absentee_all($festival,$fair)
	{   $this->db->where("pi.participant_id NOT IN (select   participant_id from  result_master AS rs where  pi.item_code=rs.item_code ) AND fm.fest_id ='$festival' AND sm.fairId ='$fair'");
		$this->db->select('pi.participant_id,fm.fest_id,pi.item_code');
		$this->db->from('participant_item_details AS pi,festival_master AS fm,science_master As sm');
		 $this->db->order_by('pi.item_code');
		$details	=	$this->db->get();
		return  $details->result_array();
	}
	
	function fetch_fest_all_result($festival,$fair)
	{  
		$this->db->where('fm.fest_id',$festival);
		$this->db->where('sc.fairId',$fair);
		$this->db->select('rs.item_code,Sd.ground_name,rs.code_no,rs.marks,rs.total_mark,rs.percentage,rs.grade,sp.is_publish,pi.spo_id,   rs.point,rs.rank,im.item_name,sm.school_name,pi.participant_name,rs.participant_id,si.start_time,fm.fest_id,fm.fest_name,si.no_of_participant,si.no_of_judges');
		$this->db->from('result_master AS rs');
		$this->db->join('item_master AS im','im.item_code = rs.item_code');
		$this->db->join('school_master AS sm','sm.school_code = rs.school_code');
		$this->db->join('participant_item_details AS pi','pi.participant_id = rs.participant_id AND pi.item_code = rs.item_code');
		$this->db->join('special_order_master AS sp',"sp.spo_id = pi.spo_id AND sp.is_publish = 'N'",'LEFT');
		$this->db->join('ground_item_master AS si','si.item_code = rs.item_code');
		$this->db->join('ground_master AS Sd','si.ground_id = Sd.ground_id');
		$this->db->join('festival_master AS fm','fm.fest_id = im.fest_id');
		$this->db->join('science_master AS sc','sc.fairId = im.fairId');
		$this->db->where("rs.is_finish ='Y'");
		$this->db->group_by('rs.item_code');
		$this->db->group_by('rs.participant_id');
		$this->db->order_by('rs.item_code');
		$this->db->order_by('rs.total_mark','DESC');
		$details	=	$this->db->get();
		return  $details->result_array();
	}
	
	function timeoffest_result($itemcode)
	{  
			$this->db->where('rs.item_code',$itemcode);
			$this->db->select('rs.item_code,Sd.ground_name,rs.code_no,rs.marks,rs.total_mark,rs.percentage,rs.grade,rs.point,rs.rank,im.item_name,sm.school_name,sm.school_code,pi.participant_name,rs.participant_id,si.start_time,sp.is_publish,pi.spo_id,si.no_of_judges,fm.fest_name,rs.is_taken');
			$this->db->from('result_master AS rs');
			$this->db->join('item_master AS im','im.item_code = rs.item_code');
			$this->db->join('school_master AS sm','sm.school_code = rs.school_code');
			$this->db->join('participant_item_details AS pi',"pi.participant_id = rs.participant_id AND pi.item_code = rs.item_code and pi.is_captain='Y'");
			$this->db->join('special_order_master AS sp',"sp.spo_id = pi.spo_id AND sp.is_publish = 'N'",'LEFT');
			$this->db->join('ground_item_master AS si','si.item_code = rs.item_code');
			$this->db->join('ground_master AS Sd','si.ground_id = Sd.ground_id');
			$this->db->join('festival_master AS fm','fm.fest_id = im.fest_id');
			$this->db->where("rs.is_finish ='Y'");
			$this->db->group_by('rs.item_code');
			$this->db->group_by('rs.participant_id');
			$this->db->order_by('rs.total_mark','DESC');
			$details	=	$this->db->get();
			return  $details->result_array();
	}
	
}
?>