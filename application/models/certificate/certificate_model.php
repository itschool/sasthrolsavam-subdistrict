<?php
class Certificate_Model extends CI_Model{
	function Certificate_Model(){
		parent::__construct();
	}
	function get_font_array()
	{
		$font_array			=	array('Arial'		=>	'Arial',
									  'courier'		=>	'Courier',
									  'helvetica'	=>	'Helvetica',
									  'times'		=>	'Times',
									  'MTCORSVA'	=>	'MTCORSVA'
									   );
									   
									   
		/*$font_array			=	array('courier'=>'Courier', 'courierB'=>'Courier-Bold', 'courierI'=>'Courier-Oblique', 'courierBI'=>'Courier-BoldOblique',
		'helvetica'=>'Helvetica', 'helveticaB'=>'Helvetica-Bold', 'helveticaI'=>'Helvetica-Oblique', 'helveticaBI'=>'Helvetica-BoldOblique',
		'times'=>'Times-Roman', 'timesB'=>'Times-Bold', 'timesI'=>'Times-Italic', 'timesBI'=>'Times-BoldItalic',
		'symbol'=>'Symbol', 'zapfdingbats'=>'ZapfDingbats');*/							   
									   
		return $font_array; 
	}
	function get_font_size_array()
	{
		$font_size_array		=	array('9'		=>	'9',
									  '10'		=>	'10',
									  '11'		=>	'11',
									  '12'		=>	'12',
									  '13'		=>	'13',
									  '14'		=>	'14',
									  '15'		=>	'15',
									  '16'		=>	'16',
									  '17'		=>	'17',
									  '18'		=>	'18',
									  '19'		=>	'19',
									  '20'		=>	'20',
									  '21'		=>	'21',
									  '22'		=>	'22',
									  '23'		=>	'23',
									  '24'		=>	'24',
									  '25'		=>	'25',
									  '26'		=>	'26',
									  '27'		=>	'27',
									  '28'		=>	'28'									  
									   );
		return $font_size_array;
	}
	function get_line_height_array()
	{
		$font_size_array		=	array('1'	=>	'1',
									  '2'		=>	'2',
									  '3'		=>	'3',
									  '4'		=>	'4',
									  '5'		=>	'5',
									  '6'		=>	'6',
									  '7'		=>	'7',
									  '8'		=>	'8',
									  '9'		=>	'9',
									  '10'		=>	'10',
									  '11'		=>	'11',
									  '12'		=>	'12',
									  '13'		=>	'13',
									  '14'		=>	'14',
									  '15'		=>	'15',
									  '16'		=>	'16',
									  '17'		=>	'17',
									  '18'		=>	'18',
									  '19'		=>	'19',
									  '20'		=>	'20',
									  '21'		=>	'21',
									  '22'		=>	'22',
									  '23'		=>	'23',
									  '24'		=>	'24',
									  '25'		=>	'25',
									  '26'		=>	'26',
									  '27'		=>	'27',
									  '28'		=>	'28',
									  '29'		=>	'29',
									  '30'		=>	'30'									  
									   );
		return $font_size_array;
	}
	function get_certificate_details($fair,$sub_dist_code)
	{
		$this->db->where('sub_district_code',$sub_dist_code);
		//$this->db->where('district_code',$dist_code);
		$this->db->where('fairId',$fair);
		$certificate_template		=	$this->db->get('certificate_template');
		return $certificate_template->result_array();
	}
	
	function save_certificate_details($fair,$sub_dist_code)
	{
		$data					=	array();
		//echo '<br><br><br>'.$fair;
		$data['fair_x']			=	(int)$this->input->post('txtFairX');
		$data['fair_y']			=	(int)$this->input->post('txtFairY');
		$data['fair_font']		=	$this->input->post('cboFairFont');
		$data['fair_size']		=	(int)$this->input->post('cboFairSize');
		
		$data['name_x']			=	(int)$this->input->post('txtNameX');
		$data['name_y']			=	(int)$this->input->post('txtNameY');
		$data['name_font']		=	$this->input->post('cboNameFont');
		$data['name_size']		=	(int)$this->input->post('cboNameSize');
		
		
		$data['item_x']			=	(int)$this->input->post('txtItemX');
		$data['item_y']			=	(int)$this->input->post('txtItemY');
		$data['item_font']		=	$this->input->post('cboItemFont');
		$data['item_size']		=	(int)$this->input->post('cboItemSize');
		
		$data['category_x']		=	(int)$this->input->post('txtCategoryX');
		$data['category_y']		=	(int)$this->input->post('txtCategoryY');
		$data['category_font']	=	$this->input->post('cboCategoryFont');
		$data['category_size']	=	(int)$this->input->post('cboCategorySize');
		
		
		$data['grade_x']		=	(int)$this->input->post('txtGradeX');
		$data['grade_y']		=	(int)$this->input->post('txtGradeY');
		$data['grade_font']		=	$this->input->post('cboGradeFont');
		$data['grade_size']		=	(int)$this->input->post('cboGradeSize');
		
		$data['class_x']		=	(int)$this->input->post('txtClassX');
		$data['class_y']		=	(int)$this->input->post('txtClassY');
		$data['class_font']		=	$this->input->post('cboClassFont');
		$data['class_size']		=	(int)$this->input->post('cboClassSize');
		
		
		$data['school_x']		=	(int)$this->input->post('txtSchoolX');
		$data['school_y']		=	(int)$this->input->post('txtSchoolY');
		$data['school_font']	=	$this->input->post('cboSchoolFont');
		$data['school_size']	=	(int)$this->input->post('cboSchoolSize');
		
		$data['sub_dist_x']		=	(int)@$this->input->post('txtSubdistrictX');
		$data['sub_dist_y']		=	(int)@$this->input->post('txtSubdistrictY');
		$data['sub_dist_font']	=	@$this->input->post('cboSubDistFont');
		$data['sub_dist_size']	=	(int)@$this->input->post('cboSubDistSize');
		
		$data['dist_x']			=	(int)@$this->input->post('txtDistrictX');
		$data['dist_y']			=	(int)@$this->input->post('txtDistrictY');
		$data['dist_font']		=	@$this->input->post('cboDistFont');
		$data['dist_size']		=	(int)@$this->input->post('cboDistSize');
		
		$data['date_x']			=	(int)@$this->input->post('txtDateX');
		$data['date_y']			=	(int)@$this->input->post('txtDateY');
		$data['date_font']		=	@$this->input->post('cboDateFont');
		$data['date_size']		=	(int)@$this->input->post('cboDateSize');
		
		$data['place_x']		=	(int)@$this->input->post('txtPlaceX');
		$data['place_y']		=	(int)@$this->input->post('txtPlaceY');
		$data['place_font']		=	@$this->input->post('cboPlaceFont');
		$data['place_size']		=	(int)@$this->input->post('cboPlaceSize');
		
		$data['ehs_x']			=	(int)@$this->input->post('txtehsX');
		$data['ehs_y']			=	(int)@$this->input->post('txtehsY');
		$data['ehs_font']		=	@$this->input->post('cboehsFont');
		$data['ehs_size']		=	(int)@$this->input->post('cboehsSize');
				
		$data['page_style']		=	$this->input->post('cboPageStyle');
		$data['line_height']	=	$this->input->post('cboLineHeight');
		$data['top_margin']		=	$this->input->post('cboTopMargin');
		$data['left_margin']	=	$this->input->post('cboLeftMargin');
		$data['right_margin']	=	$this->input->post('cboRightMargin');
		$data['type_id']		=	$this->input->post('cboCtType');
		$data['label_print']	=	$this->input->post('cboLabelPrint');
		$this->db->where('sub_district_code',$sub_dist_code);
		//$this->db->where('district_code',$dist_code);
		$this->db->where('fairId',$fair);
		
		$certificate_template		=	$this->db->get('certificate_template');
		if ($certificate_template->num_rows() > 0)
		{
			$this->db->where('sub_district_code',$sub_dist_code);
			//$this->db->where('district_code',$dist_code);
			$this->db->where('fairId',$fair);
			$this->db->update('certificate_template',$data);
		}
		else
		{
			$data['sub_district_code']	=	$sub_dist_code;
			//$data['district_code']		=	$dist_code;
			$data['fairId']	=	$fair;
			$this->db->insert('certificate_template',$data);
		}
	}
	
function get_item_certificate($fairtype,$festtype, $school_code ='')
{
		/*if($fairtype	==	4 && $this->input->post('radioLabel') == 'exhib') {
			$limit	=	$this->exhibition_category($fairtype,$festtype);
		}	*/

		$this->db->select('count( p.participant_id ) AS cpt, p.item_code, i.item_type, 
		i.item_name, f.fest_name,sm.fairName,
		(SELECT COUNT(cm.grade) FROM certificate_master cm WHERE cm.is_withheld="N" AND cm.item_code=p.item_code AND  cm.grade = "A" GROUP BY cm.grade) AS a_grade,
		(SELECT COUNT(cm.grade) FROM certificate_master cm WHERE cm.is_withheld="N" AND cm.item_code=p.item_code AND  cm.grade = "B" GROUP BY cm.grade) AS b_grade,
		(SELECT COUNT(cm.grade) FROM certificate_master cm WHERE cm.is_withheld="N" AND cm.item_code=p.item_code AND  cm.grade = "C" GROUP BY cm.grade) AS c_grade,
		(SELECT count(rm.participant_id) FROM result_master rm WHERE rm.item_code=p.item_code) AS participated_no,
		IF((SELECT count(rm1.item_code) FROM result_master rm1 
		WHERE rm1.item_code=p.item_code ) > 0 ,
		IF((SELECT count(rm1.item_code) FROM result_master rm1 
		WHERE rm1.item_code=p.item_code AND rm1.is_finish ="N"
		) > 0, "No", "Yes"
		),
		"No"
		) AS is_confirmed', FALSE);
		$this->db->from('participant_item_details AS p');
		$this->db->join('item_master AS i','i.item_code = p.item_code');
		$this->db->join('festival_master AS f','f.fest_id = i.fest_id');
		$this->db->join('science_master AS sm','sm.fairId = i.fairId');
		
		$this->db->where('i.fest_id',$festtype);
		$this->db->where('i.fairId',$fairtype);
		
		$this->db->group_by('p.item_code');
		$this->db->having("is_confirmed = 'Yes'");
		$this->db->order_by('p.item_code');
		$getdet		=	$this->db->get();
		return $getdet->result_array();
		
}//get_item_certificate($fairtype,$festtype, $school_code ='')
	
	function is_group_item ($item_code){
			$this->db->select('item_type');
			$this->db->where('item_code', $item_code);
			$item_details	= $this->db->get('item_master');
			$item_details	= $item_details->result_array();
			if (is_array($item_details) && count($item_details)){
				
				return $item_details[0]['item_type'];
			}
			return FALSE;
	}
//	get_captains_details_4participant_certi
function get_captains_details ($item_code, $school_code ='')
{
		/*$certificate_type_cont		=	$this->get_certificate_type_condition();
		if ($certificate_type_cont){
			$this->db->where($certificate_type_cont);
		}*/
		
		$this->db->select('cm.participant_id,p.participant_name');
		$this->db->from('certificate_master cm');
		$this->db->join('participant_item_details AS p', 'cm.item_code=p.item_code AND  p.participant_id=cm.participant_id');
		$this->db->where('cm.item_code', $item_code);
		$this->db->where('cm.is_withheld', 'N');
		$this->db->where('p.is_captain', 'Y');
		$this->db->where('p.is_absent', 0);
		
		if (!empty($school_code)) $this->db->where('cm.school_code', $school_code);
		$this->db->order_by('cm.participant_id', 'ASC');
		$captains		= $this->db->get();
		$captains		= $captains->result_array();
		
		if(isset($captains) && count($captains) > 0){
			$captains_array[0] = 'All Participant';
			
			foreach ($captains as $key=>$captains){
					$captains_array[$captains['participant_id']] = $captains['participant_id'].' - '.$captains['participant_name'];
			}
			return $captains_array;
		}
		return FALSE;
}//get_captains_details ($item_code, $school_code ='')
	
	function get_captains_details_4participant_certi ($item_code, $school_code =''){
			/*$certificate_type_cont		=	$this->get_part_certificate_type_condition();
			if ($certificate_type_cont){
				$this->db->where($certificate_type_cont);
			}*/
			
			$this->db->select('cm.participant_id,p.participant_name');
			$this->db->from('certificate_master cm');
			$this->db->join('participant_item_details AS p', 'cm.item_code=p.item_code AND  p.participant_id=cm.participant_id');
			$this->db->where('cm.item_code', $item_code);
			$this->db->where('cm.is_withheld', 'N');
			$this->db->where('p.is_captain', 'Y');
			$this->db->where('p.is_absent', 0);
			
			if (!empty($school_code)) $this->db->where('cm.school_code', $school_code);
			$this->db->order_by('cm.participant_id', 'ASC');
			$captains		= $this->db->get();
			$captains		= $captains->result_array();//var_dump($captains);
			if(isset($captains) && count($captains) > 0){
				$captains_array[0] = 'All Participant';
				foreach ($captains as $key=>$captains){
						$captains_array[$captains['participant_id']] = $captains['participant_id'].' - '.$captains['participant_name'];
				}
				return $captains_array;
			}
			return FALSE;
	}
	
	function get_certificate_type_condition($fairId){
			$sub_dist_code			=	$this->session->userdata('SUB_DISTRICT');
			//$dist_code				=	$this->session->userdata('DISTRICT');
			$this->db->where('sub_district_code',$sub_dist_code);
			$this->db->where('fairId',$fairId);
			//$this->db->where('district_code',$dist_code);
			$this->db->select('type_id');
			$certificate_type		=	$this->db->get('certificate_template');
			$where					=	'';
			if ($certificate_type->num_rows() > 0){
				$certificate		=	$certificate_type->result_array();
				$type_id			=	$certificate[0]['type_id'];
				//echo '<br><br>---------'.$type_id;
				if ($type_id == 1)
				{
					$where		=	"(cm.grade = 'A')";
				}
				else if ($type_id == 2)
				{
					$where		=	"(cm.grade IN ('A','B'))";
				}
				else if ($type_id == 3)
				{
					$where		=	"(cm.grade IN ('A','B','C'))";
				}
				else if ($type_id == 4)
				{
					$where		=	"cm.rank != 0";
				}
				else if ($type_id == 5)
				{
					$where		=	"(cm.rank < 3 and cm.rank != 0)";
				}
				else if ($type_id == 6)
				{
					$where		=	"(cm.rank = 1)";
				}
				else if ($type_id == 7)
				{
					$where		=	"(cm.rank = 1  and cm.grade = 'A')";
				}
				else if ($type_id == 8)
				{
					//$where		=	"(cm.rank != 0  or cm.grade IN ('A','B','C'))";
					$where		=	"(cm.rank != 0  or cm.grade = 'A')";
				}
			}
			return $where;
		
	}
	
	function get_part_certificate_type_condition($fairId)
	{
			$sub_dist_code			=	$this->session->userdata('SUB_DISTRICT');
			$this->db->where('fairId',$fairId);
			$this->db->where('sub_district_code',$sub_dist_code);
			
			$this->db->select('type_id');
			$certificate_type		=	$this->db->get('participant_certificate_template');
			$where					=	'';
			if ($certificate_type->num_rows() > 0){
				$certificate		=	$certificate_type->result_array();
				$type_id			=	$certificate[0]['type_id'];
				
				 if ($type_id == 1)
				{
					$where		=	"(cm.grade IN ('A','B'))";
				}
				else if ($type_id == 2)
				{
					$where		=	"cm.rank != 0";
				}
				else if ($type_id == 3)
				{
					$where		=	"cm.grade = '' ";
				}
				
				
			}
			return $where;
		
	}
	
	
	function get_participant_details ($item_code, $captain_id, $item_type, $participant_id =''){
			$certificate_type_cont		=	$this->get_certificate_type_condition();
			if ($certificate_type_cont){
				$this->db->where($certificate_type_cont);
			}
			
			$this->db->select('cm.item_code, cm.participant_id, p.participant_name, sm.school_code, sm.school_name, sd.sub_district_name, 
			i.item_name, f.fest_name, p.class, p.gender, cm.grade, cm.is_withheld');
			$this->db->from('certificate_master cm');
			if ('S' == $item_type) $this->db->join('participant_item_details AS p', 'cm.item_code=p.item_code AND p.participant_id=cm.participant_id');
			else if('G' == $item_type) $this->db->join('participant_item_details AS p', 'cm.item_code=p.item_code AND p.admn_no=cm.admn_no');
			$this->db->join('school_master AS sm', 'sm.school_code=p.school_code');
			$this->db->join('sub_district_master AS sd', 'sm.sub_district_code=sd.sub_district_code');
			$this->db->join('item_master AS i', 'i.item_code = p.item_code');
			$this->db->join('festival_master AS f', 'i.fest_id = f.fest_id');
			$this->db->order_by('cm.grade', 'ASC');
			$this->db->where('cm.is_withheld', 'N');
			
			if ('' != $participant_id){
				$this->db->where('p.participant_id', $captain_id);
				$this->db->where('cm.participant_id', $participant_id);
			}
			else{ 
				if ($captain_id != 'all')
				{ 
				if ('S' == $item_type) $this->db->where('cm.participant_id', $captain_id);
				else if('G' == $item_type)
				{
				$this->db->where('p.participant_id', $captain_id);
				}
				}
			}
			$this->db->where('cm.item_code', $item_code);
			$participant_details		= $this->db->get();
			return $participant_details->result_array();
	}
	function initializeTemplate(){
	
		$sub_dist_code			=	$this->session->userdata('SUB_DISTRICT');
		$dist_code				=	$this->session->userdata('DISTRICT');
		$data					=	array();
		
		$data['name_x']			=	0;
		$data['name_y']			=	0;
		
		$data['item_x']			=	0;
		$data['item_y']			=	0;

		$data['category_x']		=	0;
		$data['category_y']		=	0;
		
		$data['grade_x']		=	0;
		$data['grade_y']		=	0;
		
		$data['class_x']		=	0;
		$data['class_y']		=	0;	
		
		$data['school_x']		=	0;
		$data['school_y']		=	0;
	
		$data['sub_dist_x']		=	0;
		$data['sub_dist_y']		=	0;

		$data['dist_x']			=	0;
		$data['dist_y']			=	0;

		
		$data['date_x']			=	0;
		$data['date_y']			=	0;

		
		$data['place_x']		=	0;
		$data['place_y']		=	0;

		$data['ehs_x']			=	0;
		$data['ehs_y']			=	0;

		$this->db->where('sub_district_code',$sub_dist_code);
		$this->db->where('district_code',$dist_code);
		$this->db->update('certificate_template',$data);
		}
		
		
	function get_participant_details_with_id ($participant_id){
			$this->db->select('pid.participant_id,pid.participant_name,pid.fairId,pid.fest_id,sm.school_code, sm.school_name');
			$this->db->from('participant_item_details pid');
			$this->db->join('school_master sm', 'sm.school_code=pid.school_code');
			$this->db->where('pid.participant_id', $participant_id);
			//$this->db->where('pid.is_captain', 'Y');	
			$this->db->where('pid.is_absent', 0);
			/*$this->db->where('pid.codeNo = (SELECT codeNo FROM participant_item_details WHERE participant_id='.$participant_id.' )', NULL, FALSE);
			$this->db->where('pid.prefixCode = (SELECT prefixCode FROM participant_item_details WHERE participant_id='.$participant_id.')', NULL, FALSE);
			$this->db->where('pid.team_no = (SELECT team_no FROM participant_item_details WHERE participant_id='.$participant_id.' )', NULL, FALSE);*/
			
			$this->db->group_by('pid.participant_id');
			$participant_details		= $this->db->get();
			return  $participant_details->result_array();
			
	}//get_participant_details_with_id ($participant_id)
		
	function get_participant_item_details ($participant_id,$schoolcode='',$fairId='',$fest_id=''){
			
			$this->db->select('i.item_code, i.item_name');
			$this->db->from('participant_item_details pid');
			$this->db->join('item_master i', 'i.item_code=pid.item_code');
			$this->db->where('pid.is_absent', 0);
			$this->db->where('pid.is_captain', 'Y');	
			
			$this->db->where('pid.participant_id', $participant_id);
			
			if (!empty($schoolcode) && 0 != $schoolcode)
				$this->db->where('pid.school_code', $schoolcode);
			
			if (!empty($fairId) && 0 != $fairId)
				$this->db->where('pid.fairId', $fairId);
			
			if (!empty($fest_id) && 0 != $fest_id)
				$this->db->where('pid.fest_id', $fest_id);
			
			$this->db->group_by('i.item_code');
			
			/*$this->db->where('pid.codeNo = (SELECT codeNo FROM participant_item_details WHERE participant_id='.$participant_id.' and school_code='.$schoolcode.' and fairId ='.$fairId.' and fest_id ='.$fest_id.')', NULL, FALSE);
			$this->db->where('pid.prefixCode = (SELECT prefixCode FROM participant_item_details WHERE participant_id='.$participant_id.' and school_code='.$schoolcode.' and fairId 	='.$fairId.' and fest_id ='.$fest_id.')', NULL, FALSE);
			
			$this->db->where('pid.team_no = (SELECT team_no FROM participant_item_details WHERE participant_id='.$participant_id.' and school_code='.$schoolcode.' and fairId 	='.$fairId.' and fest_id ='.$fest_id.')', NULL, FALSE);
			$this->db->where('pid.school_code', $schoolcode);
			$this->db->where('pid.fairId', $fairId);
			$this->db->where('pid.fest_id', $fest_id);
			$this->db->group_by('i.item_code');*/
			
			$item_details		= $this->db->get();
			$item_details		= $item_details->result_array();
			$result_array		= array();
			if (is_array($item_details) && count($item_details) > 0)
			{
				$result_array[0]	= 	'All Items';
				foreach ($item_details as $item_details)
				{
					$result_array[$item_details['item_code']]	= 	$item_details['item_name'];
				}
				
				return  $result_array;
			}
			return FALSE;
			
	}//get_participant_item_details ($participant_id) 
	
	function get_school_participant_details ($fair ='', $school_code ='',$festival='', $item_code=0, $captain_id='', $participant_id='',$exb_flag=0)
	{
			$data	=	array();
			
			$certificate_type_cont		=	$this->get_certificate_type_condition($fair);
			if ($certificate_type_cont)
			{
				$this->db->where($certificate_type_cont);
			}
			
			$this->db->select('cm.item_code, cm.participant_id, cm.school_code,cm.grade, cm.is_withheld,cm.rank,rm.is_certificate_printed,rm.fest_id,rm.participant_item_dtls_id');
			$this->db->from('certificate_master cm');
			$this->db->join('result_master rm', 'rm.participant_id=cm.participant_id and rm.item_code=cm.item_code');
			
			if($exb_flag ==1){
					$this->db->where('rm.item_code = rm.school_code');
					if (!empty($school_code) && 0 != $school_code && $school_code!='all')
					{
						$this->db->where('rm.school_code',$school_code);
					}
			}
			else {
					$this->db->join('item_master i', 'i.item_code=cm.item_code');
					$this->db->join('festival_master f', 'f.fest_id=i.fest_id');
					
					if (!empty($school_code) && 0 != $school_code)
					{
						$this->db->where('cm.school_code', $school_code);
					}
					
					if (!empty($item_code) && 0 != $item_code)
					{
						$this->db->where('cm.item_code', $item_code);
					}
					
					if (!empty($fair) && 0 != $fair)
					{
						$this->db->where('i.fairId', $fair);
					}
			}
			
			if (!empty($festival) && 0 != $festival )
			{ 
						$this->db->where('f.fest_id', $festival);
			}
			
			if (!empty($captain_id) && (0 != $captain_id ))
			{
				$this->db->where('cm.participant_id', $captain_id);
			}
			
			$this->db->where('cm.is_withheld', 'N');
			
			$certificate_details		= $this->db->get();
			
			if($certificate_details->num_rows()>0)
			{
				$data['certificate_details']= $certificate_details->result_array();
			
				foreach($data['certificate_details'] as $row)
				{
						$cm_itemcode					=	$row['item_code'];
						$cm_participantid				=	$row['participant_id'];
						$cm_schoolcode					=	$row['school_code'];
						$cm_grade						=	$row['grade'];
						$cm_iswithheld					=	$row['is_withheld'];
						$cm_rank						=	$row['rank'];
						$cm_participant_item_dtls_id	=	$row['participant_item_dtls_id'];
						
						if($row['fest_id']==1)$fest = 'LP';
						else if($row['fest_id']==2)$fest = 'UP';
						else if($row['fest_id']==3)$fest = 'HS';
						else if($row['fest_id']==4)$fest = 'HSS';
						
						if($exb_flag==1)
						{
									$this->db->select('pid.participant_id,pid.pi_id , pid.participant_name,pid.exhibition as item_name,pid.exhibition as fest_name,pid.exhibition as is_teach, sm.school_code, sm.school_name, sd.sub_district_name,
										pid.class, pid.gender,scf.fairName');
									
									$this->db->where('pid.exhibition',2);
									$this->db->where('pid.codeNo = (SELECT codeNo FROM participant_item_details WHERE  pi_id='.$cm_participant_item_dtls_id.' AND school_code='.$cm_schoolcode.')', NULL, FALSE);
									$this->db->where('pid.prefixCode = (SELECT prefixCode FROM participant_item_details WHERE  pi_id='.$cm_participant_item_dtls_id.' AND school_code='.$cm_schoolcode.')', NULL, FALSE);
									$this->db->where('pid.team_no = (SELECT team_no FROM participant_item_details WHERE  pi_id='.$cm_participant_item_dtls_id.' AND school_code='.$cm_schoolcode.')', NULL, FALSE);
						
						}//if($exb_flag==1)
						else {
									$this->db->select('pid.participant_id,pid.pi_id , pid.participant_name, sm.school_code, sm.school_name, sd.sub_district_name,i.item_name,i.is_teach, f.fest_name, pid.class, pid.gender,scf.fairName');
									
									$this->db->join('item_master i', 'i.item_code=pid.item_code');
									$this->db->join('festival_master f', 'f.fest_id=i.fest_id');
									$this->db->where('pid.item_code', $cm_itemcode);
									$this->db->where('pid.codeNo = (SELECT codeNo FROM participant_item_details WHERE item_code='.$cm_itemcode.' AND pi_id='.$cm_participant_item_dtls_id.' AND school_code='.$cm_schoolcode.')', NULL, FALSE);
									$this->db->where('pid.prefixCode = (SELECT prefixCode FROM participant_item_details WHERE item_code='.$cm_itemcode.' AND pi_id='.$cm_participant_item_dtls_id.' AND school_code='.$cm_schoolcode.')', NULL, FALSE);
									$this->db->where('pid.team_no = (SELECT team_no FROM participant_item_details WHERE item_code='.$cm_itemcode.' AND pi_id='.$cm_participant_item_dtls_id.' AND school_code='.$cm_schoolcode.')', NULL, FALSE);
						
						}//ELSE if($exb_flag==1)
						
						$this->db->from('participant_item_details pid');
						$this->db->join('school_master sm', 'sm.school_code=pid.school_code');
						$this->db->join('science_master scf', 'scf.fairId=pid.fairId');
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
						
						$this->db->group_by('pid.pi_id');
						$this->db->order_by('pid.is_captain desc');
						$participant_details			= $this->db->get();
						$data['participant_details'][$cm_participant_item_dtls_id]	= $participant_details->result_array();
						
				}//foreach($data['certificate_details'] as $row)
			}//if($certificate_details->num_rows()>0)
			else{
				$data['certificate_details']= 'nodata';
			}
			
			return $data;
	}
	
function school_details_certificate_wise ()
{
		
		
		$this->db->select('sm.school_name, sm.school_code, 
				COUNT( cm.participant_id ) AS no_participation, 
				COUNT( CASE WHEN cm.grade = "A" THEN cm.grade END ) AS a_grade, 
				COUNT( CASE WHEN cm.grade = "B" THEN cm.grade END ) AS b_grade, 
				COUNT( CASE WHEN cm.grade = "C" THEN cm.grade END ) AS c_grade');
		$this->db->from('school_master AS sm');
		$this->db->join('certificate_master AS cm', 'cm.school_code=sm.school_code');
		$this->db->join('result_master AS rm', 'rm.school_code=cm.school_code');
		
		if ($this->session->userdata('SUB_DISTRICT'))
		{
			$this->db->where('sm.sub_district_code', $this->session->userdata('SUB_DISTRICT'));
		}
		
		if($this->session->userdata('USER_GROUP')=='U'){
			$this->db->where('rm.fairId', $this->session->userdata('FAIR_TYPE'));
		}
		
		$this->db->group_by('cm.school_code');
		$this->db->order_by('sm.school_code', 'ASC');
		
		$result		=	$this->db->get(); 
		return $result->result_array();
		
}//school_details_certificate_wise ()
	
	function get_school_festival_details ($school_code){
			$array = array('fm.fest_id !=' =>0);
			
			$this->db->select('fm.fest_id, fm.fest_name');
			$this->db->from('certificate_master cm');
			$this->db->join('item_master i', 'i.item_code=cm.item_code');
			$this->db->join('festival_master fm', 'fm.fest_id=i.fest_id');
			$this->db->where('cm.is_withheld', 'N');
			$this->db->where('cm.school_code', $school_code);
			$this->db->where($array);
			$this->db->group_by('fm.fest_id');

			$fest_array	= $this->db->get();
			$fest_array	= $fest_array->result_array();
			if (is_array($fest_array) && count($fest_array) > 0)
			{
				$result_array[0]	= 	'All Festival';
				foreach ($fest_array as $fest_array)
				{
					$result_array[$fest_array['fest_id']]	= 	$fest_array['fest_name'];
				}
				
				return  $result_array;
			}
			return FALSE;
	}//get_school_festival_details ($school_code)
	
	
	
	
	
	function get_school_fair_details($school_code){
			
			$this->db->select('sc.fairId, sc.fairName');
			$this->db->from('certificate_master cm');
			$this->db->join('item_master i', 'i.item_code=cm.item_code');
			$this->db->join('science_master sc', 'sc.fairId =i.fairId');
			$this->db->where('cm.is_withheld', 'N');
			$this->db->where('cm.school_code', $school_code);
			$this->db->group_by('sc.fairId');

			$fest_array	= $this->db->get();
			$fest_array	= $fest_array->result_array();
			if (is_array($fest_array) && count($fest_array) > 0)
			{
				//$result_array[0]	= 	'All Fair';
				foreach ($fest_array as $fest_array)
				{
					$result_array[$fest_array['fairId']]	= 	$fest_array['fairName'];
				}
				
				return  $result_array;
			}
			return FALSE;
	}
	
	
	
	function get_school_item_details ($fair,$school_code, $fest_id,$checkvalue=''){
			/*$certificate_type_cont		=	$this->get_certificate_type_condition();
			if ($certificate_type_cont)
			{
				$this->db->where($certificate_type_cont);
			}*/
			$this->db->select('i.item_code, i.item_name');
			$this->db->from('certificate_master cm');
			$this->db->join('item_master i', 'i.item_code=cm.item_code');
			
			if($fair==4){
				if($checkvalue != 'exhib'){
					if (0 != $fest_id) $this->db->where('i.fest_id', $fest_id);
				}
				else{
					$this->db->where('i.fest_id', $fest_id);
				}	
			}
			else{
				if (0 != $fest_id) $this->db->where('i.fest_id', $fest_id);
			}
			
			if (0 != $fair) $this->db->where('i.fairId', $fair);
			$this->db->group_by('i.item_code');
			$this->db->where('cm.is_withheld', 'N');
			$this->db->where('cm.school_code', $school_code);
			$item_array			= $this->db->get();
			$item_array			= $item_array->result_array();
			$item_select_box	= '';
			
			$item_select_box = '<select class="input_box" name="item_code" id="item_code" onChange="javascript:get_school_captains(this.value);" ><option value="0">All Items</option>';
			if (is_array($item_array) && count($item_array) > 0)
			{
				
				foreach ($item_array as $item_array)
				{
					$item_select_box .= '<option value="'.$item_array['item_code'].'">'.$item_array['item_code'].' - '.$item_array['item_name'].'</option>';
				}
			}
				$item_select_box .= '</select>';
				return  $item_select_box;
			return FALSE;
	}
	
function get_group_participants($item_code, $captain_id, $school_code = ''){
		 $this->db->select('pd.participant_id, pd.participant_name');
		 $this->db->from('participant_item_details AS pd');
		  $this->db->where('pd.item_code', $item_code);
		 $this->db->where('pd.is_absent', 0);
		 if (!empty($captain_id) && 0 != $captain_id) 
			$this->db->where('pd.codeNo =(SELECT codeNo FROM participant_item_details WHERE participant_id='.$captain_id.' AND item_code='.$item_code.' GROUP BY participant_id)', NULL, FALSE);
			
		 $this->db->where('pd.item_code', $item_code);
		 if (!empty($school_code)) $this->db->where('pd.school_code', $school_code);
		 $this->db->order_by('pd.participant_id', 'ASC');
		 $captains		= $this->db->get();
		 $captains		= $captains->result_array();
		 if(isset($captains) && count($captains) > 0){
			$participant_select_box = '<select  class="input_box" name="participant_id" id="participant_id" ><option value="0">All Participant</option>';
			foreach ($captains as $key=>$captains){
					$participant_select_box .= '<option value="'.$captains['participant_id'].'">'.$captains['participant_id'].' - '.$captains['participant_name'].'</option>';
			}
			$participant_select_box .= '</select>';
			return $participant_select_box;
		}
		return FALSE;
	}

function attended_school_details_certificate_wise(){

			if ($this->session->userdata('SUB_DISTRICT'))
			{
				$this->db->where('sm.sub_district_code', $this->session->userdata('SUB_DISTRICT'));
			}
			$this->db->select('sm.school_name, sm.school_code, 
					(SELECT SUM(spd.point) FROM school_point_details spd WHERE spd.school_code=pid.school_code)  AS total_point, 
					(SELECT COUNT(pid1.participant_id) FROM participant_item_details pid1 WHERE pid1.school_code=sm.school_code GROUP BY pid1.school_code ) as no_participation', FALSE);
			$this->db->from('school_master AS sm');
			$this->db->join('participant_item_details AS pid', 'pid.school_code=sm.school_code');
			$this->db->order_by('sm.school_code', 'ASC');
			$this->db->group_by('pid.school_code');
			$result		=	$this->db->get(); 
			return $result->result_array();
}

function get_attended_school_item_details($fair,$school_code='', $fest_id){
			$this->db->select('i.item_code, i.item_name');
			$this->db->from('participant_item_details pid');
			$this->db->join('item_master i', 'i.item_code=pid.item_code');
			if (0 != $fest_id) $this->db->where('i.fest_id', $fest_id);
			if (0 != $fair) $this->db->where('i.fairId', $fair);
			$this->db->group_by('i.item_code');
			$this->db->where('pid.school_code', $school_code);
			$item_array			= $this->db->get();
			$item_array			= $item_array->result_array();
			$item_select_box	= '';
			if (is_array($item_array) && count($item_array) > 0)
			{
				$item_select_box = '<select class="input_box" name="item_code" id="item_code" onChange="javascript:get_attended_school_captains(this.value);" ><option value="0">All Items</option>';
				foreach ($item_array as $item_array)
				{
					$item_select_box .= '<option value="'.$item_array['item_code'].'">'.$item_array['item_code'].' - '.$item_array['item_name'].'</option>';
				}
				$item_select_box .= '</select>';
				return  $item_select_box;
			}
			return FALSE;
	}


function get_attended_school_fair_details($school_code){
			$this->db->select('sc.fairId, sc.fairName');
			$this->db->from('participant_item_details pid');
			$this->db->join('item_master i', 'i.item_code=pid.item_code');
			$this->db->join('science_master sc', 'sc.fairId =i.fairId');
			$this->db->where('pid.school_code', $school_code);
			$this->db->group_by('sc.fairId');

			$fest_array	= $this->db->get();
			$fest_array	= $fest_array->result_array();
			if (is_array($fest_array) && count($fest_array) > 0)
			{
				$result_array[0]	= 	'All Fair';
				foreach ($fest_array as $fest_array)
				{
					$result_array[$fest_array['fairId']]	= 	$fest_array['fairName'];
				}
				
				return  $result_array;
			}
			return FALSE;
	}

function get_attended_school_festival_details($school_code){
			$array = array('fm.fest_id !=' =>0);
			$this->db->select('fm.fest_id, fm.fest_name');
			$this->db->from('participant_item_details pid');
			$this->db->join('item_master i', 'i.item_code=pid.item_code');
			$this->db->join('festival_master fm', 'fm.fest_id=i.fest_id');
			$this->db->where('pid.school_code', $school_code);
			$this->db->where($array);
			$this->db->group_by('fm.fest_id');

			$fest_array	= $this->db->get();
			$fest_array	= $fest_array->result_array();
			if (is_array($fest_array) && count($fest_array) > 0)
			{
				$result_array[0]	= 	'All Festival';
				foreach ($fest_array as $fest_array)
				{
					$result_array[$fest_array['fest_id']]	= 	$fest_array['fest_name'];
				}
				
				return  $result_array;
			}
			return FALSE;
	}
		
	
function get_attended_school_participant_details ($fair ='', $school_code ='',$festival='', $item_code='', $captain_id='', $participant_id='',$exb_flag=0)
{
		$data	=	array();
		
		$certificate_type_cont		=	$this->get_attended_certificate_type_condition($fair);
		if ($certificate_type_cont)
		{
			$this->db->where($certificate_type_cont);
		}
		
		$this->db->select('cm.item_code, cm.participant_id, cm.school_code,cm.grade, cm.is_withheld,cm.rank,rm.is_certificate_printed,rm.fest_id,rm.participant_item_dtls_id');
		$this->db->from('certificate_master cm');
		$this->db->join('result_master rm', 'rm.participant_id=cm.participant_id and rm.item_code=cm.item_code');
		
		if($exb_flag ==1){
				$this->db->where('rm.item_code = rm.school_code');
				if (!empty($school_code) && 0 != $school_code && $school_code!='all')
				{
					$this->db->where('rm.school_code',$school_code);
				}
		}//if($exb_flag ==1)
		else {
				$this->db->join('item_master i', 'i.item_code=cm.item_code');
				$this->db->join('festival_master f', 'f.fest_id=i.fest_id');
				
				if (!empty($school_code) && 0 != $school_code)
				{
					$this->db->where('cm.school_code', $school_code);
				}
				if (!empty($item_code) && 0 != $item_code)
				{
					$this->db->where('cm.item_code', $item_code);
				}
				if (!empty($fair) && 0 != $fair)
				{
					$this->db->where('i.fairId', $fair);
				}
		}//if($exb_flag ==1) ELSE
		
		if (!empty($festival) && 0 != $festival )
		{ 
					$this->db->where('f.fest_id', $festival);
		}
		
		if (!empty($captain_id) && (0 != $captain_id ))
		{
			$this->db->where('cm.participant_id', $captain_id);
		}
		
		$this->db->where('cm.is_withheld', 'N');
		
		$certificate_details		= $this->db->get();
		
		if($certificate_details->num_rows()>0)
		{
			$data['certificate_details']= $certificate_details->result_array();
		
			foreach($data['certificate_details'] as $row)
			{
					$cm_itemcode					=	$row['item_code'];
					$cm_participantid				=	$row['participant_id'];
					$cm_schoolcode					=	$row['school_code'];
					$cm_grade						=	$row['grade'];
					$cm_iswithheld					=	$row['is_withheld'];
					$cm_rank						=	$row['rank'];
					$cm_participant_item_dtls_id	=	$row['participant_item_dtls_id'];
					
					if($row['fest_id']==1)$fest = 'LP';
					else if($row['fest_id']==2)$fest = 'UP';
					else if($row['fest_id']==3)$fest = 'HS';
					else if($row['fest_id']==4)$fest = 'HSS';
					
					if($exb_flag==1)
					{
								$this->db->select('pid.participant_id,pid.pi_id , pid.participant_name,pid.exhibition as item_name,pid.exhibition as fest_name,pid.exhibition as is_teach, sm.school_code, sm.school_name, sd.sub_district_name,
									pid.class, pid.gender,scf.fairName');
								
								$this->db->where('pid.exhibition',2);
								$this->db->where('pid.codeNo = (SELECT codeNo FROM participant_item_details WHERE  pi_id='.$cm_participant_item_dtls_id.' AND school_code='.$cm_schoolcode.')', NULL, FALSE);
								$this->db->where('pid.prefixCode = (SELECT prefixCode FROM participant_item_details WHERE  pi_id='.$cm_participant_item_dtls_id.' AND school_code='.$cm_schoolcode.')', NULL, FALSE);
								$this->db->where('pid.team_no = (SELECT team_no FROM participant_item_details WHERE  pi_id='.$cm_participant_item_dtls_id.' AND school_code='.$cm_schoolcode.')', NULL, FALSE);
					
					}//if($exb_flag==1)
					else {
								$this->db->select('pid.participant_id,pid.pi_id , pid.participant_name, sm.school_code, sm.school_name, sd.sub_district_name,i.item_name,i.is_teach, f.fest_name, pid.class, pid.gender,scf.fairName');
								
								$this->db->join('item_master i', 'i.item_code=pid.item_code');
								$this->db->join('festival_master f', 'f.fest_id=i.fest_id');
								$this->db->where('pid.item_code', $cm_itemcode);
								$this->db->where('pid.codeNo = (SELECT codeNo FROM participant_item_details WHERE item_code='.$cm_itemcode.' AND pi_id='.$cm_participant_item_dtls_id.' AND school_code='.$cm_schoolcode.')', NULL, FALSE);
								$this->db->where('pid.prefixCode = (SELECT prefixCode FROM participant_item_details WHERE item_code='.$cm_itemcode.' AND pi_id='.$cm_participant_item_dtls_id.' AND school_code='.$cm_schoolcode.')', NULL, FALSE);
								$this->db->where('pid.team_no = (SELECT team_no FROM participant_item_details WHERE item_code='.$cm_itemcode.' AND pi_id='.$cm_participant_item_dtls_id.' AND school_code='.$cm_schoolcode.')', NULL, FALSE);
					
					}//ELSE if($exb_flag==1)
					
					$this->db->from('participant_item_details pid');
					$this->db->join('school_master sm', 'sm.school_code=pid.school_code');
					$this->db->join('science_master scf', 'scf.fairId=pid.fairId');
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
					
					$this->db->group_by('pid.pi_id');
					$this->db->order_by('pid.is_captain desc');
					$participant_details			= $this->db->get();
					$data['participant_details'][$cm_participant_item_dtls_id]	= $participant_details->result_array();
					
			}//foreach($data['certificate_details'] as $row)
		}//if($certificate_details->num_rows()>0)
		else{
			$data['certificate_details']= 'nodata';
		}
		
		return $data;
}//get_attended_school_participant_details ($fair ='', $school_code ='',$festival='', $item_code='', $captain_id='', $participant_id='',$exhib_flag=0)



	
/*function get_attended_participant_details_with_id ($participant_id){
			/*$whereisnull	=	"(ctm.participant_id) is null";
			$certificate_type_cont		=	$this->get_certificate_type_condition();
			if ($certificate_type_cont)
			{
			$this->db->where($certificate_type_cont);
			}
			$this->db->select('cm.participant_id, pd.participant_name,pd.fairId, sm.school_code, sm.school_name');
			$this->db->from('result_master cm');
			$this->db->join('certificate_master ctm', 'ctm.participant_id=cm.participant_id','LEFT');
			$this->db->join('participant_item_details pd', 'pd.participant_id=cm.participant_id');
			$this->db->join('school_master sm', 'sm.school_code=cm.school_code');
			$this->db->where($whereisnull);
			$this->db->where('cm.participant_id', $participant_id);
			$this->db->group_by('cm.participant_id');
			$participant_details		= $this->db->get();
			return $participant_details->result_array();
			
			
			$this->db->select('pid.participant_id,pid.participant_name,pid.fairId,pid.fest_id,sm.school_code, sm.school_name');
			$this->db->from('participant_item_details pid');
			$this->db->join('school_master sm', 'sm.school_code=pid.school_code');
			$this->db->where('pid.is_captain', 'Y');	
			$this->db->where('pid.is_absent', 0);
			$this->db->where('pid.codeNo = (SELECT codeNo FROM participant_item_details WHERE participant_id='.$participant_id.' )', NULL, FALSE);
			$this->db->where('pid.prefixCode = (SELECT prefixCode FROM participant_item_details WHERE participant_id='.$participant_id.')', NULL, FALSE);
			$this->db->where('pid.team_no = (SELECT team_no FROM participant_item_details WHERE participant_id='.$participant_id.' )', NULL, FALSE);
			
			$this->db->group_by('pid.participant_id');
			$participant_details		= $this->db->get();
			return  $participant_details->result_array();*/
			
			
			
	//}//get_participant_details_with_id ($participant_id)*/	
	
	
	function get_attended_participant_item_details ($participant_id){
			$whereisnull	=	"(ctm.participant_id) is null";
			$certificate_type_cont		=	$this->get_certificate_type_condition();
			if ($certificate_type_cont)
			{
				$this->db->where($certificate_type_cont);
			}
			$this->db->select('i.item_code, i.item_name');
			$this->db->from('result_master cm');
			$this->db->join('certificate_master ctm', 'ctm.participant_id=cm.participant_id','LEFT');
			$this->db->join('item_master i', 'i.item_code=cm.item_code');
			$this->db->where($whereisnull);
			$this->db->where('cm.participant_id', $participant_id);
			$item_details		= $this->db->get();
			$item_details		= $item_details->result_array();
			$result_array		= array();
			if (is_array($item_details) && count($item_details) > 0)
			{
				$result_array[0]	= 	'All Items';
				foreach ($item_details as $item_details)
				{
					$result_array[$item_details['item_code']]	= 	$item_details['item_name'];
				}
				
				return  $result_array;
			}
			return FALSE;
	}//get_participant_item_details ($participant_id)
	
	function get_attended_item_certificate($fairtype,$festtype, $school_code =''){
			$this->db->select('count( p.participant_id ) AS cpt, p.item_code, i.item_type, 
			i.item_name, f.fest_name,(SELECT COUNT(p1.participant_id) FROM participant_item_details p1 WHERE p1.item_code=p.item_code and is_absent=0) AS participated_no', FALSE);
			$this->db->from('participant_item_details p');
			$this->db->join('item_master AS i','i.item_code = p.item_code');
			$this->db->join('festival_master AS f','f.fest_id = i.fest_id');
			
			if ('' == $school_code){ 
			if($festtype!='All'){
				$this->db->where('i.fest_id',$festtype);
			}
			$this->db->where('i.fairId',$fairtype);
			}
			$this->db->group_by('p.item_code');
			$this->db->order_by('p.item_code');
			$getdet		=	$this->db->get();
			return $getdet->result_array();
	}
	
	function get_attended_captains_details($item_code, $school_code =''){
			$this->db->select('p.participant_id, p.participant_name');
			$this->db->from('participant_item_details p');
			$this->db->where('p.item_code', $item_code);
			$this->db->where('p.is_absent', 0);
			$this->db->where('p.is_captain', 'Y');
			
			if (!empty($school_code)) $this->db->where('p.school_code', $school_code);
			$this->db->order_by('p.participant_id', 'ASC');
			$captains		= $this->db->get();
			$captains		= $captains->result_array();
			if(isset($captains) && count($captains) > 0){
				$captains_array[0] = 'All Participant';
				foreach ($captains as $key=>$captains){
						$captains_array[$captains['participant_id']] = $captains['participant_id'].' - '.$captains['participant_name'];
				}
				return $captains_array;
			}
			return FALSE;
	}
	
	
function get_participant_certificate_details($dist_code,$sub_dist_code,$fair){

		$this->db->where('sub_district_code',$sub_dist_code);
		$this->db->where('district_code',$dist_code);
		$this->db->where('fairId',$fair);
		$certificate_template		=	$this->db->get('participant_certificate_template');
		return $certificate_template->result_array();
}	
	
function save_participant_certificate_details($dist_code,$sub_dist_code,$fair){
		$data					=	array();
		
		//echo '<br><br><br>------------->'.$fair;
		$data['fair_x']			=	(int)$this->input->post('txtFairX');
		$data['fair_y']			=	(int)$this->input->post('txtFairY');
		$data['fair_font']		=	$this->input->post('cboFairFont');
		$data['fair_size']		=	(int)$this->input->post('cboFairSize');
			
		$data['name_x']			=	(int)$this->input->post('txtNameX');
		$data['name_y']			=	(int)$this->input->post('txtNameY');
		$data['name_font']		=	$this->input->post('cboNameFont');
		$data['name_size']		=	(int)$this->input->post('cboNameSize');
		
		$data['item_x']			=	(int)$this->input->post('txtItemX');
		$data['item_y']			=	(int)$this->input->post('txtItemY');
		$data['item_font']		=	$this->input->post('cboItemFont');
		$data['item_size']		=	(int)$this->input->post('cboItemSize');
		
		$data['category_x']		=	(int)$this->input->post('txtCategoryX');
		$data['category_y']		=	(int)$this->input->post('txtCategoryY');
		$data['category_font']	=	$this->input->post('cboCategoryFont');
		$data['category_size']	=	(int)$this->input->post('cboCategorySize');
		
		
		$data['grade_x']		=	(int)$this->input->post('txtGradeX');
		$data['grade_y']		=	(int)$this->input->post('txtGradeY');
		$data['grade_font']		=	$this->input->post('cboGradeFont');
		$data['grade_size']		=	(int)$this->input->post('cboGradeSize');
		
		$data['class_x']		=	(int)$this->input->post('txtClassX');
		$data['class_y']		=	(int)$this->input->post('txtClassY');
		$data['class_font']		=	$this->input->post('cboClassFont');
		$data['class_size']		=	(int)$this->input->post('cboClassSize');
		
		
		$data['school_x']		=	(int)$this->input->post('txtSchoolX');
		$data['school_y']		=	(int)$this->input->post('txtSchoolY');
		$data['school_font']	=	$this->input->post('cboSchoolFont');
		$data['school_size']	=	(int)$this->input->post('cboSchoolSize');
		
		$data['sub_dist_x']		=	(int)@$this->input->post('txtSubdistrictX');
		$data['sub_dist_y']		=	(int)@$this->input->post('txtSubdistrictY');
		$data['sub_dist_font']	=	@$this->input->post('cboSubDistFont');
		$data['sub_dist_size']	=	(int)@$this->input->post('cboSubDistSize');
		
		$data['dist_x']			=	(int)@$this->input->post('txtDistrictX');
		$data['dist_y']			=	(int)@$this->input->post('txtDistrictY');
		$data['dist_font']		=	@$this->input->post('cboDistFont');
		$data['dist_size']		=	(int)@$this->input->post('cboDistSize');
		
		$data['date_x']			=	(int)@$this->input->post('txtDateX');
		$data['date_y']			=	(int)@$this->input->post('txtDateY');
		$data['date_font']		=	@$this->input->post('cboDateFont');
		$data['date_size']		=	(int)@$this->input->post('cboDateSize');
		
		$data['place_x']		=	(int)@$this->input->post('txtPlaceX');
		$data['place_y']		=	(int)@$this->input->post('txtPlaceY');
		$data['place_font']		=	@$this->input->post('cboPlaceFont');
		$data['place_size']		=	(int)@$this->input->post('cboPlaceSize');
		
		/*$data['ehs_x']			=	(int)@$this->input->post('txtehsX');
		$data['ehs_y']			=	(int)@$this->input->post('txtehsY');
		$data['ehs_font']		=	@$this->input->post('cboehsFont');
		$data['ehs_size']		=	(int)@$this->input->post('cboehsSize');*/
			
		$data['page_style']		=	$this->input->post('cboPageStyle');
		$data['line_height']	=	$this->input->post('cboLineHeight');
		$data['top_margin']		=	$this->input->post('cboTopMargin');
		$data['left_margin']	=	$this->input->post('cboLeftMargin');
		$data['right_margin']	=	$this->input->post('cboRightMargin');
		$data['type_id']		=	$this->input->post('cboCtType');
		$data['label_print']	=	$this->input->post('cboLabelPrint');
		
		$this->db->where('sub_district_code',$sub_dist_code);
		$this->db->where('fairId',$fair);
		
		$certificate_template		=	$this->db->get('participant_certificate_template');
		if ($certificate_template->num_rows() > 0)
		{
			$this->db->where('sub_district_code',$sub_dist_code);
			$this->db->where('fairId',$fair);
			$this->db->update('participant_certificate_template',$data);
		}
		else
		{
			$data['fairId']				=	$fair;
			$data['sub_district_code']	=	$sub_dist_code;
			$data['district_code']		=	$dist_code;
			$this->db->insert('participant_certificate_template',$data);
		}
}	
	
function get_certificate_type($dist_code,$sub_dist_code){
$this->db->select('type_id');
$this->db->where('district_code',$dist_code);
$this->db->where('sub_district_code',$sub_dist_code);
$result		=	$this->db->get('certificate_template');
return $result->result_array();
}	
	

function get_attended_certificate_type_condition($fair){

			$sub_dist_code			=	$this->session->userdata('SUB_DISTRICT');
			
			$this->db->where('sub_district_code',$sub_dist_code);
			$this->db->where('fairId',$fair);
			$this->db->select('type_id');
			$certificate_type		=	$this->db->get('participant_certificate_template');
			$where					=	'';
			if ($certificate_type->num_rows() > 0){
				$certificate		=	$certificate_type->result_array();
				$type_id			=	$certificate[0]['type_id'];
				
				if ($type_id == 1)
				{
					$where		=	"(cm.grade IN ('A','B'))";
				}
				else if ($type_id == 2)
				{
					$where		=	"(cm.grade IN ('A','B','C'))";
				}
				else if ($type_id == 3)
				{
					$where		=	"cm.grade = ''";
				}
				
			}
			return $where;
		
	
}



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
		//return $limit;		
	}


function get_exhibition_school($fest){
		 if ($this->session->userdata('SUB_DISTRICT'))
			{
				$this->db->where('sm.sub_district_code', $this->session->userdata('SUB_DISTRICT'));
			}
			$this->db->select('sm.school_name, sm.school_code, 
					(SELECT SUM(spd.point) FROM school_point_details spd WHERE spd.school_code=cm.school_code)  AS total_point, 
					(SELECT COUNT(rm.participant_id) FROM result_master rm WHERE rm.school_code=sm.school_code GROUP BY rm.school_code ) as no_participation, 
					
					(SELECT COUNT(cm1.grade) FROM certificate_master cm1 WHERE cm1.school_code=cm.school_code AND cm1.item_code=cm.school_code  AND 
					is_withheld = "N" AND  cm1.grade = "A" GROUP BY cm.item_code) AS a_grade,
					
					(SELECT COUNT(cm1.grade) FROM certificate_master cm1 WHERE cm1.school_code=cm.school_code AND cm1.item_code=cm.school_code  AND is_withheld = "N"   AND cm1.grade = "B" GROUP BY cm.item_code) AS b_grade,
					(SELECT COUNT(cm1.grade) FROM certificate_master cm1 WHERE cm1.school_code=cm.school_code AND cm1.item_code=cm.school_code AND  is_withheld = "N" AND cm1.grade = "C" GROUP BY cm.item_code) AS c_grade', FALSE);
			$this->db->from('school_master AS sm');
			$this->db->join('certificate_master AS cm', 'cm.school_code=sm.school_code');
			$this->db->join('result_master AS rm', 'rm.school_code=cm.school_code and rm.item_code=cm.school_code');
			$this->db->where('rm.fest_id',$fest);
			$this->db->order_by('sm.school_code', 'ASC');
			$this->db->group_by('cm.school_code');
			$result		=	$this->db->get(); 
			return $result->result_array();
}

function get_exhibition_captains($schoolcode){
		$this->db->select('p.participant_id, p.participant_name');
		$this->db->from('participant_item_details p');
		$this->db->where('p.fairId', 4);
		$this->db->where('p.fest_id', 0);
		$this->db->where('p.school_code', $schoolcode);
		$this->db->where('p.is_absent', 0);
		$this->db->where('p.is_captain', 'Y');
		$this->db->order_by('p.participant_id', 'ASC');
		
		$captains		= $this->db->get();
		$captains		= $captains->result_array();
		if(isset($captains) && count($captains) > 0){
		$captains_array[0] = 'All Participant';
		foreach ($captains as $key=>$captains){
		$captains_array[$captains['participant_id']] = $captains['participant_id'].' - '.$captains['participant_name'];
		}
		return $captains_array;
		}
		return FALSE;
}

function get_exhibition_group_participants($captain_id,$school_code){
		$this->db->select('pd.participant_id, pd.participant_name');
		$this->db->from('participant_item_details AS pd');
		$this->db->where('pd.fairId', 4);
		$this->db->where('pd.fest_id', 0);
		$this->db->where('pd.is_absent', 0);
		
		if (!empty($captain_id) && 0 != $captain_id) 
			$this->db->where('pd.codeNo =(SELECT codeNo FROM participant_item_details WHERE participant_id='.$captain_id.'  GROUP BY participant_id)', NULL, FALSE);
			$this->db->where('pd.prefixCode =(SELECT prefixCode FROM participant_item_details WHERE participant_id='.$captain_id.'  GROUP BY participant_id)', NULL, FALSE);
			$this->db->where('pd.team_no =(SELECT team_no FROM participant_item_details WHERE participant_id='.$captain_id.'  GROUP BY participant_id)', NULL, FALSE);
		
		//$this->db->where('pd.item_code', $item_code);
		
		if (!empty($school_code)) $this->db->where('pd.school_code', $school_code);
			$this->db->order_by('pd.participant_id', 'ASC');
			
		$captains		= $this->db->get();
		$captains		= $captains->result_array();var_dump($captains->result_array());
		if(isset($captains) && count($captains) > 0){
			$participant_select_box = '<select  class="input_box" name="participant_id" id="participant_id" ><option value="0">All Participant</option>';
			
		foreach ($captains as $key=>$captains){
		$participant_select_box .= '<option value="'.$captains['participant_id'].'">'.$captains['participant_id'].' - '.$captains['participant_name'].'</option>';
		}
		$participant_select_box .= '</select>';
		return $participant_select_box;
		}
		return FALSE;
}


function create_fieldname_templateTable(){
		$certfct		= $this->db->query("SHOW FIELDS  FROM certificate_template;");
		$certfct_result	=	$certfct->result_array();
		
		$partcertfct		= $this->db->query("SHOW FIELDS  FROM participant_certificate_template;");
		$partcertfct_result	=	$partcertfct->result_array();
		
		$f1=$f2=0;
		foreach($certfct_result as $fieldrow){
				$fieldname	=	$fieldrow['Field'];
				
				if($fieldname=='fair_x' || $fieldname=='fair_y' || $fieldname=='fair_font' || $fieldname=='fair_size'){
					$f1=1;
					break;
				}
		}//foreach($certfct_result as $fieldrow)
		
		if($f1==0){
			$this->db->query("ALTER TABLE `certificate_template`  ADD `fair_x` SMALLINT(6) NOT NULL AFTER `district_code`,  ADD `fair_y` SMALLINT(6) NOT NULL AFTER `fair_x`,  ADD `fair_font` VARCHAR(55) NOT NULL AFTER `fair_y`,  ADD `fair_size` SMALLINT(6) NOT NULL AFTER `fair_font`
");
		}
		
		foreach($partcertfct_result as $fieldrow1){
				$fieldname1	=	$fieldrow1['Field'];
				
				if($fieldname1=='fair_x' || $fieldname1=='fair_y' || $fieldname1=='fair_font' || $fieldname1=='fair_size'){
					$f2=1;
					break;
				}
		}//foreach($partcertfct_result as $fieldrow1)
		
		if($f2==0){
			$this->db->query("ALTER TABLE `participant_certificate_template`  ADD `fair_x` SMALLINT(6) NOT NULL AFTER `district_code`,  ADD `fair_y` SMALLINT(6) NOT NULL AFTER `fair_x`,  ADD `fair_font` VARCHAR(55) NOT NULL AFTER `fair_y`,  ADD `fair_size` SMALLINT(6) NOT NULL AFTER `fair_font`
");
		}
		
}//create_fieldname_templateTable()


function get_attended_certificate_details($fair,$sub_dist_code)
	{
		$this->db->where('sub_district_code',$sub_dist_code);
		$this->db->where('fairId',$fair);
		
		$certificate_template		=	$this->db->get('participant_certificate_template');
		return $certificate_template->result_array();
	}


function get_attended_exhibition_school_participant_details($fair ='', $school_code ='',$festival='', $item_code=0, $captain_id='', $participant_id=''){
			$data	=	array();
			
			$certificate_type_cont		=	$this->get_attended_certificate_type_condition($fair);
			if ($certificate_type_cont)
			{
				$this->db->where($certificate_type_cont);
			}
			
			$this->db->select('cm.participant_id, pid.school_code,cm.grade, cm.is_withheld,cm.rank,rm.is_certificate_printed,rm.fest_id,rm.participant_item_dtls_id,rm.participant_item_dtls_id');
			$this->db->from('certificate_master cm');
			$this->db->join('result_master rm', 'rm.participant_id=cm.participant_id');
			$this->db->join('participant_item_details pid', 'pid.pi_id =rm.participant_item_dtls_id');
			$this->db->where('cm.is_withheld', 'N');
			$this->db->where('rm.item_code = rm.school_code');
			
			if (!empty($school_code) && 0 != $school_code && $school_code!='all')
			{
				$this->db->where('cm.school_code', $school_code);
			}
			$this->db->where('cm.item_code = rm.school_code');
			$certificate_details		= $this->db->get();

			if($certificate_details->num_rows()>0){
			$data['certificate_details']= $certificate_details->result_array();
			
				foreach($data['certificate_details'] as $row){
						$cm_participantid		=	$row['participant_id'];
						$cm_schoolcode			=	$row['school_code'];
						$cm_grade				=	$row['grade'];
						$cm_iswithheld			=	$row['is_withheld'];
						$cm_rank				=	$row['rank'];
						$participant_item_dtls_id	=	$row['participant_item_dtls_id'];
						
						if($row['fest_id']==1)$fest = 'LP';
						else if($row['fest_id']==2)$festival = 'UP';
						else if($row['fest_id']==3)$festival = 'HS';
						else if($row['fest_id']==4)$festival = 'HSS';
						
						$this->db->select('pid.participant_id, pid.participant_name,pid.exhibition as item_name,pid.exhibition as fest_name,pid.exhibition as is_teach, sm.school_code, sm.school_name, sd.sub_district_name,
							pid.class, pid.gender,scf.fairName');
						
						$this->db->where('pid.exhibition',2);
						$this->db->where('pid.codeNo = (SELECT codeNo FROM participant_item_details WHERE  pi_id='.$participant_item_dtls_id.' AND school_code='.$cm_schoolcode.')', NULL, FALSE);
						$this->db->where('pid.prefixCode = (SELECT prefixCode FROM participant_item_details WHERE  pi_id='.$participant_item_dtls_id.' AND school_code='.$cm_schoolcode.')', NULL, FALSE);
						$this->db->where('pid.team_no = (SELECT team_no FROM participant_item_details WHERE  pi_id='.$participant_item_dtls_id.' AND school_code='.$cm_schoolcode.')', NULL, FALSE);

						$this->db->from('participant_item_details pid');
						$this->db->join('school_master sm', 'sm.school_code=pid.school_code');
						$this->db->join('science_master scf', 'scf.fairId=pid.fairId');
						$this->db->join('sub_district_master AS sd', 'sm.sub_district_code=sd.sub_district_code');
						
						$this->db->where('pid.is_absent', 0);
						
						if (!empty($cm_schoolcode) && 0 != $cm_schoolcode)
						{
							$this->db->where('pid.school_code', $cm_schoolcode);
						}
						$this->db->group_by('pid.participant_id');
						$this->db->order_by('pid.is_captain desc');
						$participant_details			= $this->db->get();
						$data['participant_details'][$participant_item_dtls_id]	= $participant_details->result_array();
				}
				
			}
			else{
				$data['certificate_details']= 'nodata';
			}	
			
			return $data;
	}


function get_captan_with_id($participant_id,$schoolcode,$item)
{
		 $this->db->select('cm.participant_id');	
		 $this->db->from('participant_item_details pid');
		 $this->db->join('certificate_master cm', 'cm.participant_id=pid.participant_id and cm.school_code=pid.school_code');
		 $this->db->where('pid.codeNo = (SELECT codeNo FROM participant_item_details WHERE  item_code ='.$item.' AND participant_id='.$participant_id.' AND school_code='.$schoolcode.' group by participant_id)', NULL, FALSE);
		 $this->db->where('pid.prefixCode = (SELECT prefixCode FROM participant_item_details WHERE  item_code ='.$item.' AND participant_id='.$participant_id.' AND participant_id='.$participant_id.' AND school_code='.$schoolcode.' group by participant_id)', NULL, FALSE);
		 $this->db->where('pid.team_no = (SELECT team_no FROM participant_item_details WHERE  item_code ='.$item.' AND participant_id='.$participant_id.' AND participant_id='.$participant_id.' AND school_code='.$schoolcode.' group by participant_id)', NULL, FALSE);
		
		$this->db->where('cm.school_code',$schoolcode);						
		$this->db->where('pid.exhibition',0);	
		$this->db->where('pid.item_code',$item);	
		//$this->db->group_by('pid.participant_id');
		$participant_details			= $this->db->get();	
		//echo $participant_details->num_rows();
		if($participant_details->num_rows()>0)
				return $participant_details->result_array();
		else
				return 'nodata';	
}//get_captan_with_id($participant_id,$participant_details)	

function get_participant_item($participant_id,$schoolcode='',$fairId='',$fest_id=''){
			 $this->db->select('i.item_code, i.item_name');
			$this->db->from('participant_item_details pid');
			$this->db->join('item_master i', 'i.item_code=pid.item_code');
			$this->db->where('pid.is_absent', 0);
			//$this->db->where('pid.is_captain', 'Y');	
						
			$this->db->where('pid.participant_id', $participant_id);
			
			if (!empty($schoolcode) && 0 != $schoolcode)
				$this->db->where('pid.school_code', $schoolcode);
			
			if (!empty($fairId) && 0 != $fairId)
				$this->db->where('pid.fairId', $fairId);
			
			if (!empty($fest_id) && 0 != $fest_id)
				$this->db->where('pid.fest_id', $fest_id);
			
			
			$this->db->group_by('i.item_code');
			
			$item_details		= $this->db->get();
			return $item_details->result_array();	
	}
	
	
	
function get_certificate_exhibition_4school($value){
			$data	=	array();
			
			if($value=='merit'){
				$certificate_type_cont		=	$this->get_certificate_type_condition(4);
			}
			if($value=='part'){
				$certificate_type_cont		=	$this->get_part_certificate_type_condition(4);
			}
			
			if ($certificate_type_cont)
			{
				$this->db->where($certificate_type_cont);
			}
			
			$this->db->select('scf.fairName,sdm.sub_district_name,cm.grade,sm.school_name');
			$this->db->from('certificate_master cm');
			$this->db->join('result_master rm', 'rm.participant_id=cm.participant_id and rm.item_code=cm.item_code');
			$this->db->join('participant_item_details pid','pid.pi_id=rm.participant_item_dtls_id');
			$this->db->join('science_master scf', 'scf.fairId=pid.fairId');
			$this->db->join('sub_district_master AS sdm', 'pid.sub_district_code=sdm.sub_district_code');
			$this->db->join('school_master AS sm', 'sm.school_code=pid.school_code');
			
			$this->db->where('pid.fairId',4);
			$this->db->where('pid.fest_id',0);
			$this->db->where('cm.item_code = rm.school_code');
			
			$this->db->group_by('pid.school_code');
			$this->db->order_by('pid.school_code');
			$certificate_details		= $this->db->get();
			if($certificate_details->num_rows()>0){
				return $certificate_details->result_array();
			}	
			else{
				return 'nodata';
			}
}//get_certificate_exhibition_4school($value)


	
	
}//class

?>