<style type="text/css">
<!--
.style1 {
	color: #6666FF;
	font-weight: bold;
}
-->
</style>

<br/>

<?php echo form_open('', array('id' => 'formIWPq'));

?>

<input type="hidden" name="hidItemId" id="hidItemId" value=""  />

<table width="100%" border="0" cellspacing="0" cellpadding="6" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="<?php echo ($this->session->userdata('USER_GROUP') == 'A' || $this->session->userdata('USER_GROUP') == 'W') ? 6 : 5?>" align="left"> 
    
	<? echo "WORK EXPERIENCE"; ?>&nbsp;&nbsp;&nbsp;( <?php echo "EXHIBITION"; ?>)</th>
	<th align="right">Print&nbsp;&nbsp;<img src="<?php echo base_url(false).'images/print_icon.png';?>" title="print" class="window_print" 
		onClick="javascript:printContent('print_content');return false;" /></th>
  </tr>
  <tr>
    <th width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;Category</th>
    
	<!-- <th align="center" width="10%" class="table_row_first">Stage</th> -->
    <th align="center" width="10%" class="table_row_first"> No of Schools</th>
    <th align="center" width="15%" class="table_row_first">Result Entered</th>
	<th align="center" width="15%" class="table_row_first">Result Not Entered</th>
	<th align="center" width="10%" class="table_row_first">Confirmed</th>
	<?php if($this->session->userdata('USER_GROUP') == 'A' || $this->session->userdata('USER_GROUP') == 'W' || $this->session->userdata('USER_GROUP') == 'U'){;?>
    <th align="center" width="20%" class="table_row_first">Reset Confirmation</th>
	<?php }?>
  </tr>
  
  <?php
 // var_dump($single);
 	
		
		?>
		<tr>
			<td width="27%" class="table_row_first">
				&nbsp;&nbsp;
				<span class="style1">LP</span>			</td>
			
<!-- <td align="center" class="table_row_first"><?php //echo $single[$j]['stage_name']; ?></td> -->
			<td align="center" class="table_row_first"><?php echo $single[1][0]['cpt']; ?></td>
			<td align="center" class="table_row_first"><?php echo $single[1][0]['participated_no'];?></td>
			<td align="center" class="table_row_first"><?php echo $single[1][0]['cpt']-$single[1][0]['participated_no']?></td>
			<td id="result_confirm_single1_dis" align="center" class="table_row_first"><?php echo $single[1][0]['is_confirmed']; ?></td>
			<?php if($this->session->userdata('USER_GROUP') == 'A' || $this->session->userdata('USER_GROUP') == 'W'){;?>
		 	<td id="result_confirm_single1" align="center" class="table_row_first">
				<?php if($single[1][0]['is_confirmed'] == 'Yes') { ?>
					<a href="javascript:void(0);" 
					onClick="javascript:resetResultConfirmation_exb('1', 
						'LP Schools',
						'result_confirm_single1');">Reset</a>
				<?php } ?>
			</td>
			<?php }?>
	  </tr>
      
      <tr>
			<td width="27%" class="table_row_first">
				&nbsp;&nbsp;
				<span class="style1">UP</span>			</td>
			
<!-- <td align="center" class="table_row_first"><?php //echo $single[$j]['stage_name']; ?></td> -->
			<td align="center" class="table_row_first"><?php echo @$single[2][0]['cpt']; ?></td>
			<td align="center" class="table_row_first"><?php echo $single[2][0]['participated_no'];?></td>
			<td align="center" class="table_row_first"><?php echo $single[2][0]['cpt']-$single[2][0]['participated_no']?></td>
		<td id="result_confirm_single2_dis" align="center" class="table_row_first"><?php echo $single[2][0]['is_confirmed']; ?></td>
			<?php if($this->session->userdata('USER_GROUP') == 'A' || $this->session->userdata('USER_GROUP') == 'W'){;?>
	 	<td id="result_confirm_single2" align="center" class="table_row_first">
				<?php if($single[2][0]['is_confirmed'] == 'Yes') { ?>
		  <a href="javascript:void(0);" 
					onClick="javascript:resetResultConfirmation_exb('2', 
						'UP Schools',
						'result_confirm_single2');">Reset</a>
				<?php } ?>
		</td>
			<?php }?>
	  </tr>
      
      <tr>
			<td width="27%" class="table_row_first">
				&nbsp;&nbsp;
				<span class="style1">HS</span>			</td>
			
<!-- <td align="center" class="table_row_first"><?php //echo $single[$j]['stage_name']; ?></td> -->
			<td align="center" class="table_row_first"><?php echo $single[3][0]['cpt']; ?></td>
			<td align="center" class="table_row_first"><?php echo $single[3][0]['participated_no'];?></td>
			<td align="center" class="table_row_first"><?php echo $single[3][0]['cpt']-$single[3][0]['participated_no']?></td>
			<td id="result_confirm_single3_dis" align="center" class="table_row_first"><?php echo $single[3][0]['is_confirmed']; ?></td>
			<?php if($this->session->userdata('USER_GROUP') == 'A' || $this->session->userdata('USER_GROUP') == 'W'){;?>
		 	<td id="result_confirm_single3" align="center" class="table_row_first">
				<?php if($single[3][0]['is_confirmed'] == 'Yes') { ?>
					<a href="javascript:void(0);" 
					onClick="javascript:resetResultConfirmation_exb('3', 
						'HS Schools',
						'result_confirm_single3');">Reset</a>
				<?php } ?>
			</td>
			<?php }?>
	  </tr>
      
      <tr>
			<td width="27%" class="table_row_first">
				&nbsp;&nbsp;
				<span class="style1">HSS/VHSS</span>			</td>
			
<!-- <td align="center" class="table_row_first"><?php //echo $single[$j]['stage_name']; ?></td> -->
			<td align="center" class="table_row_first"><?php echo $single[4][0]['cpt']; ?></td>
			<td align="center" class="table_row_first"><?php echo $single[4][0]['participated_no'];?></td>
			<td align="center" class="table_row_first"><?php echo $single[4][0]['cpt']-$single[4][0]['participated_no']?></td>
			<td id="result_confirm_single4_dis" align="center" class="table_row_first"><?php echo $single[4][0]['is_confirmed']; ?></td>
			<?php if($this->session->userdata('USER_GROUP') == 'A' || $this->session->userdata('USER_GROUP') == 'W'){;?>
		 	<td id="result_confirm_single4" align="center" class="table_row_first">
				<?php if($single[4][0]['is_confirmed'] == 'Yes') { ?>
					<a href="javascript:void(0);" 
					onClick="javascript:resetResultConfirmation_exb('4', 
						'HSS/VHSS Schools',
						'result_confirm_single4');">Reset</a>
				<?php } ?>
			</td>
			<?php }?>
	  </tr>

	

</table>
<!-- print content starts here----------------------------------->
<div id="print_content" class="display_none" >
	<?php
			//$this->load->view('report/report_header');
	?>
<table width="100%" border="0" cellspacing="0" cellpadding="6" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="<?php echo ($this->session->userdata('USER_GROUP') == 'A' || $this->session->userdata('USER_GROUP') == 'W') ? 6 : 5?>" align="left"> 
    
	<? echo "WORK EXPERIENCE"; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo "EXHIBITION"; ?></th>
	<th align="right">Print&nbsp;&nbsp;<img src="<?php echo base_url(false).'images/print_icon.png';?>" title="print" class="window_print" 
		onClick="javascript:printContent('print_content');return false;" /></th>
  </tr>
  <tr>
    <th width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;Category</th>
    
	<!-- <th align="center" width="10%" class="table_row_first">Stage</th> -->
    <th align="center" width="10%" class="table_row_first"> No of Students</th>
    <th align="center" width="15%" class="table_row_first">Result Entered</th>
	<th align="center" width="15%" class="table_row_first">Result Not Entered</th>
	<th align="center" width="10%" class="table_row_first">Confirmed</th>
	<?php if($this->session->userdata('USER_GROUP') == 'A' || $this->session->userdata('USER_GROUP') == 'W'){;?>
    <th align="center" width="20%" class="table_row_first">Reset Confirmation</th>
	<?php }?>
  </tr>
  
  <?php
  //var_dump($single);
 	
		
		?>
		<tr>
			<td width="27%" class="table_row_first">
				&nbsp;&nbsp;
				<span class="style1">LP</span>			</td>
			
<!-- <td align="center" class="table_row_first"><?php //echo $single[$j]['stage_name']; ?></td> -->
			<td align="center" class="table_row_first"><?php echo $single[1][0]['cpt']; ?></td>
			<td align="center" class="table_row_first"><?php echo $single[1][0]['participated_no'];?></td>
			<td align="center" class="table_row_first"><?php echo $single[1][0]['cpt']-$single[1][0]['participated_no']?></td>
			<td id="result_confirm_single1_dis" align="center" class="table_row_first"><?php echo $single[1][0]['is_confirmed']; ?></td>
			<?php if($this->session->userdata('USER_GROUP') == 'A' || $this->session->userdata('USER_GROUP') == 'W' || $this->session->userdata('USER_GROUP') == 'U'){;?>
		 	<td id="result_confirm_single1" align="center" class="table_row_first">
				<?php if($single[1][0]['is_confirmed'] == 'Yes') { ?>
					<a href="javascript:void(0);" 
					onClick="javascript:resetResultConfirmation_exb('1', 
						'LP Schools',
						'result_confirm_single1');">Reset</a>
				<?php } ?>
			</td>
			<?php }?>
	  </tr>
      
      <tr>
			<td width="27%" class="table_row_first">
				&nbsp;&nbsp;
				<span class="style1">UP</span>			</td>
			
<!-- <td align="center" class="table_row_first"><?php //echo $single[$j]['stage_name']; ?></td> -->
			<td align="center" class="table_row_first"><?php echo $single[2][0]['cpt']; ?></td>
			<td align="center" class="table_row_first"><?php echo $single[2][0]['participated_no'];?></td>
			<td align="center" class="table_row_first"><?php echo $single[2][0]['cpt']-$single[2][0]['participated_no']?></td>
		<td id="result_confirm_single2_dis" align="center" class="table_row_first"><?php echo $single[2][0]['is_confirmed']; ?></td>
			<?php if($this->session->userdata('USER_GROUP') == 'A' || $this->session->userdata('USER_GROUP') == 'W' || $this->session->userdata('USER_GROUP') == 'U'){;?>
	 	<td id="result_confirm_single2" align="center" class="table_row_first">
				<?php if($single[2][0]['is_confirmed'] == 'Yes') { ?>
		  <a href="javascript:void(0);" 
					onClick="javascript:resetResultConfirmation_exb('2', 
						'UP Schools',
						'result_confirm_single2');">Reset</a>
				<?php } ?>
		</td>
			<?php }?>
	  </tr>
      
      <tr>
			<td width="27%" class="table_row_first">
				&nbsp;&nbsp;
				<span class="style1">HS</span>			</td>
			
<!-- <td align="center" class="table_row_first"><?php //echo $single[$j]['stage_name']; ?></td> -->
			<td align="center" class="table_row_first"><?php echo $single[3][0]['cpt']; ?></td>
			<td align="center" class="table_row_first"><?php echo $single[3][0]['participated_no'];?></td>
			<td align="center" class="table_row_first"><?php echo $single[3][0]['cpt']-$single[3][0]['participated_no']?></td>
			<td id="result_confirm_single3_dis" align="center" class="table_row_first"><?php echo $single[3][0]['is_confirmed']; ?></td>
			<?php if($this->session->userdata('USER_GROUP') == 'A' || $this->session->userdata('USER_GROUP') == 'W' || $this->session->userdata('USER_GROUP') == 'U'){;?>
		 	<td id="result_confirm_single3" align="center" class="table_row_first">
				<?php if($single[3][0]['is_confirmed'] == 'Yes') { ?>
					<a href="javascript:void(0);" 
					onClick="javascript:resetResultConfirmation_exb('3', 
						'HS Schools',
						'result_confirm_single3');">Reset</a>
				<?php } ?>
			</td>
			<?php }?>
	  </tr>
      
      <tr>
			<td width="27%" class="table_row_first">
				&nbsp;&nbsp;
				<span class="style1">HSS/VHSS</span>			</td>
			
<!-- <td align="center" class="table_row_first"><?php //echo $single[$j]['stage_name']; ?></td> -->
			<td align="center" class="table_row_first"><?php echo $single[4][0]['cpt']; ?></td>
			<td align="center" class="table_row_first"><?php echo $single[4][0]['participated_no'];?></td>
			<td align="center" class="table_row_first"><?php echo $single[4][0]['cpt']-$single[4][0]['participated_no']?></td>
			<td id="result_confirm_single4_dis" align="center" class="table_row_first"><?php echo $single[4][0]['is_confirmed']; ?></td>
			<?php if($this->session->userdata('USER_GROUP') == 'A' || $this->session->userdata('USER_GROUP') == 'W' || $this->session->userdata('USER_GROUP') == 'U'){;?>
		 	<td id="result_confirm_single4" align="center" class="table_row_first">
				<?php if($single[4][0]['is_confirmed'] == 'Yes') { ?>
					<a href="javascript:void(0);" 
					onClick="javascript:resetResultConfirmation_exb('4', 
						'HSS/VHSS Schools',
						'result_confirm_single4');">Reset</a>
				<?php } ?>
			</td>
			<?php }?>
	  </tr>

	

</table>
<?php
		//$this->load->view('report/report_footer');
?>
</div>
<!-- display content ends here --------------------------------------->
<?php
//itemwise_report_interface

echo form_close();
?>
