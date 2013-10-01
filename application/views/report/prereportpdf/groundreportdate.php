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
      <table width="100%" border="0" cellspacing="0" cellpadding="4" align="center">
            <tr>
                <td align="center" class="style1">Venue Reports</td>
            </tr>
            <tr>
                <td align="center"><strong><?php echo $groundname[0]['ground_name'];?> (<?php echo datetophpmodel($date);?>)</strong></td>
            </tr>
        </table>
	</page_header>
<page_footer>
	<?php
		$this->load->view('report/report_footer');
	?>
</page_footer>  



<table width="85%" border="1" cellpadding="5" cellspacing="0">
  <tr>
    <td class="tb" height="25" align="center" width='37' style="border-bottom:0px #666666; border-right:1px #666666; padding:0px;">Sl.No. </td>
    <td class="tb" height="25" align="left" width='196' style="border-bottom:0px #666666; border-right:1px #666666; padding:0px;">&nbsp;&nbsp;Item</td>
    <td  class="tb"height="25" align="center" width='129' style="border-bottom:0px #666666; border-right:1px #666666; padding:0px;"> No.of <br />
    Participants/Teams</td>
    <td  class="tb" height="25" align="center" width='100' style="border-bottom:0px #666666; border-right:1px #666666; padding:0px;"> Tentative Time </td>
    <td class="tb"  height="25" align="center" width='99' style="border-bottom:0px #666666; border-left:0px #666666; padding:0px;">Remarks </td>
  </tr>
 	 <?php
		
            $count		=	0;
			$grandtotal =   0;
            foreach($grounddata as $data)
			{
					$count++;
					
					$time	=	($data['time_type'] == 'S') ? ceil((int)$data['max_time'] / 60) : (int)$data['max_time'];
					if ($data['is_off_stage'] == 'N')
					{
						$time		=	$data['max_time'] * $data['no_of_participant'];
					}
					$time		=	get_time_format($time);		
             ?>
  <tr>
   <td class="ety" align="center" style="border-top:1px #666666; border-right:1px #666666; padding:0px;"><?php echo $count;?></td>
   <td class="ety"  align="left" style="border-top:1px #666666; border-right:1px #666666; padding:0px;">&nbsp;<?php echo $data['item_code'].' - '.$data['item_name'].' ('.$data['fest_name'].')';?></td>
   <td class="ety" align="center" style="border-top:1px #666666; border-right:1px #666666; padding:0px;"><?php echo $data['no_of_participant'];?></td>
   <td class="ety"  align="center" style="border-top:1px #666666; border-right:1px #666666; padding:0px;"><?php echo $time?></td>
   <td class="ety" style="border-top:1px #666666; border-left:0px #666666; padding:0px;">&nbsp;</td>
  </tr>
	  <?php } ?>
  
</table>

</page>    