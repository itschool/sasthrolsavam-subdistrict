  <div class="content">
 <div class="container">
<?php echo form_open('', array('id' => 'list_district'));

?>
<input type="hidden" name="sel_district_id" id="sel_district_id" />
              <!--<div class="conthead">
                <h2>District List</h2>
            </div>-->
             <!-- Alternative Content Box Start -->
            <div class="content">
 			<div class="container">
            <br />

<table width="100%" height="159" border="1"   align="center" cellpadding="0" cellspacing="6" class="heading_tab" bordercolor="#CFCFCF" >

   <tr>
		<th height="32" colspan="23" >District List</th>
		<!--<th align="right" colspan="2">Print&nbsp;&nbsp;<img src="<?php echo base_url(false).'images/print_icon.png';?>" title="print" class="window_print" 
		onClick="javascript:printContent('print_content');return false;" /></th>-->
	</tr>
	
	<tr style="border-bottom:1px solid #CFCFCF;">
	  <th width="8%"  rowspan="2" align="center"><div align="center">Sl No</div></th>
	  <th width="16%" rowspan="2" align="left"><div align="center">District</div></th>
	  <th width="8%" rowspan="2" align="center"><div align="center">Total</div></th>
	  <th width="12%" colspan="4" align="center"><div align="center">SCIENCE</div></th>
	  <th width="12%" colspan="4" align="center"><div align="center">MATHS</div></th>
	  <th width="12%" colspan="4" align="center"><div align="center">SOCIAL SC</div></th>
	  <th width="12%" colspan="4" align="center"><div align="center">WORK EXP</div></th>
	  <th width="12%" colspan="4" align="center"><div align="center">IT</div></th>
      
	  <tr style="border-bottom:1px solid #CFCFCF;">
		<th width="6%" align="center"><div align="center">E</div></th>
		<th width="6%" align="center"><div align="center">NE</div></th>
        <th width="6%" align="center"><div align="center">C</div></th>
        <th width="6%" align="center"><div align="center">NC</div></th>
        <th width="6%" align="center"><div align="center">E</div></th>
        <th width="6%" align="center"><div align="center">NE</div></th>
        <th width="6%" align="center"><div align="center">C</div></th>
        <th width="6%" align="center"><div align="center">NC</div></th>
        <th width="6%" align="center"><div align="center">E</div></th>
        <th width="6%" align="center"><div align="center">NE</div></th>
        <th width="6%" align="center"><div align="center">C</div></th>
        <th width="6%" align="center"><div align="center">NC</div></th>
        <th width="6%" align="center"><div align="center">E</div></th>
        <th width="6%" align="center"><div align="center">NE</div></th>
        <th width="6%" align="center"><div align="center">C</div></th>
        <th width="6%" align="center"><div align="center">NC</div></th>
        <th width="6%" align="center"><div align="center">E</div></th>
        <th width="6%" align="center"><div align="center">NE</div></th>
        <th width="6%" align="center"><div align="center">C</div></th>
        <th width="6%" align="center"><div align="center">NC</div></th>
        <?php
		$i=0;
		$total_school=0;
		
		$science_entered = 0;
		$science_not_entered =0;
		$science_confirm =0;
		$science_not_confirm =0;
		
		$maths_entered = 0;
		$maths_not_entered =0;
		$maths_confirm =0;
		$maths_not_confirm =0;
		
		$socialscience_entered = 0;
		$socialscience_not_entered =0;
		$socialscience_confirm =0;
		$socialscience_not_confirm =0;
		
		$we_entered = 0;
		$we_not_entered =0;
		$we_confirm =0;
		$we_not_confirm =0;
		
		$it_entered = 0;
		$it_not_entered =0;
		$it_confirm =0;
		$it_not_confirm =0;
		
	
		$district_details1 = $district_details;
		if (is_array($district_details) && count($district_details) >0)
		{
		
			foreach ($district_details as $key => $district_details)
			{
		
				$total_school += $dist_details[$i]['total_school'];
				
				$science_entered += $dist_details[$i]['science_entered'];
				$science_not_entered = $science_not_entered + ($dist_details[$i]['total_school'] - $dist_details[$i]['science_entered']);
				$science_confirm = $science_confirm + $dist_details[$i]['science_confirm'];
				$science_not_confirm = $science_not_confirm + ($dist_details[$i]['total_school'] - $dist_details[$i]['science_confirm']);
				$maths_entered += $dist_details[$i]['maths_entered'];
				$maths_not_entered = $maths_not_entered + ($dist_details[$i]['total_school'] - $dist_details[$i]['maths_entered']);
				$maths_confirm = $maths_confirm + $dist_details[$i]['maths_confirm'];
				$maths_not_confirm = $maths_not_confirm + ($dist_details[$i]['total_school'] - $dist_details[$i]['maths_confirm']);
				
				$socialscience_entered += $dist_details[$i]['socialscience_entered'];
				$socialscience_not_entered = $socialscience_not_entered + ($dist_details[$i]['total_school'] - $dist_details[$i]['socialscience_entered']);
				$socialscience_confirm = $socialscience_confirm + $dist_details[$i]['socialscience_confirm'];
				$socialscience_not_confirm = $socialscience_not_confirm + ($dist_details[$i]['total_school'] - $dist_details[$i]['socialscience_confirm']);
				
				$we_entered += $dist_details[$i]['we_entered'];
				$we_not_entered = $we_not_entered + ($dist_details[$i]['total_school'] - $dist_details[$i]['we_entered']);
				$we_confirm = $we_confirm + $dist_details[$i]['we_confirm'];
				$we_not_confirm = $we_not_confirm + ($dist_details[$i]['total_school'] - $dist_details[$i]['we_confirm']);
				
				$it_entered += $dist_details[$i]['it_entered'];
				$it_not_entered = $it_not_entered + ($dist_details[$i]['total_school'] - $dist_details[$i]['it_entered']);
				$it_confirm = $it_confirm + $dist_details[$i]['it_confirm'];
				$it_not_confirm = $it_not_confirm + ($dist_details[$i]['total_school'] - $dist_details[$i]['it_confirm']);
				
				if(($key+1)%2 == 0)
				$class	=	'alt';
				else
				$class	=	'altnext';
			?>
		  <tr  bgcolor="#F5F5F5"  style="border-bottom:1px solid #CFCFCF;height:20px;" >
			  <td height="23" align="center"  ><div align="center"><?php echo $key+1?></td>
<td  align="left"  ><div align="left">
						<!--<a href="javascript:void(0)" onClick="javascript:fncListSubDistrictDetails('<?php echo $district_details['rev_district_code']?>');return false;">
						<?php echo $district_details['rev_district_name'];?>
						</a>-->
                        <a href="<?php echo base_url();?>index.php/welcome/district_details/<?php echo $key+1?>"><strong><?php echo $district_details['rev_district_name'];?></strong></a>					</td>
					<td  align="center"  ><div align="center"><?php echo $dist_details[$i]['total_school']?></td>
					<td  align="center"  ><div align="center"><?php echo $dist_details[$i]['science_entered']?></td>
					<td  align="center"  ><div align="center"><?php echo $dist_details[$i]['total_school'] - $dist_details[$i]['science_entered']?></td>
                    <td  align="center"  ><div align="center"><?php echo $dist_details[$i]['science_confirm']?></td>
					<td  align="center"  ><div align="center"><?php echo $dist_details[$i]['total_school']-$dist_details[$i]['science_confirm']  ?></td>
					<td  align="center"  ><div align="center"><?php echo $dist_details[$i]['maths_entered']?></td>
					<td  align="center"  ><div align="center"><?php echo $dist_details[$i]['total_school'] - $dist_details[$i]['maths_entered']?></td>
                    <td  align="center"  ><div align="center"><?php echo $dist_details[$i]['maths_confirm']?></td>
					<td  align="center"  ><div align="center"><?php echo $dist_details[$i]['total_school']-$dist_details[$i]['maths_confirm']  ?></td>
					<td  align="center"  ><div align="center"><?php echo $dist_details[$i]['socialscience_entered']?></td>
					<td  align="center"  ><div align="center"><?php echo $dist_details[$i]['total_school'] - $dist_details[$i]['socialscience_entered']?></td>
                    <td  align="center"  ><div align="center"><?php echo $dist_details[$i]['socialscience_confirm']?></td>
					<td  align="center"  ><div align="center"><?php echo $dist_details[$i]['total_school']-$dist_details[$i]['socialscience_confirm']  ?></td>
					<td  align="center"  ><div align="center"><?php echo $dist_details[$i]['we_entered']?></td>
					<td  align="center"  ><div align="center"><?php echo $dist_details[$i]['total_school'] - $dist_details[$i]['we_entered']?></td>
                    <td  align="center"  ><div align="center"><?php echo $dist_details[$i]['we_confirm']?></td>
					<td  align="center"  ><div align="center"><?php echo $dist_details[$i]['total_school']-$dist_details[$i]['we_confirm']  ?></td>
					<td  align="center"  ><div align="center"><?php echo $dist_details[$i]['it_entered']?></td>
					<td  align="center"  ><div align="center"><?php echo $dist_details[$i]['total_school'] - $dist_details[$i]['it_entered']?></td>
                    <td  align="center"  ><div align="center"><?php echo $dist_details[$i]['it_confirm']?></td>
					<td  align="center"  ><div align="center"><?php echo $dist_details[$i]['total_school']-$dist_details[$i]['it_confirm']  ?></td>
		  </tr>
			
			<?php
			$i++;
			}
		}
		
		?>
         <tr  bgcolor="#F5F5F5">
            <td height="24"   >&nbsp;     </td>
           <td   align="left"> &nbsp;&nbsp;&nbsp; Total  </td>
           
            <td  align="center"  ><strong><?php echo $total_school?></strong></td>
            
            <td  align="center"  ><strong><?php echo $science_entered?></strong></td>
            <td  align="center"  ><strong><?php echo $science_not_entered?></strong></td>
            <td  align="center"  ><strong><?php echo $science_confirm?></strong></td>
            <td  align="center"  ><strong><?php echo $science_not_confirm?></strong></td>
            
            <td  align="center"  ><strong><?php echo $maths_entered?></strong></td>
            <td  align="center"  ><strong><?php echo $maths_not_entered?></strong></td>
            <td  align="center"  ><strong><?php echo $maths_confirm?></strong></td>
            <td  align="center"  ><strong><?php echo $maths_not_confirm?></strong></td>
           
            <td  align="center"  ><strong><?php echo $socialscience_entered?></strong></td>
            <td  align="center"  ><strong><?php echo $socialscience_not_entered?></strong></td>
            <td  align="center"  ><strong><?php echo $socialscience_confirm?></strong></td>
            <td  align="center"  ><strong><?php echo $socialscience_not_confirm?></strong></td>
            
            <td  align="center"  ><strong><?php echo $we_entered?></strong></td>
            <td  align="center"  ><strong><?php echo $we_not_entered?></strong></td>
            <td  align="center"  ><strong><?php echo $we_confirm?></strong></td>
            <td  align="center"  ><strong><?php echo $we_not_confirm?></strong></td>  
            
            <td  align="center"  ><strong><?php echo $it_entered?></strong></td>
            <td  align="center"  ><strong><?php echo $it_not_entered?></strong></td>
            <td  align="center"  ><strong><?php echo $it_confirm?></strong></td>
            <td  align="center"  ><strong><?php echo $it_not_confirm?></strong></td>
      </tr>   
</table>
<br />
</div>
</div>

<div>
<strong>Note</strong>
<br />
&nbsp;&nbsp;&nbsp;&nbsp;E :Entered &nbsp;&nbsp;&nbsp;&nbsp;NE :Not Entered &nbsp;&nbsp;&nbsp;&nbsp;C :Confirm &nbsp;&nbsp;&nbsp;&nbsp;NC :Not Confirm &nbsp;&nbsp;&nbsp;&nbsp;
</div>

<?php

echo form_close();
?>
</div>
</div>