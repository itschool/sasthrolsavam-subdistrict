<?php 
function get_school_participant_details ($fair ='', $school_code ='',$festival='', $item_code=0, $captain_id='', $participant_id='',$exb_flag=0){
			$data	=	array();
			//echo '<br><br><br>fffff'.$fair;
			//$arryrank		=	"(cm.rank IN ('1','2','3'))";
			$certificate_type_cont		=	$this->get_certificate_type_condition();
			if ($certificate_type_cont)
			{
				$this->db->where($certificate_type_cont);
			}
			
			$this->db->select('cm.item_code, cm.participant_id, cm.school_code,cm.grade, cm.is_withheld,cm.rank,rm.is_certificate_printed,rm.fest_id');
			$this->db->from('certificate_master cm');
			$this->db->join('result_master rm', 'rm.participant_id=cm.participant_id');
			
			if($exb_flag ==1){$this->db->where('rm.item_code = rm.school_code');}
			else {$this->db->join('item_master i', 'i.item_code=cm.item_code');
			$this->db->join('festival_master f', 'f.fest_id=i.fest_id');}
			$this->db->where('cm.is_withheld', 'N');
			//$this->db->where('rm.is_certificate_printed', 0);
			
			
			if (!empty($fair) && 0 != $fair)
			{
				if($exb_flag==0)
				$this->db->where('i.fairId', $fair);
			}
			if (!empty($school_code) && 0 != $school_code)
			{
				$this->db->where('cm.school_code', $school_code);
			}
			
			if($fair==4){
					if($this->input->post('radioLabel') != 'exhib'){
							if (!empty($item_code) && 0 != $item_code)
							{
								$this->db->where('cm.item_code', $item_code);
							}
					}
			}		
			if($fair!=4 && $fair!=''){
							if (!empty($item_code) && 0 != $item_code)
							{
							$this->db->where('cm.item_code', $item_code);
							}
			}		
							
			if (!empty($item_code) && 0 != $item_code)
							{
							$this->db->where('cm.item_code', $item_code);
							}
							
			if (!empty($captain_id) && (0 != $captain_id ))
			{
				$this->db->where('cm.participant_id', $captain_id);
			}
			if($fair==4){
				  if($this->input->post('radioLabel') == 'spot'){
					if (!empty($festival) && 0 != $festival ){ 
						$this->db->where('f.fest_id', $festival);
					}
				  }
				  else{
				  if($exb_flag==0)
						$this->db->where('f.fest_id', $festival);
				  }	
			}
			if($fair!=4 && $fair!=''){
				if (!empty($festival) && 0 != $festival){ 
						$this->db->where('f.fest_id', $festival);
				}
			}
			$certificate_details		= $this->db->get();
			$data['certificate_details']= $certificate_details->result_array();
			
			if(count($data['certificate_details'])>0){
				foreach($data['certificate_details'] as $row){
						$cm_itemcode			=	$row['item_code'];
						$cm_participantid		=	$row['participant_id'];
						$cm_schoolcode			=	$row['school_code'];
						$cm_grade				=	$row['grade'];
						$cm_iswithheld			=	$row['is_withheld'];
						$cm_rank				=	$row['rank'];
						if($row['fest_id']==1)$fest = 'LP';
						else if($row['fest_id']==2)$fest = 'UP';
						else if($row['fest_id']==3)$fest = 'HS';
						else if($row['fest_id']==4)$fest = 'HSS';
						
						
						if($exb_flag==1){
						$this->db->select('pid.participant_id, pid.participant_name,pid.exhibition as item_name,pid.exhibition as fest_name,pid.exhibition as is_teach, sm.school_code, sm.school_name, sd.sub_district_name,
							pid.class, pid.gender');
						
						$this->db->where('pid.exhibition',2);
						$this->db->where('pid.codeNo = (SELECT codeNo FROM participant_item_details WHERE  participant_id='.$cm_participantid.' AND school_code='.$cm_schoolcode.')', NULL, FALSE);
						$this->db->where('pid.prefixCode = (SELECT prefixCode FROM participant_item_details WHERE  participant_id='.$cm_participantid.' AND school_code='.$cm_schoolcode.')', NULL, FALSE);
						$this->db->where('pid.team_no = (SELECT team_no FROM participant_item_details WHERE  participant_id='.$cm_participantid.' AND school_code='.$cm_schoolcode.')', NULL, FALSE);
						
						}
						else {
						$this->db->select('pid.participant_id, pid.participant_name, sm.school_code, sm.school_name, sd.sub_district_name,
							i.item_name,i.is_teach, f.fest_name, pid.class, pid.gender');
						
						$this->db->join('item_master i', 'i.item_code=pid.item_code');
						$this->db->join('festival_master f', 'f.fest_id=i.fest_id');
						
						$this->db->where('pid.codeNo = (SELECT codeNo FROM participant_item_details WHERE item_code='.$cm_itemcode.' AND participant_id='.$cm_participantid.' AND school_code='.$cm_schoolcode.')', NULL, FALSE);
						$this->db->where('pid.prefixCode = (SELECT prefixCode FROM participant_item_details WHERE item_code='.$cm_itemcode.' AND participant_id='.$cm_participantid.' AND school_code='.$cm_schoolcode.')', NULL, FALSE);
						$this->db->where('pid.team_no = (SELECT team_no FROM participant_item_details WHERE item_code='.$cm_itemcode.' AND participant_id='.$cm_participantid.' AND school_code='.$cm_schoolcode.')', NULL, FALSE);
						
						}
						
						$this->db->from('participant_item_details pid');
						$this->db->join('school_master sm', 'sm.school_code=pid.school_code');
						$this->db->join('sub_district_master AS sd', 'sm.sub_district_code=sd.sub_district_code');
						
						$this->db->where('pid.is_absent', 0);
						
						
						if (!empty($cm_schoolcode) && 0 != $cm_schoolcode)
						{
							$this->db->where('pid.school_code', $cm_schoolcode);
						}
						if (!empty($participant_id) && 0 != $participant_id)
						{
							$this->db->where('pid.participant_id', $participant_id);
						}
						$this->db->group_by('pid.participant_id');
						$this->db->order_by('pid.is_captain desc');
						$participant_details			= $this->db->get();
						$data['participant_details'][$cm_participantid]	= $participant_details->result_array();
						//if($exb_flag == 1)$data['participant_details']['fest_names']	= $fest;
						
						$update['is_certificate_printed']	=	1;
						$this->db->where('participant_id',$cm_participantid);
						$this->db->update('result_master',$update);
				}
				/*else{
				$data['participant_details'][$cm_participantid]	=	'null';
				}*/
				
			}
			
			//echo '<br><br><br>';
			//print_r($data);
			return $data;
	}
?>