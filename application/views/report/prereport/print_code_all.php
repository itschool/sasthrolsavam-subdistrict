<br />

<div class="container">
    
<?php echo form_open('report/codegen/generateCodenumbers', array('id' => 'formIWP'));?>
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="5" align="left">Print Code Number</th>
  </tr>
  <tr>
    <td width="8%" class="">&nbsp;</td>
    <td align="left" width="21%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Fair : </td>
    <td align="left" width="22%" class="table_row_first">
	
    
    <select name="cmbFairType" id="cmbFairType"  class="input_box" onchange="javascript:check_for_workexpo(this.value)">
    <option value="0">Select Fair</option>
    <option value="4">Work Experience Fair</option>
    </select><?php //echo form_dropdown("cmbFairType",$fair,'', 'class="input_box" id="cmbFairType" onclick="javascript:check_for_workexpo(this.value)" onchange="javascript:check_for_workexpo(this.value)"' );?>
    </td>
    <td width="35%" class="table_row_first">&nbsp;
    <div id="work" style="visibility:hidden;">
    
    <input type="radio" name="radioLabel" value="spot" id="radioLabel_spot" checked="checked" onClick="selectCat(this.value)" >
        On the Spot</label>
    <input type="radio" name="radioLabel" value="exhib" id="radioLabel_exhib" onClick="selectCat(this.value)" >
        Exhibition</label>
    
    </div>
    
    
    </td>
    <td width="14%" class="">&nbsp;</td>
  </tr>
  <tr>
    <td width="8%" class="">&nbsp;</td>
    <td align="left" width="21%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Category : </td>
    <td align="left" width="22%" class="table_row_first">
	
	<?php echo form_dropdown("cmbCateType",$fest,'', 'class="input_box" id="cmbCateType" onchange="javascript:fetch_item_participant_codegen(this.value)" onClick="javascript:fetch_item_participant_codegen(this.value)"'  );?>

    </td>
    <td width="35%" class="table_row_first">&nbsp;</td>
    <td width="14%" class="">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="21%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Item Name : </td>
  
    <td align="left" width="22%" class="table_row_first"><div id="cmbitem"><?php echo form_dropdown("cbo_item",array('select'),'', 'class="input_box" id="cbo_item" '  );?></div></td>
    <td width="35%" class="table_row_first">&nbsp;</td>
    <td width="14%" class="">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="21%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" width="22%" class="table_row_first"><form name="form1" method="post" action="">
      <label>
        <input type="submit" name="btnSubmit" id="btnSubmit" value="Generate Codenumbers" onclick="javascript: return generateCodenumbers();">
       </label>
    </form>
    </td>
    <td width="35%" class="table_row_first">&nbsp;</td>
    <td width="14%" class="">&nbsp;</td>
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