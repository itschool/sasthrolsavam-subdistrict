<?php 

class Science_Model extends CI_Model{
	function Science_Model()
	{
		parent::__construct();
	}
	
	function get_school_details($schoolcode){
	$this->db->select('SM.*,SD.class_start,SD.class_end');
		//
		$this->db->join('school_details AS SD','SM.school_code = SD.school_code','LEFT');
		$this->db->where('SM.school_code',$schoolcode);
		$this->db->from('school_master SM');
		$result		=	$this->db->get(); 
		//var_dump($result->result_array());
		return $result->result_array();
	}
	
	function save_science_details($schoolcode,$category,$fairid,$item_details){
		
		
		$data_par=array();
		$sub_district_code=$this->session->userdata('SUB_DISTRICT');
		$item_count				=	count($item_details);
		/*	echo '<br><br>cnt==='.$item_count.'<br>';
			print_r($_POST);	*/
		@$partid =0;	
		if($_POST['class_to']==4)
		{
		
		for($t=1;$t<3;$t++)
		{
				@$partid							=	@$this->input->post('participant_item_id_sc'.$t);
				$data['fairId']						=	$fairid;
				$data['fest_id']					=	2;
				$data['school_code']				=	$schoolcode;
				$data['admn_no']					=	$_POST['admn_no_sc'.$t];
				$data['sub_district_code']			=	$sub_district_code;
				$data['exhibit_name']				=	$_POST['exhibit_name_sc'.$t];
				$data['participant_name']			=	$_POST['participant_name_sc'.$t];
				$data['class']						=	'';
				$data['gender']						=	$_POST['gender_sc'.$t];
				$data['is_captain']					=	'Y';
				$data['item_type']					=	'S';
				$data['team_no']					=	1;
				$data['item_code']					=	$_POST['item_code_sc'.$t];
			
				$this->db->select('*');	
				$this->db->where('school_code',$schoolcode);
				$this->db->where('admn_no',$data['admn_no']);
				$this->db->from('participant_item_details');
				
				$result_query1	=	$this->db->get(); 
				$result1		=	$result_query1->result_array();
				$cnt_result1 = count($result1);
				
				$teachingaid_exist_flag=0;
				if($cnt_result1 > 0)
				{
					if($result1[0]['fairId'] == $data['fairId'])$teachingaid_exist_flag=0;
					else $teachingaid_exist_flag=1;
				}
				
				if($teachingaid_exist_flag == 0 && $_POST['admn_no_sc'.$t] != '')
				{
		
					if(@$partid > 0)
					{
					 $this->log_participant_details($data['school_code'],$data['item_code'],$data['fairId'],$data['fest_id'],$data['admn_no'],'O');
						 
					$this->db->where('participant_id',$partid);
					$this->db->update('participant_item_details',$data);
					$this->log_participant_details($data['school_code'],$data['item_code'],$data['fairId'],$data['fest_id'],$data['admn_no'],'N');
				//	return 2;
					}
					else
					{
					$this->db->insert('participant_item_details',$data) ;
					}
					$this->log_participant_details($data['school_code'],$data['item_code'],$data['fairId'],$data['fest_id'],$data['admn_no'],'N');
				//	return 2;
				}
			}
		}
		$data_par=array();	
		
		for($i=0;$i<$item_count;$i++)
		{
			//echo '<br><br><br>k==='.$k.'----max==='.$max.'---admn==='.$this->input->post($adm_no).'counter===='.$captaincounter;	
			$item_code[$i]			=	$item_details[$i]['item_code'];
			$item_name[$i]			=	$item_details[$i]['item_name'];
			$max_participants[$i]	=	$item_details[$i]['max_participants'];
			$max					=	$max_participants[$i];
			
			if($max_participants[$i]>1)	$item_type				=	'G'; 
			else $item_type				=	'S';
			
			$item_code1				=	'item_code'.$item_code[$i];
			
			$captaincounter =1;
			while($max_participants[$i]!=0){
			$data=array();
	
				
				
				$k					=	$max_participants[$i];
				$adm_no				=	'adm_no'.$item_code[$i].$k;
				$exhibit_name		=	'exhibit_name'.$item_code[$i];
				$name_participant	=	'name_participant'.$item_code[$i].$k;
				$txtStandard		=	'txtStandard'.$item_code[$i].$k;
				$txtgender			=	'txtgender'.$item_code[$i].$k;
				$remarks			=	'remarks'.$item_code[$i].$k;
				
			
				if($k==$max){
				if($this->input->post($adm_no) > 0 || $this->input->post($adm_no) != '' )$captaincounter++;
				
				$is_cap='Y';
							
				}
				else 
				{ 
					if($captaincounter==1){$is_cap='Y';$captaincounter++;}
					else $is_cap='N';
				}
				
			//$admn_flag=0;
			 $admn_no	=	$this->input->post($adm_no);
			// if($admn_no > 0)	$admn_flag=1;
			
			 if($category==4){
			 $admn_fest1=str_split($admn_no,1);
			 $admn_fest= $admn_fest1[0];
			 $admn_category1='admn_category'.$item_code[$i].$k;
			 $admn_category=$this->input->post($admn_category1);
			 if($admn_fest!='H' && $admn_fest!='V'){
			 
			 $admn_no=$admn_category.$this->input->post($adm_no);
			 }
			 if($admn_fest=="H" && $admn_category=="V"){
			 $adno=substr($admn_no,1,strlen($admn_no));
			 $admn_no=$admn_category.$adno;
			 }
			 if($admn_fest=="V" && $admn_category=="H"){
			 $adno=substr($admn_no,1,strlen($admn_no));
			 $admn_no=$admn_category.$adno;
			 }
			 }
				
				$partid								=	$this->input->post('participant_item_id'.$item_code[$i].$k);
				$data['fairId']						=	$fairid;
				$data['fest_id']					=	$category;
				$data['school_code']				=	$schoolcode;
				$data['admn_no']					=	$admn_no;
				$data['sub_district_code']			=	$sub_district_code;
				$data['exhibit_name']				=	$this->input->post($exhibit_name);
				$data['participant_name']			=	$this->input->post($name_participant);
				$data['class']						=	(int)$this->input->post($txtStandard);
				$data['gender']						=	$this->input->post($txtgender);
				$data['is_captain']					=	$is_cap;
				$data['item_type']					=	$item_type;
				$data['team_no']					=	1;
				$item_code1							=	'item_code'.$item_code[$i];
				$data['item_code']					=	$this->input->post($item_code1);
				//echo '<br><br><br>';
				
				$schoolcode_admn_dtls = array();
				if($data['item_code'] == 123)//if maths magazine
				{ 
				
					//check whether the item_code ,school code exist
					$schoolcode_admn_dtls	=	$this->school_admn_itemcode_exist($data['school_code'],$data['item_code'],1);
				}
				else
				{
					//check whether the admission number ,school code exist
					if($this->input->post($adm_no)>0 || $this->input->post($adm_no) != '')
					{
					
						$schoolcode_admn_dtls	=	$this->school_admn_itemcode_exist($data['school_code'],$data['admn_no']);
					}
				}
				$cnt1=count($schoolcode_admn_dtls);
				
				if($cnt1 > 0)//exist
				{		$data['participant_id']	=	$schoolcode_admn_dtls[0]['participant_id'];		
					//check exist fair =post fair
					$exist_fair = $this->check_exist_fair($data['fairId'],$data['school_code'],$data['admn_no']);
					$cnt2 = count($exist_fair);
					if($cnt2 > 0)//if  exist fair =post fair
					{//echo '<br>1<br>';
						$insert_datas = $this->fair_exist($data,$exist_fair,$partid);
					}
					else//if  exist fair != post fair
					{//echo '<br>2<br>';
						$exb_fair = $this->exb_fair_exist($data,$schoolcode_admn_dtls,$partid);
						if($exb_fair['flg'] == 4)$insert_datas = $this->fair_not_exist($data,$partid);
							else $insert_datas = $exb_fair;
					}
				}
				else//if  exist fair != post fair
				{//echo '<br>3<br>';
					$insert_datas = $this->insert_update_datas($data,$partid);//update
					
											
					
				}
					
				$data_par['flg']=$insert_datas['flg'];	
					
				
				
			$max_participants[$i] = $max_participants[$i] -1;	
		
		
			}//while
			
			if($data_par['flg']==3 && @$_POST['edit_item']<>1)break;
		}//for
		return $data_par;
	
	}
	
	//----------------------
	function insert_update_datas($data,$partid=0)
	{
			$admn_flag=0;
			if($data['fest_id']==4)
			{
			//echo '<br><br><Br>'.$data['admn_no'];
				$admn_hss	=	substr($data['admn_no'],0,1);
				//echo '<br>'.$admn_hss;
				$admn_num 	=	explode($admn_hss,$data['admn_no']);
				//print_r($admn_num);
				if($admn_num[1] > 0 || $admn_num[1] != '')$admn_flag=1;
			}
			else
			{
				if($data['admn_no'] > 0 || $data['admn_no'] != '')$admn_flag=1;
			}
			
			//echo '<br><br><br>'.$data['admn_no'];		
			if(($data['item_code'] == 123 && $data['exhibit_name'] != '')  || ($admn_flag > 0))
			{	
				if($partid > 0)
				{
					
					$this->db->select('max(pid.team_no) as team_no');
					$this->db->where('pid.pi_id',$partid);
					$this->db->from('participant_item_details pid');
					$result21	=	$this->db->get(); 
					$part_details21=$result21->result_array();
					
					$data['team_no']			 =	$part_details21[0]['team_no'];
					$this->log_participant_details($data['school_code'],$data['item_code'],$data['fairId'],$data['fest_id'],$data['admn_no'],'O');
					$this->db->where('pi_id',$partid);
					$this->db->update('participant_item_details',$data);
					$this->log_participant_details($data['school_code'],$data['item_code'],$data['fairId'],$data['fest_id'],$data['admn_no'],'N');
					$data_par['flg'] =2;
				}
				else
				{
					$this->db->select('participant_id');
					$this->db->where('pid.school_code',$data['school_code']);
					$this->db->where('pid.admn_no',$data['admn_no']);
					$this->db->from('participant_item_details pid');
					$result31				=	$this->db->get(); 
					$part_details31			=	$result31->result_array();
					$cnt31 =count($part_details31);
					
					
					if($cnt31 > 0)$data['participant_id']	=	$part_details31[0]['participant_id'];
				    else { 
					$this->db->select('max(participant_id) as participant_id');
					$this->db->from('participant_item_details pid');
					$result32				=	$this->db->get(); 
					$part_details32			=	$result32->result_array();
					$data['participant_id']	=	$part_details32[0]['participant_id']+1;
					
					}
					
					$this->db->select('max(pid.team_no) as team_no');
					$this->db->where('pid.school_code',$data['school_code']);
					$this->db->where('pid.item_code',$data['item_code']);
					$this->db->from('participant_item_details pid');
					$result4	=	$this->db->get(); 
					$part_details4=$result4->result_array();
					
					
					$this->db->select('max(pid.team_no) as team_no');
					$this->db->where('pid.school_code',$data['school_code']);
					$this->db->where('pid.item_code',$data['item_code']);
					$this->db->where('pid.spo_id',0);
					$this->db->from('participant_item_details pid');
					$result41	=	$this->db->get(); 
					$part_details41=$result41->result_array();
					if($part_details41[0]['team_no']==0)
						$data['team_no']		=	$part_details4[0]['team_no']+1;
					else
					{
					$data['team_no'] = $part_details41[0]['team_no'];
					}
					
					$this->db->insert('participant_item_details',$data);
					$this->log_participant_details($data['school_code'],$data['item_code'],$data['fairId'],$data['fest_id'],$data['admn_no'],'N');
					$data_par['flg'] =2;
				}
				
				//updating participant name , class, gender of all entries , having this admission number
				//$update_basic_info	=	$this->update_basic_dtls($data);
				//$data_par['flgb']=$update_basic_info;
				return $data_par;
			}
	}
	
	function update_basic_dtls($data)
	{
		//updating participant name , class, gender of all entries , having this admission number
		$this->log_participant_details($data['school_code'],$data['item_code'],$data['fairId'],$data['fest_id'],$data['admn_no'],'O');
		$update_basic_data=array();
		$update_basic_data['participant_name']	=	$data['participant_name'];
		$update_basic_data['class']				=	$data['class'];
		$update_basic_data['gender']			=	$data['gender'];
		$this->db->where('school_code',$data['school_code']);
		$this->db->where('admn_no',$data['admn_no']);
		$this->db->update('participant_item_details',$update_basic_data);
		$this->log_participant_details($data['school_code'],$data['item_code'],$data['fairId'],$data['fest_id'],$data['admn_no'],'N');
		return 2;
	}
	
	function exb_fair_exist($data,$schoolcode_admn_dtls,$partid)
	{
			foreach($schoolcode_admn_dtls as $intRow => $values)
			{
				if($values['exhibition'] == 2)
				{
					if($values['class'] == $data['class'])
					{
						$insert_datas = $this->insert_update_datas($data,$partid);//update
						$data_par['flg']=$insert_datas['flg'];	
					}
					else
					{
						$data_par['flg']=3;//Admission number already in another fest
						$data_par['name']=$item_name[$i];
						break;	
					}
				}else {$data_par['flg']=4; break;}
			}
			
			return $data_par;
	}
	
	function fair_not_exist($data,$partid=0)
	{
		$exist_fest = $this->check_exist_fest($data['fest_id'],$data['fairId'],$data['school_code'],$data['admn_no']);
		$cnt3 = count($exist_fest);
		if($cnt3 > 0)//if  exist fest =post fest
		{
				$insert_datas = $this->insert_update_datas($data,$partid);//update
				$data_par['flg']=$insert_datas['flg'];	
				$data_par['flgb']=$insert_datas['flgb'];
				
		}
		else
		{
				$data_par['flg']=3;//Admission number already in another fest
				$data_par['name']=$item_name[$i];
				break;	
		}
		
		return $data_par;
	}
	
	function fair_exist($data,$schoolcode_admn_dtls,$partid=0)
	{
			
			$exist_fest = $this->check_exist_fest($data['fest_id'],$data['fairId'],$data['school_code'],$data['admn_no']);
			$cnt3 = count($exist_fest);
			if($cnt3 > 0)//if  exist fest =post fest
			{
				$exist_item = $this->check_exist_item($data['item_code'],$data['school_code'],$data['admn_no']);
				$cnt4 = count($exist_item);
				if($cnt4 > 0)//if  exist item =post item
				{
					$insert_datas = $this->insert_update_datas($data,$partid);//update
					$data_par['flg']=$insert_datas['flg'];	
					$data_par['flgb']=$insert_datas['flgb'];
				}
				else//not exist in post item
				{
					$exist_item_isquiz = $this->check_exist_item_isquiz($data['item_code'],$schoolcode_admn_dtls);
					if($exist_item_isquiz == 1)//exist item is  quiz ,//exist item is not quiz but, post item is quiz
					{
						$insert_datas = $this->insert_update_datas($data,$partid);//update
						$data_par['flg']=$insert_datas['flg'];	
						$data_par['flgb']=$insert_datas['flgb'];
					}
					
					$exist_item_isworkexp = $this->check_exist_item_isworkexpit($data['item_code'],$schoolcode_admn_dtls);
					if($exist_item_isworkexp == 1)//exist item is  quiz ,//exist item is not quiz but, post item is quiz
					{
						$insert_datas = $this->insert_update_datas($data,$partid);//update
						$data_par['flg']=$insert_datas['flg'];	
						$data_par['flgb']=$insert_datas['flgb'];
					}	
				}
			}
			else
			{
					$data_par['flg']=3;//Admission number already in another fest
					$data_par['name']=$item_name[$i];
					break;	
			}
							
			return $data_par;			
	}

	function school_admn_itemcode_exist($schoolcode,$adm_no_or_item_code,$item_codeexist=0)
	{
		$this->db->select('*');	
		$this->db->where('school_code',$schoolcode);
		
		if($item_codeexist>0)$this->db->where('item_code',$adm_no_or_item_code);
		else $this->db->where('admn_no',$adm_no_or_item_code);
		
		$this->db->from('participant_item_details');
		$result_query	=	$this->db->get(); 
		$result			=	$result_query->result_array();
		return $result;
	}

	function check_exist_fair($fair,$school_code,$admn_no)
	{
		$this->db->select('*');	
		$this->db->where('school_code',$school_code);
		$this->db->where('admn_no',$admn_no);
		//$this->db->where('fairId',$fair);
		$this->db->from('participant_item_details');
		$result_query	=	$this->db->get(); 
		$result			=	$result_query->result_array();
		return $result;
	}
	
	function check_exist_fest($fest,$fair,$school_code,$admn_no)
	{
		$this->db->select('*');	
		$this->db->where('school_code',$school_code);
		$this->db->where('admn_no',$admn_no);
		//$this->db->where('fairId',$fair);
		$this->db->where('fest_id',$fest);
		$this->db->from('participant_item_details');
		$result_query	=	$this->db->get(); 
		$result			=	$result_query->result_array();
		return $result;
	}
	
	function check_exist_item($item,$school_code,$admn_no)
	{
		$this->db->select('*');	
		$this->db->where('school_code',$school_code);
		$this->db->where('admn_no',$admn_no);
		$this->db->where('item_code',$item);
		$this->db->from('participant_item_details');
		$result_query	=	$this->db->get(); 
		$result			=	$result_query->result_array();
		return $result;
	}
	
	function check_item_isquiz($item_code)
	{
		$this->db->select('is_quiz');	
		$this->db->where('item_code',$item_code);	
		$this->db->from('item_master');
		$result_query	=	$this->db->get(); 
		$result			=	$result_query->result_array();
		$item_is_quiz	=	$result[0]['is_quiz'];
		return $item_is_quiz;
	}
	
	function check_item_isworkexp($item_code)
	{
		$this->db->select('fairId');	
		$this->db->where('item_code',$item_code);	
		$this->db->from('item_master');
		$result_query	=	$this->db->get(); 
		$result			=	$result_query->result_array();
		$item_is_quiz	=	$result[0]['fairId'];
		return $item_is_quiz;
	}
	
	function check_exist_item_isquiz($item_code,$schoolcode_admn_dtls)
	{
		foreach ($schoolcode_admn_dtls as $row)
		{	
			//check whether the exist item is quiz or not
			$is_quiz			=	$this->check_item_isquiz($row['item_code']);		
			$quiz_flag			=	 0;
			
				if($is_quiz == 'N')//exist item is not quiz 
				{
					//check whether the post item is quiz or not
					$item_isquiz	=	$this->check_item_isquiz($item_code);
					
					if($item_isquiz=='Y')$quiz_flag	=	 1;//post item is quiz
					else $quiz_flag	=	 0;//post item is not quiz
																						
					break;	
				}
				else if($is_quiz == 'Y')//exist item is  quiz 
				{
					$quiz_flag	=	 1;//exist item is  quiz 
				}
					
						
			
		} // for each
		
	
		
		return $quiz_flag;
		
	}

	//----------------------
	
	function check_exist_item_isworkexpit($item_code,$schoolcode_admn_dtls)
	{
		foreach ($schoolcode_admn_dtls as $row)
		{	
			//check whether the exist item is workexp/IT or not
			$is_quiz			=	$this->check_item_isworkexp($row['item_code']);		
			
			$quiz_flag			=	 0;
			
				if($is_quiz != 4 && $is_quiz != 5)//exist item is not workexp/IT
				{
					//check whether the post item is workexp/IT or not
					$item_iswork	=	$this->check_item_isworkexp($item_code);
					
					if($item_iswork==4 || $item_iswork==5)$quiz_flag	=	 1;//post item is workexp/IT
					else $quiz_flag	=	 0;//post item is not workexp/IT
																						
					break;	
				}
				else if($is_quiz == 4 || $is_quiz == 5)//exist item is  workexp/IT 
				{
					$quiz_flag	=	 1;//exist item is  workexp/IT 
				}					
			
		} // for each	
		
		return $quiz_flag;		
	}
	
	
	function log_participant_details($schoolCode,$itemcode,$fairid,$festid,$admnNo,$status)
	{
		$this->db->where('school_code',$schoolCode );
		$this->db->where('item_code',$itemcode);
		$this->db->where('fairId',$fairid);	
		$this->db->where('admn_no',$admnNo);		
		$participant_item_details	=	$this->db->get('participant_item_details');
		foreach($participant_item_details->result_array() as $participant_item)
		{
			$data 	=	array();			
			$data['participant_id']		=	$participant_item['participant_id'];
			$data['fairId']				=	$participant_item['fairId'];
			$data['fest_id']			=	$participant_item['fest_id'];
			$data['school_code']		=	$participant_item['school_code'];
			$data['item_code']			=	$participant_item['item_code'];
			$data['item_type']			=	$participant_item['item_type'];
			$data['admn_no']			=	$participant_item['admn_no'];
			$data['exhibit_name']		=	$participant_item['exhibit_name'];
			$data['participant_name']	=	$participant_item['participant_name'];
			$data['class']				=	$participant_item['class'];
			$data['gender']				=	$participant_item['gender'];			
			$data['is_captain']			=	$participant_item['is_captain'];
			$data['group_category']		=	$participant_item['group_category'];
			$data['team_no']			=	$participant_item['team_no'];
			$data['ip']					=	$this->input->ip_address();
			$data['user_id']			=	$this->session->userdata('USERID');
			$data['status']				=	$status;
			
			$this->db->insert('z_participant_item_details_log',$data);
			
		}
		
	}
	
	function school_existin_participant_item($school_code,$fairId)
	{
	//echo '..............'.$school_code;
	
			
			$this->db->distinct('*');
			$this->db->where('school_code',$school_code);
			$this->db->where('fairId',$fairId);
			$this->db->from('participant_item_details');
						
			$result1		=	$this->db->get(); 
			
			//var_dump($result1->result_array());
			if(count($result1->result_array()) >0)
			{
				$return['entered']	= 'Yes';
			}
			else
			{
				$return['entered']	= 'No';
			}
	
			//var_dump($return);
			return $return;
	}
	
	
	  
}



?>