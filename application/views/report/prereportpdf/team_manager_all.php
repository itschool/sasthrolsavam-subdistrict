<style type="text/css">
<!--
.style1 {
	font-size: 14px;
	font-weight: bold;
	color: #660033;
}
.style2{
	font-size: 11px;
	font-weight: bold;
	color:#000000;
}
.style9{
	font-size: 12px;
	font-weight: bold;
	color:#000000;
}
.style3{
	font-size: 12px;
	font-weight: bold;
	color:#000000;
}
.style4{
	font-size: 8px;
	font-weight: bold;
	color:#000000;
}
.style5{
	font-size: 10px;
	color:#000000;
}
.ety{
	font-size: 12px;
	color:#000000;
	}
-->
</style>
	<?php
	  	$prev_schoolcode="";
		$prev_festcode="";
        for($j = 0; $j < count($part_details); $j++){
			
		  if(($prev_schoolcode!=$part_details[$j]['school_code'])||($prev_festcode!=$part_details[$j]['fest_id'])){
			    $prev_schoolcode=$part_details[$j]['school_code'];
			    $prev_festcode=$part_details[$j]['fest_id'];
				$count	=	0;
				
				if($j!=0){
				print("</table></page>");
				}
	?>

	
            
<page backtop="30mm" backbottom="10mm">
		<page_header>
    	<?php
			$this->load->view('report/report_header');
		?>
        <table width="100%" border="0" cellspacing="0" cellpadding="4" align="center">
            <tr>
                <td align="center" class="style1" valign="top"><?php echo $fair_name; if($fair_name=='Work Experience Fair'){echo ($_POST['radioLabel'] =='exhib')?'(Exhibition)':'(On the spot)' ;}?><br />List of  participants For Team Manager</td>
            </tr>  
        </table>
        
        <table width="100%" border="0" align="center">
            <tr>
                <td width="25%" class="style9" align="left">&nbsp;&nbsp;<span class="style2">&nbsp;&nbsp;&nbsp;Festival: &nbsp;&nbsp;<?php echo $part_details[$j]['fest_name']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                <td width="34%" class="style9" align="center"><span class="style2">&nbsp;&nbsp;School  Code:&nbsp;&nbsp;&nbsp;<?php echo $part_details[$j]['school_code']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
                <td width="41%" class="style9" align="right"><span class="style2">&nbsp;&nbsp;&nbsp;School Name:&nbsp;&nbsp;<?php echo $part_details[$j]['school_name']; ?> &nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;</td>
            </tr>
        </table>
	</page_header>
<page_footer>
	<?php
		$this->load->view('report/report_footer');
	?>
</page_footer>       

		<br />
		 <table width="121%" border="1" align="center" cellpadding="0" cellspacing="0">

  <tr>
    <td width="20"  align="center" class="style2" style="border-right:1px #666666; padding:2px;">Sl.No</td>
    <td width="178"align="left" class="style2" style="border-right:1px #666666; padding:2px;">Item</td>
    <td width="190" align="left" class="style2" style="border-right:1px #666666; padding:2px;">Name </td>
     <td width="40" align="center" class="style2" style="border-right:1px #666666; padding:2px;">Reg No.</td>
   <td width="40" align="center" class="style2" style="border-right:1px #666666; padding:2px;">Adm.No.</td>
    <td width="20" align="center" class="style2" style="border-right:1px #666666; padding:2px;">B/G</td>
    <td width="28" align="center" class="style2" style="border-right:1px #666666; padding:2px;">Class</td>
    <td width="56" align="center" class="style2" style="border-right:1px #666666; padding:2px;">Venue</td>
    <td width="62" align="left" class="style2" style="border-right:0px #666666; padding:2px;">Date</td>
     <!-- <td width="12%" align="center" class="style2" style="border-right:0px #666666; padding:2px;">&nbsp;&nbsp;Tentative Time&nbsp;&nbsp;</td> -->
  </tr>
  <?php
  }
  $count++;
	if(($part_details[$j]['is_captain']=='Y')&&(@$part_details[$j]['item_type']=='G'))
	$iscaptain="(C)";
	else 
	$iscaptain="";
	
   if((@$part_details[$j]['max_time']!="")&&($part_details[$j]['no_of_participant']!="")){
 			
		    $total_time_for_item	=	($part_details[$j]['time_type'] == 'S') ? ceil((int)@$part_details[$j]['max_time'] / 60) : (int)@$part_details[$j]['max_time'];
			if($part_details[$j]['is_off_stage']=='N')
			{
				$time		=	$total_time_for_item * $part_details[$j]['no_of_participant'];
				$time		=	get_time_format($time);
			}
			else 
			{
				$time		=	get_time_format($total_time_for_item);
			}
		$datt=datetophpmodel($part_details[$j]['ddt']);
		}
		else { 
		$datt="";$timetye="";$time="";
		
		}
          
  ?>
     
  <tr>
    <td class="ety" align="center"  style="border-top:1px #666666; border-right:1px #666666; padding:2px;" ><?php echo $count;?></td>
    <td class="ety" align="left"  style="border-top:1px #666666; border-right:1px #666666; padding:2px;"><?php if($fair_name=='Work Experience Fair' && $_POST['radioLabel'] =='exhib')echo 'Exhibition'; else echo wordwrap($part_details[$j]['item_code'].' - '.$part_details[$j]['item_name'],30,'<br>');?></td>
    <td class="ety" align="left"  style="border-top:1px #666666; border-right:1px #666666; padding:2px;" ><?php if($part_details[$j]['is_captain']=='Y'){ echo wordwrap($part_details[$j]['participant_name'],25,'<br>').' (L)';} else{ echo wordwrap($part_details[$j]['participant_name'],25,'<br>');}?></td>
    <td class="ety" align="center"  style="border-top:1px #666666; border-right:1px #666666; padding:2px;"><?php echo $part_details[$j]['participant_id']; ?></td>
    <td  class="ety" align="center"  style="border-top:1px #666666; border-right:1px #666666; padding:2px;"><?php echo $part_details[$j]['admn_no']; ?></td>
    <td class="ety" align="center"  style="border-top:1px #666666; border-right:1px #666666; padding:2px;"><?php echo $part_details[$j]['gender']; ?></td>
    <td class="ety" align="center"  style="border-top:1px #666666; border-right:1px #666666; padding:2px;" ><?php echo $part_details[$j]['class']; ?></td>
    <td class="ety" align="center" style="border-top:1px #666666; border-right:1px #666666; padding:2px;"><?php if($part_details[$j]['is_captain']=='Y'){  echo $part_details[$j]['ground_name']; } ?></td>
    <td class="ety" align="left"  style="border-top:1px #666666; border-right:0px #666666; padding:2px;"><?php if($part_details[$j]['is_captain']=='Y'){ echo  $datt; }?></td>
  <!--  <td align="center" class="ety" style="border-top:1px #666666; border-right:1px #666666; padding:2px;" >&nbsp;&nbsp;<?php //echo $time; ?></td>-->
  </tr>
  	<?php
 	 }
 	 ?>
  
		</table>

</page>
       
		