<?php
class Afterresult_model extends CI_Model{
	function Afterresult_model()
	{
		parent::__construct();
	}
	
	
	function school_wise_result($school,$fairid=0)
	{
	//SPD.point replaced as  RM.point
	if($fairid > 0)$filter = ' and RM.fairId='.$fairid;
	
	if($fairid==4)
	{//CASE WHEN RM.item_code=RM.school_code THEN PD.exhibition  ELSE FM.fest_name END as  fest_name //and RM.grade!=''
	  $query="SELECT SPD.item_code,IM.item_name,SPD.participant_id,RM.percentage,RM.total_mark,RM.grade,SPD.total_point as point,RM.rank,PD.participant_name,SPD.school_code,SM.school_name,SPD.is_withheld,FM.fest_name 
	 				from  result_master AS RM
	                JOIN   school_point_details AS SPD ON RM.participant_id=SPD.participant_id and  RM.item_code=SPD.item_code 
					JOIN participant_item_details AS PD ON PD.participant_id=RM.participant_id 
					JOIN item_master AS IM ON IM.item_code=SPD.item_code or (RM.item_code=RM.school_code)
					JOIN school_master AS SM ON SM.school_code=RM.school_code
					JOIN festival_master AS FM ON RM.fest_id=FM.fest_id
					where   SPD.school_code = $school and SPD.is_withheld='N' and RM.is_finish='Y'  ".$filter."
 					
					group by RM.participant_item_dtls_id  order by FM.fest_id,IM.item_code,SPD.total_point desc ";
	}
	else
	{
     $query="SELECT SPD.item_code,IM.item_name,SPD.participant_id,RM.percentage,RM.total_mark,RM.grade,SPD.total_point as point,RM.rank,PD.participant_name,SPD.school_code,SM.school_name,SPD.is_withheld,FM.fest_name 
	 				from  result_master AS RM
	                JOIN participant_item_details AS PD ON PD.participant_id=RM.participant_id 
					JOIN item_master AS IM ON IM.item_code=RM.item_code
					JOIN school_point_details AS SPD ON SPD.item_code = RM.item_code AND SPD.school_code = RM.school_code AND SPD.participant_id = RM.participant_id
					JOIN school_master AS SM ON SM.school_code=RM.school_code
					JOIN festival_master AS FM ON IM.fest_id=FM.fest_id
					where  SPD.school_code = $school and SPD.is_withheld='N' and RM.is_finish='Y'  ".$filter."
 					
					group by IM.item_code,RM.participant_item_dtls_id  order by FM.fest_id,IM.item_code,SPD.total_point desc ";
	}
                   $school_wise_result		=$this->db->query($query);
                   return   $school_wise_result->result_array();
	}
	
	
	
	function all_school_wise_result()
	{
	//SPD.point replaced as  RM.point
     $query="SELECT SPD.item_code,IM.item_name,SPD.participant_id,RM.percentage,RM.total_mark,RM.grade,RM.point,RM.rank,PD.participant_name,SPD.school_code,SM.school_name,SPD.is_withheld,FM.fest_name,FM.fest_id
	 				from  result_master AS RM
	                JOIN   school_point_details AS SPD ON RM.participant_id=SPD.participant_id and  RM.item_code=SPD.item_code 
					JOIN participant_item_details AS PD ON PD.participant_id=RM.participant_id 
					JOIN item_master AS IM ON IM.item_code=SPD.item_code
					
					JOIN school_master AS SM ON SM.school_code=RM.school_code
					JOIN festival_master AS FM ON IM.fest_id=FM.fest_id
					where  SPD.is_withheld='N' and RM.is_finish='Y' and  RM.grade!=''
					order by FM.fest_id,IM.item_code,RM.total_mark desc ";

                   $school_wise_result		=$this->db->query($query);
                   return   $school_wise_result->result_array();
	}
	
	function school_wise_result_exhibition_values($fair)
	{
	
			
				$query="SELECT RM.school_code,S.school_name, RM.rank,sum( RM.total_mark) AS cnt, RM.fest_id
				FROM result_master AS RM 
				JOIN school_master as S ON S.school_code = RM.school_code
				WHERE 
				RM.school_code=RM.item_code and 
				RM.fairId='$fair' and RM.is_finish='Y'
				 
				GROUP BY RM.school_code, RM.fest_id
				ORDER BY RM.fest_id, sum(RM.total_mark) DESC";
			
                   $school_wise_result		=$this->db->query($query);
                   return   $school_wise_result->result_array();
	}
	function school_wise_result_all($fair)
	{
			if($fair==1)
			{
				$items = " and SPD.item_code not in ('111','112','120','121','122','123','131','132') ";
				//$items = " and SPD.item_code not in ('110','111','112','119','120','121','122','123','130','131','132') ";
			}
			else if($fair==2)
			{
				$items = " and SPD.item_code not in ('138','139','146','147','163','164','181','182') ";
				//$items = " and SPD.item_code not in ('138','139','146','147','163','164','165','181','182','183') ";
			}
			else if($fair==3)
			{
				$items = " and SPD.item_code not in ('194','204','205','206','214') ";
				//$items = " and SPD.item_code not in ('188','193','194','203','204','205','206','213','214') ";
			}
			$filter = '';
			if($fair==1 || $fair==2 || $fair==3) { $filter = $items; }
	
				/* $query="SELECT SPD.school_code, SM.school_name, sum( SPD.point) AS cnt, FM.fest_id, FM.fest_name
			FROM school_point_details AS SPD
			JOIN school_master AS SM ON SM.school_code = SPD.school_code
			LEFT JOIN item_master AS IM ON IM.item_code = SPD.item_code
			LEFT JOIN festival_master AS FM ON IM.fest_id = FM.fest_id
			GROUP BY SPD.school_code, FM.fest_id
			ORDER BY FM.fest_id, sum(SPD.point ) DESC";*/
			
			//FROM school_point_details AS SPD replaced by FROM result_master AS SPD
			if($fair==4)
			{
				$query="SELECT SPD.school_code, SM.school_name, sum( SPD.total_point) AS cnt, FM.fest_id, FM.fest_name
				FROM school_point_details AS SPD
				JOIN school_master AS SM ON SM.school_code = SPD.school_code or SPD.school_code=SPD.item_code
				LEFT JOIN item_master AS IM ON IM.item_code = SPD.item_code
				LEFT JOIN festival_master AS FM ON IM.fest_id = FM.fest_id 
				WHERE IM.fairId='$fair'  
				GROUP BY SPD.school_code, FM.fest_id
				ORDER BY FM.fest_id, sum(SPD.total_point ) DESC";
			}
			else
			{
				$query="SELECT SPD.school_code, SM.school_name, sum( SPD.total_point) AS cnt, FM.fest_id, FM.fest_name
				FROM school_point_details AS SPD
				JOIN school_master AS SM ON SM.school_code = SPD.school_code
				LEFT JOIN item_master AS IM ON IM.item_code = SPD.item_code
				LEFT JOIN festival_master AS FM ON IM.fest_id = FM.fest_id
				WHERE IM.fairId='$fair'  ".$filter."
				GROUP BY SPD.school_code, FM.fest_id
				ORDER BY FM.fest_id, sum(SPD.total_point ) DESC";
			}
                   $school_wise_result		=$this->db->query($query);
                   return   $school_wise_result->result_array();
	}
	
	function school_wise_overall_result_all($fair)
	{
			
			if($fair==1)
			{
				//$items = " and SPD.item_code not in ('110','111','112','119','120','121','122','123','130','131','132') ";
				$items = " and SPD.item_code not in ('111','112','120','121','122','123','131','132') ";
			}
			else if($fair==2)
			{
				//$items = " and SPD.item_code not in ('138','139','146','147','163','164','165','181','182','183') ";
				$items = " and SPD.item_code not in ('138','139','146','147','163','164','181','182') ";
			}
			else if($fair==3)
			{
				//$items = " and SPD.item_code not in ('188','193','194','203','204','205','206','213','214') ";
				$items = " and SPD.item_code not in ('194','204','205','206','214') ";
			}
			$filter = '';
			if($fair==1 || $fair==2 || $fair==3) { $filter = $items; }
			
			if($fair==4)
			{
				$query="SELECT SPD.school_code, SM.school_name, sum( SPD.total_point) AS cnt, FM.fest_id, FM.fest_name
				FROM school_point_details AS SPD
				JOIN school_master AS SM ON SM.school_code = SPD.school_code or SPD.school_code=SPD.item_code
				LEFT JOIN item_master AS IM ON IM.item_code = SPD.item_code
				LEFT JOIN festival_master AS FM ON IM.fest_id = FM.fest_id 
				WHERE IM.fairId='$fair' 
				GROUP BY SPD.school_code, FM.fest_id
				ORDER BY FM.fest_id, sum(SPD.total_point ) DESC";
			}
			else
			{
				$query="SELECT SPD.school_code, SM.school_name, sum( SPD.total_point) AS cnt, FM.fest_id, FM.fest_name
				FROM school_point_details AS SPD
				JOIN school_master AS SM ON SM.school_code = SPD.school_code
				LEFT JOIN item_master AS IM ON IM.item_code = SPD.item_code
				LEFT JOIN festival_master AS FM ON IM.fest_id = FM.fest_id
				WHERE IM.fairId='$fair' ".$filter."
				GROUP BY SPD.school_code, FM.fest_id
				ORDER BY FM.fest_id, sum(SPD.total_point ) DESC";
			}
                   $school_wise_result		=$this->db->query($query);
                   return   $school_wise_result->result_array();
	}
	
	function itemcomplete_schoolpoint($fair)
		{
		$this->db->select('r.*, i.item_name, f.fest_id, f.fest_name');
		$this->db->from('result_publish AS r');
		if($fair==4)$this->db->join('item_master AS i','i.item_code = r.item_code ');
		else $this->db->join('item_master AS i','i.item_code = r.item_code ');
		$this->db->join('festival_master AS f','f.fest_id = i.fest_id');
		$this->db->where('i.fairId',$fair);
		$this->db->group_by('r.item_code');
		$this->db->order_by('i.fest_id');
		$details	=	$this->db->get();
		return  $details->result_array();
		}
		
	function school_wise_gradedetails($fair)
	{
		if($fair==4)
		{
		      $rt="SELECT  r.school_code, r.grade, r.rank, i.fest_id
				FROM result_master AS r
				JOIN item_master AS i ON i.item_code = r.item_code 
				where r.is_finish='Y' and r.is_taken='Y'  and i.fairId='$fair'
				ORDER BY i.fest_id, r.school_code";
		}
		else
		{				
				$rt="SELECT  r.school_code, r.grade,r.rank, i.fest_id
				FROM result_master AS r
				JOIN item_master AS i ON i.item_code = r.item_code
				where r.is_finish='Y' and r.is_taken='Y'  and i.fairId='$fair'
				ORDER BY i.fest_id, r.school_code";
		}
			 $school_wise_result		=$this->db->query($rt);
             return   $school_wise_result->result_array();
	}
	
	function count_of_items($fair)
	{
	      $query="select count(distinct r.item_code) as cn,f.fest_id from result_master as r
		  join item_master AS i on r.item_code=i.item_code 
		  join festival_master AS f on i.fest_id=f.fest_id 
		  where r.is_finish = 'Y' and i.fairId='$fair'
		  group by f.fest_id ";
		   $count_of_items		=$this->db->query($query);
                   return   $count_of_items->result_array();
	}
	
	function count_of_items_total($fairId=0)
	{
	      $query="select count(distinct s.item_code) as c,f.fest_id from ground_item_master as s
		  join item_master AS i on s.item_code=i.item_code 
		  join festival_master AS f on i.fest_id=f.fest_id 
		  where i.fairId	=".$fairId." 
		  group by f.fest_id ";
		  $count_of_items_total		=$this->db->query($query);
                   return   $count_of_items_total->result_array();
	}
	function total_points($fair)
	 {
	 	/*if($fair==4)
		{
			if($_POST['radioLabel']=='exhib')
			{
		 	$query="SELECT RM.fest_id as item_code,RM.item_code as item_name,RM.participant_id,RM.percentage,RM.grade,RM.total_mark as point,RM.rank,PD.participant_name,RM.school_code,SM.school_name,FM.fest_name,FM.fest_id from  result_master AS RM 
						  JOIN participant_item_details AS PD ON PD.participant_id=RM.participant_id and PD.school_code=RM.school_code and RM.item_code=RM.school_code
					     and RM.fairId=$fair						
						   JOIN school_master AS SM ON SM.school_code=RM.school_code
						   JOIN festival_master AS FM ON RM.fest_id=FM.fest_id
						where RM.is_finish='Y'   
						group by RM.participant_id,FM.fest_id order by FM.fest_id asc,RM.total_mark desc  ";
			}
			else
			{
						$query="SELECT RM.item_code,IM.item_name,RM.participant_id,RM.percentage,RM.grade,RM.total_mark as point,RM.rank,PD.participant_name,RM.school_code,SM.school_name,FM.fest_name,FM.fest_id from  result_master AS RM 
						  JOIN participant_item_details AS PD ON PD.participant_id=RM.participant_id and PD.school_code=RM.school_code and RM.item_code=PD.item_code
					      JOIN item_master AS IM ON IM.item_code=RM.item_code AND IM.fairId=$fair						
						   JOIN school_master AS SM ON SM.school_code=RM.school_code
						   JOIN festival_master AS FM ON IM.fest_id=FM.fest_id
						where RM.is_finish='Y'   
						group by RM.participant_id,RM.item_code ,SM.school_code order by FM.fest_id asc,IM.item_code,RM.total_mark desc ";//LIMIT 500 , 900 
			}
		}
		else
		{*/
	  	$query="SELECT SPD.item_code,IM.item_name,SPD.participant_id,RM.percentage,RM.grade,SPD.total_point as point,RM.rank,PD.participant_name,SPD.school_code,SM.school_name,SPD.is_withheld,FM.fest_name,FM.fest_id from  result_master AS RM JOIN school_point_details AS SPD ON RM.participant_id=SPD.participant_id and RM.item_code=SPD.item_code
						  JOIN participant_item_details AS PD ON PD.participant_id=SPD.participant_id and PD.school_code=SPD.school_code 
					      JOIN item_master AS IM ON IM.item_code=SPD.item_code AND IM.fairId=$fair						
						   JOIN school_master AS SM ON SM.school_code=RM.school_code
						   JOIN festival_master AS FM ON IM.fest_id=FM.fest_id
						where SPD.is_withheld='N' AND RM.is_finish='Y'   
						group by SPD.participant_id,SPD.item_code  order by FM.fest_id asc,IM.item_code,RM.total_mark desc ";
		//}
					   $school_wise_result		=$this->db->query($query);
					   return   $school_wise_result->result_array();
	}
	
	function item_wise_total_points($fair,$fest=0,$item=0)
	 {
	 	$festfilter=" ";$itemfilter=" ";
	 	if($fest > 0)$festfilter=" AND FM.fest_id= ".$fest;
		if($item > 0)$itemfilter=" AND IM.item_code= ".$item;
		
	  	$query="SELECT SPD.item_code,IM.item_name,SPD.participant_id,RM.percentage,RM.grade,RM.point,RM.rank,PD.participant_name,SPD.school_code,SM.school_name,SPD.is_withheld,FM.fest_name,FM.fest_id ,RM.total_mark,SUB.sub_district_name,PD.fairId
		
		from  result_master AS RM JOIN school_point_details AS SPD ON RM.participant_id=SPD.participant_id and RM.item_code=SPD.item_code
						  JOIN participant_item_details AS PD ON PD.participant_id=SPD.participant_id and PD.school_code=SPD.school_code and PD.pi_id = RM.participant_item_dtls_id
					      JOIN item_master AS IM ON IM.item_code=SPD.item_code AND IM.fairId=$fair				
						  JOIN sub_district_master as SUB ON SUB.sub_district_code= PD.sub_district_code
						  JOIN school_master AS SM ON SM.school_code=RM.school_code
						  JOIN festival_master AS FM ON IM.fest_id=FM.fest_id
						where SPD.is_withheld='N' AND RM.is_finish='Y'   ".$festfilter ." ".$itemfilter."
						group by SPD.participant_id,SPD.item_code  order by FM.fest_id asc,IM.item_code,RM.total_mark desc ";
	
					   $school_wise_result		=$this->db->query($query);
					   return   $school_wise_result->result_array();
	}
	
	function item_wise_school_wise_result_exhibition_values($fair,$fest)
	{
						
				$query="SELECT RM.school_code as schcode, sum( RM.total_mark) AS cnt, RM.fest_id,
				RM.rank,s.school_name as schname
				FROM result_master AS RM 
				JOIN school_master as s
				WHERE  length( RM.item_code ) >3 and  
				RM.fairId='$fair'  and  
				RM.fest_id='$fest' and RM.is_finish='Y'
				and s.school_code = RM.school_code 
				GROUP BY RM.school_code, RM.fest_id
				ORDER BY RM.fest_id, sum(RM.total_mark) DESC";
			
                $school_wise_result		=$this->db->query($query);
                return   $school_wise_result->result_array();
	}
	
	function result_exhibition_values($fair)
	{
						
				$query="SELECT RM.participant_id,RM.percentage,RM.grade,RM.total_mark as point,RM.rank,PD.participant_name,RM.school_code,SM.school_name,FM.fest_name,FM.fest_id from  result_master AS RM 
						  JOIN participant_item_details AS PD ON PD.participant_id=RM.participant_id and PD.school_code=RM.school_code and RM.item_code=RM.school_code and RM.fairId=$fair						
						   JOIN school_master AS SM ON SM.school_code=RM.school_code
						   JOIN festival_master AS FM ON RM.fest_id=FM.fest_id
						where RM.is_finish='Y'   
						group by RM.participant_id,FM.fest_id order by FM.fest_id asc,RM.total_mark desc  ";
			
                $school_wise_result		=$this->db->query($query);
                return   $school_wise_result->result_array();
	}
	
	
	
	 function status_of_kalolsavam($fest,$fair,$date)
	 {
	 if($date!='All')
	 {
		 if($fest!=0)
		 { //echo '1-------->'.$fest.'<br>';
			 if($fair==4 && $_POST['radioLabel']=='exhib')
			{
				$query="SELECT RP.item_code,RP.item_code as item_name,FM.fest_name,RP.fest_id,RP.fairId from result_master AS RP
				 JOIN ground_item_master AS sm ON sm.item_code = RP.item_code AND date( start_time ) = '$date'
			
				 LEFT JOIN festival_master AS FM ON RP.fest_id=FM.fest_id 
				 where RP.fest_id=$fest and RP.fairId=$fair and RP.is_finish='Y' and RP.item_code=RP.school_code
				 group by RP.item_code
				  order by RP.fairId,FM.fest_id";
				
			}
			else
			{
				$query="SELECT RP.item_code,IM.item_name,FM.fest_name,FM.fest_id,IM.fairId from result_master AS RP
				 JOIN ground_item_master AS sm ON sm.item_code = RP.item_code
			AND date( start_time ) = '$date'
				  LEFT JOIN item_master AS IM ON IM.item_code=RP.item_code LEFT JOIN festival_master AS FM ON IM.fest_id=FM.fest_id where IM.fest_id=$fest and IM.fairId=$fair and RP.is_finish='Y' group by RP.item_code order by IM.fairId,FM.fest_id,IM.item_code";
			}
					   $school_wise_result		=$this->db->query($query);
					   return   $school_wise_result->result_array();
		}
		else
		{ //echo '1-------->'.$fest.'<br>';
			 if($fair==4 && $_POST['radioLabel']=='exhib')
			{
				$query="SELECT RP.item_code,RP.item_code as item_name,FM.fest_name,RP.fest_id,RP.fairId from result_master AS RP
				 JOIN ground_item_master AS sm ON sm.item_code = RP.item_code AND date( start_time ) = '$date'
			
				 LEFT JOIN festival_master AS FM ON RP.fest_id=FM.fest_id 
				 where  RP.is_finish='Y' and RP.fairId=$fair and RP.item_code=RP.school_code
				 group by RP.item_code
				  order by RP.fairId,FM.fest_id";
				
			}
			else
			{
			$query="SELECT RP.item_code,IM.item_name,FM.fest_name,FM.fest_id,IM.fairId from result_master AS RP
			 JOIN ground_item_master AS sm ON sm.item_code = RP.item_code
		AND date( start_time ) = '$date'
			 LEFT JOIN item_master AS IM ON IM.item_code=RP.item_code LEFT JOIN festival_master AS FM ON IM.fest_id=FM.fest_id 
			 where RP.is_finish='Y' and IM.fairId=$fair
			 group by RP.item_code
			  order by IM.fairId,FM.fest_id,IM.item_code";
			}
					   $school_wise_result		=$this->db->query($query);
					   return   $school_wise_result->result_array();
		
		}
	}
	else
	{ //echo '1-------->'.$fest.'<br>';
	 if($fest != 0)
	 {
	 	if($fair==4 && $_POST['radioLabel']=='exhib')
		{
		$query="SELECT RP.item_code,RP.item_code as item_name,FM.fest_name,RP.fest_id,RP.fairId from result_master AS RP
		 JOIN ground_item_master AS sm ON sm.item_code = RP.item_code
	
		 LEFT JOIN festival_master AS FM ON RP.fest_id=FM.fest_id 
		 where RP.fest_id=$fest and RP.fairId=$fair and RP.is_finish='Y' and RP.item_code=RP.school_code
		 group by RP.item_code
		  order by RP.fairId,FM.fest_id";
		
		}
		else
		{
			 $query="SELECT RP.item_code,IM.item_name,FM.fest_name,FM.fest_id,IM.fairId from result_master AS RP
			 JOIN ground_item_master AS sm ON sm.item_code = RP.item_code
		
			  LEFT JOIN item_master AS IM ON IM.item_code=RP.item_code LEFT JOIN festival_master AS FM ON IM.fest_id=FM.fest_id where IM.fest_id=$fest and IM.fairId=$fair and RP.is_finish='Y' group by RP.item_code order by IM.fairId,FM.fest_id,IM.item_code";
		}
                   $school_wise_result		=$this->db->query($query);
                   return   $school_wise_result->result_array();
	 }
	else
	{ 
		if($fair==4 && $_POST['radioLabel']=='exhib')
		{
		$query="SELECT RP.item_code,RP.item_code as item_name,FM.fest_name,RP.fest_id,RP.fairId from result_master AS RP
		 JOIN ground_item_master AS sm ON sm.item_code = RP.item_code
	
		 LEFT JOIN festival_master AS FM ON RP.fest_id=FM.fest_id 
		 where RP.is_finish='Y' and RP.fairId=$fair and RP.item_code=RP.school_code
		 group by RP.item_code
		  order by RP.fairId,FM.fest_id";
		
		}
		else
		{
		$query="SELECT RP.item_code,IM.item_name,FM.fest_name,FM.fest_id,IM.fairId from result_master AS RP
		 JOIN ground_item_master AS sm ON sm.item_code = RP.item_code
	
		 LEFT JOIN item_master AS IM ON IM.item_code=RP.item_code LEFT JOIN festival_master AS FM ON IM.fest_id=FM.fest_id 
		 where RP.is_finish='Y' and IM.fairId=$fair
		 group by RP.item_code
		  order by IM.fairId,FM.fest_id,IM.item_code";
		}
                   $school_wise_result		=$this->db->query($query);
                   return   $school_wise_result->result_array();
	
	}
	}
	 
	 }
	 function status_of_kalolsavam1($fest,$fair,$festdate)
	 {//echo '2-------->'.$fest.'<br>';
	 if($festdate!='All')
	 { 
	 if($fest == 0) 
	 {//echo '2-------->'.$fest.'<br>';
		        $query1="SELECT IM.item_name, FM.fest_name, IM.item_code, FM.fest_id,IM.fairId
								FROM item_master AS IM
									JOIN ground_item_master AS sm ON sm.item_code = IM.item_code
						AND date( start_time ) = '$festdate' AND IM.fairId=$fair
							JOIN festival_master AS FM ON IM.fest_id = FM.fest_id
												AND IM.item_code NOT
								IN (
								
								SELECT DISTINCT (
								rp.item_code
								)
								FROM result_master AS rp
								) GROUP BY IM.item_code 
								ORDER BY IM.fairId,FM.fest_id,IM.item_code";
				   $school_wise_result		=$this->db->query($query1);
                   return   $school_wise_result->result_array();	
		}
		else
		{ 
		 
				   $query1="SELECT IM.item_name, FM.fest_name, IM.item_code,FM.fest_id,IM.fairId
							FROM item_master AS IM
							JOIN ground_item_master AS sm ON sm.item_code = IM.item_code
							AND date( start_time ) = '$festdate'
							LEFT JOIN festival_master AS FM ON IM.fest_id = FM.fest_id
							WHERE IM.fest_id ='$fest' AND IM.fairId=$fair
							AND IM.item_code NOT
							IN (
							SELECT distinct(RP.item_code)
							FROM result_master AS RP
							LEFT JOIN item_master AS IM ON IM.item_code = RP.item_code
							LEFT JOIN festival_master AS FM ON IM.fest_id = FM.fest_id
							WHERE IM.fest_id =$fest and IM.fairId=$fair and RP.is_finish='Y' ) GROUP BY IM.item_code order by IM.fairId,FM.fest_id,IM.item_code";
							
				   $school_wise_result		=$this->db->query($query1);
                   return   $school_wise_result->result_array();
				   
		
	 }
	 }
	 else
	 {
	 if($fest!=0) 
	 { //echo '2-------->'.$fest.'<br>';
	 		
				   $query1="SELECT IM.item_name, FM.fest_name, IM.item_code,FM.fest_id,IM.fairId
							FROM item_master AS IM
							JOIN ground_item_master AS sm ON sm.item_code = IM.item_code
							LEFT JOIN festival_master AS FM ON IM.fest_id = FM.fest_id
							WHERE IM.fest_id ='$fest' and IM.fairId=$fair
							AND IM.item_code NOT
							IN (
							SELECT distinct(RP.item_code)
							FROM result_master AS RP
							LEFT JOIN item_master AS IM ON IM.item_code = RP.item_code
							LEFT JOIN festival_master AS FM ON IM.fest_id = FM.fest_id
							WHERE IM.fest_id =$fest and IM.fairId=$fair  and RP.is_finish='Y') GROUP BY IM.item_code order by IM.fairId,FM.fest_id,IM.item_code";
						
				   $school_wise_result		=$this->db->query($query1);
                   return   $school_wise_result->result_array();
		}
		else
		{ //echo '2-------->'.$fest.'<br>';
			
		        $query1="SELECT IM.item_name, FM.fest_name, IM.item_code, FM.fest_id,IM.fairId
								FROM item_master AS IM
									JOIN ground_item_master AS sm ON sm.item_code = IM.item_code 
							JOIN festival_master AS FM ON IM.fest_id = FM.fest_id
												where  IM.fairId=$fair AND IM.item_code  NOT
								IN (
								
								SELECT DISTINCT (
								rp.item_code
								)
								FROM result_master AS rp
								where rp.is_finish='Y')
								GROUP BY IM.item_code ORDER BY IM.fairId,FM.fest_id,IM.item_code";
			
				   $school_wise_result		=$this->db->query($query1);
                   return   $school_wise_result->result_array();	
	 }
	 }
	 }
	 
	 
	 function higherlevel_result($festid,$item,$fair)
	{		
			if($fair == 4 && $this->input->post('radioLabel')=='exhib')
			{
				$this->db->select('rm.item_code, r.participant_id, r.school_code, r.grade, m.school_name, p.participant_name, p.class, f.fest_name,f.fest_id, rm.item_code as item_name,rm.rank,p.fairId,sfm.fairName');
				$this->db->from('result_publish AS r');
				$this->db->join('school_master AS m','m.school_code = r.school_code');
				$this->db->join('participant_item_details AS p',"p.participant_id = r.participant_id ");
				//$this->db->join('item_master AS i','i.item_code = r.item_code');
				
				$this->db->join('result_master AS rm',"rm.item_code = r.item_code and rm.school_code = r.school_code and rm.participant_id = r.participant_id and rm.participant_item_dtls_id=p.pi_id and  rm.is_finish = 'Y'");
				$this->db->join('festival_master AS f','f.fest_id = rm.fest_id');
				$this->db->join('science_master AS sfm','sfm.fairId = p.fairId');
				$this->db->where("p.fairId",4);
				$this->db->where("p.exhibition",2);
				$this->db->where("r.is_withheld = 'N'");
				if($festid!='All')
				$this->db->where("f.fest_id",$festid);
				//if($item!='ALL')
				//$this->db->where("r.item_code",$item);
				
				$this->db->group_by('rm.rank');
				$this->db->group_by('r.participant_id');
				$this->db->group_by('r.item_code');
				$this->db->order_by('rm.fest_id');
				$this->db->order_by('rm.rank');
			}
			else
			{		   
				$this->db->select('r.item_code, r.participant_id, r.school_code, r.grade, m.school_name, p.participant_name, p.class, f.fest_name,f.fest_id, i.item_name,rm.rank,p.fairId,sfm.fairName');
				$this->db->from('result_publish AS r');
				$this->db->join('school_master AS m','m.school_code = r.school_code');
				$this->db->join('participant_item_details AS p',"p.participant_id = r.participant_id AND  p.item_code = r.item_code ");
				$this->db->join('item_master AS i','i.item_code = r.item_code');
				$this->db->join('festival_master AS f','f.fest_id = i.fest_id');
				$this->db->join('result_master AS rm',"rm.item_code = r.item_code and rm.school_code = r.school_code and rm.participant_id = r.participant_id and rm.participant_item_dtls_id=p.pi_id and  rm.is_finish = 'Y'");
				$this->db->join('science_master AS sfm','sfm.fairId = p.fairId');
				$this->db->where("p.fairId",$fair);
				$this->db->where("r.is_withheld = 'N'");
				if($festid!='All')
				$this->db->where("f.fest_id",$festid);
				if($item!='ALL')
				$this->db->where("r.item_code",$item);
				
			//	$this->db->where("  ");
				$this->db->group_by('rm.rank');
				$this->db->group_by('r.participant_id');
				$this->db->group_by('r.item_code');
				$this->db->order_by('i.fest_id');
				$this->db->order_by('r.item_code');
				$this->db->order_by('rm.rank');
			}
				$details	=	$this->db->get();
				return  $details->result_array();
	}
	
	function schoolhigher_result($school,$fair)
	{
		if($fair == 4 )
		{
			$query1 =" 
			SELECT r.item_code, r.participant_id, r.school_code, r.grade, m.school_name, p.participant_name, p.class, f.fest_name, rm.fest_id, i.item_name 
			
			FROM result_publish AS r 
			JOIN result_master AS rm ON rm.school_code=r.school_code and rm.participant_id=r.participant_id and rm.item_code=r.item_code
			JOIN school_master AS m ON m.school_code = r.school_code 
			JOIN participant_item_details AS p ON p.participant_id = r.participant_id 
			JOIN item_master AS i ON (i.item_code = r.item_code or r.item_code=r.school_code)
			JOIN festival_master AS f ON f.fest_id = rm.fest_id 
			
			WHERE r.is_withheld = 'N' AND r.school_code = ".$school." AND i.fairId = ".$fair." group by r.item_code ORDER BY i.fest_id, r.item_code";
			
			$details		=$this->db->query($query1);
			
			/*$this->db->select('r.item_code, r.participant_id, r.school_code, r.grade, m.school_name, p.participant_name, p.class, f.fest_name,f.fest_id, i.item_name');
			$this->db->from('result_publish AS r');
			$this->db->join('school_masters AS m','m.school_code = r.school_code');
			$this->db->join('participant_item_details AS p',"p.participant_id = r.participant_id ");
			$this->db->join('item_master AS i','i.item_code = r.item_code or r.item_code=r.school_code');
			$this->db->join('festival_master AS f','f.fest_id = i.fest_id');
			$this->db->where("r.is_withheld = 'N'");
			//$this->db->where("R.is_taken ='Y' and R.is_finish = 'Y'");
			$this->db->where("r.school_code",$school);
			$this->db->where("i.fairId",$fair);
			$this->db->order_by('i.fest_id');
			$this->db->order_by('r.item_code');*/
			
			
		}
		else
		{		   
			$this->db->select('r.item_code, r.participant_id, r.school_code, r.grade, m.school_name, p.participant_name, p.class, f.fest_name,f.fest_id, i.item_name');
			$this->db->from('result_publish AS r');
			$this->db->join('school_master AS m','m.school_code = r.school_code');
			$this->db->join('participant_item_details AS p',"p.participant_id = r.participant_id and p.item_code=r.item_code ");
			$this->db->join('item_master AS i','i.item_code = r.item_code');
			$this->db->join('festival_master AS f','f.fest_id = i.fest_id');
			$this->db->where("r.is_withheld = 'N'");
			//$this->db->where("R.is_taken ='Y' and R.is_finish = 'Y'");
			$this->db->where("r.school_code",$school);
			$this->db->where("i.fairId",$fair);
			$this->db->order_by('i.fest_id');
			$this->db->order_by('r.item_code');
			
			$details	=	$this->db->get();
		}	
				
				return  $details->result_array();
	}
	
	
	function schoolhigher_resultall($fair)
	{
	
		if($fair == 4 )
		{
			$query1 =" 
			SELECT r.item_code, r.participant_id, r.school_code, r.grade, m.school_name, p.participant_name, p.class, f.fest_name, rm.fest_id, i.item_name 
			
			FROM result_publish AS r 
			JOIN result_master AS rm ON rm.school_code=r.school_code and rm.participant_id=r.participant_id and rm.item_code=r.item_code
			JOIN school_master AS m ON m.school_code = r.school_code 
			JOIN participant_item_details AS p ON p.participant_id = r.participant_id 
			JOIN item_master AS i ON (i.item_code = r.item_code or r.item_code=r.school_code)
			JOIN festival_master AS f ON f.fest_id = rm.fest_id 
			
			WHERE r.is_withheld = 'N'  AND i.fairId = ".$fair." group by r.school_code,r.item_code ORDER BY r.school_code,i.fest_id, r.item_code";
			
			$details		=$this->db->query($query1);
		}
		else
		{
			$this->db->select('r.item_code, r.participant_id, r.school_code, r.grade, m.school_name, p.participant_name, p.class, f.fest_name,f.fest_id, i.item_name');
			$this->db->from('result_publish AS r');
			$this->db->join('school_master AS m','m.school_code = r.school_code');
			$this->db->join('participant_item_details AS p',"p.participant_id = r.participant_id ");
			$this->db->join('item_master AS i','i.item_code = r.item_code');
			$this->db->join('festival_master AS f','f.fest_id = i.fest_id');
			$this->db->where("r.is_withheld = 'N'");
			$this->db->where("i.fairId",$fair);
			$this->db->order_by('i.fest_id');
			$this->db->order_by('r.item_code');
			
			$details	=	$this->db->get();
		}
		
			return  $details->result_array();
		
	}
	
}

?>