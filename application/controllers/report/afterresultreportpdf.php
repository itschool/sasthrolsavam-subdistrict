<?php
class Afterresultreportpdf extends CI_Controller {

		function __construct()
		{
			parent::__construct();
			$this->template->add_js('js/report/staticreport.js');	
			$this->template->add_js('js/report/reportjs.js');	
			$this->load->library('HTML2PDF');
			$this->load->model('report/afterresult_model');
			$this->load->model('report/prereport_model');
			$this->load->model('General_Model');
			$this->template->write_view('menu', 'menu', '');
		}
		
	
	  function school_wise_result()
	  {
			$this->load->model('report/afterresult_model');
		  	$this->Contents=array();
		  	$this->template->write('title', '');
			  	$school						=	$this->input->post('txtSchoolCode');
				$fairid						=	$this->input->post('cmbFairType');
				$fairname=$this->General_Model->get_data('science_master','fairId,fairName',array('fairId'=>$fairid));
				$this->Contents['fairid']   = $fairid;
				$this->Contents['fairname']   = $fairname[0]['fairName'];		
				if($school){
				$this->Contents['retvalue']= $this->afterresult_model->school_wise_result($school,$fairid);
				$this->template->write_view('content', 'result/afterresult_report/rpt_school_wise_point', $this->Contents);
				$content	=	$this->load->view('result/afterresult_report/rpt_school_wise_point',$this->Contents,true);
				//print_r($retvalue);
				$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		        $html2pdf->pdf->SetDisplayMode('fullpage');
		        $html2pdf->WriteHTML($content, '');
		        $html2pdf->Output('school_wise_result.pdf', 'I');
		        $this->template->load();
				}
				else{
				redirect('test/nodata');
				
				}
				
		}
		
		function allschool_points_result()
		{
			$this->load->model('report/afterresult_model');
			$this->Contents=array();
			
			$retvalue= $this->afterresult_model->all_school_wise_result();
			//echo '<br><br><br>';
			//print_r($retvalue);
			$this->Contents['retvalue']=$retvalue;
			if(count($retvalue)>0){
			//	$this->template->write_view('content', 'result/afterresult_report/rpt_school_wise_point', $this->Contents);
			$content	=	$this->load->view('result/afterresult_report/rpt_school_wise_point_all',$this->Contents,true);
			//print_r($retvalue);
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('Allschool_points_result.pdf', 'I');
			}
			else{
				redirect('test/nodata');
				
				}
		}
		
		function school_wise_result_all(){
				$this->load->model('report/afterresult_model');
				$this->Contents=array();
				$fair	=	$this->input->post('cmbFairType');
				
				$fair_name						=	$this->prereport_model->get_FairName($fair);
				$this->Contents['fair_name']	= 	$fair_name[0]['fairName'];
				$this->Contents['fairId']		= 	$fair_name[0]['fairId'];
				$this->Contents['retvalue']		= 	$this->afterresult_model->school_wise_result_all($fair);
				
				$this->Contents['itemcomp']		= 	$this->afterresult_model->itemcomplete_schoolpoint($fair);
				$this->Contents['grade']   		= 	$this->afterresult_model->school_wise_gradedetails($fair);
				$this->Contents['completed']   	= 	$this->afterresult_model->count_of_items($fair);
				if($fair==4)$this->Contents['exhibition_values']		= 	$this->afterresult_model->school_wise_result_exhibition_values($fair);
				$this->Contents['totalitems']   = 	$this->afterresult_model->count_of_items_total($this->Contents['fairId']);
				if(count($this->Contents['retvalue'])>0){
					$content	=	$this->load->view('result/afterresult_report/rpt_all_school_point',$this->Contents,true);
					$html2pdf = new CI_HTML2PDF('P','A4', 'en');
					$html2pdf->pdf->SetDisplayMode('fullpage');
					$html2pdf->WriteHTML($content, '');
					$html2pdf->Output('allschoolwisepoint.pdf', 'I');
				}
				else
				{
					redirect('test/nodata');
				}
		}//school_wise_result_all()
		
		
		
		function total_points()
		{
			$this->load->model('report/afterresult_model');
			$this->Contents=array();
			$fair	=	$this->input->post('cmbFairType1');	
			if($fair) {		
				$this->Contents['retvalue']= $this->afterresult_model->total_points($fair);
				$this->Contents['exhibition_values'] = NULL;
				if($fair==4){
					$this->Contents['exhibition_values'] = 	$this->afterresult_model->result_exhibition_values($fair);}
					
				if(count($this->Contents['retvalue'])>0)
				{
				$fair_name						=	$this->prereport_model->get_FairName($fair);
				$this->Contents['fair_name']	= 	$fair_name[0]['fairName'];
				$content	=	$this->load->view('result/afterresult_report/rpt_total_points',$this->Contents,true);
				//print_r($retvalue);
				$html2pdf = new CI_HTML2PDF('P','A4', 'en');
				$html2pdf->pdf->SetDisplayMode('fullpage');
				$html2pdf->WriteHTML($content, '');
				$html2pdf->Output('total_points.pdf', 'I');
				}
				else
				{	
				 redirect('test/nodata');
				 
				 }
			}
			
			else {
			
				redirect('afterresultreport/total_points_interface');
			
			}
		}
		
		function item_wise_total_points()
		{
		
			$this->load->model('report/afterresult_model');
			$this->Contents=array();
			$fair	=	$this->input->post('cmbFairType');
			$fest	=	$this->input->post('cmbCateType1');	
			$item	=	$this->input->post('cbo_item');		
			if($fair) {	
				$this->Contents['exhibition_vals']	=	0;	
				$this->Contents['retvalue']= $this->afterresult_model->item_wise_total_points($fair,$fest,$item);
				$this->Contents['exhibition_values'] = NULL;
				if($fair==4 && $_POST['radioLabel2']=='exhib'){
					//$this->Contents['retvalue'] = NULL;
					$this->Contents['exhibition_vals']	=	1;
					$this->Contents['exhibition_values'] = 	$this->afterresult_model->item_wise_school_wise_result_exhibition_values($fair,$fest);}
					
				if(count($this->Contents['retvalue'])>0 || count($this->Contents['exhibition_values'])>0)
				{
				$content	=	$this->load->view('result/afterresult_report/rpt_item_wise_total_points',$this->Contents,true);
				//print_r($retvalue);
				$html2pdf = new CI_HTML2PDF('P','A4', 'en');
				$html2pdf->pdf->SetDisplayMode('fullpage');
				$html2pdf->WriteHTML($content, '');
				$html2pdf->Output('item_wise_total_points.pdf', 'I');
				}
				else
				{	
				 redirect('test/nodata');
				 
				 }
			}
			
			else {
			
				redirect('afterresultreport/item_wise_total_points_interface');
			
			}
		}
		
		
	function time_wise_result_report(){
			$this->load->model('report/resultindex_model');
			$this->Contents     		  =	 array();		 		
			$timewise           		  =  $this->resultindex_model->timewise_result_report(); 
			$this->Contents['timewise']   =  $timewise;
			if($timewise['parti_count']>0){
				$content   =   $this->load->view('report/timeof_fest_reportpdf/timewise_result',$this->Contents,true);
				$html2pdf  =   new CI_HTML2PDF('P','A4', 'en');
				$html2pdf->pdf->SetDisplayMode('fullpage');
				$html2pdf->WriteHTML($content, '');
				$html2pdf->Output('time_wise_report.pdf', 'I');
			}
			else{
				redirect('test/nodata');
			}   
	}//time_wise_result_report()
	
	 function status_of_sasthramela1()
		{
			$this->load->model('report/afterresult_model');
			$this->Contents=array();
			
			$fair						=	$this->input->post('cmbFairType');
			
			if($fair == 4 && $this->input->post('radioLabel') == 'exhib'){ 
			$fest						=	$this->input->post('cmbCateType'); 
				//$fest						=	0;
		 	}
		 	else {   
				$fest						=	$this->input->post('cmbCateType');
		 	}
			
			$festdate						=	$this->input->post('festdate');
			$fair_name						=	$this->prereport_model->get_FairName($fair);
			$this->Contents['fair_name']	= 	$fair_name[0]['fairName'];
			$this->Contents['retvalue']= $this->afterresult_model->status_of_kalolsavam($fest,$fair,$festdate);
			//print_r($this->Contents['retvalue']);
			if($fair==4 && $_POST['radioLabel']=='exhib')$this->Contents['retvalue1']= array();
			else $this->Contents['retvalue1']= $this->afterresult_model->status_of_kalolsavam1($fest,$fair,$festdate);
			$this->Contents['ddt']		= $festdate;
			
			if($fest!=0)
			{ 
				$fest_name						=	$this->General_Model->get_data('festival_master','fest_name,fest_id',array('fest_id'=>$fest));
				$this->Contents['fest_name']	= 	$fest_name[0]['fest_name'];
				//echo '1--------controller>'.$fest.'<br>';
				$this->template->write_view('content', 'result/afterresult_report/rpt_status_of_sasthramela', $this->Contents);
				$content	=	$this->load->view('result/afterresult_report/rpt_status_of_sasthramela',$this->Contents,true);
				$html2pdf = new CI_HTML2PDF('P','A4', 'en');
				$html2pdf->pdf->SetDisplayMode('fullpage');
				$html2pdf->WriteHTML($content, '');
				$html2pdf->Output('status_of_sasthramela.pdf', 'I');
			}
			else
			{ 
				//echo '2--------controller>'.$fest.'<br>';
				$this->template->write_view('content', 'result/afterresult_report/rpt_status_of_sasthramela1', $this->Contents);
				$content	=	$this->load->view('result/afterresult_report/rpt_status_of_sasthramela1',$this->Contents,true);
				$html2pdf = new CI_HTML2PDF('P','A4', 'en');
				$html2pdf->pdf->SetDisplayMode('fullpage');
				$html2pdf->WriteHTML($content, '');
				$html2pdf->Output('status_of_sasthramela.pdf', 'I');
			}
		}
		
	function numwise_timeresult_report(){
			$this->load->model('report/resultindex_model');
			$this->Contents     	  =	  array();		 
			
			$fair					  =	$this->input->post('cmbFairType');	
			$result_nums    		  =	$this->input->post('txtResultno');	
			//echo $fair.'<br>'.$result_nums;
			if($fair==0 || $result_nums==''){
				redirect('test/nodata');
			}
			else{
				$numwise           		  = $this->resultindex_model->numwise_timeresult_report(); 
				$fair_name				  =	$this->prereport_model->get_FairName($fair);
				$this->Contents['fair_name']	= 	$fair_name[0]['fairName'];
				$this->Contents['result_numwise']  =  $numwise;
				if(count($numwise[0])>0){
					$content   =   $this->load->view('report/timeof_fest_reportpdf/result_numwise_report',$this->Contents,true);
					$html2pdf  =   new CI_HTML2PDF('P','A4', 'en');
					$html2pdf->pdf->SetDisplayMode('fullpage');
					$html2pdf->WriteHTML($content, '');
					$html2pdf->Output('time_wise_report.pdf', 'I');
				}
				else{
					redirect('test/nodata');
				} 
			}  
   }//numwise_timeresult_report()	
   
   function higherlevel_result()
		{
			if($this->Session_Model->check_user_permission(8)==false){
				$this->template->write('error', permission_warning());
				$this->template->load();
				return;
			}
			$this->Contents=array();
			$fest	=	$this->input->post('cmbFestType');
			$fair	=	$this->input->post('cmbFairType');		
			$item=$this->input->post('cbo_item');
			$retvalue  =$this->afterresult_model->higherlevel_result($fest,$item,$fair);
			
			if(count($retvalue)>0){
			
			$this->Contents['retvalue']=$retvalue;
			
			$content	=	$this->load->view('result/afterresult_report/higherlevel_pdf',$this->Contents,true);
			//print_r($retvalue);
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('Higherlevel_result.pdf', 'I');
			}
			else {
				redirect('test/nodata');			
			}
		
		}
		
		
	function schoolhigher_result()
	  {
			$this->Contents=array();
			$school_code=$this->input->post('txtSchoolCode');
			$fair=$this->input->post('cmbFairType1');
			$is_viewall	=	$this->input->post('chkviewall');
			//echo "<br /><br />----".$is_viewall;
			
			if($is_viewall != 'YES') {
				$retvalue  =$this->afterresult_model->schoolhigher_result($school_code,$fair);
				if(count($retvalue)>0){
				
				$this->Contents['retvalue']=$retvalue;
				$fair_name				  =	$this->prereport_model->get_FairName($fair);
				$this->Contents['fair_name']	= 	$fair_name[0]['fairName'];
				$content	=	$this->load->view('result/afterresult_report/schoolhigher_result',$this->Contents,true);
				//print_r($retvalue);
				$html2pdf = new CI_HTML2PDF('P','A4', 'en');
				$html2pdf->pdf->SetDisplayMode('fullpage');
				$html2pdf->WriteHTML($content, '');
				$html2pdf->Output('Schoolhigher_result.pdf', 'I');
				}
				else {
					redirect('test/nodata');
				
				}
			}
			else {
			
				$this->schoolhigher_resultall($fair);
			
			}
	  }
	
	function schoolhigher_resultall($fair)
		{
			$this->Contents=array();
			$retvalue  =$this->afterresult_model->schoolhigher_resultall($fair);
			if(count($retvalue)>0){
			$fair_name				  =	$this->prereport_model->get_FairName($fair);
			$this->Contents['fair_name']	= 	$fair_name[0]['fairName'];
			$this->Contents['retvalue']=$retvalue;
			
			$content	=	$this->load->view('result/afterresult_report/schoolhigher_result',$this->Contents,true);
			//print_r($retvalue);
			$html2pdf = new CI_HTML2PDF('P','A4', 'en');
			$html2pdf->pdf->SetDisplayMode('fullpage');
			$html2pdf->WriteHTML($content, '');
			$html2pdf->Output('Schoolhigher_resultall.pdf', 'I');
			}
			else {
				redirect('test/nodata');
			
			}
		}	
		
}
	
	?>