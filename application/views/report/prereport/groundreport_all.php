<!--<div align="center" class="heading_gray">
<h3>Stage Report - All</h3>
</div>--><style type="text/css">
<!--
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
-->
</style>
<br />
<?php echo form_open('', array('id' => 'groundreport','target'=>'_blank'));

?>
<input type="hidden" name="hidUserId" id="hidUserId" />
<div class="container">
<table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
  <tr>
    <th colspan="3" align="left">Venue Report - Venue wise All Date</th> 
    <th colspan="3" align="left">Venue Report -Date wise</th>
  </tr>
  <tr>
    <td width="9%" class="">&nbsp;</td>
    <td align="left" class="table_row_first" colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Click Here&nbsp;    <a href="../prereportpdf/groundreport_all" target="_blank" > Venue Report All </a></td>
  
    <td width="31%" class="table_row_first"> <a href="../prereportpdf/groundreport_abstract" target="_blank" >Abstract </a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left" width="24%" class="table_row_first">&nbsp;</td>
    <td align="left" width="36%" class="table_row_first">&nbsp;</td>
    <td width="31%" class="table_row_first">&nbsp;</td>
  </tr>
  
  <tr>
    <td align="center" colspan="4">&nbsp;</td>
  </tr>
</table>
</div>

<?php
//itemwise_report_interface
echo form_close();
?>