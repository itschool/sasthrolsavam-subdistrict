<?php 

class Registration_Model extends CI_Model{
	function Registration_Model()
	{
		parent::__construct();
	}
	
	

	function get_school_details($schoolcode){
			
		/*if(trim($this->session->userdata('SUB_DISTRICT')) != 0)
			$this->db->where('SM.sub_district_code', trim($this->session->userdata('SUB_DISTRICT')));
			
		if(trim($this->session->userdata('DISTRICT')) != 0)
			$this->db->where('SM.rev_district_code', trim($this->session->userdata('DISTRICT')));
		
		$this->db->where('SM.school_code',$schoolCode);
		//$this->db->where('SD.sportsId',$sportsId);
		$this->db->from('school_master AS SM');
		*/
		// check if the user is cluster user
		/*if(trim($this->session->userdata('USER_TYPE')) == 5) {
			$this->db->join('user_cluster AS UC','SM.school_code = UC.school_code','INNER');
			$this->db->where('UC.user_id', trim($this->session->userdata('USERID')));
		}*/
		//check if the user is cluster user ends
		
		$this->db->select('SM.*, SD.*,S.sub_district_name,R.rev_district_name');
		//
		$this->db->join('school_details AS SD','SM.school_code = SD.school_code','LEFT');
		$this->db->join('sub_district_master AS S','S.sub_district_code = SM.sub_district_code');
		$this->db->join('rev_district_master AS R','R.rev_district_code = SM.rev_district_code');
		$this->db->where('SM.school_code',$schoolcode);
		$this->db->from('school_master SM');
		$result		=	$this->db->get(); 
		//var_dump($result->result_array());
		return $result->result_array();
	}
	function get_school_details_flag($schoolcode){
		$this->db->select('SD.data_entered_flag');
		$this->db->where('SD.school_code',$schoolcode);
		$this->db->from('school_details SD');
		$result		=	$this->db->get(); 
		//var_dump($result->result_array());
		return $result->result_array();
	}
	function save_school_details($schoolcode){
	
		$data['class_start']		=	(int)$this->input->post('txtStandardFrom');
		$data['class_end']			=	(int)$this->input->post('txtStandardTo');
		$data['school_phone']		=	$this->input->post('txtSchoolPhone');
		$data['school_email']		=	$this->input->post('txtSchoolEmail');
		$data['hm_name']			=	$this->input->post('txtHeadmaster');
		$data['hm_phone']			=	$this->input->post('txtHeadmasterPhone');
		$data['principal_name']		=	$this->input->post('txtPrincipal');
		$data['principal_phone']	=	$this->input->post('txtPrincipalPhone');
		$data['strength_lp']		=	0;
		$data['strength_up']		=	0;
		$data['strength_hs']		=	0;
		$data['strength_hss']		=	0;
		$data['strength_vhss']		=	0;
		$data['total_strength']		=   0;
		
		
		
	if($data['class_start']==1 && $data['class_end']==4)
	{
	$data['strength_lp']		=	(int)$this->input->post('txtTotalLP');
	
    }
	
	if($data['class_start']==1 && $data['class_end']==5 || $data['class_start']==1 && $data['class_end']==7)
	{
	$data['strength_lp']		=	(int)$this->input->post('txtTotalLP');
	$data['strength_up']		=	(int)$this->input->post('txtTotalUP');

    }
	if($data['class_start']==1 && $data['class_end']==10)
	{
	$data['strength_lp']		=	(int)$this->input->post('txtTotalLP');
	$data['strength_up']		=	(int)$this->input->post('txtTotalUP');
	$data['strength_hs']		=	(int)$this->input->post('txtTotalHS');

    }
if($data['class_start']==1 && $data['class_end']==12)
	{
	$data['strength_lp']		=	(int)$this->input->post('txtTotalLP');
	$data['strength_up']		=	(int)$this->input->post('txtTotalUP');
	$data['strength_hs']		=	(int)$this->input->post('txtTotalHS');
	$data['strength_hss']		=	(int)$this->input->post('txtTotalHSS');
	$data['strength_vhss']		=	(int)$this->input->post('txtTotalVHSS');

    }
if($data['class_start']==5 && $data['class_end']==5 || $data['class_start']==5 && $data['class_end']==7)
	{
	$data['strength_up']		=	(int)$this->input->post('txtTotalUP');

    }


if($data['class_start']==5 && $data['class_end']==10)
	{
	$data['strength_up']		=	(int)$this->input->post('txtTotalUP');
	$data['strength_hs']		=	(int)$this->input->post('txtTotalHS');

    }

if($data['class_start']==5 && $data['class_end']==12)
	{
	$data['strength_up']		=	(int)$this->input->post('txtTotalUP');
	$data['strength_hs']		=	(int)$this->input->post('txtTotalHS');
	$data['strength_hss']		=	(int)$this->input->post('txtTotalHSS');
	$data['strength_vhss']		=	(int)$this->input->post('txtTotalVHSS');

    }
if($data['class_start']==8 && $data['class_end']==10)
	{
	$data['strength_hs']		=	(int)$this->input->post('txtTotalHS');

    }
if($data['class_start']==8 && $data['class_end']==12)
	{
	$data['strength_hs']		=	(int)$this->input->post('txtTotalHS');
	$data['strength_hss']		=	(int)$this->input->post('txtTotalHSS');
	$data['strength_vhss']		=	(int)$this->input->post('txtTotalVHSS');

    }
if($data['class_start']==11 && $data['class_end']==12)
	{
	$data['strength_hss']		=	(int)$this->input->post('txtTotalHSS');
	$data['strength_vhss']		=	(int)$this->input->post('txtTotalVHSS');

    }

		$data['total_strength']		=	$data['strength_lp']+$data['strength_up']+$data['strength_hs']+$data['strength_hss']+$data['strength_vhss'];
		
		$data['data_entered_flag']		=	'Y';
		$this->db->where('school_code',$schoolcode);
		return $this->db->update('school_details',$data);	
	}
	
	function school_finalize($schoolcode){
		$data['is_finalize']		=	'Y';
		$this->db->where('school_code',$schoolcode);
		return $this->db->update('school_details',$data);
		
		$data1['master_confirm']		=	'Y';
		$this->db->where('school_code',$schoolcode);
		return $this->db->update('school_master',$data1);
	}
	
	function get_designation_details()
	{
		$this->db->select('*');
		$query	= $this->db->get('tbl_designation');
		$result	= $query->result_array();
		return $result;
	}
	function get_escorting_teacher_details($school_code,$fairId)
	{
		$this->db->where('school_code', $school_code);
		$this->db->where('fairId', $fairId);
		//$this->db->where('exhibition', 0);
		$escorting_info		=	$this->db->get('teacherAndEscortings');
		$escorting_details	=	$escorting_info->result_array();
		return $escorting_details;
	}
	function get_escorting_teacher_details_exb($school_code,$fairId)
	{
		$this->db->where('school_code', $school_code);
		$this->db->where('fairId', $fairId);
		$this->db->where('exhibition', 2);
		$escorting_info		=	$this->db->get('teacherAndEscortings');
		$escorting_details	=	$escorting_info->result_array();
		return $escorting_details;
	}
	
	function get_item_details($category,$id){
		if($id==2)
		{$this->db->where('IM.is_quiz','N');}
		
		if($id==3)
		{$itemary=array('205','206');
		$this->db->where_not_in('IM.item_code ',$itemary);}
		
		$this->db->select('IM.*');
		$this->db->where('IM.fairId',$id);
		$this->db->where('IM.fest_id',$category);
		$this->db->where('IM.exb_flag','N');
		$this->db->where('IM.max_participants >',0);
		$this->db->order_by('IM.item_code');
		$this->db->from('item_master IM');
		$result		=	$this->db->get(); 
		//var_dump($result->result_array());
		return $result->result_array();
	}
	function get_item_details_exb($category,$id,$class_end=0){
	
		if($id==2)
		{$this->db->where('IM.is_quiz','N');}
		
		$this->db->select('IM.*');
		
		if($class_end <= 7)$this->db->where('IM.exb_cat','P');
		else if($class_end >= 8)$this->db->where('IM.exb_cat','H');
		
		$this->db->where('IM.fairId',$id);
		$this->db->where('IM.fest_id',0);
		$this->db->where('IM.exb_flag','Y');
		$this->db->where('IM.max_participants >',0);
		$this->db->order_by('IM.item_code');
		$this->db->from('item_master IM');
		$result		=	$this->db->get(); 
		//var_dump($result->result_array());
		return $result->result_array();
	}
	function get_part_details($schoolcode,$fairid,$category){
		if($fairid==2)
		{$this->db->where('IM.is_quiz','N');}
		
		$this->db->select('PID.*');
		$this->db->join('item_master AS IM','IM.fairId = PID.fairId','LEFT');
		$this->db->where('PID.school_code',$schoolcode);
		$this->db->where('PID.fairId',$fairid);
		$this->db->where('IM.fest_id',$category);
		$this->db->order_by('IM.item_code');
		$this->db->from('participant_item_details PID');
		//$this->db->group_by('PID.pi_id');
		$result		=	$this->db->get(); 
		//var_dump($result->result_array());
		return $result->result_array();
	}
		
	function log_school_details($schoolCode)
	{
		$this->db->where('school_code',$schoolCode);
		$school_details		=	$this->db->get('school_details');
		if ($school_details->num_rows() > 0)
		{
			$school				=	$school_details->result_array();
			
			$data						=	array();
			$data['school_code']		=	$school[0]['school_code'];	
			$data['class_start']		=	$school[0]['class_start'];
			$data['class_end']			=	$school[0]['class_end'];
			$data['school_phone']		=	$school[0]['school_phone'];
			$data['hm_name']			=	$school[0]['hm_name'];
			$data['hm_phone']			=	$school[0]['hm_phone'];
			$data['principal_name']		=	$school[0]['principal_name'];
			$data['principal_phone']	=	$school[0]['principal_phone'];
			//$data['teachers']			=	$school[0]['teachers'];
			$data['strength_lp']		=	$school[0]['strength_lp'];
			$data['strength_up']		=	$school[0]['strength_up'];
			$data['strength_hs']		=	$school[0]['strength_hs'];	
			$data['strength_hss']		=	$school[0]['strength_hss'];	
			$data['strength_vhss']		=	$school[0]['strength_vhss'];	
			$data['total_strength']		=	$school[0]['total_strength'];
			$data['ip']					=	$this->input->ip_address();
			$data['user_id']			=	$this->session->userdata('USERID');
			$data['status']				=	0;
			
			$this->db->insert('z_school_details_log',$data);
		}
	}
	
	function fair_count($fairId,$school_code,$gender)
	{
		//echo "<br />...".$fairId;
		//echo "<br />...".$school_code;
		//echo "<br />...".$gender;
		$this->db->select('count(*) as cnt');
		$this->db->where('PID.fairId',$fairId);
		$this->db->where('PID.school_code',$school_code);
		$this->db->where('PID.gender',$gender);
		$this->db->from('participant_item_details PID');
		$result		=	$this->db->get(); 	
		$rst	=	$result->result_array();
		//echo "...".$rst[0]['cnt'];
		//var_dump($result->result_array());
		return $rst[0]['cnt'];
	
	
	
	}
	
	function update_special_order_participant_details($team)
	{
		
		//echo '<br><br><br>';
		//print_r($_POST);
		$lmt	=0;
		$schoolcode	=	$this->input->post('hidSchoolId');
		$item_code	=	$this->input->post('hidItemCode');
		$fairid		=	$this->input->post('cmbFairType');
		$festid		=	$this->input->post('cmbFestType');
		$spoid		=	$this->input->post('cmbOrder');
		
		$limit		=	($this->input->post('limit')>0)?$this->input->post('limit'):$lmt;
		
		$item_type	=	$this->input->post('item_type');
		$sub_district_code=$this->session->userdata('SUB_DISTRICT');
		
				$this->db->select('max(pid.team_no) as team_no');
				$this->db->where('pid.school_code',$schoolcode);
				$this->db->where('pid.item_code',$item_code);
				$this->db->from('participant_item_details pid');
				$result4	=	$this->db->get(); 
				$part_details4=$result4->result_array();
		$captaincounter =1;
		for($i=0;$i<=$limit;$i++)
		{
		//echo '<br>'.$i.'<br>';
			$data_par=array();
			//$admn	=	$this->input->post('txtADNO');
		$pi_id = $this->input->post('pi_id'.$i);	
	
				 
		$admn	=	$this->input->post('txtADNO'.$i);
			
				 
			$txtADNO			=	'txtADNO'.$i;
			$txtExhibitname		=	'txtExhibitName';
			$txtParticipantName	=	'txtParticipantName'.$i;
			$txtClass			=	'txtClass'.$i;
			$txtGender			=	'txtGender'.$i;
			 $admn_no	=	$this->input->post('txtADNO'.$i);
			 if($festid==4){
			 $admn_fest1=str_split($admn,1);
			 $admn_fest= $admn_fest1[0];
			 $admn_category1='admn_category'.$i;
			 $admn_category=$this->input->post($admn_category1);
			 if($admn_fest!='H' && $admn_fest!='V'){
			 
			 $admn_no=$admn_category.$this->input->post($txtADNO);
			 }
			 if($admn_fest=="H" && $admn_category=="V"){
			 $adno=substr($admn,1,strlen($admn));
			 $admn_no=$admn_category.$adno;
			 }
			 if($admn_fest=="V" && $admn_category=="H"){
			 $adno=substr($admn,1,strlen($admn));
			 $admn_no=$admn_category.$adno;
			 }
			 }
			 
			$data['team_no']					=	$team; 
			$data['spo_id']						=	$spoid; 
			$data['fairId']						=	$fairid;
			$data['fest_id']					=	$festid;
			$data['school_code']				=	$schoolcode;
			$data['sub_district_code']			=	$sub_district_code;
			$data['item_type']					=	$item_type;
			$data['item_code']					=	$item_code;
			$data['admn_no']					=	$admn_no;
			$data['exhibit_name']				=	@$this->input->post($txtExhibitname);
			$data['participant_name']			=	$this->input->post($txtParticipantName);
			$data['class']						=	(int)$this->input->post($txtClass);
			$data['gender']						=	$this->input->post($txtGender);
			//print_r($data);
			
			
			$this->db->select('pid.*');
			$this->db->where('pid.admn_no',$admn_no);
			$this->db->where('pid.school_code',$schoolcode);
			$this->db->from('participant_item_details pid');
			$result1	=	$this->db->get(); 
			$part_details1=$result1->result_array();
			$cnt1	=	count($part_details1);
			//echo '<br>cnt=='.$cnt1.'<br>';		
			if($cnt1 > 0)
			{
				$data['participant_id']	=	$part_details1[0]['participant_id'];
				//$admn_no='2058';
				//$this->db->select('max(pid.team_no) as team_no');
				$this->db->select('pid.*');
				$this->db->where('pid.admn_no',$admn_no);
				$this->db->where('pid.school_code',$schoolcode);
				$this->db->where('pid.item_code',$item_code);
				$this->db->from('participant_item_details pid');
				$result2	=	$this->db->get(); 
				$part_details2=$result2->result_array();
				
				$cnt2	=	count($part_details2);
				//echo '<br><br><br>cnt2=='.$cnt2.'--'.$admn_no;
				if($cnt2 > 0)
				{
			
					
					$this->db->select('max(pid.team_no) as team_no');
					$this->db->where('pid.pi_id',$part_details2[0]['pi_id']);
					$this->db->from('participant_item_details pid');
					$result21	=	$this->db->get(); 
					$part_details21=$result21->result_array();
					
					$data['team_no']			 =	$part_details21[0]['team_no'];
					
					$this->db->where('school_code',$schoolcode);
					//
					$this->db->where('item_code',$item_code);
					if($pi_id>0)$this->db->where('pi_id',$pi_id);
					//else $this->db->where('admn_no',$admn_no);
					$this->db->update('participant_item_details',$data) ;
				}
				/*else
				{
					$data['team_no']		=	1;
				}
				*/
			
			}
			else
			{
				$this->db->select_max('participant_id');
				$this->db->from('participant_item_details pid');
				$result3				=	$this->db->get(); 
				$part_details3			=	$result3->result_array();
				$data['participant_id']	=	$part_details3[0]['participant_id']+1;
				
				
			
				//$data['team_no']		=	$part_details4[0]['team_no']+1;
				
				if($i==0){
				if($this->input->post($admn_no) > 0 || $this->input->post($admn_no) != '' )$captaincounter++;
				
				$is_cap='Y';
							
				}
				else 
				{ 
					if($captaincounter==1){$is_cap='Y';$captaincounter++;}
					else $is_cap='N';
				}
		
			 
			$data['spo_id']						=	$spoid; 
			$data['fairId']						=	$fairid;
			$data['fest_id']					=	$festid;
			$data['school_code']				=	$schoolcode;
			$data['sub_district_code']			=	$sub_district_code;
			$data['item_type']					=	$item_type;
			$data['item_code']					=	$item_code;
			//$data['admn_no']					=	$this->input->post($txtADNO);
			$data['admn_no']					=	$admn_no;
			$data['exhibit_name']				=	$this->input->post($txtExhibitname);
			$data['participant_name']			=	$this->input->post($txtParticipantName);
			$data['class']						=	(int)$this->input->post($txtClass);
			$data['gender']						=	$this->input->post($txtGender);
			$data['is_captain']					=	$is_cap;
			
			$this->db->select('*');
			$this->db->where('item_code',$item_code);
			$this->db->from('result_time');
			$ssresult5	=	$this->db->get(); 
			$sspart_details5=$ssresult5->result_array();
			$cnt5 = count($sspart_details5);
			
			if($cnt5 > 0)
			{
				$data_par['error_array']="Result is already entered for the entered Item code ";
			}
			else
			{
				
				
				//$data_par['error_array']=0;
				if($admn)
				{
					if($pi_id>0)
					{
					$this->db->where('school_code',$schoolcode);
					//
					$this->db->where('item_code',$item_code);
					$this->db->where('pi_id',$pi_id);
					//else $this->db->where('admn_no',$admn_no);
					$this->db->update('participant_item_details',$data) ;
					}
					else
					$this->db->insert('participant_item_details',$data);
				}

			}
			}
			
		
		}
		
	return @$data_par;
	
	}
	
	
	function save_special_order_participant_details () 
	{
		//echo '<br><br><br>';
		//print_r($_POST);
		$lmt	=0;
		$schoolcode	=	$this->input->post('hidSchoolId');
		$item_code	=	$this->input->post('txtItemCode_1');
		$fairid		=	$this->input->post('cmbFairType');
		$festid		=	$this->input->post('cmbFestType');
		$spoid		=	$this->input->post('cmbOrder');
		
		$limit		=	($this->input->post('limit')>0)?$this->input->post('limit'):$lmt;
		
		$item_type	=	$this->input->post('item_type');
		$sub_district_code=$this->session->userdata('SUB_DISTRICT');
		
				$this->db->select('max(pid.team_no) as team_no');
				$this->db->where('pid.school_code',$schoolcode);
				$this->db->where('pid.item_code',$item_code);
				$this->db->from('participant_item_details pid');
				$result4	=	$this->db->get(); 
				$part_details4=$result4->result_array();
		$captaincounter =1;
		for($i=0;$i<=$limit;$i++)
		{
			$data_par=array();
			$admn	=	$this->input->post('txtADNO'.$i);
			
				 
			$txtADNO			=	'txtADNO'.$i;
			$txtExhibitname		=	'txtExhibitName';
			$txtParticipantName	=	'txtParticipantName'.$i;
			$txtClass			=	'txtClass'.$i;
			$txtGender			=	'txtGender'.$i;
			 $admn_no	=	$this->input->post('txtADNO'.$i);
			 if($festid==4){
			 $admn_fest1=str_split($admn,1);
			 $admn_fest= $admn_fest1[0];
			 $admn_category1='admn_category'.$i;
			 $admn_category=$this->input->post($admn_category1);
			 if($admn_fest!='H' && $admn_fest!='V'){
			 
			 $admn_no=$admn_category.$this->input->post($txtADNO);
			 }
			 if($admn_fest=="H" && $admn_category=="V"){
			 $adno=substr($admn,1,strlen($admn));
			 $admn_no=$admn_category.$adno;
			 }
			 if($admn_fest=="V" && $admn_category=="H"){
			 $adno=substr($admn,1,strlen($admn));
			 $admn_no=$admn_category.$adno;
			 }
			 }
			 
			$data['spo_id']						=	$spoid; 
			$data['fairId']						=	$fairid;
			$data['fest_id']					=	$festid;
			$data['school_code']				=	$schoolcode;
			$data['sub_district_code']			=	$sub_district_code;
			$data['item_type']					=	$item_type;
			$data['item_code']					=	$item_code;
			$data['admn_no']					=	$admn_no;
			$data['exhibit_name']				=	@$this->input->post($txtExhibitname);
			$data['participant_name']			=	$this->input->post($txtParticipantName);
			$data['class']						=	(int)$this->input->post($txtClass);
			$data['gender']						=	$this->input->post($txtGender);
			
			$this->db->select('pid.*');
			$this->db->where('pid.admn_no',$admn_no);
			$this->db->where('pid.school_code',$schoolcode);
			$this->db->from('participant_item_details pid');
			$result1	=	$this->db->get(); 
			$part_details1=$result1->result_array();
			$cnt1	=	count($part_details1);
					
			if($cnt1 > 0)
			{
				$data['participant_id']	=	$part_details1[0]['participant_id'];
				//$admn_no='2058';
				//$this->db->select('max(pid.team_no) as team_no');
				$this->db->select('pid.*');
				$this->db->where('pid.admn_no',$admn_no);
				$this->db->where('pid.school_code',$schoolcode);
				$this->db->where('pid.item_code',$item_code);
				$this->db->from('participant_item_details pid');
				$result2	=	$this->db->get(); 
				$part_details2=$result2->result_array();
				
				$cnt2	=	count($part_details2);
				//echo '<br><br><br>cnt=='.$cnt2;
				if($cnt2 > 0)
				{
			
					
					$this->db->select('max(pid.team_no) as team_no');
					$this->db->where('pid.pi_id',$part_details2[0]['pi_id']);
					$this->db->from('participant_item_details pid');
					$result21	=	$this->db->get(); 
					$part_details21=$result21->result_array();
					
					$data['team_no']			 =	$part_details21[0]['team_no'];
					
					$this->db->where('school_code',$schoolcode);
					$this->db->where('admn_no',$admn_no);
					$this->db->where('item_code',$item_code);
					$this->db->update('participant_item_details',$data) ;
				}
				else
				{
					$data['team_no']		=	1;
				}
				
			
			}
			else
			{
				$this->db->select_max('participant_id');
				$this->db->from('participant_item_details pid');
				$result3				=	$this->db->get(); 
				$part_details3			=	$result3->result_array();
				$data['participant_id']	=	$part_details3[0]['participant_id']+1;
				
						
				$data['team_no']		=	$part_details4[0]['team_no']+1;
				if($i==0){
				if($this->input->post($admn_no) > 0 || $this->input->post($admn_no) != '' )$captaincounter++;
				
				$is_cap='Y';
							
				}
				else 
				{ 
					if($captaincounter==1){$is_cap='Y';$captaincounter++;}
					else $is_cap='N';
				}
				/*	if($i==1) $is_cap	=	'Y'; 
					else $is_cap	=	'N';*/
		
			 
			$data['spo_id']						=	$spoid; 
			$data['fairId']						=	$fairid;
			$data['fest_id']					=	$festid;
			$data['school_code']				=	$schoolcode;
			$data['sub_district_code']			=	$sub_district_code;
			$data['item_type']					=	$item_type;
			$data['item_code']					=	$item_code;
			//$data['admn_no']					=	$this->input->post($txtADNO);
			$data['admn_no']					=	$admn_no;
			$data['exhibit_name']				=	$this->input->post($txtExhibitname);
			$data['participant_name']			=	$this->input->post($txtParticipantName);
			$data['class']						=	(int)$this->input->post($txtClass);
			$data['gender']						=	$this->input->post($txtGender);
			$data['is_captain']					=	$is_cap;
			
			$this->db->select('*');
			$this->db->where('item_code',$item_code);
			$this->db->from('result_time ');
			$ssresult5	=	$this->db->get(); 
			$sspart_details5=$ssresult5->result_array();
			$cnt5 = count($sspart_details5);
			
			if($cnt5 > 0)
			{
				$data_par['error_array']="Result is already entered for the entered Item code ";
			}
			else
			{
				
				if($admn)
				{
					$this->db->insert('participant_item_details',$data);
				}
				
				//stage_allot_new_participant
				
				$this->db->where('item_code',$item_code);
				$ground_item_master		=	$this->db->get('ground_item_master');
				if ($ground_item_master->num_rows() > 0)
				{
					$ground_item			=	$ground_item_master->result_array();
					$no_of_participant		=	$ground_item[0]['no_of_participant'];
					$no_of_participant++;
				}
				$data_ground					=	array();
				$data_ground['no_of_participant']	=	@$no_of_participant;
				$this->db->where('item_code',$item_code);
				$this->db->update('ground_item_master',$data_ground);
				//stage_allot_new_participant

			}
			}
			
		
		}
		
	return @$data_par;
	}
	
	function delete_special_order_participant_details () 
	{
	//echo '<br><br><br>';
	//print_r($_POST);
		$schoolCode 	 = $this->input->post('hidSchoolId');
		$admnNo 	 = $this->input->post('hidADNO');
		$item_code 	 = $this->input->post('hidItemId');
		
		
		$this->db->select('*');
		$this->db->where('item_code',$item_code);
		$this->db->from('result_time ');
		$ssresult5	=	$this->db->get(); 
		$sspart_details5=$ssresult5->result_array();
		$cnt5 = count($sspart_details5);
		
		if($cnt5 > 0)
		{
			$data_par['error_array']="Result is already entered for the entered Item code ";
		}
		else
		{
			//remove stage_allot_new_participant
			$this->db->where('item_code',$item_code);
			$ground_item_master		=	$this->db->get('ground_item_master');
			if ($ground_item_master->num_rows() > 0)
			{
				
					$ground_item		=	$ground_item_master->result_array();
					$no_of_participant	=	$ground_item[0]['no_of_participant'];
					$no_of_participant--;
					$data_ground						=	array();
					$data_ground['no_of_participant']	=	$no_of_participant;
					$this->db->where('item_code',$item_code);
					$this->db->update('ground_item_master',$data_ground);
					
							
							
			}
			//remove stage_allot_new_participant
			//$this->db->where('fairId',$fairid);
			$this->db->where('item_code',$item_code);
			$this->db->where('school_code',$schoolCode);
			//$this->db->where('fest_id',$category);
			$this->db->where('admn_no',$admnNo);
			$this->db->from('participant_item_details');
		
			$ssresult3	=	$this->db->get(); 
			$sspart_details3=$ssresult3->result_array();
			$sscnt3=count($sspart_details3);
			
			if(@$sspart_details3[0]['is_captain']=='Y')//if deleted participant is captaion , make the one among the remaining group as captain
			{
				$captain['is_captain'] = 'Y';
				if(@$item_code==124)//in scienc edrams max participants=8
				{
					$this->db->where('team_no',$sspart_details3[0]['team_no']);
					$this->db->where('school_code',$schoolCode);
					$this->db->where('item_code',$item_code);
					$ssresult4	=	$this->db->get(); 
					$sspart_details4=$ssresult4->result_array();
					$sscnt4=count($sspart_details4);
					
					$this->db->where('participant_id',$sspart_details4[0]['participant_id']);
					$this->db->update('participant_item_details',$captain);
				}
				else//having max participant=2
				{
					$this->db->where('team_no',$sspart_details3[0]['team_no']);
					$this->db->where('school_code',$schoolCode);
					$this->db->where('item_code',$item_code);
					$this->db->update('participant_item_details',$captain);
				}
				
			}
			
		
		
			//$this->db->where('fairId',$fairid);
			$this->db->where('item_code',$item_code);
			$this->db->where('school_code',$schoolCode);
			//$this->db->where('fest_id',$category);
			$this->db->where('admn_no',$admnNo);
			$this->db->delete('participant_item_details');
			/*$this->db->where('school_code', $schoolCode);
			$this->db->where('admn_no', $admnNo);
			$this->db->where('item_code', $item_code);
			$this->db->delete('participant_item_details');*/
		}
	}
	
	function save_escorting_details()
		{
	
				$school_code 	 = $this->input->post('schoolcode');
				$fair_id	 	 = $this->input->post('fairid');
				$teacher_num	 = $this->input->post('escorting_teacher_num');
				$name_team	 	 = $this->input->post('name_team');
				$address_team	 = $this->input->post('address_team');
				$phone_team	 = $this->input->post('phone_team');
				$exb=0;
				if($fair_id==4){
				$exb	 = $this->input->post('exb');	
				}		
				$namedif='';
				if($teacher_num > 0)
				{
				
					$teacher_name='';
					for($i=1;$i<=$teacher_num;$i++)
					{
					
						if(($_POST['escorting_teacher_name'][@$i]<>NULL) && ($_POST['designation'][@$i]<>0) && ($_POST['escorting_teacher_phone'][@$i]<>NULL))
						{
						
							
							@$teacher_name			.=	$namedif.$_POST['escorting_teacher_name'][@$i].'#$#'.$_POST['designation'][@$i].'#$#'.$_POST['escorting_teacher_phone'][@$i];
							$namedif='#@#';
						}
						else
						{
							$data['teachers_num']	=	0;
							@$teacher_name	='';
							break;
						}
				
					}
					
					$data['fairId']				=	$this->input->post('fairid');
					$data['school_code']		=	$this->input->post('schoolcode');
					$data['teachers_num']		=	$this->input->post('escorting_teacher_num');
					$data['escorting_teachers']	= 	$teacher_name;
					//$data['num_boys']			=	$this->input->post('txtboys');
					$data['exhibition']			=	$this->input->post('exb');
					//$data['num_girls']		=	$this->input->post('txtgirls');
					$data['name_team']			=	$this->input->post('name_team');
					$data['address_team']		=	$this->input->post('address_team');
					$data['phone_team']		=	$this->input->post('phone_team');
					//$data['total']			=	$this->input->post('txtTotal');
					
					$this->db->where('school_code', $data['school_code']);
					$this->db->where('exhibition', $data['exhibition']);
					$this->db->where('fairId', $data['fairId']);
					$escorting_details		=	$this->db->get('teacherAndEscortings');
	
					if($escorting_details->num_rows() > 0)
					{
						$this->db->where('school_code', $data['school_code']);
						$this->db->where('fairId', $data['fairId']);
						$this->db->where('exhibition', $data['exhibition']);
						$this->db->update('teacherAndEscortings',$data);
					}
					else $this->db->insert('teacherAndEscortings',$data);
					
					$this->db->where('school_code', $data['school_code']);
					$this->db->where('fairId', $data['fairId']);
					$new_escorting_info		=	$this->db->get('teacherAndEscortings');
					$new_escorting_details	=	$new_escorting_info->result_array();
					return $new_escorting_details;
				}		
				
				
		}
		// get item with itemcode
	function get_details_itemcode($schoolcode,$category,$fairid,$item_code){
		$this->db->select('p.*,im.item_name');
		$this->db->join('item_master AS im','im.item_code = p.item_code');
		$this->db->where('p.fairId',$fairid);
		$this->db->where('p.school_code',$schoolcode);
		$this->db->where('p.fest_id',$category);
		$this->db->where('p.item_code',$item_code);
		$this->db->where('p.spo_id',0);
		$this->db->from('participant_item_details p');
		if($item_code==185 || $item_code==186 || $item_code==187 || $item_code==188)$this->db->order_by('p.team_no');
		
		$result1	=	$this->db->get(); 
		return $result1->result_array();
	
	}
	function get_itemdetails_itemcode($category,$fairid,$item_code){
		$this->db->select('IM.*');
		$this->db->where('IM.fairId',$fairid);
		$this->db->where('IM.item_code',$item_code);
		$this->db->where('IM.fest_id',$category);
		$this->db->where('IM.max_participants >',0);
		$this->db->from('item_master IM');
		$result		=	$this->db->get(); 
		//var_dump($result->result_array());
		return $result->result_array();
	}
	// end
	
	// delete participants
	function delete_details($schoolcode,$category,$fairid,$item_code,$admn,$parti_id=0){
	  //  echo '<br><br><br>ppp==========='.$admn;
			
	   if($parti_id > 0)
	   {
	    $this->db->where('school_code',$schoolcode);
		//$this->db->where('fest_id',$category);
	   	$this->db->where('fairId',$fairid);
	  	$this->db->where('item_code',$item_code);
		$this->db->where('admn_no',$admn);
		$this->db->delete('participant_item_details');
		
	
	
	   }
	   else
	   {
	   		$this->db->where('fairId',$fairid);
			$this->db->where('item_code',$item_code);
			$this->db->where('school_code',$schoolcode);
			$this->db->where('fest_id',$category);
			$this->db->where('admn_no',$admn);
			$this->db->from('participant_item_details');
		
			$ssresult3	=	$this->db->get(); 
			$sspart_details3=$ssresult3->result_array();
			$sscnt3=count($sspart_details3);
			
			if(@$sspart_details3[0]['is_captain']=='Y')//if deleted participant is captaion , make the one among the remaining group as captain
			{
				$captain['is_captain'] = 'Y';
				if(@$item_code==124)//in sciencedrama, max participants=8
				{
					$this->db->where('team_no',$sspart_details3[0]['team_no']);
					$this->db->where('school_code',$schoolcode);
					$this->db->where('item_code',$item_code);
					$this->db->where('admn_no != ',$admn);
					$this->db->from('participant_item_details');
					$ssresult4	=	$this->db->get(); 
					$sspart_details4=$ssresult4->result_array();
					$sscnt4=count($sspart_details4);
					
					if($sscnt4>0)
					{
					$this->db->where('participant_id',$sspart_details4[0]['participant_id']);
					$this->db->update('participant_item_details',$captain);
					}
				}
				else//having max participant=2
				{
					$this->db->where('team_no',$sspart_details3[0]['team_no']);
					$this->db->where('school_code',$schoolcode);
					$this->db->where('item_code',$item_code);
					$this->db->where('admn_no != ',$admn);
					$this->db->update('participant_item_details',$captain);
				}
				
			}
			
		
		
			$this->db->where('fairId',$fairid);
			$this->db->where('item_code',$item_code);
			$this->db->where('school_code',$schoolcode);
			$this->db->where('fest_id',$category);
			$this->db->where('admn_no',$admn);
			return $this->db->delete('participant_item_details');
	}
		
		
	}
	//end delte
	// get all details
	function get_details($schoolcode,$category,$fairid,$exb){
		//$this->db->order_by('p.participant_id');
		$this->db->select('p.*,im.item_name');
		$this->db->join('item_master AS im','im.item_code = p.item_code');
		$this->db->where('p.fairId',$fairid);
		$this->db->where('p.school_code',$schoolcode);
		$this->db->where('p.spo_id',0);
		$this->db->where('p.fest_id',$category);
		$this->db->from('participant_item_details p');
		$result1	=	$this->db->get(); 
		return $result1->result_array();
	}
	function get_details_exb($schoolcode,$category,$fairid,$exb){
		//$this->db->order_by('p.participant_id');
		$this->db->select('p.*,im.item_name');
		$this->db->join('item_master AS im','im.item_code = p.item_code');
		$this->db->where('p.fairId',$fairid);
		$this->db->where('p.school_code',$schoolcode);
		$this->db->where('p.exhibition',2);
		$this->db->where('p.fest_id',$category);
		$this->db->from('participant_item_details p');
		$result1	=	$this->db->get(); 
		return $result1->result_array();
	}
	
	function confirm_fair($schoolcode,$fairid)
	{
	   //echo "<br />--->".$schoolcode."--->".$fairid;
	   
	    if($fairid	==	1)
		{ $melafield	=	'fairScience';	
		  $timeField	=	'science_confirmTime';
		}		
		 if($fairid	==	2)
		{ $melafield	=	'fairMathematics';
		  $timeField	=	'maths_confirmTime';
	    }		
		 if($fairid	==	3)
		{ $melafield	=	'fairSocialScience'; 
		  $timeField	=	'social_confirmTime';
		}		
		 if($fairid	==	4)
		{ $melafield	=	'fairWorkExp'; 
		  $timeField	=	'workexp_confirmTime';
		}		
		 if($fairid	==	5)
		{ $melafield	=	'fairITmela'; 
		  $timeField	=	'it_confirmTime';
		}	
		
		$UpdateArray = array(
               $melafield => 'Y',
               $timeField => date("Y-m-d h:i:s")
            );
		
		$this->db->where('school_code',$schoolcode);
		return $this->db->update('school_details',$UpdateArray);	
		
		$data['school_code']	=	$schoolcode;
		$data['status']			=	'Y';
		$data['ip']					=	$this->input->ip_address();
		$data['user_id']			=	$this->session->userdata('USERID');
		$this->db->insert('z_school_confirm_log',$data);
		
		
	}
	
	function reset_fair($schoolcode,$fairid)
	{
		//echo "<br />--->".$schoolcode."--->".$fairid;
	    if($fairid	==	1)
		{ $field	=	'fairScience';	}		
		 if($fairid	==	2)
		{ $field	=	'fairMathematics'; }		
		 if($fairid	==	3)
		{ $field	=	'fairSocialScience'; }		
		 if($fairid	==	4)
		{ $field	=	'fairWorkExp'; }		
		 if($fairid	==	5)
		{ $field	=	'fairITmela'; }	
		
		$data[$field]		=	'N';
		$this->db->where('school_code',$schoolcode);
		return $this->db->update('school_details',$data);
	
	}
	// for print
	function get_participant_details($schoolcode,$fairid,$category){
		$this->db->select('p.*,im.item_name');
		$this->db->join('item_master AS im','im.item_code = p.item_code');
		$this->db->where('p.fairId',$fairid);
		$this->db->where('p.school_code',$schoolcode);
		$this->db->where('p.fest_id',$category);
		$this->db->where('p.exhibition',0);
		$this->db->from('participant_item_details p');
		$result1	=	$this->db->get(); 
		return $result1->result_array();
	
	}
	
	function get_participant_details_exb($schoolcode,$fairid,$category){
		$this->db->select('p.*,im.item_name');
		$this->db->join('item_master AS im','im.item_code = p.item_code');
		$this->db->where('p.fairId',$fairid);
		$this->db->where('p.school_code',$schoolcode);
		$this->db->where('p.exhibition',1);
		$this->db->where('p.fest_id',$category);
		$this->db->from('participant_item_details p');
		$result1	=	$this->db->get(); 
		return $result1->result_array();
	
	}
	
	function get_special_order_participant_details($schoolCode, $pi_id = '')
	{
		if($pi_id != '')
			$this->db->where('PID.pi_id',$pi_id);
		$this->db->where('PID.school_code',$schoolCode);
		$this->db->where('PID.spo_id != 0');
		$this->db->from('participant_item_details AS PID');
		$this->db->join('item_master AS IM', "IM.item_code = PID.item_code", 'INNER');
		$this->db->join('special_order_master AS SOM', "SOM.spo_id = PID.spo_id", 'INNER');
		$this->db->select('PID.*, IM.item_name, SOM.spo_title');
		$this->db->order_by('PID.item_code, PID.admn_no DESC');
		$result		=	$this->db->get(); 
		return $result->result_array();
	}
	
	function get_special_order_participant_details_itemwise($schoolCode, $item_code,$team)
	{
		
		$this->db->where('PID.team_no',$team);
		$this->db->where('PID.item_code',$item_code);
		$this->db->where('PID.school_code',$schoolCode);
		$this->db->where('PID.spo_id != 0');
		$this->db->from('participant_item_details AS PID');
		$this->db->join('item_master AS IM', "IM.item_code = PID.item_code", 'INNER');
		$this->db->join('special_order_master AS SOM', "SOM.spo_id = PID.spo_id", 'INNER');
		$this->db->select('PID.*, IM.item_name, SOM.spo_title');
		$this->db->order_by('PID.item_code, PID.admn_no DESC');
		//$this->db->order_by('PID.team_no');
		$result		=	$this->db->get(); 
		return $result->result_array();
	}
	
	function get_admn_wise_participant_details($schoolcode,$admn){
		
		$this->db->select('PID.*');
		$this->db->where('PID.school_code',$schoolcode);
		$this->db->where('PID.admn_no',$admn);
		$this->db->from('participant_item_details PID');
		//$this->db->group_by('PID.pi_id');
		$result		=	$this->db->get(); 
		//print_r($result->result_array());
		return $result->result_array();
	}
	
	function get_exhib_details($schoolcode)
	{	
		$this->db->join('item_master AS im',"im.item_code = p.item_code and im.exb_flag='Y'");
		$this->db->where('p.school_code',$schoolcode);
		$this->db->where('p.fairId','4');
		$this->db->from('participant_item_details p');
		$result		=	$this->db->get(); 
		//$result1->result_array();
		//echo "<br /><br /><br /><br /><br />";
		return $result->result_array();
	
	}
	
	function get_teachingaid($schoolcode,$fairid,$category){
	
		if($fairid==1)
		{
			if($category==1)$item_code = 111;
			
		}
		else if($fairid==2)
		{
			if($category==1)$item_code = 146;
		}
		else if($fairid==3)
		{
			if($category==1)$item_code = 194;
			
		}
		
		
		$this->db->select('PD.*');
		$this->db->where('PD.school_code',$schoolcode);
		$this->db->where('PD.fairId',$fairid);
		$this->db->where('PD.fest_id',2);
		$this->db->where('PD.item_code',$item_code);
		$this->db->from('participant_item_details PD');
		$result		=	$this->db->get(); 
		//var_dump($result->result_array());
		return $result->result_array();
	}
	
	function get_teachingproject($schoolcode,$fairid,$category){
	
		if($fairid==1)
		{
			if($category==1)$item_code = 112;
			
		}
		/*else if($fairid==2)
		{
			if($category==1)$item_code = 146;
		}
		else if($fairid==3)
		{
			if($category==1)$item_code = 194;
			
		}*/
		
		
		$this->db->select('PD.*');
		$this->db->where('PD.school_code',$schoolcode);
		$this->db->where('PD.fairId',$fairid);
		$this->db->where('PD.fest_id',2);
		$this->db->where('PD.item_code',$item_code);
		$this->db->from('participant_item_details PD');
		$result		=	$this->db->get(); 
		//var_dump($result->result_array());
		return $result->result_array();
	}
	
	function check_item_result_status($item_code)
	{
		$this->db->select('*');
		$this->db->where('item_code',$item_code);
		$this->db->from('result_time');
		$ssresult5	=	$this->db->get(); 
		$sspart_details5=$ssresult5->result_array();
		$cnt5 = count($sspart_details5);
		
		if($cnt5 > 0)return 1;	
		else return 0;
	}
	
	function check_basic_dtls($school_code,$admn_no,$participant_name,$class,$gender,$item_code=0)
	{
		$this->db->select('*');	
		$this->db->where('school_code',$school_code);
		$this->db->where('admn_no',$admn_no);
		
		if($item_code > 0)$this->db->where('item_code != ',$item_code);
		
		$this->db->from('participant_item_details');
		$result_query	=	$this->db->get(); 
		$result			=	$result_query->result_array();
		$exist_flag=0;
		foreach($result as $row=>$values)
		{
			if($participant_name != $values['participant_name'])
			{
				$exist_flag=1;
				break;
			}
			
			if($class != $values['class'])
			{
				$exist_flag=1;
				break;
			}
			
			if($gender != $values['gender'])
			{
				$exist_flag=1;
				break;
			}
			
		
		}
		//echo '<br><br><br>eeeeee=='.$exist_flag;
		return $exist_flag;
		
		
	}
	
	function update_part_id()
	{
			$this->db->select('*');
			$this->db->where('participant_id',0);
			$this->db->from('participant_item_details');
			$result1		=	$this->db->get(); 
			$res1 = $result1->result_array();
			foreach($res1 as $row=>$vals)
			{
				$this->db->select('max(participant_id) as pis_id');
				$this->db->from('participant_item_details');
				$result2		=	$this->db->get(); 
				$res2 = $result2->result_array();
				$pi_id = $res2[0]['pis_id']+1;
			
				$this->db->where('pi_id',$vals['pi_id']);
				$update_basic_data['participant_id'] = $pi_id;
				$this->db->update('participant_item_details',$update_basic_data);
				
			}
	
	}
		
}

?>