<style>
.style1{
font-size:12px;
font-weight:bold;
color:#AC3C0B;

}
.style2{
font-size:12px;
font-weight:bold;
color:#A76830;
}

.style4{
font-size:12px;
color:#A76830;
}
.style5{
font-size:16px;
color:#0033FF;
}
.style6 {
	color: #0033FF;
	font-weight: bold;
}
</style>
<br>

<div align="center" class="heading_gray">
<h3>Publish Result</h3>
</div>
<br />

<? echo form_open('', array('id' => 'festrep','name'=>'festrep','target'=>'_blank')); 
$fair_type	=	$this->session->userdata('FAIR_TYPE');
$fair_name	= $this->General_Model->get_data('science_master', '*', array('fairId'=>$fair_type));
?>


<div class="container">
<br />
<?php  

		$rank[1]=1;
		$rank[2]=2;
		$rank[3]=3;
		$rank['ALL']='All Rank';
		/*$cur_date	=	date('Y-m-d');
		$date_array[$cur_date]	=	date('j M Y',strtotime($cur_date));
		echo "<br /><br /><br />".$date_array;*/
?>
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="6" align="left">Result Number Wise</th>
  </tr>
   <tr>
    <td width="3%" height="39" class="">&nbsp;</td>
    <td align="left" width="18%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Fair Name: </td>
    <td align="left" width="39%" class="table_row_first"><?php 
	if(($this->session->userdata('USER_GROUP') == 'A') or ($this->session->userdata('USER_GROUP') == 'W'))
	echo form_dropdown("cmbFairType",$fair,@$selected_fair_id, 'class="input_box" id="cmbFairType" onclick="javascript:check_workexpo_4result(this.value)"  onchange="javascript:check_workexpo_4result(this.value)"');
	else {
		echo $fair_name[0]['fairName']; ?>
        
	    <input type="hidden" id="cmbFairType"	 name="cmbFairType" value="<? echo $fair_type;?>" /> 
      <? } 
	
	?></td>
    
    <td align="left" colspan="3" width="40%" class="table_row_first">
    
    <div id="work" style="display:<?php echo (@$fair_type==4)?'block':'none';?>;">    
              
    <input type="radio" name="radioLabel" value="all" id="radioLabel_all" checked="checked" onClick="selectCat2(this.value,this.form)" /><label>
        Aggregate</label>
    <input type="radio" name="radioLabel" value="spot" id="radioLabel_spot"  onClick="selectCat2(this.value,this.form)" /><label>
        On the Spot</label>
    <input type="radio" name="radioLabel" value="exhib" id="radioLabel_exhib" onClick="selectCat2(this.value,this.form)" /><label>
        Exhibition</label>
    </div>    </td>
  </tr>
    
  <tr>
    <td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     </td>
    </tr>
  
  <tr>
    <td align="center" colspan="5">&nbsp;</td>
  </tr>
</table>
<input type="hidden" name="hidUserId" id="hidUserId" />

<?php
//itemwise_report_interface

?>
</div>

<div align="center" >
<div align="center" class="style5"><b>RESULT</b></div> 
<br /><div id="onspot" style="visibility:hidden;"><table width="728" align="center">
  <tr><td width="720" align="left"><span class="style6">
On the Spot</span></td>
</tr></table></div>
	<table width="55%"  align="center" border="1">
  
  <input type="hidden" id="hidfestId" name="hidfestId" value="">
  
  		<?php
		$bg=0;
		foreach($fest as $key){
		
		if($bg==0){
						$bgcolor="#CFE4EB";
						$bg=1;
						}
					else{
						$bgcolor="#E6EFF7";
						$bg=0;
					}
?>
  <tr bgcolor=" <?php echo $bgcolor; ?>">
			
   	  		 <td width="100" height="25" class="style2">&nbsp;&nbsp;<?php echo $key['fest_name']; ?></td>
<td width="149" align="center" class="style1">
             <a href="javascript:void(0)"  onClick="javascript:clickresultdeclered('<?php echo $key['fest_id']; ?>')">
           		Result - Declared</a></td>
    <td width="134" align="center" class="style1"><a href="javascript:void(0)" onClick="javascript:return cickpointdeclared('<?php echo $key['fest_id']; ?>')" >Points - School</a></td>
    <!--<td width="134" align="center" class="style1"><a href="javascript:void(0)" onClick="javascript:return cickchampiondeclared('<?php echo $key['fest_id']; ?>')" >Champions</a></td>-->
  </tr>
  
  		<?php
		}
		?>
         <!--<tr bgcolor="#FCDCF5">
			
   	  		 <td width="100" height="25" class="style2">&nbsp;&nbsp;All Festival </td>
<td width="149" align="center" class="style1">
             <a href="../allresults" target="_blank">
           		Result - Declared</a></td>
    <td width="134" align="center" class="style1"><a href="../allfestschools" target="_blank">Points - School</a></td>
  </tr>-->
        
 </table>
<br />
<div id="exibdiv" style="visibility:hidden;"><table width="728" align="center">
<?php $exibfest=0; ?>
  <tr><td width="720" align="left"><span class="style6">Exhibition</span></td>
</tr></table>
<table width="732" border="1">
  <tr>
    <td width="185" class="style2">&nbsp;&nbsp;All Fest </td>
    <td width="277" align="center" class="style1"><a href="javascript:void(0)"  onclick="javascript:clickresultdeclered('<?php echo $exibfest; ?>')">Result - Declared</a></td>
    <td width="248" align="center" class="style1"><a href="javascript:void(0)" onclick="javascript:return cickpointdeclared('<?php echo $exibfest; ?>')" >Points - School</a></td>
  </tr>
</table>
</div>
 <br />
	<table width="55%" align="center" border="1">
        	<tr bgcolor="#D5E1A8">
        		<td colspan="4" height="29" align="center" valign="bottom" class="style4"><a href="javascript:void(0)" onClick="javascript:clickallresults()" > All Results </a></td>
	  </tr>
      <tr bgcolor="#D5E1A8">
        		<td colspan="4" height="29" align="center" valign="bottom" class="style4"><a href="javascript:void(0)" onClick="javascript:clickoverallchampions()" > Overall champion </a></td>
	  </tr>
      	   <tr bgcolor="#D5E1A8">
        		<td colspan="4" height="37" align="center" class="style4"><a href="javascript:void(0)"   onClick="javascript:clickfest_stat()" > Status of Festival </a></td>
	  </tr>
	</table>
</div>
	<?php
	echo form_close();
	?>
	<br>
<br>
