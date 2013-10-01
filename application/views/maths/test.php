<page backtop="20mm" backbottom="50mm">
	<page_header>
		<table style="width: 100%;">
			<tr>
				<!--<td style="text-align: left; width: 50%">
					<img src="<?php //echo image_url().'logo.jpg'?>">
				</td>-->
				<td style="width: 100%" align="center"><strong>Kerala School Sports 20011 - 12</strong></td>
			</tr>
            <tr>
				<td style="width: 100%" align="center">
                <?php 
					echo @$school_details[0]['sub_district_name'].' Subdistrict';
					echo (@$user_cluser) ? '(Cluster : '.@$user_cluser.')' : '';
				?>
                
                </td>
			</tr>
			<tr>
				<td style="width: 100%"><hr/></td>
			</tr>
		</table>
	</page_header>
	
	<table width="100%" border="0" cellspacing="5" cellpadding="10" align="center" class="heading_tab" style="margin-top:15px;">
       <tr>
         <td align="left" class="table_row_first">Date:</td>
         <td align="left" class="table_row_first"><strong><?php echo date("j F, Y");?></strong></td>
         <td align="left" class="table_row_first">Time :</td>
         <td align="left" class="table_row_first"><strong><?php echo date('h:i:s');?></strong></td>
       </tr>
       <tr>
            <td align="left" width="100" class="table_row_first">School Code : </td>
            <td align="left" width="100" class="table_row_first"><?php echo @$school_details[0]['school_code'];?></td>
            <td align="left" width="100" class="table_row_first">School Name : </td>
            <td align="left" width="300" class="table_row_first"><?php @print($school_details[0]['school_name'])?></td>
      </tr>
        <tr>
            <td align="left" class="table_row_second">Standard : </td>
            <td align="left" class="table_row_second">From : <?php echo @$school_details[0]['class_start'];?></td>
            <td align="left" colspan="2" class="table_row_second">To : <?php echo  @$school_details[0]['class_end'];?></td>
        </tr>
        <tr>
            <td align="left"  class="table_row_first">School Type : </td>
            <td align="left" colspan="3" class="table_row_first">
            <?php 
            if(@$school_details[0]['school_type'] == 'G') 
                $type	=	'Government';
            else if(@$school_details[0]['school_type'] == 'A') 
                 $type	= 	'Aided';
            else if(@$school_details[0]['school_type'] == 'U') 
                $type	= 	'Unaided' ;
            else
                $type	= '';
            echo $type;?>            </td>
        </tr>
        <tr>
            <td align="left"  class="table_row_first">Phone : </td>
            <td align="left" colspan="3" class="table_row_first"><?php echo (@$school_details[0]['school_phone']) ? @$school_details[0]['school_phone'] : '';?></td>
        </tr>
        <tr>
            <td align="left"  class="table_row_first">Headmaster : </td>
            <td align="left"  class="table_row_first"><?php echo (@$school_details[0]['hm_name']) ? @$school_details[0]['hm_name'] : '';?></td>
            <td align="left" class="table_row_first">Phone : </td>
            <td align="left"  class="table_row_first"><?php echo (@$school_details[0]['hm_phone']) ? @$school_details[0]['hm_phone'] : '';?></td>
        </tr>
        <tr>
            <td align="left" class="table_row_first">Principal : </td>
            <td align="left" class="table_row_first"><?php echo (@$school_details[0]['principal_name']) ? @$school_details[0]['principal_name'] : '';?></td>
            <td align="left"  class="table_row_first">Phone : </td>
            <td align="left"  class="table_row_first"><?php echo (@$school_details[0]['principal_phone']) ? @$school_details[0]['principal_phone'] : '';?></td>
        </tr>
        <tr>
            <td align="left" class="table_row_first" valign="top">Team Managers : </td>
            <td align="left" colspan="3" class="table_row_first"><div id="teachersRow">
                <?php 
                  if(@$escortingTeachersDetails[0]['teachers'] != ''){
                       $teachers	=	explode("#@#", $escortingTeachersDetails[0]['teachers']);
						echo '<table cellpadding="2" cellspacing="2" border="0">';
						for($i=0; $i < count($teachers); $i++){
							$teachers_details	=	explode('#$#', $teachers[$i]);
							if(count($teachers_details) > 1){
								echo '<tr><td>'.@$teachers_details[0].'</td><td>&nbsp;&nbsp;&nbsp;Phone : </td><td>'.@$teachers_details[1].'</td></tr>';
							}
						}
						echo '</table>';
                    }
                ?>
                </div>
                <div class="clear"></div>            </td>
        </tr>
        
        
        
        <tr>
            <td align="left" class="table_row_first" valign="top">Escorting Teachers: </td>
            <td align="left" colspan="3" class="table_row_first"><div id="teachersRow">
                <?php 
                  if(@$escortingTeachersDetails[0]['escorting_teachers'] != ''){
                       $teachers	=	explode("#@#", $escortingTeachersDetails[0]['escorting_teachers']);
						echo '<table cellpadding="2" cellspacing="2" border="0">';
						for($i=0; $i < count($teachers); $i++){
							$teachers_details	=	explode('#$#', $teachers[$i]);
							if(count($teachers_details) > 1){
								echo '<tr><td>'.@$teachers_details[0].'</td><td>&nbsp;&nbsp;&nbsp;Phone : </td><td>'.@$teachers_details[1].'</td></tr>';
							}
						}
						echo '</table>';
                    }
                ?>
                </div>
                <div class="clear"></div>            </td>
        </tr>
        
        
        
        
        <tr>
            <td align="left" class="table_row_first">Total number of students : </td>
            <td align="left" class="table_row_first" colspan="3">
                LP <?php echo @$school_details[0]['strength_lp'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                UP <?php echo @$school_details[0]['strength_up'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                HS <?php echo @$school_details[0]['strength_hs'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                HSS <?php echo @$school_details[0]['strength_hss'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                VHSE <?php echo @$school_details[0]['strength_vhss'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                Total <?php echo @$school_details[0]['total_strength'];?>            </td>
        </tr>
    </table>
    
  <page_footer>
		<table width="80%" cellpadding="5" cellspacing="0" border="0" align="left">
    		
		<tr>
        	<td align="center" width="700" colspan="3">
			   	Certified that above details has been verified and found correct
                <br /><br /><br />            </td>
        </tr>
        <tr>
        	<td align="left" width="700">
            	Place&nbsp;:&nbsp;..............................<br /><br />
                Date&nbsp;&nbsp;:&nbsp;.............................            </td>
            <td align="center" width="300">
            	<br /><br />
            	(School Seal)            </td>
        	<td align="right">
            	<br /><br />
               	Principal/Headmaster            </td>
        </tr>
        <tr>
          <td colspan="3" align="left">
           <?php 
			   
			    if($ifSchoolcnfrm['schoolConfirm'] == 'Y')
				{
					echo "Note : Report Taken After confirmed. School Confirmed in ".$ifSchoolcnfrm['confirmTime'];
				}
				else
				{
					echo "Note : Report Taken on ".date("F j, Y, g:i a")." before Confirmation";
				}
				?>
                </td>
          </tr>
    </table>
	
<table style="width: 100%;">
			<tr>
				<td style="width: 100%"><hr/></td>
			</tr>
			<tr>
				<td style="text-align: center;width: 100%">page [[page_cu]]/{nb} </td>
			</tr>
		</table>
	</page_footer>  
    
<table width="49%" border="1" cellspacing="0" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
        <tr>
          <th align="center" width="34" style="border-right:1px #000000; padding:2px;">Sl.No</th>
          <th align="left" width="40" style="border-right:1px #000000; padding:2px;">Admn No.</th>
          <th align="left" width="69" style="border-right:1px #000000; padding:2px;">Name of participant</th>
            
          <th align="left" width="58" style="border-right:1px #000000; padding:2px;">Parents Name</th>
          <th align="center" width="32" style="border-right:1px #000000; padding:2px;">DOB</th>
          <th align="left" width="24" style="border-right:1px #000000; padding:2px;">Age</th>
          <th align="center" width="34" style="border-right:1px #000000; padding:2px;">Class</th>
          <th align="left" width="27" style="border-right:1px #000000; padding:2px;">Boy / Girl </th>
          <th align="left" width="60" style="padding:2px;">Item code</th>
      </tr>
        <?php
            $count	=	0	;
            for($j = 0; $j < count($participant_details); $j++){
			//var_dump($participant_details);
				
				if($participant_details[$j]['item_code'][0]==0){}else{
				$count++;
                ?>
                <tr>
                    <td align="center" style="border-top:1px #000000; border-right:1px #000000; padding:2px;"><?php echo $count;
					//echo $participant_details[$j]['item_code'][0];?></td>
                    <td align="left" style="border-top:1px #000000; border-right:1px #000000; padding:2px;"><?php echo $participant_details[$j]['admn_no']?></td>
                    <td align="left" style="border-top:1px #000000; border-right:1px #000000; padding:2px;"><?php 
					$participant =  $participant_details[$j]['participant_name'];
					echo wordwrap($participant,15,"<br />\n");
					?></td>
                   
                    <td align="left" style="border-top:1px #000000; border-right:1px #000000; padding:2px;"><?php 
					$parent	=	 $participant_details[$j]['fatherOrGuardianName'];
					echo wordwrap($parent,15,"<br />\n");
					?></td>
                    <td align="left" style="border-top:1px #000000; border-right:1px #000000; padding:2px;"><?php 
					//echo $participant_details[$j]['dateOfBirth'];
				$dob1				= 		$participant_details[$j]['dateOfBirth'];
				$dob1				=		explode('-',$dob1);
				echo $date			=		$dob1[2]."-";
				echo $month			=		$dob1[1]."-";
				echo $year			=		$dob1[0];
				//echo "[". $participant_details[$j]['age']. "]";	
					
					?></td>
                    <td align="left" style="border-top:1px #000000; border-right:1px #000000; padding:2px;"><?php echo $participant_details[$j]['age'];?></td>
                    <td align="center" style="border-top:1px #000000; border-right:1px #000000; padding:2px;"><?php echo $participant_details[$j]['class']?></td>
                    <td align="left" style="border-top:1px #000000; border-right:1px #000000; padding:2px;"><?php echo ($participant_details[$j]['gender'] == 'B') ? 'Boy' : 'Girl';?></td>
                    <td align="left" style="border-top:1px #000000; padding:2px;">
					<?php
					$cnt_item	=	1;
                    foreach($participant_details[$j]['item_code'] as $items){
                        if ($cnt_item == 10)
						{
							echo '<br>';
						} 
						echo @$items.'&nbsp;&nbsp;';
						 //echo @$items.'';
                    	$cnt_item++;
					}
					 echo '&nbsp;';
                    ?>                    </td>
                </tr>	
                <?php
				}
            }
        ?>
    </table>
<br><br><br>
	<table width="80%" align="left">
    	<tr>
        	<td align="left" width="500">
            	Name & Signature of Team Manager
            </td>
        </tr>
    </table>
    
	<?php 
			$classend 				= 	@$school_details[0]['class_end'];
			$totalstudents			=	@$school_details[0]['total_strength'];
			
			
			
			//var_dump($classend);
			//var_dump($totalstudents);
			if( ($classend >=10) && ($totalstudents>=1000)  ){
			$school_type			=	"HS/HSS/VHSE";
			$subdistfee				=	200;
			$revdistfee				=	100;
			$totalfee				=	$subdistfee+$revdistfee;
			}
			elseif( ($classend==7) && ($totalstudents>=1000)  ){
			$school_type			=	"UP";
			$subdistfee				=	50;
			$revdistfee				=	20;
			$totalfee				=	$subdistfee+$revdistfee;
			}else if( ($classend >=10) && ($totalstudents<1000)  ){
			$school_type			=	"HS/HSS/VHSE";
			$subdistfee				=	150;
			$revdistfee				=	50;
			$totalfee				=	$subdistfee+$revdistfee;
			}
			elseif( ($classend==7) && ($totalstudents<1000)  ){
			$school_type			=	"UP";
			$subdistfee				=	50;
			$revdistfee				=	20;
			$totalfee				=	$subdistfee+$revdistfee;
			}elseif( ($classend<7) ){
			$school_type			=	"LP";
			$subdistfee				=	50;
			$revdistfee				=	20;
			$totalfee				=	$subdistfee+$revdistfee;
			}
	?>
    <table cellpadding="5" cellspacingl="0" border="1" align="center">
    	<tr>
			<th colspan="2" style="border-bottom:1px #000000;" align="center">Details of fees to be remitted</th>
		</tr>
		<tr>
			<td width="279" align="left"  style="border-bottom:1px #000000; border-right: 0 1px 1px 0 #000000; padding:2px;">School type</td>
			<td width="146" align="left"  style="border-bottom:1px #000000; border-right: 0 1px 1px 0 #000000; padding:2px;"><?php echo $school_type;?></td>
		</tr>
		<tr>
			<td align="left"  style="border-bottom:1px #000000; border-right: 0 1px 1px 0 #000000; padding:2px;">School affiliation fee in sudistrict </td>
			<td align="left"  style="border-bottom:1px #000000; border-right: 0 1px 1px 0 #000000; padding:2px;"><?php echo $subdistfee;?></td>
		</tr>
		<tr>
		  <td align="left"  style="border-bottom:1px #000000; border-right: 0 1px 1px 0 #000000; padding:2px;">School affiliation fee in district </td>
		  <td align="left"  style="border-bottom:1px #000000; border-right: 0 1px 1px 0 #000000; padding:2px;"><?php echo $revdistfee;?></td>
	  </tr>
		<tr>
		  <td align="left"  style="border-bottom:1px #000000; border-right: 0 1px 1px 0 #000000; padding:2px;">Total amount </td>
		  <td align="left"  style="border-bottom:1px #000000; border-right: 0 1px 1px 0 #000000; padding:2px;"><?php echo $totalfee;?></td>
	  </tr>
  </table>
	
</page>
<page_footer>
		<table width="80%" cellpadding="5" cellspacing="0" border="0" align="left">
    		
		<tr>
        	<td align="center" width="700" colspan="3">
			   	Certified that above details has been verified and found correct
                <br /><br /><br />            </td>
        </tr>
        <tr>
        	<td align="left" width="700">
            	Place&nbsp;:&nbsp;..............................<br /><br />
                Date&nbsp;&nbsp;:&nbsp;.............................            </td>
            <td align="center" width="300">
            	<br /><br />
            	(School Seal)            </td>
        	<td align="right">
            	<br /><br />
               	Principal/Headmaster            </td>
        </tr>
        <tr>
          <td colspan="3" align="left"> <?php 
			   
			    if($ifSchoolcnfrm['schoolConfirm'] == 'Y')
				{
					echo "Note : Report Taken After confirmed. School Confirmed in ".$ifSchoolcnfrm['confirmTime'];
				}
				else
				{
					echo "Note : Report Taken on ".date("F j, Y, g:i a")." before Confirmation";
				}
				?></td>
          </tr>
    </table>
	
<table style="width: 100%;">
			<tr>
				<td style="width: 100%"><hr/></td>
			</tr>
			<tr>
				<td style="text-align: center;width: 100%">page [[page_cu]]/{nb} </td>
			</tr>
		</table>
	</page_footer>