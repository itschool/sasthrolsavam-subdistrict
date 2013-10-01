<div align="center" class="heading_gray">
<h3>Score Sheet</h3>
</div>
<br />
<?php echo form_open('report/prereportpdf/print_score_sheet', array('id' => 'formscore','name' => 'formscore','target'=>'_blank'));
$fair_type	=	$this->session->userdata('FAIR_TYPE');
$fair_name	= $this->General_Model->get_data('science_master', '*', array('fairId'=>$fair_type));
?> 
<div class="container">
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="4" align="left">Score Sheet - Item wise</th>
  </tr>
    <tr>
    <td width="6%" class="">&nbsp;</td>
    <td width="18%" align="left" class="table_row_first"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fair  :</td>
    <td width="29%" align="left" class="table_row_first"><?php 
	if(($this->session->userdata('USER_GROUP') == 'A') or ($this->session->userdata('USER_GROUP') == 'W'))
	
	echo form_dropdown("cmbFairType",$fair,'','id="cmbFairType"  onclick="javascript:check_for_workexpo3(this.value,2)"');
	else {
		echo $fair_name[0]['fairName']; ?>
        
	    <input type="hidden" id="cmbFairType"	 name="cmbFairType" value="<? echo $fair_type;?>" /> 
        <? } 
	?>
    </td>
     <td width="33%" class="table_row_first">
    <div id="work2" style="display:<?php echo (@$fair_type==4)?'block':'none';?>;">
    
    &nbsp;<input type="radio" name="radioLabel" value="spot" id="radioLabel_spot" checked="checked" onClick="selectCat2(this.value,this.form)" >
        On the Spot</label>
    <input type="radio" name="radioLabel" value="exhib" id="radioLabel_exhib" onClick="selectCat(this.value)" >
        Exhibition</label>
    
    </div>
    </td>
    <td width="14%">&nbsp;</td>
  </tr>
  <tr>
    <td width="6%" class="">&nbsp;</td>
    <td align="left" width="18%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Category : </td>
    <td align="left" width="29%" class="table_row_first"><?php echo form_dropdown("cmbCateType",$fest,'', 'class="input_box" id="cmbCateType" onchange="javascript:fetch_item_from_participant(this.value)" onclick="javascript:fetch_item_from_participant(this.value)"'
	  );?></td>
    <td width="33%" class="table_row_first" >&nbsp;</td>
    
    
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="18%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Item Name : </td>
  
    <td align="left" width="29%" class="table_row_first"><div id="cmbitem"><?php echo form_dropdown("cbo_item",array('select'),'', 'class="input_box" id="cbo_item" '  );?></div></td>
    <td width="33%" class="table_row_first">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="18%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" width="29%" class="table_row_first"><form name="form1" method="post" action="">
      <label>
        <input type="submit" name="btnSubmit" id="btnSubmit" value="View report" onclick="javascript: return callsheetfirst()">
        </label>
    </form>
    </td>
    <td width="33%" class="table_row_first">&nbsp;</td>
  </tr>
  
  <tr>
    <td align="center" colspan="4">&nbsp;</td>
  </tr>
</table>
</div>
<input type="hidden" name="hidUserId" id="hidUserId" />

<?php

echo form_close();
?>