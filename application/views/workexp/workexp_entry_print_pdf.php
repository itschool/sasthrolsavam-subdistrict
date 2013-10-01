<page backtop="20mm" backbottom="50mm">
<page_header>

<table style="width: 100%;">
			<tr>
				<!--<td style="text-align: left; width: 50%">
					<img src="<?php //echo image_url().'logo.jpg'?>">
				</td>-->
				<td style="width: 100%" align="center"><strong><?PHP echo strtoupper(@$school_details[0]['sub_district_name']);?>&nbsp;SUBDISTRICTSCHOOLS<br />
			    WORKEXPERIENCE <?php if(@$heading){ echo strtoupper(@$heading);} else { echo "ON THE SPOT"; }?> FAIR 2013-14<br />
				</strong></td>
		  </tr>
            <tr>
				<td style="width: 100%" align="center">
                <?php 
					//echo @$school_details[0]['sub_district_name'].' Subdistrict';
					echo (@$cluster[0]['name']) ? '(Cluster : '.@$cluster[0]['name'].')' : '';
				?>
                
                </td>
			</tr>
			<tr>
				<td style="width: 100%"><hr/></td>
			</tr>
		</table>
        
	</page_header>
    
<page_footer>
  
		<table width="80%" cellpadding="5" cellspacing="0" border="0" align="left">
    		
		<tr>
        	<td style="text-align:center"  colspan="3" width="500">
			   	Certified that above details has been verified and found correct
                <br /><br /><br />            </td>
        </tr>
		<tr>
		  <td height="30"  colspan="3" align="center">&nbsp;</td>
		  </tr>
		<tr>
		  <td   colspan="3">        </td>
		  </tr>
        
        <tr>
        	<td style="text-align:left">
            	Place&nbsp;:&nbsp;..............................<br /><br />
                Date&nbsp;&nbsp;:&nbsp;.............................            </td>
            <td align="center" >
            	<br /><br /></td>
        	<td style="text-align:right" width="600">
            	<br /><br />
            	Name &amp; Signature of the Head of the Institution</td>
        </tr>
        <tr>
          <td colspan="3" align="left"> <?php 
			   
			  echo " Report confirmed on ".$school_details[0]['workexp_confirmTime'];
		  echo " and Report Taken on ".date("F j, Y, g:i a");
				?></td>
          </tr>
    </table>
	
<table style="width: 100%;">
			<tr>
				<td style="width: 100%"><hr/></td>
			</tr>
			<tr>
				<td style="text-align: center;width: 100%">page [[page_cu]]/{nb} </td>
			</tr>
		</table>
	</page_footer>

	<table width="100%"  align="center" cellpadding="0" cellspacing="1" style="margin-top:15px;">
   <tr><td><table style="width:100%">
     <tr style="border-bottom:1px solid #666666;">
       <td width="19%" height="20" bgcolor="#FFFFFF">School Code :</td>
       <td height="20" bgcolor="#FFFFFF"><?php echo @$school_details[0]['school_code']?>
           <input type="hidden" name="hidschool" id="hidschool" value="<? echo @$school_details[0]['school_code'] ; $schoolcode=@$school_details[0]['school_code'];?>" />
           <input name="base_url" type="hidden" id="base_url" value="<?php echo base_url();?>" />       </td>
       <td height="20" bgcolor="#FFFFFF">&nbsp;&nbsp;&nbsp;SchoolName: <?php echo @$school_details[0]['school_name']?></td>
       <td height="20"  colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
     </tr>
     <tr >
       <td height="20" bgcolor="#FFFFFF"  class="table_row_first">School Phone(with STD code) : </td>
       <td height="20" colspan="5" bgcolor="#FFFFFF"  class="table_row_first"><?php echo @$school_details[0]['school_phone']?> </td>
     </tr>
     <tr style="border-bottom:1px solid #666666;">
       <td height="20" bgcolor="#FFFFFF">E-mail : </td>
       <td height="20" colspan="5" bgcolor="#FFFFFF"><?php echo @$school_details[0]['school_email']?></td>
     </tr>
     <tr style="border-bottom:1px solid #666666;">
       <td height="20" bgcolor="#FFFFFF">Standard : </td>
       <td width="15%" height="20" bgcolor="#FFFFFF">From : <?php echo @$school_details[0]['class_start']?></td>
       <td height="20" bgcolor="#FFFFFF">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;To : <?php echo @$school_details[0]['class_end']?></td>
       <td width="1%" height="20" bgcolor="#FFFFFF">&nbsp;</td>
       <td width="8%" height="20" bgcolor="#FFFFFF">&nbsp;</td>
       <td width="45%" height="20" bgcolor="#FFFFFF"></td>
     </tr>
     <tr style="border-bottom:1px solid #666666;">
       <td height="20" bgcolor="#FFFFFF">School Type :</td>
       <td height="20" colspan="5" bgcolor="#FFFFFF"><?php 
		if(@$school_details[0]['school_type'] == 'G') 
			$type	=	'Government';
		else if(@$school_details[0]['school_type'] == 'A') 
			 $type	= 	'Aided';
		else if(@$school_details[0]['school_type'] == 'U') 
			$type	= 	'Unaided' ;
		else
			$type	= '';
		?>
           <?php echo @$type;?> </td>
     </tr>
     <tr style="border-bottom:1px solid #666666;">
       <td height="20" bgcolor="#FFFFFF">Principal :</td>
       <td height="20" bgcolor="#FFFFFF"><?php echo @$school_details[0]['principal_name'];?> </td>
       <td width="12%" height="20" bgcolor="#FFFFFF">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Phone : &nbsp;&nbsp;<?php echo @$school_details[0]['principal_phone'];?></td>
       <td height="20" colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
     </tr>
     <tr style="border-bottom:1px solid #666666;">
       <td height="20" bgcolor="#FFFFFF">Headmaster : </td>
       <td height="20" bgcolor="#FFFFFF"><?php echo @$school_details[0]['hm_name'];?></td>
       <td height="20" bgcolor="#FFFFFF">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Phone :&nbsp;&nbsp; <?php echo @$school_details[0]['hm_phone'];?></td>
       <td height="20" colspan="3" bgcolor="#FFFFFF">&nbsp;</td>
     </tr>
     <tr style="border-bottom:1px solid #666666;">
       <td height="20" bgcolor="#FFFFFF">Total number of students :</td>
       <td height="20" colspan="5" bgcolor="#FFFFFF"><?php 
				$lp		=	@$school_details[0]['strength_lp'];
				$up		=	@$school_details[0]['strength_up'];
				$hs		=	@$school_details[0]['strength_hs'];
				$hss	=	@$school_details[0]['strength_hss'];
				$vhss	=	@$school_details[0]['strength_vhss'];	
			?>
           LP&nbsp;:&nbsp; <?php echo $lp?>
         
       
        
        UP&nbsp;:&nbsp; <?php echo $up?> HS&nbsp;:&nbsp; <?php echo $hs?> &nbsp;HSS :&nbsp;<?php echo $hss?> VHSS&nbsp;:&nbsp; <?php echo $vhss?>  &nbsp;&nbsp;</td>
       </tr>
    
   </table></td>
       </tr>
     <tr>
       <td><table style="width:100%" >

         <tr >
           <td height="20" colspan="2" bgcolor="#FFFFFF" class="style4">Number of Boys Participated&nbsp;&nbsp;&nbsp;: &nbsp;&nbsp;<? echo $this->Registration_Model->fair_count($fairid,@$schoolcode,'B');?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Number of Girls Participated&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;<? echo $this->Registration_Model->fair_count($fairid,@$schoolcode,'G');?></td>
          </tr>
         <tr >
           <td height="20" bgcolor="#FFFFFF">Number of Escorting Teacher &nbsp;:&nbsp;&nbsp;&nbsp;             <?php 
		//escorting_details
		$no_escorting_details = count($escorting_details);
		 echo @$escorting_details[0]['teachers_num'];
		 $count_c =  "0";
		$count_c=@$escorting_details[0]['teachers_num'];
		//echo $count_c;
		@$school_details[0]['escorting_teachers'] = ($count_c>0)?$count_c:0;?></td>
           <td width="42%" height="20" bgcolor="#FFFFFF">&nbsp;</td>
         </tr>
         <tr>
           <td colspan="2" bgcolor="#FFFFFF">	             </td>
         </tr>

        <tr>
          <tr>
           <td colspan="2">          </td>
         </tr>
      </tr>
       </table>
        <?php 
				$lp_count		=	count(@$count_lp);
				$up_count		=	count(@$count_up);
				$hs_count		=	count(@$count_hs);
				$hss_count		=	count(@$count_hss);
				
			?>
       </td>
     </tr>
     <tr>
       <td bgcolor="#FFFFFF">&nbsp;</td>
     </tr>
     <tr>
       <td bgcolor="#FFFFFF"><?php 
		//escorting_details
		$no_escorting_details = count($escorting_details);
		 //echo $no_escorting_details+1;
		 $count_c =  "0";
		$count_c=@$escorting_details[0]['teachers_num'];
		//echo $count_c;
		@$school_details[0]['escorting_teachers'] = ($count_c>0)?$count_c:0;?>
         <?php 
	   if(@$no_escorting_details > 0)
        {
				$i_limit=$count_c+1;
				
				$escorting_teacher_details = explode('#@#',@$escorting_details[0]['escorting_teachers']); 
				?>
                <table width="726" border="0" align="center">
                <tr><td colspan="4"> <strong>Escorting Teachers Details </strong></td>
              </tr>
              <tr><td colspan="4"></td></tr> 
                
                <?
				
				for($itr=1;$itr<=$count_c;$itr++)
				{
					$aryname[$itr]= explode('#$#',@$escorting_teacher_details[$itr-1]); 
					
					
					?>
               
              <?php if($itr==1){?>  
            <tr>
                    <td width="29%" height="10" bgcolor="#FFFFFF" >Name</td>
              <td width="55%" height="10" bgcolor="#FFFFFF" >Designation</td>
              <td width="16%" height="10" bgcolor="#FFFFFF">Phone</td>
                    
                 </tr>
                 <?php }else
				  ?><tr>
                  <td height="10" bgcolor="#FFFFFF" style="width:30%" ></td>
                   <td height="10"bgcolor="#FFFFFF" style="width:40%" ></td>
                   <td height="10"bgcolor="#FFFFFF" style="width:25%" ></td>
                   
                  </tr>
                 
                 <tr>
                   <td height="10" bgcolor="#FFFFFF" style="width:30%"><?php echo  @$aryname[$itr][0];?>                   </td>
                   <td height="10"bgcolor="#FFFFFF" style="width:40%"><?php 
					
						
							foreach($designations as $row=>$values)
							{
							if(@$aryname[$itr][1]==$values['designation_code'])echo $values['designation'];
							
							}
						
						?>                   </td>
                   <td height="10" bgcolor="#FFFFFF" style="width:25%"><?php echo @$aryname[$itr][2]; ?>                   </td>
                   
                 </tr>
         
       <?php
				} ?>
          </table>
	  <? }	
	  ?></td>
     </tr> 
    
       <?php if($lp_count!=0){?>
     <tr>
       <td><table border="1" cellspacing="0" cellpadding="4" align="center"  style="width:100%; border:solid 1px #000000;">
         <tr>
           <td height="15" colspan="7" bgcolor="#FFFFFF" style="text-align:left"><strong>LP SECTION</strong><br />          </td>
          </tr>
         <tr>
           <td height="15" bgcolor="#FFFFFF"  style="width:6%;border-right: solid 1px #000000; padding:2px;border-top: solid 1px #000000; padding:2px"><span class="style1"><strong>Slno</strong></span></td>
           <td height="15" bgcolor="#FFFFFF" style="width:30%;border-right:1px #000000; padding:2px;border-top: solid 1px #000000; padding:2px"><span class="style1"><strong>Items</strong></span></td>
           <td height="15" bgcolor="#FFFFFF" style="width:30%;border-right:1px #000000; padding:2px;border-top: solid 1px #000000; padding:2px"><span class="style1"><strong>Name of Participant</strong></span></td>
           <td height="15" bgcolor="#FFFFFF" style="width:8%;border-right:1px #000000; padding:2px;border-top: solid 1px #000000; padding:2px"><span class="style1"><strong>Std</strong></span></td>
           <td height="15" bgcolor="#FFFFFF" style="width:20%;border-right:1px #000000; padding:2px;border-top: solid 1px #000000; padding:2px; text-align:left"><span class="style1"><strong>Admn Number</strong></span></td>
           <td height="15" bgcolor="#FFFFFF" style="width:8%;border-top: solid 1px #000000; padding:2px"><span class="style1"><strong>Gender</strong></span></td>
         </tr>
         <?php 

		
		 $item_count=(count($item_details_lp));
	   $var_item=$item_count;
	   $var_item1=$item_count;
	   $slno=0;
	   for($j=0;$j<$item_count;$j++){
	   
	   $var_item=$var_item1;
	   $item_name[$j]=$item_details_lp[$j]['item_name'];
	   $item_code[$j]=$item_details_lp[$j]['item_code'];
	   $max_participants[$j]=$item_details_lp[$j]['max_participants'];
	   $max=$max_participants[$j];
	  	$k=0;
	   $spn=0;
	 $part_item_details_lp=$this->Registration_Model->get_details_itemcode($schoolcode,1,$fairid,$item_code[$j]);
	if(@$part_item_details_lp[0]['admn_no']){
	$slno++;
	$r=0;
	  while($max_participants[$j]!=0){
	  $k=$max_participants[$j];
?>

         <tr <?php if($j%2==0) {?> <?php } ?>>
           <?php if($spn==0) {?>
           <td height="25" rowspan="<?php echo $k; ?>" bgcolor="#FFFFFF" style="width:6%;border-right:1px #000000; padding:2px;border-top: solid 1px #000000; padding:2px"><span class="style5"><?php echo $slno;?></span></td>
           <?php }?>
           <?php if($spn==0) {?>
           <td height="25" rowspan="<?php echo $k; ?>" bgcolor="#FFFFFF" style="width:30%;border-right:1px #000000; padding:2px;border-top: solid 1px #000000; padding:2px"><?php echo strtoupper(@$part_item_details_lp[$r]['item_name']);?>
              <input name="item_code<?php echo $item_code[$j];?>" type="hidden" value="<?php echo $item_code[$j]; ?>" /></td>
           <?php }?>
           <td height="25" bgcolor="#FFFFFF" style="width:30%;border-right:1px #000000; padding:2px;border-top: solid 1px #000000; padding:2px">
               <?php 
		   
		  /* if(@$part_item_details_lp[$r]['item_code']==$item_code[$j])*/{echo @$part_item_details_lp[$r]['participant_name'];}
		   ?></td>
           <td height="25" bgcolor="#FFFFFF" style="width:8%;border-right:1px #000000; padding:2px; text-align:center;border-top: solid 1px #000000; padding:2px"><?php 
		  /* if(@$part_item_details_lp[$r]['item_code']==$item_code[$j])*/{echo  @$part_item_details_lp[$r]['class']; }?></td>
          
         
           <td height="25" bgcolor="#FFFFFF" style="width:20%;border-right:1px #000000; padding:2px; text-align:left;border-top: solid 1px #000000; padding:2px"><?php  
		  /* if(@$part_item_details_lp[$r]['item_code']==$item_code[$j])*/{ echo @$part_item_details_lp[$r]['admn_no'];} ?></td>
           <td height="15" bgcolor="#FFFFFF" style="width:8%; text-align:left;border-top: solid 1px #000000; padding:2px"><?php 
		   if(@$part_item_details_lp[$r]['gender'] == 'B') {$sex='Boy';}
		   else if(@$part_item_details_lp[$r]['gender'] == 'G') {$sex='Girl';}
		   else {echo $sex='';}
		  /* if(@$part_item_details_lp[$r]['item_code']==$item_code[$j])*/{echo  @$sex;}
		   ?></td>
         </tr>
        
         <?php 
		
		 $max_participants[$j]=$max_participants[$j]-1;
		 
		 $spn=1;
		$r=$r+1;
		 }
		 }
		?>
		
		<?php }?>
       </table></td>
     </tr>
     <?php } ?>
    <tr>
       <td bgcolor="#FFFFFF">&nbsp;</td>
     </tr>
       <?php if($up_count!=0){?>
     <tr>
       <td><table border="1" cellspacing="0" cellpadding="4" align="center"  style=" width:100%; border:solid 1px #000000;">
         <tr>
           <td height="15" colspan="7" bgcolor="#FFFFFF" style="text-align:left"><strong>UP SECTION</strong></td>
         </tr>
         <tr>
         <td height="15" bgcolor="#FFFFFF"  style="width:6%;border-right: solid 1px #000000; padding:2px;border-top: solid 1px #000000; padding:2px"><span class="style1"><strong>Slno</strong></span></td>
           <td height="15" bgcolor="#FFFFFF" style="width:30%;border-right: solid 1px #000000; padding:2px;border-top: solid 1px #000000; padding:2px"><span class="style1"><strong>Items</strong></span></td>
           <td height="15" bgcolor="#FFFFFF" style="width:30%;border-right: solid 1px #000000; padding:2px;border-top: solid 1px #000000; padding:2px"><span class="style1"><strong>Name of Participant</strong></span></td>
           <td height="15" bgcolor="#FFFFFF" style="width:8%;border-right: solid 1px #000000; padding:2px;border-top: solid 1px #000000; padding:2px"><span class="style1"><strong>Std</strong></span></td>
           <td height="15" bgcolor="#FFFFFF" style="width:20%;border-right: solid 1px #000000; padding:2px;border-top: solid 1px #000000; padding:2px; text-align:left"><span class="style1"><strong>Admn Number</strong></span></td>
           <td height="15" bgcolor="#FFFFFF" style="width:8%;border-top: solid 1px #000000; padding:2px"><span class="style1"><strong>Gender</strong></span></td>
         </tr>
         <?php 

		
		 $item_count=(count($item_details_up));
	   $var_item=$item_count;
	   $var_item1=$item_count;
	   $slno=0;
	   for($j=0;$j<$item_count;$j++){
	  
	   $var_item=$var_item1;
	   $item_name[$j]=$item_details_up[$j]['item_name'];
	   $item_code[$j]=$item_details_up[$j]['item_code'];
	   $max_participants[$j]=$item_details_up[$j]['max_participants'];
	   $max=$max_participants[$j];
	  	$k=0;
	   $spn=0;
	 $part_item_details_up=$this->Registration_Model->get_details_itemcode($schoolcode,2,$fairid,$item_code[$j]);
	//var_dump($part_item_details_up);
	if(@$part_item_details_up[0]['admn_no']){
	$slno++;
	$r=0;
	  while($max_participants[$j]!=0){
	  $k=$max_participants[$j];
?>
         <tr <?php if($j%2==0) {?>class="table_row_second" <?php } else?>class="table_row_first">
           <?php if($spn==0) {?>
           <td height="25" rowspan="<?php echo $k; ?>" bgcolor="#FFFFFF" style="width:6%;border-right: solid 1px #000000; padding:2px;border-top: solid 1px #000000; padding:2px"><span class="style5"><?php echo $slno;?></span></td>
           <?php }?>
           <?php if($spn==0) {?>
           <td height="25" rowspan="<?php echo $k; ?>" bgcolor="#FFFFFF" style="width:30%;border-right: solid 1px #000000; padding:2px;border-top: solid 1px #000000; padding:2px"><?php echo strtoupper($item_name[$j]);?>
            <input name="item_code<?php echo $item_code[$j];?>2" type="hidden" value="<?php echo $item_code[$j]; ?>" /></td>
           <?php }?>
           <td height="25" bgcolor="#FFFFFF" style="width:30%;border-right: solid 1px #000000; padding:2px;border-top: solid 1px #000000; padding:2px"><?php 
		   
		   if(@$part_item_details_up[$r]['item_code']==$item_code[$j]){echo @$part_item_details_up[$r]['participant_name'];}
		   ?></td>
           <td height="25" bgcolor="#FFFFFF" style="width:8%; text-align:center;border-right: solid 1px #000000; padding:2px;border-top: solid 1px #000000; padding:2px"><?php 
		   if(@$part_item_details_up[$r]['item_code']==$item_code[$j]){echo  @$part_item_details_up[$r]['class']; }?></td>
           <td height="25" bgcolor="#FFFFFF" style="width:20%; text-align:left;border-right: solid 1px #000000; padding:2px;border-top: solid 1px #000000; padding:2px"><?php  
		   if(@$part_item_details_up[$r]['item_code']==$item_code[$j]){ echo @$part_item_details_up[$r]['admn_no'];} ?></td>
           <td height="15" bgcolor="#FFFFFF" style="width:8%; text-align:left;border-top: solid 1px #000000; padding:2px"><?php 
		   if(@$part_item_details_up[$r]['gender'] == 'B') {$sex='Boy';}
		   else if(@$part_item_details_up[$r]['gender'] == 'G') {$sex='Girl';}
		   else {echo $sex='';}
		   if(@$part_item_details_up[$r]['item_code']==$item_code[$j]){echo  @$sex;}
		   ?></td>
         </tr>
         
         <?php 
		
		 $max_participants[$j]=$max_participants[$j]-1;
		 
		 $spn=1;
		$r=$r+1;
		 }
		 }
		
		 }?>
       </table></td>
     </tr>
     <?php } ?>
    <tr>
       <td bgcolor="#FFFFFF">&nbsp;</td>
     </tr>
       <?php if($hs_count!=0){?>
     <tr>
       <td><table border="1" cellspacing="0"  align="center"  style=" width:100%; border:solid 1px #000000;">
         <tr>
           <td height="15" colspan="7" bgcolor="#FFFFFF" style="text-align:left"><strong>HS SECTION<br />
           </strong></td>
         </tr>
         <tr>
          <td height="15" bgcolor="#FFFFFF"  style="width:6%;border-right: solid 1px #000000; padding:2px;border-top: solid 1px #000000; padding:2px"><span class="style1"><strong>Slno</strong></span></td>
           <td height="15" bgcolor="#FFFFFF" style="width:30%;border-right: solid 1px #000000; padding:2px;border-top: solid 1px #000000; padding:2px"><span class="style1"><strong>Items</strong></span></td>
           <td height="15" bgcolor="#FFFFFF" style="width:30%;border-right: solid 1px #000000; padding:2px;border-top: solid 1px #000000; padding:2px"><span class="style1"><strong>Name of Participant</strong></span></td>
           <td height="15" bgcolor="#FFFFFF" style="width:8%;border-right: solid 1px #000000; padding:2px;border-top: solid 1px #000000; padding:2px"><span class="style1"><strong>Std</strong></span></td>
           <td height="15" bgcolor="#FFFFFF" style="width:20%; text-align:left;border-right: solid 1px #000000; padding:2px;border-top: solid 1px #000000; padding:2px"><span class="style1"><strong>Admn Number</strong></span></td>
           <td height="15" bgcolor="#FFFFFF" style="width:8%;border-top: solid 1px #000000; padding:2px"><span class="style1"><strong>Gender</strong></span></td>
         </tr>
         <?php 

		
		 $item_count=(count($item_details_hs));
	   $var_item=$item_count;
	   $var_item1=$item_count;
	   $slno=0;
	   for($j=0;$j<$item_count;$j++){
	  
	   $var_item=$var_item1;
	   $item_name[$j]=$item_details_hs[$j]['item_name'];
	   $item_code[$j]=$item_details_hs[$j]['item_code'];
	   $max_participants[$j]=$item_details_hs[$j]['max_participants'];
	   $max=$max_participants[$j];
	  	$k=0;
	   $spn=0;
	 $part_item_details_hs=$this->Registration_Model->get_details_itemcode($schoolcode,3,$fairid,$item_code[$j]);
	//var_dump($part_item_details_hs);
	if(@$part_item_details_hs[0]['admn_no']){
	$slno++;
	$r=0;
	  while($max_participants[$j]!=0){
	  $k=$max_participants[$j];
?>
         <tr <?php if($j%2==0) {?>class="table_row_second" <?php } else?>class="table_row_first">
           <?php if($spn==0) {?>
           <td height="25" rowspan="<?php echo $k; ?>" bgcolor="#FFFFFF" style="width:6%;border-right: solid 1px #000000; padding:2px;border-top: solid 1px #000000; padding:2px"><span class="style5">  <?php echo $slno;?></span></td>
           <?php }?>
           <?php if($spn==0) {?>
           <td height="25" rowspan="<?php echo $k; ?>" bgcolor="#FFFFFF"  style="width:30%;border-right: solid 1px #000000; padding:2px;border-top: solid 1px #000000; padding:2px"><?php echo strtoupper($item_name[$j]);?>
            <input name="item_code<?php echo $item_code[$j];?>3" type="hidden" value="<?php echo $item_code[$j]; ?>" /></td>
           <?php }?>
           <td height="25" bgcolor="#FFFFFF"  style="width:30%;border-right: solid 1px #000000; padding:2px;border-top: solid 1px #000000; padding:2px"><?php 
		   
		   if(@$part_item_details_hs[$r]['item_code']==$item_code[$j]){echo @$part_item_details_hs[$r]['participant_name'];}
		   ?></td>
           <td height="25" bgcolor="#FFFFFF"  style="width:8%; text-align:center;border-right: solid 1px #000000; padding:2px;border-top: solid 1px #000000; padding:2px"><?php 
		   if(@$part_item_details_hs[$r]['item_code']==$item_code[$j]){echo  @$part_item_details_hs[$r]['class']; }?></td>
           <td height="25" bgcolor="#FFFFFF"  style="width:20%; text-align:left;border-right: solid 1px #000000; padding:2px;border-top: solid 1px #000000; padding:2px"><?php  
		   if(@$part_item_details_hs[$r]['item_code']==$item_code[$j]){ echo @$part_item_details_hs[$r]['admn_no'];} ?></td>
           <td height="15" bgcolor="#FFFFFF"  style="width:8%; text-align:left;border-top: solid 1px #000000; padding:2px"><?php 
		   if(@$part_item_details_hs[$r]['gender'] == 'B') {$sex='Boy';}
		   else if(@$part_item_details_hs[$r]['gender'] == 'G') {$sex='Girl';}
		   else {echo $sex='';}
		   if(@$part_item_details_hs[$r]['item_code']==$item_code[$j]){echo  @$sex;}
		   ?></td>
         </tr>
         
         <?php 
		
		 $max_participants[$j]=$max_participants[$j]-1;
		 
		 $spn=1;
		$r=$r+1;
		 }
		}
		 }?>
       </table></td>
     </tr>
     <?php } ?>
      <tr>
       <td bgcolor="#FFFFFF">&nbsp;</td>
     </tr>
       <?php if($hss_count!=0){?>
     <tr>
       <td><table border="1" cellspacing="0"  align="center"  style=" width:100%; border:solid 1px #000000;">
         <tr>
           <td height="30" colspan="8" bgcolor="#FFFFFF" style="text-align:left"><strong>HSS/VHSS SECTION</strong></td>
         </tr>
         <tr>
           <td height="30" bgcolor="#FFFFFF" style="width:5%;border-right: solid 1px #000000; padding:2px;border-top: solid 1px #000000; padding:2px"><span class="style1"><strong>Slno</strong></span></td>
           <td height="30" bgcolor="#FFFFFF" style="width:32%;border-right: solid 1px #000000; padding:2px;border-top: solid 1px #000000; padding:2px"><span class="style1"><strong>Items</strong></span></td>
           <td height="30" bgcolor="#FFFFFF" style="width:27%;border-right: solid 1px #000000; padding:2px;border-top: solid 1px #000000; padding:2px"><span class="style1"><strong>Name of Participant</strong></span></td>
           <td height="30" bgcolor="#FFFFFF" style="width:8%;border-right: solid 1px #000000; padding:2px;border-top: solid 1px #000000; padding:2px"><span class="style1"><strong>Std</strong></span></td>
     <td height="30" bgcolor="#FFFFFF" style="width:8%;border-right: solid 1px #000000; padding:2px;border-top: solid 1px #000000; padding:2px"><span class="style2"><strong>Type</strong></span></td>
           <td height="30" bgcolor="#FFFFFF" style="width:13%;border-right: solid 1px #000000; padding:2px;border-top: solid 1px #000000; padding:2px"><span class="style1"><strong>Admn Number</strong></span></td>
           <td height="30" bgcolor="#FFFFFF" style="width:8%;border-top: solid 1px #000000; padding:2px"><span class="style1"><strong>Gender</strong></span></td>
         </tr>
         <?php 

		
		$item_count=(count($item_details_hss));
	   $var_item=$item_count;
	   $slno=0;
	   $var_item1=$item_count;
	   for($j=0;$j<$item_count;$j++){
	  
	   $var_item=$var_item1;
	   $item_name[$j]=$item_details_hss[$j]['item_name'];
	   $item_code[$j]=$item_details_hss[$j]['item_code'];
	   $max_participants[$j]=$item_details_hss[$j]['max_participants'];
	   $max=$max_participants[$j];
	  	$k=0;
	   $spn=0;
	 $part_item_details_hss=$this->Registration_Model->get_details_itemcode($schoolcode,4,$fairid,$item_code[$j]);
	//var_dump($part_item_details_hss);
	if(@$part_item_details_hss[0]['admn_no']){
	$slno++;
	$r=0;
	  while($max_participants[$j]!=0){
	  
	  $k=$max_participants[$j];
?>
         <tr <?php if($j%2==0) {?>class="table_row_second" <?php } else?>class="table_row_first">
           <?php if($spn==0) {?>
           <td height="25" rowspan="<?php echo $k; ?>" bgcolor="#FFFFFF" style="width:5%;border-right: solid 1px #000000; padding:2px;border-top: solid 1px #000000; padding:2px" ><span class="style5"><?php echo $slno;?></span></td>
           <?php }?>
           <?php if($spn==0) {?>
           <td height="25" rowspan="<?php echo $k; ?>" bgcolor="#FFFFFF" style="width:32%;border-right: solid 1px #000000; padding:2px;border-top: solid 1px #000000; padding:2px"><?php echo strtoupper($item_name[$j]);?>
            <input name="item_code<?php echo $item_code[$j];?>4" type="hidden" value="<?php echo $item_code[$j]; ?>" /></td>
           <?php }?>
           <td height="25" bgcolor="#FFFFFF" style="width:27%;border-right: solid 1px #000000; padding:2px;border-top: solid 1px #000000; padding:2px"><?php 
		   
		   if(@$part_item_details_hss[$r]['item_code']==$item_code[$j]){echo @$part_item_details_hss[$r]['participant_name'];}
		   ?></td>
           <td height="25" bgcolor="#FFFFFF" style="width:8%;border-right: solid 1px #000000; padding:2px;border-top: solid 1px #000000; padding:2px"><?php 
		   if(@$part_item_details_hss[$r]['item_code']==$item_code[$j]){echo  @$part_item_details_hss[$r]['class']; }?></td>
            <?php
		   @$admn_fest=str_split(@$part_item_details_hss[$r]['admn_no'],1);
		
		 if(@$admn_fest[0]=="H")
		 @$admn_fest="HSS";
		 else if(@$admn_fest[0]=="V")
		 @$admn_fest="VHSS";
		 else
		 @$admn_fest="";
		   ?> <td height="25" bgcolor="#FFFFFF" style="width:8%;border-right: solid 1px #000000; padding:2px;border-top: solid 1px #000000; padding:2px"><?php 
		  
		   if(@$part_item_details_hss[$r]['item_code']==$item_code[$j]){echo @$admn_fest; }?></td>
           <td height="25" bgcolor="#FFFFFF" style="width:13%;border-right: solid 1px #000000; padding:2px;border-top: solid 1px #000000; padding:2px"><?php  
		   if(@$part_item_details_hss[$r]['item_code']==$item_code[$j]){ echo @$part_item_details_hss[$r]['admn_no'];} ?></td>
           <td height="25" bgcolor="#FFFFFF" style="width:5%;border-top: solid 1px #000000; padding:2px"><?php 
		   if(@$part_item_details_hss[$r]['gender'] == 'B') {$sex='Boy';}
		   else if(@$part_item_details_hss[$r]['gender'] == 'G') {$sex='Girl';}
		   else {echo $sex='';}
		   if(@$part_item_details_hss[$r]['item_code']==$item_code[$j]){echo  @$sex;}
		   ?></td>
         </tr>
         <?php 
		
		 $max_participants[$j]=$max_participants[$j]-1;
		 
		 $spn=1;
		$r=$r+1;
		 }
		}
		 }?>
       </table></td>
     </tr>
     <?php } ?>
     <tr>
       <td bgcolor="#FFFFFF"><p><br />
         Name of the TeamManager/Joint TeamManager &nbsp;&nbsp;&nbsp;&nbsp;:<?PHP echo @$escorting_details[0]['name_team'];?></p>
         <p>Address of the TeamManager/Joint TeamManager&nbsp; :<?PHP echo @$escorting_details[0]['address_team'];?><br />
         </p>
         <p>Phone Number of the TeamManager/Joint TeamManager&nbsp; :<?PHP echo @$escorting_details[0]['phone_team'];?><br />
         </p></td>
     </tr>
     <tr>
       <td bgcolor="#FFFFFF">
       <br />
      </td>
     </tr>
     
     <tr>
       <td bgcolor="#FFFFFF"> </td>
     </tr>
     <tr>
       <td bgcolor="#FFFFFF">       </td>
       </tr></table>
       
</page>