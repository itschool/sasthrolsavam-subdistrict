// JavaScript Document
var xmlHttp;
function GetXmlHttpObject()
{
     var xmlHttp=null;
     try
     {
 // Firefox, Opera 8.0+, Safari
        xmlHttp=new XMLHttpRequest();
     }
     catch (e)
     {
 //Internet Explorer
        try
        {
             xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e)
        {
            xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
     }
     return xmlHttp;
} 



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
	if(document.getElementById('userType').value==0)
	{
		alert("select User type");
		document.getElementById('userType').focus();
		return false;
	}
	if(document.getElementById('userType').value > 1)
	{
		if(document.getElementById('cmbDistrict').value==0)
		{
			alert("select District");
			document.getElementById('cmbDistrict').focus();
			return false;
		}
	}
	if(document.getElementById('userType').value > 2)
	{
		if(document.getElementById('cmbSubDistrict').value==0)
		{
			alert("select Sub-District");
			document.getElementById('cmbSubDistrict').focus();
			return false;
		}
	}
	if(document.getElementById('userType').value > 3)
	{
		if(document.getElementById('cmbSchool').value==0)
		{
			alert("select School");
			document.getElementById('cmbSchool').focus();
			return false;
		}
	}
	
	
	return true;
	
}

function deleteUser(userId,UserType,UserName) {
	if(!confirm('Are you really want to delete the ' + UserType + ' ' + UserName+ '?')){
		return false;
	}
	document.getElementById('UserIdty').value = userId;
	document.getElementById('editUser').action = path+'index.php/user/admin_users/delete_admin_detials';
	document.getElementById('editUser').submit();
}

function editUser(userId) {
	document.getElementById('UserIdty').value = userId;
	document.getElementById('editUser').action = path+'index.php/user/admin_users/edit_admin_detials';
	document.getElementById('editUser').submit();
}

function fnsUserUpdate(userId){
	document.getElementById('hidUserId').value = userId;
	document.getElementById('formUser').action = path+'index.php/user/admin_users/update_admin_detials';
	document.getElementById('formUser').submit();
}

function cancel()
{
	document.getElementById('formUser').action = path+'index.php/user/admin_users/';
	document.getElementById('formUser').submit();
}

function loadDistrict()
{
	
	/*document.getElementById("divDistrict").style.display      = 'none';
	document.getElementById("divSubdistrict").style.display      = 'none';
	document.getElementById("divSchool").style.display      = 'none';
	


	if(document.getElementById("cmbDistrict"))
		document.getElementById('cmbDistrict').selectedIndex  = 0;
	if(document.getElementById('cmbSubDistrict'))
		document.getElementById('cmbSubDistrict').selectedIndex  = 0;
	if(document.getElementById('cmbSchool'))
		document.getElementById('cmbSchool').selectedIndex  = 0;
	
	if(document.getElementById('userType').value != 1){
		document.getElementById('divDistrict').style.display = 'block';	
	}
	
	
	if((document.getElementById('userType').value == 4) && (document.getElementById('show_generate_admin').value == 1))
	{
	
		//document.getElementById('divGenerateSubDistAdmin_user_type').innerHTML = '';
		document.getElementById('divGenerateSubDistAdmin_dist').innerHTML = '';
		document.getElementById('divGenerateSubDistAdmin_sub_dist').innerHTML = '';
	//	ajax_loder2 ('divGenerateSubDistAdmin_user_type');
		var user_type	= document.getElementById('userType').value;
		var oOptions = {
			method: "post",
			parameters: { 'user_type': user_type },
			onFailure: function (oXHR, oJson) {
				//alert("An error occurred: " + oXHR.status);
			},
			onSuccess: function(transport){
			   var response = transport.responseText;
			    document.getElementById("divGenerateSubDistAdmin_user_type").style.display = 'block';
			   document.getElementById("divGenerateSubDistAdmin_user_type").innerHTML = response;
		   }
		};
		
		var oRequest = new Ajax.Updater({ 
			//success: "divCustomerInfo"
		}, path+"index.php/ajax/loadajax/check_sub_dist_admin_exist", oOptions);	
		
	}*/
	//alert("yrty");
 	document.getElementById('divGenerateSubDistAdmin_user_type').innerHTML='';
	document.getElementById("divDistrict").style.display      = 'none';
	document.getElementById("divSubdistrict").style.display      = 'none';
	document.getElementById("divSchool").style.display      = 'none';
	


	if(document.getElementById("cmbDistrict"))
		document.getElementById('cmbDistrict').selectedIndex  = 0;
	if(document.getElementById('cmbSubDistrict'))
		document.getElementById('cmbSubDistrict').selectedIndex  = 0;
	if(document.getElementById('cmbSchool'))
		document.getElementById('cmbSchool').selectedIndex  = 0;
	
	if(document.getElementById('userType').value != 1){
		document.getElementById('divDistrict').style.display = 'block';	
	}
	
	
	if(((document.getElementById('userType').value == 4) || (document.getElementById('userType').value == 6)) && (document.getElementById('show_generate_admin').value == 1))
	{
			
	
				xmlHttp=GetXmlHttpObject();
				if (xmlHttp)
				{
					var baseurl	=	document.getElementById('base_url').value;
					
					if(document.getElementById('userType').value == 4)
					var url=baseurl+"index.php/ajax/loadajax/check_sub_dist_admin_exist";
					else if(document.getElementById('userType').value == 6)
					var url=baseurl+"index.php/ajax/loadajax/check_code_gen_admin_exist";
					
				xmlHttp.onreadystatechange = function stateChanged() 
				{ 
					if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
					{ 
						arrResponse	=	xmlHttp.responseText;
						
						document.getElementById('divGenerateSubDistAdmin_user_type').style.display='block';
						document.getElementById('divGenerateSubDistAdmin_user_type').innerHTML=xmlHttp.responseText;
						
					} 
				}
							
				//var parameters="par_test=5";
				/*for(i=0; i<document.$(formName).elements.length; i++)
				{
				parameters=parameters+'&'+document.$(formName).elements[i].name+'='+document.$(formName).elements[i].value;
				}*/
				
				xmlHttp.open("POST",url,true);
				xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xmlHttp.send();
				//xmlHttp.send(parameters);
				}
				}
			
}

function loadSubDistrict()
{
	
	if(document.getElementById('userType').value > 2)	
	{
		
		document.getElementById('divSubdistrict').style.display = 'block';	
		
		ajax_loder2('divSubdistrictCombo');
		if(document.getElementById('cmbSubDistrict'))
			document.getElementById('cmbSubDistrict').selectedIndex  = 0;
		if(document.getElementById('cmbSchool'))
			document.getElementById('cmbSchool').selectedIndex  = 0;
		
		var district_code	=	document.getElementById('cmbDistrict').value;
		
		
				xmlHttp=GetXmlHttpObject();
				if (xmlHttp)
				{
					var baseurl	=	document.getElementById('base_url').value;
				
					var url=baseurl+"index.php/ajax/loadajax/get_subdistrict_details/"+district_code;
					
				xmlHttp.onreadystatechange = function stateChanged() 
				{ 
					if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
					{ 
						arrResponse	=	xmlHttp.responseText;
						
						document.getElementById('divSubdistrictCombo').style.display='block';
						document.getElementById('divSubdistrictCombo').innerHTML=xmlHttp.responseText;
						
					} 
				}
							
			
				
				xmlHttp.open("POST",url,true);
				xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xmlHttp.send();
				
				}
				
		
	
	}
	
	/*if (document.getElementById('userType').value==3 &&  document.getElementById('cmbDistrict').value != 0 && document.getElementById('show_generate_admin').value == 1)
	{
		
		document.getElementById('divGenerateSubDistAdmin_user_type').innerHTML = '';
		document.getElementById('divGenerateSubDistAdmin_dist').innerHTML = '';
		document.getElementById('divGenerateSubDistAdmin_sub_dist').innerHTML = '';
		ajax_loder2 ('divGenerateSubDistAdmin_dist');
		
		var district_code	=	document.getElementById('cmbDistrict').value;
		alert("hhhhhhh");
				xmlHttp=GetXmlHttpObject();				
				if (xmlHttp)
				{
					
					var baseurl	=	document.getElementById('base_url').value;
					
					var url=baseurl+"index.php/ajax/loadajax/check_sub_dist_admin_exist"+district_code;
					
					
				xmlHttp.onreadystatechange = function stateChanged() 
				{ 
					if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
					{ 
						arrResponse	=	xmlHttp.responseText;
						
						document.getElementById('divGenerateSubDistAdmin_dist').style.display='block';
						document.getElementById('divGenerateSubDistAdmin_dist').innerHTML=xmlHttp.responseText;
						
					}
				
				}
							
			
				
				xmlHttp.open("POST",url,true);
				xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xmlHttp.send();
				
				}
		
	}*/
}

function loadSchool()
{
	if(document.getElementById('userType').value > 3)	
	{//alert("sfwsrf");
		document.getElementById('divSchool').style.display = 'block';	
		ajax_loder2('divSchoolCombo');
		if(document.getElementById('cmbSchool'))
			document.getElementById('cmbSchool').selectedIndex  = 0;
		
		var subdistrict_code	=	document.getElementById('cmbSubDistrict').value;
		//alert(subdistrict_code);
			xmlHttp=GetXmlHttpObject();
				if (xmlHttp)
				{
					var baseurl	=	document.getElementById('base_url').value;
					//alert(baseurl);
					var url=baseurl+"index.php/ajax/loadajax/get_school_details/"+subdistrict_code;
					
				xmlHttp.onreadystatechange = function stateChanged() 
				{ 
					if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
					{ 
						arrResponse	=	xmlHttp.responseText;
						
						document.getElementById('divSchoolCombo').style.display='block';
						document.getElementById('divSchoolCombo').innerHTML=xmlHttp.responseText;
						
					}
				
				}
							
			
				
				xmlHttp.open("POST",url,true);
				xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xmlHttp.send();
				
				}
	
	}
	if ((document.getElementById('userType').value==4 || document.getElementById('userType').value==6) &&  document.getElementById('cmbDistrict').value != 0 &&  document.getElementById('cmbSubDistrict').value != 0 && document.getElementById('show_generate_admin').value == 1)
	{
		
		document.getElementById('divGenerateSubDistAdmin_user_type').innerHTML = '';
		document.getElementById('divGenerateSubDistAdmin_dist').innerHTML = '';
		document.getElementById('divGenerateSubDistAdmin_sub_dist').innerHTML = '';
		ajax_loder2 ('divGenerateSubDistAdmin_sub_dist');
		var district_code	=	document.getElementById('cmbDistrict').value;
		var sub_district_code	=	document.getElementById('cmbSubDistrict').value;
		
			xmlHttp=GetXmlHttpObject();
				if (xmlHttp)
				{
					var baseurl	=	document.getElementById('base_url').value;
					
					if(document.getElementById('userType').value == 4)
					var url=baseurl+"index.php/ajax/loadajax/check_sub_dist_admin_exist";
					else if(document.getElementById('userType').value == 6)
					var url=baseurl+"index.php/ajax/loadajax/check_code_gen_admin_exist";
					
									
				xmlHttp.onreadystatechange = function stateChanged() 
				{ 
					if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
					{ 
						arrResponse	=	xmlHttp.responseText;
						
						document.getElementById('divGenerateSubDistAdmin_sub_dist').style.display='block';
						document.getElementById('divGenerateSubDistAdmin_sub_dist').innerHTML=xmlHttp.responseText;
						
					}
				
				}
							
			
				
				xmlHttp.open("POST",url,true);
				xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xmlHttp.send();
				
				}
				
				
		
	}
}






function loadDistrictFilter()
{

		document.getElementById('divDistrictFilter').style.display = 'none';	
		document.getElementById('divSubDistrictFilter').style.display = 'none';	
		document.getElementById('divSchoolFilter').style.display = 'none';	
		
		if(document.getElementById('cmbDistrictFilters'))
			document.getElementById('cmbDistrictFilters').selectedIndex  = 0;
		if(document.getElementById('cmbSubDistrictFilter'))
			document.getElementById('cmbSubDistrictFilter').selectedIndex  = 0;
		if(document.getElementById('cmbSchoolFilter'))
		document.getElementById('cmbSchoolFilter').selectedIndex  = 0;
	if(document.getElementById('userTypeFilters').value > 1){
		document.getElementById('divDistrictFilter').style.display = 'block';	
	}
	else
	{
		document.getElementById('divDistrictFilter').style.display = 'none';	
		}
}

function loadSubDistrictFilter()
{
	
	if(document.getElementById('userTypeFilters').value > 2)	
	{
		document.getElementById('divSubDistrictFilter').style.display = 'block';	
		//ajax_loder2('divSubDistrictFilter');
		if(document.getElementById('cmbSubDistrictFilter'))
			document.getElementById('cmbSubDistrictFilter').selectedIndex  = 0;
		if(document.getElementById('cmbSchoolFilter'))
			document.getElementById('cmbSchoolFilter').selectedIndex  = 0;
		
		var district_code	=	document.getElementById('cmbDistrictFilters').value;
		
		
			
	
				xmlHttp=GetXmlHttpObject();
				if (xmlHttp)
				{
					var baseurl	=	document.getElementById('base_url').value;
					
					var url=baseurl+"index.php/ajax/loadajax/get_subdistrict_details_small/"+district_code+"/cmbSubDistrictFilter/loadSchoolFilter";
					
				xmlHttp.onreadystatechange = function stateChanged() 
				{ 
					if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
					{ 
						arrResponse	=	xmlHttp.responseText;
						
						document.getElementById('divSubDistrictFilter').style.display='block';
						document.getElementById('divSubDistrictFilter').innerHTML=xmlHttp.responseText;
						
					} 
				}
							
				//var parameters="par_test=5";
				/*for(i=0; i<document.$(formName).elements.length; i++)
				{
				parameters=parameters+'&'+document.$(formName).elements[i].name+'='+document.$(formName).elements[i].value;
				}*/
				
				xmlHttp.open("POST",url,true);
				xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xmlHttp.send();
				//xmlHttp.send(parameters);
				}
				
				
		/*var oOptions = {
			method: "post",
			parameters: { 'district': district_code, 'name':'cmbSubDistrictFilter', 'function':'loadSchoolFilter'},
			onFailure: function (oXHR, oJson) {
				//alert("An error occurred: " + oXHR.status);
			},
			onSuccess: function(transport){
			   var response = transport.responseText;
			   document.getElementById('divSubDistrictFilter').innerHTML = response;
		   }
		};
		//
		var oRequest = new Ajax.Updater({ 
			//success: "divCustomerInfo"
		}, path+"index.php/ajax/loadajax/get_subdistrict_details_small", oOptions);	*/
	}
}

function loadSchoolFilter()
{
	if(document.getElementById('userTypeFilter').value > 3)	
	{
		document.getElementById('divSchoolFilter').style.display = 'block';	
		ajax_loder2('divSchoolFilter');
		if(document.getElementById('cmbSchoolFilter'))
			document.getElementById('cmbSchoolFilter').selectedIndex  = 0;
		
		var subdistrict_code	=	document.getElementById('cmbSubDistrictFilter').value;
		var oOptions = {
			method: "post",
			parameters: { 'subdistrict': subdistrict_code, 'name':'cmbSchoolFilter'},
			onFailure: function (oXHR, oJson) {
				//alert("An error occurred: " + oXHR.status);
			},
			onSuccess: function(transport){
			   var response = transport.responseText;
			   document.getElementById('divSchoolFilter').innerHTML = response;
		   }
		};
		var oRequest = new Ajax.Updater({ 
			//success: "divCustomerInfo"
		}, path+"index.php/ajax/loadajax/get_school_details_small", oOptions);	
	}
}
function generateSubDistAdmin ()
{

	document.formUser.action = path+'index.php/user/admin_users/generate_sub_dist_admins';
	document.formUser.submit();
}
function generateCodeGenAdmin ()
{

	document.formUser.action = path+'index.php/user/admin_users/generate_code_gen_admins';
	document.formUser.submit();
}
function generate_sub_dist_admin_pdf()
{
	$('generate_pdf').value=1;
	$('filter').action = path+'user/admin_users/sub_district_admin_list_pdf_creation';
	$('filter').target = '_blank'; 
	$('filter').submit();
	$('filter').target = '_self'; 
	$('filter').action = path+'user/admin_users/';
}


///////////////////////////////////////////////////////////////pdf list//////////////////////////////////

function suubofsub_usercreation(value){
				
				var usertype	=	document.getElementById('usertype').value;
				
				if(value==''){ 
				alert("select type");
				//document.getElementById('subdist_school').style.display="none";
				return false;	
				}
				
				else{ 
					if(usertype=='deo'){
					document.getElementById('Create Admin2').value="Create DEO Admin";
					document.getElementById('admin_generate1').style.display="none";
					document.getElementById('admin_generate').style.display="none";
					document.getElementById('admin_generate2').style.display="block";
					}
					if(usertype=='aeo'){
					document.getElementById('Create Admin2').value="Create AEO Admin";
					document.getElementById('admin_generate1').style.display="none";
					document.getElementById('admin_generate').style.display="none";
					document.getElementById('admin_generate2').style.display="block";
					}
					if(usertype=='school_user'){
					document.getElementById('Create Admin2').value="Create School Admin";
					document.getElementById('admin_generate1').style.display="none";
					document.getElementById('admin_generate').style.display="none";
					document.getElementById('admin_generate2').style.display="block";
					}
				}
				}//function
			
function loadsubdistricts_schools(district){
		var usertype	=	document.getElementById('usertype_pdf').value;
		
		if(district==''){ 
			alert("select type");
			//document.getElementById('subdist_school').style.display="none";
			document.getElementById('list_edudistdiv').style.display="none";
			document.getElementById('list_subdistdiv').style.display="none";
			document.getElementById('list_schooldiv').style.display="none";
			document.getElementById('admin_generate2').style.display="none";
			document.getElementById('subdist_school').style.display="none";
			return false;	
		}
		
		else{ 
			document.getElementById('subdist_school').style.display="block";
			if(usertype=='district'){
				document.getElementById('subdist_school').style.display="none";	
				document.getElementById('Create Admin1').value="Create District Admin";
				document.getElementById('admin_generate1').style.display="block";
				document.getElementById('admin_generate').style.display="none";
			}
			if(usertype=='deo'){
				document.getElementById('subdist_school').style.display="block";
				document.getElementById('Create Admin1').value="Create DEO Admin";
				document.getElementById('admin_generate1').style.display="block";
				document.getElementById('admin_generate').style.display="none";
				document.getElementById('list_edudistdiv').style.display="block";
				document.getElementById('list_subdistdiv').style.display="none";
				document.getElementById('list_schooldiv').style.display="none";
			}
			if(usertype=='aeo'){
				document.getElementById('subdist_school').style.display="block";
				document.getElementById('Create Admin1').value="Create AEO Admin";
				document.getElementById('admin_generate1').style.display="block";
				document.getElementById('admin_generate').style.display="none";
				document.getElementById('list_subdistdiv').style.display="block";
				document.getElementById('list_edudistdiv').style.display="none";
				document.getElementById('list_schooldiv').style.display="none";
			}
			if(usertype=='school_user'){
				document.getElementById('subdist_school').style.display="block";
				document.getElementById('Create Admin1').value="Create School Admin";
				document.getElementById('admin_generate1').style.display="block";
				document.getElementById('admin_generate').style.display="none";
				document.getElementById('list_schooldiv').style.display="block";
				document.getElementById('list_edudistdiv').style.display="none";
				document.getElementById('list_subdistdiv').style.display="none";
			}
			
			
			xmlHttp=GetXmlHttpObject();
			if (xmlHttp)
			{
				var baseurl	=	document.getElementById('baseurl').value;
				if(usertype=='aeo'){
				var url=baseurl+"index.php/home/loadajax_subdistrict/"+district;
				}
				if(usertype=='school_user'){
				var url=baseurl+"index.php/home/loadajax_school/"+district;
				}
				if(usertype=='deo'){
				var url=baseurl+"index.php/home/loadajax_edudistrict/"+district;
				}
				
				
				xmlHttp.onreadystatechange = function stateChanged() 
				{ 
				if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
				{ 
				arrResponse	=	xmlHttp.responseText;
				
				document.getElementById('subdist_school').innerHTML=xmlHttp.responseText;
				
				} 
				}
				xmlHttp.open("POST",url,true);
				xmlHttp.send(null);
			}
		}
}//function

