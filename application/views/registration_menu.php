<script>
// Javascript originally by Patrick Griffiths and Dan Webb.
// http://htmldog.com/articles/suckerfish/dropdowns/
sfHover = function() {
   var sfEls = document.getElementById("navbar").getElementsByTagName("li");
   for (var i=0; i<sfEls.length; i++) {
      sfEls[i].onmouseover=function() {
         this.className+=" hover";
      }
      sfEls[i].onmouseout=function() {
         this.className=this.className.replace(new RegExp(" hover\\b"), "");
      }
   }
}
if (window.attachEvent) window.attachEvent("onload", sfHover);
</script>    

     <!-- <ul id="navbar">-->
      <!-- The strange spacing herein prevents an IE6 whitespace bug. -->
        <!-- <li><a href="#">Science Fair</a>
         <ul>
            <li><a href="#">LP</a></li>
            <li><a href="#">UP</a></li>
            <li><a href="#">HS</a></li>
            <li><a href="#">HSS/VHSS</a></li>
          </ul>
         </li>
         <li><a href="#">Mathematics Fair</a>
         <ul>
            <li><a href="#">LP</a></li>
            <li><a href="#">UP</a></li>
            <li><a href="#">HS</a></li>
            <li><a href="#">HSS/VHSS</a></li>
          </ul>
         </li>
         <li><a href="#">Social Science Fair</a>
         <ul>
            <li><a href="#">LP</a></li>
            <li><a href="#">UP</a></li>
            <li><a href="#">HS</a></li>
            <li><a href="#">HSS/VHSS</a></li>
          </ul>
         </li>
         <li><a href="#">Work Experience Fair</a>
         <ul>
            <li><a href="#">LP</a></li>
            <li><a href="#">UP</a></li>
            <li><a href="#">HS</a></li>
            <li><a href="#">HSS/VHSS</a></li>
          </ul>
         </li>
         <li><a href="#">IT Mela Fair</a>
         <ul>
            <li><a href="#">LP</a></li>
            <li><a href="#">UP</a></li>
            <li><a href="#">HS</a></li>
            <li><a href="#">HSS/VHSS</a></li>
          </ul>
         </li>        
      </ul>-->
     
