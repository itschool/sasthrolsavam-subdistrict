<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php echo (isset($_styles)) ? $_styles : ''; ?>
<script language="javascript" type="text/javascript">
//<![CDATA[
	var path 		= '<?php echo base_url();?>';
//]]>
</script>
<?php echo (isset($_scripts)) ? $_scripts : ''; ?>
<title><?php echo (isset($title) and trim(@$title) !='') ? $title : 'Science Fair'; ?></title> 
<!-- Calendar Styles -->
<link href="<?php echo base_url();?>/styles/fullcalendar.css" rel="stylesheet" type="text/css" />
<!-- Fancybox/Lightbox Effect -->
<link href="<?php echo base_url();?>/styles/jquery.fancybox-1.3.4.css" rel="stylesheet" type="text/css" />
<!-- WYSIWYG Editor -->
<link href="<?php echo base_url();?>/styles/wysiwyg.css" rel="stylesheet" type="text/css" />
<!-- Main Controlling Styles -->
<link href="<?php echo base_url();?>/styles/main.css" rel="stylesheet" type="text/css" />
<!-- Blue Theme Styles -->
<link href="<?php echo base_url();?>/themes/blue/styles.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>/styles/sorttablestyle.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="<?php echo base_url();?>js/common.js" ></script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>

<!-- Top header/black bar start -->
	<div id="header">
    	<img src="<?php echo base_url();?>/images/logo.png" alt="AdminCP" class="logo" />
        <div id="searchbox">
        	<input type="text" class="searchinput" />
            <input type="image" src="<?php echo base_url();?>images/search_btn.png" class="searchbtn" />
    	</div>
    </div>
 <!-- Top header/black bar end -->   
    
<!-- Left side bar start -->
        <div id="left">
<!-- Left side bar start -->

<!-- Toolbox dropdown start -->
        	<div id="openCloseIdentifier"></div>
            <div id="slider">            
                <ul id="sliderContent">
                <?php if($this->session->userdata('CHANGE_PASS')=='Y'){ ?>
                    <li><a href="<?php echo base_url().'index.php/welcome/change_password_afterlogin';?>" title="">Change Password</a></li>
                    <li class="alt"><a href="#" title="">menu</a></li>
                    <li><a href="#" title="">menu</a></li>
                    <li class="alt"><a href="#" title="">menu</a></li>
                    <li><a href="<?php echo base_url();?>index.php/welcome/logout">Log out</a></li>
                <?php }?>
                </ul>
                <div id="openCloseWrap">
                    <div id="toolbox">
            			<a href="#" title="Toolbox Dropdown" class="toolboxdrop">Toolbox <img src="<?php echo base_url();?>/images/icon_expand_grey.png" alt="Expand" /></a>
            		</div>
                </div>
            </div>          
<!-- Toolbox dropdown end -->   
    	
<!-- Userbox/logged in start -->
            <div id="userbox">
            	<p>Welcome : <?php echo ucfirst($this->session->userdata('USERNAME')); ?></p>
                <ul>
                <?php if($this->session->userdata('CHANGE_PASS')=='Y'){ ?>
                	<li><a href="<?php echo base_url();?>index.php/welcome/home" title="Check Mail"><img src="<?php echo base_url();?>/images/icons/home.png" alt="Home" width="20" height="20" /></a></li>               
                    <li><a href="<?php echo base_url();?>index.php/welcome/logout" title="Logout"><img src="<?php echo base_url();?>/images/icons/logout.png" alt="Logout" width="20" height="20" /></a></li>
				<?php }?>                    
                </ul>
            </div>
<!-- Userbox/logged in end -->  

<!-- Main navigation start -->         
            <ul id="nav">
            <?php if($this->session->userdata('CHANGE_PASS')=='Y'){ ?>
            	<li>
                    <a class="collapsed heading">Home</a>
                     <ul class="navigation">
                        <li><a href="#" title="">Define fairs</a></li                        
                    ></ul>
                </li>                   
                <li>
                    <a class="collapsed heading">Registrations</a>
                     <ul class="navigation">
                        <li><a href="#" title="">School Entry</a></li>
                         <?php if($this->session->userdata('USER_TYPE')==1){ ?>
                        <li><a href="<?php echo base_url();?>index.php/admin/admin/user_creation" title="user creation">Create/View Users</a></li>
                        <?php }else if($this->session->userdata('USER_TYPE')==4){?>
                        <li><a href="<?php echo base_url();?>index.php/admin/user_cluster/cluster_creation" title="">Cretate/Edit Cluster</a></li>
                        <?php }?>
                        <li><a href="#" title="">District List</a></li>
                        <li><a href="#" title="">School Master</a></li>
                    </ul>
                </li>   
                 <li>
                    <a class="collapsed heading">Master Reports</a>
                     <ul class="navigation">
                        <li><a href="#" title="">Consolidation</a></li>
                    </ul>
                </li>      
                 <li>
                    <a class="collapsed heading">Downloads</a>
                     <ul class="navigation">
                        <li><a href="#" title="">User Manual</a></li>
                        <li><a href="#" title="">Entry Forms</a></li>
                        <li><a href="#" title="">Item Codes</a></li>
                    </ul>
                </li>                      
                <?php }?>             
            </ul>
        </div>      
<!-- Main navigation end --> 

<!-- Left side bar start end -->   

<!-- Right side start -->     
        <div id="right">

<!-- Breadcrumb start -->  
            <div id="breadcrumb">
                <ul>	
        			<li><img src="<?php echo base_url();?>/images/icon_breadcrumb.png" alt="Location" /></li>
                    <li><?php echo @$heading; ?></li>                    
                </ul>
            </div>
<!-- Breadcrumb end -->  

<!-- Top/large buttons start --> 
 
            <ul id="topbtns">
            <?php if($this->session->userdata('CHANGE_PASS')=='Y'){ ?>
                <li>
                	<a href="#"><img src="<?php echo base_url();?>/images/icons/icon_lrg_calendar.png" alt="Calendar" /><br />School Entry</a>
                </li>
                <li>
                	<a href="#"><img src="<?php echo base_url();?>/images/icons/icon_lrg_create.png" alt="Create" /><br />Result Entry</a>
                </li>
                <li>
                <?php if($this->session->userdata('USER_TYPE')==1){ ?>
                	<a href="<?php echo base_url();?>index.php/admin/admin/user_creation"><img src="<?php echo base_url();?>/images/icons/icon_lrg_user.png" alt="Users" /><br />Users</a>
                 <?php }else  if($this->session->userdata('USER_TYPE')==4){?>
                 	<a href="<?php echo base_url();?>index.php/admin/user_cluster/cluster_creation"><img src="<?php echo base_url();?>/images/icons/icon_lrg_user.png" alt="Users" /><br />Clusters</a>
                   <?php }?>
                </li>
                <li>
                	<a href="#"><img src="<?php echo base_url();?>/images/icons/icon_lrg_media.png" alt="Media" /><br />Certificates</a>
                </li>
                <li>
                	<a href="#"><img src="<?php echo base_url();?>/images/icons/icon_lrg_comment.png" alt="Comment" /><br />Template</a>
                </li>
                <li>
                	<a href="#"><img src="<?php echo base_url();?>/images/icons/icon_lrg_support.png" alt="Support" /><br />DB Backup</a>
                </li>
                 <?php }?> 
            </ul>
            
            
<!-- Top/large buttons end -->  

 <!-- Main content start -->      
            <div id="content">
            <?php 
			if(isset($error) && trim($error) !='' ){ ?>
			<!-- Green Status Bar Start -->
			<div class="status error" id="divError">
				<p class="closestatus"><a href="#" onclick="document.getElementById('divError').style.display='none'"  title="Close">x</a></p>
				<p><img src="<?php echo base_url();?>img/icons/icon_error.png" alt="Error" />
				<span><br /> <?php echo @$error; ?></span> 
				</p>
			</div>
			<!-- Green Status Bar End -->
			<?php 
		}?>
        <?php 
		if(isset($mesage) && trim($mesage)!=''){ ?>
        <!-- Blue Status Bar Start -->
        <div class="status info" id="divMessage" >
        	<p class="closestatus"><a href="#" onclick="document.getElementById('divMessage').style.display='none'" title="Close">x</a></p>
        	<p><img src="<?php echo base_url();?>img/icons/icon_info.png" alt="Information" />			              <span><?php echo @$mesage; ?></span> 
            </p>
        </div>
        <!-- Blue Status Bar End -->       			
		<?php } ?>
         <?php 
		if(isset($sucess) && trim($sucess)!=''){ ?>
         <!-- Red Status Bar Start -->
        <div class="status success" id="divSuccess">         
        	<p class="closestatus"><a href="#" onclick="document.getElementById('divSuccess').style.display='none'" title="Close">x</a></p>
        	<p><img src="<?php echo base_url();?>img/icons/icon_success.png" alt="Success" />
              <span><?php echo @$sucess; ?></span> 
            </p>
        </div>
        <!-- Red Status Bar End -->    			
		<?php } ?>
                
			 <?php print @$content ?> 

        	</div>
            
<!-- Footer start --> 
            <p id="footer" align="center"><a href="https://www.itschool.gov.in" target="_blank"><img src="<?php echo base_url();?>/images/itschoo_logo.gif" alt="It@School Project" /></a></p>
<!-- Footer end -->      
   
        </div>
<!-- Right side end --> 

		<script type="text/javascript" src="<?php echo base_url();?>js/inTemplate/enhance.js"></script>	
   		<script type='text/javascript' src='<?php echo base_url();?>js/inTemplate/excanvas.js'></script>
        <script type='text/javascript' src='<?php echo base_url();?>js/inTemplate/jquery.min.js'></script>
        <script type='text/javascript' src='<?php echo base_url();?>js/inTemplate/jquery-ui.min.js'></script>
        <script type='text/javascript' src='<?php echo base_url();?>/js/jquery.fancybox-1.3.4.pack.js'></script>
        <script type='application/javascript' src='<?php echo base_url();?>/js/fullcalendar.min.js'></script>
        <script type='text/javascript' src='<?php echo base_url();?>/js/jquery.wysiwyg.js'></script>
        <script type='text/javascript' src='<?php echo base_url();?>/js/visualize.jQuery.js'></script>
        <script type='application/javascript' src='<?php echo base_url();?>/js/functions.js'></script>
</body>
</html>
