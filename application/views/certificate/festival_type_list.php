
<div align="center" class="heading_gray">
<h3>Certificate Item Details</h3>
</div>
<br />
<div class="container">
<?php echo form_open('certificate/certificate/list_item_wise', array('id' => 'formIRL'));

$fair_type	=	$this->session->userdata('FAIR_TYPE');
$fair_name	= $this->General_Model->get_data('science_master', '*', array('fairId'=>$fair_type));
?>
<input type="hidden" name="hidUservalue" id="hidUservalue"  value="SHOW" />
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="4" align="left"> Certiicate - Item wise :</th>
  </tr>
  <tr>
    <td width="9%" class="">&nbsp;</td>
    <td align="left" width="24%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fair : </td>
    <td align="left" width="31%" class="table_row_first"><?php 
	if(($this->session->userdata('USER_GROUP') == 'A') or ($this->session->userdata('USER_GROUP') == 'W')){
		 echo form_dropdown("cmbFairType",$fair,'', 'class="input_box" id="cmbFairType" onclick="javascript:check_for_workexpo(this.value)" onchange="javascript:check_for_workexpo(this.value)"');
	}
		else{
			echo $fair_name[0]['fairName'];	
			
			if($this->session->userdata('FAIR_TYPE') == 4){
			}	
		?>
			<input type="hidden" id="cmbFairType"	 name="cmbFairType" value="<? echo $fair_type;?>" /> 
		<? } ?>
	
	</td>
    <td width="36%" class="table_row_first"><div id="work" <?php if($this->session->userdata('FAIR_TYPE') != 4){?>style="visibility:hidden;"<?php }?>> 
    
    <input type="radio" name="radioLabel" value="spot" id="radioLabel_spot" checked="checked" onClick="selectCat(this.value)" >
        On the Spot</label>
    <!--<input type="radio" name="radioLabel" value="exhib" id="radioLabel_exhib" onClick="selectCat(this.value)" >
        Exhibition--></label>
    
    </div></td>
  </tr>
  <tr>
    <td width="9%" class="">&nbsp;</td>
    <td align="left" width="24%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Category : </td>
    <td align="left" width="31%" class="table_row_first"><?php echo form_dropdown("cmbCateType",$pfest,'', 'class="input_box" id="cmbCateType"'  );?></td>
    <td width="36%" class="table_row_first">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="24%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" width="31%" class="table_row_first">      <label>
       <?php echo form_submit('Report', 'Report', 'onClick="javascript: return validateallfair(this.form)"'); ?>
        </label>
    </form>    </td>
    <td width="36%" class="table_row_first">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" colspan="4">&nbsp;</td>
  </tr>
</table>


<?php
//itemwise_report_interface
echo form_close();
?>
</div>

<!--<script type="text/javascript">
function selectCat(val){
		if(val == 'spot')
		{ 
			 document.getElementById('cmbCateType').disabled=false; 
		}
		if(val == 'exhib'){  
			document.getElementById('cmbCateType').disabled=true; 
		}
}
</script>-->