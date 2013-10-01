<? class Resultindex_Model extends CI_Model{
	function Resultindex_Model()
	{
		parent::__construct();
	}
	
	function result_rank($festid,$fair)
	{ 	
			
			$this->db->select('R.item_code, R.participant_id, R.school_code, R.code_no, R.total_mark, R.grade, R.point as ppoint, R.rank, M.school_name, pd.participant_name,pd.admn_no,pd.class, I.item_name, F.fest_name,pd.spo_id,I.is_teach, sp.is_publish,rdm.rev_district_code,rdm.rev_district_name,scm.fairName');
			$this->db->from('result_master AS R');
			$this->db->join('school_master AS M','M.school_code = R.school_code');
			$this->db->join('rev_district_master AS rdm','M.rev_district_code =rdm.rev_district_code');
		
			$this->db->join('item_master AS I',"I.item_code = R.item_code AND I.fest_id ='$festid' AND I.fairId ='$fair'");
			//$this->db->join('result_time AS rt',"rt.item_code = I.item_code");
			$this->db->join('festival_master AS F'," F.fest_id = I.fest_id AND F.fest_id='$festid'");
			$this->db->join('science_master AS scm',"scm.fairId= I.fairId AND scm.fairId ='$fair'");
			$this->db->join('participant_item_details AS pd',"pd.participant_id = R.participant_id AND pd.item_code = R.item_code");
			$this->db->join('special_order_master AS sp',"pd.spo_id = sp.spo_id AND sp.is_publish = 'N'",'LEFT');
			
			$this->db->where("(sp.is_publish IS NULL OR sp.is_publish != 'Y')");
			$this->db->where("R.is_finish",'Y');
			$this->db->order_by('R.item_code');
			$this->db->order_by('R.total_mark DESC');
			$retvalue=$this->db->get();
			return $retvalue->result_array();
		}
		
	function result_rank_exb($festid,$fair)
	{ 	
			
			$this->db->select('R.participant_id, R.school_code, R.code_no, R.total_mark, R.grade, spd.total_point as ppoint, R.rank, M.school_name, pd.participant_name,pd.admn_no,pd.class, F.fest_name,rdm.rev_district_code,rdm.rev_district_name,scm.fairName');
			$this->db->from('result_master AS R');
			$this->db->join('school_master AS M','M.school_code = R.school_code');
			$this->db->join('rev_district_master AS rdm','M.rev_district_code =rdm.rev_district_code');
			$this->db->join('school_point_details AS spd','spd.school_code =R.item_code and spd.school_code =spd.item_code');
			$this->db->join('festival_master AS F'," F.fest_id = R.fest_id AND F.fest_id='$festid'");
			$this->db->join('science_master AS scm',"scm.fairId= R.fairId AND scm.fairId ='$fair'");
			$this->db->join('participant_item_details AS pd',"pd.participant_id = R.participant_id AND pd.school_code = R.item_code");
						
			$this->db->where("R.is_finish",'Y');
			$this->db->where("R.fest_id",$festid);
			$this->db->where("R.grade != '' or R.rank != ''");
			$this->db->order_by('R.total_mark DESC');
			$retvalue=$this->db->get();
			return $retvalue->result_array();
		}
	function schoolpoints($festid,$fair,$overall_flag,$schoolcode=0)
	{	
		//echo "<br />ggg---".$festid."----".$fair."----".$schoolcode;
		if($fair==1)
			{
				if($festid == 1) { $items = array(''); }
				else if($festid == 2) { $items = array('111','112'); }
				else if($festid == 3) { $items = array('120','121','122','123'); }
				else if($festid == 4) { $items = array('131','132'); }						
			}
			else if($fair==2)
			{
				if($festid == 1) { $items = array('138','139'); }
				else if($festid == 2) { $items = array('146','147'); }
				else if($festid == 3) { $items = array('163','164'); }
				else if($festid == 4) { $items = array('181','182'); }	
						
			}
			else if($fair==3)
			{
				if($festid == 1) { $items = array(''); }
				else if($festid == 2) { $items = array('194'); }
				else if($festid == 3) { $items = array('204','205','206'); }
				else if($festid == 4) { $items = array('214'); }	
			}
			
			
			if(($fair==2 && $schoolcode==0) || ($fair==2 && $overall_flag == 1 && $schoolcode!=0)) 			{			
			$this->db->where_not_in('item_code',$items);
			$this->db->select('school_code');
			$this->db->distinct('school_code');
			$this->db->from('result_master');
			$this->db->where("fairId",$fair);
			$this->db->where("fest_id",$festid);
			if($overall_flag == 1) {
			$this->db->where("grade IN ('A')");
			$this->db->where("rank IN ('1')");
			}
			$school_val=$this->db->get();
			$school_query	=	$school_val->result_array();
			if(count($school_query) > 0) {
				foreach($school_query as $row)
				{
					$school_code	=	$row['school_code'];
					$schools[]		=	$school_code;
				}
			}
			else
			{
				$schools	=	array('');
			}
		  }
		  else if ($fair==2 && $overall_flag == 0 && $schoolcode!=0)
		  {
		  		$schools[]		=	$schoolcode;
		  }
	
			if($fair==1 || $fair==2 || $fair==3) $this->db->where_not_in('I.item_code',$items);
			
			if($this->input->post('radioLabel') != 'exhib'){
							$this->db->select('s.school_code, sum(s.total_point ) AS spoint, m.school_name,f.fest_name,f.fest_id,scm.fairId,scm.fairName,sum(RS.total_mark) as tot_mark');
			}
			else{
							$this->db->select('s.school_code, sum(s.total_point ) AS spoint, m.school_name,f.fest_name,f.fest_id,scm.fairId,scm.fairName,sum(I.total_mark) as tot_mark');
			}		
			
			$this->db->from('school_point_details AS s');
			$this->db->join('school_master AS m','s.school_code = m.school_code');
			if($this->input->post('radioLabel') != 'exhib'){
				$this->db->join('item_master AS I','I.item_code = s.item_code'); 
				$this->db->join('result_master AS RS','RS.item_code=s.item_code and RS.school_code = s.school_code and RS.participant_id=s.participant_id '); 
			}
			else{
				$this->db->join('result_master AS I','I.item_code = s.school_code and I.item_code=s.item_code'); 
			}
			$this->db->join('festival_master AS f',"f.fest_id=I.fest_id and f.fest_id='$festid'");
			$this->db->join('science_master AS scm',"scm.fairId= I.fairId AND scm.fairId ='$fair'");
			if($fair!=1 && $fair!=3 && $fair!=4 && $fair!=5){
			//echo "<br />ggg---".$fair;
			$this->db->where_in('s.school_code',$schools); }
			if($schoolcode != 0){
			    $this->db->where('s.school_code',$schoolcode); }
			$this->db->where('I.fest_id',$festid);
			$this->db->where('I.fairId',$fair);
			$this->db->group_by('s.school_code');
			$this->db->order_by('spoint desc');
			$this->db->order_by('tot_mark desc');
			$retvalue=$this->db->get();
			return $retvalue->result_array();
	}
	
	function schoolpoints_work_aggr($festid,$fair,$overall_flag,$schoolcode=0)
	{			
			$this->db->select('s.school_code, sum( total_point ) AS spoint, m.school_name,f.fest_name,f.fest_id,scm.fairName');
			$this->db->from('school_point_details AS s');
			$this->db->join('school_master AS m','s.school_code = m.school_code');
			$this->db->join('result_master AS I','I.item_code = s.item_code and I.school_code = s.school_code'); 			
			$this->db->join('festival_master AS f',"f.fest_id=I.fest_id and f.fest_id='$festid'");
			$this->db->join('science_master AS scm',"scm.fairId= I.fairId AND scm.fairId ='$fair'");
			$this->db->where('I.fairId',$fair);
			$this->db->where('I.fest_id',$festid);
			if($schoolcode!=0){
				$this->db->where('I.school_code',$schoolcode);
			}
			$this->db->group_by('s.school_code');
			$this->db->order_by('spoint desc');
			$retvalue=$this->db->get();
			return $retvalue->result_array();
	}
	
	function schoolpoints_details($festid,$fair,$schoolcode)
	{	
			$this->db->select('r.*,I.*');
			$this->db->from('result_master AS r');
			$this->db->join('school_master AS m','r.school_code = m.school_code');
			$this->db->join('festival_master AS f','f.fest_id=r.fest_id');
			$this->db->join('science_master AS scm','scm.fairId= r.fairId');
			$this->db->join('item_master AS I',"I.item_code = r.item_code AND I.fairId ='$fair'");
			$this->db->join('school_point_details AS spd',"spd.item_code = r.item_code AND spd.is_withheld = 'N' AND spd.school_code = r.school_code AND spd.participant_id = r.participant_id");
			$this->db->where('r.fest_id',$festid);
			$this->db->where('r.fairId',$fair);
			$this->db->where('r.school_code',$schoolcode);
			$this->db->order_by('r.point desc');
			$this->db->order_by('r.item_code');			
			$retvalue=$this->db->get();
			return $retvalue->result_array();
	}
	
	
	function schoolpoints_overallchampions($fest,$fair,$schoolcode)
	{
	//echo '<br><br><br>fest==='.$fest.'<br><br><br>';
			
			if($fair==1)
			{
				if($fest == 1) { $items = array(''); }
				else if($fest == 2) { $items = array('111','112'); }
				else if($fest == 3) { $items = array('120','121','122','123'); }
				else if($fest == 4) { $items = array('131','132'); }						
			}
			else if($fair==2)
			{
				if($fest == 1) { $items = array('138','139'); }
				else if($fest == 2) { $items = array('146','147'); }
				else if($fest == 3) { $items = array('163','164'); }
				else if($fest == 4) { $items = array('181','182'); }	
						
			}
			else if($fair==3)
			{
				if($fest == 1) { $items = array(''); }
				else if($fest == 2) { $items = array('194'); }
				else if($fest == 3) { $items = array('204','205','206'); }
				else if($fest == 4) { $items = array('214'); }	
			}		
			
		
			if($fair==1 || $fair==2 || $fair==3) $this->db->where_not_in('I.item_code',$items);
			
			$this->db->select('R.*,I.*');
			$this->db->from('result_master AS R');
			$this->db->join('school_master AS M',"M.school_code =R.school_code");
			$this->db->join('item_master AS I',"I.item_code = R.item_code AND I.fairId ='$fair'");
			$this->db->join('school_point_details AS spd',"spd.item_code = R.item_code AND spd.is_withheld = 'N' AND spd.school_code = R.school_code  AND spd.participant_id = R.participant_id");			
			$this->db->where_in('R.school_code',$schoolcode);
			$this->db->where_in('R.fest_id',$fest);
			$this->db->where_in('R.fairId',$fair);
			/*$this->db->where("R.grade IN ('A')");
			$this->db->where("R.rank IN ('1')");*/
			if($fair != 4){
			$this->db->where("R.point > 0");
			}
			else{
			$this->db->where("R.total_mark > 0");
			}
			$this->db->where("R.is_finish",'Y');
			$this->db->order_by('R.point  desc');
			$this->db->order_by('R.item_code');
			$this->db->order_by('R.grade');
			$retvalue=$this->db->get();
			return $retvalue->result_array();
	}
	
	
	function allresults($fair)
	{
			$this->db->select('R.item_code , R.participant_id , R.school_code , R.code_no , R.total_mark , R.grade , R.point , R.rank , M.school_name , pd.participant_name ,pd.admn_no, pd.class , I.item_name , F.fest_name , F.fest_id,pd.spo_id, R.fairId,sp.is_publish,sdm.sub_district_code,sdm.sub_district_name,rdm.rev_district_code,rdm.rev_district_name,scm.fairName');
			$this->db->from('result_master AS R');
			$this->db->join('school_master AS M','M.school_code = R.school_code');
			$this->db->join('sub_district_master AS sdm','M.sub_district_code = sdm.sub_district_code');
		    $this->db->join('rev_district_master AS rdm','M.rev_district_code = rdm.rev_district_code');
			$this->db->join('item_master AS I',"I.item_code = R.item_code AND I.fairId ='$fair'");
			$this->db->join('festival_master AS F'," F.fest_id = I.fest_id");
			$this->db->join('participant_item_details AS pd','pd.pi_id = R.participant_item_dtls_id AND pd.item_code = R.item_code');
			$this->db->join('special_order_master AS sp',"pd.spo_id = sp.spo_id AND sp.is_publish = 'N'",'LEFT');
			$this->db->join('science_master AS scm',"scm.fairId= I.fairId AND scm.fairId ='$fair'");
			//$this->db->where("R.grade IN ('A','B','C')");
			$this->db->where("(sp.is_publish IS NULL OR sp.is_publish != 'Y')");
			$this->db->where("R.is_finish",'Y');
			$this->db->order_by('F.fest_id');
			$this->db->order_by('R.item_code');
			$this->db->order_by('R.total_mark  desc');
			//$this->db->order_by('R.grade');
			$retvalue1=$this->db->get();
			
			$retvalue	=	 $retvalue1->result_array();
			
			return $retvalue;
	}
	
	
	
	
	function allresults_exb($fair)
	{
			$this->db->select('R.item_code , R.participant_id , R.school_code , R.code_no , R.total_mark , R.grade , R.point , R.total_mark, R.rank , M.school_name , pd.participant_name ,pd.admn_no, pd.class , F.fest_name , F.fest_id,pd.spo_id, sdm.sub_district_code,sdm.sub_district_name,rdm.rev_district_code,rdm.rev_district_name,scm.fairName');
			$this->db->from('result_master AS R');
			$this->db->join('school_master AS M','M.school_code = R.school_code');
			$this->db->join('sub_district_master AS sdm','M.sub_district_code = sdm.sub_district_code');
		    $this->db->join('rev_district_master AS rdm','M.rev_district_code = rdm.rev_district_code');
			$this->db->join('festival_master AS F'," F.fest_id = R.fest_id");
			$this->db->join('participant_item_details AS pd','pd.participant_id = R.participant_id AND pd.fest_id = 0 AND pd.school_code = R.item_code AND pd.is_captain ="Y"');
			$this->db->join('science_master AS scm',"scm.fairId= R.fairId AND scm.fairId ='$fair'");
			
			$this->db->where("R.item_code = R.school_code");
			$this->db->where("R.is_finish",'Y');
			$this->db->where("R.fairId",$fair);
			$this->db->order_by('F.fest_id');
			$this->db->order_by('R.total_mark  desc');
			
			$retvalue=$this->db->get();
			return $retvalue->result_array();
	}
	
	
	function allresults_work_aggr($fair)
	{
			$this->db->select('R.item_code , R.participant_id , R.school_code , R.code_no , R.total_mark , R.grade , R.point , R.rank ,  R.total_mark, M.school_name , pd.participant_name ,pd.admn_no, pd.class , F.fest_name , F.fest_id,pd.spo_id, sdm.sub_district_code,sdm.sub_district_name,rdm.rev_district_code,rdm.rev_district_name,scm.fairName');
			$this->db->from('result_master AS R');
			$this->db->join('school_master AS M','M.school_code = R.school_code');
			$this->db->join('sub_district_master AS sdm','M.sub_district_code = sdm.sub_district_code');
		    $this->db->join('rev_district_master AS rdm','M.rev_district_code = rdm.rev_district_code');
			$this->db->join('festival_master AS F'," F.fest_id = R.fest_id");
			$this->db->join('participant_item_details AS pd','pd.participant_id = R.participant_id AND pd.fest_id = 0 AND pd.school_code = R.item_code');
			$this->db->join('science_master AS scm',"scm.fairId= R.fairId AND scm.fairId ='$fair'");
			$this->db->where("R.grade IN ('A','B','C')");
			$this->db->where("R.item_code = R.school_code");
			$this->db->where("R.is_finish",'Y');
			$this->db->where("R.fairId",$fair);
			$this->db->order_by('F.fest_id');
			$this->db->order_by('R.item_code');
			$this->db->order_by('R.total_mark  desc');
			//$this->db->order_by('R.grade');
			$retvalue=$this->db->get();
			return $retvalue->result_array();
	}
	
	
	function overallchampions($fair,$overall_flag,$schoolcode=0)
	{
//	echo '<br><br><br>fair==='.$fair.'<br><br><br>';
			$schools	=	array('');
			if($fair==1)
			{
				$items = array('111','112','120','121','122','123','131','132');
			}
			else if($fair==2)
			{
				$items = array('138','139','146','147','163','164','181','182');
			}
			else if($fair==3)
			{
				$items = array('194','204','205','206','214');
			}
			$schools	=  array();
			if($fair==1 || $fair==2 || $fair==3) { $this->db->where_not_in('item_code',$items);
			
			$this->db->select('school_code');
			$this->db->distinct('school_code');
			$this->db->from('result_master');
			$this->db->where("fairId",$fair);
			if($fair==2 && $overall_flag	==	1){
			$this->db->where("grade IN ('A')");
			$this->db->where("rank IN ('1')");
			}
			$school_val=$this->db->get();
			$school_query	=	$school_val->result_array();
			if(count($school_query) > 0) {
				foreach($school_query as $row)
				{
					$school_code	=	$row['school_code'];
					$schools[]		=	$school_code;
				}
			}
			else
			{
				$schools	=	array('');
			}
		 }
			if($fair==1 || $fair==2 || $fair==3) $this->db->where_not_in('I.item_code',$items);
			
					
			$this->db->select(' R.school_code , sum(spd.total_point) as point ,  M.school_name ,   F.fest_name , F.fest_id, sdm.sub_district_code, sdm.sub_district_name, rdm.rev_district_code, rdm.rev_district_name,scm.fairId,scm.fairName,sum(R.total_mark) as tot_mark');
			$this->db->from('result_master AS R');
			$this->db->join('school_master AS M','M.school_code = R.school_code');
			$this->db->join('sub_district_master AS sdm','M.sub_district_code = sdm.sub_district_code');
		    $this->db->join('rev_district_master AS rdm','M.rev_district_code = rdm.rev_district_code');
			if($this->input->post('radioLabel') != 'exhib'){
				$this->db->join('item_master AS I',"I.item_code = R.item_code AND I.fairId ='$fair'");
				$this->db->join('festival_master AS F'," F.fest_id = I.fest_id");
				$this->db->join('science_master AS scm',"scm.fairId= I.fairId AND scm.fairId ='$fair'");
			}
			else
			{
				$this->db->join('festival_master AS F'," F.fest_id = R.fest_id");
				$this->db->join('science_master AS scm',"scm.fairId= R.fairId AND scm.fairId ='$fair'");				
			}
			$this->db->join('school_point_details AS spd',"spd.item_code = R.item_code AND spd.is_withheld = 'N' AND spd.school_code = R.school_code  AND spd.participant_id = R.participant_id");
			if($this->input->post('radioLabel') == 'exhib'){
				$this->db->where('R.item_code = spd.school_code');				
			}
			if($fair!=1 && $fair!=3 && $fair!=4 && $fair!=5){
			$this->db->where_in('R.school_code',$schools); }
			if($schoolcode !=0){
				$this->db->where('R.school_code',$schoolcode); 
			}	
			$this->db->where_in('R.fairId',$fair);
			$this->db->where("R.is_finish",'Y');
			$this->db->group_by('M.school_code');
			$this->db->order_by('point  desc');
			//$this->db->order_by('tot_mark  desc');
			$retvalue=$this->db->get();
			return $retvalue->result_array();
	}
	
	
	function overallchampions_work_aggr($fair)
	{
//	echo '<br><br><br>fair==='.$fair.'<br><br><br>';		
			
			$this->db->select(' R.school_code , sum(spd.total_point) as point ,  M.school_name ,   F.fest_name , F.fest_id, sdm.sub_district_code, sdm.sub_district_name, rdm.rev_district_code, rdm.rev_district_name, scm.fairName');
			$this->db->from('result_master AS R');
			$this->db->join('school_master AS M','M.school_code = R.school_code');
			$this->db->join('sub_district_master AS sdm','M.sub_district_code = sdm.sub_district_code');
		    $this->db->join('rev_district_master AS rdm','M.rev_district_code = rdm.rev_district_code');
			
				$this->db->join('festival_master AS F'," F.fest_id = R.fest_id");
				$this->db->join('science_master AS scm',"scm.fairId= R.fairId AND scm.fairId ='$fair'");				
			    $this->db->join('school_point_details AS spd',"spd.item_code = R.item_code AND spd.is_withheld = 'N' AND spd.school_code = R.school_code AND spd.participant_id = R.participant_id");
							
			$this->db->where_in('R.fairId',$fair);
			$this->db->where("R.is_finish",'Y');
			$this->db->group_by('M.school_code');
			$this->db->order_by('point  desc');
			$retvalue=$this->db->get();
			return $retvalue->result_array();
	}
	
	
	function festwise_overallchampions($fair,$fest)
	{
	//echo '<br><br><br>fest==='.$fest.'<br><br><br>';
			$items	=  array();
			
			if($fair==1)
			{
				if($fest == 1) { $items = array(''); }
				else if($fest == 2) { $items = array('111','112'); }
				else if($fest == 3) { $items = array('120','121','122','123'); }
				else if($fest == 4) { $items = array('131','132'); }						
			}
			else if($fair==2)
			{
				if($fest == 1) { $items = array('138','139'); }
				else if($fest == 2) { $items = array('146','147'); }
				else if($fest == 3) { $items = array('163','164'); }
				else if($fest == 4) { $items = array('181','182'); }	
						
			}
			else if($fair==3)
			{
				if($fest == 1) { $items = array(''); }
				else if($fest == 2) { $items = array('194'); }
				else if($fest == 3) { $items = array('204','205','206'); }
				else if($fest == 4) { $items = array('214'); }	
			}					
			
			
			$schools	=  array('');
			
			if($fair==1 || $fair==2 || $fair==3) 
			{
			$this->db->where_not_in('item_code',$items);
			
			$this->db->select('school_code');
			$this->db->distinct('school_code');
			$this->db->from('result_master');
			$this->db->where("fairId",$fair);
			$this->db->where("fest_id",$fest);
			$this->db->where("grade IN ('A')");
			$this->db->where("rank IN ('1')");
			$school_val=$this->db->get();
			$school_query	=	$school_val->result_array();
			if(count($school_query) > 0) {
				foreach($school_query as $row)
				{
					$school_code	=	$row['school_code'];
					$schools[]		=	$school_code;
				}
			}
			else
			{
				$schools	=	array('');
			}
		  }
			if($fair==1 || $fair==2 || $fair==3) $this->db->where_not_in('I.item_code',$items);
			
			$this->db->select('R.school_code , sum(spd.total_point) as point ,  M.school_name ,   F.fest_name , F.fest_id, sdm.sub_district_code, sdm.sub_district_name, rdm.rev_district_code, rdm.rev_district_name, scm.fairName');
			$this->db->from('result_master AS R');
			$this->db->join('school_master AS M','M.school_code = R.school_code');
			$this->db->join('sub_district_master AS sdm','M.sub_district_code = sdm.sub_district_code');
		    $this->db->join('rev_district_master AS rdm','M.rev_district_code = rdm.rev_district_code');
			
			if($this->input->post('radioLabel') != 'exhib'){
				$this->db->join('item_master AS I',"I.item_code = R.item_code AND I.fairId ='$fair'"); 
				$this->db->join('festival_master AS F'," F.fest_id = I.fest_id");
				$this->db->join('science_master AS scm',"scm.fairId= I.fairId AND scm.fairId ='$fair'");				
			}
			else{
			
				$this->db->join('festival_master AS F'," F.fest_id = R.fest_id");
				$this->db->join('science_master AS scm',"scm.fairId= R.fairId AND scm.fairId ='$fair'");	
			}
								
			
			$this->db->join('school_point_details AS spd',"spd.item_code = R.item_code AND spd.is_withheld = 'N' AND spd.school_code = R.school_code AND spd.participant_id = R.participant_id");
			
			if($this->input->post('radioLabel') == 'exhib'){
				$this->db->where('R.item_code = spd.school_code');				
			}
			if($fair!=4 && $fair!=5){
			$this->db->where_in('R.school_code',$schools); }
			$this->db->where_in('R.fairId',$fair);
			$this->db->where_in('R.fest_id',$fest);
			/*$this->db->where("R.grade IN ('A')");
			$this->db->where("R.rank IN ('1')");*/
			$this->db->where("R.is_finish",'Y');
			$this->db->group_by('M.school_code');
			$this->db->order_by('point desc');
			$retvalue=$this->db->get();
			return $retvalue->result_array();
	}
	
	
	function festwise_overallchampions_work_aggr($fair,$fest)
	{
	//echo '<br><br><br>fest==='.$fest.'<br><br><br>';
						
			$this->db->select('R.school_code , sum(spd.total_point) as point ,  M.school_name ,   F.fest_name , F.fest_id, sdm.sub_district_code, sdm.sub_district_name, rdm.rev_district_code, rdm.rev_district_name, scm.fairName');
			$this->db->from('result_master AS R');
			$this->db->join('school_master AS M','M.school_code = R.school_code');
			$this->db->join('sub_district_master AS sdm','M.sub_district_code = sdm.sub_district_code');
		    $this->db->join('rev_district_master AS rdm','M.rev_district_code = rdm.rev_district_code');			
								
			$this->db->join('festival_master AS F'," F.fest_id = R.fest_id");
			$this->db->join('science_master AS scm',"scm.fairId= R.fairId AND scm.fairId ='$fair'");	
			$this->db->join('school_point_details AS spd',"spd.item_code = R.item_code AND spd.is_withheld = 'N' AND spd.school_code = R.school_code AND spd.participant_id = R.participant_id");
			
			$this->db->where_in('R.fairId',$fair);
			$this->db->where_in('R.fest_id',$fest);
			/*$this->db->where("R.grade IN ('A')");
			$this->db->where("R.rank IN ('1')");*/
			$this->db->where("R.is_finish",'Y');
			$this->db->group_by('M.school_code');
			$this->db->order_by('point desc');
			$retvalue=$this->db->get();
			return $retvalue->result_array();
	}
	
	
	
	function festval_status1($fair)
	{
			$this->db->select('count( s.item_code ) AS cnt, f.fest_name, f.fest_id,scm.fairName');
			$this->db->from('ground_item_master AS s');
			$this->db->join('item_master AS m',"s.item_code = m.item_code  AND m.fairId ='$fair'");
			$this->db->join('festival_master AS f',"f.fest_id = m.fest_id");
			$this->db->join('science_master AS scm',"scm.fairId= m.fairId AND scm.fairId ='$fair'");
			$this->db->group_by('f.fest_id');
			$this->db->order_by('f.fest_id');
			$retvalue=$this->db->get();
			return $retvalue->result_array();
	}
	function festival_status2($fair)
	{
			$this->db->where('is_finish','Y');
			$this->db->select('count( DISTINCT P.item_code ) AS pcode, f.fest_name, f.fest_id,scm.fairName');
			$this->db->from('result_master AS P');
			$this->db->join('item_master AS m',"P.item_code = m.item_code  AND m.fairId ='$fair'");
			$this->db->join('festival_master AS f',"f.fest_id = m.fest_id");
			$this->db->join('science_master AS scm',"scm.fairId= m.fairId AND scm.fairId ='$fair'");
			$this->db->group_by('f.fest_id');
			$this->db->order_by('f.fest_id');
			$retvalue=$this->db->get();
			return $retvalue->result_array();
	}
	
	//function festvalzero_status1(){
	//}
	
	function festval_allitems($festid,$fair)
	{
		$this->db->select('m.item_code,date(m.start_time) as ddt, sm.ground_name, m.no_of_participant, t.item_name, t.gender, t.item_type, t.max_time, t.time_type, f.fest_id, f.fest_name,scm.fairName');
		$this->db->from('ground_item_master AS m');
		$this->db->join('item_master AS t',"t.item_code = m.item_code AND t.fest_id = '$festid'  AND t.fairId = '$fair'");
		$this->db->join('ground_master AS sm','sm.ground_id=m.ground_id');
		$this->db->join('festival_master AS f','f.fest_id = t.fest_id');
		$this->db->join('science_master AS scm',"scm.fairId= t.fairId AND scm.fairId ='$fair'");
		$this->db->group_by('m.item_code');
		$this->db->order_by('m.item_code');
		$details	=	$this->db->get();
		return  $details->result_array();
	}
	
	function finished_allitems($festid,$fair)
	{
			$this->db->select('t.item_code, m.item_name,scm.fairName');
			$this->db->from('result_master AS t');
			$this->db->join('item_master AS m',"m.item_code = t.item_code AND m.fairId ='$fair'");
			$this->db->join('science_master AS scm',"scm.fairId= m.fairId AND scm.fairId ='$fair'");
			$this->db->where('m.fest_id',$festid);
			$this->db->where('m.fairId',$fair);
			$this->db->where('t.is_finish','Y');
			$this->db->group_by('t.item_code');
			$this->db->order_by('t.item_code');
			
			$retvalue=$this->db->get();
			return $retvalue->result_array();
	}
	function incomplete_allitems($festid,$fair)
	{
		$this->db->select('s.ground_id,date(s.start_time) as ddt,sm.ground_name,f.fest_name, s.item_code, s.start_time, s.no_of_participant, s.item_time, s.time_type, r.item_code as leftitem, i.item_name,i.item_type,i.max_time,i.time_type,scm.fairName');
		$this->db->from('ground_item_master AS s');
		$this->db->join('item_master AS i',"i.item_code = s.item_code  AND i.fairId ='$fair'");
		$this->db->join('ground_master AS sm',"sm.ground_id=s.ground_id");
		$this->db->join('festival_master AS f',"f.fest_id=i.fest_id");
		$this->db->join('science_master AS scm',"scm.fairId= i.fairId AND scm.fairId ='$fair'");
		$this->db->join('result_master AS r',"r.item_code = s.item_code AND r.is_finish = 'Y' ",'LEFT');
		$this->db->where('f.fest_id',$festid);
		$this->db->group_by('s.item_code');
		$this->db->order_by('s.item_code');
		$retvalue=$this->db->get();
		return $retvalue->result_array();
	}
}

?>
