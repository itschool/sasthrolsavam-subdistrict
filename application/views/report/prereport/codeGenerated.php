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
<?php echo form_open('', array('id' => 'codeform','name' => 'codeform'));?>


        <table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
        	<!--<tr>
                <td colspan="2" class="style1" align="center"><?php //echo $fair_name; ?></td>
            </tr>-->
            <tr bgcolor="#FFFFE8">
                <td colspan="3" class="style1" align="center">
                <?php echo $fair_name; if($fair_name=='Work Experience Fair'){ echo " - ".@$festType;} ?>
                <?php if($festType!='exhibition'){ ?>
				<br />Itemwise participants list with Code Number
                 <?php
				  }else
				  {
				  	echo "<br>School wise List with Code Number";
				  }
					?>
                </td>
            </tr>
            <?php
			if($festType!='exhibition'){ 
			?>
             <tr bgcolor="#FFFFE8">
        <td width="35%" height="35" align="left" class="fnt">&nbsp;</td>
        <td width="35%" align="left" class="fnt">Item  :&nbsp;&nbsp; <?php echo @$itemdet[0]['item_code'];?>&nbsp;-&nbsp;<?php echo @$itemdet[0]['item_name'];?>&nbsp;&nbsp;</td>
        <td width="38%" align="left" class="fnt">&nbsp;&nbsp;<?php  if(@$festdet[0]['fest_name']!='Exhibition'){ echo 'Festival : '.@$festdet[0]['fest_name'];}?></td>
  </tr>
  <?php
  }
  elseif($festType =='exhibition'){ 
  $charArr	=array(1 => 'LP' ,2 => 'UP' ,3 => 'HS' ,4 => 'HSS/VHSS' ); 
			?>
             <tr bgcolor="#FFFFE8">
        <td width="35%" height="35" align="left" class="fnt">&nbsp;</td>
        <td align="left" class="fnt">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        Festival  :&nbsp;&nbsp;<?php  echo @$charArr[$festid];?></td>
        <td align="center" class="fnt">&nbsp;</td>
          </tr>
  <?php
  }
	?>
    
        </table>


  <div align="center">      
<table width="80%" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr class="table_row_first">
        <td class="tb" width='20' align="center" style="border-top:0px #666666; border-right:1px #666666; padding:2px;">Sl.No.</td>
        <?php
		if($festType=='exhibition'){ 
		?>
        <td  class="tb" width='74' align="center" style="border-top:0px #666666; border-right:1px #666666; padding:2px;">School Code</td>
         <td class="tb" width='220' align="left" style="border-top:0px #666666; border-right:1px #666666; padding:2px;">&nbsp;&nbsp;School Name </td>
        <?php
		}
		else
		{?>
        <td  class="tb" width='74' align="center" style="border-top:0px #666666; border-right:1px #666666; padding:2px;">Reg No.</td>
         <td class="tb" width='220' align="left" style="border-top:0px #666666; border-right:1px #666666; padding:2px;">&nbsp;&nbsp;Name </td>
        <?php
		}
		?>
        
        <td  class="tb" width='102' align="center" style="border-top:0px #666666; border-right:1px #666666; padding:2px;">Code No.</td>
        
         <td  class="tb" width='52' align="center" style="border-top:0px #666666; border-right:1px #666666; padding:2px;">Absent</td>
       
        
      
  </tr>
    <?php    
	//echo '<br><br><br>';
	//print_r($partdata);
    $count	=	0;
	if(count($partdata) > 0)
	{
		$flag = 0;
		$chk_editflag = 0;
		//checking
			foreach($partdata as $chkdata)
			{
				if($chkdata['code_confirmed'] == 0 )
				{
					$chk_editflag = 1;
					break;
				}
			}
    foreach($partdata as $data)
    {
        $count++;
		if($festType=='exhibition')
		{	$id = $data['school_code'];$name = $data['school_name'];
			
		}
		else
		{	$id =	$data['participant_id'];$name = $data['participant_name'];
		}
		
		
		
    ?>
    <tr class="table_row_first">
        <td class="ety"  align="center" style="border-top:1px #666666; border-right:1px #666666; padding:2px;"><?php echo $count;?></td>
        <td  class="ety"  align="center" style="border-top:1px #666666; border-right:1px #666666; padding:2px;"><?php echo $id;?>
        <input type="hidden" name="txtPart_<?php echo $count;?>" value="<?php echo $id;?>" id="txtPart_<?php echo $count;?>" />
        
        </td>
         <td class="ety"  align="left" style="border-top:1px #666666; border-right:1px #666666; padding:2px;">&nbsp;&nbsp;<?php echo wordwrap($name,34,'<br>');?></td>
         <td  class="ety"  align="center" style="border-top:1px #666666; border-right:1px #666666; padding:2px;">
         <?php
		 if($data['code_confirmed'] == 0 && $data['codeGeneratedFlag'] == 1)
		{$flag = 1;
			?>
		     <input type="text" size="1"  name="txt_pre<?php echo $id;?>" id="txt_pre<?php echo $id;?>"value="<?php echo $data['prefixCode'];?>" readonly="readonly" />
         <input type="text" size="5"  name="txt_code<?php echo $id;?>" id="txt_code<?php echo $id;?>"value="<?php echo $data['codeNo'];?>"  maxlength="4"  onkeyup="javascript:check_alphanumericChar(this)"/>
         <?php
		}
		else if($data['code_confirmed'] == 1 && $data['codeGeneratedFlag'] == 0)
		{$flag = 1;
			?>
		     <input type="text" size="1"  name="txt_pre<?php echo $id;?>" id="txt_pre<?php echo $id;?>"value="<?php echo $data['prefixCode'];?>" readonly="readonly" />
         <input type="text" size="5"  name="txt_code<?php echo $id;?>" id="txt_code<?php echo $id;?>"value="<?php echo $data['codeNo'];?>"  maxlength="4"  onkeyup="javascript:check_alphanumericChar(this)"/>
         <?php
		}
		else if($data['code_confirmed'] == 0 && $data['codeGeneratedFlag'] == 0)
		{$flag = 1;
			?>
		     <input type="text" size="1"  name="txt_pre<?php echo $id;?>" id="txt_pre<?php echo $id;?>"value="<?php echo $data['prefixCode'];?>" readonly="readonly" />
         <input type="text" size="5"  name="txt_code<?php echo $id;?>" id="txt_code<?php echo $id;?>"value="<?php echo $data['codeNo'];?>"  maxlength="4"  onkeyup="javascript:check_alphanumericChar(this)"/>
         <?php
		}
		elseif($data['code_confirmed'] == 1 && $data['codeGeneratedFlag'] == 1 && $chk_editflag == 1)
		{$flag = 1;
			?>
		     <input type="text" size="1"  name="txt_pre<?php echo $id;?>" id="txt_pre<?php echo $id;?>"value="<?php echo $data['prefixCode'];?>" readonly="readonly" />
         <input type="text" size="5"  name="txt_code<?php echo $id;?>" id="txt_code<?php echo $id;?>"value="<?php echo $data['codeNo'];?>"  maxlength="4"  onkeyup="javascript:check_alphanumericChar(this)"/>
         <?php
		}
		elseif($data['code_confirmed'] == 1 && $data['codeGeneratedFlag'] == 1 && $chk_editflag == 0)
		{
			if($data['is_absent'] == 0 ){echo $data['prefixCode'].$data['codeNo'];}
		?>
		 <input type="hidden" size="1"  name="txt_pre<?php echo $id;?>" id="txt_pre<?php echo $id;?>"value="<?php echo $data['prefixCode'];?>" readonly="readonly" />
         <input type="hidden" size="5"  name="txt_code<?php echo $id;?>" id="txt_code<?php echo $id;?>"value="<?php echo $data['codeNo'];?>"  maxlength="4"/>
		
        <?php
		}
		?>
        
       
		 </td>
        <td align="center">
        <?php
		if($data['code_confirmed'] == 1 && $data['codeGeneratedFlag'] == 1 && $chk_editflag == 0)
		{
			if($data['is_absent'] == 1 ){echo "Absent";}
		}
		else
		{ if($data['is_absent'] == 1)
			$checked = "checked";
		   else
		   $checked = "";
			?>
			<input type="checkbox" name="chk_absent<?php echo $count;?>" id="chk_absent<?php echo $count;?>"  <?php echo $checked?> />
		<?php }
		
		?>
         
         </td>
     
  </tr>
    <?php 
    }
	}//if
	else
	{
		echo "<center>No data</center>";	
	}
    ?>
</table>
<?php
if($festType=='exhibition'){
 	$fair 	= $partdata[0]['fairId'];
	 $fest 	=  $festid;
	 $item 	=  $partdata[0]['fest_id'];
	 $details = $fair."__".$fest."__".$item;
	// echo "---".$details;
}
else
{
	$fair 	= $partdata[0]['fairId'];
	 $fest 	=  $partdata[0]['fest_id'];
	 $item 	=  $partdata[0]['item_code'];
	 $details = $fair."__".$fest."__".$item;
	 //echo "---".$details;
}

?>
      
        
        <?php if($flag == 0)
		{
		?>
        <br />
       <table align="center">
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
        <td>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="submit" name="btnSubmit" id="btnSubmit" value="Print"  onclick="javascript:printCodenumbers()">
        &nbsp;
         <input type="submit" name="btnreset" id="btnreset" value="Reset" onclick="javascript: return resetCodenumbers('<?php echo $details?>');" style="color:red">
        </td>
        
        </tr>
        </table>
          
      
        <?php
		}
		else
		{
		?>
         <input type="submit" name="btnconfirm" id="btnconfirm" value="Confirm" onclick="javascript: return confirmCodenumbers();">

        <?php
		}
		?>
        
        <input type="hidden"  name="cmbFairType" value="<?php echo $partdata[0]['fairId']?>" id="cmbFairType"/>
    <input type="hidden"  name="cmbCateType_hid" value="<?php echo $partdata[0]['fest_id']?>" id="cmbCateType_hid"/>
     <input type="hidden"  name="cmbfestId" value="<?php echo $festid?>" id="cmbfestId"/>
     <input type="hidden"  name="cbo_item" value="<?php echo @$partdata[0]['item_code']?>" id="cbo_item"/>
      <input type="hidden"  name="radioLabel" value="<?php echo "exhib";?>" id="cbo_item"/>
      <input type="hidden"  name="number" value="<?php echo $count;?>" id="number"/>
    
       </label>
</div>
</div>
		
<?php echo form_close();?>