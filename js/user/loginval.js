// JavaScript Document
function fnsUserAdd()
{
	if(!document.getElementById('txtNewUserName').value)
	{
		alert("Please Enter User name");
		document.getElementById('txtNewUserName').focus();
		return false;
	}
	if(!document.getElementById('txtNewPassword').value)
	{
		alert("Please Enter Password");
		document.getElementById('txtNewPassword').focus();
		return false;
	}
	if(document.getElementById('cmbFairType').value == 0)
	{
		alert("Please Select The Fair Type");
		document.getElementById('cmbFairType').focus();
		return false;
	}
	/*if(document.getElementById('userType').value==0)
	{
		alert("select User type");
		document.getElementById('userType').focus();
		return false;
	}*/
	return true;
	
}

function deleteAdminUser(userId) {
	if(!confirm('Really want to delete the user?')){
		return false;
	}
	document.getElementById('UserIdty').value = userId;
	document.getElementById('editUser').action = path+'index.php/user/user_registration/delete_user_detials';
	document.getElementById('editUser').submit();
}

function editAdminUser(userId) {
	
	document.getElementById('UserIdty').value = userId;
	document.getElementById('editUser').action = path+'index.php/user/user_registration/edit_user_detials';
	document.getElementById('editUser').submit();
}

function fnsUserUpdate(userId){

	if(!document.getElementById('txtNewUserName').value)
	{
		alert("Please Enter User name");
		document.getElementById('txtNewUserName').focus();
		return false;
	}
	if(!document.getElementById('txtNewPassword').value)
	{
		alert("Please Enter Password");
		document.getElementById('txtNewPassword').focus();
		return false;
	}
	
	if(document.getElementById('cmbFairType').value == 0)
	{
		alert("Please Select The Fair Type");
		document.getElementById('cmbFairType').focus();
		return false;
	}
	
	document.getElementById('hidUserId').value = userId;
	document.getElementById('formUser').action = path+'index.php/user/user_registration/update_user_detials';
	document.getElementById('formUser').submit();
}

function cancel()
{
	document.getElementById('formUser').action = path+'index.php/user/user_registration/';
	document.getElementById('formUser').submit();
}