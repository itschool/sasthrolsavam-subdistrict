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
.tb{
font-size: 12px;
	font-weight: bold;
	color:#000000;}
.ety{
	font-size: 12px;
	color:#000000;
	}
-->
</style>
	<?php 
	$prev_festid="";
	$previtemCode = 0;$prevteamno = $stv=$varno=$tmno=0;$prevno=$slno=1;
	 for($j = 0; $j < count($part_details); $j++){
	  if($prev_festid!=$part_details[$j]['fest_id']){
	  $count	=	0;
	  $prev_festid=$part_details[$j]['fest_id'];
	  if($j!=0){
	  print("</table></page>");
	  }
	  ?>
	 
<page backtop="30mm" backbottom="20mm ">
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
                <td width="23%" class="style9">&nbsp;&nbsp;&nbsp;<span class="style3">Festival: &nbsp;&nbsp;<?php echo $part_details[$j]['fest_name']; ?> &nbsp;&nbsp;</span></td>
                <td width="31%" class="style9">&nbsp;&nbsp;&nbsp;<span class="style3">School  Code:&nbsp;&nbsp;&nbsp;<?php echo $part_details[$j]['school_code']; ?>&nbsp;&nbsp;&nbsp;</span></td>
                <td width="44%" class="style9"><span class="style3">School Name:&nbsp;&nbsp;<?php echo wordwrap($part_details[$j]['school_name'],30,'<br/>'); ?> </span></td>
                <td width="2%">&nbsp;</td>
            </tr>
        </table>
	</page_header>
<page_footer>
	<?php
		$this->load->view('report/report_footer');
	?>
</page_footer>       

<br />

 <table width="130%" border="1" align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td width="22" align="center" class="style2" style="border-right:1px #666666; padding:2px;">Sl.No</td>
   
    <td width="178"align="left" class="style2" style="border-right:1px #666666; padding:2px;">Item</td>
   
    <td width="190" align="left" class="style2" style="border-right:1px #666666; padding:2px;">Name </td>
     <td width="40" align="center" class="style2" style="border-right:1px #666666; padding:2px;">Reg No.</td>
   <td width="40" align="center" class="style2" style="border-right:1px #666666; padding:2px;">Adm.No.</td>
    <td width="20" align="center" class="style2" style="border-right:1px #666666; padding:2px;">B/G</td>
    <td width="28" align="center" class="style2" style="border-right:1px #666666; padding:2px;">Class</td>
    <td width="56" align="center" class="style2" style="border-right:1px #666666; padding:2px;">Venue</td>
    <td width="62" align="center" class="style2" style="border-right:1px #666666; padding:2px;">Date</td>
  </tr>
  
     <?php
	 }
		 
           
		
			
		 $total_time_for_item	=	($part_details[$j]['time_type'] == 'S') ? ceil((int)$part_details[$j]['max_time'] / 60) : (int)$part_details[$j]['max_time'];
		 if(($part_details[$j]['max_time']!="")&&($part_details[$j]['no_of_participant']!="")){
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
	$txt=$part_details[$j]['participant_name'];
	$name = wordwrap($txt,20,"\n",true);
	 if($previtemCode!=$part_details[$j]['item_code']){if($tmno!=0){$tmno=0;$varno=1;}
	 $count++;
		 $previtemCode = $part_details[$j]['item_code'];	
		 if($count > 1)
		 {
			echo "</table></td></tr>";
		 }
		?>
        <tr>
          <?php if($stv==0){?><td colspan='9' > <?php } else{?>
         <td colspan='9' style="border-top:1px #666666;"> <?php }?>
        <table border='0' width='100%' cellpadding="0" cellspacing="0">
        <?
	 }//if item code different
	 
if($prevteamno!=$part_details[$j]['team_no']){
		 $count++;$tmno++;
		 $prevteamno   = $part_details[$j]['team_no'];
		 if($count > 1)
		 {
			echo "</table></td></tr>";
		 }
		?>
        <tr>
        <?php if($varno==1){?><td colspan='9' > <?php } else{?>
        <td colspan='9'  style="border-top:1px #666666;"><?php }?>
        <table border='0' width='100%' cellpadding="0" cellspacing="0">
        <?
		
	 }//if item code different
	 
?>
               
  <tr>
    <td class="ety" align="center"  style=" border-right:1px #666666;padding:2px;"width="21" ><?php if($part_details[$j]['is_captain']=='Y'){echo $slno++;}?></td>
     
    <td  class="ety"align="left"  style="border-right:1px #666666;padding:2px;" width="178"><?php if($part_details[$j]['is_captain']=='Y'){  if($_POST['radioLabel'] !='exhib'){ echo wordwrap($part_details[$j]['item_code'].' - '.$part_details[$j]['item_name'],30,'<br>');}else echo 'Exhibition'; } ?></td>
    
    <td class="ety" align="left"  style="border-right:1px #666666; padding:2px;" width="190" ><?php if($part_details[$j]['is_captain']=='Y'){ echo wordwrap($part_details[$j]['participant_name'],25,'<br>').''; } else{ echo wordwrap($part_details[$j]['participant_name'],25,'<br>');} ?><span style="color:#FF0000;"><?php if($part_details[$j]['spo_id']!=0){ echo '*';} ?></span></td>
  
    <td  class="ety" align="center"  style="border-right:1px #666666;  padding:2px;" width="40"><?php echo $part_details[$j]['participant_id']; ?></td>
     <td  class="ety" align="center"  style="border-right:1px #666666; padding:2px;" width="40"><?php echo $part_details[$j]['admn_no']; ?></td>
    <td class="ety" align="center"  style=" border-right:1px #666666; padding:2px;" width="20"><?php echo $part_details[$j]['gender']; ?></td>
    <td class="ety" align="center"  style="border-right:1px #666666; padding:2px;" width="28"><?php echo $part_details[$j]['class']; ?></td>
    <td class="ety" align="center"  style="border-right:1px #666666; padding:2px;" width="56"><?php if($part_details[$j]['is_captain']=='Y'){ echo $part_details[$j]['ground_desc']; }?></td>
    <td class="ety" align="left"  style=" padding:2px;" width="62"><?php if($part_details[$j]['is_captain']=='Y'){ echo  $datt;} ?></td>
  </tr>
  		<?php
		  	$stv=1;
		  }
 		 ?>
 </table>
 </td></tr>
</table><br />
<table><tr><td style="color:#FF0000;">* indicate the special order cases</td></tr></table>
</page>
       
		