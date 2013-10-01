
<div align="center" class="heading_gray">
<h3>Certificate School Wise</h3>
</div>
<br/>
<div class="container">
<?php echo form_open('certificate/certificate/get_certificate_pdf_school_wise', array('id' => 'formIRL'));
$fair_type	=	$this->session->userdata('FAIR_TYPE');
$fair_name	= $this->General_Model->get_data('science_master', '*', array('fairId'=>$fair_type));
?>
<input type="hidden" name="hidUservalue" id="hidUservalue"  value="SHOW" />
<input type="hidden" name="hidSchoolCode" id="hidSchoolCode"  value="<?php echo $school_details[0]['school_code']; ?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="4" align="left"><?php echo $school_details[0]['school_code'].' - '.$school_details[0]['school_name']; ?>&nbsp;&nbsp;- Certificate Details</th>
  </tr>
  <?php if(is_array(@$fair) and (count(@$fair) >0)){?>
   <tr>
    <td width="9%" class="">&nbsp;</td>
    <td align="left" width="24%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fair : </td>
    <td align="left" width="40%" class="table_row_first">
	<?php 
	if(($this->session->userdata('USER_GROUP') == 'A') or ($this->session->userdata('USER_GROUP') == 'W')){
			echo form_dropdown("cmbFairType",$fair,'', 'class="input_box" id="cmbFairType" onclick="javascript:check_workexpo_4result_certificate(this.value)" onchange="javascript:check_workexpo_4result_certificate(this.value)"'  );
	}
	else{
			echo $fair_name[0]['fairName'];?>
            <input type="hidden" id="cmbFairType"	 name="cmbFairType" value="<? echo $fair_type;?>" />    
	<?php
	}
	?>
    
    <?php if($this->session->userdata('FAIR_TYPE')== 4){ ?>
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="radio" name="radioLabel" value="spot" id="radioLabel_spot"  checked="checked">On the Spot
	<?php } ?>
    
    
    <?php if($this->session->userdata('FAIR_TYPE')!= 4){ ?>
                   <div id="work" style="visibility:hidden;">
  			  <input type="radio" name="radioLabel" value="spot" id="radioLabel_spot"  checked="checked" >
        On the Spot
    
    </div>
					<?php }?>
        
    </td>
    <td width="27%" class="table_row_first"></td>
  </tr>
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
  <tr >
    <td width="9%" class="">&nbsp;</td>
    <td align="left" width="24%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Item : </td>
    <td align="left" width="40%" class="table_row_first" ><div id="all_item_code"><select  class="input_box"  name="item_code" id="item_code" ><option value="0">All Items</option></select></div></td>
    <td width="27%" class="table_row_first">&nbsp;</td>
  </tr>
  <tr >
    <td width="9%" class="">&nbsp;</td>
    <td align="left" width="24%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Participant / Leader : </td>
    <td align="left" width="40%" class="table_row_first" ><div id="all_captain_id"><select  class="input_box"  name="captain_id" id="captain_id" ><option value="0">All Participants</option></select></div></td>
    <td width="27%" class="table_row_first">&nbsp;</td>
  </tr>
  <tr >
    <td width="9%" class="">&nbsp;</td>
    <td align="left" width="24%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Participant( Group ) : </td>
    <td align="left" width="40%" class="table_row_first" ><div id="all_group_participant_id"><select  class="input_box"  name="participant_id" id="participant_id" ><option value="0">All Participants</option></select></div></td>
    <td width="27%" class="table_row_first">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="24%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" width="40%" class="table_row_first">      <label>
       <?php //echo form_submit('GET', 'GET', 'onClick="javascript: return validateschoolcertificate()"');?>
       <input type="submit" name="GET" id="GET" value="GET" onclick="return validatespotexpo();"/>
        </label>
    </form>    </td>
    <td width="27%" class="table_row_first">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" colspan="4">&nbsp;</td>
  </tr>
  <?php }?>
</table>
<?php
//itemwise_report_interface
echo form_close();
?>
</div>