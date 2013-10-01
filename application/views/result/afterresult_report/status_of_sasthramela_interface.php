<div align="center" class="heading_gray">
<h3>Status of Sasthramela</h3>
</div>
<br />
<div class="container">
<?php echo form_open('report/afterresultreportpdf/status_of_sasthramela1', array('id' => 'formIWP','target'=>'_blank'));
$fair_type	=	$this->session->userdata('FAIR_TYPE');
$fair_name	= $this->General_Model->get_data('science_master', '*', array('fairId'=>$fair_type));
?>

<form name="form1" method="post" action="" >
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="4" align="left">Select Fair</th>
  </tr>
  <tr>
    <td width="7%" class="">&nbsp;</td>
    <td align="left" width="19%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
    Fair Name :</td>
    <td align="left" width="22%" class="table_row_first"><?php 
	if(($this->session->userdata('USER_GROUP') == 'A') or ($this->session->userdata('USER_GROUP') == 'W'))
	echo form_dropdown("cmbFairType",$fair,@$selected_fair_id, 'class="input_box" id="cmbFairType" onclick="javascript:check_for_workexpo(this.value)" onchange="javascript:check_for_workexpo(this.value)"');
	else {
		echo $fair_name[0]['fairName']; ?>
        
	    <input type="hidden" id="cmbFairType"	 name="cmbFairType" value="<? echo $fair_type;?>" /> 
        <? } 
	
	?>
    </td>
    <td align="left" width="37%" class="table_row_first">
    <div id="work" style="display:<?php echo (@$fair_type==4)?'block':'none';?>;">
    
    <input type="radio" name="radioLabel" value="spot" id="radioLabel_spot" checked="checked" onClick="selectCat(this.value)" >
        On the Spot</label>
    <input type="radio" name="radioLabel" value="exhib" id="radioLabel_exhib" onClick="selectCat(this.value)" >
        Exhibition</label>
    
    </div></td>
    <td width="15%">&nbsp;</td>
  </tr>
   
  <tr>
    <td width="7%" class="">&nbsp;</td>
    <td align="left" width="19%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
    Category :</td>
    <td align="left" width="22%" class="table_row_first"><?php echo form_dropdown("cmbCateType",$fest,'', 'class="input_box" id="cmbCateType"');?></td>
    <td width="37%" class="table_row_first">&nbsp;</td>
  </tr>
   <tr>
    <td width="7%" class="">&nbsp;</td>
    <td align="left" width="19%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
    Date :</td>
    <td align="left" width="22%" class="table_row_first"><?php echo form_dropdown("festdate",$date_array,'', 'class="input_box" id="festdate"');?></td>
    <td width="37%" class="table_row_first">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="19%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" width="22%" class="table_row_first">
      <label>
        <input type="submit" name="btnSubmit" id="btnSubmit" value="View report" onclick="return notSelected()">
        </label>
        </td>
    <td width="37%" class="table_row_first">&nbsp;</td>
  </tr>
  
  <tr>
    <td align="center" colspan="4">&nbsp;</td>
  </tr>
</table>
</form>
<input type="hidden" name="hidUserId" id="hidUserId" />

<?php
//itemwise_report_interface
echo form_close();
?>
</div>