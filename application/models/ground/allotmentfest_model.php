<?php

class Allotmentfest_Model extends CI_Model{

	function Allotmentfest_Model()
	{
		parent::__construct();
	}
	
	function save_allotment ($item_code) 
	{
		$si_id			=	$this->save_ground_item_details($item_code);
		//$cluster_id		=	$this->save_cluster_details($si_id,$item_code);	
	}
	
	function save_ground_item_details ($item_code)
	{//echo '<br><br><br>fffffffff';
		$ground_id					=	$this->input->post('cmbGround'.$item_code);
		$item_code					=	($item_code>0)?$item_code:$this->input->post('hidItemId');
		$itemlength = strlen($item_code);
		//echo '<br><br><br>eee'.$item_code;
		if($itemlength==5)
		{
		$this->db->where('exb_flag','Y');
		$item_master				=	$this->db->get('item_master');
		$item						=	$item_master->result_array();
		
		$no_of_participant			=	1;	
		}
		else
		{
	
		$this->db->where('item_code',$item_code);
		$item_master				=	$this->db->get('item_master');
		$item						=	$item_master->result_array();
		
		$no_of_participant			=	$this->input->post('hidMaxPartcipants'.$item_code);	
		}
		
		
		$item_time					=	$item[0]['max_time'];
		$time_type					=	$item[0]['time_type'];
		$off_stage					=	$item[0]['is_off_stage'];
		
		$start_time					=	$this->input->post('txtDate'.$item_code).' '.$this->input->post('txtHour'.$item_code).':'.$this->input->post('txtMin'.$item_code).':00';	
		
		$total_time_for_item	=	($time_type == 'S') ? ceil((int)$item_time / 60) : (int)$item_time;	
		if ($off_stage)
		{
			$total_time_in_minutes	= 	(int)$total_time_for_item ;	
		}
		else
		{
			$total_time_in_minutes	= 	(int)$total_time_for_item * $no_of_participant;	
		}
		$timestamp = strtotime(date("Y-m-d H:i:s", strtotime($start_time)) . " + ".$total_time_in_minutes." mins");  
		$end_time = date('Y-m-d H:i:s', $timestamp);  
		
		//$this->db->where('stage_id',$stage_id);
		//$this->db->where("('".$start_time."' BETWEEN start_time AND end_time) OR ('".$end_time."' BETWEEN start_time AND end_time)");
		//$cnt_stage_exist	=	$this->db->count_all_results('cluster_master');
		
		$data['ground_id']			=	$ground_id;
		$data['item_code']			=	$item_code;
		$data['start_time']			=	$start_time;
		//$data['no_of_cluster']		=	$this->input->post('cmbNoOfCluster'.$item_code);
		$data['no_of_judges']		=	$this->input->post('cmbNoOfJudges'.$item_code);
		$data['no_of_participant']	=	$no_of_participant;
		$data['item_time']			=	$item_time;
		$data['time_type']			=	$time_type;
		$this->db->insert('ground_item_master', $data);
		$si_id 	=	$this->db->insert_id();
		return $si_id;
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
	
	
	function update_allotment ($fest_id)
	{
	//echo '<br><br><br>';
	//print_r($_POST);
	if($_POST['cmbWrkexpType']==2)
	{
	if(@$_POST['cmbWrkexpType'] == 2) {
			$limit	=	$this->exhibition_cate(4,$fest_id);
	    }		
		$this->db->select('PID.school_code,PID.school_code as cpt,SD.school_code as item_code,SD.school_name as item_name,SD.school_name,GIM.start_time,GIM.ground_id,GIM.no_of_judges,GM.ground_name,GM.ground_desc');
		$this->db->from('participant_item_details AS PID');
		$this->db->join('school_master AS SD','PID.school_code = SD.school_code');
		$this->db->join('ground_item_master AS GIM ','GIM.item_code = PID.school_code','LEFT');
		$this->db->join('ground_master AS GM ','GM.ground_id = GIM.ground_id','LEFT');
		if( @$_POST['cmbWrkexpType'] == 2) {		      
			$this->db->join('school_details AS S',"SD.school_code = S.school_code AND ".$limit."");			
			$this->db->where('PID.fest_id','0'); 
		}		
		
		$this->db->where('PID.fairId',4);
		$this->db->group_by('PID.school_code');
		$item_master		=	$this->db->get();
	
	}
	else
	{
		$this->db->where('fest_id',$fest_id);
		$item_master		=	$this->db->get('item_master');
		}
		foreach($item_master->result_array() as $item)
		{
			$item_code		=	$item['item_code'];
			if ($this->input->post('txtDate'.$item_code) and $this->is_item_to_be_ground_allot($item_code))
			{
				$this->db->where('item_code', $item_code);
				$this->db->delete('ground_item_master');
				
			//	$this->db->where('item_code', $item_code);
			//	$this->db->delete('cluster_master');
				
			//	$this->db->where('item_code', $item_code);
			//	$this->db->delete('cluster_participant_details');
				$this->save_allotment($item_code);
			}
			
			
			
		}
		return;
	}
	
	function is_item_to_be_ground_allot($item_code)
	{
		$this->db->where('item_code',$item_code);
		$ground_item_master		=	$this->db->get('ground_item_master');
		if ($ground_item_master->num_rows() > 0)
		{
			$ground_item		=	$ground_item_master->result_array();
			$ground_id			=	$ground_item[0]['ground_id'];
			$start_time			=	$ground_item[0]['start_time'];
		  //$no_of_cluster		=	$ground_item[0]['no_of_cluster'];
			$no_of_participant	=	$ground_item[0]['no_of_participant'];
			$no_of_judges		=	$ground_item[0]['no_of_judges'];
			
			$start_time_fest	=	$this->input->post('txtDate'.$item_code).' '.$this->input->post('txtHour'.$item_code).':'.$this->input->post('txtMin'.$item_code).':00';
			if ($start_time != $start_time_fest || $ground_id != $this->input->post('cmbGround'.$item_code)  || $no_of_judges != $this->input->post('cmbNoOfJudges'.$item_code) || $no_of_participant != $this->input->post('hidMaxPartcipants'.$item_code) )
			{
				return true;
			}
			else
			{
				return false;
			}
			
		}
		else
		{
			return true;
		}
	}
	

	
}



?>