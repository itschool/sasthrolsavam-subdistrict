<?php
class Prereport extends CI_Controller {

		function __construct()
		{
			parent::__construct();
			$this->load->model('Session_Model');
			$this->template->add_js('js/report/staticreport.js');	
			$this->template->add_js('js/report/reportjs.js');	
			$this->load->library('HTML2PDF');
			$this->load->model('report/prereport_model');
			$this->template->write_view('menu', 'menu', '');
			if($this->session->userdata('USER_GROUP') == '')
			{
				header ( "Location: ". base_url(). 'index.php/welcome' );		
			}
		}
		
		function itemwise_report_interface()//ratheesh
		{
		  if($this->Session_Model->check_user_permission(29)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		  }
		  $fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','fest_id != 0','Select Festival','fest_id');
		  $fair							=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','Select Fair','fairId');

		  $this->Contents				=	array();
		  $this->Contents['fest']		=	$fest;
		  $this->Contents['fair']		=	$fair;
		  $this->template->write_view('content','report/prereport/itemwise_report_interface',$this->Contents);
		  $this->template->load();
		}
		
		
		function list_school()//pratheeksha
		{
			if($this->Session_Model->check_user_permission(27)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','fest_id != 0','Select Category','fest_id');
			$fair							=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','Select Fair','fairId');
			
			$this->Contents				=	array();
			$this->Contents['fest']		=	$fest;
			$this->Contents['fair']		=	$fair;
			$this->template->write_view('content','report/prereport/list_school',$this->Contents);		 
			$this->template->load();
		}
		
		function list_participants(){ //pratheeksha
		
				if($this->Session_Model->check_user_permission(30)==false){
					$this->template->write('error', permission_warning());
					$this->template->load();
					return;
				}
				$this->Contents=array();
				$this->template->write('title', '');
				 
				 $fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','fest_id != 0','Select Category','fest_id');
				$fair							=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','Select Fair','fairId');
				
				$this->Contents					=	array();
				$this->Contents['pfest']		=	$fest;
				$this->Contents['fair']			=	$fair;
				 
				$this->template->write_view('content', 'report/prereport/list_participants', $this->Contents);
				
				$this->Contents					=	array();
				$this->Contents['fest']			=	$fest;
				
				$this->template->write_view('content', 'report/prereport/team_manager_all', $this->Contents);
				$this->template->load();
				
			}//list_participants()
			
		function participant_limit_item_more(){
		
				if($this->Session_Model->check_user_permission(40)==false){
					$this->template->write('error', permission_warning());
					$this->template->load();
					return;
				}
				$this->Contents=array();
				$this->template->write('title', '');
				
				$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','fest_id != 0','Select Category','fest_id');
				$fair							=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','Select Fair','fairId');
				$fair['ALL']	=	'ALL FAIR';
				
				$this->Contents					=	array();
				$this->Contents['pfest']		=	$fest;
				$this->Contents['fair']			=	$fair;
				$no_array		=	array();
				for($i = 2; $i <= 5; $i++)
				{
				$no_array[$i]	=	$i;
				}
				$this->Contents['no_array']		=	$no_array;
				$this->template->write_view('content', 'report/prereport/participant_limit_item_more', $this->Contents);
				$this->template->load();
		}	
		
		function participant_cardindex()
		{
			if($this->Session_Model->check_user_permission(33)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$this->Contents=array();
			$this->template->write('title', '');
			
			
			$fair							=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','','fairId');
			$this->Contents['fair']			=	$fair;
			$this->Contents['retdat']= $this->prereport_model->list_school_details();
			$this->template->write_view('content', 'report/prereport/participant_cardindex', $this->Contents);
			
			$this->template->write_view('content', 'report/prereport/participant_regno', $this->Contents);
			
			$this->template->load();
		}
		
		function timesheetinterface()//ratheesh
		{
			if($this->Session_Model->check_user_permission(41)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$this->load->model('staticreport/Itemreports_Model');
			$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','fest_id != 0','Select Festival','fest_id');
			$fair							=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','Select Fair','fairId');
			$this->Contents				=	array();
			$this->Contents['fest']		=	$fest;
			$this->Contents['fair']		=	$fair;
			$this->template->write_view('content','report/prereport/timesheet',$this->Contents);
			$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','fest_id != 0','Select Festival','fest_id');
			$fair							=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','Select Fair','fairId');
			$this->Contents				=	array();
			$this->Contents['fest']		=	$fest;
			$this->Contents['fair']		=	$fair;
			$date_array					=	$this->General_Model->get_fest_date_array();
	        $date_array['All']			=	'All Dates';
	        $this->Contents['date_array']		=	$date_array;
			$this->template->write_view('content','report/prereport/timesheet_date',$this->Contents);
			$this->template->load();	  
	}
	
	function datewisepart()//ratheesh
	{
	  if($this->Session_Model->check_user_permission(40)==false){
		$this->template->write('error', permission_warning());
		$this->template->load();
		return;
	  }
	  $this->template->add_js('js/popcalendar.js');
	  $this->template->add_css('style/calendar.css');
	  $fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Festival');
	  $fair							=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','Select Fair','fairId');
	  $this->Contents				=	array();
	  $this->Contents['fest']		=	$fest;
	  $this->Contents['fair']		=	$fair;
	  
	  $date_array					=	$this->General_Model->get_fest_date_array();
	  $date_array['All']			=	'All Dates';
	  $this->Contents['date_array']		=	$date_array;
	  
	  $this->template->write_view('content','report/prereport/datewisepart',$this->Contents);
	  
	   $fair1							=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','','fairId');
	  $fair1['All']					=	'';
	  $this->Contents['fair1']		=	$fair1;
	   $fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','fest_id != 0','Select Category','fest_id');
	   $fest['ALL']			=	'All Category';
	   $this->Contents['fest']		=	$fest;
	  $this->template->write_view('content','report/prereport/itemwisepart',$this->Contents);
	 // $this->template->write_view('content','report/prereport/datewisepart_school',$this->Contents);
	 
	  $this->template->load();	  
	}
	//Stage Report Interface
	
	 function score_sheet_interfaces($error = 0)
	     {    
		 	 if($this->Session_Model->check_user_permission(35)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			if($error == 1)
			{
				$this->template->write('error','Code Not Yet Generated For All the Participants in the Item.Click here to generate code. <a href="'.base_url().'index.php/report/prereport/callsheet_first">Code Generation</a>');
			}
			$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','fest_id != 0','Select Festival','fest_id');
			$fair							=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','Select Fair','fairId');
			$this->Contents['fest']		=	$fest;
			$this->Contents['fair']		=	$fair;
			$date_array					=	$this->General_Model->get_fest_date_array();
	        $date_array['All']			=	'All Dates';
	        $this->Contents['date_array']		=	$date_array;
			$this->template->write_view('content','report/prereport/score_sheet_interface',$this->Contents);
			
			
			$this->Contents=array();
			$this->template->write('title','');
			//itempart_details
			$this->Contents['retdat']= $this->prereport_model->festval_details();
			//$this->Contents['dat']= $this->prereport_model->festval_details();
			$this->template->write_view('content', 'report/prereport/scoresheet_fest', $this->Contents);
			
			
			$this->template->load(); 
		 }
	
		function team_list(){
				$this->Contents=array();
				$this->template->write('title', '');
				$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','fest_id != 0','Select Category','fest_id');
				$fair							=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','Select Fair','fairId');
				
				$this->Contents					=	array();
				$this->Contents['pfest']		=	$fest;
				$this->Contents['fair']			=	$fair;
				$date_array					=	$this->General_Model->get_fest_date_array();
				$this->template->write_view('content', 'report/prereport/team_list', $this->Contents);
				
				$this->template->load();
		
		}//team_list()	
		
		function attndsheet_first()
		{
			if($this->Session_Model->check_user_permission(34)==false){
					$this->template->write('error', permission_warning());
					$this->template->load();
					return;
				}
			$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','fest_id != 0','Select Category','fest_id');
			$fair							=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','Select Fair','fairId');
				
			$this->Contents					=	array();
			$this->Contents['pfest']		=	$fest;
			$this->Contents['fair']			=	$fair;
			$this->template->write_view('content','report/prereport/attendncSheet_first',$this->Contents);
				
				$this->Contents=array();
				$this->template->write('title', '');
				$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','fest_id != 0','Select Category','fest_id');
				$fair							=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','Select Fair','fairId');
				
				$this->Contents					=	array();
				$this->Contents['pfest']		=	$fest;
				$this->Contents['fair']			=	$fair;
				$date_array					=	$this->General_Model->get_fest_date_array();
				$date_array['All']			=	'All Dates';
				$this->Contents['date_array']		=	$date_array;
				//print_r($fest);
				
				
				$this->template->write_view('content', 'report/prereport/callsheet_all', $this->Contents);
				
				$this->template->load(); 
			
		}//fn
		
		function callsheet_first($codeGen = 0){
		
				if($this->Session_Model->check_user_permission(34)==false){
					$this->template->write('error', permission_warning());
					$this->template->load();
					return;
				}
				if($codeGen == 2)
				{
					$this->template->write('error','Code for students should be saved first before talking the Call Sheet.');
				}
				$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','fest_id != 0','Select Category','fest_id');
				$fair							=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','Select Fair','fairId');
				
				$this->Contents					=	array();
				$this->Contents['pfest']		=	$fest;
				$this->Contents['fair']			=	$fair;
				$this->Contents['codeCreation'] = '';
				if($codeGen == 1)
				{
				
				if($this->input->post('cmbFairType') != 4)
				{
					$fair_name						=	$this->prereport_model->get_FairName($this->input->post('cmbFairType'));
					$this->Contents['code']['fair_name']		= 	@$fair_name[0]['fairName'];
				
					if($this->input->post('cbo_item')!='ALL')
					{
						$fees_details		            =	$this->prereport_model->get_callsheet_details($this->input->post('cmbFairType'),$this->input->post('cmbCateType'),$this->input->post('cbo_item'));
						$this->Contents['code']['fees_details']  =	$fees_details;
						if(count($fees_details)>0)
						{
								$this->Contents['codeCreation'] = "yes";
						} 
						else 
						{
								$this->Contents['codeCreation'] = "no";
						}
						
					}
				}//if not work expo
				elseif($this->input->post('cmbFairType') == 4)
				{
					$this->template->write('error','You do not have the permission to add code for Work Experience Fair!!');
				}
					
				}//if code gen
				//var_dump($this->Contents['code']);
				$this->template->write_view('content','report/prereport/callsheet_first',$this->Contents);
						
				$this->template->load(); 
		}
		
		////////////////////Create Code for each student //////////////
		function callsheet_save($type)
		{
			 if($this->Session_Model->check_user_permission(36)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$this->prereport_model->saveCode_array($type);
			if($type == 1)
			{	$this->template->write('sucess','Code Confirmed.');
			}
			else
			{
				$this->template->write('sucess','Code Saved Successfully');
			}
			
			$this->callsheet_first(1);
			
		}//fn
		
		//////////////List of applicants without code number ///////////////////
		function code_notGen()
		{
			 if($this->Session_Model->check_user_permission(36)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$part_details['partdata']  =	$this->prereport_model->get_code_notGen_details();
			$part_details['exhbdata']  =	$this->prereport_model->get_code_notGen_exb(0);
			$this->template->write_view('content','report/prereport/code_notGen',$part_details);
				
				
				$this->template->load(); 
			
		}//fn
		
		
		
		////////Reset Code Saved
		function resetCode()
		{
			 if($this->Session_Model->check_user_permission(36)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$chk = $this->prereport_model->checkresultEntered();
			//echo "------------<br><br><br><br>".$chk;
			if($chk == "no")
			{
				$this->prereport_model->resetCode();
			}
			else{
				$this->template->write('error','Cannot Reset.Result Already Entered For the Item.');
			}
			$this->callsheet_first(1);
		}//fn
		
		
		////////Reset Code Saved
		function resetWorkExpoCode($urlVal)
		{
			 if($this->Session_Model->check_user_permission(36)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$data = explode("__",$urlVal);
			$fair = $data[0];
			$fest = $data[1];
			$item = $data[2];
			
			if($item != 0)
			{
				$chk = $this->prereport_model->checkresultEntered_workExpo($fair,$fest,$item);
				//echo "------------<br><br><br><br>".$item_name;
				if($chk == "no")
				{
					$this->prereport_model->resetWorkExpo_Code($fair,$fest,$item);
					redirect('report/codegen/index/2/'.$item."/".$fest."/".$fair);
				}
				else{
					redirect('report/codegen/index/1/'.$item."/".$fest."/".$fair);
				}
			}//if on the spot
			elseif($item == 0)
			{
				$chk = $this->prereport_model->checkresultEntered_workExpo($fair,$fest,$item,1);
				//echo "------------<br><br><br><br>".$chk;
				if($chk == "no")
				{
					$this->prereport_model->resetWorkExpo_Code($fair,$fest,$item,1);
					redirect('report/codegen/index/2/'.$item."/".$fest);
				}
				else{
					redirect('report/codegen/index/1/'.$item."/".$fest);
				}
		  }//if exhibition
		}//fn
		
		
		 function tabulation_report_interface()
		 {
		   if($this->Session_Model->check_user_permission(36)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$fest						=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','fest_id != 0','Select Festival','fest_id');
			$fair						=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','Select Fair','fairId');
			$this->Contents				=	array();
			$this->Contents['fest']		=	$fest;
			$this->Contents['fair']		=	$fair; 
			$this->template->write_view('content','report/prereport/tabulation_report_interface',$this->Contents);
		
			
			$fest						=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','fest_id != 0','Select Festival','fest_id');
			$fair						=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','Select Fair','fairId');
	
			$this->Contents				=	array();
			$this->Contents['fest']		=	$fest;
			$this->Contents['fair']		=	$fair; 
			
			
			//$this->Contents['fest']		=	$fest;
			 $date_array					=	$this->General_Model->get_fest_date_array();
	        $date_array['All']			=	'All Dates';
	        $this->Contents['date_array'] =	$date_array;
			$this->template->write_view('content','report/prereport/tabulation_report_interface1',$this->Contents);
			// $this->template->load();
			
				$this->template->load();
		  
		}

		function rpt_tabulation_sheet()
			{
				 if($this->Session_Model->check_user_permission(36)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
				}
				$chk = $this->prereport_model->checkCodeEntered();
				//echo "<br><br><br>------".$chk;
				if($chk == "yes")
				{
					$itemcode					=	$this->input->post('cbo_item');
					if($itemcode != "ALL")
					{
					//$this->load->model('staticreport/Tabulation_model');
					$this->Contents=array();
					$this->template->write('title', '');
					
					if($this->input->post('cmbFairType') == 4 && $this->input->post('radioLabel') == 'exhib'){  
						//$festival	=	0; 	
						$this->Contents['fest'] = "Exhibition";
						$festival	= $this->input->post('cmbCateType');   
					}
					else {   
						$this->Contents['fest'] = "On the Spot";
						$festival			=	$this->input->post('cmbCateType');    
					}
					$fair						=	$this->input->post('cmbFairType');
					$itemcode					=	$this->input->post('cbo_item');
					
					
					$retdata1= $this->prereport_model->tabulation_fest_details($festival);
					$fair_name							   =	$this->prereport_model->get_FairName($this->input->post('cmbFairType'));
					
					$this->Contents['fair_name']			   = 	$fair_name[0]['fairName'];
					
					$this->Contents['retdata1']=$retdata1;
					if($itemcode != 0)
					{
						$retdata= $this->prereport_model->tabulation_details($fair,$festival,$itemcode);
						$this->Contents['retdata']=$retdata;
						$this->Contents['arrData']	=	 $this->prereport_model->get_callsheet_details($this->input->post('cmbFairType'),$this->input->post('cmbCateType'),$this->input->post('cbo_item'),1);
					}else
					{
						$this->Contents['arrData']	=	$this->prereport_model->participate_school_details($fair,$festival,1);	
					}
				
					$this->Contents['num'] = count($this->Contents['arrData']);
					if(count($this->Contents['arrData'])>0)
					{
							$this->template->write_view('content', 'report/prereport/rpt_tabulation_sheet', $this->Contents);
					//$this->Contents['itemdet']= $this->Itemreports_Model->Eventname($itemcode);
						$content	=	$this->load->view('report/prereport/rpt_tabulation_sheet',$this->Contents,true);
						$html2pdf = new CI_HTML2PDF('P','A4', 'en');
						$html2pdf->pdf->SetDisplayMode('fullpage');
						$html2pdf->WriteHTML($content, '');
						$html2pdf->Output('Tabulation_sheet.pdf', 'I');
						$this->template->load();
					}
					else
					{
						redirect('test/nodata');
					}
				}//if not all item
				else
				{
					$festival			=	$this->input->post('cmbCateType'); 
					$fair				=	$this->input->post('cmbFairType');
					   
					$this->tabulation_allItem($fair,$festival);
				}
				
				}//if code generated
				else{
					if($this->input->post('cmbFairType') == 4)
					{ 
						if($this->input->post('cbo_item') == 0)
						{
						$this->template->write('error','Venue Not Yet Alloted.');
						$this->template->load();
						}
						
					}
					else
					{
					
				$this->template->write('error','Code Not Yet Generated For All the Participants in the Item.');
				$this->callsheet_first(1);
					}
				
			}//else code not generated
	}//fn
	
	function tabulation_allItem($fair,$festival)
	{
		//echo "---------";
		if($fair == 4  && $this->input->post('radioLabel') == 'exhib' )
		{
		$this->Contents['retvalue']  =	$this->prereport_model->getExhib_allDate($fair,$festival);
		$page= "rpt_tabulation_sheet_e_all";
		}
		else
		{
			$date = "All";
		 $this->Contents['retvalue']= $this->prereport_model->tabulation_info($festival,$date,$fair);
		 $page= "rpt_tabulation_sheet1";
			
		}
		if(count($this->Contents['retvalue'])>0)
		{
			//$this->template->write_view('content', 'report/prereport/rpt_tabulation_sheet1', $this->Contents);
			$content	=	$this->load->view('report/prereport/'.$page,$this->Contents,true);
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('Tabulation_sheet.pdf', 'I');
			//$this->template->load();
		}
		else
		{
			redirect('test/nodata');
		}
		
		
	}//tabulation all item
	
	
	
	function  tabulation_report_interface1()
	  {
	   $fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Festival','fest_id');
			$fair							=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','Select Fair','fairId');
	
			$this->Contents				=	array();
			$this->Contents['fest']		=	$fest;
			$this->Content['fair']		=	$fair; 
	  $this->template->write_view('content','report/prereport/tabulation_report_interface1',$this->Contents);
	  $this->template->load();
	}
	 function rpt_tabulation_sheet1()
		{
		$this->load->model('report/Prereport_Model');
		$this->Contents=array();
		$this->template->write('title', '');
		
		//echo "--";
		if($this->input->post('cmbFairType') == 4 && $this->input->post('radioLabel') == 'exhib'){  
		$festival	=	0; 	
		}
		else {   
		$festival	=	$this->input->post('cmbFestType');    
		}
		$fair						=	$this->input->post('cmbFairType');
		$date						=	$this->input->post('txtDate');
		$fest_id					=	$this->input->post('cmbFestType');    
		
		  if(@$this->input->post('radioLabel') == 'exhib')
		  {
			  if($date != 'All')
			{
				 $this->Contents['retvalue']  =	$this->prereport_model->participate_school_details($fair,$fest_id,1,$date);
			}
			else
			{ 
			 $this->Contents['retvalue']  =	$this->prereport_model->getExhib_allDate($fair,$fest_id);
			}
		
		  }
		  else
		{
			//echo "here----------";
			$this->Contents['retvalue']= $this->Prereport_Model->tabulation_info($festival,$date,$fair);
		}
		
		
		
		if($this->input->post('radioLabel')=='exhib')
		{
			if($date != 'All')
			{$page= "rpt_tabulation_sheet_e";}
			else{ $page= "rpt_tabulation_sheet_e_all";
			}
		$this->Contents['fairid']= $fair;
		$this->Contents['festId']= $fest_id;
		}
		else
		{	$page= "rpt_tabulation_sheet1";
		}
		//echo "--page--".$page;
		//echo '<br><br><br>cnt====='.count($this->Contents['retvalue']);
		if(count($this->Contents['retvalue'])>0)
		{
			//$this->template->write_view('content', 'report/prereport/rpt_tabulation_sheet1', $this->Contents);
			$content	=	$this->load->view('report/prereport/'.$page,$this->Contents,true);
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('Tabulation_sheet.pdf', 'I');
			//$this->template->load();
		}
		else
		{
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
			 $fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','fest_id != 0','Select Festival','fest_id');
			$fair							=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','Select Fair','fairId');
	
			$this->Contents				=	array();
			$this->Contents['fest']		=	$fest;
			$this->Contents['fair']		=	$fair; 
			//$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Festival','fest_id');
			
			$fest['ALL']               ='All Festival';
			
			
			$this->Contents['fest']		=	$fest;
			$this->template->write_view('content','report/prereport/groundallot_duration',$this->Contents);
			$this->template->load();
		  
		}
	function groundreportdate()//ratheesh
	{
		if($this->Session_Model->check_user_permission(39)==false){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
		}
		$this->template->add_js('js/popcalendar.js');
		$this->template->add_css('style/calendar.css');
		
		$stage							=	$this->General_Model->prepare_select_box_data('ground_master','ground_id,ground_name','','');
		$this->Contents					=	array();

		$this->Contents['ground']		=	$stage;
		$date_array						=	$this->General_Model->get_fest_date_array();
		$date_array['ALL']				=	'All Date';
		$this->Contents['date_array']	=	$date_array	;
		
		$this->template->write_view('content','report/prereport/groundreportdate',$this->Contents);
		
		$this->Contents=array();
		$this->template->write('title', '');
		$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Fest');
		$this->Contents				=	array();
		$this->Contents['fest']		=	$fest;
		//print_r($fest);
		$this->template->write_view('content', 'report/prereport/groundreport_all', $this->Contents);
		
		$this->template->load();	  
	}
	
	function appealed_part()
		{
			if($this->Session_Model->check_user_permission(43)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			/*$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','','Select Festival','fest_id');
			$this->Contents				=	array();
			$this->Contents['fest']		=	$fest;*/
			
			$fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','fest_id >0 ','Select Festival','fest_id');
			$fair							=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','Select Fair','fairId');
		
			$this->Contents				=	array();
			$this->Contents['fest']		=	$fest;
			$this->Contents['fair']		=	$fair;
			
			$this->template->write_view('content','report/prereport/appealed_part',$this->Contents);
			$this->template->load();
		}
		
		function print_code_number($urlVal)
		{
			if($this->session->userdata('USER_TYPE') != 4 ) {
					$this->template->write('error', permission_warning());
					$this->template->load();
					return;
				}
				$printNo = 0;
				$data = explode("__",$urlVal);
				$fair = $data[0];
				$fest = $data[1];
				$item = $data[2];
				
			if($item!='ALL')
			{
				if($item != 0 )
				{
				$fees_details		            =	$this->prereport_model->get_callsheet_details($fair,$fest,$item,0,1);
				$this->Content['fair'] =	$fair;
				}
				elseif($item == 0 )
				{
					$fees_details		            =	$this->prereport_model->participate_school_details($fair,$fest,1);
					$this->Content['fair'] = $fair;
				}
				$this->Content['fees_details']  =	$fees_details;
				
				$print_no	=	$this->input->post('print_no');    
				
				//echo "--".count($this->Content['fees_details']);
				$this->Content['print_no'] = $print_no;
				
				if(count($fees_details)>0){
						$content   =	$this->load->view('report/prereportpdf/codeNumber',$this->Content,true);
						
						$html2pdf = new CI_HTML2PDF('L','A4', 'en');
						$html2pdf->pdf->SetDisplayMode('fullpage');
						$html2pdf->WriteHTML($content, '');
						$html2pdf->Output('CodeNumber.pdf', 'I');
					
				} //if count >0
				else 
				{
						redirect('test/nodata');
				}
			}
			
			else
			{				
				
				$fees_details		            =	$this->prereport_model->get_all_codenumbers($fair,$fest,0,1);
				$this->Content['fair'] =	$fair;		
				
				$this->Content['fees_details']  =	$fees_details;
				//echo "--".count($this->Content['fees_details']);
				$print_no	=	$this->input->post('print_no');    
				$this->Content['print_no'] = $print_no;
				
				if(count($fees_details)>0){
						$content	            =	$this->load->view('report/prereportpdf/codeNumber',$this->Content,true);
						
						$html2pdf = new CI_HTML2PDF('L','A4', 'en');
						$html2pdf->pdf->SetDisplayMode('fullpage');
						$html2pdf->WriteHTML($content, '');
						$html2pdf->Output('CodeNumber.pdf', 'I');
					
				} //if count >0
				else 
				{
						redirect('test/nodata');
				}	
			
			}
				
				
		}//fn
		
		
	function confirmw_wcode_number()
	{
		if($this->session->userdata('USER_TYPE') != 4 ) {
					$this->template->write('error', permission_warning());
					$this->template->load();
					return;
				}
		$this->load->model('staticreport/Itemreports_Model');
		 $fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','fest_id != 0','Select Festival','fest_id');
		$fair							=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','Select Fair','fairId');
			
		  $this->Contents				=	array();
		  $this->Contents['fest']		=	$fest;
		  $this->Contents['fair']		=	$fair;
		  $this->template->write_view('content','report/prereport/code_gen_interface',$this->Contents);
					  
		$fair_name						=	$this->prereport_model->get_FairName($this->input->post('cmbFairType'));
		$this->Contents['fair_name']	= 	@$fair_name[0]['fairName'];
		
		if($this->input->post('cmbCateType_hid') != 0 )
		{
			$fair 		= $this->input->post('cmbFairType');
			$festival 	= $this->input->post('cmbfestId');
			$itemcode 	= $this->input->post('cbo_item');
			if($this->input->post('cbo_item')!='ALL')
			{
				$this->Itemreports_Model->confirm_Wexpo();
	
				$this->Contents['partdata']		= 	$this->Itemreports_Model->itemwise_participants($fair,$festival,$itemcode,1);
				$this->Contents['festid']	= 	$festival;
				$this->Contents['festType']	= 	'On the spot';
			}
		}//if not exhib
		elseif($this->input->post('cmbCateType_hid') == 0)
		{
			$fair 		= $this->input->post('cmbFairType');
			$festival 	= $this->input->post('cmbfestId');
			$itemcode 	= $this->input->post('cbo_item');
		$this->Itemreports_Model->confirm_Wexpo(1);
		$this->Contents['partdata']		= 	$this->prereport_model->participate_school_details($fair,$festival);
		$this->Contents['festid']	= 	$festival;
		$this->Contents['festType']	= 	'exhibition';
		}
		$this->Contents['itemdet']		= 	$this->Itemreports_Model->Eventname($itemcode);
		$this->Contents['festdet']		= 	$this->Itemreports_Model->Festname($festival);
	$this->template->write_view('content','report/prereport/codeGenerated',$this->Contents);			
	$this->template->load();
	}//fn
		
		
}//class
	
?>