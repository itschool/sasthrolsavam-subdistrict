<?php
	if($this->session->userdata('USER_TYPE')==4){
		$sub_dist_code		=	 $this->session->userdata('SUB_DISTRICT');
		$sub_dist_name		=	get_sub_dist_name($this->session->userdata('SUB_DISTRICT'));
		$label				=	$sub_dist_name.' Subdistrict';
		$welcome_label		=	$sub_dist_name.' Subdistrict Sasthrolsavam 2013 - 2014';
	}
	if($this->session->userdata('USER_TYPE')==1){
		
		$welcome_label		=	'IT Admin <br /> Subdistrict Sasthrolsavam 2013 - 2014';
	}
	if($this->session->userdata('USER_TYPE')==2){
		
		$sub_dist_name		=	get_dist_name($this->session->userdata('DISTRICT_CODE'));
		$welcome_label		=	$sub_dist_name. 'Subdistrict Sasthrolsavam 2013 - 2014';
	}
?>
<table width="100%" align="center" border="0">
	<tr>
    	<td class="login_heading" style="padding-top:150px;" align="center">
        <h1><?php echo @$welcome_label?></h1>
        </td>
    </tr>
    <tr>
    	<td class="login_heading" style="padding-top:150px;" align="center">&nbsp;
       
        </td>
    </tr>
</table>
