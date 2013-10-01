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
.style5 {color: #000000}
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
		if(isset($sucess) && trim($sucess)!='' && trim($sucess)!='2' && trim($sucess)!='0'){ ?>
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

  echo form_open('school/registration/save_details', array('id' => 'workexp_exbEntry','name' => 'workexp_exbEntry'));
  
 ?>
 <body onLoad="setfocus();" ></body>
<div class="container">

   <table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="heading_tab" style="border:solid 1px; color:#999999" >
     <tr>
       <th height="32" colspan="2" style="border-bottom:1px solid #AEAEAE;">&nbsp;
    
         <input name="base_url" type="hidden" id="base_url" value="<?php echo base_url();?>" />
         <input name="festid" type="hidden" id="festid" value="<?php echo $category;?>" />
         <input name="fairid" type="hidden" id="fairid" value="<?php echo "4";?>" />
          <input name="exb" type="hidden" id="exb" value="<? echo "2"; ?>" />
         <input name="schoolcode" type="hidden" id="schoolcode" value="<?php echo @$school_details[0]['school_code'];?>" />
          <input name="heading" type="hidden" id="heading" value="<?php echo $Heading;?>" />
         <input name="item_count" type="hidden" value="<?php echo count(@$item_details);?>" />
         <input name="class_to" type="hidden" value="<?php echo @$school_details[0]['class_end'];?>" />
         
         <?php $schoolcode=@$school_details[0]['school_code'];
		       $fairid=4;
			     if(@$confirm=="Y")  {
			  @$parti_flag = 1;
			  }
			  
		 ?>
         <span class="style4">SchoolCode&nbsp;:</span>&nbsp;<span class="style3"><?php echo @$school_details[0]['school_code'];?> </th>
       <th  height="32" colspan="4" style="border-bottom:1px solid #AEAEAE;">SchoolName&nbsp;:&nbsp;<?php echo @$school_details[0]['school_name'];?></strong></th>
     </tr>
     <?php //if($exb==0)	 {
	 ?>
     <tr >
       <td width="33%">&nbsp;</td>
       <td width="67%" colspan="5">&nbsp;</td>
     </tr>
      
     <tr bgcolor="#E6F7F5" >
       <td class="style3">Name of the TeamManager/Joint TeamManager<br /></td>
       <td colspan="5" class="style3"><?php echo (@$parti_flag == '1') ? @$escorting_details[0]['name_team'] : form_input("name_team", @$escorting_details[0]['name_team'], 'class="inputbox" id="name_team" maxlength="11" onkeypress="return toUppercase(event,this)"');?></td>
     </tr>
     <tr  bgcolor="#FFFFFF"  >
       <td class="style3">Address of the TeamManager/Joint TeamManager</td>
       <td colspan="5" class="style3">
         <?php if(@$parti_flag == '1') { echo @$escorting_details[0]['address_team']; } else {?>
         <textarea class="text-input textarea"  id="address_team" name="address_team" rows="1" cols="40" onKeyPress="return toUppercase(event,this)"><?php echo  @$escorting_details[0]['address_team'];?></textarea> 
         <?php } ?>         </td>
     </tr>
     <tr bgcolor="#E6F7F5" >
       <td class="style3">Phone Number of the TeamManager/Joint TeamManager</td>
       <td colspan="5" class="style3"><?php echo (@$parti_flag == '1') ? @$escorting_details[0]['phone_team'] : form_input("phone_team", @$escorting_details[0]['phone_team'], 'class="inputbox" id="phone_team" maxlength="11" onkeypress="javascript:return numbersonly(this, event, false);"');?></td>
     </tr>
     <tr >
       <td class="style3">&nbsp;</td>
       <td colspan="5" class="style3">&nbsp;</td>
     </tr>
     <tr  bgcolor="#FFFFFF" >
       <td>
       Number of Escorting Teacher  : <?php 
		//escorting_details
		$no_escorting_details = count($escorting_details);
		 $divname1="'divEscTeachers'";
		$count_c =  "0";
		$count_c=@$escorting_details[0]['teachers_num'];
		//echo $count_c;
		@$school_details[0]['escorting_teachers'] = ($count_c>0)?$count_c:0;
		
		echo (@$parti_flag == '1') ? @$school_details[0]['escorting_teachers'] : form_input("escorting_teacher_num", @$school_details[0]['escorting_teachers'], 'class="inputbox1" id="escorting_teacher_num" maxlength="11" onkeypress="javascript:return numbersonly(this, event, false);" onblur="showEscortingTeachers(this.value,'.@$school_details[0]['escorting_teachers'].','.$divname1.')"');?>
       </td>
       <td colspan="5"><span style="float:left;">
         
       </span></td>
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
 
<!-- <input class="inputbox" type="text" id="escorting_teacher_name[<?php echo $itr; ?>]"   name="escorting_teacher_name[<?php echo $itr; ?>]"  value="<?php echo @$aryname[$itr][0]; ?>"  onkeypress="javascript:return toUppercase(event,this)" >--> </td>
 
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
						<?php } ?>						</td>
                      	<td align="left"    width="50%">
                        <?php echo (@$parti_flag == '1') ? @$aryname[$itr][2] : form_input("escorting_teacher_phone[".$itr."]", @@$aryname[$itr][2], 'class="inputbox" id="escorting_teacher_phone['.$itr.']" onkeypress="javascript:return numbersonly(this, event, false);" '); ?> 
                 <!--       <input class="inputbox" type="text" name="escorting_teacher_phone[<?php echo $itr; ?>]"  value="<?php echo @$aryname[$itr][2]; ?>" onkeypress="javascript:return numbersonly(this, event, false);" >-->                        </td>
					</tr>
        </table>
                    <?php
				}
		}	
	  ?>
     
      <div id="divEscTeachers" style="display:none;"></div>      </td>
      </tr>
      <?php // }
	  //else{}
	  /************** Items *********************/
	  
	  ?>
     <tr >
       <td colspan="6">
   
       <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="heading_tab" >
       
       <tr style="border-bottom:1px solid #AEAEAE;">

        <th colspan="6"><span class="style1">&nbsp;Item Details</span></th>
        </tr>
               
         <tr style="border-bottom:1px solid #AEAEAE;">
           
           <th width="7%"><div align="center"><span class="style1">Slno</span></div></th>
           <th width="39%" ><span class="style1">&nbsp;Items</span></th>
            <th width="3%">&nbsp;&nbsp;</th>
           <th width="7%"><span class="style1">&nbsp;Slno</span></th>
           <th width="32%"><span class="style1">&nbsp;Items</span></th>
           <th width="5%">&nbsp;&nbsp;</th>
            <!-- <td width="8%" bgcolor="#E9E9D1"><span class="style1">&nbsp;Remarks</span></td>-->
         
         </tr>
         
         
         <?php  
  
	   $sel_items	=	explode('#',@$parti_details[0]['item_code']);
		$slno=1;
	   $r=0;
	   $rowClass	=	0; $itms	=	'';
	   $item_count=(count($item_details)); 
	     
	   $var_item =$item_count;
	   $var_item1=$item_count;
	     
	   for($j=0;$j<$item_count;$j++){
	 
	 // print_r($item_details[$j]);
	   $var_item=$var_item1;
	   //echo '<br><br>'.@$school_details[0]['class_end'].'<br>'.$item_details[$j]['exb_cat'];
	   
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
	//print_r($part_item_details);
	$r=0;
	
	  
	?>
    <input name="max<?php echo $j;?>" type="hidden" value="<?php echo $max; ?>" id="max<?php echo $j;?>" />
    <input name="count" type="hidden" value="<?php echo $item_count; ?>" id="count" />
    <input name="it_code<?php echo $j;?>" type="hidden" value="<?php echo $item_code[$j]; ?>" id="it_code<?php echo $j;?>" />
     <input name="it_name<?php echo $j;?>" type="hidden" value="<?php echo $item_name[$j]; ?>" id="it_name<?php echo $j;?>" />
     
     <? if($j%2	==0) { 
	    $rowClass++; 
		$color = (($rowClass) % 2 == 0) ? '#FFFFFF' : '';
		echo "<tr bgcolor='$color'>"; } 
	 
	    if(in_array($item_code[$j],$sel_items)) { 
		$prop = true;
		} else { 
		$prop = false;
		}
	   $data = array('name'    => $item_code[$j].'_chk',	 				
					 'id'      => $item_code[$j].'_chk',
					 'value'   => $item_code[$j],
					 'checked' => $prop
					);
	 
	 
	 ?>
     
        
         <td style="text-align:center"><span class="style5"><?php echo $j+1;?></span></td>
         <td><?php echo strtoupper($item_name[$j]);?><input name="item_code<?php echo $item_code[$j];?>" type="hidden" value="<?php echo $item_code[$j]; ?>" /></td>
         <td ><? echo form_checkbox($data); ?></td>
     <? if($j%2	!=0) {  echo "</tr>"; } ?>
     
    <?php
	  		$itms .= $item_code[$j].'#';
			//if($j>=25)$slno=$slno+1;
		 }?>
       </table></td>
     </tr>
  </table>
      <input name="items" id="items" type="hidden" value="<?php echo $itms; ?>" />
      
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="heading_tab" >
<tr style="border-bottom:1px solid #AEAEAE;">
<?php  
$span_head	=	6;
if(@$confirm=="N")  {if(@$parti_flag == '1') {  $span_head	=	7;     }} ?>
<th colspan="<? echo $span_head; ?>"><span class="style1">&nbsp;Participant Details</span></th>
</tr>

<tr style="border-bottom:1px solid #AEAEAE;">
                     
       <th width="10%"><span class="style1">&nbsp;SI No.</span></th>
      <th width="32%" align="left"><span class="style1">&nbsp;Name of Participant (Initials after name)</span></th>
      <th width="18%"><span class="style1">&nbsp;Standard</span></th>
      <th width="10%" ><span class="style1">&nbsp;TYPE<br />
(</span><span class="style4">HSS/VHSS</span><span class="style1">)</span></th>
      <th width="19%" ><span class="style1">&nbsp;Admission Number</span></th>
      <th width="21%" ><span class="style1">&nbsp;Gender</span></th>
      <?php  if(@$confirm=="N")  {if(@$parti_flag == '1') { ?>  
           <th width="8%" ><span class="style1">Delete</span></th> <?php }} ?>
        </tr>
         
        <? 
		
				$r	=	0;
		for($p=1;$p<6;$p++) { 
		$rowcolor = (($p) % 2 == 0) ? '#FFFFFF' : '';
		$admnum	=	@$parti_details[$r]['admn_no'];
	
		$admn_fests= '' ;	
		@$admn_fests=str_split(@$parti_details[$r]['admn_no'],1);
		
		 if(@$admn_fests[0]=="H") {
		 $admnf="HSS"; $admnum	=	substr(@$parti_details[$r]['admn_no'],1); }
		 else if(@$admn_fests[0]=="V") {
		 $admnf="VHSS"; $admnum	=	substr(@$parti_details[$r]['admn_no'],1); }
		 else
		 {$admnf=' '; @$admn_fests[0]=0;}
		 
		 
		 //$cnt_part	=	count(@$parti_details);
		 
		 
		?>
         <input name="participant_item_id<?php echo $p;?>" type="hidden" value="<?php echo @$parti_details[$r]['pi_id']; ?>" />
         
        <tr bgcolor="<? echo $rowcolor; ?>" style="border-bottom:1px solid #AEAEAE;">
           <td align="center" ><? echo $p; ?></td>          
           <td align="left" ><? echo (@$parti_flag == '1') ? @$parti_details[$r]['participant_name'] : form_input("name_participant".$p, @$parti_details[$r]['participant_name'], 'class="inputbox" id="name_participant'.$p.'" maxlength="30" size="35"  onkeypress="javascript:return toUppercase(event,this)"'); ?></td>
           <td align="center" ><? echo (@$parti_flag == '1') ? @$parti_details[$r]['class'] : form_dropdown("txtStandard".$p, $classsectionary, @$parti_details[$r]['class'], 'class="inputbox" id="txtStandard'.$p.'" onChange="javascript:loadStdtype('.$p.');"'); ?></td>
           
           <td align="center" ><? echo (@$parti_flag == '1') ? $admnf :  form_dropdown("admn_category".$p, @$admn_category, @$admn_fests[0], 'class="inputbox" id="admn_category'.$p.'"'); ?></td>
       		
           <td align="center" ><? $admncat_disabled=''; if(@$parti_details[$r]['class']<11)$admncat_disabled='';  echo (@$parti_flag == '1') ? @$parti_details[$r]['admn_no'] :  form_input("adm_no".$p, @$admnum, 'class="inputbox" id="adm_no'.$p.'" onKeyUp="white_space(this.id)" maxlength="15"  size="12"  '); ?></td>
           <td align="center" ><? 
		   if(@$parti_details[$r]['gender'] == 'B') {$sex='Boy';}
		   else if(@$parti_details[$r]['gender'] == 'G') {$sex='Girl';}
		   else {echo $sex='';}		   
		  // echo "<br />mmmmmm---".@$sex;
		   echo (@$parti_flag == '1') ? @$sex :   form_dropdown("txtgender".$p,array(0=>'Gender', 'B' => 'Boy', 'G' => 'Girl'),@$parti_details[$r]['gender'],  'class="inputbox" id="txtgender'.$p.'"'); ?></td>
           
           <?php 
		   $cnt1 = count(@$parti_details);
		 	
		   if(@$confirm=="N")  { if(@$parti_flag == '1' && $cnt1 > 1) { ?> <td align="center" ><?php if(@$parti_details[$r]['admn_no']) {?><a href="#" onClick="return deleteParticipant(0,<?php echo "'".$parti_details[$r]['admn_no']."'";?>,0);"><img src="<?php echo base_url()?>images/icon_cross.png"width="20" height="20" title="Delete"></a><?php } ?></td>
		   
		   <?php  } }?>
        </tr>
         
        <? $r++;
		  
		
		} ?> 
             
     
     <tr>
       <td colspan="6"><!--<input type="submit" value="Save" class="btnalt" align="right" onclick="return validate();" />-->
        <input name="edit_item" id="edit_item" type="hidden" value="0" />
       <input name="items" id="items" type="hidden" value="<?php echo $itms; ?>" />
           <?php  
		   
		   $sub_district_details=$this->School_Details_Model->getSubDistrictDetails($this->session->userdata('SUB_DISTRICT'));
		   
		   if(@$confirm=="N" && @$sub_district_details[0]['worexpo_confirm_data_entry']=="N")  {echo (@$parti_flag == '1') ? form_button('Edit', 'Edit', 'class="btnalt" onClick="javascript:fncEditPartDeatils()"').'&nbsp;&nbsp;'.form_button('Print', 'Print', 'class="btnalt" onClick="javascript:goto_print()"') : form_submit('Save', 'Save', 'class="btnalt" onClick="javascript:return exhibValidate()" '); }
		    else {
			   echo form_button('Print', 'Print', 'class="btnalt" onClick="javascript:goto_print()"');				
			
			}
		   
		   
		   ?> </td>
     </tr>
  </table>

<?php 
echo form_close();
}
?>

</div>

</div>
