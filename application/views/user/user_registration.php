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
<?php echo form_open('user/user_registration/userinsert', array('id' => 'formUser','name' => 'formUser'));

?>

 
 <table width="99%" border="1" align="center" cellpadding="0" cellspacing="0" style="border:solid 1px; color:#CFCFCF">
    <tr>
    <td align="center"><span class="style1">User Registration</span></td>
    </tr>
    </table><br />
    <div class="container">
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
		<th align="left" colspan="4">Add User</th>
	  </tr>
  <tr >
    <td width="10%" class="">&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;User Name : </td>
    <td align="left" width="55%" class="table_row_first"><?php echo form_input("txtNewUserName",@$selected_user[0]['user_name'], 'class="input_box" id="txtNewUserName"' );?></td>
    <td width="18%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Password : </td>
    <td align="left" width="55%" class="table_row_first"><?php echo form_password("txtNewPassword",'', 'class="input_box" id="txtNewPassword"' );?></td>
    <td width="18%">&nbsp;</td>
  </tr>
   <tr>
    <td>&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fair Type : </td>
    <td align="left" width="55%" class="table_row_first"><?php echo form_dropdown("cmbFairType",$fair,@$selected_user[0]['fair_right'], 'class="input_box" id="cmbFairType" '  );?></td>
    <td width="18%">&nbsp;</td>
  </tr>
  <!--<tr>
    <td>&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;User Type : </td>
    <td align="left" width="55%" class="table_row_first"><?php echo (@$school_show == 'show') ? @$school_details[0]['class_end'] : form_dropdown("userType", array(0=>'...........', 1=>'Admin', 2 => 'User'), 'id="userType"','id="userType"');?></td>
    <td width="18%">&nbsp;</td>
  </tr>-->
  <?php 
  if(count(@$user_rights) > 0 ){?>
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="27%" class="table_row_first" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;User Rights : </td>
    <td align="left" width="55%" class="table_row_first">
		<?php
		$functionality_label	=	'';
        for($i=0; $i<count($user_rights); $i++){
			if($functionality_label != $user_rights[$i]['label_name']){
				$functionality_label = $user_rights[$i]['label_name'];
				?>
                	<div class="clear_both"></div>
					<div class="functionality_label"><b><?php echo $user_rights[$i]['label_name']?></b></div>
				<?php
			}
			if(count(@$selected_user_rights) > 0 && @$selected_user_rights[0] != 0){
				$checked	=	(in_array($user_rights[$i]['rf_id'], @$selected_user_rights)) ? 'TRUE' : '';
			} else {
				$checked	=	'';
			}
			$data = array(
						'name'        => 'chkRight_'.$user_rights[$i]['rf_id'],
						'id'          => 'chkRight_'.$user_rights[$i]['rf_id'],
						'value'       => $user_rights[$i]['rf_id'],
						'checked'     => $checked,
						'style'       => 'margin:5px',
						);
			?>
			<div class="clear_both"></div>
            <div class="functionalities">
			<?php		
			echo form_checkbox($data);
			echo form_label($user_rights[$i]['rf_functionality'], 'chkRight_'.$user_rights[$i]['rf_id']).'<br>';
			?>
			</div>
			<?php
		}
		?>
    </td>
    <td width="18%">&nbsp;</td>
  </tr>
  <?php  }?>
  <tr>
    <td align="center" colspan="4">
	<?php echo (@$selected_user[0]['user_id'] != '') ? form_button('Update User', 'Update User', 'onClick="javascript: return fnsUserUpdate(\''.@$selected_user[0]['user_id'].'\')"').'&nbsp;'.form_button('Cancel', 'Cancel', 'onClick="javascript: return cancel()"'):form_submit('Add User', 'Add User', 'onClick="javascript: return fnsUserAdd()"');?> </td>
  </tr>
</table></div>
<input type="hidden" name="hidUserId" id="hidUserId" />
<?php

echo form_close();
?>
