<style type="text/css">
<!--
.style1 {
	font-size: 14px;
	font-weight: bold;
	color: #660033;
}
.style2{
	font-size: 11px;
	font-weight: 100;
	color:#000000;
}
.style3 {
	font-size: 10px;
	font-weight: 100;
	height:15px;
	border:0 0 0.5px 0.5px 0 #000000 ; 
}
.style4{
	font-size: 8px;
	font-weight: bold;
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
	font-size: 12px;
	font-weight: bold;
	color: #660033;
}
-->
</style>

<page backtop="30mm" backbottom="20mm ">
	
<page_header>
    	<?php
			$this->load->view('report/report_header');
		?>
        <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
		  <tr>
				<td colspan="2" align="center" class="style1">
				<?php
			echo $fairname[0]['fairName'];
		?>			  	Confidential Report</td>		  
		  </tr>	        
        <tr>
            <td align="left" width="337" class="style1"  style=" padding:2px;">&nbsp;&nbsp;<?php echo $itemcode;?>-<?php echo $retdat[0]['item_name'];?>(<?php echo  $retdat[0]['fest_name'];?>)   </td>
      <td  align="right" width="390" class="style1"  style=" padding:2px;">
                <?php echo $retdat[0]['ground_name'];  ?>&nbsp; on&nbsp;
                    <?php $date=explode(' ',$retdat[0]['start_time']);
                 echo datetophpmodel($date[0]);	  
                ?>            </td>
          </tr>
          
         </table> 
	</page_header>
<page_footer>
	
    <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#D4D0C8">
                <tr> <td  align="right" width="80" height="20" valign="top">Entered by :</td>
                    <td  align="right" width="500" height="20" valign="top">Signature :</td>
                    <td align="left" width="100">&nbsp;</td>
                </tr>
                <tr><td  align="right" width="80" height="20" valign="top">Checked by :</td>
                    <td   align="right" height="20" valign="top" >Program Convenor</td>
                    <td align="left">&nbsp;</td>
                </tr>
                
  </table>
    	<?php
		$this->load->view('report/report_footer');
	?>
</page_footer>

 
 <table width="95%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#666666">
    <tr>
        <td width="20"  class="style2" rowspan="2"  align="center" style="border:0 0 0.5px 0.5px 0 #666666 ;">Sl No</td>
        <td width="20"  class="style2" align="center"rowspan="2" style="border:0 0 0.5px 0.5px 0 #666666 ;">Reg No </td>
        <td width="35"  class="style2"  rowspan="2"style="border:0 0 0.5px 0.5px 0 #666666 ;">Code No</td>
        <td width="170" class="style2"  rowspan="2" align="left" style="border:0 0 0.5px 0.5px 0 #666666 ;">Name</td>          
        <td width="170" class="style2" rowspan="2"  align="left" style="border:0 0 0.5px 0.5px 0 #666666 ;">School</td>
      <td width="30" class="style2" align="center" colspan=<?php echo $judjes_count+1; ?>  style="border:0 0 0.5px 0.5px 0 #666666 ;">Marks</td>
        <td width="20" class="style2" align="center" rowspan="2" style="border:0 0 0.5px 0.5px 0 #666666 ;">%</td>
        <td width="20" class="style2" align="center" rowspan="2" style="border:0 0 0.5px 0.5px 0 #666666 ;">R</td>
        <td width="20" class="style2" align="center" rowspan="2" style="border:0 0 0.5px 0.5px 0 #666666 ;">G</td>
        <td width="20" align="center" rowspan="2" style="border:0 0 0.5px 0.5px 0 #666666 ;"><?php if($fairname[0]['fairName']=='Work Experience Fair')echo 'T'; else echo 'P';?></td>
    </tr>
            <tr>
				<?php   for($k = 1; $k <=$judjes_count; $k++ ){?>
                <td width="30" align="center" style="border:0 0 0.5px 0.5px 0 #666666 ;"><?php echo $k; ?></td>
                <? }?>
                <td width="30" align="center" style="border:0 0 0.5px 0.5px 0 #666666 ;">Total</td>
    </tr>       <?php
				$withheldno=0;
				$appeal=0;
				$sl=0;
				
				for($j=0; $j<count($retdat); $j++){
				$sl++;
		        ?>
            <tr>
            <td align="center" class="style3"><?php echo $sl;?></td>
            <td  align="center" class="style3" ><?php       
			//$withheld='';
			$symbol = '';
			if($retdat[$j]['is_publish']=='N'){
			$symbol .= '*';
			//$withheldno++;
			//$symbol=$withheld;
			}
			
			
			if($retdat[$j]['spo_id'] > 0){  
			$symbol .= '*';
			if($symbol=='**'){
			  $appeal++;}
			//$symbol=$appeal;
			$withheldno++;
			}
			
			echo $retdat[$j]['participant_id'].$symbol;
			
			?>
         </td>
            <td align="center" class="style3"><p><?php echo $retdat[$j]['code_no'];?></p></td>
            <td align="left" width="170" class="style3"><?php $name=$retdat[$j]['participant_name']; $name=wordwrap($name, 30, "<br />"); echo $name; ?></td>
            <td    width="170" align="left" class="style3"><?php $text=$retdat[$j]['school_name'];
            $text = wordwrap($text, 40, "<br />");
            echo  $retdat[$j]['school_code']."-".$text; 
            ?></td>
          
			<?php $marks	=	explode('#$#',$retdat[$j]['marks']); ?>
            <?php  for($k = 0; $k <$judjes_count; $k++ ){?>
           <td  align="center" width="30" class="style3"><?php echo @$marks[$k];
		   ?></td>
           <?php }?>
               
            <td  align="center" class="style3"><?php echo $retdat[$j]['total_mark'];?></td>
            <td  align="center" class="style3"><?php
              $percentage=$retdat[$j]['percentage'];
              $print=round($percentage,2);
              echo $print;
              ?></td>
            <td align="center" class="style3"><?php echo $retdat[$j]['rank'];?></td>
            <td align="center" class="style3"><?php echo $retdat[$j]['grade'];?></td>
            
            <td align="center" class="style3"><?php if($fairname[0]['fairName']=='Work Experience Fair')echo $retdat[$j]['total_mark']; else echo $retdat[$j]['point'];?></td>
  </tr>
           
      <?php
    
         
		 }?>
</table><br />
<table  align="center"  width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
        <td width="150" align="left">**No of withheld :<?php echo $appeal;?></td>
        <td width="150">No.of Registered :&nbsp;&nbsp;<?php echo $participated[0]['picount'];?></td>
        <td width="150">No of Absentee :&nbsp;&nbsp;<?php echo((count($absentee) and $absentee[0]) ? count($absentee) : 0 );?></td>
        <td width="150">*No of Appeal Entry :<?php echo ($withheldno-$appeal);?></td>
  </tr>
 <tr>
 	<td colspan="3">
    	<table width="100%">
          <tr>
            <td valign="top" >Absentee Reg No :</td>
            <td>
            <?php 
                    for($k=1;$k<=count($absentee);$k++){
                
                           echo $absentee[$k-1].'&nbsp;';
                           if(($k%12==0)&&($k!=0)){
                           print("<br>");
                           }
                           
                }
                 ?>
            </td>
          </tr>
    	</table>
    </td>
    
 </tr>
</table>

</page>
		