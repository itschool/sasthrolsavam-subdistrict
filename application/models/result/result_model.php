<?php
class Result_Model extends CI_Model{
	function Result_Model()
	{
		parent::__construct();
	}
	
	function get_item_details_result($item_code)
	{
		//echo "<br />".$item_code;
		$this->db->select('SM.*, IM.*,PD.*, (SELECT COUNT(PID.participant_id)
						FROM participant_item_details PID WHERE PID.item_code='.$item_code.'  AND PID.is_captain=\'Y\' AND PID.is_absent = 0 AND PID.code_confirmed=1) AS total_participants ', FALSE);
		$this->db->from('item_master AS IM');
		$this->db->join('ground_item_master AS SM','IM.item_code = SM.item_code');
		$this->db->join('participant_item_details AS PD','IM.item_code = PD.item_code');
		$this->db->where('IM.item_code',$item_code);
		$item_details		=	$this->db->get();
		if ($item_details->num_rows() > 0)
		{
			return $item_details->result_array();
		}
		return false;
	}
	
	function get_item_details_result_exb($festid)
	{
		//echo "<br />".$festid;
		$cmbFairType	=	4;
		$limit	=	$this->exhibition_category($cmbFairType,$festid);
		$this->db->select('PD.* ', FALSE);
		$this->db->from('school_details AS S');	
		//$this->db->join('ground_item_master AS SM','SM.item_code = PD.item_code');
		$this->db->join('participant_item_details AS PD','S.school_code = PD.school_code AND PD.fest_id=0 AND PD.is_captain=\'Y\' AND PD.is_absent = 0 AND PD.code_confirmed=1');				
		$this->db->where($limit); 
		$item_details		=	$this->db->get();
		if ($item_details->num_rows() > 0)
		{
			return $item_details->result_array();
		}
		return false;
	}
	
	
	function get_bulk_participant_details_result($item_code)
	{
		//echo "<br />".$item_code;
		$this->db->select('PID.*');
		$this->db->from('item_master AS IM');
		$this->db->join('ground_item_master AS SM',"IM.item_code = SM.item_code");
		$this->db->join('participant_item_details AS PID',"IM.item_code = PID.item_code");
		$this->db->where('PID.is_captain','Y');
		$this->db->where('PID.is_absent','0');
		$this->db->where('PID.code_confirmed','1');
		$this->db->where('IM.item_code',$item_code);
		//$this->db->order_by('PID.codeNo','ASC');
		$this->db->order_by('PID.code_order');	
		$this->db->order_by('PID.spo_id');	
		$this->db->order_by('PID.code_confirmed','desc'); 
		$this->db->order_by('PID.school_code');	
		$this->db->order_by('PID.team_no');		
		$this->db->order_by('PID.is_captain','desc');		
		$this->db->order_by('PID.participant_id');
		$item_details		=	$this->db->get();
		if ($item_details->num_rows() > 0)
		{
			return $item_details->result_array();
		}
		return false;
	}
	
	
	function get_bulk_participant_details_result_exb($festid)
	{
		//echo "<br />".$festid;
		$cmbFairType	=	4;
		$limit	=	$this->exhibition_category($cmbFairType,$festid);
		$this->db->select('PID.*');
		$this->db->from('school_details AS S');		
		$this->db->join('participant_item_details AS PID',"S.school_code = PID.school_code");
//$this->db->join('ground_item_master AS SM',"SM.item_code = PID.item_code");
		$this->db->where('PID.is_captain','Y');
		$this->db->where('PID.is_absent','0');
		$this->db->where('PID.fest_id','0');
		$this->db->where('PID.code_confirmed','1');
		$this->db->where($limit);
		$this->db->order_by('PID.codeNo','ASC');
		$item_details		=	$this->db->get();
		if ($item_details->num_rows() > 0)
		{
			return $item_details->result_array();
		}
		return false;
	}
	
	
	
	function get_item_result_list($item_code)
	{
		$this->db->where('item_code',$item_code);
		$cnt_result_publish		=	$this->db->count_all_results('result_publish');
		
		$this->db->select ('rm.*, spd.is_withheld');
		$this->db->from ('result_master rm');
		$this->db->join('school_point_details spd', 'spd.item_code=rm.item_code AND spd.participant_id=rm.participant_id', 'left');
		$this->db->where('rm.item_code',$item_code);
		//$this->db->order_by('rank','ASC');
		//$this->db->order_by('rm.total_mark','DESC');
		if (@$cnt_result_publish)
		{
			$this->db->order_by('rm.total_mark','DESC');
		}
		else
		{
			$this->db->order_by('rm.rm_id','ASC');
		}
		$result_master		=	$this->db->get();
		
		$result_array		=	array();
		if ($result_master->num_rows() > 0)
		{
			$k	=	0;
			foreach($result_master->result_array() as $result_list)
			{
				$result_array[$k]['rm_id']			=	$result_list['rm_id'];
				$result_array[$k]['participant_id']	=	$result_list['participant_id'];
				$result_array[$k]['code_no']		=	$result_list['code_no'];
				$result_array[$k]['total_mark']		=	$result_list['total_mark'];
				$result_array[$k]['percentage']		=	$result_list['percentage'];
				$result_array[$k]['grade']			=	$result_list['grade'];
				$result_array[$k]['point']			=	$result_list['point'];
				$result_array[$k]['rank']			=	$result_list['rank'];
				$result_array[$k]['marks']			=	$result_list['marks'];
				$result_array[$k]['school_code']	=	$result_list['school_code'];
				$result_array[$k]['is_withheld']	=	$result_list['is_withheld'];
				/*$this->db->where('item_code',$item_code);
				$this->db->where('participant_id',$result_list['participant_id']);
				$this->db->where('code_no',$result_list['code_no']);
				$result_entry		=	$this->db->get('result_entry');
				
				$result_array[$k]['mark'][$result_list['participant_id']]		=	array();
				if ($result_entry->num_rows() > 0)
				{
					$j	=	0;
					foreach($result_entry->result_array() as $result_entry)
					{
						$result_array[$k]['mark'][$result_list['participant_id']][$j]	=	$result_entry['mark'];
						$j++;
					}
					
				}*/
				$k++;
			}
		}
		
		return $result_array;
	}
	
	
	function get_item_result_list_bulk_exb($festid,$participant_item_dtls_id=0)
	{
		$cmbFairType	=	4;
		
		$limit	=	$this->exhibition_category($cmbFairType,$festid);
				
		$this->db->from('result_publish AS P');
		$this->db->join('school_details AS S',"S.school_code = P.school_code AND $limit");
		$this->db->where('P.school_code = P.item_code');	
		$cnt_result_publish		=	$this->db->count_all_results('result_publish');
		
		
		$this->db->select ('rm.*, spd.is_withheld');
		$this->db->from ('result_master rm');
		$this->db->join('school_point_details spd', 'spd.school_code=rm.school_code AND spd.participant_id=rm.participant_id', 'left');
		$this->db->join('school_details AS S',"S.school_code = rm.school_code AND $limit");
		$this->db->where('rm.fairId','4');
		$this->db->where('rm.fest_id',$festid);
		$this->db->where('length(rm.item_code) >3');
			
		if($participant_item_dtls_id > 0)
		$this->db->where('rm.participant_item_dtls_id',$participant_item_dtls_id);
		//$this->db->order_by('rank','ASC');
		//$this->db->order_by('rm.total_mark','DESC');
		if (@$cnt_result_publish)
		{
			$this->db->order_by('rm.total_mark','DESC');
		}
		else
		{
			$this->db->order_by('rm.code_no','ASC');
		}
		$result_master		=	$this->db->get();
		//print_r($result_master);echo '<br>';
		$result_array		=	array();
		if ($result_master->num_rows() > 0)
		{
			$k	=	0;
			foreach($result_master->result_array() as $result_list)
			{
				$result_array[$k]['rm_id']			=	$result_list['rm_id'];
				$result_array[$k]['participant_id']	=	$result_list['participant_id'];
				$result_array[$k]['code_no']		=	$result_list['code_no'];
				$result_array[$k]['total_mark']		=	$result_list['total_mark'];
				$result_array[$k]['percentage']		=	$result_list['percentage'];
				$result_array[$k]['grade']			=	$result_list['grade'];
				$result_array[$k]['point']			=	$result_list['point'];
				$result_array[$k]['rank']			=	$result_list['rank'];
				$result_array[$k]['marks']			=	$result_list['marks'];
				$result_array[$k]['school_code']	=	$result_list['school_code'];
				$result_array[$k]['is_withheld']	=	$result_list['is_withheld'];
				/*$this->db->where('item_code',$item_code);
				$this->db->where('participant_id',$result_list['participant_id']);
				$this->db->where('code_no',$result_list['code_no']);
				$result_entry		=	$this->db->get('result_entry');
				
				$result_array[$k]['mark'][$result_list['participant_id']]		=	array();
				if ($result_entry->num_rows() > 0)
				{
					$j	=	0;
					foreach($result_entry->result_array() as $result_entry)
					{
						$result_array[$k]['mark'][$result_list['participant_id']][$j]	=	$result_entry['mark'];
						$j++;
					}
					
				}*/
				$k++;
			}
		}
		
		return $result_array;
	}
	
	
	function get_item_result_list_bulk($item_code,$participant_item_dtls_id=0)
	{
		$this->db->where('item_code',$item_code);
		$cnt_result_publish		=	$this->db->count_all_results('result_publish');
		
		$this->db->select ('rm.*, spd.is_withheld');
		$this->db->from ('result_master rm');
		$this->db->join('school_point_details spd', 'spd.item_code=rm.item_code AND spd.participant_id=rm.participant_id', 'left');
		$this->db->where('rm.item_code',$item_code);
		if($participant_item_dtls_id > 0)
		$this->db->where('rm.participant_item_dtls_id',$participant_item_dtls_id);
		//$this->db->order_by('rank','ASC');
		//$this->db->order_by('rm.total_mark','DESC');
		if (@$cnt_result_publish)
		{
			$this->db->order_by('rm.total_mark','DESC');
		}
		else
		{
			$this->db->order_by('rm.code_no','ASC');
		}
		$result_master		=	$this->db->get();
		//print_r($result_master);echo '<br>';
		$result_array		=	array();
		if ($result_master->num_rows() > 0)
		{
			$k	=	0;
			foreach($result_master->result_array() as $result_list)
			{
				$result_array[$k]['rm_id']			=	$result_list['rm_id'];
				$result_array[$k]['participant_id']	=	$result_list['participant_id'];
				$result_array[$k]['code_no']		=	$result_list['code_no'];
				$result_array[$k]['total_mark']		=	$result_list['total_mark'];
				$result_array[$k]['percentage']		=	$result_list['percentage'];
				$result_array[$k]['grade']			=	$result_list['grade'];
				$result_array[$k]['point']			=	$result_list['point'];
				$result_array[$k]['rank']			=	$result_list['rank'];
				$result_array[$k]['marks']			=	$result_list['marks'];
				$result_array[$k]['school_code']	=	$result_list['school_code'];
				$result_array[$k]['is_withheld']	=	$result_list['is_withheld'];
				/*$this->db->where('item_code',$item_code);
				$this->db->where('participant_id',$result_list['participant_id']);
				$this->db->where('code_no',$result_list['code_no']);
				$result_entry		=	$this->db->get('result_entry');
				
				$result_array[$k]['mark'][$result_list['participant_id']]		=	array();
				if ($result_entry->num_rows() > 0)
				{
					$j	=	0;
					foreach($result_entry->result_array() as $result_entry)
					{
						$result_array[$k]['mark'][$result_list['participant_id']][$j]	=	$result_entry['mark'];
						$j++;
					}
					
				}*/
				$k++;
			}
		}
		
		return $result_array;
	}
	
	
	
	function check_confirm_item ($item_code)
	{
		if(!empty($item_code))
		{
			$this->db->select ('item_code');
			$this->db->where ('item_code', $item_code);
			$this->db->where ('is_finish', 'N');
			$result	=	$this->db->get('result_master');
			$result	=	$result->result_array();
			if (is_array($result) && count($result) > 0) return TRUE;
			else return FALSE;
		}
	}
	
	function check_confirm_item_exb($festid)
	{
		if(!empty($festid))
		{
			$cmbFairType	=	4;
			$limit	=	$this->exhibition_category($cmbFairType,$festid);
			$this->db->select('RM.item_code');
			$this->db->from('result_master RM');			
			$this->db->join('school_details AS S',"S.school_code = RM.school_code AND $limit");
			$this->db->where ('RM.fairId','4');
			$this->db->where ('RM.fest_id',$festid);
			$this->db->where('length(RM.item_code) > 3');
			$this->db->where ('RM.is_finish', 'N');
			$result	=	$this->db->get('result_master');
			$result	=	$result->result_array();
			if (is_array($result) && count($result) > 0) return TRUE;
			else return FALSE;
		}
	}
	
	
	function get_absentee_list ($item_code)
	{
		$this->db->select('participent_id_csv');
		$this->db->where('item_code', $item_code);
		$result	=	$this->db->get('item_absentee_master');
		$result	=	$result->result_array();
		if(is_array($result) && count($result) > 0)
		{
			return $result[0]['participent_id_csv'];
		}
		return FALSE;
	}
	function get_absentee_list_exb($festid)
	{		
		$cmbFairType	=	4;
		$limit	=	$this->exhibition_category($cmbFairType,$festid);
		$this->db->select('AB.participent_id_csv');
		$this->db->from('item_absentee_master AS AB');		
		$this->db->join('school_details AS S',"S.school_code = AB.item_code AND $limit");
		$this->db->join('result_master AS RM',"RM.school_code = S.school_code AND RM.fest_id	='$festid'");
		$this->db->where('length(AB.item_code) > 3');
		$result	=	$this->db->get('item_absentee_master');
		$result	=	$result->result_array();
		if(is_array($result) && count($result) > 0)
		{
			return $result[0]['participent_id_csv'];
		}
		return FALSE;
	}
	
	function save_result_details () {
		$error_array	=	array();
		//echo "<br /><br />helloooo";
		$this->db->where('PD.participant_id', $this->input->post('txt_reg_no'));
		$this->db->where('PD.item_code', $this->input->post('hidItemId'));
		$this->db->where('PD.is_captain','Y');
		$this->db->select('PD.*');
		$result					=	$this->db->get('participant_item_details PD');
		$participant_details	=	$result->result_array();
		//var_dump($participant_details);
		if(count($participant_details) > 0) {
			$percentage				=	round((100 * (int)$this->input->post('totalMark') ) / ((int)$this->input->post('hidNoJudge') * 100),2) ;
			$grade					=	'';
			$point					=	'';
			//echo "<br />".round($percentage);
			if(round($percentage) >= 50 && round($percentage) <=59) {
				$grade					=	'C';
				$point					=	'1';
			} else if(round($percentage) >= 60 && round($percentage) <=69) {
				$grade					=	'B';
				$point					=	'3';
			} else if(round($percentage) > 69) {
				$grade					=	'A';
				$point					=	'5';
			}
			$marks		=	'';
			$total_mark	=	0;
			for($i = 1; $i <= $this->input->post('hidNoJudge'); $i++ ) {
				$total_mark	+=	$_POST['mark_'.$i];
				$marks		.=	$_POST['mark_'.$i].'#$#';	
			}
			if ($total_mark != $this->input->post('totalMark'))
			{
				$error_array[]	=	'Total Mark not matched';
				$return_array['error_array']	=	$error_array;
				return $return_array;
			}
			$data['fairId']			=	$participant_details[0]['fairId'];
			$data['fest_id']		=	$participant_details[0]['fest_id'];
			$data['item_code']		=	$participant_details[0]['item_code'];
			$data['participant_item_dtls_id']	=	$participant_details[0]['pi_id'];
			$data['participant_id']	=	$participant_details[0]['participant_id'];
			$data['school_code']	=	$participant_details[0]['school_code'];
			$data['admn_no']		=	$participant_details[0]['admn_no'];
			$data['code_no']		=	$this->input->post('txt_code_no');
			$data['total_mark']		=	$this->input->post('totalMark');
			$data['percentage']		=	$percentage;
			$data['grade']			=	$grade;
			if($data['fairId'] == 4){
				$data['point']			=	'';	}
			else{
			$data['point']			=	$point; }
			$data['marks']			=	$marks;
			
			/* check if the result is already entered */
			$this->db->where('item_code', $participant_details[0]['item_code']);
			$this->db->where('participant_id', $participant_details[0]['participant_id']);
			$this->db->where('school_code', $participant_details[0]['school_code']);
			$result_master	=	$this->db->get('result_master');
			$result_master	=	$result_master->result_array();
			
			if(count($result_master) > 0){
				$this->db->where('rm_id', $result_master[0]['rm_id']);
				$this->db->update('result_master', $data);
			} else {
				$this->db->insert('result_master', $data);
			}
			
			//$this->update_rank();
			
			
			
			/*if(count($result_master) > 0){
				$this->db->where('rm_id', $result_master[0]['rm_id']);
				$this->db->update('result_master', $data);
				$this->db->where('rm_id', $result_master[0]['rm_id']);
				$this->db->delete('result_entry');
				
				$insert_id	=	$result_master[0]['rm_id'];
			} else {
				$this->db->insert('result_master', $data);
				$insert_id	=	$this->db->insert_id();
			}
			for($i = 1; $i <= $this->input->post('hidNoJudge'); $i++ ) {
				$marks						=	array();
				$marks['rm_id']				=	$insert_id;	
				$marks['item_code']			=	$participant_details[0]['item_code'];	
				$marks['participant_id']	=	$participant_details[0]['participant_id'];	
				$marks['code_no']			=	$this->input->post('txt_code_no');	
				$marks['mark']				=	$_POST['mark_'.$i];	
				$this->db->insert('result_entry', $marks);
			}*/	
		} else {
			$error_array[]	=	'Register number invalid';
		}
		$return_array['error_array']	=	$error_array;
		return $return_array;
	}
	
	
	function save_bulk_result_details () {
	
		$error_array	=	array();
		
		$tot_parti	=	$this->input->post('hidPartitot');	
		$tot_judge	=	$this->input->post('hidNoJudge');	
		$itemcode	=	$this->input->post('hidItemId');
		$item_code_array	=	array('111','112','120','121','122','123','131','132','138','139','146','147','163','164','181','182','194','204','205','206','214');		
		if(@$tot_parti > 0)
		{		
			
			for($i=1;$i<=$tot_parti;$i++)
			{
				
				$tot_markid		=	"totalMark_".$i;
				$regid			=	'hidPartiId'.$i;				
				$tot_mark		=	$this->input->post($tot_markid);
				$regno			=	$this->input->post($regid);	
				//echo "<br /><br /><br />mark-->".$tot_mark."--id--->".$regno;
				$this->db->where('PD.is_captain','Y');
				$this->db->where('PD.participant_id', $regno);
				if($itemcode != 'exb'){
					$this->db->where('PD.item_code', $itemcode);
				}else{
					$cmbFairType	=	4;
					
					$festid	=	$this->input->post('hidFestid');
					//echo "<br /><br />helloooo".$festid;	
					$limit	=	$this->exhibition_category($cmbFairType,$festid);
					$item_marks	=	($festid == 1 || $festid == 2) ? 2000 : 2500;
					$this->db->where('PD.fest_id', '0');
				    $this->db->join('school_details AS S',"S.school_code = PD.school_code AND $limit");
				}
				
				
				$this->db->select('PD.*');
				$result					=	$this->db->get('participant_item_details PD');
				$participant_details	=	$result->result_array();
				//var_dump($participant_details);
				if(count($participant_details) > 0) {		
				if($itemcode != 'exb'){
				$percentage		=	round((100 * (int)$tot_mark) / ((int)$tot_judge * 100),2) ;
				}
				else
				{
				  $percentage	=	round((100 * (int)$tot_mark) / ((int)$tot_judge * (int)$item_marks),2) ;
				}
				$grade					=	'';
				$point					=	'';
				//echo "<br />".round($percentage);
				if(round($percentage) >= 50 && round($percentage) <=59) {
					$grade					=	'C';
					$point					=	'1';
				} else if(round($percentage) >= 60 && round($percentage) <=69) {
					$grade					=	'B';
					$point					=	'3';
				} else if(round($percentage) > 69) {
					$grade					=	'A';
					$point					=	'5';
				}
				
			    $marks		=	'';
				$total_mark	=	0;
			
				if(in_array($itemcode,$item_code_array))
					{	$point					=	'';		}
			
			   
			   for($j=1;$j<=$tot_judge;$j++)
			   {
					$mark1_id	 =	"mark_".$j."_".$i;	
					$total_mark	+=	$this->input->post($mark1_id);
					$marks	    .=	$this->input->post($mark1_id).'#$#';		   
			   }
			   
			   //echo "<br />huuuuuuuuuuu".$total_mark."-----".$tot_mark;
			   if ($total_mark != $tot_mark)
				{
					$error_array[]	=	'Total Mark not matched for code No '.@$participant_details[0]['codeNo'];
					$return_array['error_array']	=	$error_array;
					return $return_array;
				}	
				
				
				$data['fairId']			=	$participant_details[0]['fairId'];
				
				$item_len				=	strlen($participant_details[0]['item_code']);
				if($itemcode != 'exb') {
					$data['fest_id']	=	$participant_details[0]['fest_id'];
					$data_item_code		=	$participant_details[0]['item_code'];
				}else{
					$data['fest_id']	=	$festid;
					$data_item_code		=	$participant_details[0]['school_code'];
				}
				$data['item_code']		=	$data_item_code;
				$data['participant_id']	=	$participant_details[0]['participant_id'];
				$data['participant_item_dtls_id']	=	$participant_details[0]['pi_id'];
				$data['school_code']	=	$participant_details[0]['school_code'];
				$data['admn_no']		=	$participant_details[0]['admn_no'];
				$code_no				=	$participant_details[0]['codeNo'];
				$prefixCode				=	$participant_details[0]['prefixCode'];
				$data['code_no']		=	$prefixCode."".$code_no;
				$data['total_mark']		=	$tot_mark;
				$data['percentage']		=	$percentage;
				$data['grade']			=	$grade;
				if($data['fairId'] == 4){
				$data['point']			=	'';	}
				else{
				$data['point']			=	$point; }
				$data['marks']			=	$marks;
				
				/* check if the result is already entered */
				$this->db->where('item_code', $data_item_code);
				$this->db->where('participant_id', $participant_details[0]['participant_id']);
				$this->db->where('school_code', $participant_details[0]['school_code']);
				$result_master	=	$this->db->get('result_master');
				$result_master	=	$result_master->result_array();
				
				if(count($result_master) > 0){
					//echo "<br /><br /><br />kkk";
					if($tot_mark == 0){
						$this->db->where('rm_id',$result_master[0]['rm_id']);
						$this->db->delete('result_master');
						 }
						 else
						 {
				
							$this->db->where('rm_id', $result_master[0]['rm_id']);
							$this->db->update('result_master', $data);
						 }
				} else {
					if($tot_mark > 0) {
						$this->db->insert('result_master', $data); }
				  }	   
			
			} //if(count($participant_details)
			
		} //for
		$return_array['error_array']	=	$error_array;
		return $return_array;
	 } //if(@$tot_parti > 0)	
} //function ends
	
	function get_selected_result_details () {
		$this->db->where('rm_id',$this->input->post('hidResultId'));
		$result_master		=	$this->db->get('result_master');
		$result_array		=	array();
		if ($result_master->num_rows() > 0)
		{
			$k	=	0;
			foreach($result_master->result_array() as $result_list)
			{
				$result_array[$k]['rm_id']			=	$result_list['rm_id'];
				$result_array[$k]['participant_id']	=	$result_list['participant_id'];
				$result_array[$k]['code_no']		=	$result_list['code_no'];
				$result_array[$k]['marks']			=	$result_list['marks'];
				$result_array[$k]['total_mark']		=	$result_list['total_mark'];
				$k++;
			}
			/*$k	=	0;
			foreach($result_master->result_array() as $result_list)
			{
				$result_array[$k]['rm_id']			=	$result_list['rm_id'];
				$result_array[$k]['participant_id']	=	$result_list['participant_id'];
				$result_array[$k]['code_no']		=	$result_list['code_no'];
				$result_array[$k]['total_mark']		=	$result_list['total_mark'];
	
				
				$this->db->where('rm_id',$this->input->post('hidResultId'));
				$result_entry		=	$this->db->get('result_entry');
				
				$result_array[$k]['mark'][$result_list['participant_id']]		=	array();
				if ($result_entry->num_rows() > 0)
				{
					$j	=	0;
					foreach($result_entry->result_array() as $result_entry)
					{
						$result_array[$k]['mark'][$result_list['participant_id']][$j]	=	$result_entry['mark'];
						$j++;
					}
					
				}
				$k++;
			}*/
		}
		
		return $result_array;
	}
	
	function delete_result () 
	{
//	echo '<br><br><br>';
//	print_r($_POST);
		$this->db->where('rm_id', $this->input->post('hidResultId'));
		$this->db->delete('result_master');
	}
	
	
	function set_confirm_result($item_code)
	{  		
		$this->db->trans_begin();
		if ($this->update_point_grade())
		{
			$this->db->where('item_code', $item_code);
			$this->db->delete('school_point_details');
			
			// get all participant (captain only), collect special order entry if any
			$this->db->select('RM.*, PID.spo_id, SOM.is_publish', FALSE);
			$this->db->from('result_master RM');
			$this->db->join("participant_item_details PID", "PID.participant_id=RM.participant_id AND PID.item_code=RM.item_code");
			$this->db->join("special_order_master SOM", "SOM.spo_id=PID.spo_id", "LEFT");
			$this->db->where('RM.item_code', $item_code);
			$this->db->where('PID.item_code', $item_code);
			$this->db->group_by('RM.participant_id,RM.item_code');
			
			$this->db->order_by('RM.school_code', 'DESC');
			$this->db->order_by('RM.total_mark', 'DESC');
			$this->db->order_by('PID.spo_id', 'ASC');
			$all_participant_master =	$this->db->get();
			$all_participant_master =	$all_participant_master->result_array();
			$school_point_array = array();
			
			// Inserting item point corresponding school. If participants of same school will store the point,  top score of the paricular school and 
			// the other point store in not_point feild. If any participant is comes with withheld (ie is_pubish is 'N' in special_order_table) will 
			// that participant point will store in not_point field.
			for ($i = 0; $i < count($all_participant_master); $i++)
			{
				$school_point_array['participant_id']	= $all_participant_master[$i]['participant_id'];
				$school_point_array['school_code'] 		= $all_participant_master[$i]['school_code'];
				$school_point_array['item_code'] 		= $all_participant_master[$i]['item_code'];
				
				if ($all_participant_master[$i]['is_publish'] == NULL || $all_participant_master[$i]['is_publish'] == 'Y')
				{
					if(isset($school_code) && $school_code == $all_participant_master[$i]['school_code'])
					{
						if ($all_participant_master[$i]['spo_id'] > 0)
						{
							$ishigherthaOriginal	=	$this->checkWetherconcidertograde($all_participant_master[$i]['participant_id'],$all_participant_master[$i]['item_code'],$all_participant_master[$i]['school_code'],$all_participant_master[$i]['total_mark'])	;
							//echo "<br /><br />pppppp---".$ishigherthaOriginal;
							
							if($ishigherthaOriginal	==	'eligibleformarks'){
							//echo "yes";
							$data_clear				=	array();
							$data_clear['grade']	=	$all_participant_master[$i]['grade'];
							$data_clear['point']	=	$all_participant_master[$i]['point'];
							$data_clear['rank']		=	$all_participant_master[$i]['rank'];
							$data_clear['is_taken']	=	'N';
													
							$this->db->where('participant_id',$all_participant_master[$i]['participant_id']);
							$this->db->where('item_code',$all_participant_master[$i]['item_code']);
							$this->db->update('result_master',$data_clear);
							continue;
						 }
							
						else{		
								//echo "no";			
								$data_clear				=	array();
								$data_clear['grade']	=	'';
								$data_clear['point']	=	'0';
								$data_clear['rank']		=	'0';
								$data_clear['is_taken']	=	'N';
								
								$this->db->where('participant_id',$all_participant_master[$i]['participant_id']);
							$this->db->where('item_code',$all_participant_master[$i]['item_code']);
							$this->db->update('result_master',$data_clear);
								continue;
							}			
							
							
						}
						else
						{
							$data_clear				=	array();
							$data_clear['is_taken']	=	'Y';
							$this->db->where('participant_id',$all_participant_master[$i]['participant_id']);
							$this->db->where('item_code',$all_participant_master[$i]['item_code']);
							$this->db->update('result_master',$data_clear);
							
							
							$school_point_array['point'] 		= 0;
							$school_point_array['not_point']	= $all_participant_master[$i]['point'];
							$school_point_array['spo_id'] 		= $all_participant_master[$i]['spo_id'];
						}
					}
					else
					{
						$school_point_array['point'] 		= $all_participant_master[$i]['point'];
						$school_point_array['not_point']	= 0;
						$school_point_array['spo_id'] 		= $all_participant_master[$i]['spo_id'];
						$school_code						= $all_participant_master[$i]['school_code'];
					}
					$school_point_array['is_withheld'] 	= 'N';
				}
				else if ($all_participant_master[$i]['is_publish'] == 'N')
				{
					if(isset($school_code) && $school_code == $all_participant_master[$i]['school_code'])
					{
						$data_clear				=	array();
						$data_clear['grade']	=	'';
						$data_clear['point']	=	'0';
						$data_clear['rank']		=	'0';
						$data_clear['is_taken']	=	'N';
						$this->db->where('participant_id',$all_participant_master[$i]['participant_id']);
						$this->db->where('item_code',$all_participant_master[$i]['item_code']);
						$this->db->update('result_master',$data_clear);
						continue;
					}
					else
					{
						$data_clear				=	array();
						$data_clear['is_taken']	=	'N';
						$this->db->where('participant_id',$all_participant_master[$i]['participant_id']);
						$this->db->where('item_code',$all_participant_master[$i]['item_code']);
						$this->db->update('result_master',$data_clear);
						
						$school_point_array['point'] 		= 0;
						$school_point_array['not_point']	= $all_participant_master[$i]['point'];
						$school_point_array['spo_id'] 		= $all_participant_master[$i]['spo_id'];
						$school_point_array['is_withheld'] 	= 'Y';
					}
				}
				if(!$this->db->insert('school_point_details', $school_point_array))
				{
					$this->db->trans_rollback();
					return FALSE;
				}
				$present_participant_id[$i]				= $all_participant_master[$i]['participant_id'];
			}
			
			// Change the status of data entry of pariculat item.
			$this->db->where('item_code', $item_code);
			if(!$this->db->update('result_master', array('is_finish' => 'Y')))
			{
				$this->db->trans_rollback();
				return FALSE;
			}
			else
			{
				if (!$this->update_rank())
				{
					$this->db->trans_rollback();
					return FALSE;
				}
				
				// Update the confirm date and time
				
				$this->db->select('item_code');
				$this->db->where('item_code',$item_code);
				$query = $this->db->get('result_time');
				$itemcode_query	=	$query->result_array();		
				//var_dump();
				if (is_array($itemcode_query) && count($itemcode_query))
				{
					$rank_time_array['is_finalized'] =	'Y';
					$rank_time_array['is_reset']	 =	1;
					$rank_time_array['confirm_date'] =	date("Y-m-d");
					$rank_time_array['confirm_time'] =	date("H:i:s a");
					if(!$this->db->update('result_time', $rank_time_array, array('item_code' => $item_code)))
					{
						$this->db->trans_rollback();
						return FALSE;
					}
				
				}
				else
				{				
					$this->db->select_max('result_no');
					$query = $this->db->get('result_time');
					foreach ($query->result() as $row)
					{
					   $result_max	    =	 $row->result_no;
					   $result_max++;
					}
					$rank_time_array['result_no']	 =	$result_max;
					$rank_time_array['item_code']	 =	$item_code;
					$rank_time_array['is_finalized'] =	'Y';
					$rank_time_array['confirm_date'] =	date("Y-m-d");
					$rank_time_array['confirm_time'] =	date("H:i:s");
					if(!$this->db->insert('result_time', $rank_time_array))
					{
						$this->db->trans_rollback();
						return FALSE;
					}
				}
				
				
				// Select the First Rank holdsers in particular item. If any rank holders then store the detail in  table 'result_publish' for
				// higher level competition (district level)
				$this->db->select('RM.*, SPD.is_withheld');
				$this->db->from('result_master RM');
				$this->db->where('RM.item_code', $item_code);
				$this->db->join('school_point_details SPD', 'SPD.participant_id=RM.participant_id AND SPD.item_code=RM.item_code');
				//$this->db->where('RM.rank', 1);
				$ranks=array(1,2);
				$this->db->where_in('RM.rank', $ranks);
				$result_publish_master =	$this->db->get();
				$result_publish_master =	$result_publish_master->result_array();	
				
				if (is_array($result_publish_master) && count($result_publish_master))
				{
					$this->db->where('item_code', $item_code);
					$this->db->delete('result_publish');
					foreach ($result_publish_master as $result_publish_master)
					{
						$publish_array = array();
						$publish_array['school_code'] 	= $result_publish_master['school_code'];
						$publish_array['item_code'] 	= $result_publish_master['item_code'];
						$publish_array['participant_id']= $result_publish_master['participant_id'];
						$publish_array['grade']			= $result_publish_master['grade'];
						$publish_array['is_withheld']	= $result_publish_master['is_withheld'];
						if(!$this->db->insert('result_publish', $publish_array))
						{
							$this->db->trans_rollback();
							return FALSE;
						}
					}
				}
					
				
				$item_absentee['participent_id_csv']	= $this->get_absentee_list_select ($item_code);
				$this->db->select('item_code');
				$this->db->where('item_code', $item_code);
				$check_absentee_id 		=	$this->db->get('item_absentee_master');
				$check_absentee_id 		=	$check_absentee_id->result_array();

				if (is_array ($check_absentee_id) && count($check_absentee_id) > 0)
				{
					if (!empty($item_absentee['participent_id_csv']))
					{
						if(!$this->db->update('item_absentee_master', $item_absentee, array('item_code' => $item_code)))
						{
							$this->db->trans_rollback();
							return FALSE;
						}
					}
					else
					{
						$this->db->where('item_code', $item_code);
						if(!$this->db->delete('item_absentee_master'))
						{
							$this->db->trans_rollback();
							return FALSE;
						}
					}
				}
				else
				{
					if (!empty($item_absentee['participent_id_csv']))
					{
						$item_absentee['item_code']		= $item_code;
						if(!$this->db->insert('item_absentee_master', $item_absentee))
						{
							$this->db->trans_rollback();
							return FALSE;
						}
					}
				}
				
				
				
				/*$this->db->select('RM.item_code, RM.school_code, PID.participant_id, PID.admn_no, RM.grade, RM.rank, 
										PID.parent_admn_no, IF(IFNULL(TRIM(SOM.is_publish), "Y")="Y", "N", "Y") AS is_withheld', FALSE);
				$this->db->where('RM.item_code', $item_code);
				$this->db->where_in('RM.grade', array('A', 'B', 'C'));
				$this->db->from('result_master RM');
				
				$this->db->join("participant_item_details PID", "PID.parent_admn_no=RM.admn_no AND PID.school_code=RM.school_code 
							AND PID.item_code=RM.item_code");
				$this->db->join("special_order_master SOM", "SOM.spo_id=PID.spo_id", "LEFT");
				$this->db->group_by('PID.participant_id,RM.item_code');*/
				
				$this->db->select('RM.item_code, RM.school_code, PID.participant_id, PID.admn_no, RM.grade, RM.rank, IF(IFNULL(TRIM(SOM.is_publish), "Y")="Y", "N", "Y") AS is_withheld', FALSE);
                $this->db->where('RM.item_code', $item_code);
				$this->db->where('PID.item_code', $item_code);
                //$this->db->where_in('RM.grade', array('A', 'B', 'C'));
                $this->db->from('result_master RM');
               
                $this->db->join("participant_item_details PID", "PID.admn_no=RM.admn_no AND PID.school_code=RM.school_code
                            AND PID.item_code=RM.item_code");
                $this->db->join("special_order_master SOM", "SOM.spo_id=PID.spo_id", "LEFT");
                $this->db->group_by('PID.participant_id');
				
				

				
				$cirtificate_array_master 		=	$this->db->get();
				$cirtificate_array_master 		=	$cirtificate_array_master->result_array();
				
				if(is_array($cirtificate_array_master) && count($cirtificate_array_master) > 0)
				{
					$this->db->select('item_code');
					$this->db->where('item_code', $item_code);
					$check_cirtificate_array 		=	$this->db->get('certificate_master');
					$check_cirtificate_array 		=	$check_cirtificate_array->result_array();
					if (is_array($check_cirtificate_array) && count($check_cirtificate_array) > 0)
					{
						$this->db->where('item_code', $item_code);
						if(!$this->db->delete('certificate_master'))
						{
							$this->db->trans_rollback();
							return FALSE;
						}
					}
					foreach ($cirtificate_array_master as $cirtificate_array_master)
					{
						if(!$this->db->insert('certificate_master', $cirtificate_array_master))
						{
							$this->db->trans_rollback();
							return FALSE;
						}
					}
				}
			
				
			}
			$this->db->trans_commit();
			//return TRUE;
			/*echo '<pre>';
			print_r($result_point_master);exit();*/
		}
		$this->update_schoolpoint($item_code);
		return TRUE;
	}
	
	function set_confirm_result_exb($festid)
	{  		
		$cmbFairType	=	4;
		//echo "<br /><br />ffff".$festid;
		$limit			=	$this->exhibition_category($cmbFairType,$festid);
		$this->db->trans_begin();
		if ($this->update_point_grade(4))
		{
			$this->db->select('item_code,participant_id');
			$this->db->from('result_master RM');
			$this->db->where('RM.fest_id', $festid);	
			$this->db->where('length(RM.item_code) > 3');	
			$all_schools =	$this->db->get();
			$all_schools =	$all_schools->result_array();
			for ($i = 0; $i < count($all_schools); $i++)
			{
				$participant_id	= $all_schools[$i]['participant_id'];
				$item_code 		= $all_schools[$i]['item_code'];
				$this->db->where('item_code', $item_code);
				$this->db->delete('school_point_details');
			}
			
			// get all participant (captain only), collect special order entry if any
			$this->db->select('RM.*', FALSE);
			$this->db->from('result_master RM');
			$this->db->join("participant_item_details PID", "PID.participant_id=RM.participant_id AND PID.school_code=RM.item_code");
			$this->db->join("school_details S","S.school_code=PID.school_code AND $limit", "LEFT");
			$this->db->where('RM.fest_id', $festid);
			$this->db->where('PID.fest_id', '0');
			$this->db->where('PID.is_captain','Y');
			$this->db->group_by('RM.participant_id,RM.item_code');			
			$this->db->order_by('RM.school_code', 'DESC');
			$this->db->order_by('RM.total_mark', 'DESC');
			$all_participant_master =	$this->db->get();
			$all_participant_master =	$all_participant_master->result_array();
			$school_point_array = array();
			
			// Inserting item point corresponding school. If participants of same school will store the point,  top score of the paricular school and 
			// the other point store in not_point feild. If any participant is comes with withheld (ie is_pubish is 'N' in special_order_table) will 
			// that participant point will store in not_point field.
			for ($i = 0; $i < count($all_participant_master); $i++)
			{
				$school_point_array['participant_id']	= $all_participant_master[$i]['participant_id'];
				$school_point_array['school_code'] 		= $all_participant_master[$i]['school_code'];
				$school_point_array['item_code'] 		= $all_participant_master[$i]['item_code'];
				
				if(isset($school_code) && $school_code == $all_participant_master[$i]['school_code'])
					{									
							$data_clear				=	array();
							$data_clear['is_taken']	=	'N';
							$this->db->where('participant_id',$all_participant_master[$i]['participant_id']);
							$this->db->where('item_code',$all_participant_master[$i]['item_code']);
							$this->db->update('result_master',$data_clear);				
							
							$school_point_array['point'] 		= 0;
							$school_point_array['not_point']	= $all_participant_master[$i]['point'];													
					}
					else
					{
						$school_point_array['point'] 		= $all_participant_master[$i]['point'];
						$school_point_array['not_point']	= 0;
						$school_code						= $all_participant_master[$i]['school_code'];
					}
					$school_point_array['is_withheld'] 	= 'N';
				
				
				if(!$this->db->insert('school_point_details', $school_point_array))
				{
					$this->db->trans_rollback();
					return FALSE;
				}
				$present_participant_id[$i]				= $all_participant_master[$i]['participant_id'];
			}
			
			// Change the status of data entry of pariculat item.
			$this->db->where('fest_id', $festid);
			$this->db->where('length(item_code) > 3');
			if(!$this->db->update('result_master', array('is_finish' => 'Y')))
			{
				$this->db->trans_rollback();
				return FALSE;
			}
			else
			{
				if (!$this->update_rank())
				{
					$this->db->trans_rollback();
					return FALSE;
				}
				
				// Update the confirm date and time
				
				$this->db->select('fest_id');
				$this->db->from('result_time RT');
				$this->db->join("result_master RM","RM.fest_id=RT.item_code", "LEFT");
				$this->db->where('RM.fest_id', $festid);	
				$this->db->where('length(RM.item_code) > 3');	
				$query = $this->db->get('result_time');
				$itemcode_query	=	$query->result_array();		
				//var_dump();
				if (is_array($itemcode_query) && count($itemcode_query))
				{
					$rank_time_array['is_finalized'] =	'Y';
					$rank_time_array['is_reset']	 =	1;
					$rank_time_array['confirm_date'] =	date("Y-m-d");
					$rank_time_array['confirm_time'] =	date("H:i:s a");
					if(!$this->db->update('result_time', $rank_time_array, array('item_code' => $festid)))
					{
						$this->db->trans_rollback();
						return FALSE;
					}
				
				}
				else
				{				
					$this->db->select_max('result_no');
					$query = $this->db->get('result_time');
					foreach ($query->result() as $row)
					{
					   $result_max	    =	 $row->result_no;
					   $result_max++;
					}
					$rank_time_array['result_no']	 =	$result_max;
					$rank_time_array['item_code']	 =	$festid;
					$rank_time_array['is_finalized'] =	'Y';
					$rank_time_array['confirm_date'] =	date("Y-m-d");
					$rank_time_array['confirm_time'] =	date("H:i:s");
					if(!$this->db->insert('result_time', $rank_time_array))
					{
						$this->db->trans_rollback();
						return FALSE;
					}
				}
				
				
				// Select the First Rank holdsers in particular item. If any rank holders then store the detail in  table 'result_publish' for
				// higher level competition (district level)
				$this->db->select('RM.*, SPD.is_withheld');
				$this->db->from('result_master RM');
				$this->db->where('RM.fest_id', $festid);	
				$this->db->where('length(RM.item_code) > 3');	
				$this->db->join('school_point_details SPD', 'SPD.participant_id=RM.participant_id AND SPD.item_code=RM.item_code');				
				//$this->db->where('RM.rank', 1);
				$ranks=array(1,2);
				$this->db->where_in('RM.rank', $ranks);
				$result_publish_master =	$this->db->get();
				$result_publish_master =	$result_publish_master->result_array();	
				
				if (is_array($result_publish_master) && count($result_publish_master))
				{
					$this->db->select('item_code,participant_id');
					$this->db->from('result_master RM');
					$this->db->where('RM.fest_id', $festid);	
					$this->db->where('length(RM.item_code) > 3');	
					$all_schools =	$this->db->get();
					$all_schools =	$all_schools->result_array();
					for ($i = 0; $i < count($all_schools); $i++)
					{
						$participant_id	= $all_schools[$i]['participant_id'];
						$item_code 		= $all_schools[$i]['item_code'];
						$this->db->where('item_code', $item_code);
						$this->db->delete('result_publish');
					}
					
					foreach ($result_publish_master as $result_publish_master)
					{
						$publish_array = array();
						$publish_array['school_code'] 	= $result_publish_master['school_code'];
						$publish_array['item_code'] 	= $result_publish_master['item_code'];
						$publish_array['participant_id']= $result_publish_master['participant_id'];
						$publish_array['grade']			= $result_publish_master['grade'];
						$publish_array['is_withheld']	= $result_publish_master['is_withheld'];
						if(!$this->db->insert('result_publish', $publish_array))
						{
							$this->db->trans_rollback();
							return FALSE;
						}
					}
				}
					
				
				$item_absentee['participent_id_csv']	= $this->get_absentee_list_select_exb ($festid);
				$this->db->select('AB.item_code');
				$this->db->from('item_absentee_master as AB');
				$this->db->join('result_master RM','RM.item_code=AB.item_code');
				$this->db->where('RM.fest_id', $festid);	
				$this->db->where('length(RM.item_code) > 3');	
				$check_absentee_id 		=	$this->db->get('item_absentee_master');
				$check_absentee_id 		=	$check_absentee_id->result_array();

				foreach ($check_absentee_id as $check_absentee_id)
				{
					$publish_array = array();
					$absentee_school_code 	= $check_absentee_id['school_code'];
					if (is_array ($check_absentee_id) && count($check_absentee_id) > 0)
					{
						if (!empty($item_absentee['participent_id_csv']))
						{
							
								if(!$this->db->update('item_absentee_master', $item_absentee, array('item_code' => $absentee_school_code)))
								{
									$this->db->trans_rollback();
									return FALSE;
								}
						   
						}
						else
						{
							$this->db->where('RM.item_code', $absentee_school_code);	
							if(!$this->db->delete('item_absentee_master'))
							{
								$this->db->trans_rollback();
								return FALSE;
							}
						}
					}
					else
					{
						if (!empty($item_absentee['participent_id_csv']))
						{
							$item_absentee['item_code']		= $absentee_school_code;
							if(!$this->db->insert('item_absentee_master', $item_absentee))
							{
								$this->db->trans_rollback();
								return FALSE;
							}
						}
					}
				}
				
				
				
				/*$this->db->select('RM.item_code, RM.school_code, PID.participant_id, PID.admn_no, RM.grade, RM.rank, 
										PID.parent_admn_no, IF(IFNULL(TRIM(SOM.is_publish), "Y")="Y", "N", "Y") AS is_withheld', FALSE);
				$this->db->where('RM.item_code', $item_code);
				$this->db->where_in('RM.grade', array('A', 'B', 'C'));
				$this->db->from('result_master RM');
				
				$this->db->join("participant_item_details PID", "PID.parent_admn_no=RM.admn_no AND PID.school_code=RM.school_code 
							AND PID.item_code=RM.item_code");
				$this->db->join("special_order_master SOM", "SOM.spo_id=PID.spo_id", "LEFT");
				$this->db->group_by('PID.participant_id,RM.item_code');*/
				
				$this->db->select('RM.item_code, RM.school_code, PID.participant_id, PID.admn_no, RM.grade, RM.rank', FALSE);
                $this->db->where('RM.fest_id', $festid);
				$this->db->where('PID.fest_id', '0');
				$this->db->where('length(RM.item_code) > 3');		
                //$this->db->where_in('RM.grade', array('A', 'B', 'C'));
                $this->db->from('result_master RM');
               
                $this->db->join("participant_item_details PID", "PID.admn_no=RM.admn_no AND PID.school_code=RM.school_code
                            AND PID.school_code=RM.item_code");
                $this->db->group_by('PID.participant_id');				
				$cirtificate_array_master 		=	$this->db->get();
				$cirtificate_array_master 		=	$cirtificate_array_master->result_array();
				
				if(is_array($cirtificate_array_master) && count($cirtificate_array_master) > 0)
				{
					$this->db->select('CM.item_code');
					$this->db->from('certificate_master CM');
					$this->db->join('result_master as RM','RM.item_code=CM.item_code');
					$this->db->where('RM.fest_id', $festid);
					$this->db->where('length(RM.item_code) > 3');	
					$check_cirtificate_array 		=	$this->db->get('certificate_master');
					$check_cirtificate_array 		=	$check_cirtificate_array->result_array();
					if (is_array($check_cirtificate_array) && count($check_cirtificate_array) > 0)
					{
						
						$this->db->select('item_code,participant_id');
						$this->db->from('result_master RM');
						$this->db->where('RM.fest_id', $festid);	
						$this->db->where('length(RM.item_code) > 3');	
						$all_schools =	$this->db->get();
						$all_schools =	$all_schools->result_array();
						for ($i = 0; $i < count($check_cirtificate_array); $i++)
						{
							$item_code 		= $check_cirtificate_array[$i]['item_code'];
							$this->db->where('item_code', $item_code);
							if(!$this->db->delete('certificate_master'))
							{
								$this->db->trans_rollback();
								return FALSE;
							}
						}			
						
					}
					foreach ($cirtificate_array_master as $cirtificate_array_master)
					{
						if(!$this->db->insert('certificate_master', $cirtificate_array_master))
						{
							$this->db->trans_rollback();
							return FALSE;
						}
					}
				}
			
				
			}
			$this->db->trans_commit();
			//return TRUE;
			/*echo '<pre>';
			print_r($result_point_master);exit();*/
		 }
		
		return TRUE;
	}
	
	/** function or update the rank */
	function update_rank ($fairId = 0)
	{
		//$this->db->trans_begin();
		$rank			=	array();
		$rank['rank']	=	0;
		if($fairId != 4 && $this->input->post('hidItemId') != 'exb'){ 
			$this->db->where('item_code', $this->input->post('hidItemId'));
		}
		else
		{
			$this->db->where('fest_id', $this->input->post('hidFestid'));
			$this->db->where('length(item_code) > 3');		
		}
		
		
		$this->db->update('result_master', $rank);
		
		if($fairId != 4 && $this->input->post('hidItemId') != 'exb'){ 
			$this->db->where('item_code', $this->input->post('hidItemId'));
			$this->db->where('is_taken', 'Y');
		}
		else
		{
			$this->db->where('fest_id', $this->input->post('hidFestid'));
			$this->db->where('length(item_code) > 3');		
		}
		//$this->db->where('point > 0');
		$this->db->select('total_mark, rm_id,fairId');
		$this->db->order_by('total_mark', 'DESC');
		$top_marks 	= 	$this->db->get('result_master');
		$top_marks	=	$top_marks->result_array();
		$temp_mark	='';
		$rank_no	= 0;
		$rank		= array();
		//echo 'rr';
		//print_r($top_marks);
		//echo '<br>';
		
		for( $i = 0; $i < count($top_marks); $i++ )
		{
			if ($rank_no < 3 or $temp_mark == $top_marks[$i]['total_mark'])
			{
				if (!empty($temp_mark))
				{
					if ($temp_mark == $top_marks[$i]['total_mark'])
					{
						$rank['rank']	=	$rank_no;
						$temp_mark = $top_marks[$i]['total_mark'];
					}
					else
					{
						$rank_no++;
						$rank['rank']	=	$rank_no;
						$temp_mark = $top_marks[$i]['total_mark'];
					}
				}
				else 
				{
					$rank_no++;
					$rank['rank']	=	$rank_no;
					$temp_mark = $top_marks[$i]['total_mark'];
				}
				$this->db->where('rm_id', @$top_marks [$i]['rm_id']);
				if (!$this->db->update('result_master', $rank))
				{
					//$this->db->trans_rollback();
					return FALSE;
				}
				$rank	=	array();
			}
		}
		$this->update_rank_grade();
		//$this->db->trans_commit();
		return TRUE;
	} 
	
	function update_point_grade($fairId = 0)
	{
		$this->db->trans_begin();
		$item_code_array	=	array('111','112','120','121','122','123','131','132','138','139','146','147','163','164','181','182','194','204','205','206','214');	
		
		if($fairId != 4 && $this->input->post('hidItemId') != 'exb'){ 
		$this->db->where('item_code', $this->input->post('hidItemId'));
		//$this->db->where('is_taken', 'Y');
		}
		else
		{
			$this->db->where('fest_id', $this->input->post('hidFestid'));
			$this->db->where('length(item_code) > 3');		
		}
		$this->db->where('percentage >= 50');
		$this->db->select('percentage, rm_id, fairId');
		$grade_point	= 	$this->db->get('result_master');
		//echo "<br /><br />";
		//	print_r($grade_point->result_array());	
		foreach ($grade_point->result_array() as $grade_point)
		{
			$percentage				=	$grade_point['percentage'];
			$fairid					=	$grade_point['fairId'];
			$grade					=	'';
			$point					=	'';
			if(round($percentage) >= 50 && round($percentage) <=59) {
				$grade					=	'C';
				$point					=	'1';
			} else if(round($percentage) >= 60 && round($percentage) <=69) {
				$grade					=	'B';
				$point					=	'3';
			} else if(round($percentage) > 69) {
				$grade					=	'A';
				$point					=	'5';
			}
			if($fairid == 4){
				$point					=	'';
			}
			//echo $grade;
			if(in_array($this->input->post('hidItemId'),$item_code_array))
			{	$point					=	'';		}
			
			$data_grade_point['grade']		=	$grade;
			$data_grade_point['point']		=	$point;
			$data_grade_point['is_taken']	=	'Y';
			$this->db->where('rm_id', $grade_point['rm_id']);
			$this->db->update('result_master',$data_grade_point);
		}
		$this->db->trans_commit();
		return TRUE;
	}
	
	
	function update_rank_grade()
	{
	//echo '<br><br><br>post';
	//print_r($_POST);
	//echo '<br><br><br>post';
		$this->db->trans_begin();
		$item_code_array	=	array('111','112','120','121','122','123','131','132','138','139','146','147','163','164','181','182','194','204','205','206','214');	
		
		if($this->input->post('hidItemId') != 'exb'){ 
			$this->db->where('item_code', $this->input->post('hidItemId'));
		}
		else
		{
			$this->db->where('fest_id', $this->input->post('hidFestid'));
			$this->db->where('length(item_code) > 3');		
		}
				
		$this->db->select('rank,item_code,rm_id,point,school_code,participant_id,fairId,total_mark');
		$rank_point	= 	$this->db->get('result_master');
				
		//echo "<br /><br />";
		//print_r($rank_point->result_array());		
		foreach ($rank_point->result_array() as $rank_point)
		{
		
			$rank					=	$rank_point['rank'];
			$point					=	$rank_point['point'];
			$fairid					=	$rank_point['fairId'];
			$tot_mark				=	$rank_point['total_mark'];
			$item_id				=	$rank_point['item_code'];
			
			if($rank == 1) {
				$point					=	$point+5;
			} else if($rank == 2) {
				$point					=	$point+3;
			} else if($rank == 3) {
				$point					=	$point+1;
			}
			if($fairid == 4){
				$point					=	'';
			}
			
			if(in_array($this->input->post('hidItemId'),$item_code_array))
			{	$point					=	'';		}
			
			
			$data_rank_point['point']		=	$point;
			$this->db->where('rm_id', $rank_point['rm_id']);
			$this->db->update('result_master',$data_rank_point);	
			
			
			if($this->input->post('hidItemId') != 'exb'){ 
				$this->db->where('school_code',$rank_point['school_code']);
				$this->db->where('participant_id',$rank_point['participant_id']);
				$this->db->where('item_code', $this->input->post('hidItemId'));
				$this->db->select('sp_id,point');
				$school_point_details	= 	$this->db->get('school_point_details');
			}
			else
			{
				$this->db->where('SP.school_code',$rank_point['school_code']);
				$this->db->where('SP.participant_id',$rank_point['participant_id']);
				$this->db->where('RM.fest_id', $this->input->post('hidFestid'));
				$this->db->where('length(RM.item_code) > 3');	
				$this->db->from('school_point_details as SP');	
				$this->db->join('result_master RM','RM.item_code=SP.item_code');	
				$this->db->select('SP.sp_id,SP.point');
				$school_point_details	= 	$this->db->get('school_point_details');
			}		
			
			
			$school_point_dtls 		= 	$school_point_details->result_array();
			
			if($fairid	==	4){
				$point					=	$tot_mark;				
			}
			/*if(@$school_point_dtls[0]['point']>0)
			{*/
				$data_rank_total_point['total_point']		=	$point;
				if($this->input->post('hidItemId') != 'exb'){ 
					$this->db->where('item_code', $this->input->post('hidItemId'));
				}
				else
				{
					$this->db->where('item_code', $item_id);										
				}
				$this->db->where('school_code',$rank_point['school_code']);
				$this->db->where('participant_id',$rank_point['participant_id']);
				$this->db->update('school_point_details',$data_rank_total_point);
			//}	
		
		}
		$this->db->trans_commit();
		return TRUE;
	}
	
	
	
	
	function get_absentee_list_select ($item_code)
	{
		$this->db->select('PID.participant_id', FALSE);
		$this->db->from('result_master RM');
		$this->db->join('participant_item_details PID', 'PID.item_code = RM.item_code AND PID.participant_id=RM.participant_id', 'right');
		$this->db->where('PID.item_code', $item_code);
		$this->db->where('PID.is_captain', 'Y');
		$this->db->where('RM.rm_id', NULL);
		$result	=	$this->db->get();
		$result	=	$result->result_array();
		$absentee_list	=	'';
		if(is_array($result) && count($result) > 0)
		{
			foreach ($result as $key=>$each_result)
			{
				$absentee_list	.= $each_result['participant_id'];	
				if ($key != (count($result)-1) && count($result) != 1) $absentee_list	.= ', ';
			}
			return $absentee_list;
		}
		return FALSE;
	}
	
	function get_absentee_list_select_exb($fest_id)
	{
		$this->db->select('PID.participant_id', FALSE);
		$this->db->from('result_master RM');
		$this->db->join('participant_item_details PID', 'PID.school_code = RM.item_code AND PID.participant_id=RM.participant_id', 'right');
		$this->db->where('PID.fest_id', '0');
		$this->db->where('PID.is_captain', 'Y');
		$this->db->where('length(RM.item_code) >  3');
		$this->db->where('RM.fest_id', $fest_id);
		$this->db->where('RM.rm_id', NULL);
		$result	=	$this->db->get();
		$result	=	$result->result_array();
		$absentee_list	=	'';
		if(is_array($result) && count($result) > 0)
		{
			foreach ($result as $key=>$each_result)
			{
				$absentee_list	.= $each_result['participant_id'];	
				if ($key != (count($result)-1) && count($result) != 1) $absentee_list	.= ', ';
			}
			return $absentee_list;
		}
		return FALSE;
	}
	
	function get_item_result($festtype,$fair_id)
	{
		// s.start_time,s.no_of_cluster,s.stage_id,sm.stage_name, sm.stage_desc,
		
		$this->db->select('count( p.participant_id ) AS cpt, p.item_code, i.item_type, 
			i.item_name, f.fest_name,
			 (SELECT count(rm.participant_id) FROM result_master rm WHERE rm.item_code=p.item_code) AS participated_no,
			 IF((SELECT count(rm1.item_code) FROM result_master rm1 
					WHERE rm1.item_code=p.item_code ) > 0 ,
					IF((	SELECT count(rm1.item_code) FROM result_master rm1 
							WHERE rm1.item_code=p.item_code AND rm1.is_finish ="N"
						) > 0, "No", "Yes"
					),
					"No"
			) AS is_confirmed', FALSE);
		$this->db->from('participant_item_details AS p');
		$this->db->join('item_master AS i','i.item_code = p.item_code');
		$this->db->join('festival_master AS f','f.fest_id = i.fest_id');
		//$this->db->join('stage_item_master AS s','s.item_code= p.item_code','LEFT');
		//$this->db->join('stage_master AS sm','sm.stage_id = s.stage_id','LEFT');
		//$this->db->join('result_master AS rm','rm.participant_id= p.participant_id','LEFT');
		$this->db->where('i.fest_id',$festtype);
		$this->db->where('i.fairId',$fair_id);
		$this->db->where('p.is_captain','Y');
		$this->db->where('i.item_type','G');
		$this->db->group_by('p.item_code');
		$this->db->order_by('p.item_code');
		$getdet		=	$this->db->get();
		return $getdet->result_array();
	}
	
	function get_item_result_single($festtype,$fair_id)
	{
	//AND rm1.is_finish ="N"
	//s.start_time,s.no_of_cluster,s.stage_id,sm.stage_name, sm.stage_desc,
	
		$this->db->select('count( p.participant_id) AS cpt, p.item_code, i.item_type, i.item_name, 
		f.fest_name,
		(SELECT count(rm.participant_id) FROM result_master rm WHERE rm.item_code=p.item_code) AS participated_no,
		 IF((SELECT count(rm1.item_code) FROM result_master rm1 
				WHERE rm1.item_code=p.item_code ) > 0 ,
				IF((	SELECT count(rm1.item_code) FROM result_master rm1 
						WHERE rm1.item_code=p.item_code AND rm1.is_finish ="N"
					) > 0, "No", "Yes"
				),
				"No"
		) AS is_confirmed', FALSE);
					
		$this->db->from('participant_item_details AS p');
		$this->db->join('item_master AS i','i.item_code = p.item_code');
		$this->db->join('festival_master AS f','f.fest_id = i.fest_id');
		//$this->db->join('stage_item_master AS s','s.item_code= p.item_code','LEFT');
		//$this->db->join('stage_master AS sm','sm.stage_id = s.stage_id','LEFT');
		$this->db->where('i.fest_id',$festtype);
		$this->db->where('i.fairId',$fair_id);
		$this->db->where('i.item_type','S');
		$this->db->group_by('p.item_code');
		$this->db->order_by('p.item_code');
		$getdet		=	$this->db->get();
		return $getdet->result_array();
		
	}
	
	function get_item_result_single_exb()
	{
	//AND rm1.is_finish ="N"
	//s.start_time,s.no_of_cluster,s.stage_id,sm.stage_name, sm.stage_desc,
		$cmbFairType	=	4;
		for($festid=1;$festid<5;$festid++)	
		{		
			$limit	=	$this->exhibition_category($cmbFairType,$festid);
			
			$this->db->select('count( p.participant_id) AS cpt,(SELECT count(rm.participant_id) FROM result_master rm,participant_item_details p WHERE rm.item_code=p.school_code AND rm.fest_id='.$festid.'  and p.fest_id=0 and p.is_captain="Y" ) AS participated_no,
			IF((SELECT count(rm1.item_code) FROM result_master rm1, participant_item_details p1
					WHERE rm1.item_code=p1.school_code AND  rm1.fest_id='.$festid.') > 0 ,
					IF((SELECT count(rm1.item_code) FROM result_master rm1,  participant_item_details p1
							WHERE rm1.item_code=p1.school_code AND  rm1.fest_id='.$festid.' AND rm1.is_finish ="N"
						) > 0, "No", "Yes"
					),
					"No"
			) AS is_confirmed', FALSE);
								
			$this->db->from('participant_item_details AS p');
			//$this->db->join('result_master AS i','i.item_code = p.school_code AND i.fairId=4 AND i.fest_id='.$festid);
					
			$this->db->join('school_details AS S',"S.school_code = p.school_code AND $limit");
			//$this->db->join('stage_item_master AS s','s.item_code= p.item_code','LEFT');
			//$this->db->join('stage_master AS sm','sm.stage_id = s.stage_id','LEFT');
			$this->db->where('p.fairId','4');
			$this->db->where('p.fest_id','0');
			$this->db->where('p.is_captain','Y');	
			$this->db->group_by('p.fest_id');	
			
			$getdet		=	$this->db->get();
			$return_array[$festid]	=	 $getdet->result_array();	
			
			//echo "<br />".$festid."<br />";
			//var_dump($return_array[$festid]);
		}			
		return $return_array;	
	}
	
	function reset_result_confirmation_status ($item_code)
	{
		$this->db->trans_begin();
		$this->db->where('item_code', $item_code);
		if (!$this->db->delete('item_absentee_master'))
		{
			 $this->db->trans_rollback();
			 return FALSE;
		}
		$this->db->where('item_code', $item_code);
		if (!$this->db->delete('result_publish'))
		{	
			 $this->db->trans_rollback();
			 return FALSE;	
		}
		$this->db->where('item_code', $item_code);
		if (!$this->db->delete('school_point_details'))
		{	
			 $this->db->trans_rollback();
			 return FALSE;	
		}
		$this->db->where('item_code', $item_code);
		if (!$this->db->delete('certificate_master'))
		{	
			 $this->db->trans_rollback();
			 return FALSE;	
		}
		$this->db->where('item_code', $item_code);
		if (!$this->db->delete('result_time'))
		{	
			 $this->db->trans_rollback();
			 return FALSE;	
		}
		$this->db->where('item_code', $item_code);
		$update_array['rank']		= 0;
		$update_array['is_finish']	= 'N';
		if (!$this->db->update('result_master', $update_array))
		{	
			 $this->db->trans_rollback();
			 return FALSE;	
		}
		$this->db->trans_commit();
		return TRUE;
	}
	
	
	function reset_result_confirmation_status_exb($festid)
	{
		$this->db->select('item_code,participant_id');
		$this->db->from('result_master RM');
		$this->db->where('RM.fest_id', $festid);	
		$this->db->where('length(RM.item_code) > 3');	
		$all_schools =	$this->db->get();
		$all_schools =	$all_schools->result_array();
		for ($i = 0; $i < count($all_schools); $i++)
		{
			$participant_id	= $all_schools[$i]['participant_id'];
			$item_code 		= $all_schools[$i]['item_code'];
			$this->db->trans_begin();
			$this->db->where('item_code', $item_code);
			if (!$this->db->delete('item_absentee_master'))
			{
				 $this->db->trans_rollback();
				 return FALSE;
			}
			$this->db->where('item_code', $item_code);
			if (!$this->db->delete('result_publish'))
			{	
				 $this->db->trans_rollback();
				 return FALSE;	
			}
			$this->db->where('item_code', $item_code);
			if (!$this->db->delete('school_point_details'))
			{	
				 $this->db->trans_rollback();
				 return FALSE;	
			}
			$this->db->where('item_code', $item_code);
			if (!$this->db->delete('certificate_master'))
			{	
				 $this->db->trans_rollback();
				 return FALSE;	
			}
			$this->db->where('item_code', $item_code);
			if (!$this->db->delete('result_time'))
			{	
				 $this->db->trans_rollback();
				 return FALSE;	
			}
			$this->db->where('item_code', $item_code);
			$update_array['rank']		= 0;
			$update_array['is_finish']	= 'N';
			if (!$this->db->update('result_master', $update_array))
			{	
				 $this->db->trans_rollback();
				 return FALSE;	
			}
			$this->db->trans_commit();
	  }
		return TRUE;
	}
	
	function exhibition_category($cmbFairType,$cmbCateType)
	{
		//echo "<br /><br />ffff".$cmbFairType."festttt".$cmbCateType;
		if($cmbFairType == 4){
			if($cmbCateType	==	1)
			{	$limit	=	'S.class_end = 4'; }
			if($cmbCateType	==	2)
			{	$limit	=	'(S.class_end = 7 OR S.class_end = 5)'; }
			if($cmbCateType	==	3)
			{	$limit	=	'(S.class_end = 8 OR S.class_end = 10)'; }
			if($cmbCateType	==	4)
			{	$limit	=	'S.class_end = 12'; }
		}			
		return $limit;		
	}
	
	
	function checkWetherconcidertograde($participantId,$itemCode,$school_code,$totMark){
		//$this->template->write('message','<br>Participant Id = '.$participantId)	;
		//$this->template->write('message','<br>Iten Code      = '.$itemCode)	;
		$this->db->select('distinct R.*');
		$this->db->from('result_master R');
		$this->db->join('participant_item_details P','R.item_code = P.item_code');
		$this->db->where('R.item_code', $itemCode);
		$this->db->where('R.school_code', $school_code);
		$this->db->where('P.spo_id', '0');
		$result	=	$this->db->get('result_master');
		$result	=	$result->result_array();
		$cnt	=	count($result);
		if(is_array($result) && $cnt > 0)
		{
			for ($i = 0; $i < $cnt; $i++)
			{
				$totalMarkofRegularOrder		=	$result[$i]['total_mark'];
				if($totalMarkofRegularOrder < $totMark){
					return 'eligibleformarks';
					//$this->template->write('message','<br><br><br>********************<br>')	;
					//$this->template->write('message','<br><br>Original Mark = '.$totalMarkofRegularOrder.' <br> Special Orders mark = '.$totMark.'<br> So Permission Granded <br>')	;			
					//$this->template->write('message','<br><br><br>********************<br>')	;
	
				}
			} //for
			return 'noteligibleformarks';			
		}//if
	}
	
	
	function update_schoolpoint($item_code)
	{		
		if($item_code	==	124){
			$maxi	=	1;
		}
		else{
			$maxi	=	2;
		}
		$this->db->select('distinct(school_code)');
		$this->db->where('item_code', $item_code);
		$result	=	$this->db->get('result_master');
		$result	=	$result->result_array();
		$cnt	=	count($result);
		
		if(is_array($result) && $cnt > 0)
		{
			//$rtrn_val	=	'noteligibleformarks';
			for ($i = 0; $i < $cnt; $i++)
			{
				$schoolcode		=	$result[$i]['school_code'];
		
			$sql	=	mysql_query("SELECT * FROM school_point_details WHERE item_code ='$item_code' and school_code='$schoolcode' ORDER BY school_code,total_point");			
	
			$num_rows 	= 	mysql_num_rows($sql);
			$num		=	$num_rows;
			while($code	=	mysql_fetch_assoc($sql))
			{
				if($num > $maxi){
					//var_dump($code);
					$schoolcode1	=	$code['school_code'];				
					$part_id		=	$code['participant_id'];
					//echo "<br /><br />--->".$subcode."<br />".$point."<br />".$count;	
					$sql2="delete  FROM school_point_details WHERE  school_code='$schoolcode1' and  item_code='$item_code' and participant_id='$part_id'";
					//echo "<br /><br /><br />--->".$sql2;
					$sq2	=	mysql_query($sql2);
					$num	= $num-1;
					
				}	
			}
		}//for
	   }
			
	}
	
	
	
}
?>
