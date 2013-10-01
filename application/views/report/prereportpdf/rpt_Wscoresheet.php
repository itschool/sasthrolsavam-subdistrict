<style type="text/css">
<!--
.style1 {
	font-size: 18px;
	font-weight: bold;
	color: #660033;
font:Verdana;
}
.style2 {font-size: 22px}
-->
</style>
<page backtop="25mm" backbottom="40mm ">
	<page_header>
    	<?php
			$this->load->view('report/report_header');
		?>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="heading_tab">
            <tr>
                <td align="center" class="style1">Score Sheet</td>
            </tr>
        </table>
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
                    <td width="190" align="right" height="40" valign="top">Addresss:</td>
                    <td align="left">&nbsp;</td>
                </tr>
  </table>

  <?php
		$this->load->view('report/report_footer');
	?>
</page_footer>  

    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#D4D0C8">
      <tr>
        <td height="32" align="center" colspan="10" style='border:0 0 0.5px 0.5px 0 #666666 ; height:20 px; font:Georgia;'>Festival:<?php echo $start_time[0]['fest_name'];?></td>
      </tr>
          
      <tr>        
       	<td width="44" height="32" style='border:0 0 0.5px 0.5px 0 #666666 ; height:20 px;'><strong>Item </strong></td>
           	<td colspan="9" style='border:0 0 0.5px 0.5px 0 #666666 ; height:20 px;'><span class="style2"><?php  echo wordwrap( $itemcode." - ".$start_time[0]['item_name'],50,'<br>');?></span></td>
      </tr>
          
      <!--<tr>
            <td width=49 height="32" style='border:0 0 0.5px 0.5px 0 #666666 ; height:20 px;font:Georgia;'><div align="left"><strong>Item</strong></div></td>
            <td colspan="9" style='border:0 0 0.5px 0.5px 0 #666666 ; height:20 px;font:Georgia; '><strong><span class="style2"><?php  echo wordwrap( $itemcode." - ".$start_time[0]['item_name'],25,'<br>');?></span></strong></td>
            <td align="left" style='border:0 0 0.5px 0.5px 0 #666666 ; height:20 px;'><strong>Date :<?php  echo datetophpmodel($start_time[0]['start_time']);?> </strong></td>
          </tr>-->
      <?php if (file_exists($this->config->item('base_path').'value_points/'.$itemcode.'.JPG')){ ?>
          
      
      <!--<tr>
            <td align="center" colspan="11" style='border:0 0 0.5px 0.5px 0 #666666 ; font:Georgia;'>
            	<img src="<?php echo base_url(false).'value_points/'.$itemcode.'.JPG' ?>" height="100" width="700" />
            </td>
          </tr>-->
      <?php }?>
      <tr>
           
           
         <td colspan="2" style='border:0 0 0.5px 0.5px 0 #666666 ; height:20 px;'><div align="left"><strong></strong></div>              	</td>
         <td colspan="4" align="center"><strong>Score for each value points</strong></td>
          <td width="27" style='border:0 0 0.5px 0.5px 0 #666666 ; height:20 px;'><div align="center">&nbsp;</div></td>
              
               
      </tr>
      <tr>
        <td width="44" rowspan="2"  align="center" style='border:0 0 0.5px 0.5px 0 #666666 ; height:25 px;'><strong>Sl.No</strong>							            </td>
           
        <td width="111" rowspan="2"  align="center" style='border:0 0 0.5px 0.5px 0 #666666 ; height:25 px;'><strong>Code.No  </strong>                </td>
            <td align="left" width="139" style='border:0 0 0.5px 0.5px 0 #666666 ; height:30 px;'><strong>&nbsp;&nbsp;&nbsp;&nbsp;Work content and pupils participation&nbsp;&nbsp;&nbsp;&nbsp;</strong></td>
            <td width="91" align="left" style='border:0 0 0.5px 0.5px 0 #666666 ; height:30 px;'><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Skill utilized and finish&nbsp;&nbsp;&nbsp;</strong></td>
            <td width="158" align="left" style='border:0 0 0.5px 0.5px 0 #666666 ; height:30 px;'><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Knowledge about materials,tools etc.,and time taken&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></td>
            <td width="91" align="left" style='border:0 0 0.5px 0.5px 0 #666666 ; height:30 px;'><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Social usefulness of the product&nbsp;&nbsp;</strong></td>
                
            <td width="79" rowspan="2" align="left" style='border:0 0 0.5px 0.5px 0 #666666 ; height:30 px;'><strong>Total 100</strong></td>
      </tr>
          <tr>
            <td align="center" style='border:0 0 0.5px 0.5px 0 #666666 ; height:30 px;'><b>40%</b></td>
            <td width="91" align="center" style='border:0 0 0.5px 0.5px 0 #666666 ; height:30 px;'><b>25%</b></td>
            <td width="158" align="center" style='border:0 0 0.5px 0.5px 0 #666666 ; height:30 px;'><b>20%</b></td>
            <td width="91" align="center" style='border:0 0 0.5px 0.5px 0 #666666 ; height:30 px;'><b>15%</b></td>
          </tr>
         
      <?php 
     $count=$start_time[0]['no_of_participant'];
      $sl=0;
	  for($i=0;$i<$count+5;$i++)
       {
         $sl++;
       ?>
      <tr>
           	<td align="center" width="44"  height="46"  style='border:0 0 0.5px 0.5px 0 #666666 ; height:50 px;'>
		    <?php echo $sl;?></td>
            
          
            <td align="center" width="111"    height="46"  style='border:0 0 0.5px 0.5px 0 #666666 ;'>&nbsp;
            <?php
	if(@$start_time[$i]['is_captain']=='Y' && @$start_time[$i]['is_absent'] != 1)
	{
		echo @$start_time[$i]['prefixCode'].$start_time[$i]['codeNo'];
	}
	?>
            
            </td>
            <td align="center" width="139"    height="46"  style='border:0 0 0.5px 0.5px 0 #666666 ; '>&nbsp;</td>
            <td align="center" width="91"    height="46"  style='border:0 0 0.5px 0.5px 0 #666666 ; '>&nbsp;</td>
            <td align="center" width="158"    height="46"  style='border:0 0 0.5px 0.5px 0 #666666 ; '>&nbsp;</td>
            <td align="center" width="91"    height="46"  style='border:0 0 0.5px 0.5px 0 #666666 ; '>&nbsp;</td>
                
            <td align="center" width="79"    height="46"  style='border:0 0 0.5px 0.5px 0 #666666 ; '>&nbsp;</td>
      </tr>          
      <?php }  ?>
    </table>
    </page>
<p>&nbsp;</p>
		<p>&nbsp;</p>
        