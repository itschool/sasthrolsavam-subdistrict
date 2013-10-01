<?php 
//if (@$selected_school[0]['school_name'] or $this->Session_Model->check_user_permission(26)) {
?>
<table width="99%" border="1" align="center" cellpadding="0" cellspacing="0" style="border:solid 1px; color:#CFCFCF">
    <tr>
    <td align="center"><span class="style1">School Master </span></td>
    </tr>
    </table><br />

<?php
echo form_open('school/school_master/add_school_details', array('id' => 'formUser'));

?>
<div class="container">
 <div class="contentbox" align="center">
 <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
 <tr class="table_row_first">
    <th height="28" colspan="4" align="left" bgcolor="#C0E0ED"><b>Edit School</b></th>
  </tr>
 </table>

<table width="85%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#E6F0DD">
 <!-- class="table_row_first"-->
  
  <tr class="table_row_first">
    <td colspan="4">&nbsp;</td>
  </tr>
  <?php
 // if ($this->Session_Model->check_user_permission(26)) { 
  ?>
  <tr style="border-bottom:1px solid #AEAEAE;">
    <td width="10%" class="">&nbsp;</td>
    <td align="left" width="27%" valign="top" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;School Code : </td>
    <td align="left" width="55%" class="table_row_first">
		<?php echo form_input("txtSchoolCode",@$selected_school[0]['school_code'], 'class="inputbox" id="txtSchoolCode" disabled="disabled"' );?>
   		<br /><br>
   </td>
    <td width="18%">&nbsp;</td>
  </tr>
  <?php 
 // }
  ?>
  <tr style="border-bottom:1px solid #AEAEAE;">
    <td width="10%" height="20" class="">&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;School Name : </td>
    <td align="left" width="55%" class="table_row_first"><?php echo form_input("txtSchoolName",@$selected_school[0]['school_name'], 'class="inputbox" id="txtSchoolName" size="60"' );?></td>
    <td width="18%">&nbsp;</td>
  </tr>
  <tr style="border-bottom:1px solid #AEAEAE;">
    <td>&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;School Type : </td>
    <td align="left" width="55%" class="table_row_first">
	<?php 
	$value_array	=	array(0=>'--Select One--', 'G' => 'Government', 'A' => 'Aided', 'U' => 'Unaided');
	echo form_dropdown("cmbSchoolType", $value_array, @$selected_school[0]['school_type'], 'id="cmbSchoolType" class="inputbox"');
	?>
    </td>
    <td width="18%">&nbsp;</td>
  </tr>
  <?php 
  //if($this->session->userdata('USER_GROUP') == 'W') {?>
<!--  <tr style="border-bottom:1px solid #AEAEAE;">
  	<td colspan="4" style="padding:0px; margin:0px;">
  		<div style="display:block" id="divDistrict">
        	<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab">
               <tr>
                <td width="10%" class="">&nbsp;</td>
                <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;District : </td>
                <td align="left" width="55%" class="table_row_first">
				<?php 
				//echo form_dropdown("cmbDistrict", $districts, @$selected_school[0]['rev_district_code'], 'id="cmbDistrict" class="inputbox"  onChange="javascript:loadEduDistrict()"');
				?>
				</td>
                <td width="18%">&nbsp;</td>
              </tr>
            </table>
      </div>  
    </td>
  </tr>-->
  <?php 
  //}
  // if ($this->Session_Model->check_user_permission(26)) {
  ?>
  <!--<tr style="border-bottom:1px solid #AEAEAE;">
  	<td colspan="4" style="padding:0px; margin:0px;">
  		<div style="display:<?php //echo ((isset($selected_school[0]['edu_district_code']) && @$selected_school[0]['edu_district_code'] != '0') || isset($edu_districts))? 'block' : 'none';?>" id="divEduDistrict">
        	<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab">
               <tr>
                <td width="10%" class="">&nbsp;</td>
                <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Education District : </td>
                <td align="left" width="55%" class="table_row_first">
				<div id="divEdudistrictCombo">
				<?php 
				//if(@$edu_districts){
				//echo form_dropdown("cmbEduDistrict", @$edu_districts, @$selected_school[0]['edu_district_code'], 'id="cmbEduDistrict" class="inputbox"  onChange="javascript:loadSubDistrict()"'); } 
				
				
				?>
                </div>
				</td>
                <td width="18%">&nbsp;</td>
              </tr>
            </table>
      </div>  
    </td>
  </tr>-->
 <!-- <tr  style="border-bottom:1px solid #AEAEAE;">
  	<td colspan="4" style="padding:0px; margin:0px;">
  		<div style="display:<?php //echo (isset($selected_school[0]['sub_district_code']) && @$selected_school[0]['sub_district_code'] != '0')? 'block' : 'none';?>" id="divSubdistrict">
        	<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab">
               <tr>
                <td width="10%" class="">&nbsp;</td>
                <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sub-district : </td>
                <td align="left" width="55%" class="table_row_first">
                <div id="divSubdistrictCombo">
				<?php 
				//if(@$subdistricts){
				//echo form_dropdown("cmbSubDistrict", @$subdistricts, @$selected_school[0]['sub_district_code'], 'id="cmbSubDistrict" class="inputbox"  onChange="javascript:loadSchool()"'); }
				?>
                </div>
                </td>
                <td width="18%">&nbsp;</td>
              </tr>
            </table>
      </div>  
    </td>
  </tr>-->
  <?php //}?>
  <tr>
    <td align="center" colspan="4">
	<?php echo (@$selected_school[0]['school_code'] != '') ? form_button('Update School', 'Update School', 'onClick="javascript: return fncUpdateSchool(\''.@$selected_school[0]['school_code'].'\', \''.$this->session->userdata('USER_TYPE').'\')"').'&nbsp;'.form_button('Cancel', 'Cancel', 'onClick="javascript: return cancel()"'):form_submit('Add School', 'Add School', 'onClick="javascript: return fncAddSchool(\''.$this->session->userdata('USER_TYPE').'\')"');?> </td>
  </tr>
</table>
<input type="hidden" name="hidUserId" id="hidUserId" />
</div>
</div>
<?php

echo form_close();
//}
?>
