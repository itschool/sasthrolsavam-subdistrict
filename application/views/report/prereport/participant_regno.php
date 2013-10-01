<!--<div align="center" class="heading_gray">
<h3>Participant Card(single)</h3>
</div>-->
<br />
<?php echo form_open('report/prereportpdf/participant_regno', array('id' => 'part_reg','target'=>'_blank'));


	for($j=0;$j<count($retdat); $j++){
	$dat[$retdat[$j]['school_code']] = $retdat[$j]['school_name'];
	}	
$fair_type	=	$this->session->userdata('FAIR_TYPE');
$fair_name	= $this->General_Model->get_data('science_master', '*', array('fairId'=>$fair_type));
?>

<input type="hidden" name="hiddtext" value="">
<div class="container" >
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="4" align="left">Participants Cards - Reg No Wise</th>
  </tr>
  <tr>
    <td width="20%" align="left" class="table_row_first"><strong> &nbsp;Fair</strong></td>
    <td width="24%" align="left" class="table_row_first"><?php 
	if(($this->session->userdata('USER_GROUP') == 'A') or ($this->session->userdata('USER_GROUP') == 'W'))
	echo form_dropdown("cmbFairType",$fair,'', 'class="input_box" id="cmbFairType" onclick="javascript:check_for_workexpofaironly(this.value)"');
	else {
		echo $fair_name[0]['fairName']; ?>
        
	    <input type="hidden" id="cmbFairType"	 name="cmbFairType" value="<? echo $fair_type;?>" /> 
        <? } 
	?> </td>
    <td width="55%" class="table_row_first"><td width="1%">
  </tr>
  <tr>
    <td width="20%" align="left" class="table_row_first"><strong> &nbsp;Enter Register Number :</strong></td>
    <td width="24%" align="left" class="table_row_first"><?php echo form_input("regno", '','class="input_box" id="regno" onkeypress="javascript:return numbersonly(this, event, false);" '); ?> </td>
    <td width="55%" class="table_row_first"><td width="1%">
  </tr>
   <tr>
    <td width="20%" align="left" class="table_row_first">&nbsp;</td>
    <td width="24%" align="left" class="table_row_first"><?php echo form_input("regno1", '','class="input_box" id="regno1" onkeypress="javascript:return numbersonly(this, event, false);" '); ?> </td>
    <td width="55%" class="table_row_first"><td width="1%">
  </tr>
   <tr>
   
    <td width="20%" align="left" class="table_row_first">&nbsp;</td>
    <td width="24%" align="left" class="table_row_first"><?php echo form_input("regno2", '','class="input_box" id="regno2" onkeypress="javascript:return numbersonly(this, event, false);" '); ?> </td>
    <td width="55%" class="table_row_first"><td width="1%">
  </tr>
  <tr>
    <td align="center" colspan="3"><?php echo form_submit('Card', 'Card'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
  </tr>
</table>
</div>
<?php
echo form_close();
?>