<?php if($this->session->userdata('USER_TYPE')!=''){ ?>

<script type="text/javascript" src="<?php echo base_url();?>/js/common.js">
</script>

<style type="text/css">
<!--
.style1 {
	color: #333333;
	font-weight: bold;
}
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

	
 echo form_open('school/registration/save_details', array('id' => 'scienceSchool','name' => 'scienceSchool'));
 
 ?>
<body onLoad="setfocus();" ></body>
<div class="container" >

   <table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="heading_tab" style="border:solid 1px; color:#999999">
     <tr>
       <th  height="32" colspan="2" style="border-bottom:1px solid #AEAEAE;">&nbsp;
    
         <input name="base_url" type="hidden" id="base_url" value="<?php echo base_url();?>" />
         <input name="festid" type="hidden" id="festid" value="<?php echo $category;?>" />
         <input name="fairid" type="hidden" id="fairid" value="<?php echo "1";?>" />
         <input name="schoolcode" type="hidden" id="schoolcode" value="<?php echo @$school_details[0]['school_code'];?>" />
         <input name="item_count" type="hidden" value="<?php echo count(@$item_details);?>" />
         <input name="class_to"  id="class_to" type="hidden" value="<?php echo @$school_details[0]['class_end'];?>" />
         
          <?php $schoolcode=@$school_details[0]['school_code'];
		       $fairid=1;
			    if(@$confirm=="Y")  {
			  @$parti_flag = 1;
			  }
		 ?>
         
       SchoolCode:<?php echo @$school_details[0]['school_code'];?>  </th>
       <th  height="32" colspan="4" style="border-bottom:1px solid #AEAEAE;">SchoolName : &nbsp;<?php echo @$school_details[0]['school_name'];?> </th>
     </tr>
     
    
     <tr  bgcolor="#FFFFFF" >
       <td width="29%">Number of Escorting Teacher :  
	   </td>
       <td width="71%" colspan="5"><span style="float:left;">
	   <?php 
		//escorting_details
		$no_escorting_details = count($escorting_details);
		 $divname="'divEscTeachers'";
		$count_c =  "0";
		$count_c=@$escorting_details[0]['teachers_num'];
		
		@$school_details[0]['escorting_teachers'] = ($count_c>0)?$count_c:0;
		
		echo (@$parti_flag == '1') ? @$school_details[0]['escorting_teachers'] : form_input("escorting_teacher_num", @$school_details[0]['escorting_teachers'], 'class="inputbox1" id="escorting_teacher_num" maxlength="11" onkeypress="javascript:return numbersonly(this, event, false);" onblur="showEscortingTeachers(this.value,'.@$school_details[0]['escorting_teachers'].','.$divname.')"');?>
	   </span>        </td>
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
						<td align="left" width="2%"><?php echo $itr; ?></td>
						<td align="left" width="20%"><?php echo (@$parti_flag == '1') ? @$aryname[$itr][0] : form_input("escorting_teacher_name[".$itr."]", @$aryname[$itr][0], 'class="inputbox" id="escorting_teacher_name['.$itr.']" onkeypress="javascript:return toUppercase(event,this)" '); ?> 
 
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
						<select   name="<?php echo "designation[".$itr."]"; ?>" id="<?php echo "designation[".$itr."]"; ?>" style="width:400px;" >
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
      <div id="divEscTeachers" style="display:none;" >
     
      </div>   
      </td>
      </tr>
     
     <tr >
       <td colspan="6"><table width="100%" border="0" align="center" cellpadding="5" cellspacing="0"  class="heading_tab" >
         <tr style="border-bottom:1px solid #AEAEAE;">
           <th width="3%"><div align="center"><span class="style1">Slno</span></div></th>
           <th width="22%"><span class="style1">&nbsp;Items</span></th>
           <th width="15%" ><span class="style1">&nbsp;Name of Exhibit</span></th>
           
           <th width="22%" ><span class="style1">&nbsp;Name of Participant<br /> (Initials after name)</span></th>
           <th width="8%" ><span class="style1">&nbsp;Standard</span></th>
          <?php if(@$festid==4) {?>  <th width="10%" ><span class="style1">&nbsp;TYPE<br />
            (HSS/VHSS)</span></th>  <?php  } ?>
           <th width="9%" ><span class="style1">&nbsp;Admission No
/ Teachers (Pen/PF No)</span></th>
           <th width="7%" ><span class="style1">&nbsp;Gender</span></th>
           <!--<td width="10%" bgcolor="#E9E9D1"><span class="style1">&nbsp;Remarks</span></td>-->
          <?php  if(@$confirm=="N")  {if(@$parti_flag == '1') { ?>  
          <th width="8%" ><span class="style1">Delete</span></th>
          <th width="5%"><span class="style1">Edit</span></th>
            <?php }} ?>
         </tr>
         <?php 
	   $r=0;
	   $item_count=(count($item_details));$itms ='';
	   $var_item=$item_count;
	   $var_item1=$item_count;
	   for($j=0;$j<$item_count;$j++){
	  
	   $var_item=$var_item1;
	   $item_name[$j]=$item_details[$j]['item_name'];
	   $item_code[$j]=$item_details[$j]['item_code'];
	   $max_participants[$j]=$item_details[$j]['max_participants'];
	   $is_exhibit[$j]=$item_details[$j]['is_exhibit'];
	   $is_teach[$j]=$item_details[$j]['is_teach'];
	   $max=$max_participants[$j];
	  	$k=0;
	   $spn=0;
	  
	   
	   if($is_exhibit[$j]	==	'N')
	   {	$max_participants[$j]	=	10;	}
	   
	  
	  
		   $part_item_details=$this->Registration_Model->get_details_itemcode($schoolcode,$category,$fairid,$item_code[$j]);
		   
		   $result_item_details=$this->Registration_Model->get_result_item_details($item_code[$j]);
	  	   if($result_item_details[0]['count'] == 0)$item_disabled = '';
		   else $item_disabled = 'disabled';
			
		
		$r=0;
		?>
       
		<input name="max<?php echo $j;?>" type="hidden" value="<?php echo $max; ?>" id="max<?php echo $j;?>" />
		<input name="count" type="hidden" value="<?php echo $item_count; ?>" id="count" />
		<input name="it_code<?php echo $j;?>" type="hidden" value="<?php echo $item_code[$j]; ?>" id="it_code<?php echo $j;?>" />
		<input name="it_name<?php echo $j;?>" type="hidden" value="<?php echo $item_name[$j]; ?>" id="it_name<?php echo $j;?>" />
         
		<?php
	     
	 	 
	   while($max_participants[$j]!=0){
	   if($is_exhibit[$j]	!=	'N')
	   { $k=$max_participants[$j]; $f	=	''; $ex_flag='notdisabled';} else { $k	=	1; $f	=	'disabled'; $ex_flag='disabled';}
	   
	   //quiz + talent search
	   if($item_code[$j] == 110 || $item_code[$j] == 119  || $item_code[$j] == 120 || $item_code[$j] == 130)
	   { $quiz_flag	=	1; } else{ $quiz_flag	=	0;   }
	   
		 
	  if(@$part_item_details[$r]['item_code']==$item_code[$j]){ 
	   ?>
       <input name="participant_item_id<?php echo $item_code[$j].$k;?>" type="hidden" value="<?php echo @$part_item_details[$r]['pi_id']; ?>" />
       <?php } ?>
       
       
         <tr <?php if($j%2==0) { ?> bgcolor="#E6F7F5"  <?php } else ?> bgcolor="#FFFFFF" >
          <?php if($spn==0) {?> <td rowspan="<?php echo $k; ?>"><div align="center"><?php echo $j+1;?></div></td><?php }?>
           <?php if($spn==0) {?> <td rowspan="<?php echo $k; ?>">&nbsp;<?php echo strtoupper($item_name[$j]);?><input name="item_code<?php echo $item_code[$j];?>" id="item_code<?php echo $item_code[$j];?>" type="hidden" value="<?php echo $item_code[$j]; ?>" /></td><?php }?>
           
		  
           <?php if($spn==0) {?> <td align="left" rowspan="<?php echo $k; ?>"> 
          
		   <?php 
		   $id1='exhibit_name'.$item_code[$j];
		   //echo "<br />".$id1;
		   if($quiz_flag	==	0) {  if(@$part_item_details[$r]['item_code']==$item_code[$j]){echo (@$parti_flag == '1') ? @$part_item_details[$r]['exhibit_name'] : form_input("exhibit_name".$item_code[$j], @$part_item_details[$r]['exhibit_name'], 'class="inputbox"   '.$item_disabled.'   id="'.$id1.'" maxlength="11" onkeypress="javascript:return toUppercase(event,this)"'.''.'');}else { echo (@$parti_flag == '1') ? @$part_item_details[$r]['exhibit_name'] : form_input("exhibit_name".$item_code[$j],@$_POST["exhibit_name".$item_code[$j]], 'class="inputbox"   '.$item_disabled.'   id="'.$id1.'"  maxlength="11" onkeypress="javascript:return toUppercase(event,this)"'.''.$f.'');}  }?>
                    
           </td> <? } ?>
           
            
           
          <td><?php 
		  $id1='name_participant'.$item_code[$j].$k; 
		  if($item_code[$j] != 123 ){
		  if(@$part_item_details[$r]['item_code']==$item_code[$j]){echo (@$parti_flag == '1') ? @$part_item_details[$r]['participant_name'] : form_input("name_participant".$item_code[$j].$k, @$part_item_details[$r]['participant_name'], 'class="inputbox"  maxlength="30"   '.$item_disabled.'  size="35" id="'.$id1.'" onkeypress="javascript:return toUppercase(event,this)"'.''.'');}else { echo (@$parti_flag == '1') ? @$part_item_details[$r]['participant_name'] : form_input("name_participant".$item_code[$j].$k,@$_POST["name_participant".$item_code[$j].$k], 'class="inputbox"   '.$item_disabled.'   maxlength="30" size="35" id="'.$id1.'" onkeypress="javascript:return toUppercase(event,this)"'.''.'');}
		  }
		   ?></td>
          
          <td>&nbsp;<?php 
		   if($item_code[$j] != 123 && $is_teach[$j] != 'Y' ){
		   $id1='txtStandard'.$item_code[$j].$k; 
		  if(@$part_item_details[$r]['item_code']==$item_code[$j]){echo (@$parti_flag == '1') ? @$part_item_details[$r]['class'] : form_dropdown("txtStandard".$item_code[$j].$k, $classsectionary, @$part_item_details[$r]['class'],'class="inputbox1"   '.$item_disabled.'   id="'.$id1.'" '); }else { echo (@$parti_flag == '1') ? @$part_item_details[$r]['class'] : form_dropdown("txtStandard".$item_code[$j].$k, $classsectionary, @$_POST["txtStandard".$item_code[$j].$k],'class="inputbox1"   '.$item_disabled.'   id="'.$id1.'" '); }
		  }
		  
		  if($is_teach[$j] == 'Y' ){
		   ?>
           <input type="hidden" name="<?php echo 'txtStandard'.$item_code[$j].$k; ?>" value="100"  id="<?php echo 'txtStandard'.$item_code[$j].$k; ?>"   />
           <?php
		   		  
		  }
		  
		  ?>
          
          
          </td>
          
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
		    if($item_code[$j] != 123 ){
		   if(@$part_item_details[$r]['item_code']==$item_code[$j]){echo (@$parti_flag == '1') ? @$admn_fest : form_dropdown("admn_category".$item_code[$j].$k, $admn_category, @$admn_fest[0],'class="inputbox"   '.$item_disabled.'   id="'.$id1.'" '); }else { echo (@$parti_flag == '1') ? @$admn_fest : form_dropdown("admn_category".$item_code[$j].$k, $admn_category, @$_POST["admn_category".$item_code[$j].$k],'class="inputbox"   '.$item_disabled.'   id="'.$id1.'" '); }?></td><?php } 
		   }
		    ?>
          <td>&nbsp;
         <input name="exhibitFlag_<?php echo $item_code[$j]; ?>_<?php echo $k; ?>" id="exhibitFlag_<?php echo $item_code[$j]; ?>_<?php echo $k; ?>" type="hidden" value="<?php echo $ex_flag; ?>" />
            <input name="max_participant_<?php echo $item_code[$j]; ?>_<?php echo $k; ?>"  id="max_participant_<?php echo $item_code[$j]; ?>_<?php echo $k; ?>" type="hidden" value="<?php echo $item_details[$j]['max_participants']; ?>" />
            
             <input name="participant_id<?php echo $item_code[$j]; ?><?php echo $k; ?>"  id="participant_id<?php echo $item_code[$j]; ?>_<?php echo $k; ?>" type="hidden" value="<?php echo @$part_item_details[$r]['participant_id']; ?>" />
            
            <? $admn_hid='adm_no_hid'.$item_code[$j].$k;  //echo $admn_hid;  ?>
            
            <input name="<?php echo $admn_hid; ?>"  id="<?php echo $admn_hid; ?>" type="hidden" value="<?php echo @$part_item_details[$r]['admn_no']; ?>" />
            
		    <?php  $id1='adm_no'.$item_code[$j].$k; 
			 if($item_code[$j] != 123 ){
		   if(@$part_item_details[$r]['item_code']==$item_code[$j]){ echo (@$parti_flag == '1') ? @$part_item_details[$r]['admn_no'] : form_input("adm_no".$item_code[$j].$k, @$part_item_details[$r]['admn_no'], 'class="inputbox" id="'.$id1.'" maxlength="11" size="4"   '.$item_disabled.'    onKeyUp="white_space(this.id)" onBlur="javascript:fetch_admision_no_details_array('.$item_code[$j].$k.')"'); }
		   else{ echo (@$parti_flag == '1') ? @$part_item_details[$r]['admn_no'] : form_input("adm_no".$item_code[$j].$k, @$_POST["adm_no".$item_code[$j].$k], 'class="inputbox" id="'.$id1.'" maxlength="11"  size="4"   '.$item_disabled.'  onKeyUp="white_space(this.id)"  onBlur="javascript:fetch_admision_no_details_array('.$item_code[$j].$k.')" ');} 
		   }
		   ?></td>
          
          
           <td><?php
		  
		   $aryGender=array(0=>'Gender', 'B' => 'Boy', 'G' => 'Girl');
		  if(@$part_item_details[$r]['gender'] == 'B') {$sex='Boy';}
		   else if(@$part_item_details[$r]['gender'] == 'G') {$sex='Girl';}
		   else {echo $sex='';}
		    $id1='txtgender'.$item_code[$j].$k; 
			 if($item_code[$j] != 123 ){
		   if(@$part_item_details[$r]['item_code']==$item_code[$j]){echo (@$parti_flag == '1') ? @$sex : form_dropdown("txtgender".$item_code[$j].$k, array(0=>'Gender', 'B' => 'Boy', 'G' => 'Girl'), @$part_item_details[$r]['gender'],'class="inputbox"   '.$item_disabled.'   id="'.$id1.'" '); }else { echo (@$parti_flag == '1') ? @$sex : form_dropdown("txtgender".$item_code[$j].$k, $aryGender, @$_POST["txtgender".$item_code[$j].$k],'class="inputbox"   '.$item_disabled.'   id="'.$id1.'" ');}
		   }
		   
		   ?></td>
          
       
		    <?php 
			if($result_item_details[0]['count'] == 0)
			{
			if(@$confirm=="N")  { if(@$parti_flag == '1') { 
			
			//if($spn==0) { ?> 
            <td ><?php if((@$item_code[$j] == 123 && @$part_item_details[$r]['exhibit_name'] != '') || @$part_item_details[$r]['admn_no']) {?><a href="#" onClick="return deleteParticipant(<?php echo "'".$item_code[$j]."'";?>,<?php echo "'".@$part_item_details[$r]['admn_no']."'"; ?>,<?php echo 0;?>);"><img src="<?php echo base_url()?>images/icon_cross.png"width="20" height="20" title="Delete"></a><?php } ?></td>
		   
		   <?php // } 
		   
		   } }?>
           
		   <?php if(@$confirm=="N")  {if(@$parti_flag == '1') { if($spn==0) {?> <td rowspan="<?php echo $k; ?>"><?php if((@$item_code[$j] == 123 && @$part_item_details[$r]['exhibit_name'] != '') || @$part_item_details[$r]['admn_no']) {?><a href="javascript:void(0);"  onclick="javascript:return editParticipant(<?php echo "'".$item_code[$j]."'";?>);"><img src="<?php echo base_url()?>images/edit.gif" width="20" height="20" title="Edit"></a><?php }?></td><?php }}}
		   
		   
		   }
		   ?>
          
          
         </tr>
         
         <?php if($is_exhibit[$j]	!=	'N') { $max_participants[$j]=$max_participants[$j]-1; }
		       else {	$max_participants[$j]= 0;}
			   
			 $itms .= $item_code[$j].'_'.$k.'#';	  	   
		 $spn=1;
		$r=$r+1;
		 }
		 }
		 
		 if(@$school_details[0]['class_end']==4)
		{
	
		$edit_teaching_flag=1;
		if(@$edit_item==1)
		{
			if(@$code_item==111)$edit_teaching_flag=1;
			else $edit_teaching_flag=0;
		}
		
		if($edit_teaching_flag==1){
		?>
        <tr>
        <td align="center">4</td><td>Teaching Aid</td>
        <input name="participant_item_id_sc1" id="participant_item_id_sc1" type="hidden" value="<?php echo @$teachingaid[0]['participant_id']; ?>" />
        <input name="item_code_sc1" id="item_code_sc1" type="hidden" value="<?php echo 111; ?>" />
        <td><?php if(@$parti_flag == '1'){echo @$teachingaid[0]['exhibit_name'];}else{?><input class="inputbox" onKeyPress="javascript:return toUppercase(event,this)"   name="exhibit_name_sc1" id="exhibit_name_sc1" type="text" value="<?php echo @$teachingaid[0]['exhibit_name']; ?>" /><?php } ?></td>
        <td><?php if(@$parti_flag == '1'){echo @$teachingaid[0]['participant_name'];}else{?><input class="inputbox"  onkeypress="javascript:return toUppercase(event,this)"   size="35"  name="participant_name_sc1" id="participant_name_sc1" type="text" value="<?php echo @$teachingaid[0]['participant_name']; ?>" /><?php } ?></td>
        <td>&nbsp;</td>
        <td><?php if(@$parti_flag == '1'){echo @$teachingaid[0]['admn_no'];}else{?><input class="inputbox" name="admn_no_sc1" id="admn_no_sc1" type="text" value="<?php echo @$teachingaid[0]['admn_no']; ?>" onKeyUp="white_space(this.id)"   size="4" /><?php } ?></td>
        <td>
        <?php if(@$parti_flag == '1'){if(@$teachingaid[0]['gender']=='B')echo 'Boy';else if(@$teachingaid[0]['gender']=='G')echo 'Girl';}else{
		$select='';$select1='';
		if(@$teachingaid[0]['gender']=='B'){$select='selected';$select1='';}else if(@$teachingaid[0]['gender']=='G'){$select='';$select1='selected';};
		?>
        <select class="inputbox" name="gender_sc1" id="gender_sc1" >
          <option value="0">Select</option>
        <option <?php echo $select ?> value="B">Boy</option>
        <option <?php echo $select1 ?> value="G">Girl</option>
        </select><?php } ?></td>
        <?php if(@$parti_flag == '1'){?>
        <td><?php if(@$teachingaid[0]['admn_no']){ ?><a href="#" onClick="return deleteParticipant(<?php echo 111;?>,<?php echo "'".@$teachingaid[0]['admn_no']."'";?>,<?php echo 1; ?>);" ><img src="<?php echo base_url()?>images/icon_cross.png"width="20" height="20"></a><?php } ?></td>
        <td><?php if(@$teachingaid[0]['admn_no']){ ?><a href="javascript:void(0);"   onclick="javascript:return editParticipant(<?php echo 111;?>);"><img src="<?php echo base_url()?>images/edit.gif" width="20" height="20"></a><?php } ?></td>
        <?php } ?>
        </tr>
        <?php } 
		$edit_teaching_flag=2;
		if(@$edit_item==1)
		{
			if(@$code_item==112)$edit_teaching_flag=2;
			else $edit_teaching_flag=0;
		}
		
		if($edit_teaching_flag==2){
		?>
        <tr>
        <td align="center">5</td><td>Teacher's Project</td>
        <input name="participant_item_id_sc2" id="participant_item_id_sc2" type="hidden" value="<?php echo @$teachingproject[0]['participant_id']; ?>" />
        <input name="item_code_sc2" id="item_code_sc2" type="hidden" value="<?php echo 112; ?>" />
        <td><?php if(@$parti_flag == '1'){echo @$teachingproject[0]['exhibit_name'];}else{?><input class="inputbox" onKeyPress="javascript:return toUppercase(event,this)"   name="exhibit_name_sc2" id="exhibit_name_sc2" type="text" value="<?php echo @$teachingproject[0]['exhibit_name']; ?>" /><?php } ?></td>
        <td><?php if(@$parti_flag == '1'){echo @$teachingproject[0]['participant_name'];}else{?><input class="inputbox"  onkeypress="javascript:return toUppercase(event,this)"   size="35"  name="participant_name_sc2" id="participant_name_sc2" type="text" value="<?php echo @$teachingproject[0]['participant_name']; ?>" /><?php } ?></td>
        <td>&nbsp;</td>
        <td><?php if(@$parti_flag == '1'){echo @$teachingproject[0]['admn_no'];}else{?><input class="inputbox" name="admn_no_sc2" id="admn_no_sc2" type="text" value="<?php echo @$teachingproject[0]['admn_no']; ?>" onKeyUp="white_space(this.id)"   size="4" /><?php } ?></td>
        <td>
        <?php if(@$parti_flag == '1'){if(@$teachingproject[0]['gender']=='B')echo 'Boy';else if(@$teachingproject[0]['gender']=='G')echo 'Girl';}else{
		$select='';$select1='';
		if(@$teachingproject[0]['gender']=='B'){$select='selected';$select1='';}else if(@$teachingproject[0]['gender']=='G'){$select='';$select1='selected';};
		?>
        <select class="inputbox" name="gender_sc2" id="gender_sc2" >
          <option value="0">Select</option>
        <option <?php echo $select ?> value="B">Boy</option>
        <option <?php echo $select1 ?> value="G">Girl</option>
        </select><?php } ?></td>
        <?php if(@$parti_flag == '1'){?>
        <td><?php if(@$teachingproject[0]['admn_no']){ ?><a href="#" onClick="return deleteParticipant(<?php echo 112;?>,<?php echo "'".@$teachingproject[0]['admn_no']."'";?>,<?php echo 1; ?>);" ><img src="<?php echo base_url()?>images/icon_cross.png"width="20" height="20"></a><?php } ?></td>
        <td><?php if(@$teachingproject[0]['admn_no']){ ?><a href="javascript:void(0);"   onclick="javascript:return editParticipant(<?php echo 112;?>);"><img src="<?php echo base_url()?>images/edit.gif" width="20" height="20"></a><?php } ?></td>
        <?php } ?>
        </tr>
        <?php 
		}
		 }
		 ?>
		
        
         
         
         
       </table></td>
      </tr>
     
     <tr>
       <td colspan="6">
        <input name="code_item" id="code_item" type="hidden" value="<?php echo @$code_item; ?>" />
         <input name="edit_item" id="edit_item" type="hidden" value="<?php echo @$edit_item; ?>" />
       <input name="items" id="items" type="hidden" value="<?php echo $itms; ?>" />
           <?php 
		   $sub_district_details[0]['science_confirm_data_entry']='N';
		   //if($this->session->userdata('USER_TYPE')==5)
		   $sub_district_details=$this->School_Details_Model->getSubDistrictDetails($this->session->userdata('SUB_DISTRICT'));
		  // else $sub_district_details[0]['science_confirm_data_entry']='N';
		//echo 'sub'.$this->session->userdata('USER_TYPE').'$confirm=='.$confirm.'sub===='.$sub_district_details[0]['science_confirm_data_entry'];  
		//
		   if(@$confirm=="N" && @$sub_district_details[0]['science_confirm_data_entry']=="N"){echo (@$parti_flag == '1') ? form_button('Edit', 'Edit', 'class="btnalt" onClick="javascript:fncEditPartDeatils()"').'&nbsp;&nbsp;'.form_button('Print', 'Print', 'class="btnalt" onClick="javascript:goto_print()"')  : form_submit('Save', 'Save', 'class="btnalt" onClick="javascript:return socialsciencemathsValidate()"  ');}
		   else {
			  
			   ?>
              <!-- <div class="status info" id="divMessage" ><p><span><?php echo "AEO level confirmation has been done. Now it is possible to take the print" ?></span></p></div>-->
        <?php		
		 echo form_button('Print', 'Print', 'class="btnalt" onClick="javascript:goto_print()"');		
			  }
		   
		   
		   ?> </td>
     </tr>
   </table>
  
 </div>
 <div id="contan"></div>
  
<?php 
echo form_close();
}
?>