<div align="center" class="heading_gray">
<h3>Team List</h3>
</div>
<br />
<div class="container">
<?php echo form_open('report/prereportpdf/team_list', array('id' => 'part_reg','target'=>'_blank'));
$fair_type	=	$this->session->userdata('FAIR_TYPE');
$fair_name	= $this->General_Model->get_data('science_master', '*', array('fairId'=>$fair_type));

?>

<input type="hidden" name="hiddtext" id="hiddtext" value="">
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="5" align="left"><strong>Participants in Group Items</strong></th>
  </tr>
  <tr>
    <td width="4%" class="">&nbsp;</td>
    <td align="left" width="26%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fair : </td>
    <td align="left" width="30%" class="table_row_first"><?php 
	if(($this->session->userdata('USER_GROUP') == 'A') or ($this->session->userdata('USER_GROUP') == 'W'))
	
	echo form_dropdown("cmbFairType",$fair,'', 'class="input_box" id="cmbFairType" onclick="javascript:check_for_workexpo(this.value)" onchange="javascript:check_for_workexpo(this.value)"');
	
	else {
		echo $fair_name[0]['fairName']; ?>
        
	    <input type="hidden" id="cmbFairType"	 name="cmbFairType" value="<? echo $fair_type;?>" /> 
        <? } 
	
	?></td>
    <td width="34%" class="table_row_first">
    <div id="work"  style="display:<?php echo (@$fair_type==4)?'block':'none';?>;">
    
    <input type="radio" name="radioLabel" value="spot" id="radioLabel_spot" checked="checked" onClick="selectCat(this.value)" >
        On the Spot</label>
    <input type="radio" name="radioLabel" value="exhib" id="radioLabel_exhib" onClick="selectCat(this.value)" >
        Exhibition</label>
    
    </div></td>
  </tr>
  <tr>
    <td width="4%" class="">&nbsp;</td>
    <td align="left" width="26%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Category : </td>
    <td align="left" width="30%" class="table_row_first"><?php echo form_dropdown("cmbCateType",$pfest,'', 'class="input_box" id="cmbCateType" onchange="javascript:fetch_team_item_from_festival(this.value)" onClick="javascript:fetch_team_item_from_festival(this.value)"'  );?></td>
    <td width="34%" class="table_row_first">&nbsp;</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="26%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Item Name : </td>
    <td align="left" width="30%" class="table_row_first"><div id="cmbitem"><?php echo form_dropdown("cbo_item",array('select'),'', 'class="input_box" id="cbo_item" '  );?></div></td>
     <td width="34%" class="table_row_first">&nbsp;</td>
    </tr>
  
  <tr>
    <td width="4%" class="">&nbsp;</td>
    <td width="26%" align="left" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Captain :</td>
    <td width="30%" align="left" class="table_row_first"><div id="cmbcap"><?php echo form_dropdown("cbo_cap",array('select'),'', 'class="input_box" id="cbo_cap" '  );?></div></td>
     <td width="34%" class="table_row_first">&nbsp;</td>
    </tr>
  
  <tr>
    <td align="center" colspan="3"><?php echo form_submit('Report', 'Report', 'onClick="javascript: return funvalidatecaptainrpt(this.form)"'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
    <td width="34%">&nbsp;</td>
     <td width="6%" >&nbsp;</td>
  </tr>
</table>
<?php
echo form_close();
?>
</div>