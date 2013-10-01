<?php
class Resultindex_Model extends CI_Model{

	function Resultindex_Model()
	{
		parent::__construct();
	}
	
function rankwise_report($festid,$item,$rank,$date,$fairid,$exb=0)
	{	
		
		
		if($exb == 0)
		{//R.point
			$this->db->select('R.item_code, R.participant_id, R.school_code, R.rank, spd.total_point as point, R.grade, p.participant_name, p.spo_id, I.item_name, s.school_name, f.fest_id, f.fest_name, R.percentage, p.spo_id, sp.is_publish,date(sim.start_time),sm.fairName');
			$this->db->join('participant_item_details AS p','p.participant_id = R.participant_id AND p.item_code = R.item_code');
			$this->db->join('item_master AS I','I.item_code = R.item_code');
			$this->db->join('festival_master AS f','f.fest_id = I.fest_id');
			$this->db->join('science_master AS sm','sm.fairId = I.fairId');
		}
		else
		{
			$this->db->select('R.item_code, R.participant_id, R.school_code, R.rank, spd.total_point as point, R.grade, p.participant_name, p.spo_id, p.item_code as item_name, s.school_name, p.fest_id, p.exhibition as fest_name, R.percentage, p.spo_id, sp.is_publish,date(sim.start_time),sm.fairName');
			$this->db->join('participant_item_details AS p','p.participant_id = R.participant_id AND p.school_code = R.school_code AND R.school_code = R.item_code');
			$this->db->join('science_master AS sm','sm.fairId = p.fairId');
			
			$limit	=	$this->exhibition_category($fairid,$festid);
			
			$this->db->join('school_details AS SD',"SD.school_code = p.school_code AND ".$limit."");			
			$this->db->where('p.fest_id','0'); 
			
	     	
			
		}
		
		$this->db->from('result_master AS R');
		
		
		$this->db->join('school_master AS s','s.school_code = R.school_code');
		
		$this->db->join('school_point_details AS spd','spd.item_code = R.item_code AND spd.school_code = R.school_code AND spd.participant_id = R.participant_id');
		$this->db->join('ground_item_master AS sim','R.item_code = sim.item_code');
		$this->db->join('special_order_master AS sp',"sp.spo_id = p.spo_id AND sp.is_publish = 'N'",'LEFT');
		
		if($rank=='ALL'){
		$this->db->where("R.rank IN(1,2,3)");
		}
		else{
		$this->db->where('R.rank',$rank);
		}
		if(($festid!='ALL' || $festid==0) && ($exb==0)){
		$this->db->where('f.fest_id',$festid);
		
		}
		if($item!='ALL' && ($exb==0)){
		
		$this->db->where('R.item_code',$item);
		}
		if($date!='All'){
		$this->db->where('date(sim.start_time)',$date);
		}
		$this->db->where("R.is_finish = 'Y'");
		$this->db->where('sm.fairId',$fairid);
		$this->db->group_by('R.participant_id');
		$this->db->group_by('R.item_code');
		
		if($exb==0)$this->db->order_by('f.fest_id');
		
		$this->db->order_by('R.item_code');
		$this->db->order_by('R.total_mark desc');
		$retvalue=$this->db->get();
		return $retvalue->result_array();
	}
    	
	function gradewiseparticip_report($fair,$festid,$item,$grade,$exb=0)
	{
	
		if($exb == 0)
		{//R.point
			$this->db->select('R.item_code,R.is_taken, R.participant_id, R.school_code, R.rank, SPD.total_point as point, R.grade, p.participant_name, p.spo_id, I.item_name, s.school_name, f.fest_id, f.fest_name, R.percentage, sp.is_publish');
			$this->db->join('participant_item_details AS p','p.participant_id = R.participant_id AND p.item_code = R.item_code');
			$this->db->join('item_master AS I','I.item_code = R.item_code');
			$this->db->join('festival_master AS f','f.fest_id = I.fest_id');
			
		}
		else
		{
			$this->db->select('R.item_code,R.is_taken, R.participant_id, R.school_code, R.rank, SPD.total_point as point, R.grade, p.participant_name, p.spo_id, p.item_code as item_name, s.school_name, p.fest_id, p.exhibition as fest_name, R.percentage, sp.is_publish');
			$this->db->join('participant_item_details AS p','p.participant_id = R.participant_id AND p.school_code = R.school_code AND R.school_code = R.item_code');
			
			
			$limit	=	$this->exhibition_category($fair,$festid);
			
			$this->db->join('school_details AS SD',"SD.school_code = p.school_code AND ".$limit."");			
			$this->db->where('p.fest_id','0'); 
			
	     	
			
		}
		
		
		$this->db->from('result_master AS R');
		
		
		$this->db->join('school_master AS s','s.school_code = R.school_code');
		
		$this->db->join('school_point_details AS SPD','SPD.item_code = R.item_code AND SPD.participant_id = R.participant_id AND SPD.school_code = R.school_code');
		$this->db->join('special_order_master AS sp',"sp.spo_id = p.spo_id AND sp.is_publish = 'N'",'LEFT');
		$this->db->where('p.fairId',$fair);
		if($grade=='ALL'){
		$this->db->where("R.grade IN('A','B','C')");
		}
		else{
		$this->db->where('R.grade',$grade);
		}
		if(($festid!='ALL' || $festid==0) && $exb==0){
		$this->db->where('f.fest_id',$festid);
		}
		if($item!='ALL' && $exb==0){
		$this->db->where('R.item_code',$item);
		}
		
		$this->db->where("R.is_finish = 'Y'");
		$this->db->group_by('R.participant_id');
		$this->db->group_by('R.item_code');
		if($exb==0)$this->db->order_by('f.fest_id');
		$this->db->order_by('R.item_code');
		$this->db->order_by("R.total_mark desc");
		$retvalue=$this->db->get();
		return $retvalue->result_array();
		
	}
	
	function timewise_result_report()
	{
		$parti_count		=	0;
		$fair 				     	  =		$this->input->post('cmbFairType');
		$from_date 				      =		$this->input->post('txtfromDate');
		$to_date 				      =		$this->input->post('txttoDate');
		$from_time 				      =		$this->input->post('txtfromTime');
		$to_time 				      =		$this->input->post('txttoTime');
		$from_ampm 				      =		$this->input->post('txtfromampm');
		$to_ampm 				      =		$this->input->post('txttoampm');
		$details['from_date']		  =		$from_date ;
		$details['to_date']			  =		$to_date ;
		$details['from_time']		  =		$from_time ;
		$details['to_time']			  =		$to_time ;
		$details['from_ampm']		  =		$from_ampm ;
		$details['to_ampm']			  =		$to_ampm ;
		
	    $from_time 	= ($from_time != 12 && $from_ampm == 'PM' ) ? $from_time+12 :$from_time;
		$to_time 	= ($to_time != 12 && $to_ampm == 'PM' ) ? $to_time+12 :$to_time;
		
		$from_time 	= ($from_time < 10) ? '0'.$from_time :$from_time;
		$to_time 	= ($to_time < 10) ? '0'.$to_time :$to_time;
		
		$from_time 	= ($from_time == 12 && $from_ampm == 'AM') ? 00 :$from_time;
		$to_time 	= ($to_time == 12 && $to_ampm == 'AM') ? 00 :$to_time;
		
		if($from_time == $to_time)
		{		
			
		}
		
		
		$query="SELECT RT.item_code,RT.confirm_date,RT.confirm_time,RT.result_no,IM.item_name,FM.fest_name,FM.fest_id from result_time AS RT  JOIN result_master AS RM ON  RT.`item_code`=RM.`item_code` JOIN item_master AS IM ON RT.item_code=IM.item_code JOIN festival_master AS FM ON IM.fest_id=FM.fest_id   where   RT.confirm_date >= '". $from_date."' and  RT.confirm_date <= '". $to_date."' and RT.confirm_time >= '". $from_time.":00:00' and IM.fairId='$fair' and RT.is_finalized='Y' group by RT.item_code order by RT.result_no,RT.item_code asc";
		$details1				=	$this->db->query($query);	
		$details['values']		= 	$details1->result_array();	
		
		if(is_object($details1)) 
		{
    		if($details1->num_rows() > 0) 
			{
				$ArrReturn['item'] = $details1->result_array();
				foreach($ArrReturn['item'] as $row)
				{
					$item_code		=	$row['item_code'];
					$parti_query	=	"SELECT SPD.participant_id,RM.percentage,RM.grade,RM.point,RM.rank,PD.participant_name,SPD.school_code,SM.school_name,SPD.is_withheld from  result_master AS RM
					JOIN school_point_details AS SPD ON RM.participant_id=SPD.participant_id and RM.item_code=SPD.item_code
					JOIN participant_item_details AS PD ON PD.participant_id=SPD.participant_id and PD.school_code=SPD.school_code 
					JOIN item_master AS IM ON IM.item_code=SPD.item_code						
					JOIN school_master AS SM ON SM.school_code=RM.school_code
					JOIN festival_master AS FM ON IM.fest_id=FM.fest_id 
					where RM.item_code='".$item_code."' and SPD.is_withheld='N' AND RM.is_finish='Y' AND RM.grade!='' order by FM.fest_id asc,SPD.item_code asc,RM.rank asc,RM.point desc";
					$parti_det				=	$this->db->query($parti_query);	
					$details['parti_det'][$item_code]	= 	$parti_det->result_array();	
					
					$parti_count	+= count($parti_det->result_array());	
					
					$confirm_date	=	$row['confirm_date'];
					$confirm_time	=	$row['confirm_time'];
					$query1="SELECT RT.item_code,RT.confirm_date,RT.confirm_time,RT.result_no from  result_time AS RT	where  RT.confirm_date ='". $to_date."' and RT.confirm_time >'". $to_time.":00:00' and  RT.is_finalized='Y'";
					$disc_code				=	$this->db->query($query1);	
					$details['disc_code']	= 	$disc_code->result_array();		
					
				}
				
			}
		}
		
		$details['parti_count']		=		$parti_count;	
		return  $details;
	
	}
	
	function numwise_timeresult_report(){
			$fair 			=	$this->input->post('cmbFairType');
			$result_nums    =	$this->input->post('txtResultno');
			$result_nums	=	explode(',',$result_nums);
			$len			=	count($result_nums);
			for($i=0;$i<$len;$i++){
				$result_no	=	$result_nums[$i];		
				$query="SELECT SPD.item_code,RT.result_no,IM.item_name,SPD.participant_id,RM.percentage,RM.grade,SPD.point,RM.rank,PD.participant_name,SPD.school_code,SM.school_name,SPD.is_withheld,FM.fest_name,FM.fest_id from  result_master AS RM
				JOIN school_point_details AS SPD ON RM.participant_id=SPD.participant_id and RM.item_code=SPD.item_code
				JOIN participant_item_details AS PD ON PD.participant_id=SPD.participant_id and PD.school_code=SPD.school_code 
				JOIN item_master AS IM ON IM.item_code=SPD.item_code
				
				JOIN school_master AS SM ON SM.school_code=RM.school_code
				JOIN festival_master AS FM ON IM.fest_id=FM.fest_id
				JOIN result_time AS RT ON RM.`item_code` = RT.`item_code`
				where IM.fairId ='$fair' and SPD.is_withheld='N' AND RM.is_finish='Y' AND RM.grade!='' and RT.result_no ='$result_no' group by SPD.participant_id,SPD.item_code  order by FM.fest_id asc,IM.item_code,RM.total_mark desc ";
				$details			=	$this->db->query($query);
				$det_report[$i]		=	$details->result_array();		
			}
			
			return  $det_report;
	}//numwise_timeresult_report()
	
	
	
	function exhibition_category($cmbFairType,$cmbCateType)
	{
		if($cmbFairType == 4){
			if($cmbCateType	==	1)
			{	$limit	=	'SD.class_end = 4'; }
			if($cmbCateType	==	2)
			{	$limit	=	'(SD.class_end = 7  OR SD.class_end = 5)'; }
			if($cmbCateType	==	3)
			{	$limit	=	'(SD.class_end = 8 OR SD.class_end = 10)'; }
			if($cmbCateType	==	4)
			{	$limit	=	'SD.class_end = 12'; }
		}			
		return $limit;		
	}
	
	
    
   }
   
   ?>