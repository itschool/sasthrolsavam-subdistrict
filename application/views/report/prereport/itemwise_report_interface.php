<div align="center" class="heading_gray">
<h3>Itemwise Participants</h3>
</div>
<br />

<div class="container">
    
<?php echo form_open('report/prereportpdf/rpt_itemwiseparticipants', array('id' => 'formIWP','target'=>'_blank'));
$fair_type	=	$this->session->userdata('FAIR_TYPE');
$fair_name	= $this->General_Model->get_data('science_master', '*', array('fairId'=>$fair_type));
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="5" align="left">Select Item</th>
  </tr>
  <tr>
    <td width="8%" class="">&nbsp;</td>
    <td align="left" width="21%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Fair : </td>
    <td align="left" width="22%" class="table_row_first"><?php 
	if(($this->session->userdata('USER_GROUP') == 'A') or ($this->session->userdata('USER_GROUP') == 'W'))
	echo form_dropdown("cmbFairType",$fair,'', 'class="input_box" id="cmbFairType" onclick="javascript:check_for_workexpo(this.value)" onchange="javascript:check_for_workexpo(this.value)"' );
	else {
		echo $fair_name[0]['fairName']; ?>
        
	    <input type="hidden" id="cmbFairType"	 name="cmbFairType" value="<? echo $fair_type;?>" /> 
        <? } 	
	
	?></td>
    <td width="37%" class="table_row_first">
    <div id="work" style="display:<?php echo (@$fair_type==4)?'block':'none';?>;">
    
    <input type="radio" name="radioLabel" value="spot" id="radioLabel_spot" checked="checked" onClick="selectCat(this.value)" >
        On the Spot</label>
    <input type="radio" name="radioLabel" value="exhib" id="radioLabel_exhib" onClick="selectCat(this.value)" >
        Exhibition</label>
    
    </div>
    
    
    </td>
    <td width="12%" class="">&nbsp;</td>
  </tr>
  <tr>
    <td width="8%" class="">&nbsp;</td>
    <td align="left" width="21%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Category : </td>
    <td align="left" width="22%" class="table_row_first">
	
	<?php echo form_dropdown("cmbCateType",$fest,'', 'class="input_box" id="cmbCateType" onchange="javascript:fetch_item_from_participant(this.value)" onClick="javascript:fetch_item_from_participant(this.value)"'  );?>

    </td>
    <td width="37%" class="table_row_first">&nbsp;</td>
    <td width="12%" class="">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="21%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Item Name : </td>
  
    <td align="left" width="22%" class="table_row_first"><div id="cmbitem"><?php echo form_dropdown("cbo_item",array('select'),'', 'class="input_box" id="cbo_item" '  );?></div></td>
    <td width="37%" class="table_row_first">&nbsp;</td>
    <td width="12%" class="">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="21%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" width="22%" class="table_row_first"><form name="form1" method="post" action="">
      <label>
        <input type="submit" name="btnSubmit" id="btnSubmit" value="View report" onclick="javascript: return callsheetfirst();">
       </label>
    </form>
    </td>
    <td width="37%" class="table_row_first">&nbsp;</td>
    <td width="12%" class="">&nbsp;</td>
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