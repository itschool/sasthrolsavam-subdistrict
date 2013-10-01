<div align="center" class="heading_gray">
<h3>Tabulation Sheet</h3>
</div>
<br />
<?php echo form_open('report/prereport/rpt_tabulation_sheet', array('id' => 'formTabItem','name' => 'formTabItem','target'=>'_blank'));
$fair_type	=	$this->session->userdata('FAIR_TYPE');
$fair_name	= $this->General_Model->get_data('science_master', '*', array('fairId'=>$fair_type));
?>
<div class="container">
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="4" align="left">Tabulation Sheet(Item Wise)</th>
  </tr>
  <tr>
    <td width="7%" class="">&nbsp;</td>
    <td align="left" width="19%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fair Name: </td>
    <td align="left" width="27%" class="table_row_first">
    <?php 
	if(($this->session->userdata('USER_GROUP') == 'A') or ($this->session->userdata('USER_GROUP') == 'W'))
	echo form_dropdown("cmbFairType",$fair,'', 'class="input_box" id="cmbFairType"  onclick="javascript:check_for_workexpo3(this.value,3)"');
	else {
		echo $fair_name[0]['fairName']; ?>
        
	    <input type="hidden" id="cmbFairType"	 name="cmbFairType" value="<? echo $fair_type;?>" /> 
        <? } 
	
	?> 
    </td>
     <td align="left" width="38%" class="table_row_first">
    <div id="work3"  style="display:<?php echo (@$fair_type==4)?'block':'none';?>;">
    
    <input type="radio" name="radioLabel" value="spot" id="radioLabel_spot" checked="checked" onClick="selectCat2(this.value,this.form)" >
        On the Spot</label>
    <input type="radio" name="radioLabel" value="exhib" id="radioLabel_exhib" onClick="selectCat(this.value,this.form)" >
        Exhibition</label>
    
    </div>  
      </td>
    <td width="9%">&nbsp;</td>
  </tr>
  <tr>
    <td width="7%" class="">&nbsp;</td>
    <td align="left" width="19%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Category : </td>
    <td align="left" width="27%" class="table_row_first"><?php echo form_dropdown("cmbCateType",$fest,'', 'class="input_box" id="cmbCateType" onchange="javascript:fetch_item_from_participant(this.value)" onclick="javascript:fetch_item_from_participant(this.value)"'  );?></td>
    <td width="38%" class="table_row_first">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="19%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Item Name : </td>
  
    <td align="left" width="27%" class="table_row_first"><div id="cmbitem"><?php echo form_dropdown("cbo_item",array('Select'),'', 'class="input_box" id="cbo_item"');?></div></td>
    <td width="38%" class="table_row_first">&nbsp;</td>
  </tr>
  <!--<tr>
    <td>&nbsp;</td>
    <td align="left" class="table_row_first"><div align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No of Participants :</div></td>
    <td align="left" class="table_row_first"><?php 
			 //echo form_input("txtParticipantNum",'', 'class="input_box_small" id="txtParticipantNum" onkeypress="javascript:return numbersonly(this, event, false);"');
		
		?>    (No of rows to be printed)</td>
    <td>&nbsp;</td>
    </tr>-->
   <tr>
    <td>&nbsp;</td>
    <td align="left" width="19%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" width="27%" class="table_row_first"><form name="form1" method="post" action="" >
      <label>
      <input type="submit" name="btnSubmit" id="btnSubmit" value="View report" onClick="javascript:return tabulationitemsubmit()">
      </label>
    </form>    </td>
    <td width="38%" class="table_row_first">&nbsp;</td>
  </tr>
  
  <tr>
    <td align="center" colspan="4">&nbsp;</td>
  </tr>
</table>
</div>
<input type="hidden" name="hidUserId" id="hidUserId" />

<?php
//itemwise_report_interface

echo form_close();
?>

