<script type="text/javascript">
function check(){
		if(document.formDWP.txtFair.value==0){
			alert('Please Select Fair');
			return false;
		}
		else{
			return true;
		}
}
</script>

<br />
<?php echo form_open('report/prereportpdf/itemwisepart1', array('id' => 'formIWP','name' => 'formIWP', 'target'=>'_blank'));
$fair_type	=	$this->session->userdata('FAIR_TYPE');
$fair_name	= $this->General_Model->get_data('science_master', '*', array('fairId'=>$fair_type));

?>
<form name="form1" method="post" action="">
<div class="container">
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="4" align="left">Item wise Participants</th>
  </tr>
  <tr>
    <td width="9%">&nbsp;</td>
    <td align="left" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fair :</td>
    <td align="left" class="table_row_first">
    <?php 
	
	if(($this->session->userdata('USER_GROUP') == 'A') or ($this->session->userdata('USER_GROUP') == 'W'))
		echo form_dropdown("cmbFairType",@$fair1,@$fair_id, 'class="input_box" id="cmbFairType" onchange="javascript:check_for_workexpo(this.value)" onclick="javascript:check_for_workexpo(this.value)"' );
	else {
			echo $fair_name[0]['fairName']; ?>
        
	    	<input type="hidden" id="cmbFairType"	 name="cmbFairType" value="<? echo $fair_type;?>" /> 
        <? } ?>
       
    
    <div id="work" style="display:<?php echo (@$fair_type==4)?'block':'none';?>;">
    
    <input type="radio" name="radioLabel" value="spot" id="radioLabel_spot" checked="checked" onClick="selectCat(this.value)" >
        On the Spot
    <input type="radio" name="radioLabel" value="exhib" id="radioLabel_exhib" onClick="selectCat(this.value)" >
        Exhibition
    
    </div>
	
	   
  
  </tr>
  <tr>
    <td width="9%">&nbsp;</td>
    <td align="left" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Category :</td>
    <td align="left" class="table_row_first">
       <?php echo form_dropdown("cmbCateType",$fest,'', 'class="input_box" id="cmbCateType" onchange="javascript:fetch_item_from_participant(this.value)" onClick="javascript:fetch_item_from_participant(this.value)"'  );?>
         
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
   <tr>
    <td>&nbsp;</td>
    <td align="left" width="18%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Item Name : </td>
  
    <td align="left" width="32%" class="table_row_first"><div id="cmbitem"><?php echo form_dropdown("cbo_item",array('select'),'', 'class="input_box" id="cbo_item" '  );?></div></td>
  
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="24%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" width="59%" class="table_row_first">
      <label>
        <input type="submit" name="btnSubmit" id="btnSubmit" value="View report" onclick="return checkIR();">
        </label>       </td>
    <td width="8%">&nbsp;</td>
  </tr>
  
  <tr>
    <td align="center" colspan="4">&nbsp;</td>
  </tr>
</table>
</div>
<input type="hidden" name="hidUserId" id="hidUserId" />
 </form>
<?php
//itemwise_report_interface
echo form_close();
?>
