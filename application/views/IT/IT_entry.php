<?php if($this->session->userdata('USER_TYPE')!=''){ ?>
<script type="text/javascript" src="<?php echo base_url();?>/js/common.js">
</script>
<style type="text/css">
<!--
.style1 {
	color: #333333;
	font-weight: bold;
}
.style2 {
	color: #666666;
	font-weight: bold;
}
.style3 {color: #666666}
.style4 {color: #333333}
-->
</style>
 <?php 
			if(isset($error) && trim($error) !='' ){ ?>
			<!-- Green Status Bar Start -->
			<div class="status error" id="divError">
				<p class="closestatus"><a href="#" onClick="document.getElementById('divError').style.display='none'"  title="Close">x</a></p>
				<p><img src="<?php echo base_url();?>images/icons/icon_error.png" alt="Error" />
				<span><br /> <?php echo @$error; ?></span> 
				</p>
			</div>
			<!-- Green Status Bar End -->
			<?php } ?>
             <?php 
		if(isset($sucess) && trim($sucess)!=''){ ?>
         <!-- Red Status Bar Start -->
        <div class="status success" id="divSuccess">         
        	<p class="closestatus"><a href="#" onClick="document.getElementById('divSuccess').style.display='none'" title="Close">x</a></p>
        	<p><img src="<?php echo base_url();?>images/icons/icon_success.png" alt="Success" />
              <span><?php echo @$sucess; ?></span> 
            </p>
        </div>
        <!-- Red Status Bar End -->    			
		<?php } ?>
			
<table width="99%" border="1" align="center" cellpadding="0" cellspacing="0" style="border:solid 1px; color:#CFCFCF">
<tr>
<td align="center">
  <span class="style6"><?php echo $Heading; ?></span>  </td>
  </tr>
  </table>

<?php
 echo form_open('school/registration/save_details', array('id' => 'ITEntry','name' => 'ITEntry'));
 
 ?>
 <body onLoad="setfocus();" ></body>
<div class="container">
 
   <table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" style="border:solid 1px; color:#999999" class="heading_tab">
     <tr>
        <th  height="32" colspan="2" style="border-bottom:1px solid #AEAEAE;">&nbsp;
    
         <input name="base_url" type="hidden" id="base_url" value="<?php echo base_url();?>" />
         <input name="festid" type="hidden" id="festid" value="<?php echo $category;?>" />
         <input name="fairid" type="hidden" id="fairid" value="<?php echo "5";?>" />
         <input name="schoolcode" type="hidden" id="schoolcode" value="<?php echo @$school_details[0]['school_code'];?>" />
          <input name="heading" type="hidden" id="heading" value="<?php echo $Heading;?>" />
         <input name="item_count" type="hidden" value="<?php echo count(@$item_details);?>" />
         <input name="class_to" id="class_to" type="hidden" value="<?php echo @$school_details[0]['class_end'];?>" />
         
         <?php $schoolcode=@$school_details[0]['school_code'];
		       $fairid=5;
			  if(@$confirm=="Y")  {
			  @$parti_flag = 1;
			  }
		 ?>
         <span class="style4">SchoolCode&nbsp;:</span>&nbsp;<span class="style3"><?php echo @$school_details[0]['school_code'];?></th>
       <th  height="32" colspan="4" style="border-bottom:1px solid #AEAEAE;">SchoolName&nbsp;:</span>&nbsp;<?php echo @$school_details[0]['school_name'];?></span></strong></th>
     </tr>
     
     
     <tr bgcolor="#FFFFFF" >
       <td><span class="style2">Number of Escorting Teacher  : 
	   </td>
       <td width="71%" colspan="5"><span style="float:left;">
	   <?php 
		//escorting_details
		$no_escorting_details = count($escorting_details);
		 $divname="'divEscTeachers'";
		$count_c =  "0";
		$count_c=@$escorting_details[0]['teachers_num'];
		//echo $count_c;
		@$school_details[0]['escorting_teachers'] = ($count_c>0)?$count_c:0;
		
		echo (@$parti_flag == '1') ? @$school_details[0]['escorting_teachers'] : form_input("escorting_teacher_num", @$school_details[0]['escorting_teachers'], 'class="inputbox1" id="escorting_teacher_num" maxlength="11" onkeypress="javascript:return numbersonly(this, event, false);" onblur="showEscortingTeachers(this.value,'.@$school_details[0]['escorting_teachers'].','.$divname.')"');?></span></td>
      
     </tr>
      <tr >
	  <td colspan="6">
      <?php 
	   if(@$no_escorting_details > 0)
        {
				$i_limit=$count_c+1;
				
				$escorting_teacher_details = explode('#@#',@$escorting_details[0]['escorting_teachers']); 
				
				for($itr=1;$itr<=$count_c;$itr++)
				{
					$aryname[$itr]= explode('#$#',@$escorting_teacher_details[$itr-1]); 
					
					
					?>
                   <table width="100%" align="center" border="0">
					 
					
					<tr>
						<td align="left"    width="2%"><?php echo $itr; ?></td>
						<td align="left"    width="20%"><?php echo (@$parti_flag == '1') ? @$aryname[$itr][0] : form_input("escorting_teacher_name[".$itr."]", @$aryname[$itr][0], 'class="inputbox" id="escorting_teacher_name['.$itr.']" onkeypress="javascript:return toUppercase(event,this)" '); ?> 
 
<!-- <input class="inputbox" type="text" id="escorting_teacher_name[<?php echo $itr; ?>]"   name="escorting_teacher_name[<?php echo $itr; ?>]"  value="<?php echo @$aryname[$itr][0]; ?>"  onkeypress="javascript:return toUppercase(event,this)" >-->
 
 </td>
 
                        <td align="left"    width="30%">
                        <?php 
					
						if(@$parti_flag == '1')
						{
							foreach($designations as $row=>$values)
							{
							if(@$aryname[$itr][1]==$values['designation_code'])echo $values['designation'];
							
							}
						}
						else
						{
						?>
						<select  size=1 name="<?php echo "designation[".$itr."]"; ?>" id="<?php echo "designation[".$itr."]"; ?>">
						<option value=0  >Designation</option>
						<?php
					
						foreach($designations as $row=>$values)
						{
						if(@$aryname[$itr][1]==$values['designation_code'])$select='selected';
						else $select=' ';
						echo "<option ".$select."  value='".$values['designation_code']."' >".$values['designation']."</option>";
						}
						?>
						
					    </select>
						<?php } ?>
						</td>
                      	<td align="left"    width="50%">
                        <?php echo (@$parti_flag == '1') ? @$aryname[$itr][2] : form_input("escorting_teacher_phone[".$itr."]", @@$aryname[$itr][2], 'class="inputbox" id="escorting_teacher_phone['.$itr.']" onkeypress="javascript:return numbersonly(this, event, false);" '); ?> 
                 <!--       <input class="inputbox" type="text" name="escorting_teacher_phone[<?php echo $itr; ?>]"  value="<?php echo @$aryname[$itr][2]; ?>" onkeypress="javascript:return numbersonly(this, event, false);" >-->
                        
                        </td>
					
					</tr>
                    </table>
                    <?php
				}
		}	
	  ?>
     
      <div id="divEscTeachers" style="display:none;" ></div>     </td>
      </tr>
     <tr >
       <td colspan="6">
       
       <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="heading_tab" >
         <tr style="border-bottom:1px solid #AEAEAE;">
           <th width="3%" ><div align="center"><span class="style1">Slno</span></div></th>
           <th width="17%" ><span class="style1">&nbsp;Items</span></th>
           
           <th width="12%"><span class="style1">&nbsp;Name of Participant  (Initials after name)</span></th>
           <th width="7%"><span class="style1">&nbsp;Standard</span></td>
           <?php if(@$festid==4) {?>  <th width="10%" ><span class="style1">&nbsp;TYPE<br />
(</span><span class="style4">HSS/VHSS</span><span class="style1">)</span></th>  <?php  } ?>
           <th width="7%" ><span class="style1">&nbsp;Admission Number</span></th>
           <th width="7%" ><span class="style1">&nbsp;Gender</span></th>
          <!-- <td width="10%" bgcolor="#E9E9D1"><span class="style1">&nbsp;Remarks</span></td>-->
         <?php if(@$confirm=="N")  {if(@$parti_flag == '1') { ?>  
        
           <th width="8%" ><span class="style1">Delete</span></th>
            <th width="5%" ><span class="style1">Edit</span></th> <?php } } ?>
         </tr>
         
         
         <?php 

		$r=0;
		$item_count=(count($item_details));$itms='';
	   $var_item=$item_count;
	   $var_item1=$item_count;
	   for($j=0;$j<$item_count;$j++){
	  
	   $var_item=$var_item1;
	   $item_name[$j]=$item_details[$j]['item_name'];
	   $item_code[$j]=$item_details[$j]['item_code'];
	   $max_participants[$j]=$item_details[$j]['max_participants'];
	   $max=$max_participants[$j];
	  	$k=0;
	   $spn=0;
	   //if($max_participants[$j]>1)
	 	// $r=0;
		//echo $item_code[$j];
	 $part_item_details=$this->Registration_Model->get_details_itemcode($schoolcode,$category,$fairid,$item_code[$j]);
	//var_dump($part_item_details);
	$r=0;
	?>
    <input name="max<?php echo $j;?>" type="hidden" value="<?php echo $max; ?>" id="max<?php echo $j;?>" />
    <input name="count" type="hidden" value="<?php echo $item_count; ?>" id="count" />
    <input name="it_code<?php echo $j;?>" type="hidden" value="<?php echo $item_code[$j]; ?>" id="it_code<?php echo $j;?>" />
     <input name="it_name<?php echo $j;?>" type="hidden" value="<?php echo $item_name[$j]; ?>" id="it_name<?php echo $j;?>" />
    <?php
	  while($max_participants[$j]!=0){
	  $k=$max_participants[$j];
	  
	    if(@$part_item_details[$r]['item_code']==$item_code[$j]){ 
	   ?>
       <input name="participant_item_id<?php echo $item_code[$j].$k;?>" type="hidden" value="<?php echo @$part_item_details[$r]['pi_id']; ?>" />
       <?php } 
       
	// echo @$part_item_details[$r]['item_code'];
	 
	 //echo @$part_item_details[$r]['item_code']."-------------".$item_code[$j]."----".$r."----".@$part_item_details[$r]['admn_no']."</br>";
	  /*if(@$parti_flag==1){
	  if($item_code[$j]==@$parti_details[$j]['item_code']){
	   $s=$j;
	   }
	   else
	   {
	  $s=$j-1;
	  }
	  }
	  else
	  $s=$j;*/
	 
	  // 
	   ?>
         <tr <?php if($j%2==0) {?> bgcolor="#E6F7F5"  <?php } else?> bgcolor="#FFFFFF" >
          <?php if($spn==0) {?> <td rowspan="<?php echo $k; ?>" style="text-align:center"><span class="style3"><?php echo $j+1;?></span></td>
          <?php }?>
           <?php if($spn==0) {?> <td rowspan="<?php echo $k; ?>"><?php echo strtoupper($item_name[$j]);?><input name="item_code<?php echo $item_code[$j];?>" type="hidden" value="<?php echo $item_code[$j]; ?>" /></td><?php }?>
           
          
           <td>
		   &nbsp;
		    <input name="exhibitFlag_<?php echo $item_code[$j]; ?>_<?php echo $k; ?>" id="exhibitFlag_<?php echo $item_code[$j]; ?>_<?php echo $k; ?>" type="hidden" value="disabled" />
            <input name="max_participant_<?php echo $item_code[$j]; ?>_<?php echo $k; ?>"  id="max_participant_<?php echo $item_code[$j]; ?>_<?php echo $k; ?>" type="hidden" value="<?php echo $item_details[$j]['max_participants']; ?>" />
		   
		   <?php 
		   $id1='name_participant'.$item_code[$j].$k; 
		   if(@$part_item_details[$r]['item_code']==$item_code[$j]){echo (@$parti_flag == '1') ? @$part_item_details[$r]['participant_name'] : form_input("name_participant".$item_code[$j].$k, @$part_item_details[$r]['participant_name'], 'class="inputbox" id="'.$id1.'" maxlength="30" size="35" onkeypress="javascript:return toUppercase(event,this)"'.''.'');}else { echo (@$parti_flag == '1') ? @$part_item_details[$r]['participant_name'] : form_input("name_participant".$item_code[$j].$k,'', 'class="inputbox" id="'.$id1.'" maxlength="30"  size="35" onkeypress="javascript:return toUppercase(event,this)"'.''.'');}
		   ?></td>
          
           <td>&nbsp;<?php 
		   
		    $id1='txtStandard'.$item_code[$j].$k; 
		   if(@$part_item_details[$r]['item_code']==$item_code[$j]){echo (@$parti_flag == '1') ? @$part_item_details[$r]['class'] : form_dropdown("txtStandard".$item_code[$j].$k, $classsectionary, @$part_item_details[$r]['class'],'class="inputbox1" id="'.$id1.'"'); }else { echo (@$parti_flag == '1') ? @$part_item_details[$r]['class'] : form_dropdown("txtStandard".$item_code[$j].$k, $classsectionary, '','class="inputbox1" id="'.$id1.'"'); }?></td>
           
           
           <?php if(@$festid==4) {
		   @$admn_fest=str_split(@$part_item_details[$r]['admn_no'],1);
		 if(@$admn_fest[0]=="H")
		 @$admn_fest="HSS";
		 else if(@$admn_fest[0]=="V")
		 @$admn_fest="VHSS";
		 else
		 @$admn_fest="";
		   ?> <td>&nbsp;<?php 
		   $id1='admn_category'.$item_code[$j].$k; 
		   if(@$part_item_details[$r]['item_code']==$item_code[$j]){echo (@$parti_flag == '1') ? @$admn_fest : form_dropdown("admn_category".$item_code[$j].$k, $admn_category, @$admn_fest[0],'class="inputbox"  id="'.$id1.'" '); }else { echo (@$parti_flag == '1') ? @$admn_fest : form_dropdown("admn_category".$item_code[$j].$k, $admn_category, '','class="inputbox"  id="'.$id1.'" '); }?></td><?php }  ?>
           <td>
       &nbsp;
		   <?php  $id1='adm_no'.$item_code[$j].$k; 
		   if(@$part_item_details[$r]['item_code']==$item_code[$j]){ echo (@$parti_flag == '1') ? @$part_item_details[$r]['admn_no'] : form_input("adm_no".$item_code[$j].$k, @$part_item_details[$r]['admn_no'], 'class="inputbox" id="'.$id1.'" maxlength="11"  size="4" onKeyUp="white_space(this.id)" onBlur="javascript:fetch_admision_no_details_array('.$item_code[$j].$k.')" '); }else{ echo (@$parti_flag == '1') ? @$part_item_details[$r]['admn_no'] : form_input("adm_no".$item_code[$j].$k, '', 'class="inputbox" id="'.$id1.'" maxlength="11"   size="4"   onKeyUp="white_space(this.id)" onBlur="javascript:fetch_admision_no_details_array('.$item_code[$j].$k.')" ');} ?></td>
          
           <td>&nbsp;<?php
		   if(@$part_item_details[$r]['gender'] == 'B') {$sex='Boy';}
		   else if(@$part_item_details[$r]['gender'] == 'G') {$sex='Girl';}
		   else {echo $sex='';}
		    $id1='txtgender'.$item_code[$j].$k; 
			
		    if(@$part_item_details[$r]['item_code']==$item_code[$j]){echo (@$parti_flag == '1') ? @$sex : form_dropdown("txtgender".$item_code[$j].$k, array(0=>'Gender', 'B' => 'Boy', 'G' => 'Girl'), @$part_item_details[$r]['gender'],'class="inputbox" id="'.$id1.'"'); }else { echo (@$parti_flag == '1') ? @$sex : form_dropdown("txtgender".$item_code[$j].$k, array(0=>'Gender', 'B' => 'Boy', 'G' => 'Girl'), '','class="inputbox" id="'.$id1.'"');}
		   ?></td>
          
           <!--<td >&nbsp;<?php //if(@$part_item_details[$r]['item_code']==$item_code[$j]){ if(@$parti_flag == '1') { echo @$part_item_details[$r]['remarks']; } else {?><textarea class="text-input textarea"  id="remarks" name="remarks<?php echo @$item_code[$j].$k;?>" rows="1" cols="20" onkeypress="return toUppercase(event,this)"><?php //echo  @$part_item_details[$r]['remarks'];?></textarea> <?php //} }else { if(@$parti_flag == '1') { echo @$part_item_details[$r]['remarks']; } else {?><textarea class="text-input textarea" id="remarks" name="remarks<?php //echo @$item_code[$j].$k;?>" rows="1" cols="20" onkeypress="return toUppercase(event,this)"></textarea> <?php //} }?></td>-->
            <?php if(@$confirm=="N")  {if(@$parti_flag == '1') { 
		   //if($spn==0) {?> 
           <td ><?php if(@$part_item_details[$r]['admn_no']) {?><a href="#" onClick="return deleteParticipant(<?php echo "'".$item_code[$j]."'";?>,<?php echo "'".@$part_item_details[$r]['admn_no']."'";?>);"><img src="<?php echo base_url()?>images/icon_cross.png"width="20" height="20" title="Delete"></a><?php } ?></td><?php //} 
		    }}?>
            
            
          <?php if(@$confirm=="N")  {if(@$parti_flag == '1') { 
		 // if($spn==0) {?> 
          <td rowspan="<?php echo $k; ?>"><?php if(@$part_item_details[$r]['admn_no']) {?><a href="javascript:void(0);"  onclick="javascript:return editParticipant(<?php echo "'".$item_code[$j]."'";?>);"><img src="<?php echo base_url()?>images/edit.gif" width="20" height="20" title="Edit"></a><?php }?></td><?php //}
		  }}?>
          
          
         </tr>
         <?php $max_participants[$j]=$max_participants[$j]-1;
		 $spn=1;
		$r=$r+1;
		 $itms .= $item_code[$j].'_'.$k.'#';	  
		 }
		 }?>
       </table></td>
      </tr>
     
     <tr>
       <td colspan="6"><!--<input type="submit" value="Save" class="btnalt" align="right" onclick="return validate();" />-->
         <input name="code_item" id="code_item" type="hidden" value="<?php echo @$code_item; ?>" />
         <input name="edit_item" id="edit_item" type="hidden" value="<?php echo @$edit_item; ?>" />
        <input name="items" id="items" type="hidden" value="<?php echo $itms; ?>" />
           <?php  $sub_district_details=$this->School_Details_Model->getSubDistrictDetails($this->session->userdata('SUB_DISTRICT'));
		   
		   if(@$confirm=="N" && @$sub_district_details[0]['it_confirm_data_entry']=="N")  {echo (@$parti_flag == '1') ? form_button('Edit', 'Edit', 'class="btnalt" onClick="javascript:fncEditPartDeatils()"').'&nbsp;&nbsp;'.form_button('Print', 'Print', 'class="btnalt" onClick="javascript:goto_print()"') : form_submit('Save', 'Save', 'class="btnalt" onClick="javascript:return socialsciencemathsValidate()" '); }
		  else {
			   echo form_button('Print', 'Print', 'class="btnalt" onClick="javascript:goto_print()"');				
			
			}  
		   
		   
		   
		   ?> </td>
     </tr>
   </table>
 </div>

<?php 
echo form_close();
}
?>