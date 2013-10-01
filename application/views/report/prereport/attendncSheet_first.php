<div align="center" class="heading_gray">
<h3>Call Sheet</h3>
</div>
<br />
<div class="container">
<?php echo form_open('report/prereportpdf/callsheet_report', array('id' => 'callsheet','name' => 'callsheet','target'=>'_blank'));
$fair_type	=	$this->session->userdata('FAIR_TYPE');
$fair_name	= $this->General_Model->get_data('science_master', '*', array('fairId'=>$fair_type));
?>

<input type="hidden" name="hidUserId" id="hidUserId" />
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="5" align="left">Call Sheet :(Item)</th>
  </tr>
  <tr>
    <td width="6%" class="">&nbsp;</td>
    <td align="left" width="17%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fair : </td>
    <td align="left" width="28%" class="table_row_first"><?php 
	if(($this->session->userdata('USER_GROUP') == 'A') or ($this->session->userdata('USER_GROUP') == 'W'))
	echo form_dropdown("cmbFairType",$fair,'', 'class="input_box" id="cmbFairType"   onclick="javascript:check_for_workexpo3(this.value,2)"'  );
	
	else {
		echo $fair_name[0]['fairName']; ?>
        
	    <input type="hidden" id="cmbFairType"	 name="cmbFairType" value="<? echo $fair_type;?>" /> 
        <? } 
	
	?>
    </td>
    <td align="left" width="29%" class="table_row_first">
      <div id="work2"  style="display:<?php echo (@$fair_type==4)?'block':'none';?>;">
    
    <input type="radio" name="radioLabel" value="spot" id="radioLabel_spot" checked="checked" onClick="selectCat2(this.value,this.form)" >
        On the Spot</label>
    <input type="radio" name="radioLabel" value="exhib" id="radioLabel_exhib" onClick="selectCat(this.value,this.form)" >
        Exhibition</label>
    </div>
 
    <td width="14%">&nbsp;</td>
  </tr>
   <tr>
    <td width="6%" class="">&nbsp;</td>
    <td align="left" width="17%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Category : </td>
    <td align="left" width="28%" class="table_row_first"><?php echo form_dropdown("cmbCateType",$pfest,'', 'class="input_box" id="cmbCateType" onchange="javascript:fetch_item_from_participant(this.value)" onclick="javascript:fetch_item_from_participant(this.value)"'  );?></td>
    <td width="29%" class="table_row_first">&nbsp;</td>
    
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="17%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Item Name : </td>
  
    <td align="left" width="28%" class="table_row_first"><div id="cmbitem"><?php echo form_dropdown("cbo_item",array('select'),'', 'class="input_box" id="cbo_item" '  );?></div></td>
    <td width="29%" class="table_row_first">&nbsp;</td>
    
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="17%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" width="28%" class="table_row_first">      <label>
   
      <?php // echo form_submit('Report', 'Report', $jvscript);?>
      <input type="submit" onclick="javacript: return callsheetfirst('report')" name="Report" id="Report"  value="Report"/>
        
        </label>
          <input type="hidden"  name="cmbCateType_hid" value="1" id="cmbCateType_hid"/>
           <input type="hidden"  name="cmbfestId" value="0" id="cmbfestId"/>
    </form>    </td>
    <td width="29%" class="table_row_first">&nbsp;</td>
    
  </tr>
  
  <tr>
    <td align="center" colspan="5">&nbsp;</td>
  </tr>
</table>


<?php
echo form_close();
?>
</div>

