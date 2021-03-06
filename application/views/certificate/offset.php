<head>
    <script type="text/javascript">
        function GetOffset (object, offset) {
            if (!object)
                return;
            offset.x += object.offsetLeft;
            offset.y += object.offsetTop;

            GetOffset (object.offsetParent, offset);
        }

        function GetScrolled (object, scrolled) {
            if (!object)
                return;
            scrolled.x += object.scrollLeft;
            scrolled.y += object.scrollTop;

            if (object.tagName.toLowerCase () != "html") {
                GetScrolled (object.parentNode, scrolled);
            }
        }

        function GetTopLeft () {
            var div = document.getElementById ("myDiv");

            var offset = {x : 0, y : 0};
            GetOffset (div, offset);

            var scrolled = {x : 0, y : 0};
            GetScrolled (div.parentNode, scrolled);

            var posX = offset.x - scrolled.x;
            var posY = offset.y - scrolled.y;
            alert ("The top-left corner of the div relative to the top-left corner of the browser's client area: \n" 
                    + " horizontal: " + posX + "px\n vertical: " +  posY + "px");
        }
    </script>
</head>
<body>
<div style="height:200px; width:300px; overflow:auto;">
  <div id="myDiv" style="width:200px; border:1px solid red;"> You can get the top-left corner of this element 
    relative to the top left corner of the client area with the button below.<br />
    Use the scrollbars to test it for different positions. </div>
  <div style="width:1000px; height:1000px;"></div>
</div>
<br />
    <button onClick="GetTopLeft ();">Get the position of the element with red border!</button>
</body>