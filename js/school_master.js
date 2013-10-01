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


function ajax_loder2(ele){ $(ele).innerHTML = '<img src="'+image_path+'ajax_loader2.gif">'; }
function fncAddSchool(usertype)
{
	if(!document.getElementById('txtSchoolName').value)
	{
		alert("Please Enter School name");
		document.getElementById('txtSchoolName').focus();
		return false;
	}
	
	if(document.getElementById('cmbSchoolType').value==0)
	{
		alert("Please select School type");
		document.getElementById('cmbSchoolType').focus();
		return false;
	}
	
	if(usertype	< 2) {
		if(document.getElementById('cmbDistrict').value==0)
		{
			alert("select District");
			document.getElementById('cmbDistrict').focus();
			return false;
		}
	}
	if(usertype	< 3) {
		if(document.getElementById('cmbEduDistrict').value==0)
		{
			alert("select Education District");
			document.getElementById('cmbEduDistrict').focus();
			return false;
		}
	
		if(document.getElementById('cmbSubDistrict').value==0)
		{
			alert("select Sub-District");
			document.getElementById('cmbSubDistrict').focus();
			return false;
		}
		
		
	}
	return true;
	
}

function fncUpdateSchool(userId, usertype){
	if(!document.getElementById('txtSchoolName').value)
	{
		alert("Please Enter School name");
		document.getElementById('txtSchoolName').focus();
		return false;
	}
	
	if(document.getElementById('cmbSchoolType').value==0)
	{
		alert("Please select School type");
		document.getElementById('cmbSchoolType').focus();
		return false;
	}
	if(usertype	< 2) {
		
		if(document.getElementById('cmbDistrict').value==0)
		{
			alert("select District");
			document.getElementById('cmbDistrict').focus();
			return false;
		}
	}
	if(usertype	< 3) {
		if(document.getElementById('cmbEduDistrict').value==0)
		{
			alert("select Education District");
			document.getElementById('cmbEduDistrict').focus();
			return false;
		}
	
		if(document.getElementById('cmbSubDistrict').value==0)
		{
			alert("select Sub-District");
			document.getElementById('cmbSubDistrict').focus();
			return false;
		}
	}
	document.getElementById('hidUserId').value = userId;
	document.getElementById('formUser').action = path+'index.php/school/school_master/update_school_detials';
	document.getElementById('formUser').submit();
}


function deleteUser(userId) {
	if(!confirm('Really want to delete the user?')){
		return false;
	}
	$('UserIdty').value = userId;
	$('editUser').action = path+'schools/school_master/delete_school_detials';
	$('editUser').submit();
}

function edit_User(userId) {
	//alert("hii");
	document.getElementById('UserIdty').value = userId;
	document.getElementById('editUser').action = path+'index.php/school/school_master/edit_school_detials';
	document.getElementById('editUser').submit();
}


function cancel()
{
	$('formUser').action = path+'schools/school_master/';
	$('formUser').submit();
}

function loadEduDistrict()
{	
	if(document.getElementById('cmbDistrict').value > 0)	
	{
			
		document.getElementById('divEduDistrict').style.display = 'block';	
		ajax_loder2('divEdudistrictCombo');
		if(document.getElementById('cmbEduDistrict'))
			document.getElementById('cmbEduDistrict').selectedIndex  = 0;
		
		var district_code	=	document.getElementById('cmbDistrict').value;	
		var strURL= path+"index.php/ajax/loadajax/get_edu_district_details/"+district_code;
		
		xmlHttp=GetXmlHttpObject();
		if (xmlHttp)
		{			
			xmlHttp.onreadystatechange = function stateChanged() 
				{ 				
					if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
					{ 
						//alert("state-->"+xmlHttp.readyState);
						 document.getElementById("divEdudistrictCombo").innerHTML=xmlHttp.responseText;
					 } 				 
				}
				xmlHttp.open("POST",strURL,true);
				xmlHttp.send(null);
		}//end block1*/	
			
	}
}


function loadSubDistrict()
{
	if(document.getElementById('cmbEduDistrict').value > 0)	
	{
		document.getElementById('divSubdistrict').style.display = 'block';	
		ajax_loder2('divSubdistrictCombo');
		if(document.getElementById('cmbSubDistrict'))
			document.getElementById('cmbSubDistrict').selectedIndex  = 0;
		var edu_district	=	document.getElementById('cmbEduDistrict').value;
		var strURL= path+"index.php/ajax/loadajax/get_subdistrict_details_of_edu_district/"+edu_district;
		
		xmlHttp=GetXmlHttpObject();
		if (xmlHttp)
		{			
			xmlHttp.onreadystatechange = function stateChanged() 
				{ 				
					if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
					{ 
						//alert("state-->"+xmlHttp.readyState);
						 document.getElementById("divSubdistrictCombo").innerHTML=xmlHttp.responseText;
					 } 				 
				}
				xmlHttp.open("POST",strURL,true);
				xmlHttp.send(null);
		}//end block1*/			
		
	}
}

function loadSchool()
{
	return;
}

function loadSubDistrictFilter()
{
	if(document.getElementById('cmbDistrictFilter').value > 0)	
	{
		document.getElementById('divSubDistrictFilter').style.display = 'block';	
		ajax_loder2('divSubDistrictFilter');
		if(document.getElementById('cmbSubDistrictFilter'))
			document.getElementById('cmbSubDistrictFilter').selectedIndex  = 0;
		if(document.getElementById('cmbSchoolFilter'))
			document.getElementById('cmbSchoolFilter').selectedIndex  = 0;
		
		var district_code	=	document.getElementById('cmbDistrictFilter').value;
		var name 		= 'cmbSubDistrictFilter';
		var function1 	= 'loadSchoolFilter';
		var strURL= path+"index.php/ajax/loadajax/get_subdistrict_details_small/"+district_code+"/"+name+"/"+function1;
		
		xmlHttp=GetXmlHttpObject();
		if (xmlHttp)
		{			
			xmlHttp.onreadystatechange = function stateChanged() 
				{ 				
					if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
					{ 
						//alert("state-->"+xmlHttp.readyState);
						 document.getElementById("divSubDistrictFilter").innerHTML=xmlHttp.responseText;
					 } 				 
				}
				xmlHttp.open("POST",strURL,true);
				xmlHttp.send(null);
		}//end block1*/					
		
	}
}


function printContent(content)
{ 
  var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
      disp_setting+="scrollbars=yes,width=650, height=600, left=100, top=25"; 
  var content_vlue = document.getElementById(content).innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('<html><head><title>Sasthramela School List</title>'); 
   docprint.document.write('</head><body onLoad="self.print()"><center>');          
   docprint.document.write(content_vlue);          
   docprint.document.write('</center></body></html>'); 
   docprint.document.close(); 
   docprint.focus(); 
    // window.location="vacancy_print.php";
}

