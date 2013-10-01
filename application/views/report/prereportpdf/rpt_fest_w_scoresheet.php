<style type="text/css">
<!--
.style1 {
	font-size: 18px;
	font-weight: bold;
	color: #660033;
}
.style2 {
	font-size: 24px;
	font-weight: bold;
}
.style3 {
	font-size: 11px;
	font-weight: bold;
	color: black;
}


-->
</style>
	<?php
    
    $flag=0;
    $count=0;  
    $check2=''; $i=0;
    foreach($start_time as  $data)
    {   
    $itemcode = $data['item_code'];
	$fair = $data['fairId'];
	$fest = $data['fest_id'];
			
    $check=$data['fest_name'];
	$check_fair=$data['fairName'];
    $count=$data['no_of_participant'];
    if($i!=0){
    print("</page>");
    }
    $i++;
    
    
    ?>
<page backtop="20mm" backbottom="40mm ">
	<page_header>
    	<?php
			$this->load->view('report/report_header');
		?>
	</page_header>
    <page_footer>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#D4D0C8">
                <tr>
                    <td  align="right" width="500" height="20" valign="top">Signature :</td>
                    <td align="left" width="200">&nbsp;</td>
                </tr>
                <tr>
                    <td   align="right" height="20" valign="top" >Name of judge:</td>
                    <td align="left">&nbsp;</td>
                </tr>
                <tr>
                    <td  align="right" height="40" valign="top">Addresss:</td>
                    <td align="left">&nbsp;</td>
                </tr>
            </table>
			<?php
                $this->load->view('report/report_footer');
            ?>
    </page_footer>   
    <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class=						"heading_tab" style="margin-top:15px;">
    <tr>
      <td height="37" align="center" class="style1">Score Sheet</td>
    </tr>
    </table>
<table width=300 border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#D4D0C8" style="width:300px;">
      <tr>
       		<td  align="center" height="32" colspan="11" style='border: 0 0.5px 0.5px 0 #666666 ; height:20 px;'><strong><?php echo $data['fairName'];?>&nbsp;&nbsp;Festival:<?php echo $data['fest_name'];?></strong></td>
      </tr>          
      <tr>        
           	<td width="37" height="32" style='border:0 0 0.5px 0.5px 0 #666666 ; height:20 px;'><strong>Item </strong></td>
           	<td colspan="5" style='border:0 0 0.5px 0.5px 0 #666666 ; height:20 px;'><span class="style3"><?php echo wordwrap($data['item_code']." - ".$data['item_name'],25,'<br>');?></span></td>
           	<td style='border:0 0 0.5px 0.5px 0 #666666 ; height:20 px;' colspan="2"><strong>Date</strong><strong>:<?php echo datetophpmodel($data['start_time']);?>&nbsp;&nbsp;<?php echo $data['ground_name'];?></strong></td>
      </tr>
        
      
         <tr>
            <td colspan="2" style='border:0 0 0.5px 0.5px 0 #666666 ; height:20 px;'><div align="left"><strong></strong></div>              	</td>
            <td colspan="4" align="center"><strong>Score for each value points</strong></td>
            <td colspan="2" style='border:0 0 0.5px 0.5px 0 #666666 ; height:20 px;'><div align="center">&nbsp;</div></td>
        </tr>
       
        <tr>
            <td width=37 height="34" align="center" style='border:0 0 0.5px 0.5px 0 #666666 ; height:50 px;' rowspan="2"><strong>Sl.No</strong>	          </td>
                 
          <td width=79 rowspan="2"  align="center" style='border:0 0 0.5px 0.5px 0 #666666 ; height:50 px;'><strong>Code.No  </strong>                </td>
            <td width=87 align="center" style='border:0 0 0.5px 0.5px 0 #666666 ; height:50 px;'><strong>Work&nbsp;content<br />and&nbsp;pupils<br />participation&nbsp;</strong></td>
            <td align="center"width=80 style='border:0 0 0.5px 0.5px 0 #666666 ; height:50 px;'><strong>Skill&nbsp;utilized<br />and&nbsp;finish</strong></td>
            <td width="98" align="center" style='border:0 0 0.5px 0.5px 0 #666666 ; height:30 px;'><strong>Knowledge<br />about<br />materials,tools<br />etc.,and time<br />taken</strong></td>
           <td width="80" align="center" style='border:0 0 0.5px 0.5px 0 #666666 ; height:30 px;'><strong>Social<br />usefulness<br />of<br />the<br />product</strong></td>
           
            <td colspan="2" rowspan="2" align="center" style='border:0 0 0.5px 0.5px 0#666666 ; height:50 px;' width=50><strong>Total out of 100</strong></td>
             
        </tr>
        <tr>
          <td width=87 align="center" style='border:0 0 0.5px 0.5px 0 #666666 ; height:50 px;'><b>40%</b></td>
          <td align="center" style='border:0 0 0.5px 0.5px 0 #666666 ; height:50 px;'><b>25%</b></td>
          <td width="98" align="center" style='border:0 0 0.5px 0.5px 0 #666666 ; height:30 px;'><b>20%</b></td>
          <td width="80" align="center" style='border:0 0 0.5px 0.5px 0 #666666 ; height:30 px;'><b>15%</b></td>
        </tr>
        
        <tr>
            <td  height="24" colspan="6" align="center"  style='border:0 0 0.5px 0.5px 0 #666666 ; height:50 px;'>&nbsp;</td>
            <td align="center" width=50   height="24" style='border:0 0 0.5px 0.5px 0 #666666 ; height:80 px;' valign="top"><strong>In Figures</strong></td>
            <td align="center" width=150  height="24"  style='border:0 0 0.5px 0.5px 0 #666666 ; height:80 px;' valign="top"><strong>In Words</strong></td>
               
        </tr>
       
		<?php 
            $sl=0;
			$prev_item =0;
			
			
			$partData = $this->prereport_model->fetch_participantCode($fair,$fest,$itemcode,0,0);
			$partCount = count($partData);
			
            for($j=0;$j<$partCount+5;$j++)
            {
           	 $sl++;
			
			
			//var_dump($partData[0]);
			
            ?>           
  <tr>
	<td align="center" width=37  height="46"  style='border:0 0 0.5px 0.5px 0 #666666 ; '><?php echo $sl;?></td>
        
            <td align="center"width=79   height="46"  style='border:0 0 0.5px 0.5px 0 #666666 ;'><?php 
	if(@$partData[$j]['is_captain']=='Y' && @$partData[$j]['is_absent'] != 1)
	{
				echo @$partData[$j]['prefixCode'].@$partData[$j]['codeNo'];
	}?></td>
            <td align="center"width=87   height="46"   style='border:0 0 0.5px 0.5px 0 #666666 ; '>&nbsp;</td>
            <td align="center"width=80   height="46"  style='border:0 0 0.5px 0.5px 0 #666666 ; '>&nbsp;</td>
            <td align="center"width=98   height="46"  style='border:0 0 0.5px 0.5px 0 #666666 ; '>&nbsp;</td>
            <td align="center"width=80   height="46"  style='border:0 0 0.5px 0.5px 0 #666666 ; '>&nbsp;</td>
          
            <td align="center"width=70  style='border:0 0 0.5px 0.5px 0 #666666 ; height:50 px;'>&nbsp;</td>
            <td align="center" width=20  height=50  style='border:0 0 0.5px 0.5px 0 #666666 ; '>&nbsp;</td>
              
        </tr>          
		<?php
            }  
            ?>
</table>
<?php
            }
            ?>
            
</page>