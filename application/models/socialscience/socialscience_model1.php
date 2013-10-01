<?php

class Socialscience_Model extends CI_Model{
	function Socialscience_Model()
	{
		parent::__construct();
	}
	function get_details_4lp($schoolcode,$category,$fairid,$item_code,$parti_id)
	{
		$this->db->select('p.*,im.item_name');
		$this->db->join('item_master AS im','im.item_code = p.item_code');
		$this->db->where('p.school_code',$schoolcode);
		$this->db->where('p.item_code',$item_code);
		$this->db->where('p.team_no',$parti_id);
		$this->db->from('participant_item_details p');
		$result1	=	$this->db->get(); 
		return $result1->result_array();
	}
	
	function save_socialscience_details($schoolcode,$category,$fairid,$item_details){
	
	$data_par=array();
	$sub_district_code=$this->session->userdata('SUB_DISTRICT');
	$item_count				=	count($item_details);
	//echo "cnt-->".$item_count;
	
	for($i=0;$i<$item_count;$i++)
	{
	//echo "cnt-->".$i;
		$item_code[$i]			=	$item_details[$i]['item_code'];
		$item_name[$i]=$item_details[$i]['item_name'];
		$max_participants[$i]	=	$item_details[$i]['max_participants'];
		$max					=	$max_participants[$i];
		if($max_participants[$i]>1)
		$item_type				=	'G';
		else
		$item_type				=	'S';
		$item_code1				=	'item_code'.$item_code[$i];
			
		if($item_code[$i]==187 || $item_code[$i]==188)
		{
			
		  while($max_participants[$i]!=0){
			  
			 $k					=	$max_participants[$i];
			 $adm_no			=	'adm_no'.$item_code[$i].$k;
			 $exhibit_name		=	'exhibit_name'.$item_code[$i].$k;
			 $name_participant	=	'name_participant'.$item_code[$i].$k;
			 $txtStandard		=	'txtStandard'.$item_code[$i].$k;
			 $txtgender			=	'txtgender'.$item_code[$i].$k;
			 $remarks			=	'remarks'.$item_code[$i].$k;
			
		
			$data['fairId']						=	$fairid;
			$data['fest_id']					=	$category;
			$data['school_code']				=	$schoolcode;
			$data['admn_no']					=	$this->input->post($adm_no);
			$data['sub_district_code']			=	$sub_district_code;
			$data['exhibit_name']				=	$this->input->post($exhibit_name);
			$data['participant_name']			=	$this->input->post($name_participant);
			$data['class']						=	(int)$this->input->post($txtStandard);
			$data['gender']						=	$this->input->post($txtgender);
			$data['item_type']					=	$item_type;
			$item_code1							=	'item_code'.$item_code[$i];
			$data['item_code']					=	$this->input->post($item_code1);
				
			$this->db->select('is_quiz');	
			$this->db->where('item_code',$data['item_code']);	
			$this->db->from('item_master');
			$q_result	=	$this->db->get(); 
			$q_details	=	$q_result->result_array();
			$item1_is_quiz	=	$q_details[0]['is_quiz'];
				
				
			 if($this->input->post('coun') > 0)
			 { 
				//updating for individual editing
				 if($this->input->post($adm_no)){
				 
				 if($item_code[$i]==187){  $data['team_no']=$_POST['team_'.$item_code[$i].'_'.$k];}
				 else if($item_code[$i]==188){$data['team_no']=$_POST['team_'.$item_code[$i].'_'.$k];}
				 else $data['team_no'] =0;
				
					$this->db->where('school_code',$schoolcode);
					$this->db->where('admn_no',$this->input->post($adm_no));
					$this->db->where('team_no',$data['team_no']);
					$this->db->where('item_code',$this->input->post($item_code1));
					 $this->db->update('participant_item_details',$data) ;
				 }
			 }
			 else
			 {			
				//checking whether exist any entry for the admission number given
				
				$this->db->select('p.participant_id,p.item_code,p.team_no,p.fest_id,im.is_quiz');
				$this->db->join('item_master as im','im.item_code = p.item_code');
				$this->db->where('p.school_code',$schoolcode);
				$this->db->where('p.admn_no',$this->input->post($adm_no));
				///$this->db->where('p.item_code',$this->input->post($item_code1));
				$this->db->from('participant_item_details p');
				 
				$ssresult1	=	$this->db->get(); 
				$sspart_details1=$ssresult1->result_array();
				$sscnt1=count($sspart_details1);
				//echo 'cnt==='.$sscnt1;
				if($sscnt1==0) //if not exist, do the insertion
				{	
					 if($item_code[$i]==187){ if($k==1)$data['team_no']=2;else if($k==2)$data['team_no']=1; }
					 else if($item_code[$i]==188){if($k==1 || $k==2)$data['team_no']=2;else if($k==3 || $k==4)$data['team_no']=1;}
					 else $data['team_no'] =0;
					 
					 if($data['admn_no']<>'')
					$this->db->insert('participant_item_details',$data) ;
				}
				else
				{ 			
					
					if($_POST['team_'.$item_code[$i].'_'.$k] > 0 )
					{
				
					 $data['team_no']=$_POST['team_'.$item_code[$i].'_'.$k];
				
					}
					else
					{
					 if($item_code[$i]==187){ if($k==1)$data['team_no']=2;else if($k==2)$data['team_no']=1; }
						 else if($item_code[$i]==188){if($k==1 || $k==2)$data['team_no']=2;else if($k==3 || $k==4)$data['team_no']=1;}
						 else $data['team_no'] =0;
						 
				
				    }				  
				 					
					$this->db->select('p.participant_id,p.team_no');
					$this->db->where('p.school_code',$schoolcode);
					$this->db->where('p.admn_no',$this->input->post($adm_no));
					$this->db->where('p.item_code',$this->input->post($item_code1));
					$this->db->where('p.team_no',$data['team_no']);
					$this->db->from('participant_item_details p');					
					$ssresult2	=	$this->db->get(); 
					$sspart_details2=$ssresult2->result_array();			
					$sscnt2=count($sspart_details2);
				
					if($sscnt2 > 0)
					{
						echo "<br />1--".$this->input->post($name_participant);
						$this->db->where('school_code',$schoolcode);
						$this->db->where('admn_no',$this->input->post($adm_no));
						$this->db->where('team_no',$data['team_no']);
						$this->db->where('item_code',$this->input->post($item_code1));
						$this->db->update('participant_item_details',$data) ;
					} // if($sscnt2 > 0)
					else if($sscnt2 == 0)
					{							
						echo "<br />2--".$this->input->post($name_participant);
						$data_par['flg'] =3;
						$data_par['name']=$item_name[$i];
						$this->db->select('p.participant_id,p.team_no');
						$this->db->where('p.school_code',$schoolcode);
						$this->db->where('p.item_code',$this->input->post($item_code1));
						$this->db->where('p.team_no',$data['team_no']);
						$this->db->from('participant_item_details p');
						
						$ssresult3	=	$this->db->get(); 
						
						$sspart_details3=$ssresult3->result_array();
						$sscnt3 = count($sspart_details3);
						if($sscnt3 > 0)
						{
						  $this->db->where('participant_id',$sspart_details3[0]['participant_id']);
						  $this->db->delete('participant_item_details') ;
						}
						
						if($this->input->post($item_code1)==188)
						{
						foreach ($sspart_details1 as $row)
						{			
							$it_code			=	 $row['item_code'];
							$it_code1			=	 $this->input->post($item_code1);
							$fest_id			=	 $row['fest_id'];
							$is_quiz			=	 $row['is_quiz'];
							$team_num			=	 $row['team_no'];
							$team_num1			=	 $data['team_no'];
							//echo "<br />it_code-->".$it_code."1-->".$item1_is_quiz."2-->".$is_quiz.'3---->'.$it_code1.'4---->'.$team_num.'5--->'.$team_num1;
							
							
							
							
							$quiz_array[$i]		=	 $is_quiz;
							$quiz_flag			=	0;
							if($category == $fest_id){
							if($item1_is_quiz == 'N' && $is_quiz == 'N' && ($it_code == $it_code1) )
							   break;
							else 
							{
							//echo '<br>---1-->'.$item1_is_quiz,'---2--->'.$team_num.'---3---->'.$team_num1;
							if($item1_is_quiz == 'Y' && ($team_num == $team_num1) )
							  $quiz_flag		=	1;
							  }		
							}			
						} // for each
						//echo "<br />it_code-->".$it_code."---->".$quiz_flag;
						if($quiz_flag	==	0)
						{
							$data_par['flg']=3;
							$data_par['name']=$item_name[$i];							
						}
						else
						{
							//echo "flishkuuu";
							$this->db->insert('participant_item_details',$data) ;
							$data_par['flg']=2;								
						} // else if($quiz_flag	==	0)		
						}				
						
					} //else if($sscnt2 == 0)		
				 
				}// inner else
				
				
			} // else
			$max_participants[$i] = $max_participants[$i] -1;
				
			}//while
			
		}	//if($item_code[$i]==187 || $item_code[$i]==188)
		else
		{
			$this->db->select('p.participant_id');
			//$this->db->where('p.admn_no',$this->input->post($adm_no));
			$this->db->where('p.fairId',$fairid);
			$this->db->where('p.school_code',$schoolcode);
			$this->db->where('p.fest_id',$category);
			$this->db->where('p.item_code',$this->input->post($item_code1));
			$this->db->from('participant_item_details p');
			$result1	=	$this->db->get(); 
			$part_details1=$result1->result_array();
			$cnt=count($part_details1);
			 $s=0;
			 
			 while($max_participants[$i]!=0){
			  
			 $k=$max_participants[$i];
			// $adm_no			=	'adm_no_hid'.$item_code[$i].$k;
			 
			 
			/* if($this->input->post($adm_no) == '')
			 {
			 	
			 }*/
			 
			 $part_id			=	'participant_id'.$item_code[$i].$k;
			 $adm_no			=	'adm_no'.$item_code[$i].$k;
			 $exhibit_name		=	'exhibit_name'.$item_code[$i];
			 $name_participant	=	'name_participant'.$item_code[$i].$k;
			 $txtStandard		=	'txtStandard'.$item_code[$i].$k;
			 $txtgender			=	'txtgender'.$item_code[$i].$k;
			 $remarks			=	'remarks'.$item_code[$i].$k;
			 
			 $admn_no					=	$this->input->post($adm_no);
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
			
			//echo "<br /><br />admnooo--->".$adm_no;
			$data['fairId']						=	$fairid;
			$data['fest_id']					=	$category;
			$data['school_code']				=	$schoolcode;
			$data['admn_no']					=	$admn_no;
			$data['sub_district_code']			=	$sub_district_code;
			$data['exhibit_name']				=	$this->input->post($exhibit_name);
			$data['participant_name']			=	$this->input->post($name_participant);
			$data['class']						=	(int)$this->input->post($txtStandard);
			$data['gender']						=	$this->input->post($txtgender);
			//$data['remarks']					=	$this->input->post($remarks);
			$data['item_type']					=	$item_type;
			$item_code1							=	'item_code'.$item_code[$i];
			$data['item_code']					=	$this->input->post($item_code1);
		    $participant_id						=	$this->input->post($part_id);
			$this->db->select('is_quiz');	
			$this->db->where('item_code',$data['item_code']);	
			$this->db->from('item_master');
			$q_result	=	$this->db->get(); 
			$q_details	=	$q_result->result_array();
			$item1_is_quiz	=	$q_details[0]['is_quiz'];
			 
			if($cnt>=$max){
		
		   	$participant_id=@$part_details1[$s]['participant_id'];	    
			$this->db->select('p.*');
		//	$this->db->where('p.fairId',$fairid);
			$this->db->where('p.school_code',$schoolcode);
			$this->db->where('p.admn_no',$admn_no);
			//$this->db->where('p.participant_id',$participant_id);
		//	$this->db->where('p.fest_id',$category);
			//$this->db->where('p.item_code',$this->input->post($item_code1));
			$this->db->where('p.participant_id',$participant_id);
			$this->db->from('participant_item_details p');
			$result3	=	$this->db->get(); 
			$part_details3=$result3->result_array();
			if(count($part_details3)>0){
			$participant_id=@$part_details1[$s]['participant_id'];
			$this->db->where('participant_id',$participant_id);
			$this->db->update('participant_item_details',$data) ;
			if($data_par['flg']!=3)
			 $data_par['flg']=2;
			}
		}
		else
		{
			if($admn_no)
			{						     
				$participant_id=@$part_details1[$s]['participant_id'];				
				$this->db->select('p.item_code,p.fest_id,im.is_quiz');
				$this->db->join('item_master as im','im.item_code = p.item_code');
				$this->db->where('p.school_code',$schoolcode);
				$this->db->where('p.admn_no',$admn_no);
				$this->db->from('participant_item_details p');
				
				$dup_result		=	$this->db->get(); 
				$dup_details	=	$dup_result->result_array();
				if(count($dup_details)>0)
				{				
					foreach ($dup_details as $row)
					{			
						$it_code			=	 $row['item_code'];
						$fest_id			=	 $row['fest_id'];
						$is_quiz			=	 $row['is_quiz'];
						//echo "1-->".$item1_is_quiz."2-->".$is_quiz;
						$quiz_array[$i]		=	 $is_quiz;
						$quiz_flag			=	0;
						if($category == $fest_id){
						if($item1_is_quiz == 'N' && $is_quiz == 'N')
						   break;
						else 
						  $quiz_flag		=	1;		
						}			
					}
					
					if($quiz_flag	==	0)
					{
						$data_par['flg']=3;
						$data_par['name']=$item_name[$i];							
					}
					else
					{
						$this->db->insert('participant_item_details',$data) ;
						$data_par['flg']=2;
					}
				}
			    else
				{
					if($admn_no){
					 $this->db->insert('participant_item_details',$data) ;
					 $data_par['flg']=2;
					 }
				}
		   } //if($admn_no)
		}// else
	 $max_participants[$i]=$max_participants[$i]-1;
	 $spn=1;
	 $s++;
	 	}
		}//not 187/188
	}
		
	$item_count1=count($item_details);
	for($i=0;$i<$item_count1;$i++)
	{
	$item_code[$i]=$item_details[$i]['item_code'];
	
	if($item_code[$i]==187 || $item_code[$i]==188)
	{
	
	}
	else
	{
		$max_participants[$i]=$item_details[$i]['max_participants'];
		$item_name[$i]=$item_details[$i]['item_name'];
		$max_item_par=$max_participants[$i];
	
		if($max_item_par>1){
			$this->db->select('p.participant_id');
			$this->db->where('p.school_code',$schoolcode);
			$this->db->where('p.item_code',$item_code[$i]);
			$this->db->from('participant_item_details p');
			$result10	=	$this->db->get(); 
			$part_details10=$result10->result_array();
			$cnt1=count($part_details10);
			
			if($cnt1!=$max_item_par && $cnt1!=0){
			$this->db->where('item_code',$item_code[$i]);
			$this->db->delete('participant_item_details') ;
			$data_par['flg']=3;
			$data_par['name']=$item_name[$i];
			}
		
		}
	}
	}// end for
	return $data_par;
	 
	
	}//function
		//return $flg;
	  
	  
}



?>