<html>
<head>
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
color:#000000;
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
</head>
<body topmargin="0" bottommargin="0" >
<br><br><br>
	<?php
	//echo "<br>kkkkkkkk";
	//var_dump($details);
	if(count($details)>0 || count($details2)>0){

	?>
<table width="80%" align="center" border="1" style=" border-top:1px black; border-left:1px black; border-right:1px black;" cellpadding="0" cellspacing="0">
		<tr bgcolor="#C6D6EA">
		  <td colspan="8" align="center" height="27" class="style1"><?php echo 'Work Experience Fair'; echo ' (On the Spot) '; ?></td>
		</tr>
		
		<tr bgcolor="#C6D6EA">
		  <td colspan="8" align="center" height="27" class="style1"><?php echo 'Category&nbsp;:&nbsp;'.$details[0]['fest_name']; ?></td>
		</tr>
		
		
		<?
		//echo "<br>kkkkkkkkyyyyyyyy";
		$prev_itemcode="";
		foreach($details as $value){
			if(@$value['is_publish']!='N'){
		if(@$prev_itemcode!=@$value['item_code']){
				@$prev_itemcode=@$value['item_code'];

		?>

 	 <tr>
   		 <td  colspan="8" align="left" height="25" class="style2">&nbsp;&nbsp;<?php echo @$value['item_code'].' - '.@$value['item_name']; ?></td>
  </tr>
     <tr bgcolor=""> 
     		
             <td align="center" height="25" class="style8">Reg. No</td>
             <td align="center" height="25" class="style8">Code No.</td>
             <td align="center" height="25" class="style8">Name</td>
            <?php if(@$value['is_teach']!='Y'){?> <td align="center" height="25" class="style8">STD</td><?php }?>
             <td align="center" height="25" class="style8">School Name</td>
             <!--<td align="center" height="25" class="style8">Rank</td>-->
             <td align="center" height="25" class="style8">Grade</td>
             <td align="center" height="25" class="style8">Point</td>
      </tr>
 		 <?php  @$bg=0; } 
         
       		  if(@$bg==0){
						$bgcolor="#D8D8D8";
						$bg=1;
						}
					else{
						$bgcolor="#EFEFEF";
						$bg=0;
					}
		?>
					
 	 <tr bgcolor="<?php echo $bgcolor; ?> ">
    
             <td align="center" height="25" class="stylelp"><?php echo $value['participant_id']; ?></td>
             <td align="center" height="25" class="stylelp"><?php echo $value['code_no']; ?></td>
             <td height="25" class="stylelp">&nbsp;<?php echo wordwrap($value['participant_name'],25,'<br>'); ?></td>
            <?php if(@$value['is_teach']!='Y'){?> <td align="center" height="25" class="stylelp"><?php echo @$value['class']; ?></td><?php }?>
             <td height="25" class="stylelp">&nbsp;<?php echo  wordwrap($value['school_name'],35,'<br>'); ?></td>
             <!--<td height="25" class="stylelp" align="center"><?php //echo $value['rank']; ?>&nbsp;</td>-->
             <td height="25" class="stylelp" align="center"><?php echo $value['grade']; ?>&nbsp;</td>
             <td height="25" class="stylelp" align="center"><?php echo $value['ppoint']; ?>&nbsp;</td>
  	</tr>
				<?php
                 }
             } 
                ?>
  
    </table>
    <br>

    
    <table width="80%" align="center" border="1" style=" border-top:1px black; border-left:1px black; border-right:1px black;" cellpadding="0" cellspacing="0">
		<tr bgcolor="#C6D6EA">
		  <td colspan="8" align="center" height="27" class="style1"><?php echo 'Work Experience Fair'; echo ' (Exhibition) '; ?></td>
		</tr>
		
			<tr bgcolor="#C6D6EA">
		  <td colspan="8" align="center" height="27" class="style1"><?php echo 'Category&nbsp;:&nbsp;'.$details[0]['fest_name']; ?></td>
		</tr>	
		
		
		 <tr bgcolor=""> 
     		
             <td align="center" height="25" class="style8">Reg. No</td>
             <td align="center" height="25" class="style8">Code No.</td>
             <td align="center" height="25" class="style8">Name</td>
            <?php if(@$value['is_teach']!='Y'){?> <td align="center" height="25" class="style8">STD</td><?php }?>
             <td align="center" height="25" class="style8">School Name</td>
             <!--<td align="center" height="25" class="style8">Rank</td>-->
             <td align="center" height="25" class="style8">Grade</td>
             <td align="center" height="25" class="style8">Point</td>
      </tr>
      <?
		$bg=0;
		foreach($details2 as $value2){	
		$bg++;

	    if(@$bg%2 ==0){
						$bgcolor="#D8D8D8";
						$bg=1;
						}
					else{
						$bgcolor="#EFEFEF";
						$bg=0;
					}
		?>
					
 	 <tr bgcolor="<?php echo $bgcolor; ?> ">
    
             <td align="center" height="25" class="stylelp"><?php echo $value2['participant_id']; ?></td>
             <td align="center" height="25" class="stylelp"><?php echo $value2['code_no']; ?></td>
             <td height="25" class="stylelp">&nbsp;<?php echo wordwrap($value2['participant_name'],25,'<br>'); ?></td>
            <td align="center" height="25" class="stylelp"><?php echo @$value2['class']; ?></td>
             <td height="25" class="stylelp">&nbsp;<?php echo  wordwrap($value2['school_name'],35,'<br>'); ?></td>
             <!--<td height="25" class="stylelp" align="center"><?php //echo $value['rank']; ?>&nbsp;</td>-->
             <td height="25" class="stylelp" align="center"><?php echo $value2['grade']; ?>&nbsp;</td>
             <td height="25" class="stylelp" align="center"><?php echo $value2['ppoint']; ?>&nbsp;</td>
  	</tr>
				<?php
                 
             } 
                ?>
  
    </table>
    
    <?php }
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
