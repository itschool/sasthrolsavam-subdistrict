<br />

<?php echo form_open('user/user_registration/userinsert', array('id' => 'editUser','name' => 'editUser'));



?>

<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="5" align="left"> Existing Users </td>
  </tr>
  <tr>
    <th align="center" class="table_row_first">Sl.No.</th>
    <th align="left" class="table_row_first">User Name</th>
    <th align="center" class="table_row_first">Edit</th>
    <th align="center" class="table_row_first">Delete</th>
  </tr>
  <?php
$i=1;
foreach($retvalue as $value)
	{
	$class_name = ($i % 2 == 0) ? 'table_row_first' : 'table_row_second';
?>
  <tr>
    <td align="center" class="<?php echo $class_name;?>"><?php echo $i; ?></td>
    <td align="left" class="<?php echo $class_name;?>"><?php echo ($value['user_name']); ?></td>
    <td align="center" class="<?php echo $class_name;?>" ><a href="javascript:void(0)" onClick="javascript:editAdminUser('<?php echo $value['user_id']?>')"> <img src="<?php echo base_url(false)?>images/user_edit.png" border="0" width="20" height="20" > </a> </td>
    <td align="center" class="<?php echo $class_name;?>"><a href="javascript:void(0)" onClick="javascript:deleteAdminUser('<?php echo $value['user_id']?>')"> <img src="<?php echo base_url(false)?>images/user_delete.png" border="0" width="20" height="20" > </a> </td>
  </tr>
  <? $i++;} ?>
  <input type="hidden" name="UserIdty" id="UserIdty" value="">
</table>

