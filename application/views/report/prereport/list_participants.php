<div align="center" class="heading_gray">
<h3>List of participants for team manager</h3>
</div>
<br />
<div class="container">
<?php echo form_open('report/prereportpdf/list_participants', array('id' => 'formPWD', 'name' => 'formPWD' , 'target'=>'_blank'));
//echo blue_box_top();
$fair_type	=	$this->session->userdata('FAIR_TYPE');
$fair_name	= $this->General_Model->get_data('science_master', '*', array('fairId'=>$fair_type));
	/*for($j=0;$j<count($retdat); $j++){
	$dat[$retdat[$j]['school_code']] = $retdat[$j]['school_name'];
	}*/

		
		
?>
<input type="hidden" name="hiddtext" id="hiddtext" value="">
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="4" align="left">List of Participant Details - School wise</th>
  </tr>
  <tr>
   
    <td width="21%" align="left" class="table_row_first"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;School Code  :</td>
    <td width="23%" align="left" class="table_row_first"><?php 
	echo form_input("txtSchoolCode", @$school_details[0]['school_code'], 'class="input_box" id="txtSchoolCode"
	onkeypress="javascript:return numbersonly(this, event, false);"  onBlur="javascript:fetch_schooldetails(this.value)"');?> </td>
    <td width="55%" class="table_row_first"><div id="cmbitem"> </div><td width="1%">
  </tr>
  <tr>
  		<td width="21%" align="left" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fair :</td>
        <td width="23%" align="left" class="table_row_first"><?php 
		if(($this->session->userdata('USER_GROUP') == 'A') or ($this->session->userdata('USER_GROUP') == 'W'))
		
		
		echo form_dropdown("cmbFairType",$fair,'', 'class="input_box" id="cmbFairType"  onclick="javascript:check_for_workexpo3(this.value,2)"  onchange="javascript:check_for_workexpo3(this.value,2)"'  );
		else {
		echo $fair_name[0]['fairName']; ?>
        
	    <input type="hidden" id="cmbFairType"	 name="cmbFairType" value="<? echo $fair_type;?>" /> 
        <? } 
		
		?></td>
        <td class="table_row_first">
        
        <div id="work2" style="display:<?php echo (@$fair_type==4)?'block':'none';?>;">
    
    <input type="radio" name="radioLabel" value="spot" id="radioLabel_spot" checked="checked" onClick="selectCat2(this.value,this.form)" >
        On the Spot</label>
    <input type="radio" name="radioLabel" value="exhib" id="radioLabel_exhib" onClick="selectCat2(this.value,this.form)" >
        Exhibition</label>
    
    </div>
        
        </td>
   </tr>
   <tr>
  		<td width="21%" align="left" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Category :</td>
        <td width="23%" align="left" class="table_row_first"><?php echo form_dropdown("cmbCateType",$pfest,'', 'class="input_box" id="cmbCateType"'  );?></td>
        <td class="table_row_first"></td>
   </tr>
  <tr>
    <td align="center" colspan="3"><?php echo form_submit('Report', 'Report', 'onClick="javascript: return fnschgpwdAddrr1()"');?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
  </tr>
</table>
<?php
//echo blue_box_bottom();
echo form_close();
?>
</div>