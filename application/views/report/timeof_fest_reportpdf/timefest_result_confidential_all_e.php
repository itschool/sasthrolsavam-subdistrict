
<style type="text/css">
<!--
.style1 {
	font-size: 14px;
	font-weight: bold;
	color: #660033;
}.style2 {
	font-size: 11px;
	font-weight: 100;
	
}
.style3 {
	font-size: 10px;
	font-weight: 100;
	height:9px;
	border:0 0 0.5px 0.5px 0 #000000 ; 
}
</style>
<page backtop="30mm" backbottom="20mm">
<page_header>
    	<?php
			$this->load->view('report/report_header');
			$char_arr = array(1=>'LP',2=>'UP',3=>'HS',4=>'HSS/VHSS');
		?>
          <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
			<tr>
				<td colspan="2" align="center" class="style1">
					Confidential Report	
				</td>		  
		  </tr>        
        <tr>
            <td  align="left" width="305" class="style1"  style=" padding:2px;"height="25">&nbsp;&nbsp; Exhibition ( <?php echo $char_arr[$fest_id];?> ) </td>
            <td  align="right" width="438" class="style1"  style=" padding:2px;"height="25">
                         </td>
        </tr>
         </table> 
  </page_header>
<page_footer>
	<?php
	    ?> <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#D4D0C8">
                <tr>
                    <td  align="right" width="80" height="20" valign="top">Entered by :</td>
                    <td  align="right" width="500" height="20" valign="top">Signature :</td>
                    <td align="left" width="100">&nbsp;</td>
                </tr>
                <tr>
                    <td  align="right" width="80" height="20" valign="top">Checked by :</td>
                    <td   align="right" height="20" valign="top" >Program Convenor</td>
                    <td align="left">&nbsp;</td>
                </tr>
                
  </table><?php
		$this->load->view('report/report_footer');  
		 $ctt=  @$festresult[0]['no_of_judges'];
	?>
</page_footer>
  <table width="97%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#D4D0C8">
          <tr>
            <td width=20 height="10" rowspan="2" align="center"style='border:0 0 0.5px 0.5px 0#666666 ; '>Sl No</td>
            <td width=40  height="10" rowspan="2" align="center"style='border:0 0 0.5px 0.5px 0 #666666 ;'>Reg No </td>
            <td width=27  height="10"rowspan="2" align="center"style='border:0 0 0.5px 0.5px 0 #666666 ; '>Code No</td>
            <td width=170  height="10"rowspan="2"  align="left" style='border:0 0 0.5px 0.5px 0 #666666 ;  px;'>&nbsp;Name</td>
            <td width=170  height="10"rowspan="2"  align="left" style='border:0 0 0.5px 0.5px 0 #666666 ;'>&nbsp;School</td>
            <td align="center" colspan="4" width=20  height="10"style='border:0 0 0.5px 0.5px 0 #666666; '>Marks</td>       <td align="center" rowspan="2" width=20 height="10" style='border:0 0 0.5px 0.5px 0 #666666 ; '> %</td>
            <td align="center" rowspan="2" width=20 height="10" style='border:0 0 0.5px 0.5px 0 #666666 ; '>R</td>
            <td align="center" rowspan="2"width=20  height="10"style='border:0 0 0.5px 0.5px 0 #666666 ; '>G</td>
            <td align="center" rowspan="2" width=20  height="10"style='border:0 0 0.5px 0.5px 0 #666666 ; '>P</td>
          </tr>
           <tr>
            <td  align="center" height="10"width=20 style='border:0 0 0.5px 0.5px 0 #666666 ;'>1</td>
             <td  align="center" height="10"width=20 style='border:0 0 0.5px 0.5px 0 #666666 ;'>2</td>
              <td  align="center" height="10"width=20 style='border:0 0 0.5px 0.5px 0 #666666 ;'>3</td>
              <td  align="center" height="10"width=30 style='border:0 0 0.5px 0.5px 0 #666666 ;'>Total</td>
          
          
          </tr>
         

<?php      $k=0;
           $appeal=0;
		   $withheldno=0;
		   $previtem="";
		   $Absent_count=0;
		  
		   $no=0;
		   $sl=0;
		   for($j=0; $j<count($festresult); $j++){
			   $sl++;     
				   //if($previtem!=$festresult[$j]['item_code']){
					
					 
					$temp=$previtem;
					$previtem=$festresult[$j]['item_code'];
					$this->load->model('report/timefest_model');
						$itemcount= $this->timefest_model->timeoffest_count($temp);
						//$itemcount2= $this->timefest_model->timeoffest_count2($previtem);     
					    $absentee_list= $this->timefest_model->timeoffest_result_absentee($temp);
					    $absentee	= explode(',', $absentee_list);
					 $this->Reg_no=array();
					
						   if($j!=0){/*
						   				$rt=0;
								for($ty=0;$ty<count($absentee);$ty++){
										 //if($temp==$absenteeall[$ty]['item_code']){
											 $this->Reg_no[$ty]=$absentee[$ty];	
											 $rt++;
									 	// }
								 }
						 $Absent_reg_no=(count($absentee) and (trim($absentee[0]))) ? count($absentee) : '0';
						  $no_reg_tot=$itemcount[0]['picount'];
						  
						  $withheldcount=$withheldno-$appeal;
						  
						         $withheldno=0;
						   */}
						
	?>   

        
          <?php
		 
		  		 	 
		  //} 
	
		   ?>
          <tr>
            <td  align="center" width=20 class="style3"><?php echo $sl;?>&nbsp;</td>
          <td   align="center" width=39  class="style3"><?php
			  	    
			$symbol = '';
			if(@$festresult[$j]['is_publish']=='N'){
			
			$symbol .= '*';
			}
			
			if(@$festresult[$j]['spo_id'] > 0){
			
			$symbol .= '*';
			if($symbol=='**'){
			  $appeal++;}
			 $withheldno++;
			 
			}
			
			echo @$festresult[$j]['participant_id'].$symbol;
			
?>
&nbsp;</td>
          <td width=27  align="center"class="style3"><p><?php echo @$festresult[$j]['prefixCode'].@$festresult[$j]['codeNo'];?></p></td>
          <td width=170 align="left" class="style3"><?php $name=@$festresult[$j]['participant_name']; $name=wordwrap($name, 30, "<br />", 1); echo $name; ?></td>
          <td width=170 align="left" class="style3"><?php $text=$festresult[$j]['school_name'];
		   $text = wordwrap($text, 45, "<br />", 1);
		  	echo  $festresult[$j]['school_code']."-".$text; 
		  ?></td>
           <?php 
		   $marks	=	explode('#$#',@$festresult[$j]['marks']);
		   $cnt=count(@$festresult[$j]['no_of_judges']);
		   for($k =0; $k<3; $k++ ){ 
		   
		   ?>
          <td  width="20" align="center" class="style3" >
		  <?php 
		   echo  @$marks[$k];
		   ?>
          </td>         
<?php 
		  }
		  ?>
          
            
          <td  align="center"  width=20 class="style3"><?php echo $festresult[$j]['total_mark'];?></td>
          <td  align="center"  width=20 class="style3"><?php
			  $percentage=$festresult[$j]['percentage'];
		      $prnt= round( $percentage,2);
			  echo $prnt;
			  ?></td>
          <td align="center" width=20 class="style3"><?php echo $festresult[$j]['rank'];?></td>
          <td align="center" width=20 class="style3"><?php echo $festresult[$j]['grade'];?></td>
          <td align="center" width=20 class="style3"><?php echo $festresult[$j]['point'];?></td>
      	</tr>
       
         <?php
			 
			}
		  
		  ?>
        
            <?php
		     $temp=$festresult[$j-1]['item_code'];
			 $itemcount= $this->timefest_model->timeoffest_count($festresult[$j-1]['item_code']);
		  	 $absentee_list= $this->timefest_model->timeoffest_result_absentee($temp);
			 $absentee	= explode(',', $absentee_list);
			
			
			 $this->Reg_no=array();$rt=0;
			 for($ty=0;$ty<count($absentee);$ty++){
						//if($temp==$absenteeall[$ty]['item_code']){
							$this->Reg_no[$ty]=$absentee[$ty];	
							$rt++;
							// }
						}
						  $Absent_reg_no=(count($absentee) and (trim($absentee[0]))) ? count($absentee) : '0';
						  $no_reg_tot=$itemcount[0]['picount'];
						  $withheldcount=$withheldno-$appeal;
			 
                 
       ?>
       </table>
        </page>
		