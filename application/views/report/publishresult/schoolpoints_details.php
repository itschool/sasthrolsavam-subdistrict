<script type="text/javascript" src="<?php echo base_url() ?>js/ground/ground.js"></script>
<style>
.style1{font-size:14px;
font-weight:bold;
color:#964B4B;
}
.style2{font-size:12px;
font-weight:bold;
color:#FFFFFF;
}
.style3{font-size:12px;
font-weight:bold;
color:black;
}


.style4{font-size:14px;
font-family:"Arial Narrow";
font-weight:bold;
color:black;
}
</style>
<br>

<? echo form_open('', array('id' => 'schoolpoints','name'=>'schoolpoints','target'=>'_blank')); ?>
<input type="hidden" name="baseurl" id="baseurl" value="<? echo base_url(); ?>" >
<body topmargin="0" bgcolor="#ECE2F1">
	<?php
	if(count($details)>0){
	
	 $fairname	=	@$fairName[0]['fairName'];
	 $festname	=	@$festName[0]['fest_name'];
	 $schoolname	=	@$schoolName[0]['school_name'];

	?>
<table width="61%" align="center" border="1" style=" border-top:1px black; border-left:1px black; border-right:1px black;" cellpadding="0" cellspacing="0">
	 <tr bgcolor="#A2BDEA">
    	<td colspan="7" align="center" height="27" class="style1" ><?php echo @$fairname; if(@$fairname=='Work Experience Fair'){ if(@$festname=='Exhibition'){ echo ' (Exhibition) ';} else{ echo ' (On the Spot) ';}} else { echo "&nbsp;&nbsp;&nbsp;&nbsp;".@$festname; } ?></td></tr>
     <?php
		//$prev_festid="";
		//foreach($details as $value){
			
			//if($prev_festid!=$value['fest_id']){
			//$prev_festid=$value['fest_id'];
			$count=0;
		
		 ?>
<tr bgcolor="#964B4B">
    	<td colspan="7" align="center" height="27" class="style2"><? echo @$schoolname; ?></td>
  </tr>
     <tr>
     	<td height="24" align="center" bgcolor="#E5E5E5" class="style3">Sl.No.</td>
       <td align="left" bgcolor="#E5E5E5" class="style3">&nbsp;&nbsp;Reg No</td>
       <td align="left" bgcolor="#E5E5E5" class="style3">&nbsp;&nbsp;Code Number</td>
       <td width="36%" align="left" bgcolor="#E5E5E5" class="style3">&nbsp;&nbsp;Item Name</td>
       <td width="9%" align="left" bgcolor="#E5E5E5" class="style3">&nbsp;&nbsp;Grade</td>
        <td width="8%" align="left" bgcolor="#E5E5E5" class="style3">&nbsp;&nbsp;Rank</td>
       <td width="8%" align="left" bgcolor="#E5E5E5" class="style3">&nbsp;&nbsp;Point</td>
      
       
		
  
			 <? //} 
			 $total_points	=	0;
			 //var_dump($overall_details);
			 //echo "<br>".count($overall_details);
             foreach($details as $value){
			 	$bgcolor	=	'#E5E5E5';
			if(count($overall_details) > 0 ) {
			 	foreach($overall_details as $over)
				{
					//echo "<br> all-->".$value['item_code']." overr----".$over['item_code'];
					if($value['item_code'] == $over['item_code']) {
						$bgcolor		=	'#D5F0DA';		
						if($value['participant_id'] == $over['participant_id']) {
					//echo "<br>--".$value['item_code']."---".$total_points."--->".$over['point'];		
						$total_points	+=	$over['point'];		
						
						//echo "<br>--tottt".$total_points;				
						
					}
					
						
					}	
					
				}
				
			}
			
			
				
				//echo "<br>--".$value['item_code']."---".$total_points."--->".$value['point'];
			 
			 $count++; 
             ?>
             <tr bgcolor="<? echo $bgcolor; ?>">
             <td width="8%" height="23" align="center" class="style4"><?php echo $count; ?></td>
    <td width="12%" height="23" align="left" class="style4">&nbsp;&nbsp;&nbsp;<?php echo $value['participant_id']; ?></td>
    <td width="12%" height="23" align="left"  class="style4">&nbsp;&nbsp;&nbsp;<?php echo $value['code_no']; ?></td>
     <td width="12%" height="23" align="left"  class="style4">&nbsp;&nbsp;&nbsp;<?php echo $value['item_code']." - ".$value['item_name']; ?></td>
    <td width="12%" height="23" align="center"  class="style4">&nbsp;&nbsp;&nbsp;<?php echo $value['grade']; ?></td>
    <td width="12%" height="23" align="center" class="style4">&nbsp;&nbsp;&nbsp;<?php echo $value['rank']; ?></td>
    <td width="12%" height="23" align="center"  class="style4">&nbsp;&nbsp;&nbsp;<?php echo $value['point']; ?></td>
     
  </tr>
  	
  		<?php } ?>
        <tr  bgcolor="#E5E5E5">
    	<td width="12%" colspan="5" height="23" align="center" class="style4">&nbsp;&nbsp;&nbsp;Total Points</td>
        <td width="12%"  height="23" align="center" class="style4">&nbsp;&nbsp;&nbsp;</td>
        <td width="12%" height="23" align="center" class="style4"><?php echo $total_points; ?></td>
        
    </tr>
  
    </table>
    <?php }
		else {
		?>
        <table align="center" width="75%">
       	 <tr>
        	<td align="center">Try later...... Points are  Not Ready </td>
      	  </tr>
        </table>
        <? } ?>
        </body>
	<?php
	echo form_close();
	?>