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

      
        
     <?php 
	
	 $count_start_time = count($start_time);
	  foreach($start_time as $int =>$values)
       {
	 ?>
         <page backtop="25mm" backbottom="40mm ">
	<page_header>
    	<?php
			$this->load->view('report/report_header');
		?>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="heading_tab">
            <tr>
                <td align="center" class="style1">Score Sheet - Workexperience Fair (<?php echo " Exhibition"; ?>) 
</td>
            </tr>
            
              <tr>
                <td align="center" class="style1">&nbsp;</td>
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
		//var_dump($start_time);
		//echo "<br /><br />->>>>".count($exb_items);
	?>
</page_footer>  


<table width="98%" border="0" align="center"   cellpadding="0" cellspacing="0" bordercolor="#D4D0C8" > 
        <tr>
           
           
         <td colspan="3" height="65" style="margin-top:100px;border:0 0 0.5px 0.5px 0 #666666 ; height:20 px;width:500 px;"><div align="left"><strong>Stall No :<?php echo $values['prefixCode'].$values['codeNo']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Festival : <? echo $fest_names[0]['fest_name']; ?>  <!--Code.No of the stall--></strong></div></td>
        
         <td style='border:0 0 0.5px 0.5px 0 #666666 ; height:20 px;' ><strong>Date</strong><strong>:<?php echo datetophpmodel($values['start_time']);?>&nbsp;&nbsp;<?php echo $values['ground_name'];?></strong></td>
      </tr>
      <tr>
        <td width="59"  align="center" style='border:0 0 0.5px 0.5px 0 #666666 ; height:25 px;'><strong>Sl.No</strong>							            </td>
           
        <td width="368"  align="center" style='border:0 0 0.5px 0.5px 0 #666666 ; height:25 px;'><strong>&nbsp;&nbsp;&nbsp;&nbsp;Name of Items&nbsp;&nbsp;&nbsp;</strong>                </td>
            
        <td width="108" align="left" style='border:0 0 0.5px 0.5px 0 #666666 ; height:30 px;'><strong>Maximum Marks 100</strong></td>
                
            <td width="206" align="left" style='border:0 0 0.5px 0.5px 0 #666666 ; height:30 px;'><strong>&nbsp;&nbsp;Remarks</strong></td>
      </tr>
      <?php 
    
      $sl=0;
	 /* print_r($exb_item);
	  $item_array = array();
	  $item_array = explode('#',@$values['item_code']);*/
	   
	  
	  
	  foreach($exb_item as $rows)
	  {		//for($k=0;$k<$item_count;$k++)
       
	   		/* $item_details = $this->General_Model->get_data('item_master','item_code,item_name',array('item_code'=>$item_array[$k]));*/
			
         $sl++;
       ?>
      <tr>
           	<td align="center" width="59"  height="46"  style='border:0 0 0.5px 0.5px 0 #666666 ; height:50 px;'>
		    <?php echo $sl;?></td>
            
          
            <td align="left" width="368"    height="46"  style='border:0 0 0.5px 0.5px 0 #666666 ;'>&nbsp;<?php echo $rows['item_name'];?></td>
            
            <td align="center" width="108"    height="46"  style='border:0 0 0.5px 0.5px 0 #666666 ; '>&nbsp;</td>
                
            <td align="center" width="206"    height="46"  style='border:0 0 0.5px 0.5px 0 #666666 ; '>&nbsp;</td>
      </tr>   
      
      <?php } //foreach  
	  ?><tr><td style='border:0 0 0px 0px 0 #666666 ; 'colspan="4">&nbsp;</td></tr>
       </table>
  
    </page>
      <?php
	  }?>
   
    
<p>&nbsp;</p>
		<p>&nbsp;</p>
        