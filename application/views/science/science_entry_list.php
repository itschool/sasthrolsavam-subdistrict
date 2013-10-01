<script type="text/javascript" src="<?php echo base_url();?>/js/common.js">
</script>
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
    <td align="center"><span class="style1">Science Fair </span></td>
    </tr>
    </table><br />


<div class="container">
 <!--<div class="contentbox" align="center">-->
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" style="margin-top:15px;">
  <tr class="heading_tab">
    <th colspan="4" align="left" >School Details</th>
	<th align="center" class="heading_tab" >Print <img src="<?php echo image_url().'/print_icon.png';?>" title="print" class="window_print" 
		onClick="javascript:printContent('print_content');return false;" /></th>
  </tr>
  

<tr>
<td class="heading_tab" colspan="4">&nbsp;</td>
</tr>
  <tr class="heading_tab" style="height:20px;">
    <th align="center" width="5%"  >Sl.No</th>
	<th align="left"  width="20%"  >School Code</th>
    <th align="left"  width="50%"  >School Name</th>
    <th align="left" width="25%"  >Entered</th>
  </tr>
  <?php
 // var_dump($details);
$i=1;
if(@$details){
foreach(@$details as $value)
	{
	$color = ($i % 2 == 0) ? '#E6F0DD' : '';
		
?>
  <tr style="border-top:1px solid #CFCFCF;" bgcolor="<? echo $color; ?>" >
    <td align="center" ><?php echo $i; ?></td>
	<td align="left" ><a href="<?php echo base_url();?>index.php/science/science_entry/science_school_entry/<?php echo $value['school_code']?>/1"><?php echo ($value['school_code']); ?></a></td>
    <td align="left" ><a href="<?php echo base_url();?>index.php/science/science_entry/science_school_entry/<?php echo $value['school_code']?>/1"><?php echo ($value['school_name']); ?></a></td>
    <td align="left"><?php echo ($value['entered']['entered']); ?></td>
    <input name="fairId" type="hidden" id="fairId" value="<?php echo @$school_details[0]['school_code'];?>" />
  </tr>
  <? $i++;} }?>

  <input type="hidden" name="UserIdty" id="UserIdty" value="">
</table>
<!--</div>-->
</div>

