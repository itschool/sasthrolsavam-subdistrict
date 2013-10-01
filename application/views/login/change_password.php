
 <div id="content">
 	<!--<div class="container med left">-->
 	<!--<div class="container half left">-->
<?php echo form_open('welcome/change_password',array('id' => 'formchange_password','name' => 'formchange_password')); ?>
<!-- Form elements start -->                 
				
                
                <div class="container">
                
                	<div class="conthead">
                    	<h2>Change Password</h2>
                    </div>
                    
                	<div class="contentbox">
                    	<!--<div class="inputboxes">-->
                        <table >
                        	<tr>
                            	<td>
                                    <label for="regular">Current Password</label>
                                </td>
                                <td>
                                    <input type="password" name="password" id="password" class="inputbox" />
                                </td>
                      		</tr>
                            <tr>
                            	<td>	
                                	<label for="regular">New Password</label>
                                </td>
                                <td>
                                	<input type="password" name="newPassword" id="newPassword" class="inputbox" />
                                </td>
                             </tr>
                              <tr>
                            	<td>
                                	<label for="regular">Retype Password</label>
                                </td>
                                <td>
                                	 <input type="password" name="retype_password" id="retype_password" class="inputbox" />
                                </td>
                             </tr>
                              <tr>
                            	<td>
                                	<label for="regular">Name </label>
                                </td>
                                <td>
                                	<input type="text" name="name" id="name" class="inputbox" value="<?php echo @$_POST['name']; ?>"    onkeypress="javascript:return toUppercase(event,this)" />
                                </td>
                             </tr>
                              <tr>
                            	<td>
                                	<label for="regular">Mobile No:</label>
                                </td>
                                <td>
                                	 <input type="text" name="mobile" id="mobile" class="inputbox" value="<?php echo @$_POST['mobile']; ?>"  onkeypress="return numbersonly(this, event, false)"  />
                                </td>
                             </tr>
                              <tr>
                            	<td>
                                	<label for="regular">E-mail ID </label>
                                </td>
                                <td>
                                	<input type="text" name="email" id="email" value="<?php echo @$_POST['email']; ?>" class="inputbox" />
                                </td>
                             </tr>
                             <tr>
                             	<td colspan="2"><input type="submit" name="change_password"   value="Change Password" onclick="return validate_changePassword();" class="btn" /></td>
                             </tr>
                       
                    </table>
                       <!-- </div> inputbox close    -->                                                                 
                  </div><!-- contentbox close    -->   
                </div>
                
 <?php echo form_close();?> <!-- Form elements end --> 

<!--</div>--><!-- container half left -->  
<!--</div>-->   <!-- container med left -->  
</div> <!-- content -->  
          
 