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
.style10 {
	font-size:13px;
	font-weight: bold;
	color:#000000;
}
-->
</style>
<?php
  
		
		 $prev_itemcode="";
		 $post_itemcode="";$quato_dash_flag=0;
 //var_dump($fees_details);
		for($j=0; $j<count($fees_details); $j++){
			
			$quato_dash="";
			if( $prev_itemcode!=$fees_details[$j]['item_code']){
			 $s=0;
			$prev_itemcode=$fees_details[$j]['item_code'];
			if($j!=0){
		//echo "--".$s;
			print("</page>");
			}
			else {
				$post_itemcode=$fees_details[$j+1]['item_code'];
			}
			
		?>


	
<page backtop="20mm" backbottom="40mm " >
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
 
<table width="83%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
<tr>
    	<td align="center" class="style1" height="27" width="800"><?php echo $fees_details[0]['fairName']; if($fees_details[0]['fairName']=='Work Experience Fair' && $this->input->post('radioLabel') == 'exhib'){ echo ' (Exhibition)';} if($fees_details[0]['fairName']=='Work Experience Fair' && $this->input->post('radioLabel') == 'spot'){ echo ' (On the Spot)';} ?></td>
    </tr>
    <tr>
    	<td align="center" class="style1" height="27" width="800">Call sheet <?php  if($fees_details[0]['fest_name']!='Exhibition'){echo $fees_details[0]['fest_name'];} ?><br /><?php echo $fees_details[$j]['item_code'].' - '.$fees_details[$j]['item_name']; ?></td>
    </tr>
   <?php
   if($fees_details[$j]['time_type']=='M') $timetype='Minutes';
   else  if($fees_details[$j]['time_type']=='S') $timetype='Second';
   else  if($fees_details[$j]['time_type']=='H') $timetype='hour';
   ?>
</table>
        
       
        
<table width="100%"  border="1" bordercolor="#666666" align="center" cellpadding="0" cellspacing="0">
  <tr>
  	<td colspan="6" style="border-bottom:1px #666666; padding:2px;">
    	<table align="center" width="100%" border="0">
        	<tr>
                <td class="style2" align="left" width="150">Stage No : <?php echo $fees_details[$j]['ground_name']; ?></td>
                <td class="style2" align="left" width="150">Date : <?php echo datetophpmodel($fees_details[$j]['start_time']); ?></td>
                <td align="left" class="style2" width="150">Max Time : <?php echo $fees_details[$j]['item_time'].'  '.$timetype; ?></td>
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
  <!--<tr>
    <td align="center" class="style2"  style="border-right:1px #666666; padding:2px;"height="30">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sl.No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="center" class="style2"  height="25" style="border-right:1px #666666; padding:2px;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Registration No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="center" class="style2"  height="25" style="border-right:1px #666666; padding:2px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Code No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td width="23%" align="center" class="style2" height="25" style="border-right:1px #666666; padding:2px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Signature  of Participant&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td width="14%" align="center" class="style2"  height="25" style="border-right:0px #666666; padding:2px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Remarks&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td> </tr>-->
   		 <?php
		}
		
		
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
				
			$quato_dash='';
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
     <!-- <tr height="35">
    <td  align="center" style=" <?php echo $style;?>" height="35"><?php if($fees_details[$j]['is_captain']=='Y'){echo $s;} ?></td>
    <td  class="style10" align="center" style="border-top:1px #666666; border-right:1px #666666; padding:2px;"><?php echo $fees_details[$j]['participant_id'].'  '.$quato_dash; ?> </td>
    <td width="17%" style=" <?php echo $style;?>"><?php echo @$fees_details[$j]['prefixCode'].@$fees_details[$j]['codeNo']; ?></td>
    <td style="border-top:1px #666666; border-right:1px #666666; padding:2px;">&nbsp;</td>
    <td style="border-top:1px #666666; border-right:0px #666666; padding:2px;">&nbsp;</td>
  </tr> --> 
  
  		<?php
		$array_max=count($fees_details);
			if($j!=($array_max-1)) 
				{
				 
		
 		if(($post_itemcode!=$fees_details[$j+1]['item_code'])&&($j!=0)){
			$post_itemcode=$fees_details[$j+1]['item_code'];
			
		?>
       </table>  <table width="100%" border="0" align="left">
<tr><td width="9%" height="29">&nbsp;</td>
<td width="31%"></td>
<td width="1%"></td>
<td width="59%"></td>
</tr>
  <tr>
    <td colspan="2" class="style2"  height="25" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;     No. of Participants  Registered</td>
    <td colspan="2">&nbsp;&nbsp;<?php echo $fees_details[$j]['no_of_participant']; ?></td>
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
  
 
 


		<?php
		$quato_dash_flag=0;
				}
				
			}
			else {
		?>
        
       </table> <table width="100%" border="0" align="left">
<tr><td width="9%" height="29">&nbsp;</td>
<td width="31%"></td>
<td width="1%"></td>
<td width="59%"></td>
</tr>
  <tr>
    <td colspan="2" class="style2"  height="25" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;Total No. of Participants  Registered</td>
    <td colspan="2">&nbsp;&nbsp;<?php echo $fees_details[$j]['no_of_participant']; ?></td>
  </tr>
  <tr>
    <td colspan="2" align="left" class="style2"  height="25" > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Total No. of Participants  Reported </td>
    <td colspan="2">........................&nbsp;</td>
  </tr>
  <tr>
    <td  colspan="2" align="left" class="style2"  height="25" >
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    No of Participants staged the  item</td>
    <td colspan="2">........................</td>
  </tr>
  <tr>
    <td   class="style2" colspan="4"  height="25" >
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    Result Declared at&nbsp;&nbsp;.........................................&nbsp;&nbsp;on &nbsp;&nbsp;.....................................................&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;by Judges  &nbsp;&nbsp;&nbsp;</td>
  </tr>
  <tr>
   
    <td class="style2" align="right" colspan="3">&nbsp;&nbsp;&nbsp;</td>
    <td class="style2" align="right" height="50">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Signature of stage manager:</td>
  </tr>
   <?php
  if($quato_dash_flag==1){
  ?>
  <tr>
   
    <td height="20" align="left" colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="style9">* </span> <span class="style8">Special Order Entry (Result to be declared) </span></td>
   
  </tr>
  <tr>
   
    <td height="20" align="left" colspan="4"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="style9"> ** </span>
    <span class="style8">Special Order Entry (Result to be Withheld)</span> </td>
   
  </tr>
  <?php
  }
  ?>
</table>
        
        
        <?php
		}
		}
		?>
        </page>

       
       
		
		