<?php
class Registration extends CI_Controller{ 
	public function __construct()
	{
		parent::__construct(); 
		$this->load->model('Session_Model');
		$this->load->model('login/Login_Model');
		$this->load->model('school/Registration_Model');
		$this->load->model('School_Details_Model');
		$this->load->model('maths/Maths_entry_Model');
		$this->load->model('IT/It_Model');
		$this->load->model('science/Science_Model');
		$this->load->model('workexp/Workexp_Model');
		$this->load->model('socialscience/Socialscience_Model');
		$this->load->library('session');
		$this->load->library('javascript');
		$this->template->add_js('js/common.js');
	}
	
	function index()
	{
		//$this->template->write_view('content','school/test');		 
		//$this->template->load();
	}
	
	
	
	
	//---------------- School List for All the Fair -------------//
	
	function school_details($fairId)
	{
	//var_dump($_POST);
	//echo  '<br><br><br>subdist----------'.$this->session->userdata('SUB_DISTRICT').'<br>user---------'.$fairId;
		$this->template->write_view('menu', 'menu', '');	
		$sub_district = $this->session->userdata('SUB_DISTRICT');
		$userId 	= $this->session->userdata('USERID');
		$this->Content=array();
		
		
		$this->Contents['school']	=	$this->General_Model->get_data('school_master','school_code,school_name,sub_district_code',array('sub_district_code' => $sub_district),'school_code');
		//echo '<br><br><br>';print_r($this->Contents['school']);
		foreach(@$this->Contents['school'] as $intRow=>$value)
		{
				$this->Content['details'][$intRow]['entered']	=	$this->Science_Model->school_existin_participant_item($value['school_code'],$fairId);
				
				$this->Content['details'][$intRow]['school_code']=$value['school_code'];
				$this->Content['details'][$intRow]['school_name']=$value['school_name'];
				$this->Content['details'][$intRow]['fairId']=$fairId;
		}
		//var_dump($this->Content['details']);
		
		
		if(@$fairId==1) {
		
			$this->template->write_view('content', 'science/science_entry_list',$this->Content);
		}
		else if(@$fairId==2) {
		
			$this->template->write_view('content', 'maths/maths_entry_list',$this->Content);
		}
		else if(@$fairId==3) {
		
			$this->template->write_view('content', 'socialscience/socialscience_entry_list',$this->Content);
		}
		else if(@$fairId==4) {
		
			$this->template->write_view('content', 'workexp/workexpo_entry_list',$this->Content);
		}
		else if(@$fairId==5) {
		
			$this->template->write_view('content', 'IT/IT_entry_list',$this->Content);
		}
		$this->template->load();
	
	}
	
	
	
	//-------------------------End-------------------------------//
	

	
	function school_entry($schoolcode,$category = 0,$fairid = 0,$fairdet = array(),$exb=0)
	{
	$this->Registration_Model->update_part_id();
	
		// echo '<br><br><br>schoolcode----'.$schoolcode.'fair---'.$fairid.'---exb'.$exb.'---cat=='.$category;	  
		// print_r($fairdet);
	 if($fairid == 4 && $exb==0 && !(is_array($fairdet)))
	 {			
		$is_onthe_spot_entered		=	$this->Registration_Model->get_exhib_details($schoolcode);
		if(count($is_onthe_spot_entered) == 0) {
		
			$exb	=	2;
			$category	=	0;
			$error	=	'First Enter Exhibition details';
			 $this->template->write('error',$error);			
		 } 	 	 
	 }	 
	 
		$this->template->write_view('menu', 'menu', '');	
		$school_details_flag					=	 $this->Registration_Model->get_school_details_flag($schoolcode);
		if(@$school_details_flag['0']['data_entered_flag']=="N")
		$this->Content['flag']	=	0;
		else
		$this->Content['flag']	=	1;
		
		$school_details						=	 $this->Registration_Model->get_school_details($schoolcode);
		
		$this->Content['science']			=	 $school_details[0]['fairScience'];
		$this->Content['maths']				=	 $school_details[0]['fairMathematics'];
		$this->Content['socialscience']		=	 $school_details[0]['fairSocialScience'];
		$this->Content['workexp']			=	 $school_details[0]['fairWorkExp'];
		$this->Content['it']				=	 $school_details[0]['fairITmela'];
		
		if($this->Login_Model->if_master_confirmed($schoolcode))
			 $this->Content['master_confirm']			=	 'Y';
			 else
			 $this->Content['master_confirm']			=	 'N';	
		
		$this->Content['fairId']				=	 ($fairid==0)?$this->input->post('fairId'):$fairid;
		
		$this->Content['school_details']	=	$school_details;		
			
		$this->template->write_view('content','school/school_entry',$this->Content);
		
		/************ If Category Exist ***************/
		
		
		 if(is_array($fairdet)){
			
			$this->Content['sucess']=@$fairdet['sucess'];
			$parti_id=@$fairdet['parti_id'];
			$exb=@$fairdet['exb'];
			$edit_delete=@$fairdet['edit_delete'];
			
			}
		
		if($category != 0 || $exb==2)
		{			 
			$festname ='';				
			if($category=='1')$festname="LP";else if($category=='2')$festname="UP";else if($category=='3')$festname="HS";else if($category=='4')$festname="HSS/VHSE";
			
			if($category==0 ){
			if($exb == 2)
			{
				$this->Content['classsectionary']  = array();
				$this->Content['classsectionary'][0]  = "Std";
				
				for($class_start=@$school_details[0]['class_start'];$class_start<=@$school_details[0]['class_end'];$class_start++)
				{
					$this->Content['classsectionary'][$class_start]  = $class_start;
				}
			}
			}
			else if($category==1)$this->Content['classsectionary']  = array(0=>"Std",1=>1,2=>2,3=>3,4=>4);
			else if($category==2)$this->Content['classsectionary']  = array(0=>"Std",5=>5,6=>6,7=>7);
			else if($category==3)$this->Content['classsectionary']  = array(0=>"Std",8=>8,9=>9,10=>10);
			else if($category==4){$this->Content['classsectionary'] = array(0=>"Std",11=>11,12=>12);
			$this->Content['admn_category']=array(0=>"Select",'H'=>'HSS','V'=>'VHSS');
			$this->Content['festid'] = $category;
			}
			if(is_array($fairdet) && @$fairdet['edit_item']==1){
		//echo '<br><br><br>ddddddddd';
		//print_r(@$fairdet['edit_itemcode']);
			$this->Content['item_details']	=	@$fairdet['edit_itemcode'];
			
			}
			else{
		
		   if($exb==0)
			$this->Content['item_details']	=	 $this->Registration_Model->get_item_details($category,$fairid);
			else
			$this->Content['item_details']	=	 $this->Registration_Model->get_item_details_exb($category,$fairid,@$school_details[0]['class_end']);
			
			}
			
			 if($exb==0){
			
			$this->Content['parti_details']	=	 $this->Registration_Model->get_details($schoolcode,$category,$fairid,$exb);
			
			}
			else
			$this->Content['parti_details']	=	 $this->Registration_Model->get_details_exb($schoolcode,$category,$fairid,$exb);
			
			$this->Content['designations']=$this->Registration_Model->get_designation_details();
			$this->Content['escorting_details']	=	 $this->Registration_Model->get_escorting_teacher_details($schoolcode,$fairid);
		
			if(count($this->Content['escorting_details']) && is_array($fairdet) && @$fairdet['edit']!=1)
			{ $this->Content['esc_flag']	=	1; }
			else
			{ $this->Content['esc_flag']	=	2; }	
				
			$this->Content['category']	=	$category;
			$this->Content['flag']	=	1;
			
			$this->Content['part_flag']	=	@$fairdet['part_flag'];
			
			$teachingflag =0;
			if(@$school_details[0]['class_end']==4 && $category==1 && ($fairid==1 || $fairid==2 || $fairid==3))
			{
				$this->Content['teachingaid'] =0;$this->Content['teachingproject']=0;
				$this->Content['teachingaid']=$this->Registration_Model->get_teachingaid($schoolcode,$fairid,$category);
				if($fairid==1)$this->Content['teachingproject']=$this->Registration_Model->get_teachingproject($schoolcode,$fairid,$category);
				
				if(count($this->Content['teachingaid']) || count($this->Content['teachingproject']))$teachingflag = 1;
				else $teachingflag = 2;
				
					
				
			
			
			}
			
							
			if((count($this->Content['parti_details']) || (@$teachingflag == 1)) &&  (@$fairdet['edit']!=1) )
			{ 
			
			
				if(is_array($fairdet) && @$fairdet['error']<>'')$this->Content['parti_flag'] = 2;
				else $this->Content['parti_flag']	=	1;
			
		
			 }
			else
			{ $this->Content['parti_flag']	=	2; }			
			
			if($category==0 ){
			
			if($exb == 2)
			{
			  $cls_str		= @$school_details[0]['strength_lp'] + @$school_details[0]['strength_up'] + @$school_details[0]['strength_hs'] + @$school_details[0]['strength_hss'] + @$school_details[0]['strength_vhss']; } }
			if($category	==	1) {  $cls_str		= @$school_details[0]['strength_lp']; } 
			if($category	==	2) {  $cls_str		= @$school_details[0]['strength_up']; } 
			if($category	==	3) {  $cls_str		= @$school_details[0]['strength_hs']; } 
			if($category	==	4) {  $cls_str		= @$school_details[0]['strength_hss'] + @$school_details[0]['strength_vhss']; } 
				
		
			if($cls_str){ //checking the availability of the category in the school
				
				/*************** Science fair *****************/
				if($fairid ==	1){ 	
										
					if($this->Login_Model->if_school_data_confirmed($schoolcode,'fairScience'))
					$this->Content['confirm']			=	 'Y';
					else
					$this->Content['confirm']			=	 'N';
					$this->Content['Heading'] = 'Science Fair Registration for '.$festname; 
						
					$this->template->write_view('content','science/science_entry',$this->Content);					
				}
				
				
				/*************** Mathematics fair *****************/
				if($fairid ==	2){	
					if($this->Login_Model->if_school_data_confirmed($schoolcode,'fairMathematics'))
					$this->Content['confirm']			=	 'Y';
					else
					$this->Content['confirm']			=	 'N';						
					$this->Content['Heading'] = 'Mathematics Fair Registration for '.$festname;
					$this->template->write_view('content','maths/maths_entry_form',$this->Content);	
				}
								
				/*************** Social Scinece fair *****************/
				if($fairid ==	3){			
					if($this->Login_Model->if_school_data_confirmed($schoolcode,'fairSocialScience'))
					$this->Content['confirm']			=	 'Y';
					else
					$this->Content['confirm']			=	 'N';				
					$this->Content['Heading'] = 'Social Science Fair Registration for '.$festname;
					$this->Content['parti_id']=@$parti_id;
					$this->Content['edit_delete']=@$edit_delete;
					$this->template->write_view('content','socialscience/socialscience_entry',$this->Content);	
				}
				
				
				/*************** Work Experience fair *****************/
				if($fairid ==	4){			
				    if($this->Login_Model->if_school_data_confirmed($schoolcode,'fairWorkExp'))
					$this->Content['confirm']			=	 'Y';
					else
					$this->Content['confirm']			=	 'N';						
					if($exb == 0){ $workexpo	=	'On the spot competition';
										
					} else{ $workexpo	=	'Exhibition'; } 			
					//$this->Content['Heading'] = "Work experience '".$workexpo."' Registration for " .$festname;
					$this->Content['Heading'] = "Work experience '".$workexpo."' Registration ";
					if($exb==0)$this->Content['Heading'] .= " for " .$festname;
					//echo '<br><br><br>'.$exb;
					$this->Content['exb']=$exb;
					if($exb == 0) {
					$this->template->write_view('content','workexp/workexp_entry',$this->Content);
					} else {
					
					
					$this->Content['admn_category']=array(0=>"Select",'H'=>'HSS','V'=>'VHSS');
					
					$this->template->write_view('content','workexp/workexp_entry_exhib',$this->Content);
					}	
				}				
				
				/*************** IT fair *****************/
				if($fairid ==	5){			
					if($this->Login_Model->if_school_data_confirmed($schoolcode,'fairITmela'))
					$this->Content['confirm']			=	 'Y';
					else
					$this->Content['confirm']			=	 'N';				
					$this->Content['Heading'] = 'IT Fair Registration for '.$festname;
					$this->template->write_view('content','IT/IT_entry',$this->Content);	
				}
				
			 } //if($cls_str)	 
			 else {	
			// echo 'exp======='.$exb;
			 $error	=	'No '.$festname.' category for this school!';
			 
			 $this->template->write('error',$error);}	
		
		} //if($category != NULL)
			
		
		$this->template->load();
	}
	function get_school_details()
	{//var_dump($_POST);
		$this->form_validation->set_rules('txtSchoolPhone', 'SchoolPhoneNumber', 'trim|required');
		$this->form_validation->set_rules('txtSchoolEmail', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('txtStandardFrom', 'From standard', 'trim|required');
		$this->form_validation->set_rules('txtStandardTo', 'To standard', 'trim|required');
		$this->form_validation->set_rules('txtTotalLP', 'Number of LP student', 'trim|required');
		$this->form_validation->set_rules('txtTotalUP', 'Number of UP student', 'trim|required');
		$this->form_validation->set_rules('txtTotalHS', 'Number of HS student', 'trim|required');
		//$this->form_validation->set_rules('txtTotalHSS', 'Number of HSS student', 'trim|required');
		//$this->form_validation->set_rules('txtTotalVHSS', 'Number of VHSS student', 'trim|required');
		
		if ($this->form_validation->run() == false)
		{	
			$school_details['0']['school_code']		=	(int)$this->input->post('txtSchoolCode');
			$schoolcode								=	(int)$this->input->post('txtSchoolCode');		
			$school_details['0']['class_start']		=	(int)$this->input->post('txtStandardFrom');
			$school_details['0']['class_end']		=	(int)$this->input->post('txtStandardTo');
			$school_details['0']['school_phone']	=	$this->input->post('txtSchoolPhone');
			$school_details['0']['school_email']	=	$this->input->post('txtSchoolEmail');
			$school_details['0']['hm_name']			=	$this->input->post('txtHeadmaster');
			$school_details['0']['hm_phone']		=	$this->input->post('txtHeadmasterPhone');
			$school_details['0']['school_type']		=	$this->input->post('type1');
			$school_details['0']['principal_name']	=	$this->input->post('txtPrincipal');
			$school_details['0']['principal_phone']	=	$this->input->post('txtPrincipalPhone');
			$school_details['0']['strength_lp']		=	(int)$this->input->post('txtTotalLP');
			$school_details['0']['strength_up']		=	(int)$this->input->post('txtTotalUP');
			$school_details['0']['strength_hs']		=	(int)$this->input->post('txtTotalHS');
			$school_details['0']['strength_hss']	=	(int)$this->input->post('txtTotalHSS');
			$school_details['0']['strength_vhss']	=	(int)$this->input->post('txtTotalVHSS');
			$school_details['0']['total_strength']	=	(int)$this->input->post('txtTotal');
			$this->Content['school_details']	=	$school_details;			
			$error	=	 validation_errors();
			$formvalidation_flag=1;
			$this->template->write('error',$error);						
		}
		else
		{
			$schoolcode=(int)$this->input->post('txtSchoolCode');
			$school_details_flag			=	 $this->Registration_Model->get_school_details_flag($schoolcode);
			$message		=	$this->Registration_Model->save_school_details($schoolcode);
			if($message)
			{
				$school_details_flag		=	 $this->Registration_Model->get_school_details_flag($schoolcode);
				$this->template->write('sucess'," School Details Inserted Successfully");	
				if($school_details_flag['0']['data_entered_flag']=="N")
				$this->Content['flag']	=	0;
				else
				$this->Content['flag']	=	1;
			}
			$this->Registration_Model->log_school_details($schoolcode);
			$school_details						=	 $this->Registration_Model->get_school_details($schoolcode);
			$this->Content['school_details']	=	$school_details;		
		}	
		if($this->Login_Model->if_master_confirmed($schoolcode))
			 $this->Content['master_confirm']			=	 'Y';
			 else
			 $this->Content['master_confirm']			=	 'N';
		
		$this->template->write_view('menu', 'menu', '');	
		$this->template->write_view('content','school/school_entry',$this->Content);				
		$this->template->load();
	}
	
	
	function school_finalize($schoolcode)
	{
		$this->Content['flag']	=	0;
		$school_finalize					=	 $this->Registration_Model->school_finalize($schoolcode);
		$this->template->write('sucess'," School Details Confirmed Successfully");	
		$school_details						=	 $this->Registration_Model->get_school_details($schoolcode);
		$this->Content['school_details']	=	$school_details;
		//print_r($this->Content['school_details']);
		if($this->Login_Model->if_master_confirmed($schoolcode))
			 $this->Content['master_confirm']			=	 'Y';
			 else
			 $this->Content['master_confirm']			=	 'N';
			 
			// $this->school_entry($schoolcode,$category,$fairid,$this->Content);
		$this->school_entry($schoolcode,0,0,$this->Content);
		/*$this->template->write_view('menu', 'menu', '');	
		$this->template->write_view('content','school/school_entry',$this->Content);		 
		$this->template->load();*/
	}
	
	function school_reset($schoolcode)
	{
		$this->Content['flag']	=	0;
		$school_details						=	 $this->Registration_Model->get_school_details($schoolcode);
		$this->Content['school_details']	=	$school_details;
		if($this->Login_Model->if_master_confirmed($schoolcode))
			 $this->Content['master_confirm']			=	 'Y';
			 else
			 $this->Content['master_confirm']			=	 'N';
		$this->template->write_view('menu', 'menu', '');	
		$this->template->write_view('content','school/school_entry',$this->Content);		 
		$this->template->load();
	}
	function part_reset($schoolcode,$category,$fareid,$exb)
	{	$this->Content['edit_item']	=	2;
		$this->Content['part_flag']	=	2;
		$this->Content['edit']	=	1;		
		$this->Content['exb']	=	$exb;		
		$this->school_entry($schoolcode,$category,$fareid,$this->Content);
	}
	//////////////////////// for delete participants with item code ///////////////
	function part_delete($schoolcode,$category,$fairid,$item_code,$exb,$admn,$parti_id=0)
	{	
//	echo "<br /><br />kiloooo";
	$this->Content['exb']	=	$exb;	
	$this->Content['part_flag']	=	1;
	$this->Content['parti_id']	=	$parti_id;
	if($parti_id > 0)$this->Content['edit_delete']='delete';
	if($exb !=2) {
	$maths_delete_itemcode						=	 $this->Registration_Model->delete_details($schoolcode,$category,$fairid,$item_code,$admn,$parti_id); }
	else {
			
			
			$exb_delete_parti					=	 $this->Registration_Model->workexp_exb_delete_parti($schoolcode,$admn);
	}
	
	$this->school_entry($schoolcode,$category,$fairid,$this->Content);
	}
	////////////////////end ///////////////////////////////////////
	
	//////////////////////// for edit participants with item code ///////////////
	function part_edit($schoolcode,$category,$fairid,$item_code,$parti_id=0,$exb)
	{	
	
	
	$this->Content['part_flag']	=	1;
	$this->Content['edit_item']	=	1;
	$this->Content['edit']		=	1;
	$this->Content['parti_id']	=	$parti_id;	
	$this->Content['exb']		=	$exb;	
	$this->Content['code_item']	=	$item_code;	
	if($parti_id > 0)$this->Content['edit_delete']='edit';
	$edit_itemcode				=	 $this->Registration_Model->get_itemdetails_itemcode($category,$fairid,$item_code);
	$this->Content['edit_itemcode']	=	$edit_itemcode;
	$this->school_entry($schoolcode,$category,$fairid,$this->Content);
	}
	////////////////////end ///////////////////////////////////////
	function esc_teacher_ajax($numEscTeachers,$count)
	{

		$data['numEscTeachers'] = $numEscTeachers;
		$data['count'] = $count;
		$data['designations']=$this->Registration_Model->get_designation_details();
		$this->load->view('ajax/school_ajax',$data);
	}
	
	
	////////////////   function for saving  details /////////////////////////////
	
	
	function save_details()
	{
	//echo '<br><br><br>'.$this->input->post('code_item');
	//print_r($this->Content);	
		//$this->form_validation->set_rules('escorting_teacher_num', 'Number of Escorting Teacher', 'required|is_natural_no_zero');
		//echo '<br><br>edititem==='.@$_POST['edit_item'].'----item===='.(int)$this->input->post('item_code').'<br>';
		
		$schoolcode		=	(int)$this->input->post('schoolcode');	
		$category		=	(int)$this->input->post('festid');
		$fairid			=	(int)$this->input->post('fairid');
		$exb=0;
		if($fairid==4)
		$exb			=	(int)$this->input->post('exb');
		$item_count		=	(int)$this->input->post('item_count');
		
			if((int)$this->input->post('edit_item')==1){
			$code_item	=	(int)$this->input->post('code_item');
			
			 
			$this->Content['item_details']	=	$this->Registration_Model->get_itemdetails_itemcode($category,$fairid,$code_item);
			
			}
			else{
		 if($exb==0)
			$this->Content['item_details']	=	 $this->Registration_Model->get_item_details($category,$fairid);
			else
			$this->Content['item_details']	=	 $this->Registration_Model->get_item_details_exb($category,$fairid,@$_POST['class_to']);
			}
			
			
		$this->Content['category']			=	$category;
		$this->Content['Heading'] 			= 	(int)$this->input->post('heading');	
		$this->Content['flag']				=	1;
		
		$data['error'] = '';
		if($this->input->post('escorting_teacher_num')==0)$data['error']	.= 'The Number of Escorting Teacher field must contain a number greater than zero.</br>';
		
		/*if($fairid==4){
		if($this->input->post('name_team')=='')$data['error']	.= 'Name of TeamManager/Joint Team Manager Required.</br>';
		if($this->input->post('address_team')=='')$data['error']	.= 'Address of TeamManager/Joint Team Manager Required.</br>';
		if($this->input->post('phone_team')=='')$data['error']	.= ' Phone Number of TeamManager/Joint Team Manager Required.</br>';
		}*/
		
		for($i=1;$i<=$this->input->post('escorting_teacher_num');$i++)
		{
			if((@$this->input->post('escorting_teacher_num')>0))
			{
				if((@$_POST['escorting_teacher_name'][@$i]==NULL) || (@$_POST['designation'][@$i]==0) || (@$_POST['escorting_teacher_phone'][@$i]==NULL))$data['error']	.= 'Escorting Teacher name , Designation  &amp; Phone  in row - '.$i.' is required<br>';					
			}
		}
		$k=0;				
		$fg=0;
		$item_array = $this->Content['item_details'];
		
		//echo '<br><br><br>';
		//print_r($item_array);
		$item = count($item_array);
		if($exb==0)
		{
		for($m=0;$m<$item;$m++)
		{
			@$max_participants[$m]=@$item_array[$m]['max_participants'];
			while($max_participants[$m]!=0){
				@$k=@$max_participants[$m];
				
				if(((@$item_array[$m]['item_code']==138 || @$item_array[$m]['item_code']==147 || @$item_array[$m]['item_code']==164 || @$item_array[$m]['item_code']==182 || @$item_array[$m]['item_code']==123 )) && (@$_POST['name_magazine'.$item_array[$m]['item_code'].$k] != '' || @$_POST['exhibit_name'.$item_array[$m]['item_code']] != ''))
				{
					@$fg=1;
					break;
				}
				
				if((@$_POST['adm_no'.$item_array[$m]['item_code'].$k]>0 || @$_POST['adm_no'.$item_array[$m]['item_code'].$k] != '' ) && (@$item_array[$m]['item_code']<>138 || @$item_array[$m]['item_code']<>147 || @$item_array[$m]['item_code']<>164 || @$item_array[$m]['item_code']<>182 || @$item_array[$m]['item_code']<>123 )  )
				{
					@$fg=1;
					break;
					
				}
				
				
				@$max_participants[$m]=@$max_participants[$m]-1;
			}
			
			if($fg == 1)break;
		}
		
		$k=0;
		if($fg == 1)
		{
			for($m=0;$m<$item;$m++)
			{
				@$max_participants[$m]=@$item_array[$m]['max_participants'];
				while($max_participants[$m]!=0){
				
					 @$k=@$max_participants[$m];
					 
					 $admn_no					=	@$_POST['adm_no'.$item_array[$m]['item_code'].$k];
					 if($category==4){
					 $admn_fest1=str_split($admn_no,1);
					 $admn_fest= $admn_fest1[0];
					 $admn_category1='admn_category'.$item_array[$m]['item_code'].$k;
					 $admn_category=$this->input->post($admn_category1);
					 if($admn_fest!='H' && $admn_fest!='V'){
					 
					 $admn_no=$admn_category.@$_POST['adm_no'.$item_array[$m]['item_code'].$k];
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
					 $basic_flag =0;
					 if(@$_POST['adm_no'.$item_array[$m]['item_code'].$k]>0 || @$_POST['adm_no'.$item_array[$m]['item_code'].$k] != ''){
					 $basic_flag = $this->Registration_Model->check_basic_dtls($schoolcode,$admn_no,@$_POST['name_participant'.$item_array[$m]['item_code'].$k],@$_POST['txtStandard'.$item_array[$m]['item_code'].$k],@$_POST['txtgender'.$item_array[$m]['item_code'].$k],$item_array[$m]['item_code']);
					 
					 
					 if($basic_flag == 1){$admission_number = $admn_no; break;}
					 }
					 @$max_participants[$m]=@$max_participants[$m]-1;
				}
				if($basic_flag == 1){$admission_number = $admn_no; break;}
			}
		
		}
		
		
		
		if((@$_POST['item_code_sc1']==194 || @$_POST['item_code_sc1']==146 || @$_POST['item_code_sc1']==111 ) && @$_POST['admn_no_sc1'] != '')
		{//echo '1111';
			@$fg=1;
		}

		
		if( @$_POST['item_code_sc2']==112  && @$_POST['admn_no_sc2'] != '')
		{//echo '222';
			@$fg=1;
		}
		
	//echo $fg;
		
			
		if((@$fg==0) && (@$this->input->post('escorting_teacher_num')>0))
		{
				
			$data['error']	.='Participant details required';
			//break;
		}
			
		if((@$basic_flag > 0))
		{
			
			$data['error']	.='Admission number('.$admission_number.') is already exist with different participant name/standard/gender .';
			//break;
		}
			
		
		}
		else
		{
			for($p=1;$p<6;$p++) { 
			
				$admn_no = @$_POST['adm_no'.$p];
				if((@$_POST['adm_no'.$p] > 0) && (@$_POST['txtStandard'.$p] == 11 || @$_POST['txtStandard'.$p] == 12))
				{
					
					 $admn_fest1=str_split($admn_no,1);
					 $admn_fest= $admn_fest1[0];
					 $admn_category1='admn_category'.$p;
					 $admn_category=$this->input->post($admn_category1);
					 if($admn_fest!='H' && $admn_fest!='V'){
					 
					 $admn_no=$admn_category.@$_POST['adm_no'.$p];
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
			
				 $basic_flag =0;
				 if(@$_POST['adm_no'.$p] > 0 || @$_POST['adm_no'.$p] != ''){
				 $basic_flag = $this->Registration_Model->check_basic_dtls($schoolcode,$admn_no,@$_POST['name_participant'.$p],@$_POST['txtStandard'.$p],@$_POST['txtgender'.$p]);
				//echo $basic_flag;
				if($basic_flag == 1){$admission_number = $admn_no; break;}
					 }
					
				}
				
			if((@$basic_flag > 0))
			{
				
				$data['error']	.='Admission number('.$admission_number.') is already exist with different participant name/standard/gender .';
				$this->Content['exb']	=	$exb;
				//break;
			}	
			
		}
		
		
		//echo "oo".$exb;	
		if ($this->form_validation->run() == false)
		if($data['error']<>'')
		{			
			$maths_details['0']['escorting']	=(int)$this->input->post('escorting');
			$error	=	 validation_errors();
			$formvalidation_flag=1;
			$this->Content['error']	=	$data['error'];
		}
		else
		{
			//echo "<br /><br /><br /><br /><br /><br /><br />";
			//echo "kooooooooooo";	
			//print_r($this->Content['item_details']);
			
			
			$escorting_details_save		=	 $this->Registration_Model->save_escorting_details();
			
			/*********** Saving Science fair entry ******************/
			if($fairid	==	1)
			{
				@$science_details_save					=	 $this->Science_Model->save_science_details($schoolcode,$category,$fairid,$this->Content['item_details']);
				
				//echo "<br /><br />".$science_details_save;
				if(@$science_details_save['flg']==3)	
				{
					$this->Content['error']	=	"Participants Details of ".@$science_details_save['name']." Not Saved Admission no already exist";
					
					
				}
				 else if(@$science_details_save['flg']==2)
				{
						$this->Content['sucess']="Participants Details Inserted Successfully";
							
				}
					
			}
						
			/*********** Saving  Mathematics fair entry ******************/		 
			if($fairid	==	2)
			{
				@$maths_details_save						=	 $this->Maths_entry_Model->save_maths_details($schoolcode,$category,$fairid,$this->Content['item_details']);
								
					 if(@$maths_details_save['flg']==3)
					{
					$this->Content['error']		=	"Participants Details of ".@$maths_details_save['name']." Not Saved Admission no already exist";	
					}
					else if(@$maths_details_save['flg']==2)
					{
						/*if(@$maths_details_save['flg']==2)*/
						$this->Content['sucess']		=	"Participants Details Saved Successfully";	
								
					}
					
					
					
			}
			
			/*********** Saving Social fair entry ******************/			
			if($fairid	==	3)
			{
				@$socialscience_details_save				=	 $this->Socialscience_Model->save_socialscience_details($schoolcode,$category,$fairid,$this->Content['item_details']); 				
			
				 if(@$socialscience_details_save['flg']==3)
					{
					$this->Content['error']		=	"Participants Details of ".@$socialscience_details_save['name']." Not Saved Admission no already exist";	
					}
					 else if(@$socialscience_details_save['flg']==4)
				{
						$this->Content['error']="Same Admission number with different names";
										
				}
					 else if(@$socialscience_details_save['flg']==2)
					{
						/*if(@$maths_details_save['flg']==2)*/
						$this->Content['sucess']		=	"Participants Details Saved Successfully";		
					}
					
						/*$sucess="Participants Details Inserted Successfully";
						$this->Content['sucess']	=	$sucess;	*/						
				
			}
			
			
			/*********** Saving Work Experience fair entry ******************/			
			if($fairid	==	4)
			{
		
			// echo "<br />ggkeriii";
			    if($exb==0){
				//echo "oo".$exb;
				@$workexpo_details_save				=	 $this->Workexp_Model->save_workexpo_details($schoolcode,$category,$fairid,$exb,$this->Content['item_details']); 
				$this->Content['exb']	=	$exb;
				}	
				else{
				
				@$workexpo_details_save				=	 $this->Workexp_Model->save_workexpo_details_exb($schoolcode,$category,$fairid,$exb,$this->Content['item_details']); 

				$this->Content['exb']	=	$exb;
						}

					if(@$workexpo_details_save['flg']==3)
					{
						if($exb==0){
							$this->Content['error']		=	"Participants Details of ".@$workexpo_details_save['name']." Not Saved Admission no already exist";	
						}
						else
						{
							$this->Content['error']		=	"Participants Details  Not Saved Admission no already exist";	
						}
					
					}
					 else if(@$workexpo_details_save['flg']==4)
				{
						$this->Content['error']="Same Admission number with different names";
										
				}
					 else if(@$workexpo_details_save['flg']==2)
					{
						/*if(@$maths_details_save['flg']==2)*/
						$this->Content['sucess']		=	"Participants Details Saved Successfully";		
					}
						
									
					
			}
			
			
			/*********** Saving IT fair entry ******************/			
			if($fairid	==	5)
			{
			@$IT_details_save				=	 $this->It_Model->save_IT_details($schoolcode,$category,$fairid,$this->Content['item_details']); 				
				
					
					 if(@$IT_details_save['flg']==3)
					{
					$this->Content['error']		=	"Participants Details of ".@$IT_details_save['name']." Not Saved Admission no already exist";	
					}
					 else if(@$IT_details_save['flg']==4)
					{
							$this->Content['error']="Same Admission number with different names";
											
					}
					 else if(@$IT_details_save['flg']==2)
					{
						/*if(@$maths_details_save['flg']==2)*/
						$this->Content['sucess']		=	"Participants Details Saved Successfully";		
					}
			}
			
			
		}// else
			$this->school_entry($schoolcode,$category,$fairid,$this->Content);
			
	// for print
	
	
			
	}
	
function school_entry_print($schoolcode,$fairid,$exb){
	$this->template->write_view('menu', 'menu', '');	
	 $this->Content['fairid']						=	 $fairid;
	 $this->Content['school_details']						=	 $this->Registration_Model->get_school_details($schoolcode);
	 $this->Content['designations']								=	 $this->Registration_Model->get_designation_details();
	 $this->Content['escorting_details']						=	 $this->Registration_Model->get_escorting_teacher_details($schoolcode,$fairid);
	 
	 if($exb==0){
	  $this->Content['item_details_lp']							=	 $this->Registration_Model->get_item_details(1,$fairid);
	  $this->Content['item_details_up']							=	 $this->Registration_Model->get_item_details(2,$fairid);
	  $this->Content['item_details_hs']							=	 $this->Registration_Model->get_item_details(3,$fairid);
	  $this->Content['item_details_hss']						=	 $this->Registration_Model->get_item_details(4,$fairid);
	  
	  $this->Content['count_lp']								=	 $this->Registration_Model->get_participant_details($schoolcode,$fairid,1);
	  $this->Content['count_up']								=	 $this->Registration_Model->get_participant_details($schoolcode,$fairid,2);
	  $this->Content['count_hs']								=	 $this->Registration_Model->get_participant_details($schoolcode,$fairid,3);
	  $this->Content['count_hss']								=	 $this->Registration_Model->get_participant_details($schoolcode,$fairid,4);
	  }
	  else if($exb==2)
	  {
	  $this->Content['item_details_lp']							=	 $this->Registration_Model->get_item_details_exb(1,$fairid,$this->Content['school_details'][0]['class_end']);
	  $this->Content['item_details_up']							=	 $this->Registration_Model->get_item_details_exb(2,$fairid);
	  $this->Content['item_details_hs']							=	 $this->Registration_Model->get_item_details_exb(3,$fairid);
	  $this->Content['item_details_hss']						=	 $this->Registration_Model->get_item_details_exb(4,$fairid);
	  $this->Content['count_lp']								=	 $this->Registration_Model->get_participant_details_exb($schoolcode,$fairid,1);
	  $this->Content['count_up']								=	 $this->Registration_Model->get_participant_details_exb($schoolcode,$fairid,2);
	  $this->Content['count_hs']								=	 $this->Registration_Model->get_participant_details_exb($schoolcode,$fairid,3);
	  $this->Content['count_hss']								=	 $this->Registration_Model->get_participant_details_exb($schoolcode,$fairid,4);

	  //$this->Content['escorting_details']						=	 $this->Registration_Model->exb($schoolcode,$fairid);
	  $this->Content['heading']="Exhibition";
	  }
	 $this->Content['exb']=$exb;
	 if($fairid==1){
	 $this->template->write_view('content','science/science_entry_print',$this->Content);	
	 }
	  if($fairid==2){
	 $this->template->write_view('content','maths/maths_entry_print',$this->Content);	
	 }
	 if($fairid==3){
	 $this->template->write_view('content','socialscience/socialscience_entry_print',$this->Content);	
	 }
	  if($fairid==4){
	 	  if($exb==2)$this->template->write_view('content','workexp/workexp_exb_entry_print',$this->Content);
		  else  	 $this->template->write_view('content','workexp/workexp_entry_print',$this->Content);	
	 }
	  if($fairid==5){
	$this->template->write_view('content','IT/it_entry_print',$this->Content);
	 }
	 
	 $this->template->load();
	}		
	function maths_print_details(){
	$schoolcode=$this->input->post('sch_code');
	$fairid=$this->input->post('fairid');
	$exb=$this->input->post('exb');
	$userId 	= $this->session->userdata('USERID');
	$this->Content['cluster']	=	$this->School_Details_Model->clusterdetails($userId);
	
	 $this->Content['fairid']								=	 $fairid;
	 $this->Content['school_details']						=	 $this->Registration_Model->get_school_details($schoolcode);
	  $this->Content['designations']								=	 $this->Registration_Model->get_designation_details();
	 
	 if($exb==0){
	  $this->Content['item_details_lp']							=	 $this->Registration_Model->get_item_details(1,$fairid);
	  $this->Content['item_details_up']							=	 $this->Registration_Model->get_item_details(2,$fairid);
	  $this->Content['item_details_hs']							=	 $this->Registration_Model->get_item_details(3,$fairid);
	  $this->Content['item_details_hss']						=	 $this->Registration_Model->get_item_details(4,$fairid);
	  $this->Content['escorting_details']						=	 $this->Registration_Model->get_escorting_teacher_details($schoolcode,$fairid);
	  $this->Content['count_lp']								=	 $this->Registration_Model->get_participant_details($schoolcode,$fairid,1);
	  $this->Content['count_up']								=	 $this->Registration_Model->get_participant_details($schoolcode,$fairid,2);
	  $this->Content['count_hs']								=	 $this->Registration_Model->get_participant_details($schoolcode,$fairid,3);
	  $this->Content['count_hss']								=	 $this->Registration_Model->get_participant_details($schoolcode,$fairid,4);

	  }
	  else if($exb==2)
	  {
	  $this->Content['item_details_lp']							=	 $this->Registration_Model->get_item_details_exb(1,$fairid,$this->Content['school_details'][0]['class_end']);
	  $this->Content['item_details_up']							=	 $this->Registration_Model->get_item_details_exb(2,$fairid);
	  $this->Content['item_details_hs']							=	 $this->Registration_Model->get_item_details_exb(3,$fairid);
	  $this->Content['item_details_hss']						=	 $this->Registration_Model->get_item_details_exb(4,$fairid);
	  $this->Content['escorting_details']						=	 $this->Registration_Model->get_escorting_teacher_details_exb($schoolcode,$fairid);
	  $this->Content['count_lp']								=	 $this->Registration_Model->get_participant_details_exb($schoolcode,$fairid,1);
	  $this->Content['count_up']								=	 $this->Registration_Model->get_participant_details_exb($schoolcode,$fairid,2);
	  $this->Content['count_hs']								=	 $this->Registration_Model->get_participant_details_exb($schoolcode,$fairid,3);
	  $this->Content['count_hss']								=	 $this->Registration_Model->get_participant_details_exb($schoolcode,$fairid,4);

	  $this->Content['heading']="Exhibition";
	  }
	 $this->Content['exb']=$exb;
	
	
	$this->load->library('HTML2PDF');
	if($fairid==1)
	$content					= $this->load->view('science/science_entry_print_pdf',$this->Content, true);
	else if($fairid==2)
	$content					= $this->load->view('maths/maths_entry_print_pdf',$this->Content, true);
	else if($fairid==3)
	$content					= $this->load->view('socialscience/socialscience_entry_print_pdf',$this->Content, true);
	else if($fairid==4)
	{
		if($exb==2)$content = $this->load->view('workexp/workexp_exb_entry_print_pdf',$this->Content, true);
		else $content = $this->load->view('workexp/workexp_entry_print_pdf',$this->Content, true);
	}
	else if($fairid==5)
	$content					= $this->load->view('IT/it_entry_print_pdf',$this->Content, true);
	
		$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('project_urls.pdf', 'D');
	}
	
}

?>