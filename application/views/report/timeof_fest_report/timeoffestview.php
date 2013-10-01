<div class="container">
<div align="center" class="heading_gray">
<h3> <?php if($fest !=0){echo $resultdet[0]['fairName'];}else{echo "WorkExperience Fair";} ?></h3>
</div>

<?php echo form_open('', array('id' =>'resreport','target'=>'_blank'));

?>
<input type="hidden" name="hiditemcode" id="hiditemcode" />
<input type="hidden" name="hidFestcode" id="hidFestcode" value="<?php echo $fest; ?>" />
<input type="hidden" name="hidFaircode" id="hidFaircode" value="<?php echo $fair; ?>" />
<?php if($fest !=0)
{?>
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="2" align="left">&nbsp;&nbsp;Festival : &nbsp;<?php echo $resultdet[0]['fest_name']; ?></th>
    <th class="table_row_first" >&nbsp;&nbsp;</th>
  </tr>
  <tr>
    <th align="left" width="44%" >&nbsp;&nbsp;&nbsp;Item </th>
    <th align="left" width="30%" >Item Type</th>
    <th width="17%" >&nbsp;</th>
  </tr>
	  <?php
	  foreach($resultdet as $value){
	  	
			if($value['item_type']=='S') 
					$item_type='Single';
			else 
				$item_type='Group';
      
      ?>
  <tr>
    <td class="table_row_first">&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" onClick="javascript:resultprintout('<?php echo $value['item_code'] ?>')">
	<?php echo $value['item_code'].' - '.$value['item_name']; ?></a></td>
    <td align="left" width="44%" class="table_row_first"><?php echo $item_type; ?></td>
    <td align="left" width="30%" class="table_row_first">
          </td>
  </tr>
	  <?php
      }
	 
      ?>
      <tr>
      		<td class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="javascript:void(0)" onClick="javascript:resultallprint()">
            All Results</a></td>
     		 <td class="table_row_first"></td>
     		 <td class="table_row_first"></td>
      </tr>
  
  <tr>
    <td align="center" colspan="3">&nbsp;</td>
  </tr>
</table>
<?php }
else
{?>


<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="2" align="left">&nbsp;&nbsp;Festival : &nbsp;<?php echo $fest_id; ?></th>
    <th class="table_row_first" >&nbsp;&nbsp;</th>
  </tr>
  <tr>
    <th align="left" width="44%" >&nbsp;&nbsp;&nbsp;Item </th>
    <th align="left" width="30%" >Item Type</th>
    <th width="17%" >&nbsp;</th>
  </tr>
	  <?php
	  foreach($resultdet as $value){
	  	
				$item_type='Single';
      
      ?>
  <tr>
    <td class="table_row_first">&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" onClick="javascript:resultprintout('<?php echo $value['item_code'] ?>')">
	<?php echo $value['item_code'].' - '.$value['school_name']; ?></a></td>
    <td align="left" width="44%" class="table_row_first"><?php echo $item_type; ?></td>
    <td align="left" width="30%" class="table_row_first">
          </td>
  </tr>
	  <?php
      }
	 
      ?>
      <tr>
      		<td class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="javascript:void(0)" onClick="javascript:resultallprint()">
            All Results</a></td>
     		 <td class="table_row_first"></td>
     		 <td class="table_row_first"></td>
      </tr>
  
  <tr>
    <td align="center" colspan="3">&nbsp;</td>
  </tr>
</table>
<?php }
?>
<!-- print content starts here----------------------------------->
<div id="print_content" class="display_none" >

<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="4" align="left">Result Declared Items Festival:&nbsp;<?php echo $resultdet[0]['fest_name']; ?></th>
  </tr>
  <tr>
    <th align="left" width="44%" >&nbsp;&nbsp;&nbsp;Item Code & Name</th>
    <th align="left" width="30%" >Item Type</th>
    <th width="17%" >&nbsp;</th>
  </tr>
	  <?php
	  foreach($resultdet as $value){
	  	
			if($value['item_type']=='S') 
					$item_type='Single';
			else 
				$item_type='Group';
      
      ?>
  <tr>
    <td class="table_row_first">&nbsp;&nbsp;&nbsp;
	<?php echo $value['item_code'].' - '.$value['item_name']; ?></td>
    <td align="left" width="44%" class="table_row_first"><?php echo $item_type; ?></td>
    <td align="left" width="30%" class="table_row_first">
          </td>
  </tr>
	  <?php
      }
	 
      ?>
      
  
  <tr>
    <td align="center" colspan="3">&nbsp;</td>
  </tr>
</table>



</div>
<!-- print content end here----------------------------------->
<?php
//itemwise_report_interface

echo form_close();
?>
</div>
