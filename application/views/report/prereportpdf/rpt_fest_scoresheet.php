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
    <table width="67%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#D4D0C8">
          <tr>
           		<td  align="center" height="32" colspan="11" style='border: 0 0.5px 0.5px 0 #666666 ; height:20 px;'><strong><?php echo $data['fairName'];?>&nbsp;&nbsp;Festival:<?php echo $data['fest_name'];?></strong></td>
          </tr>          
          <tr>        
            	<td width="38" height="32" style='border:0 0 0.5px 0.5px 0 #666666 ; height:20 px;'><strong>Item </strong></td>
            	<td colspan="8" style='border:0 0 0.5px 0.5px 0 #666666 ; height:20 px;'><span class="style3"><?php echo wordwrap($data['item_code']." - ".$data['item_name'],25,'<br>');?></span></td>
            	<td style='border:0 0 0.5px 0.5px 0 #666666 ; height:20 px;' colspan="2"><strong>Date</strong><strong>:<?php echo datetophpmodel($data['start_time']);?>&nbsp;&nbsp;<?php echo $data['ground_name'];?></strong></td>
          </tr>
          <?php if (file_exists($this->config->item('base_path').'images/value_points/'.$itemcode.'.JPG')){ ?>
          <tr>
            	<td align="center" colspan="11" style='border:0 0 0.5px 0.5px 0 #666666 ; font:Georgia;'>
            	<img src="<?php echo base_url(false).'images/value_points/'.$data['item_code'].'.JPG' ?>" height="160" width="700" />            	</td>
          </tr>
          <?php }?>
           <? if(@$fair	!=	2){ ?>
            <tr>
                <td colspan="3" style='border:0 0 0.5px 0.5px 0 #666666 ; height:20 px;'><div align="left"><strong></strong></div>              	</td>
                <td colspan="6" align="center"><strong>Score for each value points</strong></td>
                <td colspan="2" style='border:0 0 0.5px 0.5px 0 #666666 ; height:20 px;'><div align="center">&nbsp;</div></td>
            </tr>
            <?php
			 }
			 elseif(@$fair	==	2)
			 {			
			?>
             <tr>
                <td colspan="2" style='border:0 0 0.5px 0.5px 0 #666666 ; height:20 px;'><div align="left"><strong></strong></div>              	</td>
                <td colspan="6" align="center"><strong>Score for each value points</strong></td>
                <td colspan="2" style='border:0 0 0.5px 0.5px 0 #666666 ; height:20 px;'><div align="center">&nbsp;</div></td>
            </tr>
            <?php }?>
            <tr>
                <td  align="center"width=38 height="34" style='border:0 0 0.5px 0.5px 0 #666666 ; height:50 px;'><strong>Sl.No</strong>	          </td>
                  <? if(@$fair	!=	2){ ?>
                    <td  align="center"width=90 height="34" style='border:0 0 0.5px 0.5px 0 #666666 ; height:50 px;'><strong>Name of Exhibit</strong>	          </td>
                  <?php
				  }
				  ?>
                <td  align="center"width=80 style='border:0 0 0.5px 0.5px 0 #666666 ; height:50 px;'><strong>Code.No  </strong>                </td>
                <td align="center" width=40 style='border:0 0 0.5px 0.5px 0 #666666 ; height:50 px;'>1</td>
                <td align="center"width=40 style='border:0 0 0.5px 0.5px 0 #666666 ; height:50 px;'>2</td>
                <td align="center" width=46 style='border:0 0 0.5px 0.5px 0 #666666 ; height:50 px;'>3</td>
                <td align="center"width=43 style='border:0 0 0.5px 0.5px 0 #666666 ; height:50 px;'>4</td>
                <td align="center"width=39 style='border:0 0 0.5px 0.5px 0 #666666 ; height:50 px;'>5</td>
                <td align="center"width=50 style='border:0 0 0.5px 0.5px 0 #666666 ; height:50 px;'>6</td>
                <td colspan="2" align="center" style='border:0 0 0.5px 0.5px 0#666666 ; height:50 px;'><strong>Total out of 100</strong></td>
             
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
			
			
			$partData = $this->prereport_model->fetch_participantCode($fair,$fest,$itemcode,0,0);
			$partCount = count($partData);
			
            for($j=0;$j<$partCount+5;$j++)
            {
           	 $sl++;
			
			
			//var_dump($partData[0]);
			
            ?>           
	  <tr>
   		<td align="center" width=38  height="46"  style='border:0 0 0.5px 0.5px 0 #666666 ; '><?php echo $sl;?></td>
         <? if(@$fair	!=	2){ ?>
         <td  align="center"width=90 height="34" style='border:0 0 0.5px 0.5px 0 #666666 ; height:50 px;'>&nbsp;        </td>
                  <?php
				  }
				  ?>
                <td align="center"width=80   height="46"  style='border:0 0 0.5px 0.5px 0 #666666 ;'><?php 
	if(@$partData[$j]['is_captain']=='Y' && @$partData[$j]['is_absent'] != 1)
	{
				echo @$partData[$j]['prefixCode'].@$partData[$j]['codeNo'];
	}?></td>
                <td align="center"width=40   height="46"   style='border:0 0 0.5px 0.5px 0 #666666 ; '>&nbsp;</td>
                <td align="center"width=40   height="46"  style='border:0 0 0.5px 0.5px 0 #666666 ; '>&nbsp;</td>
                <td align="center"width=46   height="46"  style='border:0 0 0.5px 0.5px 0 #666666 ; '>&nbsp;</td>
                <td align="center"width=43   height="46"  style='border:0 0 0.5px 0.5px 0 #666666 ; '>&nbsp;</td>
                <td align="center"width=39   height="46"  style='border:0 0 0.5px 0.5px 0 #666666 ; '>&nbsp;</td>
                <td align="center"width=50   height="46"  style='border:0 0 0.5px 0.5px 0 #666666 ; '>&nbsp;</td>
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