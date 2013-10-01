<div align="center" class="heading_gray">

</div>
<br />
<div class="container">
<?php echo form_open('report/afterresultreportpdf/item_wise_total_points', array('id' => 'formItemwise','name' => 'formItemwise','target'=>'_blank'));

  $fair_type	=	$this->session->userdata('FAIR_TYPE');
$fair_name	= $this->General_Model->get_data('science_master', '*', array('fairId'=>$fair_type));
	//for($j=0;$j<count($retdat); $j++){
	//$dat[$retdat[$j]['school_code']] = $retdat[$j]['school_name'];
	//}

		
		
?>
<input type="hidden" name="hiddtext" id="hiddtext" value="">
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="4" align="left"><strong></strong></th>
  </tr>
  
  <tr>
    <th colspan="4" align="left">&nbsp;Result - Item Wise </th>
  </tr>
  <tr>
   
    <td width="26%" align="left" class="table_row_first"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fair Name  :</td>
    <td width="44%" align="left" class="table_row_first"><?php 
	if(($this->session->userdata('USER_GROUP') == 'A') or ($this->session->userdata('USER_GROUP') == 'W'))
		echo form_dropdown("cmbFairType",@$fair,@$fair_id, 'class="input_box" id="cmbFairType"  onchange="javascript:check_for_workexpo3(this.value,2)" onclick="javascript:check_for_workexpo3(this.value,2)" ' );
	else {
			echo $fair_name[0]['fairName']; ?>
        
    	<input type="hidden" id="cmbFairType"	 name="cmbFairType" value="<? echo $fair_type;?>" /> 
        <? } 
	
	//echo form_dropdown("cmbFairType",$fair,'', 'class="input_box" id="cmbFairType"'  );
	?>
       <div id="work2" style="display:<?php echo (@$fair_type==4)?'block':'none';?>;">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="radio" name="radioLabel2" value="spot" id="radioLabel_spot2" checked="checked"  onClick="selectCat_itemwise(this.value)" >
        On the Spot
    <input type="radio" name="radioLabel2" value="exhib" id="radioLabel_exhib2" onClick="selectCat_itemwise(this.value)" >
        Exhibition
    
    </div>  
     </td>
    <td width="23%" class="table_row_first"></td>
  </tr>
  <tr>
 
    <td align="left" width="26%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Category : </td>
    <td align="left" width="44%" class="table_row_first"><?php echo form_dropdown("cmbCateType1",$fest,'', 'class="input_box" id="cmbCateType1" onchange="javascript:fetch_item_from_festival(this.value,form.id)" onclick="javascript:fetch_item_from_festival(this.value,form.id)"'  );?></td>
    <td width="23%" class="table_row_first">&nbsp;</td>
    <td width="7%">&nbsp;</td>
  </tr>
  <tr>
   
    <td align="left" width="26%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Item Name : </td>
  
    <td align="left" width="44%" class="table_row_first"><div id="cmbitem"><?php echo form_dropdown("cbo_item",array('select'),'', 'class="input_box" id="cbo_item" '  );?></div></td>
    <td width="23%" class="table_row_first">&nbsp;</td>
    <td width="7%">&nbsp;</td>
  </tr>
 <tr>
    <td align="center" colspan="3"><?php echo form_submit('Report', 'Report', 'onClick="javascript: return fncitemwisetotalpoint()"');?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
  </tr>
   
</table>
<?php

echo form_close();
?>
</div>