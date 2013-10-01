<div align="center" class="heading_gray">
<h3> Participants Eligible For Higher Level Competition</h3>
</div>
<br />
<div class="container">

<?php echo form_open('report/afterresultreportpdf/higherlevel_result', array('id' => 'higher_result','name' => 'higher_result','target'=>'_blank'));

	
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="4" align="left">Select Festival</th>
  </tr>
  <tr>
    <td width="10%" class="">&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fair Name : </td>
    <td align="left" width="55%" class="table_row_first"><?php echo form_dropdown("cmbFairType",$fair,'', 'class="input_box" id="cmbFairType"  onclick="javascript:check_for_workexpo(this.value)" onchange="javascript:check_for_workexpo(this.value)"'  );?>
    <div id="work" style="visibility:hidden;">
    
    <input type="radio" name="radioLabel" value="spot" id="radioLabel_spot" checked="checked" onClick="selectCat(this.value)" >
        On the Spot</label>
    <input type="radio" name="radioLabel" value="exhib" id="radioLabel_exhib" onClick="selectCat(this.value)" >

        Exhibition</label>
    
    </div>
    </td>
    <td width="18%">&nbsp;</td>
  </tr>
  <tr>
    <td width="10%" class="">&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Category : </td>
    <td align="left" width="55%" class="table_row_first"><?php echo form_dropdown("cmbFestType",$fest,'', 'class="input_box" id="cmbCateType" onchange="javascript:fetch_higherlevel_participant(this.value)"'  );?></td>
    <td width="18%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Item Name : </td>
  
    <td align="left" width="55%" class="table_row_first"><div id="cmbitem"><?php echo form_dropdown("cbo_item",array('select'),'', 'class="input_box" id="cbo_item" '  );?></div></td>
    <td width="18%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" width="55%" class="table_row_first">
      <label>
        <input type="submit" name="btnSubmit" id="btnSubmit" value="View report" onclick="return checkvalsubmit();">
        </label>
   
    </td>
    <td width="18%">&nbsp;</td>
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
<br>
<div class="container">
<?php echo form_open('report/afterresultreportpdf/schoolhigher_result', array('id' => 'school_result','target'=>'_blank'));

?>
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">

  <tr>
    <th colspan="4" align="left">Enter School Code</th>
  </tr>
   <tr>
   
    <td width="21%" align="left" class="table_row_first"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fair Name  :</td>
    <td width="23%" align="left" class="table_row_first"><?php 
	echo form_dropdown("cmbFairType1",$fair,'', 'class="input_box" id="cmbFairType1"');?> </td>
    <td width="55%" class="table_row_first"><?php echo form_checkbox("chkviewall", 'YES', '', 'id="chkviewall" onclick="javascript:fncviewallschools()"'); 
	echo form_label("View All Schools", "View All Schools");
	?></td>
  </tr>
    <tr>
   
    <td width="21%" align="left" class="table_row_first"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;School Code  :</td>
    <td width="23%" align="left" class="table_row_first"><?php echo form_input("txtSchoolCode", @$school_details[0]['school_code'], 'class="input_box" id="txtSchoolCode"
	onkeypress="javascript:return numbersonly(this, event, false);"  onBlur="javascript:higher_schooldetails(this.value)"');?> </td>
    <td width="55%" class="table_row_first"><div id="school_name"> </div><td width="1%">
  </tr>
  <tr>
    <td class="table_row_first">&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;</td>
  
    <td align="left" width="55%" class="table_row_first"><input type="submit" name="btnSubmit2" id="btnSubmit2" value="View report" onClick="return checkschoolval();"></td>
    <td width="18%" class="table_row_first">&nbsp;</td>
  </tr>
  <tr>
    <td class="table_row_first">&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" width="55%" class="table_row_first"><!--<a href="../afterresultreportpdf/schoolhigher_resultall" target="_blank">School Wise All</a>-->
   
        </td>
    <td width="18%" class="table_row_first">&nbsp;</td>
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