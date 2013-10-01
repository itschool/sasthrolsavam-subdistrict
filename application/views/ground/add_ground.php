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
    <td align="center"><span class="style1">Define Venue</span></td>
    </tr>
    </table><br />

<div class="container">   
<?php echo form_open('ground/ground_details/add_ground', array('id' => 'formGround')); ?>

<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr  bgcolor="#CFCFCF" >
    <th colspan="4" align="left"><?php echo (@$selected_ground[0]['ground_id'] != '') ? 'Edit Venue' : 'Add Venue';?></th>
  </tr>
  <tr bgcolor="#F5F5F5" style="border-bottom:1px solid #CFCFCF;height:20px;">
    <td width="10%" class="">&nbsp;</td>
    <td align="left" width="27%" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Venue Name : </td>
    <td align="left" width="55%" ><?php echo form_dropdown("txtGroundName",@$ground_array,@$selected_ground[0]['ground_name'], 'class="input_box" id="txtGroundName"' );?></td>
    <td width="18%">&nbsp;</td>
  </tr>
  <tr bgcolor="#F5F5F5" style="border-bottom:1px solid #CFCFCF;height:20px;">
    <td>&nbsp;</td>
    <td align="left" width="27%" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Description : </td>
    <td align="left" width="55%" ><?php echo form_input("txtGroundDescription",@$selected_ground[0]['ground_desc'], ' id="txtGroundDescription" class="input_box" ' );?></td>
    <td width="18%">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" colspan="4">
	<?php echo (@$selected_ground[0]['ground_id'] != '') ? form_button('Update', 'Update', 'onClick="javascript: return fnsUpdateGround(\''.@$selected_ground[0]['ground_id'].'\')"').'&nbsp;'.form_button('Cancel', 'Cancel', 'onClick="javascript: return cancel()"'):form_submit('Add Venue', 'Add Venue', '');
	//onClick="javascript: return fnsAddGround()"
	?> </td>
  </tr>
</table>
</div>
<input type="hidden" name="hidGdId" id="hidGdId" />
<?php echo form_close(); ?>
