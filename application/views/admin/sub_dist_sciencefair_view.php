<div align="center" class="heading_gray">
	<h3>Sasthrolsavam Details</h3>
</div>

<!--<script language="JavaScript">


//var sURL = unescape(window.location.pathname);


var	url = path+'index.php/admin/sciencefair';
setTimeout( "refresh()", 2*1000 );
//function doLoad()
//{
    // the timeout value should be the same as in the "refresh" meta-tag
    
//}

function refresh()
{

    //  This version of the refresh function will cause a new
    //  entry in the visitor's history.  It is provided for
    //  those browsers that only support JavaScript 1.0.
    //
    window.location.href = url;
}

</script>-->

<?php 

if (@$edit_sciencefair != 'no'){
	echo '<br/>';
	echo form_open_multipart('admin/sciencefair/add_sciencefair', array('id' => 'formSciencefair','name' => 'formSciencefair'));
	//print_r(@$selected_sciencefair);
	?>
	<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
	  <tr>
		<th align="left" colspan="4">Sciencefair</th>
	  </tr>
	   <tr>
		<td align="left" width="20%" class="table_row_first">Sciencefair Logo</td>
		<td align="left" width="40%" class="table_row_first"><?php display_sciencefair_logo('sub_dist', @$selected_sciencefair[0]['logo_name']);?></td>
		<td align="left" colspan="2" class="table_row_first">&nbsp;</td>
	  </tr>
	  <tr>
		<td align="left" class="table_row_first">Sciencefair Name</td>
		<td align="left" class="table_row_first">
			<?php echo @$selected_sciencefair[0]['sub_dist_sciencefair_name'];?>
		<td align="left" colspan="2" class="table_row_first">&nbsp;</td>
	  </tr>
	  <tr>
		<td align="left"  class="table_row_first">Venue</td>
		<td align="left" class="table_row_first"><?php echo form_input("txtSciencefairVenue", @$selected_sciencefair[0]['venue'], 'class="input_box" id="txtSciencefairVenue" ');?></td>
		<td align="left" colspan="2" class="table_row_first">&nbsp;</td>
	  </tr>
	  <tr>
		<td align="left"  class="table_row_first">Start Date</td>
		<td align="left" class="table_row_first">
			<?php if(@$selected_sciencefair[0]['start_date'] == '0000-00-00') @$start_date = '';else @$start_date = @$selected_sciencefair[0]['start_date']; ?>
			<?php echo form_input("txtStartDate", @$start_date, 'class="input_box" id="txtStartDate"  onfocus="javascript:displayCalendar(document.getElementById(\'txtStartDate\'),\'yyyy-mm-dd\',this);" readonly="readonly" ');?>
			 <img src="<?php echo image_url();?>calender.gif" onclick="displayCalendar(document.getElementById('txtStartDate'),'yyyy-mm-dd',this)" width="16" height="16" style="cursor:pointer" />
		</td>
		<td align="left" colspan="2" class="table_row_first">&nbsp;</td>
	  </tr>
	  <tr>
		<td align="left"  class="table_row_first">End Date</td>
		<td align="left" class="table_row_first">
			<?php if(@$selected_sciencefair[0]['end_date'] == '0000-00-00') @$end_date = '';else @$end_date = @$selected_sciencefair[0]['end_date'];?>
			<?php //
			echo form_input("txtEndDate", @$end_date, 'class="input_box" id="txtEndDate"  onfocus="javascript:displayCalendar(document.getElementById(\'txtEndDate\'),\'yyyy-mm-dd\',this);" readonly="readonly" ');?>
			<img src="<?php echo image_url();?>calender.gif" onclick="displayCalendar(document.getElementById('txtEndDate'),'yyyy-mm-dd',this)" width="16" height="16" style="cursor:pointer" />
		</td>
		<td align="left" colspan="2" class="table_row_first">&nbsp;</td>
	  </tr>
	  <tr>
		<td align="left" class="table_row_first">Upload Logo</td>
		<td align="left" class="table_row_first">
			 <input name="sciencefairLogo" id="sciencefairLogo"  type="file" onchange="uploadImage(this.value);" />
			 <?php //echo form_upload("sciencefairLogo", 'class="input_box" id="sciencefairLogo" ');?>
            <img src="" alt="" id="preview" width="40" height="40" > 
			<span class="guide_line">(.jpg, .gif, .png)</span>
		</td>
		<td align="left" colspan="2" class="table_row_first">&nbsp;</td>
	  </tr>
	  <tr>
		<td align="center" colspan="2">
			<?php echo (count(@$selected_sciencefair) > 0 ) ? form_submit('update_sciencefair', 'Update', 'id="update_kalolsavam" onClick="javascript:fncUpdateSciencefair(\'sub_dist\',\''.$selected_sciencefair[0]['sub_dist_sciencefair_id'].'\')"').'&nbsp;&nbsp;'.form_button('Cancel', 'Cancel', 'onClick="javascript:fncCancelSciencefair()"'): form_submit('save_sciencefair', 'Save', 'id="save_sciencefair" onClick="javascript:fncSaveSciencefair();"');?>
		</td>
	  </tr>
	</table>
	<?php if (isset($sciencefair_id) && !empty($sciencefair_id)) {?>
		<input type="hidden" name="sciencefair_id" id="sciencefair_id" value="<?php echo  $sciencefair_id;?>" />
	<?php }?>
	<?php
	
	echo form_close();
}
?>
<br/>
<?php echo form_open('user/admin_users/add_admin', array('id' => 'list_formSciencefair','name' => 'list_formSciencefair'));

?>
<div class="container">
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th width="5%">Sl No.</th>
	<th width="35%">Sciencefair Name</th>
	<th width="25%">Venue</th>
	<th width="25%">Date</th>
	<th width="10%">Edit</th>
  </tr>
  <?php 
  $count = 0;
  foreach($sciencefair_details as $sciencefair){
  	$count++;
  	$class_name = ($count % 2 == 0) ? 'table_row_second' : 'table_row_first';
  ?>
  	<tr>
		<td align="left" class="<?php echo $class_name;?>" ><?php echo $count;?></td>
		<td align="left" class="<?php echo $class_name;?>" ><?php echo $sciencefair['sub_dist_sciencefair_name'];?></td>
		<td align="left" class="<?php echo $class_name;?>" ><?php echo $sciencefair['venue'];?></td>
		<td align="left" class="<?php echo $class_name;?>" >
			<?php
				if($sciencefair['start_date'] == '0000-00-00') echo 'NULL';else echo date("j M Y", strtotime($sciencefair['start_date']));
				echo '&nbsp; - &nbsp;';
				if($sciencefair['end_date'] == '0000-00-00') echo 'NULL';else echo date("j M Y", strtotime($sciencefair['end_date']));
			?>
		</td>
		<td align="left" class="<?php echo $class_name;?>">
			<?php if ($sciencefair['status'] == 'O'){?>
			<a href="javascript:void(0)" onClick="javascript:fncEditSciencefair('<?php echo $sciencefair['sub_dist_sciencefair_id']?>');return false;">
				<img src="<?php echo base_url(false)?>images/edit.gif" border="0">
			</a>
			<?php }?>
		</td>
	</tr>
  <?php }?>
</table>
</div>
<input type="hidden" name="sel_sciencefair_id" id="sel_sciencefair_id" />
<!--<input type="hidden" name="base_url" id="base_url" value="<?php echo  base_url();?>" />-->
<?php echo form_close(); ?>
