<?php
class Import_Model extends CI_Model
{
	function Import_Model(){
		parent::__construct();
	}

	function assignRelayCodestoSchools()
	{
		$this->db->from('participant_item_details AS PD');
	   	$this->db->order_by('PD.school_code');
		$this->db->distinct('PD.school_code');
		$this->db->join('school_details AS SD','SD.school_code = PD.school_code');
		$this->db->like('PD.item_type','G');
	    $this->db->select('PD.school_code,PD.sportsId,PD.item_type');
		$query =	$this->db->get();
		$query = $query->result_array();

		for($i=0;$i<count($query);$i++)
		{
			 $this->db->select('letter');
			 $this->db->where('id',$i+1);
			 $this->db->from('relayletter');
			 $query1 =	$this->db->get();
			 $res=$query1->result_array();

	  		 $relay_letter=$res[0]['letter'];
			 $schoolcode=$query[$i]['school_code'];
			 $data = array(
               'relayletter' => $relay_letter

            );
		$this->db->where('school_code', $schoolcode);
        $this->db->update('school_details', $data);


		}
		//return $query->result_array();


}

	function insert_import_data ($file_name,$fair_num)
	{

		$is_fair_imported	=	$this->is_fair_imported($fair_num);

		//var_dump($is_fair_imported);

		if(count($is_fair_imported) == 0)
		{

			$file = $this->config->item('base_path').'uploads/csv/'.$file_name;

			if (file_exists($file))
			{

				$csvData			= $this->csvreader->parse_file($file);
				//echo "<br /><br /><br />---".count($csvData);
				if (is_array($csvData) && count($csvData) > 0)
				{

					//echo "<br /><br />".is_import_data_finish ($this->session->userdata('SUB_DISTRICT'));
					if (!is_import_data_finish ($this->session->userdata('SUB_DISTRICT')))
					{
						// echo "<br /><br /><br />keriiii";

						// checking encripted time and the integer time is same
						if (trim(@$csvData[1][1]) == get_encr_password(trim(@$csvData[1][0])) &&
							(trim(@$csvData[0][0])) == trim($this->session->userdata('SUB_DISTRICT')) &&
							get_encr_password(trim($this->session->userdata('SUB_DISTRICT')).trim(@$csvData[0][1])) == trim(@$csvData[0][2]))
						{

						   // echo "<br /><br />keriiiiiiii";
							if ('SM_DETAILS' == trim($csvData[2][0]))
							{
								$table 		= trim($csvData[2][0]);
								$data_array	= array();

								// transation begins
								$this->db->trans_begin();


								/*$this->db->empty_table('school_master');
								$this->db->empty_table('school_details');
								$this->db->empty_table('participant_item_details');
								$this->db->empty_table('teacherAndEscortings');			*/
								for ($i = 3; $i < count($csvData); $i++)
								{
									if (is_array($csvData[$i]))
									{

										if ('SM_DETAILS' == $table)
										{

										   //echo "<br />-->".count($csvData[$i])."----".trim($csvData[$i][0]);
											if (count($csvData[$i]) == 1 or trim($csvData[$i][0]) == 'SD_DETAILS' )
											{
												$table 		= trim($csvData[$i][0]);
												continue;
											}

											//echo "<br />--val1--".trim($csvData[$i][4]);
											//echo "<br />--val1--S. A.T. H. S. Manjeshwar";
											//echo "<br />--val2--".get_encr_password(trim($csvData[$i][0]).trim($csvData[$i][1]).trim($csvData[$i][2]).trim($csvData[$i][3]).trim($csvData[$i][4]).trim($csvData[$i][5]));
											if (trim($csvData[$i][7]) == get_encr_password(trim($csvData[$i][0]).trim($csvData[$i][1]).trim($csvData[$i][2]).trim($csvData[$i][3]).trim($csvData[$i][5]))
												)
											{

												$data_array							= array ();
												$data_array['school_code'] 			= trim($csvData[$i][0]);
												$data_array['sub_district_code']	= trim($csvData[$i][1]);
												$data_array['edu_district_code'] 	= trim($csvData[$i][2]);
												$data_array['rev_district_code'] 	= trim($csvData[$i][3]);
												$data_array['school_name'] 			= trim($csvData[$i][4],'"');
												$data_array['school_type'] 			= trim($csvData[$i][5]);
												//$data_array['master_confirm'] 		= trim($csvData[$i][6]);
												$data_array['master_confirm'] 		= 'N';
												$data_array['school_status'] 		= trim($csvData[$i][6]);
												$school_code		=		$data_array['school_code'];
												$SM_table_value	=	$this->General_Model->get_data('school_master','*', array('school_code' => $school_code));

												//echo "<br />emmm--".empty($SM_table_value);

												if(!empty($SM_table_value)) {
													 $this->db->where('school_code',$school_code);
													if (!$this->db->update('school_master', $data_array))
													{
														 $this->db->trans_rollback();
													}

												}
												else {

													if (!$this->db->insert('school_master', $data_array))
													{
														 $this->db->trans_rollback();
													}
												}


											}
											else
											{
												$this->db->trans_rollback();
												return "ERROR";
											}

										}
										else if ($table == 'SD_DETAILS' or trim($csvData[$i][0]) == 'PID_DETAILS')
										{


											if (count($csvData[$i]) == 1)
											{
												$table 		= trim($csvData[$i][0]);
												continue;
											}
											if (trim($csvData[$i][25]) == get_encr_password(trim($csvData[$i][0]).trim($csvData[$i][6]).trim($csvData[$i][7]).trim($csvData[$i][16]).trim($csvData[$i][17]).trim($csvData[$i][18]).trim($csvData[$i][19]).trim($csvData[$i][20]).trim($csvData[$i][21]))
												)
											{
												$data_array							= array ();
												$data_array['school_code'] 			= trim($csvData[$i][0]);

												$data_array['fairScience'] 			= 'N';
												$data_array['fairMathematics'] 		= 'N';
												$data_array['fairSocialScience'] 	= 'N';
												$data_array['fairWorkExp'] 			= 'N';
												$data_array['fairITmela'] 			= 'N';

												$data_array['class_start']			= trim($csvData[$i][6]);
												$data_array['class_end'] 			= trim($csvData[$i][7]);
												$data_array['school_phone'] 		= trim($csvData[$i][8]);
												$data_array['school_email'] 		= trim($csvData[$i][9]);
												$data_array['hm_name'] 				= trim($csvData[$i][10],'"');
												$data_array['hm_phone'] 			= trim($csvData[$i][11]);
												$data_array['principal_name'] 		= trim($csvData[$i][12],'"');
												$data_array['principal_phone'] 		= trim($csvData[$i][13]);
												$data_array['teachers'] 			= trim($csvData[$i][14],'"');
												$data_array['escorting_teachers'] 	= trim($csvData[$i][15],'"');
												$data_array['strength_lp'] 			= trim($csvData[$i][16]);
												$data_array['strength_up'] 			= trim($csvData[$i][17]);
												$data_array['strength_hs'] 			= trim($csvData[$i][18]);
												$data_array['strength_hss'] 		= trim($csvData[$i][19]);
												$data_array['strength_vhss'] 		= trim($csvData[$i][20]);
												$data_array['total_strength'] 		= trim($csvData[$i][21]);
												$data_array['data_entered_flag'] 	= trim($csvData[$i][22]);
												$data_array['is_create_report'] 	= trim($csvData[$i][23]);
												$data_array['is_finalize'] 			= trim($csvData[$i][24]);

												$school_code		=		$data_array['school_code'];
												$SD_table_value	=	$this->General_Model->get_data('school_details','*', array('school_code' => $school_code));
	//calls the function to insert relay code starts here



												if(!empty($SD_table_value)) {
													$this->db->where('school_code',$school_code);
													if (!$this->db->update('school_details', $data_array))
													{
														 $this->db->trans_rollback();
													}

												}
												else {
													if (!$this->db->insert('school_details', $data_array))
													{
														 $this->db->trans_rollback();
													}
												}

	//calls the function to insert relay code ends here
											}
											else
											{
												$this->db->trans_rollback();
												return "ERROR";
											}

										}
										else if ($table == 'PID_DETAILS')
										{
											if (count($csvData[$i]) == 1 or trim($csvData[$i][0]) == 'ES_DETAILS' )
											{
												$table 		= trim($csvData[$i][0]);
												continue;
											}

										/*	echo "<br /><br />line num ".$i."<br /><br />";
											echo "---".trim($csvData[$i][0])."---".trim($csvData[$i][1])."---".trim($csvData[$i][2])."---".trim($csvData[$i][3])."---".trim($csvData[$i][4])."---".trim($csvData[$i][5])."---".trim($csvData[$i][6])."---".trim($csvData[$i][7])."---".trim($csvData[$i][8])."---".trim($csvData[$i][9])."---".trim($csvData[$i][10])."---".trim($csvData[$i][11])."---".trim($csvData[$i][12])."---".trim($csvData[$i][13])."---".trim($csvData[$i][14])."---".trim($csvData[$i][15])."---".trim($csvData[$i][16])."---".trim($csvData[$i][17])."---".trim($csvData[$i][18]);*/
											/*echo "<br />-->".trim($csvData[$i][17]);*/
											/*echo "<br />-->".get_encr_password(trim($csvData[$i][0]).
																		trim($csvData[$i][1]).
																		trim($csvData[$i][2]).
																		trim($csvData[$i][3]).
																		trim($csvData[$i][4]).
																		trim($csvData[$i][5]).
																		trim($csvData[$i][6]).
																		trim($csvData[$i][13]).
																		trim($csvData[$i][14]).
																		trim($csvData[$i][15]));
																		*/

											if (trim($csvData[$i][18]) == get_encr_password(trim($csvData[$i][0]).
																		trim($csvData[$i][1]).
																		trim($csvData[$i][2]).
																		trim($csvData[$i][3]).
																		trim($csvData[$i][4]).
																		trim($csvData[$i][5]).
																		trim($csvData[$i][6]).
																		trim($csvData[$i][13]).
																		trim($csvData[$i][14]).
																		trim($csvData[$i][15]))
												)
											{

												$data_array						= array ();
												//$data_array['participant_id'] 		= trim($csvData[$i][0]);
												$data_array['participant_id'] 	= trim($csvData[$i][0]);
												$data_array['fairId'] 			= trim($csvData[$i][1]);
												$data_array['fest_id'] 			= trim($csvData[$i][2]);
												$data_array['school_code']		= trim($csvData[$i][3]);
												$data_array['sub_district_code']= trim($csvData[$i][4]);
												$data_array['admn_no'] 		= trim($csvData[$i][5]);
												$data_array['item_code'] 	= trim($csvData[$i][6]);
												$data_array['item_type'] 	= trim($csvData[$i][7]);
												$data_array['spo_id'] 		= trim($csvData[$i][8]);
												$data_array['spo_remarks'] 	= trim($csvData[$i][9]);
												$data_array['exhibition'] 	= trim($csvData[$i][10]);
												$data_array['exhibit_name'] = trim($csvData[$i][11],'"');
												$data_array['participant_name']= trim($csvData[$i][12],'"');
												$data_array['class'] 	= trim($csvData[$i][13]);
												$data_array['gender'] 	= trim($csvData[$i][14]);
												$data_array['team_no'] 	= trim($csvData[$i][15]);
												$data_array['is_captain'] 	= trim($csvData[$i][16]);
												$data_array['remarks'] 	= trim($csvData[$i][17]);

												//var_dump($data_array);

												if (!$this->db->insert('participant_item_details', $data_array))
												{
													 //$this->db->trans_rollback();
													 return "ERROR";
												}
											}
											else
											{
												$this->db->trans_rollback();
												return "ERROR";
											}
										}
										else if ($table == 'ES_DETAILS' or trim($csvData[$i][0]) == 'ES_DETAILS')
										{
											if (count($csvData[$i]) == 1)
											{
												$table 		= trim($csvData[$i][0]);
												continue;
											}
									/*		echo "<br /><br />line num ".$i."<br /><br />";
											echo "---".trim($csvData[$i][0])."---".trim($csvData[$i][1])."---".trim($csvData[$i][2])."---".trim($csvData[$i][3])."---".trim($csvData[$i][4])."---".trim($csvData[$i][5])."---".trim($csvData[$i][6])."---".trim($csvData[$i][7])."---".trim($csvData[$i][8])."---";*/


												$data_array		= array ();
												$data_array['escorting_table_id'] = trim($csvData[$i][0]);
												$data_array['fairId'] 	= trim($csvData[$i][1]);
												$data_array['school_code'] 	= trim($csvData[$i][2]);


												$teachers = trim($csvData[$i][3]);

												$data_array['teachers_num'] = $teachers;

												$escorting_teachers = trim($csvData[$i][4],'"');

												$data_array['escorting_teachers'] 	= $escorting_teachers;
												$data_array['exhibition'] 	= trim($csvData[$i][5]);
												$data_array['name_team'] = trim($csvData[$i][6],'"');


												$data_array['address_team'] = trim($csvData[$i][7],'"');
												$data_array['phone_team'] 	= trim($csvData[$i][8]);

												if (!$this->db->insert('teacherAndEscortings', $data_array))
												{
													 $this->db->trans_rollback();
												}

										}


									}
								}
								//echo "<br><br><br><br><br>";
						//echo "yes reached...........................".$sub_dist_code;
						//$this->assignRelayCodestoSchools();

				/*$sub_district_code		=	$sub_dist_code;
				$this->db->where('sub_district_code',$sub_district_code);
				$this->db->where('sportsId',$sportsId);
				$this->db->select_max('participant_id');
				$participant_details		=	$this->db->get('participant_details');
				$participant_id				=	0;
				if ($participant_details->num_rows() > 0)
				{
					$participant			=	$participant_details->result_array();
					$participant_id			=	$participant[0]['participant_id'];
					$participant_id++;
				}
				if ($participant_id < 101)
				{
					echo "in alter query";
					$alterQuery		=$this->db->query("ALTER TABLE participant_details AUTO_INCREMENT = 100");
					//mysql_query($alterQuery);
					//$participant_id			=	101;
				}*/
						/*$query = $this->db->query("UPDATE participant_item_details TPID SET TPID.participant_id = ( SELECT TPD.participant_id FROM participant_details TPD WHERE TPID.school_code = TPD.school_code AND TPD.admn_no=TPID.admn_no)														WHERE  TPID.admn_no IN(SELECT TPD.admn_no FROM participant_details TPD WHERE TPD.sub_district_code=".$sub_dist_code.")");
									if (!$query)
									{
										$this->db->trans_rollback();
										return FALSE;
									}
						*/
						$query1 = $this->db->query("UPDATE participant_item_details TPID SET TPID.participant_id = pi_id where fairId='$fair_num'");

						$parti_updated	=	$this->Import_Model->update_parti($fair_num);
								$this->db->trans_commit();
								return "COMPLETED";
							}
							else
							{
								return "ERROR";
							}
						}
						else
						{
							//echo "<br />INVALID_DATA<br /><br />kerillaaaaaaaaa";
							return "INVALID_DATA";
						}

					}
					else
					{
						//echo "<br />DATA_ALREADY_ENTERED<br /><br />kerillaaaaaaaaa";
						return "ALL_IMPORT_COMPLETED";
					}
				}
			}
		}
		else
		{
			return "DATA_ALREADY_ENTERED";

		}

	}// function end
  function backup_tables($tables = '*')
  {
	$return='';
	//get all of the tables
	if($tables == '*')
	{
		$tables = array();
		$result = mysql_query('SHOW TABLES');
		while($row = mysql_fetch_row($result))
		{
			$tables[] = $row[0];
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}

	//cycle through
	foreach($tables as $table)
	{
		$result = mysql_query('SELECT * FROM '.$table);
		$num_fields = mysql_num_fields($result);

		$return.= 'DROP TABLE IF EXISTS '.$table.';';
		$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";

		for ($i = 0; $i < $num_fields; $i++)
		{
			while($row = mysql_fetch_row($result))
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++)
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = ereg_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}

	//save file
	$handle = fopen($_SERVER['DOCUMENT_ROOT'].'/sciencefair_subdistrict2013/dbBackup/sasthramela_subdistrict2013_'.date('d-m-Y-h-i-s').'.sql','x');
	fwrite($handle,$return);
	fclose($handle);
	return true;
}

	function insert_import_district_data ($file_name)
	{
		$file = $this->config->item('base_path').'uploads/csv/'.$file_name;
		if (file_exists($file))
		{
			$csvData			= $this->csvreader->parse_file($file);
			if (is_array($csvData) && count($csvData) > 0)
			{
				$sub_dist_code	= trim($csvData[0][1]);
				$this->db->select('rev_district_code');
				$this->db->where('sub_district_code', trim($csvData[0][1]));
				$district_code	= $this->db->get('sub_district_master');
				$district_code	= $district_code->result_array();
				if(is_array($district_code) && count($district_code) > 0 && $district_code[0]['rev_district_code'] == trim($this->session->userdata('DISTRICT')))
				{
					$this->db->select('school_code');
					$this->db->where('sub_district_code', trim($csvData[0][1]));
					$school_code	= $this->db->get('temp_dist_participant_details');
					$school_code	= $school_code->result_array();
					if (is_array($school_code) && count($school_code) <= 0)
					{
						// checking encripted time and the integer time is same
						if (isset($csvData[1][0])  &&
							isset($csvData[1][1])  &&
							isset($csvData[0][1])  &&
							isset($csvData[0][2])  &&
							isset($csvData[0][3])  &&
							trim($csvData[1][1]) == get_encr_password(trim(@$csvData[1][0])) &&
							(trim($csvData[0][0])) == trim($this->session->userdata('DISTRICT')) &&
							get_encr_password(trim($this->session->userdata('DISTRICT')).trim($csvData[0][1]).trim($csvData[0][2])) == trim($csvData[0][3]))
						{
							if ('PD_DETAILS' == trim($csvData[2][0]))
							{
								$table 		= trim($csvData[2][0]);
								$data_array	= array();

								// transation begins
								$this->db->trans_begin();
								for ($i = 3; $i < count($csvData); $i++)
								{

									if (is_array($csvData[$i]))
									{

										if ('PD_DETAILS' == $table)
										{

											if (count($csvData[$i]) == 1)
											{
												$table 		= trim($csvData[$i][0]);
												continue;
											}
											if (trim($csvData[$i][6]) == get_encr_password(trim($csvData[$i][0]).
																						trim($csvData[$i][1]).
																						trim($csvData[$i][2]).
																						trim($csvData[$i][4]).
																						trim($csvData[$i][5]))
												)
											{
												$data_array							= array ();
												$data_array['school_code']			= trim($csvData[$i][0]);
												$data_array['sub_district_code'] 	= trim($csvData[$i][1]);
												$data_array['admn_no'] 				= trim($csvData[$i][2]);
												$data_array['participant_name'] 	= trim($csvData[$i][3],'"');
												$data_array['class'] 				= trim($csvData[$i][4]);
												$data_array['gender'] 				= trim($csvData[$i][5]);
												if (!$this->db->insert('temp_dist_participant_details', $data_array))
												{
													 $this->db->trans_rollback();
												}
											}
											else
											{
												$this->db->trans_rollback();
												return FALSE;
											}
										}
										else if ($table == 'PID_DETAILS')
										{
											if (count($csvData[$i]) == 1)
											{
												$table 		= trim($csvData[$i][0]);
												continue;
											}
											if (trim($csvData[$i][6]) == get_encr_password(trim($csvData[$i][0]).
																			trim($csvData[$i][1]).
																			trim($csvData[$i][2]).
																			trim($csvData[$i][3]).
																			trim($csvData[$i][4]).
																			trim($csvData[$i][5]))
												)
											{
												$data_array							= array ();

												$data_array['school_code']			= trim($csvData[$i][0]);
												$data_array['admn_no'] 				= trim($csvData[$i][1]);
												$data_array['parent_admn_no'] 		= trim($csvData[$i][2]);
												$data_array['item_code'] 			= trim($csvData[$i][3]);
												$data_array['item_type'] 			= trim($csvData[$i][4]);
												$data_array['is_captain'] 			= trim($csvData[$i][5]);

												if (!$this->db->insert('temp_dist_participant_item_details', $data_array))
												{
													 $this->db->trans_rollback();
												}
											}
											else
											{
												$this->db->trans_rollback();
												return FALSE;
											}
										}
									}
								}

								//$query = $this->db->query("UPDATE temp_dist_participant_item_details TPID SET TPID.participant_id = ( SELECT TPD.participant_id														FROM temp_dist_participant_details TPD WHERE TPID.school_code = TPD.school_code AND TPD.admn_no=TPID.admn_no) WHERE  TPID.admn_no IN(SELECT TPD.admn_no FROM temp_dist_participant_details TPD WHERE TPD.sub_district_code=".$sub_dist_code.")");
								$query1 = $this->db->query("UPDATE participant_item_details TPID SET TPID.participant_id = pi_id where fairId='$fair_num'");
								if (!$query)
								{
									$this->db->trans_rollback();
									return FALSE;
								}
								$this->db->trans_commit();
								return TRUE;
							}
							else
							{
								$this->db->trans_rollback();
								return FALSE;
							}
						}
					}
					else
					{
						echo "<br />dataaaaaaaaaa";
						return 'DATA_ALREADY_ENTERED';
					}
				}
				else
				{
					return 'INVALID_SUB_DISRICT_DATA';
				}
			}
		}
	}


	function clear_selected_tables()
	{
	/*$this->db->empty_table('school_master');
	$this->db->empty_table('school_details');
	$this->db->empty_table('participant_details');
	$this->db->empty_table('participant_item_details');
	$this->db->empty_table('teacherAndEscortings');	*/
	}

	 function is_table_empty($table){
				$sub_dist		=	$this->session->userdata('SUB_DISTRICT');

				$query	=	$this->db->get($table);
				return $query->result_array();
			}//function

	function is_fair_imported($fairNum)
	{
		$this->db->where('fairId',$fairNum);
		$query	=	$this->db->get('participant_item_details');
		return $query->result_array();

	}

	function update_parti($fair)
	{
		//echo "<br />ooo";
		$data	=	array();
		$this->db->from('participant_item_details');
		$this->db->having('n > 1');
	   	$this->db->group_by(array('school_code','admn_no'));
		//$this->db->where('fairId',$fair);
	    $this->db->select('pi_id,participant_id,school_code,admn_no,count(*) as n');
		$query =	$this->db->get();
		$update_query = $query->result_array();

		if ($query->num_rows() > 0)
		{
			foreach($update_query as $row)
			{
				//echo "<br />".$row['admn_no'];
				$data['participant_id']	=	$row['participant_id'];
				$admno					=	$row['admn_no'];
				$schoolcode				=	$row['school_code'];

				$this->db->where('school_code', $schoolcode);
				//$this->db->where('fairId', $fair);
				$this->db->where('admn_no', $admno);
        		$this->db->update('participant_item_details', $data);

			}
		}

	}




}
?>