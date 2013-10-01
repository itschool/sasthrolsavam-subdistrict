<style type="text/css">
<!--
.style1 {
	font-size: 24px;
	font-style: italic;
	font-family: "Times New Roman", Times, serif;
}

-->
</style>
    <table width="99%" border="1" align="center" cellpadding="0" cellspacing="0" style="border:solid 1px; color:#CFCFCF">
    <tr>
    <td align="center"><span class="style1">School Master </span></td>
    </tr>
    </table><br />
<?php 

echo form_open('school/school_master/', array('id' => 'filter'));

?>
<div class="container">
 <!--<div class="contentbox" align="center">-->
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" style="margin-top:15px;">
  <tr class="heading_tab">
    <th colspan="4" align="left" >Schools</th>
	<th align="center" class="heading_tab" >Print <img src="<?php echo image_url().'/print_icon.png';?>" title="print" class="window_print" 
		onClick="javascript:printContent('print_content');return false;" /></th>
  </tr>
  <?php if ($this->session->userdata('USER_TYPE') == 2 || $this->session->userdata('USER_TYPE') == 1) {?>
  <tr>
    <td align="left" colspan="5">
        <?php if($this->session->userdata('USER_GROUP') == 'W') {?>
        <div style="float:left; padding-left:8px; display:block" id="divDistrictFilter">
			<?php 
			if($districts){
            echo form_dropdown("cmbDistrictFilter", $districts, @$_POST['cmbDistrictFilter'], 'id="cmbDistrictFilter" class="inputbox"  onChange="javascript:loadSubDistrictFilter()"');
            }
			?>
    	</div> 
        <?php }?>
        <div style="float:left; padding-left:8px; display:<?php echo (isset($_POST['cmbDistrictFilter']) && trim($_POST['cmbDistrictFilter']) != 0)? 'block' : 'none';?>" id="divSubDistrictFilter">
			<?php 
			if(@$sub_districts) {
            echo form_dropdown("cmbSubDistrictFilter", @$sub_districts, @$_POST['cmbSubDistrictFilter'], 'id="cmbSubDistrictFilter" class="inputbox" ');
             } 
		    ?>
    	</div> 
       
        <div style="float:left; padding-left:8px; ">
        	<?php echo form_submit('filter', 'Go >>', '');?>
        </div>
    </td>
  </tr>
  
<?php
	} 
echo form_close();

echo form_open('school/school_master/', array('id' => 'editUser'));?>
<tr>
<td colspan="5">&nbsp;</td>
</tr>
  <tr class="heading_tab"   style="height:20px;">
    <th align="center" width="4%"  >Sl.No</th>
	<th align="left"  width="10%"  >School Code</th>
    <th align="left"  width="60%"  >School Name</th>
    <th align="left" width="10%"  >School Type</th>
    <th align="center" width="10%"  >Edit</th>
  </tr>
  <?php
$i=1;


foreach($retvalue as $value)
	{
	$color = ($i % 2 == 0) ? '#E6F0DD' : '';
	$school_type	=	'';
	if ($value['school_type'] == 'G')
		$school_type	=	'Government';
	else if ($value['school_type'] == 'A') 
		$school_type	=	'Aided';
	else if ($value['school_type'] == 'U') 
		$school_type	=	'Unaided';
?>
  <tr style="border-top:1px solid #CFCFCF;" bgcolor="<? echo $color; ?>" >
    <td align="center" ><?php echo $i; ?></td>
	<td align="left" ><?php echo ($value['school_code']); ?></td>
    <td align="left" ><?php echo ($value['school_name']); ?></td>
    <td align="left"><?php echo $school_type ?></td>
    <td align="center"><a href="javascript:void(0)" onClick="edit_User(<?php echo $value['school_code'] ?>)"> <img src="<?php echo image_url(false)?>/edit.gif" /> </a> </td>
  </tr>
  <? $i++;} ?>
  <input type="hidden" name="UserIdty" id="UserIdty" value="">
</table>
<!--</div>-->
</div>
<!-- print content starts here----------------------------------->
<div id="print_content" style="display:none" >
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="1" cellspacing="0" cellpadding="6" align="center"  style="margin-top:15px;">
	<tr>
		<th align="center" width="10%" class="table_row_first">Sl.No.</th>
		<th align="left"  width="20%"  class="table_row_first">School Code</th>
		<th align="left"  width="55%"  class="table_row_first">School Name</th>
		<th align="left" width="30%"  class="table_row_first">School Type</th>
	  </tr>
	  <?php
	$i=1;
	foreach($retvalue as $value)
		{
		$class_name = ($i % 2 == 0) ? 'table_row_first' : 'table_row_second';
		$school_type	=	'';
		if ($value['school_type'] == 'G')
			$school_type	=	'Government';
		else if ($value['school_type'] == 'A') 
			$school_type	=	'Aided';
		else if ($value['school_type'] == 'U') 
			$school_type	=	'Unaided';
	?>
	  <tr>
		<td align="center" class="<?php echo $class_name;?>"><?php echo $i; ?></td>
		<td align="left" class="<?php echo $class_name;?>"><?php echo ($value['school_code']); ?></td>
		<td align="left" class="<?php echo $class_name;?>"><?php echo ($value['school_name']); ?></td>
		<td align="left" class="<?php echo $class_name;?>"><?php echo $school_type ?></td>
	  </tr>
	  <?php
	  $i++;
	 }
?>
</table>
</body>
</div>
<!-- display content ends here --------------------------------------->
