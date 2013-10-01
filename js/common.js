// JavaScript Document

function ltrim(str) { for(var k = 0; k < str.length && isWhitespace(str.charAt(k)); k++); return str.substring(k, str.length);}
function rtrim(str) { for(var j=str.length-1; j>=0 && isWhitespace(str.charAt(j)) ; j--) ; return str.substring(0,j+1);}
function trim(str) {return ltrim(rtrim(str));}
function isAlphaNumeric(val){if (val.match(/^[a-zA-Z0-9]+$/)){ return true;}else{return false;} }
function isWhitespace(charToCheck) { var whitespaceChars = " \t\n\r\f"; return (whitespaceChars.indexOf(charToCheck) != -1);}
var delete_msg = 'Do you really want to delete?';

function ajax_loder(ele){ $(ele).innerHTML = '<img src="'+image_path+'ajax_loader.gif">'; }
function ajax_loder2(ele){ $(ele).innerHTML = '<img src="'+image_path+'ajax_loader2.gif">'; }

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

function white_space(field)
{
 	document.getElementById(field).value = document.getElementById(field).value.replace(/[^a-zA-Z0-9]+/, "");
}


function goto_print()
{
	var schoolcode	=	document.getElementById('schoolcode').value;
	var fairid		=	document.getElementById('fairid').value;
	var path 		=   document.getElementById("base_url").value;
	var exb=0;
	if(fairid==4)
	var exb	=	document.getElementById('exb').value;
	
	if(fairid==1)
	{
		document.scienceSchool.action = path+'index.php/school/registration/school_entry_print/'+schoolcode+'/'+fairid+'/0';
		document.scienceSchool.submit();
	}
	
	if(fairid==2)
	{
		document.mathsSchool.action = path+'index.php/school/registration/school_entry_print/'+schoolcode+'/'+fairid+'/0';
		document.mathsSchool.submit();
	}
	
	if(fairid==3)
	{
		document.socialscienceEntry.action = path+'index.php/school/registration/school_entry_print/'+schoolcode+'/'+fairid+'/0';
		document.socialscienceEntry.submit();
	}
	if(fairid==4)
	{
		 if(exb==0){
		 document.workexp_onEntry.action = path+'index.php/school/registration/school_entry_print/'+schoolcode+'/'+fairid+'/0';
		 document.workexp_onEntry.submit();
		 }
		 else
		 {
		 document.workexp_exbEntry.action = path+'index.php/school/registration/school_entry_print/'+schoolcode+'/'+fairid+'/2';
		 document.workexp_exbEntry.submit();
		 }
	}
	if(fairid==5)
	{
		document.ITEntry.action = path+'index.php/school/registration/school_entry_print/'+schoolcode+'/'+fairid+'/0';
		document.ITEntry.submit();
	}
	
}


function validate_changePassword(){
			if(document.getElementById('password').value==''){
			alert("Please Enter Password");
			document.getElementById('password').focus();
			return false;
			}
			if(document.getElementById('newPassword').value==''){
			alert("Please Enter New Password");
			document.getElementById('newPassword').focus();
			return false;
			}
			if(document.getElementById('newPassword').value != '')
			{
				var newpwd =document.getElementById('newPassword').value;
				var newlength=newpwd.length;
				newlength	=	newlength * 1;
				//alert(newlength);
				if(newlength < 6)
				{
					//alert(parseInt(newlength);
					alert("New password should have minimum length 6");
					document.getElementById('newPassword').focus();
					return false;
				}
			}
			 if(document.getElementById('retype_password').value==''){
			alert("Please Enter Retype Password");
			document.getElementById('retype_password').focus();
			return false;
			}
			if(document.getElementById('newPassword').value!=document.getElementById('retype_password').value){
			alert("New Password and Retype Password are not match");
			document.getElementById('retype_password').focus();
			return false;
			}
			if(document.getElementById('name').value==''){
			alert("Please Enter Name");
			document.getElementById('name').focus();
			return false;
			}
			if(document.getElementById('mobile').value==''){
			alert("Please Enter Mobile");
			document.getElementById('mobile').focus();
			return false;
			}
			if(document.getElementById('email').value==''){
			alert("Please Enter Valid Email");
			document.getElementById('email').focus();
			return false;
			}
			
			var baseUrl		=	document.getElementById('baseurl').value;
			var url	=baseUrl+"index.php/welcome/change_password";
			document.getElementById('formtemplate').action	=	url;		
			document.getElementById('formtemplate').submit();
			
			}//function
//15017
//779
/*function fetch_school_details()
{
	//alert("binojjjjjjjjjjjj");
	
	//alert(sportsId);
	
	var school_code	=	document.getElementById('txtSchoolCode').value;
	alert(school_code);
	path = document.getElementById("base_url").value;
	alert(path);
			//document.formSchoolList.action = path+'index.php/schools/school_reset/'+school_code;
			//document.formSchoolList.submit();
	/*ajax_loder2('divSchoolCode');*/
/*	var oOptions = {
		method: "post",
		parameters: { 'code': school_code},
		onFailure: function (oXHR, oJson) {
			//alert("An error occurred: " + oXHR.status);
		},
		onSuccess: function(transport){
		   var response = transport.responseText;
		   
		  document.getElementById('divEntryForm').innerHTML = response;
	   }
	};
	var oRequest = new Ajax.Updater({ 
		//success: "divCustomerInfo"
	}, path+"school/registration/get_school_details", oOptions);	
}
*/

function isValidEmail(email){
	var filter=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;if (filter.test(email)){ return true; }else{ return false; }
}

function toUppercase(e,obj) {
			tecla = (document.all) ? e.keyCode : e.which;
			if (tecla!="8" && tecla!="0"){
			obj.value += String.fromCharCode(tecla).toUpperCase();
			return false;
			}
			else{
			return true;
			}
			} //function
			
function numbersonly(myfield, e, dec){ 
//alert('txtParticipantId-------->'+document.getElementById('txtParticipantId').value);
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
		if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27) ){
			//myfield.form.elements[dec].focus();
			//document.getElementById('txtParticipantId').focus();
			 return true;
		}
		
		// numbers
		else if ((("0123456789").indexOf(keychar) > -1)){
			//myfield.form.elements[dec].focus();
			//document.getElementById('txtParticipantId').focus();
			 return true;
		}
		
		// decimal point jump
		else if ((dec) && (keychar == "."))
			 {
			 //myfield.form.elements[dec].focus();
			// document.getElementById('txtParticipantId').focus();
			 return true;
			 }
		else
			 return false;
			 //document.getElementById('txtParticipantId').focus();
}

function display_wrkexp_type(fairid)
{
	//cmbWrkexpType
	if(fairid==4)document.getElementById('divWrkexp').style.display='block';
	else {document.getElementById('divWrkexp').style.display='none';document.getElementById('cmbFestType').disabled =false;}
	
	var festid=0;
	var festid	=	document.getElementById('cmbFestType').value;
	if(festid) fetch_items(festid);
	
}

function fetch_items(festid)
{
	//alert('hiii');
	
	var fairid	=	document.getElementById('cmbFairType').value;

	if(fairid != 0){
	ajax_loder2('cmbitem');
		
	xmlHttp=GetXmlHttpObject();
	if (xmlHttp)
	{
		var wrkexp_type = 0;
		if(fairid==4){
			
			if(document.getElementById('cmbWrkexpType').value==2)wrkexp_type = 2;
		}
							
							
		var url=path+"index.php/ajax/loadajax/fetch_items_for_special_order/"+festid+"/"+fairid+"/"+wrkexp_type;
		//alert(url);
		xmlHttp.onreadystatechange = function stateChanged() 
		{ 
			if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
			{ 
				arrResponse	=	xmlHttp.responseText;
				//cmbFestType
				document.getElementById('cmbFestType').disabled =false;
			/*	if(fairid==4){
						if(document.getElementById('cmbWrkexpType').value==2){
							document.getElementById('cmbFestType').disabled =true;
							document.getElementById('cmbFestType').value =0;
						
							}
						else {
							document.getElementById('cmbFestType').disabled =false;
							
							}
						}*/
				
				document.getElementById('cmbitem').style.display='block';
				document.getElementById('cmbitem').innerHTML=xmlHttp.responseText;
				
			} 
		}
					
		xmlHttp.open("POST",url,true);
		xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlHttp.send();
		//xmlHttp.send(parameters);
	}
	}
	else
	{
		alert("select Fair");
		return false;		
	}	
}

function fetch_entry_details(itemcode)
{
	//alert('hiii');
	
	
/*	if(itemcode != 0){
	ajax_loder2('cmbitem');
		
	xmlHttp=GetXmlHttpObject();
	if (xmlHttp)
	{
		var url=path+"index.php/ajax/loadajax/fetch_items_for_special_order/"+festid+"/"+fairid;
		//alert(url);
		xmlHttp.onreadystatechange = function stateChanged() 
		{ 
			if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
			{ 
				arrResponse	=	xmlHttp.responseText;
				
				document.getElementById('cmbitem').style.display='block';
				document.getElementById('cmbitem').innerHTML=xmlHttp.responseText;
				
			} 
		}
					
		xmlHttp.open("POST",url,true);
		xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlHttp.send();
		//xmlHttp.send(parameters);
	}
	}
	else
	{
		alert("select Fair");
		return false;		
	}	*/
}


function goschooldet(shid) {
	
	path = document.getElementById("base_url").value;
	
	document.clustschool.action = path+'index.php/school/registration/school_entry/'+shid;
	document.clustschool.submit();
/*	$('hidSchoolId').value = shid;
	$('clustschool').action = path+'school/registration/school_entry'+shid;
	$('clustschool').submit();*/
}


function validate()
{

	
	var txtSchoolPhone	=	document.getElementById('txtSchoolPhone').value;
	var txtSchoolEmail		=	document.getElementById('txtSchoolEmail').value;
	var txtHeadmaster		=	document.getElementById('txtHeadmaster').value;
	var txtHeadmasterPhone	=	document.getElementById('txtHeadmasterPhone').value;
	
	var lp   = document.getElementById('txtTotalLP').value;
	var up   = document.getElementById('txtTotalUP').value;
	var hs   = document.getElementById('txtTotalHS').value;
	var hss  = document.getElementById('txtTotalHSS').value;
	var vhss = document.getElementById('txtTotalVHSS').value;




	var txtPrincipal		=	document.getElementById('txtPrincipal').value;
	var txtPrincipalPhone	=	document.getElementById('txtPrincipalPhone').value;
	var txtStandardFrom		=	document.getElementById('txtStandardFrom').value;
	var txtStandardTo		=	document.getElementById('txtStandardTo').value;
	if(txtSchoolPhone=="" || txtSchoolPhone=='0'){
		alert("Please Enter Phone Number(Cannot be 0)");
		document.getElementById('txtSchoolPhone').focus();
		return false;
	}
	if(!isValidEmail(txtSchoolEmail)  || txtSchoolEmail==""){
		alert("Please check the email");
		document.getElementById('txtSchoolEmail').focus();
		return false;
	}
	
	if(txtHeadmaster=="" && txtPrincipal==""){
		alert("Please Enter Principal or Headmaster Name");
		return false;
	}
	if(txtHeadmaster!="" && txtHeadmasterPhone==""){
		alert("Please Enter  Headmaster Phone Number");
		document.getElementById('txtHeadmasterPhone').focus();
		return false;
	}
	if(txtPrincipal!="" && txtPrincipalPhone==""){
		alert("Please Enter Principal Phone Number");
		document.getElementById('txtPrincipalPhone').focus();
		return false;
	}
	
	if((txtStandardTo*1)<(txtStandardFrom*1) || txtStandardTo=="0" || txtStandardFrom=="0"){
		alert("Check the From and To Standard");
		return false;
	}
	if(txtStandardFrom==1 && txtStandardTo==4){
		up=0;
		 hs=0;
	  hss=0;
	  vhss=0;
	if(lp=="" || lp == '0'){
		
		alert("Enter LP Strength");
		document.getElementById('txtTotalLP').focus();
		
		return false;
	}
}
 if(txtStandardFrom==1 && txtStandardTo==5 || txtStandardFrom==1 && txtStandardTo==7){
	  hs=0;
	  hss=0;
	  vhss=0;
	  document.getElementById('total').value=(lp*1)+(up*1);
	 if(lp=="" || lp == '0'){
		alert("Enter LP  Strength");
		document.getElementById('txtTotalLP').focus();
		return false;
	 }
	 else if( up=="" || up == '0'){
		alert("Enter UP  Strength");
		document.getElementById('txtTotalUP').focus();
		return false; 
	 }
}
if(txtStandardFrom==1 && txtStandardTo==10){
	
	  hss=0;
	  vhss=0;
	document.getElementById('total').value=(lp*1)+(up*1)+(hs*1);
	
	if(lp=="" || lp == '0'){
		alert("Enter LP  Strength");
		document.getElementById('txtTotalLP').focus();
		return false;
	 }
	 else if( up=="" || up == '0'){
		alert("Enter UP  Strength");
		document.getElementById('txtTotalUP').focus();
		return false; 
	 }
	else if(hs=="" || hs == '0'){
		
	alert("Enter  HS Strength");
	document.getElementById('txtTotalHS').focus();
	return false;
	}
}
 if(txtStandardFrom==1 && txtStandardTo==12){
	 
	 document.getElementById('total').value=(lp*1)+(up*1)+(hs*1)+(hss*1)+(vhss*1);
	if(lp=="" || lp == '0'){
		alert("Enter LP  Strength");
		document.getElementById('txtTotalLP').focus();
		return false;
	 }
	 else if( up=="" || up == '0'){
		alert("Enter UP  Strength");
		document.getElementById('txtTotalUP').focus();
		return false; 
	 }
	else if(hs=="" || hs == '0'){
		
	alert("Enter  HS Strength");
	document.getElementById('txtTotalHS').focus();
	return false;
	} 
else if((hss=="" || hss == '0') && (vhss=="" || vhss == '0')){
alert("Enter HSS/VHSS Strength");
document.getElementById('txtTotalHSS').focus();
	return false;
}
/*else if(vhss=="" || vhss == '0'){
		
	alert("Enter  VHSS Strength");
	document.getElementById('txtTotalVHSS').focus();
	return false;
	} */
}
 if(txtStandardFrom==5 && txtStandardTo==5 || txtStandardFrom==5 && txtStandardTo==7){
	  lp=0;
	   hs=0;
	  hss=0;
	  vhss=0;
	 
	 document.getElementById('total').value=(up*1);

	 if( up=="" || up == '0'){
		alert("Enter UP  Strength");
		document.getElementById('txtTotalUP').focus();
		return false; 
	 }

	 }
if(txtStandardFrom==5 && txtStandardTo==10){
	  lp=0;
	  hss=0;
	  vhss=0;
	
	document.getElementById('total').value=(up*1)+(hs*1);
   if( up=="" || up == '0'){
		alert("Enter UP  Strength");
		document.getElementById('txtTotalUP').focus();
		return false; 
	 }
	else if(hs=="" || hs == '0'){
		
	alert("Enter  HS Strength");
	document.getElementById('txtTotalHS').focus();
	return false;
	} 

}
if(txtStandardFrom==5 && txtStandardTo==12){
	 lp=0;
	  
	document.getElementById('total').value=(up*1)+(hs*1)+(hss*1)+(vhss*1);
 if( up=="" || up == '0'){
		alert("Enter UP  Strength");
		document.getElementById('txtTotalUP').focus();
		return false; 
	 }
	else if(hs=="" || hs == '0'){
		
	alert("Enter  HS Strength");
	document.getElementById('txtTotalHS').focus();
	return false;
	} 
else if((hss=="" || hss == '0') && (vhss=="" || vhss == '0')){
alert("Enter HSS/VHSS Strength");
document.getElementById('txtTotalHSS').focus();
	return false;
}
/*else if(vhss=="" || vhss == '0'){
		
	alert("Enter  VHSS Strength");
	document.getElementById('txtTotalVHSS').focus();
	return false;
	} */
}
if(txtStandardFrom==8 && txtStandardTo==10){
	   lp=0;
	   up=0;
	  hss=0;
	  vhss=0;
	document.getElementById('total').value=(hs*1);
 if(hs=="" || hs == '0'){
		
	alert("Enter  HS Strength");
	document.getElementById('txtTotalHS').focus();
	return false;
	} 


}
if(txtStandardFrom==8 && txtStandardTo==12){
	 lp=0;
	   up=0;
	  
	document.getElementById('total').value=(hs*1)+(hss*1)+(vhss*1);
 if(hs=="" || hs == '0'){
		
	alert("Enter  HS Strength");
	document.getElementById('txtTotalHS').focus();
	return false;
	} 
else if((hss=="" || hss == '0') && (vhss=="" || vhss == '0')){
alert("Enter HSS/VHSS Strength");
document.getElementById('txtTotalHSS').focus();
	return false;
}
/*else if(vhss=="" || vhss == '0'){
		
	alert("Enter  VHSS Strength");
	document.getElementById('txtTotalVHSS').focus();
	return false;
	} */
}
 if(txtStandardFrom==11 && txtStandardTo==12){
	  lp=0;
	   up=0;
	  hs=0;
	 
	 document.getElementById('total').value=(hss*1)+(vhss*1);
if((hss=="" || hss == '0') && (vhss=="" || vhss == '0')){
alert("Enter HSS/VHSS Strength");
document.getElementById('txtTotalHSS').focus();
	return false;
}
/*else if(vhss=="" || vhss == '0'){
		
	alert("Enter  VHSS Strength");
	document.getElementById('txtTotalVHSS').focus();
	return false;
	} */
}
/**/
	
	
}
function fncEditSchoolDeatils(){
	
	
	var schoolcode	=	document.getElementById('hidschool').value;
	
	path = document.getElementById("base_url").value;
	document.formSchool.action = path+'index.php/school/registration/school_reset/'+schoolcode;
	document.formSchool.submit();
}
function fncEditPartDeatils(){
	
	var schoolcode	=	document.getElementById('schoolcode').value;
	var category	=	document.getElementById('festid').value;
	var fairid	=	document.getElementById('fairid').value;
	var exb=0;
	if(fairid==4)
	var exb	=	document.getElementById('exb').value;
	path = document.getElementById("base_url").value;
	
	
	if(fairid==1)
	{
		document.scienceSchool.action = path+'index.php/school/registration/part_reset/'+schoolcode+'/'+category+'/'+fairid+'/'+exb;
		document.scienceSchool.submit();
	}
	
	if(fairid==2)
	{
		document.mathsSchool.action = path+'index.php/school/registration/part_reset/'+schoolcode+'/'+category+'/'+fairid+'/'+exb;
		document.mathsSchool.submit();
	}
	
	if(fairid==3)
	{
		document.socialscienceEntry.action = path+'index.php/school/registration/part_reset/'+schoolcode+'/'+category+'/'+fairid+'/'+exb;
		document.socialscienceEntry.submit();
	}
	if(fairid==4)
	{
		 if(exb==0){
		 document.workexp_onEntry.action = path+'index.php/school/registration/part_reset/'+schoolcode+'/'+category+'/'+fairid+'/'+exb;
		 document.workexp_onEntry.submit();
		 }
		 else
		 {
		 document.workexp_exbEntry.action = path+'index.php/school/registration/part_reset/'+schoolcode+'/'+category+'/'+fairid+'/2';
		 document.workexp_exbEntry.submit();
		 }
	}
	if(fairid==5)
	{
		document.ITEntry.action = path+'index.php/school/registration/part_reset/'+schoolcode+'/'+category+'/'+fairid+'/'+exb;
		document.ITEntry.submit();
	}
	
	
}
function exhibition(){
	var schoolcode	=	document.getElementById('schoolcode').value;
	var category	=	document.getElementById('festid').value;
	var fairid	=	document.getElementById('fairid').value;
	var exb	=	document.getElementById('exb').value;
	path = document.getElementById("base_url").value;
	 if(exb==1){
		 document.getElementById(tab-1).style.display='none';
		 document.workexp_exbEntry.action = path+'index.php/school/registration/school_entry/'+schoolcode+'/'+category+'/'+fairid+'/NULL/'+exb;
		// document.workexp_exbEntry.submit();
		 }
		 else
		 {
		 document.workexp_onEntry.action = path+'index.php/school/registration/school_entry/'+schoolcode+'/'+category+'/'+fairid+'/NULL/'+exb;
		 //document.workexp_onEntry.submit();
		 }
}
function fncShowHideStd(){
var txtStandardFrom	=	document.getElementById('txtStandardFrom').value;
var txtStandardTo	=	document.getElementById('txtStandardTo').value;	

	var lp=document.getElementById('txtTotalLP').value;
	var up=document.getElementById('txtTotalUP').value;
	var hs=document.getElementById('txtTotalHS').value;
	var hss=document.getElementById('txtTotalHSS').value;
	var vhss=document.getElementById('txtTotalVHSS').value;

if(txtStandardFrom==1 && txtStandardTo==4){
	up=0;
	hs=0;
	hss=0;
	vhss=0;
document.getElementById('total').value=(lp*1);
document.getElementById('lp').style.display="block";	
document.getElementById('up').style.display="none";
document.getElementById('hs').style.display="none";
document.getElementById('hss').style.display="none";
document.getElementById('vhss').style.display="none";	
document.getElementById('txtTotalUP').value=0;
document.getElementById('txtTotalHS').value=0;
document.getElementById('txtTotalHSS').value=0;
document.getElementById('txtTotalVHSS').value=0;


}
else if((txtStandardFrom==1 && txtStandardTo==5) || (txtStandardFrom==1 && txtStandardTo==7)){
	hs=0;
	hss=0;
	vhss=0;
	document.getElementById('total').value=(lp*1)+(up*1);
document.getElementById('lp').style.display="block";	
document.getElementById('up').style.display="block";
document.getElementById('hs').style.display="none";
document.getElementById('hss').style.display="none";
document.getElementById('vhss').style.display="none";	
document.getElementById('txtTotalHS').value=0;
document.getElementById('txtTotalHSS').value=0;
document.getElementById('txtTotalVHSS').value=0;

}
else if(txtStandardFrom==1 && txtStandardTo==10){
	 hss=0;
	 vhss=0;
document.getElementById('total').value=(lp*1)+(up*1)+(hs*1);
document.getElementById('lp').style.display="block";	
document.getElementById('up').style.display="block";
document.getElementById('hs').style.display="block";
document.getElementById('hss').style.display="none";
document.getElementById('vhss').style.display="none";	
document.getElementById('txtTotalHSS').value=0;
document.getElementById('txtTotalVHSS').value=0;

}
else if(txtStandardFrom==1 && txtStandardTo==12){
document.getElementById('total').value=(lp*1)+(up*1)+(hs*1)+(hss*1)+(vhss*1);
document.getElementById('lp').style.display="block";	
document.getElementById('up').style.display="block";
document.getElementById('hs').style.display="block";
document.getElementById('hss').style.display="block";
document.getElementById('vhss').style.display="block";	


}
else if((txtStandardFrom==5 && txtStandardTo==5) || (txtStandardFrom==5 && txtStandardTo==7)){
	lp=0;
	hs=0;
	hss=0;
	vhss=0;
	 
document.getElementById('total').value=(up*1);
document.getElementById('lp').style.display="none";	
document.getElementById('up').style.display="block";
document.getElementById('hs').style.display="none";
document.getElementById('hss').style.display="none";
document.getElementById('vhss').style.display="none";
document.getElementById('txtTotalLP').value=0;
document.getElementById('txtTotalHSS').value=0;
document.getElementById('txtTotalVHSS').value=0;

}
else if(txtStandardFrom==5 && txtStandardTo==10){
	lp=0;
	hss=0;
	vhss=0;
	
	document.getElementById('total').value=(up*1)+(hs*1);
document.getElementById('lp').style.display="none";	
document.getElementById('up').style.display="block";
document.getElementById('hs').style.display="block";
document.getElementById('hss').style.display="none";
document.getElementById('vhss').style.display="none";
document.getElementById('txtTotalLP').value=0;
document.getElementById('txtTotalHSS').value=0;
document.getElementById('txtTotalVHSS').value=0;

}
else if(txtStandardFrom==5 && txtStandardTo==12){
	 lp=0;
	  
	document.getElementById('total').value=(up*1)+(hs*1)+(hss*1)+(vhss*1);
document.getElementById('lp').style.display="none";	
document.getElementById('up').style.display="block";
document.getElementById('hs').style.display="block";
document.getElementById('hss').style.display="block";
document.getElementById('vhss').style.display="block";
document.getElementById('txtTotalLP').value=0;


}
else if(txtStandardFrom==8 && txtStandardTo==10){
	lp=0;
    up=0;
	hss=0;
	vhss=0;
	document.getElementById('total').value=(hs*1);
document.getElementById('lp').style.display="none";	
document.getElementById('up').style.display="none";
document.getElementById('hs').style.display="block";
document.getElementById('hss').style.display="none";
document.getElementById('vhss').style.display="none";
document.getElementById('txtTotalLP').value=0;
document.getElementById('txtTotalUP').value=0;
document.getElementById('txtTotalHSS').value=0;
document.getElementById('txtTotalVHSS').value=0;


}
else if(txtStandardFrom==8 && txtStandardTo==12){
	lp=0;
	  up=0;
	  
	document.getElementById('total').value=(hs*1)+(hss*1)+(vhss*1);
document.getElementById('lp').style.display="none";	
document.getElementById('up').style.display="none";
document.getElementById('hs').style.display="block";
document.getElementById('hss').style.display="block";
document.getElementById('vhss').style.display="block";
document.getElementById('txtTotalLP').value=0;
document.getElementById('txtTotalUP').value=0;

}
else if(txtStandardFrom==11 && txtStandardTo==12){
	
	lp=0;
	   up=0;
	  hs=0;
	 
	 document.getElementById('total').value=(hss*1)+(vhss*1);
document.getElementById('lp').style.display="none";	
document.getElementById('up').style.display="none";
document.getElementById('hs').style.display="none";
document.getElementById('hss').style.display="block";
document.getElementById('vhss').style.display="block";
document.getElementById('txtTotalLP').value=0;
document.getElementById('txtTotalUP').value=0;
document.getElementById('txtTotalHS').value=0;

}
}
function fncShowtotal()
{

	
	var txtboys	=	document.getElementById('txtboys').value;
	var txtgirls	=	document.getElementById('txtgirls').value;
	var total=(txtboys*1)+(txtgirls*1);
	document.getElementById('txtTotal').value=total;
	
	
}
function showClustschools()
{
	document.clust.submit();
	}



 function showEscortingTeachers(comboValue,count,divName){ 
	
			if(comboValue==''){ 
			
				
				document.getElementById(divName).innerHTML='';
				return false;	
				}
			else{
			
				
			/*	iteraion=0;	
				for(i=1;i<=count;i++)
				{
					
					name  = document.getElementById("escorting_teacher_name["+i+"]").value;
					desig = document.getElementById("designation["+i+"]").value;
					phone = document.getElementById("escorting_teacher_phone["+i+"]").value;
					
					if((name=='') && (desig==0) && (phone==''))
					{
						iteraion++;
						
					}
					
				}
			
					diff = count - iteraion;*/
					
					/*if(comboValue < count){
					alert("Number of Escorting Teachers & Details Given is not matching");
					document.getElementById('escorting_teacher_num').value=count;
					return false;	
					}*/
			
				xmlHttp=GetXmlHttpObject();
				if (xmlHttp)
				{
					var baseurl	=	document.getElementById('base_url').value;
					
					var url=baseurl+"index.php/school/registration/esc_teacher_ajax/"+comboValue+"/"+count;
					
				xmlHttp.onreadystatechange = function stateChanged() 
				{ 
					if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
					{ 
						arrResponse	=	xmlHttp.responseText;
						
						document.getElementById(divName).style.display='block';
						document.getElementById(divName).innerHTML=xmlHttp.responseText;
						//alert(xmlHttp.responseText);
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
			}//function
		
function escortingteacherValidate()
{
			var escorting_teacher_num= document.getElementById("escorting_teacher_num").value;
			//var escorting_count= document.getElementById("teacher_count").value;
			
			if(escorting_teacher_num==0)
			{
				alert("Number of escorting teacher is required");
				document.getElementById("escorting_teacher_num").focus();
				return false;
				
			}
			else
			{
				for(i=1;i<=escorting_teacher_num;i++)
				{
					name  = document.getElementById("escorting_teacher_name["+i+"]").value;
					desig = document.getElementById("designation["+i+"]").value;
					phone = document.getElementById("escorting_teacher_phone["+i+"]").value;
					
					if(name == ''){
					alert("Escorting Teacher name required");
					document.getElementById("escorting_teacher_name["+i+"]").focus();
					return false;	
					}
					
					if(desig==0){
						alert("Escorting Teacher's Designation required");
						document.getElementById("designation["+i+"]").focus();
						return false;	
					}
					
					if(phone==''){
						alert("Escorting Teacher's Phone required");
						document.getElementById("escorting_teacher_phone["+i+"]").focus();
						return false;	
					}
				
																
				}
				/*nameiteraion=0;	desigiteraion=0;	phoneiteraion=0;	
				for(i=1;i<=escorting_count;i++)
				{
					name  = document.getElementById("escorting_teacher_name["+i+"]").value;
					desig = document.getElementById("designation["+i+"]").value;
					phone = document.getElementById("escorting_teacher_phone["+i+"]").value;
					
					if(name != '')nameiteraion++;
						
					if(desig > 0)desigiteraion++;
										
					if(phone != '')phoneiteraion++;
											
				}
				
				diffname  = escorting_count - nameiteraion;
				diffdesig = escorting_count - desigiteraion;
				diffphone = escorting_count - phoneiteraion;
				
								
					if(nameiteraion < escorting_teacher_num ){
					alert("Escorting Teacher name required");
					return false;	
				}
				
				if(desigiteraion < escorting_teacher_num ){
					alert("Escorting Teacher's Designation required");
					return false;	
				}
				
				if(phoneiteraion < escorting_teacher_num){
					alert("Escorting Teacher's Phone required");
					return false;	
				}*/
			}
		
}

function socialsciencemathsValidate()
{
	//alert("kiiii");
		var escorting_teacher_num= document.getElementById("escorting_teacher_num").value;

		var festid= document.getElementById("festid").value;
		var fairid= document.getElementById("fairid").value;
		var returnflag = 0;	
		if(fairid==4){
			var exb= document.getElementById("exb").value;
			var name_team= document.getElementById("name_team").value;
			var address_team= document.getElementById("address_team").value;
			var phone_team= document.getElementById("phone_team").value;
		}
		
		
			if(escorting_teacher_num==0)
			{
				alert("Number of escorting teacher is required");
				document.getElementById("escorting_teacher_num").focus();
				var returnflag = 1;	
				return false;
				
			}
			else
			{
				
			/*	if(document.getElementById("divEscTeachers").style.display=='none')
				{
					alert("Please Enter Escorting Teacher Details");
					return false;
				}*/
				
				for(i=1;i<=escorting_teacher_num;i++)
				{
					name  = document.getElementById("escorting_teacher_name["+i+"]").value;
					desig = document.getElementById("designation["+i+"]").value;
					phone = document.getElementById("escorting_teacher_phone["+i+"]").value;
					
					
					
					if(name == ''){
					
					alert("Escorting Teacher name required");
					document.getElementById("escorting_teacher_name["+i+"]").focus();
					var returnflag = 1;	
					return false;	
					}
					
					
					if(desig==0){
						alert("Escorting Teacher's Designation required");
						document.getElementById("designation["+i+"]").focus();
						var returnflag = 1;	
						return false;	
					}
					
					
					if(phone==''){
						alert("Escorting Teacher's Phone required");
						document.getElementById("escorting_teacher_phone["+i+"]").focus();
						var returnflag = 1;	
						return false;	
					}
					
																
				}
			}
		
	
	var admn_array = new Array(); 
	name = new Array();
	std = new Array();
	gender = new Array();
	admn_id = new Array();
	name_id = new Array();
	std_id = new Array();
	gender_id = new Array();
	
	var fairid= document.getElementById("fairid").value;
	var festid= document.getElementById("festid").value;
	var a = 0;
	var fg=0;
	var items_no= document.getElementById("items").value;
//alert(items_no);
	var itemary_no =items_no.split('#');
	
	exbcounter =0 ;
	var limit = itemary_no.length;
	if((fairid ==1) || (fairid ==2) || (fairid ==3))
	{
	var class_to= document.getElementById("class_to").value;
	
	if((festid == 1) && (class_to == 4)){
			
		if(fairid == 1)
		{
			for(var t=1;t<3;t++)
			{
				if( (document.getElementById("exhibit_name_sc"+t).value != '') ||  (document.getElementById("participant_name_sc"+t).value != '') || (document.getElementById("admn_no_sc"+t).value != '') || (document.getElementById("gender_sc"+t).value > 0) )
				{
					if(document.getElementById("exhibit_name_sc"+t).value == ''){
						alert("Please enter exhibit name");
						document.getElementById("exhibit_name_sc"+t).focus();
						return false;
					}
					
					if(document.getElementById("participant_name_sc"+t).value == ''){
						alert("Please enter participant name");
						document.getElementById("participant_name_sc"+t).focus();
						return false;
					}
					
					if(document.getElementById("admn_no_sc"+t).value == ''){
						alert("Please enter admission number");
						document.getElementById("admn_no_sc"+t).focus();
						return false;
					}
					
					if(document.getElementById("gender_sc"+t).value == 0){
						alert("Please enter gender");
						document.getElementById("gender_sc"+t).focus();
						return false;
					}
				}
			}
		}
		else if(fairid == 2)	
		{
			if((document.getElementById("participant_name_sc1").value != '') || (document.getElementById("admn_no_sc1").value != '') || (document.getElementById("gender_sc1").value > 0) )
			{
						
				if(document.getElementById("participant_name_sc1").value == ''){
					alert("Please enter participant name");
					document.getElementById("participant_name_sc1").focus();
					return false;
				}
				
				if(document.getElementById("admn_no_sc1").value == ''){
					alert("Please enter admission number");
					document.getElementById("admn_no_sc1").focus();
					return false;
				}
				
				if(document.getElementById("gender_sc1").value == 0){
					alert("Please enter gender");
					document.getElementById("gender_sc1").focus();
					return false;
				}
			}
		}
		else if(fairid == 3)	
		{
			if( (document.getElementById("exhibit_name_sc1").value != '') ||  (document.getElementById("participant_name_sc1").value != '') || (document.getElementById("admn_no_sc1").value != '') || (document.getElementById("gender_sc1").value > 0) )
			{
				if(document.getElementById("exhibit_name_sc1").value == ''){
					alert("Please enter exhibit name");
					document.getElementById("exhibit_name_sc1").focus();
					return false;
				}
				
				if(document.getElementById("participant_name_sc1").value == ''){
					alert("Please enter participant name");
					document.getElementById("participant_name_sc1").focus();
					return false;
				}
				
				if(document.getElementById("admn_no_sc1").value == ''){
					alert("Please enter admission number");
					document.getElementById("admn_no_sc1").focus();
					return false;
				}
				
				if(document.getElementById("gender_sc1").value == 0){
					alert("Please enter gender");
					document.getElementById("gender_sc1").focus();
					return false;
				}
			}
		}
	}
	}
	
	for(i=0;i<(limit);i++)
	{
			var itemary = itemary_no[i].split('_');
			
			var max_item_code = document.getElementById("max_participant_"+itemary[0]+"_"+itemary[1]).value;
     		
			exhibit='';
			//if((itemary[0]==185) || (itemary[0]==186) || (itemary[0]==187))exhibit=itemary[1];
			//else exhibit='';
		
	 		var stdflag = 0;	
			//alert(itemary[0]);
			if((itemary[0]==111) || (itemary[0]==112) || (itemary[0]==121) || (itemary[0]==122) || (itemary[0]==131) || (itemary[0]==132) ||  (itemary[0]==146) || (itemary[0]==163) || (itemary[0]==181) || (itemary[0]==194) || (itemary[0]==204) || (itemary[0]==214) )//teachnigaid
			{
				var stdflag = 1;
				document.getElementById("txtStandard"+itemary[0]+""+itemary[1]).value = 0;
			}
			else
			{
				var stdflag = 0;
			}
			
			if((itemary[0] != 123) && (itemary[0] != 138) && (itemary[0] != 147) && (itemary[0] != 164) && (itemary[0] != 182))
			{
				admn_array[a]	=	document.getElementById("adm_no"+itemary[0]+""+itemary[1]).value;
				admn_id[a]		=	document.getElementById("adm_no"+itemary[0]+""+itemary[1]);
				
				name[a]	 		=	document.getElementById("name_participant"+itemary[0]+""+itemary[1]).value;
				name_id[a]	 	=	document.getElementById("name_participant"+itemary[0]+""+itemary[1]);
				
				if(stdflag==0)
				{
					std[a]	 		=	document.getElementById("txtStandard"+itemary[0]+""+itemary[1]).value;
					std_id[a]	 	=	document.getElementById("txtStandard"+itemary[0]+""+itemary[1]);
				}
				
				gender[a] 		=	document.getElementById("txtgender"+itemary[0]+""+itemary[1]).value;
				gender_id[a] 	=	document.getElementById("txtgender"+itemary[0]+""+itemary[1]);
			}
			
			a++;
			
		
		//alert(stdflag);
		if((document.getElementById("exhibitFlag_"+itemary[0]+"_"+itemary[1]).value=='notdisabled') && (itemary[0] != 123) )
		{
			
			if(festid!=4){
		
			if( ((document.getElementById("adm_no"+itemary[0]+""+itemary[1]).value != '') || document.getElementById("adm_no"+itemary[0]+""+itemary[1]).value > 0) || (document.getElementById("name_participant"+itemary[0]+""+itemary[1]).value != '') || ((document.getElementById("txtStandard"+itemary[0]+""+itemary[1]).value > 0) && (stdflag==0)) ||  (document.getElementById("txtgender"+itemary[0]+""+itemary[1]).value != 0) )
			{
	
				if((document.getElementById("exhibit_name"+itemary[0]+""+exhibit).value =='' )){
					alert("Enter Exhibit name");
					document.getElementById("exhibit_name"+itemary[0]+""+exhibit).focus();
					var returnflag = 1;	
					return false;
				}
				else if((document.getElementById("name_participant"+itemary[0]+""+itemary[1]).value == '')){
					alert("Enter Name of Participant");
					document.getElementById("name_participant"+itemary[0]+""+itemary[1]).focus();
					var returnflag = 1;	
					return false;
				}
				else if(((document.getElementById("txtStandard"+itemary[0]+""+itemary[1]).value == 0) && (stdflag==0))){
					
					alert("Enter Standard");
					document.getElementById("txtStandard"+itemary[0]+""+itemary[1]).focus();
					var returnflag = 1;	
					return false;
				}
				else if((document.getElementById("adm_no"+itemary[0]+""+itemary[1]).value == '') || (document.getElementById("adm_no"+itemary[0]+""+itemary[1]).value == 0)){
					alert("Enter Admission number");
					document.getElementById("adm_no"+itemary[0]+""+itemary[1]).focus();
					var returnflag = 1;	
					return false;
				}
				
				else if((document.getElementById("txtgender"+itemary[0]+""+itemary[1]).value == 0)){
					alert("Enter Gender");
					document.getElementById("txtgender"+itemary[0]+""+itemary[1]).focus();
					var returnflag = 1;	
					return false;
				}
							   
									
			
			}
			}
			else
			{
				//(document.getElementById("exhibit_name"+itemary[0]+""+exhibit).value !='' )||
				if((document.getElementById("admn_category"+itemary[0]+""+itemary[1]).value != 0) || ((document.getElementById("adm_no"+itemary[0]+""+itemary[1]).value != '') || document.getElementById("adm_no"+itemary[0]+""+itemary[1]).value > 0) || (document.getElementById("name_participant"+itemary[0]+""+itemary[1]).value != '') || ((document.getElementById("txtStandard"+itemary[0]+""+itemary[1]).value > 0) && (stdflag==0)) ||  (document.getElementById("txtgender"+itemary[0]+""+itemary[1]).value != 0) )
			{
					//alert("iiiii"+exhibit);
					//alert(document.getElementById("exhibit_name"+itemary[0]+""+exhibit).value);
					if((document.getElementById("exhibit_name"+itemary[0]+""+exhibit).value =='' )){
					alert("Enter Exhibit name");
					document.getElementById("exhibit_name"+itemary[0]+""+exhibit).focus();
					var returnflag = 1;	
					return false;
				}
				else if((document.getElementById("name_participant"+itemary[0]+""+itemary[1]).value == '')){
					alert("Enter Name of Participant");
					document.getElementById("name_participant"+itemary[0]+""+itemary[1]).focus();
					var returnflag = 1;	
					return false;
				}
				else if(((document.getElementById("txtStandard"+itemary[0]+""+itemary[1]).value == 0) && (stdflag == 0))){
					alert("Enter Standard");
					document.getElementById("txtStandard"+itemary[0]+""+itemary[1]).focus();
					var returnflag = 1;	
					return false;
				}
				else if((document.getElementById("admn_category"+itemary[0]+""+itemary[1]).value == 0)){
					alert("Enter Type");
					document.getElementById("admn_category"+itemary[0]+""+itemary[1]).focus();
					var returnflag = 1;	
					return false;
				}
				else if((document.getElementById("adm_no"+itemary[0]+""+itemary[1]).value == '') || (document.getElementById("adm_no"+itemary[0]+""+itemary[1]).value == 0)){
					alert("Enter Admission number");
					document.getElementById("adm_no"+itemary[0]+""+itemary[1]).focus();
					var returnflag = 1;	
					return false;
				}
				
				else if((document.getElementById("txtgender"+itemary[0]+""+itemary[1]).value == 0)){
					alert("Enter Gender");
					document.getElementById("txtgender"+itemary[0]+""+itemary[1]).focus();
					var returnflag = 1;	
					return false;
				}
				
					
			
			}
			}
		}
		

		
		if((document.getElementById("exhibitFlag_"+itemary[0]+"_"+itemary[1]).value=='disabled') && ((itemary[0] != 138) || (itemary[0] != 147) || (itemary[0] != 164) || (itemary[0] != 182) ))
		{
	
			if(festid!=4){
			if(((document.getElementById("adm_no"+itemary[0]+""+itemary[1]).value != '') || document.getElementById("adm_no"+itemary[0]+""+itemary[1]).value > 0) || (document.getElementById("name_participant"+itemary[0]+""+itemary[1]).value != '') || ((document.getElementById("txtStandard"+itemary[0]+""+itemary[1]).value > 0) ) ||  (document.getElementById("txtgender"+itemary[0]+""+itemary[1]).value != 0) )
			{
					
				if((document.getElementById("name_participant"+itemary[0]+""+itemary[1]).value == '')){
					alert("Enter Name of Participant");
					document.getElementById("name_participant"+itemary[0]+""+itemary[1]).focus();
					var returnflag = 1;	
					return false;
				}
				else if(((document.getElementById("txtStandard"+itemary[0]+""+itemary[1]).value == 0) && (stdflag == 0))){
					alert("Enter Standard");
					document.getElementById("txtStandard"+itemary[0]+""+itemary[1]).focus();
					var returnflag = 1;	
					return false;
				}
				
				else if((document.getElementById("adm_no"+itemary[0]+""+itemary[1]).value == '') || (document.getElementById("adm_no"+itemary[0]+""+itemary[1]).value == 0)){
					alert("Enter Admission number");
					document.getElementById("adm_no"+itemary[0]+""+itemary[1]).focus();
					var returnflag = 1;	
					return false;
				}
				
				else if((document.getElementById("txtgender"+itemary[0]+""+itemary[1]).value == 0)){
					alert("Enter Gender");
					document.getElementById("txtgender"+itemary[0]+""+itemary[1]).focus();
					var returnflag = 1;	
					return false;
				}
				
				
			
					if(fairid==4 && exb==0){
						
						if((festid==1) || (festid==2)){
							if(exbcounter>=10){
							alert("Maximum allowed participants is 10");
							var returnflag = 1;	
							return false;
							}
						}
						
						if((festid==3) || (festid==4)){
							if(exbcounter>=20){
							alert("Maximum allowed participants is 20");
							var returnflag = 1;	
							return false;
							}
						}
					}
					
					exbcounter++;
			
			}
			}
			else
			{
				
				if((document.getElementById("admn_category"+itemary[0]+""+itemary[1]).value != 0) || ((document.getElementById("adm_no"+itemary[0]+""+itemary[1]).value != '') || document.getElementById("adm_no"+itemary[0]+""+itemary[1]).value > 0) || (document.getElementById("name_participant"+itemary[0]+""+itemary[1]).value != '') || ((document.getElementById("txtStandard"+itemary[0]+""+itemary[1]).value > 0) && (stdflag==0)) ||  (document.getElementById("txtgender"+itemary[0]+""+itemary[1]).value != 0) )
			{
					
				if((document.getElementById("name_participant"+itemary[0]+""+itemary[1]).value == '')){
					alert("Enter Name of Participant");
					document.getElementById("name_participant"+itemary[0]+""+itemary[1]).focus();
					var returnflag = 1;	
					return false;
				}
				else if(((document.getElementById("txtStandard"+itemary[0]+""+itemary[1]).value == 0) && (stdflag == 0))){



					alert("Enter Standard");
					document.getElementById("txtStandard"+itemary[0]+""+itemary[1]).focus();
					var returnflag = 1;	
					return false;
				}
				else if((document.getElementById("admn_category"+itemary[0]+""+itemary[1]).value == 0)){
					alert("Enter Type");
					document.getElementById("admn_category"+itemary[0]+""+itemary[1]).focus();
					var returnflag = 1;	
					return false;
				}
				else if((document.getElementById("adm_no"+itemary[0]+""+itemary[1]).value == '') || (document.getElementById("adm_no"+itemary[0]+""+itemary[1]).value == 0)){
					alert("Enter Admission number");
					document.getElementById("adm_no"+itemary[0]+""+itemary[1]).focus();
					var returnflag = 1;	
					return false;
				}
				
				else if((document.getElementById("txtgender"+itemary[0]+""+itemary[1]).value == 0)){
					alert("Enter Gender");
					document.getElementById("txtgender"+itemary[0]+""+itemary[1]).focus();
					var returnflag = 1;	
					return false;
				}
				
					
			
			}
			
			}
		}
		
		if((itemary[0] != 123) && (itemary[0] != 138) && (itemary[0] != 147) && (itemary[0] != 164) && (itemary[0] != 182))//magazine
		{
		for(j=0;j<=a;j++)
		{
		for(k=j+1;k<=a;k++)	
		{
			var flag = 0;
			if((admn_array[j] == admn_array[k]) && admn_array[j]!=0 && admn_array[k]!=0)
			{	
			
							if(name[j] != name[k])
							{
								alert("Participant name is different for the admission number :"+admn_array[j]);
								flag = 1;
								name_id[j].style.borderColor = "Red";
								name_id[k].style.borderColor = "Red";
								var returnflag = 1;	
								return false;
								
							}
							
							if(stdflag == 0)
							{
							if(std[j] != std[k])
							{
								alert("Participant's standard is different for the admission number :"+admn_array[j]);
								flag = 1;
								std_id[j].style.borderColor = "Red";
								std_id[k].style.borderColor = "Red";
								var returnflag = 1;	
								return false;
							}
							}
							
							
							if(gender[j] != gender[k])
							{
								alert("Participant's gender is different for the admission number :"+admn_array[j]);
								flag = 1;
								gender_id[j].style.borderColor = "Red";
								gender_id[k].style.borderColor = "Red";
								var returnflag = 1;	
								return false;
							}
							
							
							if(flag == 1)
							{
								
								admn_id[j].style.borderColor = "Red";
								admn_id[k].style.borderColor = "Red";
								var returnflag = 1;	
								return false;
								break;
							}
						
							
							
			}	
			
		}
		
		 }
		}
 //alert("dfgdfgd");
}
}




// for edit participants
function editParticipant(item_code,part_id){
	
	var schoolcode	=	document.getElementById('schoolcode').value;
	var category	=	document.getElementById('festid').value;
	var fairid		=	document.getElementById('fairid').value;
	
	var answer = confirm(" Do you want to Edit Details?");
	if(answer)
	{
	
	var exb=0;
	if(fairid==4)
	var exb		=	document.getElementById('exb').value;
	path = document.getElementById("base_url").value;
	if(fairid==1)
	{
		document.scienceSchool.action =path+'index.php/school/registration/part_edit/'+schoolcode+'/'+category+'/'+fairid+'/'+item_code+'/0/0';
		document.scienceSchool.submit();
	}
	
	if(fairid==2)
	{
		document.mathsSchool.action = path+'index.php/school/registration/part_edit/'+schoolcode+'/'+category+'/'+fairid+'/'+item_code+'/0/0';
		document.mathsSchool.submit();
	}
	
	if(fairid==3)
	{
		document.socialscienceEntry.action =path+'index.php/school/registration/part_edit/'+schoolcode+'/'+category+'/'+fairid+'/'+item_code+'/'+part_id+'/0';
		document.socialscienceEntry.submit();
	}
	if(fairid==4)
	{
		
		
		 if(exb==0){
			 
		 document.workexp_onEntry.action = path+'index.php/school/registration/part_edit/'+schoolcode+'/'+category+'/'+fairid+'/'+item_code+'/0/'+exb;
		 document.workexp_onEntry.submit();
		 }
		 else
		 {
		 document.workexp_exbEntry.action = path+'index.php/school/registration/part_edit/'+schoolcode+'/'+category+'/'+fairid+'/'+item_code+'/0/'+2;
		 document.workexp_exbEntry.submit();
		 }
	}
	if(fairid==5)
	{
		
		document.ITEntry.action = path+'index.php/school/registration/part_edit/'+schoolcode+'/'+category+'/'+fairid+'/'+item_code+'/0/0';
		document.ITEntry.submit();
	}
	}
	else
			return false;
	
}
// for delete participants
function deleteParticipant(item_code,admn_no,parti_id){
	var schoolcode	=	document.getElementById('schoolcode').value;
	var category	=	document.getElementById('festid').value;
	var fairid		=	document.getElementById('fairid').value;
	var exb=0;
	
	var answer = confirm(" Do you want to Delete Details?");
	if(answer)
	{
	if(fairid==4)
	var exb		=	document.getElementById('exb').value;
	
	path = document.getElementById("base_url").value;
	
	
	if(fairid==1)
	{
		document.scienceSchool.action =path+'index.php/school/registration/part_delete/'+schoolcode+'/'+category+'/'+fairid+'/'+item_code+'/'+exb+'/'+admn_no+'/'+parti_id;
		document.scienceSchool.submit();
	}
	
	if(fairid==2)
	{
		document.mathsSchool.action = path+'index.php/school/registration/part_delete/'+schoolcode+'/'+category+'/'+fairid+'/'+item_code+'/'+exb+'/'+admn_no+'/'+parti_id;
		document.mathsSchool.submit();
	}
	
	if(fairid==3)
	{
	
		document.socialscienceEntry.action =path+'index.php/school/registration/part_delete/'+schoolcode+'/'+category+'/'+fairid+'/'+item_code+'/'+exb+'/'+admn_no+'/'+parti_id;
		document.socialscienceEntry.submit();
		
		
	}
	
	if(fairid==4)
	{
		//alert(exb+"fdf"+item_code);
		
		 if(exb==0){
			 
		 document.workexp_onEntry.action = path+'index.php/school/registration/part_delete/'+schoolcode+'/'+category+'/'+fairid+'/'+item_code+'/'+exb+'/'+admn_no+'/0';
		 document.workexp_onEntry.submit();
		 }
		 else
		 {
			 //alert(path+'index.php/school/registration/part_delete/'+schoolcode+'/'+category+'/'+fairid+'/'+item_code+'/'+exb+'/0');
		 document.workexp_exbEntry.action = path+'index.php/school/registration/part_delete/'+schoolcode+'/'+category+'/'+fairid+'/'+item_code+'/'+exb+'/'+admn_no+'/0';
		 document.workexp_exbEntry.submit();
		 }
	}
	
	if(fairid==5)
	{
		document.ITEntry.action = path+'index.php/school/registration/part_delete/'+schoolcode+'/'+category+'/'+fairid+'/'+item_code+'/'+exb+'/'+admn_no+'/0';
		document.ITEntry.submit();
	}
	}
	else
			return false;
}

// function  for comaon validation
function common_validate(){
	
	var count	=	document.getElementById('count').value;
	for(i=0;i<count;i++){
		var item_code1="it_code"+i;
		var item_name1="it_name"+i;
		var max1="max"+i;
		var item_code		=	document.getElementById(item_code1).value;
		var item_name		=	document.getElementById(item_name1).value;
		var max_item_code	=	document.getElementById(max1).value;	
		for(j=max_item_code;j>0;j--){
			adm="adm_no"+item_code+j;
			var admn_no		=	document.getElementById(adm).value;
			if(admn_no){
				break;
			}
		}
		max_item_code=j-1;
		for(j=max_item_code;j>0;j--){
			adm="adm_no"+item_code+j;
			var admn_no		=	document.getElementById(adm).value;
			if(!admn_no){
				alert("Please enter the "+item_name+ " details");
				document.getElementById(adm).focus()
				return false;
			}
		}
		
		
	
	}
}
//end


function fncConfirnSubDistAdmin()
{
	//alert("hi");
	var chks	=0;
	path = document.getElementById("base_url").value;
	for(i=1;i<=5;i++){
		
		if(document.getElementById('chkC'+i).checked==true)
			chks	=	i;
	}

	if(chks==0){
			alert('Please select one fair to confirm');
			return false;
		}
	if(chks ==1)
	{
		$event = "Science Fair";
	}else if(chks ==2){
		$event = "Mathematics Fair";
	}else if(chks ==3){
		$event = "Social Science Fair";
	}else if(chks ==4){
		$event = "Work expo Fair";
	}else if(chks ==5){
		$event = "IT Fair";
	}
	if (confirm("Do you want to confirm? \n Once confirmed the "+$event+" entry details cannot be modified or add any school!!"))
	{
		document.confirm_sub_dist.action = path+'index.php/welcome/confirm_sub_dist_schools/'+chks;
		//alert(path+'index.php/welcome/confirm_sub_dist_schools/'+chks);
		document.confirm_sub_dist.submit();
		//$('confirm_sub_dist').submit();
	}
	else
	{
		return false;
	}	
	
		
}



function fncExportSubDistrictData()
{

	var chks	=	0;
	path = document.getElementById("base_url").value;
	for(i=1;i<=5;i++){
		
		if(document.getElementById('chk'+i).checked==true){
				chks = chks+i;
			}		
		}
	if(chks==0){
		
			alert('Please check atleast one category to export');
			return false;
		}
	else{
		
	document.confirm_sub_dist.action = path+'index.php/export/export_sub_district_data/'+chks;
	document.confirm_sub_dist.submit();
	}
}
function Clickheretoprint()
{ 
  var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
      disp_setting+="scrollbars=yes,width=650, height=600, left=100, top=25"; 
  var content_vlue = document.getElementById("print_content").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('<html><head><title>Science Fair</title>'); 
   docprint.document.write('</head><body onLoad="self.print()"><center>');          
   docprint.document.write(content_vlue);          
   docprint.document.write('</center></body></html>'); 
   docprint.document.close(); 
   docprint.focus(); 
    // window.location="vacancy_print.php";
}
function fncalk(){
	var txtStandardFrom	=	document.getElementById('txtStandardFrom').value;
	var txtStandardTo	=	document.getElementById('txtStandardTo').value;
	var lp=document.getElementById('txtTotalLP').value;
	var up=document.getElementById('txtTotalUP').value;
	var hs=document.getElementById('txtTotalHS').value;
	var hss=document.getElementById('txtTotalHSS').value;
	var vhss=document.getElementById('txtTotalVHSS').value;
	if(txtStandardFrom==1 && txtStandardTo==4){
		document.getElementById('total').value=(lp*1);
	}

 	if(txtStandardFrom==1 && txtStandardTo==5 || txtStandardFrom==1 && txtStandardTo==7){
	 document.getElementById('total').value=(lp*1)+(up*1);
	}
	if(txtStandardFrom==1 && txtStandardTo==10){
	 document.getElementById('total').value=(lp*1)+(up*1)+(hs*1);
	}
 	if(txtStandardFrom==1 && txtStandardTo==12){
	document.getElementById('total').value=(lp*1)+(up*1)+(hs*1)+(hss*1)+(vhss*1);
	}

 	if(txtStandardFrom==5 && txtStandardTo==5 || txtStandardFrom==5 && txtStandardTo==7){
	document.getElementById('total').value=(up*1);
	 }
	if(txtStandardFrom==5 && txtStandardTo==10){
	document.getElementById('total').value=(up*1)+(hs*1);
	}
	if(txtStandardFrom==5 && txtStandardTo==12){
	document.getElementById('total').value=(up*1)+(hs*1)+(hss*1)+(vhss*1);
	}
	if(txtStandardFrom==8 && txtStandardTo==10){
	document.getElementById('total').value=(hs*1);
	}
	if(txtStandardFrom==8 && txtStandardTo==12){
	document.getElementById('total').value=(hs*1)+(hss*1)+(vhss*1);
	}
	 if(txtStandardFrom==11 && txtStandardTo==12){
	document.getElementById('total').value=(hss*1)+(vhss*1);
 	}
}


function fncShowPathReg()
{ //alert('haiiiiiiiiiiii');
	var txtSchool_code	=	document.getElementById('school_code').value;
	var txtFairClass	=	document.getElementById('txtFairClass').value;
	var txtFairId		=	document.getElementById('fairId').value;
	//var txtworkexpo		=	document.getElementById('txtworkexpo').value;
	//alert(txtFairId);
	
	path = document.getElementById("base_url").value;
	//alert(txtFairId);
	if(txtFairId==4)
	{
		//alert("hhhhhhh");
	
		if(txtFairClass==1) {
			document.formSchool.action =path+'index.php/school/registration/school_entry/'+txtSchool_code+'/1/'+txtFairId+'/no/0';
			document.formSchool.submit();
		}
		
		if(txtFairClass==2) {
			document.formSchool.action =path+'index.php/school/registration/school_entry/'+txtSchool_code+'/2/'+txtFairId+'/no/0';
			document.formSchool.submit();
		}
		
		if(txtFairClass==3) {
			document.formSchool.action =path+'index.php/school/registration/school_entry/'+txtSchool_code+'/3/'+txtFairId+'/no/0';
			document.formSchool.submit();
		}
		
		if(txtFairClass==4) {
			document.formSchool.action =path+'index.php/school/registration/school_entry/'+txtSchool_code+'/4/'+txtFairId+'/no/0';
			document.formSchool.submit();
		}
		if(txtFairClass==5) {
			document.formSchool.action =path+'index.php/school/registration/school_entry/'+txtSchool_code+'/5/'+txtFairId+'/no/0';
			document.formSchool.submit();
		}
	
		
	}
	else
	{
	
		if(txtFairClass==1) {
			document.formSchool.action =path+'index.php/school/registration/school_entry/'+txtSchool_code+'/1/'+txtFairId;
			document.formSchool.submit();
		}
		
		if(txtFairClass==2) {
			document.formSchool.action =path+'index.php/school/registration/school_entry/'+txtSchool_code+'/2/'+txtFairId;
			document.formSchool.submit();
		}
		
		if(txtFairClass==3) {
			document.formSchool.action =path+'index.php/school/registration/school_entry/'+txtSchool_code+'/3/'+txtFairId;
			document.formSchool.submit();
		}
		
		if(txtFairClass==4) {
			document.formSchool.action =path+'index.php/school/registration/school_entry/'+txtSchool_code+'/4/'+txtFairId;
			document.formSchool.submit();
		}
		if(txtFairClass==5) {
			document.formSchool.action =path+'index.php/school/registration/school_entry/'+txtSchool_code+'/5/'+txtFairId;
			document.formSchool.submit();
		}
	}
}
	

function fncShowWorkexpPathReg()
{
	var txtworkexpo		=	document.getElementById('txtworkexpo').value;
	var txtSchool_code	=	document.getElementById('school_code').value;
	var txtFairId		=	document.getElementById('fairId').value;
	//alert('workexpo--'+txtworkexpo);
//	alert(txtFairId);
	path = document.getElementById("base_url").value;
	if(txtworkexpo == 2) {
		document.formSchool.action =path+'index.php/school/registration/school_entry/'+txtSchool_code+'/0/'+txtFairId+'/no/2';
	//	alert(document.formSchool.action);
	document.getElementById('fairId').value=0
	document.getElementById('txtFairClass').style.display='none';
		document.formSchool.submit();
	
	}
	else if(txtworkexpo == 1) {
		//alert("ht");
	document.getElementById('txtFairClass').style.display='block';
	}
	
	
}

function getschooldetails(shid) {
	
	path = document.getElementById("base_url").value;
	
	document.science_School.action = path+'index.php/school/registration/school_entry/'+shid;
	document.science_School.submit();
/*	$('hidSchoolId').value = shid;
	$('clustschool').action = path+'school/registration/school_entry'+shid;
	$('clustschool').submit();*/
}


function fncSaveSasthramelaCSV ()
{
	$('formSasthramela').submit();
}

/************* Special Order Entry ********************/

function fetch_special_order_school_details()
{
	
	
	var school_code	=	document.getElementById('txtSchoolCode').value;
	
	ajax_loder2('divSchoolCode');
	
	if(school_code)
	{
		xmlHttp=GetXmlHttpObject();
		if (xmlHttp)
		{
			var url=path+"index.php/school/special_order_entry/get_school_details/"+school_code;
			//alert(url);
			xmlHttp.onreadystatechange = function stateChanged() 
			{ 
				if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
				{ 
					arrResponse	=	xmlHttp.responseText;
					
					document.getElementById('divEntryForm').style.display='block';
					document.getElementById('divEntryForm').innerHTML=xmlHttp.responseText;
					
				} 
			}
						
			xmlHttp.open("POST",url,true);
			xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlHttp.send();
			//xmlHttp.send(parameters);
		}
	}
}


function add_special_order_participant ()
{
	if(document.getElementById('chkAddParticipant').checked == true){
		document.getElementById('newEntry').style.display		=	'block';
		document.getElementById('cmbParticipant').value		=	'0';
		document.getElementById('cmbParticipant').disabled	=	true;
		if(document.getElementById('txtItemCode_1').value		!=	'')
			fetch_item_code_details();
	} else {
		document.getElementById('newEntry').style.display		=	'none';
		document.getElementById('cmbParticipant').disabled	=	false;
		document.getElementById('divCapPin').style.visibility = 'visible';
		//$('cmbParticipant').style.display	=	'block';
	}
}


function fncSaveSpecialOrderParticipant ()
{
	
	var limit = document.getElementById('limits').value;
	var items = document.getElementById('items').value;
	var is_exhibit = document.getElementById('is_exhibit').value;
	
	if((items == 123) || (items == 138) || (items == 147) || (items == 164) || (items == 182))
	{
		if(document.getElementById('txtExhibitName').value == ''){
			
				alert('Please enter the exhibit name');
				document.getElementById('txtExhibitName').focus();
				return false;
		}
	}
	else
	{
			
	for(var i=1;i<=limit;i++)
	{
		if(is_exhibit)
		{
			
			if(document.getElementById('txtExhibitName').value == ''){
			
				alert('Please enter the exhibit name');
				document.getElementById('txtExhibitName').focus();
				return false;
			}
		}
		
		
	if((document.getElementById('txtADNO'+i).value != '') || (document.getElementById('txtClass'+i).value > 0) || (document.getElementById('txtParticipantName'+i).value != ''))
	{
		if(document.getElementById('txtADNO'+i).value == ''){
		
		alert('Please enter the admission number');
		document.getElementById('txtADNO'+i).focus();
		return false;
		}
		var admn_no		=	document.getElementById('txtADNO'+i).value;
		
		
		if(document.getElementById('is_teach').value != 'Y'){
			
		if(document.getElementById('txtClass'+i).value == 0)
		{
			alert('Please enter the class ');
			document.getElementById('txtClass'+i).focus();
			return false;
		}
			
		if (document.getElementById('txtClass'+i).value > 10)
		{
			var hss_vhse_chr	=	(document.getElementById('admn_category'+i).value);	
			if ( !( (hss_vhse_chr == 'V' ) || (hss_vhse_chr == 'H' ) ) )
			{
				alert('Please select whether HSS/VHSS');
				//alert('Invalid admission number');	
				document.getElementById('txtADNO'+i).focus();
				return false;
			}
			
			
			admn_no		=	(document.getElementById('txtADNO'+i).value).substring(1);
		}
		
		if (isNaN(admn_no))
		{
			alert('Invalid admission number');	
			document.getElementById('txtADNO'+i).focus();
			return false;	
		}
		}
		
		if(document.getElementById('txtParticipantName'+i).value == ''){
			alert('Please enter the participant name');
			document.getElementById('txtParticipantName'+i).focus();
			return false;
		}
	}//checking not null
	}//for loop
	}

	document.getElementById('formParticipant').submit();
}

function editSpecialOrderParticipant (adno,itemcode,team,fest,fair) {
	
	document.getElementById('hidPiId').value = adno;
	document.getElementById('hidItemId').value = itemcode;
	document.getElementById('cmbFestType').value = fest;
	document.getElementById('cmbFairType').value = fair;
	
	document.getElementById('formParticipant').action = path+'index.php/school/special_order_entry/edit_participant_detials/'+team;
	document.getElementById('formParticipant').submit();
}

function deleteSpecialOrderParticipant(adno, itemcode) {
	if(!confirm('Do you really want to delete the participant?')){
		return false;
	}
	document.getElementById('hidADNO').value = adno;
	document.getElementById('hidItemId').value = itemcode;
	document.getElementById('formParticipant').action = path+'index.php/school/special_order_entry/delete_participant_detials';
	document.getElementById('formParticipant').submit();
}

function fncCancelSpecialOrderParticipant () {
	document.getElementById('formParticipant').action = path+'index.php/school/special_order_entry/';
	document.getElementById('formParticipant').submit();	
}




function fetch_item_code_details()
{
	
	//alert('hiiioooi');
	//if(document.getElementById('chkAddParticipant').checked == true && document.getElementById('editEntry').style.display	!=	'block')
	if(document.getElementById('editEntry').style.display	!=	'block')
	{
		//alert('hiiii');
		var item_code	=	document.getElementById('txtItemCode_1').value;
		var sch_code	=	document.getElementById('txtSchoolCode').value;
		//ajax_loder2('divSchoolCode');
		
		xmlHttp=GetXmlHttpObject();
		if (xmlHttp)
		{
			var url=path+"index.php/school/special_order_entry/get_itemcode_details/"+item_code;
			//alert(url);
			xmlHttp.onreadystatechange = function stateChanged() 
			{ 
				if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
				{ 
					arrResponse	=	xmlHttp.responseText;
					
					document.getElementById('newEntry').style.display='block';
					document.getElementById('newEntry').innerHTML=xmlHttp.responseText;
					
				} 
			}
						
			xmlHttp.open("POST",url,true);
			xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlHttp.send();
			//xmlHttp.send(parameters);
		}
		
	}	
	
}


function fetch_admision_no_details_array(val)
{	
	
	var admn		=	document.getElementById('txtADNO'+val).value;
	var scholCode	=	document.getElementById('hidSchoolId').value;
	var fest_id		=	document.getElementById('fest_id').value;
	
	var admn_category =0;
	if(fest_id==4)
	{
		var admn_category		=	document.getElementById('admn_category'+val).value;
		//alert(admn_category);
	}
	
	
	if(admn)
	{
		xmlHttp=GetXmlHttpObject();
		if (xmlHttp)
		{
			var url=path+"index.php/school/special_order_entry/get_admn_wise_part_details/"+scholCode+"/"+admn+"/"+fest_id+"/"+admn_category;
			//alert(url);
			xmlHttp.onreadystatechange = function stateChanged() 
			{ 
				if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete");
				{ 
					arrResponse	=	xmlHttp.responseText;
					
					//alert(arrResponse);
					//alert(partary[1]);
					//alert(partary[2]);
					//alert(fest_id);
					//alert(partary[3]);
					
					if(arrResponse)
					{
						partary =new Array();
						partary = arrResponse.split("<br>");
					
						/*if(fest_id != partary[3])
						{
							alert("Admission number "+admn+" is already exist in another festival type")
							document.getElementById('txtADNO'+val).value = '';
							return false();
						}
						else
						{*/
							document.getElementById('txtParticipantName'+val).value	=	partary[0];
							document.getElementById('txtClass'+val).value	=	partary[1];
							document.getElementById('txtGender'+val).value	=	partary[2];
							//document.getElementById('newEntry').style.display='block';
							//document.getElementById('newEntry').innerHTML=xmlHttp.responseText;
						//}
					}
				} 
			}
						
			xmlHttp.open("POST",url,true);
			xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlHttp.send();
			//xmlHttp.send(parameters);
		}
	}
		
	
}

function fncUpdateParticipant(adno) {
	
	
	var limit = document.getElementById('limit').value;
	
	var items = document.getElementById('items').value;
	
	var is_exhibit = document.getElementById('is_exhibit').value;
	
	if((items == 123) || (items == 138) || (items == 147) || (items == 164) || (items == 182))
	{
		if(document.getElementById('txtExhibitName').value == ''){
			
				alert('Please enter the exhibit name');
				document.getElementById('txtExhibitName').focus();
				return false;
		}
	}
	else
	{
			
	for(var i=0;i<limit;i++)
	{
		if(is_exhibit)
		{
			
			if(document.getElementById('txtExhibitName').value == ''){
			
				alert('Please enter the exhibit name');
				document.getElementById('txtExhibitName').focus();
				return false;
			}
		}
	if((document.getElementById('txtADNO'+i).value != '') || (document.getElementById('txtClass'+i).value > 0) || (document.getElementById('txtParticipantName'+i).value != ''))
	{
		if(document.getElementById('txtADNO'+i).value == ''){
		
		alert('Please enter the admission number');
		document.getElementById('txtADNO'+i).focus();
		return false;
		}
		var admn_no		=	document.getElementById('txtADNO'+i).value;
		
		if(document.getElementById('is_teach').value != 'Y'){
			
		if(document.getElementById('txtClass'+i).value == 0)
		{
			alert('Please enter the class ');
			document.getElementById('txtClass'+i).focus();
			return false;
		}
		
		if (document.getElementById('txtClass'+i).value > 10)
		{
			var hss_vhse_chr	=	(document.getElementById('admn_category'+i).value);	
			if ( !( (hss_vhse_chr == 'V' ) || (hss_vhse_chr == 'H' ) ) )
			{
				alert('Please select whether HSS/VHSS');
				//alert('Invalid admission number');	
				document.getElementById('txtADNO'+i).focus();
				return false;
			}
			admn_no		=	(document.getElementById('txtADNO'+i).value).substring(1);
		}
		
		}
	
		if((document.getElementById('txtParticipantName'+i).value) == ''){
			alert('Please enter the participant name');
			document.getElementById('txtParticipantName'+i).focus();
			return false;
		}
	}
	
		for(var j=i+1;j<limit;j++)
		{
			if(document.getElementById('txtADNO'+i).value == document.getElementById('txtADNO'+j).value)
			{
				alert('Admission number repeated');
				document.getElementById('txtADNO'+i).focus();
				return false;
				
			}
		}
	}
	}
	
	
	document.getElementById('formParticipant').action = path+'index.php/school/special_order_entry/update_participant_detials/'+adno;
	document.getElementById('formParticipant').submit();
}



function fncConfirmSchoolDeatils(){
	
	
	var schoolcode	=	document.getElementById('hidschool').value;
	
	path = document.getElementById("base_url").value;
	document.formSchool.action = path+'index.php/school/registration/school_finalize/'+schoolcode;
	document.formSchool.submit();
}
/*******************************************************/

function exhibValidate()
{	
	
	
	//alert("giiiiiiiiiiii");
	
	var escorting_teacher_num= document.getElementById("escorting_teacher_num").value;	
	if(escorting_teacher_num==0)
	{
		alert("Number of escorting teacher is required");
		document.getElementById("escorting_teacher_num").focus();
		return false;		
	}
	else
	{		
		for(i=1;i<=escorting_teacher_num;i++)
		{
			name  = document.getElementById("escorting_teacher_name["+i+"]").value;
			desig = document.getElementById("designation["+i+"]").value;
			phone = document.getElementById("escorting_teacher_phone["+i+"]").value;
			
			if(name == ''){
			alert("Escorting Teacher name required");
			document.getElementById("escorting_teacher_name["+i+"]").focus();
			return false;	
			}			
			if(desig==0){
				alert("Escorting Teacher's Designation required");
				document.getElementById("designation["+i+"]").focus();
				return false;	
			}			
			if(phone==''){
				alert("Escorting Teacher's Phone required");
				document.getElementById("escorting_teacher_phone["+i+"]").focus();
				return false;	
			}														
		}//for
	}//else
	
	
	
	
	var items_no= document.getElementById("items").value;
   // alert("----"+items_no);
	var itemary_no =items_no.split('#');
	
	
	var limit = itemary_no.length;
	
	/*************** checking atleast 1 item is selected ***************/
	for(i=0;i<(limit-1);i++)
	{
		//alert(itemary_no[i]);
		var sel_flag	=	1;
		var item1_name = itemary_no[i]+'_chk';
		if(document.getElementById(item1_name).checked	==	false)
			 sel_flag	=	0;
	    else
		     break;				
	}
	
	if(sel_flag	==	0)
	{  
		alert('Select atleast one item');
		return false;
	}
	/***********end***************/
	
	for(i=1;i<6;i++)
	{		
		var item1_name = itemary_no[i]+'_chk';
	    if(document.getElementById(item1_name).checked	==	false)
			 sel_flag	=	0;
	    else
		     sel_flag	=	1; break;				
	}
	
	
	
	
	
	
	
for(k=1;k<6;k++)
	{
			
		/*alert(document.getElementById("adm_no"+k).value);
		alert(document.getElementById("name_participant"+k).value);
		alert(document.getElementById("txtStandard"+k).value);
		alert(document.getElementById("txtgender"+k).value);*/
	
			if( (document.getElementById("adm_no"+k).value != '') || (document.getElementById("name_participant"+k).value != '') || (document.getElementById("txtStandard"+k).value > 0) ||  (document.getElementById("txtgender"+k).value != 0) )
			{
	
			  if((document.getElementById("name_participant"+k).value == '')){
					alert("Enter Name of Participant");
					document.getElementById("name_participant"+k).focus();
					return false;
				}
				else if((document.getElementById("txtStandard"+k).value == 0)){
					alert("Enter Standard");
					document.getElementById("txtStandard"+k).focus();
					return false;
				}
				else if((document.getElementById("adm_no"+k).value == '')){
					alert("Enter Admission number");
					document.getElementById("adm_no"+k).focus();
					return false;
				}
				
				else if((document.getElementById("txtgender"+k).value == 0)){
					alert("Enter Gender");
					document.getElementById("txtgender"+k).focus();
					return false;
				}
																   
									
			
			}//checking null/zero
			

}
	
	
}


function loadStdtype(val)
{
	//alert(val);
	var std = document.getElementById("txtStandard"+val).value;
	
	if((std==11) || (std==12))
	{
		document.getElementById("admn_category"+val).disabled = false;
	}
	else
	{
		document.getElementById("admn_category"+val).disabled = true;
	}
}

function checkmark(id,mark,exb)
{
	if(exb == 0 && mark >100)
	{
		alert("Please enter mark in 100");
		//alert(id);
		document.getElementById(id).value	= "";		
		document.getElementById(id).focus();
		return false;		
	}
	
}