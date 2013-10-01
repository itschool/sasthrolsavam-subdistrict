<br />
<?php echo form_open(base_url().'index.php/ground/item_participant/ground_allot_fest_all', array('id' => 'formIWPq','name' => 'formIWPq'));
//echo '<br><br><br>';
//print_r($_POST);
?>

<input type="hidden" name="txtItemCode" id="txtItemCode" value=""  />
<input type="hidden" name="cmbFestType"   id="cmbFestType" value="<?php echo @$_POST['cmbFestType'];?>"  />
<input type="hidden" name="cmbFairType" id="cmbFairType" value="<?php echo @$_POST['cmbFairType'];?>"  />

<div class="container">
<table width="100%" border="0" cellspacing="0" cellpadding="6" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="6" align="left"> 
    &nbsp;&nbsp;&nbsp;Festival  : 
	<?php echo @$itempart[0]['fest_name'] ? @$itempart[0]['fest_name'] : @$single[0]['fest_name']; ?>&nbsp;&nbsp;</th>
  </tr>
  <tr>
    <th width="25%" class="table_row_first"><?php echo (@$_POST['cmbFairType']==4 && @$_POST['cmbWrkexpType']==2)?'&nbsp;School':'&nbsp;Item'; ?></th>
    <th align="center" width="10%" class="table_row_first"> No of Participants</th>
    <th align="left" width="30%" class="table_row_first">Date & Time(Date HH:MM)</th>
     <th align="left" width="8%" class="table_row_first">Venue</th>
     <th  width="12%" class="table_row_first">No of judges</th>
  </tr>
  
  <?php
  	$judge_array	=	array();
	//echo '<br><br>';
	//print_r($single);
	for($i = 1; $i <= $no_of_judges; $i++ )
				$judge_array[$i]	=	$i;
 	for($j=0;$j<count($single);$j++){
		$item_code	=	$single[$j]['item_code'];
		$date		=	date('Y-m-d',strtotime($single[$j]['start_time']));
		$hour		=	date('H',strtotime($single[$j]['start_time']));
		$min		=	date('i',strtotime($single[$j]['start_time']));
		$ground_array	=	array();
		for($i = 0; $i < count($grounds); $i++ ){
			$ground_array[$grounds[$i]['ground_id']]	=	$grounds[$i]['ground_name'];
		}
		
		$value_array	=	array();
		$limit = (@$single[$j]['is_off_stage'] == 'Y') ? 1 : ((@$no_of_clusters > @$single[$j]['cpt']) ? @$single[$j]['cpt'] : @$no_of_clusters);
		for($i = 1; $i <= $limit; $i++ )
			$value_array[$i]	=	$i;
			
			
			//echo '<br><br><br>ddddd'.$item_code;
	?>
     <tr>
    <td  class="table_row_first" align="left">
	<a href="javascript:void(0)" onClick="javascript:getitemgrounddet('<?php echo $single[$j]['item_code'] ?>')">
	<?php 
	
	if(@$_POST['cmbFairType']==4 && @$_POST['cmbWrkexpType']==2)
	{
		echo $single[$j]['school_code'].'&nbsp;-&nbsp;'.$single[$j]['school_name'];
	}
	else
	{
		echo $single[$j]['item_code'].'&nbsp;-&nbsp;'.$single[$j]['item_name'].'('.$single[$j]['item_type'].')'; 
	}
	?></a> </td>

    <td align="center" class="table_row_first">
     <?php
		if(@$_POST['cmbFairType']==4 && @$_POST['cmbWrkexpType']==2)
		{
			echo 1; 
		}
		else
		{ 
			echo $single[$j]['cpt']; 
		}
	 ?></td>
    <input type="hidden" name="hidMaxPartcipants<?php echo $item_code;?>" id="hidMaxPartcipants<?php echo $item_code;?>" value="<?php echo $single[$j]['cpt'];?>"  /> 
    <td align="left" class="table_row_first">
     <?php echo form_dropdown('txtDate'.$item_code,$date_array,$date,'id="txtDate'.$item_code.'"');?>
     <?php echo form_dropdown('txtHour'.$item_code, @$hour_array,$hour, 'class="input_box_small" id="txtHour'.$item_code.'"' );?>
     <?php echo form_dropdown('txtMin'.$item_code, @$min_array,$min, 'class="input_box_small" id="txtMin'.$item_code.'"' );?>
	 <?php //echo $single[$j]['start_time']; ?></td>
     
     
       <td align="left" class="table_row_first"> 
       <?php echo form_dropdown('cmbGround'.$item_code, $ground_array, @$single[$j]['ground_id'],'id="cmbGround'.$item_code.'"');?>
	   <?php //echo $single[$j]['stage_name']; ?></td>
       <td align="center" class="table_row_first">
     <?php echo form_dropdown('cmbNoOfJudges'.$item_code, $judge_array, (@$single[$j]['no_of_judges']) ? @$single[$j]['no_of_judges'] : '3','id="cmbNoOfJudges'.$item_code.'" class="input_box_small"');?>
      </td>
  </tr>
    
    	
	
	<?php
	}
	?>
    
    
 <?php
 if(@$_POST['cmbWrkexpType']!=2){
 	for($j=0;$j<count($itempart);$j++){
		$item_code	=	$itempart[$j]['item_code'];
		$date		=	date('Y-m-d',strtotime($itempart[$j]['start_time']));
		$hour		=	date('H',strtotime($itempart[$j]['start_time']));
		$min		=	date('i',strtotime($itempart[$j]['start_time']));
		$ground_array	=	array();
		for($i = 0; $i < count($grounds); $i++ ){
			$ground_array[$grounds[$i]['ground_id']]	=	$grounds[$i]['ground_name'];
		}
		
		$value_array	=	array();
		$limit = (@$itempart[$j]['is_off_stage'] == 'Y') ? 1 : ((@$no_of_clusters > @$itempart[$j]['cpt']) ? @$itempart[$j]['cpt'] : @$no_of_clusters);
		for($i = 1; $i <= $limit; $i++ )
			$value_array[$i]	=	$i;
	?>
     <tr>
    <td  class="table_row_first" align="left">
	<a href="javascript:void(0)" onClick="javascript:getitemgrounddet('<?php echo $itempart[$j]['item_code'] ?>')">
	<?php echo $itempart[$j]['item_code'].'&nbsp;-&nbsp;'.$itempart[$j]['item_name'].'('.$itempart[$j]['item_type'].')'; ?></a> </td>

    <td align="center" class="table_row_first">
     <?php echo $itempart[$j]['cpt']; ?></td>
     <input type="hidden" name="hidMaxPartcipants<?php echo $item_code;?>" id="hidMaxPartcipants<?php echo $item_code;?>" value="<?php echo $itempart[$j]['cpt'];?>"  />
    <td align="left" class="table_row_first">
     <?php echo form_dropdown('txtDate'.$item_code,$date_array,$date,'id="txtDate'.$item_code.'"');?>
     <?php echo form_dropdown('txtHour'.$item_code, @$hour_array,$hour, 'class="input_box_small" id="txtHour'.$item_code.'"' );?>
     <?php echo form_dropdown('txtMin'.$item_code, @$min_array,$min, 'class="input_box_small" id="txtMin'.$item_code.'"' );?>
	 <?php //echo $itempart[$j]['start_time']; ?></td>
     
     
       <td align="left" class="table_row_first"> 
       <?php echo form_dropdown('cmbGround'.$item_code, $ground_array, @$itempart[$j]['ground_id'],'id="cmbGround'.$item_code.'"');?>
	   <?php //echo $itempart[$j]['stage_name']; ?></td>
   
       <td align="center" class="table_row_first">
     <?php echo form_dropdown('cmbNoOfJudges'.$item_code, $judge_array, (@$itempart[$j]['no_of_judges']) ? @$itempart[$j]['no_of_judges'] : '3','id="cmbNoOfJudges'.$item_code.'" class="input_box_small"');?>
      </td>
  </tr>
    	
	
	<?php
	}}
	?>
    <input type="hidden" name="cmbWrkexpType" id="cmbWrkexpType" value="<?php echo @$_POST['cmbWrkexpType'];?>"  />
    <tr>
    	<td align="center" colspan="6">
        	<?php echo form_submit('Allotment','Allotment')?>
        </td>
    </tr>
</table>

</div>

<?php
//itemwise_report_interface

echo form_close();
?>