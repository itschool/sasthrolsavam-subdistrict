<?php
class Prereportpdf extends CI_Controller {

		function __construct()
		{
			parent::__construct(); 
			$this->load->model('Session_Model');
			$this->template->add_js('js/report/staticreport.js');	
			$this->template->add_js('js/report/reportjs.js');	
			$this->load->library('HTML2PDF');
			$this->load->model('report/prereport_model');
			if($this->session->userdata('USER_GROUP') == '')
			{
				header ( "Location: ". base_url(). 'index.php/welcome' );		
			}
		}
		
		
		function eligible_school()
		{
			
			
			if($this->Session_Model->check_user_permission(42)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			//echo "kiii";
			$this->Content = array();
			$school_details		            =	$this->prereport_model->list_eligible_schools();
			$this->Content['school_details']  =	$school_details	;
			//print_r($school_details);
	
			if(count($school_details)>0){
			 $content	                    =	             $this->load->view('report/prereportpdf/list_eligible_school',$this->Content,true);
			 
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('Eligible_schools.pdf', 'I');
		  }
		}
		
		function participant_cardindex()
		{
			if($this->Session_Model->check_user_permission(33)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$this->Content = array();
		
			$fest							       =	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Festival','fest_id');
			$this->Content['fest']		           =	$fest;
			$participant_details				   =	$this->prereport_model->get_participant_details($this->input->post('txtSchoolCode'),$this->input->post('cmbFairType'));
			$fair_name							   =	$this->prereport_model->get_FairName($this->input->post('cmbFairType'));
			
			$this->Content['participant_details']  =	$participant_details;
			$this->Content['fair_name']			   = 	$fair_name[0]['fairName'];
			$this->Content['fairId']			   = 	$this->input->post('cmbFairType');
			
			if(count($participant_details)>0){
			
			 $content	                    =	             $this->load->view('report/prereportpdf/pt',$this->Content,true);
			 
			$html2pdf = new CI_HTML2PDF('L','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('participantcard.pdf', 'I');
			} 
			else {
				redirect('test/nodata');
			}
			
		}
		
	function participant_regno()
	{
	   
		$this->Content = array();
		$partcard		            =	$this->prereport_model->get_participant_regno($this->input->post('regno'),$this->input->post('cmbFairType'));
		$partcard1		            =	$this->prereport_model->get_participant_regno($this->input->post('regno1'),$this->input->post('cmbFairType'));
		$partcard2		            =	$this->prereport_model->get_participant_regno($this->input->post('regno2'),$this->input->post('cmbFairType'));
		
		$this->Content['partcard']   =	$partcard;
		$this->Content['partcard1']  =	$partcard1;
		$this->Content['partcard2']  =	$partcard2;
		//var_dump($this->Content['partcard1']);
		$this->Content['fairId']			   = 	$this->input->post('cmbFairType');
		
		if(count($partcard)>0 || count($partcard1)>0 || count($partcard2)>0){
		
		 $content	                    =	  $this->load->view('report/prereportpdf/participant_regno',$this->Content,true);
		 
		$html2pdf = new CI_HTML2PDF('L','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('participantcard.pdf', 'I');
		} 
		else {
			redirect('test/nodata');
		}
	}
	
	function timesheet()
		{
		$this->Contents=array();
		$this->template->write('title', '');
		$itemcode						=	$this->input->post('cbo_item');
	  	$festival						=	$this->input->post('cmbFestType');
		$this->Contents['itemtime']= $this->prereport_model->timesheet($itemcode);
		
		$this->Contents['item_count']= $this->General_Model->get_record_count('participant_item_details',"item_code = '$itemcode' AND is_captain = 'Y'");
		
		$this->Contents['festname']= $this->prereport_model->Festname($festival);
		$content	=	$this->load->view('report/prereportpdf/timesheet',$this->Contents,true);
		$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('Timesheet.pdf', 'I');
		}
		
	function timesheet_date()
	{
		$this->Contents=array();
		$this->template->write('title', '');
		$date						=	$this->input->post('txtDate');
	  	$festival					=	$this->input->post('cmbFestType');
		$fair						=	$this->input->post('cmbFairType');
		$this->Contents['itemtime'] = $this->prereport_model->timesheet_date($festival,$date,$fair);
		//$this->Contents['date']=$date;
		//$this->Contents['item_count']= $this->General_Model->get_record_count('participant_item_details',"item_code = '$itemcode' AND is_captain = 'Y'");
		
		$this->Contents['festname']= $this->prereport_model->Festname($festival);
		$content	=	$this->load->view('report/prereportpdf/timesheet_date',$this->Contents,true);
		$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('Timesheet_date.pdf', 'I');
	}
	
		function list_school_with_team()
		{
			if($this->Session_Model->check_user_permission(27)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$this->Content = array();
			$this->load->model('report/prereport_model');
			$school_details			=	$this->prereport_model->list_all_school_details();
			
			$this->Content['school_details']		= 	$school_details;
			
			$content	=	$this->load->view('report/prereportpdf/list_school_with_team',$this->Content,true);
			
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('Participatingschools.pdf', 'I');
			
		}
		
		function rpt_itemwiseparticipants(){//ratheesh
					$this->load->model('staticreport/Itemreports_Model');
					$this->Contents=array();
					$this->template->write('title', '');
					$itemcode						=	$this->input->post('cbo_item');
					$fair							=	$this->input->post('cmbFairType');
					$festival						=	$this->input->post('cmbCateType');	
					$fair_name						=	$this->prereport_model->get_FairName($this->input->post('cmbFairType'));				
					$this->Contents['fair_name']	= 	$fair_name[0]['fairName'];
					if($fair == 4 && $this->input->post('radioLabel') == 'exhib'){ 
							$this->Contents['fest_name']	=	$this->General_Model->get_data('festival_master', '*', array("fest_id" => $festival), 'fest_name'); 
							$l	=	$this->prereport_model->exhibition_category($fair,$festival);
							$this->Contents['partdata']		= 	$this->Itemreports_Model->itemwise_participants_exhib($fair,$festival,$l);
							//var_dump($this->Contents);
							if(count($this->Contents['partdata'])>0){
								$content	=	$this->load->view('report/prereportpdf/rpt_itemwiseparticipants_exb',$this->Contents,true);
							}
								else{
								redirect('test/nodata');
					         }
					 }
					else {   					
					
					if($itemcode=='ALL'){
							$itempart              =        $this->prereport_model->itemwise_allfestival($festival,$fair);							
							if(count($itempart)>0){
							$this->Contents['itempart']  =  $itempart;
							$content	=	$this->load->view('report/prereportpdf/rptallitemwise',$this->Contents,true);
							}
							else{
							redirect('test/nodata');
							}
					}
					
					else{
						$this->Contents['partdata']		= 	$this->Itemreports_Model->itemwise_participants($fair,$festival,$itemcode);
						$this->Contents['itemdet']		= 	$this->Itemreports_Model->Eventname($itemcode);
						$this->Contents['festdet']		= 	$this->Itemreports_Model->Festname($festival);
						
						if(count($this->Contents['partdata'])>0){
						$content	=	$this->load->view('report/prereportpdf/rpt_itemwiseparticipants',$this->Contents,true);
						}
						else{
						redirect('test/nodata');
						}
					  }
					
					}
					
					$html2pdf = new CI_HTML2PDF('P','A4', 'en');
					$html2pdf->pdf->SetDisplayMode('fullpage');
					$html2pdf->WriteHTML($content, '');
					$html2pdf->Output('itemwiseparticipants.pdf', 'I');
		
		}

	 function print_score_sheet()//vipin
	     {       
			if($this->Session_Model->check_user_permission(35)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			if($this->input->post('cbo_item') == 'ALL')
			{
				$this->print_scoreSheet_all();
			}
			else
			{
			$chk = $this->prereport_model->checkCodeEntered();
			if($chk == "yes")
			{
				$ItemCode	=	$this->input->post('cbo_item');	
				if($ItemCode == '')
				{$ItemCode = 0;
				}
				$fair 		=	$this->input->post('cmbFairType');	
				$fest 		= 	$this->input->post('cmbCateType');
					if($fest != 0) {
						if($ItemCode != 0)
						{
							$date= $this->prereport_model->fetch_item_name2($ItemCode);	
						}
						else
						{$date= $this->prereport_model->participate_school_details($fair,$fest);	
						}
					}
					
					if(count($date>0)){
					$this->Contents	=	array();	 	 
					
					$this->Contents['itemcode']	=	$ItemCode; 
					$this->Contents['start_time']	=	$date;	
					$this->Contents['fair']	=	$fair;	
					$fair_name	=	$this->prereport_model->get_FairName($this->input->post('cmbFairType'));
					
					$this->Contents['fair_name']		= 	$fair_name[0]['fairName'];
					$this->Contents['fest_names']	=	$this->General_Model->get_data('festival_master', '*', array("fest_id" => $fest), 'fest_id');
					//echo '<br><br><br>';	
					//print_r($fair_name);
					if($fair == 4 )
					{
						if($ItemCode != 0 )
						{
						$content=$this->load->view('report/prereportpdf/rpt_Wscoresheet',$this->Contents,true);
						}
						if($ItemCode == 0 )
						{
						  $this->Contents['exb_item'] = $this->General_Model->get_data('item_master','item_code,item_name',array('exb_cat'=>'H','fairId' => $fair,'fest_id' => 0));
						 $content=$this->load->view('report/prereportpdf/rpt_Exh_scoresheet',$this->Contents,true);
						}
					}
					elseif($fair != 4)
					{
						$content=$this->load->view('report/prereportpdf/rpt_scoresheet',$this->Contents,true);	
					}
					$html2pdf = new CI_HTML2PDF('P','A4', 'en');
					$html2pdf->pdf->SetDisplayMode('fullpage');
					$html2pdf->WriteHTML($content,'');
					$html2pdf->Output('scoresheet.pdf','I');
					}
				   	else{
					 
						redirect('test/nodata');
					
					}  
				}//if code generated
				else{
				redirect('report/prereport/score_sheet_interfaces/1');
			}//else code not generated
			}//if not all
		 	
		  }//function
		  
		  
		  ////////////////Print all items in score sheet ////////////////
		  function print_scoreSheet_all()
		  {
			  if($this->Session_Model->check_user_permission(35)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$chk = $this->prereport_model->checkCodeEntered();
			if($chk == "yes")
			{
				$ItemCode	=	$this->input->post('cbo_item');	
				$fair 		=	$this->input->post('cmbFairType');	
				$fest 		= 	$this->input->post('cmbCateType');
				$fair_name	=	$this->prereport_model->get_FairName($this->input->post('cmbFairType'));
					
				$this->Contents['fair_name']		= 	$fair_name[0]['fairName'];
				$data= $this->prereport_model->fetch_item_name2($ItemCode,1);	
				$this->Contents['retvalue'] = $data;
				
				if($this->input->post('cmbFairType') == 4 && $this->input->post('radioLabel') == 'spot'){  $page= "rpt_scoreSheet_w_all";}
				elseif($this->input->post('cmbFairType') != 4)
				{	 $page= "rpt_scoreSheet_all"; }
				
				if(count($this->Contents['retvalue'])>0)
				{
					$this->Contents['fair']	=	$fair;	
					$this->Contents['fest_names']	=	$this->General_Model->get_data('festival_master', '*', array("fest_id" => $fest), 'fest_id');
					$content	=	$this->load->view('report/prereportpdf/'.$page,$this->Contents,true);
					$html2pdf = new CI_HTML2PDF('P','A4', 'en');
					$html2pdf->pdf->SetDisplayMode('fullpage');
					$html2pdf->WriteHTML($content, '');
					$html2pdf->Output('Score_sheet.pdf', 'I');
					//$this->template->load();
				}
				else
				{
					redirect('test/nodata');
				}
				
			}//if code generated
			else{
				redirect('report/prereport/score_sheet_interfaces/1');
			}//else code not generated
			  
		  }//funtion
		  
		  
		   function fest_scoresheet_details()//vipin
	    	 {   	
		 		 $fest_id=$_POST['txtfestFrom'];
				 $fair_id=$_POST['txtfairFrom'];		
				 $date=$_POST['txtDate'];
   				 $this->Contents	         =	array();
				  if(@$this->input->post('radioLabel') == 'exhib')
				  {
				 $fest_details        =	$this->prereport_model->participate_school_details($fair_id,$fest_id,1,$date);
				  }
				  else
				{
					 $fest_details    =	$this->prereport_model->fetch_fest_scoresheet($fest_id,$date,$fair_id);
				}
				  $this->Contents['fest_names']	=	$this->General_Model->get_data('festival_master', '*', array("fest_id" => $fest_id), 'fest_id');	
		          // print_r ($fest_details);				 
				  if(count($fest_details)>0){
				   //$this->Contents['fest_details']=  $fest_details;	
				   $this->Contents['start_time']	=	$fest_details;	
				   if($fair_id != 4)
				   {
				  $content=$this->load->view('report/prereportpdf/rpt_fest_scoresheet',$this->Contents,true);
				   }
				   elseif($fair_id == 4)
				   {
					  if($this->input->post('radioLabel') == 'spot' )
					{
					 $content=$this->load->view('report/prereportpdf/rpt_fest_w_scoresheet',$this->Contents,true);
					}
					if($this->input->post('radioLabel') == 'exhib')
					{	 $charArr	=array(1 => 'P' ,2 => 'P' ,3 => 'H' ,4 => 'H' ); 
						 $exbcat = $charArr[$fest_id];
						  $this->Contents['fest_names']	=	$this->General_Model->get_data('festival_master', '*', array("fest_id" => $fest_id), 'fest_id');	
						$this->Contents['exb_item']	=	$this->General_Model->get_data('item_master', '*', array("fairId" => $fair_id,"fest_id" => 0,"exb_cat" => $exbcat), 'item_code');
						
						$content=$this->load->view('report/prereportpdf/rpt_Exh_scoresheet',$this->Contents,true);
						//var_dump($content);
					}
				   }
		          $html2pdf = new CI_HTML2PDF('P','A4', 'en');
		          $html2pdf->pdf->SetDisplayMode('fullpage');
		          $html2pdf->WriteHTML($content,'');
		          $html2pdf->Output('festscoresheet.pdf','I');
		          }
		         else{
				 		
				     redirect('test/nodata');
				 
				  }
		  }
		  
	function datewisepart()
	{
		
		if($this->Session_Model->check_user_permission(28)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->Contents=array();
		$this->template->write('title', '');
		//$itemcode						=	$this->input->post('cbo_item');
	  	//$festival						=	$this->input->post('cmbFestType');
		$date							=	$this->input->post('txtDate');
		$fair							=	$this->input->post('txtFair');
		//$this->Contents['date']			=	$date;
		
		if($date!='All'){
		
		$this->Contents['partdata']= $this->prereport_model->datewise_participants($date,$fair);
		//$this->Contents['itemdet']= $this->prereport_model->Eventname($itemcode);
		$lp=$this->prereport_model->lpstudents_date($date,$fair);
		$up=$this->prereport_model->upstudents_date($date,$fair);
		$hs=$this->prereport_model->hsstudents_date($date,$fair);
		$hss=$this->prereport_model->hssstudents_date($date,$fair);
		$school=$this->prereport_model->school_lpdetails();
		
		if($fair==4)
		{
		$lpexhib=$this->prereport_model->lpstudentsexhib_date($date,$fair);
		$upexhib=$this->prereport_model->upstudentsexhib_date($date,$fair);
		$hsexhib=$this->prereport_model->hsstudentsexhib_date($date,$fair);
		$hssexhib=$this->prereport_model->hssstudentsexhib_date($date,$fair);
		
		$this->Contents['lpexhib']  =$lpexhib;
		$this->Contents['upexhib']  =$upexhib;
		$this->Contents['hsexhib']  =$hsexhib;
		$this->Contents['hssexhib']  =$hssexhib;
		//print_r($this->Contents['lpexhib'][11250]);
		//echo '<br>------<br><br>';
		}
		
		//print_r($up);
		$this->Contents['lp']  =$lp;
		$this->Contents['up']  =$up;
		$this->Contents['hs']  =$hs;
		$this->Contents['hss']  =$hss;
		$this->Contents['school']=$school;
		$this->Contents['date']=$date;
		
		//print_r($this->Contents);
		$content	=	$this->load->view('report/prereportpdf/datewisepart',$this->Contents,true);
		$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('datewise_participant.pdf', 'I');
		}
		else {
		
		$this->Contents['partdata']= $this->prereport_model->datewise_participants($date,$fair);
		//$this->Contents['itemdet']= $this->prereport_model->Eventname($itemcode);
		$lp=$this->prereport_model->lpstudents($fair);
		$up=$this->prereport_model->upstudents($fair);
		$hs=$this->prereport_model->hsstudents($fair);
		$hss=$this->prereport_model->hssstudents($fair);
		$school=$this->prereport_model->school_lpdetails();
		$this->Contents['lp']  =$lp;
		$this->Contents['up']  =$up;
		$this->Contents['hs']  =$hs;
		$this->Contents['hss']  =$hss;
		
		if($fair==4)
		{
		$lpexhib=$this->prereport_model->lpstudentsexhib_date($date,$fair);
		$upexhib=$this->prereport_model->upstudentsexhib_date($date,$fair);
		$hsexhib=$this->prereport_model->hsstudentsexhib_date($date,$fair);
		$hssexhib=$this->prereport_model->hssstudentsexhib_date($date,$fair);
		
		$this->Contents['lpexhib']  =$lpexhib;
		$this->Contents['upexhib']  =$upexhib;
		$this->Contents['hsexhib']  =$hsexhib;
		$this->Contents['hssexhib']  =$hssexhib;
		//print_r($this->Contents['hssexhib'][11009]);
		//echo '<br>------<br>'.@$hsexhib[11007]['hsid'].'<br>';
		}
		
		$this->Contents['school']  =$school;
		$this->Contents['date']="";
		
		$content	=	$this->load->view('report/prereportpdf/datewisepart',$this->Contents,true);
		$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('datewise_participant.pdf', 'I');
		}
	}
	
function list_school(){//pratheeksha

			if($this->Session_Model->check_user_permission(27)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$this->Content = array();
			$this->load->model('report/prereport_model');
			$fairid	=	$this->input->post('cmbFairType');
			
			 /*if($fairid == 4 && $this->input->post('radioLabel') == 'exhib'){  
				$catid	=	0; 	
			 }
			 else { */  
				$catid	=	$this->input->post('cmbCateType');    
			// }
			 
			 $school_fest			=	$this->prereport_model->participating_schoolDetails($this->input->post('cmbFairType'),$catid);
			 
			 if(count($school_fest)>0){
					 $fair_name			=	$this->prereport_model->get_FairName($this->input->post('cmbFairType'));
					  
					
					 $this->Content['school_fest']		= 	$school_fest;
					 $this->Content['fair_name']		= 	$fair_name[0]['fairName'];
					 
					 if($catid==1){
							 $this->Content['category_name']	=	'LP';
					 }
					 else if($catid==2){
							 $this->Content['category_name']	=	'UP';
					 }
					 else if($catid==3){
							$this->Content['category_name']	=	'HS';
					 }
					 else if($catid==4){
							$this->Content['category_name']	=	'HS/VHSS';
					 }
					 
					/* else {
					 
							$this->Content['category_name']	=	'Exhibition';
					 }
					  */
					 $content	=	$this->load->view('report/prereportpdf/list_school',$this->Content,true);
					 
					$html2pdf = new CI_HTML2PDF('P','A4', 'en');
					$html2pdf->pdf->SetDisplayMode('fullpage');
					$html2pdf->WriteHTML($content, '');
					$html2pdf->Output('Participatingschools.pdf', 'I');
			}
			else{
					redirect('test/nodata');
			}
			
		}//list_school()
		
function list_participants(){//pratheeksha
		 
		 if($this->Session_Model->check_user_permission(30)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
		 }
		 $this->Content=array();
		 $schoolcode		=		$this->input->post('txtSchoolCode');
		 $cmbFairType		=		$this->input->post('cmbFairType');
		 
		 $fairid	=	$this->input->post('cmbFairType');
			
			/*if($fairid == 4 && $this->input->post('radioLabel') == 'exhib')
			{  $cmbCateType	=	0; 	}
			 else {*/   $cmbCateType	=	$this->input->post('cmbCateType');     //}
				
		 
		 $where='school_code='.$schoolcode;
		 $item_details	=		$this->General_Model->fetch_data('school_details','school_code',$where);
		 
		
		if(count($item_details)>0)
			{
				$part_details			=	$this->prereport_model->part_item_details($this->input->post('txtSchoolCode'),$cmbFairType,$cmbCateType);
				$fair_name			=	$this->prereport_model->get_FairName($cmbFairType);
				
				 $this->Content['part_details']		= 	$part_details;	
				 $this->Content['fair_name']		= 	$fair_name[0]['fairName'];
				if(count($part_details)>0)
					{
						$content	=	             $this->load->view('report/prereportpdf/list_participant_report',$this->Content,true);
						
						$html2pdf = new CI_HTML2PDF('P','A4', 'en');
						$html2pdf->pdf->SetDisplayMode('fullpage');
						$html2pdf->WriteHTML($content, '');
						$html2pdf->Output('Listofparticipantforteam_manager.pdf', 'I');
						}
						else {
						redirect('test/nodata');
				}
		}
		else {
				redirect('test/nodata');
		}
		
}//list_participants()	

	function team_manager_all(){
		
			$this->Contents=array();
			$fairid	=	$this->input->post('cmbFairType');
			
			 if($fairid == 4 && $this->input->post('radioLabel') == 'exhib'){  
				//$catid	=	0; 	
				$catid	=	$this->input->post('cmbCateType');    
			 }
			 else {   
				$catid	=	$this->input->post('cmbCateType');    
			 }
			
			if($this->input->post('cmbFairType')){
					$part_details					=	$this->prereport_model->part_item_details_allschool($this->input->post('cmbFairType'),$catid);
					$fair_name						=	$this->prereport_model->get_FairName($this->input->post('cmbFairType'));
						
					$this->Contents['fair_name']	= 	$fair_name[0]['fairName'];
					$this->Contents['part_details']	= 	$part_details;	
					
					if(count($part_details)>0){
					
						$content	=	             $this->load->view('report/prereportpdf/team_manager_all',$this->Contents,true);
						
						$html2pdf = new CI_HTML2PDF('P','A4', 'en');
						$html2pdf->pdf->SetDisplayMode('fullpage');
						$html2pdf->WriteHTML($content, '');
						$html2pdf->Output('AllListofparticipantforteam_manager.pdf', 'I');
					}
					else {
						redirect('test/nodata');
					}
			}
			else{
				redirect('test/nodata');
			}
	
	}//team_manager_all()	
	
	function more_limit_partlist(){	
	
				$this->Content = array();
				
				if($this->input->post('cmbFairType') == 4 && $this->input->post('radioLabel') == 'exhib'){  
					$catid	=	0; 	
				}
				else {   
					$catid	=	$this->input->post('cmbCateType');    
				}
				$fair_type	=	$this->input->post('cmbFairType');
				if($fair_type){
				   
				         if($fair_type != 'ALL'){
							//echo "<br /><br />fair---".$fair_type;
							$fees_details		            =	$this->prereport_model->list_more_limitpart($this->input->post('cmbFairType'),$catid,$this->input->post('txtLimitcode'));
							$fair_name						=	$this->prereport_model->get_FairName($this->input->post('cmbFairType'));
							$this->Content['fair_name']		= 	$fair_name[0]['fairName'];
							$this->Content['fair_id']		= 	$fair_type;
							$file_name	=	'participant_limit_item_more';
							}
						 else {
						 	$fees_details		            =	$this->prereport_model->list_more_limitpart_allfair($catid);
							$file_name	=	'participant_limit_item_more_allfair';
							}
						
						//var_dump($fair_name);
						
						$this->Content['fees_details']  =	$fees_details;
						
					
						if(count($fees_details)>0){
								$content	                    =	             $this->load->view('report/prereportpdf/'.$file_name,$this->Content,true);
								
								$html2pdf = new CI_HTML2PDF('P','A4', 'en');
								
								$html2pdf->pdf->SetDisplayMode('fullpage');
								$html2pdf->WriteHTML($content, '');
								$html2pdf->Output('partmorethanoneitem.pdf', 'I');
						}
						else {
								redirect('test/nodata');
						}
						
				}
				
		}//more_limit_partlist()
		
		function team_list(){
				$this->Contents     =    array();
				$cap	            =   $this->input->post('cbo_cap');
				$item_code          =   $this->input->post('cbo_item');
				$fair	            =   $this->input->post('cmbFairType');
				$cateid        		=   $this->input->post('cmbCateType');
				$exb_flag=0;
				if(@$_POST['radioLabel']=='exhib')$exb_flag=1;
				/*if($fair==4){
				}
				else{
				}*/
				
				$partdata   		=    $this->prereport_model->team_list_in_group_final($cap,$item_code,$exb_flag);
				$fair_name			=	$this->prereport_model->get_FairName($this->input->post('cmbFairType'));
				
				$this->Contents['partdata']=$partdata;
				$this->Contents['fair_name']	= 	$fair_name[0]['fairName'];
				
				if(count($partdata)>0 || $exb_flag==0){
						$content=$this->load->view('report/prereportpdf/team_list_in_group_final',$this->Contents,true);
						$html2pdf = new CI_HTML2PDF('P','A4', 'en');
						$html2pdf->pdf->SetDisplayMode('fullpage');
						$html2pdf->WriteHTML($content, '');
						$html2pdf->Output('list_of_participants_in_group.pdf', 'I');
				}
				else {
						redirect('test/nodata');
					}
			
		}//team_list()
		
		function callsheet_report(){
		
				if($this->Session_Model->check_user_permission(34)==false){
					$this->template->write('error', permission_warning());
					$this->template->load();
					return;
				}
				$this->Content = array();
				$fair_name						=	$this->prereport_model->get_FairName($this->input->post('cmbFairType'));
				$this->Content['fair_name']		= 	$fair_name[0]['fairName'];
				
				if($this->input->post('cbo_item')!='ALL'){
					$fees_details		            =	$this->prereport_model->get_callsheet_details($this->input->post('cmbFairType'),$this->input->post('cmbCateType'),$this->input->post('cbo_item'));
					$this->Content['fees_details']  =	$fees_details;
					
					if(count($fees_details)>0){
							$content	            =	$this->load->view('report/prereportpdf/callsheet_report',$this->Content,true);
							
							$html2pdf = new CI_HTML2PDF('P','A4', 'en');
							$html2pdf->pdf->SetDisplayMode('fullpage');
							$html2pdf->WriteHTML($content, '');
							$html2pdf->Output('Callsheet.pdf', 'I');
						
					} //if count >0
					else {
							redirect('test/nodata');
					}
				}
				else
				{
					$fees_details		            =	$this->prereport_model->callsheet_all_item_details($this->input->post('cmbFairType'),$this->input->post('cmbCateType'),'All');
					$this->Content['fees_details']  =	$fees_details;
					
					if(count($fees_details)>0){
							$content	            =	$this->load->view('report/prereportpdf/callsheet_all_items',$this->Content,true);
							//$content	            =	$this->load->view('report/prereportpdf/callsheet_report',$this->Content,true);
							$html2pdf = new CI_HTML2PDF('P','A4', 'en');
							$html2pdf->pdf->SetDisplayMode('fullpage');
							$html2pdf->WriteHTML($content, '');
							$html2pdf->Output('Callsheet.pdf', 'I');
						
					} //if count >0
					else {
							redirect('test/nodata');
					}
				
				
				}
	}
	////////////////Call sheet for work expo/////////////
		function callsheet_Wreport(){
		
				 if($this->session->userdata('USER_GROUP') != 'C' && $this->session->userdata('USER_TYPE') != 4){
					$this->template->write('error', permission_warning());
					$this->template->load();
					return;
				}
				$this->Content = array();
				$fair_name				=	$this->prereport_model->get_FairName($this->input->post('cmbFairType'));
				//echo "<br><br>-".$this->input->post('cmbCateType_hid');
				$this->Content['fair_name']		= 	$fair_name[0]['fairName'];
				if($this->input->post('cmbCateType_hid') != 0 )
				{
					if($this->input->post('cbo_item')!='ALL')
					{
						$fees_details	=	$this->prereport_model->get_callsheet_details($this->input->post('cmbFairType'),$this->input->post('cmbCateType_hid'),$this->input->post('cbo_item'),1);
						//var_dump($fees_details);
						$this->Content['fees_details']  =	$fees_details;
						$page = "callsheet_report";
					}
					else
					{
						$fees_details	 =	$this->prereport_model->callsheet_all_item_details($this->input->post('cmbFairType'),$this->input->post('cmbCateType_hid'),'All');
						$this->Content['fees_details']  =	$fees_details;
						$page = "callsheet_all_items";
					}
				}//if not exhib
				elseif($this->input->post('cmbCateType_hid') == 0)
				{
					$fest	=	$this->input->post('cmbfestId');
					@$fees_details		=	$this->prereport_model->participate_school_details($this->input->post('cmbFairType'),$fest);
					$this->Content['fees_details']  =	$fees_details;
					$this->Content['festType']	= 	'exhibition';
					$this->Content['fest_id']	= 	$fest;
					$page = "callsheet_e";
				}
				if(count(@$fees_details)>0)
				{
					$content	            =	$this->load->view('report/prereportpdf/'.$page,$this->Content,true);
					
					$html2pdf = new CI_HTML2PDF('P','A4', 'en');
					$html2pdf->pdf->SetDisplayMode('fullpage');
					$html2pdf->WriteHTML($content, '');
					$html2pdf->Output('Callsheet.pdf', 'I');
				
				} //if count >0
				else {
						redirect('test/nodata');
				}
				

	}
	
	
	
	function callsheet_all(){
			$this->Content = array();
			$date=$_POST['txtDate'];	
			
			if(($this->input->post('cmbFairType') && $this->input->post('cmbCateType')) || ($this->input->post('cmbFairType')==4 && $this->input->post('radioLabel')=='exhib')){
				if($this->input->post('radioLabel')=='exhib')
				{
					$fees_details		            =	$this->prereport_model->participate_school_details($this->input->post('cmbFairType'),$this->input->post('cmbCateType'),1,$date);	
					$this->Content['festType']	= 	'exhibition';
					$this->Content['fest_id']	= 	$this->input->post('cmbCateType');
					$page= "callsheet_e";
				}
				else
				{
					$fees_details		            =	$this->prereport_model->all_callsheet_details($this->input->post('cmbFairType'),$this->input->post('cmbCateType'),$date);	
					$page= "callsheet_all";
				}
					
					$fair_name						=	$this->prereport_model->get_FairName($this->input->post('cmbFairType'));
					
					$this->Content['fair_name']		= 	$fair_name[0]['fairName'];
					$this->Content['fees_details']  =	$fees_details;
					//echo "<br><br>".count($fees_details);
					if(count($fees_details)>0){
							$content	            =	$this->load->view('report/prereportpdf/'.$page,$this->Content,true);
							 
							$html2pdf = new CI_HTML2PDF('P','A4', 'en');
							$html2pdf->pdf->SetDisplayMode('fullpage');
							$html2pdf->WriteHTML($content, '');
							$html2pdf->Output('Callsheetall.pdf', 'I');
					} 
					else {
							redirect('test/nodata');
					}
			}
			else {
							redirect('test/nodata');
			}
					
	}
		
	function groundallot_duration()
		{
			if($this->Session_Model->check_user_permission(31)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
		
		$this->Contents=array();
		$this->template->write('title', '');
		$festcode			=	$this->input->post('cmbFestType');
		$faircode			=	$this->input->post('cmbFairType');
		if($festcode!='ALL'){
		
			$allot              =   $this->prereport_model->groundallot_duration($festcode,$faircode);
			//echo '<br><br><br>ddddddddd';
			//print_r($allot);
			$this->Contents['allot']            = 	$allot;
			$this->Contents['subdistrict']     	=   $this->prereport_model->find_subdistrict();
			$this->Contents['groups']           =   $this->prereport_model->groupallotduration();
			if(count($allot)>0){
			 //echo '<br><br><br>ddddddddd';
			 $content=$this->load->view('report/prereportpdf/groundallot_duration',$this->Contents,true);
		
			 $html2pdf = new CI_HTML2PDF('P','A4', 'en');
			 $html2pdf->pdf->SetDisplayMode('fullpage');
			 $html2pdf->WriteHTML($content,'');
			 $html2pdf->Output('Groundallot_duration.pdf', 'I');
			 }
			else{
				redirect('test/nodata');
				}
			}
		 else {
			 $allot              =   $this->prereport_model->groundallot_duration_all();
			//print_r($allot);
			$this->Contents['allot']            = $allot;
			$this->Contents['subdistrict']     	=   $this->prereport_model->find_subdistrict();
			$this->Contents['groups']           =   $this->prereport_model->groupallotduration();
			if(count($allot)>0){
			 $content=$this->load->view('report/prereportpdf/groundallot_all',$this->Contents,true);
		
			 $html2pdf = new CI_HTML2PDF('P','A4', 'en');
			 $html2pdf->pdf->SetDisplayMode('fullpage');
			 $html2pdf->WriteHTML($content,'');
			 $html2pdf->Output('Groundallot_duration.pdf', 'I');
		 
			 }
			 else{
				redirect('test/nodata');
				}
			 }
		
		}
		
		function groundreportdate()//ratheesh
		{
			if($this->Session_Model->check_user_permission(39)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$this->Contents=array();
			$this->template->write('title', '');
			$groundid						=	$this->input->post('cmbground');	  	
			$date							=	$this->input->post('txtDate');
			if($date=='ALL'){
			
					$this->Contents['date']			=	"All Date";
					$this->Contents['groundid']		=	$groundid;
					$this->Contents['grounddata']	= 	$this->prereport_model->alldate_groundreport($groundid);
					$this->Contents['groundname']	= 	$this->prereport_model->Groundname($groundid);		
					$content	=	$this->load->view('report/prereportpdf/allground',$this->Contents,true);
					$html2pdf = new CI_HTML2PDF('P','A4', 'en');
					$html2pdf->pdf->SetDisplayMode('fullpage');
					$html2pdf->WriteHTML($content, '');
					$html2pdf->Output('Venuereport_date.pdf', 'I');
			
			}
			else{
					$this->Contents['date']			=	$date;
					$this->Contents['groundid']		=	$groundid;
					$this->Contents['grounddata']	= 	$this->prereport_model->datewise_groundaltreport($date,$groundid);//datewise_stagereport($date);
					$this->Contents['groundname']	= 	$this->prereport_model->Groundname($groundid);		
					$content	=	$this->load->view('report/prereportpdf/groundreportdate',$this->Contents,true);
					$html2pdf = new CI_HTML2PDF('P','A4', 'en');
					$html2pdf->pdf->SetDisplayMode('fullpage');
					$html2pdf->WriteHTML($content, '');
					$html2pdf->Output('Venuereport_date.pdf', 'I');
			}
		 }
		 
		  function groundreport_all()
		 {
		 
		 $this->Contents=array();
		 $this->template->write('title', '');
		 //$groundid						=	$this->input->post('cmbFestType');	
		 $retdata                        =   $this->prereport_model->groundreport_all();
		// print_r($retdata);
		 $this->Contents['retdata']        =   $retdata;
		  $this->Contents['subdistrict'] =   $this->prereport_model->find_subdistrict();
		//print_r($this->Contents['subdistrict']);
		 $content	=	$this->load->view('report/prereportpdf/groundreport_all',$this->Contents,true);
		$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('Venuereport_all.pdf', 'I');
		 
		 }
			
	function groundreport_abstract()
	{
			if($this->Session_Model->check_user_permission(31)==false){
					$this->template->write('error', permission_warning());
					$this->template->load();
					return;
				}
				$this->Contents=array();
				$abstract            =   $this->prereport_model->groundallot_abstract();
			//	print_r($abstract);
			
				if(count($abstract)>0){
				
						 $this->Contents['abstract']            = $abstract;
						 $content=$this->load->view('report/prereportpdf/groundallot_abstract',$this->Contents,true);
						 $html2pdf = new CI_HTML2PDF('P','A4', 'en');
						 $html2pdf->pdf->SetDisplayMode('fullpage');
						 $html2pdf->WriteHTML($content,'');
						 $html2pdf->Output('VenueallotAbstract.pdf', 'I');
				 }	
	}
	
		function appealed_part()
		{
			if($this->Session_Model->check_user_permission(43)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$this->Contents=array();
			$this->template->write('title', '');
			
			if($this->input->post('cmbFairType') == 4 && $this->input->post('radioLabel') == 'exhib'){  
				$festcode	=	0; 	
			}
			else {   
				$festcode	=	$this->input->post('cmbFestType');    
			}
			$faircode			=	$this->input->post('cmbFairType');
			//$festcode			=	$this->input->post('cmbFestType');
			$appeal              =   $this->prereport_model->appealed_part($festcode,$faircode);
			//print_r($allot);
			$this->Contents['appeal']            = $appeal;
			$this->Contents['subdistrict']     	=   $this->prereport_model->find_subdistrict();
			//print_r($appeal);
			if(count($appeal)>0){
			$content=$this->load->view('report/prereportpdf/appealed_part',$this->Contents,true);
			
			 $html2pdf = new CI_HTML2PDF('P','A4', 'en');
			 $html2pdf->pdf->SetDisplayMode('fullpage');
			 $html2pdf->WriteHTML($content,'');
			 $html2pdf->Output('Appealed_participant.pdf', 'I');
			}
			else{
				redirect('test/nodata');
			}
		}
		
		function itemwisepart1(){
		
	
	
		/*if($this->Session_Model->check_user_permission(28)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}*/
		$this->Contents=array();
		$this->template->write('title', '');
		
		
		$fair							=	$this->input->post('cmbFairType');
		$fest							=	$this->input->post('cmbCateType');
		$cbo_item						=	$this->input->post('cbo_item');
		//echo '<br><br><br><br>';
		if($cbo_item!='ALL'){
		//echo '<br><br><br><br>-------';
					$where			=	array("fairId" => $fair);
					$item_wise_participants =	$this->prereport_model->itemwisestudents_item($cbo_item);
				//	print_r($item_wise_participants);
					$fair			=   $this->General_Model->get_data('science_master','*',$where);
					$item_name		=   $this->General_Model->get_data('item_master','*',array("item_code" => $cbo_item));
					$fest_name			=   $this->General_Model->get_data('festival_master','*',array("fest_id" => $fest));
					$this->Contents['item_wise_participants']  			  =	$item_wise_participants;
					$this->Contents['item_name']  	  =	$item_name;
					$this->Contents['fair']			  =	$fair[0]['fairName'];
					$this->Contents['cbo_item']		  =	$cbo_item;
					$this->Contents['fest_name']	  =	$fest_name;
					
					
		}//if($item!='All')
		else {
			
					$where			=	array("fairId" => $fair);
					$item_wise_participants				=	$this->prereport_model->item_wise_participants($fest,$fair);
					$fair			=	$this->General_Model->get_data('science_master','*',$where);
					$fest_name			=   $this->General_Model->get_data('festival_master','*',array("fest_id" => $fest));
					$this->Contents['item_wise_participants']  			  =	$item_wise_participants;
					$this->Contents['fair']			  =	@$fair[0]['fairName'];
					$this->Contents['cbo_item']		  =	$cbo_item;
					$this->Contents['fest_name']	  =	$fest_name;
					
		}
					 /* $this->template->write_view('content','report/prereportpdf/itemwisepart',$this->Contents);
	 				  $this->template->load();	*/  
					$content	=	$this->load->view('report/prereportpdf/itemwisepart',$this->Contents,TRUE);
					
					
					$html2pdf = new CI_HTML2PDF('P','A4', 'en');
					$html2pdf->pdf->SetDisplayMode('fullpage');
					$html2pdf->WriteHTML($content, '');
					$html2pdf->Output('itemwise_participant.pdf', 'D');

}//datewisepart()	


}//class


?>