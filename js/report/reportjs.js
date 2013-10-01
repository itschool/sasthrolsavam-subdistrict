// JavaScript Document

function ltrim(str) { for(var k = 0; k < str.length && isWhitespace(str.charAt(k)); k++); return str.substring(k, str.length);}
function rtrim(str) { for(var j=str.length-1; j>=0 && isWhitespace(str.charAt(j)) ; j--) ; return str.substring(0,j+1);}
function trim(str) {return ltrim(rtrim(str));}
function isAlphaNumeric(val){if (val.match(/^[a-zA-Z0-9]+$/)){ return true;}else{return false;} }
function isWhitespace(charToCheck) { var whitespaceChars = " \t\n\r\f"; return (whitespaceChars.indexOf(charToCheck) != -1);}
var delete_msg = 'Do you really want to delete?';


function ajax_loder(ele){ $(ele).innerHTML = '<img src="'+image_path+'ajax_loader.gif">'; }
function ajax_loder2(ele){ $(ele).innerHTML = '<img src="'+image_path+'ajax_loader2.gif">'; }

function fetch_item_from_participant(festid)
{
	//alert(document.getElementById('radioLabel_spot').checked);
	var work_cat	=	'hi';
	var fairid	=	document.getElementById('cmbFairType').value;
	
	if(fairid != 0){
	ajax_loder2('cmbitem');
	
		if(fairid	==	4)
		{			
			if(document.getElementById('radioLabel_spot').checked == true){ 
			  work_cat	=	'spot';	}
			else if(document.getElementById('radioLabel_exhib').checked == true){
			  work_cat	=	'exhib';}		
		}
		//alert(work_cat);
		if(work_cat	!=	'exhib')
		{
				//alert('hiii');
			xmlHttp=GetXmlHttpObject();
			if (xmlHttp)
			{
				var url=path+"index.php/ajax/loadajax/fetch_item_from_participantt/"+festid+"/"+fairid;
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
		}//if(work_cat != 'exhib')
		
	}
	else
	{
		alert("select Fair");
		return false;
		
	}
}

function fetch_item_participant_codegen(festid)
{
	
	var work_cat	=	'hi';
	var fairid	=	document.getElementById('cmbFairType').value;
	
	if(fairid != 0){
	ajax_loder2('cmbitem');
	
		if(fairid	==	4)
		{			
			if(document.getElementById('radioLabel_spot').checked == true){ 
			  work_cat	=	'spot';	}
			else if(document.getElementById('radioLabel_exhib').checked == true){
			  work_cat	=	'exhib';}		
		}
		//alert(work_cat);
		if(work_cat	!=	'exhib')
		{
				//alert('hiii');
			xmlHttp=GetXmlHttpObject();
			if (xmlHttp)
			{
				var url=path+"index.php/ajax/loadajax/fetch_item_from_participant_codegen/"+festid+"/"+fairid;
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
		}//if(work_cat != 'exhib')
		
	}
	else
	{
		alert("select Fair");
		return false;
		
	}
}



function fetch_item_from_participant_scoresheet(festid)
{
	//alert(document.getElementById('radioLabel_spot').checked);
	var work_cat	=	'hi';
	var fairid	=	document.getElementById('cmbFairType').value;
	
	if(fairid != 0){
	ajax_loder2('cmbitem');
	
		if(fairid	==	4)
		{			
			if(document.getElementById('radioLabel_spot').checked == true){ 
			  work_cat	=	'spot';	}
			else if(document.getElementById('radioLabel_exhib').checked == true){
			  work_cat	=	'exhib';}		
		}
		//alert(work_cat);
		if(work_cat	!=	'exhib')
		{
				//alert('hiii');
			xmlHttp=GetXmlHttpObject();
			if (xmlHttp)
			{
				var url=path+"index.php/ajax/loadajax/fetch_item_from_festival/"+festid+"/"+fairid;
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
		}//if(work_cat != 'exhib')
		
	}
	else
	{
		alert("select Fair");
		return false;
		
	}
}



function fnschgpwdAddrr1(){
	
	     //alert(document.getElementById('cmbCateType').value);
		 if(document.getElementById('txtSchoolCode').value==0){
				alert("Please Enter SchoolCode");
				return false;
		 }	
		 if(document.getElementById('cmbFairType').value==0){
				alert("Please Select fairId");
				return false;
		 }
		 
		 if(document.getElementById('cmbCateType').value==0 && document.getElementById('radioLabel_exhib').checked != true){
				alert("Please Select Category");
				return false;
		 }
}//fnschgpwdAddrr()

function validateallfair(formid){
	     form_id	=	formid.id;
		// alert(form_id);
		 if(document.getElementById(form_id).cmbFairType.value==0){
				alert("Please Select fairId");
				return false;
		 }
		 if(document.getElementById(form_id).cmbCateType.value==0 && document.getElementById(form_id).radioLabel_exhib.checked != true){
				alert("Please Select Category");
				return false;
		 }
}//fnschgpwdAddrr()

function funvalidatecaptainrpt(formid){
		 validateallfair(formid);
		 if(document.getElementById('cbo_item').value==0){
				alert("Please Select Item");
				return false;
		 }
		 if(document.getElementById('cbo_cap').value==0){
				alert("Please Select Captain");
				return false;
		 }
}

function fetch_schooldetails(schoolcode){//pratheeksha
		
			if(schoolcode != 0){
			ajax_loder2('cmbitem');
			
			xmlHttp=GetXmlHttpObject();
			if (xmlHttp)
				{
					var url=path+"index.php/ajax/loadajax/fetch_school_from_festival/"+schoolcode;
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
					}
			}
			else
				{
					document.getElementById('cmbitem').style.display='none';
					//alert("select Fair");
					//return false;
				}
}//fetch_schooldetails(schoolcode)


function fetch_team_item_from_festival(cateid){
	
			var fairid	=	document.getElementById('cmbFairType').value;
			if(cateid != 0 && fairid!=0){
				ajax_loder2('cmbitem');
				
				xmlHttp=GetXmlHttpObject();
				if (xmlHttp)
					{
						var exb=0;
						if(fairid == 4)
						{
						if(document.getElementById("radioLabel_spot").checked==true)
						{var exb=0;}
						else if(document.getElementById("radioLabel_exhib").checked==true)
						{var exb=2;}
						}
						
						var url=path+"index.php/ajax/loadajax/fetch_team_item_from_festival/"+cateid+'/'+fairid+'/'+exb;
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
						}
				}
}

function fetch_team_captain_from_item(itemcode){
	
		if(itemcode){
			ajax_loder2('cmbcap');
			
			xmlHttp=GetXmlHttpObject();
			if (xmlHttp)
				{
					var url=path+"index.php/ajax/loadajax/fetch_team_captain_from_item/"+itemcode;
					xmlHttp.onreadystatechange = function stateChanged() 
					{ 
					if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
					{ 
					arrResponse	=	xmlHttp.responseText;
					
					document.getElementById('cmbcap').style.display='block';
					document.getElementById('cmbcap').innerHTML=xmlHttp.responseText;
					
					} 
					}
					
					xmlHttp.open("POST",url,true);
					xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					xmlHttp.send();
					}
			}
			else
				{
					document.getElementById('cmbcap').style.display='none';
					alert("select Fair");
					return false;
				}
	
}

function callsheetfirst(type){
	//alert(document.getElementById('cmbFairType').value);
	
	if(type == "report")
	{
		if(document.getElementById('cmbFairType').value==0){
			alert("Please select a Fair");
			document.getElementById('cmbFairType').focus();
			return false;
		}
		if(document.getElementById('cmbCateType').value==0 ){
			alert("Please select a Category");
			document.getElementById('cmbCateType').focus();
			return false;
		}
		
		if(document.getElementById('cmbFairType').value	==	4)
		{	
			if(document.getElementById('radioLabel_spot').checked == true)
			{
				 if(document.getElementById('cbo_item').value==0){
					alert("Please select an Item");
					document.getElementById('cbo_item').focus();
					return false;
					}
			}
				
		}
		else
		{
			if(document.getElementById('cbo_item').value==0){
				alert("Please select an Item");
				document.getElementById('cbo_item').focus();
				return false;
			}
		}
		if(document.getElementById('cmbFairType').value	==	4)
		{
			if(document.getElementById('radioLabel_spot').checked == true)
			{
				document.getElementById('cmbCateType_hid').value = document.getElementById('cmbCateType').value;
			}
			else if(document.getElementById('radioLabel_exhib').checked == true)
			{
				document.getElementById('cmbCateType_hid').value =0;
				document.getElementById('cmbfestId').value =document.getElementById('cmbCateType').value;
			}
			url = path+"index.php/report/prereportpdf/callsheet_Wreport";
			//alert(url);
			document.getElementById('callsheet').action = url;
			document.getElementById('callsheet').target="_blank";
			document.getElementById('callsheet').submit();
		}
		else if(document.getElementById('cmbFairType').value	!=	4)
		{
			url = path+"index.php/report/prereportpdf/callsheet_report";
			//alert(url);
			document.getElementById('callsheet').action = url;
			document.getElementById('callsheet').target="_blank";
			document.getElementById('callsheet').submit();
			return true;
		}
	}//if report
	if(type == "code")
	{
		if(document.getElementById('cmbFairType').value==0){
			alert("Please select a Fair");
			document.getElementById('cmbFairType').focus();
			return false;
		}
		if(document.getElementById('cmbCateType').value==0 && document.getElementById('radioLabel_exhib').checked != true){
			alert("Please select a Category");
			document.getElementById('cmbCateType').focus();
			return false;
		}
		if(document.getElementById('cmbFairType').value	==	4)
		{	
			if(document.getElementById('radioLabel_spot').checked == true)
			{
				 if(document.getElementById('cbo_item').value==0){
					alert("Please select an Item");
					document.getElementById('cbo_item').focus();
					return false;
					}
			}
				
		}
		else
		{
			if(document.getElementById('cbo_item').value==0){
				alert("Please select an Item");
				document.getElementById('cbo_item').focus();
				return false;
			}
		}
		url = path+"index.php/report/prereport/callsheet_first/1";
		//alert(url);
		document.getElementById('callsheet').action = url;
		document.getElementById('callsheet').target="_self";
		document.getElementById('callsheet').submit();
	}//if report
}

function addPrefix(start_no)
{ 
 	ino = start_no;
	var prefx = document.getElementById('prefixCode').value;
	var numbrs = document.getElementById('item_no').value;
	for(i=1;i<=numbrs;i++)
	{
		var textbx = 'prefix_'+i;
		var regNo = document.getElementById('reg_'+i).value;
		var text_start = 'code_'+regNo;

		document.getElementById(textbx).innerHTML = prefx;
		document.getElementById(text_start).value = ino;
		ino++;
	}//for
}



function chkFields(type)
{
	var numbrs = document.getElementById('item_no').value;
	
	if(document.getElementById('prefixCode').value == '' || document.getElementById('prefixCode').value == 0)
		{
			alert("Please enter Prefix Code ");	
			document.getElementById('prefixCode').focus();
			return false;
		}
	/*//any textbox is null 
	for(i=1;i<=numbrs;i++)
	{
		var reg = 'reg_'+i;
		regno = document.getElementById(reg).value;
		var textbx = 'code_'+regno;
		
		//document.getElementById(textbx).value = prefx;
		if(document.getElementById(textbx).value == '' || document.getElementById(textbx).value == 0)
		{
			alert("Please enter code for Reg No : "+regno);	
			document.getElementById(textbx).focus();
			return false;
		}
		
	}//for*/
	for(i=1;i<=numbrs;i++)
	{
		var reg = 'reg_'+i;
		regno = document.getElementById(reg).value;
		var textbx = 'code_'+regno;
		for(j=1;j<=numbrs;j++)
		{
			if(j == i)
				continue;
		
			var reg_j = 'reg_'+j;
			regno_j = document.getElementById(reg_j).value;
			var textbx_j = 'code_'+regno_j;
			
			if((document.getElementById(textbx).value != '' && document.getElementById(textbx).value != 0) && (document.getElementById(textbx_j).value != '' && document.getElementById(textbx_j).value != 0))
			{
				if(document.getElementById(textbx).value == document.getElementById(textbx_j).value)
				{
					alert("Same code entered for Reg No : "+regno+" & Reg No :"+regno_j);	
					document.getElementById(textbx_j).focus();
					return false;
				}
			}
		}//inner for
			
	}//for
	
	
	if(type == 1)
	{
		url = path+"index.php/report/prereport/callsheet_save/1";
		//alert(url);
		document.getElementById('callsheetcode').action = url;
		document.getElementById('callsheetcode').target="_self";
		document.getElementById('callsheetcode').submit();
	}
	
}//fn

function resetCode()
{
		url = path+"index.php/report/prereport/resetCode";
		//alert(url);
		document.getElementById('callsheetcode').action = url;
		document.getElementById('callsheetcode').target="_self";
		document.getElementById('callsheetcode').submit();
	
}//fn

function resetCodenumbers(details)
{//alert('jkgfg');
	url = path+"index.php/report/prereport/resetWorkExpoCode/"+details;
	document.getElementById('codeform').action = url;
	document.getElementById('codeform').submit();
	
}

function printCode(details)
{
	url = path+"index.php/report/prereport/print_code_number/"+details;
	document.getElementById('codeform').action = url;
		document.getElementById('codeform').target="_blank";
		document.getElementById('codeform').submit();
}

function printCode2(details)
{
	//alert(path);
	url = path+"index.php/report/prereport/print_code_number/"+details;
	document.getElementById('callsheetcode').action = url;
		document.getElementById('callsheetcode').target="_blank";
		document.getElementById('callsheetcode').submit();
}

function printCode3()
{
	var fair_id = document.getElementById('cmbFairType').value;
	var fest_id = document.getElementById('cmbCateType').value;
	if(fair_id == 0)
	{
		alert('Please select fair');
		return false;
	}
	if(fest_id == 0)
	{
		alert('Please select category');
		return false;
	}
	 details = fair_id+"__"+fest_id+"__ALL";
		url = path+"index.php/report/prereport/print_code_number/"+details;
		document.getElementById('callsheet').action = url;
		document.getElementById('callsheet').target="_blank";
		document.getElementById('callsheet').submit();
	
}

function printCodenumbers()
{
	url = path+"index.php/report/prereportpdf/callsheet_Wreport";
	document.getElementById('codeform').action = url;
	//alert(document.getElementById('codeform').action);
	document.getElementById('codeform').target="_blank";
	document.getElementById('codeform').submit();
}



function confirmCodenumbers(type)
{
	//alert('hi');
	var numbrs = document.getElementById('number').value;
	for(i=1;i<=numbrs;i++)
	{
		var reg = 'txtPart_'+i;
		var absnt = 'chk_absent'+i;
		regno = document.getElementById(reg).value;
		var textbx = 'txt_code'+regno;
		if(document.getElementById(absnt).checked != true)
		{
		//check alphanumeric characters 
			if((/^[a-zA-Z0-9]+$/).test(document.getElementById(textbx).value))
			{
			}
			else
			{	alert('Please enter only Alphabets or Numbers');
				document.getElementById(textbx).focus();
				return false;
			}
			//alert(document.getElementById(absnt).checked);
			
				/////////////////////
				for(j=1;j<=numbrs;j++)
				{
					if(j == i)
						continue;
				
					var reg_j = 'txtPart_'+j;
					var absnt_j = 'chk_absent'+j;
					regno_j = document.getElementById(reg_j).value;
					var textbx_j = 'txt_code'+regno_j;
					
					if(document.getElementById(absnt_j).checked != true)
					{
					if((document.getElementById(textbx).value != '' && document.getElementById(textbx).value != 0) && (document.getElementById(textbx_j).value != '' && document.getElementById(textbx_j).value != 0))
					{
						if(document.getElementById(textbx).value == document.getElementById(textbx_j).value)
						{ 
							if(type == "exhibition")
							{
							alert("Same code entered for School : "+regno+" & School :"+regno_j);	
							}else{
							alert("Same code entered for Regno : "+regno+" & Regno :"+regno_j);	
							}
							document.getElementById(textbx_j).focus();
							return false;
						}
					}
				}//if not absent
				}//inner for
			
			}//if not absent
	}//for
	var ans = confirm('Do u want to confirm the code number?');
	if(ans)
	{
		url = path+"index.php/report/prereport/confirmw_wcode_number";
		document.getElementById('codeform').action = url;
		document.getElementById('codeform').target="_self";
		document.getElementById('codeform').submit();
	}else
	return false;
}

function check_alphanumericChar(obj)
{ 
	var textVal = obj.value;
	var id     = obj.id;
	if((/^[a-zA-Z0-9]+$/).test(textVal))
	{
		var val = textVal.toUpperCase();
		document.getElementById(id).value = val;
	}
	else
	{alert('Please enter only Alphabets or Numbers');
		return false;
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
}


function isAlphanumeric(elem,regNo){
	var alphaExp = /^[0-9a-zA-Z]+$/;
	if(elem.value != '')
	{
	if(elem.value.match(alphaExp)){
		return true;
	}else{
		alert("Code should be only numbers and letters for Reg No :"+regNo);
		var elem_name = elem.name;
		document.getElementById(elem_name).value='';
		document.getElementById(elem_name).focus();
		//elem.focus();
		return false;
	}
	}//if element val not null
}


function tabulationitemsubmit()
{
	//alert('kiii');
	if(document.getElementById('cmbFairType').value==0 || document.getElementById('cmbFairType').value==''){
		alert("Please select a Fair");
		document.getElementById('cmbFairType').focus();
		return false;
	}
	if(document.getElementById('cmbCateType').value==0 ){
			alert("Please select a Category");
			document.getElementById('cmbCateType').focus();
			return false;
		}
	if(document.getElementById('cmbFairType').value	==	4)
	{	
		if(document.getElementById('radioLabel_spot').checked == true)
		{
			 if(document.getElementById('cbo_item').value==0){
				alert("Please select an Item");
				document.getElementById('cbo_item').focus();
				return false;
				}
		}
			
	}
	else
	{
		if(document.getElementById('cbo_item').value==0){
			alert("Please select an Item");
			document.getElementById('cbo_item').focus();
			return false;
		}
	}
		
	
	/*if(trim(document.getElementById('txtParticipantNum').value)==''){
		alert("Please Enter no of Participants");
		document.getElementById('txtParticipantNum').focus();
		return false;
	}*/
	
	
}


function fnschgpwdAddrr()
{
 if(document.getElementById('txtSchoolCode').value=="")
 {
	alert("Please Enter a valid School code");
	return false;
 }
 
 if(document.getElementById('cmbFairType').value==0)
 {
	alert("Please Select a Fair");
	return false;
 }
 
 
 
}


function fetch_higherlevel_participant(festid)
{
	
	//var festid	=	$('txtSchoolCode').value;	
	var fairid	=	document.getElementById('cmbFairType').value;
	//alert(fairid);
	if(fairid != 0){
	ajax_loder2('cmbitem');
		
	xmlHttp=GetXmlHttpObject();
	if (xmlHttp)
	{
		var url=path+"index.php/ajax/loadajax/fetch_higherlevel/"+festid+"/"+fairid;
		//alert(url);
		xmlHttp.onreadystatechange = function stateChanged() 
		{ 
			if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
			{ 
				arrResponse	=	xmlHttp.responseText;				
				document.getElementById('cmbitem').style.display='block';
				document.getElementById('cmbitem').innerHTML=xmlHttp.responseText;		
				
				
				if(document.getElementById('radioLabel_exhib').checked==true){
					document.getElementById('cbo_item').disabled = true;
					}
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

function funschoolwisepoint(){
		if(document.getElementById('cmbFairType').value==0){
			alert("Please Select a Fair");
			return false;
			}
}//funschoolwisepoint()

function fnctotalpoint()
{
	if(document.getElementById('cmbFairType1').value==0){
			alert("Please select a Fair");
			document.getElementById('cmbFairType1').focus();
			return false;
		}
}

function fncitemwisetotalpoint()
{
	if(document.getElementById('cmbFairType1').value==0){
			alert("Please select a Fair");
			document.getElementById('cmbFairType1').focus();
			return false;
		}
		//alert(document.getElementById('cmbCateType').value);
		
		if(document.getElementById('cmbCateType1').value==0){
			alert("Please select a Category");
			document.getElementById('cmbCateType1').focus();
			return false;
		}
		
		if(document.getElementById('cbo_item').disabled==false)
		{
			if(document.getElementById('cbo_item').value==0){
				alert("Please select a Item");
				document.getElementById('cbo_item').focus();
				return false;
			}
		}
		
	
}

function higher_schooldetails(schoolid)
{
	//alert('hiii');
	if(schoolid) {
   xmlHttp=GetXmlHttpObject();
	if (xmlHttp)
	{
		var url=path+"index.php/ajax/ajax2/fetch_school_from_festival/"+schoolid;
		//alert(url);
		xmlHttp.onreadystatechange = function stateChanged() 
		{ 
			if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
			{ 
				arrResponse	=	xmlHttp.responseText;				
				document.getElementById('school_name').style.display='block';
				document.getElementById('school_name').innerHTML=xmlHttp.responseText;				
			} 
		}
					
		xmlHttp.open("POST",url,true);
		xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlHttp.send();
		//xmlHttp.send(parameters);
	}		
	}
	/*else{
			alert("Please Enter school code");
			document.getElementById('txtSchoolCode').focus();
			return false;
	}*/
	
}

function checkvalsubmit()
{
	if(document.getElementById('cmbFairType').value==0){
		alert("Please select fair");
		document.getElementById('cmbFairType').focus();
		return false;
		}
	if(document.getElementById('cmbFestType').value==0){
		alert("Please select festival");
		document.getElementById('cmbFestType').focus();
		return false;
		}
		if(document.getElementById('cbo_item').value==0){
		alert("Please select an item from list");
		document.getElementById('cbo_item').focus();
		return false;
		}
	
}

function checkschoolval()
{
		//alert(document.getElementById('cmbFairType1').value);
		if(document.getElementById('cmbFairType1').value==0){
			alert("Please select a Fair");
			document.getElementById('cmbFairType1').focus();
			return false;
		}
		//alert(document.getElementById('chkviewall').checked);
		
		if(document.getElementById('chkviewall').checked == false){
			if(document.getElementById('txtSchoolCode').value==''){
				alert("Please Enter school code");				
				document.getElementById('txtSchoolCode').focus();
				return false;
			}
		}
			
}

function fncviewallschools()
{	
	if(document.getElementById('chkviewall').checked == true){
			
		document.getElementById('txtSchoolCode').disabled=true;
		document.getElementById('txtSchoolCode').value='';
		document.getElementById('school_name').style.display='none';
	}
	else{
		document.getElementById('txtSchoolCode').disabled=false;	
	}
	
}


function check_for_workexpo(val)
{	//alert('kkkkkkkkkkk');
	document.getElementById('cmbCateType').value=0;
	//document.getElementById('cmbitem').innerHTML='<select  class="input_box"  name="cbo_item" id="cbo_item" ><option vlaue="0">Select</option></select>';
	
	if(val == 4){ 
	  document.getElementById('work').style.display='block'; 
	}
	else{ 
		 document.getElementById('radioLabel_spot').checked = true;
		 document.getElementById('cmbCateType').disabled=false;
		 document.getElementById('work').style.display='none'; 
	 }	
}

function check_for_workexpo3(val,id)
{	
	
	//alert("kooooooooooooooooo"+work);
	if(id	==	2) { work = 'work2';
	document.getElementById('cmbCateType').value=0; }
	else { work = 'work3';
	document.getElementById('cmbCateType').value=0; }
	
	//document.getElementById('cmbCateType').value=0;
	//document.getElementById('cbo_item').value='';
	
	if(val == 4)
	{ 	 
	 document.getElementById(work).style.display='block';  }
	else
	{ 
	 document.getElementById('radioLabel_spot').checked = true;
	 document.getElementById('cmbCateType').disabled=false;	 
	 document.getElementById(work).style.display='none'; 
	 document.getElementById('cbo_item').disabled=false; }	
}

function selectCat(val)
{	//alert("hiii");
	if(val == 'spot')
	{  
	   document.getElementById('cbo_item').value=0;
	   document.getElementById('cbo_item').disabled=false; 
	}
	else {
		//alert("in");  
	 document.getElementById('cbo_item').value=0;
	 document.getElementById('cbo_item').disabled=true;  
	 fetch_item_from_participant(0);
	 
	 }		
}


function selectCat2(val,formid)
{
	var form_name	=	formid.name;
	if(val == 'spot')
	{  
	   document.getElementById(form_name).cmbCateType.disabled=false;
	   document.getElementById(form_name).cbo_item.disabled=false; }
	else {  
	
	// document.getElementById(form_name).cmbCateType.value=0;
	document.getElementById(form_name).cmbCateType.disabled=false;
	//alert("one");
	document.getElementById(form_name).cbo_item.value=0;
	document.getElementById(form_name).cbo_item.disabled=true; 
	//alert("two");
	 //fetch_item_from_participant(0);
	 //alert(form_name);
	 	if((form_name!='formPWD') && (form_name!='team_manager') && (form_name!='callsheet_all') && (form_name!='formSF') && (form_name!='formIWP') && (form_name!='formAP')  && (form_name!='formscore') )
		{
				var cateid=0;
				var fairid	=	document.getElementById('cmbFairType').value;
				if(fairid==4){
				ajax_loder2('cmbitem');
				
				xmlHttp=GetXmlHttpObject();
				if (xmlHttp)
					{
						var url=path+"index.php/ajax/loadajax/fetch_team_item_from_festival/"+cateid+'/'+fairid;
						xmlHttp.onreadystatechange = function stateChanged() 
						{ 
						if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
						{ 
						arrResponse	=	xmlHttp.responseText;
						
						document.getElementById('cmbitem').style.display='block';
						document.getElementById('cmbitems').innerHTML=xmlHttp.responseText;
						
						} 
						}
						
						xmlHttp.open("POST",url,true);
						xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
						xmlHttp.send();
						}
				}
		}
	 }		
}

/********* for result view***********/

function check_workexpo_4result(val){
		//document.getElementById('cmbFestType').disabled=false; 
		
		if(val == 4){
		  document.getElementById('work').style.display='block'; 
		}
		else{ 
			 document.getElementById('work').style.display='none'; 
		 }	
}



function printContent(element_id)
{
	var DocumentContainer = document.getElementById(element_id);
	var WindowObject = window.open('', "TrackHistoryData", 
						  "width='100%',height='100%',top=10,left=10,toolbars=no,scrollbars=yes,status=no,resizable=no");
	WindowObject.document.writeln(DocumentContainer.innerHTML);
	WindowObject.document.close();
	WindowObject.focus();
	WindowObject.print();
	WindowObject.close();
}

function checkIR()
{

	if(document.getElementById('cmbFairType').value==0 || document.getElementById('cmbFairType').value==''){
		alert("Please select a Fair");
		document.getElementById('cmbFairType').focus();
		return false;
	}
	var cmbFest=document.getElementById('cmbCateType').value;
	if(cmbFest==0)
	{
		if(document.getElementById('radioLabel_exhib').checked==false)
		{
		alert('Select a Category');
		return false;
		}
	}
	var cmbItem=document.getElementById('cbo_item').value;
	if(cmbItem==0)
	{
		if(document.getElementById('radioLabel_exhib').checked==false)
		{
		alert('Select an Item');
		return false;
		}
	}
	else
	return true;
	
}