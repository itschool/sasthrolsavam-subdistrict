<?php

class Allotment_Model extends CI_Model{

	function Allotment_Model()
	{
		parent::__construct();
	}
	
	
	function get_item_details($item_id)
	{
	
		$item_id	=	($item_id != '') ? $item_id : $this->input->post('cmbItemType');
		
		$itemlength = strlen($item_id);
		if($itemlength==5)
		{
		$this->db->where('exb_flag', 'Y' );
		
		}
		else
		{
		$this->db->where('item_code', $item_id );}
		$this->db->select('item_code, item_name, max_time, time_type, item_type, is_off_stage');
		$this->db->from('item_master');
		$result	=	$this->db->get();
		$result =	$result->result_array();
		
		if(count($result) > 0)
		{
			if($result[0]['item_type'] == 'G')
			{
				$this->db->where('is_captain', 'Y');
			}
			$this->db->where('item_type != "P"');
			$this->db->where('item_code', $item_id);
			$this->db->select('COUNT(participant_id) as count');
			$this->db->from('participant_item_details');
			$result2	=	$this->db->get();
			$result2 =	$result2->result_array();
			
			if(count($result2) > 0)
			{
			//echo '<br><br><br>';
				$result[0]['total_participants'] = $result2[0]['count'];
				
				$time	=	($result[0]['time_type'] == 'S') ? ceil((int)$result[0]['max_time'] / 60) : (int)$result[0]['max_time'];
				
				if ($result[0]['is_off_stage'] == 'Y')
				{
					$result[0]['total_time']	=	(int)$time;
				}
				else
				{
					$result[0]['total_time']	=	(int)$time * (int)$result2[0]['count'];
				}
			
			}
			
		}
		else
		{
			return;
		}
		return $result;
	}
	
	function get_grounds()
	{
		$this->db->from('ground_master');
		$this->db->order_by('ground_name', 'ASC');
		$this->db->select('*');
		$result		=	$this->db->get(); 
		return $result->result_array();
	}
	function save_allotment () 
	{
		$si_id			=	$this->save_ground_item_details();
		//$cluster_id		=	$this->save_cluster_details($si_id);	
	}
	
	function save_ground_item_details ()
	{
	//echo '<br><br><br>';
	//print_r($_POST);
		$ground_id					=	$this->input->post('cmbGround');
		$item_code					=	$this->input->post('cmbItemType');
		$itemlength = strlen($this->input->post('cmbItemType'));
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
		
		$no_of_participant			=	$this->input->post('hidMaxPartcipants');	
		}
		
		//echo '<br><br><br>';
		//print_r($item);
		$item_time					=	@$item[0]['max_time'];
		$time_type					=	@$item[0]['time_type'];
		$off_stage					=	@$item[0]['is_off_stage'];
		
		$start_time					=	$this->input->post('txtDate').' '.$this->input->post('txtHour').':'.$this->input->post('txtMin').':00';	
		$date = date($start_time);  
		$total_time_for_item	=	($time_type == 'S') ? ceil((int)$item_time / 60) : (int)$item_time;	
		if ($off_stage)
		{
			$total_time_in_minutes	= 	(int)$total_time_for_item ;	
		}
		else
		{
			$total_time_in_minutes	= 	(int)$total_time_for_item * $no_of_participant;	
		}
		$timestamp = strtotime(date("Y-m-d H:i:s", strtotime($date)) . " + ".$total_time_in_minutes." mins");  
		$end_time = date('Y-m-d H:i:s', $timestamp);  
		
		//$this->db->where('ground_id',$ground_id);
		//$this->db->where("('".$start_time."' BETWEEN start_time AND end_time) OR ('".$end_time."' BETWEEN start_time AND end_time)");
		//	$cnt_stage_exist	=	$this->db->count_all_results('cluster_master');
		
		$data['ground_id']			=	$ground_id;
		$data['item_code']			=	$item_code;
		$data['start_time']			=	$start_time;
		$data['end_time']			=	$end_time;
	  //$data['no_of_cluster']		=	$this->input->post('cmbNoOfCluster');
		$data['no_of_judges']		=	$this->input->post('cmbNoOfJudges');
		$data['no_of_participant']	=	$no_of_participant;
		$data['item_time']			=	$item_time;
		$data['time_type']			=	$time_type;
		$this->db->insert('ground_item_master', $data);
		$si_id 	=	$this->db->insert_id();
		return $si_id;
	}
	
	
	function get_alloted_item_details ($item_code='')
	{
		$itemlength = strlen($item_code);
		//print_r($_POST);
		$item_code	=	($item_code != '') ? $item_code : $this->input->post('cmbItemType');
		$this->db->select('PDT.item_code,  PDT.participant_id, PDT.school_code, IM.ground_id,IM.start_time,IM.end_time, IM.no_of_judges');
		$this->db->from('ground_item_master IM');
		//$this->db->join('cluster_master CM', 'CM.cluster_id = PD.cluster_id', 'INNER');
		//$this->db->join('stage_item_master IM', 'CM.si_id = IM.si_id', 'INNER');
		if($itemlength==5)$this->db->join('participant_item_details PDT', 'PDT.school_code = IM.item_code and PDT.exhibition=2', 'INNER');
		else $this->db->join('participant_item_details PDT', 'PDT.item_code = IM.item_code', 'INNER');
		$this->db->where('IM.item_code', $item_code);
		
		if($itemlength==5)$this->db->group_by('PDT.school_code');
		else $this->db->order_by('PDT.participant_id');
		$result	=	$this->db->get();
		return $result->result_array();
	}
	
	
	function update_allotment ()
	{
		
			$this->db->where('item_code', $this->input->post('cmbItemType'));
			$this->db->delete('ground_item_master');
			
			//$this->db->where('item_code', $this->input->post('hidItemId'));
			//$this->db->delete('cluster_master');
			
			//$this->db->where('item_code', $this->input->post('hidItemId'));
			//$this->db->delete('cluster_participant_details');
			$this->save_allotment();
			return;
		
		
	}
	
}



?>