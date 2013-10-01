<br />
<?php echo form_open('report/prereportpdf/fest_scoresheet_details', array('id' => 'formSF','name' => 'formSF','target'=>'_blank'));
$fair_type	=	$this->session->userdata('FAIR_TYPE');
$fair_name	= $this->General_Model->get_data('science_master', '*', array('fairId'=>$fair_type));
?>
<div class="container">
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="4" align="left">Score Sheet - Festival wise</th>
  </tr>
   <tr>
    <td width="7%" class="">&nbsp;</td>
    <td width="19%" align="left" class="table_row_first"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fair  :</td>
    <td width="25%" align="left" class="table_row_first"><?php 
	if(($this->session->userdata('USER_GROUP') == 'A') or ($this->session->userdata('USER_GROUP') == 'W'))
	echo form_dropdown("txtfairFrom",$fair,'','id="txtfairFrom"  onclick="javascript:check_for_workexpo3(this.value,3)"');
	
	else {
		echo $fair_name[0]['fairName']; ?>
        
	    <input type="hidden" id="txtfairFrom"	 name="txtfairFrom" value="<? echo $fair_type;?>" /> 
        <? } 
	
	?>
    </td>
    <td width="34%" align="left" class="table_row_first"> 
    <div id="work3"  style="display:<?php echo (@$fair_type==4)?'block':'none';?>;">
    
    <input type="radio" name="radioLabel" value="spot" id="radioLabel_spot" checked="checked"  >
        On the Spot</label>
    <input type="radio" name="radioLabel" value="exhib" id="radioLabel_exhib"  />
        Exhibition</label>
    
    </div>   
    </td>
    <td width="15%">&nbsp;</td>
  </tr>
  <tr>
    <td width="7%" class="">&nbsp;</td>
    <td width="19%" align="left" class="table_row_first"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Category  :</td>
    <td width="25%" align="left" class="table_row_first"><?php echo form_dropdown("txtfestFrom",$fest,'','id="cmbCateType"');
	//echo form_dropdown("txtfestFrom", array($retdat[0]['fest_id']=>$retdat[0]['fest_name'],$retdat[1]['fest_id']=>$retdat[1]['fest_name'],$retdat[2]['fest_id']=>$retdat[2]['fest_name'],$retdat[3]['fest_id']=>$retdat[3]['fest_name'],$retdat[4]['fest_id']=>$retdat[4]['fest_name'],$retdat[5]['fest_id']=>$retdat[5]['fest_name'],$retdat[6]['fest_id']=>$retdat[6]['fest_name'],$retdat[7]['fest_id']=>$retdat[7]['fest_name'],$retdat[8]['fest_id']=>$retdat[8]['fest_name']),'','id="txtfestFrom"');
	
	?></td>
    <td width="34%" class="table_row_first">&nbsp;</td>
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
    <td class="table_row_first">&nbsp;</td>
    <td align="left" class="table_row_first"><?php echo form_submit('Report', 'View Report');?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
  	<td class="table_row_first">&nbsp;</td>
  </tr>
</table>
</div>
<?php
echo form_close();
?>