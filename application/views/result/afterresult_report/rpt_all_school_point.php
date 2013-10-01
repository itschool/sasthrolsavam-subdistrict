 	
    
    <style type="text/css">
<!--
.style1 {
	font-size: 14px;
	font-weight: bold;
	color: #660033;
}
.style2 {
	font-size:12px;
	font-weight:bold;
	color:#000000;
}
.style3 {
	font-size:11px;
	font-weight:bold;
	color:#000000;
}
.style4 {
	font-size:12px;
	color:#000000;
}
-->
</style>
	<?php
	  
	  $previd="";$j=0;
	  
  	foreach($retvalue AS $data)
    {
		if($previd!=$data['fest_id']){
				
				$previd_temp=$previd;
				$previd=$data['fest_id'];
				$count=0;
				
				if($j!=0){
			   $ct=0;
			   for($j=0;$j<count($itemcomp);$j++)
			   {
			   		if($itemcomp[$j]['fest_id']==$previd_temp)
					{
					$ct++;
			   ?>
          <!-- 	<tr><td style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'><?php //echo $ct; ?> </td><td style='border: 0 0 0.5px 0.5px 0 #000000;  height:20px;'><?php //echo $itemcomp[$j]['item_name']; ?></td></tr>-->
                <?php
					}
				}
					print("</table></page>");
					}
  ?>

<page backtop="20mm" backbottom="20mm">
		<page_header>
    	<?php
			  $this->load->view('report/report_header');
		 ?>
	    </page_header>
         <page_footer>
	     <?php
		      $this->load->view('report/report_footer');
			  
	     ?>
    </page_footer>   
<table width="94%" height="62" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td align="center" height="30" valign="top"><strong class="style1"><?php echo $fair_name;?><br />Grade-Point Report of all schools </strong></td>
  </tr>
</table>
<table width="96%" border="1" align="center" cellpadding="0" cellspacing="0">
		<?php
		$pre='';
        for($i=0;$i<count($completed);$i++)
        {
         if ($completed[$i]['fest_id']==$previd)
           {
              for($k=0;$k<count($totalitems);$k++)
                { 
                   if ($totalitems[$k]['fest_id']==$previd)
                     {
					  if($pre!=$data['fest_id'])
	                       {
	                         $pre=$data['fest_id'];
                   
        ?>
<tr>

    <td colspan=9 align="center" class="style2" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'><?php echo $data['fest_name']; ?></td>
  </tr>
    <tr>
     <td colspan=9 align="center" class="style2" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'   >Result Declared <?php echo $completed[$i]['cn'] ."/" . $totalitems[$k]['c']; ?> Items</td>
    </tr>
  <tr>
    <td class="style3" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'width="22" rowspan="2" align="center" >Sl No</td>
    <td class="style3" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'width="404" rowspan="2" align="left" >&nbsp;&nbsp;School</td>
    <td class="style3" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'colspan="3" align="center" >Place</td>
     <td class="style3" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'colspan="3" align="center" >Grade</td>
    <!--<td class="style3" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'width="50" rowspan="2" align="center">
	<?php //if($fair_name=='Work Experience Fair' )echo 'Total Mark';else echo 'Point';
	//overall_result
	?></td>-->
    
    <td class="style3" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'width="106" rowspan="2" align="center">
	Overall <?php if($fair_name=='Work Experience Fair' )echo 'Mark';else echo 'Point';?> </td>
  </tr>
  <tr>
    <td class="style3" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'width="24" align="center" >I</td>
    <td class="style3" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'width="30" align="center" >II</td>
    <td class="style3" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'width="31" align="center" >III</td>
    <td class="style3" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'width="27" align="center" >A</td>
    <td class="style3" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'width="34" align="center">B</td>
    <td class="style3" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'width="15" align="center" >C</td>
  </tr>
  
 
  
    <?php
	}
	}
	}
	}
	}
	}
	
	$count++;
	$j++;
	?>
  <tr>
    <td  class="style4" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'align="center" ><?php echo $count; ?></td>
    <td class="style4" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'align="left" >&nbsp;&nbsp;<?php echo $data['school_code'].' - '.$data['school_name'];  ?></td>    	
    	<?php
		
		$agrade		=	0;
		$bgrade		=	0;
		$cgrade		=	0;
		
		$first		=	0;
		$second		=	0;
		$third		=	0;
		
		for($h=0;$h<count($grade);$h++){
			if(($grade[$h]['school_code']==$data['school_code'])&&($grade[$h]['fest_id']==$data['fest_id'])){
				
					if($grade[$h]['grade'] == 'A')
					{ 	$agrade=$agrade+1;
					}
					if($grade[$h]['grade'] == 'B')
					{ 	$bgrade=$bgrade+1;
					}
					if($grade[$h]['grade'] == 'C')
					{ 	$cgrade=$cgrade+1;
					}
					
					
					if($grade[$h]['rank'] > 0){
						if($grade[$h]['rank'] == 1)
						{ 	$first=$first+1;
						}
						if($grade[$h]['rank'] == 2)
						{ 	$second=$second+1;
						}
						if($grade[$h]['rank'] == 3)
						{ 	$third=$third+1;
						}
					}
					//var_dump($grade[$h]['rnk']);
				}
			}
			
			$cnt = $data['cnt'];
			if($fair_name=='Work Experience Fair' )
			{
				for($n=0;$n<count($exhibition_values);$n++){
					if(($exhibition_values[$n]['school_code']==$data['school_code'])&&($exhibition_values[$n]['fest_id']==$data['fest_id'])){
					$cnt = $data['cnt'] + $exhibition_values[$n]['cnt'];
					}
				}
			}
						
		?>
    <td class="style4" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;' align="center" ><?php echo $first; ?></td>
    	<td class="style4" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;' align="center" ><?php echo $second; ?></td>
    	<td class="style4" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;' align="center" ><?php echo $third; ?></td>
   <td class="style4" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;' align="center" ><?php echo $agrade; ?></td>
   <td class="style4" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;' align="center" ><?php echo $bgrade; ?></td>
   <td class="style4" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;' align="center" ><?php echo $cgrade; ?></td>
   <td class="style4" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;' align="center" ><?php echo $cnt; ?></td>
   <!--<td class="style4" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'align="center" ><?php //echo $cnt_overall; ?></td>-->
  </tr>
  <?php
  		$agrade=0;
		$bgrade=0;
		$cgrade=0;
   }
  
   
  ?>
</table>
<?
if(@$exhibition_values != NULL)
{
?>
<br />
<table width="94%" height="62" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td align="center" height="30" valign="top"><strong class="style1"><br />Exhibition</strong></td>
  </tr>
</table>
<table width="96%" border="1" align="center" cellpadding="0" cellspacing="0">
<tr>
    <td class="style3" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'width="21" rowspan="2" align="center" >Sl No</td>
    <td class="style3" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'width="315" rowspan="2" align="left" >&nbsp;&nbsp;School</td>
      
    <td class="style3" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'colspan="3" align="center" >Place</td>
     
    <td class="style3" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'width="139" rowspan="2" align="center">
	Overall <?php if($fair_name=='Work Experience Fair' )echo 'Mark';else echo 'Point';?> </td>
  </tr>
  <tr>
  <td class="style3" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'width="17" align="center" >I</td>
    <td class="style3" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'width="21" align="center" >II</td>
    <td class="style3" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'width="21" align="center" >III</td>
    </tr>
<?php
$exb = 0;
$exb_slno = 1;
if($fair_name=='Work Experience Fair' )
{
	foreach($exhibition_values as $exbition)
	{
		//$cnt = $data['cnt'] + $exhibition_values[$n]['cnt'];
		$exb = $exbition['cnt'];
		$first		=	0;
		$second		=	0;
		$third		=	0;
		//////////////Rank //////////////////
		if($exbition['rank'] > 0){
		switch($exbition['rank'])
		{
			case '1':
			$first		=	1;
			break;
			
			case '2':
			$second		=	1;						
			break;
			
			case '3':
			$third		=	1;
			break;
			
			default:
			$first		=	0;
			$second		=	0;
			$third		=	0;
			break;
		
		}
		}
	///////////////////////////////////
	?>
    <tr>
   <td  class="style4" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'align="center" ><?php echo $exb_slno; ?></td>
    <td class="style4" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'align="left" >&nbsp;&nbsp;<?php echo @$exbition['school_name']; ?></td>
   
  <td class="style4" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'align="center" ><?php echo $first; ?></td>
    	<td class="style4" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'align="center" ><?php echo $second; ?></td>
    	<td class="style4" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'align="center" ><?php echo $third; ?></td>
   
   <td class="style4" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'align="center" ><?php echo $exb; ?></td>
   <!--<td class="style4" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'align="center" ><?php //echo $cnt_overall; ?></td>-->
  </tr>
    <?php
	$exb_slno++;
	}//foreach
}			
?>
</table>

<?php
}//if exhibiton
?>
</page>
