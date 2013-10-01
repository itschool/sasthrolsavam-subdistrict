<html>
<head>
<title>Javascript Drag and Drop</title>
<meta name="revisit-after" content="7 days">
<style>
<!--
.dragme{position:relative;}
-->
</style>
<script language="JavaScript1.2">
<!--

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
  document.getElementById('displaydiv').innerHTML = 'Possition -> '+x+' : '+y;
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

//-->
</script>

</head>

<body leftmargin=0 topmargin=0 rightmargin=0>
<br><br>

<table border=1>

      <tr>
        <td><img src="<?php echo base_url();?>images/itschoo_logo.gif" class="dragme"></td>
        <td><img src="<?php echo base_url();?>images/user_delete.png" class="dragme"></td>
        <td><img src="<?php echo base_url();?>images/user_edit.png" class="dragme"></td>
      </tr>
     
      
</table>
     <label class="dragme">DRAG ME</label>
<div id="displaydiv">Possition : </div>
</body>
</html>