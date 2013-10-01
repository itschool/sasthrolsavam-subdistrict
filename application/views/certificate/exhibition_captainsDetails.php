
<div align="center" class="heading_gray">
<h3>Certificate Participant</h3>
</div>
<br />
<div class="container">
<?php echo form_open('certificate/certificate/get_exhibition_certificate_pdf', array('id' => 'formIRL'));
?>
<input type="hidden" name="hidUservalue" id="hidUservalue"  value="SHOW" />
<input type="hidden" name="hidschoolcode" id="hidschoolcode"  value="<?php echo $schoolcode;?>" />
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="4" align="left"> Certificate - Participant Wise:</th>
  </tr>
  <?php if (is_array(@$captain_detail) and count(@$captain_detail) > 0 ){ ?>
  <tr>
    <td width="10%" class="">&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo 'Group Captain'; ?> : </td>
    <td align="left" width="55%" class="table_row_first"><?php echo form_dropdown("captain_id", 
		@$captain_detail,'', 'class="input_box" id="captain_id" '.$javascript_code);?></td>
    <td width="18%">&nbsp;</td>
  </tr>

  <tr id="all_participant_tr_id" >
    <td width="10%" class="">&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Participants : </td>
    <td align="left" width="55%" class="table_row_first" ><div id="all_participant_id"><select  class="input_box"  name="participant_id" id="participant_id" ><option vlaue="0">All Participant</option></select></div></td>
    <td width="18%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" width="55%" class="table_row_first"><label><?php echo form_submit('GET', 'GET', '');?></label>
    </form></td>
    <td width="18%">&nbsp;</td>
  </tr>
  <?php }?>
  <tr>
    <td align="center" colspan="4">&nbsp;</td>
  </tr>
</table>


<?php
//itemwise_report_interface
echo form_close();
?>
</div>