<style type="text/css">
<!--
.style1 {
	font-size: 14px;
	font-weight: bold;
	color: #660033;
}
.style2{
	font-size: 12px;
	font-weight: bold;
	color:black
}
.style3{
	font-size: 10px;
	font-weight: bold;
	color:#000000;
}
.style4{
	font-size: 8px;
	font-weight: bold;
	color:#000000;
}
.ety{
	font-size: 12px;
	color:#000000;
	}
-->
</style>
<page backtop="30mm" backbottom="20mm ">
		<page_header>
    	<?php
			$this->load->view('report/report_header');
		?>
        <table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" >
        	 <tr>
                <td align="center" class="style1"><?php  echo $fair_name;if($fair_name=='Work Experience Fair'){ if($this->input->post('radioLabel')=='exhib'){ echo '(Exhibition)';} else if($this->input->post('radioLabel')=='spot'){ echo ' (On the Spot)';}} ?></td>
            </tr>
            <tr>
                <td align="center" class="style1">List of Participating Schools with School Code</td>
            </tr>
           
            <tr>
                <td align="center" valign="bottom" class="style2"><?php if($category_name!='Exhibition'){ ?>Category:&nbsp;<?php echo $category_name; }?></td>
            </tr>
        </table>
	</page_header>
<page_footer>
	<?php
		$this->load->view('report/report_footer');
	?>
</page_footer>       

			

	    <table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
          <tr >
            <th width="79" height="30" align="center" class="style2">Sl.No</th>
            <th width="120" align="center" class="style2">School code</th>
            <th width="326" colspan="10" align="left" class="style2">School Name</th>
          </tr>
          <?php
			$count=1;
			foreach($school_fest as $row){
                ?>
          <tr>
            <td align="center" class="ety"  ><?php echo $count;?></td>
            <td align="center" class="ety" ><?php echo $row['school_code']; ?></td>
            <td align="left" class="ety"><?php echo $row['school_name']; ?></td>
          </tr>
          <?php
          $count++;  }
        ?>
        </table>
    
 </page>
	
    
    