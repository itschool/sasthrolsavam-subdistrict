// JavaScript Document
function fncAddCluster()
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
	return true;
	
}

function editUser(userId) {
	document.getElementById('UserIdty').value = userId;
	document.getElementById('createUser').action = path+'index.php/admin/user_cluster/edit_user_cluster';
	document.getElementById('createUser').submit();
}

function fncUpdateCluster(userId){
	document.getElementById('hidUserId').value = userId;
	document.getElementById('createUser').action = path+'index.php/admin/user_cluster/update_user_cluster';	
	document.getElementById('createUser').submit();
}

function deleteUser(userId) {
	if(!confirm('Really want to delete the user?')){
		return false;
	}
	document.getElementById('UserIdty').value = userId;
	document.getElementById('createUser').action = path+'index.php/admin/user_cluster/delete_user_cluster';
	document.getElementById('createUser').submit();
}




function cancel()
{
	$('formUser').action = path+'user/admin_users/';
	$('formUser').submit();
}
function cancel_cluster()
{
	$('formUser').action = path+'user/user_cluster/';
	$('formUser').submit();
}



