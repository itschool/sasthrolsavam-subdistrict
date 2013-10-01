
<div align="center" class="heading_gray">
<h3>Certificate For Exhibition</h3>
</div>
<br/>
<div class="container">
<?php echo form_open('certificate/certificate/attended_certificate_exhibition_interface', array('id' => 'formIRL'));
?>
<input type="hidden" name="hidUservalue" id="hidUservalue"  value="SHOW" />
<input type="hidden" name="hidSchoolCode" id="hidSchoolCode"  value="<?php //echo $school_details[0]['school_code']; ?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <td width="9%" class="">&nbsp;</td>
    <td align="left" width="24%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Category : </td>
    <td align="left" width="40%" class="table_row_first"><?php if(is_array(@$fest) and (count(@$fest) >0)){
		echo form_dropdown("cmbFestType", @$fest, '', 'class="input_box" id="cmbFestType" onchange="javascript:get_school_items(this.value)" onclick="javascript:get_school_items(this.value)"');
	}
	else{
			echo "<select class='input_box' id='cmbFestType' onchange='javascript:get_school_items(this.value)' onclick='javascript:get_school_items(this.value)' disabled='disabled'";
			echo "<option value=''></option>";
			echo "</select>";
	}
	?></td>
    <td width="27%" class="table_row_first">&nbsp;</td>
  </tr>
 
  
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="24%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" width="40%" class="table_row_first">      <label>
       
       <input type="submit" name="GET" id="GET" value="GET" onclick="return validatespotexpo();"/>
        </label>
    </form>    </td>
    <td width="27%" class="table_row_first">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" colspan="4">&nbsp;</td>
  </tr>
</table>
<?php
//itemwise_report_interface
echo form_close();
?>
</div>