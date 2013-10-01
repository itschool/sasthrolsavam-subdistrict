<style type="text/css">
<!--
.style1 {
	font-size: 14px;
	font-weight: bold;
	color: #660033;
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
<page backtop="20mm" backbottom="20mm ">
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

         <!-- <div align="center" class="style1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date wise participants list</div>-->
 
  <table align="center" width="100%"><tr>
    <td align="center" class="style1">Total  number of participants in <?php echo $fair;?> &nbsp;<?php if($this->input->post('radioLabel')=='exhib')echo 'Exhibition';else {if($cbo_item != 'ALL'){echo '-'.$item_name[0]['item_name'];}  if($this->input->post('cmbCateType') != 'ALL')echo '&nbsp;&nbsp;'.$fest_name[0]['fest_name'];} ?> </td>
  </tr></table>
        
         <br />
         <table width="87%" border="1" align="center" cellpadding="0" cellspacing="0">
       
          <tr>
            <td class="tb" width='30'  style="border-top:0px #000000; border-right:1px #000000; padding:2px;" align="center"> Sl.No. </td>
            
              <?php if($cbo_item == 'ALL'){ ?>
           <td width="70" align="center" style="border-top:1px #000000; border-right:1px #000000; padding:2px;">Item Name</td>
            <?php } ?>
           <?php 	//if($_POST['txtFair']==4){ ?>
          <td width="70" align="center" style="border-top:1px #000000; border-right:1px #000000; padding:2px;">B</td>
          <td width="70" align="center" style="border-top:1px #000000; border-right:1px #000000; padding:2px;">G</td>
          <?php //} ?>
          <td class="tb" width='70' style="border-top:0px #000000; border-right:0px #000000; padding:2px;" align="center" >Total </td>
          </tr>
          
       <?php 
	   $count=0;
	   $category=0;
	  // print_r($item_wise_participants);
	   foreach($item_wise_participants as $intRow=>$value)
	   {
	   ?>
      
        <?php if($this->input->post('cmbCateType') == 'ALL' && $category != $value['fest_id']){ 
		$count=0;
		
	?>
   
     <?php 
//if($value['fest_id']>0)
//{
?>
           <tr><td colspan="5" align="center" style="border-top:1px #000000; border-right:1px #000000; padding:2px;">Category: <?php if($value['fest_id']==2)echo 'UP';else if($value['fest_id']==3)echo 'HS';else if($value['fest_id']==4)echo 'HSS/VHSE'; ?></td></tr>
            <?php 
			}
			//} ?>
          <tr>
          
            <td class="ety" style="border-top:1px #000000; border-right:1px #000000; padding:0px;" align="center"><?php echo ++$count; ?></td>
            <?php if($cbo_item == 'ALL'){ ?>
            <td class="ety" style="border-top:1px #000000; border-right:1px #000000; padding:0px;" align="left"><?php echo $value['item_name']; ?></td>
            <?php } ?>
            <?php 	//if($_POST['txtFair']==4){ ?>
            <td class="ety" style="border-top:1px #000000; border-right:1px #000000; padding:0px;" align="center"><?php echo $value['cnt_b']; ?></td>
            <td class="ety" style="border-top:1px #000000; border-right:1px #000000; padding:0px;" align="center"><?php echo $value['cnt_g']; ?></td>
            <?php //} ?>
            <td class="ety" style="border-top:1px #000000; border-right:0px #000000; padding:2px;" align="center"><?php echo ($value['cnt_b'] + $value['cnt_g']); ?> </td>
          </tr> 
                       
           <?php 
		    $category = $value['fest_id'];
	}
		
		  
   
  ?>	
        </table>
</page>
