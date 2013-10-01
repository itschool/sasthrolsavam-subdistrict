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
<table width="99%" border="1" align="center" cellpadding="0" cellspacing="0" style="border:solid 1px; color:#CFCFCF">
    <tr>
    <td align="center"><span class="style1">Venue Allotment</span></td>
    </tr>
    </table><br />

<div class="container">  
<?php echo form_open('ground/allotment/save_allotment', array('id' => 'formAllotment', 'name' => 'formAllotment')); 
$fair_type	=	$this->session->userdata('FAIR_TYPE');
$fair_name	= $this->General_Model->get_data('science_master', '*', array('fairId'=>$fair_type));
?>
<table width="100%" border="0" cellspacing="4" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
	<tr>
		<th colspan="6" align="left">Allotment Form.</th>
	</tr>
	<tr bgcolor="#F5F5F5" style="border-bottom:1px solid #CFCFCF;height:20px;">  
		<td align="left" width="20%" >Fair Type : </td>
	  <td align="left" width="13%" >
		<?php
		if(($this->session->userdata('USER_GROUP') == 'A') or ($this->session->userdata('USER_GROUP') == 'W'))
		
		echo form_dropdown("cmbFairType",$fair,@$fair_id, 'class="input_box" id="cmbFairType"  onchange="javascript:display_wrkexp(this.value)"   onclick="javascript:display_wrkexp(this.value)" '  );
		else {
		echo $fair_name[0]['fairName']; ?>
        
	    <input type="hidden" id="cmbFairType"	 name="cmbFairType" value="<? echo $fair_type;?>" /> 
        <? } 
		//onChange="javascript:fetch_item_details()"
		?>
        
	    <!--<div id="divSchoolCode">
				<?php //echo form_input("txtItemCode", @$selected_item[0]['item_code'], 'class="input_box_small" id="txtItemCode" onkeypress="javascript:return numbersonly(this, event, false);" onBlur="javascript:fetch_item_details()" onkeyup="javascript:fetch_item_details()" ');?>
        	</div>  -->      </td>
	  <td align="left" width="21%" >Category : </td>
	  <td align="left" width="15%" >
       <div id="divWrkexp" style="display:<?php echo (@$_POST['cmbWrkexpType']>0 && @$fair_id==4)?'block':'none';?>;" >
      <?php 
		$arywrkexp = array(1=>'On the spot',2=>'Exhibition');
		echo form_dropdown("cmbWrkexpType",$arywrkexp,@$_POST['cmbWrkexpType'], 'class="input_box" id="cmbWrkexpType" onchange="javascript:fetch_item_details()"  onclick="javascript:fetch_item_details()" ');?>
         </div>
         <?php $combotype = (@$_POST['cmbWrkexpType']==2 && @$fair_id==4)?'disabled':'';?>
          <?php echo form_dropdown("cmbFestType",@$fest,@$fest_id, 'class="input_box" id="cmbFestType" onChange="javascript:fetch_item_details()"  onClick="javascript:fetch_item_details()"  '.@$combotype .''  );?>
      </td>
        <td align="left" width="16%" >Item : </td>
		<td align="left" width="15%" ><div id="divItems" ><?php echo form_dropdown("cmbItemType",@$item_details,@$item_id, 'class="input_box" id="cmbItemType" onChange="javascript:fetch_participant_details()" onClick="javascript:fetch_participant_details()" '  ); ?></div>
		<?php //echo form_dropdown("cmbFestType",$fest,@$fest_id, 'class="input_box" id="cmbFestType"'  ); ?>
        </td>
	</tr>
    
	<tr bgcolor="#F5F5F5" style="border-bottom:1px solid #CFCFCF;height:20px;">
		<td align="left" width="20%" >Venue : </td>
		<td align="left" width="13%" >
		<?php 
			@$ground_array	=	array('0' => '-- Venue --');
			for(@$i = 0; @$i < count(@$grounds); $i++ ){
				@$ground_array[$grounds[$i]['ground_id']]	=	@$grounds[$i]['ground_name'];
			}
			echo form_dropdown("cmbGround", $ground_array, @$alloted_records[0]['ground_id'],'id="cmbGround" ');
			?>      	</td>
        <td width="21%"  >Date :  </td>
    
<?php 
//echo '<br><br><br>';
//echo @$alloted_records[0]['start_time'];
				if(@$alloted_records[0]['start_time'])
				{
					@$explode_date	=	explode(' ', @$alloted_records[0]['start_time']);
				//	print_r(@$explode_date);
					@$date			=	$explode_date[0];
					@$time_explode	=	explode(':',@$explode_date[1]);
					@$hour			=	@$time_explode[0];
					@$minute		=	@$time_explode[1];				
				}
			?>
           
                
          	<td align="left" width="15%" > <?php echo form_dropdown("txtDate", @$date_array,(@$date != '') ? @$date :'', ' id="txtDate"' );?></td>
                  <td align="left" width="16%" >Time : </td>
		<td align="left" width="15%" ><?php echo form_dropdown("txtHour", @$hour_array,(@$hour != '') ? $hour :'HH', ' id="txtHour" maxlength="2" onfocus="javascript:clearText(\'txtHour\', \'HH\')" onBlur="javascript:clearText(\'txtHour\', \'HH\')" onkeyup="javascript:change_text_max_to_focus(\'txtHour\', \'txtMin\', \'2\')"' );?>
            <?php echo form_dropdown("txtMin", @$min_array,(@$minute != '') ? @$minute : 'MM', ' id="txtMin" maxlength="2" onfocus="javascript:clearText(\'txtMin\', \'MM\')" onBlur="javascript:clearText(\'txtMin\', \'MM\')" ' );?></td>
    </tr>
	<tr bgcolor="#F5F5F5" style="border-bottom:1px solid #CFCFCF;height:20px;">
	
        <td align="left" width="20%"  >Number of participants:</td>
		<td align="left" width="13%"  ><?php @print($selected_item[0]['total_participants'])?></td>
        <td align="left" width="21%"  >Approximate time taken :</td>
     	<td align="left" width="15%"  ><?php @print(get_time_format((int)$selected_item[0]['total_time'])); ?></td>
        <td align="left" width="16%"  >No of judges : </td>
        <td align="left" width="15%"  >
        <?php 
			$judge_array	=	array('0' => '0');
			for($i = 1; $i <= $no_of_judges; $i++ )
				$judge_array[$i]	=	$i;
			
			echo form_dropdown("cmbNoOfJudges", $judge_array, (@$alloted_records[0]['no_of_judges']) ? @$alloted_records[0]['no_of_judges'] : '3','id="cmbNoOfJudges" ');?>        </td>
	</tr>
    <?php if(count(@$alloted_records) > 0 ){ ?>
    	<!--<tr bgcolor="#F5F5F5" style="border-bottom:1px solid #CFCFCF;height:20px;">
	
        <td align="left" width="20%"  >Start Time:</td>
		<td align="left" width="13%"  ><?php echo datetophpmodel(@$alloted_records[0]['start_time']).' '.timephpmodel(@$alloted_records[0]['start_time']) ?></td>
        <td align="left" width="20%"  >End Time:</td>
     	<td align="left" width="15%"  ><?php  echo datetophpmodel(@$alloted_records[0]['end_time']).' '.timephpmodel(@$alloted_records[0]['end_time']) ?></td>
        <td align="left" width="16%"  >&nbsp;</td>
        <td align="left" width="15%"  >&nbsp;</td>
	</tr>-->
    <?php } ?>

	<tr>
		<td align="center" colspan="6">
		<?php 
			if (isset($is_edit) and $is_edit != 'no'){
				echo (@count($alloted_records) > 0) ? form_button('Update', 'Update', 'onClick="javascript:fncCheckAllotmentDeatils(1)"') : form_button('Save', 'Save', 'onClick="javascript:fncCheckAllotmentDeatils(0)"');
			}
			
			//alloted_details
		?>		</td>
	</tr>
</table>

<input type="hidden" name="hidItemId" id="hidItemId" value="<?php echo (@$selected_item[0]['item_code']) ? @$selected_item[0]['item_code'] : @$this->input->post('hidItemId');?>">
<input type="hidden" name="hidMaxPartcipants" id="hidMaxPartcipants" value="<?php @print($selected_item[0]['total_participants'])?>">
<input type="hidden" name="hidMaxTime" id="hidMaxTime" value="<?php @print($selected_item[0]['max_time'])?>">
<input type="hidden" name="hidTimeType" id="hidTimeType" value="<?php @print($selected_item[0]['time_type'])?>">


<?php  echo form_close(); ?>
</div>
<br>
</div>

<?php 
if(count(@$alloted_records) > 0 ){
echo form_open('ground/allotment/update_cluster_participant', array('id' => 'formUpdateGroundParticipant', 'name' => 'formUpdateGroundParticipant'));

?>
<div class="container">
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
	<tr>
		<th width="4%" colspan="4" align="left">Allotments</th>
	</tr>
	<tr>
		<th>Reg No</th>
		<th>School code</th>
		
	</tr>
	<?php
	$value_array	=	array();
			//$limit = $alloted_records[0]['no_of_cluster'];
			//for($i = 1; $i <= $limit; $i++ )
			//	$value_array[$i]	=	$i;
			
	for($i = 0; $i < count($alloted_records); $i++)
	{
		$class_name = ($i % 2 == 0) ? 'table_row_first' : 'table_row_first';
		echo '<tr><td class="'.$class_name.'">';
		echo $alloted_records[$i]['participant_id'];
		echo '</td><td class="'.$class_name.'">';
		echo $alloted_records[$i]['school_code'];
		echo '</td></tr>';
	}
	?>
	<input type="hidden" name="hidClusterItemCode" id="hidClusterItemCode" value="<?php @print($alloted_records[0]['item_code'])?>">
	<?php if($this->Session_Model->check_user_permission(3)){?>
   <!-- <tr>
		<td align="center" colspan="3">-->
		<?php 
	//	echo (@count($alloted_records) > 0) ? form_button('Update', 'Update', 'onClick="javascript:fncUpdateCluster()"') : '';
		?>
	<!--	</td>
	</tr>-->
    <?php }?>
</table>
<?php echo form_close(); }?>

