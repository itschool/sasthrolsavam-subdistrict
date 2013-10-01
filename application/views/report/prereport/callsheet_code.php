<style type="text/css">
<!--
.style1 {
	font-size: 15px;
	font-weight: bold;
	color: #660033;
}
.style2{
	font-size: 11px;
	font-weight: bold;
	color:#000000;
}
.style3
{font-size: 13px;
}
.style4{
	font-size: 8px;
	font-weight: bold;
	color:#000000;
}
.style8{
	font-size: 12px;
	color:#CC3300;
	font-family:"Times New Roman";
	background-color:#FFF;
}
.style9 {
	font-size: 20px;
	font-weight: bold;
	color: #660033;
	background-color:#FFF;
}
.style10{
	font-size: 13px;
	color:#000000;
	background-color:#E6F7F5;
}
.alt{
	font-size: 13px;
	color:#000000;
	background-color:#FFF;
}
.textbox
{
	border:#FFF;
	background-color:transparent;
	
	
}

-->
</style>

		
	
  
<br />
<div class="container">   
<?php echo form_open('report/prereport/callsheet_save/0', array('id' => 'callsheetcode','name' => 'callsheetcode'));
?>
<?php

 $read = '';
 $flag = 0;
   if(count($fees_details)>0){
		for($j=0; $j<count($fees_details); $j++)
		{
			if($fees_details[$j]['code_confirmed'] == 1 )
			{
				//echo "-------------";
				$flag = 1;
				$read = 'readonly';
				break;
			}
		}//for
   }//if
				?>
        
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="9" align="left">Call Sheet :(Code Entry)</th>
  </tr>   
   <tr>
   	  <td  height="27" colspan="5" align="center"><b><?php echo $fair_name; ?>&nbsp;(<?php echo $fees_details[0]['fest_name']; ?>)<br /><?php echo $fees_details[0]['item_code'].' - '.$fees_details[0]['item_name']; ?></b>
      </td>
    </tr>
   <tr bgcolor="#E6F7F5">
   <td width="144" height="44" align="left">&nbsp;&nbsp;Enter Prefix code<br /> (should be 2 characters) :
   </td>
   <td width="56"><span style="border-top:1px #666666; border-right:1px #666666; padding:2px;">
     <input type="text" size="5" name="prefixCode" class="inputbox" maxlength="5" onkeyup="javascript:this.value=this.value.toUpperCase();" id="prefixCode" value="<?php echo @$fees_details[0]['prefixCode']?>" <?php echo @$read;?> />
   </span></td>
   <td width="108">Starting Number</td>
   <td width="88">
   <?php if(@$read != '')
   {?>
   <input type="text" size="5" name="start_no" class="inputbox" maxlength="4"  id="start_no" value="<?php echo @$fees_details[0]['start_number']?>" <?php echo @$read;?>  />
   <?php
   }
   else
   { ?>
   <input type="text" size="5" name="start_no" class="inputbox" maxlength="4"  onKeyPress="javascript:return numbersonly(this, event, false);" onBlur="addPrefix(this.value)" id="start_no" value="<?php echo @$fees_details[0]['start_number']?>" <?php echo @$read;?>  />
   <?php
   }
   ?>
   
   </td>
   <td width="287">
     <?php
 if($flag == 1 )
 {
	 $fair 	= $fees_details[0]['fairId'];
	 $fest 	=  $fees_details[0]['fest_id'];
	 $item 	=  $fees_details[0]['item_code'];
	 $details = $fair."__".$fest."__".$item;
	 ?>
	  <div><!--<a href='<?php echo base_url()?>index.php/report/prereport/print_code_number/<?php echo $details?>' target="_blank"><font style="font-size:16px;" color='red'>Click here to print code number</font></a>-->
       <input type="submit" name="btnPrint" id="btnPrint" value="Click here to print code number" onclick="javascript:printCode2('<?php echo $details?>')" >
      </div>
 <?php }
 ?>
   </td>
   
   </tr>
   
    
</table>

<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
  
  <tr bgcolor="#FFFFE8">
    <td width="6%"height="30" rowspan="2" align="center"  style="border-right:1px #666666; padding:2px;">&nbsp;<b>Sl.No</b></td>
    <td width="18%"  height="25" rowspan="2" align="center"  style="border-right:1px #666666; padding:2px;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Registration No.</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td width="19%"  height="25" rowspan="2" align="center"  style="border-right:1px #666666; padding:2px;" >&nbsp;&nbsp;&nbsp;&nbsp;<b>Participant Name</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td width="9%"  height="25" rowspan="2" align="center"  style="border-right:1px #666666; padding:2px;" >&nbsp;</td>
    <td  height="12" colspan="4" align="center" style="border-right:1px #666666; padding:2px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Code No</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td width="19%"  height="25" rowspan="2" align="center" style="border-right:1px #666666; padding:2px;">&nbsp;</td>
   
  </tr>
  <tr bgcolor="#FFFFE8">
    <td width="6%"  height="13" align="center" style="border-right:1px #666666; padding:2px;">&nbsp;</td>
    <td width="8%"  height="13" align="center" style="border-right:1px #666666; padding:2px;">Prefix</td>
    <td width="7%"  height="13" align="center" style="border-right:1px #666666; padding:2px;">Code</td>
    <td width="8%"  height="13" align="center" style="border-right:1px #666666; padding:2px;">&nbsp;</td>
  </tr>
 
  
   <?php
   $s=0; $quato_dash_flag=0;
   $confrmFlagbut = 0;
   $confrmFlag =0;
   $read = '';
   if(count($fees_details)>0){
		for($j=0; $j<count($fees_details); $j++){
		
				if($fees_details[$j]['codeNo'] != 0 || $fees_details[$j]['codeNo'] != '')
				{
					$confrmFlagbut = 1;
				}
				if($fees_details[$j]['code_confirmed'] == 1 )
				{
					$confrmFlag = 1;
					$read = 'readonly';
				}
				if($fees_details[$j]['spo_id']!=0)
				{
				$quato_dash_flag=1;
					if($fees_details[$j]['is_publish']=='Y'){
					$quato_dash='*';
					}
					else {
					$quato_dash='**';
					}
				}
				else{
				
			$quato_dash='&nbsp;';
				}
				
				if($s % 2 == 0)
				{
					$class = 'class = "alt"';
				}
				else
				{
					$class = 'class = "style10"';
				}
				if($fees_details[$j]['is_captain']=='Y'){
					$s++;
					if($s > 1)
					 {
						echo "</table></td></tr>";
					 }
				?>	
				<tr>
                 <td colspan='9'  <?php echo $class?> > 
                <table border='0' width='100%' cellpadding="0" cellspacing="0" >
		<?php }
		
		?>
		 
  <tr>
    <td width="8%" height="35"  align="center" style="border-top:1px #666666; border-right:1px #666666; padding:2px;" ><?php if($fees_details[$j]['is_captain']=='Y'){echo $s;} ?></td>
    <td width="11%"   align="center" style="border-top:1px #666666; border-right:1px #666666; padding:2px;"><?php echo $fees_details[$j]['participant_id'].'   '.$quato_dash; ?> </td>
    <td width="8%"   align="left" style="border-top:1px #666666; border-right:1px #666666; padding:2px;"  >&nbsp;</td>
    <td width="30%"   align="left" style="border-top:1px #666666; border-right:1px #666666; padding:2px;"  ><?php echo $fees_details[$j]['participant_name']; ?></td>
    <td  width="2%" style="border-top:1px #666666; border-right:1px #666666; padding:2px;"    align="center">&nbsp;</td>
    <td  width="7%" style="border-top:1px #666666; border-right:1px #666666; padding:2px;"   align="center">
    <?php if($fees_details[$j]['is_captain']=='Y'){?>
    <input type="hidden" size="2" name="reg_<?php echo $s?>" class="textbox" value="<?php echo $fees_details[$j]['participant_id']?>" id="reg_<?php echo $s?>" /> 
   <div id="prefix_<?php echo $s?>">
   <?php echo @$fees_details[0]['prefixCode']?>
   </div>
   <?php
	}//if ?>
    </td>
    <td  width="8%" style="border-top:1px #666666; border-right:1px #666666; padding:2px;"   align="center">
    <?php if($fees_details[$j]['is_captain']=='Y'){?>
    <input type="text" size="5" name="code_<?php echo $fees_details[$j]['participant_id'];?>" class="inputbox" id="code_<?php echo $fees_details[$j]['participant_id'];?>" value="<?php echo @$fees_details[$j]['codeNo']?>"  maxlength="4" onkeyup="javascript:this.value=this.value.toUpperCase();" onblur="isAlphanumeric(this,<?php echo $fees_details[$j]['participant_id'];?>)" <?php echo @$read;?> />
    <?php
	}//if ?>
      <input type="hidden"  name="teamno_<?php echo $fees_details[$j]['participant_id'];?>" value="<?php echo $fees_details[$j]['team_no']?>" id="teamno_<?php echo $fees_details[$j]['participant_id'];?>"/>	
       <input type="hidden"  name="schoolCode_<?php echo $fees_details[$j]['participant_id'];?>" value="<?php echo $fees_details[$j]['school_code']?>" id="schoolCode_<?php echo $fees_details[$j]['participant_id'];?>"/>
     
    
    </td>
    <td  width="7%" style="border-top:1px #666666; border-right:1px #666666; padding:2px;"   align="center">
    <?php 
	if($fees_details[$j]['is_absent'] == 1)
	{	if($fees_details[$j]['is_captain']=='Y')
		{
		?>
        <font color="#FF0000">Absent</font>
     <?
		}
	}	
	?>
    </td>
    <td  width="19%" style="border-top:1px #666666; border-right:1px #666666; padding:2px;"    align="center">&nbsp;</td>
  
  </tr>
  <? } 
	  }
	?>
 <tr align="center" >
 <td height="28" colspan="9" <?php echo $class?>>
 <?php 
 $jvscript = "onclick='javascript: return chkFields(0)'";
 if($confrmFlag == 0 )
 {
 echo form_submit('Save', 'Save', @$jvscript);
 }
 if($confrmFlag == 0 && $confrmFlagbut == 1)
 {
	 $jvscriptc = "onclick='javascript: return chkFields(1)'";
	  echo "&nbsp;&nbsp;&nbsp;".form_submit('Confirm', 'Confirm',@$jvscriptc);
 }
 if($confrmFlag == 1 )
 {
 echo "Already Confirmed!!!!!";
 $jvscriptr = "onclick='javascript: return resetCode()'";
  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;". form_submit('Reset', 'Reset', @$jvscriptr);

 }
 ?>
  <input type="hidden"  name="item_no" value="<?php echo $s?>" id="item_no"/>
   <input type="hidden"  name="cmbFairType" value="<?php echo $fees_details[0]['fairId']?>" id="cmbFairType"/>
    <input type="hidden"  name="cmbCateType" value="<?php echo $fees_details[0]['fest_id']?>" id="cmbCateType"/>
     <input type="hidden"  name="cbo_item" value="<?php echo $fees_details[0]['item_code']?>" id="cbo_item"/>
    
 </td>
  
 </tr>
 <tr>
 <td colspan="9"  align="center">
 <?php
 if($confrmFlag == 1 )
 {
	?>
      <input type="submit" name="btnPrint" id="btnPrint" value="Click here to print code number" onclick="javascript:printCode2('<?php echo $details?>')" >
    <?php
	
 }
 ?>
   <input type="hidden"  name="print_no" value="8" id="print_no"/>
 </td>
 
 </tr>
  </table>
 </td></tr>
</table>
<?php
echo form_close();
?>
<div class="style8">
  <span class="style9">* </span> <span class="style8">Special Order Entry (Result to be declared) </span>
<div style="clear:both"></div>
    <span class="style9"> ** </span>
  <span class="style8">Special Order Entry (Result to be Withheld)</span>
</div>
</div>

       
		
		