<html>
<head>
<title>Certificate Template Graphically</title>
<meta name="revisit-after" content="7 days">
<style>
<!--
.dragme{position:relative;}
-->
</style>
<?php
$certificateTemp =array();
$i=0;

	$certificateTemp[0]		=	$certificate_template[0]['name_x'];
	$certificateTemp[1]		=	$certificate_template[0]['name_y'];
	$certificateTemp[2]		=	$certificate_template[0]['item_x'];
	$certificateTemp[3]		=	$certificate_template[0]['item_y'];
	$certificateTemp[4]		=	$certificate_template[0]['category_x'];
	$certificateTemp[5]		=	$certificate_template[0]['category_y'];
	$certificateTemp[6]		=	$certificate_template[0]['grade_x'];
	$certificateTemp[7]		=	$certificate_template[0]['grade_y'];
	$certificateTemp[8]		=	$certificate_template[0]['class_x'];
	$certificateTemp[9]		=	$certificate_template[0]['class_y'];
	$certificateTemp[10]	=	$certificate_template[0]['school_x'];
	$certificateTemp[11]	=	$certificate_template[0]['school_y'];
	$certificateTemp[12]	=	$certificate_template[0]['sub_dist_x'];
	$certificateTemp[13]	=	$certificate_template[0]['sub_dist_y'];
	$certificateTemp[14]	=	$certificate_template[0]['date_x'];
	$certificateTemp[15]	=	$certificate_template[0]['date_y'];
	$certificateTemp[16]	=	$certificate_template[0]['place_x'];
	$certificateTemp[17]	=	$certificate_template[0]['place_y'];
	$certificateTemp[18]	=	$certificate_template[0]['ehs_X'];
	$certificateTemp[19]	=	$certificate_template[0]['ehs_Y'];


?>
<script>
	var jsArray = ["<?php echo join("\", \"", $certificateTemp); ?>"];
	var path 		= '<?php echo base_url();?>';
</script>
<script type="text/javascript" src="<?php echo base_url();?>js/certificate/certificateTemplate.js" ></script>
<link href="<?php echo base_url();?>/styles/main.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {
	font-family: "monotype corsiva";
	font-weight: bold;
	font-size:36px
}
.workArea{
	background-color:#F2FCFD;
	border:#000000;
	top:50px;
	left:255px;
	width:750px;
	position:absolute;
	/*FILTER: alpha(opacity=10);opacity:0.2;*/

}
-->
</style>

</head>
<body leftmargin=0 topmargin=0 rightmargin=0 onLoad="loadInitials();">
<div id="mainContainer">
<div class="style1" align="center">Certificate Template</div>
<div id="leftTools" style="float:left;background-color:#F5FEF3;border:#000000;top:50px;width:250px;position:absolute;height:auto;">
<?php 
echo form_open('certificate/certificate/save_certificate_template_drag/', array('id' => 'formCertificatedrag'));
if($certificate_template[0]['page_style']=='P'){
		$pcheck	=	'checked';
		$lcheck	=	'';
	}else if($certificate_template[0]['page_style']=='L'){
		$pcheck	=	'';
		$lcheck	=	'checked';
	}
if($certificate_template[0]['label_print']=='Y'){
		$lprintY	=	'checked';
		$lprintN	=	'';
		$displayN	=	'none';
		$displayY	=	'block';
		?>
		<script language="javascript" type="text/javascript">
		/*var Yname	=	document.getElementById('lblname1');
		Yname.offsetLeft	=	<?php //echo $certificate_template[0]['name_x'];?>
		Yname.offsetTop		=	<?php //echo $certificate_template[0]['name_y'];?>
			*/
		</script>
		<?php
	}else {
		$lprintN	=	'checked';
		$lprintY	=	'';
		$displayN	=	'block';
		$displayY	=	'none';
	}
//echo blue_box_top();
?>
<input name="txtNameX" id="txtNameX" type="hidden" value="<?php echo $certificate_template[0]['name_x'];?>">
<input name="txtNameY" id="txtNameY" type="hidden" value="<?php echo $certificate_template[0]['name_y'];?>">
<input name="cboNameFont" id="cboNameFont" type="hidden" value="<?php echo $certificate_template[0]['name_font'];?>">
<input name="cboNameSize" id="cboNameSize" type="hidden" value="<?php echo $certificate_template[0]['name_size'];?>">

<input name="txtItemX" id="txtItemX" type="hidden" value="<?php echo $certificate_template[0]['item_x'];?>">
<input name="txtItemY" id="txtItemY" type="hidden" value="<?php echo $certificate_template[0]['item_y'];?>">
<input name="cboItemFont" id="cboItemFont" type="hidden" value="<?php echo $certificate_template[0]['item_font'];?>">
<input name="cboItemSize" id="cboItemSize" type="hidden" value="<?php echo $certificate_template[0]['item_size'];?>">

<input name="txtCategoryX" id="txtCategoryX" type="hidden" value="<?php echo $certificate_template[0]['category_x'];?>">
<input name="txtCategoryY" id="txtCategoryY" type="hidden" value="<?php echo $certificate_template[0]['category_y'];?>">
<input name="cboCategoryFont" id="cboCategoryFont" type="hidden" value="<?php echo $certificate_template[0]['category_font'];?>">
<input name="cboCategorySize" id="cboCategorySize" type="hidden" value="<?php echo $certificate_template[0]['category_size'];?>">

<input name="txtGradeX" id="txtGradeX" type="hidden" value="<?php echo $certificate_template[0]['grade_x'];?>">
<input name="txtGradeY" id="txtGradeY" type="hidden" value="<?php echo $certificate_template[0]['grade_y'];?>">
<input name="cboGradeFont" id="cboGradeFont" type="hidden" value="<?php echo $certificate_template[0]['grade_font'];?>">
<input name="cboGradeSize" id="cboGradeSize" type="hidden" value="<?php echo $certificate_template[0]['grade_size'];?>">

<input name="txtClassX" id="txtClassX" type="hidden" value="<?php echo $certificate_template[0]['class_x'];?>">
<input name="txtClassY" id="txtClassY" type="hidden" value="<?php echo $certificate_template[0]['class_y'];?>">
<input name="cboClassFont" id="cboClassFont" type="hidden" value="<?php echo $certificate_template[0]['class_font'];?>">
<input name="cboClassSize" id="cboClassSize" type="hidden" value="<?php echo $certificate_template[0]['class_size'];?>">

<input name="txtSchoolX" id="txtSchoolX" type="hidden" value="<?php echo $certificate_template[0]['school_x'];?>">
<input name="txtSchoolY" id="txtSchoolY" type="hidden" value="<?php echo $certificate_template[0]['school_y'];?>">
<input name="cboSchoolFont" id="cboSchoolFont" type="hidden" value="<?php echo $certificate_template[0]['school_font'];?>">
<input name="cboSchoolSize" id="cboSchoolSize" type="hidden" value="<?php echo $certificate_template[0]['school_size'];?>">

<input name="txtSubdistrictX" id="txtSubdistrictX" type="hidden" value="<?php echo $certificate_template[0]['sub_dist_x'];?>">
<input name="txtSubdistrictY" id="txtSubdistrictY" type="hidden" value="<?php echo $certificate_template[0]['sub_dist_y'];?>">
<input name="cboSubDistFont" id="cboSubDistFont" type="hidden" value="<?php echo $certificate_template[0]['sub_dist_font'];?>">
<input name="cboSubDistSize" id="cboSubDistSize" type="hidden" value="<?php echo $certificate_template[0]['sub_dist_size'];?>">

<input name="txtDateX" id="txtDateX" type="hidden" value="<?php echo $certificate_template[0]['date_x'];?>">
<input name="txtDateY" id="txtDateY" type="hidden" value="<?php echo $certificate_template[0]['date_y'];?>">
<input name="cboDateFont" id="cboDateFont" type="hidden" value="<?php echo $certificate_template[0]['date_font'];?>">
<input name="cboDateSize" id="cboDateSize" type="hidden" value="<?php echo $certificate_template[0]['date_size'];?>">

<input name="txtPlaceX" id="txtPlaceX" type="hidden" value="<?php echo $certificate_template[0]['place_x'];?>">
<input name="txtPlaceY" id="txtPlaceY" type="hidden" value="<?php echo $certificate_template[0]['place_y'];?>">
<input name="cboPlaceFont" id="cboPlaceFont" type="hidden" value="<?php echo $certificate_template[0]['place_font'];?>">
<input name="cboPlaceSize" id="cboPlaceSize" type="hidden" value="<?php echo $certificate_template[0]['place_size'];?>">

<input name="txtehsX" id="txtehsX" type="hidden" value="<?php echo $certificate_template[0]['ehs_X'];?>">
<input name="txtehsY" id="txtehsY" type="hidden" value="<?php echo $certificate_template[0]['ehs_Y'];?>">
<input name="cboehsFont" id="cboehsFont" type="hidden" value="<?php echo $certificate_template[0]['ehs_font'];?>">
<input name="cboehsSize" id="cboehsSize" type="hidden" value="<?php echo $certificate_template[0]['ehs_size'];?>">

<input name="cboPageStyle" id="cboPageStyle" type="hidden" value="<?php echo $certificate_template[0]['page_style'];?>">
<input name="cboLineHeight" id="cboLineHeight" type="hidden" value="<?php echo $certificate_template[0]['line_height'];?>">
<input name="cboTopMargin" id="cboTopMargin" type="hidden" value="<?php echo $certificate_template[0]['top_margin'];?>">
<input name="cboLeftMargin" id="cboLeftMargin" type="hidden" value="<?php echo $certificate_template[0]['left_margin'];?>">

<input name="cboRightMargin" id="cboRightMargin" type="hidden" value="<?php echo $certificate_template[0]['right_margin'];?>">
<input name="cboCtType" id="cboCtType" type="hidden" value="<?php echo $certificate_template[0]['type_id'];?>">
<input name="cboLabelPrint" id="cboLabelPrint" type="hidden" value="<?php echo $certificate_template[0]['label_print'];?>">


<table width="100%" border="0" cellspacing="5" cellpadding="5">
  <tr>
    <td>Tool Box</td>
  </tr>
  <tr>
    <td>
    	<fieldset>
        <legend>Oriantation</legend>        	
        <p>
          <label>
            <input type="radio" name="radioOriantation" value="L" id="radioOriantation_0" onClick="selectOriantation(this.value)" <?php echo @$lcheck;?> >
            Landscape</label>
          <br>
          <label>
            <input type="radio" name="radioOriantation" value="P" id="radioOriantation_1" onClick="selectOriantation(this.value)" <?php echo @$pcheck;?>>
            Portrait</label>
          <br>
        </p>
    	</fieldset>
    </td>
  </tr>
  <tr>
    <td>
    <fieldset>.
    <legend>Label</legend>    
    <p>
      <label>
        <input type="radio" name="radioLabel" value="Y" id="radioLabel_0" onClick="selectItems(this.value)" <?php echo @$lprintY;?>>
        Yes</label>
      <br>
      <label>
        <input type="radio" name="radioLabel" value="N" id="radioLabel_1" onClick="selectItems(this.value)" <?php echo @$lprintN;?>>
        No</label>
      <br>
    </p>
    </fieldset>
    </td>
  </tr>
  <tr id="withoutlabel" style="display:<?php echo @$displayN;?>">
    <td><fieldset>
    <legend>Items</legend>
    <?php if($certificate_template[0]['name_x'] == 0 && $certificate_template[0]['name_y'] == 0){?>
    <label class="dragme" id="lblname">Name</label><br>
    <?php }?>
    <?php if($certificate_template[0]['item_x'] == 0 && $certificate_template[0]['item_y'] == 0){?>
    <label class="dragme" id="lblitem">Item</label><br>
    <?php }?>
    <?php if($certificate_template[0]['category_x'] == 0 && $certificate_template[0]['category_y'] == 0){?>
    <label class="dragme" id="lblcat">Category</label><br>
    <?php }?>
    <?php if($certificate_template[0]['grade_x'] == 0 && $certificate_template[0]['grade_y'] == 0){?>
    <label class="dragme" id="iblgrade">Grade</label><br>
    <?php }?>
    <?php if($certificate_template[0]['class_x'] == 0 && $certificate_template[0]['class_y'] == 0){?>
    <label class="dragme" id="lblclass">Class</label><br>
    <?php }?>
    <?php if($certificate_template[0]['school_x'] == 0 && $certificate_template[0]['school_y'] == 0){?>
    <label class="dragme" id="lblschool">School</label><br>
    <?php }?>
    <?php if($certificate_template[0]['sub_dist_x'] == 0 && $certificate_template[0]['sub_dist_y'] == 0){?>
    <label class="dragme" id="lblsubdist">Sub District</label><br>
    <?php }?>
    <?php if($certificate_template[0]['date_x'] == 0 && $certificate_template[0]['date_y'] == 0){?>
    <label class="dragme" id="ibldate">Date</label><br>
    <?php }?>
    <?php if($certificate_template[0]['place_x'] == 0 && $certificate_template[0]['place_y'] == 0){?>
    <label class="dragme" id="lablplace">Place</label><br>
    <?php }?>
    <?php if($certificate_template[0]['ehs_X'] == 0 && $certificate_template[0]['ehs_Y'] == 0){?>
    <label class="dragme" id="lblefh">Elegible for heigher level</label><br>
    <?php }?>
    </fieldset></td>
  </tr>
  <tr id="withlabel" style="display:<?php echo @$displayY;?>">
    <td><fieldset>
    <legend>Items</legend>
    <?php if($certificate_template[0]['name_x'] == 0 && $certificate_template[0]['name_y'] == 0){?>
    <label class="dragme" id="lblname1">Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Student Name</label><br>
    <?php }?>
    <?php if($certificate_template[0]['item_x'] == 0 && $certificate_template[0]['item_y'] == 0){?>
    <label class="dragme" id="lblitem1">Item&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp: Item Name</label><br>
    <?php }?>
    <?php if($certificate_template[0]['category_x'] == 0 && $certificate_template[0]['category_y'] == 0){?>
    <label class="dragme" id="lblcat1">Category&nbsp;&nbsp;&nbsp;&nbsp;&nbsp: Category</label><br>
    <?php }?>
    <?php if($certificate_template[0]['grade_x'] == 0 && $certificate_template[0]['grade_y'] == 0){?>
    <label class="dragme" id="iblgrade1">Grade&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp: Grade</label><br>
    <?php }?>
    <?php if($certificate_template[0]['class_x'] == 0 && $certificate_template[0]['class_y'] == 0){?>
    <label class="dragme" id="lblclass1">Class&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp: Class</label><br>
    <?php }?>
    <?php if($certificate_template[0]['school_x'] == 0 && $certificate_template[0]['school_y'] == 0){?>
    <label class="dragme" id="lblschool1">School&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp: School Name</label><br>
    <?php }?>
     <?php if($certificate_template[0]['sub_dist_x'] == 0 && $certificate_template[0]['sub_dist_y'] == 0){?>
    <label class="dragme" id="lblsubdist1">Sub District&nbsp: Sub district name</label><br>
    <?php }?>
    <?php if($certificate_template[0]['date_x'] == 0 && $certificate_template[0]['date_y'] == 0){?>
    <label class="dragme" id="ibldate1">Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp: Date</label><br>
    <?php }?>
    <?php if($certificate_template[0]['place_x'] == 0 && $certificate_template[0]['place_y'] == 0){?>
    <label class="dragme" id="lablplace1">Place&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp: Place</label><br>
    <?php }?>
    <?php if($certificate_template[0]['ehs_X'] == 0 && $certificate_template[0]['ehs_Y'] == 0){?>
    <label class="dragme" id="lblefh1">Elegible for heigher level</label><br>
    <?php }?>
    </fieldset></td>
  </tr>
</table>

</div><!-- end Left tools-->
<div id="workArea" class="workArea">
	<div align="center"><strong>Work Area</strong>
    <div align="right">
    <a href="<?php echo base_url();?>index.php/certificate/certificate/initializeTemplate" title="Certificate - Template" >Inintialize</a>&nbsp;&nbsp;
    <a href="<?php echo base_url();?>index.php/certificate/certificate/" title="Certificate - Template" >Back</a>
    </div>
    </div>
    <div id="displaydiv">Set Positions below : </div>
   <?php //echo $certificate_template[0]['page_style'];
   	//var_dump($certificate_template);
	if($certificate_template[0]['page_style']=='P'){
		$width	=	'475px';
		$height	=	'679px';
	}else if($certificate_template[0]['page_style']=='L'){
		$width	=	'679px';
		$height	=	'475px';
	}
   ?>
</div><!-- end Work Area-->
<br><br><br><br>
<table align="center" cellspacing="0" width="<?php echo @$width;?>" height="<?php echo @$height;?>" border="1" cellpadding="0" id="oriantationtable" style="left:255px;position:inherit;border-style:dashed">
<tr valign="top" align="center">
<td>    
	<?php if($certificate_template[0]['name_x'] > 0 && $certificate_template[0]['name_y'] > 0 && $certificate_template[0]['label_print']=='Y'){?>    
    <label class="dragme" id="lblname1" style="position:absolute">Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Student Name</label>    
    <?php }else if($certificate_template[0]['name_x'] > 0 && $certificate_template[0]['name_y'] > 0 && $certificate_template[0]['label_print']=='N'){?>
	<label class="dragme" id="lblname" style="position:absolute">Name</label>
    <?php }?>
    
    <?php if($certificate_template[0]['item_x'] >0 && $certificate_template[0]['item_y'] > 0 && $certificate_template[0]['label_print']=='Y'){?>    
   <label class="dragme" id="lblitem1" style="position:absolute">Item&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp: Item Name</label>
    <?php }else if($certificate_template[0]['item_x'] >0 && $certificate_template[0]['item_y'] > 0 && $certificate_template[0]['label_print']=='N'){?>
	<label class="dragme" id="lblitem" style="position:absolute">Item</label>
    <?php }?>
    
    <?php if($certificate_template[0]['category_x'] >0 && $certificate_template[0]['category_y'] > 0 && $certificate_template[0]['label_print']=='Y'){?>    
    <label class="dragme" id="lblcat1" style="position:absolute">Category&nbsp;&nbsp;&nbsp;&nbsp;&nbsp: Category</label>
    <?php }else if($certificate_template[0]['category_x'] >0 && $certificate_template[0]['category_y'] > 0 && $certificate_template[0]['label_print']=='N'){?>
	<label class="dragme" id="lblcat" style="position:absolute">Category</label>
    <?php }?>
    
    <?php if($certificate_template[0]['grade_x'] >0 && $certificate_template[0]['grade_y'] > 0 && $certificate_template[0]['label_print']=='Y'){?>    
    <label class="dragme" id="iblgrade1" style="position:absolute">Grade&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp: Grade</label>
    <?php }else if($certificate_template[0]['grade_x'] >0 && $certificate_template[0]['grade_y'] > 0 && $certificate_template[0]['label_print']=='N'){?>
	 <label class="dragme" id="iblgrade" style="position:absolute">Grade</label>
    <?php }?>
    
    <?php if($certificate_template[0]['class_x'] >0 && $certificate_template[0]['class_y'] > 0 && $certificate_template[0]['label_print']=='Y'){?>    
    <label class="dragme" id="lblclass1" style="position:absolute">Class&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp: Class</label>
    <?php }else if($certificate_template[0]['class_x'] >0 && $certificate_template[0]['class_y'] > 0 && $certificate_template[0]['label_print']=='N'){?>
	 <label class="dragme" id="lblclass" style="position:absolute">Class</label>
    <?php }?>
    
    <?php if($certificate_template[0]['school_x'] >0 && $certificate_template[0]['school_y'] > 0 && $certificate_template[0]['label_print']=='Y'){?>    
   <label class="dragme" id="lblschool1" style="position:absolute">School&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp: School Name</label>
    <?php }else if($certificate_template[0]['school_x'] >0 && $certificate_template[0]['school_y'] > 0 && $certificate_template[0]['label_print']=='N'){?>
	<label class="dragme" id="lblschool" style="position:absolute">School</label>
    <?php }?>
    
    <?php if($certificate_template[0]['sub_dist_x'] >0 && $certificate_template[0]['sub_dist_y'] > 0 && $certificate_template[0]['label_print']=='Y'){?>    
    <label class="dragme" id="lblsubdist1" style="position:absolute">Sub District&nbsp: Sub district name</label>
    <?php }else if($certificate_template[0]['sub_dist_x'] >0 && $certificate_template[0]['sub_dist_y'] > 0 && $certificate_template[0]['label_print']=='N'){?>
	<label class="dragme" id="lblsubdist" style="position:absolute">Sub District</label>
    <?php }?>
    
    <?php if($certificate_template[0]['date_x'] >0 && $certificate_template[0]['date_y'] > 0 && $certificate_template[0]['label_print']=='Y'){?>    
     <label class="dragme" id="ibldate1" style="position:absolute">Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp: Date</label>
    <?php }else if($certificate_template[0]['date_x'] >0 && $certificate_template[0]['date_y'] > 0 && $certificate_template[0]['label_print']=='N'){?>
	 <label class="dragme" id="ibldate" style="position:absolute">Date</label>
    <?php }?>
    
    <?php if($certificate_template[0]['place_x'] >0 && $certificate_template[0]['place_y'] > 0 && $certificate_template[0]['label_print']=='Y'){?>    
     <label class="dragme" id="lablplace1" style="position:absolute">Place&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp: Place</label>
    <?php }else if($certificate_template[0]['place_x'] >0 && $certificate_template[0]['place_y'] > 0 && $certificate_template[0]['label_print']=='N'){?>
	 <label class="dragme" id="lablplace" style="position:absolute">Place</label>
    <?php }?>
    
    <?php if($certificate_template[0]['ehs_X'] >0 && $certificate_template[0]['ehs_Y'] > 0 && $certificate_template[0]['label_print']=='Y'){?>    
     <label class="dragme" id="lblefh1" style="position:absolute">Elegible for heigher level</label>
    <?php }else if($certificate_template[0]['ehs_X'] >0 && $certificate_template[0]['ehs_Y'] > 0 && $certificate_template[0]['label_print']=='N'){?>
	  <label class="dragme" id="lblefh" style="position:absolute">Elegible for heigher level</label>
    <?php }?>
                
    </td>
</tr>
<tr><td align="center" style="height:5px"><input name="btnSave" type="button" id="btnSave" value="Save" onClick="return saveCertificateTemplate();"></td></tr>
</table>

</div><!-- end main container-->
<?php echo form_close();?>
</body>
</html>