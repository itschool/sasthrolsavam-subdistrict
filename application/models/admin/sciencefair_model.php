<?php 
class Sciencefair_Model extends CI_Model{
	function Sciencefair_Model()
	{
		parent::__construct();
	}
	
	function save_sciencefair_details ($data, $type)
	{//echo '<br><br><br>xsxxx';
		$this->db->trans_start();
		if ('ADD' == $type && (0 == $this->session->userdata('USER_TYPE') || 4 == $this->session->userdata('USER_TYPE')))
		{
			if ($this->General_Model->is_record_exists('dist_sciencefair_master', "status = 'O'") or 
				$this->General_Model->is_record_exists('sub_dist_sciencefair_master', "status = 'O'"))
			{
				 return false;
			}
				
				$result	= $this->db->insert('sub_dist_sciencefair_master', $data);
				$sciencefair_id = $this->db->insert_id();
				
				if ($sciencefair_id > 0)
				{
					
					$this->db->select('rev_district_code , rev_district_name');
					$result				= $this->db->get('rev_district_master'); 
					$dist_details		= $result->result_array();
					$sciencefair_name	= ' Sciencefair ';
					if (is_array($dist_details) && count($dist_details) > 0)
					{
						foreach ($dist_details as $dist_details)
						{
							$result	= $this->db->insert('dist_sciencefair_master', 
										array(
											"dist_sciencefair_name" => $dist_details['rev_district_name'].' District '.$sciencefair_name.$data['sciencefair_year'],
											"rev_district_code" => $dist_details['rev_district_code'],
											"sciencefair_id"	=> $sciencefair_id
											));
							$dist_sciencefair_id = $this->db->insert_id();
							if ($dist_sciencefair_id > 0)
							{				
								$this->db->select('sub_district_name, sub_district_code, rev_district_code');
								$this->db->where ('rev_district_code', $dist_details['rev_district_code']);
								$result		=	$this->db->get('sub_district_master'); 
								$sub_dist_details		= $result->result_array();
								if (is_array($sub_dist_details) && count($sub_dist_details) > 0)
								{
									foreach ($sub_dist_details as $sub_dist_details)
									{
										$result	= $this->db->insert('sub_dist_sciencefair_master', 
										array(
											"sub_dist_sciencefair_name" => $sub_dist_details['sub_district_name'].' Sub-District '.$sciencefair_name.$data['sciencefair_year'],
											"sub_district_code" =>  $sub_dist_details['sub_district_code'],
											"rev_district_code" => $sub_dist_details['rev_district_code'],
											"dist_sciencefair_id" => $dist_sciencefair_id,
											"sciencefair_id"	=> $sciencefair_id
											));
										$sub_dist_sciencefair_id = $this->db->insert_id();
										if (!$sub_dist_sciencefair_id)
										{
											$this->db->trans_rollback();
											return FALSE;
										}
									}
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
			else
			{
				$this->db->trans_rollback();
				return FALSE;
			}
			$this->db->trans_complete(); 
			return TRUE;
		}
		
		else if ('EDIT' == $type)
		{
			$this->db->trans_start();
			if ($this->db->update('sciencefair_master', $data, array('sciencefair_id' =>$data['sciencefair_id'])))
			{
				$this->db->select('rev_district_code , rev_district_name');
				$result				= $this->db->get('rev_district_master'); 
				$dist_details		= $result->result_array();
				$sciencefair_name	= ' Sciencefair ';
				$sciencefair_id		= $data['sciencefair_id'];
				if (is_array($dist_details) && count($dist_details) > 0)
				{
					foreach ($dist_details as $dist_details)
					{
						$result	= $this->db->update('dist_sciencefair_master', 
									array(
										"dist_sciencefair_name" => $dist_details['rev_district_name'].' District '.$sciencefair_name.$data['sciencefair_year']
										), array("sciencefair_id" => $kalolsavam_id, "rev_district_code" => $dist_details['rev_district_code']));
						if ($result)
						{				
							$this->db->select('sub_district_name, sub_district_code, rev_district_code');
							$this->db->where ('rev_district_code', $dist_details['rev_district_code']);
							$result		=	$this->db->get('sub_district_master'); 
							$sub_dist_details		= $result->result_array();
							if (is_array($sub_dist_details) && count($sub_dist_details) > 0)
							{
								foreach ($sub_dist_details as $sub_dist_details)
								{
									$result	= $this->db->update('sub_dist_sciencefair_master', 
									array(
										"sub_dist_sciencefair_name" => $sub_dist_details['sub_district_name'].' Sub-District '.$sciencefair_name.$data['sciencefair_year']
										
										), array("sciencefair_id" => $sciencefair_id, "sub_district_code" => $sub_dist_details['sub_district_code']));
									if (!$result)
									{
										$this->db->trans_rollback();
										return FALSE;
									}
								}
							}
						}
						else
						{
							$this->db->trans_rollback();
							return FALSE;
						}
					}
				}
				$this->db->trans_complete(); 
			  	return TRUE;
			}
			else return FALSE;
		}
	}
	
	function update_sub_dist_sciencefair_details ($data)
	{
		if($this->db->update('sub_dist_sciencefair_master', $data, array('sub_dist_sciencefair_id' =>$data['sub_dist_sciencefair_id']))) return TRUE;
		return FALSE;
	}
	/** function for fetch schools*/
	
}//end model class
?>