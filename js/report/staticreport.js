// JavaScript Document

function ajax_loder(ele){ $(ele).innerHTML = '<img src="'+image_path+'ajax_loader.gif">'; }
function ajax_loder2(ele){ $(ele).innerHTML = '<img src="'+image_path+'ajax_loader2.gif">'; }


function fetch_item_from_festival(festid,val)
{
	if(val){
		var fairid	=	document.getElementById('cmbFairType1').value;
	}else {
		var fairid	=	document.getElementById('cmbFairType').value;
	}
	var flag = 1;
	//alert(fairid);
	if(val == 'formItemwise' && fairid == 4){
		
		if(document.getElementById('radioLabel_exhib2').checked == true){
			flag = 0;
			document.getElementById('cbo_item').value='';
	 		document.getElementById('cbo_item').disabled=true;
		}
	}
	if(fairid != 0 && flag == 1){
	//ajax_loder2('cmbitem');

	xmlHttp=GetXmlHttpObject();
	if (xmlHttp)
	{
		//alert("dsfsd");
		var url=path+"index.php/ajax/loadajax/fetch_item_from_festival/"+festid+"/"+fairid;
		//alert(path);
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
	if(fairid == 0)
	{
		alert("select Fair");
		return false;
		
	}
}
	
function notSelected()
{  // alert ("hai");

if(document.getElementById('cmbFairType').value==0 || document.getElementById('cmbFairType').value==''){
		alert("Please select a Fair");
		document.getElementById('cmbFairType').focus();
		return false;
	}
	var cmbFest=document.getElementById('cmbFestType').value;
	if(cmbFest==0)
	{
		alert('Select a Festival');
		return false;
	}
	else
	return true;
}	
	
function fnschgpwdAddrr()
{
	if($(txtSchoolCode.value)!='')
	{
		alert("Please Enter a valid School code");
		return false;	
	}
	
	 if(document.getElementById('cmbFairType').value=="")
 {
	alert("Please Select a Fair");
	return false;
 }
	
}
	
	
function check_for_workexpo(val)
{	
	//alert('kkkkkkkkkkk');
	document.getElementById('resultFest').value=0;
	
	if(val == 4){ 
	  document.getElementById('work').style.visibility='visible'; 
	}
	else{ 
		 document.getElementById('radioLabel_spot').checked = true;
		 document.getElementById('resultFest').disabled=false;
		 document.getElementById('work').style.visibility='hidden'; 
	 }	
}


function check_for_workexpofaironly(val)
{	
	
	if(val == 4){ 
	  document.getElementById('work').style.visibility='visible'; 
	}
	else{ 
		 document.getElementById('radioLabel_spot').checked = true;
		 document.getElementById('work').style.visibility='hidden'; 
	 }	
}

function selectCat(val)
{
alert("sdef");
	if(val == 'spot')
	{  document.getElementById('resultFest').disabled=false; 
	   document.getElementById('cbo_item').value='';
	}
	else {
		
	 document.getElementById('resultFest').value=0;
	 document.getElementById('resultFest').disabled=true;  
	 fetch_item_from_participant(0);
	 
	 }		
}

