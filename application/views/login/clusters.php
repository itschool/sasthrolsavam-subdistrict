

 <div class="container">
 <?
 if ($this->session->userdata('USER_TYPE') == 2 or $this->session->userdata('USER_GROUP') == 'W') { ?>
 <div align="right"><A HREF="javascript:history.go(-1)"><img height="35" width="35" src="<?php echo base_url(false).'images/back_button.png';?>" title="Back"/></a></div>
<? } ?> 	

<?php echo form_open('welcome/cluster_schools', array('id' => 'clust','name' => 'clust'));?>
<input type="hidden" name="sel_district_id" id="sel_district_id" />
              <!--<div class="conthead">
                <h2>Cluster List</h2>
            </div>-->
             <!-- Alternative Content Box Start -->
           
<table width="100%" height="215"  border="0" align="center" cellpadding="0" cellspacing="6" class="heading_tab" bordercolor="#CFCFCF" >
<tr>
    	<th colspan="18">
        	<?php print('Name&nbsp;:&nbsp;&nbsp;'.@$cluster[0]['name'].'&nbsp;&nbsp;&nbsp;&nbsp;Mobile&nbsp;:&nbsp;'.@$cluster[0]['mobile'].'&nbsp;&nbsp;&nbsp;&nbsp;E-mail&nbsp;:&nbsp;'.@$cluster[0]['email']);?>        </th>
    </tr>
     <tr>
		<th height="34" colspan="23" >Cluster List</th>
	   <!--<th align="right" colspan="2">Print&nbsp;&nbsp;<img src="<?php echo base_url(false).'images/print_icon.png';?>" title="print" class="window_print" 
		onClick="javascript:printContent('print_content');return false;" /></th>-->
	</tr>
	<tr style="border-bottom:1px solid #CFCFCF;">
    
	  <th width="4%"  rowspan="2" align="center"><div align="center">Sl No</div></th>
	  <th width="8%" rowspan="2" align="left"><div align="center">Clusters</div></th>
	  <th width="6%" rowspan="2" align="center"><div align="center">Total</div></th>
	  <th height="21" colspan="3" align="center"><div align="center">SCIENCE</div></th>
	  <th colspan="3" align="center"><div align="center">MATHS</div></th>
	  <th colspan="3" align="center"><div align="center">SOCIAL SC</div></th>
	  <th colspan="3" align="center"><div align="center">WORK EXP</div></th>
	  <th colspan="3" align="center"><div align="center">IT</div></th>
    <tr style="border-bottom:1px solid #CFCFCF;">
		<th width="4%" height="19" align="center"><div align="center">E</div></th>
	  <th width="4%" align="center"><div align="center">NE</div></th>
        <th width="4%" align="center"><div align="center">C</div></th>
        <!--<th width="4%" align="center"><div align="center">NC</div></th>-->
        <th width="4%" align="center"><div align="center">E</div></th>
        <th width="4%" align="center"><div align="center">NE</div></th>
        <th width="4%" align="center"><div align="center">C</div></th>
        <!--<th width="4%" align="center"><div align="center">NC</div></th>-->
        <th width="4%" align="center"><div align="center">E</div></th>
        <th width="4%" align="center"><div align="center">NE</div></th>
        <th width="4%" align="center"><div align="center">C</div></th>
        <!--<th width="4%" align="center"><div align="center">NC</div></th>-->
        <th width="4%" align="center"><div align="center">E</div></th>
        <th width="4%" align="center"><div align="center">NE</div></th>
        <th width="4%" align="center"><div align="center">C</div></th>
       <!-- <th width="4%" align="center"><div align="center">NC</div></th>-->
        <th width="4%" align="center"><div align="center">E</div></th>
        <th width="4%" align="center"><div align="center">NE</div></th>
        <th width="4%" align="center"><div align="center">C</div></th>
        <!--<th width="4%" align="center"><div align="center">NC</div></th>-->
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
		
	// var_dump($sub_dist_det);
	
		if (is_array($cluster_details) && count($cluster_details) >0)
		{
		
			foreach ($cluster_details as $key => $cluster)
			{
		
				$total_school += $clusters[$i]['total_school'];
				
				$science_entered += $clusters[$i]['science_entered'];
				$science_not_entered = $science_not_entered + ($clusters[$i]['total_school'] - $clusters[$i]['science_entered']);
				$science_confirm = $science_confirm + $clusters[$i]['science_confirm'];
				$science_not_confirm = $clusters[$i]['total_school']-$clusters[$i]['science_confirm'];
				$maths_entered += $clusters[$i]['maths_entered'];
				$maths_not_entered = $maths_not_entered + ($clusters[$i]['total_school'] - $clusters[$i]['maths_entered']);
				$maths_confirm = $maths_confirm + $clusters[$i]['maths_confirm'];
				$maths_not_confirm = $clusters[$i]['total_school']-$clusters[$i]['maths_confirm'];
				
				$socialscience_entered += $clusters[$i]['socialscience_entered'];
				$socialscience_not_entered = $socialscience_not_entered + ($clusters[$i]['total_school'] - $clusters[$i]['socialscience_entered']);
				$socialscience_confirm = $socialscience_confirm + $clusters[$i]['socialscience_confirm'];
				$socialscience_not_confirm = $clusters[$i]['total_school']-$clusters[$i]['socialscience_confirm'];
				
				$we_entered += $clusters[$i]['we_entered'];
				$we_not_entered = $we_not_entered + ($clusters[$i]['total_school'] - $clusters[$i]['we_entered']);
				$we_confirm = $we_confirm + $clusters[$i]['we_confirm'];
				$we_not_confirm = $clusters[$i]['total_school']-$clusters[$i]['we_confirm'];
				
				$it_entered += $clusters[$i]['it_entered'];
				$it_not_entered = $it_not_entered + ($clusters[$i]['total_school'] - $clusters[$i]['it_entered']);
				$it_confirm = $it_confirm + $clusters[$i]['it_confirm'];
				$it_not_confirm = $clusters[$i]['total_school']-$clusters[$i]['it_confirm'];
				
				
				$clustered_schools_count	=	$total_school;
				
				$tot_count					=	$total_school + $nonclust[0]['mcode'];
				
				
				if(($key+1)%2 == 0)
				$class	=	'alt';
				else
				$class	=	'altnext';
			?>
	<tr  bgcolor="#F5F5F5"  style="border-bottom:1px solid #CFCFCF;height:20px;">
					<td height="24" align="center"><?php echo $key+1 ?></td>
<td  align="left"> <div align="left">
					 <a href="<?php echo base_url();?>index.php/welcome/cluster_schools/<?php echo $cluster_details[$key]['user_id']?>"><?php echo $cluster_details[$key]['user_name'];?></a>
                     <input type="hidden" name="hidClusterId" id="hidClusterId" value="<?php echo $cluster_details[$key]['user_id']?>"  />				</td>
					<td  align="center"  ><?php echo $clusters[$i]['total_school']?></td>
					<td  align="center"  ><?php echo $clusters[$i]['science_entered']?></td>
					<td  align="center"  ><?php echo $clusters[$i]['total_school'] - $clusters[$i]['science_entered']?></td>
                    <td  align="center"  ><?php echo $clusters[$i]['science_confirm']?></td>
					<!--<td  align="center"  ><?php //echo $clusters[$i]['total_school']-$clusters[$i]['science_confirm']  ?></td>-->
					<td  align="center"  ><?php echo $clusters[$i]['maths_entered']?></td>
					<td  align="center"  ><?php echo $clusters[$i]['total_school'] - $clusters[$i]['maths_entered']?></td>
                    <td  align="center"  ><?php echo $clusters[$i]['maths_confirm']?></td>
					<!--<td  align="center"  ><?php //echo $clusters[$i]['total_school']-$clusters[$i]['maths_confirm']  ?></td>-->
					<td  align="center"  ><?php echo $clusters[$i]['socialscience_entered']?></td>
					<td  align="center"  ><?php echo $clusters[$i]['total_school'] - $clusters[$i]['socialscience_entered']?></td>
                    <td  align="center"  ><?php echo $clusters[$i]['socialscience_confirm']?></td>
					<!--<td  align="center"  ><?php //echo $clusters[$i]['total_school']-$clusters[$i]['socialscience_confirm']  ?></td>-->
					<td  align="center"  ><?php echo $clusters[$i]['we_entered']?></td>
					<td  align="center"  ><?php echo $clusters[$i]['total_school'] - $clusters[$i]['we_entered']?></td>
                    <td  align="center"  ><?php echo $clusters[$i]['we_confirm']?></td>
					<!--<td  align="center"  ><?php //echo $clusters[$i]['total_school']-$clusters[$i]['we_confirm']  ?></td>-->
					<td  align="center"  ><?php echo $clusters[$i]['it_entered']?></td>
					<td  align="center"  ><?php echo $clusters[$i]['total_school'] - $clusters[$i]['it_entered']?></td>
                    <td  align="center"  ><?php echo $clusters[$i]['it_confirm']?></td>
					<!--<td  align="center"  ><?php //echo $clusters[$i]['total_school']-$clusters[$i]['it_confirm']  ?></td>-->
    </tr>
			
			<?php
			$i++;
			}
		}
		
		?>
        
       
        
        
        
        
         <!--<tr>
            <td height="48"  >&nbsp;     </td>
           <td   align="left"> &nbsp;&nbsp;&nbsp; <strong>Total</strong>  </td>
           
            <td  align="center"  ><strong><?php echo $total_school?></strong></td>
            
            <td  align="center"  ><strong><?php echo $science_entered?></strong></td>
            <td  align="center"  ><strong><?php echo $science_not_entered?></strong></td>
            <td  align="center"  ><strong><?php echo $science_confirm?></strong></td>
            <td  align="center"  ><strong><?php //echo $science_not_confirm?></strong></td>
            
            <td  align="center"  ><strong><?php echo $maths_entered?></strong></td>
            <td  align="center"  ><strong><?php echo $maths_not_entered?></strong></td>
            <td  align="center"  ><strong><?php echo $maths_confirm?></strong></td>
            <td  align="center"  ><strong><?php //echo $maths_not_confirm?></strong></td>
           
            <td  align="center"  ><strong><?php echo $socialscience_entered?></strong></td>
            <td  align="center"  ><strong><?php echo $socialscience_not_entered?></strong></td>
            <td  align="center"  ><strong><?php echo $socialscience_confirm?></strong></td>
            <td  align="center"  ><strong><?php //echo $socialscience_not_confirm?></strong></td>
            
            <td  align="center"  ><strong><?php echo $we_entered?></strong></td>
            <td  align="center"  ><strong><?php echo $we_not_entered?></strong></td>
            <td  align="center"  ><strong><?php echo $we_confirm?></strong></td>
            <td  align="center"  ><strong><?php //echo $we_not_confirm?></strong></td> 
            
            <td  align="center"  ><strong><?php echo $it_entered?></strong></td>
            <td  align="center"  ><strong><?php echo $it_not_entered?></strong></td>
            <td  align="center"  ><strong><?php echo $it_confirm?></strong></td>
            <td  align="center"  ><strong><?php //echo $it_not_confirm?></strong></td>
            <?
			//$data_confirmed_schools	=	
			
			?>
            
      </tr>-->   
      
<tr>
            <td height="57"  >&nbsp;     </td>
      <td   align="left"><strong>Non-cluster schools</strong>  </td>
           
        <td  align="center"  ><?php echo $nonclust[0]['mcode'];?></td>
            
        <td colspan="15"   align="center"  ><?php print('<strong>Total Schools</strong>&nbsp;&nbsp;&nbsp;<strong>'.@$tot_count.'</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.
						'<strong>Clustered Schools</strong>&nbsp;&nbsp;&nbsp;<strong>'.@$clustered_schools_count.'</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');?></td>
    </tr>   
      
</table>
</div>

<div>
<strong>Note</strong>

&nbsp;&nbsp;&nbsp;&nbsp;E :Entered &nbsp;&nbsp;&nbsp;&nbsp;NE :Not Entered &nbsp;&nbsp;&nbsp;&nbsp;C :Confirm &nbsp;&nbsp;&nbsp;&nbsp;<br />

<?
echo form_close();
?>
</div>


<div class="container">
<?php echo form_open('', array('id' => 'confirm_sub_dist','name' => 'confirm_sub_dist')); ?>
<input type="hidden" name="sel_district_id" id="sel_district_id" />
              
             <!-- Alternative Content Box Start -->
           
<table width="100%"   border="1" align="center" cellpadding="0" cellspacing="6" class="heading_tab" bordercolor="#CFCFCF">

	<tr>
	  <th colspan="3"  align="left">Confirm</th>

	</tr>
    
        <input name="base_url" type="hidden" id="base_url" value="<?php echo base_url();?>" />
       <?php
	   
	   if($this->session->userdata('USER_TYPE') == 4)
	   {
	   	   
	   		/*if ('N' == $sub_school['confirm_data_entry'])
			{*/
	   ?>
			<tr>
            			<tr>
				<td class="table_row_first" align="left">
                	<strong>Select Fair to Confirm</strong><br />                    
			<?php 
		
			if($sub_dist_det[0]['science_confirm_data_entry'] == 'N')
			{
			?>
             	 <input name="chkC" id="chkC1" type="radio" value="1"/>SCIENCE FAIR<br />
            <?php
			} else {
			?>
            	<input name="chkC" id="chkC1" type="radio" value="1" disabled="disabled"/><strong>SCIENCE FAIR  [ Confirmed ]</strong><br />
            <?php
			}
			?>
		
        	
            
            <?php 
		
			if($sub_dist_det[0]['maths_confirm_data_entry'] == 'N')
			{
			?>
             	<input name="chkC"	id="chkC2" type="radio" value="2"/>MATHEMATICS FAIR<br />
            <?php
			} else {
			?>
            	<input name="chkC"	id="chkC2" type="radio" value="2" disabled="disabled"/><strong>MATHEMATICS FAIR [ Confirmed ]</strong><br />
            <?php
			}
			?>
            
             <?php 
		
			if($sub_dist_det[0]['social_confirm_data_entry'] == 'N')
			{
			?>
                     <input name="chkC"	id="chkC3" type="radio" value="3"/>SOCIAL SCIENCE FAIR<br />
            <?php
			} else {
			?>
            	 <input name="chkC"	id="chkC3" type="radio" value="3" disabled="disabled"/><strong>SOCIAL SCIENCE FAIR  [ Confirmed ]</strong><br />
            <?php
			}
			
			if($sub_dist_det[0]['worexpo_confirm_data_entry'] == 'N')
			{
			?>
                     <input name="chkC"	id="chkC4" type="radio" value="3"/>WORK EXPERIENCE FAIR<br />
            <?php
			} else {
			?>
            	 <input name="chkC"	id="chkC4" type="radio" value="3" disabled="disabled"/><strong>WORK EXPERIENCE FAIR  [ Confirmed ]</strong><br />
            <?php
			}
			
			if($sub_dist_det[0]['it_confirm_data_entry'] == 'N')
			{
			?>
                     <input name="chkC"	id="chkC5" type="radio" value="3"/>IT FAIR<br />
            <?php
			} else {
			?>
            	 <input name="chkC"	id="chkC5" type="radio" value="3" disabled="disabled"/><strong>IT FAIR  [ Confirmed ]</strong><br />
            <?php
			}
			
			?>
            
         	</td>
			</tr>
				<td class="table_row_first" align="left">
					<label style="color:#990000"><strong>Warning: Once confirmed new additions/entry details cannot be permitted</strong></label>
					<br />
						<?php print(form_submit('Confirm','Confirm','onClick="javascript:return fncConfirnSubDistAdmin();"'));?></td>
			</tr>
		
			<tr>
				<td class="table_row_first" align="left">
                	<strong>Select Fair to export</strong><br />               
			<?php 
		
			if($sub_dist_det[0]['science_confirm_data_entry'] == 'N')
			{
			?>
                    	
                        <input name="chk1" id="chk1" type="checkbox" value="1"  disabled="disabled"/>SCIENCE FAIR<br /> 
            <?php
            } else {
			?>   
              			<input name="chk1" id="chk1" type="checkbox" value="1" />SCIENCE FAIR<br /> 
             <?php 
			 } ?> 
             
             
             <?php 
		
			if($sub_dist_det[0]['maths_confirm_data_entry'] == 'N')
			{
			?>
                    <input name="chk2"	id="chk2" type="checkbox" value="2"  disabled="disabled"/>MATHEMATICS FAIR<br />	
            <?php
            } else {
			?>   	
                        <input name="chk2"	id="chk2" type="checkbox" value="2" />MATHEMATICS FAIR<br />
             <?php 
			 } ?> 
             
             
              <?php 
		
			if($sub_dist_det[0]['social_confirm_data_entry'] == 'N')
			{
			?>
                    <input name="chk3"	id="chk3" type="checkbox" value="3"  disabled="disabled"/>SOCIAL SCIENCE FAIR<br />
            <?php
            } else {
			?>   	
                       <input name="chk3"	id="chk3" type="checkbox" value="3" />SOCIAL SCIENCE FAIR<br />
             <?php 
			 } 
			 
			 if($sub_dist_det[0]['worexpo_confirm_data_entry'] == 'N')
			{
			?>
                    <input name="chk4"	id="chk4" type="checkbox" value="3"  disabled="disabled"/>WORK EXPERIENCE FAIR<br />
            <?php
            } else {
			?>   	
                       <input name="chk4"	id="chk4" type="checkbox" value="3" />WORK EXPERIENCE FAIR<br />
             <?php 
			 } 
			 
			 if($sub_dist_det[0]['it_confirm_data_entry'] == 'N')
			{
			?>
                    <input name="chk5"	id="chk5" type="checkbox" value="3"  disabled="disabled"/>IT FAIR<br />
            <?php
            } else {
			?>   	
                       <input name="chk5"	id="chk5" type="checkbox" value="3" />IT FAIR<br />
             <?php 
			 } 
			 
			 ?> 
                    	
                    
                    	
                 </td>
           <?php
			// }
			 ?>
			</tr>
            <tr>
				<td class="table_row_first" align="left">
					<?php print(form_button('data_export','Export Selected Data','onClick="javascript:fncExportSubDistrictData();"'));?>				</td>
			</tr>
		<?php
			
		}
		?>
	</tr>
	
	  

</table>

<br />

<?php

echo form_close();
?>
</div>

