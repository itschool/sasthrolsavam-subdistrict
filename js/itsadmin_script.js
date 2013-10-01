//javascript

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

	function loadajaz_district(type){  
			
				if(type==''){ 
				alert("select type");
				document.getElementById('subdist_school').style.display="none";
				document.getElementById('admin_generate').style.display="none";
				document.getElementById('admin_generate2').style.display="none";
				document.getElementById('list_edudistdiv').style.display="none";
				document.getElementById('list_subdistdiv').style.display="none";
				document.getElementById('list_schooldiv').style.display="none";
				document.getElementById('admin_generate1').style.display="none";
				return false;	
				}
				else{
					//////////////////////////////////////////////////////////////
					if(type=='state_admin'){ 
					document.getElementById('head_distdiv').style.display="none";
					document.getElementById('districtdiv').style.display="none";
					document.getElementById('list_edudistdiv').style.display="none";
					document.getElementById('list_subdistdiv').style.display="none";
					document.getElementById('list_schooldiv').style.display="none";
					document.getElementById('subdist_school').style.display="none";
					document.getElementById('admin_generate').style.display="none";
					document.getElementById('admin_generate1').style.display="none";
					document.getElementById('admin_generate2').style.display="none";
					}
					else{
					
					/////////////////////////////////////////////////////////////////
					if(type=='district'){
					document.getElementById('Create Admin').value="Create District Admin";
					document.getElementById('admin_generate').style.display="block";
					}
					if(type=='deo'){
					document.getElementById('Create Admin').value="Create DEO Admin";
					document.getElementById('admin_generate').style.display="block";
					}
					if(type=='aeo'){
					document.getElementById('Create Admin').value="Create AEO Admin";
					document.getElementById('admin_generate').style.display="block";
					}
					if(type=='school_user'){
					document.getElementById('Create Admin').value="Create School Admin";
					document.getElementById('admin_generate').style.display="block";
					}
					document.getElementById('admin_generate1').style.display="none";
					document.getElementById('admin_generate2').style.display="none";
					document.getElementById('head_distdiv').style.display="block";
					document.getElementById('districtdiv').style.display="block";
					
					document.getElementById('list_edudistdiv').style.display="none";
					document.getElementById('list_subdistdiv').style.display="none";
					document.getElementById('list_schooldiv').style.display="none";
					document.getElementById('subdist_school').style.display="none";
					document.getElementById('head_distdiv').style.display="block";
					document.getElementById('districtdiv').style.display="block";
					}
				}
			
			}//function
	
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
				var usertype	=	document.getElementById('usertype').value;
				
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
				
				else{ document.getElementById('subdist_school').style.display="block";
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
					var url=baseurl+"index.php/admin/admin/loadajax_subdistrict/"+district;
					}
					if(usertype=='school_user'){
					var url=baseurl+"index.php/admin/admin/loadajax_school/"+district;
					}
					if(usertype=='deo'){
					var url=baseurl+"index.php/admin/admin/loadajax_edudistrict/"+district;
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
					
		function generate_loginuser(){
				var usertype	=	document.getElementById('usertype').value;
				if(usertype==''){
				return false;
				}
				else{  
					var baseUrl		=	document.getElementById('baseurl').value; 
					
					var url	=baseUrl+"index.php/admin/admin/generate_admin/"+usertype;
					document.getElementById('formUserCreation').action	=	url;	
					document.getElementById('formUserCreation').submit();
					}
					}//function
					
		function generate_loginuser1(){
				var usertype	=	document.getElementById('usertype').value;
				if(usertype==''){
				return false;
				}
				else if(usertype!='' && document.getElementById('district').value==''){
					alert("Please Select District");return false;
				}
				else{  
				var baseUrl		=	document.getElementById('baseurl').value; 
				
				var url	=baseUrl+"index.php/admin/admin/sub_generate_admin/"+usertype;
				document.getElementById('formUserCreation').action	=	url;	
				document.getElementById('formUserCreation').submit();
				}
				}//function
				
		function generate_loginuser2(){
				var usertype	=	document.getElementById('usertype').value;
				if(usertype==''){
				return false;
				}
				else if(usertype=='deo' && document.getElementById('edu_district').value==''){
					alert("Please Select Education District");return false;
				}
				else if(usertype=='aeo' && document.getElementById('sub_district').value==''){
					alert("Please Select Subdistrict");return false;
				}
				else if(usertype=='school_user' && document.getElementById('school').value==''){
					alert("Please Select School");return false;
				}
				
				else{  
				var baseUrl		=	document.getElementById('baseurl').value; 
				
				var url	=baseUrl+"index.php/admin/admin/subofsub_generate_admin/"+usertype;
				document.getElementById('formUserCreation').action	=	url;	
				document.getElementById('formUserCreation').submit();
				}
				}//function
		
	function loadTeacher(type,id,num){ 

			if((type=='') || (type==0)){ 
				//alert("Enter type");
				document.getElementById(id).innerHTML='';
				return false;	
				}
			else{
				
				xmlHttp=GetXmlHttpObject();
				if (xmlHttp)
				{
					var school_code = document.getElementById('school_code').value;
					var baseurl	=	document.getElementById('baseurl').value;
					var url=baseurl+"index.php/admin/admin/get_teacher/"+type+"/"+id+"/"+num+"/"+school_code;
				//alert('render'+num);
				xmlHttp.onreadystatechange = function stateChanged() 
				{ 
					if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
					{ 
					arrResponse	=	xmlHttp.responseText;
					
					document.getElementById(id).innerHTML=xmlHttp.responseText;
					//alert('render'+num);
					} 
				}
				var parameters="par_test=5";
//alert(document.designation_details.elements.length);
				for(i=0; i<document.designation_details.elements.length; i++)
				{
				parameters=parameters+'&'+document.designation_details.elements[i].name+'='+document.designation_details.elements[i].value;
				}
				//alert(parameters);
				xmlHttp.open("POST",url,true);
				xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xmlHttp.send(parameters);
				}
				}
			}//function
			
	function validateusercreation(){ 
			if(document.getElementById('usertype').value==''){
			alert('Select Usertype');return false;
			}
			
			if(document.getElementById('txtusername').value==''){ 
			alert('Please Enter Username');return false;
			}
			if(document.getElementById('txtpassword').value==''){
			alert('Please Enter Passsword');return false;
			}
			}//function 
	
	function deleteUser(user_name){ 
	var value	=	confirm("Do You Want to Delete");
	if(value){ 
			var baseUrl		=	document.getElementById('baseurl').value;
			var url	=baseUrl+"index.php/admin/admin/deleteUser/"+user_name;
			document.getElementById('formUserCreation').action	=	url;		
			document.getElementById('formUserCreation').submit();
			//document.getElementById('deleteuser').style.display="block";
	}
	else{
		return false;
	}
	}
	
	function enableEdit_button(username){ //alert(username);
		document.getElementById('hidusername').value=username;
		document.getElementById('txtusername').value=username;
		document.getElementById('txtusername').disabled="true";
		document.getElementById('Create User').style.display="none";
		document.getElementById('Update User').style.display="block";
		document.getElementById('editdiv').style.display="block";
		
		document.getElementById('usertypediv').style.display="none";
		document.getElementById('districtdiv').style.display="none";
		document.getElementById('head_typediv').style.display="none";
		document.getElementById('head_distdiv').style.display="none";
		document.getElementById('txtpassword').focus();
	}
	function updateUser(){
			document.getElementById('updateuser').style.display="block";
			var baseUrl		=	document.getElementById('baseurl').value;
			var url	=baseUrl+"index.php/admin/admin/updateUser";
			document.getElementById('formUserCreation').action	=	url;		
			document.getElementById('formUserCreation').submit();
	}

	function generate_admin_users_pdf(){ 
	var district_pdf		=	document.getElementById('district_pdf').value;
	var usertype_pdf		=	document.getElementById('usertype_pdf').value;
	if(usertype_pdf=='' && district_pdf!=''){
		alert("Please Select Type of User");return false;
	}
	else{
			var baseUrl		=	document.getElementById('baseurl').value;
			document.getElementById('generate_pdf').value=1;
			document.getElementById('formUserCreation').action = baseUrl+'index.php/admin/admin/generate_admin_users_pdf';
			document.getElementById('formUserCreation').target = '_blank'; 
			document.getElementById('formUserCreation').submit();
			document.getElementById('formUserCreation').target = '_self'; 
			//document.getElementById('formUserCreation').action = path+'user/admin_users/';
			}
	}//function
			
	function toLowercase(e,obj) {
			tecla = (document.all) ? e.keyCode : e.which;
			if (tecla!="8" && tecla!="0"){
			obj.value += String.fromCharCode(tecla).toLowerCase();
			return false;
			}else{
			return true;
			}
			} 	
			
	function enableEdit_button_notitsadmin(username){
		document.getElementById('hidusername').value=username;
		document.getElementById('txtusername').value=username;
		document.getElementById('txtusername').disabled="true";
		document.getElementById('editdiv').style.display="block";
		document.getElementById('txtpassword').focus();
	}
	
	function toUppercase(e,obj) {
			tecla = (document.all) ? e.keyCode : e.which;
			if (tecla!="8" && tecla!="0"){
			obj.value += String.fromCharCode(tecla).toUpperCase();
			return false;
			}else{
			return true;
			}
			} 	
	function numbersonly(myfield, e, dec)
{ 

		var key;
		var keychar;
		
		if (window.event)
			 key = window.event.keyCode;
		else if (e)
			 key = e.which;
		else
			 return true;
		keychar = String.fromCharCode(key);
		
		var val = myfield.value;
		if(val && keychar == '.'){
			if(val.split(".").length > 1){
				return false;
			}
		}
		
		// control keys
		if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27) )
			 return true;
		
		// numbers
		else if ((("0123456789").indexOf(keychar) > -1))
			 return true;
		
		// decimal point jump
		else if ((dec) && (keychar == "."))
			 {
			 //myfield.form.elements[dec].focus();
			 return true;
			 }
		else
			 return false;

}//numbers only		



function generate_admin_users_pdf_notitsadmin(){ 
		var usertype_pdf		=	document.getElementById('usertype_pdf').value;
		if(usertype_pdf==''){
		alert("Please Select Type of User");return false;
		}
		else{
		var baseUrl		=	document.getElementById('baseurl').value;
		document.getElementById('generate_pdf').value=1;
		document.getElementById('formUserCreation').action = baseUrl+'index.php/admin/admin/generate_admin_users_pdf_notitsadmin';
		document.getElementById('formUserCreation').target = '_blank'; 
		document.getElementById('formUserCreation').submit();
		document.getElementById('formUserCreation').target = '_self'; 
		//document.getElementById('formUserCreation').action = path+'user/admin_users/';
		}	
		}//function
//Adminl level 	User Creation		