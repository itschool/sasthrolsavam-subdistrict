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
    $check2=''; $i=0; $itemcode =$retvalue[0]['item_code'];
    foreach($retvalue as  $data)
    {   
   // $itemcode = $data['item_code'];
	$fair = $data['fairId'];
	$fest = $data['fest_id'];
			
    $check=$data['fest_name'];
	$count=$data['no_of_participant'];
   	
	if($itemcode != $data['item_code'])
	{//echo "<br><br>--------".$i;
		$i++;
		  print("</page>");
		  $itemcode = $data['item_code'];
	}	
 
    
    
    ?>
<page backtop="35mm" backbottom="30mm">
	<page_header>
    	<?php
			$this->load->view('report/report_header');
		?>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="heading_tab" style="margin-top:15px;">
    <tr>
      <td  align="center" colspan="3" class="style1">Score Sheet</td>
    </tr>
     <tr>
      <td  align="left" ><strong><?php echo @$fair_name;?>&nbsp;&nbsp;Festival:<?php echo $data['fest_name'];?></strong></td>
      <td  align="center" >&nbsp;</td>
      <td  align="right" >Item : <?php echo wordwrap($data['item_code']." - ".$data['item_name'],75,'<br>');?></td>
    </tr>
    </table>
	</page_header>
    <page_footer>
           <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#D4D0C8" >
                <tr>
                    <td  align="left" width="250" height="20" valign="top">Signature :</td>
                    <td  align="left" width="250" height="20" valign="top">Name &amp; Addresss of judge:</td>
                </tr>
           </table>
			<?php
                $this->load->view('report/report_footer');
            ?>
    </page_footer>   
   
    <table width="67%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#D4D0C8">
        <!--  <tr>
           		<td  align="center" height="32" colspan="11" style='border: 0 0.5px 0.5px 0 #666666 ; height:20 px;'><strong><?php echo @$fair_name;?>&nbsp;&nbsp;Festival:<?php echo $data['fest_name'];?></strong></td>
          </tr>          
          <tr>        
            	<td width="38" height="32" style='border:0 0 0.5px 0.5px 0 #666666 ; height:20 px;'><strong>Item </strong></td>
            	<td colspan="5" style='border:0 0 0.5px 0.5px 0 #666666 ; height:20 px;'><span class="style3"><?php echo wordwrap($data['item_code']." - ".$data['item_name'],75,'<br>');?></span></td>
            	<td style='border:0 0 0.5px 0.5px 0 #666666 ; height:20 px;' colspan="2" class="style3"><strong>Date</strong><strong>:<?php echo datetophpmodel($data['start_time']);?>&nbsp;&nbsp;<?php echo $data['ground_name'];?></strong></td>
          </tr>-->
          <?php if (file_exists($this->config->item('base_path').'images/value_points/'.$itemcode.'.JPG')){ ?>
          <tr>
            	<td align="center" colspan="8" style='border:0 0 0.5px 0.5px 0 #666666 ; font:Georgia;'>
            	<!--<img src="<?php echo base_url(false).'images/value_points/'.$data['item_code'].'.JPG' ?>" height="160" width="700" />-->            	</td>
          </tr>
          <?php }?>
           
             <tr>
                <td colspan="2" style='border:0 0 0.5px 0.5px 0 #666666 ; height:20 px;'><div align="left"><strong></strong></div>              	</td>
                <td colspan="4" style='border:0 0 0.5px 0.5px 0 #666666 ; height:20 px;' align="center"><strong>Score for each value points</strong></td>
                <td colspan="2" style='border:0 0 0.5px 0.5px 0 #666666 ; height:20 px;'><div align="center">&nbsp;</div></td>
            </tr>
          
            <tr>
                <td  align="center"width=38 height="34" style='border:0 0 0.5px 0.5px 0 #666666 ; height:50 px;' rowspan="2" ><strong>Sl.No</strong>	          </td>
                  
                <td  align="center"width=80 style='border:0 0 0.5px 0.5px 0 #666666 ; height:50 px;' rowspan="2" ><strong>Code.No  </strong>                </td>
                <td width=87 align="center" style='border:0 0 0.5px 0.5px 0 #666666 ; height:50 px;'><strong>Work&nbsp;content<br />and&nbsp;pupils<br />participation&nbsp;</strong></td>
                 <td align="center"width=80 style='border:0 0 0.5px 0.5px 0 #666666 ; height:50 px;'><strong>Skill&nbsp;utilized<br />and&nbsp;finish</strong></td>
            <td width="98" align="center" style='border:0 0 0.5px 0.5px 0 #666666 ; height:30 px;'><strong>Knowledge<br />about<br />materials,tools<br />etc.,and time<br />taken</strong></td>
           <td width="80" align="center" style='border:0 0 0.5px 0.5px 0 #666666 ; height:30 px;'><strong>Social<br />usefulness<br />of<br />the<br />product</strong></td>
                
                <td colspan="2" align="center" style='border:0 0 0.5px 0.5px 0#666666 ; height:50 px;' rowspan="2" ><strong>Total out of 100</strong></td>
             
            </tr>
             <tr>
          <td width=87 align="center" style='border:0 0 0.5px 0.5px 0 #666666 ; height:50 px;'><b>40%</b></td>
          <td align="center" style='border:0 0 0.5px 0.5px 0 #666666 ; height:50 px;'><b>25%</b></td>
          <td width="98" align="center" style='border:0 0 0.5px 0.5px 0 #666666 ; height:30 px;'><b>20%</b></td>
          <td width="80" align="center" style='border:0 0 0.5px 0.5px 0 #666666 ; height:30 px;'><b>15%</b></td>
        </tr>
        
             <? if(@$fair	!=	2){ ?>
          <!--  <tr>
                <td  height="24" colspan="9" align="center"  style='border:0 0 0.5px 0.5px 0 #666666 ; height:50 px;'>&nbsp;</td>
                <td align="center"  style='border:0 0 0.5px 0.5px 0 #666666 ; height:50 px;'><strong>In Figures</strong></td>
                <td align="center"  height="24"  style='border:0 0 0.5px 0.5px 0 #666666 ; height:50 px;'><strong>In Words</strong></td>
               
            </tr>-->
            <?php
			 }
			 elseif(@$fair	==	2)
			 {			
			?>
            <!-- <tr>
                <td  height="24" colspan="8" align="center"  style='border:0 0 0.5px 0.5px 0 #666666 ; height:50 px;'>&nbsp;</td>
                <td align="center"  style='border:0 0 0.5px 0.5px 0 #666666 ; height:50 px;'><strong>In Figures</strong></td>
                <td align="center"  height="24"  style='border:0 0 0.5px 0.5px 0 #666666 ; height:50 px;'><strong>In Words</strong></td>
               
            </tr>-->
            <?php
			 }
			 ?>
			<?php 
            $sl=0;
			$prev_item =0;
			
			
			$partData = $this->prereport_model->fetch_participantCode($fair,$fest,$itemcode);
			$partCount = count($partData);
			
            for($j=0;$j<$partCount+5;$j++)
            {
           	 $sl++;
			
			
			//var_dump($partData[0]);
			
            ?>           
	  <tr>
   		<td align="center" width=38  height="46"  style='border:0 0 0.5px 0.5px 0 #666666 ; '><?php echo $sl;?></td>
        
                <td align="center"width=80   height="46"  style='border:0 0 0.5px 0.5px 0 #666666 ;'><?php 
	if(@$partData[$j]['is_captain']=='Y' && @$partData[$j]['is_absent'] != 1)
	{
				echo @$partData[$j]['prefixCode'].@$partData[$j]['codeNo'];
	}?></td>
                <td align="center"width=40   height="46"   style='border:0 0 0.5px 0.5px 0 #666666 ; '>&nbsp;</td>
                <td align="center"width=40   height="46"  style='border:0 0 0.5px 0.5px 0 #666666 ; '>&nbsp;</td>
                <td align="center"width=46   height="46"  style='border:0 0 0.5px 0.5px 0 #666666 ; '>&nbsp;</td>
                <td align="center"width=43   height="46"  style='border:0 0 0.5px 0.5px 0 #666666 ; '>&nbsp;</td>
                
                <td align="center"width=68  style='border:0 0 0.5px 0.5px 0 #666666 ; height:50 px;'>&nbsp;</td>
               <!-- <td align="center"width=166  height="46"  style='border:0 0 0.5px 0.5px 0 #666666 ; '>&nbsp;</td>-->
              
            </tr>          
			<?php
            }  
            ?>
         </table>
    <?php
            }
            ?>
            
    </page>