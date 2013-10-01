<!--<div align="center" class="heading_gray">
<h3>List of participants for team manager</h3>
</div>-->
<br />
<div class="container">
<?php echo form_open('report/prereportpdf/team_manager_all', array('id' => 'team_manager','name' => 'team_manager','target'=>'_blank'));
//echo blue_box_top();
$fair_type	=	$this->session->userdata('FAIR_TYPE');
$fair_name	= $this->General_Model->get_data('science_master', '*', array('fairId'=>$fair_type));
?>
<input type="hidden" name="hidUserId" id="hidUserId" />
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="5" align="left">List of Participant Details - Category wise</th>
  </tr>
   <tr>
    <td width="8%" class="">&nbsp;</td>
    <td align="left" width="22%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fair : </td>
    <td align="left" width="19%" class="table_row_first"><?php 
	if(($this->session->userdata('USER_GROUP') == 'A') or ($this->session->userdata('USER_GROUP') == 'W'))
	echo form_dropdown("cmbFairType",$fair,'', 'class="input_box" id="cmbFairType" onclick="javascript:check_for_workexpo3(this.value,3)"'  );
	else {
		echo $fair_name[0]['fairName']; ?>
        
	    <input type="hidden" id="cmbFairType"	 name="cmbFairType" value="<? echo $fair_type;?>" /> 
        <? } 
	
	
	?></td>
    <td width="39%"  class="table_row_first">&nbsp;
    
    <div id="work3" style="display:<?php echo (@$fair_type==4)?'block':'none';?>;">
    
    <input type="radio" name="radioLabel" value="spot" id="radioLabel_spot" checked="checked" onClick="selectCat2(this.value)" >
        On the Spot</label>
    <input type="radio" name="radioLabel" value="exhib" id="radioLabel_exhib" onClick="selectCat2(this.value)" >
        Exhibition</label>
    
    </div>   
    </td>
    <td width="12%" class="">&nbsp;</td>
    
  </tr>
  <tr>
    <td width="8%" class="">&nbsp;</td>
    <td align="left" width="22%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Category : </td>
    <td align="left" width="19%" class="table_row_first"><?php echo form_dropdown("cmbCateType",$fest,'', 'class="input_box" id="cmbCateType"'  );?></td>
    <td width="39%"  class="table_row_first">&nbsp;</td>
    <td width="12%" class="">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="22%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" width="19%" class="table_row_first">      <label>
       <?php echo form_submit('Report', 'Report', 'onClick="javascript: return validateallfair(this.form)"');?>
        </label>
    </form>    </td>
    <td width="39%"  class="table_row_first">&nbsp;</td>
    <td width="12%" class="">&nbsp;</td>
  </tr>
  
  <tr>
    <td align="center" colspan="4">&nbsp;</td>
  </tr>
</table>


<?php
//itemwise_report_interface
//echo blue_box_bottom();
echo form_close();
?>
</div>