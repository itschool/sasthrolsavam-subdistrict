// JavaScript Document
var ie=document.all;
var nn6=document.getElementById&&!document.all;

var isdrag=false;
var x,y;
var dobj;

function movemouse(e)
{
  if (isdrag)
  {
    dobj.style.left = nn6 ? tx + e.clientX - x : tx + event.clientX - x;
    dobj.style.top  = nn6 ? ty + e.clientY - y : ty + event.clientY - y;
	
    return false;
  } 
}

function selectmouse(e) 
{
  var fobj       = nn6 ? e.target : event.srcElement;
  var topelement = nn6 ? "HTML" : "BODY";

  while (fobj.tagName != topelement && fobj.className != "dragme")
  {
    fobj = nn6 ? fobj.parentNode : fobj.parentElement;
  }

  if (fobj.className=="dragme")
  {
    isdrag = true;
    dobj = fobj;
    tx = parseInt(dobj.style.left+0);
    ty = parseInt(dobj.style.top+0);
    x = nn6 ? e.clientX : event.clientX;
    y = nn6 ? e.clientY : event.clientY;	
    document.onmousemove=movemouse;
    return false;
  }
}

document.onmousedown=selectmouse;
document.onmouseup=new Function("isdrag=false");

function loadInitials(){

	if(document.getElementById('radioOriantation_0').checked	==	true){
		var	oriant	=	'L';
		var leftDecrement	=	285;
		var topDecrement	=	210;
	}
	else if(document.getElementById('radioOriantation_1').checked	==	true){
		var	oriant	=	'P';
		var leftDecrement	=	260;
		var topDecrement	=	150;
	}
	if(document.getElementById('radioLabel_0').checked	==	true)
		var	labels	=	'Y';
	else if(document.getElementById('radioLabel_1').checked	==	true)
		var	labels	=	'N';

	if(labels	==	'Y'){
		if(jsArray[0] > 0){
			var Yname	=	document.getElementById('lblname1');
			Yname.style.left	=	parseInt(parseInt(jsArray[0])	+	parseInt(leftDecrement));
			Yname.style.top		=	parseInt(parseInt(jsArray[1])	+	parseInt(topDecrement));
		}
		if(jsArray[2] > 0){
			var Yitem			=	document.getElementById('lblitem1');
			Yitem.style.left	=	parseInt(parseInt(jsArray[2])	+	parseInt(leftDecrement));
			Yitem.style.top		=	parseInt(parseInt(jsArray[3])	+	parseInt(topDecrement));
		}
		if(jsArray[4] > 0){
			var Ycat			=	document.getElementById('lblcat1');
			Ycat.style.left		=	parseInt(parseInt(jsArray[4])	+	parseInt(leftDecrement));
			Ycat.style.top		=	parseInt(parseInt(jsArray[5])	+	parseInt(topDecrement));
		}
		if(jsArray[6] > 0){
			var Ygrade			=	document.getElementById('iblgrade1');
			Ygrade.style.left	=	parseInt(parseInt(jsArray[6])	+	parseInt(leftDecrement));
			Ygrade.style.top	=	parseInt(parseInt(jsArray[7])	+	parseInt(topDecrement));
		}
		if(jsArray[8] > 0){
			var Yclass			=	document.getElementById('lblclass1');
			Yclass.style.left	=	parseInt(parseInt(jsArray[8])	+	parseInt(leftDecrement));
			Yclass.style.top	=	parseInt(parseInt(jsArray[9])	+	parseInt(topDecrement));
		}
		if(jsArray[10] > 0){
			var Yschool			=	document.getElementById('lblschool1');
			Yschool.style.left	=	parseInt(parseInt(jsArray[10])	+	parseInt(leftDecrement));
			Yschool.style.top	=	parseInt(parseInt(jsArray[11])	+	parseInt(topDecrement));
		}
		if(jsArray[12] > 0){
			var Ysub			=	document.getElementById('lblsubdist1');
			Ysub.style.left		=	parseInt(parseInt(jsArray[12])	+	parseInt(leftDecrement));
			Ysub.style.top		=	parseInt(parseInt(jsArray[13])	+	parseInt(topDecrement));
		}
		if(jsArray[14] > 0){
			var Ydate			=	document.getElementById('ibldate1');
			Ydate.style.left	=	parseInt(parseInt(jsArray[14])	+	parseInt(leftDecrement));
			Ydate.style.top		=	parseInt(parseInt(jsArray[15])	+	parseInt(topDecrement));
		}
		if(jsArray[16] > 0){
			var Yplace			=	document.getElementById('lablplace1');
			Yplace.style.left	=	parseInt(parseInt(jsArray[16])	+	parseInt(leftDecrement));
			Yplace.style.top	=	parseInt(parseInt(jsArray[17])	+	parseInt(topDecrement));
		}
		if(jsArray[18] > 0){
			var Yehs			=	document.getElementById('lblefh1');
			Yehs.style.left		=	parseInt(parseInt(jsArray[18])	+	parseInt(leftDecrement));
			Yehs.style.top		=	parseInt(parseInt(jsArray[19])	+	parseInt(topDecrement));
		}
	}else if(labels	==	'N'){
		
		if(jsArray[0] > 0){
			var Yname	=	document.getElementById('lblname');
			Yname.style.left	=	parseInt(parseInt(jsArray[0])	+	parseInt(leftDecrement));
			Yname.style.top		=	parseInt(parseInt(jsArray[1])	+	parseInt(topDecrement));
			
		}
		if(jsArray[2] > 0){
			var Yitem			=	document.getElementById('lblitem');
			Yitem.style.left	=	parseInt(parseInt(jsArray[2])	+	parseInt(leftDecrement));
			Yitem.style.top		=	parseInt(parseInt(jsArray[3])	+	parseInt(topDecrement));
		}
		if(jsArray[4] > 0){
			var Ycat			=	document.getElementById('lblcat');
			Ycat.style.left		=	parseInt(parseInt(jsArray[4])	+	parseInt(leftDecrement));
			Ycat.style.top		=	parseInt(parseInt(jsArray[5])	+	parseInt(topDecrement));
		}
		if(jsArray[6] > 0){
			var Ygrade			=	document.getElementById('iblgrade');
			Ygrade.style.left	=	parseInt(parseInt(jsArray[6])	+	parseInt(leftDecrement));
			Ygrade.style.top	=	parseInt(parseInt(jsArray[7])	+	parseInt(topDecrement));
		}
		if(jsArray[8] > 0){
			var Yclass			=	document.getElementById('lblclass');
			Yclass.style.left	=	parseInt(parseInt(jsArray[8])	+	parseInt(leftDecrement));
			Yclass.style.top	=	parseInt(parseInt(jsArray[9])	+	parseInt(topDecrement));
		}
		if(jsArray[10] > 0){
			var Yschool			=	document.getElementById('lblschool');
			Yschool.style.left	=	parseInt(parseInt(jsArray[10])	+	parseInt(leftDecrement));
			Yschool.style.top	=	parseInt(parseInt(jsArray[11])	+	parseInt(topDecrement));
		}
		if(jsArray[12] > 0){
			var Ysub			=	document.getElementById('lblsubdist');
			Ysub.style.left		=	parseInt(parseInt(jsArray[12])	+	parseInt(leftDecrement));
			Ysub.style.top		=	parseInt(parseInt(jsArray[13])	+	parseInt(topDecrement));
		}
		if(jsArray[14] > 0){
			var Ydate			=	document.getElementById('ibldate');
			Ydate.style.left	=	parseInt(parseInt(jsArray[14])	+	parseInt(leftDecrement));
			Ydate.style.top		=	parseInt(parseInt(jsArray[15])	+	parseInt(topDecrement));
		}
		if(jsArray[16] > 0){
			var Yplace			=	document.getElementById('lablplace');
			Yplace.style.left	=	parseInt(parseInt(jsArray[16])	+	parseInt(leftDecrement));
			Yplace.style.top	=	parseInt(parseInt(jsArray[17])	+	parseInt(topDecrement));
		}
		if(jsArray[18] > 0){
			var Yehs			=	document.getElementById('lblefh');
			Yehs.style.left		=	parseInt(parseInt(jsArray[18])	+	parseInt(leftDecrement));
			Yehs.style.top		=	parseInt(parseInt(jsArray[19])	+	parseInt(topDecrement));
		}		
	}
	return true;				
}
function selectOriantation(obj){
	var theTable	=	document.getElementById('oriantationtable');
	if(obj	==	'L'){
		theTable.style.width 	= '679px';
		theTable.style.height 	= '475px';
	}
	if(obj	==	'P'){
		theTable.style.width 	= '475px';
		theTable.style.height 	= '679px';
	}
}
function selectItems(obj){
	var mydiv	=	document.getElementById('withoutlabel');
	if(obj	==	'N'){
		mydiv.style.display 	= 'block';
		document.getElementById('withlabel').style.display='none';
		/*document.getElementById('lblname1').style.display='none';
		document.getElementById('lblitem1').style.display='none';
		document.getElementById('lblcat1').style.display='none';
		document.getElementById('iblgrade1').style.display='none';
		document.getElementById('lblclass1').style.display='none';
		document.getElementById('lblschool1').style.display='none';
		document.getElementById('lblsubdist1').style.display='none';
		document.getElementById('ibldate1').style.display='none';
		document.getElementById('lablplace1').style.display='none';
		document.getElementById('lblefh1').style.display='none';*/
	}
	else if(obj	==	'Y'){
		mydiv.style.display 	= 'none';		
		document.getElementById('withlabel').style.display='block';
		/*document.getElementById('lblname1').style.display='block';
		document.getElementById('lblitem1').style.display='block';
		document.getElementById('lblcat1').style.display='block';
		document.getElementById('iblgrade1').style.display='block';
		document.getElementById('lblclass1').style.display='block';
		document.getElementById('lblschool1').style.display='block';
		document.getElementById('lblsubdist1').style.display='block';
		document.getElementById('ibldate1').style.display='block';
		document.getElementById('lablplace1').style.display='block';
		document.getElementById('lblefh1').style.display='block';*/
				
	}

}
function findPos() {
	var obj	=	document.getElementById('oriantationtable');
	var curleft = curtop = 0;
	if (obj.offsetParent) {
		curleft = obj.offsetLeft
		curtop = obj.offsetTop
		while (obj = obj.offsetParent) {
			curleft += obj.offsetLeft
			curtop += obj.offsetTop
		}
	}
	document.getElementById('displaydiv').innerHTML = 'Starting Possition -> '+curleft+' : '+curtop;
	var Yname	=	document.getElementById('lblname1');
	alert(Yname.offsetLeft);
	alert(Yname.offsetTop);
	/*Yname.style.left	=	jsArray[0];
	Yname.style.top		=	jsArray[1];
	alert(Yname.offsetLeft);
	alert(Yname.offsetTop);
	return true;*/
	//return [curleft,curtop];
}

function saveCertificateTemplate(){

	if(document.getElementById('radioOriantation_0').checked	==	true){
		var	oriant	=	'L';
		var leftDecrement	=	285;
		var topDecrement	=	210;
		document.getElementById('cboPageStyle').value	=	'L';
		
	}
	else if(document.getElementById('radioOriantation_1').checked	==	true){
		var	oriant	=	'P';
		var leftDecrement	=	260;
		var topDecrement	=	150;
		document.getElementById('cboPageStyle').value	=	'P';
	}
	if(document.getElementById('radioLabel_0').checked	==	true){
		var	labels	=	'Y';
		document.getElementById('cboLabelPrint').value	=	'Y';
	}
	else if(document.getElementById('radioLabel_1').checked	==	true){
		var	labels	=	'N';
		document.getElementById('cboLabelPrint').value	=	'N';
	}	

	if(labels	==	'Y'){
		
		var Yname	=	document.getElementById('lblname1');
		if(Yname.offsetLeft > 200 && Yname.offsetTop > 50){
		document.getElementById('txtNameX').value	=	(Yname.offsetLeft)	- parseInt(leftDecrement);
		document.getElementById('txtNameY').value	=	(Yname.offsetTop)	- parseInt(topDecrement);
		}
				
		var Yitem	=	document.getElementById('lblitem1');
		if(Yitem.offsetLeft > 200 && Yitem.offsetTop > 50){
		document.getElementById('txtItemX').value	=	(Yitem.offsetLeft)	- parseInt(leftDecrement);
		document.getElementById('txtItemY').value	=	(Yitem.offsetTop)	- parseInt(topDecrement);
		}
				
		var Ycat			=	document.getElementById('lblcat1');
		if(Ycat.offsetLeft > 200 && Ycat.offsetTop > 50){
		document.getElementById('txtCategoryX').value	=	(Ycat.offsetLeft)	- parseInt(leftDecrement);
		document.getElementById('txtCategoryY').value	=	(Ycat.offsetTop)	- parseInt(topDecrement);
		}
				
		var Ygrade			=	document.getElementById('iblgrade1');
		if(Ygrade.offsetLeft > 200 && Ygrade.offsetTop > 50){
		document.getElementById('txtGradeX').value	=	(Ygrade.offsetLeft)	- parseInt(leftDecrement);
		document.getElementById('txtGradeY').value	=	(Ygrade.offsetTop)	- parseInt(topDecrement);
		}
				
		var Yclass			=	document.getElementById('lblclass1');
		if(Yclass.offsetLeft > 200 && Yclass.offsetTop > 50){
		document.getElementById('txtClassX').value	=	(Yclass.offsetLeft)	- parseInt(leftDecrement);
		document.getElementById('txtClassY').value	=	(Yclass.offsetTop)	- parseInt(topDecrement);
		}
				
		var Yschool			=	document.getElementById('lblschool1');
		if(Yschool.offsetLeft > 200 && Yschool.offsetTop > 50){
		document.getElementById('txtSchoolX').value	=	(Yschool.offsetLeft)	- parseInt(leftDecrement);
		document.getElementById('txtSchoolY').value	=	(Yschool.offsetTop)	- parseInt(topDecrement);
		}
				
		var Ysub			=	document.getElementById('lblsubdist1');
		if(Ysub.offsetLeft > 200 && Ysub.offsetTop > 50){
		document.getElementById('txtSubdistrictX').value	=	(Ysub.offsetLeft)	- parseInt(leftDecrement);
		document.getElementById('txtSubdistrictY').value	=	(Ysub.offsetTop)	- parseInt(topDecrement);
		}
			
		var Ydate			=	document.getElementById('ibldate1');
		if(Ydate.offsetLeft > 200 && Ydate.offsetTop > 50){
		document.getElementById('txtDateX').value	=	(Ydate.offsetLeft)	- parseInt(leftDecrement);
		document.getElementById('txtDateY').value	=	(Ydate.offsetTop)	- parseInt(topDecrement);
		}
		
		var Yplace			=	document.getElementById('lablplace1');
		if(Yplace.offsetLeft > 200 && Yplace.offsetTop > 50){
		document.getElementById('txtPlaceX').value	=	(Yplace.offsetLeft)	- parseInt(leftDecrement);
		document.getElementById('txtPlaceY').value	=	(Yplace.offsetTop)	- parseInt(topDecrement);
		}
				
		var Yehs			=	document.getElementById('lblefh1');
		if(Yehs.offsetLeft > 200 && Yehs.offsetTop > 50){
		document.getElementById('txtehsX').value	=	(Yehs.offsetLeft)	- parseInt(leftDecrement);
		document.getElementById('txtehsY').value	=	(Yehs.offsetTop)	- parseInt(topDecrement);
		}

	}else if(labels	==	'N'){

		var Yname	=	document.getElementById('lblname');		
		if(Yname.offsetLeft > 200 && Yname.offsetTop > 50){
		document.getElementById('txtNameX').value	=	(Yname.offsetLeft)	- parseInt(leftDecrement);
		document.getElementById('txtNameY').value	=	(Yname.offsetTop)	- parseInt(topDecrement);
		}
				
		var Yitem	=	document.getElementById('lblitem');
		if(Yitem.offsetLeft > 200 && Yitem.offsetTop > 50){
		document.getElementById('txtItemX').value	=	(Yitem.offsetLeft)	- parseInt(leftDecrement);
		document.getElementById('txtItemY').value	=	(Yitem.offsetTop)	- parseInt(topDecrement);
		}
				
		var Ycat			=	document.getElementById('lblcat');
		if(Ycat.offsetLeft > 200 && Ycat.offsetTop > 50){
		document.getElementById('txtCategoryX').value	=	(Ycat.offsetLeft)	- parseInt(leftDecrement);
		document.getElementById('txtCategoryY').value	=	(Ycat.offsetTop)	- parseInt(topDecrement);
		}
				
		var Ygrade			=	document.getElementById('iblgrade');
		if(Ygrade.offsetLeft > 200 && Ygrade.offsetTop > 50){
		document.getElementById('txtGradeX').value	=	(Ygrade.offsetLeft)	- parseInt(leftDecrement);
		document.getElementById('txtGradeY').value	=	(Ygrade.offsetTop)	- parseInt(topDecrement);
		}
				
		var Yclass			=	document.getElementById('lblclass');
		if(Yclass.offsetLeft > 200 && Yclass.offsetTop > 50){
		document.getElementById('txtClassX').value	=	(Yclass.offsetLeft)	- parseInt(leftDecrement);
		document.getElementById('txtClassY').value	=	(Yclass.offsetTop)	- parseInt(topDecrement);
		}
				
		var Yschool			=	document.getElementById('lblschool');
		if(Yschool.offsetLeft > 200 && Yschool.offsetTop > 50){
		document.getElementById('txtSchoolX').value	=	(Yschool.offsetLeft)	- parseInt(leftDecrement);
		document.getElementById('txtSchoolY').value	=	(Yschool.offsetTop)	- parseInt(topDecrement);
		}
				
		var Ysub			=	document.getElementById('lblsubdist');
		if(Ysub.offsetLeft > 200 && Ysub.offsetTop > 50){
		document.getElementById('txtSubdistrictX').value	=	(Ysub.offsetLeft)	- parseInt(leftDecrement);
		document.getElementById('txtSubdistrictY').value	=	(Ysub.offsetTop)	- parseInt(topDecrement);
		}
			
		var Ydate			=	document.getElementById('ibldate');
		if(Ydate.offsetLeft > 200 && Ydate.offsetTop > 50){
		document.getElementById('txtDateX').value	=	(Ydate.offsetLeft)	- parseInt(leftDecrement);
		document.getElementById('txtDateY').value	=	(Ydate.offsetTop)	- parseInt(topDecrement);
		}
		
		var Yplace			=	document.getElementById('lablplace');
		if(Yplace.offsetLeft > 200 && Yplace.offsetTop > 50){
		document.getElementById('txtPlaceX').value	=	(Yplace.offsetLeft)	- parseInt(leftDecrement);
		document.getElementById('txtPlaceY').value	=	(Yplace.offsetTop)	- parseInt(topDecrement);
		}
				
		var Yehs			=	document.getElementById('lblefh');
		if(Yehs.offsetLeft > 200 && Yehs.offsetTop > 50){
		document.getElementById('txtehsX').value	=	(Yehs.offsetLeft)	- parseInt(leftDecrement);
		document.getElementById('txtehsY').value	=	(Yehs.offsetTop)	- parseInt(topDecrement);
		}			
		
	}else{
		alert('Some error occured while saving plase try again');	
		return false;
	}

	document.getElementById('formCertificatedrag').action = path+'index.php/certificate/certificate/save_certificate_template';
	document.getElementById('formCertificatedrag').submit();
}

