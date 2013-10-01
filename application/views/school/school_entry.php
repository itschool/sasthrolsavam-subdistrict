<?php if($this->session->userdata('USER_TYPE')!=''){ ?>
<script type="text/javascript" src="<?php echo base_url();?>/js/common.js">
</script>
 <style type="text/css">#cssMenu{display:none}</style>


  <link type="text/css" href="<?php echo base_url();?>/css-menu.files/style.css" rel="stylesheet"/>
<style type="text/css">
<!--
.style5 {color: #666666}
.style6 {
	font-size: 24px;
	font-style: italic;
	font-weight: bold;
	color: #333333;
	font-family: "Times New Roman", Times, serif;
}
-->
</style>

<?
 if ($this->session->userdata('USER_TYPE') == 5 or $this->session->userdata('USER_TYPE') == 4 or $this->session->userdata('USER_TYPE') == 2 or  $this->session->userdata('USER_GROUP') == 'W') { ?>
 <!--<div align="left"> 
 <A HREF="javascript:history.go(-1)"><img height="40" width="40" src="<?php echo base_url(false).'images/back_button.png';?>" title="Back"/></a>
 </div>-->
<? } 

if(@$fairId == '1') { @$name = 'Science Fair'; }
else if(@$fairId == '2') { @$name = 'Mathematics Fair'; }
else if(@$fairId == '3') { @$name = 'Social Science Fair'; }
else if(@$fairId == '4') { @$name = 'Work Experience Fair'; }
?> 	




<table width="99%" border="1" align="center" cellpadding="0" cellspacing="0" style="border:solid 1px; color:#CFCFCF">
<tr>
<td align="center">
  <span class="style6"><?php  echo @$name ?></span>  </td>
  </tr>
  </table>
  <br />


<?php
 echo form_open('school/registration/get_school_details', array('id' => 'formSchool','name' => 'formSchool'));
// var_dump($school_details);
 ?>
<div class="container"  >

    <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" class="heading_tab" style="border:solid 1px; color:#999999">
   
     <tr bgcolor="#FFFFFF" style="border-bottom:1px solid #AEAEAE;">
       <td width="28%" height="31"  class="table_row_first">School Code :</span></td>
       <td  class="table_row_first"><?php echo  form_input("txtSchoolCode", @$school_details[0]['school_code'], 'class="inputbox" id="txtSchoolCode" onkeypress="javascript:return numbersonly(this, event, false);" readonly="true"'); ?>
          <input type="hidden" name="hidschool" id="hidschool" value="<? echo @$school_details[0]['school_code'] ; ?>" />  
          <input name="base_url" type="hidden" id="base_url" value="<?php echo base_url();?>" />       </td>
       
       <td >SchoolName : </span></td>
       <td width="27%"  colspan="3"><?php echo @$school_details[0]['school_name']?></span></td>
     </tr>
     <tr  bgcolor="#E6F7F5" style="border-bottom:1px solid #AEAEAE;">
       <td  width="28%"  class="table_row_first">School Phone(with STD code) : </span></td>
       <td   class="table_row_first"><?php echo (@$flag == '1') ? @$school_details[0]['school_phone'] : form_input("txtSchoolPhone", @$school_details[0]['school_phone'], 'class="inputbox" id="txtSchoolPhone" maxlength="11" onkeypress="javascript:return numbersonly(this, event, false);"');?> </td>
       <td  class="table_row_first">E-mail :</td>
       <td  class="table_row_first"><?php echo (@$flag == '1') ? @$school_details[0]['school_email'] : form_input("txtSchoolEmail",@$school_details[0]['school_email'], 'class="inputbox" id="txtSchoolEmail" maxlength="100" ');?></td>
     </tr>
    
     <tr  bgcolor="#E6F7F5" style="border-bottom:1px solid #AEAEAE;">
       <td height="25"><span>Standard : </span></td>
       <td width="27%">
       <table><tr>
       <td>From : </td><td><?php echo (@$flag == '1') ? @$school_details[0]['class_start'] : form_dropdown("txtStandardFrom", array(0=>'', 1 => 1, 5 => 5, 8 => 8, 11 => 11), @$school_details[0]['class_start'],'class="inputbox1" id="txtStandardFrom"  onChange="javascript:fncShowHideStd()"');?></td>
       <td>&nbsp;&nbsp;To : </td><td><?php echo (@$flag == '1') ? @$school_details[0]['class_end'] : form_dropdown("txtStandardTo", array( 0=>'', 4 => 4, 5 => 5, 7 => 7, 10 => 10, 12 => 12), @$school_details[0]['class_end'],'id="txtStandardTo" class="inputbox1"  onChange="javascript:fncShowHideStd()"');?></td>
       </tr></table>
       </td>
       
       <td  class="table_row_first">School Type :</td>
       <td  class="table_row_first"><?php 
		if(@$school_details[0]['school_type'] == 'G') 
			$type	=	'Government';
		else if(@$school_details[0]['school_type'] == 'A') 
			 $type	= 	'Aided';
		else if(@$school_details[0]['school_type'] == 'U') 
			$type	= 	'Unaided' ;
		else
			$type	= '';
		?>
          <input name="type1" type="hidden" value="<?php echo @$school_details[0]['school_type'];?>" />
           <?php echo (@$flag == '1') ? $type : form_input("type", $type, 'class="inputbox" id="type" maxlength="11" onkeypress="javascript:return numbersonly(this, event, false);" readonly="true"');?></td>
     </tr>
     
     <tr  bgcolor="#E6F7F5" style="border-bottom:1px solid #AEAEAE;">
       <td height="35">Principal :</span></td>
       <td><?php echo (@$flag == '1') ? @$school_details[0]['principal_name'] : form_input("txtPrincipal", @$school_details[0]['principal_name'], 'class="inputbox" id="txtPrincipal" maxlength="11" onkeypress="javascript:return toUppercase(event,this)"');?> </td>
       <td width="18%">Phone : </td>
       <td colspan="3"><?php echo (@$flag == '1') ? @$school_details[0]['principal_phone'] :  form_input("txtPrincipalPhone", @$school_details[0]['principal_phone'], 'class="inputbox" id="txtPrincipalPhone"  maxlength="11" onkeypress="javascript:return numbersonly(this, event, false);"');?></td>
     </tr>
     <tr   bgcolor="#FFFFFF" style="border-bottom:1px solid #AEAEAE;">
       <td height="36">Headmaster : </td>
       <td><?php echo (@$flag == '1') ? @$school_details[0]['hm_name'] : form_input("txtHeadmaster", @$school_details[0]['hm_name'], 'class="inputbox" id="txtHeadmaster" maxlength="11" onkeypress="javascript:return toUppercase(event,this)"');?> </td>
       <td>Phone : </td>
       <td colspan="3"><?php echo (@$flag == '1') ? @$school_details[0]['hm_phone'] : form_input("txtHeadmasterPhone", @$school_details[0]['hm_phone'], 'class="inputbox" id="txtHeadmasterPhone"  maxlength="11" onkeypress="javascript:return numbersonly(this, event, false);"');?></td>
     </tr>
     <tr  bgcolor="#E6F7F5" style="border-bottom:1px solid #AEAEAE;">
       <td>Total number of students :</span></td>
   <td colspan="5">
     <?php 
				$lp		=	( @$school_details[0]['strength_lp'] != '') ? 'block' : 'none';
				$up		=	(@$school_details[0]['strength_up'] != '') ? 'block' : 'none';
				$hs		=	(@$school_details[0]['strength_hs'] != '') ? 'block' : 'none';
				$hss		=	(@$school_details[0]['strength_hss']!= '' || @$school_details[0]['strength_vhss']!= '') ? 'block' : 'none';
				$vhss	=	(@$school_details[0]['strength_vhss']!= '' || @$school_details[0]['strength_hss']!= '') ? 'block' : 'none';	
			?>
          
     <div class="style5" id="lp" style="float:left; display:<?php echo $lp?>;">LP&nbsp;:&nbsp; <?php echo (@$flag == '1') ? @$school_details[0]['strength_lp'] : form_input("txtTotalLP", @$school_details[0]['strength_lp'], 'class="inputbox1" id="txtTotalLP" maxlength="11" onkeypress="javascript:return numbersonly(this, event, false);" onblur="javascript:fncalk();" onkeyup="javascript:fncalk();"');?> </div>
     
         <div class="style5" id="up" style="float:left; display:<?php echo $up?>;">&nbsp;UP&nbsp;:&nbsp; <?php echo (@$flag == '1') ? @$school_details[0]['strength_up'] : form_input("txtTotalUP", @$school_details[0]['strength_up'], 'class="inputbox1" id="txtTotalUP" maxlength="11" onkeypress="javascript:return numbersonly(this, event, false);" onblur="javascript:fncalk();" onkeyup="javascript:fncalk();"');?> </div>
         
         <div class="style5" id="hs" style="float:left; display:<?php echo $hs?>;">&nbsp;HS&nbsp;:&nbsp; <?php echo (@$flag == '1') ? @$school_details[0]['strength_hs'] : form_input("txtTotalHS", @$school_details[0]['strength_hs'], 'class="inputbox1" id="txtTotalHS" maxlength="11" onkeypress="javascript:return numbersonly(this, event, false);" onblur="javascript:fncalk();" onkeyup="javascript:fncalk();"');?> </div>
         
         <div class="style5" id="hss" style="float:left; display:<?php echo $hss?>;">&nbsp;HSS :&nbsp;<?php echo (@$flag == '1') ? @$school_details[0]['strength_hss'] : form_input("txtTotalHSS", @$school_details[0]['strength_hss'], 'class="inputbox1" id="txtTotalHSS" maxlength="11" onkeypress="javascript:return numbersonly(this, event, false);" onblur="javascript:fncalk();" onkeyup="javascript:fncalk();"');?> </div>
         
        <div class="style5" id="vhss" style="float:left; display:<?php echo $vhss?>;">&nbsp;&nbsp;VHSS&nbsp;:&nbsp; <?php echo (@$flag == '1') ? @$school_details[0]['strength_vhss'] : form_input("txtTotalVHSS", @$school_details[0]['strength_vhss'], 'class="inputbox1" id="txtTotalVHSS" maxlength="11" onkeypress="javascript:return numbersonly(this, event, false);" onblur="javascript:fncalk();" onkeyup="javascript:fncalk();"');?> </div>
       <div class="style5" style="float:left;">&nbsp;Total&nbsp;:
         <?php if(@$flag == '1') {echo @$school_details[0]['total_strength']; } else {?>
         <input name="total" type="text" id="total" class="inputbox1" readonly="readonly" value="<?php echo @$school_details[0]['total_strength'];?>" /><?php } ?> </div>
       </td>
     </tr>
     <tr>
       <td colspan="6"><!--<input type="submit" value="Save" class="btnalt" align="right" onclick="return validate();" />-->
           <?php 
		     if(@$school_details[0]['is_finalize']=="N")  { echo (@$flag == '1') ? form_button('Edit', 'Edit', 'class="btnalt" onClick="javascript:fncEditSchoolDeatils()"').'&nbsp;&nbsp;&nbsp;&nbsp;'.form_button('Confirm', 'Confirm', 'class="btnalt" onClick="javascript:fncConfirmSchoolDeatils()"') : form_submit('Save', 'Save', 'class="btnalt" onClick="javascript:return validate()"'); }?></td>
     </tr>
  </table>
   
   </div>
   

<? 	
//echo '<br><br><br>----------Flag--'.@$flag;
//if(@$flag == '1'){ 
if(@$school_details[0]['is_finalize']=="Y"){
	if(@$fairId == '1') {  ?>  			  
      <div class="container">
     <table width="100%">
      	<tr  bgcolor="#E6F7F5" style="border-bottom:1px solid #AEAEAE;">
      	 <td width="9%" height="5">Science Fair:</td>
        <input name="type2" type="hidden" id="school_code" value="<?php echo @$school_details[0]['school_code'];?>" />
        <input name="type3" type="hidden" id="fairId" value="<?php echo @$fairId;?>" />
       	<td width="91%" height="55" colspan="6" align="left"><?php echo (@$flag == '1') ? form_dropdown("txtFairClass", array(0=>'Select Class',1=>'LP', 2 =>'UP', 3 => 'HS', 4 => 'HSS/VHSE',), @$fairClassType,'class="inputbox" id="txtFairClass" width="25"  onChange="javascript:fncShowPathReg()"') :'' ;?></td>
      </tr>
     </table>
     </div>
     <?php } 
	 
	 
	  if(@$fairId == '2') { // $school_code=@$school_details[0]['school_code']; ?>   
      <div class="container"  >
     <table width="100%">
      	<tr  bgcolor="#E6F7F5" style="border-bottom:1px solid #AEAEAE;">
      	 <td width="9%" height="5">Mathematics Fair:</td>
        <input name="type2" type="hidden" id="school_code" value="<?php echo @$school_details[0]['school_code'];?>" />
        <input name="type3" type="hidden" id="fairId" value="<?php echo @$fairId;?>" />
       <td width="91%" height="55" colspan="6" align="left"><?php echo (@$flag == '1') ? form_dropdown("txtFairClass", array(0=>'Select Class',1=>'LP', 2 =>'UP', 3 => 'HS', 4 => 'HSS/VHSE',), @$fairClassType,'class="inputbox" id="txtFairClass" width="25"  onChange="javascript:fncShowPathReg()"') :'' ;?></td>
       
     </tr>
      
      </table>
      </div>
      
    <?php } 
    
     
	if(@$fairId == '3') { // $school_code=@$school_details[0]['school_code']; ?>   
      <div class="container"  >
      <table>
      <tr  bgcolor="#E6F7F5" style="border-bottom:1px solid #AEAEAE;">
       <td height="25">Social Science Fair:</td>
        <input name="type2" type="hidden" id="school_code" value="<?php echo @$school_details[0]['school_code'];?>" />
        <input name="type3" type="hidden" id="fairId" value="<?php echo @$fairId;?>" />
       <td height="55"><?php echo (@$flag == '1') ? form_dropdown("txtFairClass", array(0=>'Select Class',1=>'LP', 2 =>'UP', 3 => 'HS', 4 => 'HSS/VHSE',), @$fairClassType,'class="inputbox" id="txtFairClass" width="25"  onChange="javascript:fncShowPathReg()"') :'' ;?></td>
       
     </tr>
      
      </table>
      </div>
      
    <?php } 
        
     if(@$fairId == '4') { // $school_code=@$school_details[0]['school_code']; ?>   
      <div class="container"  >
      <table  width="100%">
   <tr  bgcolor="#E6F7F5" style="border-bottom:1px solid #AEAEAE;">
      	 <td width="9%" height="5">Work&nbsp;Experience&nbsp;Fair:</td>
     <input name="type2" type="hidden" id="school_code" value="<?php echo @$school_details[0]['school_code'];?>" />
         <input name="type3" type="hidden" id="fairId" value="<?php echo @$fairId;?>" />
       <td width="91%" height="55" colspan="6" align="left"><?php echo (@$flag == '1') ? form_dropdown("txtworkexpo", array(0=>'Select',1=>'ON THE SPOT', 2 =>'EXHIBITION'), @$workexpo,'class="inputbox" id="txtworkexpo" width="25"  onChange="javascript:fncShowWorkexpPathReg()"') : form_dropdown("txtworkexpo", array(0=>'Select',1=>'ON THE SPOT', 2 =>'EXHIBITION'), @$workexpo,'class="inputbox" id="txtworkexpo" width="25"  onChange="javascript:fncShowWorkexpPathReg()"') ;?>&nbsp;&nbsp;
      <?php echo (@$flag == '1') ? form_dropdown("txtFairClass", array(0=>'Select Class',1 =>'LP',2 =>'UP',3 => 'HS', 4 => 'HSS/VHSE',), @$fairClassType,'class="inputbox" id="txtFairClass" style="display:none;" width="25"  onChange="javascript:fncShowPathReg()"') :form_dropdown("txtFairClass", array(0=>'Select Class',2 =>'UP',3 => 'HS', 4 => 'HSS/VHSE',), @$fairClassType,'class="inputbox" id="txtFairClass" width="25"  onChange="javascript:fncShowPathReg()"')  ;?></td>
       
     <!--  <td height="55"><?php //echo (@$flag == '1') ? form_dropdown("txtFairClass", array(0=>'Select Class',1=>'LP', 2 =>'UP', 3 => 'HS', 4 => 'HSS/VHSE',), @$fairClassType,'class="inputbox" id="txtFairClass" width="25"  onChange="javascript:fncShowPathReg()"') :'' ;?></td>-->
       
     </tr>
      
      </table>
</div>
      
    <?php } 
	
	
    if(@$fairId == '5') { // $school_code=@$school_details[0]['school_code']; ?>   
      <div class="container"  >
      <table>
      <tr  bgcolor="#E6F7F5" style="border-bottom:1px solid #AEAEAE;">
       <td height="25">IT Fair:</td>
        <input name="type2" type="hidden" id="school_code" value="<?php echo @$school_details[0]['school_code'];?>" />
        <input name="type3" type="hidden" id="fairId" value="<?php echo @$fairId;?>" />
       <td height="55"><?php echo (@$flag == '1') ? form_dropdown("txtFairClass", array(0=>'Select Class',2 =>'UP',3 => 'HS', 4 => 'HSS/VHSE',), @$fairClassType,'class="inputbox" id="txtFairClass" width="25"  onChange="javascript:fncShowPathReg()"') :'' ;?></td>
       
     </tr>
      
      </table>
      </div>
      
    <?php } ?>
  </ul>
   

<?  $sch_code	=	@$school_details[0]['school_code']; ?>
	

</div>
   
   
   <? }     ?>
   
   
   

</div>
<?php 
echo form_close();
}
?>