<br />
<?php echo form_open('ground/ground_details/add_ground', array('id' => 'editGround'));

?>
<div class="container">  
<table width="100%" border="0"  align="center" class="heading_tab" style="margin-top:15px;">

  <tr >
    <th colspan="5" align="left">Venue</th>
  </tr>
  <tr bgcolor="#CFCFCF">
    <th align="center" width="10%" class="table_row_first">Sl.No.</th>
    <th align="left"  width="40%"  class="table_row_first">Venue Name</th>
    <th align="left" width="40%"  class="table_row_first">Venue description</th>
    <th align="center" width="10%"  class="table_row_first">Edit</th>
    <!--<th align="center" width="10%"  class="table_row_first">Delete</th>-->
  </tr>
  <?php
$i=1;
foreach($grounds as $value)
	{
	
?>
  <tr bgcolor="#F5F5F5" style="border-bottom:1px solid #CFCFCF;height:20px;">
    <td align="center" ><?php echo $i; ?></td>
    <td align="left" ><?php echo ($value['ground_name']); ?></td>
    <td align="left" ><?php echo ($value['ground_desc']); ?></td>
    <td align="center"  ><a href="javascript:void(0)" onClick="javascript:editGround('<?php echo $value['ground_id']?>')"> <img src="<?php echo base_url(false)?>images/edit.gif" border="0"> </a> </td>
    <!--<td align="center" ><a href="javascript:void(0)" onClick="javascript:deleteStage('<?php echo $value['ground_id']?>')"> <img src="<?php echo base_url(false)?>images/delete.gif" border="0"> </a> </td>-->
  </tr>
  <? $i++;} ?>
  <input type="hidden" name="hidGroundId" id="hidGroundId" value="">
</table>
</div>
<?php
echo form_close();
?>
