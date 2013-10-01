<style type="text/css">
<!--
.style1 {
	font-size: 14px;
	font-weight: bold;
	color: #660033;
}
.tb{
font-size: 11px;
	font-weight: bold;
	color:#000000;}
.ety{
	font-size: 12px;
	color:#000000;
	}
-->
</style>
<page backtop="30mm" backbottom="20mm ">
	<page_header>
    	<?php
			$this->load->view('report/report_header');
		?>
        <table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
        	<!--<tr>
                <td colspan="2" class="style1" align="center"><?php //echo $fair_name; ?></td>
            </tr>-->
            <tr>
                <td colspan="2" class="style1" align="center">
                <?php  echo 'Work Experience (Exhibition)'; ?>
				<br />  
								Participants list</td>
            </tr>
             <tr>
       
        <td width="57%" align="center" class="tb">&nbsp;&nbsp;<?php   echo 'Festival : '.@$fest_name[0]['fest_name'];?></td>
  </tr>
        </table>
	</page_header>
<page_footer>
	<?php
		$this->load->view('report/report_footer');
	?>
</page_footer> 
<p>&nbsp;</p>
        
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td class="tb" width='40' align="center" style="border-top:0px #666666; border-right:1px #666666; padding:2px;">Sl.No.</td>
        <td  class="tb" width='60' align="center" style="border-top:0px #666666; border-right:1px #666666; padding:2px;">Reg No.</td>
        <td class="tb" width='230' align="left" style="border-top:0px #666666; border-right:1px #666666; padding:2px;">&nbsp;&nbsp;Name </td>
        
      <td class="tb" width='30' align="center" style="border-top:0px #666666; border-right:1px #666666; padding:2px;"><?php if(@$itemdet[0]['is_teach']!='Y'){?>B/G <?php } else{?>M/F<?php }?></td>
        <?php if(@$itemdet[0]['is_teach']!='Y'){?><td class="tb"  width='40' align="center" style="border-top:0px #666666; border-right:1px #666666; padding:2px;">Class</td><?php }?>
        <td class="tb" width='280' align="left" style="border-top:0px #666666; border-right:0px #666666; padding:2px;">&nbsp;&nbsp;School</td>
  </tr>
    <?php    
    $count	=	0;
    foreach($partdata as $data)
    {
        $count++;
    ?>
    <tr>
        <td class="ety"  align="center" style="border-top:1px #666666; border-right:1px #666666; padding:2px;"><?php echo $count;?></td>
        <td  class="ety"  align="left" style="border-top:1px #666666; border-right:1px #666666; padding:2px;">&nbsp;&nbsp;<?php echo $data['participant_id'];?><span style="color:#FF0000;"><?php if($data['spo_id'] > 0) echo "*";?></span></td>
        <td class="ety"  align="left" style="border-top:1px #666666; border-right:1px #666666; padding:2px;">&nbsp;&nbsp;<?php echo wordwrap($data['participant_name'],34,'<br>');?></td>
      <td class="ety"  align="center" style="border-top:1px #666666; border-right:1px #666666; padding:2px;"><?php if(@$itemdet[0]['is_teach']!='Y'){ echo $data['gender']; } else{ if($data['gender']=='G'){ echo 'F';} else{ echo 'M';}}?></td>                  
       <?php if(@$itemdet[0]['is_teach']!='Y'){?> <td  class="ety" align="center" style="border-top:1px #666666; border-right:1px #666666; padding:2px;"><?php echo $data['class'];?></td><?php }?>
        <td class="ety"  align="left" style="border-top:1px #666666; border-right:0px #666666; padding:2px;">&nbsp;&nbsp;<?php echo wordwrap($data['school_code'].' - '.$data['school_name'],47,'<br>');?></td>
  </tr>
    <?php 
    }
    ?>
</table>
<br />
<table><tr><td style="color:#FF0000;">* indicate the special order cases</td></tr></table>
</page>
		