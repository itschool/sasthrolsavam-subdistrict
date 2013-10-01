<div align="center" class="heading_gray">
<h3>Venue Allotment Duration</h3>
</div>
<br />

<?php echo form_open('report/prereportpdf/groundallot_duration', array('id' => 'formIWP','target'=>'_blank'));
?>
<div class="container">
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="4" align="left">Venue Allotment (Festival|Fair wise)</th>
  </tr>
   
 
    <td width="4%" class="">&nbsp;</td>
    <td align="left" width="26%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fair Type : </td>
    <td align="left" width="30%" class="table_row_first"><?php echo form_dropdown("cmbFairType",$fair,@$fair_id, 'class="input_box" id="cmbFairType" onclick="javascript:check_for_workexpo(this.value)" onchange="javascript:check_for_workexpo(this.value)"'  );?>
    <div id="work" style="visibility:hidden;">
    
    <input type="radio" name="radioLabel" value="spot" id="radioLabel_spot" checked="checked" onClick="selectCat(this.value)" >
        On the Spot</label>
    <input type="radio" name="radioLabel" value="exhib" id="radioLabel_exhib" onClick="selectCat(this.value)" >
        Exhibition</label>
    
    </div></td>
    <td width="34%" ></td>
    
  </tr>  
  <tr>
 
    <td width="4%" class="">&nbsp;</td>
    <td align="left" width="26%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Category : </td>
    <td align="left" width="30%" class="table_row_first">
	  <?php echo form_dropdown("cmbFestType",$fest,'', 'class="input_box" id="cmbCateType" onchange="javascript:fetch_callsheet_festival(this.value)"  '  );?></td>
     <td width="34%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" width="55%" class="table_row_first">      <label>
       <?php echo form_submit('Report', 'Report', 'onClick="javascript: return callsheet()"');?>
        </label>
    </form>    </td>
    <td width="18%">&nbsp;</td>
  </tr>
  
  <tr>
    <td align="center" colspan="4">&nbsp;</td>
  </tr>
</table>
</div>

<?php
//itemwise_report_interface

echo form_close();
?>