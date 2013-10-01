<?php
class Codegen extends CI_Controller {

		function __construct()
		{
			parent::__construct();
			$this->load->model('Session_Model');
			$this->load->library('HTML2PDF');
			$this->load->model('report/codegen_model');
			$this->template->add_js('js/report/staticreport.js');	
			$this->template->add_js('js/report/reportjs.js');
			$this->load->model('report/prereport_model');	
			$this->template->write_view('menu', 'menu', '');
		}
	function index($error = 0,$item_Code = 0,$fest_msg = 0,$fair_msg = 0){
		  if($this->session->userdata('FAIR_TYPE') != 4  && $this->session->userdata('USER_GROUP') != 'A' && !$this->Session_Model->check_user_permission(34) ){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
			  
		  }//if
		  if($error == 1)
		  {
			  if($item_Code != 0)
			  {
				  $itemname = $this->prereport_model->getItemName($item_Code,$fair_msg,$fest_msg);
				  $item_name =$itemname[0]['item_code']." - ".trim($itemname[0]['item_name']);
				  
			  }elseif($item_Code == 0)
			 {
				$charArr	=array(1 => 'LP' ,2 => 'UP' ,3 => 'HS' ,4 => 'HSS/VHSS' ); 
				$catgry = $charArr[$fest_msg];
				$item_name = "Exhibition - ".$catgry;
			 }
			  $message = "Cannot Reset.Result Already Entered For ".$item_name;
				$this->template->write('error',$message);  
		  }
		  if($error == 2)
		  {
			  if($item_Code != 0)
			  {
				  $itemname = $this->prereport_model->getItemName($item_Code,$fair_msg,$fest_msg);
				  $item_name =$itemname[0]['item_code']." - ".trim($itemname[0]['item_name']);
				  
			  }elseif($item_Code == 0)
			 {
				$charArr	=array(1 => 'LP' ,2 => 'UP' ,3 => 'HS' ,4 => 'HSS/VHSS' ); 
				$catgry = $charArr[$fest_msg];
				$item_name = "Exhibition - ".$catgry;
			 }
			  
			   $message = "Code Has Been Reset For ".$item_name;
			$this->template->write('sucess',$message);  
		  }
		   $fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','fest_id != 0','Select Festival','fest_id');
		  $fair							=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','Select Fair','fairId');

		  $this->Contents				=	array();
		  $this->Contents['fest']		=	$fest;
		  $this->Contents['fair']		=	$fair;
		  $this->template->write_view('content','report/prereport/code_gen_interface',$this->Contents);
		  $this->template->load();
	
	}
	
	function generateCodenumbers(){
		  if($this->session->userdata('FAIR_TYPE') != 4  && $this->session->userdata('USER_GROUP') != 'A' && !$this->Session_Model->check_user_permission(34)){
			$this->template->write('error', permission_warning());
			$this->template->load();
			return;
			  
		  }//if
					$this->load->model('staticreport/Itemreports_Model');
					$this->Contents=array();
					$this->template->write('title', '');
					  $fest							=	$this->General_Model->prepare_select_box_data('festival_master','fest_id,fest_name','fest_id != 0','Select Category','fest_id');
					  $fair							=	$this->General_Model->prepare_select_box_data('science_master','fairId,fairName','','Select Fair','fairId');
			
					  $this->Contents				=	array();
					  $this->Contents['fest']		=	$fest;
					  $this->Contents['fair']		=	$fair;
					  $this->template->write_view('content','report/prereport/code_gen_interface',$this->Contents);
		  
					$itemcode						=	$this->input->post('cbo_item');
					$fair							=	$this->input->post('cmbFairType');
					
					if($fair == 4 && $this->input->post('radioLabel') == 'exhib'){  
							$festival						=	$this->input->post('cmbCateType');
					}
					else 
					{   
							$festival						=	$this->input->post('cmbCateType');
					}
					
					//if($fair == 4 && $festival != 0)	
					if($fair == 4 )
					{
					
						
						$fair_name						=	$this->prereport_model->get_FairName($this->input->post('cmbFairType'));
						$this->Contents['fair_name']	= 	$fair_name[0]['fairName'];
						if($itemcode=='ALL'){
							$chk = $this->prereport_model->checkCodeEntered(1);
							//echo "------------<br><br><br><br>".$chk;
							/*if($chk == "yes")
							{*/
								$itempart              =        $this->Itemreports_Model->codeGen($fair,$festival,$itemcode,1);
							/*}
							else
							{$itempart  = "yes";
							}*/
								$this->Contents['partdata']		= 	$this->Itemreports_Model->all_itemwise_participants($fair,$festival);
								$this->Contents['fest_id']		= 	$festival;
								$this->Contents['fair_id']		= 	$fair;
								
								if($itempart == "yes"){
								$this->Contents['itempart']  =  $itempart;
								
								 $this->template->write_view('content','report/prereport/code_all_itemgen',$this->Contents);
								}
								else{
								rdirect('test/nodata');
								}
						}					
						else{
								if($this->input->post('radioLabel') == 'exhib')
								{
								$this->Contents['retdata']		= 	$this->prereport_model->exhibCodeGen($fair,$festival);
								$this->Contents['partdata']		= 	$this->prereport_model->participate_school_details($fair,$festival);
								$this->Contents['festid']	= 	$festival;
								$this->Contents['festType']	= 	'exhibition';
								//echo "<br><br>";
								//var_dump($this->Contents['retdata']);
								}
								else
								{
							$this->Contents['retdata']		= 	$this->Itemreports_Model->codeGen($fair,$festival,$itemcode);
							$this->Contents['partdata']		= 	$this->Itemreports_Model->itemwise_participants($fair,$festival,$itemcode,1);
							$this->Contents['festid']	= 	$festival;
							$this->Contents['festType']	= 	'On the spot';
								}
							
							$this->Contents['itemdet']		= 	$this->Itemreports_Model->Eventname($itemcode);
							$this->Contents['festdet']		= 	$this->Itemreports_Model->Festname($festival);
				
							if($this->Contents['retdata']== "yes")
							{
							//$this->template->write_view('content','report/prereport/code_gen_interface',$this->Contents);				
							 $this->template->write_view('content','report/prereport/codeGenerated',$this->Contents);										
							
							}
							else{
							//redirect('test/nodata');
							$this->template->write('error','No data!!');
							}
						}
				
					}//if work expo
					/*else
					{
						$this->template->write('error',"Code Numbers are generated only for 'on the spot' .You donot have the permision to add code.");
					}*/
					$this->template->load();
					
	}//fn
}//class

?>