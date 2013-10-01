<?php
class Import extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Session_Model');
		$this->template->add_js('js/common.js');
		//$this->load->model('General_Model');
		//$this->Session_Model->is_user_logged(true);
		//$this->template->write_view('menu', 'menu', '');
		$this->load->library('csvreader');
		$this->load->model('Import_Model');
		$this->Contents = array();
		//$this->template->write_view('left_panel', 'menu_left', '');
	}
	function index()
	{
		$this->import_data ();
	}

	function import_data ()
	{


		if ($this->session->userdata('USER_TYPE')==4 || $this->session->userdata('USER_TYPE')==1)
		{
			if (is_import_data_finish ($this->session->userdata('SUB_DISTRICT')))
			{
				$this->Contents['import_completed'] = 'YES';
				$this->template->write_view('menu', 'menu', '');
			}
			else
			{
				$this->Contents['import_completed'] = 'NO';
			}
			if (isset($_FILES['SasthramelaCSV']['name']) && !empty($_FILES['SasthramelaCSV']['name']))
			{

				$name_of_csv	=	explode('.',$_FILES['SasthramelaCSV']['name']);
				$name_of_csv	=	$name_of_csv[0];
				$name_of_csv1	=	explode('+',$name_of_csv);
				$fair_num		=	$name_of_csv1[1];

				if($fair_num==1)
				{
					$fairName		=	'Science Fair';
				} if($fair_num==2){
					$fairName		=	'Mathematics Fair';
				} if($fair_num==3){
					$fairName		=	'Social Science Fair';
				} if($fair_num==4){
					$fairName		=	'Work Experience Fair';
				}if($fair_num==5){
					$fairName		=	'IT Fair';
				}

				$file_name	= $this->General_Model->upload_kalolsavam_csv_data ('SasthramelaCSV', 'SasthramelaCSV'.substr(fncUuid(), 10));
		//echo '<br><br><br><br>ok------->'.$file_name;
		if (!$file_name)
				{
					$this->template->write('error', $this->upload->display_errors());
					$this->template->write_view('content', 'import/import_csv_data', $this->Contents);
					$this->template->load();
					return;
				}
				if ($this->session->userdata('USER_TYPE')==4 )
				{
					$table_value	=	$this->Import_Model->is_table_empty('participant_item_details');
					if(!empty($table_value)) {
					$this->template->write_view('menu', 'menu', '');
					}

					$import_result	= $this->Import_Model->insert_import_data($file_name,$fair_num);

					if ($import_result == 'ALL_IMPORT_COMPLETED')
					{
						$this->template->write('error', 'Already imported CSV data for all Fairs ');
					}

					else if($import_result == 'INVALID_DATA')
					{
						$this->template->write('error', 'Invalid CSV');
					}
					else if($import_result == 'DATA_ALREADY_ENTERED')
					{
						$this->template->write('error', 'CSV data already imported for '.$fairName);
					}

					else if ($import_result == 'COMPLETED')
					{
						$parti_updated	=	$this->Import_Model->update_parti($fair_num);
						$master_updated		=	$this->General_Model->insert('science_master',array('fairId' => $fair_num,'fairName' => $fairName));

						$this->Contents['import_completed'] = 'YES';
						$this->template->write_view('menu', 'menu', '');
						$this->template->write('sucess', 'CSV Data saved successfully');
					}

					else
					{
						$this->Import_Model->clear_selected_tables();
						$this->template->write('error', 'Failed to Save CSV Data');
					}
				}
				else if ($this->session->userdata('USER_TYPE')==2)
				{
					$import_result	= $this->Import_Model->insert_import_district_data ($file_name);
					if (TRUE === $import_result)
					{
						$this->template->write('message', 'CSV Data saved successfully');
					}
					else if ('INVALID_SUB_DISRICT_DATA' == $import_result)
					{
						$this->template->write('error', 'This Sub-District is not belongs to current District');
					}
					else if ('DATA_ALREADY_ENTERED' == $import_result)
					{
						$this->template->write('error', 'Sub-District data already imported');
					}
					else
					{	$this->Import_Model->clear_selected_tables();
						$this->template->write('error', 'Failed to Save CSV Data');
					}
				}


			}

			$this->template->write_view('content', 'import/import_csv_data', $this->Contents);
			$this->template->load();
		}
		else redirect ('welcome');

	}

	function import_district_kalolsavam_data ()
	{
		if ($this->session->userdata('USER_GROUP') == 'A' && $this->session->userdata('USER_TYPE')==2)
		{
			if (isset($_FILES['SasthramelaCSV']['name']) && !empty($_FILES['SasthramelaCSV']['name']))
			{
				$file_name	= $this->General_Model->upload_kalolsavam_csv_data ('SasthramelaCSV', 'SasthramelaCSV'.substr(fncUuid(), 10));
				if (!$file_name)
				{
					$this->template->write('error', $this->upload->display_errors());
				}
				if ($this->Import_Model->insert_import_data ($file_name))
				{
					$this->template->write('message', 'CSV Data saved successfully');
				}
				else
				{	$this->Import_Model->clear_selected_tables();
					$this->template->write('error', 'Failed to Save CSV Data');
				}

			}

			$this->template->write_view('content', 'import/import_csv_data', $this->Contents);
			$this->template->load();
		}
		else redirect ('welcome');

	}
	function backup_data(){

		$back_up		=	$this->Import_Model->backup_tables();
		$message		=	'Database backup done sucessfully . To view the backup ,  file look in        /opt/lampp/htdocs/sciencefair_subdistrict2013/dbBackup';
		$this->template->write('sucess', $message);
		$this->template->write_view('menu', 'menu', '');
		$this->template->write_view('content','welcome_message');
		$this->template->load();

		}

	function up()
	{

		$parti_updated	=	$this->Import_Model->update_parti('1');
	}

}
?>