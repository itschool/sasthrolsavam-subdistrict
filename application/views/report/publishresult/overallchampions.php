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
	//var_dump($fairname);
	if(count($overall_details)>0){
	$i=0;
	
	?>
  <table width="80%" align="center" border="1" style=" border-top:1px black; border-left:1px black; border-right:1px black;" cellpadding="0" cellspacing="0">
    <tr bgcolor="#000000">
        	<td colspan="8" align="center" height="5" class="style2"></td></tr>

	<tr bgcolor="#B689B1">
        	<td colspan="8" align="center" height="30" class="style2"><?php echo @$fairname[0]['fairName']; if(@$fairname[0]['fairName']=='Work Experience Fair'){ if(@$wrk=='exb'){ echo ' (Exhibition) ';} else if(@$wrk=='all'){ echo ' ';} else{ echo ' (On the Spot) ';}} 
			//if($value['fairName']=='Work Experience Fair'){ if($value['fest_name']=='Exhibition'){ echo ' (Exhibition) ';} else{ echo ' (On the Spot) ';}} if($value['fest_name']!='Exhibition'){?> 
            &nbsp;&nbsp;<br>
           Overall Champion
			<?php //}?></td>
	</tr>
     <tr>    		
         
       <td align="center" height="25" width="234" class="style8"> School Name</td>
       <? if(@$wrk != 'exb'){ ?>
       <td align="center" height="25" width="85" class="style8">LP</td>
       <td align="center" height="25" width="85" class="style8">UP</td>
       <td align="center" height="25" width="97" class="style8">HS</td>
       <td align="center" height="25" width="71" class="style8">HSS/VHSS</td>
       <? } 
	   if(@$wrk == 'all'){ ?>
       <td align="center" height="25" width="85" class="style8">Exhibition</td>      
       <? } ?>
       <td align="center" height="25" width="83" class="style8"><? if(@$fairId != 4) echo "Point"; else echo "Marks"; ?></td>
    </tr>
        <?php
		$prev_itemcode="";
		$prev_mark	= '';
		$prev_festid="";
		 $overall_school = '';
		 $prev_totmark	=	'';
		//echo '<br><br><br>';
		//print_r($details);
		foreach($overall_details as $value){
			 $i++;
			//$value['tot_mark']=830;
			//var_dump($value);
			 //echo "<br><br>...".@$value['fairId'];
			 if(@$fairId != 4){
			 	$if	=	($value['point'] == $prev_mark || $prev_mark =='');}
			 else{
			 	$if	=	($value['point'] == $prev_mark || $prev_mark =='') ;}
			
			
		  	 if($if) {	
		?>		
		
 	<!-- <tr bgcolor="#CAE4FF" >
   		 <td  colspan="8" align="left" height="25">&nbsp;&nbsp;<b><?php echo $value['item_code'].'&nbsp;- &nbsp;'.@$value['item_name']; ?></b></td>
 	 </tr>-->
    
 		 <?php 
		// echo "<br><br>i--->".$i;
		   
		 	$school_code		=	$value['school_code'];
			$fair_id			=	@$fairId;
		    if(@$wrk != 'exb' && @$wrk != 'all'){			
			
				$lp_count		=	$this->resultindex_model->schoolpoints(1,$fair_id,0,$school_code);
				$up_count		=	$this->resultindex_model->schoolpoints(2,$fair_id,0,$school_code);
				$hs_count		=	$this->resultindex_model->schoolpoints(3,$fair_id,0,$school_code);
				$hss_count		=	$this->resultindex_model->schoolpoints(4,$fair_id,0,$school_code);
			}
			if(@$wrk == 'all'){
			    
			    $lp_count	     = 	$this->resultindex_model->schoolpoints_work_aggr(1,$fair_id,0,$school_code);	
				$up_count	     = 	$this->resultindex_model->schoolpoints_work_aggr(2,$fair_id,0,$school_code);	
				$hs_count		=	$this->resultindex_model->schoolpoints_work_aggr(3,$fair_id,0,$school_code);
				$hss_count		=	$this->resultindex_model->schoolpoints_work_aggr(4,$fair_id,0,$school_code);
				$total_count	=	@$lp_count[0]['spoint'] + @$up_count[0]['spoint'] + @$hs_count[0]['spoint'] + @$hss_count[0]['spoint'];
				$point			=	$value['point'];
				$exb_count		=	$point - $total_count; 
				//var_dump($exb_count);
				
			
			}
			
		 
		  ?>
          
 	 <tr bgcolor="#F2F2F2">
               
             <td height="25" class="stylelp" >&nbsp;<?php 
			 $overall_school	=	$overall_school.",".$value['school_code'];
			 //$overall_dist	=	$value['sub_district_code'];
			 echo $value['school_code']." - "; 
			 echo wordwrap($value['school_name'],35,'<br>'); ?></td>
              <? if(@$wrk != 'exb'){ ?>
              <td height="25" class="stylelp" align="center">&nbsp;<?php echo @$lp_count[0]['spoint']; ?></td>
             <td height="25" class="stylelp" align="center">&nbsp;<?php echo @$up_count[0]['spoint']; ?></td>
             <td height="25" class="stylelp" align="center">&nbsp;<?php echo @$hs_count[0]['spoint']; ?></td>
             <td height="25" class="stylelp" align="center">&nbsp;<?php echo @$hss_count[0]['spoint']; ?></td> 
             <? } 
			 if(@$wrk == 'all'){ ?>
              <td height="25" class="stylelp" align="center">&nbsp;<?php echo @$exb_count; ?></td> 
             <? } ?>
             
             <td height="25" class="stylelp" align="center"><?php echo $value['point']; ?></td>
  	</tr>
  		<?php
		 // echo "<br><br>---".@$fairId;
			 if(@$fairId != 4){
				$prev_totmark	=	$value['tot_mark']; }
				
			$prev_mark		=	$value['point'];
		 }
		
		 
		
		
		
	}// foreach ?>
  
    </table><br>
<br>

     <?php 
	 //var_dump(@$runnerup_details);
	 if(count(@$runnerup_details)>0){
	$i=1;
	?>
  <table width="80%" align="center" border="1" style=" border-top:1px black; border-left:1px black; border-right:1px black;" cellpadding="0" cellspacing="0">
   <tr bgcolor="#000000">
        	<td colspan="8" align="center" height="5" class="style2"></td></tr>

	<tr bgcolor="#B689B1">
        	<td colspan="8" align="center" height="30" class="style2"><?php echo $fairname[0]['fairName'];  if(@$value['fairName']=='Work Experience Fair'){ if(@$wrk=='exb'){ echo ' (Exhibition) ';} else if(@$wrk=='all'){ echo ' ';} else{ echo ' (On the Spot) ';}} 
			?> 
            &nbsp;&nbsp;<br>
            Runnersup
			<?php ?></td>
	</tr>
    <tr> 
       		
         
      <td align="center" height="25" width="233" class="style8">School Name</td>
       <? if(@$wrk != 'exb'){ ?>
       <td align="center" height="25" width="87" class="style8">LP</td>
      <td align="center" height="25" width="87" class="style8">UP</td>
      <td align="center" height="25" width="98" class="style8">HS</td>
      <td align="center" height="25" width="71" class="style8">HSS/VHSS</td>
      <? } 
	   if(@$wrk == 'all'){ ?>
       <td align="center" height="25" width="85" class="style8">Exhibition</td>      
       <? } ?>
      <td align="center" height="25" width="81" class="style8"><? if(@$value['fairId'] != 4) echo "Point"; else echo "Marks"; ?></td>
    </tr>
        <?php
		$prev_itemcode="";
		$prev_festid="";
		//echo '<br><br><br>';
		//print_r($details);
		foreach($runnerup_details as $value1){
		
		$overall_flag	=	0;
			   //echo "<br>---".($overall_school);
	   $overall_array	= explode(',', $overall_school);
	  
	   for($i=1;$i<count($overall_array);$i++)
	   {	//echo '-------->'.$overall_array[$i];	 
			if($value1['school_code']	==	$overall_array[$i])
				 $overall_flag	=	1;
	   }
	   
	   if($overall_flag	==	1)
			continue;
					
	   if($value1['point'] > 0) {			
		?>	
		
 	<!-- <tr bgcolor="#CAE4FF" >
   		 <td  colspan="8" align="left" height="25">&nbsp;&nbsp;<b><?php echo $value1['item_code'].'&nbsp;- &nbsp;'.@$value1['item_name']; ?></b></td>
 	 </tr>-->
    
 		 <?php 
		// echo "<br><br>i--->".$i;
			/*$up_count2	=	0;
			$hs_count2	=	0;
			$hss_count2	=	0;*/
		
			$school_code2	=	$value1['school_code'];
			$fair_id2		=	@$value1['fairId'];
			//echo "<br>--".$dist_code2;
			
		     if(@$wrk != 'exb' && @$wrk != 'all'){		
			$lp_count2		=	$this->resultindex_model->schoolpoints(1,$fair_id2,0,$school_code2);	
			$up_count2		=	$this->resultindex_model->schoolpoints(2,$fair_id2,0,$school_code2);
			$hs_count2		=	$this->resultindex_model->schoolpoints(3,$fair_id2,0,$school_code2);
			$hss_count2		=	$this->resultindex_model->schoolpoints(4,$fair_id2,0,$school_code2);
			}
			
			if(@$wrk == 'all'){
				$lp_count2	    = 	$this->resultindex_model->schoolpoints_work_aggr(1,$fair_id2,0,$school_code2);
			    $up_count2	    = 	$this->resultindex_model->schoolpoints_work_aggr(2,$fair_id2,0,$school_code2);	
				$hs_count2		=	$this->resultindex_model->schoolpoints_work_aggr(3,$fair_id2,0,$school_code2);
				$hss_count2		=	$this->resultindex_model->schoolpoints_work_aggr(4,$fair_id2,0,$school_code2);
				$total_count	=	@$lp_count2[0]['spoint'] + @$up_count2[0]['spoint'] + @$hs_count2[0]['spoint'] + @$hss_count2[0]['spoint'];
				
				$point			=	$value1['point'];
				$exb_count		=	$point - $total_count; 
				//echo "<br><br>".$dist_code2."---".$point."----".$total_count;
				//echo "<br><br>".$up_count[0]['point']."----t".@$hs_count[0]['point']."-----t".@$hss_count[0]['point']."----t".$exb_count;
			
			}
			
			//var_dump($up_count2);
		 
		  ?>
 	 <tr bgcolor="#F2F2F2">
     
          
             <td height="25" class="stylelp" >&nbsp;<?php echo $value1['school_code']." - "; 
			 echo wordwrap($value1['school_name'],35,'<br>'); ?></td>
              <? if(@$wrk != 'exb'){ ?>
              <td height="25" class="stylelp" align="center">&nbsp;<?php echo @$lp_count2[0]['spoint']; ?></td>
              <td height="25" class="stylelp" align="center">&nbsp;<?php echo @$up_count2[0]['spoint']; ?></td>
             <td height="25" class="stylelp" align="center">&nbsp;<?php echo @$hs_count2[0]['spoint']; ?></td>
             <td height="25" class="stylelp" align="center">&nbsp;<?php echo @$hss_count2[0]['spoint']; ?></td> 
             <? } 
			 
			  if(@$wrk == 'all'){ ?>
              <td height="25" class="stylelp" align="center">&nbsp;<?php echo @$exb_count; ?></td> 
             <? } ?>
             <td height="25" class="stylelp" align="center"><?php echo $value1['point']; ?></td>
  	</tr>
  		<?php
		 }
		
		
		$i++;
		
	}// foreach ?>
  
    </table>
     <?php  
	   } //if(count($runnerup_details)>0)
	 
	 } //outer if(count($overall_details)>0)
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
