<?php
	if ($this->session->userdata('SUB_DISTRICT'))
	{
		$sub_dist_name		=	get_sub_dist_name($this->session->userdata('SUB_DISTRICT'));
		$label				=	$sub_dist_name.' Subdistrict';
	}
	$fest_master_details	=	$this->General_Model->get_fest_master_details();
	//echo "<br /><br /><br />hooo---->".count($fest_master_details); 
	//echo "<br /><br /><br />subdist---->".$this->session->userdata('SUB_DISTRICT'); 
	if (count($fest_master_details) > 0)
	{
		$title		=	(@$fest_master_details[0]['sub_dist_sciencefair_name']) ? @$fest_master_details[0]['sub_dist_sciencefair_name'] : '';
		$venue		=	@$fest_master_details[0]['venue'];
		$start_date	=	datetophpmodel(@$fest_master_details[0]['start_date']);
		$end_date	=	datetophpmodel(@$fest_master_details[0]['end_date']);
		
		$logo		=	@$fest_master_details[0]['logo_name'];
		$file_path	=	'';
		//echo "<br /><br />--->".$this->config->item('base_path').'uploads/subdistrict/thumb_'.$logo;
		if (file_exists($this->config->item('base_path').'uploads/subdistrict/thumb_'.$logo))
		{
			$file_path		=	base_url(false).'uploads/subdistrict/thumb_'.$logo;
			//echo "<br /><br />mmmmmmm".$file_path;
		}
	}
?>

<table style="width: 100%;">
    <tr>
        <td style="text-align: left;">
            <?php if (@$file_path){?>
            <img src="<?php echo $file_path?>" height="40">
            <?php }?>
        </td>
        <td style="text-align: right;" align="right" valign="top">
        <?php
		@$logo_name = explode(',',$title);
		@$title = $logo_name[0];
		@$sudDist = $logo_name[1];
		?>
        
        	<strong><?php echo @$title;?> , <?php echo @$sudDist." Subdistrict";?></strong><br /><?php echo @$venue;?><br /><?php echo @$start_date . ' - ' . @$end_date;?>
        </td>
    </tr>
   <tr>
        <td style="width: 100%" colspan="2"><hr/></td>
    </tr>
</table>