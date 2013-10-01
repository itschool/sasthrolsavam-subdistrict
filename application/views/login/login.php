<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style type="text/css">
<!--
/* Status Bars */

		.status {padding: 8px 10px 5px 10px; border-radius: 10px; -moz-border-radius: 10px; text-shadow: 1px 1px 1px #fff; overflow: auto; margin-bottom: 20px; clear: both}
			.status img {float: left; padding-right: 5px}
			.status p {padding: 0; margin: 0}
			.status p span {font-weight: 700}
			.status .closestatus {float: right; color: #fff; text-align: center; margin-left: 10px}
				.status .closestatus a {position: relative; color: #fff; text-decoration: none; padding: 5px; width: 10px; height: 10px; display: block; border-radius: 5px; -moz-border-radius: 5px; line-height: .6em; top: -2px; text-shadow: none}

		.warning {border: 3px solid #BF9900; background: #FEEB9C url(../images/bg_fade_yellow_med.png) repeat-x top}
			.warning span {color: #BF9900}
			.warning .closestatus a {background: #BF9900}
				.warning .closestatus a:hover {background: #9B7C00}

		.success {border: 3px solid #8EA534; background: #CBDA8F url(../images/bg_fade_green_med.png) repeat-x top}
			.success span {color: #8EA534}
			.success .closestatus a {background: #8EA534}
				.success .closestatus a:hover {background: #829829}

		.error {border: 3px solid #990000; background: #F5D0CD url(../images/bg_fade_red_med.png) repeat-x top}
			.error span {color: #990000}
			.error .closestatus a {background: #990000}
				.error .closestatus a:hover {background: #730D0D}

		.info {border: 3px solid #2FADD7; background: #92D6ED url(../images/bg_fade_blue_med.png) repeat-x top}
			.info span {color: #0E7A9F}
			.info .closestatus a {background: #2FADD7}
				.info .closestatus a:hover {background: #228DB0}

#header_style{
	}

	#footer{
		background:url(<?php echo base_url(false);?>/images/footer.png);
		height:50px;
		text-align:center;
		line-height:45px;
	}

	.bullet ul {
	list-style-type:none;
	margin:0;
	padding:0;
	margin-bottom: 8px;
	}
	.bullet ul li {
	padding-bottom:2px;

	}
	.bullet ul li a{
	background:url(<?php echo base_url(false);?>/images/bullet.jpg) ;
	display:block;
	padding: 2px 0;
	padding-left: 19px;
	text-decoration: none;
	font-weight: bold;
font-family:Times New Roman;
border-bottom: 0px solid #dadada;
font-size: 95%;
color:#007BB7;
	}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sasthrolsavam</title>
<link href="<?php echo base_url()?>styles/login.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>

    <br /><br />
       <div align="center" id="header_style">
       		<img src="<?php echo base_url(false);?>/images/final copy.png" />
       </div>
        <?php
			if(isset($error) && trim($error) !='' ){ ?>
			<!-- Error Bar Start -->
            <br />
			<div class="status error" id="loginerror">
				<p class="closestatus"><a href="#" onclick="document.getElementById('loginerror').style.display='none'"  title="Close">x</a></p>
				<p><img src="<?php echo base_url();?>img/icons/icon_error.png" alt="Error" />
				<span> <?php echo @$error; ?></span>
				</p>
			</div>
			<!-- Error Bar End -->
			<?php
		} ?>

    <table align="center" width="80%" height="80%" border="0">

     <tr><td>&nbsp;</td></tr>
    <tr> <td align="center">
    <?
	 /*$s	= $_SERVER['HTTP_USER_AGENT']."<br />";
	 echo $s;*/



	?>

   &nbsp;&nbsp;<font size="4"><strong>Sub District Sasthrolsavam</strong></font>

    </td></tr>
    <tr>

    <td align="left">
	<div id="logincontainer" >

    	<!--<h1>Science<span>Fair</span></h1> Iceweasel-->
        <div align="center" class="style16"><strong>
		    <marquee scrollamount="3" onmouseover="this.setAttribute('scrollamount', 0, 0);" onmouseout="this.setAttribute('scrollamount', 1, 0);"  behavior="alternate">
		      Website best viewed in Mozilla Firefox
		    </marquee>
		  </strong>
         </div>

        <div id="loginbox" >
        	<?php echo form_open('welcome/checkLogin',array('id' => 'formLogin','name' => 'formLogin')); ?>
                <div class="inputcontainer">
                    <img src="<?php echo base_url()?>images/icons/icon_username.png" alt="Username" />
                    <label for="username">Username:</label>
                    <input type="text" name="txtUserName" id="txtUserName"/>
                </div>
                <div class="inputcontainer">
                    <img src="<?php echo base_url()?>images/icons/icon_locked.png" alt="Password" />
                    <label for="password">Password:</label>
                    <input type="password" name="txtPassword" id="txtPassword"  />
                </div>
                <input type="submit" value="Login" class="loginsubmit" name="login" id="login" />
               <!-- <p><a href="#">Forgot password ?</a></p>-->
            <?php echo form_close();?>
        </div>
    </div></td></tr>
    <tr> <td align="center">
     <div  >

   &nbsp;&nbsp;<font color="#0000FF" size="3"><strong><a target="_blank" href="<?php echo base_url()?>Sasthrolsavam Offline software user guide 2011_final.pdf">Download User Manual</a></strong></font>

	</div><br />

   <div  >

   &nbsp;&nbsp;<!--<font color="#0000FF" size="3"><strong><a target="_blank" href="<?php echo base_url()?>code_usermanual.pdf">Codeuser User Manual</a></strong></font>-->

	</div>
    </td></tr>
    </table>
   <br />

 <div align="center"><a href="http://www.mozilla.com/en-US/firefox/" target="_blank"><img src="<?php echo base_url()?>/images/mozzilla.gif" width="125" height="42" border="0" /></a></div>
 <br />

 <div  align="center"><strong>Version : 02-10-2013</strong></div>
<div id="footer">© 2013 <a href="https://www.itschool.gov.in/" target="_blank"><strong>IT@school</strong></a> project all rights reserved</div>

</body>
</html>
