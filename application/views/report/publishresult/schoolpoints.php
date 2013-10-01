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
<? echo form_open('', array('id' => 'schoolpoints','name'=>'schoolpoints','target'=>'_blank')); ?>
<input type="hidden" name="baseurl" id="baseurl" value="<? echo base_url(); ?>" >
<body topmargin="0" bgcolor="#ECE2F1">
	<?php
	if(count($overall_details)>0){

	?>
<table width="61%" align="center" border="1" style=" border-top:1px black; border-left:1px black; border-right:1px black;" cellpadding="0" cellspacing="0">
	 <tr bgcolor="#A2BDEA">
    	<td colspan="3" align="center" height="27" class="style1" ><?php echo @$overall_details[0]['fairName']; if(@$overall_details[0]['fairName']=='Work Experience Fair'){ if(@$wrk=='exb'){ echo ' (Exhibition) ';} else if(@$wrk=='all'){ echo ' ';} else{ echo ' (On the Spot) ';}}?></td></tr>
     <?php
		
			$count=0;
		
		 ?>
<tr bgcolor="#964B4B">
    	<td colspan="3" align="center" height="27" class="style2"> School Point <?php if(@$overall_details[0]['fest_name']!='Exhibition'){echo (@$overall_details[0]['fest_name']) ? '( Category&nbsp;:&nbsp;'.@$overall_details[0]['fest_name'].')' : ''; }
		
		$fest_id	=	@$overall_details[0]['fest_id'];
		?> Overall Champion</td>
  </tr>
     <tr>
     	<td height="24" align="center" bgcolor="#B4B4B4" class="style3">Sl.No.</td>
       <td align="left" bgcolor="#E5E5E5" class="style3">&nbsp;&nbsp;School</td>
       <td align="center" bgcolor="#B4B4B4" class="style3">Overall <? if($fairId != 4){ ?>Point <? } else{ ?>Mark <? }?></td>		
  <tr>
			 <? 
			 $prev_mark	= '';
			 $prev_totmark	=	'';
			 $overall_school = '';
             foreach($overall_details as $value){
			 $count++; 
			 
			  if($fairId != 4){
			 	$if	=	($value['spoint'] == $prev_mark || $prev_mark =='') && ($value['tot_mark'] == $prev_totmark || $prev_totmark =='');
			  }
			 else{
			 	$if	=	($value['spoint'] == $prev_mark || $prev_mark =='') ;
			 }
			
		  	 if($if) {
			 
		// if($value['spoint'] == $prev_mark || $prev_mark =='') {
             ?>
             <td width="11%" height="23" align="center" bgcolor="#B4B4B4" class="style4"><?php echo $count; ?></td>
             <td width="74%" height="23" align="left" bgcolor="#E5E5E5" class="style4">&nbsp;&nbsp;&nbsp;<?php 
			 $overall_school	=	$overall_school.",".$value['school_code'];
			 echo wordwrap($value['school_code'].'&nbsp;&nbsp;&nbsp;'.$value['school_name'],80,'<br>'); ?></td>
             <td width="15%" height="23" align="center" bgcolor="#B4B4B4" class="style4"><a href="javascript:return clickpointdetails('<?php echo $fest_id; ?>','<?php echo $value['school_code']; ?>')" onClick="javascript:return clickpointdetails('<?php echo $fest_id; ?>','<?php echo $fairId; ?>','<?php echo $value['school_code']; ?>')" ><?php echo $value['spoint']; ?></a></td>
  </tr>
  		<?php
			if($fairId != 4)
				$prev_totmark	=	$value['tot_mark'];
		
			$prev_mark	=	$value['spoint'];
		   } //if($count == 1)
		
		 }// foreach ?>
  
    </table><br>
<br>
<?
   if(count($runnerup_details)>0){
	?>
    
   <table width="61%" align="center" border="1" style=" border-top:1px black; border-left:1px black; border-right:1px black;" cellpadding="0" cellspacing="0">
	 <tr bgcolor="#A2BDEA">
    	<td colspan="3" align="center" height="27" class="style1" ><?php echo @$runnerup_details[0]['fairName']; if(@$runnerup_details[0]['fairName']=='Work Experience Fair'){ if(@$wrk=='exb'){ echo ' (Exhibition) ';} else if(@$wrk=='all'){ echo ' ';} else{ echo ' (On the Spot) ';}}?></td></tr>
     <?php
		
			$count=0;
		
		 ?>
<tr bgcolor="#964B4B">
    	<td colspan="3" align="center" height="27" class="style2"> School Point <?php if(@$runnerup_details[0]['fest_name']!='Exhibition'){echo (@$runnerup_details[0]['fest_name']) ? '( Category&nbsp;:&nbsp;'.@$runnerup_details[0]['fest_name'].')' : ''; }
		
		$fest_id	=	@$runnerup_details[0]['fest_id'];
		?> Runnersup</td>
  </tr>
     <tr>
     	<td height="24" align="center" bgcolor="#B4B4B4" class="style3">Sl.No.</td>
       <td align="left" bgcolor="#E5E5E5" class="style3">&nbsp;&nbsp;School</td>
       <td align="center" bgcolor="#B4B4B4" class="style3">Overall <? if($fairId != 4){ ?>Point <? } else{ ?>Mark <? }?></td>
	 </tr>	
  <tr>
			 <? 
             foreach($runnerup_details as $value1){
			   $overall_flag	=	0;
			   //echo "<br>---".($overall_school);
			   $overall_array	= explode(',', $overall_school);
			  
			   for($i=1;$i<count($overall_array);$i++)
			   {
			   	 //echo "<br>-ooo--".$overall_array[$i]."-ooo--".$value1['school_code'];
				 //echo "<br>";
			   		if($value1['school_code']	==	$overall_array[$i])
			   			 $overall_flag	=	1;
			   }
			   
			   if($overall_flag	==	1)
					continue;
			 $count++; 
             ?>
             <td width="11%" height="23" align="center" bgcolor="#B4B4B4" class="style4"><?php echo $count; ?></td>
             <td width="74%" height="23" align="left" bgcolor="#E5E5E5" class="style4">&nbsp;&nbsp;&nbsp;<?php echo wordwrap($value1['school_code'].'&nbsp;&nbsp;&nbsp;'.$value1['school_name'],80,'<br>'); ?></td>
             <td width="15%" height="23" align="center" bgcolor="#B4B4B4" class="style4"><a href="javascript:return clickpointdetails('<?php echo $fest_id; ?>','<?php echo $value1['school_code']; ?>')" onClick="javascript:return clickpointdetails('<?php echo $fest_id; ?>','<?php echo $fairId; ?>','<?php echo $value1['school_code']; ?>')" ><?php echo $value1['spoint']; ?></a></td>
  </tr>
  		<?php } ?>
		</table>
	 <? } //if(count($runnerup_details)>0)

    } //if(count($overall_details)>0)
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