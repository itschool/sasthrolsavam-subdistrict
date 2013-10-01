<?php
class Export_Model extends CI_Model
{
	function Export_Model(){
		parent::__construct();
	}
	function get_sub_dist_school_export_data($checks)
	{

		$data_data_array				=	array();
		$curr_date						=	time();
		$encr_date						=	get_encr_password($curr_date);
		$date_data_array[0]['date']		=	$curr_date;
		$date_data_array[0]['encr_date']=	$encr_date;
		
		// total rows count leaving the titles
		$total_row_count				=	0;
		
		$sub_district_code				=	$this->session->userdata('SUB_DISTRICT');
		$this->db->where('sub_district_code',$sub_district_code);
		$school_master					=	$this->db->get('school_master');
		$school_master					=	$school_master->result_array();
		$school_master_data				= array ();
		$i								= 0;		
		$school_master_data[$i]['title']=	'SM_DETAILS';	
		
		//echo "<br />".count($school_master);	
		
		if (isset($school_master) && count($school_master) > 0)
		{
			foreach ($school_master as $key => $school_master)
			{
				$i++;
				$school_master_data[$i]['school_code']				= trim($school_master['school_code']);
				$school_master_data[$i]['sub_district_code']		= trim($school_master['sub_district_code']);
				$school_master_data[$i]['edu_district_code']		= trim($school_master['edu_district_code']);
				$school_master_data[$i]['rev_district_code']		= trim($school_master['rev_district_code']);
				$school_master_data[$i]['school_name']				= str_replace(',',' ',trim($school_master['school_name']));
				$school_master_data[$i]['school_type']				= trim($school_master['school_type']);
				
				
				$school_master_data[$i]['school_status']				= trim($school_master['school_status']);
				$school_master_data[$i]['school_master_encr_code']		= get_encr_password(trim($school_master['school_code']).trim($school_master['sub_district_code']).trim($school_master['rev_district_code']).trim($school_master['school_type']));
				$total_row_count++;
			}
		}
	
		$this->db->where('SM.sub_district_code',$sub_district_code);
		$this->db->join('school_master AS SM','SD.school_code = SM.school_code');
		$this->db->order_by('SD.school_code');
		$school_details						= $this->db->get('school_details AS SD');
		$school_details						= $school_details->result_array();
		$school_details_data				= array ();
		$i									= 0;
		$school_details_data[$i]['title']	= 'SD_DETAILS';
		
		if (isset($school_details) && count($school_details) > 0)
		{
			foreach ($school_details as $key => $school_details)
			{
				$i++;
				$school_details_data[$i]['school_code']					= trim($school_details['school_code']);
				
				$school_details_data[$i]['fairScience']					= 'N';
				$school_details_data[$i]['fairMathematics']				= 'N';
				$school_details_data[$i]['fairSocialScience']			= 'N';
				$school_details_data[$i]['fairWorkExp']					= 'N';
				$school_details_data[$i]['fairITmela']					= 'N';
				
				$school_details_data[$i]['class_start']					= trim($school_details['class_start']);
				$school_details_data[$i]['class_end']					= trim($school_details['class_end']);
				$school_details_data[$i]['school_phone']				= trim($school_details['school_phone']);
				$school_details_data[$i]['school_email']				= trim($school_details['school_email']);
				$school_details_data[$i]['hm_name']						= str_replace(',',' ',trim($school_details['hm_name']));
				$school_details_data[$i]['hm_phone']					= trim($school_details['hm_phone']);
				$school_details_data[$i]['principal_name']				= str_replace(',',' ',trim($school_details['principal_name']));
				$school_details_data[$i]['principal_phone']				= trim($school_details['principal_phone']);
				$school_details_data[$i]['teachers']					= str_replace(',',' ',trim($school_details['teachers']));
				$school_details_data[$i]['escorting_teachers']			= str_replace(',',' ',trim($school_details['escorting_teachers']));
				$school_details_data[$i]['strength_lp']					= trim($school_details['strength_lp']);
				$school_details_data[$i]['strength_up']					= trim($school_details['strength_up']);
				$school_details_data[$i]['strength_hs']					= trim($school_details['strength_hs']);
				$school_details_data[$i]['strength_hss']				= trim($school_details['strength_hss']);
				$school_details_data[$i]['strength_vhss']				= trim($school_details['strength_vhss']);
				$school_details_data[$i]['total_strength']				= trim($school_details['total_strength']);
				$school_details_data[$i]['is_create_report']			= trim($school_details['is_create_report']);
				$school_details_data[$i]['is_finalize']					= trim($school_details['is_finalize']);
				$school_details_data[$i]['school_details_encr_code']	= get_encr_password(trim($school_details['school_code']).trim($school_details['class_start']).trim($school_details['class_end']).trim($school_details['strength_lp']).trim($school_details['strength_up']).trim($school_details['strength_hs']).trim($school_details['strength_hss']).trim($school_details['strength_vhss']).trim($school_details['total_strength']));
				$total_row_count++;																
					
			}
		}
				
		
		$checksLength							=	strlen(trim($checks));
		
		
		$this->db->where('PD.fairId',$checks);
		$this->db->where('PD.sub_district_code',$sub_district_code);
		$this->db->select('PD.*');
		$participant_item_details					= $this->db->get('participant_item_details AS PD');
		$participant_item_details					= $participant_item_details->result_array();
		$participant_item_details_data				= array ();
		$i											= 0;
		$participant_item_details_data[$i]['title']	= 'PID_DETAILS';
		
		if (isset($participant_item_details) && count($participant_item_details) > 0)
		{
			foreach ($participant_item_details as $key => $participant_item_details)
			{
				$i++;
				$participant_item_details_data[$i]['participant_id']				= trim($participant_item_details['participant_id']);
				$participant_item_details_data[$i]['fairId']						= trim($participant_item_details['fairId']);
				$participant_item_details_data[$i]['fest_id']						= trim($participant_item_details['fest_id']);
				$participant_item_details_data[$i]['school_code']					= trim($participant_item_details['school_code']);
				$participant_item_details_data[$i]['sub_district_code']				= trim($participant_item_details['sub_district_code']);
				$participant_item_details_data[$i]['admn_no']						= str_replace(' ','',trim($participant_item_details['admn_no']));
				
				$participant_item_details_data[$i]['item_code']						= trim($participant_item_details['item_code']);
				$participant_item_details_data[$i]['item_type']						= trim($participant_item_details['item_type']);
				$participant_item_details_data[$i]['spo_id']						= trim($participant_item_details['spo_id']);
				$participant_item_details_data[$i]['spo_remarks']					= trim($participant_item_details['spo_remarks']);
				$participant_item_details_data[$i]['exhibition']					= trim($participant_item_details['exhibition']);
				$participant_item_details_data[$i]['exhibit_name']					= str_replace(',',' ',trim($participant_item_details['exhibit_name']));
				$participant_item_details_data[$i]['participant_name']				= str_replace(',',' ',trim($participant_item_details['participant_name']));
				$participant_item_details_data[$i]['class']							= trim($participant_item_details['class']);
				$participant_item_details_data[$i]['gender']						= trim($participant_item_details['gender']);
				$participant_item_details_data[$i]['team_no']						= trim($participant_item_details['team_no']);
				$participant_item_details_data[$i]['is_captain']						= trim($participant_item_details['is_captain']);
				$participant_item_details_data[$i]['remarks']						= trim($participant_item_details['remarks']);
				
				$participant_item_details_data[$i]['participant_item_encr_code']	= get_encr_password(trim($participant_item_details['participant_id']).trim($participant_item_details['fairId']).trim($participant_item_details['fest_id']).trim($participant_item_details['school_code']).trim($participant_item_details['sub_district_code']).str_replace(' ','',trim($participant_item_details['admn_no'])).trim($participant_item_details['item_code']).trim($participant_item_details['class']).trim($participant_item_details['gender']).trim($participant_item_details['team_no']));
				$total_row_count++;
				//echo "<br>jjjj";
			//echo $participant_item_details_data[$i]['item_code']."- ". $participant_item_details_data[$i]['school_code']
			//."-".$participant_item_details_data[$i]['admn_no'];
			}
			
		}
		
		
		$this->db->where('ES.fairId',$checks);
		$this->db->where('SM.sub_district_code',$sub_district_code);
		$this->db->join('school_master AS SM','ES.school_code = SM.school_code');
		$escorting_details						= $this->db->get('teacherAndEscortings AS ES');
		$escorting_details						= $escorting_details->result_array();
		$escorting_details_data					= array ();
		$i										= 0;
		$escorting_details_data[$i]['title']	= 'ES_DETAILS';
		
		if (isset($escorting_details) && count($escorting_details) > 0)
		{
			foreach ($escorting_details as $key => $escorting_details)
			{
				$i++;
				$escorting_details_data[$i]['escorting_table_id']		= trim($escorting_details['escorting_table_id']);
				
				$escorting_details_data[$i]['fairId']		= trim($escorting_details['fairId']);
				$escorting_details_data[$i]['school_code']	= trim($escorting_details['school_code']);
				//str_replace(',',' ',trim($school_details['escorting_teachers']));
				$escorting_details_data[$i]['teachers_num']		= trim($escorting_details['teachers_num']);
				$escorting_details_data[$i]['escorting_teachers']	= trim($escorting_details['escorting_teachers']);
				$escorting_details_data[$i]['exhibition']	= trim($escorting_details['exhibition']);
				$escorting_details_data[$i]['name_team']	= trim($escorting_details['name_team']);				
				//echo "<br />-->".trim($escorting_details['address_team']);
				$esc_det	=	trim($escorting_details['address_team']);
				$escorting_details_data[$i]['address_team']		= str_replace(array(CHR(10), ','),' ',$esc_det);
				//echo "-->".$escorting_details_data[$i]['address_team'];
				
				$escorting_details_data[$i]['phone_team']	= trim($escorting_details['phone_team']);
				
				//$escorting_details_data[$i]['escorting_details_encr_code']	= get_encr_password(trim($escorting_details['escorting_table_id']).trim($escorting_details['fairId']).trim($escorting_details['school_code']).trim($escorting_details['teachers_num']));
				$total_row_count++;																	
					
			}
		}	
		
		
		
		$sub_district_data	= array(0 => array('sub_district_code' => $this->session->userdata('SUB_DISTRICT'),
												'total_row_count' => $total_row_count,
												'encr_sub_district_data' => get_encr_password(trim($this->session->userdata('SUB_DISTRICT')).$total_row_count)
												) );
		
		$export_array		=	array();
		
		
		$export_array		=	array_merge($export_array, $sub_district_data, $date_data_array, $school_master_data, $school_details_data, $escorting_details_data, $participant_item_details_data);
		return $export_array;
	}
	
	function get_district_export_data($fairid,$exb_flag = 0)
	{
		$data_data_array				=	array();
		$curr_date						=	time();
		$encr_date						=	get_encr_password($curr_date);
		$date_data_array[0]['date']		=	$curr_date;
		$date_data_array[0]['encr_date']=	$encr_date;
		
		// total rows count leaving the titles
		$total_row_count				=	0;
		
		$sub_district_code				=	$this->session->userdata('SUB_DISTRICT');
		$i								= 0;	

		$this->db->select('pid.*, rp.is_withheld,rm.rank');
		$this->db->from('result_publish rp');
		$this->db->join('result_master rm', 'rm.participant_id=rp.participant_id AND rp.item_code=rm.item_code');
		$this->db->join('participant_item_details pid', 'pid.admn_no=rm.admn_no AND pid.school_code=rm.school_code AND rp.item_code=pid.item_code');		
		
		
			/*$this->db->join('participant_item_detail pid', 'pid.admn_no=rm.admn_no AND pid.school_code=rm.school_code AND rp.school_code=pid.school_code and pid.fest_id=0');
		*/
		
		$this->db->where('pid.sub_district_code', $sub_district_code);		
		$this->db->where('pid.fairId',$fairid);
		//$this->db->where('rp.grade', 'A');
		$this->db->where('pid.is_captain', 'Y');
		$this->db->where('rp.is_withheld', 'N');
				
		$participant_captain_details			= $this->db->get();
		$participant_captain_details			= $participant_captain_details->result_array();
		//var_dump($participant_all_details);
		
		$participant_details_data			= array();
		$participant_item_details_data		= array();
		if (is_array($participant_captain_details) && count($participant_captain_details) > 0)
		{
			$j = 0;
			$participant_item_details_data[$j]['title']	= 'PID_DETAILS';
			$check_participant							= array();
			$k = 0;
			//var_dump($participant_captain_details);
			/*$participant_details_data[$k]['title'] 		= 'PD_DETAILS';*/
			foreach ($participant_captain_details as $key => $participant_captain_details)
			{
				
				//var_dump($participant_captain_details);
				$itemcode					=	$participant_captain_details['item_code'];
				$rank						=	$participant_captain_details['rank'];
				$participantid				=	$participant_captain_details['participant_id'];
				$schoolcode					=	$participant_captain_details['school_code'];
				//$grade						=	$participant_captain_details['grade'];
				//$iswithheld					=	$participant_all_details['is_withheld'];
				
				if($itemcode !=124 || $rank != 2)
				{
				/*if($exb_flag==1){
						$this->db->select('pid.*');
						
						$this->db->where('pid.exhibition',2);
						$this->db->where('pid.codeNo = (SELECT codeNo FROM participant_item_details WHERE  participant_id='.$participantid.' AND school_code='.$schoolcode.')', NULL, FALSE);
						$this->db->where('pid.prefixCode = (SELECT prefixCode FROM participant_item_details WHERE  participant_id='.$participantid.' AND school_code='.$schoolcode.')', NULL, FALSE);
						$this->db->where('pid.team_no = (SELECT team_no FROM participant_item_details WHERE  participant_id='.$participantid.' AND school_code='.$schoolcode.')', NULL, FALSE);
						
						}*/
						
						$this->db->select('pid.*');
										
						$this->db->where('pid.codeNo = (SELECT codeNo FROM participant_item_details WHERE item_code='.$itemcode.' AND participant_id='.$participantid.' AND school_code='.$schoolcode.')', NULL, FALSE);
						$this->db->where('pid.prefixCode = (SELECT prefixCode FROM participant_item_details WHERE item_code='.$itemcode.' AND participant_id='.$participantid.' AND school_code='.$schoolcode.')', NULL, FALSE);
						$this->db->where('pid.team_no = (SELECT team_no FROM participant_item_details WHERE item_code='.$itemcode.' AND participant_id='.$participantid.' AND school_code='.$schoolcode.')', NULL, FALSE);
						
						
						$this->db->from('participant_item_details pid');
						$this->db->where('pid.item_code', $itemcode);
						$this->db->where('pid.is_absent', 0);
						$this->db->where('pid.fairId',$fairid);
						
						
						if (!empty($schoolcode) && 0 != $schoolcode)
						{
							$this->db->where('pid.school_code', $schoolcode);
						}
						/*if (!empty($participant_id) && 0 != $participant_id)
						{
							$this->db->where('pid.participant_id', $participant_id);
						}*/
						$this->db->group_by('pid.participant_id');
						$this->db->order_by('pid.is_captain desc');
						$participant_details			= $this->db->get();
						$participant_all_details		= $participant_details->result_array();
						//var_dump($participant_all_details);
						if (is_array($participant_all_details) && count($participant_all_details) > 0)
					    {
							foreach ($participant_all_details as $key => $participant_all_details)
							{
				             	$j++;
							$participant_item_details_data[$j]['participant_id']				= trim($participant_all_details['participant_id']);
							$participant_item_details_data[$j]['fairId']						= trim($participant_all_details['fairId']);
							$participant_item_details_data[$j]['fest_id']						= trim($participant_all_details['fest_id']);
							$participant_item_details_data[$j]['school_code']					= trim($participant_all_details['school_code']);
							$participant_item_details_data[$j]['sub_district_code']				= trim($participant_all_details['sub_district_code']);
							$participant_item_details_data[$j]['admn_no']						= str_replace(' ','',trim($participant_all_details['admn_no']));
							
							$participant_item_details_data[$j]['item_code']						= trim($participant_all_details['item_code']);
							$participant_item_details_data[$j]['item_type']						= trim($participant_all_details['item_type']);
							$participant_item_details_data[$j]['spo_id']						= 0;
							$participant_item_details_data[$j]['spo_remarks']					= '';
							$participant_item_details_data[$j]['exhibition']					= trim($participant_all_details['exhibition']);
							$participant_item_details_data[$j]['exhibit_name']					= str_replace(',',' ',trim($participant_all_details['exhibit_name']));
							$participant_item_details_data[$j]['participant_name']				= str_replace(',',' ',trim($participant_all_details['participant_name']));
							$participant_item_details_data[$j]['class']							= trim($participant_all_details['class']);
							$participant_item_details_data[$j]['gender']						= trim($participant_all_details['gender']);
							$participant_item_details_data[$j]['team_no']						= trim($participant_all_details['team_no']);
							$participant_item_details_data[$j]['is_captain']					= trim($participant_all_details['is_captain']);
							$participant_item_details_data[$j]['encr']= get_encr_password(
							trim($participant_all_details['school_code']).trim($participant_all_details['sub_district_code']).str_replace(' ','',trim($participant_all_details['admn_no'])).str_replace(' ','',trim($participant_all_details['class'])).trim($participant_all_details['gender']).trim($participant_all_details['item_code']).trim($participant_all_details['item_type']).trim($participant_all_details['is_captain']));
							$total_row_count++;
					     } //foreach
					 }//if
						
				 }
			 }
		}
		
		if($fairid	==	4)
		{
		$exhibition_participant_details		=	$this->get_exhibition_participant_details($total_row_count);
		
		}
		

		//$total_row_count	= count($participant_item_details_data);
		//$total_row_count	= ($total_row_count >0) ? $total_row_count-2:$total_row_count;
		
		$sub_district_data	= array(0 => array('district_code' => $this->session->userdata('DISTRICT_CODE'),
												'sub_district_code' => $this->session->userdata('SUB_DISTRICT'),
												'total_row_count' => $total_row_count,
												'encr_sub_district_data' => get_encr_password(trim($this->session->userdata('DISTRICT_CODE')).trim($this->session->userdata('SUB_DISTRICT')).$total_row_count)));
		
		$export_array		=	array();
		if($fairid == 4){
		$export_array		=	array_merge($export_array, $sub_district_data, $date_data_array, $participant_item_details_data,$exhibition_participant_details);
		}
		else{
			$export_array		=	array_merge($export_array, $sub_district_data, $date_data_array, $participant_item_details_data);
		}
		return $export_array;
	}
	
	function get_exhibition_participant_details($total_row_count)
	{
		$sub_district_code				=	$this->session->userdata('SUB_DISTRICT');
		$this->db->select('pid.*, rp.is_withheld,rm.rank');
		$this->db->from('result_publish rp');
		$this->db->join('result_master rm', 'rm.participant_id=rp.participant_id AND rp.item_code=rm.item_code AND rp.school_code=rm.school_code');
		$this->db->join('participant_item_details pid', 'pid.admn_no=rm.admn_no AND pid.school_code=rm.item_code AND rp.item_code=pid.school_code and pid.fest_id=0');		
		
		
		$this->db->where('pid.sub_district_code', $sub_district_code);
		
		$this->db->where('pid.fairId',4);
		//$this->db->where('rp.grade', 'A');
		$this->db->where('pid.is_captain', 'Y');
		$this->db->where('rp.is_withheld', 'N');
				
		$participant_captain_details			= $this->db->get();
		$participant_captain_details			= $participant_captain_details->result_array();
		//var_dump($participant_captain_details);
		
		$participant_details_data			= array();
		$participant_item_details_data		= array();
		if (is_array($participant_captain_details) && count($participant_captain_details) > 0)
		{
			$j = 0;
			
			foreach ($participant_captain_details as $key => $participant_captain_details)
			{
				
				//var_dump($participant_captain_details);
				$itemcode					=	$participant_captain_details['item_code'];
				$rank						=	$participant_captain_details['rank'];
				$participantid				=	$participant_captain_details['participant_id'];
				$schoolcode					=	$participant_captain_details['school_code'];
				
				
				
						$this->db->select('pid.*');
						
						$this->db->where('pid.exhibition',2);
						$this->db->where('pid.codeNo = (SELECT codeNo FROM participant_item_details WHERE  participant_id='.$participantid.' AND school_code='.$schoolcode.' AND exhibition = 2)', NULL, FALSE);
						$this->db->where('pid.prefixCode = (SELECT prefixCode FROM participant_item_details WHERE  participant_id='.$participantid.' AND school_code='.$schoolcode.' AND exhibition = 2)', NULL, FALSE);
						$this->db->where('pid.team_no = (SELECT team_no FROM participant_item_details WHERE  participant_id='.$participantid.' AND school_code='.$schoolcode.' AND exhibition = 2)', NULL, FALSE);			
					
						
						
						$this->db->from('participant_item_details pid');
						$this->db->where('pid.exhibition', 2);
						$this->db->where('pid.is_absent', 0);						
						$this->db->where('pid.fairId',4);
						
						
						if (!empty($schoolcode) && 0 != $schoolcode)
						{
							$this->db->where('pid.school_code', $schoolcode);
						}
						/*if (!empty($participant_id) && 0 != $participant_id)
						{
							$this->db->where('pid.participant_id', $participant_id);
						}*/
						$this->db->group_by('pid.participant_id');
						$this->db->order_by('pid.is_captain desc');
						$participant_details			= $this->db->get();
						$participant_all_details		= $participant_details->result_array();
						//var_dump($participant_all_details);
						if (is_array($participant_all_details) && count($participant_all_details) > 0)
					    {
							foreach ($participant_all_details as $key => $participant_all_details)
							{
				             	$j++;
							$participant_item_details_data[$j]['participant_id']				= trim($participant_all_details['participant_id']);
							$participant_item_details_data[$j]['fairId']						= trim($participant_all_details['fairId']);
							$participant_item_details_data[$j]['fest_id']						= trim($participant_all_details['fest_id']);
							$participant_item_details_data[$j]['school_code']					= trim($participant_all_details['school_code']);
							$participant_item_details_data[$j]['sub_district_code']				= trim($participant_all_details['sub_district_code']);
							$participant_item_details_data[$j]['admn_no']						= str_replace(' ','',trim($participant_all_details['admn_no']));
							
							$participant_item_details_data[$j]['item_code']						= trim($participant_all_details['item_code']);
							$participant_item_details_data[$j]['item_type']						= trim($participant_all_details['item_type']);
							$participant_item_details_data[$j]['spo_id']						= 0;
							$participant_item_details_data[$j]['spo_remarks']					= '';
							$participant_item_details_data[$j]['exhibition']					= trim($participant_all_details['exhibition']);
							$participant_item_details_data[$j]['exhibit_name']					= str_replace(',',' ',trim($participant_all_details['exhibit_name']));
							$participant_item_details_data[$j]['participant_name']				= str_replace(',',' ',trim($participant_all_details['participant_name']));
							$participant_item_details_data[$j]['class']							= trim($participant_all_details['class']);
							$participant_item_details_data[$j]['gender']						= trim($participant_all_details['gender']);
							$participant_item_details_data[$j]['team_no']						= trim($participant_all_details['team_no']);
							$participant_item_details_data[$j]['is_captain']					= trim($participant_all_details['is_captain']);
							$participant_item_details_data[$j]['encr']= get_encr_password(
							trim($participant_all_details['school_code']).trim($participant_all_details['sub_district_code']).str_replace(' ','',trim($participant_all_details['admn_no'])).str_replace(' ','',trim($participant_all_details['class'])).trim($participant_all_details['gender']).trim($participant_all_details['item_code']).trim($participant_all_details['item_type']).trim($participant_all_details['is_captain']));
							$total_row_count++;
					     } //foreach
					 }//if
				
			 }
		}
		
		return $participant_item_details_data;
	
	}
		

}
?>