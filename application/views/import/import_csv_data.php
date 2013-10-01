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

<?php 
	//if ($import_completed == 'NO'){
	echo form_open_multipart('import/import_data', array('id' => 'formSasthramela'));
	
	?>
    
    <table width="99%" border="1" align="center" cellpadding="0" cellspacing="0" style="border:solid 1px; color:#CFCFCF">
    <tr>
    <td align="center"><span class="style1">Import CSV Data  </span></td>
    </tr>
    </table><br />

<div class="container">    
	<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
	  <tr>
		<th align="left" colspan="4">Import CSV Data</th>
	  </tr>
	  <tr bgcolor="#F5F5F5"  style="border-bottom:1px solid #CFCFCF;height:20px;">
		<td align="left" >&nbsp;&nbsp;&nbsp;Upload  CSV File</td>
	  <td align="left">
			<?php echo form_upload("SasthramelaCSV", 'class="input_box" id="SasthramelaCSV" ');?>
			<span class="guide_line"></span>
		</td>
		<td align="left" colspan="2" >&nbsp;</td>
	  </tr>
	  <tr bgcolor="#F5F5F5"  style="border-bottom:1px solid #CFCFCF;height:20px;">
		<td align="center" colspan="4">
			<?php echo form_submit('save_kalolsavam', 'Save', 'id="save_kalolsavam" onClick="javascript:fncSaveSasthramelaCSV();"');?>
		</td>
	  </tr>
	</table><br />

    </div>
	<?php
	
	echo form_close();
	//}
?><br />

<br />

<?
 $science = $this->General_Model->get_data('participant_item_details','*',array('fairId' => '1'));
 $science_cnt	=	count($science);
 $maths = $this->General_Model->get_data('participant_item_details','*',array('fairId' => '2'));
 $maths_cnt	=	count($maths);
 $social = $this->General_Model->get_data('participant_item_details','*',array('fairId' => '3'));
 $social_cnt	=	count($social);
 $work = $this->General_Model->get_data('participant_item_details','*',array('fairId' => '4'));
 $work_cnt	=	count($work);
 $IT = $this->General_Model->get_data('participant_item_details','*',array('fairId' => '5'));
 $IT_cnt	=	count($IT);

 
?>

<div class="container">    
	<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
	  <tr>
		<th align="left" colspan="4">Imported Details</th>
	  </tr>
	  <tr bgcolor="#F5F5F5"  style="border-bottom:1px solid #CFCFCF;height:20px;">
      	<td width="16%" align="left" ><span class="style5">SI No</span></td>	
		<td width="63%" align="left" ><span class="style5">Fair Name</span></td>		
		<td width="21%" align="left"><span class="style5">Status</span></td>
	  </tr>
	  <tr bgcolor="#F5F5F5"  style="border-bottom:1px solid #CFCFCF;height:20px;">
		<td align="left" >1</td>	
		<td align="left" >Science Fair</td>	    
        <? if($science_cnt > 0) { ?>
        	<td align="left">Imported</td>
        <? } else { ?>
        	<td align="left">-</td>
        <? } ?>  
		
	  </tr>
      <tr bgcolor="#F5F5F5"  style="border-bottom:1px solid #CFCFCF;height:20px;">
		<td align="left" >2</td>	
		<td align="left" >Mathematics Fair</td>	
       <? if($maths_cnt > 0) { ?>
        	<td align="left">Imported</td>
        <? } else { ?>
        	<td align="left">-</td>
        <? } ?>  
      </tr>
        <tr bgcolor="#F5F5F5"  style="border-bottom:1px solid #CFCFCF;height:20px;">
		<td align="left" >3</td>	
		<td align="left" >Social Science Fair</td>	
        <? if($social_cnt > 0) { ?>
        	<td align="left">Imported</td>
        <? } else { ?>
        	<td align="left">-</td>
        <? } ?>  
      </tr>
        <tr bgcolor="#F5F5F5"  style="border-bottom:1px solid #CFCFCF;height:20px;">
		<td align="left" >4</td>	
		<td align="left" >Work Experience Fair</td>	
        <? if($work_cnt > 0) { ?>
        	<td align="left">Imported</td>
        <? } else { ?>
        	<td align="left">-</td>
        <? } ?>  
      </tr>
        <tr bgcolor="#F5F5F5"  style="border-bottom:1px solid #CFCFCF;height:20px;">
		<td align="left" >5</td>	
		 <td align="left" >IT Fair</td>		
        <? if($IT_cnt > 0) { ?>
        	<td align="left">Imported</td>
        <? } else { ?>
        	<td align="left">-</td>
        <? } ?>  
      </tr>
	</table>
<br />

</div>