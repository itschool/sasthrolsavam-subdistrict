<div align="center" class="heading_gray">
<h3>Result Itemwise</h3>
</div>
<br />
<div class="container">

<?php echo form_open('report/timefestreport/timefest_result_confidential', array('id' => 'timeoffest','target' => '_blank'));
$fair_type	=	$this->session->userdata('FAIR_TYPE');
$fair_name	= $this->General_Model->get_data('science_master', '*', array('fairId'=>$fair_type));
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="4" align="left">Declared &nbsp;Result </th>
  </tr>
  <tr>
    <td width="9%" class="table_row_first">&nbsp;</td>
    <td align="left" width="24%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fair Name: </td>
    <td align="left" width="27%" class="table_row_first"><?php 
	if(($this->session->userdata('USER_GROUP') == 'A') or ($this->session->userdata('USER_GROUP') == 'W'))
	echo form_dropdown("resultFair",$fair,'', 'class="input_box" id="resultFair" onclick="javascript:check_for_workexpo(this.value)" onchange="javascript:check_for_workexpo(this.value)"');
	else {
		echo $fair_name[0]['fairName']; ?>
        
	    <input type="hidden" id="resultFair"	 name="resultFair" value="<? echo $fair_type;?>" /> 
        <? } 
	?></td>
    <td width="40%" class="table_row_first">
    <div id="work" style="display:<?php echo (@$fair_type==4)?'block':'none';?>;">
    
    <input type="radio" name="radioLabel" value="spot" id="radioLabel_spot" checked="checked" onClick="selectCat(this.value)" >
        On the Spot</label>
    <input type="radio" name="radioLabel" value="exhib" id="radioLabel_exhib" onClick="selectCat(this.value)" >
        Exhibition</label>
    
    </div></td>
  </tr>
  <tr>
    <td width="9%" class="table_row_first">&nbsp;</td>
    <td align="left" width="24%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Category  : </td>
    <td align="left" width="27%" class="table_row_first"><?php echo form_dropdown("resultFest",$fest,'', 'class="input_box" id="resultFest" ');?></td>
    <td width="40%" class="table_row_first">&nbsp;</td>
  </tr>
  <tr>
    <td class="table_row_first">&nbsp;</td>
    <td align="left" width="24%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">
      <label>
        <input type="submit" name="btnSubmit" id="btnSubmit" value="GET">
        </label>       </td>
    <td width="40%" class="table_row_first">&nbsp;</td>
  </tr>
  
  <tr>
    <td align="center" colspan="4">&nbsp;</td>
  </tr>
</table>
<input type="hidden" name="hidUserId" id="hidUserId" />
<?php
//itemwise_report_interface

echo form_close();
?>
</div>
