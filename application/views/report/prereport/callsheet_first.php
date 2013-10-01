<div align="center" class="heading_gray">
<h3>Code Generation</h3>
</div>
<br />
<div class="container">
<?php echo form_open('report/prereportpdf/callsheet_report', array('id' => 'callsheet','name' => 'callsheet','target'=>'_blank'));
$fair_type	=	$this->session->userdata('FAIR_TYPE');
$fair_name	= $this->General_Model->get_data('science_master', '*', array('fairId'=>$fair_type));
?>

<input type="hidden" name="hidUserId" id="hidUserId" />
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="5" align="left">Call Sheet :(Item)</th>
  </tr>
  <tr>
    <td width="10%" class="">&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fair : </td>
    <td align="left" width="55%" class="table_row_first"><?php 
	if(($this->session->userdata('USER_GROUP') == 'A') or ($this->session->userdata('USER_GROUP') == 'W'))
	echo form_dropdown("cmbFairType",$fair,'', 'class="input_box" id="cmbFairType"   onclick="javascript:check_for_workexpo3(this.value,2)"'  );
	else {
		echo $fair_name[0]['fairName']; ?>
        
	    <input type="hidden" id="cmbFairType"	 name="cmbFairType" value="<? echo $fair_type;?>" /> 
        <? } 
	
	?>
      <div id="work2" style="visibility:hidden;">
    
    <input type="radio" name="radioLabel" value="spot" id="radioLabel_spot" checked="checked" onClick="selectCat2(this.value,this.form)" >
        On the Spot</label>
    <input type="radio" name="radioLabel" value="exhib" id="radioLabel_exhib" onClick="selectCat(this.value,this.form)" >
        Exhibition</label>
    </div>
 <td width="18%">&nbsp;</td>
    <td width="18%">&nbsp;</td>
  </tr>
   <tr>
    <td width="10%" class="">&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Category : </td>
    <td align="left" width="55%" class="table_row_first"><?php echo form_dropdown("cmbCateType",$pfest,'', 'class="input_box" id="cmbCateType" onchange="javascript:fetch_item_from_festival(this.value)" onclick="javascript:fetch_item_from_festival(this.value)"'  );?></td>
    <td width="18%">&nbsp;</td>
    <td width="18%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Item Name : </td>
  
    <td align="left" width="55%" class="table_row_first"><div id="cmbitem"><?php echo form_dropdown("cbo_item",array('select'),'', 'class="input_box" id="cbo_item" '  );?></div></td>
    <td width="18%">&nbsp;</td>
    <td width="18%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="27%" class="table_row_first">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="left" width="55%" class="table_row_first">      <label>
   
      <?php // echo form_submit('Report', 'Report', $jvscript);?>
              <input type="submit" onclick="javacript: return callsheetfirst('code')" name="AddCode" id="AddCode"  value="Add Code"/>
                              
       
               <input type="hidden"  name="cmbCateType_hid" value="1" id="cmbCateType_hid"/>
           <input type="hidden"  name="cmbfestId" value="0" id="cmbfestId"/>
        </label>
    </form>    </td>
    <td width="18%">&nbsp;</td>
    <td width="18%">&nbsp;</td>
  </tr>
  <tr>
  <td height="51"  >&nbsp;</td>
  <td colspan="2"  class="table_row_first"><table align="center">
    <tr>
      <td> Number of Code per page : </td>
      <td><select name="print_no" id="print_no" >
        <option value="4">4</option>
        <option value="6">6</option>
        <option value="8" selected="selected">8</option>
      </select></td>
      <td>&nbsp;&nbsp;&nbsp;
        <input type="submit" name="btnPrint" id="btnPrint" value="Print code number" onclick="javascript:return printCode3()" /></td>
    </tr>
  </table></td>
  <td >&nbsp;</td>
  <td >&nbsp;</td>
  </tr>
  
  <tr>
    <td align="center" colspan="5">&nbsp;</td>
  </tr>
</table>


<?php
echo form_close();
?>
</div>

<?php
if(@$codeCreation == "yes")
{
	$this->load->view('report/prereport/callsheet_code',$code);
	
	
}


?>