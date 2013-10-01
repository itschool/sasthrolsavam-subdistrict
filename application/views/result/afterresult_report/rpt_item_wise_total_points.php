<style type="text/css">
<!--
.style1 {
	font-size: 14px;
	font-weight: bold;
	color: #660033;
}
.style2{
	font-size: 12px;
	font-weight: bold;
	color:#000000;
}
.style3{ 
	font-size: 11px;
	font-weight: bold;
	color:#000000;
}
.style4{
	font-size: 11px;
	color:#000000;
}
.tb{
font-size: 11px;
	font-weight: bold;
	color:#000000;}
	
.ety{
	font-size: 12px;
	color:#000000;
	}


-->
</style>


<?php
	  $count=0;
	  $previous="";
	  $pre="";
	  $j=0;
if(@$exhibition_vals == 0)
{	
  foreach($retvalue AS $data)
  {
  		if($previous!=$data['item_code'])
 		 {
			 $previous=$data['item_code'];
  			 $count=0;
			if($j!=0){
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
<table width="100%" height="62" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td  align="center"  class="style1">Item Wise All Results</td>
  </tr>
  <tr>
    <td  align="center" ><b>  Festival : <?php echo $data['fest_name'];?>&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $data['item_code'];?> ( <?php echo $data['item_name'];?>)</b></td>
  </tr>
</table>

<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
   
  <tr>
    <td width="43" align="center" class="style2" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'>Sl No</td>
    <td width="250" align="left" class="style2" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'>&nbsp;Name </td>
    <td width="250" align="left" class="style2" style='border: 0 0 0.5px 0.5px 0 #666666;  height:25px;'>&nbsp;School </td>
    <td width="40" align="center" class="style2" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'>&nbsp;Rank</td>
    <td width="40" align="center" class="style2" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'>&nbsp;Grade</td>
      <td width="40" align="center" class="style2" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'>&nbsp;<?php if($data['fairId'] == 4){echo "Mark";}else{ echo "Point";} ?></td>
  </tr>
    <?php
	
	}
		     //$count=0;
			// $pre=$data['item_code'];
   	$count++;
	$j++;
	?>
     
  <tr>
    <td style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;' align="center"><?php echo $count; ?></td>
    <td style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'>&nbsp;<?php echo wordwrap($data['participant_name'],50,'<br>'); ?></td>
       <td style='border: 0 0 0.5px 0.5px 0 #666666;  height:25px;' class="style4">&nbsp;<?php echo wordwrap($data['school_code'].' - '.$data['school_name'].' ('.$data['sub_district_name'].')',50,'<br>'); ?></td>
       <td style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;' align="center"><?php echo $data['rank']; ?></td>
    <td style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;' align="center"><?php echo $data['grade']; ?></td>
     <td style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;' align="center"><?php 
	  if($data['fairId'] == 4){echo $data['total_mark'];
	  }
	  else{
	 echo $data['point'];} ?></td>
  </tr>
  <?php
  
  }
  


?>
</table></page>

<?php
}

/**************************Exhibition ***************/
if(@$exhibition_values != NULL)
{
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
<table width="100%" height="62" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td  align="center"  class="style1">Item Wise All Results</td>
  </tr>
 
</table>
<br />
<table width="94%" height="62" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td align="center" height="30" valign="top"><strong class="style1"><br />Exhibition</strong></td>
  </tr>
</table>
<table width="96%" border="1" align="center" cellpadding="0" cellspacing="0">
<tr>
    <td class="style3" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'width="21" rowspan="2" align="center" >Sl No</td>
    <td class="style3" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'width="315" rowspan="2" align="left" >&nbsp;&nbsp;Schools</td>
      
    <td class="style3" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'colspan="3" align="center" >Place</td>
     
    <td class="style3" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'width="139" rowspan="2" align="center">
	Overall Mark </td>
  </tr>
  <tr>
  <td class="style3" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'width="17" align="center" >I</td>
    <td class="style3" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'width="21" align="center" >II</td>
    <td class="style3" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'width="21" align="center" >III</td>
    </tr>
<?php
$exb = 0;
$exb_slno = 1;
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
    <td class="style4" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'align="left" >&nbsp;&nbsp;<?php echo @$exbition['schcode']." - ".@$exbition['schname']; ?></td>
   
  <td class="style4" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'align="center" ><?php echo $first; ?></td>
    	<td class="style4" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'align="center" ><?php echo $second; ?></td>
    	<td class="style4" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'align="center" ><?php echo $third; ?></td>
   
   <td class="style4" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'align="center" ><?php echo $exb; ?></td>
   <!--<td class="style4" style='border: 0 0 0.5px 0.5px 0 #666666;  height:20px;'align="center" ><?php //echo $cnt_overall; ?></td>-->
  </tr>
    <?php
	$exb_slno++;
	}//foreach
?>
</table>
</page>
<?php
}//if exhibiton
?>



