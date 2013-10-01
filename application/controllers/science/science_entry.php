<?php
class Science_entry extends CI_Controller{ 
	
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
		$this->template->write_view('menu', 'menu', '');
	}
	function index()
	{
		//$this->template->write_view('content','school/test');		 
		//$this->template->load();
	}
	
	//function science_school_entry($schoolcode,$category = 0,$fairid = 0,$fairdet = array(),$exb=0)
	function science_school_entry($schoolcode,$fairid = 0,$fairdet = array(),$exb=0)
	{
	  //if($exb==2)
	 
	  
	  //echo '----------------------<br><br>'.$fairid;
	 // var_dump($_POST);
		$this->template->write_view('menu', 'menu', '');	
		$school_details_flag					=	 $this->Registration_Model->get_school_details_flag($schoolcode);
		
		if($school_details_flag['0']['data_entered_flag']=="N")
		$this->Content['flag']	=	0;
		else
		$this->Content['flag']	=	1;
		
		$school_details						=	 $this->Registration_Model->get_school_details($schoolcode);
		//var_dump($school_details);
		$this->Content['science']			=	 $school_details[0]['fairScience'];
		$this->Content['maths']				=	 $school_details[0]['fairMathematics'];
		$this->Content['socialscience']		=	 $school_details[0]['fairSocialScience'];
		$this->Content['workexp']			=	 $school_details[0]['fairWorkExp'];
		$this->Content['it']				=	 $school_details[0]['fairITmela'];
		$this->Content['data_entered']		=	 $school_details[0]['data_entered_flag'];
		//echo $fairid;
		/*if($this->Login_Model->if_master_confirmed($schoolcode))
			 $this->Content['master_confirm']			=	 'Y';
			 else
			 $this->Content['master_confirm']			=	 'N';*/
		 
		
		$this->Content['fairId']	=	$fairid;
		
	//	if($this->Content['flag']==1)
		$this->Content['school_details']	=	$school_details;
		
		$this->template->write_view('content','school/school_entry',$this->Content);
		
		/************ If Category Exist ***************/
		
		/*if($category != NULL)
		{	
		 //  var_dump(@$fairdet);
		   /* if($fairdet!=NULL){
			
			$this->Content['sucess']=@$fairdet['sucess'];
			$parti_id=@$fairdet['parti_id'];
			$exb=@$fairdet['exb'];
			$edit_delete=@$fairdet['edit_delete'];
			
			}
			*/
			
			//print_r($fairdet['edit_itemcode']);
			 
			/*$festname ='';				
			if($category=='1')$festname="LP";else if($category=='2')$festname="UP";else if($category=='3')$festname="HS";else if($category=='4')$festname="HSS/VHSE";
			
			if($category==1)	$this->Content['classsectionary']  = array(0=>"Std",1=>1,2=>2,3=>3,4=>4);
			else if($category==2)$this->Content['classsectionary'] = array(0=>"Std",5=>5,6=>6,7=>7);
			else if($category==3)$this->Content['classsectionary'] = array(0=>"Std",8=>8,9=>9,10=>10);
			else if($category==4){$this->Content['classsectionary'] = array(0=>"Std",11=>11,12=>12);
			$this->Content['admn_category']=array(0=>"Select",'H'=>'HSS','V'=>'VHSS');
			$this->Content['festid'] = $category;
			}
			if(@$fairdet['edit_item']==1){
			$this->Content['item_details']	=	@$fairdet['edit_itemcode'];
			//$this->Content['esc_flag']	=	1;
			}
			else{
		//	$this->Content['esc_flag']	=	2;
		   if($exb==0)
			$this->Content['item_details']	=	 $this->Registration_Model->get_item_details($category,$fairid);
			else
			$this->Content['item_details']	=	 $this->Registration_Model->get_item_details_exb($category,$fairid);
			
			}
			//$this->Content['parti_details']	=	 $this->Registration_Model->get_part_details($schoolcode,$fairid,$category);
			 if($exb==0){
			
			$this->Content['parti_details']	=	 $this->Registration_Model->get_details($schoolcode,$category,$fairid,$exb);
			//var_dump($this->Content['parti_details']);
			}
			else
			$this->Content['parti_details']	=	 $this->Registration_Model->get_details_exb($schoolcode,$category,$fairid,$exb);
		//	var_dump($this->Content['parti_details']);
			$this->Content['designations']=$this->Registration_Model->get_designation_details();
			$this->Content['escorting_details']	=	 $this->Registration_Model->get_escorting_teacher_details($schoolcode,$fairid);
		
			if(count($this->Content['escorting_details']) && @$fairdet['edit']!=1)
			{ $this->Content['esc_flag']	=	1; }
			else
			{ $this->Content['esc_flag']	=	2; }	
				
			$this->Content['category']	=	$category;
			$this->Content['flag']	=	1;
			
			$this->Content['part_flag']	=	@$fairdet['part_flag'];
				/*var_dump(@$fairdet['edit']);
				var_dump($this->Content['parti_details']);
				var_dump(count($this->Content['parti_details']));*/
	//		if(count($this->Content['parti_details']) && @$fairdet['edit']!=1)
	//		{ $this->Content['parti_flag']	=	1;
			//echo "ssssssssss<br>";
	//		 }
	//		else
	//		{ $this->Content['parti_flag']	=	2; }		
			
			//echo '<br><br><br>'.$this->Content['parti_flag'];
/*			if($category	==	1) {  $cls_str		= @$school_details[0]['strength_lp']; } 
			if($category	==	2) {  $cls_str		= @$school_details[0]['strength_up']; } 
			if($category	==	3) {  $cls_str		= @$school_details[0]['strength_hs']; } 
			if($category	==	4) {  $cls_str		= @$school_details[0]['strength_hss'] + @$school_details[0]['strength_vhss']; } 
			
			
		
			if($cls_str){ /*///checking the availability of the category in the school
				
				/*************** Science fair *****************/
				/*if($fairid ==	1){ 	
										
					if($this->Login_Model->if_school_data_confirmed($schoolcode,'fairScience'))
					$this->Content['confirm']			=	 'Y';
					else
					$this->Content['confirm']			=	 'N';
					$this->Content['Heading'] = 'Science Fair Registration for '.$festname;   								
					$this->template->write_view('content','science/science_entry',$this->Content);					
				}
				*/
				
				/*************** Mathematics fair *****************/
				/*if($fairid ==	2){	
					if($this->Login_Model->if_school_data_confirmed($schoolcode,'fairMathematics'))
					$this->Content['confirm']			=	 'Y';
					else
					$this->Content['confirm']			=	 'N';						
					$this->Content['Heading'] = 'Mathematics Fair Registration for '.$festname;
					$this->template->write_view('content','maths/maths_entry_form',$this->Content);	
				}*/
								
				/*************** Social Scinece fair *****************/
				/*if($fairid ==	3){			
					if($this->Login_Model->if_school_data_confirmed($schoolcode,'fairSocialScience'))
					$this->Content['confirm']			=	 'Y';
					else
					$this->Content['confirm']			=	 'N';				
					$this->Content['Heading'] = 'Social Science Fair Registration for '.$festname;
					$this->Content['parti_id']=@$parti_id;
					$this->Content['edit_delete']=@$edit_delete;
					$this->template->write_view('content','socialscience/socialscience_entry',$this->Content);	
				}*/
				
				
				/*************** Work Experience fair *****************/
				/*if($fairid ==	4){			
				    if($this->Login_Model->if_school_data_confirmed($schoolcode,'fairWorkExp'))
					$this->Content['confirm']			=	 'Y';
					else
					$this->Content['confirm']			=	 'N';	
					if($exb == 0){ $workexpo	=	'On the spot competition'; } else{ $workexpo	=	'Exhibition'; } 			
					$this->Content['Heading'] = "Work experience '".$workexpo."' Registration for " .$festname;
					$this->Content['exb']=$exb;
					$this->template->write_view('content','workexp/workexp_entry',$this->Content);	
				}*/
				
				
				/*************** IT fair *****************/
				/*if($fairid ==	5){			
					if($this->Login_Model->if_school_data_confirmed($schoolcode,'fairITmela'))
					$this->Content['confirm']			=	 'Y';
					else
					$this->Content['confirm']			=	 'N';				
					$this->Content['Heading'] = 'IT Fair Registration for '.$festname;
					$this->template->write_view('content','IT/IT_entry',$this->Content);	
				}*/
				
			 //} //if($cls_str)	 
			/* else {	$error	=	'No '.$festname.' category for this school!';
					$this->template->write('error',$error);}	*/
		
		//} //if($category != NULL)
			
		//$this->template->write_view('content','registration_menu');	
	
		//var_dump($this->Content['error']);
		$this->template->load();
	}
	
	
	
	
	
	
}

?>