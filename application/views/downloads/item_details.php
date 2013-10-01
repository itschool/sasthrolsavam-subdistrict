<page backtop="10mm" backbottom="20mm">

		<table style="width: 100%;">
			<tr>
				<!--<td style="text-align: left; width: 50%">
					<img src="<?php //echo image_url().'logo.jpg'?>">
				</td>-->
				<td style="width: 100%" align="center"><strong>Item Details<br>
				<? echo $fair_name[0]['fairName'];?></strong></td>
		  </tr>
            
			<tr>
				<td style="width: 100%"><hr/></td>
			</tr>
		</table>
        <page_footer>
<table style="width: 100%;">
			<tr>
				<td style="width: 100%"><hr/></td>
			</tr>
			<tr>
				<td style="text-align: center;width: 100%">page [[page_cu]]/{nb} </td>
			</tr>
		</table>
</page_footer> 
        
  <table width="600" border="0"  align="center" cellpadding="0" cellspacing="1" style="margin-top:15px;">
  
  
    <tr align="center">
        <td height="15" colspan="3" align="center" bgcolor="#FFFFFF"><strong>LP SECTION</strong><br />          </td>
    </tr>
                 
    <tr>
        <td height="15" bgcolor="#FFFFFF"  style="width:20%;border-right: solid 1px #000000; border-left: solid 1px #000000;padding:2px;border-top: solid 1px #000000;border-bottom: solid 1px #000000; padding:2px"><span class="style1"><strong>Slno</strong></span></td>
        <td height="15" bgcolor="#FFFFFF" style="width:20%;border-right: solid 1px #000000; padding:2px;border-top: solid 1px #000000;border-bottom: solid 1px #000000; padding:2px"><span class="style1"><strong>Item Code</strong></span></td>
        <td height="15" bgcolor="#FFFFFF" style="width:60%;border-right: solid 1px #000000; padding:2px;border-top: solid 1px #000000;border-bottom: solid 1px #000000; padding:2px"><span class="style1"><strong>Item Name</strong></span></td>
    
    </tr>
         
          <?php 
		  $i	=	0;
         foreach ($LP_item_details as $row1)
		 {		 	
			$i++;
			
			?>
              
            <tr>
                <td height="10" bgcolor="#FFFFFF"  style="width:20%;border-left: solid 1px #000000;border-right: solid 1px #000000; padding:2px;border-bottom: solid 1px #000000; padding:2px"><? echo $i; ?></td>
                <td height="15" bgcolor="#FFFFFF" style="width:20%;border-right: solid 1px #000000; padding:2px;border-bottom: solid 1px #000000; padding:2px"><? echo $row1['item_code']; ?></td>
                <td height="15" bgcolor="#FFFFFF" style="width:60%;border-right: solid 1px #000000; padding:2px;border-bottom: solid 1px #000000; padding:2px"><? echo $row1['item_name']; ?></td>
            
            </tr>
            
            
            <?
		 
		 
		 }


		?>
         
       </table>
       
       <table width="600" border="0"  align="center" cellpadding="0" cellspacing="1" style="margin-top:15px;">
  
  
   <tr align="center">
           <td height="15" colspan="3" align="center" bgcolor="#FFFFFF"><strong>UP SECTION</strong><br />          </td>
          </tr>
       
         <tr>
           <td height="15" bgcolor="#FFFFFF"  style="width:20%;border-right: solid 1px #000000; border-left: solid 1px #000000;padding:2px;border-top: solid 1px #000000;border-bottom: solid 1px #000000; padding:2px"><span class="style1"><strong>Slno</strong></span></td>
           <td height="15" bgcolor="#FFFFFF" style="width:20%;border-right: solid 1px #000000; padding:2px;border-top: solid 1px #000000;border-bottom: solid 1px #000000; padding:2px"><span class="style1"><strong>Item Code</strong></span></td>
           <td height="15" bgcolor="#FFFFFF" style="width:60%;border-right: solid 1px #000000; padding:2px;border-top: solid 1px #000000;border-bottom: solid 1px #000000; padding:2px"><span class="style1"><strong>Item Name</strong></span></td>
          
         </tr>
         
          <?php 
		  $i	=	0;
         foreach ($UP_item_details as $row1)
		 {		 	
			$i++;
			
			?>
              
            <tr>
                <td height="15" bgcolor="#FFFFFF"  style="width:20%;border-left: solid 1px #000000;border-right: solid 1px #000000; padding:2px;border-bottom: solid 1px #000000; padding:2px"><? echo $i; ?></td>
                <td height="15" bgcolor="#FFFFFF" style="width:20%;border-right: solid 1px #000000; padding:2px;border-bottom: solid 1px #000000; padding:2px"><? echo $row1['item_code']; ?></td>
                <td height="15" bgcolor="#FFFFFF" style="width:60%;border-right: solid 1px #000000; padding:2px;border-bottom: solid 1px #000000; padding:2px"><? echo $row1['item_name']; ?></td>
            
            </tr>
            
            
            <?
		 
		 
		 }


		?>
         
       </table>
       
       
       <table width="600" border="0"  align="center" cellpadding="0" cellspacing="1" style="margin-top:15px;">
  
  
   <tr align="center">
           <td height="15" colspan="3" align="center" bgcolor="#FFFFFF"><strong>HS SECTION</strong><br />          </td>
          </tr>
     
     
         <tr>
           <td height="15" bgcolor="#FFFFFF"  style="width:20%;border-right: solid 1px #000000; border-left: solid 1px #000000;padding:2px;border-top: solid 1px #000000;border-bottom: solid 1px #000000; padding:2px"><span class="style1"><strong>Slno</strong></span></td>
           <td height="15" bgcolor="#FFFFFF" style="width:20%;border-right: solid 1px #000000; padding:2px;border-top: solid 1px #000000;border-bottom: solid 1px #000000; padding:2px"><span class="style1"><strong>Item Code</strong></span></td>
           <td height="15" bgcolor="#FFFFFF" style="width:60%;border-right: solid 1px #000000; padding:2px;border-top: solid 1px #000000;border-bottom: solid 1px #000000; padding:2px"><span class="style1"><strong>Item Name</strong></span></td>
          
         </tr>
         
          <?php 
		  $i	=	0;
         foreach ($HS_item_details as $row1)
		 {		 	
			$i++;
			
			?>
              
            <tr>
                <td height="15" bgcolor="#FFFFFF"  style="width:20%;border-left: solid 1px #000000;border-right: solid 1px #000000; padding:2px;border-bottom: solid 1px #000000; padding:2px"><? echo $i; ?></td>
                <td height="15" bgcolor="#FFFFFF" style="width:20%;border-right: solid 1px #000000; padding:2px;border-bottom: solid 1px #000000; padding:2px"><? echo $row1['item_code']; ?></td>
                <td height="15" bgcolor="#FFFFFF" style="width:60%;border-right: solid 1px #000000; padding:2px;border-bottom: solid 1px #000000; padding:2px"><? echo $row1['item_name']; ?></td>
            
            </tr>
            
            
            <?
		 
		 
		 }


		?>
         
       </table>
       
       
       <table width="600" border="0"  align="center" cellpadding="0" cellspacing="1" style="margin-top:15px;">
  
  
   <tr align="center">
           <td height="15" colspan="3" align="center" bgcolor="#FFFFFF"><strong>HSS/VHSS SECTION</strong><br />          </td>
          </tr>
        
         <tr>
           <td height="15" bgcolor="#FFFFFF"  style="width:20%;border-right: solid 1px #000000; border-left: solid 1px #000000;padding:2px;border-top: solid 1px #000000;border-bottom: solid 1px #000000; padding:2px"><span class="style1"><strong>Slno</strong></span></td>
           <td height="15" bgcolor="#FFFFFF" style="width:20%;border-right: solid 1px #000000; padding:2px;border-top: solid 1px #000000;border-bottom: solid 1px #000000; padding:2px"><span class="style1"><strong>Item Code</strong></span></td>
           <td height="15" bgcolor="#FFFFFF" style="width:60%;border-right: solid 1px #000000; padding:2px;border-top: solid 1px #000000;border-bottom: solid 1px #000000; padding:2px"><span class="style1"><strong>Item Name</strong></span></td>
          
         </tr>
         
          <?php 
		  $i	=	0;
         foreach ($HSS_item_details as $row1)
		 {		 	
			$i++;
			
			?>
              
            <tr>
                <td height="15" bgcolor="#FFFFFF"  style="width:20%;border-left: solid 1px #000000;border-right: solid 1px #000000; padding:2px;border-bottom: solid 1px #000000; padding:2px"><? echo $i; ?></td>
                <td height="15" bgcolor="#FFFFFF" style="width:20%;border-right: solid 1px #000000; padding:2px;border-bottom: solid 1px #000000; padding:2px"><? echo $row1['item_code']; ?></td>
                <td height="15" bgcolor="#FFFFFF" style="width:60%;border-right: solid 1px #000000; padding:2px;border-bottom: solid 1px #000000; padding:2px"><? echo $row1['item_name']; ?></td>
            
            </tr>
            
            
            <?
		 
		 
		 }


		?>
         
       </table>
       
       
       
 
       
</page>