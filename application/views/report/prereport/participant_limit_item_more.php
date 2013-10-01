<div align="center" class="heading_gray">
<h3>List Participant More than One Item</h3>
</div>
<br />
<div class="container">
<?php echo form_open('report/prereportpdf/more_limit_partlist', array('id' => 'formIWP','name' => 'formIWP','target'=>'_blank'));
$fair_type	=	$this->session->userdata('FAIR_TYPE');
$fair_name	= $this->General_Model->get_data('science_master', '*', array('fairId'=>$fair_type));

?>
<input type="hidden" name="hidUserId" id="hidUserId" />
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="4" align="left">List of Participants in More than one Item</th>
  </tr>
  <tr>
    <td width="9%" class="">&nbsp;</td>
    <td align="left" width="24%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fair : </td>
    <td align="left" width="27%" class="table_row_first"><?php 
	
	
	if(($this->session->userdata('USER_GROUP') == 'A') or ($this->session->userdata('USER_GROUP') == 'W'))
		echo form_dropdown("cmbFairType",@$fair,@$fair_id, 'class="input_box" id="cmbFairType" onchange="javascript:check_for_workexpo_limit(this.value)" onclick="javascript:check_for_workexpo_limit(this.value)"' );
	else {
			echo $fair_name[0]['fairName']; ?>
        
    	<input type="hidden" id="cmbFairType"	 name="cmbFairType" value="<? echo $fair_type;?>" /> 
        <? } ?>
	
	</td>
    <td width="28%" class="table_row_first">
    <div id="work" style="display:<?php echo (@$fair_type==4)?'block':'none';?>;">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="radio" name="radioLabel" value="spot" id="radioLabel_spot" checked="checked" onClick="selectCat2(this.value,this.form)" >
        On the Spot
            
    </div>  
	
	</td>
  </tr>
  <tr>
    <td width="9%" class="">&nbsp;</td>
    <td align="left" width="24%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Category : </td>
    <td align="left" width="27%" class="table_row_first"><?php echo form_dropdown("cmbCateType",$pfest,'', 'class="input_box" id="cmbCateType"'  );?></td>
    <td width="40%" class="table_row_first">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="24%" class="table_row_first">&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Limit Number:</td>
  
    <td align="left" width="27%" class="table_row_first"><?php echo form_dropdown("txtLimitcode", $no_array,'','class="input_box_small" id="txtLimitcode" '); ?></td>
    <td width="40%" class="table_row_first">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="24%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">      <label>
       <?php echo form_submit('Report', 'Report', 'onClick="javascript: return validateallfair(this.form)"');?>
        </label>
    </form>
    </td>
    <td width="40%" class="table_row_first">&nbsp;</td>
  </tr>
  
  <tr>
    <td align="center" colspan="4">&nbsp;</td>
  </tr>
</table>


<?php
echo form_close();
?>
</div>