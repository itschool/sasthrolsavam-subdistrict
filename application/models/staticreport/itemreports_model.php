<?php
class Itemreports_Model extends CI_Model{
	function Itemreports_Model()
	{
		parent::__construct();
	}
    
	function Festname($festval)
	{
	    $this->db->from('festival_master AS FM');
		$this->db->where('FM.fest_id',$festval);
		$festname		=	$this->db->get();
		return $festname->result_array();
	}
	function item_details()
	{
		$this->db->from('school_details AS SM');
		$this->db->join('school_master AS SD','SM.school_code = SD.school_code','LEFT');
		$school_details		=	$this->db->get();
		return $school_details->result_array();
	}
	
	function timesheet($itemcode)
	{
		$this->db->from('item_master AS IT');
		$this->db->where('IT.item_code ',$itemcode);
		$this->db->join('stage_item_master AS ST','ST.item_code = IT.item_code','LEFT');
		$this->db->join('stage_master AS SM','SM.stage_id = ST.stage_id','LEFT');
		$item_details		=	$this->db->get();
		return $item_details->result_array();
	}
	
	function datewise_participants($date)
	{
	   
		$this->db->from('school_master AS SD');
		
		$this->db->join('participant_item_details  AS PD ','PD.school_code = SD.school_code');
		
		$this->db->join('stage_item_master  AS SIM ','SIM.item_code = PD.item_code');
		
		$this->db->where("DATE_FORMAT(SIM.start_time,'%Y-%m-%d')",$date);
		
		$this->db->select('COUNT(PD.pi_id) as total, PD.item_code, PD.admn_no, SD.school_code, SD.school_name');
		
		$this->db->groupby('SD.school_code');
		
		$participants_details		=	$this->db->get();
		return $participants_details->result_array();
	}
	
	//stage report
	function datewise_stagereport($date)
	{
		$this->db->from('stage_item_master  AS SIM');
		$this->db->join('item_master  AS IM ','SIM.item_code = IM.item_code');
		$this->db->join('festival_master AS FM ','FM.fest_id = IM.fest_id');
		$this->db->where("DATE_FORMAT(SIM.start_time,'%Y-%m-%d')",$date);
		$participants_details		=	$this->db->get();
		return $participants_details->result_array();
	}
	
	//find stage name
	function Stagename($stageid)
	{
	    $this->db->from('stage_master AS SM');
		$this->db->where('SM.stage_id',$stageid);
		
		$stagedetails		=	$this->db->get();
		return $stagedetails->result_array();
	}
	
	function itemwise_participants($fair,$cateid,$itemcode,$oderby=0){
		//echo "--";
			$this->db->from('participant_item_details AS PD');
			$this->db->where('PD.item_code',$itemcode);	
			$this->db->where('PD.fairId',$fair);
			$this->db->where('PD.fest_id',$cateid);
			$this->db->where('PD.is_captain','Y');
			$this->db->join('school_master  AS SM ','SM.school_code = PD.school_code');
			$this->db->join('festival_master  AS FM ','FM.fest_id = PD.fest_id');
			$this->db->join('item_master  AS IM ','IM.item_code = PD.item_code');
			if($oderby == 1)
			{ 	
				$this->db->order_by('PD.code_confirmed','desc');
				$this->db->order_by('PD.school_code');	
				$this->db->order_by('PD.team_no');		
				$this->db->order_by('PD.is_captain','desc');		
				$this->db->order_by('PD.participant_id');
				
			}
			$this->db->select('PD.*,FM.fest_name,IM.item_name,SM.school_name');
			$participants_details		=	$this->db->get();
			return $participants_details->result_array();
	}
	
	function itemwise_participants_exhib($fair,$cateid,$limit,$oderby=0){
			$this->db->from('participant_item_details AS PD');
			$this->db->where('PD.fairId',$fair);
			$this->db->where('PD.fest_id','0');
			$this->db->where('PD.is_captain','Y');
			$this->db->join('school_master  AS SM ','SM.school_code = PD.school_code');
			$this->db->join('school_details AS S',"SM.school_code = S.school_code AND ".$limit."");					
			
			if($oderby == 1)
			{ 	
				$this->db->order_by('PD.school_code');	
				$this->db->order_by('PD.team_no');		
				$this->db->order_by('PD.is_captain','desc');		
				$this->db->order_by('PD.participant_id');
			}
			$this->db->select('PD.*,SM.school_name');
			$participants_details		=	$this->db->get();
			return $participants_details->result_array();
	}
	
	function Eventname($itemcode){
			$this->db->from('item_master AS IT');
			$this->db->where('IT.item_code',$itemcode);
			$item_details		=	$this->db->get();
			return $item_details->result_array();
	}
	function item_master($fairId,$fest_id)
	{
		$this->db->from('item_master AS IM');
		$this->db->where('IM.fairId',$fairId);
		$this->db->where('IM.fest_id',$fest_id);
		$school_details		=	$this->db->get();
		return $school_details->result_array();
	}
	
		/////////////////ALL ITEM CODE GENERATION ////////////////
	function fair_allitemwise($festid,$fair)
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
	
	////////all item wise participant list/////////
	function all_itemwise_participants($fair,$festival)
	{
		$partList = NULL;
		$itemList =  $this->fair_allitemwise($festival,$fair);
		foreach($itemList as $item)
		{
			$itemCode = $item['item_code'];
			$partList[$itemCode] = $this->itemwise_participants($fair,$festival,$itemCode,1);
		}
		return $partList;
		
	}//fn
	
	function codeGen($fair,$festival,$itemcode,$allitem=0)
	{
		if($allitem == 1)
		{
			$itemList =  $this->fair_allitemwise($festival,$fair);
			if(count($itemList) > 0)
			{	foreach($itemList as $item)
				{
					$itemCode = $item['item_code'];
					$retVal 	= $this->codeGeneration($fair,$festival,$itemCode,$allitem);
				}//foreach item
			}
			return "yes";
			
		}
		elseif($allitem == 0 )
		{
			$partList 		= $this->itemwise_participants($fair,$festival,$itemcode,1);
			$retVal 	= $this->codeGeneration($fair,$festival,$itemcode);
			return  $retVal;
		}//if not all Item
	}//fn
	
	
	function codeGeneration($fair,$festival,$itemcode,$allitem=0)
	{
		$charArr	=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
		$partList 		= $this->itemwise_participants($fair,$festival,$itemcode,1);
		if(count($partList)>0)
		{	
			$itemcodeArry 	= $this->item_master($fair,$festival);
			$slno = 0;
			foreach($itemcodeArry as $row)
			{
				$slno++;
				if($row['item_code'] == $itemcode)
				{	break;	}
			
			}//item code or each
			if($slno < 10)
			{
				$slno = "0".$slno;
			}
			//////////////Prefix Letter//////////////////////
			if($festival == 0)
			{ $prefx = "E";	}
			else if($festival == 1)
			{ $prefx = "L";	}
			elseif($festival == 2)
			{ $prefx = "U";	}
			elseif($festival == 3)
			{ $prefx = "H";}
			elseif($festival == 4)
			{ $prefx = "V";}
			/////////////////////////////Retrieving Participant list/////////////////////
			$codeNo = 0;
			$flag 	= 0;
			$i=0;$j=0;
			$arr 	= array();
			
			if($festival == 0)
			{//echo "<br><br><br>PRT-->";
			}
			else 
			{
				if($allitem == 1)
				{
				//check if code generated already for item 
					$codeflag			=	0;
					$this->db->select('*');
					$this->db->from('participant_item_details');
					$this->db->where('fairId',$fair);
					$this->db->where('fest_id',$festival);
					$this->db->where('item_code',$itemcode);
					$cnf_details	=	$this->db->get();
					$arrReturnCheck	=	$cnf_details->result_array();
					if(count($arrReturnCheck) > 0)
					{  foreach($arrReturnCheck as $rowCheck)
						{	if($rowCheck['codeGeneratedFlag'] == 1)
							{	$codeflag = 1;
								break;
							}
						}//foreach
					}//if count
				
				}
				elseif($allitem == 0)
				{$codeflag			=	0;}
				//echo "<br><br>-----------".$codeflag;
				if($codeflag == 0 )//if not yet generated
				{ 
					foreach($partList as $data)
					{
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
						$arr['codeNo']	=	$code;
						if($allitem == 0)
						{	$arr['code_confirmed']	=	0;}
						elseif($allitem ==  1)
						{ $arr['code_confirmed']	=	1;}
						
						$arr['codeGeneratedFlag']	=	1;
						//var_dump($arr);
						/////////////////Updating Code for each participant////////
						if($data['code_confirmed']  != 1)
						{
						$this->db->where('item_code',$itemcode);	
						$this->db->where('fairId',$fair);
						$this->db->where('fest_id',$festival);
						$this->db->where('participant_id',$data['participant_id']);
						$this->db->update('participant_item_details',$arr);
						}
					}//foreach
				}//if flag == 0
			}//else if on spot
			return "yes";
		}//if
		else
		{
			return "no";
		}
		
	}//fn
	
	//confirmation
	function confirm_Wexpo($exhib = 0)
	{
		$totNo = $this->input->post('number');
		$fair 		= $this->input->post('cmbFairType');
		$festival 	= $this->input->post('cmbfestId');
		$itemcode 	= $this->input->post('cbo_item');
		for($i=1;$i <=$totNo;$i++)
		{
			$participant =  $this->input->post('txtPart_'.$i);
			$codenoVal	 =	$this->input->post('txt_code'.$participant);
			$prefix 	 =	$this->input->post('txt_pre'.$participant);
			if($this->input->post('chk_absent'.$i))
			{$arr['is_absent']	=	1;
				$arr['codeNo']		= 	"";
			}
			else
			{ 	$arr['is_absent']	=	0;
				$arr['codeNo']		= 	$codenoVal;
			}
			$arr['prefixCode']	=	$prefix;
			$arr['code_confirmed']	=	1;
			$arr['codeGeneratedFlag']	=	1;
			//echo "<br>parti------>".$participant."---------code==".$arr['codeNo'];
			if($exhib == 0)
			{
			$this->db->where('item_code',$itemcode);	
			$this->db->where('fairId',$fair);
			$this->db->where('fest_id',$festival);
			$this->db->where('participant_id',$participant);
			$this->db->update('participant_item_details',$arr);
			}
			else
			{
			$school_code = $participant;
			$this->db->where('school_code',$school_code);	
			$this->db->where('fairId',$fair);
			$this->db->where('fest_id',0);
			$this->db->update('participant_item_details',$arr);
			}
		}//for
		
	}//fn
	

	
}//class

?>