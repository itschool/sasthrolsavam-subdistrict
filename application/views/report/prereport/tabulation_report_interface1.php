
<br />
<?php echo form_open('report/prereport/rpt_tabulation_sheet1', array('id' => 'formIWP','name' => 'formIWP','target'=>'_blank'));
$fair_type	=	$this->session->userdata('FAIR_TYPE');
$fair_name	= $this->General_Model->get_data('science_master', '*', array('fairId'=>$fair_type));

?>
<div class="container">
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="4" align="left">Tabulation Sheet(Festival Wise)</th>
  </tr>
  <tr>
    <td width="7%" class="">&nbsp;</td>
    <td align="left" width="19%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fair Name: </td>
    <td align="left" width="21%" class="table_row_first"><?php 
	if(($this->session->userdata('USER_GROUP') == 'A') or ($this->session->userdata('USER_GROUP') == 'W'))
	echo form_dropdown("cmbFairType",$fair,'', 'class="input_box" id="cmbFairType"  onclick="javascript:check_for_workexpo3(this.value,2)"');
	else {
		echo $fair_name[0]['fairName']; ?>
        
	    <input type="hidden" id="cmbFairType"	 name="cmbFairType" value="<? echo $fair_type;?>" /> 
        <? } 
	
	?>
    </td>
    <td align="left" width="45%" class="table_row_first">
    <div id="work2" style="display:<?php echo (@$fair_type==4)?'block':'none';?>;">
    
    &nbsp;<input type="radio" name="radioLabel" value="spot" id="radioLabel_spot" checked="checked"  >
        On the Spot</label>
    <input type="radio" name="radioLabel" value="exhib" id="radioLabel_exhib" >
        Exhibition</label>
    
    </div>
    </td>
    <td width="8%">&nbsp;</td>
  </tr>
  <tr>
    <td width="7%" class="">&nbsp;</td>
    <td align="left" width="19%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Category : </td>
    <td align="left" width="21%" class="table_row_first"><?php echo form_dropdown("cmbFestType",$fest,'', 'class="input_box" id="cmbCateType"');?></td>
    <td width="45%" class="table_row_first">&nbsp;</td>
  </tr>
  <tr>
    <td width="7%">&nbsp;</td>
    <td align="left" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date :</td>
    <td align="left" class="table_row_first">
            <?php echo form_dropdown("txtDate", @$date_array,(@$date != '') ? $date :'', 'class="select_box_medium" id="txtDate"' );?>
            <!--<input class="input_box date_field" type="text" onfocus="displayCalendar(document.formAllotment.txtDate,'yyyy-mm-dd',this)" name="txtDate" id="txtDate" value="<?php echo @$date; ?>" readonly="readonly">-->
          	<!--<input class="input_box date_field" type="text"   onFocus="javascript:vDateType='3'" onBlur="DateFormat(this,this.value,event,true,'3')" onKeyDown="DateFormat(this,this.value,event,false,'3')" onKeyUp="DateFormat(this,this.value,event,false,'3')" maxlength="10"  name="txtDate" id="txtDate" value="<?php //echo $start_date; ?>">-->
            <!--<img src="<?php echo image_url();?>calender.gif" onclick="displayCalendar(document.formAllotment.txtDate,'yyyy-mm-dd',this)" width="16" height="16" style="cursor:pointer" />-->
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td class="table_row_first">&nbsp;</td>
  </tr>
    <tr>
    <td>&nbsp;</td>
    <td align="left" width="19%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" width="21%" class="table_row_first"><form name="form" method="post" action="" >
      <label>
        <input type="submit" name="btnSubmit" id="btnSubmit" value="View report" >
        </label>
    </form>
    </td>
    <td width="45%" class="table_row_first">&nbsp;</td>
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

