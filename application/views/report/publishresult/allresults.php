
<html>
<style>
.style1{
font-size:14px;
font-family:"Courier New", Courier, monospace;
font-weight:bold;
color:#AC3C0B;

}
.style2{
font-size:15px;
font-weight:bold;
color:#FFFFFF;
}
.style8{
font-size:12px;
font-family:Arial, Helvetica, sans-serif;
font-weight:bold;
color:#000000;
}
.stylelp{
font-size:12px;
font-family:Arial, Helvetica, sans-serif;
color:#000000;
}

.style4{
font-size:13px;
color:#A76830;
}
.style5{
font-size:16px;
color:#0033FF;
}
</style>

<body bgcolor="#F5F5F5" topmargin="0">
	<?php
	if(count($details)>0){
	if(@$wrk	!=	'exb') {
	?>
  <table width="80%" align="center" border="1" style=" border-top:1px black; border-left:1px black; border-right:1px black;" cellpadding="0" cellspacing="0">
        <?php
		$prev_itemcode="";
		$prev_festid="";
		foreach($details as $value){
			if(@$value['is_publish']!='N'){
		
			if($prev_festid!=$value['fest_id']){
			$prev_festid=$value['fest_id'];
		?>
        <tr bgcolor="#000000">
        	<td colspan="8" align="center" height="5" class="style2"></td></tr>

	<tr bgcolor="#B689B1">
        	<td colspan="8" align="center" height="30" class="style2"><?php echo $value['fairName'];  if($value['fairName']=='Work Experience Fair'){  if(@$wrk=='exb'){ echo ' (Exhibition) ';} elseif(@$wrk=='all'){ echo ' ';} else{ echo ' (On the Spot) ';}} ?> &nbsp;&nbsp;Category :<?php echo $value['fest_name']; ?></td>
	</tr>

		
		<?php
		}
		if($prev_itemcode!=$value['item_code']){
				$prev_itemcode=$value['item_code'];
		?>
 	 <tr bgcolor="#CAE4FF" >
   		 <td  colspan="8" align="left" height="25">&nbsp;&nbsp;<b><?php echo @$value['item_code'].'&nbsp;- &nbsp;'.@$value['item_name']; ?></b></td>
 	 </tr>
     <tr> 
     
     		
             <td align="center" height="25" class="style8">Reg. No</td>
             <td align="center" height="25" class="style8">Code No.</td>
             <td align="center" height="25" class="style8">Name</td>
             <td align="center" height="25" class="style8">STD</td>
             <td align="center" height="25" class="style8">School Name</td>
             <!--<td align="center" height="25" class="style8">Rank</td>-->
             <td align="center" height="25" class="style8">Grade</td>
             <td align="center" height="25" class="style8"><? if(@$value['fairId'] != 4) echo "Point"; else echo "Marks"; ?></td>
      </tr>
 		 <?php } ?>
 	 <tr bgcolor="#F2F2F2">
     
             <td align="center" height="25" class="stylelp"><?php echo $value['participant_id']; ?></td>
             <td align="center" height="25" class="stylelp"><?php echo $value['code_no']; ?></td>
             <td height="25" class="stylelp">&nbsp;<?php echo wordwrap($value['participant_name'],25,'<br>'); ?></td>
             <td align="center" height="25" class="stylelp"><?php echo $value['class']; ?></td>
             <td height="25" class="stylelp" >&nbsp;<?php echo  wordwrap($value['school_name'],35,'<br>'); ?></td>
             <!--<td height="25" class="stylelp" align="center"><?php //echo $value['rank']; ?></td>-->
             <td height="25" class="stylelp" align="center"><?php echo $value['grade']; ?></td>
             <td height="25" class="stylelp" align="center"><? if(@$value['fairId'] != 4) echo $value['point']; else echo $value['total_mark']; ?></td>
  	</tr>
  		<?php 
		} 
				}?>
  
    </table>
    <?php }
	else{ ?>
	
			<table width="80%" align="center" border="1" style=" border-top:1px black; border-left:1px black; border-right:1px black;" cellpadding="0" cellspacing="0">
        <?php
		$prev_itemcode="";
		$prev_festid="";
		foreach($details as $value){
			if(@$value['is_publish']!='N'){
		
			if($prev_festid!=$value['fest_id']){
			$prev_festid=$value['fest_id'];
		?>
        <tr bgcolor="#000000">
        	<td colspan="8" align="center" height="5" class="style2"></td></tr>

	<tr bgcolor="#B689B1">
        	<td colspan="8" align="center" height="30" class="style2">Work Experience Fair (Exhibition) &nbsp;&nbsp;Category :<?php echo $value['fest_name']; ?></td>
	</tr>
    <tr> 
     
     		
             <td align="center" height="25" class="style8">Reg. No</td>
             <td align="center" height="25" class="style8">Code No.</td>
             <td align="center" height="25" class="style8">Name</td>
             <td align="center" height="25" class="style8">STD</td>
             <td align="center" height="25" class="style8">School Name</td>
             <!--<td align="center" height="25" class="style8">Rank</td>-->
             <td align="center" height="25" class="style8">Grade</td>
             <td align="center" height="25" class="style8">Marks</td>
      </tr>

		
		<?php
		} ?>
		
 	 
     
 		
 	 <tr bgcolor="#F2F2F2">
     
             <td align="center" height="25" class="stylelp"><?php echo $value['participant_id']; ?></td>
             <td align="center" height="25" class="stylelp"><?php echo $value['code_no']; ?></td>
             <td height="25" class="stylelp">&nbsp;<?php echo wordwrap($value['participant_name'],25,'<br>'); ?></td>
             <td align="center" height="25" class="stylelp"><?php echo $value['class']; ?></td>
             <td height="25" class="stylelp" >&nbsp;<?php echo  wordwrap($value['school_name'],35,'<br>'); ?></td>
             <!--<td height="25" class="stylelp" align="center"><?php //echo $value['rank']; ?></td>-->
             <td height="25" class="stylelp" align="center"><?php echo $value['grade']; ?></td>
             <td height="25" class="stylelp" align="center"><?php echo $value['total_mark']; ?></td>
  	</tr>
  		<?php 
		} 
				}?>
  
    </table>
	<?
	
	 }
	}
		else {
		?>
        <table align="center" width="75%">
       	 <tr>
        	<td align="center">Please Wait....... Result Not Prepared</td>
      	  </tr>
        </table>
        <? } ?>
        
        </body>
        </html>
