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

 echo form_open('school/registration/save_details', array('id' => 'socialscienceEntry','name' => 'socialscienceEntry'));
 
 ?>
 <body onLoad="setfocus();" ></body>
<div class="container">
 
   <table width="98%" border="0" align="center" cellpadding="0" cellspacing="1" class="heading_tab" style="border:solid 1px; color:#999999">
     <tr>
       <th height="32" colspan="2" style="border-bottom:1px solid #AEAEAE;">&nbsp;
    
         <input name="base_url" type="hidden" id="base_url" value="<?php echo base_url();?>" />
         <input name="festid" type="hidden" id="festid" value="<?php echo $category;?>" />
         <input name="fairid" type="hidden" id="fairid" value="<?php echo "3";?>" />
         <input name="schoolcode" type="hidden" id="schoolcode" value="<?php echo @$school_details[0]['school_code'];?>" />
         <input name="item_count" type="hidden" value="<?php echo count(@$item_details);?>" />
             <input name="class_to" id="class_to" type="hidden" value="<?php echo @$school_details[0]['class_end'];?>" />
             
          <?php $schoolcode=@$school_details[0]['school_code'];
		       $fairid=3;
			    if(@$confirm=="Y")  {
			  @$parti_flag = 1;
			  }
		 ?>
         
       SchoolCode : &nbsp;<?php echo @$school_details[0]['school_code'];?> 
       </th>
       <th  height="32" colspan="4" style="border-bottom:1px solid #AEAEAE;">SchoolName : &nbsp;<?php echo @$school_details[0]['school_name'];?> </th>
     </tr>
     
    
     <tr bgcolor="#FFFFFF" >
       <td colspan="2">Number of Escorting Teacher : 
       </td>
       <td width="71%" colspan="4"><span style="float:left;">
        <?php 
		//escorting_details
	
		$no_escorting_details = count($escorting_details);
		 $divname="'divEscTeachers'";
		$count_c =  "0";
		$count_c=@$escorting_details[0]['teachers_num'];
		
		@$school_details[0]['escorting_teachers'] = ($count_c>0)?$count_c:0;
		
		echo (@$parti_flag == '1') ? @$school_details[0]['escorting_teachers'] : form_input("escorting_teacher_num", @$school_details[0]['escorting_teachers'], 'class="inputbox1" id="escorting_teacher_num" maxlength="11" onkeypress="javascript:return numbersonly(this, event, false);" onblur="showEscortingTeachers(this.value,'.@$school_details[0]['escorting_teachers'].','.$divname.')"');?></td>
      
	  </span>        
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
					 
					
				<tr >
						<td align="left"    width="2%"><?php echo $itr; ?></td>
						<td align="left"    width="20%">&nbsp;&nbsp;<?php echo (@$parti_flag == '1') ? @$aryname[$itr][0] : form_input("escorting_teacher_name[".$itr."]", @$aryname[$itr][0], 'class="inputbox" id="escorting_teacher_name['.$itr.']" onkeypress="javascript:return toUppercase(event,this)" '); ?> 
 
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
						<select  size=1 name="<?php echo "designation[".$itr."]"; ?>" id="<?php echo "designation[".$itr."]"; ?>" >
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
       <td colspan="6">
       <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"  class="heading_tab" >
         <tr style="border-bottom:1px solid #AEAEAE;">
           <th width="1%"><span class="style1">Slno</span></th>
           <th width="22%" align="center"><span class="style1">Items</span></th>
           <th width="15%"><span class="style1">Name of Exhibit</span></th>
           
           <th width="22%"><span class="style1">Name of Participant (Initials after name)</span></th>
           <th width="8%"><span class="style1">Standard</span></th>
            <?php if(@$festid==4) {?>  
            <th width="10%" ><span class="style1">TYPE<br />(HSS/VHSS)</span></th>
			 <th width="10%" ><span class="style1">Group</span></th>					
  <?php  } ?>
           <th width="9%"><span class="style1">Admission No
/ Teachers (Pen/PF No)</span></th>
           <th width="7%"><span class="style1">Gender</span></th>
         <!--  <td width="10%" bgcolor="#E9E9D1"><span class="style1">Remarks</span></td>-->
         <?php  if(@$confirm=="N")  {if(@$parti_flag == '1') { ?>  
          <th width="8%"><span class="style1">Delete</span></th>
         <th width="5%"><span class="style1">Edit</span></th><?php }} ?>
         </tr>
         <?php 
		//  echo '<br><br><br><br>wwwww'.$code_item.'kkkkkkk';
		// print_r($item_details);
	   $r=0;
		 $item_count=(count($item_details));$itms ='';
	   $var_item=$item_count;
	   $var_item1=$item_count;
	  $lp_item_flag1 = 0;$lp_item_flag2 = 0;$lp_item_flag3 = 0;
	  
	 // if(@$school_details[0]['class_end']==4)$item_count=$item_count+1;
	  
	  
	   for($j=0;$j<$item_count;$j++){
	    
		
	   $var_item=$var_item1;
	   $item_name[$j]=$item_details[$j]['item_name'];
	   $item_code[$j]=$item_details[$j]['item_code'];
	  // if($item_code[$j]==188 && $parti_id>0 && $edit_delete=='edit')$max_participants[$j]=2;
	  // else $max_participants[$j]=$item_details[$j]['max_participants'];
	   $max_participants[$j]=$item_details[$j]['max_participants'];
	   $is_exhibit[$j]=$item_details[$j]['is_exhibit'];
	   $is_teach[$j]=$item_details[$j]['is_teach'];
	   $max=$max_participants[$j];
	   $k=0;
	   $spn=0;
	   
	   
	   /*if(@$school_details[0]['class_end']==4)
		{
		if($j==3)
		{
		 $item_name[$j]=$item_details[$j]['item_name']='Teaching Aid';
	   $item_code[$j]=$item_details[$j]['item_code']=194;
	    $max_participants[$j]=$item_details[$j]['max_participants']=1;
	   $is_exhibit[$j]=$item_details[$j]['is_exhibit']='';
	   $is_teach[$j]=$item_details[$j]['is_teach']='Y';
		}
		}*/
	   
	    if(($parti_id>0)){ echo '<input name="coun" type="hidden" value="1" id="cout" />';
		if($edit_delete=='edit')
		$part_item_details=$this->Socialscience_Model->get_details_4lp($schoolcode,$category,$fairid,$item_code[$j],$parti_id);
		else if($edit_delete=='delete')$part_item_details=$this->Registration_Model->get_details_itemcode($schoolcode,$category,$fairid,$item_code[$j]);
		//echo '<br><br><br>';
		//print_r($part_item_details);
		 //echo '<br>'.$schoolcode.'--'.$category.'---'.$fairid.'---'.$item_code[$j].'---'.$parti_id.'<br>';
		//print_r($part_item_details);
		
		} 
	   else {echo '<input name="coun" type="hidden" value="0" id="cout" />';$part_item_details=$this->Registration_Model->get_details_itemcode($schoolcode,$category,$fairid,$item_code[$j]);
	  
	   }
	   
	   $cnt_part_item_details = count($part_item_details);
	  if($category==1)
	  {
	  //echo '<br>$lp_item_flag1=='.$lp_item_flag1.'--$lp_item_flag2=='.$lp_item_flag2.'<br>';
	  	//if(( ($j==0 || $j==1 || $j==2) && $cnt_part_item_details == 0 ) )	continue;
	  	
	  		 if($j==0 && $cnt_part_item_details == 0){$lp_item_flag1 = 1;continue;}
		else if($j==1 && $cnt_part_item_details == 0){$lp_item_flag2 = 1;continue;}
		else if($j==2 && $cnt_part_item_details == 0){ if($lp_item_flag1 == 0 || $lp_item_flag2 == 0){$lp_item_flag3 = 1;continue;}}
	  }
	  
	
	  // $part_item_details=$this->Registration_Model->get_details_itemcode($schoolcode,$category,$fairid,$item_code[$j]);
		
		$r=0;
		?>
		<input name="max<?php echo $j;?>" type="hidden" value="<?php echo $max; ?>" id="max<?php echo $j;?>" />
		<input name="count" type="hidden" value="<?php echo $item_count; ?>" id="count" />
		<input name="it_code<?php echo $j;?>" type="hidden" value="<?php echo $item_code[$j]; ?>" id="it_code<?php echo $j;?>" />
		<input name="it_name<?php echo $j;?>" type="hidden" value="<?php echo $item_name[$j]; ?>" id="it_name<?php echo $j;?>" />
         
		<?php

 
	   while($max_participants[$j]!=0){
	  
	   if($is_exhibit[$j]	!=	'N')
	   {  $f	=	''; $ex_flag='notdisabled';} else { $f	=	'disabled'; $ex_flag='disabled';}
	   
	   if($item_code[$j] == 188 || $item_code[$j] == 192 || $item_code[$j] == 201 || $item_code[$j] == 202  || $item_code[$j] == 203  || $item_code[$j] == 205  || $item_code[$j] == 206 ||  $item_code[$j] == 211  || $item_code[$j] == 212  || $item_code[$j] == 213 )
	   { $quiz_flag	=	1; } else{ $quiz_flag	=	0;   }
	   
		
		//echo '<br><br><br>prti===='.$parti_id.'kkk';
		if(($parti_id > 0) && $edit_delete=='edit'){if($item_code[$j] == 185 || $item_code[$j] == 186 || $item_code[$j] == 187){$k=1;}else if($item_code[$j] == 100){$k=2;}}else $k = $max_participants[$j];
		
	  if(@$part_item_details[$r]['item_code']==$item_code[$j]){ 
	   ?>
       <input name="participant_item_id<?php echo $item_code[$j].$k;?>" type="hidden" value="<?php echo @$part_item_details[$r]['pi_id']; ?>" />
       <?php } ?>
       
       
         <tr <?php if($j%2==0) {?> bgcolor="#E6F7F5" <?php } else ?>  bgcolor="#FFFFFF" >
          <?php if($spn==0) {?> <td rowspan="<?php echo $k; ?>"><?php 
		    if($category==1){
		  	if($item_code[$j] == 188)echo 2;

			else if($item_code[$j] == 189)echo 3;
			else echo 1;
		  }
		  else echo $j+1;
		  
		  ?></td><?php }?>
           <?php if($spn==0) {?><td rowspan="<?php echo $k; ?>" >
		   <?php 
		    //echo @$part_item_details[$r]['item_code'];
		    //echo strtoupper($item_name[$j]);
		    if($item_code[$j]==185 || $item_code[$j]==186 || $item_code[$j]==187)
		   {
		  
		   $select185='';$select186='';$select187='';
		   if(@$part_item_details[$r]['item_code']==185)$select185='selected';
		   else if(@$part_item_details[$r]['item_code']==186)$select186='selected';
		   else if(@$part_item_details[$r]['item_code']==187)$select187='selected';
		   ?>
           <select name="lp_item_code" >
         
           <option  <?php echo $select185; ?> value="185">Collections</option>
           <option  <?php echo $select186; ?> value="186">Models</option>
           <option  <?php echo $select187; ?> value="187">Charts</option>
           </select> 
		   <?php
		   }
		   else echo strtoupper($item_name[$j]);
		   ?>
           <input name="item_code<?php echo $item_code[$j];?>" type="hidden" value="<?php echo $item_code[$j]; ?>" /></td><?php }  ?>
           
		            
		   <?php 
		   if($item_code[$j]==1850 || $item_code[$j]==1860 || $item_code[$j]==1870)
		   {
		   		?> <td rowspan="1"> 
				<?php
               $id1='exhibit_name'.$item_code[$j].$k;
               //echo "<br />".$id1;
               if(@$part_item_details[$r]['item_code']==$item_code[$j]){echo (@$parti_flag == '1') ? @$part_item_details[$r]['exhibit_name'] : form_input("exhibit_name".$item_code[$j].$k, @$part_item_details[$r]['exhibit_name'], 'class="inputbox"  id="'.$id1.'" maxlength="11" onkeypress="javascript:return toUppercase(event,this)"'.''.'');}else { echo (@$parti_flag == '1') ? @$part_item_details[$r]['exhibit_name'] : form_input("exhibit_name".$item_code[$j].$k,'', 'class="inputbox"  id="'.$id1.'"  maxlength="11" onkeypress="javascript:return toUppercase(event,this)"'.''.$f.'');}  ?>
                        
               </td> <?  
		   }
		   
		 else if($item_code[$j]==100)//188
		   {
		   	 if($parti_id >0 && $edit_delete=='edit')
			 {
			 	if($spn==0) {?> <td rowspan="<?php echo $k; ?>"> 
				<?php
               $id1='exhibit_name'.$item_code[$j];
               //echo "<br />".$id1;
               if($quiz_flag	==	0) {  if(@$part_item_details[$r]['item_code']==$item_code[$j]){echo (@$parti_flag == '1') ? @$part_item_details[$r]['exhibit_name'] : form_input("exhibit_name".$item_code[$j], @$part_item_details[$r]['exhibit_name'], 'class="inputbox"  id="'.$id1.'" maxlength="11" onkeypress="javascript:return toUppercase(event,this)"'.''.'');}else { echo (@$parti_flag == '1') ? @$part_item_details[$r]['exhibit_name'] : form_input("exhibit_name".$item_code[$j],'', 'class="inputbox"  id="'.$id1.'"  maxlength="11" onkeypress="javascript:return toUppercase(event,this)"'.''.$f.'');}  }?>
                        
               </td> <? } 
			 }
			 else
			 {
			 	if($spn==0 || $spn==2) {?> <td rowspan="2"> 
				<?php
               $id1='exhibit_name'.$item_code[$j];
               
			   
               if($quiz_flag	==	0 ) {  if(@$part_item_details[$r]['item_code']==$item_code[$j]){echo (@$parti_flag == '1') ? @$part_item_details[$r]['exhibit_name'] : form_input("exhibit_name".$item_code[$j], @$part_item_details[$r]['exhibit_name'], 'class="inputbox"  id="'.$id1.'" maxlength="11" onkeypress="javascript:return toUppercase(event,this)"'.''.'');}else { echo (@$parti_flag == '1') ? @$part_item_details[$r]['exhibit_name'] : form_input("exhibit_name".$item_code[$j],'', 'class="inputbox"  id="'.$id1.'"  maxlength="11" onkeypress="javascript:return toUppercase(event,this)"'.''.$f.'');}  }?>
                        
               </td> <? } 
			 }
		   }
		   else
		   {
		   		 if($spn==0 ) {?> <td rowspan="<?php echo $k; ?>"> 
				<?php
               $id1='exhibit_name'.$item_code[$j];
               //echo "<br />".$id1;
               if($quiz_flag	==	0) {  if(@$part_item_details[$r]['item_code']==$item_code[$j]){echo (@$parti_flag == '1') ? @$part_item_details[$r]['exhibit_name'] : form_input("exhibit_name".$item_code[$j], @$part_item_details[$r]['exhibit_name'], 'class="inputbox"  id="'.$id1.'" maxlength="11" onkeypress="javascript:return toUppercase(event,this)"'.''.'');}else { echo (@$parti_flag == '1') ? @$part_item_details[$r]['exhibit_name'] : form_input("exhibit_name".$item_code[$j],'', 'class="inputbox"  id="'.$id1.'"  maxlength="11" onkeypress="javascript:return toUppercase(event,this)"'.''.$f.'');}  }?>
                        
               </td> <? } 
		   }
		   ?>
           
            
           
          <td><?php 
		  $id1='name_participant'.$item_code[$j].$k; 
		  if(@$part_item_details[$r]['item_code']==$item_code[$j]){echo (@$parti_flag == '1') ? @$part_item_details[$r]['participant_name'] : form_input("name_participant".$item_code[$j].$k, @$part_item_details[$r]['participant_name'], 'class="inputbox"  maxlength="30" size="35" id="'.$id1.'" onkeypress="javascript:return toUppercase(event,this)"'.''.'');}else { echo (@$parti_flag == '1') ? @$part_item_details[$r]['participant_name'] : form_input("name_participant".$item_code[$j].$k,'', 'class="inputbox"  maxlength="30" size="35" id="'.$id1.'" onkeypress="javascript:return toUppercase(event,this);" ');}
		   ?></td>
          
          <td><?php 
		   $id1='txtStandard'.$item_code[$j].$k; 
		   if($is_teach[$j] != 'Y' ) {
		  if(@$part_item_details[$r]['item_code']==$item_code[$j]){echo (@$parti_flag == '1') ? @$part_item_details[$r]['class'] : form_dropdown("txtStandard".$item_code[$j].$k, $classsectionary, @$part_item_details[$r]['class'],'class="inputbox1"  id="'.$id1.'" '); }else { echo (@$parti_flag == '1') ? @$part_item_details[$r]['class'] : form_dropdown("txtStandard".$item_code[$j].$k, $classsectionary, '','class="inputbox1"  id="'.$id1.'" '); }
		  }
		  
		   if($is_teach[$j] == 'Y' ){
		   ?>
           <input type="hidden" name="<?php echo 'txtStandard'.$item_code[$j].$k; ?>" value="0"  id="<?php echo 'txtStandard'.$item_code[$j].$k; ?>"   />
           <?php
		   		  
		  }
		  ?></td>
          
            <?php if(@$festid==4) {
		   @$admn_fest=str_split(@$part_item_details[$r]['admn_no'],1);
		 if(@$admn_fest[0]=="H")
		 {
		 $disabled = "";
		 @$admn_fest="HSS";
		 }
		 else if(@$admn_fest[0]=="V")
		 {
		 @$admn_fest="VHSS";
		  $disabled = " disabled ";
		 }
		 else
		 {
		 @$admn_fest="";
		  $disabled = "disabled";
		 }
		 
		  if(@$part_item_details[$r]['group_category'] == 'C') {$group='Commerce';}
		   else if(@$part_item_details[$r]['group_category'] == 'H') {$group='Humanities';}
		   else {echo $group='';}
		   
		   ?> <td><?php 
		   $hid=$item_code[$j].$k;
		   $id1='admn_category'.$item_code[$j].$k; 
		   if(@$part_item_details[$r]['item_code']==$item_code[$j]){echo (@$parti_flag == '1') ? @$admn_fest : form_dropdown("admn_category".$item_code[$j].$k, $admn_category, @$admn_fest[0],'class="inputbox" onChange="getHssGroup('.$hid.');"  id="'.$id1.'" '); }else { echo (@$parti_flag == '1') ? @$admn_fest : form_dropdown("admn_category".$item_code[$j].$k, $admn_category, '','class="inputbox"  id="'.$id1.'" onChange="getHssGroup('.$hid.');"  '); }?></td>
		    <td><?php 
		   $id1='group_category'.$item_code[$j].$k; 
		   $arygroup_category=array('0'=>'Others','C'=>'Commerce','H'=>'Humanities');
		   if(@$part_item_details[$r]['item_code']==$item_code[$j]){echo (@$parti_flag == '1') ? $group : form_dropdown("group_category".$item_code[$j].$k, $arygroup_category, @$part_item_details[$r]['group_category'],'class="inputbox" "'.$disabled.'" id="'.$id1.'" '); }else { echo (@$parti_flag == '1') ? $group : form_dropdown("group_category".$item_code[$j].$k, @$arygroup_category, '','class="inputbox" "'.$disabled.'" id="'.$id1.'" '); }?></td>
		   <?php }  ?>
          <td>
         <input name="exhibitFlag_<?php echo $item_code[$j]; ?>_<?php echo $k; ?>" id="exhibitFlag_<?php echo $item_code[$j]; ?>_<?php echo $k; ?>" type="hidden" value="<?php echo $ex_flag; ?>" />
            <input name="max_participant_<?php echo $item_code[$j]; ?>_<?php echo $k; ?>"  id="max_participant_<?php echo $item_code[$j]; ?>_<?php echo $k; ?>" type="hidden" value="<?php echo $item_details[$j]['max_participants']; ?>" />
            
             <input name="participant_id<?php echo $item_code[$j]; ?><?php echo $k; ?>"  id="participant_id<?php echo $item_code[$j]; ?>_<?php echo $k; ?>" type="hidden" value="<?php echo @$part_item_details[$r]['participant_id']; ?>" />
             <?php 
			 if(@$part_item_details[$r]['team_no']<>'')$team=@$part_item_details[$r]['team_no'];
			 else $team='';
			 ?>
             <input name="team_<?php echo $item_code[$j]?>_<?php echo $k; ?>"  id="team_<?php echo $item_code[$j]?>_<?php echo $k; ?>" type="hidden" value="<?php echo @$team; ?>" />
             
            <? $admn_hid='adm_no_hid'.$item_code[$j].$k;  //echo $admn_hid;  ?>
            
            <input name="<?php echo $admn_hid; ?>"  id="<?php echo $admn_hid; ?>" type="hidden" value="<?php echo @$part_item_details[$r]['admn_no']; ?>" />
            
		    <?php  $id1='adm_no'.$item_code[$j].$k; 
		   if(@$part_item_details[$r]['item_code']==$item_code[$j]){ echo (@$parti_flag == '1') ? @$part_item_details[$r]['admn_no'] : form_input("adm_no".$item_code[$j].$k, @$part_item_details[$r]['admn_no'], 'class="inputbox" id="'.$id1.'" maxlength="11"  size="4"    onKeyUp="white_space(this.id)" onBlur="javascript:fetch_admision_no_details_array('.$item_code[$j].$k.')"  '); }
		   else{ echo (@$parti_flag == '1') ? @$part_item_details[$r]['admn_no'] : form_input("adm_no".$item_code[$j].$k, '', 'class="inputbox" id="'.$id1.'" maxlength="11"  size="4" onKeyUp="white_space(this.id)"  onBlur="javascript:fetch_admision_no_details_array('.$item_code[$j].$k.')" ');} ?></td>
          
          
           <td><?php 
		   if(@$part_item_details[$r]['gender'] == 'B') {$sex='Boy';}
		   else if(@$part_item_details[$r]['gender'] == 'G') {$sex='Girl';}
		   else {echo $sex='';}
		    $id1='txtgender'.$item_code[$j].$k; 
		   if(@$part_item_details[$r]['item_code']==$item_code[$j]){echo (@$parti_flag == '1') ? @$sex : form_dropdown("txtgender".$item_code[$j].$k, array(0=>'Gender', 'B' => 'Boy', 'G' => 'Girl'), @$part_item_details[$r]['gender'],'class="inputbox"  id="'.$id1.'" '); }else { echo (@$parti_flag == '1') ? @$sex : form_dropdown("txtgender".$item_code[$j].$k, array(0=>'Gender', 'B' => 'Boy', 'G' => 'Girl'), '','class="inputbox"  id="'.$id1.'" ');}
		   ?></td>
          
         <!--  <td >
		   <?php //if(@$part_item_details[$r]['item_code']==$item_code[$j]){ if(@$parti_flag == '1') { echo @$part_item_details[$r]['remarks']; } else {?><textarea class="text-input textarea"  id="remarks" name="remarks<?php //echo @$item_code[$j].$k;?>" rows="1" cols="15" onkeypress="return toUppercase(event,this)"><?php //echo  @$part_item_details[$r]['remarks'];?></textarea> <?php //} }else { if(@$parti_flag == '1') { echo @$part_item_details[$r]['remarks']; } else {?><textarea class="text-input textarea" id="remarks" name="remarks<?php //echo @$item_code[$j].$k;?>" rows="1" cols="15" onkeypress="return toUppercase(event,this)"></textarea> <?php //} }?></td>-->
		   
		   <?php 
		   
		   
  if((@$confirm=="N") && (@$parti_flag == '1'))  {
   
	  if($item_code[$j]==1850 || $item_code[$j]==1860 || $item_code[$j]==1870){
	   
		  ?> 
		
		  
		  <td rowspan="1"><?php if(@$part_item_details[$r]['admn_no']) {?><a href="#" onClick="return deleteParticipant(<?php echo "'".$item_code[$j]."'";?>,<?php echo "'".$part_item_details[$r]['admn_no']."'";?>,<?php echo "'".$part_item_details[$r]['team_no']."'";?>);"><img src="<?php echo base_url()?>images/icon_cross.png"width="20" height="20"></a><?php } ?></td>
		    <td rowspan="1"><?php if(@$part_item_details[$r]['admn_no']) {?><a href="javascript:void(0);"  onclick="javascript:return editParticipant(<?php echo "'".$item_code[$j]."'";?>,<?php echo "'".$part_item_details[$r]['team_no']."'";?>);"><img src="<?php echo base_url()?>images/edit.gif" width="20" height="20"></a><?php }?></td>
		  <?php 
		  
	  }
	  else if($item_code[$j]==100){
	  	if($parti_id >0 && $edit_delete=='edit')
		{
		?>
         <td ><?php if(@$part_item_details[$r]['admn_no']) {?><a href="#" onClick="return deleteParticipant(<?php echo "'".$item_code[$j]."'";?>,<?php echo "'".$part_item_details[$r]['admn_no']."'";?>,<?php echo "'".$part_item_details[$r]['team_no']."'";?>);"><img src="<?php echo base_url()?>images/icon_cross.png"width="20" height="20"></a><?php } ?></td>
        <?php 
			if($spn==0) {?> 
		  
		   <td rowspan="<?php echo $k;?>"><?php if(@$part_item_details[$r]['admn_no']) {?><a href="javascript:void(0);"  onclick="javascript:return editParticipant(<?php echo "'".$item_code[$j]."'";?>,<?php echo "'".$part_item_details[$r]['team_no']."'";?>);"><img src="<?php echo base_url()?>images/edit.gif" width="20" height="20"></a><?php }?></td>
		  <?php 
		 }
		}
		else
		{
		?>
         <td ><?php if(@$part_item_details[$r]['admn_no']) {?><a href="#" onClick="return deleteParticipant(<?php echo "'".$item_code[$j]."'";?>,<?php echo "'".$part_item_details[$r]['admn_no']."'";?>,<?php echo "'".$part_item_details[$r]['team_no']."'";?>);"><img src="<?php echo base_url()?>images/icon_cross.png"width="20" height="20"></a><?php } ?></td>
        <?php 
		
		
			if($spn==0 || $spn==2) {?> 
		        
		   <td rowspan="2"><?php if(@$part_item_details[$r]['admn_no']) {?><a href="javascript:void(0);"  onclick="javascript:return editParticipant(<?php echo "'".$item_code[$j]."'";?>,<?php echo "'".$part_item_details[$r]['team_no']."'";?>);"><img src="<?php echo base_url()?>images/edit.gif" width="20" height="20"></a><?php }?></td>
		  <?php 
		 }
		}
	  }
	  else
	  {
	  	?>
        <td ><?php if(@$part_item_details[$r]['admn_no']) {?><a href="#" onClick="return deleteParticipant(<?php echo "'".$item_code[$j]."'";?>,<?php echo "'".@$part_item_details[$r]['admn_no']."'";?>,<?php echo 0; ?>);"><img src="<?php echo base_url()?>images/icon_cross.png"width="20" height="20"></a><?php } ?></td>
        <?php 
	  	if($spn==0) {?> 
        
		  <td rowspan="<?php echo $k; ?>"><?php if(@$part_item_details[$r]['admn_no']) {?><a href="javascript:void(0);"  onclick="javascript:return editParticipant(<?php echo "'".$item_code[$j]."'";?>);"><img src="<?php echo base_url()?>images/edit.gif" width="20" height="20"></a><?php }?></td>
		  
		  <?php 
		}
	  } 
	 
   
   }?>
        </tr>
        
                
         
         <?php  
		 if(($parti_id>0 && $edit_delete=='edit')){if($item_code[$j]==1850 || $item_code[$j]==1860 || $item_code[$j]==1870){$max_participants[$j]=0;}else if($item_code[$j]==100){$max_participants[$j]=$max_participants[$j]-1;}}
		 else $max_participants[$j]=$max_participants[$j]-1; 
		       
			 //$max_participants[$j]=$max_participants[$j]-1; 
			 $itms .= $item_code[$j].'_'.$k.'#';	  	   
		 $spn=$spn+1;
		$r=$r+1;
		 }
		
		 }
		 
		if(@$school_details[0]['class_end']==4)
		{
		$teachingaid=$this->Registration_Model->get_teachingaid($schoolcode,$fairid,$category);
		//print_r($teachingaid);
		$edit_teaching_flag=0;
		if(@$edit_item==1)
		{
			if(@$code_item==194)$edit_teaching_flag=0;
			else $edit_teaching_flag=1;
		}
		
		if($edit_teaching_flag==0){
		?>
        <tr>
        <td>3</td><td>Teaching Aid</td>
        <input name="participant_item_id_sc1" id="participant_item_id_sc1" type="hidden" value="<?php echo @$teachingaid[0]['participant_id']; ?>" />
        <input name="item_code_sc1" id="item_code_sc1" type="hidden" value="<?php echo 194; ?>" />
        <td><?php if(@$parti_flag == '1'){echo @$teachingaid[0]['exhibit_name'];}else{?><input class="inputbox" name="exhibit_name_sc1" id="exhibit_name_sc1" type="text" value="<?php echo @$teachingaid[0]['exhibit_name']; ?>" /><?php } ?></td>
        <td><?php if(@$parti_flag == '1'){echo @$teachingaid[0]['participant_name'];}else{?><input class="inputbox"   size="35"  name="participant_name_sc1" id="participant_name_sc1" type="text" value="<?php echo @$teachingaid[0]['participant_name']; ?>" /><?php } ?></td>
        <td>&nbsp;</td>
        <td><?php if(@$parti_flag == '1'){echo @$teachingaid[0]['admn_no'];}else{?><input class="inputbox" name="admn_no_sc1" id="admn_no_sc1" type="text" value="<?php echo @$teachingaid[0]['admn_no']; ?>" onKeyUp="white_space(this.id)"  size="4" /><?php } ?></td>
       <td>
        <?php if(@$parti_flag == '1'){if(@$teachingaid[0]['gender']=='B')echo 'Boy';else if(@$teachingaid[0]['gender']=='G')echo 'Girl';}else{
		$select='';$select1='';
		if(@$teachingaid[0]['gender']=='B'){$select='selected';$select1='';}else if(@$teachingaid[0]['gender']=='G'){$select='';$select1='selected';};
		?>
        <select class="inputbox" name="gender_sc1" id="gender_sc1" >
        <option value="0">Select</option>
        <option <?php echo $select ?> value="B">Boy&nbsp;&nbsp;&nbsp;&nbsp;</option>
        <option <?php echo $select1 ?> value="G">Girl</option>
        </select><?php } ?></td>
        <?php if(@$parti_flag == '1'){?>
        <td><?php if(@$teachingaid[0]['admn_no']){ ?><a href="#" onClick="return deleteParticipant(<?php echo 194;?>,<?php echo "'".@$teachingaid[0]['admn_no']."'";?>,<?php echo 1; ?>);" ><img src="<?php echo base_url()?>images/icon_cross.png"width="20" height="20"></a><?php } ?></td>
        <td><?php if(@$teachingaid[0]['admn_no']){ ?><a href="javascript:void(0);"   onclick="javascript:return editParticipant(<?php echo 194;?>);"><img src="<?php echo base_url()?>images/edit.gif" width="20" height="20"></a><?php } ?></td>
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
		   //onClick="javascript:return socialsciencemathsValidate()"
		   $sub_district_details=$this->School_Details_Model->getSubDistrictDetails($this->session->userdata('SUB_DISTRICT'));
		     if(@$confirm=="N" && @$sub_district_details[0]['social_confirm_data_entry']=="N")  {echo (@$parti_flag == '1') ? form_button('Edit', 'Edit', 'class="btnalt" onClick="javascript:fncEditPartDeatils()"').'&nbsp;&nbsp;'.form_button('Print', 'Print', 'class="btnalt" onClick="javascript:goto_print()"') : form_submit('Save', 'Save', 'class="btnalt"  onClick="javascript:return socialsciencemathsValidate();" ');}
		    else {
			  echo  form_button('Print', 'Print', 'class="btnalt" onClick="javascript:goto_print()"');				
			
			}
		   
		   
		   
		   ?> </td>
     </tr>
   </table>
 </div>

<?php 
echo form_close();
}
?>