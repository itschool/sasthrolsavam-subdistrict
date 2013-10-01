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

<div id="divEntryForm">

<div align="center" class="heading_gray">
<h3>Special Order Entry</h3>
</div>
<br />

<div class="container">


<?php echo form_open('school/special_order_entry', array('id' => 'formSchool','name' => 'formSchool'));

?>
<input type="hidden" name="hidTeachers" id="hidTeachers" value="1">
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px; background-color:#F5F5F5" >
	<tr>
		<th width="20%" colspan="4" align="left">Special Order Entry.</th>
	</tr>
	<tr>
		<td width="20%" height="36" align="left" class="table_row_first">School Code : </td>
		<td align="left" width="30%" class="table_row_first">
        <div id="divSchoolCode">
		<?php 
			echo form_input("txtSchoolCode", @$school_details[0]['school_code'], 'class="inputbox" id="txtSchoolCode" maxlength = "6" onkeypress="javascript:return numbersonly(this, event, false);" onBlur="javascript:fetch_special_order_school_details()"');
		?>
        </div>        </td>
		<td align="left" width="20%" class="table_row_first">School Name : </td>
		<td align="left" width="30%" class="table_row_first"><?php @print($school_details[0]['school_name'])?></td>
	</tr>
    <tr>
		<td align="left" width="20%" class="table_row_first">Revenue District :</td>
		<td align="left" class="table_row_first">
        <?php @print($school_details[0]['rev_district_name'])?>
        </td>
        <td align="left" width="20%" class="table_row_first">Sub District :</td>
		<td align="left" class="table_row_first">
        <?php @print($school_details[0]['sub_district_name'])?>
        </td>
	  </tr>
</table>
<input type="hidden" name="hidSchoolId" id="hidSchoolId" value="<?php echo (@$school_details[0]['school_code']) ? @$school_details[0]['school_code'] : @$this->input->post('hidSchoolId');?>">
<?php 

echo form_close();

?><br />

</div>


<?php 
echo "<div style='height:10px;'></div><div class='clear_both'></div>";
echo form_open_multipart('school/special_order_entry/save_participant', array('id' => 'formParticipant'));
?>

<div id="divAddParticipants" style="display:<?php echo (@$school_show == 'show')? 'block' : 'none';?>">
<div class="container">
<?php

if (isset($save_update) and count($save_update) > 0)
{
	foreach ($save_update as $err)
	{
		print($err.'<br>');
	}
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;background-color:#F5F5F5;" >
	<tr>
		<th colspan="4" align="left">Participants</th>
	</tr>
  
    <tr style="border-bottom:1px solid #CFCFCF;height:20px;">
		<td width="17%" height="33" align="left" class="table_row_first">Special Order</td>
		<td align="left" width="68%" class="table_row_first">
		<?php 
		echo form_dropdown("cmbOrder", $orders, @$selected_participant[0]['spo_id'], 'id="cmbOrder" ');
		?>        </td>
		<td align="left" colspan="2" class="table_row_first">&nbsp;</td>
	</tr>
    <tr style="border-bottom:1px solid #CFCFCF;height:20px;">
		<td width="17%" height="33" align="left" class="table_row_first">Fair Name</td>
		<td align="left" width="68%" class="table_row_first">
		<?php 
		$combo_disabled = (@$show_edit == 'show')? 'disabled' : '';
		//$fair=array(0=>'select',1=>'science',2=>'maths',3=>'social',4=>'work_exp',5=>'it');
		$fair_type	=	$this->session->userdata('FAIR_TYPE');
		$fair_name	= $this->General_Model->get_data('science_master', '*', array('fairId'=>$fair_type));
		if(($this->session->userdata('USER_GROUP') == 'A') or ($this->session->userdata('USER_GROUP') == 'W'))
		{		
		  echo form_dropdown("cmbFairType",$fair,@$selected_fair_id, 'class="input_box" id="cmbFairType" onchange="javascript:display_wrkexp_type(this.value)"  '.$combo_disabled.'  ');
		}
		else
		{
		 echo $fair_name[0]['fairName']; ?>        
	   	 <input type="hidden" id="cmbFairType" name="cmbFairType" value="<? echo $fair_type;?>" /> 
		
        <?php 
        }
        ?>        
		</td>
		<td align="left" colspan="2" class="table_row_first">&nbsp;</td>
	</tr>
     <tr style="border-bottom:1px solid #CFCFCF;height:0px;">
		<td width="100%" height="33%" align="left" class="table_row_first" colspan="3">
        <div id="divWrkexp" style="display:none;">
        <table width="100%" border="0">
        <tr>
        <td width="20%">&nbsp;</td>
        <td width="60%" align="right"><?php 
		//$arywrkexp = array(1=>'On the spot',2=>'Exhibition');
		$arywrkexp = array(1=>'On the spot');
		echo form_dropdown("cmbWrkexpType",$arywrkexp,@$arywrkexp[0], 'class="input_box" id="cmbWrkexpType" onchange="javascript:fetch_items(this.value)"  ');?></td>
        <td width="20%">&nbsp;</td>
        </table>
        </div>
        </td>
	</tr>
    
    <tr style="border-bottom:1px solid #CFCFCF;height:20px;">
		<td width="17%" height="33" align="left" class="table_row_first" >Category</td>
		<td align="left" width="68%" class="table_row_first" >
		<?php echo form_dropdown("cmbFestType",$fest,@$selected_fest_id, 'class="input_box" id="cmbFestType" onchange="javascript:fetch_items(this.value)" onkeyup="javascript:fetch_items(this.value)" onclick="javascript:fetch_items(this.value)"  '.$combo_disabled.' ');?>        </td>
		<td align="left" colspan="2" class="table_row_first"  >&nbsp;</td>
	</tr>
     <tr>
        <td align="left" width="20%" class="table_row_first">Item code</td>
        <td align="left" width="80%" colspan="3" class="table_row_first"><div id="cmbitem" style="display:<?php echo (@$show_edit == 'show')? 'block' : 'none';?>">
        
            <?php
			
			//echo "hby"; 
            //$items_selected	=	$this->Registration_Model->get_participant_item_details(@$selected_participant[0]['participant_id'], @$selected_participant[0]['admn_no'],'C');
			//array(@$selected_participant[0]['item_code'] => @$selected_item[0]['item_code'])
			echo form_dropdown("txtItemCode_1",@$item_details,@$selected_item_code, ' class="input_box" id="txtItemCode_1"  onchange="javascript:fetch_item_code_details()" onBlur="javascript:fetch_item_code_details()" onkeyup="javascript:fetch_item_code_details()"  '.$combo_disabled.' ');
		//onChange="javascript:add_special_order_participant()"	
     ?>
      <input type="hidden" name="hidItemCode" id="hidItemCode" value="<?php echo @$selected_item_code; ?>">
          </div>        </td>
    </tr> 
    
    <tr>
    	<td colspan="4" style="padding:0; margin:0">
        	<div id="editEntry" style="display:<?php echo (@$show_edit == 'show')? 'block' : 'none';?>">
            <input type="hidden" name="hidParticipantId" id="hidParticipantId" value="">
           
            <?php  
			$num		=	@$item_info[0]['max_participants'];

			$type		=	@$item_info[0]['item_type'];
			$limit		=	(int)$num;

	$class_array	=	array();
	if(@$item_info[0]['fest_id']==1)	$class_array  = array(0=>"Std",1=>1,2=>2,3=>3,4=>4);
	else if(@$item_info[0]['fest_id']==2)$class_array = array(0=>"Std",5=>5,6=>6,7=>7);
	else if(@$item_info[0]['fest_id']==3)$class_array = array(0=>"Std",8=>8,9=>9,10=>10);
	else if(@$item_info[0]['fest_id']==4)$class_array = array(0=>"Std",11=>11,12=>12);
			
if($limit)
{
			
			?>
             <input type="hidden" name="limit" id="limit" value="<?php echo $limit; ?>">
            <table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab">
                    <tr>
                        <td align="left" width="9%" class="table_row_first">&nbsp;</td>
                        <?php if(@$item_info[0]['is_exhibit'] == ''){?>
                        <td align="left" width="17%" class="table_row_first">Exhibit Name</td>
						<?php } ?>
                        <td align="center" width="14%" class="table_row_first">Admission No/Pen No</td>
                        <td align="left" width="27%" class="table_row_first">Name</td>
                         <?php if(@$item_info[0]['is_teach']!='Y'){	?>
                        <td align="left" width="5%" class="table_row_first">Class</td>
                        <?php if(@$item_info[0]['fest_id']==4){	?>
                        <td align="left" width="7%" class="table_row_first">TYPE<br />
                      (HSS/VHSS)</td>
                        <!--<td align="left" width="5%" class="table_row_first">Group</td>-->
                        <?php } } ?>
                        <td align="left" width="5%" class="table_row_first">Gender</td>
                        <td align="left" width="11%" class="table_row_first">&nbsp;</td>
  					</tr>
                    
                    
                    <?php
					
					
					$slnum=1;
					  for($i=0;$i<$limit;$i++)
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
                    	 <td align="left" width="4%" class="table_row_first"><? echo $slnum++; ?>
                         <input type="hidden" id="<? echo $txt_pin;?>" name="<? echo $txt_pin;?>" value="<? echo $pin_val;?>" />
                         <input type="hidden" id="item_type" name="item_type" value="<? echo $type;?>" />                         </td>
                         <?php 
						// echo '<br>exhibit=='.@$item_det[0]['is_exhibit'].'uuu<br>';
						 if(@$item_info[0]['is_exhibit'] == ''){
						 $exhibit_rowspan=1;
						if(@$item_info[0]['item_type']=='G')$exhibit_rowspan=$limit;
						
						if($i==0)
						{
						 ?>
                         <td align="left" width="19%" rowspan="<?php echo $exhibit_rowspan; ?>" class="table_row_first"><?php  echo form_input(@$txtExhibitname,@$selected_participant[$i]['exhibit_name'], ' class="input_box" size="4px" id="'.$txtExhibitname.'" onkeyup="javascript:this.value=this.value.toUpperCase();" ');?>                        </td>
						<?php } }?>
                     	 <td align="center" width="19%" class="table_row_first"><input type="hidden" name="pi_id<?php echo $i; ?>" id="pi_id<?php echo $i; ?>" value="<?php echo @$selected_participant[$i]['pi_id'];?>"><?php  echo form_input($txtADNO,@$selected_participant[$i]['admn_no'], 'size="4px" id="'.$txtADNO.'" maxlength="6" onkeyup="javascript:this.value=this.value.toUpperCase();" onBlur="javascript:fetch_admision_no_details_array('.$i.')"');?>                        </td>
                    
    <td align="left" width="22%" class="table_row_first"><?php echo form_input($txtParticipantName, @$selected_participant[$i]['participant_name'], ' class="input_box" id="'.$txtParticipantName.'"onkeyup="javascript:this.value=this.value.toUpperCase();"');?></td>
        <?php if(@$item_info[0]['is_teach']!='Y'){	?>                 
<td align="left" width="9%" class="table_row_first"><?php echo form_dropdown($txtClass,$class_array,@$selected_participant[$i]['class'],'id="'.$txtClass.'"'); ?> </td>

           <?php 
		  
		   if(@$item_info[0]['fest_id']==4) {
		   @$admn_fest=str_split(@$selected_participant[$i]['admn_no'],1);
		 if(@$admn_fest[0]=="H")
		 @$admn_fest="H";
		 else if(@$admn_fest[0]=="V")
		 @$admn_fest="V";
		 else
		 @$admn_fest="";
		   ?>
           <td><?php 
		   $admn_category = array(0=>"Select",'H'=>'HSS','V'=>'VHSS');
		   $id1='admn_category'.$i; 
		   echo form_dropdown("admn_category".$i, $admn_category, @$admn_fest,'class="inputbox"  id="'.$id1.'" '); ?>
           </td>
		
		   <?php } } ?>
           
           
           
                        <td align="left" width="9%" class="table_row_first">
                        <?php 
							if(@$item_info[0]['gender'] == 'C')
							{						
								echo form_dropdown($txtGender, array('B' => 'Boy', 'G' => 'Girl'), @$selected_participant[$i]['gender'],'id="'.$txtGender.'"');
							}
							else if(@$item_info[0]['gender'] == 'B')
							{
								echo form_dropdown($txtGender, array('B' => 'Boy'), @$selected_participant[$i]['gender'],'id="'.$txtGender.'"');							
							}
							else if(@$item_info[0]['gender'] == 'G')
							{
								echo form_dropdown($txtGender, array('G' => 'Girl'), @$selected_participant[$i]['gender'],'id="'.$txtGender.'"');							
							}?>                            </td>                 
                       

                       
<td align="left" valign="top"  colspan="2" class="table_row_first">&nbsp;
                        <div id="<? echo $photo_div; ?>">                        </div>    </td>
  </tr>
                  <?
				  } 
				  $i=$i-1;
				  
				  ?>
                  <input type="hidden" name="hidtot" id="hidtot" value="<? echo $i; ?>" />
                     <input type="hidden" name="cmbFairType" id="cmbFairType" value="<? echo @$selected_fair_id; ?>" />
                     <input type="hidden" name="cmbFestType" id="cmbFestType" value="<? echo @$item_info[0]['fest_id']; ?>" />
                      <input type="hidden" name="hidItemCode" id="hidItemCode" value="<? echo  @$item_info[0]['item_code']; ?>" />
                      <input type="hidden" name="is_teach" id="is_teach" value="<? echo  @$item_info[0]['is_teach']; ?>" />
				</table>
                
<?
 
  }
 
  ?>

  <input type="hidden" name="limit" id="limit" value="<? echo $limit; ?>" />
    <input type="hidden" name="fest_id" id="fest_id" value="<? echo @$item_info[0]['fest_id']; ?>" />
    <input type="hidden" id="items" name="items" value="<? echo @$item_info[0]['item_code'];?>" />
   <input type="hidden" id="is_exhibit" name="is_exhibit" value="<? echo @$item_info[0]['is_exhibit'];?>" />
					
			
            </div>        </td>
    </tr>
    <tr>
                        <td colspan="4" style="padding:0; margin:0">
                            <div id="newEntry" >                            </div>                        </td>
                    </tr>
       				
<!--    <tr style="border-bottom:1px solid #CFCFCF;height:20px;">
		<td align="left" width="9%" class="table_row_first">Remarks</td>
		<td align="left" width="17%" class="table_row_first">
		<?php 
		echo form_textarea("txtRemarks", @$selected_participant[0]['spo_remarks'], 'id="txtRemarks" style="width:300px; height:80px;" ');
		?>        </td>
		<td align="left" colspan="2" class="table_row_first">&nbsp;</td>
	</tr>-->
	<tr>
		<td align="center" colspan="2">
			<?php echo (count(@$selected_participant) > 0 ) ? form_button('update_participant', 'Update Details', 'id="update_participant" onClick="javascript:return fncUpdateParticipant(\''.$selected_participant[0]['team_no'].'\')"').'&nbsp;&nbsp;'.form_button('Cancel', 'Cancel', 'onClick="javascript:fncCancelSpecialOrderParticipant()"'): form_button('save_participant', 'Save Details', 'id="update_participant" onClick="javascript:fncSaveSpecialOrderParticipant()"');?>		</td>
	</tr>
</table>
<input type="hidden" name="hidSchoolId" id="hidSchoolId" value="<?php echo (@$school_details[0]['school_code']) ? @$school_details[0]['school_code'] : @$this->input->post('hidSchoolId');?>">
<input type="hidden" name="hidADNO" id="hidADNO" value="">
<input type="hidden" name="hidPiId" id="hidPiId" value="">
<input type="hidden" name="hidItemId" id="hidItemId" value="">
<?php

?>
<br />
</div>
</div>
<br />

<div style="display:<?php echo (count(@$participant_details) > 0 && @$school_show == 'show') ? 'block' : 'none';?>">
<?php
//print_r($participant_details);
?>
<table width="100%" border="1" bgcolor="#FFFFFF" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
	<tr>
		<th align="left" width="4%">Sl No</th>
        <th align="left" width="20%">Fair</th>
        <th align="left" width="20%">Item</th>
      <!--  <th align="left" width="10%">Team</th>-->
		<th align="left" width="6%">AD No/PenNo</th>
        <th align="left" width="6%">Reg No.</th>
		<th align="left" width="25%">Name of participant</th>
		<th align="center" width="4%">Class</th>
		<th align="center" width="4%">B/G</th>
	    <th align="left" width="28%">Order</th>
		<?php if (isset($is_edit) and $is_edit != 'no'){?>
		<th align="center" width="8%">Delete</th>
        <th align="center" width="16%">Edit </th>
		<?php }?>
	</tr>
    <?php
		$count	=	1;
		$prev_item_code	=	'';
		$prev_fair	=	'';
		$prev_team	=	'';
		$prev_parent_adno	=	'';
		for($j = 0; $j < count($participant_details); $j++){
			//$items	=	$this->Registration_Model->get_participant_item_details($participant_details[$j]['participant_id'], $participant_details[$j]['admn_no']);
			$classname		=	($j%2 == 0)? '' : '';
			$item_rowspan	=	1;
			$fair_rowspan	=	1;
			$caption_rowspan=	1;
			$captain_set	=	false;
			/*if($prev_parent_adno != @$participant_details[$j]['parent_admn_no'] or $prev_item_code != $participant_details[$j]['item_code']) {
				$caption_rowspan	=	get_array_double_val_count($participant_details, 'parent_admn_no', @$participant_details[$j]['parent_admn_no'], 'item_code', $participant_details[$j]['item_code']);
				$prev_parent_adno = @$participant_details[$j]['parent_admn_no'];
				$captain_set		=	true;
			}*/
			
			?>
			<tr>
				
                <td align="left" rowspan="<?php echo $caption_rowspan?>"  class="<?php echo $classname?>"><?php echo $count;?></td>
                
               
                 <?php
				
				
				if($prev_fair != $participant_details[$j]['fairId']) {
					$fair_rowspan	=	get_array_val_count($participant_details, 'fairId', $participant_details[$j]['fairId']);
					$prev_fair 		= 	$participant_details[$j]['fairId'];
					?>
                   <td align="left" rowspan="<?php echo $fair_rowspan?>" class="<?php echo $classname?>" ><?php echo $fair[$participant_details[$j]['fairId']]; ?></td>
                    <?php
				}
				?> 
                
                
                
                <?php 
				$count++;
				
				?>
                <?php
				if($prev_item_code != $participant_details[$j]['item_code']) {
				$team=0;
					$item_rowspan	=	get_array_val_count($participant_details, 'item_code', $participant_details[$j]['item_code']);
					$prev_item_code = $participant_details[$j]['item_code'];
					?>
                    <td align="left" rowspan="<?php echo $item_rowspan?>" class="<?php echo $classname?>" ><?php echo @$participant_details[$j]['item_code'].' - '.@$participant_details[$j]['item_name'];?></td>
                    <?php
				}
				
				if($prev_team != $participant_details[$j]['team_no']) {
				
				$team=0;
				
					$team_rowspan	=	get_array_double_val_count($participant_details, 'team_no', $participant_details[$j]['team_no'] , 'item_code' , $participant_details[$j]['item_code']);
					$prev_team 		= 	$participant_details[$j]['team_no'];
					?>
                   <!--<td align="left" rowspan="<?php echo $team_rowspan?>" class="<?php echo $classname?>" ><?php echo $participant_details[$j]['team_no']; ?></td>-->
                    <?php
				}
				$team=$team+1;
				?> 
			   <?php if (@$captain_set){?>
				<!--<td align="left" rowspan="<?php echo $caption_rowspan?>" class="<?php echo $classname?>"><?php echo @$participant_details[$j]['parent_admn_no']?></td>-->
                <?php }?>
                <td align="left" class="<?php echo $classname?>"><?php echo $participant_details[$j]['admn_no']?></td>
                <td align="left" class="<?php echo $classname?>"><?php echo $participant_details[$j]['participant_id']?></td>
				<td align="left" class="<?php echo $classname?>"><?php echo $participant_details[$j]['participant_name']?></td>
				<td align="center" class="<?php echo $classname?>"><?php echo $participant_details[$j]['class']?></td>
				<td align="center" class="<?php echo $classname?>"><?php echo $participant_details[$j]['gender']?></td>
                <td align="left" class="<?php echo $classname?>"><?php echo $participant_details[$j]['spo_title']?></td>
				<?php if (isset($is_edit) and $is_edit != 'no'){?>
                <td align="center" class="<?php echo $classname?>" > 
					<a href="javascript:void(0)" onClick="javascript:deleteSpecialOrderParticipant('<?php echo $participant_details[$j]['admn_no']?>', '<?php echo $participant_details[$j]['item_code']?>')">
						<img src="<?php echo base_url(false)?>images/delete.gif" border="0"></a></td>
                  <?php if($team==1){ ?>      
				<td align="center"  rowspan="<?php echo $team_rowspan; ?>" class="<?php echo $classname?>" >
					<a href="javascript:void(0)" onClick="javascript:editSpecialOrderParticipant('<?php echo $participant_details[$j]['pi_id']?>', '<?php echo $participant_details[$j]['item_code']?>', '<?php echo $participant_details[$j]['team_no']?>')"><img src="<?php echo base_url(false)?>images/edit.gif" border="0">	</a>
                </td>
                <?php } //if ($captain_set){?>
				
                <?php 
				$captain_set = false;
				//}?>
				<?php }?>
			</tr>	
			<?php
			//$count++;
		}
	?>
    
    
    
    
    
    
    
	<?php
		/*$count	=	1;
		for($j = 0; $j < count($participant_details); $j++){
			//$items	=	$this->Registration_Model->get_participant_item_details($participant_details[$j]['participant_id'], $participant_details[$j]['admn_no']);
			$classname	=	($j%2 == 0)? 'table_row_second' : 'table_row_first'
			?>
			<tr>
				<td align="left" class="<?php echo $classname?>"><?php echo $count;?></td>
				<td align="left" class="<?php echo $classname?>"><?php echo $participant_details[$j]['admn_no']?></td>
				<td align="left" class="<?php echo $classname?>"><?php echo $participant_details[$j]['participant_name']?></td>
				<td align="left" class="<?php echo $classname?>"><?php echo $participant_details[$j]['class']?></td>
				<td align="left" class="<?php echo $classname?>"><?php echo ($participant_details[$j]['gender'] == 'B') ? 'Boy' : 'Girl';?></td>
                <td align="center" class="<?php echo $classname?>" ><label style="cursor:pointer" title="<?php echo (@$participant_details[$j]['item_name']) ? @$participant_details[$j]['item_name'] :'';?>"><?php echo (@$participant_details[$j]['item_code']) ? @$participant_details[$j]['item_code'] :'';?></label></td>
                <td align="left" class="<?php echo $classname?>"><?php echo $participant_details[$j]['spo_title']?></td>
				<?php if (isset($is_edit) and $is_edit != 'no'){?>
				<!--<td align="center" class="<?php echo $classname?>">
					<a href="javascript:void(0)" onClick="javascript:editSpecialOrderParticipant('<?php echo $participant_details[$j]['pi_id']?>')">
						<img src="<?php echo base_url(false)?>images/edit.gif" border="0">
					</a>
				</td>
				<td align="center" class="<?php echo $classname?>"> 
					<a href="javascript:void(0)" onClick="javascript:deleteSpecialOrderParticipant('<?php echo $participant_details[$j]['pi_id']?>')">
						<img src="<?php echo base_url(false)?>images/delete.gif" border="0">
					</a>
				</td>-->
				<?php }?>
			</tr>	
			<?php
			$count++;
		}*/
	?>
</table>
<?php

?>


<?php
echo form_close();
?>
</div>
</div>