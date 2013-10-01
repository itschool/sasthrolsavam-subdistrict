<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php echo (isset($_styles)) ? $_styles : ''; ?>
<script language="javascript" type="text/javascript">
function height_adjust(id){	if($(id).getHeight() < 500){ if (window.navigator.userAgent.indexOf('MSIE 6.0') != -1) $(id).style.height='500px'; $(id).style.minHeight='500px'; }}
function show_menu(el) { el.getElementsByTagName('ul')[0].style.left='auto'; el.getElementsByTagName('ul')[0].style.display='block'; }
function hide_menu(el) { el.getElementsByTagName('ul')[0].style.left='-999em'; }
//<![CDATA[
	var path 		= '<?php echo base_url();?>';
	
	var image_path 	= '<?php echo image_url();?>';
//]]>
</script>
<?php echo (isset($_scripts)) ? $_scripts : ''; ?>
<title><?php echo (isset($title) and trim(@$title) !='') ? $title : 'Science Fair 2013-2014'; ?></title> 
<!-- Main Controlling Styles -->
<link href="<?php echo base_url();?>/styles/main.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>/styles/demos.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>/styles/registration_menu.css" rel="stylesheet" type="text/css" />
<!-- Blue Theme Styles -->
<link href="<?php echo base_url();?>/themes/blue/styles.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>/themes/base/ui.all.css" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url();?>/styles/sorttablestyle.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url();?>/styles/new_styles.css"  type="text/css" />
<script type="text/javascript" src="<?php echo base_url();?>js/common.js" ></script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>
<div id="mainContainer">
<?php
if(isset($menu) && trim($menu)!=''){ echo $menu; }?><br /><br />
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td valign="top" align="left" class="left_bar_bg">
	  <div style="padding-left:2px; padding-bottom:20px;">
	  <?php 
		if(isset($mesage) && trim($mesage)!=''){ ?>
        <!-- Blue Status Bar Start -->
        <div class="status info" id="divMessage" >
        	<p class="closestatus"><a href="#" onclick="document.getElementById('divMessage').style.display='none'" title="Close">x</a></p>
        	<p><img src="<?php echo base_url();?>imgages/icons/icon_info.png" alt="Information" />			              <span><?php echo @$mesage; ?></span> 
            </p>
        </div>
        <!-- Blue Status Bar End -->       			
		<?php } ?>
        <?php 
		if(isset($sucess) && trim($sucess)!=''){ ?>
         <!-- Red Status Bar Start -->
        <div class="status success" id="divSuccess">         
        	<p class="closestatus"><a href="#" onclick="document.getElementById('divSuccess').style.display='none'" title="Close">x</a></p>
        	<p><img src="<?php echo base_url();?>images/icons/icon_success.png" alt="Success" />
              <span><?php echo @$sucess; ?></span> 
            </p>
        </div>
        <!-- Red Status Bar End -->    			
		<?php } ?>
         <?php 
			if(isset($error) && trim($error) !='' ){ ?>
			<!-- Green Status Bar Start -->
			<div class="status error" id="divError">
				<p class="closestatus"><a href="#" onclick="document.getElementById('divError').style.display='none'"  title="Close">x</a></p>
				<p><img src="<?php echo base_url();?>images/icons/icon_error.png" alt="Error" />
				<span><br /> <?php echo @$error; ?></span> 
				</p>
			</div>
			<!-- Green Status Bar End -->
			<?php 
		}?>        		
        <?php print $content ?> </div></td>
    </tr>
  </table>
</div>
<div id="footer_bar">&copy; <?php echo date('Y'); ?> <a href="http://itschool.gov.in/"><img src="<?php echo base_url();?>images/itschoo_logo.gif" alt="IT@School" /></a> project all rights reserved</div>
<script language="javascript" type="text/javascript">
	height_adjust('mainContainer');		
</script>
<!--<script type="text/javascript" src="<?php //echo base_url();?>js/inTemplate/enhance.js"></script>	-->
   		<!--<script type='text/javascript' src='<?php //echo base_url();?>js/inTemplate/excanvas.js'></script>-->
        <script type='text/javascript' src='<?php echo base_url();?>js/inTemplate/jquery.min.js'></script>
       <!-- <script type='text/javascript' src='<?php //echo base_url();?>js/inTemplate/jquery-ui.min.js'></script>-->
        <!--<script type='text/javascript' src='<?php //echo base_url();?>/js/jquery.fancybox-1.3.4.pack.js'></script>-->
        <!--<script type='application/javascript' src='<?php //echo base_url();?>/js/fullcalendar.min.js'></script>-->
        <!--<script type='text/javascript' src='<?php //echo base_url();?>/js/jquery.wysiwyg.js'></script>-->
       <!-- <script type='text/javascript' src='<?php //echo base_url();?>/js/visualize.jQuery.js'></script>-->
        <!--<script type='application/javascript' src='<?php //echo base_url();?>/js/functions.js'></script>-->
</body>
</html>
