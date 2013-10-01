<div align="center" class="heading_gray">
<h3>All Results</h3>
</div>
<br />
<div class="container">
<?php echo form_open('report/afterresultreportpdf/total_points', array('id' => 'formTPWD','name' => 'formTPWD','target'=>'_blank'));

  
	//for($j=0;$j<count($retdat); $j++){
	//$dat[$retdat[$j]['school_code']] = $retdat[$j]['school_name'];
	//}

	$fair_type	=	$this->session->userdata('FAIR_TYPE');
$fair_name	= $this->General_Model->get_data('science_master', '*', array('fairId'=>$fair_type));	
		
?>
<input type="hidden" name="cmbCateType" id="cmbCateType" value="">
<input type="hidden" name="hiddtext" id="hiddtext" value="">
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="4" align="left">Result -  Fair Wise</th>
  </tr>
  
  
  <tr>
   
    <td width="26%" align="left" class="table_row_first"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fair Name  :</td>
    <td width="74%" align="left" class="table_row_first"><?php 
	if(($this->session->userdata('USER_GROUP') == 'A') or ($this->session->userdata('USER_GROUP') == 'W'))
	echo form_dropdown("cmbFairType1",$fair,'', 'class="input_box" id="cmbFairType1" onclick="javascript:check_for_workexpo(this.value)" onchange="javascript:check_for_workexpo(this.value)"'  );
	else {
		echo $fair_name[0]['fairName']; ?>
        
	    <input type="hidden" id="cmbFairType"	 name="cmbFairType" value="<? echo $fair_type;?>" /> 
        <? } 
	?><div id="work" style="visibility:hidden;">
    
    <input type="radio" name="radioLabel" value="spot" id="radioLabel_spot" checked="checked" onClick="selectCat(this.value)" >
        On the Spot</label>
    <input type="radio" name="radioLabel" value="exhib" id="radioLabel_exhib" onClick="selectCat(this.value)" >
        Exhibition</label>
    
    </div> </td>
    
  </tr>
 <tr>
    <td align="center" colspan="3"><?php echo form_submit('Report', 'Report', 'onClick="javascript: return fnctotalpoint()"');?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
  </tr>
   
</table>
<?php

echo form_close();
?>
</div>