<div align="center" class="heading_gray">
	<h3>Export Result Data</h3>
</div>
<br/>
<div class="container">
<?php
	echo form_open('', array('id' => 'export_dist_data'));
 
?>
	<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
		  <th align="left" colspan="2">
			Export Result Data for State Sasthramela
        </th>
        <tr>
			 <td class="table_row_first" align="left">
				Fair Name  
			</td>
            <td class="table_row_first" align="left">
				<?php echo form_dropdown("cmbFairType",$fair,'', 'class="input_box" id="cmbFairType" ');?>  
                <div id="work2" style="visibility:hidden;">
    
            &nbsp;<input type="radio" name="radioLabel" value="0" id="radioLabel_spot" checked="checked" onClick="sel_type(this.value,this.form)" >
                On the Spot</label>
            <input type="radio" name="radioLabel" value="1" id="radioLabel_exhib" onClick="sel_type(this.value)" >
                Exhibition</label>
    
   
    </div>  
			</td>
		</tr>
		<tr>
			<td colspan="2" class="table_row_first" align="left">
				<input type="hidden" name="hidExport" id="hidExport" />
                <input type="hidden" name="hidworktype" id="hidworktype" value=0 />
				<?php print(form_button('data_export','Export Data','onClick="javascript:fncExportDistrictData();return false;"'));?>
			</td>
		</tr>
	</table>
<?php

	echo form_close();
?>
</div>