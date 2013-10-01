<?php
class Prereport_Model extends CI_Model{
	function Prereport_Model()
	{
		parent::__construct();
	}


	function participating_schoolDetails($cmbFairType,$cmbCateType)
	{
		$exhib = '';
		if(@$this->input->post('radioLabel')== 'exhib')
		{
			$exhib = @$this->input->post('radioLabel');
		}
		
		if($cmbFairType	==	4 && $exhib == 'exhib')
		 {
			$limit	=	$this->exhibition_category($cmbFairType,$cmbCateType);
	     }
		$ground = ",GIM.*,GM.ground_name";
		//$ground = "";
		$this->db->select('distinct(PID.school_code),SD.school_name,PID.codeNo,PID.fairId,PID.fest_id,PID.item_code as pid_item_code,PID.code_confirmed,PID.codeGeneratedFlag,PID.is_absent,PID.is_captain,PID.prefixCode'.$ground);
		$this->db->from('participant_item_details AS PID');
		$this->db->join('school_master AS SD','PID.school_code = SD.school_code','LEFT');
		if($cmbFairType	==	4 && $exhib == 'exhib')
		 {	$this->db->join('ground_item_master AS GIM ','GIM.item_code = PID.school_code');
		 }
		 else
		 { $this->db->join('ground_item_master AS GIM ','GIM.item_code = PID.item_code');
		 }
		$this->db->join('ground_master AS GM ','GM.ground_id = GIM.ground_id');
		if($cmbFairType	==	4 && $exhib == 'exhib')
		 {	$this->db->where('GIM.item_code = PID.school_code');
		 }
		 else
		 {$this->db->where('GIM.item_code = PID.item_code');
		 }
		$this->db->where('PID.is_captain','Y');
		if($cmbFairType	==	4 && $exhib == 'exhib') {		      
			$this->db->join('school_details AS S',"SD.school_code = S.school_code AND ".$limit."");			
			$this->db->where('PID.fest_id','0'); 
		}		
		if($cmbFairType	!=	4) {			
			$this->db->where('PID.fest_id',$cmbCateType); 
		}
		
		$this->db->where('PID.fairId',$cmbFairType);
		$this->db->group_by('PID.school_code');
		$this->db->order_by('PID.code_confirmed','desc');
		$this->db->order_by('PID.school_code');	
		$this->db->order_by('PID.team_no');		
		$this->db->order_by('PID.is_captain','desc');		
		$this->db->order_by('PID.participant_id');
		$school_details		=	$this->db->get();
		return $school_details->result_array();
		
	}
	
	
	
	function participate_school_details($cmbFairType,$cmbCateType,$exhbdateFlag = 0,$date = 0)
	{
		//echo "<br /><br />-".$this->input->post('radioLabel');
		
		$where = '';
		$limit	=	$this->exhibition_category($cmbFairType,$cmbCateType);
		if($exhbdateFlag == 1)
		{
			$where = "and PID.code_confirmed = 1";
			if($date != 'All')
			{  $where .= " and date(GIM.start_time) = '$date'";
			}
			
		}
		if($exhbdateFlag == 1)
		{$order_by = "PID.code_confirmed desc , PID.school_code, 
		PID.team_no,PID.is_captain desc,PID.participant_id,date(GIM.start_time)";
		}else
		{	$order_by = "PID.code_confirmed desc , PID.school_code, 
		PID.team_no,PID.is_captain desc,PID.participant_id";
		}
		
		$query1="SELECT PID.school_code , PID.school_code AS cpt, 
		PID.school_code AS item_code, SM.school_name AS 
		item_name,SM.school_name, GIM .start_time,GIM .ground_id,GIM .no_of_judges, 
		GM.ground_name, GM.ground_desc ,PID.codeNo,PID.code_confirmed,
		PID.codeGeneratedFlag,PID.is_absent,PID.is_captain,PID.prefixCode,PID.participant_id
		,PID.fairId,PID.fest_id,GIM.*,GM.ground_name,PID.item_code		
		FROM participant_item_details AS PID
		JOIN school_master AS SM ON SM.school_code = PID.school_code
		LEFT JOIN ground_item_master AS GIM  ON (GIM.item_code=PID.school_code)
		LEFT JOIN ground_master AS GM ON GM.ground_id = GIM.ground_id
		JOIN school_details AS S ON S.school_code = SM.school_code AND ".$limit."
		WHERE PID.fest_id =0 AND PID.is_captain = 'Y'
		AND PID.fairId = ".$cmbFairType." $where
		GROUP BY PID.school_code 
		ORDER BY $order_by";
		//echo "<br><br>----------".$query1;
		
		 $district_wise_result	=	$this->db->query($query1);		  
		
		return $district_wise_result->result_array();
	
	}
	
	function getExhib_allDate($cmbFairType,$cmbCateType)
	{			//echo "-".$this->input->post('radioLabel');
		
		$exhib = $this->input->post('radioLabel');
		if($cmbFairType	==	4 && $exhib == 'exhib')
		 {
			$limit	=	$this->exhibition_category($cmbFairType,$cmbCateType);
	     }
		$ground = ",GIM.*,GM.ground_name";
		$this->db->select('distinct(PID.school_code)'.$ground);
		$this->db->from('participant_item_details AS PID');
		//$this->db->join('school_master AS SD','PID.school_code = SD.school_code','LEFT');
		      
			$this->db->join('school_details AS S',"S.school_code = PID.school_code AND ".$limit."");	
		$this->db->join('ground_item_master AS GIM ','GIM.item_code = S.school_code');
		$this->db->join('ground_master AS GM ','GM.ground_id = GIM.ground_id');
		$this->db->where('GIM.item_code = PID.school_code');
		$this->db->where('PID.is_captain','Y');
				
		$this->db->where('PID.fest_id','0'); 
	
		$this->db->where('PID.code_confirmed',1);
		
		$this->db->where('PID.fairId',$cmbFairType);
		$this->db->group_by('date(GIM.start_time)');
		$this->db->order_by('date(GIM.start_time)');
		$this->db->order_by('PID.code_confirmed','desc');
		$this->db->order_by('PID.school_code');	
		$this->db->order_by('PID.team_no');		
		$this->db->order_by('PID.is_captain','desc');		
		$this->db->order_by('PID.participant_id');
		
		$school_details		=	$this->db->get();
		return $school_details->result_array();
		
	}
	
	
	
	function exhibCodeGen($cmbFairType,$cmbCateType)
	{  
		$retVal 	=   $this->e_codeGeneration($cmbFairType,$cmbCateType);
		return  $retVal;
	
	}
	function e_codeGeneration($fair,$festival)
	{
		$charArr	=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
		$Dist_detail = $this->participate_school_details($fair,$festival);
		//echo "<br><br>---".$festival;
		//var_dump($school_detail);
		if(count($Dist_detail)>0)
		{
			$slno = 0;
			
			$slno = "0".$festival;
			
			$prefx = "E";	
			$codeNo = 0;
			$flag 	= 0;
			$i=0;$j=0;
			$arr 	= array();
			
			foreach($Dist_detail as $data)
			{
				$school_code = $data['school_code'];
				$codeNo++;
				$alpha_no='';
				if($flag == 1 && $j < count($charArr))
				{
					if($i >= count($charArr))
					{
						$j++;
						$i=0;
					}
					if($i < count($charArr))
					{
						$codeNo = $charArr[$i];
						$i++;
					}
					
				}//if array number code completed and flag one
				if($j < count($charArr) && $flag == 0)
				{
					if($codeNo > 9)
					{
						$j++;
						$codeNo = 1;
					}//if code no
				}//if array number code not completed and flag zero
			
				if($j >= count($charArr) && $flag == 0)
				{
					$flag = 1;
					if($i == 0)
					{
						$j=0;
					}
					$codeNo = $charArr[$i];
					$i++;
									
				}////if array number code completed and flag zero
				
				
				$alpha 		= $charArr[$j];
				$alpha_no	= $alpha.$codeNo;
				
				$code 		= $slno.$alpha_no;
				$arr['prefixCode']	=	 $prefx;
				//echo "<br /><br />-------------Code------>".$code;
									
				$arr['codeNo']	=	$code;
				$arr['code_confirmed']	=	0;
				$arr['codeGeneratedFlag']	=	1;
				if($data['code_confirmed']  != 1)
					{
				/////////////////Updating Code for each participant////////
				$this->db->where('school_code',$school_code);	
				$this->db->where('fairId',$fair);
				$this->db->where('fest_id',0);
				$this->db->update('participant_item_details',$arr);
				}
			}//foreach
	
			return "yes";
		}//if count > 0
		else
		{
			return "no";
		}
		
	}//fn
	
	
	///////////////////////////////////////////////////////////////////////////////
	function get_FairName($cmbFairType){
			 $this->db->where('fairId',$cmbFairType);
			 $result	=	$this->db->get('science_master');	
			 return $result->result_array();
	}
	
	function getItemName($itemCode,$fairId,$festid){
			 $this->db->where('fairId',$fairId);
			 $this->db->where('fest_id',$festid);
			 $this->db->where('item_code',$itemCode);
			 $result	=	$this->db->get('item_master');	
			 return $result->result_array();
	}
	
	
	//function save code for call sheet
	function saveCode_array($type)
	{
		$data = array();
		$no		=	$this->input->post('item_no');
		$prefix = 	$this->input->post('prefixCode');
		$startNo = 	$this->input->post('start_no');
		
		$fairId			=	$this->input->post('cmbFairType');
		$fest_id		=	$this->input->post('cmbCateType');
		$item_code		=	$this->input->post('cbo_item');
		
		$data['start_number'] =	$startNo;
		for($i=1;$i<=$no;$i++)
		{
			$reg 			= 'reg_'.$i;
			$regno 			= $this->input->post($reg);
			$participant_id = $regno;
			$textbx			= 'code_'.$regno;
			$team			= 'teamno_'.$regno;
			$codeVal		=	$this->input->post($textbx);
			$teamNo			=	$this->input->post($team);
			$school_code	=	$this->input->post('schoolCode_'.$regno);
			$data['code_confirmed'] = 0;
			$data['codeGeneratedFlag']	=	1;
			//checking if absent
			if($codeVal == '' || $codeVal == '0')
			{
				$data['codeNo'] = $codeVal;
				$data['prefixCode'] = $prefix;
				$data['is_absent'] = 1;
				
			}
			else
			{
				$data['codeNo'] = $codeVal;
				$data['prefixCode'] = $prefix;
				$data['is_absent'] = 0;
			}
			if($type == 1)
			{
				$data['code_confirmed'] = 1;
			}
			
			//update
			$this->db->where('fairId',$fairId);
			$this->db->where('fest_id',$fest_id);
			$this->db->where('item_code',$item_code);
			$this->db->where('school_code',$school_code);
			$this->db->where('team_no',$teamNo);
			
			$this->db->update('participant_item_details',$data);
			
			//$query = "UPDATE `participant_item_details` SET `code_confirmed` = 0, `codeNo` = '".$data['codeNo']."', `prefixCode` = '".$data['prefixCode']."', `is_absent` = ".$data['is_absent']." WHERE `fairId` = ".$fairId." AND `fest_id` = ".$fest_id."  AND `item_code` = ".$item_code."  AND `school_code` = ".$school_code."  AND `team_no` = ".$teamNo." ";
			//echo "<br><br>".$query;
			//mysql_query($query);
			
		}//for
		
	}//fn
	
	function checkresultEntered()
	{
		$fairId			=	$this->input->post('cmbFairType');
		$fest_id		=	$this->input->post('cmbCateType');
		$item_code		=	$this->input->post('cbo_item');
		
		$this->db->select('*');
		$this->db->from('result_master');
		$this->db->where('fairId',$fairId);
		$this->db->where('fest_id',$fest_id);
		$this->db->where('is_finish','Y');
		$this->db->where('item_code',$item_code);
		$cnf_details		=	$this->db->get();
		$arr		=	$cnf_details->result_array();
		//echo "-------".count($cnf_details->result_array());
		if(count($cnf_details->result_array()) > 0)
		{
			return "yes";
		}
		else
				return "no";
	}//fn
	
	
	function checkresultEntered_workExpo($fairId,$fest_id,$item_code,$exhb=0)
	{	
		$this->db->select('*');
		$this->db->from('result_master');
		$this->db->where('fairId',$fairId);
		$this->db->where('fest_id',$fest_id);
		$this->db->where('is_finish','Y');
		if($exhb == 0)
		{	$this->db->where('item_code',$item_code);  }
		else
		{  $this->db->where('length(item_code) > ',3); }
	
		$cnf_details		=	$this->db->get();
		$arr		=	$cnf_details->result_array();
		//echo "-------".count($cnf_details->result_array());
		if(count($cnf_details->result_array()) > 0)
		{
			return "yes";
		}
		else
				return "no";
	}//fn
	
	function resetWorkExpo_Code($fairId,$fest_id,$item_code,$exhb=0)
	{
		$arrVal['codeGeneratedFlag'] = 0;
		if($exhb == 0)
		{
			$this->db->where('fairId',$fairId);
			$this->db->where('fest_id',$fest_id);
			$this->db->where('item_code',$item_code);
			$this->db->update('participant_item_details',$arrVal);
		}
		elseif($exhb == 1)
		{//echo "in";
			$limit	=	$this->exhibition_category($fairId,$fest_id);
			$this->db->select('distinct(PID.school_code) as school');
			$this->db->from('participant_item_details AS PID');
			$this->db->join('school_master AS SD','PID.school_code = SD.school_code','LEFT');
			$this->db->join('school_details AS S',"SD.school_code = S.school_code AND ".$limit."");		
			$this->db->where('PID.is_captain','Y');
			$this->db->where('PID.fest_id','0'); 
			$this->db->where('PID.fairId',$fairId);
			
			$this->db->group_by('PID.school_code');
			$this->db->order_by('PID.code_confirmed','desc');
			$this->db->order_by('PID.school_code');	
			$this->db->order_by('PID.team_no');		
			$this->db->order_by('PID.is_captain','desc');		
			$this->db->order_by('PID.participant_id');
			$res_school_details		=	$this->db->get();
			$school_details		=	$res_school_details->result_array();
			//var_dump($school_details);
			foreach($school_details as $school_det)
			{
				$school_code	=	$school_det['school'];
				$this->db->where('fairId',$fairId);
				$this->db->where('fest_id',0);
				$this->db->where('school_code',$school_code);
				$this->db->update('participant_item_details',$arrVal);
			}
		}
	}
	
	
	////////////////// check Code generated /////////////
	function checkCodeEntered($codegen_all = 0)
	{
		$flag			=	0;
		$fairId			=	$this->input->post('cmbFairType');
		$fest_id		=	$this->input->post('cmbCateType');
		$item_code		=	$this->input->post('cbo_item');
		if($item_code	!= "ALL")
		{
			if($fairId	==	4 && $this->input->post('radioLabel') == 'exhib') 
			{
				$arr	=	$this->participate_school_details($fairId,$fest_id);
			}
			else
			{
				$this->db->select('*');
				$this->db->from('participant_item_details');
				$this->db->where('fairId',$fairId);
				$this->db->where('fest_id',$fest_id);
				$this->db->where('item_code',$item_code);
				$cnf_details		=	$this->db->get();
				$arr		=	$cnf_details->result_array();
			}
			//echo "<br><br>-------".count($cnf_details->result_array());
			if(count($arr) > 0)
			{
				foreach($arr as $row)
				{
					if($row['code_confirmed'] == 0)
					{
						$flag = 1;
						break;
					}
					
				}//foreach
				//echo"<br><br>-------".$flag;
				if($flag == 0 )
					return "yes";
				elseif($flag == 1 )
					return "no";
					
			}
			else
					return "no";
		}//if not all item
		else
		{
			$itemList =  $this->fair_item_wise($fest_id,$fairId);
			foreach($itemList as $item)
			{	$flag			=	0;
				$itemCode = $item['item_code'];
				$this->db->select('*');
				$this->db->from('participant_item_details');
				$this->db->where('fairId',$fairId);
				$this->db->where('fest_id',$fest_id);
				$this->db->where('item_code',$itemCode);
				$cnf_details		=	$this->db->get();
				$arr		=	$cnf_details->result_array();
			
				if($codegen_all == 0)
				{
					if(count($arr) > 0)
					{
						foreach($arr as $row)
						{
							if($row['code_confirmed'] == 0)
							{
								$flag = 1;
								break;
							}
							
						}//foreach
						if($flag == 1 )
						{	
							break;
						}
						
					}
					
				}//if code not yet generated
				else
				{
					if(count($arr) > 0)
					{  foreach($arr as $row)
						{
							if($row['codeGeneratedFlag'] == 1)
							{	$flag = 1;
								break;
							}
							
						}//foreach
						if($flag == 1 )
						{	break;
						}
						
					}
										
				}//else if code generated once
			}//foreach
				//echo "<br><br>".$flag.$row['item_code'];
			if($flag == 1 )
			{	return "no";
			}
			elseif($flag == 0 )
					return "yes";
		}//elseif all item
	}//fn
	
	
	
	function fair_item_wise($festid,$fair)
	{//echo "--";
	$this->db->select('I.*');
	$this->db->from('item_master AS I');
	$this->db->join('ground_item_master AS GIM ','GIM.item_code = I.item_code');
	$this->db->join('ground_master AS GM ','GM.ground_id = GIM.ground_id');
	$this->db->where('I.fest_id',$festid);
	$this->db->where('I.fairId',$fair);
	$this->db->group_by('I.item_code');
	$this->db->order_by('I.item_code');
	$retdata=$this->db->get();
	return $retdata->result_array();
	}//fn
	
	function checkConfrm()
	{
		$cflag = 0;
		
			$fairId			=	$this->input->post('cmbFairType');
			$fest_id		=	$this->input->post('cmbCateType');
			$item_code		=	$this->input->post('cbo_item');
			
			$this->db->select('*');
			$this->db->from('participant_item_details');
			$this->db->where('fairId',$fairId);
			$this->db->where('fest_id',$fest_id);
			$this->db->where('item_code',$item_code);
			$cnf_details		=	$this->db->get();
			$arr	=	$cnf_details->result_array();
				
			if(count($arr)>0)
			{
				for($j=0; $j<count($arr); $j++)
				{
					if($arr[$j]['code_confirmed'] == 1 )
					{
						$cflag = 1;
						break;
					}
				}//for
			}//if
			
			if($cflag == 0)
			{
				return "no";
			}
			else
					return "yes";
		
		
	}
	
	function resetCode()
	{
		$fairId			=	$this->input->post('cmbFairType');
		$fest_id		=	$this->input->post('cmbCateType');
		$item_code		=	$this->input->post('cbo_item');
		$arrVal['code_confirmed'] = 0;
		
		$this->db->where('fairId',$fairId);
		$this->db->where('fest_id',$fest_id);
		$this->db->where('item_code',$item_code);
		$this->db->update('participant_item_details',$arrVal);
	}
	
	function list_eligible_schools()
	{
		$user_id		=	$this->session->userdata('USERID');
		$subdist		=	$this->session->userdata('SUB_DISTRICT');
		$usrtype        =   $this->session->userdata('USER_TYPE');
		
		$this->db->select('sm.school_code, sm.school_name, sm.sub_district_code, sdm.sub_district_name');
		$this->db->from('school_master AS sm');
		$this->db->from('sub_district_master  AS sdm');
		$this->db->where('sdm.sub_district_code',$subdist);
		$this->db->where('sm.sub_district_code = sdm.sub_district_code');
		$this->db->order_by('sm.school_code');
		$school_details		=	$this->db->get();
		return $school_details->result_array();
	}
	
	function list_all_school_details()
		{
			$this->db->select('SD.*,SM.school_name');
			$this->db->from('school_master AS SM');
			$this->db->join('school_details AS SD','SM.school_code = SD.school_code');
			$school_details		=	$this->db->get();
			return $school_details->result_array();
		}
	
	function itemwise_allfestival($festid,$fair)
		{
		$this->db->select('pd.participant_name,pd.spo_id, pd.class, pd.school_code, pd.gender, pd.participant_id, pd.item_code, pd.item_type, pd.is_captain, m.school_name, I.item_name,I.is_teach, f.fest_name');
		$this->db->from('participant_item_details AS pd');
		$this->db->join('school_master AS m','m.school_code = pd.school_code');
		$this->db->join('item_master AS I','I.item_code = pd.item_code');
		$this->db->join('festival_master AS f','f.fest_id = I.fest_id');
		$this->db->where('pd.fest_id',$festid);
		$this->db->where('pd.fairId',$fair);
		$this->db->where('pd.is_captain','Y');
		$this->db->group_by('pd.participant_id');
		$this->db->group_by('pd.item_code');
		$this->db->order_by('pd.item_code');
		$retdata=$this->db->get();
		return $retdata->result_array();
		}
	
	function festval_details()
	{
		$this->db->from('science_master AS SM');
		$school_details		=	$this->db->get();
		return $school_details->result_array();
	}
	
	function get_participant_details($school_code, $fairId='')
	{
		$this->db->where('PD.school_code',$school_code);
		$this->db->where('PD.fairId',$fairId);
		$this->db->join('school_master AS SM','SM.school_code = PD.school_code');
		$this->db->join('item_master AS I','I.item_code = PD.item_code');
		$this->db->distinct('PD.participant_id');
		$this->db->select('PD.*,SM.school_name,I.is_teach');
		$this->db->order_by('PD.participant_id');
		$this->db->group_by('PD.participant_id');
		$participant		=	$this->db->get('participant_item_details AS PD');
		return $participant->result_array();
		
	}
	
	
	function get_participant_item_details($participant_id,$fairId,$exb=0)
	{
		
		if($exb==0)
		{
		$this->db->select('PD.*,IM.item_name,ST.ground_name,SM.start_time');
		$this->db->join('item_master AS IM','IM.item_code = PD.item_code');
		$this->db->join('ground_item_master AS SM','IM.item_code = SM.item_code','LEFT');
		}
		else
		{
		$this->db->select('PD.*,ST.ground_name,SM.start_time');
		$this->db->join('ground_item_master AS SM','SM.item_code = PD.school_code','LEFT');
		}
		$this->db->join('ground_master AS ST','ST.ground_id = SM.ground_id','LEFT');
		//$this->db->distinct('PD.participant_id');
		$this->db->where('PD.participant_id',$participant_id);
		$this->db->where('PD.fairId',$fairId);
		
		$participant		=	$this->db->get('participant_item_details AS PD');
		return $participant->result_array();
		
	
	}
	
	function get_participant_regno($regno,$fairId)
	{
	$this->db->from('school_details AS sd');
		$this->db->select('sd.school_code,mj.school_name, pid.participant_id, pid.school_code,pid.gender, pid.participant_name,pid.exhibition,
pid.class, pid.gender, pid.item_code, pid.item_type, pid.is_captain, it.item_name, it.fest_id,it.is_teach, sm.ground_id, date(sm.start_time) AS datee, ssm.ground_desc,ssm.ground_name, fm.fest_name,scm.fairName,scm.fairId');
		$this->db->join('school_master AS mj','mj.school_code = sd.school_code');
		$this->db->join('participant_item_details  AS pid ','pid.school_code = sd.school_code');
		$this->db->join('item_master AS it','it.item_code = pid.item_code');
		$this->db->join('festival_master AS fm','fm.fest_id = it.fest_id');
		$this->db->join('ground_item_master AS sm','sm.item_code = it.item_code','LEFT');
		$this->db->join('ground_master AS ssm','ssm.ground_id = sm.ground_id','LEFT');
		$this->db->join('science_master AS scm','scm.fairId = pid.fairId');
		$this->db->where('pid.participant_id',$regno);
		$this->db->where('pid.fairId',$fairId);
		$this->db->group_by('pid.item_code');
		$this->db->order_by('it.fest_id'); 
		$this->db->order_by('pid.participant_id');
		$this->db->order_by('pid.item_code');
		$school_details		=	$this->db->get();
		return $school_details->result_array();
	}
	
	function timesheet_details($festid,$itemcode)
	{
		$this->db->where('m.item_code',$itemcode);
	 	$this->db->where('m.fest_id',$festid);
	 	$this->db->select('m.item_code, m.item_name, m.fest_id,f.fest_name');
	 	$this->db->from('item_master AS m');
	    $this->db->from('festival_master AS f');
	    $this->db->group_by('m.item_code');
	    $fest_details		=	$this->db->get();
		return $fest_details->result_array();
	}
	
	function timesheet($itemcode)
	{
		$this->db->from('item_master AS IT');
		$this->db->where('IT.item_code ',$itemcode);
		$this->db->join('ground_item_master AS ST','ST.item_code = IT.item_code','LEFT');
		$this->db->join('ground_master AS SM','SM.ground_id = ST.ground_id','LEFT');
		$this->db->select('IT.*,SM.ground_name,date(ST.start_time) as ttime');
		$item_details		=	$this->db->get();
		return $item_details->result_array();
	}
	
	function timesheet_date($festival,$date,$fair)
	{
		$que="SELECT *,SM.start_time,
		(select count(*) from participant_item_details AS PID where PID.item_code = IM.item_code and is_captain = 'Y' and PID.fairId='$fair') as item_count,
		IM.item_name, IM.item_code, date(SM.start_time) as item_date
		FROM `item_master` AS IM
		JOIN festival_master AS FM ON IM.`fest_id` = FM.`fest_id`
		JOIN ground_item_master AS SM ON IM.`item_code` = SM.`item_code`
		JOIN ground_master AS ST ON ST.`ground_id` = SM.`ground_id`
		WHERE date(SM.start_time) ='$date' and FM.fest_id='$festival' ";
		
		$fest_data=$this->db->query($que);
		return  $fest_data->result_array();
	}
	
	function Festname($festval)
	{
	    $this->db->from('festival_master AS FM');
		$this->db->where('FM.fest_id',$festval);
		
		$festname		=	$this->db->get();
		return $festname->result_array();
	}
	function participate_item_details($festid)
	{
		$this->db->where('PD.admn_no = PM.admn_no');
		$this->db->from('participant_item_details AS PD');
		$this->db->join('participant_details  AS PM ','PD.school_code = PM.school_code');
		$this->db->join('school_master as SM','SM.school_code=PM.school_code');
		$this->db->join('item_master   AS IM ','IM.item_code = PD.item_code');
		$this->db->join('festival_master   AS FM','FM.fest_id = IM.fest_id');
		if ($festid)
		{
			$this->db->where('FM.fest_id',$festid);
		}
		$this->db->group_by('PM.school_code');
		$this->db->order_by('PM.school_code');
		$school_details		=	$this->db->get();
		return $school_details->result_array();
	}
	
	function itempart_details()
	{
		$this->db->from('festival_master AS FM');
		$school_details		=	$this->db->get();
		return $school_details->result_array();
	}
	
	function  fetch_item_name2($item_id,$allitem = 0,$tabulation_score =0)
	{
		
		if($allitem == 0)
		{
			$where = "";
			if($tabulation_score ==0)
			{
				$where = "and PD.is_captain = 'Y' ";
			}
			$que="SELECT *,PD.codeNo,PD.prefixCode,PD.is_absent,PD.code_confirmed,PD.is_captain
FROM `item_master` AS IM
JOIN festival_master AS FM ON IM.`fest_id` = FM.`fest_id`
JOIN participant_item_details  AS PD ON PD.item_code = IM.item_code
LEFT JOIN ground_item_master AS SM ON IM.`item_code` = SM.`item_code`
LEFT JOIN ground_master AS ST ON ST.`ground_id` = SM.`ground_id`
WHERE IM.`item_code` =$item_id and PD.is_absent = 0 $where
group by PD.participant_id order by PD.code_confirmed desc,PD.codeGeneratedFlag desc,PD.code_order,PD.spo_id,PD.spo_team,PD.school_code,PD.team_no,PD.is_captain desc,PD.participant_id ";
//echo "<br><br>".$que;
//group by PD.participant_id order by PD.school_code,FM.fest_id,PD.team_no,PD.is_captain desc";		
		 $fest_data=$this->db->query($que);
		 return  $fest_data->result_array();
		}
		elseif($allitem == 1)
		{//echo "----";
			 $fair 		=	$this->input->post('cmbFairType');	
			 $festival	= 	$this->input->post('cmbCateType');
			 
		
		$que="SELECT *,PD.codeNo,PD.prefixCode,PD.is_absent,PD.code_confirmed,PD.is_captain
FROM `item_master` AS IM
JOIN festival_master AS FM ON IM.`fest_id` = FM.`fest_id`
JOIN participant_item_details  AS PD ON PD.item_code = IM.item_code
 JOIN ground_item_master AS SM ON IM.`item_code` = SM.`item_code`
 JOIN ground_master AS ST ON ST.`ground_id` = SM.`ground_id`
WHERE PD.is_captain = 'Y' and PD.is_absent = 0 and FM.`fest_id` =$festival 
AND PD.fairId=$fair group by IM.item_code
order by IM.item_code,PD.participant_id,PD.school_code,FM.fest_id,PD.team_no,PD.is_captain desc ";
//echo "--".$que;
   $fest_detail1		=	$this->db->query($que);
		return $fest_detail1->result_array();
		}
		
 }
	
	function datewise_participants($date,$fair)
	{
	   
		$this->db->from('school_master AS SD');
		
		$this->db->join('participant_item_details  AS PD ','PD.school_code = SD.school_code');
		
		$this->db->join('ground_item_master  AS SIM ','SIM.item_code = PD.item_code');
		
		$this->db->where("DATE_FORMAT(SIM.start_time,'%Y-%m-%d')",$date);
		
		$this->db->where('PD.fairId',$fair);
		
		$this->db->select('COUNT(PD.pi_id) as total, PD.item_code, PD.admn_no, SD.school_code, SD.school_name');
		
		$this->db->group_by('SD.school_code');
		
		$participants_details		=	$this->db->get();
		return $participants_details->result_array();
	}
	//=====================================================date wise 
	
	function lpstudents_date($date,$fair)
	{
	$this->db->select('count( pd.pi_id ) AS cntlp, pd.school_code, pd.gender, date( sm.start_time ) AS sdt');
	$this->db->from('participant_item_details AS pd');
	$this->db->join('school_master  AS s','s.school_code = pd.school_code');
	$this->db->join('ground_item_master AS sm','sm.item_code = pd.item_code');
	$this->db->where('pd.fairId',$fair);
	$this->db->where('date( sm.start_time )=',$date);
	$this->db->where('pd.class BETWEEN 1 AND 4');
	$this->db->group_by('pd.gender');
	$this->db->group_by('pd.school_code');
	$participants_details		=	$this->db->get();
	return $participants_details->result_array();
	}
	function upstudents_date($date,$fair)
	{
	$this->db->select('count( pd.pi_id ) AS upid, pd.school_code, pd.gender, date( sm.start_time ) AS sdt');
	$this->db->from('participant_item_details AS pd');
	$this->db->join('school_master  AS s','s.school_code = pd.school_code');
	$this->db->join('ground_item_master AS sm','sm.item_code = pd.item_code');
	$this->db->where('date( sm.start_time )=',$date);
	$this->db->where('pd.fairId',$fair);
	$this->db->where('pd.class BETWEEN 5 AND 7');
	$this->db->group_by('pd.gender');
	$this->db->group_by('pd.school_code');
	$participants_details		=	$this->db->get();
	return $participants_details->result_array();
	}
	function hsstudents_date($date,$fair)
	{
	$this->db->select('count( pd.pi_id ) AS hsid, pd.school_code, pd.gender, date( sm.start_time ) AS sdt');
	$this->db->from('participant_item_details AS pd');
	$this->db->join('school_master  AS s','s.school_code = pd.school_code');
	$this->db->join('ground_item_master AS sm','sm.item_code = pd.item_code');
	$this->db->where('date( sm.start_time )=',$date);
	$this->db->where('pd.fairId',$fair);
	$this->db->where('pd.class BETWEEN 8 AND 10');
	$this->db->group_by('pd.gender');
	$this->db->group_by('pd.school_code');
	$participants_details		=	$this->db->get();
	return $participants_details->result_array();
	}
	function hssstudents_date($date,$fair)
	{
	$this->db->select('count( pd.pi_id ) AS hssid, pd.school_code, pd.gender, date( sm.start_time ) AS sdt');
	$this->db->from('participant_item_details AS pd');
	$this->db->join('school_master  AS s','s.school_code = pd.school_code');
	$this->db->join('ground_item_master AS sm','sm.item_code = pd.item_code');
	$this->db->where('date( sm.start_time )=',$date);
	$this->db->where('pd.fairId',$fair);
	$this->db->where('pd.class BETWEEN 11 AND 12');
	$this->db->group_by('pd.gender');
	$this->db->group_by('pd.school_code');
	$participants_details		=	$this->db->get();
	return $participants_details->result_array();
	}
	
	function lpstudentsexhib_date($date,$fair)
	{
	$this->db->select('count( pd.pi_id ) AS cntlp, pd.school_code, pd.gender, date( sm.start_time ) AS sdt');
	$this->db->from('participant_item_details AS pd');
	$this->db->join('ground_item_master AS sm','sm.item_code = pd.school_code');
	$this->db->join('school_master  AS s','s.school_code = pd.school_code');
	$this->db->where('date( sm.start_time )=',$date);
	$this->db->where('pd.fairId',$fair);
	$this->db->where('length(sm.item_code) > ',3);
	$this->db->where('pd.fest_id',0);
	$this->db->where('pd.class BETWEEN 1 AND 4');
	$this->db->group_by('pd.gender');
	$this->db->group_by('pd.school_code');
	$participants_details		=	$this->db->get();
	//return $participants_details->result_array();
	
	$part_info = $participants_details->result_array();
	$cnt = count($part_info);
	$parti_details =array();
	if($cnt > 1)
	{
	foreach($part_info as $introw=>$vals)
	{
		$parti_details[$vals['school_code']][$vals['gender']] = $vals['cntlp'];
	}
	}
	return $parti_details;
	}
	function upstudentsexhib_date($date,$fair)
	{
	$this->db->select('count( pd.pi_id ) AS upid, pd.school_code, pd.gender, date( sm.start_time ) AS sdt');
	$this->db->from('participant_item_details AS pd');
	$this->db->join('ground_item_master AS sm','sm.item_code = pd.school_code');
	$this->db->join('school_master  AS s','s.school_code = pd.school_code');
	$this->db->where('date( sm.start_time )=',$date);
	$this->db->where('pd.fairId',$fair);
	$this->db->where('length(sm.item_code) > ',3);
	$this->db->where('pd.fest_id',0);
	$this->db->where('pd.class BETWEEN 5 AND 7');
	$this->db->group_by('pd.gender');
	$this->db->group_by('pd.school_code');
	$participants_details		=	$this->db->get();
	//return $participants_details->result_array();
	$part_info = $participants_details->result_array();
	$cnt = count($part_info);
	$parti_details =array();
	if($cnt > 1)
	{
	foreach($part_info as $introw=>$vals)
	{
		$parti_details[$vals['school_code']][$vals['gender']] = $vals['upid'];
	}
	}
	return $parti_details;
	}
	function hsstudentsexhib_date($date,$fair)
	{
	$this->db->select('count( pd.pi_id ) AS hsid, pd.school_code, pd.gender, date( sm.start_time ) AS sdt');
	$this->db->from('participant_item_details AS pd');
	$this->db->join('ground_item_master AS sm','sm.item_code = pd.school_code');
	$this->db->join('school_master  AS s','s.school_code = pd.school_code');
	$this->db->where('date( sm.start_time )=',$date);
	$this->db->where('pd.fairId',$fair);
	$this->db->where('length(sm.item_code) > ',3);
	$this->db->where('pd.fest_id',0);
	$this->db->where('pd.class BETWEEN 8 AND 10');
	$this->db->group_by('pd.gender');
	$this->db->group_by('pd.school_code');
	$participants_details		=	$this->db->get();
	//return $participants_details->result_array();
	$part_info = $participants_details->result_array();
	$cnt = count($part_info);
	$parti_details =array();
	if($cnt > 1)
	{
	foreach($part_info as $introw=>$vals)
	{
		$parti_details[$vals['school_code']][$vals['gender']] = $vals['hsid'];
		//$parti_details[$vals['school_code']][$vals['gender']] = $vals['gender'];
	}
	}
	return $parti_details;
	}
	function hssstudentsexhib_date($date,$fair)
	{
	$this->db->select('count( pd.pi_id ) AS hssid, pd.school_code, pd.gender, date( sm.start_time ) AS sdt');
	$this->db->from('participant_item_details AS pd');
	$this->db->join('ground_item_master AS sm','sm.item_code = pd.school_code');
	$this->db->join('school_master  AS s','s.school_code = pd.school_code');
	$this->db->where('date( sm.start_time )=',$date);
	$this->db->where('pd.fairId',$fair);
	$this->db->where('length(sm.item_code) > ',3);
	$this->db->where('pd.fest_id',0);
	$this->db->where('pd.class BETWEEN 11 AND 12');
	$this->db->group_by('pd.gender');
	$this->db->group_by('pd.school_code');
	$participants_details		=	$this->db->get();
	//return $participants_details->result_array();
	$part_info = $participants_details->result_array();
	$cnt = count($part_info);
	$parti_details =array();
	if($cnt > 1)
	{
	foreach($part_info as $introw=>$vals)
	{
		$parti_details[$vals['school_code']][$vals['gender']] = $vals['hssid'];
	}
	}
	return $parti_details;
	}
	
	//========================================
	function school_lpdetails()
	{
	$this->db->select('d.school_code,m.school_name');
	$this->db->from('school_details AS d');
	$this->db->join('school_master AS m','m.school_code=d.school_code');
	$this->db->order_by('d.school_code');
	$participants_details		=	$this->db->get();
	return $participants_details->result_array();
	}
	
	function lpstudents($fair)
	{
	$this->db->select('count( p.participant_id ) AS cntlp, p.school_code, p.gender, s.school_name');
	$this->db->from('participant_item_details AS p');
	$this->db->join('school_master  AS s','s.school_code = p.school_code');
	$this->db->join('school_details AS d','d.school_code=p.school_code','RIGHT');
	$this->db->where('p.fairId',$fair);
	$this->db->where('p.class BETWEEN 1 AND 4');
	$this->db->group_by('p.gender');
	$this->db->group_by('p.school_code');
	$participants_details		=	$this->db->get();
	return $participants_details->result_array();
	}
	function upstudents($fair)
	{
	$this->db->select('count( p.participant_id ) AS upid, p.school_code, p.gender, s.school_name');
	$this->db->from('participant_item_details AS p');
	$this->db->join('school_master  AS s','s.school_code = p.school_code');
	$this->db->where('p.class BETWEEN 5 AND 7');
	$this->db->where('p.fairId',$fair);
	$this->db->group_by('p.gender');
	$this->db->group_by('p.school_code');
	$participants_details		=	$this->db->get();
	return $participants_details->result_array();
	}
	function hsstudents($fair)
	{
	$this->db->select('count( p.participant_id ) AS hsid, p.school_code, p.gender, s.school_name');
	$this->db->from('participant_item_details AS p');
	$this->db->join('school_master  AS s','s.school_code = p.school_code');
	$this->db->where('p.class BETWEEN 8 AND 10');
	$this->db->where('p.fairId',$fair);
	$this->db->group_by('p.gender');
	$this->db->group_by('p.school_code');
	$participants_details		=	$this->db->get();
	return $participants_details->result_array();
	}
	function hssstudents($fair)
	{
	$this->db->select('count( p.participant_id ) AS hssid, p.school_code, p.gender, s.school_name');
	$this->db->from('participant_item_details AS p');
	$this->db->join('school_master  AS s','s.school_code = p.school_code');
	$this->db->where('p.class BETWEEN 11 AND 12');
	$this->db->where('p.fairId',$fair);
	$this->db->group_by('p.gender');
	$this->db->group_by('p.school_code');
	$participants_details		=	$this->db->get();
	return $participants_details->result_array();
	}
	//==========================================================
	
	
	  function  fetch_fest_scoresheet($fest_id,$date,$fair_id)
		{// echo "--";
		if($date!='All')
		{           
		  $this->db->select('f.fest_id, f.fest_name,sfm.fairName,sfm.fairId, m.item_code, m.item_name,sm.start_time, sm.no_of_participant,st.ground_name,PD.prefixCode,PD.codeNo,PD.is_captain,PD.code_confirmed');
		  $this->db->where('f.fest_id',$fest_id);
		  $this->db->where('m.fairId',$fair_id);
		  $this->db->where('m.fest_id = f.fest_id');
		  $this->db->where('m.fairId  = sfm.fairId');
		  $this->db->where('PD.code_confirmed',1);
		  $this->db->from('festival_master AS f');
		  $this->db->from('science_master AS sfm');
		  $this->db->from('item_master AS m');
		  $this->db->join('participant_item_details  AS PD ','PD.item_code = m.item_code');
		  $this->db->join('ground_item_master  AS sm','sm.item_code = m.item_code','LEFT');
		  $this->db->join('ground_master  AS st','st.ground_id = sm.ground_id','LEFT');
		  $this->db->where('date(sm.start_time)',$date); 
		  $this->db->group_by('m.item_code');
		 /* $this->db->order_by('PD.school_code');	
		  $this->db->order_by('PD.team_no');		
		  $this->db->order_by('PD.is_captain','desc');		
		  $this->db->order_by('PD.participant_id');*/
		  
		 $fest_data=$this->db->get();
		 return  $fest_data->result_array();
		 }
		 else
		 {
		  $this->db->select('f.fest_id, f.fest_name,sfm.fairName,sfm.fairId, m.item_code, m.item_name, sm.start_time, sm.no_of_participant,st.ground_name,PD.prefixCode,PD.codeNo,PD.is_captain,PD.code_confirmed');
		  $this->db->where('f.fest_id',$fest_id); 
		  $this->db->where('m.fairId',$fair_id);
		  $this->db->where('m.fest_id = f.fest_id');
		  $this->db->where('m.fairId = sfm.fairId');
		   $this->db->where('PD.code_confirmed',1);
		  $this->db->from('festival_master AS f');
		  $this->db->from('science_master AS sfm');
		  $this->db->from('item_master AS m');
		    $this->db->join('participant_item_details  AS PD ','PD.item_code = m.item_code');
		  $this->db->join('ground_item_master  AS sm','sm.item_code = m.item_code','LEFT');
		  $this->db->join('ground_master  AS st','st.ground_id = sm.ground_id','LEFT');
		  $this->db->group_by('m.item_code');
		 $fest_data=$this->db->get();
		 return  $fest_data->result_array();
		 }
		}
		
		function fetch_participantCode($fair,$fest,$itemcode,$date= 0,$tabulation_score=0)
		{
			if($fest != 0) //not exhibition
			{
				if($itemcode != 0)
				{
					//echo "---in";
					$data= $this->fetch_item_name2($itemcode,0,$tabulation_score);	
				}
			}//if fest not zero
			else
			{
				//echo "------here".$fest;
				$data= $this->participate_school_details($fair,$fest,1,$date);	
			}//if exhibition
			return $data;
		}//fn
		
	function find_subdistrict()
		{
		$user_id		=	$this->session->userdata('USERID');
		$subdist		=	$this->session->userdata('SUB_DISTRICT');
		$usrtype        =   $this->session->userdata('USER_TYPE');
		$this->db->select('sub_district_code,rev_district_code');
		$this->db->where('user_id',$user_id);
		$rev_details		=	$this->db->get('user_master');
		$rev			=	$rev_details->row();
		if($rev->sub_district_code!=0)
		{
		
		$this->db->select('sdm.sub_dist_sciencefair_name as sub_dist, sdm.venue');
		$this->db->from('sub_dist_sciencefair_master  AS sdm');
		$this->db->where('sdm.sub_district_code',$subdist);
		$school_details		=	$this->db->get();
		return $school_details->result_array();
		}
		else if($rev->rev_district_code!=0){
		$this->db->select('sdm.dist_sciencefair_name as sub_dist,sdm.venue');
			$this->db->from('dist_sciencefair_master  AS sdm');
			$this->db->where('sdm.rev_district_code',$rev->rev_district_code);
			$school_details		=	$this->db->get();
			return $school_details->result_array();
		}
		else{
		$retdata[0]['sub_dist']="State School Sciencefair ";
		$retdata[0]['venu']="";
		return $retdata;
		}
		}
	
	function list_school_details(){
			$this->db->from('school_details AS SM');
			$this->db->select('SM.*,SM.school_code,SD.school_name');
			$this->db->join('school_master AS SD','SM.school_code = SD.school_code','LEFT');
			$school_details		=	$this->db->get();
			return $school_details->result_array();
	}
	
	function part_item_details($schoolcode,$fairid,$cateid){
	//echo '<BR><BR><BR>ccccc'.$cateid;
	  if($fairid	==	4 && $this->input->post('radioLabel') == 'exhib') {
			$limit	=	$this->exhibition_category($fairid,$cateid);
	    }			
	
			$this->db->select('p.participant_id,p.admn_no,p.school_code,p.item_code,p.item_type, p.is_captain,p.participant_name,p.gender,p.team_no, p.class,p.spo_id,date( gim.start_time ) AS ddt, im.time_type,ss.ground_name,ss.ground_desc, im.item_name,im.is_teach, F.fest_id,F.fest_name, m.school_name, gim.no_of_participant, im.is_off_stage,im.max_time');
			$this->db->from('participant_item_details AS p');
			$this->db->join('item_master AS im','im.item_code = p.item_code');			
			$this->db->join('school_master AS m',' m.school_code = p.school_code');
			$this->db->join('ground_item_master AS gim','gim.item_code = p.item_code','LEFT');
			$this->db->join('ground_master AS ss','ss.ground_id = gim.ground_id','LEFT');
			if($fairid	==	4 && $this->input->post('radioLabel') == 'exhib') 
			{		      
				$this->db->join('school_details AS S',"m.school_code = S.school_code AND ".$limit."");			
				$this->db->from('festival_master AS F');
				$this->db->where("F.fest_id = ".$cateid);
				$this->db->where('p.fest_id','0'); 
		   }	
		   else
		   {
		   		$this->db->join('festival_master AS F','F.fest_id = im.fest_id');
				$this->db->where('p.fest_id',$cateid);
			}
			
			if($schoolcode!=0 and $fairid!=0){
				$this->db->where('p.school_code',$schoolcode);
				$this->db->where('p.fairId',$fairid);
				
			}
			
			$this->db->group_by('p.participant_id');
			$this->db->group_by('p.item_code');
			$this->db->order_by('p.school_code');
			$this->db->order_by('F.fest_id');
			$this->db->order_by('p.item_code');
			$this->db->order_by('p.team_no');
			$this->db->order_by('p.is_captain','desc');
			
			$part_details		=	$this->db->get();
			return $part_details->result_array();

	}//part_item_details($schoolcode,$festid)
	
	function part_item_details_allschool($fairId,$cateid){
	
			$where		=	'';
			if ($fairId)
			{
				$where		=	" where p.fairId ='$fairId' and p.fest_id ='$cateid'";
			}
			
			 if($fairId	==	4 && @$this->input->post('radioLabel') == 'exhib') {
			 
			 $limit	=	$this->exhibition_category($fairId,$cateid);
			$qy="SELECT p.participant_id,p.is_captain,p.admn_no, p.school_code, p.item_code, p.item_type, p.is_captain, 						             p.participant_name, p.gender, p.class,date( gim.start_time ) AS ddt, ss.ground_name, ss.ground_desc, p.exhibition as item_name, F.fest_id, F.fest_name,m.school_name, gim.no_of_participant
			FROM participant_item_details AS p
			JOIN festival_master AS F 
			JOIN school_master AS m ON m.school_code = p.school_code 
			JOIN school_details AS S ON m.school_code = S.school_code  AND ".$limit."
			LEFT JOIN ground_item_master AS gim ON length(gim.item_code) > 3
			LEFT JOIN ground_master AS ss ON ss.ground_id = gim.ground_id
			where p.fairId ='$fairId' AND p.fest_id = '0' and  F.fest_id = '$cateid' 
			GROUP BY p.participant_id, p.school_code
			ORDER BY p.school_code, F.fest_id, p.item_code,p.is_captain desc";
	    }	else
		{
			$qy="SELECT p.participant_id,p.is_captain,p.admn_no, p.school_code, p.item_code, p.item_type, p.is_captain, 						             p.participant_name, p.gender, p.class,date( s.start_time ) AS ddt,im.time_type, ss.ground_name, ss.ground_desc, im.item_name, F.fest_id, F.fest_name,m.school_name, s.no_of_participant, im.is_off_stage,im.max_time
			FROM participant_item_details AS p
			JOIN item_master AS im ON im.item_code = p.item_code
			JOIN festival_master AS F ON F.fest_id = im.fest_id
			JOIN school_master AS m ON m.school_code = p.school_code
			LEFT JOIN ground_item_master AS s ON s.item_code = p.item_code
			LEFT JOIN ground_master AS ss ON ss.ground_id = s.ground_id
			$where 
			GROUP BY p.participant_id, p.item_code
			ORDER BY p.school_code, F.fest_id, p.item_code,p.is_captain desc";
			}
			$fest_detail1		=	$this->db->query($qy);
			return $fest_detail1->result_array();
	
	}//part_item_details_allschool($festid)

	function list_more_limitpart($fairid,$cateid,$limit){
			$this->db->from('participant_item_details AS PID');
			$this->db->select('count( PID.participant_id ) AS cnt, PID.participant_id,PID.spo_id,PID.is_captain,PID.school_code, PID.participant_name, PID.class, PID.gender, PID.admn_no, PID.item_code, IM.item_name, IM.fest_id,SM.school_name,FM.fest_name,SD.sub_district_name');
			$this->db->join('item_master AS IM','IM.item_code = PID.item_code');
			$this->db->join('sub_district_master AS SD','SD.sub_district_code = PID.sub_district_code');
			$this->db->join('festival_master AS FM','FM.fest_id=IM.fest_id');
			$this->db->join('school_master AS SM','SM.school_code=PID.school_code');
			$this->db->group_by('PID.participant_id');
			$this->db->having('cnt >=', $limit);
			$this->db->where('PID.fairId',$fairid);
			$this->db->where('PID.fest_id',$cateid);
			$school_details		=	$this->db->get();
			return $school_details->result_array();
	
	}//list_more_limitpart($festid,$limit)
	
	function list_more_limitpart_allfair($cateid){
			$this->db->from('participant_item_details AS PID');
			$this->db->select('count(PID.participant_id ) AS cnt, PID.participant_id,PID.spo_id,PID.is_captain,PID.school_code, PID.participant_name, PID.class, PID.gender, PID.admn_no, PID.item_code, IM.item_name, IM.fest_id,SM.school_name,FM.fest_name,S.sub_district_code,S.sub_district_name');
			$this->db->join('item_master AS IM','IM.item_code = PID.item_code');
			$this->db->join('festival_master AS FM','FM.fest_id=IM.fest_id');
			$this->db->join('school_master AS SM','SM.school_code=PID.school_code');
			$this->db->join('sub_district_master AS S','S.sub_district_code=SM.sub_district_code');
			$this->db->group_by('PID.participant_id');
			$this->db->having('cnt > 1');
			$this->db->where('PID.fest_id',$cateid);
			$school_details		=	$this->db->get();
			return $school_details->result_array();
	
	}//list_more_limitpart($festid,$limit)
	
	
	function get_participant_details_more_allfair($participant_id,$fair=0)
{
		$this->db->select('PD.*,IM.item_name,IM.item_code,SM.fairName');
		$this->db->join('item_master AS IM','IM.item_code = PD.item_code');
		$this->db->join('science_master AS SM','SM.fairId = PD.fairId','LEFT');
		//$this->db->distinct('PD.participant_id');
		$this->db->where('PD.participant_id',$participant_id);
		if($fair !=0){
			$this->db->where('PD.fairId',$fair);
		}
			
		$participant		=	$this->db->get('participant_item_details AS PD');
		return $participant->result_array();
}
		
	function team_list_in_group_final($cap,$item_code,$exb_flag=0){
	
			   if($cap != 'ALL')
			   {
			   if($exb_flag==1)
				{
			/*$sql="SELECT `pid`.`participant_id` , `pid`.`participant_name`
					FROM (`participant_item_details` AS `pid`)
					
					WHERE admn_no ='A' ";*/
					$sql="SELECT `pid`.`participant_id` , `pid`.`participant_name` , `pid`.`spo_id` , `pid`.`class` , `pid`.`gender` ,pid.is_captain,pid.admn_no, `m`.`school_code` , `m`.`school_name` ,`pid`.`admn_no` 
					FROM `participant_item_details` AS pid 
					JOIN `school_master` AS m ON `m`.`school_code` = `pid`.`school_code`
					WHERE `pid`.`school_code` = $item_code and pid.fest_id='0' AND  `pid`.`school_code`
					IN (SELECT school_code FROM participant_item_details
					WHERE admn_no = $cap) order by `m`.`school_code`, `pid`.team_no DESC,pid.is_captain DESC,`pid`.`participant_id`  ASC";
				}
				else
				{
					$sql="SELECT `pid`.`participant_id` , `pid`.`participant_name` , `pid`.`spo_id` , `pid`.`class` , `pid`.`gender`,pid.is_captain,pid.admn_no,`m`.`school_code` , `m`.`school_name` , `f`.`fest_id` , `f`.`fest_name` , `pid`.`admn_no` , `im`.`item_code` , `im`.`item_name`,`im`.`is_teach`
					FROM (`participant_item_details` AS `pid`)
					JOIN `item_master` AS im ON `im`.`item_code` = `pid`.`item_code`
					JOIN `festival_master` AS f ON `f`.`fest_id` = `im`.`fest_id`
					JOIN `school_master` AS m ON `m`.`school_code` = `pid`.`school_code`
					WHERE `pid`.`item_code` = $item_code
					AND `pid`.`school_code`
					IN (SELECT school_code FROM participant_item_details
					WHERE admn_no = $cap) order by `m`.`school_code`, `pid`.team_no DESC,pid.is_captain DESC,`pid`.`participant_id`  ASC ";
				}
				}
				else
				{
				if($exb_flag==0)
				{
					$sql="SELECT `pid`.`participant_id` , `pid`.`participant_name` , `pid`.`spo_id` , `pid`.`class` , `pid`.`gender` ,pid.is_captain,pid.admn_no, `m`.`school_code` , `m`.`school_name` , `f`.`fest_id` , `f`.`fest_name` , `pid`.`admn_no` , `im`.`item_code` , `im`.`item_name`,`im`.`is_teach`
					FROM (`participant_item_details` AS pid)
					JOIN `item_master` AS im ON `im`.`item_code` = `pid`.`item_code`
					JOIN `festival_master` AS f ON `f`.`fest_id` = `im`.`fest_id`
					JOIN `school_master` AS m ON `m`.`school_code` = `pid`.`school_code`
					WHERE `pid`.`item_code` = $item_code order by `m`.`school_code`, `pid`.team_no DESC,pid.is_captain DESC,`pid`.`participant_id`  ASC";
				}
				else
				{
				$sql="SELECT `pid`.`participant_id` , `pid`.`participant_name` , `pid`.`spo_id` , `pid`.`class` , `pid`.`gender` ,pid.is_captain,pid.admn_no, `m`.`school_code` , `m`.`school_name` ,`pid`.`admn_no` 
					FROM `participant_item_details` AS pid 
					JOIN `school_master` AS m ON `m`.`school_code` = `pid`.`school_code`
					WHERE `pid`.`school_code` = $item_code and pid.fest_id='0'  order by `m`.`school_code`, `pid`.team_no DESC,pid.is_captain DESC,`pid`.`participant_id`  ASC";
				}
					
					
				}
				   $fest_detail1		=	$this->db->query($sql);
					return $fest_detail1->result_array();
	}
	
	
	
	
	
	function get_callsheet_details($fairid,$cateid,$itemcode,$tabulation = 0,$printcode = 0){
		//echo "<br /><br /><br />----".$itemcode;
				$this->db->select(' GM.ground_name, GM.ground_desc, IM.item_code, IM.item_name, FM.fest_id, FM.fest_name, pd.participant_id, GIM.start_time, GIM.item_time, GIM.time_type,GIM.no_of_participant,pd.spo_id,so.is_publish,pd.fairId,pd.fest_id,pd.codeNo,pd.prefixCode,pd.is_absent,pd.code_confirmed,pd.participant_name,pd.start_number,pd.team_no,pd.school_code,pd.is_captain,SM.school_name');
				$this->db->from('participant_item_details AS pd');
				$this->db->join('item_master AS IM ','IM.item_code = pd.item_code');
				$this->db->join('school_master AS SM ','SM.school_code = pd.school_code');
				$this->db->join('ground_item_master AS GIM ','GIM.item_code = IM.item_code');
				$this->db->join('ground_master AS GM ','GM.ground_id = GIM.ground_id');
				$this->db->join('festival_master  AS FM','FM.fest_id = IM.fest_id');
				$this->db->join('special_order_master AS so','so.spo_id=pd.spo_id','LEFT');
				$this->db->where('GIM.item_code = pd.item_code');
				if($tabulation == 1)
				{$this->db->where('pd.is_absent',0);
				}
				if($printcode == 1)
				{$this->db->where('pd.is_captain = "Y"');
				$this->db->where('pd.is_absent',0);
				}
				$this->db->where('pd.fairId',$fairid);
				$this->db->where('pd.fest_id',$cateid);
				$this->db->where('pd.item_code',$itemcode);
				
				
				$this->db->order_by('pd.spo_id');
				$this->db->order_by('pd.spo_team');
				$this->db->order_by('pd.school_code');	
				$this->db->order_by('pd.team_no');		
				$this->db->order_by('pd.is_captain','desc');		
				$this->db->order_by('pd.participant_id');
				
				$this->db->group_by('pd.participant_id');
				$this->db->group_by('IM.item_code');
				
				
				
				$school_details		=	$this->db->get();
				return $school_details->result_array();
	}	
	
	
	function get_all_codenumbers($fairid,$cateid,$tabulation = 0,$printcode = 0){
		//echo "----";
				$this->db->select(' GM.ground_name, GM.ground_desc, IM.item_code, IM.item_name, FM.fest_id, FM.fest_name, pd.participant_id, GIM.start_time, GIM.item_time, GIM.time_type,GIM.no_of_participant,pd.spo_id,so.is_publish,pd.fairId,pd.fest_id,pd.codeNo,pd.prefixCode,pd.is_absent,pd.code_confirmed,pd.participant_name,pd.team_no,pd.school_code,pd.is_captain,SM.school_name');
				$this->db->from('participant_item_details AS pd');
				$this->db->join('item_master AS IM ','IM.item_code = pd.item_code');
				$this->db->join('school_master AS SM ','SM.school_code = pd.school_code');
				$this->db->join('ground_item_master AS GIM ','GIM.item_code = IM.item_code');
				$this->db->join('ground_master AS GM ','GM.ground_id = GIM.ground_id');
				$this->db->join('festival_master  AS FM','FM.fest_id = IM.fest_id');
				$this->db->join('special_order_master AS so','so.spo_id=pd.spo_id','LEFT');
				$this->db->where('GIM.item_code = pd.item_code');
				$this->db->where('pd.is_absent',0);
				
				if($printcode == 1)
				{$this->db->where('pd.is_captain = "Y"');
				}
				$this->db->where('pd.fairId',$fairid);
				$this->db->where('pd.fest_id',$cateid);
				$this->db->where('pd.code_confirmed',1);
				$this->db->order_by('pd.item_code');	
				$this->db->order_by('pd.school_code');	
				$this->db->order_by('pd.team_no');		
				$this->db->order_by('pd.is_captain','desc');		
				$this->db->order_by('pd.participant_id');
				$this->db->group_by('IM.item_code');
				$this->db->group_by('pd.participant_id');								
				$school_details		=	$this->db->get();
				return $school_details->result_array();
	}
	
	
	
	function all_callsheet_details($fairid,$cateid,$date){   
	//echo "--";
				if($date!='All'){
						$this->db->select('SM.fairName,GM.ground_name, GM.ground_desc, IM.item_code, IM.item_name, FM.fest_id, FM.fest_name, pd.participant_id,pd.participant_name,SD.school_name,SD.school_code, GIM.start_time, GIM.item_time, GIM.time_type,GIM.no_of_participant,pd.spo_id,so.is_publish,pd.code_confirmed,pd.codeNo,pd.prefixCode,pd.is_absent,pd.is_captain');
						$this->db->from('participant_item_details AS pd');
						$this->db->join('school_master AS SD ','SD.school_code = pd.school_code');
						$this->db->join('item_master AS IM ','IM.item_code = pd.item_code');
						$this->db->join('ground_item_master AS GIM ','GIM.item_code = IM.item_code');	
						$this->db->join('ground_master AS GM ','GM.ground_id = GIM.ground_id');
						$this->db->join('festival_master  AS FM','FM.fest_id = IM.fest_id');
						$this->db->join('science_master  AS SM','SM.fairId = IM.fairId');
						$this->db->join('special_order_master AS so','so.spo_id=pd.spo_id','LEFT');
						$this->db->where('pd.fairId',$fairid);
						$this->db->where('pd.fest_id',$cateid);
						$this->db->where('date(GIM.start_time)',$date);
						$this->db->where('pd.item_code = IM.item_code');
						
						$this->db->order_by('pd.item_code');
						$this->db->order_by('pd.spo_id');
						$this->db->order_by('pd.spo_team');		
						$this->db->order_by('pd.code_confirmed','desc'); 	
						$this->db->order_by('pd.school_code');	
						$this->db->order_by('pd.team_no');		
						$this->db->order_by('pd.is_captain','desc');		
						$this->db->order_by('pd.participant_id');
						
						$school_details		=	$this->db->get();
						return $school_details->result_array();
				}
				else{ 
						$this->db->select('SM.fairName, GM.ground_name, GM.ground_desc, IM.item_code, IM.item_name, FM.fest_id, FM.fest_name, pd.participant_id, GIM.start_time, GIM.item_time, GIM.time_type,GIM.no_of_participant,pd.participant_name,SD.school_name,SD.school_code, pd.spo_id,so.is_publish,pd.code_confirmed,pd.codeNo,pd.prefixCode,pd.is_absent,pd.is_captain');
						$this->db->from('participant_item_details AS pd');
						$this->db->join('school_master AS SD ','SD.school_code = pd.school_code');
						$this->db->join('item_master AS IM ','IM.item_code = pd.item_code');
						$this->db->join('ground_item_master AS GIM ','GIM.item_code = IM.item_code');
						$this->db->join('ground_master AS GM ','GM.ground_id = GIM.ground_id');
						$this->db->join('festival_master  AS FM','FM.fest_id = IM.fest_id');
						$this->db->join('science_master  AS SM','SM.fairId = IM.fairId');
						$this->db->join('special_order_master AS so','so.spo_id=pd.spo_id','LEFT');
						$this->db->where('pd.fairId',$fairid);
						$this->db->where('pd.fest_id',$cateid);
						$this->db->where('pd.item_code = IM.item_code');
						
						$this->db->order_by('pd.item_code');	
						$this->db->order_by('pd.school_code');	
						$this->db->order_by('pd.team_no');		
						$this->db->order_by('pd.is_captain','desc');		
						$this->db->order_by('pd.participant_id');
						
						$school_details		=	$this->db->get();
						return $school_details->result_array();
				}
	}//all_callsheet_details($festcode,$date)	
	
	function tabulation_details($fair,$fest,$itemcode)
	{
		//echo $itemcode;
		$query="SELECT IM.item_code, IM.item_name,date(SM.start_time) as timer FROM (`item_master` AS IM) LEFT JOIN participant_item_details AS PD ON IM.item_code =PD.item_code LEFT JOIN ground_item_master  AS SM ON IM.item_code =SM.item_code where IM.fairId='$fair' and IM.fest_id='$fest' and IM.item_code ='$itemcode' GROUP BY IM.item_code ";
		//echo $query;
		$tabulation_detail		=$this->db->query($query);
		return   $tabulation_detail->result_array();
		}
		
	function tabulation_fest_details($festival)
	{//echo "--";
	$this->db->from('festival_master AS FM');
		$this->db->where('FM.fest_id',$festival);
$fest_detail		=	$this->db->get();
		return $fest_detail->result_array();
	}
	
	
	
	function tabulation_info($festival,$date,$fair)
	{
	//$this->db->from('`item_master` AS IM');
	//echo "--";
	//$this->db->join('festival_master   AS FM','FM.fest_id= IM.fest_id');
		//$this->db->where('IM.`fest_id`',$festival);
		if($date!='All')
		{
	$que="SELECT IM.item_name,IM.item_code,IM.fairId ,IM.fest_id,FM.fest_name,SCM.fairName,date(SM.start_time) as timer, count( PID.participant_id ) as cnt FROM (`item_master` AS IM)
    JOIN festival_master AS FM ON FM.`fest_id` = IM.`fest_id`
	JOIN science_master AS SCM ON SCM.`fairId` = IM.`fairId`
    LEFT JOIN participant_item_details AS PID ON PID.`item_code` = IM.`item_code`
	LEFT JOIN ground_item_master  AS SM ON IM.item_code =SM.item_code
    WHERE FM.`fest_id` =$festival and date(SM.start_time)='$date' AND PID.fairId=$fair 
    GROUP BY (IM.item_code)";
	//echo "----".$que;
  		 $fest_detail1		=	$this->db->query($que);
		return $fest_detail1->result_array();
		}
		else
		{
		$que="SELECT IM.item_name,IM.item_code, IM.fairId ,IM.fest_id ,FM.fest_name,SCM.fairName,date(SM.start_time) as timer, count( PID.participant_id ) as cnt FROM (`item_master` AS IM)
    JOIN festival_master AS FM ON FM.`fest_id` = IM.`fest_id`
	JOIN science_master AS SCM ON SCM.`fairId` = IM.`fairId`
    LEFT JOIN participant_item_details AS PID ON PID.`item_code` = IM.`item_code`
	LEFT JOIN ground_item_master  AS SM ON IM.item_code =SM.item_code
    WHERE FM.`fest_id` =$festival AND PID.fairId=$fair 
    GROUP BY (IM.item_code)";
	//echo "-------------".$que;
   		$fest_detail1		=	$this->db->query($que);
		return $fest_detail1->result_array();
		
		}
	}

	
	
	function groundallot_duration($festid,$fairid)
		{
		$this->db->select('count( pd.participant_id ) AS pdcount, pd.item_code, im.item_name, im.fest_id, im.item_type, im.max_time, im.time_type, im.is_off_stage, f.fest_name,date(gm.start_time) as ddttime');
		$this->db->from('participant_item_details AS pd');
		$this->db->join('item_master AS im','im.item_code = pd.item_code');
		$this->db->join('festival_master AS f','f.fest_id = im.fest_id');
		$this->db->join('ground_item_master AS gm','gm.item_code=im.item_code','LEFT');
		$this->db->where('im.fest_id',$festid);
		$this->db->where('pd.fairId',$fairid);
		$this->db->where('pd.is_captain','Y');
		$this->db->group_by('pd.item_code');
		$this->db->order_by('pd.item_code');
		$retdata=$this->db->get();
		return $retdata->result_array();
		}
		function groundallot_duration_all()
		{
		$this->db->select('count( pd.participant_id ) AS pdcount, pd.item_code, im.item_name, im.fest_id, im.item_type, im.max_time, im.time_type, im.is_off_stage, f.fest_name,date(gm.start_time) as ddttime');
		$this->db->from('participant_item_details AS pd');
		$this->db->join('item_master AS im','im.item_code = pd.item_code');
		$this->db->join('festival_master AS f','f.fest_id = im.fest_id');
		$this->db->join('ground_item_master AS gm','gm.item_code=im.item_code','LEFT');
		$this->db->where('pd.is_captain','Y');
		$this->db->group_by('pd.item_code');
		$this->db->order_by('f.fest_id');
		$this->db->order_by('pd.item_code');
		$retdata=$this->db->get();
		return $retdata->result_array();
		}
		function groupallotduration()
		{
		$this->db->select('count( `participant_id` ) AS cpid, item_code, item_type');
		$this->db->from('participant_item_details');
		$this->db->where('item_type','G');
		$this->db->where('is_captain','Y');
		$this->db->group_by('item_code');
		$retdata=$this->db->get();
		return $retdata->result_array();
		}
	
	function alldate_groundreport($ground)
		{
		$this->db->select('s.ground_id, s.item_code, date(s.start_time)as ddt, s.no_of_participant, t.item_name,t.time_type, m.ground_name, m.ground_desc,f.fest_name,t.item_type,t.max_time,t.is_off_stage,sfm.fairName,sfm.fairId');
		$this->db->from('ground_item_master AS s');
		$this->db->join('ground_master AS m',' m.ground_id = s.ground_id');
		$this->db->join('item_master AS t','t.item_code = s.item_code');
		$this->db->join('festival_master AS f','f.fest_id = t.fest_id');
		$this->db->join('science_master AS sfm','sfm.fairId = t.fairId');
		$this->db->where('s.ground_id',$ground);
		$this->db->group_by('s.item_code');
		$this->db->order_by('s.ground_id, f.fest_id, s.item_code');
		$retdata=$this->db->get();
		return $retdata->result_array();
		}
		
	function Groundname($groundid)
	{
	    $this->db->from('ground_master AS SM');
		$this->db->where('SM.ground_id',$groundid);
		
		$grounddetails		=	$this->db->get();
		return $grounddetails->result_array();
	}	
	function datewise_groundaltreport($date,$ground)
	{
		$this->db->select('SIM.ground_id, SIM.start_time, SIM.item_code, SIM.no_of_participant, IM.item_name, IM.time_type, IM.item_type, IM.is_off_stage, IM.max_time, F.fest_id, F.fest_name');
		$this->db->from('ground_item_master AS SIM');
		$this->db->join('item_master AS IM','SIM.item_code = IM.item_code');
		$this->db->join('festival_master AS F ','F.fest_id = IM.fest_id');
		$this->db->where("DATE_FORMAT( SIM.start_time, '%Y-%m-%d' )=",$date);
		$this->db->where('SIM.ground_id',$ground);
		$ground		=	$this->db->get();
		return $ground->result_array();
	}
	
	function groundreport_all()
		{
		
		$this->db->select('s.ground_id, s.item_code, date(s.start_time) AS ddt, s.no_of_participant, im.item_name, f.fest_id, f.fest_name,sm.ground_name, sm.ground_desc,im.is_off_stage,im.item_type,im.max_time,im.time_type,s.no_of_participant');
		$this->db->from('ground_item_master AS s');
		$this->db->join('ground_master AS sm',' s.ground_id = sm.ground_id');
		$this->db->join('item_master AS im','im.item_code = s.item_code');
		$this->db->join('festival_master AS f','f.fest_id = im.fest_id');
		$this->db->group_by('s.item_code');
		$this->db->order_by('ddt');
		//$this->db->order_by('f.fest_id');
		$this->db->order_by('s.ground_id');
		$retdata=$this->db->get();
		return $retdata->result_array();
		}
		
		function groundallot_abstract()
		{
		  $this->db->select('count( sm.item_code ) AS itcode,ms.ground_name, sm.ground_id, date( start_time ) AS dt, im.fest_id');
		  $this->db->from('ground_item_master AS sm');
		  $this->db->join('item_master AS im','im.item_code = sm.item_code');
		  $this->db->join('festival_master as f','f.fest_id=im.fest_id');
		  $this->db->join('ground_master as ms','ms.ground_id=sm.ground_id');
		  $this->db->group_by('im.fest_id');
		  $this->db->group_by('date(start_time)');
		  $this->db->group_by('sm.ground_id');
		 
		  $this->db->order_by('sm.ground_id');
		  $this->db->order_by('date(start_time)');
		  $this->db->order_by('im.fest_id');
		  $retdata=$this->db->get();
		  return $retdata->result_array();
		}
		
		function appealed_part($festcode,$faircode)
		{
		$this->db->select('pd.participant_id,sh.school_name,sh.school_code, pd.spo_id, so.spo_title, so.is_publish,  pd.item_code, im.item_name, pd.participant_name, pd.school_code, pd.class, pd.gender,fm.fest_name, fm.fest_id,date(sm.start_time) as sdt,scm.fairName,scm.fairId');
		$this->db->from('participant_item_details AS pd');
		$this->db->join('special_order_master AS so','so.spo_id = pd.spo_id');
		$this->db->join('item_master AS im','im.item_code = pd.item_code');
		$this->db->join('school_master AS sh','pd.school_code = sh.school_code');
		$this->db->join('festival_master AS fm','fm.fest_id = im.fest_id');
		$this->db->join('science_master AS scm','scm.fairId = im.fairId');
		$this->db->join('ground_item_master AS sm','sm.item_code=pd.item_code','LEFT');
		$this->db->where('pd.spo_id !=0');
		$this->db->where('fm.fest_id',$festcode);
		$this->db->where('scm.fairId',$faircode);
		$retdata=$this->db->get();
		return $retdata->result_array();
		}
	/*function getitemtype($itemcode)(){
	$this->db->select('is_teach');
	}*/
	
	function exhibition_category($cmbFairType,$cmbCateType)
	{
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
	
	function callsheet_all_item_details($fairid,$cateid,$itemcode,$tabulation = 0,$printcode = 0){
		//echo "----";
				$this->db->select(' GM.ground_name, GM.ground_desc, IM.item_code, IM.item_name, FM.fest_id, FM.fest_name, pd.participant_id, GIM.start_time, GIM.item_time, GIM.time_type,GIM.no_of_participant,pd.spo_id,so.is_publish,pd.fairId,pd.fest_id,pd.codeNo,pd.prefixCode,pd.is_absent,pd.code_confirmed,pd.participant_name,pd.team_no,pd.school_code,pd.is_captain,SM.school_name');
				$this->db->from('participant_item_details AS pd');
				$this->db->join('item_master AS IM ','IM.item_code = pd.item_code');
				$this->db->join('school_master AS SM ','SM.school_code = pd.school_code');
				$this->db->join('ground_item_master AS GIM ','GIM.item_code = IM.item_code');
				$this->db->join('ground_master AS GM ','GM.ground_id = GIM.ground_id');
				$this->db->join('festival_master  AS FM','FM.fest_id = IM.fest_id');
				$this->db->join('special_order_master AS so','so.spo_id=pd.spo_id','LEFT');
				$this->db->where('GIM.item_code = pd.item_code');
				if($tabulation == 1)
				{$this->db->where('pd.is_absent',0);
				}
				if($printcode == 1)
				{$this->db->where('pd.is_captain = "Y"');
				}
				$this->db->where('pd.fairId',$fairid);
				$this->db->where('pd.fest_id',$cateid);
			//	$this->db->where('pd.item_code',$itemcode);
				$this->db->order_by('pd.item_code');
				$this->db->order_by('pd.spo_id');	
				$this->db->order_by('pd.code_confirmed','desc'); 
				$this->db->order_by('pd.school_code');	
				$this->db->order_by('pd.team_no');		
				$this->db->order_by('pd.is_captain','desc');		
				$this->db->order_by('pd.participant_id');
				//$this->db->group_by('pd.participant_id');
				//$this->db->group_by('IM.item_code');
				
				
				
				$school_details		=	$this->db->get();
				return $school_details->result_array();
	}	
	
	
	//////////////////// list of students without code number ///////////////
 function  get_code_notGen_details()
	{
		
	$que="SELECT IM.*,PD.participant_id,PD.school_code,PD.spo_id,PD.participant_name,
	PD.is_captain,SCM.fairName,FM.*	,PD.code_confirmed
	FROM `item_master` AS IM
	JOIN festival_master AS FM ON IM.`fest_id` = FM.`fest_id`
	JOIN science_master as SCM ON SCM.fairId= IM.fairId
	JOIN participant_item_details  AS PD ON PD.item_code = IM.item_code
	LEFT JOIN ground_item_master AS SM ON IM.`item_code` = SM.`item_code`
	LEFT JOIN ground_master AS ST ON ST.`ground_id` = SM.`ground_id`
	WHERE  PD.is_absent = 0 and PD.is_captain = 'Y' and (PD.code_confirmed = 0 
	or PD.codeGeneratedFlag = 0) and PD.fairId != 5
	group by IM.fairId,IM.`item_code`,PD.participant_id 
	order by IM.`item_code`,PD.spo_id,PD.spo_team,PD.school_code,PD.team_no,PD.is_captain 
	desc,PD.participant_id ";
//echo "<br><br><br><br>".$que;
		 $fest_data=$this->db->query($que);
		 return  $fest_data->result_array();
	}//fn
	
	function get_code_notGen_exb($flag,$cat = 0)
	{
		$limit	=	'';
		
		//echo "<br /><br />---".$flag."---".$cat;
		if($flag == 1)
		{
			$limit	=	$this->exhibition_category(4,$cat);	
			$this->db->select('PD.fest_id');
			$this->db->from('participant_item_details AS PD');		
			$this->db->join('school_details AS S',"PD.school_code = S.school_code AND ".$limit."");			
		}
		else
		{ 
			$this->db->select('distinct(PD.school_code), PD.is_captain, PD.code_confirmed, sm.school_name');			
			$this->db->from('participant_item_details AS PD');		
			$this->db->join('school_master AS sm ','sm.school_code = PD.school_code');
		}
		
		$this->db->where('PD.is_absent = 0  and  PD.codeGeneratedFlag = 0 and PD.fest_id =0');
		$this->db->group_by('PD.fest_id');
		 $fest_data=$this->db->get();
		 return  $fest_data->result_array();
	}//fn
	
	//=====================================================item wise participants count start===============================
function itemwisestudents_item($item){
		
		if($_POST['radioLabel']!='exhib')
		{
		//$this->db->select('count(distinct pd.participant_id ) AS cnt, pd.gender');
		$this->db->select('count(CASE WHEN pd.gender="B" THEN pd.participant_id END) AS cnt_b,count(CASE WHEN pd.gender="G" THEN pd.participant_id END) AS cnt_g, sm.item_name,pd.fest_id');
		$this->db->from('participant_item_details AS pd');
		$this->db->join('item_master AS sm','sm.item_code = pd.item_code');
		$this->db->where('pd.exhibition != ','2');
		$this->db->where('pd.item_code',$item);
		$this->db->group_by('pd.item_code');
		}
		else
		{
		$this->db->select('count(CASE WHEN pd.gender="B" THEN pd.participant_id END) AS cnt_b,count(CASE WHEN pd.gender="G" THEN pd.participant_id END) AS cnt_g, pd.exhibition as item_name,pd.fest_id');
		$this->db->from('participant_item_details AS pd');
		$this->db->where('pd.exhibition','2');
		$this->db->group_by('pd.item_code');
		}
		
		$participants_details		=	$this->db->get();//var_dump($participants_details->result_array());
		return $participants_details->result_array();
}

function item_wise_participants($fest,$fair){
		
		if($_POST['radioLabel']!='exhib')
		{
		
		$this->db->select('count(CASE WHEN pd.gender="B" THEN pd.participant_id END) AS cnt_b,count(CASE WHEN pd.gender="G" THEN pd.participant_id END) AS cnt_g, sm.item_name,pd.fest_id');
		$this->db->from('participant_item_details AS pd');
		$this->db->join('item_master AS sm','sm.item_code = pd.item_code');
		$this->db->where('pd.fairId',$fair);
		$this->db->where('pd.exhibition !=','2');
		if($fest != 'ALL')$this->db->where('pd.fest_id',$fest);
		$this->db->group_by('pd.item_code');
		}
		else
		{
		$this->db->select('count(CASE WHEN pd.gender="B" THEN pd.participant_id END) AS cnt_b,count(CASE WHEN pd.gender="G" THEN pd.participant_id END) AS cnt_g, sm.item_name,pd.fest_id');
		$this->db->from('participant_item_details AS pd');
		$this->db->join('item_master AS sm','sm.item_code = pd.item_code');
		$this->db->where('pd.fairId',$fair);
		$this->db->where('pd.exhibition ','2');
		if($fest != 'ALL')$this->db->where('pd.fest_id',$fest);
		$this->db->group_by('pd.item_code');
		}
		
		
		$participants_details		=	$this->db->get();//var_dump($participants_details->result_array());
		return $participants_details->result_array();
}

//=====================================================item wise participants count ends===============================
	
}//class


?>