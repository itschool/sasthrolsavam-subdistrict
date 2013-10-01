<style type="text/css">
<!--
.style1 {
	font-size: 24px;
	font-style: italic;
	font-family: "Times New Roman", Times, serif;
}
.style5 {
	font-size: 14px;
	font-weight: bold;
	font-family: "Times New Roman", Times, serif;
}
-->
</style>

<table width="99%" border="1" align="center" cellpadding="0" cellspacing="0" style="border:solid 1px; color:#CFCFCF">
    <tr>
    <td align="center"><span class="style1">Venue Item Details</span></td>
    </tr>
    </table><br />

<div class="container">   
<?php echo form_open('ground/item_participant/participant_nodetails', array('id' => 'formIWP')); 
$fair_type	=	$this->session->userdata('FAIR_TYPE');
$fair_name	= $this->General_Model->get_data('science_master', '*', array('fairId'=>$fair_type));?>
<input type="hidden" name="hidUservalue" id="hidUservalue"  value="SHOW" />
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="4" align="left"> Item wise Student Abstract Details:</th>
  </tr>
  <tr bgcolor="#F5F5F5" style="border-bottom:1px solid #CFCFCF;height:20px;" >
    <td width="10%" class="">&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fair Type : </td>
    <td align="left" width="55%" class="table_row_first"><?php 
	
	if(($this->session->userdata('USER_GROUP') == 'A') or ($this->session->userdata('USER_GROUP') == 'W'))
	
	
	echo form_dropdown("cmbFairType",@$fair,@$fair_id, 'class="input_box" id="cmbFairType" onchange="javascript:display_wrkexp(this.value)"    '  );
	else {
		echo $fair_name[0]['fairName']; ?>
        
	    <input type="hidden" id="cmbFairType"	 name="cmbFairType" value="<? echo $fair_type;?>" /> 
        <? } 
	//onChange="javascript:fetch_item_details()"
	?></td>
    <td width="18%">&nbsp;</td>
  </tr>
       <tr bgcolor="#F5F5F5" style="border-bottom:1px solid #CFCFCF;height:20px;">
		<td width="100%" height="33%" align="left" class="table_row_first" colspan="4">
        <div id="divWrkexp" style="display:<?php echo ((@$_POST['cmbWrkexpType']>0 && @$fair_id==4) || @$fair_type==4)?'block':'none';?>;">
        <table width="100%" border="0">
        <tr>
        <td width="10%">&nbsp;</td>
        <td width="27%" class="">&nbsp;</td>
        <td width="55%" align="right"><?php 
		$arywrkexp = array(1=>'On the spot',2=>'Exhibition');
		//$arywrkexp = array(1=>'On the spot');
		echo form_dropdown("cmbWrkexpType",$arywrkexp,@$_POST['cmbWrkexpType'], 'class="input_box" id="cmbWrkexpType" onchange="javascript:fetch_items(this.value)"  ');?></td>
        <td width="18%">&nbsp;</td>
        </table>
        </div>
        </td>
	</tr>
    <tr bgcolor="#F5F5F5" style="border-bottom:1px solid #CFCFCF;height:20px;" >
    <td width="10%" class="">&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Category : </td>
    <td align="left" width="55%" class="table_row_first"><?php //$combotype = (@$_POST['cmbWrkexpType']==2 && @$fair_id==4)?'disabled':'';?>
	<?php echo form_dropdown("cmbFestType",@$fest,@$fest_id, 'class="input_box" id="cmbFestType" '.@$combotype .' '  );?></td>
    <td width="18%">&nbsp;</td>
  </tr>
   <!--<tr bgcolor="#F5F5F5" style="border-bottom:1px solid #CFCFCF;height:20px;" >
    <td width="10%" class="">&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Item : </td>
    <td align="left" width="55%" class="table_row_first"><div id="divItems" ><?php echo form_dropdown("cmbItemType",@$item_details,@$item_id, 'class="input_box" id="cmbItemType" '  ); ?></div></td>
    <td width="18%">&nbsp;</td>
  </tr>-->
  <tr >
    <td >&nbsp;</td>
    <td align="left" width="27%" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" width="55%" ><label><?php echo form_submit('GET', 'GET', '');?></label></td>
    <td width="18%" >&nbsp;</td>
  </tr>
</table>
</div>

<?php
//itemwise_report_interface
echo form_close();
?>