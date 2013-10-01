<?php if($this->session->userdata('USER_TYPE')!=''){ ?>
<script type="text/javascript" src="<?php echo base_url();?>js/itsadmin_script.js"></script>
<style type="text/css">
<!--
.style2 {
	color: #666666;
	font-weight: bold;
	height:20px;
}
.formlistbox {border: 1px solid #999; }
#contentExtended {-moz-border-radius: 4px; border-radius: 4px; -webkit-border-radius: 4px; padding: 5px; background: #4f4f4f; clear: both; position: relative; top: 10px; min-height: 1500px; }
-->
</style>
<div class="container half left">
    <div class="conthead">
        <h2>Create / View Users</h2>
    </div>
<div class="contentbox">
<?php echo form_open('admin/admin/save_createdUser',array('id' => 'formUserCreation','name' => 'formUserCreation')); ?>
<input type="hidden" name="baseurl" id="baseurl" value="<?php echo base_url();?>" /><br />
<div id="deleteuser" style="size:14px; color:#FF0000;"><strong><?php echo @$msg;?></strong></div>
<div id="updateuser" style=" size:14px; color:#FF0000;"><strong><?php echo @$updatemsg;?></strong></div><br />
<div style="padding-left:100px;">
<!--<table border="1"><tr><td>-->
<table cellpadding="0" cellspacing="0"  >
  <tr>
    <td width="171" class="style2">User Name</td>
    <td colspan="2">
      <input type="text" name="txtusername" id="txtusername" class="inputbox" />
      <input type="hidden" id="hidusername" name="hidusername" />
   </td>
     
  </tr>
  <tr>
    <td class="style2">Password</td>
    <td colspan="2">
      <input type="password" name="txtpassword" id="txtpassword" class="inputbox"/>
      <div id="editdiv" style="display:none;">( Leave password field blank, if you don't want to change the password. )</div>
      <br /><input type="submit" name="Update User" id="Update User" value="Update User" class="btn" onclick="return updateUser();" style="display:none;"/>
    </td>
     
  </tr>
  <tr>
    <td class="style2"><div id="head_typediv">Select Type</div></td>
    <td width="323" ><div id="usertypediv">
      <select name="usertype" id="usertype" onchange="return loadajaz_district(this.value);" class="inputbox" style="width:321px;">
      <option value="">Select type</option>
      <option value="state_admin">State admin</option>
      <option value="district">District admin</option>
      <option value="aeo">Sub District Admin</option>
      </select></div>
    </td>
     <td width="46" class="style2">
       <div align="left" style="display:none" id="admin_generate"><input type="submit" name="Create Admin" id="Create Admin" value="Create  Admin"  onclick="return generate_loginuser();" style="border:1px solid #999999;"/></div>
       
     </td>
  </tr>
  <tr>
    <td class="style2"><div id="head_distdiv">Select District</div></td>
    <td ><div id="districtdiv">
    <select name="district" id="district" onchange="return loadsubdistricts_schools(this.value);" class="inputbox" style="width:321px;">
      <option value="">Select district</option>
      <?php foreach($districtdetails as $row){ ?>
      <option value="<?php echo $row['rev_district_code'];?>"><?php echo $row['rev_district_name'];?></option>
      <?php } ?>
      </select></div>
   <!-- <div align="center" id="district" ></div>-->
    </td>
     <td class="style2"><div align="left" style="display:none" id="admin_generate1"><input type="submit" name="Create Admin1" id="Create Admin1" value="Create  Admin"  onclick="return generate_loginuser1();" style="border:1px solid #999999;"/></div></td>
  </tr>
<!--</table>
<div align="center" id="subdist_school" style="width:34%; margin-left:490px;background-color:#EBEBD8;"></div>
<table width="446" border="1" align="center" cellpadding="2" cellspacing="1" bordercolor="#FFFFFF" bgcolor="#EBEBD8">-->
  <tr><td><div id="list_edudistdiv" style="display:none;"><strong>Select Education District</strong></div>
  <div id="list_subdistdiv" style="display:none;"><strong>Select Subdistrict</strong></div><div id="list_schooldiv" style="display:none;"><strong>Select School</strong></div></td>
    <td height="19" >
    <div align="left" id="subdist_school"></div>
    </td>
    <td class="style2"><div align="left" style="display:none" id="admin_generate2"><input type="submit" name="Create Admin2" id="Create Admin2" value="Create  Admin"  onclick="return generate_loginuser2();" style="border:1px solid #999999;"/></div></td>
  </tr>
   <tr>
    <td height="24" ></td>
    <td align="center">
    <input type="submit" name="Create User" id="Create User" value="Create User" class="btn" onclick="return validateusercreation();"/>
    
   </td> <td ></td>
  </tr>
</table><!--</td></tr></table>--></div>
<br /><br /><br />
<?php //if($userdetails!='null'){ ?>

<?php //} ?>

<div id="tablewrapper">
		<div id="tableheader">
        	<div class="search">
        	  <select name="columns" id="columns" onchange="sorter.search('query')">
      	    </select>
        	  <input type="text" id="query" onKeyUp="sorter.search('query')" />
            </div>
    <span class="details">
				<div>Records <span id="startrecord"></span>-<span id="endrecord"></span> of <span id="totalrecords"></span></div>
        		<div><a href="javascript:sorter.reset()">reset</a></div> 
                
        	</span>
        </div>
        <div>
        <table><tr><td >
      <select name="usertype_pdf" id="usertype_pdf"  class="formlistbox" >
      <option value="">Select type</option>
      <option value="district">District admin</option>
      <option value="aeo">AEO</option>
       <option value="school_user">School User</option>
      </select></td>
      <td><select name="district_pdf" id="district_pdf"  class="formlistbox" onchange="loadsubdistricts_schools();">
      <option value="">Select district</option>
      <?php foreach($districtdetails as $row){ ?>
      <option value="<?php echo $row['rev_district_code'];?>"><?php echo $row['rev_district_name'];?></option>
      <?php } ?>
      </select>
       <input type="button" value="Generate pdf" name="Generatepdf" id="Generatepdf" onclick="javascript:generate_admin_users_pdf();" />
      </td>
      <td width="95">
		 	<input type="hidden" name="generate_pdf" id="generate_pdf" />
           
        	<?php //echo '<input value="Generate pdf" type="button" onclick="javascript:generate_admin_users_pdf();return false;" style="color:#FFFFFF;"/>';?>
            </td></tr></table>
        </div>
        <table cellpadding="0" cellspacing="0" border="0" id="table" class="tinytable">
            <thead>
                <tr>
                    <th><h3>SlNo</h3></th>
                    <th><h3>User Name</h3></th>
                    <th><h3>User Type</h3></th>
                    <th><h3>District/DEO/AEO/School </h3></th>
                    <th><h3>Generated Password</h3></th>
                  <th class="nosort"><h3>Edit</h3></th>
                    <th class="nosort"><h3>Delete</h3></th>
                </tr>
            </thead>
            <tbody>
            <?php 
			//var_dump($allUsers);
			$slNo	=	0;
			foreach($allUsers['createdusers'] as $user){ $slNo++; 
					$generated_password	=	$user['generated_password'];
		
				$user_name	=	$user['user_name'];
				if($user['user_type']		==	1)
					$usertype	=	'State Admin';
				else if($user['user_type']	==	2)
					$usertype	=	'District Admin';
				else if($user['user_type']	==	3)
					$usertype	=	'DEO Admin';
				else if($user['user_type']	==	4)
					$usertype	=	'AEO Admin';
				else if($user['user_type']	==	5)
					$usertype	=	'School Admin';
			?>
                <tr>
                    <td><?php echo $slNo;?></td>
                    <td>&nbsp;<?php echo $user_name;?></td>
                    <td>&nbsp;<?php echo $usertype;?></td>
                    <td>&nbsp;<?php  if($user['user_type']!=1){ echo @$allUsers[$user_name];} ?></td>
                    <td>&nbsp;<?php echo $user['generated_password'];?></td>
                    <td>&nbsp;<a href="javascript:void(0);"  onclick="javascript:enableEdit_button(<?php echo "'".$user_name."'";?>);"><img src="<?php echo base_url()?>images/user_edit.png" width="30" height="30"></a></td>
                    <td>&nbsp;<?php if($user['user_type']!=1){?><a href="#" onclick="return deleteUser(<?php echo "'".$user_name."'";?>);"><img src="<?php echo base_url()?>images/user_delete.png"width="30" height="30"></a><?php } ?></td>
            </tr>
               <?php }?>                
            </tbody>
        </table>
        <div id="tablefooter">
          <div id="tablenav">
            	<div>
                  <img src="<?php echo base_url()?>images/sorttableimages/first.gif" width="16" height="16" alt="First Page" onClick="sorter.move(-1,true)" />
                  <img src="<?php echo base_url()?>images/sorttableimages/previous.gif" width="16" height="16" alt="First Page" onClick="sorter.move(-1)" />
                  <img src="<?php echo base_url()?>images/sorttableimages/next.gif" width="16" height="16" alt="First Page" onClick="sorter.move(1)" />
                  <img src="<?php echo base_url()?>images/sorttableimages/last.gif" width="16" height="16" alt="Last Page" onClick="sorter.move(1,true)" />
                </div>
                <div>
                	<select id="pagedropdown"></select>
				</div>
                <div>
                	<a href="javascript:sorter.showall()">view all</a>
                </div>
          </div>
			<div id="tablelocation">
            	<div>
                    <select onChange="sorter.size(this.value)">
                    <option value="5">5</option>
                        <option value="10" selected="selected">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span>Entries Per Page</span>
                </div>
                <div class="page">Page <span id="currentpage"></span> of <span id="totalpages"></span></div>
            </div>
        </div>
  </div>
  <br /><br />
	<script type="text/javascript" src="<?php echo base_url();?>js/script.js"></script>
	<script type="text/javascript">
	var sorter = new TINY.table.sorter('sorter','table',{
		headclass:'head',
		ascclass:'asc',
		descclass:'desc',
		evenclass:'evenrow',
		oddclass:'oddrow',
		evenselclass:'evenselected',
		oddselclass:'oddselected',
		paginate:true,
		size:10,
		colddid:'columns',
		currentid:'currentpage',
		totalid:'totalpages',
		startingrecid:'startrecord',
		endingrecid:'endrecord',
		totalrecid:'totalrecords',
		hoverid:'selectedrow',
		pageddid:'pagedropdown',
		navid:'tablenav',
		sortcolumn:0,
		sortdir:0,
		columns:[],
		init:true
	});
  </script>
<?php echo form_close();?>
</div>
</div>
<?php }?>
