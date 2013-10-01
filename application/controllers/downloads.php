<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Downloads extends CI_Controller {
	
	public function __construct()
    {
		parent::__construct(); 
		$this->load->model('General_Model');
		$this->load->model('Session_Model');
		$this->load->model('school/Registration_Model');
		$this->load->model('login/Login_Model');
		$this->load->model('School_Details_Model');
		$this->load->library('session');
		$this->load->library('javascript');
		
		
	}//end function  function __construct
	function index()
	{
	
	}
	
	function item_details($fair)
	{		
		$this->Content['LP_item_details']	=	$this->General_Model->get_data('item_master', '*', array("fairId" => $fair,"fest_id" => 1), 'item_code');
		$this->Content['UP_item_details']	=	$this->General_Model->get_data('item_master', '*', array("fairId" => $fair,"fest_id" => 2), 'item_code');
		$this->Content['HS_item_details']	=	$this->General_Model->get_data('item_master', '*', array("fairId" => $fair,"fest_id" => 3), 'item_code');
		$this->Content['HSS_item_details']	=	$this->General_Model->get_data('item_master', '*', array("fairId" => $fair,"fest_id" => 4), 'item_code');
		
		$this->Content['fair_name']		=	$this->General_Model->get_data('science_master', 'fairName', array("fairId" => $fair));
	
		//$this->load->view('downloads/item_details',$this->Content);
		
		
		//$this->load->view('IT/it_entry_print_pdf',$this->Content);
		
		$this->load->library('HTML2PDF');
	
		$content  = $this->load->view('downloads/item_details',$this->Content, true);
	
		$html2pdf = new CI_HTML2PDF('P','A4', 'en');
		$html2pdf->pdf->SetDisplayMode('fullpage');
		$html2pdf->WriteHTML($content, '');
		$html2pdf->Output('Items.pdf', 'D');
	
	}
}
?>