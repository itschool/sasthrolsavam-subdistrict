<?php
class Certificate extends CI_Controller {

	public function __construct(){
		parent::__construct(); 
		//$this->load->model('Session_Model');
		$this->template->write_view('menu', 'menu', '');													
		$this->load->model('certificate/Certificate_model');
		$this->template->add_js('js/certificate/certificate.js');
		$this->template->add_js('js/report/reportjs.js');	
	}
	
	function index($fair)
	{

		$this->Certificate_model->create_fieldname_templateTable();

		$this->Contents = array();
		$certificate_type_array	=	$this->General_Model->prepare_select_box_data('certificate_type','ct_id,type','','','ct_id');
		
		$sub_dist_code			=	$this->session->userdata('SUB_DISTRICT');
		$dist_code				=	$this->session->userdata('DISTRICT');
		
		$font_array				=	$this->Certificate_model->get_font_array();
		$font_size_array		=	$this->Certificate_model->get_font_size_array();
		$line_height_array		=	$this->Certificate_model->get_line_height_array();
		
		$certificate_template	=	$this->Certificate_model->get_certificate_details($fair,$sub_dist_code);
		
		$this->Contents['certificate_type_array']	=	$certificate_type_array;
		$this->Contents['font_array']				=	$font_array;
		$this->Contents['font_size_array']			=	$font_size_array;
		$this->Contents['line_height_array']		=	$line_height_array;
		$this->Contents['certificate_template']		=	$certificate_template;
		$this->Contents['fairId']					=	$fair;

		$this->template->write_view('content','certificate/certificate_template', $this->Contents);
		$this->template->load();
		
	}
	function certificate_template_graphoical(){
		$this->Contents = array();
		$certificate_type_array	=	$this->General_Model->prepare_select_box_data('certificate_type','ct_id,type','','','ct_id');
		
		$sub_dist_code			=	$this->session->userdata('SUB_DISTRICT');
		$dist_code				=	$this->session->userdata('DISTRICT');
		
		$font_array				=	$this->Certificate_model->get_font_array();
		$font_size_array		=	$this->Certificate_model->get_font_size_array();
		$line_height_array		=	$this->Certificate_model->get_line_height_array();
		
		$certificate_template	=	$this->Certificate_model->get_certificate_details($dist_code,$sub_dist_code);
		
		$this->Contents['certificate_type_array']	=	$certificate_type_array;
		$this->Contents['font_array']				=	$font_array;
		$this->Contents['font_size_array']			=	$font_size_array;
		$this->Contents['line_height_array']		=	$line_height_array;
		
		$this->Contents['certificate_template']		=	$certificate_template;

		$this->load->view('certificate/certificate_template_drag', $this->Contents);
		//$this->template->load();			
	
	}
	function save_certificate_template()
	{
		//echo '<br><br><br>'.$this->input->post('fairtype');
		$sub_dist_code			=	$this->session->userdata('SUB_DISTRICT');
		$dist_code				=	$this->session->userdata('DISTRICT');
		$this->Certificate_model->save_certificate_details($this->input->post('fairtype'),$sub_dist_code);
		
		$this->index($this->input->post('fairtype'));
	}
	
function list_item_wise ()
{
		if($this->Session_Model->check_user_permission(48)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		
		$fest						=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','fest_id != 0','Select Festival','fest_id');
		$fair						=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','Select Fair','fairId');
		$this->Contents				=	array();
		
		$this->Contents['pfest']	=	$fest;
		$this->Contents['fair']		=	$fair;
	  
		$this->template->write_view('content', 'certificate/festival_type_list', $this->Contents);
		$fair_id	= $this->input->post('cmbFairType');
		$fest_id	= $this->input->post('cmbCateType');
		
		if($fair_id!=0)
		{		
			$itempart					=	$this->Certificate_model->get_item_certificate($fair_id,$fest_id);
			
			$this->Contents['itempart']	= 	$itempart;
			if(count($itempart)>0)
			{
					$this->template->write_view('content','certificate/item_certificate_details',$this->Contents);
			}//if(count($itempart)>0)
		}//if($fair_id!=0)
		$this->template->load();
		
}//list_item_wise ()
	
function get_certificate_itemwise($itemcode)
{
		if($this->Session_Model->check_user_permission(48)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		if ('' != $itemcode)
		{
				$this->Contents['javascript_code']	= '';
				$this->Contents['item_type'] =	$this->Certificate_model->is_group_item($itemcode);
				
				$this->Contents['item_id'] 	 =	$itemcode;
				if('G' == $this->Contents['item_type']){
					$this->Contents['javascript_code']	= 'onchange="javascript:getParticipant(this.value);"';
					$this->Contents['dropdown_title']	= 'Group Captain';
				}
				else if('S' == $this->Contents['item_type']){
					$this->Contents['dropdown_title']	= 'Participants';
				}
				$this->Contents['captain_detail']	= $this->Certificate_model->get_captains_details($itemcode);
				$this->template->write_view('content', 'certificate/certificate_itemwise', $this->Contents);
				$this->template->load();
		}//if ('' != $itemcode)
		else{
			redirect('certificate/certificate/list_item_wise');
		}
}//get_certificate_itemwise($itemcode)
	
function get_certificate_pdf ()
{ 
		if($this->Session_Model->check_user_permission(48)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		if ('' != $this->input->post('hidItemId') && '' != $this->input->post('captain_id') && '' != $this->input->post('hidItemType'))
		{
			$sub_dist_code	=	$this->session->userdata('SUB_DISTRICT');
			$dist_code		=	$this->session->userdata('DISTRICT');
			
			$fairid			= 	$this->General_Model->get_data('item_master', 'fairId,fest_id', array('item_code' => $this->input->post('hidItemId')));
			
			$certificate_template	=	$this->Certificate_model->get_certificate_details($fairid[0]['fairId'],$sub_dist_code);
			
			$fair	=	$fairid[0]['fairId'];
			
			if(count($certificate_template)>0){
			
					$page_style				=	($certificate_template[0]['page_style'] == 'P') ? 'P' : 'L';
					
					$this->load->library('_fpdf/fpdf');
					$this->fpdf->Open();
					$this->fpdf->FPDF($page_style,'mm','A4');
					
					$school_code		= '';
					$item_code			= $this->input->post('hidItemId');
					$captain_id			= $this->input->post('captain_id');
					$participant_id		= $this->input->post('participant_id');
					
					$participant_array	= $this->Certificate_model->get_school_participant_details($fairid[0]['fairId'],$school_code, $fairid[0]['fest_id'], $item_code, $captain_id, $participant_id);
					
					
					if (is_array($participant_array) && count($participant_array))
					{	
						if($participant_array['certificate_details']!='nodata'){
							foreach ($participant_array['certificate_details'] as $certificate_details)
							{	
									$cm_array	=	array($certificate_details['participant_id'],$certificate_details['grade'],$certificate_details['is_withheld'],$certificate_details['rank'],$certificate_details['participant_item_dtls_id']);
									$this->create_certificate($participant_array['participant_details'],$cm_array,$certificate_template);
							}
							$this->fpdf->Output('certificate.pdf','D');	
						}
						else{ 
							redirect('test/nodata/'.$fair);
						}	
					}
			}
			else{
					redirect('test/notemplate/'.$fair);
			}		
		}
		else
		{
				redirect('certificate/certificate/list_item_wise');
		}
}//get_certificate_pdf ()

function get_exhibition_certificate_pdf (){ 
			if($this->Session_Model->check_user_permission(48)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			if ('' != $this->input->post('hidItemId') || '' != $this->input->post('captain_id') || '' != $this->input->post('hidItemType')){
				$sub_dist_code			=	$this->session->userdata('SUB_DISTRICT');
				$dist_code				=	$this->session->userdata('DISTRICT');
				$certificate_template	=	$this->Certificate_model->get_certificate_details($dist_code,$sub_dist_code);
				$page_style				=	($certificate_template[0]['page_style'] == 'P') ? 'P' : 'L';
				
				$this->load->library('_fpdf/fpdf');
				$this->fpdf->Open();
				$this->fpdf->FPDF($page_style,'mm','A4');
				
				
				$fair				= '';
				$school_code		= '';
				$festival			= '';
				$item_code			= $this->input->post('hidItemId');
				$captain_id			= $this->input->post('captain_id');
				$participant_id		= $this->input->post('participant_id');
				
				$participant_array	= $this->Certificate_model->get_school_participant_details($fair,$school_code, $festival, $item_code, $captain_id, $participant_id);
				
				
				if (is_array($participant_array) && count($participant_array))
				{	
					foreach ($participant_array['certificate_details'] as $certificate_details)
					{	
							$cm_array	=	array($certificate_details['participant_id'],$certificate_details['grade'],$certificate_details['is_withheld'],$certificate_details['rank'],$certificate_details['participant_item_dtls_id']);
							$this->create_certificate($participant_array['participant_details'],$cm_array,$certificate_template);
					}
				}
				
				$this->fpdf->Output('certificate.pdf','D');	
			
			}
			else
			{//echo '<br><br><br>ssssssssss';
			redirect('certificate/certificate/list_item_wise');
			}
	}
	

	
	function create_certificate ($participant_arraydata,$cm_array,$certificate_template)
	{
		$participantid	= $cm_array[0];
		$grade			= $cm_array[1];
		$is_withheld	= $cm_array[2];
		$rank			= $cm_array[3];
		$participant_item_dtls_id			= $cm_array[4];
		//if($participant_arraydata[$participantid]!='null'){
		foreach($participant_arraydata[$participant_item_dtls_id] as $participant_array){
			if($this->Session_Model->check_user_permission(48)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$page_style				=	($certificate_template[0]['page_style'] == 'P') ? 'P' : 'L';
			$line_height			=	($certificate_template[0]['line_height']) ? $certificate_template[0]['line_height'] : '1';
			$top_margin				=	($certificate_template[0]['top_margin']) ? $certificate_template[0]['top_margin'] : '1';
			$left_margin			=	($certificate_template[0]['left_margin']) ? $certificate_template[0]['left_margin'] : '1';
			$right_margin			=	($certificate_template[0]['right_margin']) ? $certificate_template[0]['right_margin'] : '1';
			
			$label_print			=	($certificate_template[0]['label_print']) ? $certificate_template[0]['label_print'] : 'N';
			
			$this->fpdf->AddPage();
			$this->fpdf->SetFont('Arial','B',14);
			
			$this->fpdf->SetMargins($left_margin,$top_margin,$right_margin);
			
			
			if ($certificate_template[0]['fair_x'] and $certificate_template[0]['fair_y'])
			{
				$this->fpdf->SetFont($certificate_template[0]['fair_font'],'B',$certificate_template[0]['fair_size']);
				$this->fpdf->SetXY($certificate_template[0]['fair_x'],$certificate_template[0]['fair_y']);
				
				if ($label_print == 'Y')
				{
					$this->fpdf->Write($line_height,'Fair');
					$this->fpdf->SetXY($certificate_template[0]['fair_x']+20,$certificate_template[0]['fair_y']);
					$this->fpdf->Write($line_height,' : ');
					$this->fpdf->SetXY($certificate_template[0]['fair_x']+25,$certificate_template[0]['fair_y']);
					$this->fpdf->Write($line_height,$participant_array['fairName']);
				}
				else
				{
					$this->fpdf->Write($line_height,$participant_array['fairName']);
				}
			
			}
			if ($certificate_template[0]['name_x'] and $certificate_template[0]['name_y'])
			{
				$this->fpdf->SetFont($certificate_template[0]['name_font'],'B',$certificate_template[0]['name_size']);
				$this->fpdf->SetXY($certificate_template[0]['name_x'],$certificate_template[0]['name_y']);
				
				if ($label_print == 'Y')
				{
					$this->fpdf->Write($line_height,'Name');
					$this->fpdf->SetXY($certificate_template[0]['name_x']+20,$certificate_template[0]['name_y']);
					$this->fpdf->Write($line_height,' : ');
					$this->fpdf->SetXY($certificate_template[0]['name_x']+25,$certificate_template[0]['name_y']);
					$this->fpdf->Write($line_height,$participant_array['participant_name']);
				}
				else
				{
					$this->fpdf->Write($line_height,$participant_array['participant_name']);
				}
			
			}
			if ($certificate_template[0]['item_x'] and $certificate_template[0]['item_y'])
			{
				$this->fpdf->SetFont($certificate_template[0]['item_font'],'B',$certificate_template[0]['item_size']);
				$this->fpdf->SetXY($certificate_template[0]['item_x'],$certificate_template[0]['item_y']);
				
					if ($label_print == 'Y')
				{
					$this->fpdf->Write($line_height,'Item');
					$this->fpdf->SetXY($certificate_template[0]['item_x']+20,$certificate_template[0]['item_y']);
					$this->fpdf->Write($line_height,' : ');
					$this->fpdf->SetXY($certificate_template[0]['item_x']+25,$certificate_template[0]['item_y']);
					$participant_array['item_name'] = (@$participant_array['item_name']==2)?'Exhibition':$participant_array['item_name'];
					$this->fpdf->Write($line_height,$participant_array['item_name']);
				}
				else
				{
					$participant_array['item_name'] = (@$participant_array['item_name']==2)?'Exhibition':$participant_array['item_name'];
					$this->fpdf->Write($line_height, $participant_array['item_name']);
				}
			}
			if ($certificate_template[0]['category_x'] and $certificate_template[0]['category_y'])
			{
				$this->fpdf->SetFont($certificate_template[0]['category_font'],'B',$certificate_template[0]['category_size']);
				$this->fpdf->SetXY($certificate_template[0]['category_x'],$certificate_template[0]['category_y']);
				
				if ($label_print == 'Y')
				{
					if(@$participant_array['fest_name']==2)
					{
					if($cm_array[5]==1)$fest ='LP';
					else if($cm_array[5]==2)$fest ='UP';
					else if($cm_array[5]==3)$fest ='HS';
					else if($cm_array[5]==3)$fest ='HSS';
					}
					$this->fpdf->Write($line_height,'Category');
					$this->fpdf->SetXY($certificate_template[0]['category_x']+20,$certificate_template[0]['category_y']);
					$this->fpdf->Write($line_height,' : ');
					$this->fpdf->SetXY($certificate_template[0]['category_x']+25,$certificate_template[0]['category_y']);
					$participant_array['fest_name'] =($participant_array['fest_name']==2)?$fest:$participant_array['fest_name'];
					$this->fpdf->Write($line_height,$participant_array['fest_name']);
				}
				else
				{
					if(@$participant_array['fest_name']==2)
					{
					if($cm_array[5]==1)$fest ='LP';
					else if($cm_array[5]==2)$fest ='UP';
					else if($cm_array[5]==3)$fest ='HS';
					else if($cm_array[5]==3)$fest ='HSS';
					}
				
					$participant_array['fest_name'] =($participant_array['fest_name']==2)?$fest:$participant_array['fest_name'];
					$this->fpdf->Write($line_height,$participant_array['fest_name']);
				}
			}
			if ($certificate_template[0]['grade_x'] and $certificate_template[0]['grade_y'])
			{
				$this->fpdf->SetFont($certificate_template[0]['grade_font'],'B',$certificate_template[0]['grade_size']);
				$this->fpdf->SetXY($certificate_template[0]['grade_x'],$certificate_template[0]['grade_y']);
				
				if ($label_print == 'Y')
				{
					$this->fpdf->Write($line_height,'Grade');
					$this->fpdf->SetXY($certificate_template[0]['grade_x']+20,$certificate_template[0]['grade_y']);
					$this->fpdf->Write($line_height,' : ');
					$this->fpdf->SetXY($certificate_template[0]['grade_x']+25,$certificate_template[0]['grade_y']);
					$this->fpdf->Write($line_height,$grade);
				}
				else
				{
					$this->fpdf->Write($line_height, $grade);
				}
			}
			if($participant_array['is_teach']!='Y'){
					if ($certificate_template[0]['class_x'] and $certificate_template[0]['class_y'])
					{
						$this->fpdf->SetFont($certificate_template[0]['class_font'],'B',$certificate_template[0]['class_size']);
						$this->fpdf->SetXY($certificate_template[0]['class_x'],$certificate_template[0]['class_y']);
						
						if ($label_print == 'Y')
						{
							$this->fpdf->Write($line_height,'Class');
							$this->fpdf->SetXY($certificate_template[0]['class_x']+20,$certificate_template[0]['class_y']);
							$this->fpdf->Write($line_height,' : ');
							$this->fpdf->SetXY($certificate_template[0]['class_x']+25,$certificate_template[0]['class_y']);
							$this->fpdf->Write($line_height,$participant_array['class']);
						}
						else
						{
							$this->fpdf->Write($line_height,$participant_array['class']);
						}
					}
			}
			if ($certificate_template[0]['school_x'] and $certificate_template[0]['school_y'])
			{
				$this->fpdf->SetFont($certificate_template[0]['school_font'],'B',$certificate_template[0]['school_size']);
				$this->fpdf->SetXY($certificate_template[0]['school_x'],$certificate_template[0]['school_y']);
				
				if ($label_print == 'Y')
				{
					$this->fpdf->Write($line_height,'School');
					$this->fpdf->SetXY($certificate_template[0]['school_x']+20,$certificate_template[0]['school_y']);
					$this->fpdf->Write($line_height,' : ');
					$this->fpdf->SetXY($certificate_template[0]['school_x']+25,$certificate_template[0]['school_y']);
					$this->fpdf->Write($line_height,$participant_array['school_name']);
				}
				else
				{
					$this->fpdf->Write($line_height, $participant_array['school_name']);
				}
			}
			if ($certificate_template[0]['sub_dist_x'] and $certificate_template[0]['sub_dist_y'])
			{
				$this->fpdf->SetFont($certificate_template[0]['sub_dist_font'],'B',$certificate_template[0]['sub_dist_size']);
				$this->fpdf->SetXY($certificate_template[0]['sub_dist_x'],$certificate_template[0]['sub_dist_y']);
				if ($label_print == 'Y')
				{
					
					$this->fpdf->SetXY($certificate_template[0]['sub_dist_x']+25,$certificate_template[0]['sub_dist_y']);
					$this->fpdf->Write($line_height,$participant_array['sub_district_name']);
				}
				else
				{
					$this->fpdf->Write($line_height, $participant_array['sub_district_name']);
				}
			}
			if ($certificate_template[0]['date_x'] and $certificate_template[0]['date_y'])
			{
				$this->fpdf->SetFont($certificate_template[0]['date_font'],'B',$certificate_template[0]['date_size']);
				$this->fpdf->SetXY($certificate_template[0]['date_x'],$certificate_template[0]['date_y']);
				
				$end_date		=	end($this->General_Model->get_fest_date_array());
				
				$this->fpdf->SetXY($certificate_template[0]['date_x']+25,$certificate_template[0]['date_y']);
				$this->fpdf->Write($line_height,$end_date);
			}
			if ($certificate_template[0]['place_x'] and $certificate_template[0]['place_y'])
			{
				$this->fpdf->SetFont($certificate_template[0]['place_font'],'B',$certificate_template[0]['place_size']);
				$this->fpdf->SetXY($certificate_template[0]['place_x'],$certificate_template[0]['place_y']);
				
				$this->fpdf->SetXY($certificate_template[0]['place_x']+25,$certificate_template[0]['place_y']);
				$this->fpdf->Write($line_height,$participant_array['sub_district_name']);
			}
			
			if ($certificate_template[0]['ehs_X'] and $certificate_template[0]['ehs_Y'])
			{
				$this->fpdf->SetFont($certificate_template[0]['ehs_font'],'B',$certificate_template[0]['ehs_size']);
				$this->fpdf->SetXY($certificate_template[0]['ehs_X'],$certificate_template[0]['ehs_Y']);
				
				$this->fpdf->SetXY($certificate_template[0]['ehs_X']+25,$certificate_template[0]['ehs_Y']);
				
				if($participant_array['item_name']=='Science Drama'){
					/*if(($grade=='A' || $grade=='B') && $is_withheld=='N'  && $rank==1){
							$this->fpdf->Write($line_height,'Eligible For Higher Level');
					}*/
					if($is_withheld=='N'  && $rank==1){
							$this->fpdf->Write($line_height,'Eligible For Higher Level');
					}
				}
				else{
					if($is_withheld=='N'  && ($rank==1 || $rank==2)){
							$this->fpdf->Write($line_height,'Eligible For Higher Level');
					}
				}
				
				//else{
						//$this->fpdf->Write($line_height,'NEHS');
				//}
			}
		}
	//}		
		
	}
	
function list_reg_no_wise (){
		if($this->Session_Model->check_user_permission(48)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->template->write_view('content','certificate/participant_certificate_details');
		$this->template->load();
}//list_reg_no_wise ()
	
	function initializeTemplate(){
		$initial	=	$this->Certificate_model->initializeTemplate();
		$this->index();
	}
	
function get_certificate_pdf_participant_wise ()
{
		if($this->Session_Model->check_user_permission(48)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		if ('' != $this->input->post('txtParticipantId') && '' != $this->input->post('item_code'))
		{
				$sub_dist_code			=	$this->session->userdata('SUB_DISTRICT');
				//$dist_code				=	$this->session->userdata('DISTRICT');
				if($this->input->post('item_code')!=0)
				{
						$capntan	=	$this->Certificate_model->get_captan_with_id($this->input->post('txtParticipantId'),$this->input->post('schoolcode'),$this->input->post('item_code'));
						if($capntan!='nodata')
						{
							$where	=	'participant_id='.$this->input->post('txtParticipantId').' and item_code='.$this->input->post('item_code');
							$fairvalue	=	$this->General_Model->fetch_data('participant_item_details','fairId',$where);
							
							$fair	=	$fairvalue[0]['fairId'];
							
							$certificate_template	=	$this->Certificate_model->get_certificate_details($fair,$sub_dist_code);
							
							if(count($certificate_template)>0)
							{
								$page_style				=	($certificate_template[0]['page_style'] == 'P') ? 'P' : 'L';
								$this->load->library('_fpdf/fpdf');
								$this->fpdf->Open();
								$this->fpdf->FPDF($page_style,'mm','A4');
								
								$festival			= '';
								$school_code		= '';
								$captain_id			= '';
								$item_code			= $this->input->post('item_code');
								$participant_id		= $this->input->post('txtParticipantId');
								$schoolcode			= $this->input->post('schoolcode');
								$captain_id			= $capntan[0]['participant_id'];
								
								$participant_array	= $this->Certificate_model->get_school_participant_details($fair,$school_code, $festival, $item_code, $captain_id, $participant_id);
								
								//$venue 	= $this->General_Model->get_data('state_sciencefair_master','*','','');
								
								if (is_array($participant_array) && count($participant_array))
								{	
									if($participant_array['certificate_details']!='nodata')
									{
										foreach ($participant_array['certificate_details'] as $certificate_details)
										{	
												$cm_array	=	array($certificate_details['participant_id'],$certificate_details['grade'],$certificate_details['is_withheld'],$certificate_details['rank'],$certificate_details['participant_item_dtls_id']);
												$this->create_certificate($participant_array['participant_details'],$cm_array,$certificate_template);
										}//foreach ($participant_array['certificate_details'] as $certificate_details)
										$this->fpdf->Output('certificate.pdf','D');
								}//if($participant_array['certificate_details']!='nodata')
									else{
									redirect('test/nodata');
									}	
								}//if (is_array($participant_array) && count($participant_array))
							}//if(count($certificate_template)>0)
							else{
								redirect('test/notemplate/'.$fair);
							}	
						}//if($capntan!='nodata')
						else{
						redirect('test/nodata');
						}				
				
				}//if($this->input->post('item_code')!=0)
		
				else
				{
					$participant_details	=	$this->Certificate_model->get_participant_details_with_id($this->input->post('txtParticipantId'));
					$item_details_array		=	$this->Certificate_model->get_participant_item($this->input->post('txtParticipantId'),$this->input->post('schoolcode'),'',$participant_details[0]['fest_id']);
					
					$this->load->library('_fpdf/fpdf');
					$this->fpdf->Open();
					$this->fpdf->FPDF('L','mm','A4');
					
					$flag=0;				
					foreach($item_details_array as $row)
					{					
							$capntan	=	$this->Certificate_model->get_captan_with_id($this->input->post('txtParticipantId'),$this->input->post('schoolcode'),$row['item_code']);
							
							if($capntan!='nodata')
							{
									$where	=	'participant_id='.$this->input->post('txtParticipantId').' and item_code='.$row['item_code'];
									$fairvalue	=	$this->General_Model->fetch_data('participant_item_details','fairId',$where);
									
									$fair	=	$fairvalue[0]['fairId'];
									
									$certificate_template	=	$this->Certificate_model->get_certificate_details($fair,$sub_dist_code);
									
									if(count($certificate_template)>0)
									{
											$page_style				=	($certificate_template[0]['page_style'] == 'P') ? 'P' : 'L';										
											
											$festival			= '';
											$school_code		= '';
											$captain_id			= '';
											$item_code			= $row['item_code'];
											$participant_id		= $this->input->post('txtParticipantId');
											$schoolcode			= $this->input->post('schoolcode');
											$captain_id			= $capntan[0]['participant_id'];
											
											$participant_array	= $this->Certificate_model->get_school_participant_details($fair,$school_code, $festival, $item_code, $captain_id, $participant_id);
											
											if (is_array($participant_array) && count($participant_array))
											{	
												if($participant_array['certificate_details']!='nodata')
												{
												foreach ($participant_array['certificate_details'] as $certificate_details)
												{	
														$cm_array	=	array($certificate_details['participant_id'],$certificate_details['grade'],$certificate_details['is_withheld'],$certificate_details['rank'],$certificate_details['participant_item_dtls_id']);
													
														$this->create_certificate($participant_array['participant_details'],$cm_array,$certificate_template);	
														$flag=1;
									}//foreach ($participant_array['certificate_details'] as $certificate_details)													
									}//if($participant_array['certificate_details']!='nodata')
												else{ 
													if($flag==0){
														redirect('test/nodata');
													}//if($flag==0)
												}//else	
											}//if (is_array($participant_array) && count($participant_array))
									}//if(count($certificate_template)>0)
									else{
									redirect('test/notemplate/'.$fair);
									}	
							}//if($capntan!='nodata')	
							else{
							redirect('test/nodata');
							}
					}//foreach($item_details_array as $row)		
					$this->fpdf->Output('certificate.pdf','D');
					}
		}//if ('' != $this->input->post('txtParticipantId') && '' != $this->input->post('item_code'))		
		else
		{
			redirect('certificate/certificate/list_reg_no_wise');
		}
}//get_certificate_pdf_participant_wise ()
	
function list_school_wise ()
{
		if($this->Session_Model->check_user_permission(48)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->Contents						=	array();
		$this->Contents['school_details']	=	$this->Certificate_model->school_details_certificate_wise();
		$this->template->write_view('content','certificate/certificate_details_school_wise',$this->Contents);
		$this->template->load();
}
	
	function get_certificate_school_wise (){
	
			if($this->Session_Model->check_user_permission(48)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			if ('' != $this->input->post('hidSchoolCode')){
				$school_code						= 	$this->input->post('hidSchoolCode');
				$this->Contents['fest']				=	$this->Certificate_model->get_school_festival_details($school_code);
				$this->Contents['fair']				=	$this->Certificate_model->get_school_fair_details($school_code);
				$school_code						= 	$this->input->post('hidSchoolCode');
				$this->Contents['school_details']	= 	$this->General_Model->get_data('school_master', 'school_code, school_name', array('school_code' => $school_code));
				$this->template->write_view('content','certificate/school_item_certificate_details',$this->Contents);
				$this->template->load();
			}
			else{
				redirect('certificate/certificate/list_school_wise');
			}
	}

function get_certificate_pdf_school_wise ()
{
		if($this->Session_Model->check_user_permission(48)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		if ('' != $this->input->post('hidSchoolCode'))
		{
			$sub_dist_code			=	$this->session->userdata('SUB_DISTRICT');
			$dist_code				=	$this->session->userdata('DISTRICT');
			$certificate_template	=	$this->Certificate_model->get_certificate_details($this->input->post('cmbFairType'),$sub_dist_code);
			
			if(count($certificate_template)>0)
			{
						$page_style				=	($certificate_template[0]['page_style'] == 'P') ? 'P' : 'L';
			
						$this->load->library('_fpdf/fpdf');
						$this->fpdf->Open();
						$this->fpdf->FPDF($page_style,'mm','A4');
						
						$fair				= $this->input->post('cmbFairType');
						$school_code		= $this->input->post('hidSchoolCode');
						$festival			= $this->input->post('cmbFestType');
						$item_code			= $this->input->post('item_code');
						$captain_id			= $this->input->post('captain_id');
						$participant_id		= $this->input->post('participant_id');
						
						if($fair == 4 && $this->input->post('radioLabel') == 'exhib'){  
							 $festival						=	0;
						}
						else {   
							 $festival						=	$festival;
						}
						
						$participant_array	= $this->Certificate_model->get_school_participant_details($fair,$school_code, $festival, $item_code, $captain_id, $participant_id);
						
						if (is_array($participant_array) && count($participant_array))
						{	
							if($participant_array['certificate_details']!='nodata')
							{
									foreach (@$participant_array['certificate_details'] as $certificate_details){	
											$cm_array	=	array($certificate_details['participant_id'],$certificate_details['grade'],$certificate_details['is_withheld'],$certificate_details['rank'],$certificate_details['participant_item_dtls_id']);
											
											$this->create_certificate($participant_array['participant_details'],$cm_array,$certificate_template);
									}//foreach (@$participant_array['certificate_details'] as $certificate_details)
								$this->fpdf->Output('certificate.pdf','D');
							}//if($participant_array['certificate_details']!='nodata')
							else{
								redirect('test/nodata');
							}	
						}//if (is_array($participant_array) && count($participant_array))
			}//if(count($certificate_template)>0)
			else{
				redirect('test/notemplate/'.$this->input->post('cmbFairType'));
			}
			
			
		}//if ('' != $this->input->post('hidSchoolCode'))
		else{
			redirect('certificate/certificate/list_item_wise');
		}
}//get_certificate_pdf_school_wise ()


/////////////////////////Only for Participated Students///////////////
	
function attended_list_school_wise()
{
		if($this->Session_Model->check_user_permission(48)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		
		$this->Contents						=	array();
		$this->Contents['school_details']	=	$this->Certificate_model->school_details_certificate_wise();
		$this->template->write_view('content','certificate/participants/certificate_details_school_wise',$this->Contents);
		$this->template->load();
		
}//attended_list_school_wise()	
	
function get_attended_certificate_school_wise ()
{
			if($this->Session_Model->check_user_permission(48)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			if ('' != $this->input->post('hidSchoolCode'))
			{
					$school_code						= 	$this->input->post('hidSchoolCode');
					$this->Contents['fest']				=	$this->Certificate_model->get_school_festival_details($school_code);
					$this->Contents['fair']				=	$this->Certificate_model->get_school_fair_details($school_code);
					$school_code						= 	$this->input->post('hidSchoolCode');
					$this->Contents['school_details']	= 	$this->General_Model->get_data('school_master', 'school_code, school_name', array('school_code' => $school_code));
					$this->template->write_view('content','certificate/participants/school_item_certificate_details',$this->Contents);
					$this->template->load();
					
			}//if ('' != $this->input->post('hidSchoolCode'))
			
			else{
				redirect('certificate/certificate/attended_list_school_wise');
			}
}//get_attended_certificate_school_wise ()
	
function get_attended_certificate_pdf_school_wise ()
{
		if($this->Session_Model->check_user_permission(48)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		if ('' != $this->input->post('hidSchoolCode'))
		{
			$sub_dist_code			=	$this->session->userdata('SUB_DISTRICT');
			
			$certificate_template	=	$this->Certificate_model->get_attended_certificate_details($this->input->post('cmbFairType'),$sub_dist_code);
				
			if(count($certificate_template)>0)
			{	
				$page_style				=	($certificate_template[0]['page_style'] == 'P') ? 'P' : 'L';
				
				$this->load->library('_fpdf/fpdf');
				$this->fpdf->Open();
				$this->fpdf->FPDF($page_style,'mm','A4');
				$fair				= $this->input->post('cmbFairType');
				$school_code		= $this->input->post('hidSchoolCode');
				$festival			= $this->input->post('cmbFestType');
				$item_code			= $this->input->post('item_code');
				$captain_id			= $this->input->post('captain_id');
				$participant_id		= $this->input->post('participant_id');
				
				if($fair == 4 && $this->input->post('radioLabel') == 'exhib'){  
					 $festival						=	0;
				}
				else {   
					 $festival						=	$festival;
				}
				
				$participant_array	= $this->Certificate_model->get_attended_school_participant_details($fair,$school_code, $festival, $item_code, $captain_id, $participant_id);
				
				if (is_array($participant_array) && count($participant_array))
				{	
					if($participant_array['certificate_details']!='nodata')
					{
						foreach ($participant_array['certificate_details'] as $certificate_details)
						{	
								$cm_array	=	array($certificate_details['participant_id'],$certificate_details['grade'],$certificate_details['is_withheld'],$certificate_details['rank'],$certificate_details['participant_item_dtls_id']);
								$this->create_attended_certificate($participant_array['participant_details'],$cm_array,$certificate_template);
						}//foreach ($participant_array['certificate_details'] as $certificate_details)
					}//if($participant_array['certificate_details']!='nodata')
					else{
						redirect('test/nodata');
					}
				}//if (is_array($participant_array) && count($participant_array))
				$this->fpdf->Output('certificate.pdf','D');
			}//if(count($certificate_template)>0)
			else{ 
					redirect('test/no_partTemplate/'.$fair);
			}		
		}//if ('' != $this->input->post('hidSchoolCode'))
		else{
			redirect('certificate/certificate/attended_list_school_wise');
		}
}//get_attended_certificate_pdf_school_wise ()
	
function attended_list_reg_no_wise (){
		if($this->Session_Model->check_user_permission(48)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->template->write_view('content','certificate/participants/participant_certificate_details');
		$this->template->load();
}
	
function get_attended_certificate_pdf_participant_wise ()
{
		if($this->Session_Model->check_user_permission(48)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		if ('' != $this->input->post('txtParticipantId') && '' != $this->input->post('item_code'))
		{		$sub_dist_code			=	$this->session->userdata('SUB_DISTRICT');
				if($this->input->post('item_code')!=0)
				{
					$capntan	=	$this->Certificate_model->get_captan_with_id($this->input->post('txtParticipantId'),$this->input->post('schoolcode'),$this->input->post('item_code'));
					
					if($capntan!='nodata')
					{
						$where	=	'participant_id='.$this->input->post('txtParticipantId').' and item_code='.$this->input->post('item_code');
						$fairvalue	=	$this->General_Model->fetch_data('participant_item_details','fairId',$where);
						
						$fair	=	$fairvalue[0]['fairId'];						
						$certificate_template	=	$this->Certificate_model->get_attended_certificate_details($fair,$sub_dist_code);
						
						if(count($certificate_template)>0)
						{
							$page_style				=	($certificate_template[0]['page_style'] == 'P') ? 'P' : 'L';
							
							$this->load->library('_fpdf/fpdf');
							$this->fpdf->Open();
							$this->fpdf->FPDF($page_style,'mm','A4');
							
							$festival			= '';
							$school_code		= '';
							$captain_id			= '';
							$item_code			= $this->input->post('item_code');
							$participant_id		= $this->input->post('txtParticipantId');
							$schoolcode			= $this->input->post('schoolcode');
							$captain_id			= $capntan[0]['participant_id'];
							
							$participant_array	= $this->Certificate_model->get_attended_school_participant_details($fair,$school_code, $festival, $item_code, $captain_id, $participant_id);
														
							if (is_array($participant_array) && count($participant_array))
							{	
								if($participant_array['certificate_details']!='nodata'){
									foreach ($participant_array['certificate_details'] as $certificate_details)
									{	
											$cm_array	=	array($certificate_details['participant_id'],$certificate_details['grade'],$certificate_details['is_withheld'],$certificate_details['rank'],$certificate_details['participant_item_dtls_id']);
											
											$this->create_attended_certificate($participant_array['participant_details'],$cm_array,$certificate_template);
									}//foreach ($participant_array['certificate_details'] as $certificate_details)
									$this->fpdf->Output('certificate.pdf','D');
								}//if($participant_array['certificate_details']!='nodata')
								else{
								redirect('test/nodata');
								}	
							}//if (is_array($participant_array) && count($participant_array))
						}//if(count($certificate_template)>0)
						else{
						redirect('test/no_partTemplate/'.$fair);
						}	
					}//if($capntan!='nodata')
					else{
						redirect('test/nodata');
					}				
				}//if($this->input->post('item_code')!=0)
				else
				{
					$participant_details	=	$this->Certificate_model->get_participant_details_with_id($this->input->post('txtParticipantId'));
					$item_details_array	=	$this->Certificate_model->get_participant_item($this->input->post('txtParticipantId'),$this->input->post('schoolcode'),'',$participant_details[0]['fest_id']);
					
					$this->load->library('_fpdf/fpdf');
					$this->fpdf->Open();
					$this->fpdf->FPDF('L','mm','A4');
					
					$flag=0;				
					foreach($item_details_array as $row)
					{					
							$capntan	=	$this->Certificate_model->get_captan_with_id($this->input->post('txtParticipantId'),$this->input->post('schoolcode'),$row['item_code']);
							
							if($capntan!='nodata')
							{
								$where	=	'participant_id='.$this->input->post('txtParticipantId').' and item_code='.$row['item_code'];
								$fairvalue	=	$this->General_Model->fetch_data('participant_item_details','fairId',$where);
								
								$fair	=	$fairvalue[0]['fairId'];								
								$certificate_template	=	$this->Certificate_model->get_attended_certificate_details($fair,$sub_dist_code);
								
								if(count($certificate_template)>0)
								{
									$page_style				=	($certificate_template[0]['page_style'] == 'P') ? 'P' : 'L';										
									
									$festival			= '';
									$school_code		= '';
									$captain_id			= '';
									$item_code			= $row['item_code'];
									$participant_id		= $this->input->post('txtParticipantId');
									$schoolcode			= $this->input->post('schoolcode');
									$captain_id			= $capntan[0]['participant_id'];
									
									$participant_array	= $this->Certificate_model->get_attended_school_participant_details($fair,$school_code, $festival, $item_code, $captain_id, $participant_id);
									
									if (is_array($participant_array) && count($participant_array))
									{	
										if($participant_array['certificate_details']!='nodata')
										{
										foreach ($participant_array['certificate_details'] as $certificate_details)
										{	
												$cm_array	=	array($certificate_details['participant_id'],$certificate_details['grade'],$certificate_details['is_withheld'],$certificate_details['rank'],$certificate_details['participant_item_dtls_id']);
												
												$this->create_attended_certificate($participant_array['participant_details'],$cm_array,$certificate_template);	
												$flag=1;
										}//foreach ($participant_array['certificate_details'] as $certificate_details)
									}//if($participant_array['certificate_details']!='nodata')
										else{ 
											if($flag==0){
												redirect('test/nodata');
											}//if
										}//else	
									}//if (is_array($participant_array) && count($participant_array))
								}//if(count($certificate_template)>0)
								else{
								redirect('test/no_partTemplate/'.$fair);
								}	
							}//if($capntan!='nodata')
							else{
								redirect('test/nodata');
							}					
					}//foreach($item_details_array as $row)		
					$this->fpdf->Output('certificate.pdf','D');
				}//ELSE if($this->input->post('item_code')!=0)
		}//if ('' != $this->input->post('txtParticipantId') && '' != $this->input->post('item_code'))
		else
		{
		redirect('certificate/certificate/attended_list_reg_no_wise');
		}
}//get_certificate_pdf_participant_wise ()
	
	
	
	function attended_list_item_wise (){
			if($this->Session_Model->check_user_permission(48)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			
			$fest						=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','fest_id != 0','Select Festival','fest_id');
			$fair						=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','Select Fair','fairId');
			$this->Contents				=	array();
			$fest['All']                =   "All Melas";
			$this->Contents['pfest']	=	$fest;
			$this->Contents['fair']		=	$fair;
		  
			$this->template->write_view('content', 'certificate/participants/festival_type_list', $this->Contents);
			$fair_id	= $this->input->post('cmbFairType');
			$fest_id	= $this->input->post('cmbCateType');
			if($fair_id!=0){
			//echo '<br><br>fair_id------>'.$fest_id;
				if($fair_id == 4 && $this->input->post('radioLabel') == 'exhib'){  
					 $fest_id						=	0;
				}
				else {   
					 $fest_id						=	$this->input->post('cmbCateType');
				}
			
				$itempart					=	$this->Certificate_model->get_item_certificate($fair_id,$fest_id);
				//echo '<br><br>';var_dump($itempart);
				$this->Contents['itempart']	= 	$itempart;
				if(count($itempart)>0)
				{
				$this->template->write_view('content','certificate/participants/item_certificate_details',$this->Contents);
				}
			}
			$this->template->load();
	}
	
	function get_attended_certificate_itemwise($itemcode){
			if($this->Session_Model->check_user_permission(48)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			if ('' != $itemcode){
				$this->Contents['javascript_code']	= '';
				$this->Contents['item_type'] =	$this->Certificate_model->is_group_item($itemcode);
				$this->Contents['item_id'] 	 =	$itemcode;
				if('G' == $this->Contents['item_type']){
					$this->Contents['javascript_code']	= ' onchange="javascript:getParticipant(this.value);"';
					$this->Contents['dropdown_title']	= 'Group Captain';
				}
				else if('S' == $this->Contents['item_type']){
					$this->Contents['dropdown_title']	= 'Participants';
				}
				//$this->Contents['captain_detail']	= $this->Certificate_model->get_captains_details($itemcode);
				$this->Contents['captain_detail']	= $this->Certificate_model->get_captains_details_4participant_certi($itemcode);
				$this->template->write_view('content', 'certificate/participants/certificate_itemwise', $this->Contents);
				$this->template->load();
			}
			else{
				redirect('certificate/certificate/attended_list_item_wise');
			}
	}
	
function create_attended_certificate ($participant_arraydata,$cm_array,$certificate_template)
{
		$participantid				= $cm_array[0];
		$grade						= $cm_array[1];
		$is_withheld				= $cm_array[2];
		$rank						= $cm_array[3];
		$participant_item_dtls_id	= $cm_array[4];
		
		foreach($participant_arraydata[$participant_item_dtls_id] as $participant_array){
			if($this->Session_Model->check_user_permission(48)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$page_style				=	($certificate_template[0]['page_style'] == 'P') ? 'P' : 'L';
			$line_height			=	($certificate_template[0]['line_height']) ? $certificate_template[0]['line_height'] : '1';
			$top_margin				=	($certificate_template[0]['top_margin']) ? $certificate_template[0]['top_margin'] : '1';
			$left_margin			=	($certificate_template[0]['left_margin']) ? $certificate_template[0]['left_margin'] : '1';
			$right_margin			=	($certificate_template[0]['right_margin']) ? $certificate_template[0]['right_margin'] : '1';
			
			$label_print			=	($certificate_template[0]['label_print']) ? $certificate_template[0]['label_print'] : 'N';
			
			$this->fpdf->AddPage();
			$this->fpdf->SetFont('Arial','B',14);
			
			$this->fpdf->SetMargins($left_margin,$top_margin,$right_margin);
			
			
			if ($certificate_template[0]['fair_x'] and $certificate_template[0]['fair_y'])
			{
				$this->fpdf->SetFont($certificate_template[0]['fair_font'],'B',$certificate_template[0]['fair_size']);
				$this->fpdf->SetXY($certificate_template[0]['fair_x'],$certificate_template[0]['fair_y']);
				
				if ($label_print == 'Y')
				{
					$this->fpdf->Write($line_height,'Fair');
					$this->fpdf->SetXY($certificate_template[0]['fair_x']+20,$certificate_template[0]['fair_y']);
					$this->fpdf->Write($line_height,' : ');
					$this->fpdf->SetXY($certificate_template[0]['fair_x']+25,$certificate_template[0]['fair_y']);
					$this->fpdf->Write($line_height,$participant_array['fairName']);
				}
				else
				{
					$this->fpdf->Write($line_height,$participant_array['fairName']);
				}
			
			}
			
			if ($certificate_template[0]['name_x'] and $certificate_template[0]['name_y'])
			{
				$this->fpdf->SetFont($certificate_template[0]['name_font'],'B',$certificate_template[0]['name_size']);
				$this->fpdf->SetXY($certificate_template[0]['name_x'],$certificate_template[0]['name_y']);
				
				if ($label_print == 'Y')
				{
					$this->fpdf->Write($line_height,'Name');
					$this->fpdf->SetXY($certificate_template[0]['name_x']+20,$certificate_template[0]['name_y']);
					$this->fpdf->Write($line_height,' : ');
					$this->fpdf->SetXY($certificate_template[0]['name_x']+25,$certificate_template[0]['name_y']);
					$this->fpdf->Write($line_height,$participant_array['participant_name']);
				}
				else
				{
					$this->fpdf->Write($line_height,$participant_array['participant_name']);
				}
			
			}
			if ($certificate_template[0]['item_x'] and $certificate_template[0]['item_y'])
			{
				$this->fpdf->SetFont($certificate_template[0]['item_font'],'B',$certificate_template[0]['item_size']);
				$this->fpdf->SetXY($certificate_template[0]['item_x'],$certificate_template[0]['item_y']);
				
				if ($label_print == 'Y')
				{
					$this->fpdf->Write($line_height,'Item');
					$this->fpdf->SetXY($certificate_template[0]['item_x']+20,$certificate_template[0]['item_y']);
					$this->fpdf->Write($line_height,' : ');
					$this->fpdf->SetXY($certificate_template[0]['item_x']+25,$certificate_template[0]['item_y']);
					$this->fpdf->Write($line_height,$participant_array['item_name']);
				}
				else
				{
					$this->fpdf->Write($line_height, $participant_array['item_name']);
				}
			}
			if ($certificate_template[0]['category_x'] and $certificate_template[0]['category_y'])
			{
				$this->fpdf->SetFont($certificate_template[0]['category_font'],'B',$certificate_template[0]['category_size']);
				$this->fpdf->SetXY($certificate_template[0]['category_x'],$certificate_template[0]['category_y']);
				
				if ($label_print == 'Y')
				{
					$this->fpdf->Write($line_height,'Category');
					$this->fpdf->SetXY($certificate_template[0]['category_x']+20,$certificate_template[0]['category_y']);
					$this->fpdf->Write($line_height,' : ');
					$this->fpdf->SetXY($certificate_template[0]['category_x']+25,$certificate_template[0]['category_y']);
					$this->fpdf->Write($line_height,$participant_array['fest_name']);
				}
				else
				{
					$this->fpdf->Write($line_height,$participant_array['fest_name']);
				}
			}
			if ($certificate_template[0]['grade_x'] and $certificate_template[0]['grade_y'])
			{
				$this->fpdf->SetFont($certificate_template[0]['grade_font'],'B',$certificate_template[0]['grade_size']);
				$this->fpdf->SetXY($certificate_template[0]['grade_x'],$certificate_template[0]['grade_y']);
				
				if ($label_print == 'Y')
				{
					$this->fpdf->Write($line_height,'Grade');
					$this->fpdf->SetXY($certificate_template[0]['grade_x']+20,$certificate_template[0]['grade_y']);
					$this->fpdf->Write($line_height,' : ');
					$this->fpdf->SetXY($certificate_template[0]['grade_x']+25,$certificate_template[0]['grade_y']);
					$this->fpdf->Write($line_height,$grade);
				}
				else
				{
					$this->fpdf->Write($line_height, $grade);
				}
			}
			if($participant_array['is_teach']!='Y'){
					if ($certificate_template[0]['class_x'] and $certificate_template[0]['class_y'])
					{
						$this->fpdf->SetFont($certificate_template[0]['class_font'],'B',$certificate_template[0]['class_size']);
						$this->fpdf->SetXY($certificate_template[0]['class_x'],$certificate_template[0]['class_y']);
						
						if ($label_print == 'Y')
						{
							$this->fpdf->Write($line_height,'Class');
							$this->fpdf->SetXY($certificate_template[0]['class_x']+20,$certificate_template[0]['class_y']);
							$this->fpdf->Write($line_height,' : ');
							$this->fpdf->SetXY($certificate_template[0]['class_x']+25,$certificate_template[0]['class_y']);
							$this->fpdf->Write($line_height,$participant_array['class']);
						}
						else
						{
							$this->fpdf->Write($line_height,$participant_array['class']);
						}
					}
			}
			if ($certificate_template[0]['school_x'] and $certificate_template[0]['school_y'])
			{
				$this->fpdf->SetFont($certificate_template[0]['school_font'],'B',$certificate_template[0]['school_size']);
				$this->fpdf->SetXY($certificate_template[0]['school_x'],$certificate_template[0]['school_y']);
				
				if ($label_print == 'Y')
				{
					$this->fpdf->Write($line_height,'School');
					$this->fpdf->SetXY($certificate_template[0]['school_x']+20,$certificate_template[0]['school_y']);
					$this->fpdf->Write($line_height,' : ');
					$this->fpdf->SetXY($certificate_template[0]['school_x']+25,$certificate_template[0]['school_y']);
					$this->fpdf->Write($line_height,$participant_array['school_name']);
				}
				else
				{
					$this->fpdf->Write($line_height, $participant_array['school_name']);
				}
			}
			if ($certificate_template[0]['sub_dist_x'] and $certificate_template[0]['sub_dist_y'])
			{
				$this->fpdf->SetFont($certificate_template[0]['sub_dist_font'],'B',$certificate_template[0]['sub_dist_size']);
				$this->fpdf->SetXY($certificate_template[0]['sub_dist_x'],$certificate_template[0]['sub_dist_y']);
				if ($label_print == 'Y')
				{
					
					$this->fpdf->SetXY($certificate_template[0]['sub_dist_x']+25,$certificate_template[0]['sub_dist_y']);
					$this->fpdf->Write($line_height,$participant_array['sub_district_name']);
				}
				else
				{
					$this->fpdf->Write($line_height, $participant_array['sub_district_name']);
				}
			}
			if ($certificate_template[0]['date_x'] and $certificate_template[0]['date_y'])
			{
				$this->fpdf->SetFont($certificate_template[0]['date_font'],'B',$certificate_template[0]['date_size']);
				$this->fpdf->SetXY($certificate_template[0]['date_x'],$certificate_template[0]['date_y']);
				
				$end_date		=	end($this->General_Model->get_fest_date_array());
				
				$this->fpdf->SetXY($certificate_template[0]['date_x']+25,$certificate_template[0]['date_y']);
				$this->fpdf->Write($line_height,$end_date);
			}
			if ($certificate_template[0]['place_x'] and $certificate_template[0]['place_y'])
			{
				$this->fpdf->SetFont($certificate_template[0]['place_font'],'B',$certificate_template[0]['place_size']);
				$this->fpdf->SetXY($certificate_template[0]['place_x'],$certificate_template[0]['place_y']);
				
				$this->fpdf->SetXY($certificate_template[0]['place_x']+25,$certificate_template[0]['place_y']);
				$this->fpdf->Write($line_height,$participant_array['sub_district_name']);
			}
		}
}//create_attended_certificate ($participant_arraydata,$cm_array,$certificate_template)
	
	
function get_attended_certificate_pdf (){ 
		if($this->Session_Model->check_user_permission(48)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		if ('' != $this->input->post('hidItemId') && '' != $this->input->post('captain_id') && '' != $this->input->post('hidItemType'))
		{
			$sub_dist_code			=	$this->session->userdata('SUB_DISTRICT');
			
			$where		=	'item_code='.$this->input->post('hidItemId');
			$fairvalue	=	$this->General_Model->fetch_data('item_master','fairId,fest_id',$where);
			$fair		=	$fairvalue[0]['fairId'];
			
			$certificate_template	=	$this->Certificate_model->get_attended_certificate_details($fair,$sub_dist_code);
			
			if(count($certificate_template)>0){
				$page_style				=	($certificate_template[0]['page_style'] == 'P') ? 'P' : 'L';
				$this->load->library('_fpdf/fpdf');
				$this->fpdf->Open();
				$this->fpdf->FPDF($page_style,'mm','A4');
				
				$school_code		= '';
				$festival			= '';
				$item_code			= $this->input->post('hidItemId');
				$captain_id			= $this->input->post('captain_id');
				$participant_id		= $this->input->post('participant_id');
				
				$participant_array	= $this->Certificate_model->get_attended_school_participant_details($fair,$school_code, $festival, $item_code, $captain_id, $participant_id);
				
				if (is_array($participant_array) && count($participant_array))
				{	
					if($participant_array['certificate_details']!='nodata'){
						foreach ($participant_array['certificate_details'] as $certificate_details)
						{	
								$cm_array	=	array($certificate_details['participant_id'],$certificate_details['grade'],$certificate_details['is_withheld'],$certificate_details['rank'],$certificate_details['participant_item_dtls_id']);
								$this->create_attended_certificate($participant_array['participant_details'],$cm_array,$certificate_template);
						}
					}
					else{
							redirect('test/nodata');
					}	
				}
				$this->fpdf->Output('certificate.pdf','D');	
			}//if(count($certificate_template)>0)
			else{
				redirect('test/no_partTemplate/'.$fair);
			}	
		}//if ('' != $this->input->post('hidItemId') && '' != $this->input->post('captain_id') && '' != $this->input->post('hidItemType'))
		else
		{
				redirect('certificate/certificate/attended_list_item_wise');
		}
}//get_attended_certificate_pdf ()
	

function participant_certificateTemplate($fair)
{
		$this->Contents = array();
		
		$sub_dist_code			=	$this->session->userdata('SUB_DISTRICT');
		$dist_code				=	$this->session->userdata('DISTRICT');

		$certificate_type_array	=	$this->General_Model->prepare_select_box_data('participant_certificate_type','ct_id,type','','','ct_id');
		
		$font_array				=	$this->Certificate_model->get_font_array();
		$font_size_array		=	$this->Certificate_model->get_font_size_array();
		$line_height_array		=	$this->Certificate_model->get_line_height_array();
		
		$certificate_template	=	$this->Certificate_model->get_participant_certificate_details($dist_code,$sub_dist_code,$fair);
		 
		$this->Contents['certificate_type_array']	=	$certificate_type_array;
		$this->Contents['font_array']				=	$font_array;
		$this->Contents['font_size_array']			=	$font_size_array;
		$this->Contents['line_height_array']		=	$line_height_array;
		
		$this->Contents['certificate_template']		=	$certificate_template;
		$this->Contents['fairId']					=	$fair;

		$this->template->write_view('content','certificate/participants/certificate_template', $this->Contents);
		$this->template->load();
}

function save_participant_certificate_template(){
		//$sub_dist_code			=	$this->session->userdata('SUB_DISTRICT');
		$dist_code				=	$this->session->userdata('DISTRICT_CODE');
		$this->Certificate_model->save_participant_certificate_details($dist_code,$this->input->post('fairtype'));
		//echo $this->input->post('fairtype');;
		$this->participant_certificateTemplate($this->input->post('fairtype'));
}


///////////////////////////////Certificate Only For Exhibition///////////////////////////////

function certificate_exhibition_interface(){
		if($this->Session_Model->check_user_permission(48)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		
		$fest						=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','fest_id != 0','Select Festival','fest_id');
		$this->Contents				=	array();
		$fest['All']                =   "All Fest";
		$this->Contents['fest']	=	$fest;
		
		$this->template->write_view('content', 'certificate/exhibition_interface', $this->Contents);
		
		$fest_id	= $this->input->post('cmbFestType');
		
		if($fest_id!=0){
			$this->Contents['school_details']	=	$this->Certificate_model->get_exhibition_school($fest_id);
			$this->template->write_view('content','certificate/list_exhibition_school',$this->Contents);
		}
		$this->template->load();
		
}//certificate_exhibition_interface()


function exhibition_captains($school_code,$fest=0)
{
		if($this->Session_Model->check_user_permission(48)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		if ('' != $school_code)
		{
				$sub_dist_code			=	$this->session->userdata('SUB_DISTRICT');
			
				$certificate_template	=	$this->Certificate_model->get_certificate_details(4,$sub_dist_code);
				
				if(count($certificate_template)>0)
				{
					$page_style				=	($certificate_template[0]['page_style'] == 'P') ? 'P' : 'L';
					
					$this->load->library('_fpdf/fpdf');
					$this->fpdf->Open();
					$this->fpdf->FPDF($page_style,'mm','A4');
					
					$fair				= 4;
					
					$this->Contents['schoolcode']		=	$school_code;
					$participant_array			=	$this->Certificate_model->get_school_participant_details(4,$school_code,'','','','',1);
					
					if (is_array($participant_array) && count($participant_array) >0)
					{	
						if($participant_array['certificate_details']!='nodata')
						{
							foreach ($participant_array['certificate_details'] as $certificate_details)
							{	
									$cm_array	=	array($certificate_details['participant_id'],$certificate_details['grade'],$certificate_details['is_withheld'],$certificate_details['rank'],$certificate_details['participant_item_dtls_id'],$certificate_details['fest_id']);
									
									$this->create_certificate($participant_array['participant_details'],$cm_array,$certificate_template);
							}//foreach ($participant_array['certificate_details'] as $certificate_details)
							$this->fpdf->Output('certificate.pdf','D');	
						}//if($participant_array['certificate_details']!='nodata')
						else{
							redirect('test/nodata');
						}	
					}//if (is_array($participant_array) && count($participant_array) >0)
					
					$this->Contents['school_details']	= 	$this->General_Model->get_data('school_master', 'school_code, school_name', array('school_code' => $school_code));
			}//if(count($certificate_template)>0)
			else{
					redirect('test/notemplate/4');
			}// if(count($certificate_template)>0) ELSE	
		}//if ('' != $school_code)
		else{
			redirect('certificate/certificate/certificate_exhibition_interface');
		}
}//exhibition_captains($school_code,$fest=0)


function attended_certificate_exhibition_interface(){

		if($this->Session_Model->check_user_permission(48)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		
		$fest						=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','fest_id != 0','Select Festival','fest_id');
		$this->Contents				=	array();
		$fest['All']                =   "All Fest";
		$this->Contents['fest']	=	$fest;
		
		$this->template->write_view('content', 'certificate/participants/exhibition_interface', $this->Contents);
		
		$fest_id	= $this->input->post('cmbFestType');
		
		if($fest_id!=0){
			$this->Contents['school_details']	=	$this->Certificate_model->get_exhibition_school($fest_id);
			$this->template->write_view('content','certificate/participants/list_exhibition_school',$this->Contents);
		}
		$this->template->load();
}	


function attended_exhibition_captains($school_code,$fest=0){
		if($this->Session_Model->check_user_permission(48)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		if ('' != $school_code){
				$sub_dist_code					=	$this->session->userdata('SUB_DISTRICT');
				
				$certificate_template	=	$this->Certificate_model->get_attended_certificate_details(4,$sub_dist_code);
				
				if(count($certificate_template)>0){
					$page_style				=	($certificate_template[0]['page_style'] == 'P') ? 'P' : 'L';
					
					$this->load->library('_fpdf/fpdf');
					$this->fpdf->Open();
					$this->fpdf->FPDF($page_style,'mm','A4');
					
					$fair				= 4;
					$festival			= '';
					$item_code			= $this->input->post('hidItemId');
					$captain_id			= $this->input->post('captain_id');
					$participant_id		= $this->input->post('participant_id');
					
			
				$this->Contents['schoolcode']		=	$school_code;
				
				$participant_array			=	$this->Certificate_model->get_attended_exhibition_school_participant_details(4,$school_code,'','','','');
				
					if (is_array($participant_array) && count($participant_array) >0)
					{	
					
						if($participant_array['certificate_details']!='nodata'){
							foreach ($participant_array['certificate_details'] as $certificate_details)
							{	
									$cm_array	=	array($certificate_details['participant_id'],$certificate_details['grade'],$certificate_details['is_withheld'],$certificate_details['rank'],$certificate_details['participant_item_dtls_id'],$certificate_details['fest_id']);
									
									
									$this->create_attended_certificate($participant_array['participant_details'],$cm_array,$certificate_template);
							}
							$this->fpdf->Output('certificate.pdf','D');	
						}
						else{
						redirect('test/nodata');
						}	
					}
				
				$this->Contents['school_details']	= 	$this->General_Model->get_data('school_master', 'school_code, school_name', array('school_code' => $school_code));
			}//if(count($certificate_template)>0)
			else{
				redirect('test/no_partTemplate/4');
			}
			
		}
		else{
			redirect('certificate/certificate/attended_certificate_exhibition_interface');
		}
		
}




function certificate_exhibition_4school($value)
{
		if($this->Session_Model->check_user_permission(48)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		
		$sub_dist_code					=	$this->session->userdata('SUB_DISTRICT');
		if($value=='merit'){
			$certificate_template	=	$this->Certificate_model->get_certificate_details(4,$sub_dist_code);
		}
		if($value=='part'){
			$certificate_template	=	$this->Certificate_model->get_attended_certificate_details(4,$sub_dist_code);
		}
		
		if(count($certificate_template)>0)
		{	
				$page_style				=	($certificate_template[0]['page_style'] == 'P') ? 'P' : 'L';
				$this->load->library('_fpdf/fpdf');
				$this->fpdf->Open();
				$this->fpdf->FPDF($page_style,'mm','A4');
				
				$participant_array			=	$this->Certificate_model->get_certificate_exhibition_4school($value);
				
				if (is_array($participant_array) && count($participant_array) >0 && $participant_array!='nodata')
				{	
						$this->create_certificate_4school($participant_array,$certificate_template);
						$this->fpdf->Output('certificate.pdf','D');	
				}//if (is_array($participant_array) && count($participant_array) >0)
				else{ 
								redirect('test/nodata');
				}	
		}//if(count($certificate_template)>0)
		else{ 
				if($value=='merit'){
					redirect('test/notemplate/4');
				}
				else if($value=='part'){
					redirect('test/no_partTemplate/4');
				}
		}	
}//certificate_exhibition_interface_4district()


function create_certificate_4school($participant_arraydata,$certificate_template){
		
		foreach($participant_arraydata as $participant_array){
		
				
		
			if($this->Session_Model->check_user_permission(48)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$page_style				=	($certificate_template[0]['page_style'] == 'P') ? 'P' : 'L';
			$line_height			=	($certificate_template[0]['line_height']) ? $certificate_template[0]['line_height'] : '1';
			$top_margin				=	($certificate_template[0]['top_margin']) ? $certificate_template[0]['top_margin'] : '1';
			$left_margin			=	($certificate_template[0]['left_margin']) ? $certificate_template[0]['left_margin'] : '1';
			$right_margin			=	($certificate_template[0]['right_margin']) ? $certificate_template[0]['right_margin'] : '1';
			
			$label_print			=	($certificate_template[0]['label_print']) ? $certificate_template[0]['label_print'] : 'N';
			
			$this->fpdf->AddPage();
			$this->fpdf->SetFont('Arial','B',14);
			
			$this->fpdf->SetMargins($left_margin,$top_margin,$right_margin);
			
			
			if ($certificate_template[0]['school_x'] and $certificate_template[0]['school_y'])
			{
				$this->fpdf->SetFont($certificate_template[0]['school_font'],'B',$certificate_template[0]['school_size']);
				$this->fpdf->SetXY($certificate_template[0]['school_x'],$certificate_template[0]['school_y']);
				if ($label_print == 'Y')
				{
					$this->fpdf->Write($line_height,'School');
					$this->fpdf->SetXY($certificate_template[0]['school_x']+30,$certificate_template[0]['school_y']);
					$this->fpdf->Write($line_height,' : ');
					$this->fpdf->SetXY($certificate_template[0]['school_x']+40,$certificate_template[0]['school_y']);
					$this->fpdf->Write($line_height,$participant_array['school_name']);
				}
				else
				{
					$this->fpdf->Write($line_height, $participant_array['school_name']);
				}
			}
			/*if ($certificate_template[0]['sub_dist_x'] and $certificate_template[0]['sub_dist_y'])
			{
				$this->fpdf->SetFont($certificate_template[0]['sub_dist_font'],'B',$certificate_template[0]['sub_dist_size']);
				$this->fpdf->SetXY($certificate_template[0]['sub_dist_x'],$certificate_template[0]['sub_dist_y']);
				if ($label_print == 'Y')
				{
					$this->fpdf->Write($line_height,'Sub District');
					$this->fpdf->SetXY($certificate_template[0]['sub_dist_x']+30,$certificate_template[0]['sub_dist_y']);
					$this->fpdf->Write($line_height,' : ');
					$this->fpdf->SetXY($certificate_template[0]['sub_dist_x']+40,$certificate_template[0]['sub_dist_y']);
					$this->fpdf->Write($line_height,$participant_array['sub_district_name']);
				}
				else
				{
					$this->fpdf->Write($line_height, $participant_array['sub_district_name']);
				}
			}*/
			
			if ($certificate_template[0]['fair_x'] and $certificate_template[0]['fair_y'])
			{
				$this->fpdf->SetFont($certificate_template[0]['fair_font'],'B',$certificate_template[0]['fair_size']);
				$this->fpdf->SetXY($certificate_template[0]['fair_x'],$certificate_template[0]['fair_y']);
				
				if ($label_print == 'Y')
				{
					$this->fpdf->Write($line_height,'Fair');
					$this->fpdf->SetXY($certificate_template[0]['fair_x']+30,$certificate_template[0]['fair_y']);
					$this->fpdf->Write($line_height,' : ');
					$this->fpdf->SetXY($certificate_template[0]['fair_x']+40,$certificate_template[0]['fair_y']);
					$this->fpdf->Write($line_height,$participant_array['fairName']);
				}
				else
				{
					$this->fpdf->Write($line_height,$participant_array['fairName']);
				}
			}
			
			if ($certificate_template[0]['grade_x'] and $certificate_template[0]['grade_y'])
			{
				$this->fpdf->SetFont($certificate_template[0]['grade_font'],'B',$certificate_template[0]['grade_size']);
				$this->fpdf->SetXY($certificate_template[0]['grade_x'],$certificate_template[0]['grade_y']);
				
				if ($label_print == 'Y')
				{
					$this->fpdf->Write($line_height,'Grade');
					$this->fpdf->SetXY($certificate_template[0]['grade_x']+30,$certificate_template[0]['grade_y']);
					$this->fpdf->Write($line_height,' : ');
					$this->fpdf->SetXY($certificate_template[0]['grade_x']+40,$certificate_template[0]['grade_y']);
					$this->fpdf->Write($line_height,$participant_array['grade']);
				}
				else
				{
					$this->fpdf->Write($line_height, $participant_array['grade']);
				}
			}
						
			if ($certificate_template[0]['date_x'] and $certificate_template[0]['date_y'])
			{
				$this->fpdf->SetFont($certificate_template[0]['date_font'],'B',$certificate_template[0]['date_size']);
				$this->fpdf->SetXY($certificate_template[0]['date_x'],$certificate_template[0]['date_y']);
				
				$end_date		=	end($this->General_Model->get_fest_date_array());
				
				if ($label_print == 'Y')
				{
					$this->fpdf->Write($line_height,'Date');
					$this->fpdf->SetXY($certificate_template[0]['date_x']+30,$certificate_template[0]['date_y']);
					$this->fpdf->Write($line_height,' : ');
					$this->fpdf->SetXY($certificate_template[0]['date_x']+40,$certificate_template[0]['date_y']);
					$this->fpdf->Write($line_height,$end_date);
				}
				else
				{
					$this->fpdf->Write($line_height,$end_date);
				}
			}
						
		}
		
}//create_certificate_4district($participant_arraydata,$certificate_template)




/////////////////////////End Certificate Only For Exhibition///////////////////////////////





	

}//class
?>