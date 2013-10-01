function fncUpdateSciencefair($sciencefair_type, id)
{
	if ($sciencefair_type == 'state')
	{
		if(!trim($('txtSciencefairName').value))
		{
			alert("Please Enter a Sciencefair Name");
			document.getElementById('txtSciencefairName').value = ''
			document.getElementById('txtSciencefairName').focus();
			return false;
		}
		if(!trim($('txtSciencefairYear').value))
		{
			alert("Please Enter Sciencefair Year");
			document.getElementById('txtSciencefairYear').value = ''
			document.getElementById('txtSciencefairYear').focus();
			return false;
		}
	}
	if(!document.getElementById('txtSciencefairVenue').value)
		{
			alert("Please Enter a Venu");
			document.getElementById('txtSciencefairVenue').value = ''
			document.getElementById('txtSciencefairVenue').focus();
			return false;
	}
	document.getElementById('formSciencefair').action = path+'index.php/admin/sciencefair/update_sciencefair';
	document.getElementById('formSciencefair').submit();
	return true;
}
function fncEditSciencefair(id)
{
	document.getElementById('sel_sciencefair_id').value = id;
	document.getElementById('list_formSciencefair').action = path+'index.php/admin/sciencefair/edit_sciencefair';
	document.getElementById('list_formSciencefair').submit();
}
function fncCancelSciencefair()
{
	window.open(path+'index.php/admin/sciencefair', '_parent');
}
function fncSaveSciencefair()
{
	//alert(document.getElementById('txtSciencefairName').value);
	if(!(document.getElementById('txtSciencefairName').value))
	{
		alert("Please Enter a Sciencefair Name");
		document.getElementById('txtSciencefairName').value = ''
		document.getElementById('txtSciencefairName').focus();
		return false;
	}
	if(!(document.getElementById('txtSciencefairYear').value))
	{
		alert("Please Enter Sciencefair Year");
		document.getElementById('txtSciencefairYear').value = ''
		document.getElementById('txtSciencefairYear').focus();
		return false;
	}
	if(!document.getElementById('txtSciencefairVenue').value)
	{
		alert("Please Enter a Venu");
		document.getElementById('txtSciencefairVenue').value = ''
		document.getElementById('txtSciencefairVenue').focus();
		return false;
	}
	document.getElementById('formSciencefair').submit();
	return true;
}
function fncListSubDistrictDetails(id)
{
	$('sel_district_id').value = id;
	$('list_district').action = path+'index.php/welcome/sub_district_details';
	$('list_district').submit();
}
function fncListClustertDetails(id)
{
	$('sel_sub_district_id').value = id;
	$('list_district').action = path+'index.php/welcome/cluster_details';
	$('list_district').submit();
}
function fncSaveSciencefairCSV ()
{
	$('formSciencefair').submit();
}

function nonclusterschool(subdist)
{
	$('hidClusterId').value = subdist;
	$('clustschool').action = path+'index.php/welcome/nonclustdetails';
	$('clustschool').submit();

}
function fncExportSubDistrictData()
{
	$('confirm_sub_dist').action = path+'index.php/export/export_sub_district_data';
	$('confirm_sub_dist').submit();
}
function fncExportDistrictData()
{
	if(document.getElementById('cmbFairType').value != 0)
	{
		document.getElementById('export_dist_data').action 	= path+'index.php/export/export_district_data';
		document.getElementById('hidExport').value			= 'TRUE'; 
		document.getElementById('export_dist_data').submit();
	}
	else{
		alert('Select a Fair to Export');
		document.getElementById('cmbFairType').focus();
		return false;
		
	}
}

function nonclustschooldet(shid) {
	$('hidSchoolId').value = shid;
	$('noncluster').action = path+'index.php/schools/registration/';
	$('noncluster').submit();
}

function printContentt(element_id)
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


function uploadImage(file_name) {
	
		
		var imageid = document.getElementById("sciencefairLogo");
		var file 	= imageid.files[0];
		img_array 	= file_name.split('.'); 
			
			if((img_array[1] != 'jpg') && (img_array[1] != 'jpeg') && (img_array[1] != 'gif') &&  (img_array[1] != 'JPG') && (img_array[1] != 'JPEG') && (img_array[1] != 'GIF') )
			{
				alert('Invalid Image File Format.\nImage type should be in jpg,jpeg,gif format.\nPlease Upload Again.');
				return false;
			}
			else
			{
				
				if(file.fileSize > 102400)
				{
					document.getElementById("sciencefairLogo").value = ''; 
					alert("Image size should not be larger than 100 Kb");
				}
				else
				{
					var preview = document.getElementById("preview");
										
						preview.src = file.getAsDataURL();
						//document.getElementById("previewField").style.display='none';
						//document.getElementById("imageToUpload1").value = imageid.value; 
					
				}
			}
		
		
	
	}
	
	
	