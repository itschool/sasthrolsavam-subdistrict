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
.fnt{
font-size: 13px;
	color:#000000;}

.ety{
	font-size: 12px;
	color:#000000;
	}
-->
</style>
<div class="container">   
<?php echo form_open('', array('id' => 'codeform','target'=>'_blank'));?>






 <?php 
// echo "<br><br>";var_dump($partdata[216]);  
 
if(count($partdata) > 0)
	{
		$fairr = 0;
		$item = 0;
		 $count	=	0;$s = 0;
    foreach($partdata as $data)
    {
		
		
    ?>
    <?php    
    	if($fairr != $data['fairId']){
		
			$fairr  = $data['fairId'];
       ?>  
    <table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
        	<!--<tr>
                <td colspan="2" class="style1" align="center"><?php //echo $fair_name; ?></td>
            </tr>-->
            <tr bgcolor="#FFFFE8">
                <td colspan="3" class="style1" align="center">
                <?php echo @$data['fairName']; if(@$data['fairName']=='Work Experience Fair'){ if(@$festdet[0]['fest_name']=='Exhibition'){ echo ' (Exhibition)';} else{ echo ' (On the Spot)';}} ?>
				<br />
				Itemwise participants list without Code Number</td>
            </tr>
            
        </table>

     <?php
		}//if different fair
		//echo "'i'--".$s."---".$data['participant_id']."===data==".$data['item_code'];
    	if($item != $data['item_code']){
			//echo "<br><br>inside---".$item;
			$count	=	0;
			$s = 0;
			$count	++;
			$item  = $data['item_code'];
       ?>   
        <table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
        	<!--<tr>
                <td colspan="2" class="style1" align="center"><?php //echo $fair_name; ?></td>
            </tr>-->
         
             <tr bgcolor="#FFFFE8">
         <td width="35%" height="35" align="left" class="fnt">&nbsp;</td>
        <td width="27%" align="left" class="fnt">Item  :&nbsp;&nbsp; <?php echo @$data['item_code'];?>&nbsp;-&nbsp;<?php echo @$data['item_name'];?>&nbsp;&nbsp;</td>
        
         <td width="38%" align="left" class="fnt">&nbsp;&nbsp;<?php  if(@$data['fest_name']!='Exhibition'){ echo 'Festival : '.@$data['fest_name'];}?></td>
       
  </tr>
 
        </table>
 <?php 
 if($count > 1)
 {
	 echo "</div></table>";
 }
?>
  <div align="center">      
<table width="80%" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr class="table_row_first">
        <td class="tb" width='81' align="center" style="border-top:0px #666666; border-right:1px #666666; padding:2px;">Sl.No.</td>
        <td  class="tb" width='74' align="center" style="border-top:0px #666666; border-right:1px #666666; padding:2px;">Reg No.</td>
        <td  class="tb" width='102' align="center" style="border-top:0px #666666; border-right:1px #666666; padding:2px;">School code.</td>
        <td class="tb" width='490' align="left" style="border-top:0px #666666; border-right:1px #666666; padding:2px;">&nbsp;&nbsp;Name </td>
        
      
  </tr>
  <?php  }//if  different item 
 
?>
   <?php    
   
     /*foreach($data as $row)
    {*/
        $s++;
    ?>
    <tr class="table_row_first">
        <td class="ety"  align="center" style="border-top:1px #666666; border-right:1px #666666; padding:2px;"><?php echo $s;?></td>
        <td  class="ety"  align="center" style="border-top:1px #666666; border-right:1px #666666; padding:2px;"><?php echo $data['participant_id'];?></td>
         <td  class="ety"  align="center" style="border-top:1px #666666; border-right:1px #666666; padding:2px;">        
        <?php echo $data['school_code'];?>
         </td>
        <td class="ety"  align="left" style="border-top:1px #666666; border-right:1px #666666; padding:2px;">&nbsp;&nbsp;<?php echo wordwrap($data['participant_name'],34,'<br>');?></td>
     
  </tr>
    <?php 
    //}
    ?>

 <?php 
	
    }// foreach item 
/*	echo "<br /><br />fest".$fest_id;
	echo "<br /><br />fest".$fest_id;*/
	
	
	// $details = $fair_id."__".$fest_id."__ALL";
	
	?>
   <!-- <table align="center">
       <tr><td>
       Number of Code per page :
       </td>
       <td>
         <select name="print_no" id="print_no" >
         <option value="4">4</option>
         <option value="6">6</option>
         <option value="8" selected="selected">8</option>
         </select>
        </td>
        <td>
        &nbsp;&nbsp;&nbsp;
         <input type="submit" name="btnPrint" id="btnPrint" value="Click here to print code number" onclick="javascript:printCode('<?php echo $details?>')" > 
        </td>
       
        
        </tr>
        </table>
    -->
    <?
	}//if
	else
	{
		echo "<center>No data</center>";	
	}
    ?>
<label>
        <!--<input type="submit" name="btnSubmit" id="btnSubmit" value="Print" onclick="javascript: return generateCodenumbers();">-->
        
        <input type="hidden"  name="cmbFairType" value="<?php echo @$partdata[0]['fairId']?>" id="cmbFairType"/>
    <input type="hidden"  name="cmbCateType" value="<?php echo @$partdata[0]['fest_id']?>" id="cmbCateType"/>
     <input type="hidden"  name="cbo_item" value="<?php echo @$partdata[0]['item_code']?>" id="cbo_item"/>
    
       </label>

<?php
//echo "---------------".var_dump($exhbdata); 
if(count($exhbdata) > 0)
{
	?>
     

  <table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
        	<!--<tr>
                <td colspan="2" class="style1" align="center"><?php //echo $fair_name; ?></td>
            </tr>-->
            <tr bgcolor="#FFFFE8">
                <td colspan="3" class="style1" align="center">
              Exhibition 
				<br />
				Itemwise participants list without Code Number</td>
            </tr>
            
        </table>

       <table width="80%" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr class="table_row_first">
        <td class="tb" width='100' align="center"  style="border-top:0px #666666; border-right:1px #666666; padding:2px;">Sl.No.</td>
        <td  class="tb" width='108' align="center" s style="border-top:0px #666666; border-right:1px #666666; padding:2px;">Category</td>
        </tr>     
        
      
        
      
 
  <?php
  $s=0;
   for($k=1;$k<5;$k++)
    {
        //$s++;
		
		if($k==1){ $cate	=	'LP'; }elseif($k==2){$cate	=	'UP'; }elseif($k==3){$cate	=	'HS'; }elseif($k==4){$cate	=	'HSS'; }
		$cat_det	 =	$this->prereport_model->get_code_notGen_exb(1,$k);
		
		if(count($cat_det) > 0) {
		foreach($cat_det as $row) {
    ?>
   
        
    <tr class="table_row_first">
        <td class="ety"  align="center" style="border-top:1px #666666; border-right:1px #666666; padding:2px;"><?php echo $k;?></td>
        <td  class="ety"  align="left" style="border-top:1px #666666; border-right:1px #666666; padding:2px;">        
        <?php echo $cate;?>
         </td>
       
     
  </tr>
    <?php 
   }
    ?>


<?php
     }
 } //for
   ?>
 </table>  
</div>
<br />
<? } ?>

		
<?php echo form_close();?>