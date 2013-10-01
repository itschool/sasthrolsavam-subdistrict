<div id="divEntryForm">
<div align="center" class="heading_gray">
<h3>Item Wise Result Entry </h3>
</div>
<br />
<div class="container">
<?php echo form_open('', array('id' => 'resultEntry_bulk', 'name' => 'resultEntry_bulk'));
$fair_type	=	$this->session->userdata('FAIR_TYPE');
$fair_name	= $this->General_Model->get_data('science_master', '*', array('fairId'=>$fair_type));
//echo "<br /><br />";
//var_dump($selected_item_dtls);
if(@$selected_result[0]['participant_id']){ $property1	=	'disabled'; $property2	=	'disabled';} 
else { $property1	=	'';  $property2	=	'';}

if(@$selected_fair_id == 4 && @$selected_fest_id ==0){ @$selected_fest_id	=	''; $property2	=	'disabled';  }
?>


<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
	<tr>
		<th colspan="4" align="left">Result Entry (Item code)</th>
	</tr>
    <tr>
		<td align="left" width="14%" class="table_row_first">Item Code : </td>
		<td align="left" width="86%" class="table_row_first"><input type="text" name="item_code" id="item_code" size="1pt" maxlength="3" onblur="javascript:fetch_bulk_item_details_result(this.value)"  onkeyup="javascript:fetch_bulk_item_details_result(this.value)"  /> </td>
     </tr>
</table>



<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
	<tr>
		<th colspan="4" align="left">Result Entry.</th>
	</tr>
    <tr>
		<td align="left" width="16%" class="table_row_first">Fair Name : </td>
		<td align="left" width="25%" class="table_row_first"><?php 
		
		if(($this->session->userdata('USER_GROUP') == 'A') or ($this->session->userdata('USER_GROUP') == 'W'))
		echo form_dropdown("cmbFairType",$fair,@$selected_fair_id, 'class="input_box" id="cmbFairType" '.$property1.' onclick="javascript:check_for_workexpo(this.value)" onchange="javascript:check_for_workexpo(this.value)" ');
	else {
			echo $fair_name[0]['fairName']; ?>
        
    	<input type="hidden" id="cmbFairType"	 name="cmbFairType" value="<? echo $fair_type;?>" /> 
        <? } ?>
	
	</td>
    <td width="31%" class="table_row_first">
     <? 
	   //echo "<br /><br />".@$selected_fair_id."-----".@$selected_fest_id;
	    if(@$selected_fair_id == 4 && @$selected_fest_id ==0) { 
	      $visibility	= 'block'; $checked1	=	''; $checked2	=	'checked'; 
		  } else if(@$selected_fair_id == 4 && @$selected_fest_id !=0) {  
		  $visibility	= 'block'; $checked1	=	'checked'; $checked2	=	''; 
		  } else if($fair_type == 4) { 
		  $visibility	= 'block'; $checked1	=	''; $checked2	=	'';
		  }
		  else  { 
		  $visibility	= 'none'; $checked1	=	''; $checked2	=	'';
		  } ?>
          
    <div id="work" style="display:<?php echo $visibility; ?>;">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     <input type="radio" name="radioLabel" value="spot" id="radioLabel_spot" <? echo $checked1;?> onClick="selectCat4bulkentry(this.value)" >
        On the Spot</label>
    <input type="radio" name="radioLabel" value="exhib" id="radioLabel_exhib" onClick="selectCat4bulkentry(this.value)" <? echo $checked2;?> >
        Exhibition</label>
    <input type="hidden" name="worktype" id="worktype" value="" />
    </div>
     
	
        
        </td>
		<td align="left" width="28%" class="table_row_first"></td>
	</tr>
    <tr>
		<td align="left" width="16%" class="table_row_first">Category : </td>
		<td align="left" width="25%" class="table_row_first"><?php echo form_dropdown("cmbFestType",$fest,@$selected_fest_id, 'class="input_box" id="cmbFestType" onchange="javascript:fetch_items_for_bulk_result_entry(this.value)"   '.$property2.'');?></td>
		<td align="left" width="31%" class="table_row_first"></td>
		<td align="left" width="28%" class="table_row_first"></td>
	</tr>
	<tr>
		<td align="left" width="16%" class="table_row_first">Item Code : </td>
		<td align="left" width="25%" class="table_row_first"><div id="cmbitem"><?php 
		//echo "<br /><br />->".var_dump(@$items);
		
		echo form_dropdown("cbo_item1",@$items,@$selected_item_id, 'class="input_box" id="cbo_item1" onchange="javascript:fetch_bulk_item_details_result(this.value)" onkeyup="javascript:fetch_bulk_item_details_result(this.value)" ');?></div></td>
		<td align="left" width="31%" class="table_row_first">Item Name : </td>
		<td align="left" width="28%" class="table_row_first"><?php @print(@$selected_item_name[0]['item_name'])?></td>
	</tr>
    <tr>
		<td align="left" class="table_row_first">Number of participants: </td>
		<td align="left" class="table_row_first"><?php @print($selected_item[0]['total_participants'])?></td>

    	<td align="left" class="table_row_first">Number of Judges : </td>
		<td align="left" class="table_row_first"><?php @print((int)$selected_item[0]['no_of_judges']);// + ((int)@$interval_bw_items * @$selected_item[0]['total_participants']))?></td>
    </tr>
	
    <?php
		//echo "<br />---->".@$selected_item[0]['no_of_judges'];
		$cnt_judges		=	(int)@$selected_item[0]['no_of_judges'];
		$item_cod	=	(@$selected_item[0]['item_code']) ? @$selected_item[0]['item_code'] : @$this->input->post('hidItemId');
		$len			=	strlen($item_cod);
		$exb	=	@$selected_item[0]['exhibition'];
		if($exb == 2)  {  @$item_cod	=	'exb'; }
		?>
</table>
<input type="hidden" name="hidItemId" id="hidItemId" value="<?php echo (@$item_cod);?>">
<input type="hidden" name="hidNoJudge" id="hidNoJudge" value="<?php echo (@$cnt_judges)?>">
<input type="hidden" name="hidFestid" id="hidFestid" value="<?php echo (@$selected_fest_id)?>">
<?php 

echo form_close(); ?>

</div>

<?
//var_dump(@$selected_item);
if (count(@$selected_item) > 0){
  
  $len	=	$selected_item[0]['fest_id'];
 // echo "<br />--->".@$selected_fair_name[0]['item_code'];
?>
<div align="center" class="heading_gray">
<h3><? if($exb != 2) { echo @$selected_fair_name[0]['fairName'];?> - <?php @print($selected_item[0]['item_name'])?> ( <?php @print($selected_item[0]['item_code'])?> ) <? } 
else {
   echo "WORK EXPERIENCE FAIR( EXHIBITION )";
}
?>
</h3>
</div>


<div class="container">


<?php echo form_open('', array('id' => 'resultEntryBulkList', 'name' => 'resultEntryBulkList'));

//echo "<br />lllllllll-->".$add_edit;
@$is_all_confirmed == "yes";

if(@$selected_fair_id == 4 && $exb != 2)
{
	//echo "<br /><br />kkkkkkkk--".@$selected_fair_id;
	//@$is_all_confirmed	=	$this->Result_Model->is_exhibition_confirmed();
	//@$is_all_confirmed	=	'yes';

}



	$Partitot_limit	=	count(@$participant_list);
	//echo "-------->".$Partitot_limit;
	$code_confirmed	=0;$codeGeneratedFlag=0;
	for($m=0;$m<@$Partitot_limit;$m++)
	{//echo '<br><br>code_confirm==='.@$participant_list[$m]['codeGeneratedFlag'].'<br>';
		if(@$participant_list[$m]['code_confirmed']==0)
		{
			$code_confirmed=1;
			break;
		}
		
		if(@$participant_list[$m]['codeGeneratedFlag']==0)
		{
			$codeGeneratedFlag=1;
			break;
		}
	}
	
	//echo "<br /><br />jjjj";
	
	if($code_confirmed==1 || $codeGeneratedFlag==1)
		{
		?>
        <table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
	
	<tr><td align="center"> <?php 
			echo 'Code No. is not alloted to all participants... '; ?>
        </td></tr>
        <tr><td align="center">
        <?php if(@$selected_fair_id==4){ ?> 
		<a href="<?php echo base_url().'index.php/report/codegen'; ?>" >Code Entry Form</a>
		<?php }else{?>
        <a href="<?php echo base_url().'index.php/report/prereport/callsheet_first/1/'.@$selected_fest_id.'/'.@$selected_fair_id.'/'.@$selected_item_id;?>" >Code Entry Form</a>
        <?php } ?>
        </td></tr>
        </table>
        <?php 
		//	echo 'Code No. is not alloted to all participants ';
		}
		else if(@$is_all_confirmed == "no")
		{?>
            <table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
            
            <tr><td align="center"><font color="#FF0000" size="+1"><?php 
            echo 'Exhibition Result Entry is not yet confirmed for all sub districts..'; ?></font>
            </td></tr>            
            </table>
		
		
		<? }
		else
		{
?>
<div id="print_content" >
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
<? if(isset($show_conirm_button) && 'no' == $show_conirm_button && count(@$selected_item_dtls)>0)
   { ?>
	<tr>
    <th colspan="11" align="right">Print&nbsp;&nbsp;<img src="<?php echo base_url(false).'images/print_icon.png';?>" title="print" class="window_print" 
		onClick="javascript:printContent('print_content');return false;" /></th>
    </tr>
    <tr>
    <th colspan="11" align="center"><? if($exb != 2) { echo @$selected_fair_name[0]['fairName'];?> - <?php @print($selected_item[0]['item_name'])?> ( <?php @print($selected_item[0]['item_code'])?> ) <? } 
else {
   echo "WORK EXPERIENCE FAIR( EXHIBITION )";
}
?></th>
    </tr>
    <? } ?>
	<tr>
		<th align="left" width="16%">Sl No</th>
		<th align="left" width="13%">Code No</th>
    <?php for($i = 1; $i <= @$cnt_judges; $i++ ){?>
        	<th align="left" width="11%">Mark <?php echo $i?></th>
        <?php }?>
        <th align="left" width="9%">Total</th>
         <th align="left" width="9%">% Mark</th>
        <th align="center" width="6%">Rank</th>
        <th align="center" width="7%">Grade</th>
        <th align="center" width="9%">Point</th>  
		
		<?php if((@$add_edit == 'no'  && $show_conirm_button == 'yes') || (isset($show_conirm_button) && 'no' == $show_conirm_button && count(@$selected_item_dtls)>0)){?>
        <!--<th align="center" width="25%">Edit</th>-->
        <th align="center" width="20%">Delete</th>
        
		<?php }
		else { ?>
			 <th align="center" width="20%">Absent</th>
		<? }
		?>
	</tr>
    
    <?php 		
		
		//var_dump($selected_item_list);
		$count	=	1;
		$cnt_judges		=	(int)@$selected_item[0]['no_of_judges'];
		$Partitot	=	count(@$participant_list);
	
		$a_grade_count = $b_grade_count = $c_grade_count = $withheld_count = 0;
		//echo "--------><br>".print_r(@$participant_list);echo '<br><br><br><br>';
		//echo "--------><br><br><br>";
		// print_r(@$selected_item_list);
		for($p=0;$p<@$Partitot;$p++)
		{//echo '<br>itemcode==='.@$participant_list[$p]['pi_id'].'<br>';
		   $partiId	=	'hidPartiId'.$count;
		   if($exb != 2) {
		   		$selected_item_list=	$this->Result_Model->get_item_result_list_bulk($selected_item[$p]['item_code'],@$participant_list[$p]['pi_id']); }
		   else{
		   		$selected_item_list=	$this->Result_Model->get_item_result_list_bulk_exb(@$selected_fest_id,@$participant_list[$p]['pi_id']);
		   }
		  // echo "--------><br>".print_r(@$selected_item_list);echo '<br><br><br><br>';
		
		if (@$selected_item_list[0]['grade'] == 'A') $a_grade_count++;
				else if (@$selected_item_list[0]['grade'] == 'B') $b_grade_count++;
				else if (@$selected_item_list[0]['grade'] == 'C') $c_grade_count++;
				
				$withheld_simbol	= '';
				if (@$selected_item_list[0]['is_withheld'] == 'Y')
				{
					$withheld_simbol	= '<span class="with_held"> * </span>';
					$withheld_count++;
				}
				
	?>
    
    <tr>
	    <td align="left"  class="table_row_first"><? echo $count; ?></td>
		<td align="left"  class="table_row_first"><?php  echo @$participant_list[$p]['prefixCode']."". @$participant_list[$p]['codeNo']; if(@$participant_list[$p]['spo_id']){ echo "<font color='red'>*</font>"; }?></td>
        <input type="hidden" name="<? echo $partiId; ?>" id="<? echo $partiId; ?>" value="<? echo @$participant_list[$p]['participant_id']; ?>">
        
		<?php 
			$marks_array	=	explode('#$#', @$selected_item_list[0]['marks']);
			//echo "<br /><br />-------".$cnt_judges;
			for($i = 1; $i <= $cnt_judges; $i++ ){ 
				$markid		=	"mark_".$i."_".$count;
				
			?>
            <td align="left" class="table_row_first">
            
            <?   
				$marks	=	@$marks_array[$i-1];
				if(@$marks_array[$i-1] == '') { $marks	=	0; }
				if((@$show_conirm_button=='no' && count(@$selected_item_dtls)==0))
				{
					
					echo form_input($markid, @$marks, 'class="input_box_small" id="'.$markid.'" maxlength="5" onkeypress="javascript:return numbersonly(this, event, true);"  onBlur="javascript:return checkmark(this.id,this.value,'.$exb.');"');
				}
				else 
				{
					
					echo (@$add_edit == 'no')?(count(@$selected_item_list) > 0)?@$marks:'' :form_input($markid, @$marks, 'class="input_box_small" id="'.$markid.'" maxlength="5" onkeypress="javascript:return numbersonly(this, event, true);"  onBlur="javascript:return checkmark(this.id,this.value,'.$exb.');"');
				}
				
				
				
			?>&nbsp;&nbsp;&nbsp;
	
			</td> 
			<?
			} ?>
			<td align="left" class="table_row_first">
            <?
			$totalMark	=	"totalMark_".$count;
			$tot_marks	=	@$selected_item_list[0]['total_mark'];
			if(@$selected_item_list[0]['total_mark'] == '') { $tot_marks	=	0; }
			//if(@$participant_list[$p]['prefixCode'].@$participant_list[$p]['codeNo']==@$selected_item_list[0]['code_no'])
			//{
			//echo "<br /><br />";
			//var_dump(@$selected_item_list);
			if((@$show_conirm_button=='no' && count(@$selected_item_dtls)==0))
			{
				
				echo form_input($totalMark, @$tot_marks, 'class="input_box_small" id="'.$totalMark.'" maxlength="6" onkeypress="javascript:return numbersonly(this, event, true);" onblur="javascript:return fnc_ifabsnt('.$count.',this.value);"');
			}
			else 
			{
				//echo "hhhh";
				echo (@$add_edit == 'no')?(count(@$selected_item_list) > 0)?@$tot_marks:'' :form_input($totalMark, @$tot_marks, 'class="input_box_small" id="'.$totalMark.'" maxlength="6" onkeypress="javascript:return numbersonly(this, event, true);" onblur="javascript:return fnc_ifabsnt('.$count.',this.value);"');
			}
			//echo (@$add_edit == 'no' && count(@$selected_item_list) > 0)? @$selected_item_list[0]['total_mark']:form_input($totalMark, @$selected_item_list[0]['total_mark'], 'class="input_box_small" id="'.$totalMark.'" maxlength="6" onkeypress="javascript:return numbersonly(this, event, true);"');
		//	}
			?>
            </td>
            <td align="left" class="table_row_first"><?php 
			if(@$participant_list[$p]['prefixCode'].@$participant_list[$p]['codeNo']==@$selected_item_list[0]['code_no'])
			{
			
			echo @$selected_item_list[0]['percentage'];
			}
			
			?></td>
			<td align="center" class="table_row_first"><?php 
			if(@$participant_list[$p]['prefixCode'].@$participant_list[$p]['codeNo']==@$selected_item_list[0]['code_no'])
			{	
				echo @$selected_item_list[0]['rank'];
			}	
			?></td>
			<td align="center" class="table_row_first"><?php 
			if(@$participant_list[$p]['prefixCode'].@$participant_list[$p]['codeNo']==@$selected_item_list[0]['code_no'])
			{
				echo @$selected_item_list[0]['grade'];
			}
			?></td>
			<td align="center" class="table_row_first"><?php 
			if(@$participant_list[$p]['prefixCode'].@$participant_list[$p]['codeNo']==@$selected_item_list[0]['code_no'])
			{
				echo @$selected_item_list[0]['point'];
			}	
			?></td>
           <td align="center"  class="table_row_first">  
      	<?php 
		//echo '<br><br><br>';
		//print_r($selected_item_list[$p]);
		//echo "<br />--->".$add_edit;
		if(@$participant_list[$p]['prefixCode'].@$participant_list[$p]['codeNo']==@$selected_item_list[0]['code_no'])
		{
			//echo '<br><br><br>ooooooooo';
		   if((@$add_edit == 'no'  && $show_conirm_button == 'yes')){
			
		?>
         
             <!--<td align="center"  class="table_row_first">
               <a href="javascript:void(0)" onClick="javascript:editResult('<?php echo @$selected_item_list[0]['rm_id']?>')">
                    <img src="<?php echo base_url(false)?>images/edit.gif" border="0">
                </a>
            </td>-->
            
                <a href="javascript:void(0)" onClick="javascript:deleteBulkResult('<?php echo @$selected_item_list[0]['rm_id']?>')">
                    <img src="<?php echo base_url(false)?>images/delete.gif" border="0">
                </a>
            
			<?php } 
			
			else if (@$add_edit == 'yes'){ 
			       
				  // echo "<br />kkkk-->".@$selected_item_list[0]['total_mark'];
					$chk_absent	= "chk_absent".$count;
					
					if(@$selected_item_list[0]['total_mark'] == '' )
					{  $checked = "checked"; }
				    else {
				       $checked = ""; }
						
			      ?>
                  	  <input type="checkbox" name="<?php echo $chk_absent;?>" id="<?php echo $chk_absent;?>"  onclick="javascript:fnchk_absnt(<? echo $cnt_judges; ?>,<? echo $count; ?>)"   <?php echo $checked?>/>		
			    <?
				
			  }
			
			}
			else{  
					 //if(@$add_edit != 'no' || (@$show_conirm_button == 'no' && $add_edit == 'no')){              echo 
					// if (!isset($show_conirm_button) && 'no' != $show_conirm_button && count(@$selected_item_dtls)<=0){
					//echo "<br />-->".@$selected_item_list[0]['code_no'];
					if((@$add_edit == 'yes') || (@$show_conirm_button == 'no' && $add_edit == 'no')){
					 $chk_absent = "chk_absent".$count;					
					 if(@$selected_item_list[0]['total_mark'] == '' )
					 {  $checked = "checked"; }
				     else {
				        $checked = ""; }
						
					if((@$add_edit == 'no'  && $show_conirm_button == 'yes') || (isset($show_conirm_button) && 'no' == $show_conirm_button && count(@$selected_item_dtls)>0)){
					}
					else{
			      ?>
                  
                  	  <input type="checkbox" name="<?php echo $chk_absent;?>" id="<?php echo $chk_absent;?>"   onclick="javascript:fnchk_absnt(<? echo $cnt_judges; ?>,<? echo $count; ?>)"   <?php echo $checked?> />		
			    <?  }
				
				  }
				
				}
			
			
			?>
       	</td>
    </tr>
     <?php
	       $count++; 
	     }
		
		 ?>
        
        <tr>
		<td align="center" colspan="10">
		<?php 
		/*echo "count(selected_item_list)----";
		
		echo "---show_conirm_button----".$show_conirm_button."---add_edit---".@$add_edit;
*/		
	//	var_dump(@$selected_item_dtls);
		//echo "----".@$selected_item_dtls[0][''];
   if(count(@$selected_item_dtls) > 0 && $show_conirm_button == 'yes' && @$add_edit == 'no')
		{
	?>
			<tr>
				<td align="left"><input type="button" value="Confirm Results" onClick="javascript:confirmBulkResutlEntry();return false;"/></td>
                <td align="left"><input type="button" value="Edit Results" onClick="javascript:editBulkResutlEntry();return false;"/></td>
			</tr>
	<?php
		}
		//echo count(@$selected_item).'---'.$add_edit;
		
			//echo $show_conirm_button.'+++++++++<br>';
		if (isset($show_conirm_button) && 'no' == $show_conirm_button && count(@$selected_item_dtls)>0)
		{
		
			//var_dump($absentee_list);
			if (isset($absentee_list) && !empty($absentee_list)) 
			{
				$absentee_array	= explode(',', $absentee_list);
				
			}
			else $absentee_array = array();
			
			
			//var_dump($absentee_array);
	?>
			<tr>
            	
				<td align="left" colspan="<?php echo ($show_conirm_button == 'yes')? @$cnt_judges+10: @$cnt_judges+8;?>">
					<table width="100%" cellpadding="0" cellspacing="0" border="0">
						<tr>
							<td width="50%">
								<br/>
								<div><b>No of Absentees &nbsp;&nbsp;&nbsp;&nbsp;: <?php echo count($absentee_array);?></b></div>
								<?php if(0 < count($absentee_array)){?>
								<div style="margin-top:7px;"><b>Absentees &nbsp;&nbsp;&nbsp;&nbsp;: <?php if($exb	==	2){
			   					$absentee_list = explode(',', @$absentee_list);
								for($i=0;$i<=count($absentee_list);$i++){
								$dist_name	=	$this->General_Model->get_data('rev_district_master', 'rev_district_name', array("rev_district_code" => @$absentee_list[$i]));	
								echo @$dist_name[0]["rev_district_name"]."&nbsp;&nbsp;&nbsp;";
								}
				          } else{
				            	echo @$absentee_list;
							}
							?></b></div>
								<?php }?>
								<div style="margin-top:7px;"><b><span class="with_held"> * </span> No of Withheld participants &nbsp;&nbsp;&nbsp;&nbsp;: <?php echo $withheld_count;?></b></div>
								<br/>
							</td>
                            <td align="left">
                            <? if($exb	!=	2){ ?>
                            <a target="_blank" href="<?php echo base_url();?>index.php/report/timefestreportpdf/confidential/1/<? echo @$selected_item_id; ?>/<? echo @$selected_fest_id; ?>/<? echo @$selected_fair_id; ?>" title="Confidential Report">Confidential Result Report</a><? } else { ?>
                         <a target="_blank" href="<?php echo base_url();?>index.php/report/timefestreport/confidential_exhb/<? echo @$selected_fest_id; ?>/<? echo @$selected_fair_id; ?>" title="Confidential Report">Confidential Result Report</a><? } ?>    
                             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                 <? if(@$selected_item_dtls[0]['is_publish'] == 'N') { ?>
                <input type="button" value="Publish Result" onClick="javascript:PublishResutlEntry();return false;"/>
                <? } ?>
                </td>
							<td width="50%">
								<table width="100%" cellpadding="3"  cellspacing="0" border="0">
									<tr>
										<td width="40%">&nbsp;</td>
										<td align="center"><b>A Grade</b></th>
										<td align="center"><b>B Grade</b></th>
										<td align="center"><b>C Grade</b></th>
									</tr>
									<tr>
										<td width="10%">&nbsp;</td>
										<td align="center"><?php echo $a_grade_count;?></td>
										<td align="center"><?php echo $b_grade_count;?></td>
										<td align="center"><?php echo $c_grade_count;?></td>
									</tr>
									<tr>
										<td width="10%">&nbsp;</td>
										<td colspan="3">
											
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					
				</td>
			</tr>
	<?php		
		
			}
			else
			{
			//echo $add_edit.'--'.count(@$selected_item);
		//	echo "---show_conirm_button----".$show_conirm_button."---add_edit---".@$add_edit;
				if (count(@$selected_item) > 0){
					if(@$add_edit == 'yes'){
						echo form_button('Update', 'Update', 'onClick="javascript:fncSaveBulkResultEntry()"');
						//echo '&nbsp;&nbsp;&nbsp;'.form_button('Cancel', 'Cancel', 'onClick="javascript:fncCancel()"');
					} else if(@$show_conirm_button == 'no' && $add_edit == 'no') {
					
						echo form_button('Save', 'Save', 'onClick="javascript:fncSaveBulkResultEntry()"');
					}
					
				}
				else 
				{
				echo form_button('Save', 'Save', 'onClick="javascript:fncSaveBulkResultEntry()"');
				}
			}
			
			
		?>
		</td>
	</tr>
        
  </table>
  <?php } 
  $item_cod	=	(@$selected_item[0]['item_code']) ? @$selected_item[0]['item_code'] : @$this->input->post('hidItemId');
		$len			=	strlen($item_cod);
		$exb	=	@$selected_item[0]['exhibition'];
		if($exb == 2)  {  @$item_cod	=	'exb'; }
  ?>  
  <input type="hidden" name="hidPartitot" id="hidPartitot" value="<? echo @$Partitot; ?>">      
<input type="hidden" name="hidedit" id="hidedit" value="0" />
<input type="hidden" name="hidupdated" id="hidupdated" value="0" />
<input type="hidden" name="hidItemId" id="hidItemId" value="<?php echo (@$item_cod);?>">
<input type="hidden" name="hidNoJudge" id="hidNoJudge" value="<?php echo (@$cnt_judges)?>">
<input type="hidden" name="hidResultId" id="hidResultId" value="">
<input type="hidden" name="hidFestid" id="hidFestid" value="<?php echo (@$selected_fest_id)?>">
<?php 

echo form_close();

}
?>
</div>
</div>
</div>
<!-- print content starts here----------------------------------->

<!-- display content ends here --------------------------------------->
<?php if (@$this->input->post('hidItemId') and $show_conirm_button == 'yes'){?>
<script language="JavaScript">
	window.onload = $('txt_reg_no').focus();;
</script>
<?php }?>