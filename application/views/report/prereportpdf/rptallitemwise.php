<style type="text/css">
<!--
.style1 {
	font-size: 14px;
	font-weight: bold;
	color: #660033;
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
			$prev_item_code="";
			
            for($j=0;$j<count($itempart);$j++){
				
				if($prev_item_code!=$itempart[$j]['item_code']){
				
						$prev_item_code=$itempart[$j]['item_code'];
						$count=0;
								if($j!=0){
								print("</table></page>");
								}
            ?>


<page backtop="30mm" backbottom="20mm">
	<page_header>
    	<?php
			$this->load->view('report/report_header');
		?>
        <table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
            <tr>
                <td class="style1" align="center"><?php echo $fair_name; if($fair_name=='Work Experience Fair'){ if($itempart[$j]['fest_name']=='Exhibition'){ echo ' (Exhibition)';} else{ echo ' (On the Spot)';}} ?><br />Itemwise participants list  <?php if($itempart[$j]['fest_name']!='Exhibition'){ echo ' : '.$itempart[$j]['fest_name']; } ?></td>
            </tr>
        </table>
	</page_header>
<page_footer>
	<?php
		$this->load->view('report/report_footer');
	?>
</page_footer> 
<br />
        
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="6" class="tb" align="center" style=" border-bottom:1px #666666; border-right:0px #666666; padding:2px;">Item  :&nbsp;&nbsp;
      <?php echo $itempart[$j]['item_code'];?>&nbsp;-&nbsp;<?php echo $itempart[$j]['item_name'];?>&nbsp;&nbsp;</td>
       
    </tr>
    
    <tr>
        <td class="tb" width='40'  align="center" style=" border-bottom:1px #666666; border-right:1px #666666; padding:2px;">Sl.No.</td>
        <td class="tb" width='60'  align="center" style=" border-bottom:1px #666666; border-right:1px #666666; padding:2px;">Reg No.</td>
        <td class="tb" width='250'  align="left" style=" border-bottom:1px #666666; border-right:1px #666666; padding:2px;">&nbsp;Name</td>
      <?php if($itempart[$j]['is_teach']!='Y'){?> <td class="tb" width='30'  align="center" style=" border-bottom:1px #666666; border-right:1px #666666; padding:2px;">B/G</td><?php } else{?><td class="tb" width='30'  align="center" style=" border-bottom:1px #666666; border-right:1px #666666; padding:2px;">M/F</td><?php }?>
        <?php if($itempart[$j]['is_teach']!='Y'){?><td class="tb"  width='40'  align="center" style=" border-bottom:1px #666666; border-right:1px #666666; padding:2px;">Class</td><?php }?>
        <td class="tb" width='260'  align="left" style=" border-bottom:1px #666666; border-right:0px #666666; padding:2px;">&nbsp;School</td>
  </tr>
    <?php
	}
   
        $count++;
    ?>
    <tr>
        <td class="ety"  align="center" style=" border-bottom:1px #666666; border-right:1px #666666; padding:2px;"><?php echo $count;?></td>
        <td class="ety"  align="left" style=" border-bottom:1px #666666; border-right:1px #666666; padding:2px;">&nbsp;&nbsp;<?php echo $itempart[$j]['participant_id'];?> <span style="color:#FF0000;"><?php if($itempart[$j]['spo_id'] > 0) echo "*";?></span></td>
        <td class="ety" align="left" style=" border-bottom:1px #666666; border-right:1px #666666; padding:2px;">&nbsp;&nbsp;<?php echo wordwrap($itempart[$j]['participant_name'],30,'<br>');?></td>
        <td class="ety" align="center" style=" border-bottom:1px #666666; border-right:1px #666666; padding:2px;"><?php if($itempart[$j]['is_teach']!='Y'){ echo $itempart[$j]['gender'];} else{ if($itempart[$j]['gender']=='G'){ echo 'F';}else{ echo 'M';}}?></td>                  
       <?php if($itempart[$j]['is_teach']!='Y'){?> <td class="ety" align="center" style=" border-bottom:1px #666666; border-right:1px #666666; padding:2px;"><?php echo $itempart[$j]['class'];?></td><?php }?>
        <td  class="ety"align="left" style=" border-bottom:1px #666666; border-right:0px #666666; padding:2px;"'><?php echo wordwrap($itempart[$j]['school_code'].' - '.$itempart[$j]['school_name'],45,'<br>');?></td>
    </tr>
    <?php 
    }
    ?>
</table>
<br />
<table><tr><td style="color:#FF0000;">* indicate the special order cases</td></tr></table>
</page>
		