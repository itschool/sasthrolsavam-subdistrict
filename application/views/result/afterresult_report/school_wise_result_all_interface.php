
<div align="center" class="heading_gray">
<h3>School Wise Point Result</h3>
</div>
<br />
<div class="container">
<?php echo form_open('report/afterresultreportpdf/school_wise_result_all', array('id' => 'formPWD','target'=>'_blank'));
$fair_type	=	$this->session->userdata('FAIR_TYPE');
$fair_name	= $this->General_Model->get_data('science_master', '*', array('fairId'=>$fair_type));
?>
<input type="hidden" name="hiddtext" id="hiddtext" value="">
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="4" align="left">List of Participant Details - School wise</th>
  </tr>
 
  <tr>
   
    <td width="21%" height="38" align="left" class="table_row_first"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fair Name  :</td>
    <td width="23%" align="left" class="table_row_first"><?php 
	if(($this->session->userdata('USER_GROUP') == 'A') or ($this->session->userdata('USER_GROUP') == 'W'))
	echo form_dropdown("cmbFairType",$fair,@$selected_fair_id, 'class="input_box" id="cmbFairType" ');
	else {
		echo $fair_name[0]['fairName']; ?>
        
	    <input type="hidden" id="cmbFairType"	 name="cmbFairType" value="<? echo $fair_type;?>" /> 
        <? } 
	
	
	?> </td>
    <td width="55%" class="table_row_first"></td><td width="1%"></td>
  </tr>
 
    <td align="center" colspan="3"><?php echo form_submit('Report', 'Report', 'onClick="javascript: return funschoolwisepoint()"');?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
  </tr>
   <tr><td colspan="3" align="center"><!--<a href="../afterresultreportpdf/allschool_points_result" target="_blank">All School </a>--></td></tr>
</table>
<?php

echo form_close();
?>
</div>