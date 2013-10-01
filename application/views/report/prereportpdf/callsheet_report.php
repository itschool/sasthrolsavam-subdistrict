<style type="text/css">
<!--
.style1 {
	font-size: 15px;
	font-weight: bold;
	color: #660033;
}
.style2{
	font-size: 11px;
	font-weight: bold;
	color:#000000;
}
.style4{
	font-size: 10px;
	color:#000000;
}
.style8{
	font-size: 8px;
	color:#CC3300;
}
.style9 {
	font-size: 20px;
	font-weight: bold;
	color: #660033;
}
.style10{
	font-size: 13px;
	font-weight: bold;
	color:#000000;
}

-->
</style>

<page backtop="20mm" backbottom="40mm">
		<page_header>
    	<?php
			$this->load->view('report/report_header');
		?>
	</page_header>
<page_footer>
	<?php
		$this->load->view('report/report_footer');
	?>
    <span class="style9">* </span> <span class="style8">Special Order Entry (Result to be declared) </span>
    <div style="clear:both"></div>
    <span class="style9"> ** </span>
    <span class="style8">Special Order Entry (Result to be Withheld)</span>
</page_footer>       
   
        
<table width="100%" align="center" >
    <tr>
    	<td align="center" class="style1" height="27" width="800"><?php echo $fair_name; ?><br />Call sheet <?php echo $fees_details[0]['fest_name']; ?><br /><?php echo $fees_details[0]['item_code'].' - '.$fees_details[0]['item_name']; ?></td>
    </tr>
    <?php
    if($fees_details[0]['time_type']=='M') $timetype='Minutes';
    else  if($fees_details[0]['time_type']=='S') $timetype='Second';
	 else  if($fees_details[0]['time_type']=='H') $timetype='Hour';
    ?>
    
</table>
  <table width="100%"  border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
  	<td colspan="6" style="border-bottom:1px #666666; padding:2px;">
    	<table align="center" width="100%" border="0">
        	<tr>
                <td class="style2" align="left" width="150">Venue : <?php echo $fees_details[0]['ground_name']; ?></td>
              <td class="style2" align="left" width="150">Date : <?php echo datetophpmodel($fees_details[0]['start_time']); ?></td>
                <td align="left" class="style2" width="150">Max Time : <?php echo $fees_details[0]['item_time'].'  '.@$timetype; ?></td>
            </tr>
        </table>
    </td>
  </tr>
  
  
  <tr bgcolor="#FFFFE8">

    <td width="6%"height="30" align="center" class="style2"  style="border-right:1px #666666; padding:2px;">Sl.No&nbsp;</td>
    <td width="12%"  height="25" align="center" class="style2" style="border-right:1px #666666; padding:2px;" >Registration No.</td>
    <td width="20%"  height="25" align="center" class="style2" style="border-right:1px #666666; padding:2px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Code No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td width="36%"  height="25" align="center" class="style2" style="border-right:1px #666666; padding:2px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
      <td width="15%"  height="25" align="center" class="style2" style="border-right:1px #666666; padding:2px;">School</td>
    <td width="20%" align="center" class="style2" height="25" style="border-right:1px #666666; padding:2px;">&nbsp;Signature  of Participant&nbsp;</td>
    
  </tr>
 
   <?php
 //  var_dump($fees_details);
   $s=0; $quato_dash_flag=0;
    if(count($fees_details)>0){
		for($j=0; $j<count($fees_details); $j++){
		
				if($fees_details[$j]['spo_id']!=0)
				{
				$quato_dash_flag=1;
					if($fees_details[$j]['is_publish']=='Y'){
					$quato_dash='*';
					}
					else {
					$quato_dash='**';
					}
				}
				else{
				
			$quato_dash='&nbsp;';
				}
				
				
				if($fees_details[$j]['is_captain']=='Y'){
					$s++;
					$style = "border-top:1px #666666; border-right:1px #666666; padding:2px;";
				 }
                else
					 $style = "border-right:1px #666666; padding:2px;";
		
		?>
		 
  <tr>
   <td width="6%" height="35"  align="center" style=" <?php echo $style;?>"><?php if($fees_details[$j]['is_captain']=='Y'){echo $s;} ?>&nbsp;</td>
     <td width="12%"  align="center" class="style10" style=" border-top:1px #666666; border-right:1px #666666; padding:2px;"><?php echo $fees_details[$j]['participant_id'].'   '.$quato_dash; ?> </td>
   
   <td  width="11%" style=" <?php echo $style;?>" align="left">&nbsp;
    <?php /*if($this->session->userdata('USER_GROUP') == 'C' && $this->session->userdata('USER_TYPE') == 4){*/
	if(@$fees_details[$j]['is_captain']=='Y' && @$fees_details[$j]['is_absent'] != 1 && @$fees_details[$j]['code_confirmed'] == 1)
	{
		echo @$fees_details[$j]['prefixCode'].$fees_details[$j]['codeNo'];
	}
	?> </td>
   
  <td width="36%"  style="border-top:1px #666666; border-right:1px #666666; padding:0px;" class="style4" >&nbsp;
  <?php	  echo $fees_details[$j]['participant_name']; 
  ?>
  </td>
  <td  width="15%" style=" <?php echo $style;?>" align="left" class="style4">
  <?php	if($fees_details[$j]['is_captain']=='Y'){
	  echo wordwrap($fees_details[$j]['school_name'],25,'<br>');
  }
	?> </td>
    <td width="20%"  style="border-top:1px #666666; border-right:0px #666666; padding:2px;">&nbsp;</td>
  
  </tr>
  <? } 
	  }
	?>


</table>

<table width="100%" border="0" align="left">
<tr><td width="9%" height="29">&nbsp;</td>
<td width="31%"></td>
<td width="1%"></td>
<td width="59%"></td>
</tr>
  <tr>
    <td colspan="2" class="style2"  height="25" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp; No. of Participants  Registered</td>
    <td colspan="2">&nbsp;&nbsp;<?php echo $fees_details[0]['no_of_participant']; ?></td>
  </tr>
  <tr>
    <td colspan="2" align="left" class="style2"  height="25" > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
     No. of Participants  Reported </td>
    <td colspan="2">........................&nbsp;</td>
  </tr>
  <tr>
    <td  colspan="2" align="left" class="style2"  height="25" >
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    No of Participants performed</td>
    <td colspan="2">........................</td>
  </tr>
  <tr>
    <td   class="style2" colspan="4"  height="25" >
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Result Declared at&nbsp;&nbsp;.........................................&nbsp;&nbsp;on &nbsp;&nbsp;.....................................................&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;by Judges  &nbsp;&nbsp;&nbsp;</td>
  </tr>
  
</table>

</page>
       
		
		