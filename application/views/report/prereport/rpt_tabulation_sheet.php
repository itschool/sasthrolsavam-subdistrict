<style type="text/css">
<!--
.style1 {
	font-size: 18px;
	font-weight: bold;
	color: #660033;
}
.style4{
	font-size: 8px;
	font-weight: normal;
	color:#000000;
	border-right:1px #666666;
	 height:25px;
	}
	.style3{
	font-size: 11px;
	font-weight: normal;
	color:#000000;
	
	}

	.style9{
	font-size: 12px;
	font-weight: bold;
	
	
}
.style10{
	font-size: 15px;
	font-weight: bold;
	
	
}
-->
</style>

<page backtop="35mm" backbottom="45mm">
		<page_header>
    	<?php
			$this->load->view('report/report_header');
		?>
<table width="100%" border="0"  cellspacing="0" cellpadding="0" align="center">
    <tr>
        <td align="center" class="style10" colspan="7">Tabulation Sheet<br />
          <?php echo @$fair_name; if(@$fair_name=='Work Experience Fair'){  echo "- ".@$fest;}?></td>
    </tr>
        <?php
		//var_dump($retdata1);
		$t='';
    if((@$fair_name!='Work Experience Fair') || (@$fair_name=='Work Experience Fair' && @$fest != "Exhibition"))
	{
		foreach($retdata as $data)
		{
		$time=$data['timer'];
		if($time=='')
		$t='';
		else
		{
		$t=date('d M Y',strtotime($time));
		}
	
    ?>
    <tr>
        <td width="50" height="32" class="style9">Item  : </td>
        <td width="300" height="32" class="style9"><?php echo $data['item_code']; ?>   -   <?php echo $data['item_name']; 
          foreach($retdata1 as $datum)
        {
        ?>
        <?php  echo ' ('.$datum['fest_name'].')'; ?>
        
        <?php 
        }
        ?>
         </td>
        
        <td width="60" height="32" class="style9">Date :</td>
        <td width="80" height="32" class="style9"><?php echo $t; ?></td>
    </tr>
        <?php
		 } //for
	}
	else
	{$time=$arrData[0]['start_time'];
	$t=date('d M Y',strtotime($time));
		?>
        
         <tr>
           <td width="60" height="32" class="style9">Festival : </td>
        <td width="300" height="32" class="style9" >
        <?php
        foreach($retdata1 as $datum)
        {
        ?>
        <?php  echo $datum['fest_name']; ?>
        
        <?php 
        }
        ?>
        </td>
        
        <td width="60" height="32" class="style9">Date :</td>
        <td width="80" height="32" class="style9"><?php echo $t; ?></td>
    </tr>
    <?php
	}
	?>

</table>

	  </page_header>
    <page_footer>
  <!--  <table width="100%" align="center">
        <tr>
        <td>Time of Declaration of Result _ _ _ _ _ _ _ _ _ _ </td>
        <td>&nbsp;</td>
        <td>Name and Signature of Stage Manager _ _ _ _ _ _ _ _ _ _ _ _</td>
      </tr>
       </table>-->
      
       <table width="100%" align="left">
      <tr>
            <td width="7%">&nbsp;</td>
            <td width="20%">Signature of Judge1</td>
            <td width="73%">&nbsp; _ _ _ _ _ _ _ _ _ _ _</td>
       </tr>
        <tr>
              <td width="7%">&nbsp;</td>
            <td >Signature of Judge2 </td>
            <td>&nbsp;_ _ _ _ _ _ _ _ _ _ _</td>
            </tr>
            <tr>
              <td width="7%">&nbsp;</td>
            <td>Signature of Judge3</td>
             <td>&nbsp; _ _ _ _ _ _ _ _ _ _ _</td>
      </tr>
    </table>
      <p>&nbsp;</p>
    <table width="100%" border="0" align="left" bordercolor="#D4D0C8">
        <tr>     
            <td  align="center" style="font-size:12px;">70% and above = 'A' Grade,&nbsp;&nbsp;60% to 69%    = 'B' Grade,&nbsp;&nbsp;50% to 59%    = 'C' Grade, &nbsp;&nbsp;Below 50%    =  No Grade </td>
        </tr>
    </table>
	<?php
		$this->load->view('report/report_footer');
	 ?> 
    </page_footer>       
  
       
        <table width="62%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#666666">
          <tr >
           <?php
			if($fair_name!='Work Experience Fair'){?>
            <td colspan="3" class="style4" style="border-bottom:1px #666666;"><div align="left"></div>              
            <div align="center"></div></td>
             <?php
			}
			else
			{
			?>
               <td colspan="2" class="style4" style="border-bottom:1px #666666;"><div align="left"></div>              
            <div align="center"></div></td>
             <?php
			}?>
            <td colspan="6" class="style4" align="center" style="border-bottom:1px #666666;"><strong>Score </strong></td>
            <td colspan="3" class="style4" style="border-bottom:1px #666666;"><div align="center">&nbsp;</div></td>
          </tr>
          <tr>
            <td width=35 height="25" class="style4" align="center"><strong>Sl.No</strong></td>
            <?php
			 if(($fair_name!='Work Experience Fair') || ($fair_name=='Work Experience Fair' && $fest != "Exhibition"))
	{?>
             <td width=50 class="style4"align="center"><strong>Reg No  </strong></td>
             <?php
			}
			?>
            <td width=50 class="style4"align="center"><strong>Code.No  </strong></td>
           
            <td width=35 class="style4"align="center">J1</td>
            <td width=35 class="style4"align="center">J2</td>
            <td width=35 class="style4"align="center">J3</td>
                   
            <td width=35 class="style4"align="center"><strong>Total</strong></td>
            <td width=35 class="style4"align="center"><strong>%</strong></td>
            <td width=40 class="style4"align="center"><strong>Grade</strong></td>
            <td width=125 class="style4"align="center"><strong> Remarks</strong></td>
          </tr>
          <?php 
  		$j=0;
		$s= 0;
		//var_dump($arrData);
		//echo "---".$num;
      for($i=1;$i<=$num+5;$i++)
       {
		   	if($i > $num)
			{$style = "border-top:1px #666666; border-right:1px #666666; padding:2px;";
			}
			else
			{
	   			if($arrData[$j]['is_captain']=='Y'){
					$s++;
					$style = "border-top:1px #666666; border-right:1px #666666; padding:2px;";
				 }
                else
					 $style = "border-right:1px #666666; padding:2px;";
			}
				
   
       ?>
          <tr>
            <td width=35 class="style4" align="center" style=" <?php echo $style;?>"><?php 
			if(@$arrData[$j]['code_confirmed'] ==1 && @$arrData[$j]['is_captain']=='Y'){echo $s;}?></td>
            <?php
			 if(($fair_name!='Work Experience Fair') || ($fair_name=='Work Experience Fair' && $fest != "Exhibition"))
	{
			?>
            <td width=61 class="style3" style=" border-top:1px #666666; border-right:1px #666666; padding:2px;" >  &nbsp;<?php
			if(@$arrData[$j]['code_confirmed'] ==1){ echo @$arrData[$j]['participant_id'];} ?></td>
             <?php
			}
			?>
            <td width=61 style=" <?php echo $style;?>" align="center" class="style3"> &nbsp;<?php
				if(@$arrData[$j]['code_confirmed'] ==1 && @$arrData[$j]['is_captain']=='Y'){
					echo @$arrData[$j]['prefixCode'].$arrData[$j]['codeNo'];
				 }
			?></td>
            <td width=35 class="style4" style=" <?php echo $style;?>">&nbsp;</td>
            <td width=35 class="style4" style=" <?php echo $style;?>">&nbsp;</td>
            <td width=35 class="style4" style=" <?php echo $style;?>">&nbsp;</td>
            
            <td width=35 class="style4"style=" <?php echo $style;?>">&nbsp;</td>
            <td width=35 class="style4" style=" <?php echo $style;?>">&nbsp;</td>
            <td width=40 class="style4" style=" <?php echo $style;?>">&nbsp;</td>
            <td width=150 class="style4" style=" <?php echo $style;?>">&nbsp;</td>
          </tr>
          <?php 
		  $j++;
		  } 
		  
		  
		   ?>
        </table>
        
        <p>&nbsp;</p>
        <p>&nbsp;</p>

     
</page>
		