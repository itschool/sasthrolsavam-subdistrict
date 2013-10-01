// JavaScript Document

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




function fnsAddGround()
{
	if(!document.getElementById('txtGroundName').value)
	{
		alert("Please Enter Venue name");
		document.getElementById('txtGroundName').focus();
		return false;
	}
	if(!document.getElementById('txtGroundDescription').value)
	{
		alert("Please Enter Venue Description");
		document.getElementById('txtGroundDescription').focus();
		return false;
	}
	return true;
}

function deleteGround(groundId) {
	if(!confirm('Really want to delete the user?')){
		return false;
	}
	$('hidGroundId').value = groundId;
	$('editGround').action = path+'index.php/ground/ground_details/delete_ground_detials';
	$('editGround').submit();
}

function editGround(groundId) {
	
	document.getElementById('hidGroundId').value = groundId;
	document.getElementById('editGround').action = path+'index.php/ground/ground_details/edit_ground_detials';
	document.getElementById('editGround').submit();
}

function fnsUpdateGround(groundId){
	
	document.getElementById('hidGdId').value = groundId;
	document.getElementById('formGround').action = path+'index.php/ground/ground_details/update_ground_detials';
	document.getElementById('formGround').submit();
}

function cancel()
{
	document.getElementById('formGround').action = path+'index.php/ground/ground_details/';
	document.getElementById('formGround').submit();
}

function display_fest_type(fairid)
{
	if(fairid==4){
		//document.getElementById('cmbFairType1').selectedIndex=0;
		document.getElementById('non_wrkexp').style.display='none';
		document.getElementById('wrkexp').style.display='block';
		
	}
	else{
		//document.getElementById('cmbFairType').selectedIndex=0;
		document.getElementById('non_wrkexp').style.display='block';
		document.getElementById('wrkexp').style.display='none';
		
	}
}

function display_wrkexp(fairid)
{
	//cmbWrkexpType
	if(fairid==4)document.getElementById('divWrkexp').style.display='block';
	else {document.getElementById('divWrkexp').style.display='none';document.getElementById('cmbFestType').disabled =false;}
	
	fetch_item_details();
	
}

function fetch_item_details()
{ 	

	var cmbFairType = document.getElementById('cmbFairType').value;
	var cmbFestType = document.getElementById('cmbFestType').value;
	
	//ajax_loder2('divSchoolCode');
		
	xmlHttp=GetXmlHttpObject();
	if (xmlHttp)
	{//alert(document.getElementById('cmbWrkexpType').value);
		
		var wrkexp_type = 0;
		if(cmbFairType==4){
			
			if(document.getElementById('cmbWrkexpType').value==2){document.getElementById('cmbWrkexpType').value = 2; wrkexp_type = 2; }
		}
		
		var url=path+"index.php/ground/allotment/get_item_details/"+cmbFairType+"/"+cmbFestType+"/"+wrkexp_type;
		//var url=path+"index.php/ground/allotment/get_item_details";
		
		xmlHttp.onreadystatechange = function stateChanged() 
		{ 
			if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
			{ 
				arrResponse	=	xmlHttp.responseText;
				
				document.getElementById('cmbFestType').disabled =false;
				/*if(cmbFairType==4){
						if(document.getElementById('cmbWrkexpType').value==2){
							document.getElementById('cmbFestType').disabled =true;
							document.getElementById('cmbFestType').value =0;
						
							}
						else {
							document.getElementById('cmbFestType').disabled =false;
							
							}
						}*/
						if(cmbFairType==4){
			
		
				document.getElementById('divWrkexp').style.display='block';		}
				document.getElementById('divItems').style.display='block';
				document.getElementById('divItems').innerHTML=xmlHttp.responseText;
				
			} 
		}
					
		xmlHttp.open("POST",url,true);
		xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlHttp.send();
		//xmlHttp.send(parameters);
	}


	
}

function fetch_participant_details()
{
	
	var cmbFairType = document.getElementById('cmbFairType').value;
	var cmbFestType = document.getElementById('cmbFestType').value;
	var cmbItemType = document.getElementById('cmbItemType').value;
	ajax_loder2('cmbItemType');
		
	xmlHttp=GetXmlHttpObject();
	if (xmlHttp)
	{
		var url=path+"index.php/ground/allotment/get_participant_details/"+cmbFairType+"/"+cmbFestType+"/"+cmbItemType;
			
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

function fncCheckAllotmentDeatils (update)
{
	
	if( document.getElementById('cmbGround').value == '0')
	{
		alert('Please select ground');
		document.getElementById('cmbGround').focus();
		return false;	
	}
	
	if( document.getElementById('txtDate').value == '')
	{
		alert('Please select date');
		document.getElementById('txtDate').focus();
		return false;	
	}
	
	if( document.getElementById('txtHour').value == '' || document.getElementById('txtHour').value == 'HH')
	{
		alert('Please enter hour');
		document.getElementById('txtHour').focus();
		return false;	
	}
	
	if( document.getElementById('txtMin').value == '' || document.getElementById('txtMin').value == 'MM')
	{
		alert('Please enter minute');
		document.getElementById('txtMin').focus();
		return false;	
	}	
	
	if( document.getElementById('cmbNoOfJudges').value == '0')
	{
		alert('Please select number of judges');
		document.getElementById('cmbNoOfJudges').focus();
		return false;	
	}
	if(update == 1){
		document.getElementById('formAllotment').action = path+'index.php/ground/allotment/update_allotment';
	}
	document.getElementById('formAllotment').submit();
}

function getitemgrounddet(itemcode)
{
	document.getElementById('txtItemCode').value = itemcode;
	
	document.getElementById('formIWPq').action = path+'index.php/ground/allotment';
	document.getElementById('formIWPq').submit();
}

function clickresultdeclered(festid)
{
	document.getElementById('hidfestId').value=festid;
	//alert(document.getElementById('hidfestId').value);
	//alert(path+'index.php/publishresult/resultindex/result_declared/');
	document.getElementById('festrep').action = path+'index.php/publishresult/resultindex/result_declared/';
	document.getElementById('festrep').submit();
}

function cickpointdeclared(festid)
{	
	document.getElementById('hidfestId').value=festid;
	document.getElementById('festrep').action = path+'index.php/publishresult/resultindex/schoolpoints';
	document.getElementById('festrep').submit();
}

function cickchampiondeclared(festid)
{	
	document.getElementById('hidfestId').value=festid;
	document.getElementById('festrep').action = path+'index.php/publishresult/resultindex/festwise_overallchampions';
	document.getElementById('festrep').submit();
}

function clickpointdetails(festid,fair,school)
{	
	//document.getElementById('hidfestId').value=festid;
	//alert('--->'+festid+'--->'+school+"---"+fair);
	//alert(path);
	var path	=	document.getElementById('baseurl').value;
	//alert(path+'index.php/publishresult/resultindex/schoolpoints_detailed/'+festid+'/'+fair+'/'+school);
	document.getElementById('schoolpoints').action = path+'index.php/publishresult/resultindex/schoolpoints_detailed/'+festid+'/'+fair+'/'+school;
	
	document.getElementById('schoolpoints').submit();
}


function clickallresults()
{
	document.getElementById('festrep').action = path+'index.php/publishresult/resultindex/allresults';
	document.getElementById('festrep').submit();	
}

function clickoverallchampions()
{
	document.getElementById('festrep').action = path+'index.php/publishresult/resultindex/overallchampions';
	document.getElementById('festrep').submit();	
}


function clickfest_stat()
{
	document.getElementById('festrep').action = path+'index.php/publishresult/resultindex/festval_status';
	document.getElementById('festrep').submit();	
}

function clicktoviewfestdet(festid)
{
	document.getElementById('hidfestid').value=festid;
	//alert($('hidfestid').value);
	document.getElementById('festdet').action = path+'index.php/publishresult/resultindex/festival_allitem';
	document.getElementById('festdet').submit();
}

function finisheditemdet(festid)
{
	document.getElementById('hidfestid').value=festid;
	//alert($('hidfestid').value);
	document.getElementById('festdet').action = path+'index.php/publishresult/resultindex/finished_item';
	document.getElementById('festdet').submit();
	
}

function remainderitemdet(festid)
{
	document.getElementById('hidfestid').value=festid;
	//alert($('hidfestid').value);
	document.getElementById('festdet').action = path+'index.php/publishresult/resultindex/incomplete_item';
	document.getElementById('festdet').submit();
}