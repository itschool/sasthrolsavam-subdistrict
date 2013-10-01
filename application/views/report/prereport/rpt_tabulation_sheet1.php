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
	/*border: 0 0.5px 0.5px 0 #666666 ;*/
	border-right:1px #666666;
	
	 height:25px;
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
         <?php 
			foreach($retvalue as $data)
			{
			?>
        
<page backtop="35mm" backbottom="40mm">
        <page_header>
    	<?php
			$this->load->view('report/report_header');
		?>
        <table width="800" border="0" align="center" bordercolor="#D4D0C8">
<?php
	
		
		  $time=$data['timer'];
		  if($time=='')
		  $t='';
		  else
		  {
		  $t=date('d M Y',strtotime($time));
		  }
		  ?>
    <tr>
    	<td colspan="4" class="style10" align="center">Tabulation Sheet<br /><?php echo $data['fairName']; if($data['fairName']=='Work Experience Fair'){ if($data['fest_name']=='Exhibition'){ echo ' (Exhibition)'; }else{ echo ' (On the Spot)';}}?></td></tr>
    <tr>
        <td width=50 height="32" class="style9">Item  :</td>
        <td width=300 height="32" class="style9"><?php echo $data['item_code']; ?>   -   <?php echo $data['item_name']; ?> <?php if($data['fest_name']!='Exhibition'){ echo ' ('.$data['fest_name'].')';} ?></td>
        <td width=50 height="32" class="style9">Date  :</td>
        <td width=80 height="30" class="style9"><?php echo $t; ?></td>
    </tr>
    </table>
    
	</page_header>
    <page_footer>
	        <p>&nbsp;</p>
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
    <tr>
            <td colspan="3" class="style4"><div align="left"></div>              
            <div align="center"></div></td>
            <td colspan="6" class="style4" align="center"><strong>Score </strong></td>
           <td colspan="3" class="style4"><div align="center">&nbsp;</div></td>
          </tr>
    <tr>
        <td width=35 class="style4" align="center" style=" border-top:1px #666666;"><strong>Sl.No</strong></td>
        <td width=50 class="style4"align="center" style=" border-top:1px #666666;"><strong>Code.No</strong></td>
        <td width=50 class="style4"align="center" style=" border-top:1px #666666;"><strong>Reg No  </strong></td>
      <td width=35 class="style4" align="center" style=" border-top:1px #666666;">J1</td>
        <td width=35 class="style4"align="center" style=" border-top:1px #666666;">J2</td>
        <td width=35 class="style4"align="center" style=" border-top:1px #666666;">J3</td>
        <td width=35 class="style4"align="center" style=" border-top:1px #666666;">J4</td>
        <td width=35 class="style4"align="center" style=" border-top:1px #666666;">J5</td>
        
        <td width=35 class="style4"align="center" style=" border-top:1px #666666;"><strong>Total</strong></td>
        <td width=35 class="style4"align="center" style=" border-top:1px #666666;"><strong>%</strong></td>
        <td width=40 class="style4"align="center" style=" border-top:1px #666666;"><strong>Grade</strong></td>
        <td width=150 class="style4"align="center" style=" border-top:1px #666666;"><strong> Remarks</strong></td>
    </tr>
    <?php 
     $itemcode = $data['item_code'];
	$fair = $data['fairId'];
	$fest = $data['fest_id'];
	$partData = $this->prereport_model->fetch_participantCode($fair,$fest,$itemcode,0,1);
	$partCount = count($partData);
	$j=0;	
	//echo "count--".$partCount;
    for($i=0;$i<$partCount+5;$i++)
    {
		
		if($i >= $partCount)
		{$style = "border-top:1px #666666; border-right:1px #666666; padding:2px;";
		}
		else
		{//echo "i===".$i."<br><br>";
			if($partData[$i]['is_captain']=='Y'){
			 $j++;
			$style = "border-top:1px #666666; border-right:1px #666666; padding:2px;";
			}
			else
			$style = "border-right:1px #666666; padding:2px;";
		}
    
    ?>
    <tr>
        <td class="style4" align="center" style=" <?php echo $style;?>" >
		
		<?php if(@$partData[$i]['code_confirmed'] ==1 && @$partData[$i]['is_captain']=='Y'){echo $j;}?>
        </td>
        <td class="style4" align="center" style=" <?php echo $style;?>">
		<?php if(@$partData[$i]['code_confirmed'] ==1 && @$partData[$i]['is_captain']=='Y'){ echo @$partData[$i]['prefixCode'].@$partData[$i]['codeNo'];}?></td>
        <td class="style4"align="center" style=" border-top:1px #666666;padding:2px;" ><?php echo @$partData[$i]['participant_id'];?></td>
        <td  class="style4"align="center" style=" border-top:1px #666666;padding:2px;" >&nbsp;</td>
        <td class="style4"align="center" style=" border-top:1px #666666;padding:2px;" >&nbsp;</td>
        <td class="style4"align="center" style=" border-top:1px #666666;padding:2px;" >&nbsp;</td>
        <td class="style4"align="center" style=" border-top:1px #666666;padding:2px;" >&nbsp;</td>
        <td class="style4"align="center" style=" border-top:1px #666666;padding:2px;" >&nbsp;</td>
        <td class="style4"align="center" style=" border-top:1px #666666;padding:2px;" >&nbsp;</td>
        <td class="style4"align="center" style=" border-top:1px #666666;padding:2px;" >&nbsp;</td>
        <td class="style4"align="center" style=" border-top:1px #666666;padding:2px;" >&nbsp;</td>
         <td class="style4"align="center" style=" border-top:1px #666666;padding:2px;" >&nbsp;</td>
  </tr>  

<?php
}
?>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>


</page> 
          <?php
	  
		  }
		  
		  ?> 
          

		