<div align="center" class="heading_gray">
<h3><?php 
if(@$fairId==1){ echo 'Science Fair Certificate Template';}else if(@$fairId==2){ echo 'Mathematics Fair Certificate Template';}else if(@$fairId==3){ echo 'Social Science Fair Certificate Template';}else if(@$fairId==4){ echo 'Work Experience Fair Certificate Template';}else{ echo 'IT Fair Certificate Template';}?></h3>
</div>
<br />

<div class="container">
<br />

<?php 
echo form_open('certificate/certificate/save_participant_certificate_template/', array('id' => 'formCertificate'));
?>

<input type="hidden" name="fairtype" id="fairtype" value="<?php echo @$fairId;?>"/>

<table width="100%" cellpadding="4" cellspacing="0" border="0" class="heading_tab">
	<tr>
	  <th align="left">&nbsp;</th>
	  <th align="left">&nbsp;</th>
	  <th align="center">&nbsp;</th>
	  <th align="center">&nbsp;</th>
	  <th colspan="3" align="right" ><a href="<?php echo base_url();?>index.php/certificate/certificate/certificate_template_graphoical" title="Certificate - Template" ></a></th>
  </tr>
	<tr>
    	<th align="left" width="2%">&nbsp;</th>
        <th align="left" width="15%">&nbsp;</th>
        <th align="center" width="15%">
        	From Left        </th>
        <th align="center" width="15%">
        	From Top        </th>
        <th align="center" width="15%" >
        	Font        </th>
        <th align="center" width="15%" >
        	Size        </th>
        <th align="left" width="23%">&nbsp;</th
    ></tr>
    <tr>
        <td align="left"  class="table_row_first">&nbsp;</td>
    	<td align="left" class="table_row_first">
        	Fair</td>
        <td align="center" class="table_row_first">
        	<?php echo form_input('txtFairX',@$certificate_template[0]['fair_x'],'id="txtFairX" class="input_box_small" maxlength="3" onkeypress="javascript:return numbersonly(this, event, false);"')?>        </td>
        <td align="center" class="table_row_first">
        	<?php echo form_input('txtFairY',@$certificate_template[0]['fair_y'],'id="txtFairY" class="input_box_small" maxlength="3" onkeypress="javascript:return numbersonly(this, event, false);"')?>        </td>
        <td align="center" class="table_row_first">
        	<?php echo form_dropdown('cboFairFont',$font_array,@$certificate_template[0]['fair_font'],'id="cboFairFont" class="select_box_medium"')?>        </td>
         <td align="center" class="table_row_first">
        	<?php echo form_dropdown('cboFairSize',$font_size_array,@$certificate_template[0]['fair_size'],'id="cboFairSize" class="input_box_small"')?>        </td>
        <td align="left" class="table_row_first">&nbsp;</td>
    </tr>
    <tr>
        <td align="left"  class="table_row_first">&nbsp;</td>
    	<td align="left" class="table_row_first">
        	Name        </td>
        <td align="center" class="table_row_first">
        	<?php echo form_input('txtNameX',@$certificate_template[0]['name_x'],'id="txtNameX" class="input_box_small" maxlength="3" onkeypress="javascript:return numbersonly(this, event, false);"')?>        </td>
        <td align="center" class="table_row_first">
        	<?php echo form_input('txtNameY',@$certificate_template[0]['name_y'],'id="txtNameY" class="input_box_small" maxlength="3" onkeypress="javascript:return numbersonly(this, event, false);"')?>        </td>
        <td align="center" class="table_row_first">
        	<?php echo form_dropdown('cboNameFont',$font_array,@$certificate_template[0]['name_font'],'id="cboNameFont" class="select_box_medium"')?>        </td>
         <td align="center" class="table_row_first">
        	<?php echo form_dropdown('cboNameSize',$font_size_array,@$certificate_template[0]['name_size'],'id="cboNameSize" class="input_box_small"')?>        </td>
        <td align="left" class="table_row_first">&nbsp;</td>
    </tr>
    
    <tr>
    	<td align="left"  class="table_row_first">&nbsp;</td>
        <td align="left" class="table_row_first">
        	Item        </td>
        <td align="center" class="table_row_first">
        	<?php echo form_input('txtItemX',@$certificate_template[0]['item_x'],'id="txtItemX" class="input_box_small" maxlength="3" onkeypress="javascript:return numbersonly(this, event, false);"')?>        </td>
        <td align="center" class="table_row_first">
        	<?php echo form_input('txtItemY',@$certificate_template[0]['item_y'],'id="txtItemY" class="input_box_small" maxlength="3" onkeypress="javascript:return numbersonly(this, event, false);"')?>        </td>
        <td align="center" class="table_row_first">
        	<?php echo form_dropdown('cboItemFont',$font_array,@$certificate_template[0]['item_font'],'id="cboItemFont" class="select_box_medium"')?>        </td>
         <td align="center" class="table_row_first">
        	<?php echo form_dropdown('cboItemSize',$font_size_array,@$certificate_template[0]['item_size'],'id="cboItemSize" class="input_box_small"')?>        </td>
        <td align="left" class="table_row_first">&nbsp;</td>
    </tr>
    
    <tr>
    	<td align="left"  class="table_row_first">&nbsp;</td>
        <td align="left" class="table_row_first">
        	Category        </td>
        <td align="center" class="table_row_first">
        	<?php echo form_input('txtCategoryX',@$certificate_template[0]['category_x'],'id="txtCategoryX" maxlength="3" class="input_box_small" onkeypress="javascript:return numbersonly(this, event, false);"')?>        </td>
        <td align="center" class="table_row_first">
        	<?php echo form_input('txtCategoryY',@$certificate_template[0]['category_y'],'id="txtCategoryY" maxlength="3" class="input_box_small" onkeypress="javascript:return numbersonly(this, event, false);"')?>        </td>
        <td align="center" class="table_row_first">
        	<?php echo form_dropdown('cboCategoryFont',$font_array,@$certificate_template[0]['category_font'],'id="cboCategoryFont" class="select_box_medium"')?>        </td>
         <td align="center" class="table_row_first">
        	<?php echo form_dropdown('cboCategorySize',$font_size_array,@$certificate_template[0]['category_size'],'id="cboCategorySize" class="input_box_small"')?>        </td>
        <td align="left" class="table_row_first">&nbsp;</td>
    </tr>
    
    <tr>
     	<td align="left"  class="table_row_first">&nbsp;</td>
    	<td align="left" class="table_row_first">
        	Grade        </td>
        <td align="center" class="table_row_first">
        	<?php echo form_input('txtGradeX',@$certificate_template[0]['grade_x'],'id="txtGradeX" class="input_box_small" maxlength="3" onkeypress="javascript:return numbersonly(this, event, false);"')?>        </td>
        <td align="center" class="table_row_first">
        	<?php echo form_input('txtGradeY',@$certificate_template[0]['grade_y'],'id="txtGradeY" class="input_box_small" maxlength="3" onkeypress="javascript:return numbersonly(this, event, false);"')?>        </td>
        <td align="center" class="table_row_first">
        	<?php echo form_dropdown('cboGradeFont',$font_array,@$certificate_template[0]['grade_font'],'id="cboGradeFont" class="select_box_medium"')?>        </td>
         <td align="center" class="table_row_first">
        	<?php echo form_dropdown('cboGradeSize',$font_size_array,@$certificate_template[0]['grade_size'],'id="cboGradeSize" class="input_box_small"')?>        </td>
        <td align="left" class="table_row_first">&nbsp;</td>
    </tr>
    
    <tr>
     	<td align="left"  class="table_row_first">&nbsp;</td>
    	<td align="left" class="table_row_first">
        	Class        </td>
        <td align="center" class="table_row_first">
        	<?php echo form_input('txtClassX',@$certificate_template[0]['class_x'],'id="txtClassX" class="input_box_small" maxlength="3" onkeypress="javascript:return numbersonly(this, event, false);"')?>        </td>
        <td align="center" class="table_row_first">
        	<?php echo form_input('txtClassY',@$certificate_template[0]['class_y'],'id="txtClassY" class="input_box_small" maxlength="3" onkeypress="javascript:return numbersonly(this, event, false);"')?>        </td>
        <td align="center" class="table_row_first">
        	<?php echo form_dropdown('cboClassFont',$font_array,@$certificate_template[0]['class_font'],'id="cboClassFont" class="select_box_medium"')?>        </td>
         <td align="center" class="table_row_first">
        	<?php echo form_dropdown('cboClassSize',$font_size_array,@$certificate_template[0]['class_size'],'id="cboClassSize" class="input_box_small"')?>        </td>
        <td align="left" class="table_row_first">&nbsp;</td>
    </tr>
    
    <tr>
     	<td align="left"  class="table_row_first">&nbsp;</td>
    	<td align="left" class="table_row_first">
        	School        </td>
        <td align="center" class="table_row_first">
        	<?php echo form_input('txtSchoolX',@$certificate_template[0]['school_x'],'id="txtSchoolX" maxlength="3" class="input_box_small" onkeypress="javascript:return numbersonly(this, event, false);"')?>        </td>
        <td align="center" class="table_row_first">
        	<?php echo form_input('txtSchoolY',@$certificate_template[0]['school_y'],'id="txtSchoolY" maxlength="3" class="input_box_small" onkeypress="javascript:return numbersonly(this, event, false);"')?>        </td>
        <td align="center" class="table_row_first">
        	<?php echo form_dropdown('cboSchoolFont',$font_array,@$certificate_template[0]['school_font'],'id="cboSchoolFont" class="select_box_medium"')?>        </td>
         <td align="center" class="table_row_first">
        	<?php echo form_dropdown('cboSchoolSize',$font_size_array,@$certificate_template[0]['school_size'],'id="cboSchoolSize" class="input_box_small"')?>        </td>
        <td align="left" class="table_row_first">&nbsp;</td>
    </tr>
    
    <tr>
     	<td align="left"  class="table_row_first">&nbsp;</td>
    	<td align="left" class="table_row_first">
        	Subdistrict        </td>
        <td align="center" class="table_row_first">
        	<?php echo form_input('txtSubdistrictX',@$certificate_template[0]['sub_dist_x'],'id="txtSubdistrictX" class="input_box_small" maxlength="3" onkeypress="javascript:return numbersonly(this, event, false);"')?>        </td>
        <td align="center" class="table_row_first">
        	<?php echo form_input('txtSubdistrictY',@$certificate_template[0]['sub_dist_y'],'id="txtSubdistrictY" class="input_box_small" maxlength="3" onkeypress="javascript:return numbersonly(this, event, false);"')?>        </td>
        <td align="center" class="table_row_first">
        	<?php echo form_dropdown('cboSubDistFont',$font_array,@$certificate_template[0]['sub_dist_font'],'id="cboSubDistFont" class="select_box_medium"')?>        </td>
         <td align="center" class="table_row_first">
        	<?php echo form_dropdown('cboSubDistSize',$font_size_array,@$certificate_template[0]['sub_dist_size'],'id="cboSubDistSize" class="input_box_small"')?>        </td>
        <td align="left" class="table_row_first">&nbsp;</td>
    </tr>
    
   <!-- <tr>
     	<td align="left"  class="table_row_first">&nbsp;</td>
    	<td align="left" class="table_row_first">
        	District
        </td>
        <td align="center" class="table_row_first">
        	<?php echo form_input('txtDistrictX',@$certificate_template[0]['dist_x'],'id="txtDistrictX" class="input_box_small" maxlength="3" onkeypress="javascript:return numbersonly(this, event, false);"')?>
        </td>
        <td align="center" class="table_row_first">
        	<?php echo form_input('txtDistrictY',@$certificate_template[0]['dist_y'],'id="txtDistrictY" class="input_box_small" maxlength="3" onkeypress="javascript:return numbersonly(this, event, false);"')?>
        </td>
        <td align="center" class="table_row_first">
        	<?php echo form_dropdown('cboDistFont',$font_array,@$certificate_template[0]['dist_font'],'id="cboDistFont" maxlength="3" class="select_box_medium"')?>
        </td>
         <td align="center" class="table_row_first">
        	<?php echo form_dropdown('cboDistSize',$font_size_array,@$certificate_template[0]['dist_size'],'id="cboDistSize" maxlength="3" class="input_box_small"')?>
        </td>
        <td align="left" class="table_row_first">&nbsp;</td>
    </tr>-->
    
     <tr>
     	<td align="left"  class="table_row_first">&nbsp;</td>
    	<td align="left" class="table_row_first">
        	Date        </td>
        <td align="center" class="table_row_first">
        	<?php echo form_input('txtDateX',@$certificate_template[0]['date_x'],'id="txtDateX" class="input_box_small" maxlength="3" onkeypress="javascript:return numbersonly(this, event, false);"')?>        </td>
        <td align="center" class="table_row_first">
        	<?php echo form_input('txtDateY',@$certificate_template[0]['date_y'],'id="txtDateY" class="input_box_small" maxlength="3" onkeypress="javascript:return numbersonly(this, event, false);"')?>        </td>
        <td align="center" class="table_row_first">
        	<?php echo form_dropdown('cboDateFont',$font_array,@$certificate_template[0]['date_font'],'id="cboDateFont" maxlength="3" class="select_box_medium"')?>        </td>
         <td align="center" class="table_row_first">
        	<?php echo form_dropdown('cboDateSize',$font_size_array,@$certificate_template[0]['date_size'],'id="cboDateSize" maxlength="3" class="input_box_small"')?>        </td>
        <td align="left" class="table_row_first">&nbsp;</td>
    </tr>
    
    <tr>
     	<td align="left"  class="table_row_first">&nbsp;</td>
    	<td align="left" class="table_row_first">
        	Place        </td>
        <td align="center" class="table_row_first">
        	<?php echo form_input('txtPlaceX',@$certificate_template[0]['place_x'],'id="txtPlaceX" class="input_box_small" maxlength="3" onkeypress="javascript:return numbersonly(this, event, false);"')?>        </td>
        <td align="center" class="table_row_first">
        	<?php echo form_input('txtPlaceY',@$certificate_template[0]['place_y'],'id="txtPlaceY" class="input_box_small" maxlength="3" onkeypress="javascript:return numbersonly(this, event, false);"')?>        </td>
        <td align="center" class="table_row_first">
        	<?php echo form_dropdown('cboPlaceFont',$font_array,@$certificate_template[0]['place_font'],'id="cboPlaceFont" maxlength="3" class="select_box_medium"')?>        </td>
         <td align="center" class="table_row_first">
        	<?php echo form_dropdown('cboPlaceSize',$font_size_array,@$certificate_template[0]['place_size'],'id="cboPlaceSize" maxlength="3" class="input_box_small"')?>        </td>
        <td align="left" class="table_row_first">&nbsp;</td>
    </tr>
    <!--<tr>
     	<td align="left"  class="table_row_first">&nbsp;</td>
    	<td align="left" class="table_row_first">
        	Eligible For Higher Level</td>
        <td align="center" class="table_row_first">
        	<?php echo form_input('txtehsX',@$certificate_template[0]['ehs_X'],'id="txtehsX" class="input_box_small" maxlength="3" onkeypress="javascript:return numbersonly(this, event, false);"')?>        </td>
        <td align="center" class="table_row_first">
        	<?php echo form_input('txtehsY',@$certificate_template[0]['ehs_Y'],'id="txtehsY" class="input_box_small" maxlength="3" onkeypress="javascript:return numbersonly(this, event, false);"')?>        </td>
        <td align="center" class="table_row_first">
        	<?php echo form_dropdown('cboehsFont',$font_array,@$certificate_template[0]['ehs_font'],'id="cboPlaceFont" maxlength="3" class="select_box_medium"')?>        </td>
         <td align="center" class="table_row_first">
        	<?php echo form_dropdown('cboehsSize',$font_size_array,@$certificate_template[0]['ehs_size'],'id="cboehsSize" maxlength="3" class="input_box_small"')?>        </td>
        <td align="left" class="table_row_first">&nbsp;</td>
    </tr>
    -->
    <tr>
     	<td align="left"  class="table_row_first">&nbsp;</td>
    	<td align="left" class="table_row_first">
        	Page Style        </td>
        <td align="left" class="table_row_first" colspan="4">
        	<?php echo form_dropdown('cboPageStyle',array('P' => 'Portrait','L' => 'Landscape'),@$certificate_template[0]['page_style'],'id="cboPageStyle" class="input_box"')?>        </td>
        <td align="left" class="table_row_first">&nbsp;</td>
    </tr>
    
    <tr>
     	<td align="left"  class="table_row_first">&nbsp;</td>
    	<td align="left" class="table_row_first">
        	Line Height        </td>
        <td align="left" class="table_row_first" colspan="4">
        	<?php echo form_dropdown('cboLineHeight',$line_height_array,@$certificate_template[0]['line_height'],'id="cboLineHeight" class="input_box_small"')?>        </td>
        <td align="left" class="table_row_first">&nbsp;</td>
    </tr>
    
    <tr>
     	<td align="left"  class="table_row_first">&nbsp;</td>
    	<td align="left" class="table_row_first">
        	Top Margin        </td>
        <td align="left" class="table_row_first" colspan="4">
        	<?php echo form_dropdown('cboTopMargin',$line_height_array,@$certificate_template[0]['top_margin'],'id="cboTopMargin" class="input_box_small"')?>        </td>
        <td align="left" class="table_row_first">&nbsp;</td>
    </tr>  
    <tr>
     	<td align="left"  class="table_row_first">&nbsp;</td>
    	<td align="left" class="table_row_first">
        	Left Margin        </td>
        <td align="left" class="table_row_first" colspan="4">
        	<?php echo form_dropdown('cboLeftMargin',$line_height_array,@$certificate_template[0]['left_margin'],'id="cboLeftMargin" class="input_box_small"')?>        </td>
        <td align="left" class="table_row_first">&nbsp;</td>
    </tr>
    
    <tr>
     	<td align="left"  class="table_row_first">&nbsp;</td>
    	<td align="left" class="table_row_first">
        	Right Margin        </td>
        <td align="left" class="table_row_first" colspan="4">
        	<?php echo form_dropdown('cboRightMargin',$line_height_array,@$certificate_template[0]['right_margin'],'id="cboRightMargin" class="input_box_small"')?>        </td>
        <td align="left" class="table_row_first">&nbsp;</td>
    </tr>
    
    <tr>
     	<td align="left"  class="table_row_first">&nbsp;</td>
    	<td align="left" class="table_row_first">
        	Type of Certificate        </td>
        <td align="left" class="table_row_first" colspan="4">
        	<?php echo form_dropdown('cboCtType',$certificate_type_array,@$certificate_template[0]['type_id'],'id="cboCtType" class="input_box"')?>        </td>
        </td>
        <td align="left" class="table_row_first">&nbsp;</td>
    </tr>
    
    <tr>
     	<td align="left"  class="table_row_first">&nbsp;</td>
    	<td align="left" class="table_row_first">
        	Label Print        </td>
        <td align="left" class="table_row_first" colspan="4">
        	<?php echo form_dropdown('cboLabelPrint',array('N' => 'No','Y' => 'Yes'),@$certificate_template[0]['label_print'],'id="cboLabelPrint" class="input_box_medium"')?>        </td>
        </td>
        <td align="left" class="table_row_first">&nbsp;</td>
    </tr>
    
    <tr>
     	<td align="center"  class="table_row_first">&nbsp;</td>
    	<td align="center" colspan="6"  class="table_row_first">
        	<?php echo form_submit('Save','Save')?>
        	&nbsp;&nbsp;
        	<a href="<?php echo base_url().'index.php/test/'?>" target="_blank">Test X - Y Cordinates (Portrait)</a>
            &nbsp;&nbsp;
        	<a href="<?php echo base_url().'index.php/test/landscapeview'?>" target="_blank">Test X - Y Cordinates (Landscape)</a>        </td>
    </tr>
</table>

<?php 
//echo blue_box_bottom();
echo form_close();
?>
</div>