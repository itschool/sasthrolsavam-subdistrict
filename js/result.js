// JavaScript Document

function ltrim(str) { for(var k = 0; k < str.length && isWhitespace(str.charAt(k)); k++); return str.substring(k, str.length);}
function rtrim(str) { for(var j=str.length-1; j>=0 && isWhitespace(str.charAt(j)) ; j--) ; return str.substring(0,j+1);}
function trim(str) {return ltrim(rtrim(str));}
function isAlphaNumeric(val){if (val.match(/^[a-zA-Z0-9]+$/)){ return true;}else{return false;} }
function isWhitespace(charToCheck) { var whitespaceChars = " \t\n\r\f"; return (whitespaceChars.indexOf(charToCheck) != -1);}
var delete_msg = 'Do you really want to delete?';


function fetch_items_for_result_entry(festid)
{
	//alert('hiii');
	
	var fairid	=	document.getElementById('cmbFairType').value;
	//alert(fairid);
	if(fairid != 0){
	ajax_loder2('cmbitem');
		
	xmlHttp=GetXmlHttpObject();
	if (xmlHttp)
	{
		var url=path+"index.php/ajax/loadajax/fetch_items_for_result_entry/"+festid+"/"+fairid;
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
	}	
}

function fetch_item_details_result()
{	//alert("opop");
	var fairid	=	document.getElementById('cmbFairType').value;
	var festid	=	document.getElementById('cmbFestType').value;
	//alert(document.getElementById('txtItemCode').value);
	if(document.getElementById('txtItemCode').value.length >= 3)
	{
		//alert("iouoi");
		var item_code	=	document.getElementById('txtItemCode').value;
	
	xmlHttp=GetXmlHttpObject();
	if (xmlHttp)
	{
		var url=path+"index.php/result/resultentry/get_item_details_result/"+item_code;
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


function fncSaveResultEntry()
{
	//alert("kii");
	if (trim(document.getElementById('txt_reg_no').value) == '')
	{
		alert('Please enter the register number');
		document.getElementById('txt_reg_no').focus();
		return;
	}
	
	if (trim(document.getElementById('txt_code_no').value) == '')
	{
		alert('Please enter the code');
		document.getElementById('txt_code_no').focus();
		return;
	}
	var mark_id	=	'';
	var total_marks	=	0;
	for(var i = 1; i <= document.getElementById('hidNoJudge').value; i++) {
		mark_id	=	'mark_'+i;
		if (trim(document.getElementById(mark_id).value) == '')
		{
			alert('Please enter the mark '+i);
			document.getElementById(mark_id).focus();
			return;
		}
		if (trim(document.getElementById(mark_id).value)*1 > 100)
		{
			alert('Please enter valid mark '+i);
			document.getElementById(mark_id).focus();
			return;
		}
		
		total_marks	+=	document.getElementById(mark_id).value*1;
	}
	if (trim(document.getElementById('totalMark').value) == '')
	{
		alert('Please enter the total marks');
		document.getElementById('totalMark').focus();
		return;
	}
	
	if (total_marks != document.getElementById('totalMark').value)
	{
		alert('Please check the total marks entered');
		document.getElementById('totalMark').focus();
		return;
	}
	
	document.getElementById('resultEntry').action =	path+'index.php/result/resultentry/save_result_entry/';
	document.getElementById('resultEntry').submit();
}



function fncSaveBulkResultEntry()
{
	//alert("kiirr");
	var parti_tot	=	document.getElementById('hidPartitot').value;
	var fair_id		=	document.getElementById('cmbFairType').value;
	var high	=	new Array();
	
	//alert("kiirr"+parti_tot);
	if(parti_tot > 2)
	{  $lim = 3; }else{ $lim = parti_tot; }
		
		
	for(var i=1;i<=parti_tot;i++)
	{		
		var total_id	=	"totalMark_"+i;
		//alert("totalMark_"+i);
		var total_val	=	document.getElementById(total_id).value;	
		var judge_cnt	=	document.getElementById('hidNoJudge').value;			
		var actual_tot	=	0;
		var tot_flag	=	0;
		for(j=1;j<=judge_cnt;j++)
		{
			var null_flag	=	0;
			var mark_id		=	"mark_"+j+"_"+i;
			//alert("mark_"+j+"_"+i);
			var mark_val	=	document.getElementById(mark_id).value;	
			
			if(mark_val == ''){
				null_flag	=	1;
				null_id		=	mark_id;
			}
			
			
			if(null_flag	==	1)
			{
				alert("Dont leave the textbox blank");
				document.getElementById(null_id).focus();	
				return false;		
			}	
			actual_tot	+=	parseInt(mark_val);
		
		}
		
		if(total_val == '' || total_val ==0){
			null_flag	=	1;
			null_id		=	total_id;
		}
		
		if(total_val != actual_tot)
		{ var tot_flag	=  2; 	
		  null_id	=	total_id;
		}
		
		if(tot_flag	==	2)
		{
			alert("Please Enter the correct Total");
			document.getElementById(null_id).focus();	
			return false;		
		}		
		high[i]	=	total_val;	
	}
	
	 high.sort(compare);
	 
	 var comp	=	0;	
	//if(fair_id != 4){
		for(var i=0;i<$lim;i++)
		{
			//alert(high[i]);
			
			if(high[i] == 0)
			 continue;
			if(high[i] != comp)
			comp	=		high[i];
			else
			{		
				alert('Total '+ high[i]+' is repeating');
				return false;			
			}
		}
	//}
	
	document.getElementById('resultEntryBulkList').action =	path+'index.php/result/resultentry/save_bulk_result_entry/';
	document.getElementById('resultEntryBulkList').submit();
		
}

function fnchk_absnt(jdg,cnt){
	
	//alert(jdg+"<---->"+cnt);
	var chk_id	=	'chk_absent'+cnt;
	//alert(chk_id);
	if(document.getElementById(chk_id).checked == true)
	{
		for(k=1;k<=jdg;k++)
		{
			var mark_id	=	'mark_'+k+'_'+cnt;
			var tot_id	=	'totalMark_'+cnt;
			document.getElementById(mark_id).value	=	0;
			document.getElementById(tot_id).value	=	0;			
		}		
	}	
}


function fnc_ifabsnt(cnt,val)
{
	//alert(cnt);
	//alert(val);
	var chk_id	=	'chk_absent'+cnt;	
	if(val == 0){	
		document.getElementById(chk_id).checked	=	true;
	} else{
		document.getElementById(chk_id).checked	=	false;
	}
	
}

function compare(a,b)
{
	return b-a;
	
}


function editResult (id) {
	document.getElementById('hidResultId').value	=	id;
	document.getElementById('resultEntryList').action	=	path+'index.php/result/resultentry/edit_result_entry/';
	document.getElementById('resultEntryList').submit();
}


function editBulkResutlEntry() {
	
	document.getElementById('hidedit').value	=	1;
	itcode	=	document.getElementById('hidItemId').value;
	document.getElementById('resultEntryBulkList').action	=	path+'index.php/result/resultentry/bulk_result_entry/hu/'+itcode;
	document.getElementById('resultEntryBulkList').submit();
}

function deleteBulkResult (id) {
	if(!confirm('Do you want to delete result ? ')){
		return;	
	}
	document.getElementById('hidResultId').value	=	id;
	document.getElementById('resultEntryBulkList').action	=	path+'index.php/result/resultentry/delete_bulk_result_entry/';
	document.getElementById('resultEntryBulkList').submit();	
}

function deleteResult (id) {
	if(!confirm('Do you want to delete result ? ')){
		return;	
	}
	document.getElementById('hidResultId').value	=	id;
	document.getElementById('resultEntryList').action	=	path+'index.php/result/resultentry/delete_result_entry/';
	document.getElementById('resultEntryList').submit();	
}

function confirmBulkResutlEntry ()
{
	//alert('kiiii');
	if(confirm('Do you really want to confirm the results?'))
	{
		//alert(path+'index.php/result/resultentry/confirm_result_entry');
		document.getElementById('resultEntryBulkList').action	=	path+'index.php/result/resultentry/confirm_bulk_result_entry';
		document.getElementById('resultEntryBulkList').submit();
	}
}

function confirmResutlEntry ()
{
	//alert('kiiii');
	if(confirm('Do you really want to confirm the results?'))
	{
		//alert(path+'index.php/result/resultentry/confirm_result_entry');
		document.getElementById('resultEntryList').action	=	path+'index.php/result/resultentry/confirm_result_entry';
		document.getElementById('resultEntryList').submit();
	}
}

function resetResultConfirmation (itemcode, message, element_id)
{
	//alert('---'+itemcode+'----'+message+'----'+element_id);
	message = 'Do you really want to reset the Result confirmation status of '+message;
	if (confirm(message))
	{
		ajax_loder2(element_id);
		xmlHttp=GetXmlHttpObject();
	if (xmlHttp)
	{
		var url=path+"index.php/ajax/loadajax/reset_result_confirmation_status/"+itemcode;
		//alert(url);
		xmlHttp.onreadystatechange = function stateChanged() 
		{ 
			if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
			{ 
				arrResponse	=	xmlHttp.responseText;
							
				document.getElementById(element_id).innerHTML = '';
			    document.getElementById(element_id+'_dis').innerHTML = xmlHttp.responseText;
				
			} 
		}
					
		xmlHttp.open("POST",url,true);
		xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlHttp.send();
		//xmlHttp.send(parameters);
	  }
	}	
	
}

function resetResultConfirmation_exb (fest, message, element_id)
{
	//alert('---'+fest+'----'+message+'----'+element_id);
	message = 'Do you really want to reset the Result confirmation status of '+message;
	if (confirm(message))
	{
		ajax_loder2(element_id);
		xmlHttp=GetXmlHttpObject();
	if (xmlHttp)
	{
		var url=path+"index.php/ajax/loadajax/reset_result_confirmation_status_exb/"+fest;
		//alert(url);
		xmlHttp.onreadystatechange = function stateChanged() 
		{ 
			if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
			{ 
				arrResponse	=	xmlHttp.responseText;
							
				document.getElementById(element_id).innerHTML = '';
			    document.getElementById(element_id+'_dis').innerHTML = xmlHttp.responseText;
				
			} 
		}
					
		xmlHttp.open("POST",url,true);
		xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlHttp.send();
		//xmlHttp.send(parameters);
	  }
	}	
	
}


function resultprintout(itm)
{
	document.getElementById('hiditemcode').value = itm;
	//alert($('hiditemcode').value);
	document.getElementById('resreport').action=path+"index.php/report/timefestreportpdf/confidential";
	document.getElementById('resreport').submit();
}
function resultallprint()
{
	document.getElementById('hiditemcode').value='ALL';
	document.getElementById('resreport').action=path+"index.php/report/timefestreportpdf/confidential";
	document.getElementById('resreport').submit();
}

function getItemResult(itemcode)
{
	document.getElementById('hidItemId').value = itemcode;
	document.getElementById('formIWPq').action = path+'index.php/result/resultentry/bulk_result_entry';
	document.getElementById('formIWPq').submit();
}

function chuu(pu)
{
	alert("koo");	
	
}

function check_for_workexpo_result(val)
{	
	//alert('kkkkkkkkkkk'+document.getElementById('cmbFestType').value);
	//document.getElementById('cmbFestType').value=0;
	//document.getElementById('cmbFestType').value='';
	
	if(val == 4){ 
	  document.getElementById('work').style.display='block'; 
	}
	else{ 
		//document.getElementById('worktype').value='';
		 document.getElementById('radioLabel_spot').checked = true;
		 document.getElementById('cmbFestType').disabled=false;
		 document.getElementById('work').style.display='none'; 
	 }	
}

function check_for_workexpo(val)
{		
	//alert(val);
	if(val == 4){ 
	  document.getElementById('work').style.display='block'; 
	}
	else{ 
		document.getElementById('work').style.display='none'; 
		 document.getElementById('radioLabel_spot').checked = true;
		 document.getElementById('cmbFestType').disabled=false;
		 
	 }	
}

/****for item result list **********/
function selectCat(val)
{
	//alert("hiii");
	if(val == 'spot')
	{  
		document.getElementById('cmbFestType').disabled=false; 
	    document.getElementById('txtItemCode').value='';
	}
	else {  
	 
	 document.getElementById('cmbFestType').value=0;
	 document.getElementById('cmbFestType').value='';
	 document.getElementById('cmbFestType').disabled=true;
	// fetch_items_for_result_entry(0);	 
	 }		
}

function selectCat_itemwise(val)
{
	//alert(document.getElementById('radioLabel_spot').checked);
	
	if(val == 'spot')
	{  
		document.getElementById('cbo_item').value='';
		document.getElementById('cbo_item').disabled=false;
	    
	}
	else {  
	 
	 document.getElementById('cbo_item').value='';
	 document.getElementById('cbo_item').value=0;
	 document.getElementById('cbo_item').disabled=true;
	 //fetch_items_for_result_entry(0);	 
	 }		
}

function selectCat4bulkentry(val)
{
	
	if(val == 'spot')
	{  
		document.getElementById('worktype').value='spot';
		document.getElementById('cmbFestType').value = 0;
		document.getElementById('cbo_item1').disabled=false;
		
	   document.getElementById('cbo_item1').value=0;
	   
	}
	else {  
	 	document.getElementById('worktype').value='exib';
		
	   document.getElementById('cmbFestType').value = 0;
		document.getElementById('cbo_item1').value=0;
	 //alert("2---"+document.getElementById('cbo_item').value);
	 document.getElementById('cbo_item1').disabled=true;
	 
	 //fetch_items_for_bulk_result_entry(0);
	
	 
	 }		
}

function fetch_bulk_item_details_result(item_code)
{	
	//alert("dfg");
	
	var fairid	=	document.getElementById('cmbFairType').value;
	var festid	=	document.getElementById('cmbFestType').value;
	//var item_code	=	document.getElementById('cbo_item').value;
	//alert('---'+document.getElementById('cbo_item1').value);
	if(item_code.length >= 3)
	{
			//alert(item_code);
	xmlHttp=GetXmlHttpObject();
	if (xmlHttp)
	{
		var url=path+"index.php/result/resultentry/get_item_details_bulk_result/"+item_code;
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


function fetch_exibbulk_item_details_result(fairid,festid)
{	
	//alert("dfg"+festid);
	
	xmlHttp=GetXmlHttpObject();
	if (xmlHttp)
	{
		var url=path+"index.php/result/resultentry/get_exib_details_bulk_result/"+festid;
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

function fetch_items_for_bulk_result_entry(festid)
{
	//alert('hiii');
	var worktype	=	'nil';
	var fairid	=	document.getElementById('cmbFairType').value;
	
	if(fairid	==	4)
	{ 	worktype	=	document.getElementById('worktype').value; 
		//fetch_bulk_item_details_result();
	}
	//alert(fairid+"----"+worktype);
	if(fairid != 0 && worktype != 'exib'){
	ajax_loder2('cmbitem');
		
	xmlHttp=GetXmlHttpObject();
	if (xmlHttp)
	{
		var url=path+"index.php/ajax/loadajax/fetch_items_for_bulk_result_entry/"+festid+"/"+fairid;
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
	else if(fairid == 0)
	{
		alert("select Fair");
		return false;		
	}	
	else if(worktype == 'exib')
	{
		fetch_exibbulk_item_details_result(fairid,festid);
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