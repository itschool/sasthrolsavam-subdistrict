
<style>
.style1{
font-size:12px;
color:#9D2615;
font-weight:bold;
}

</style>
<br>
<br>
<br>
<div align="center">
	<?php
	if(count($details1)>0){
	
	 echo form_open('', array('id' => 'festdet','name'=>'festdet','target'=>'_blank'));
	 
	?>
    <input type="hidden" name="hidfestid" id="hidfestid" value="" />
    <input type="hidden" name="hidfairid" id="hidfairid" value="<? echo $fairname[0]['fairId']; ?>" />
<table width="65%" border="1" align="center" style=" border-top:1px black; border-left:1px black; border-right:1px black;" cellpadding="0" cellspacing="0">
 
 	<tr bgcolor="#D6D6D6">
 		<td colspan="3" height="27" align="center" class="style1">STATUS OF COMPLETION OF ITEMS (<? echo $fairname[0]['fairName']; ?>)</td>
    </tr>
  <tr bgcolor="#CCDDEA">
	   <td width="37%" height="24" align="center"  >Festival (Item Total)</td>
    <td width="28%" align="center">Items Completed</td>
   		 <td width="35%" align="center">Items not Completed</td>
 	 </tr>
			 <?php
			 $flag=0;$firstnotzero=$firstzero=0;
			 $bg=0;
             foreach($details1 as $value){
			 
			 	for($j=0;$j<count($details2);$j++){
				
					if($value['fest_id']==$details2[$j]['fest_id']){
					
						$finished_item=$details2[$j]['pcode'];
						$flag=1;
						}
					}
					
				if($flag==0) $finished_item=0;
             		$remind=$value['cnt']-$finished_item;
					if($bg==0){
						$bgcolor="#CFE4EB";
						$bg=1;
						}
					else{
						$bgcolor="#E6EFF7";
						$bg=0;
					}
				//echo '------>'.$value['fest_name'];
				if($value['fest_name']!='Exhibition'){	
				if($firstnotzero!=1 && $fairname[0]['fairName']=='Work Experience Fair'){
				$firstnotzero	=	1;
				echo "<tr><td colspan=3 style='color:#9D2615;font-weight:bold;'>&nbsp;On the Spot</td></tr>";
				}
             ?>
            <tr bgcolor="<?php echo $bgcolor; ?>">
                <td height="31">&nbsp;&nbsp;&nbsp;
                <?php if($value['cnt']!=0){ ?>
                 <a href="javascript:void(0)"  onClick="javascript:clicktoviewfestdet('<?php echo $value['fest_id']; ?>')">
                <?php echo $value['fest_name']; ?>(<?php echo $value['cnt']; ?>)</a>
                <?php } 
				else { 
                echo $value['cnt'];  } ?>
				</td>
              <td align="center"><?php if($finished_item!=0){ ?>
               <a href="javascript:void(0)"  onClick="javascript:finisheditemdet('<?php echo $value['fest_id']; ?>')"><?php echo $finished_item; ?></a>
               <?php } else { echo 0;  }?></td>
                <td align="center"><?php if($remind!=0){ ?>
                 <a href="javascript:void(0)"  onClick="javascript:remainderitemdet('<?php echo $value['fest_id']; ?>')"><?php echo $remind; ?></a> 
                 <?php } else { echo 0; } ?>
           
                 </td>
            </tr>
            <?php } else{//if($value['fest_id']!=0)
				if($firstzero!=1){
				$firstzero	=	1;
				echo "<tr><td colspan=3 style='color:#9D2615;font-weight:bold;'>&nbsp;Exhibition</td></tr>";
				}
			?>
			<tr bgcolor="<?php echo $bgcolor; ?>">
                <td height="31">&nbsp;&nbsp;&nbsp;
                <?php if($value['cnt']!=0){ ?>
                 <a href="javascript:void(0)"  onClick="javascript:clicktoviewfestdet('<?php echo $value['fest_id']; ?>')">
                <?php //echo $value['fest_name']; ?>All(<?php echo $value['cnt']; ?>)</a>
                <?php } 
				else { 
                echo $value['cnt'];  } ?>
				</td>
              <td align="center"><?php if($finished_item!=0){ ?>
               <a href="javascript:void(0)"  onClick="javascript:finisheditemdet('<?php echo $value['fest_id']; ?>')"><?php echo $finished_item; ?></a>
               <?php } else { echo 0;  }?></td>
                <td align="center"><?php if($remind!=0){ ?>
                 <a href="javascript:void(0)"  onClick="javascript:remainderitemdet('<?php echo $value['fest_id']; ?>')"><?php echo $remind; ?></a> 
                 <?php } else { echo 0; } ?>
           
                 </td>
            </tr>
			<?php }
			$flag=0;
            }
            ?>
</table>
	<?php
	echo form_close();
	}
	else{
	?>
    <div align="center">Festival not started</div>
    
    <?php
	}
	?>
</div>