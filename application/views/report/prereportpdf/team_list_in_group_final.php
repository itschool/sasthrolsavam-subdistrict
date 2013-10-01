<style type="text/css">
<!--
.style1 {
	font-size: 14px;
	font-weight: bold;
	color: #660033;
}
.tb{
font-size: 11px;
	font-weight: bold;
	color:#000000;}
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
        <table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
            <tr>
                <td colspan="2" class="style1" align="center"><?php echo $fair_name;?><br />Participants in Group Items </td>
            </tr>
             <tr>
        <td class="tb" align="left">Item  :&nbsp;&nbsp;
        <?php 
		if($fair_name=='Work Experience Fair' && $_POST['radioLabel'] =='exhib')echo 'Exhibition';
		else {echo $partdata[0]['item_code'];?>&nbsp;-&nbsp;<?php echo $partdata[0]['item_name'];}?>&nbsp;&nbsp;</td>
        <td class="tb" align="left">&nbsp;&nbsp;Festival :<?php 
		if($fair_name=='Work Experience Fair' && $_POST['radioLabel'] =='exhib'){
		if(@$_POST['cmbCateType']==1)echo 'LP';
		else if(@$_POST['cmbCateType']==2)echo 'UP';
		else if(@$_POST['cmbCateType']==3)echo 'HS';
		else if(@$_POST['cmbCateType']==4)echo 'HSS/VHSS';
		}
		else echo @$partdata[0]['fest_name'];?></td>
  </tr>
        </table>
	</page_header>
<page_footer>
	<?php
		$this->load->view('report/report_footer');
	?>
</page_footer> 

        

    <?php
	$team_no=0;
    $count=0;
	$previous="";
	$pre_cap="";
	$j=0;
   
    foreach($partdata as $data)
    {	
		 
	  if($previous!=$data['school_code'])
 	  {
	  		 $pre_cap	=	$data['admn_no'];
			 $previous  =	$data['school_code'];
  			 $count		=	0;
			 if($j!=0)
			 {
			    print("</table><br />");			
			 }
            $team_no++;
		//$school	=	;?>
		<br />
         <table width="100%" border="0" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
            <tr>
            <td class="tb" align="left" >Team No : <strong><? echo $team_no; ?></strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;School  :&nbsp;&nbsp;
            <?php echo $data['school_code'];?>&nbsp;-&nbsp;<?php echo $data['school_name'];?>&nbsp;&nbsp;</td>
            
            </tr>
                    
        </table>
        
		<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0">
   
     
    <tr>
        <td class="tb" width='40' align="center" style="border-top:0px #000000; border-right:1px #000000; padding:2px;">Sl.No.</td>
        <td  class="tb" width='60' align="center" style="border-top:0px #000000; border-right:1px #000000; padding:2px;">Reg No.</td>
        <td class="tb" width='230' align="left" style="border-top:0px #000000; border-right:1px #000000; padding:2px;">&nbsp;&nbsp;Name </td>
        
      <td class="tb" width='30' align="center" style="border-top:0px #000000; border-right:1px #000000; padding:2px;"> <?php  if(@$partdata[0]['is_teach']!='Y'){ echo 'B/G';} else{ echo 'M/F';}?></td>
        <?php  if(@$partdata[0]['is_teach']!='Y'){ ?><td class="tb"  width='40' align="center" style="border-top:0px #000000; border-right:1px #000000; padding:2px;">Class</td><?php }?>
       
  </tr>	
	<?php
	}
		    
   	$count++;
	$j++;
	?>	
    
    <tr>
        <td class="ety"  align="center" style="border-top:1px #000000; border-right:1px #000000; padding:2px;"><?php echo $count;?></td>
        <td  class="ety"  align="left" style="border-top:1px #000000; border-right:1px #000000; padding:2px;">&nbsp;&nbsp;<?php echo $data['participant_id'];?> <span style="color:#FF0000;"><?php if($data['spo_id'] > 0) echo "*";?></span></td>
        <td class="ety"  align="left" style="border-top:1px #000000; border-right:1px #000000; padding:2px;">&nbsp;&nbsp;<?php echo wordwrap($data['participant_name'],34,'<br>'); if($data['is_captain'] == 'Y'){ echo " (Captain)";}?></td>
      <td class="ety"  align="center" style="border-top:1px #000000; border-right:1px #000000; padding:2px;"><?php if(@$partdata[0]['is_teach']!='Y'){ echo $data['gender']; } else{ if($data['gender']=='G'){ echo '<br />
F';} else{ echo 'M';}}?></td>          <?php  if(@$partdata[0]['is_teach']!='Y'){ ?>         
        <td  class="ety" align="center" style="border-top:1px #000000; border-right:1px #000000; padding:2px;"><?php echo $data['class'];?></td>
       <?php }?> 
  </tr>
    <?php 
    }
    ?>
</table>
<br />
<table><tr><td style="color:#FF0000;">* indicate the special order cases</td></tr></table>
</page>
		