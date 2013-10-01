<script language="javascript" src="<?php echo base_url()?>js/admin/user_cluster.js"></script>
<div class="container">
<?php echo form_open('admin/user_cluster/save_user_cluster', array('id' => 'createUser'));?>
<!-- Create Users start -->           
              
                	<div class="conthead">
                		<h3>Create Users</h3>
                    </div>
                	<div class="contentbox">
                        <table width="100%"  bgcolor="#E6F0DD">                            
                                <tr  style="border-bottom:1px solid #AEAEAE;">
                                    <td width="26%">Username</td>
                                    <td width="1%">:</td>
                                    <td width="73%"><input type="text" name="txtNewUserName" id="txtNewUserName" class="inputbox" value="<?php echo @$selected_cluster[0]['user_name'];?>" /></td>                                    
                                </tr>
                                <tr>
                                    <td>Password</td>
                                    <td>:</td>
                                    <td><input type="password" name="txtNewPassword" id="txtNewPassword" class="inputbox" /><br />
                                    <?php echo (@$selected_cluster[0]['user_name']) ? "<br>( Leave password field blank, if you don't want to change the password. )" : '';?>
                                    </td>
                                <tr>                                                    
                        </table>
                    </div>                      
<!-- Create Users end --> 
<!-- Unclusterd schools start-->           
                	<div class="conthead">
                		<h3>School List</h3>
                    </div>
                	<div class="contentbox">                  
                        <table width="100%">
                            <thead>
                                <tr class="table_row_first"  bgcolor="#C0E0ED">
                                    <th width="8%" height="32">Sl.No</th>
                                  <th width="33%" >School</th>
                                  <th width="4%" ></th>
                                    <th width="9%">Sl.No</th>
                                    <th width="41%">School</th>
                                  <th width="5%"></th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php   if(count(@$schools) > 0 || count(@$selected_cluster_schools) > 0){?>
                                <tr><?php 
								 $newTR	=	0;
								 $rowClass	=	0;
					for($j=0; $j<count(@$selected_cluster_schools); $j++){					
					$data = array();
					if (in_array($selected_cluster_schools[$j]['school_code'],$entered_school))
					{
						$data = array(
								'name'        => $selected_cluster_schools[$j]['school_code'].'chk',
								'id'          => $selected_cluster_schools[$j]['school_code'].'chk',
								'value'       => $selected_cluster_schools[$j]['school_code'],
								'disabled'     => 'FALSE',
								'checked'     => 'TRUE',
								
								);
						?>
                        <input type="hidden" name="<?php echo $selected_cluster_schools[$j]['school_code'];?>" id="<?php echo $selected_cluster_schools[$j]['school_code'];?>" value="<?php echo $selected_cluster_schools[$j]['school_code'];?>" />
                        <?php
					}
					else
					{
						$data = array(
								'name'        => $selected_cluster_schools[$j]['school_code'],
								'id'          => $selected_cluster_schools[$j]['school_code'],
								'value'       => $selected_cluster_schools[$j]['school_code'],
								'checked'     => 'TRUE',
								);
					}
				  // $class_name = (($rowClass) % 2 == 0) ? 'table_row_first' : 'table_row_second';
				   $color = (($rowClass) % 2 == 0) ? '#E6F0DD' : '';
					if($newTR%2 == 0){
						$rowClass++;	
						//echo "<br /><br />".$class_name;				
					?>
					</tr>
					<tr style="border-top:1px solid #CFCFCF;" bgcolor="<? echo $color; ?>" >
					
					<?php
					}else $class_name	=	'table_row_second';												
					echo '<td >'.($newTR+1).'</td><td >';
					echo form_label($selected_cluster_schools[$j]['school_code'].' - '.$selected_cluster_schools[$j]['school_name'], $selected_cluster_schools[$j]['school_code']).'</td>';
					echo '<td >'.form_checkbox($data).'</td>';
					$newTR++;
				}
				for($i=0; $i<count(@$schools); $i++){
					if(count(@$selected_schools) > 0 && @$selected_schools[0] != 0){
						$checked	=	(in_array($user_rights[$i]['rf_id'], @$selected_user_rights)) ? 'TRUE' : '';
					} else {
							$checked	=	'';
					}
					$data = array(
								'name'        => $schools[$i]['school_code'],
								'id'          => $schools[$i]['school_code'],
								'value'       => $schools[$i]['school_code'],
								'checked'     => $checked
								);
					//$class_name = ($rowClass % 2 == 0) ? 'alt' : 'altNext';
					 $color = (($rowClass) % 2 == 0) ? '#E6F0DD' : '';
					if($newTR%2 == 0){
						$rowClass++;
					?>
					</tr>
					<tr style="border-top:1px solid #CFCFCF;" bgcolor="<? echo $color; ?>" >
					
					<?php
					}
					$newTR++;	
					echo '<td >'.$newTR.'</td><td >';
					echo form_label($schools[$i]['school_code'].' - '.$schools[$i]['school_name'], $schools[$i]['school_code']).'</td>';
					echo '<td >'.form_checkbox($data).'</td>';
					
					?>									
					<?php
					
				}
				}
				?>  
                 
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                    <?php if(@$selected_cluster[0]['user_name']){?>
                    <input type="button" name="updation" id="updation" value="Update User" class="btn" onClick="javascript: return fncUpdateCluster(<?php echo @$selected_cluster[0]['user_id'];?>)" />
                    <?php }else{?>
                    &nbsp; <input type="submit" name="insertion" id="insertion" value="Create User" class="btn" onClick="javascript: return fncAddCluster()" />
                    <?php }?>
                    <input type="hidden" name="hidUserId" id="hidUserId" />
                    </td>
                <tr>                                      
                            </tbody>
                        </table>  
                      </div>                      
<!--  Unclusterd schools end -->   
<!-- List Users start -->           
                	<div class="conthead">
                		<h3>Existing Users</h3>
                    </div>
                	<div class="contentbox">
                        <table width="100%">
                            <thead>
                                <tr class="table_row_first"  bgcolor="#C0E0ED">
                                    <th  align="center" height="34">Sl No</th>
                                  <th align="left">Username</th>
                                    <th  align="center">No of Schools</th>
                                    <th align="center">Edit</th>
                                    <th align="center">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php
								$i=0;
								foreach($existing_cluster as $value){				
								$color = (($i) % 2 == 0) ? '#E6F0DD' : '';					
								//	$class_name = ($i % 2 == 0) ? 'alt' : 'altNext';
									$i++;
								?>
                                <tr style="border-top:1px solid #CFCFCF;" bgcolor="<? echo $color; ?>" >
                                    <td align="center" ><?php echo $i; ?></td>
                                    <td align="justify" >&nbsp;<?php echo ($value['user_name']); ?></td>
                                    <td align="center" ><?php echo ($value['total']); ?></td>
                                    <td align="center" ><a href="javascript:void(0)" onClick="javascript:editUser('<?php echo $value['user_id']?>')">
                                    <img src="<?php echo base_url()?>images/icons/icon_edit.png" alt="Edit" /></a>
                                    </td>
                                    <td align="center" >
                                    <? if(!($this->Login_Model->is_cluster_enterd($value['user_name']))) { ?>
                                    <a href="javascript:void(0)" onClick="javascript:deleteUser('<?php echo $value['user_id']?>')" title=""><img src="<?php echo base_url()?>images/icons/icon_delete.png" alt="Delete" /></a>
                                     <? } ?>
                                    </td>
                                </tr>
								<?php }?>                                                  
                            </tbody>
                        </table>  
                        <input type="hidden" name="UserIdty" id="UserIdty" value="">
                      </div>                      
<!-- List Users end -->  
<?php echo form_close();?>
</div>