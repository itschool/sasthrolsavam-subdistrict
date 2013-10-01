<?
$num		=	@$item_det[0]['max_participants'];
//$pin_num	=	@$item_det[0]['max_pinnani'];
//echo "----->".var_dump(@$item_det);
$cap_admn	=	@$capt_det[0]['admn_no'];
//echo "----->".@$cap_admn;
$type		=	@$item_det[0]['item_type'];
$limit		=	(int)$num;

//echo "<br /><br />----------------jjjjjjjj".@$item_det[0]['fest_id'];
	$class_array	=	array();
	if(@$item_det[0]['fest_id']==1)	$class_array  = array(0=>"Std",1=>1,2=>2,3=>3,4=>4);
	else if(@$item_det[0]['fest_id']==2)$class_array = array(0=>"Std",5=>5,6=>6,7=>7);
	else if(@$item_det[0]['fest_id']==3)$class_array = array(0=>"Std",8=>8,9=>9,10=>10);
	else if(@$item_det[0]['fest_id']==4)$class_array = array(0=>"Std",11=>11,12=>12);
			
if($limit)
{
//print_r(@$item_det[0]);

?>
  <input type="hidden" name="limits" id="limits" value="<?php echo $limit; ?>">
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab">
                    <tr>
                        <td align="left" width="4%" class="table_row_first">&nbsp;</td>
                        <?php if(@$item_det[0]['is_exhibit'] == ''){?>
                        <td align="left" width="19%" class="table_row_first">Exhibit Name</td>
						<?php } ?>
                        <td align="center" width="19%" class="table_row_first">Admission No/PenNo.</td>
                        <td align="left" width="22%" class="table_row_first">Name</td>
                         <?php if(@$item_det[0]['is_teach']!='Y'){	?>
                        <td align="left" width="9%" class="table_row_first">Class</td>
                        <?php 
						if(@$item_det[0]['fest_id']==4){	?>
                        <td align="left" width="9%" class="table_row_first">TYPE<br />(HSS/VHSS)</td>
                       <!-- <td align="left" width="9%" class="table_row_first">Group</td>-->
                        <?php } } ?>
                        <td align="left" width="9%" class="table_row_first">Gender</td>
                        <td align="left" width="13%" class="table_row_first">&nbsp;</td>
  					</tr>
                  
                  <?
				  
	
				 // echo "----->".@$num;
				     for($i=1;$i<=$limit;$i++)
						{
					    //echo "<br>--->".$i;
						//if($i==1 && $type == 'G'){$adm	=	@$cap_admn;} else {$adm	=	"";}
						$txtADNO			=	'txtADNO'.$i;
						$txtParticipantName	=	'txtParticipantName'.$i;
						$txtClass			=	'txtClass'.$i;
						$txtGender			=	'txtGender'.$i;
						//$txtClass			=	'txtClass'.$i;
						//$txtGender		=	'txtGender'.$i;
						$userfile			=	'userfile'.$i;
						$photo_div			=	'photo_div'.$i;
						$txt_pin			=	'txt_pin'.$i;
						$txtExhibitname		=	'txtExhibitName';
						if($i >  $num)
						{
						  $pin_val			=	1;
						 ?>
						 <tr>
							<td colspan="8" align="left"><strong>Pinnany</strong></td>
						 </tr>
						   <?
					   }
					   else
					   {
							$pin_val		=	0;	
						}
						  ?>
<tr>
                    	 <td align="left" width="4%" class="table_row_first"><? echo $i; ?>
                         <input type="hidden" id="<? echo $txt_pin;?>" name="<? echo $txt_pin;?>" value="<? echo $pin_val;?>" />
                         <input type="hidden" id="items" name="items" value="<? echo $item_det[0]['item_code'];?>" />
                         <input type="hidden" id="is_exhibit" name="is_exhibit" value="<? echo $item_det[0]['is_exhibit'];?>" />
                         <input type="hidden" id="item_type" name="item_type" value="<? echo $type;?>" />      
                         <input type="hidden" id="is_teach" name="is_teach" value="<? echo $item_det[0]['is_teach'];?>" />                   </td>
                         <?php 
						 //echo '<br>exhibit=='.@$item_det[0]['item_code'].'uuu<br>';
						 if(@$item_det[0]['is_exhibit'] == ''){
						 $exhibit_rowspan=1;
													
						if(@$item_det[0]['item_type']=='G')$exhibit_rowspan=$limit;
						
						if($i==1 || (@$item_det[0]['item_code']==185 || @$item_det[0]['item_code']==186 || @$item_det[0]['item_code']==187))
						{
						 ?>
                         <td align="left" width="19%" rowspan="<?php echo $exhibit_rowspan; ?>" class="table_row_first"><?php  echo form_input(@$txtExhibitname,@$selected_participant[0]['exhibit_name'], ' class="input_box" size="4px" id="'.$txtExhibitname.'" onkeyup="javascript:this.value=this.value.toUpperCase();" ');?>                        </td>
						<?php } }?>
                     	 <td align="center" width="19%" class="table_row_first"><?php  echo form_input($txtADNO,@$selected_participant[0]['admn_no'], 'size="4px" id="'.$txtADNO.'" maxlength="6" onkeyup="javascript:this.value=this.value.toUpperCase();" onBlur="javascript:fetch_admision_no_details_array('.$i.')"');?>                        </td>
                    
    <td align="left" width="22%" class="table_row_first"><?php echo form_input($txtParticipantName, @$selected_participant[0]['participant_name'], ' class="input_box" id="'.$txtParticipantName.'"onkeyup="javascript:this.value=this.value.toUpperCase();"');?></td>
            <?php if(@$item_det[0]['is_teach']!='Y'){	?>             
<td align="left" width="9%" class="table_row_first"><?php echo form_dropdown($txtClass, $class_array, '','id="'.$txtClass.'"'); ?></td>
                        
                   
           <?php 
		 
		  
		   if(@$item_det[0]['fest_id']==4) {
		   @$admn_fest=str_split(@$selected_participant[0]['admn_no'],1);
		 if(@$admn_fest[0]=="H")
		 @$admn_fest="HSS";
		 else if(@$admn_fest[0]=="V")
		 @$admn_fest="VHSS";
		 else
		 @$admn_fest="";
		   ?>
           <td><?php 
		   $admn_category = array(0=>"Select",'H'=>'HSS','V'=>'VHSS');
		   $id1='admn_category'.$i; 
		   echo form_dropdown("admn_category".$i, $admn_category, '','class="inputbox"  id="'.$id1.'" '); ?>
           </td>
            <?php 
		  
		
		   } }?>
           
           
           
                        <td align="left" width="9%" class="table_row_first">
                        <?php 
							if(@$item_det[0]['gender'] == 'C')
							{						
								echo form_dropdown($txtGender, array('B' => 'Boy', 'G' => 'Girl'), '','id="'.$txtGender.'"');
							}
							else if(@$item_det[0]['gender'] == 'B')
							{
								echo form_dropdown($txtGender, array('B' => 'Boy'), '','id="'.$txtGender.'"');							
							}
							else if(@$item_det[0]['gender'] == 'G')
							{
								echo form_dropdown($txtGender, array('G' => 'Girl'), '','id="'.$txtGender.'"');							
							}?>                            </td>                 
                       

                       
<td align="left" valign="top"  colspan="2" class="table_row_first">&nbsp;
                        <div id="<? echo $photo_div; ?>">                        </div>    </td>
  </tr>
                  <?
				  } 
				  $i=$i-1;
				  
				  ?>
                  <input type="hidden" name="hidtot" id="hidtot" value="<? echo $i; ?>" />
				</table>
                
<?
 
  }
  
  ?>
  <input type="hidden" name="limit" id="limit" value="<? echo $limit; ?>" />
    <input type="hidden" name="fest_id" id="fest_id" value="<? echo @$item_det[0]['fest_id']; ?>" />
<!--  <input type="hidden" name="hidtot" id="hidtot" value="<? echo $i; ?>" />-->