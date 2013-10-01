<style type="text/css">
<!--
.style1 {
	font-size: 14px;
	font-weight: bold;
	color: #660033;
}
.style2{
	font-size: 12px;
	font-weight: bold;
	color:#000000;
}
.style3{ 
	font-size: 11px;
	font-weight: bold;
	color:#000000;
}
.style9{ 
	font-size: 12px;
	font-weight: bold;
	color:#000000;
}

.tb{
font-size: 12px;
	font-weight: bold;
	color:#000000;}
.ety{
	font-size: 11px;
	color:#000000;
	}

-->
</style>
<style>
@media print
{
h1 {page-break-before:always}
}
</style>
<page backtop="20mm" backbottom="20mm">
		<page_header>
    	<?php
			$this->load->view('report/report_header');
		?>
	</page_header>
<page_footer>
	<?php
		$this->load->view('report/report_footer');
	?>
</page_footer>       

   
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" >
    <tr>
        <td height="43" align="center" class="style1"><br />List of Students Participating More than One Items - All Fair</td>
    </tr>
</table>
       
 
   <?php
  				$s=0;
				$prev_fest="";
				for($j=0; $j<count($fees_details); $j++){
				$s++;
				if($prev_fest!=$fees_details[$j]['fest_id']){
					if($j!=0){
					print("</table>");
					
				?>
				
			   <?Php 
						 }
		
			$prev_fest=$fees_details[$j]['fest_id'];
			$s=1;
		
			?>
<table width="100%" align="center" border="1" cellpadding="0" cellspacing="0" >
    <tr>
    	<td colspan="6" align="center" class="style2" height="26" style="border-bottom:1px #666666; border-right:0px #666666; padding:2px;">&nbsp;&nbsp;<?php if($fees_details[$j]['fest_name']!='Exhibition'){echo 'Category : '.$fees_details[$j]['fest_name'];} ?></td>
    </tr>
    <tr>
        <td width="20" align="center" class="style3" style="border-right:1px #666666; padding:2px;" height="26">Sl.No</td>
        <td width="30" align="center" class="style3" style="border-right:1px #666666; padding:2px;">Reg No.</td>
        <td width="30" align="center" class="style3" style="border-right:1px #666666; padding:2px;">No.&nbsp;of<br />Items</td>
        <td width="80" align="left" class="style3" style="border-right:1px #666666; padding:2px;">&nbsp;Name </td>
      <td width="90" align="left" class="style3" style="border-right:1px #666666; padding:2px;">School</td>
        <td width="20" align="left" class="style3" style="border-right:1px #666666; padding:2px;">Items</td>
  </tr>
    <? 
    } 
    ?>
    <tr>
        <td class="ety"  align="center"  style="border-top:1px #666666; border-right:1px #666666; padding:2px;"><?php echo $s; ?></td>
        <td class="ety"  align="center"  style="border-top:1px #666666; border-right:1px #666666; padding:2px;"><?php echo $fees_details[$j]['participant_id']; ?><span style="color:#FF0000;"><?php if($fees_details[$j]['spo_id']!=0){ echo '*';} ?></span></td>
        <td class="ety"  align="center"  style="border-top:1px #666666; border-right:1px #666666; padding:2px;"><?php echo $fees_details[$j]['cnt']; ?></td>
        <td class="ety"  align="left"  style="border-top:1px #666666; border-right:1px #666666; padding:2px;"><?php echo wordwrap($fees_details[$j]['participant_name'],20,'<br>'); ?></td>
        <td class="ety"  align="left"  style="border-top:1px #666666; border-right:1px #666666; padding:2px;"><?php echo wordwrap($fees_details[$j]['school_code'].' - '.$fees_details[$j]['school_name'],40,'<br>'); ?></td>
        <td class="ety"  align="left"  style="border-top:1px #666666; border-right:1px #666666; padding:2px;">
        <?
        $item_details		=	$this->prereport_model->get_participant_details_more_allfair($fees_details[$j]['participant_id']);
		
		foreach($item_details as $items){
		
		//echo "<br /><br />";
		$fair_name	=	$items['fairName'];
		$item_code	=	$items['item_code'];
		$item_name	=	$items['item_name']; ?>		
        
        <?php echo '<strong>'.$fair_name.'</strong>'.' - '.wordwrap($item_name,20,'<br>').' ('.$item_code.')<br />'; 
		 }        
        ?>
    </td>    
    
    </tr>
<? 
} 
?>

</table>
<br />
<table><tr><td style="color:#FF0000;">* indicate the special order cases</td></tr></table>
        </page>
