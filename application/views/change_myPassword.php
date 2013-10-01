<?php if($this->session->userdata('USER_TYPE')!=''){ ?>
<script type="text/javascript" src="<?php echo base_url();?>js/common.js"></script>
<style type="text/css">
<!--
.style2 {
	font-size: 18px;
	font-weight: bold;
}
-->
</style>
<div class="contentbox">
<p><?php echo form_open('welcome/change_password1',array('id' => 'formchange_password','name' => 'formchange_password')); ?>
</p><?php //echo md5(@$logindata[0]['password']);?>
<input type="hidden" name="hidpassword" id="hidpassword" value="<?php echo get_encr_password(@$logindata[0]['password']);?>" />
<input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url();?>" /><div align="center">
        		<div class="container half left">
                	<div class="conthead">
                    	<h2>Change Password</h2>
                    </div>
                	<div class="contentbox">
                    	<div class="inputboxes">
                        	<label for="regular">Current Password</label>
                            <input type="password" name="password" id="password" class="inputbox" />
                        </div>
                        <div class="inputboxes">
                        	<label for="regular">New Password</label>
                            <input type="password" name="newPassword" id="newPassword" class="inputbox" />
                        </div>
                        <div class="inputboxes">
                        	<label for="regular">Retype Password</label>
                            <input type="password" name="retype_password" id="retype_password" class="inputbox" />
                        </div>
                        <div class="inputboxes">
                        	<label for="regular">Name </label>
                            <input type="text" name="name" id="name" class="inputbox" value="<?php echo @$logindata[0]['name'];?>" onkeypress="javascript:return toUppercase(event,this)" />
                        </div>
                        <div class="inputboxes">
                        	<label for="regular">Mobile No:</label>
                            <input type="text" name="mobile" id="mobile" class="inputbox"  value="<?php echo @$logindata[0]['mobile'];?>" />
                        </div>
                        <div class="inputboxes">
                        	<label for="regular">E-mail ID </label>
                            <input type="text" name="email" id="email" class="inputbox" value="<?php echo @$logindata[0]['email'];?>" />                            
                        </div>            
                         <input type="submit" name="change_password" value="Change Password" class="btn" />                                              
                  </div>
                </div>
                

<?php echo form_close(); ?><br />
<?php }?>