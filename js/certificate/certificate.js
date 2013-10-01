// JavaScript Document

function getItemCertificate(itemcode)
{ 
	var baseUrl		=	document.getElementById('baseurl').value;
	var url	=baseUrl+"certificate/certificate/get_certificate_itemwise";
	document.getElementById('formIWPq').action	=	url;		
	document.getElementById('formIWPq').submit();	
}

function fetch_participant_details_result(){
		var partid	=	document.getElementById('txtParticipantId').value;
		if(partid != 0 ){
		//ajax_loder2('cmbitem');
		
		xmlHttp=GetXmlHttpObject();
		if (xmlHttp){
			var url=path+"index.php/ajax/loadajax/get_participant_details/"+partid;
			xmlHttp.onreadystatechange = function stateChanged() 
			{ 
				if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
				{ 
					arrResponse	=	xmlHttp.responseText;
					
					document.getElementById('content_id').innerHTML=xmlHttp.responseText;
				
				}
			
			}
			
			xmlHttp.open("POST",url,true);
			xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlHttp.send();
			}
		}
				
}

function getSchoolWiseCertificate (schoolCode){
		document.getElementById('hidSchoolCode').value	=	schoolCode;
		var baseUrl		=	document.getElementById('baseurl').value;
		var url			=	baseUrl+"index.php/certificate/certificate/get_certificate_school_wise";
		document.getElementById('formIWPq').action	=	url;		
		document.getElementById('formIWPq').submit();
}

function getSchoolWise_attendedCertificate(schoolCode){
		document.getElementById('hidSchoolCode').value	=	schoolCode;
		var baseUrl		=	document.getElementById('baseurl').value;
		var url			=	baseUrl+"index.php/certificate/certificate/get_attended_certificate_school_wise";
		document.getElementById('formIWPq').action	=	url;		
		document.getElementById('formIWPq').submit();
}

function getSchoolWiseAttendedCertificate (schoolCode){
		document.getElementById('hidSchoolCode').value	=	schoolCode;
		var baseUrl		=	document.getElementById('baseurl').value;
		var url			=	baseUrl+"index.php/certificate/certificate/get_attended_certificate_school_wise";
		document.getElementById('formIWPq').action	=	url;		
		document.getElementById('formIWPq').submit();
}


function get_school_items (element_value){
	
		document.getElementById('all_item_code').innerHTML='<select  class="input_box"  name="item_code" id="item_code" ><option vlaue="0">All Items</option></select>';
		document.getElementById('all_captain_id').innerHTML='<select  class="input_box"  name="captain_id" id="captain_id" ><option vlaue="0">All Participants</option></select>';
		document.getElementById('all_group_participant_id').innerHTML='<select  class="input_box"  name="participant_id" id="participant_id" ><option vlaue="0">All Participants</option></select>';
		var hidSchoolCode		=	document.getElementById('hidSchoolCode').value;
		var fair				=	document.getElementById('cmbFairType').value;
			
			/*if(fair==4){
				if(document.getElementById('radioLabel_spot').checked==true){
					var checkedvalue	=	document.getElementById('radioLabel_spot').value;
				}
				if(document.getElementById('radioLabel_exhib').checked==true){
					var checkedvalue	=	document.getElementById('radioLabel_exhib').value;
				}
			}*/
			
			 if(fair==4){
					 var checkedvalue	=	document.getElementById('radioLabel_spot').value;
			 }
			 
			xmlHttp=GetXmlHttpObject();
			if (xmlHttp){
				var url=path+"index.php/ajax/loadajax/get_school_items/"+fair+"/"+element_value+"/"+hidSchoolCode+"/"+checkedvalue;
				xmlHttp.onreadystatechange = function stateChanged() 
				{ 
				if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
				{ 
				arrResponse	=	xmlHttp.responseText;
				document.getElementById('all_item_code').innerHTML='';
				document.getElementById('all_item_code').innerHTML=xmlHttp.responseText;
				} 
				}
				
				xmlHttp.open("POST",url,true);
				xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xmlHttp.send();
			}
}

function get_attended_school_items(element_value){
	
	document.getElementById('all_item_code').innerHTML='<select  class="input_box"  name="item_code" id="item_code" ><option vlaue="0">All Items</option></select>';
		document.getElementById('all_captain_id').innerHTML='<select  class="input_box"  name="captain_id" id="captain_id" ><option vlaue="0">All Participants</option></select>';
		document.getElementById('all_group_participant_id').innerHTML='<select  class="input_box"  name="participant_id" id="participant_id" ><option vlaue="0">All Participants</option></select>';
		var hidSchoolCode		=	document.getElementById('hidSchoolCode').value;
		var fair				=	document.getElementById('cmbFairType').value;
			
			if(fair==4){
				if(document.getElementById('radioLabel_spot').checked==true){
					var checkedvalue	=	document.getElementById('radioLabel_spot').value;
				}
				if(document.getElementById('radioLabel_exhib').checked==true){
					var checkedvalue	=	document.getElementById('radioLabel_exhib').value;
				}
			}
			 
			xmlHttp=GetXmlHttpObject();
			if (xmlHttp){
				var url=path+"index.php/ajax/loadajax/get_attended_school_items/"+fair+"/"+element_value+"/"+hidSchoolCode+"/"+checkedvalue;
				xmlHttp.onreadystatechange = function stateChanged() 
				{ 
				if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
				{ 
				arrResponse	=	xmlHttp.responseText;
				document.getElementById('all_item_code').innerHTML='';
				document.getElementById('all_item_code').innerHTML=xmlHttp.responseText;
				} 
				}
				
				xmlHttp.open("POST",url,true);
				xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xmlHttp.send();
			}
}



/*function get_attended_school_items(){ 
		document.getElementById('all_item_code').innerHTML='<select  class="input_box"  name="item_code" id="item_code" ><option vlaue="0">All Items</option></select>';
		document.getElementById('all_captain_id').innerHTML='<select  class="input_box"  name="captain_id" id="captain_id" ><option vlaue="0">All Participants</option></select>';
		document.getElementById('all_group_participant_id').innerHTML='<select  class="input_box"  name="participant_id" id="participant_id" ><option vlaue="0">All Participants</option></select>';
		var hidSchoolCode		=	document.getElementById('hidSchoolCode').value;
		var fair				=	document.getElementById('cmbFairType').value;
			
			xmlHttp=GetXmlHttpObject();
			if (xmlHttp){
				var url=path+"index.php/ajax/loadajax/get_attended_school_items/"+fair+"/"+element_value+"/"+hidSchoolCode;alert(url);
				xmlHttp.onreadystatechange = function stateChanged() 
				{ 
				if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
				{ 
				arrResponse	=	xmlHttp.responseText;
				document.getElementById('all_item_code').innerHTML='';
				document.getElementById('all_item_code').innerHTML=xmlHttp.responseText;
				} 
				}
				
				xmlHttp.open("POST",url,true);
				xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xmlHttp.send();
			}
}*/

function get_school_captains (element_value)
{
	
		document.getElementById('all_captain_id').innerHTML='<select  class="input_box"  name="captain_id" id="captain_id" ><option vlaue="0">All Participants</option></select>';
		document.getElementById('all_group_participant_id').innerHTML='<select  class="input_box"  name="participant_id" id="participant_id" ><option vlaue="0">All Participants</option></select>';
		var hidSchoolCode		=	document.getElementById('hidSchoolCode').value;
		var fair				=	document.getElementById('cmbFairType').value;
			
			xmlHttp=GetXmlHttpObject();
			if (xmlHttp){
				var url=path+"index.php/ajax/loadajax/get_school_captains/"+fair+"/"+element_value+"/"+hidSchoolCode;
				xmlHttp.onreadystatechange = function stateChanged() 
				{ 
				if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
				{ 
				arrResponse	=	xmlHttp.responseText;
				document.getElementById('all_captain_id').innerHTML='';
				document.getElementById('all_captain_id').innerHTML=xmlHttp.responseText;
				} 
				}
				
				xmlHttp.open("POST",url,true);
				xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xmlHttp.send();
			}
}

function get_school_group_participants(captain_id){
			var hidSchoolCode		=	document.getElementById('hidSchoolCode').value;
			var item_code			=	document.getElementById('item_code').value;
			xmlHttp=GetXmlHttpObject();
			if (xmlHttp){
				var url=path+"index.php/ajax/loadajax/get_all_group_participants/"+item_code+"/"+captain_id+"/"+hidSchoolCode;
				xmlHttp.onreadystatechange = function stateChanged() 
				{ 
					if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){ 
						arrResponse	=	xmlHttp.responseText;
						document.getElementById('all_group_participant_id').innerHTML='';
						document.getElementById('all_group_participant_id').innerHTML=xmlHttp.responseText;
					} 
				}
				
				xmlHttp.open("POST",url,true);
				xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xmlHttp.send();
			}
}

function selectCat_certificate(val)
{ 
		/*if(val == 'spot')
		{ 
			 document.getElementById('cmbFestType').disabled=false; 
			 if(document.getElementById('cmbFestType').value==''){ 
				document.getElementById('GET').disabled=true;  
			 }
			 else{
				 document.getElementById('GET').disabled=false; 
			 }
	
		}
		else if(val == 'exhib'){  
			 document.getElementById('cmbFestType').value=0;
			 document.getElementById('cmbFestType').disabled=true;  
			 document.getElementById('GET').disabled=false; 
		}
		get_school_items();*/
		
		
		if(val == 'spot')
		{ 
			 document.getElementById('item_code').disabled=false; 
			 //if(document.getElementById('cmbFestType').value==''){ 
				//document.getElementById('GET').disabled=true;  
			// }
			// else{
				// document.getElementById('GET').disabled=false; 
			 //}
	
		}
	   if(val == 'exhib'){  
			 //document.getElementById('item_code').value=0;
			 document.getElementById('item_code').disabled=true;  
			 //document.getElementById('GET').disabled=false; 
		}
		get_school_items();
}



function validatespotexpo(){
			if(document.getElementById('cmbFairType').value==4 && document.getElementById('cmbFestType').value=='' && (document.getElementById('radioLabel_spot').checked==false && document.getElementById('radioLabel_exhib').checked==false)){
				alert('Please Select On the Spot/Exhibition');
				return false;
			}
}


/*function fetch_attended_participant_details_result(){
		var partid	=	document.getElementById('txtParticipantId').value;
		if(partid != 0 ){
		
		xmlHttp=GetXmlHttpObject();
		if (xmlHttp){
			var url=path+"index.php/ajax/loadajax/get_attended_participant_details/"+partid;
			xmlHttp.onreadystatechange = function stateChanged() 
			{ 
				if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
				{ 
					arrResponse	=	xmlHttp.responseText;
					
					//document.getElementById('cmbitem').style.display='block';
					document.getElementById('content_id').innerHTML=xmlHttp.responseText;
				
				}
			
			}
			
			xmlHttp.open("POST",url,true);
			xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlHttp.send();
			}
		}
}
*/

function check_workexpo_4result_certificate(val){
		document.getElementById('cmbFestType').disabled=false; 
		document.getElementById('all_item_code').innerHTML='<select  class="input_box"  name="item_code" id="item_code" ><option vlaue="0">All Items</option></select>';
		document.getElementById('all_captain_id').innerHTML='<select  class="input_box"  name="captain_id" id="captain_id" ><option vlaue="0">All Participants</option></select>';
		document.getElementById('all_group_participant_id').innerHTML='<select  class="input_box"  name="participant_id" id="participant_id" ><option vlaue="0">All Participants</option></select>';
		if(val == 4){
		  document.getElementById('work').style.visibility='visible'; 
		}
		else{ 
			 document.getElementById('work').style.visibility='hidden'; 
		 }	
}

function check_for_workexpo(val)
{	
	//document.getElementById('cmbCateType').value=0;
	
	if(val == 4){ 
	  document.getElementById('work').style.visibility='visible'; 
	}
	else{ 
		 //document.getElementById('radioLabel_spot').checked = true;
		 //document.getElementById('cmbCateType').disabled=false;
		 document.getElementById('work').style.visibility='hidden'; 
	 }	
}

function get_attended_school_captains (element_value)
{
	
		document.getElementById('all_captain_id').innerHTML='<select  class="input_box"  name="captain_id" id="captain_id" ><option vlaue="0">All Participants</option></select>';
		document.getElementById('all_group_participant_id').innerHTML='<select  class="input_box"  name="participant_id" id="participant_id" ><option vlaue="0">All Participants</option></select>';
		var hidSchoolCode		=	document.getElementById('hidSchoolCode').value;
		var fair				=	document.getElementById('cmbFairType').value;
			
			xmlHttp=GetXmlHttpObject();
			if (xmlHttp){
				var url=path+"index.php/ajax/loadajax/get_attended_school_captains/"+fair+"/"+element_value+"/"+hidSchoolCode;
				xmlHttp.onreadystatechange = function stateChanged() 
				{ 
				if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
				{ 
				arrResponse	=	xmlHttp.responseText;
				document.getElementById('all_captain_id').innerHTML='';
				document.getElementById('all_captain_id').innerHTML=xmlHttp.responseText;
				} 
				}
				
				xmlHttp.open("POST",url,true);
				xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xmlHttp.send();
			}
}


function getParticipant (element_value)
{
	
		var hidItemId		=	document.getElementById('hidItemId').value;
			
			xmlHttp=GetXmlHttpObject();
			if (xmlHttp){
				var url=path+"index.php/ajax/loadajax/get_all_group_participants/"+hidItemId+"/"+element_value;
				xmlHttp.onreadystatechange = function stateChanged() 
				{ 
				if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
				{ 
				arrResponse	=	xmlHttp.responseText;
				document.getElementById('all_participant_id').innerHTML='';
				document.getElementById('all_participant_id').innerHTML=xmlHttp.responseText;
				} 
				}
				
				xmlHttp.open("POST",url,true);
				xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xmlHttp.send();
			}
}


function printContent()
{ 
  var disp_setting="toolbar=yes,location=no,directories=yes,menubar=yes,"; 
      disp_setting+="scrollbars=yes,width=650, height=600, left=100, top=25"; 
  var content_vlue = document.getElementById("print_content").innerHTML; 
  
  var docprint=window.open("","",disp_setting); 
   docprint.document.open(); 
   docprint.document.write('<html><head><title>Science Fair</title>'); 
   docprint.document.write('</head><body onLoad="self.print()"><center><strong>');          
   docprint.document.write(content_vlue);          
   docprint.document.write('</strong></center></body></html>'); 
   docprint.document.close(); 
   docprint.focus(); 
    // window.location="vacancy_print.php";
	
}

function getExhibitionCaptains (schoolCode,fest){
		document.getElementById('hidSchoolCode').value	=	schoolCode;
		document.getElementById('fest').value	=	fest;

		var baseUrl		=	document.getElementById('baseurl').value;
		var url			=	baseUrl+"index.php/certificate/certificate/exhibition_captains/"+schoolCode+"/"+fest;
		document.getElementById('formIWPq').action	=	url;		
		document.getElementById('formIWPq').submit();
}

function getExhibitionParticipant(){
		schoolCode	=	document.getElementById('hidschoolcode').value;
		xmlHttp=GetXmlHttpObject();
		if (xmlHttp){
		var url=path+"index.php/ajax/loadajax/get_all_exhibition_group_participants/"+element_value+'/'+schoolCode;
		xmlHttp.onreadystatechange = function stateChanged() 
		{ 
			if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
			{ 
			arrResponse	=	xmlHttp.responseText;
			document.getElementById('all_participant_id').innerHTML='';
			document.getElementById('all_participant_id').innerHTML=xmlHttp.responseText;
			} 
		}
		
		xmlHttp.open("POST",url,true);
		xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlHttp.send();
		}
}

function get_attendedExhibitionCaptains(schoolCode){
		document.getElementById('hidSchoolCode').value	=	schoolCode;
		var baseUrl		=	document.getElementById('baseurl').value;
		var url			=	baseUrl+"index.php/certificate/certificate/attended_exhibition_captains/"+schoolCode;
		document.getElementById('formIWPq').action	=	url;		
		document.getElementById('formIWPq').submit();
}