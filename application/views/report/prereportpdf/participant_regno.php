<style type="text/css">
<!--
.style1 {
	font-size: 25px;
	font-weight: bold;
	color: #660033;
}
.style56 {
	font-size: 17px;
	font-weight: bold;
	color: #660033;
}
.style2 {
	font-size: 15px;
	font-weight: bold;
	color: black;
}
.style55 {

font-size: 12px;
	color: black;
}
.style57 {font-size: 14}
.style58 {font-size: 14px; font-weight: bold; color: #660033; }
-->
</style>

<?php

if ($this->session->userdata('SUB_DISTRICT'))
	{
		/*$sub_dist_name		=	get_sub_dist_name($this->session->userdata('SUB_DISTRICT'));
		$label				=	$sub_dist_name;*/
		$title		=	wordwrap('Sub District '.get_sub_dist_name($this->session->userdata('SUB_DISTRICT')),40,'<br/>');
	}
	else if ($this->session->userdata('DISTRICT'))
	{
		$title			=	wordwrap(get_dist_name($this->session->userdata('DISTRICT')).'  District',40,'<br/>');
	}
	$fest_master_details	=	$this->General_Model->get_fest_master_details();
	if (count($fest_master_details) > 0)
	{
		//$title		=	(@$fest_master_details[0]['sub_dist_kalolsavam_name']) ? @$fest_master_details[0]['sub_dist_kalolsavam_name'] : '';
		//$title		=	wordwrap(get_sub_dist_name($this->session->userdata('SUB_DISTRICT')).' Sub District',40,'<br/>');
		$venue		=	wordwrap(@$fest_master_details[0]['venue'],40,'<br/>');
		$logo		=	@$fest_master_details[0]['logo_name'];
		$file_path	=	'';
		if (file_exists($this->config->item('base_path').'uploads/subdistrict/'.$logo) and trim($logo) != '')
		{
			$file_path		=	base_url(false).'uploads/subdistrict/'.$logo;
		}
		else{
			$file_path="";
		}
	}
	?>

<page backtop="5mm" backbottom="0mm ">
 <table width="1314" border="0" align="left">
 <tr>
 <?php if (is_array($partcard) and count($partcard) > 0){?>
 <td width="396" height="237" valign="top"> 
 <table align="left"  border="1" >
    <tr valign="top">
    	<td rowspan="2">
    		<?php if(@$file_path!=""){ ?><img src="<?php echo @$file_path?>" height="40"><?php }
	   		else { ?>&nbsp;<?php } ?>        </td>    
       	<td width="306" align="left" class="style56 style57">Kerala School <?php if($fairId == 4){echo '<br>';} echo $partcard[0]['fairName'];?> 2013-14</td>
    </tr>
    <tr>
  		 <td align="left" class="style2"><?php echo @$title.'<br>Venue&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  '.@$venue; ?><br></td>
     </tr>
     <tr bgcolor="#CCCCCC">
      	 <td bgcolor="#E5E5E5" colspan="2" align="center" class="style2" style="border-bottom:1px #000000;border-top:1px #000000; border-right:0px #000000; padding:2px;">Participant's Card</td>
      </tr>
      <?php 
	 
	  ?>
		<tr>
			<td align="center">Reg. No</td>
            
            <td rowspan="2" style="border-bottom:1px #000000; border-left:1px #000000; padding:0px;"><span class="style2">&nbsp;<?php echo wordwrap($partcard[0]['participant_name'],25,'<br/>'); ?></span><br>
				&nbsp;<?php echo $partcard[0]['school_code'].'  '.$partcard[0]['school_name']; ?><br>
				&nbsp;<?php if($partcard[0]['is_teach']!='Y'){echo 'Class  :'.$partcard[0]['class'].'&nbsp;&nbsp;&nbsp;&nbsp;Gender&nbsp;:&nbsp;'.$partcard[0]['gender'];}else{if($partcard[0]['gender']=='B'){echo 'Gender&nbsp;;&nbsp;M';} else{ echo 'Gender&nbsp;;&nbsp;F';}} ?></td>
   		</tr>
		<tr>
    		<td  width="74"class="style1" valign="top" style="border-bottom:1px #000000; border-right:0px #000000; padding:2px;" align="center"><?php echo $partcard[0]['participant_id']; ?></td>
		</tr>
        
            <?php 
			
			$count=1; $cnt=count($partcard);
			for($j=0;$j<count($partcard);$j++){
			$dat_itme=datetophpmodel($partcard[$j]['datee']);
			if($cnt!=($j+1)){
			
			?>
	
	   <tr><td height="34" colspan="2"><table><tr>
       			<td width="207" height="23" align="left"  class="style55" style="border-bottom:1px #000000; border-right:0px #000000; padding:2px;">&nbsp;<?php echo $partcard[$j]['item_code'].'&nbsp;&nbsp;&nbsp;'.$partcard[$j]['item_name']; ?></td>
           		<td width="158" align="right"  class="style55" style="border-bottom:1px #000000; border-right:0px #000000; padding:2px;"><?php echo $partcard[$j]['ground_name'].'&nbsp; :  on  '.$dat_itme;?>&nbsp;&nbsp;&nbsp;</td>
   	 	</tr></table></td></tr>
  			<?php
			}
			else{
			?>
        <tr><td height="30" colspan="2"><table><tr>
          <td width="208" align="left"  class="style55" >&nbsp;<?php echo ($partcard[$j]['exhibition']==2)?'Exhibition':($partcard[$j]['item_code'].'&nbsp;&nbsp;&nbsp;'.$partcard[$j]['item_name']); ?>2</td>
        	<td width="153" align="right"  class="style55" ><?php echo $partcard[$j]['ground_name'].'&nbsp; : on '.$dat_itme;?>&nbsp;&nbsp;&nbsp;</td>
      </tr></table></td></tr>
			
			
			<?php
			}
			$count++;
			}
			?>
      </table>
</td>
<?php } if (is_array($partcard1) and count($partcard1) > 0){?>
<td width="9">&nbsp;</td>
<td width="459"  valign="top">
	<table align="left" width="459" border="1" >
 
    <tr valign="top">
    <td rowspan="2"><?php if(@$file_path!=""){ ?><img src="<?php echo @$file_path?>" height="40"><?php } 
	else { ?>&nbsp;<?php } ?>    </td>         
    <td width="369" align="left" class="style58">Kerala School <?php if($fairId == 4){echo '<br>';} echo $partcard1[0]['fairName'];?> 2013-14</td>
    </tr>
    <tr>
  		 <td align="left" class="style2"><?php echo $title.'<br>Venue&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  '.@$venue; ?><br></td>
     </tr>
    
  
      <tr bgcolor="#CCCCCC">
      
       		 <td bgcolor="#E5E5E5" colspan="2" align="center" class="style2" style="border-bottom:1px #000000;border-top:1px #000000; border-right:0px #000000; padding:2px;">Participant's Card</td>
      </tr>
		<tr>
			<td align="center">Reg. No</td>
            
            <td rowspan="2" style="border-bottom:1px #000000; border-left:1px #000000; padding:0px;"><span class="style2">&nbsp;<?php echo wordwrap($partcard1[0]['participant_name'],25,'<br/>'); ?></span><br>
				&nbsp;<?php echo $partcard1[0]['school_code'].'  '.$partcard1[0]['school_name']; ?><br>
				&nbsp;<?php if($partcard1[0]['is_teach']!='Y'){echo 'Class  :'.$partcard1[0]['class'].'&nbsp;&nbsp;&nbsp;&nbsp;Gender&nbsp;:&nbsp;'.$partcard1[0]['gender'];}else{if($partcard1[0]['gender']=='B'){echo 'Gender&nbsp;;&nbsp;M';} else{ echo 'Gender&nbsp;;&nbsp;F';}} ?></td>
   </tr>
		<tr>
    		<td  width="74"class="style1" valign="top" style="border-bottom:1px #000000; border-right:0px #000000; padding:2px;" align="center"><?php echo $partcard1[0]['participant_id']; ?></td>
		</tr>
        
            <?php 
			
			$count=1; $cnt=count($partcard1);
			for($j=0;$j<count($partcard1);$j++){
			$dat_itme=datetophpmodel($partcard1[$j]['datee']);
			if($cnt!=($j+1)){
			
			?>
	
	   <tr><td colspan="2"><table><tr>
       			<td width="188" align="left"  class="style55" style="border-bottom:1px #000000; border-right:0px #000000; padding:2px;">&nbsp;<?php echo $partcard1[$j]['item_code'].'&nbsp;&nbsp;&nbsp;'.$partcard1[$j]['item_name']; ?></td>
           		<td width="240" align="right"  class="style55" style="border-bottom:1px #000000; border-right:0px #000000; padding:2px;"><?php echo $partcard1[$j]['ground_name'].'&nbsp; :  on  '.$dat_itme;?>&nbsp;&nbsp;&nbsp;</td>
   	 	</tr></table></td></tr>
  			<?php
			}
			else{
			?>
        <tr><td colspan="2"><table><tr>
          <td width="190" align="left"  class="style55" >&nbsp;<?php echo ($partcard1[$j]['exhibition']==2)?'Exhibition':$partcard1[$j]['item_code'].'&nbsp;&nbsp;&nbsp;'.$partcard1[$j]['item_name']; ?></td>
        	<td width="237" align="right"  class="style55" ><?php echo $partcard1[$j]['ground_name'].'&nbsp; : on '.$dat_itme;?>&nbsp;&nbsp;&nbsp;</td>
      </tr></table></td></tr>
			
			
			<?php
			}
			$count++;
			}
			?>
      </table>

</td>
<?php }?>
<?php if (is_array($partcard2) and count($partcard2) > 0){
//$prevfairid2=0;
?>
<td width="17">&nbsp;</td>
<td width="411" valign="top">
<?php foreach($partcard2 as $row2){
/*if($prevfairid2	!=$row2['fairId']){
$prevfairid2	=	$row2['fairId'];*/
?>
	<table height="217" border="1" align="left" >
 
    <tr valign="top">
    <td rowspan="2"><?php if($file_path!=""){ ?><img src="<?php echo $file_path?>" height="40"><?php }
	else { ?>&nbsp;<?php } ?>
     </td>       
   		  <td width="300" align="left" class="style56">Kerala School <?php if($fairId == 4){echo '<br>';} echo $row2['fairName'];?> 2013-14</td>
    </tr>
    <tr>
  		<td align="left" class="style2"><?php echo $title.'<br>Venue&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  '.$venue; ?><br></td>
     </tr>
      <tr bgcolor="#CCCCCC">
       		 <td bgcolor="#E5E5E5" colspan="2" align="center" class="style2" style="border-bottom:1px #000000;border-top:1px #000000; border-right:0px #000000; padding:2px;">Participant's Card</td>
      </tr>
		<tr>
			<td align="center">Reg. No</td>
            
            <td rowspan="2" style="border-bottom:1px #000000; border-left:1px #000000; padding:0px;"><span class="style2">&nbsp;<?php echo wordwrap($partcard2[0]['participant_name'],25,'<br/>'); ?></span><br>
				&nbsp;<?php echo $row2['school_code'].'  '.$row2['school_name']; ?><br>
				&nbsp;<?php if($row2['is_teach']!='Y'){echo 'Class  :'.$row2['class'].'&nbsp;&nbsp;&nbsp;&nbsp;Gender&nbsp;:&nbsp;'.$row2['gender'];}else{if($row2['gender']=='B'){echo 'Gender&nbsp;;&nbsp;M';} else{ echo 'Gender&nbsp;;&nbsp;F';}} ?></td>
   </tr>
		<tr>
    		<td  width="74"class="style1" valign="top" style="border-bottom:1px #000000; border-right:0px #000000; padding:2px;" align="center"><?php echo $row2['participant_id']; ?></td>
		</tr>
        
            <?php 
			
			$count=1; $cnt=count($partcard2);$prevfairid2item=$partcard2[0]['fairId'];
			for($j=0;$j<count($partcard2);$j++){
			$dat_itme=datetophpmodel($partcard2[$j]['datee']);
			if($cnt!=($j+1)){
			
			?>
	
	   <tr><td colspan="2"><table><tr>
       			<td width="186" align="left"  class="style55" style="border-bottom:1px #000000; border-right:0px #000000; padding:2px;">&nbsp;<?php echo $partcard2[$j]['item_code'].'&nbsp;&nbsp;&nbsp;'.$partcard2[$j]['item_name']; ?></td>
           		<td width="146" align="right"  class="style55" style="border-bottom:1px #000000; border-right:0px #000000; padding:2px;"><?php echo $partcard2[$j]['ground_name'].'&nbsp; :  on  '.$dat_itme;?>&nbsp;&nbsp;&nbsp;</td>
   	 	</tr></table></td></tr>
  			<?php
			}
			else{
			?>
        <tr><td colspan="2"><table><tr>
          <td width="187" align="left"  class="style55" >&nbsp;<?php echo ($partcard2[$j]['exhibition']==2)?'Exhibition':$partcard2[$j]['item_code'].'&nbsp;&nbsp;&nbsp;'.$partcard2[$j]['item_name']; ?></td>
        	<td width="144" align="right"  class="style55" ><?php echo $partcard2[$j]['ground_name'].'&nbsp; : on '.$dat_itme;?>&nbsp;&nbsp;&nbsp;</td>
      </tr></table></td></tr>
			
			
			<?php
			}
			$count++;
			}
			?>
      </table>
<?php //}//if($prevfairid2	!=$row2['fairId'])
}//foreach($partcard2 as $row2)?>
</td>
<?php }?>
</tr>
</table>

</page>
      
        
       
       
