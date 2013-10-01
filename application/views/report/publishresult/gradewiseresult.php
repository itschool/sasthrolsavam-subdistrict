<style type="text/css">
<!--
.style1 {
	font-size: 14px;
	font-weight: bold;
	color: #660033;
}
.style2{
	font-size: 12px;
	font-weight: bold;
	color:#000000;
}
.style3{ 
	font-size: 11px;
	font-weight: bold;
	color:#000000;
}

-->
</style>

<div align="center" class="heading_gray">
<h3>Grade Wise Participant Result Details</h3>
</div>
<br />
<div class="container">
<?php echo form_open('report/resultindex/grade_report', array('id' => 'radewise','target'=>'_blank'));

		$rank['A']=' A  -  GRADE ';
		$rank['B']=' B  -  GRADE ';
		$rank['C']=' C  -  GRADE ';
		$rank['ALL']=' All GRADE ';
$fair_type	=	$this->session->userdata('FAIR_TYPE');
$fair_name	= $this->General_Model->get_data('science_master', '*', array('fairId'=>$fair_type));
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="4" align="left">Select Category, Item &amp; Grade</th>
  </tr>
  <tr>
    <td width="7%" class="">&nbsp;</td>
    <td align="left" width="19%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Fair : </td>
    <td align="left" width="27%" class="table_row_first"><?php 
	if(($this->session->userdata('USER_GROUP') == 'A') or ($this->session->userdata('USER_GROUP') == 'W'))
	echo form_dropdown("cmbFairType",$fair,'', 'class="input_box" id="cmbFairType" onclick="javascript:check_for_workexpo(this.value)" onchange="javascript:check_for_workexpo(this.value)"');
	else {
		echo $fair_name[0]['fairName']; ?>
        
	    <input type="hidden" id="cmbFairType"	 name="cmbFairType" value="<? echo $fair_type;?>" /> 
        <? } 
	?>
    </td>
    <td align="left" width="33%" class="table_row_first">
      <div id="work" style="display:<?php echo (@$fair_type==4)?'block':'none';?>;">
    
    <input type="radio" name="radioLabel" value="spot" id="radioLabel_spot" checked="checked" onClick="selectCat(this.value)" >
        On the Spot</label>
    <input type="radio" name="radioLabel" value="exhib" id="radioLabel_exhib" onClick="selectCat(this.value)" >
        Exhibition</label>
    
    </div></td>
    <td width="14%">&nbsp;</td>
  </tr>
 <tr>
    <td width="7%" class="">&nbsp;</td>
    <td align="left" width="19%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Category : </td>
    <td align="left" width="27%" class="table_row_first"><?php echo form_dropdown("cmbCateType",$fest,'', 'class="input_box" id="cmbCateType" onchange="javascript:fetch_item_from_participant(this.value)" onClick="javascript:fetch_item_from_participant(this.value)"'  );?></td>
    <td width="33%" class="table_row_first">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="19%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Item Name : </td>
  
    <td align="left" width="27%" class="table_row_first"><div id="cmbitem"><?php echo form_dropdown("cbo_item",array('select'),'', 'class="input_box" id="cbo_item" '  );?></div></td>
    <td width="33%" class="table_row_first">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="19%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Grade :</td>
  
    <td align="left" width="27%" class="table_row_first" ><?php echo form_dropdown("grade",$rank,'', 'class="input_box" id="grade" '  );?>&nbsp;</td>
    <td width="33%" class="table_row_first">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="19%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" width="27%" class="table_row_first"><form name="form1" method="post" action="">
      <label>
      <input type="submit" name="btnSubmit" id="btnSubmit" value="View report" onClick="return rankwise();">
      </label>
    </form>    </td>
    <td width="33%" class="table_row_first">&nbsp;</td>
  </tr>
  
  <tr>
    <td align="center" colspan="4">&nbsp;</td>
  </tr>
</table>
<input type="hidden" name="hidUserId" id="hidUserId" />

<?php
echo form_close();
?>
</div>