<style type="text/css">
<!--
.style1 {
	font-size: 25px;
	font-weight: bold;
	color: #660033;
}
.style56 {
	font-size: 17px;
	font-weight: bold;
	color: #660033;
}
.style2 {
	font-size: 15px;
	font-weight: bold;
	color: black;
}
.stylehy{
	font-size: 11px;
	font-weight: bold;
	color: black;
}
.style55 {

	font-size: 11px;
	color: black;
}
.style57 {
	font-size: 14px
}
.style59 {font-size: 14px; font-weight: bold; color: #660033; }
-->
</style>
<?php

if ($this->session->userdata('SUB_DISTRICT'))
{
	$sub_dist_name		=	get_sub_dist_name($this->session->userdata('SUB_DISTRICT'));
	$label				=	$sub_dist_name;
}
$fest_master_details	=	$this->General_Model->get_fest_master_details();
if (count($fest_master_details) > 0)
{
	$title		=	(@$fest_master_details[0]['sub_dist_kalolsavam_name']) ? @$fest_master_details[0]['sub_dist_kalolsavam_name'] : '';
	$title		=	wordwrap('Sub District '.get_sub_dist_name($this->session->userdata('SUB_DISTRICT')),40,'<br/>');
	$venue		=	wordwrap(@$fest_master_details[0]['venue'],40,'<br/>');
	$logo		=	@$fest_master_details[0]['logo_name'];
	$file_path	=	'';
	if (file_exists($this->config->item('base_path').'uploads/subdistrict/thumb_'.$logo) and trim($logo) != '')
	{
		$file_path		=	base_url(false).'uploads/subdistrict/thumb_'.$logo;
	}
	else {
	
		$file_path="";
	}
}
	
	//echo '<br><br><br>';
	//print_r(@$participant_details);				
?>


<page backtop="2mm" backbottom="0mm">

<table align="left" border="0">
<?php
for($i = 0; $i < count($participant_details); ){

?>
	<tr>
    	<td valign="top">
        	<?php if (@$participant_details[$i]['participant_id']){?>
            <table border="1" width="275" >
            	<tr>
                <?php
              	  if(@$file_path!=""){
				  ?>
                 <td rowspan="2"> <img src="<?php echo @$file_path?>" height="40"  /></td>
                 <?php } 
				 else {?>
                  <td rowspan="2">&nbsp; </td>
                  <?php } ?>
                  <td  class="style56 style57" >Kerala School <?php if($fairId == 4){echo '<br>';} echo $fair_name;  ?> 2013-14</td>
</tr>
                <tr>
                   
                    <td align="left" class="stylehy"><?php echo @$title.'<br>Venue&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.wordwrap(@$venue,30,'<br>'); ?><br></td>
                </tr>
            
                <tr bgcolor="#CCCCCC">
                    <td bgcolor="#E5E5E5" colspan="2" align="center" class="style2" style="border-bottom:1px #666666;border-top:1px #666666; border-right:0px #666666; padding:2px;">Participant's Card</td>
                </tr>
                <tr>
                    <td align="center">Reg. No</td> 
                    <td rowspan="2" style="border-bottom:1px #666666; border-left:1px #666666; padding:1px;"><span class="style2">&nbsp;<?php echo wordwrap($participant_details[$i]['participant_name'],25,'<br/>'); ?></span><br>
                        &nbsp;<?php  echo wordwrap($participant_details[$i]['school_code'].'  '.@$participant_details[0]['school_name'],30,'<br/>'); ?><br>
                        &nbsp;<?php if($participant_details[$i]['is_teach']!='Y'){echo 'Class&nbsp;:&nbsp;'.$participant_details[$i]['class'].'&nbsp;&nbsp;&nbsp;&nbsp;';}if($participant_details[$i]['is_teach']=='Y'){if($participant_details[$i]['gender']=='G'){echo 'Gender&nbsp;:&nbsp;F';} else{ echo 'Gender&nbsp;:&nbspM';} } else{echo 'Gender&nbsp;:&nbsp;'.$participant_details[$i]['gender'];}?><br />
                        &nbsp;<?php echo 'Category&nbsp;:&nbsp;'.$fest[$participant_details[$i]['fest_id']]; ?>
                       
                    </td>
              </tr>
                <tr>
                    <td  width="54"class="style1" valign="top" style="border-bottom:1px #666666; border-right:0px #666666; padding:1px;" align="center"><font style="font-size:14px"><?php echo $participant_details[$i]['participant_id']; ?></font></td>
     
                </tr>
                <?php
					$item_details		=	$this->prereport_model->get_participant_item_details($participant_details[$i]['participant_id'],$fairId);
					
					$cnt=count($item_details);
					$l=1;
					foreach($item_details as $item)
					{
						if($l==$cnt)
							$style="style23";
						else 
							$style="style9";
							$dat_itme=datetophpmodel($item['start_time']);
						if(($item['exhibition']==2))
						{
						$exhibition_item_details		=	$this->prereport_model->get_participant_item_details($participant_details[$i]['participant_id'],$fairId,$item['exhibition']);
						$item['ground_name'] = $exhibition_item_details[0]['ground_name'];$dat_itme=datetophpmodel($exhibition_item_details[0]['start_time']);
						}
				?>
               	<tr>
                	<td colspan="2"  class="<?php echo $style; ?>">
                    	<table width="325">
                        	 <tr>
                                <td class="style55" width="165" valign="top" align="left"><?php  echo ($item['exhibition']==2)?'Exhibition':($item['item_code'].'&nbsp;'.$item['item_name']); ?></td>
                                <td class="style55" width="160" valign="top" align="right"><?php echo $item['ground_name'].'&nbsp;on&nbsp;'.$dat_itme;?>&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
               
                <?php
				$l++;
					}
				?>
            </table>
            <?php }?>
         </td><td width="12">&nbsp;</td>
         <?php $i++;?>
         <td valign="top">
         	<?php if (@$participant_details[$i]['participant_id']){?>
        	<table border="1" width="275" >
            	<tr>
                <?php
              	  if(@$file_path!=""){
				  ?>
                  
                 <td rowspan="2"> <img src="<?php echo @$file_path?>" height="40"></td>
                 <?php 
				 }
				 else {
				 ?>
                <td rowspan="2">&nbsp;</td>
                 
                 <?php
                 }
                 ?>
                    <td class="style59"  >Kerala School <?php if($fairId == 4){echo '<br>';} echo $fair_name; ?> 2013-14</td>
  </tr>
                <tr>
                   
                    <td align="left" class="stylehy"><?php echo @$title.'<br>Venue&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.wordwrap(@$venue,30,'<br>'); ?><br></td>
                </tr>
            
                <tr bgcolor="#CCCCCC">
                    <td bgcolor="#E5E5E5" colspan="2" align="center" class="style2" style="border-bottom:1px #666666;border-top:1px #666666; border-right:0px #666666; padding:2px;">Participant's Card</td>
                </tr>
                
                <tr>
                    <td align="center">Reg. No</td>
                    <td rowspan="2" style="border-bottom:1px #666666; border-left:1.5px #666666; padding:2px;"><span class="style2"><?php echo wordwrap($participant_details[$i]['participant_name'],25,'<br/>'); ?></span><br>
                        <?php  echo wordwrap($participant_details[$i]['school_code'].'  '.@$participant_details[0]['school_name'],30,'<br/>'); ?><br>
            <?php if($participant_details[$i]['is_teach']!='Y'){echo 'Class  :'.$participant_details[$i]['class'].'&nbsp;&nbsp;&nbsp;&nbsp;';}if($participant_details[$i]['is_teach']=='Y'){if($participant_details[$i]['gender']=='G'){echo 'Gender&nbsp;:&nbsp;F';} else{ echo 'Gender&nbsp;:&nbsp;M';} } else{echo 'Gender&nbsp;:&nbsp;'.$participant_details[$i]['gender'];}?><br />
                        <?php echo 'Category :'.$fest[$participant_details[$i]['fest_id']]; ?>
                  </td>
                </tr>
                <tr>
                    <td  width="50"class="style1" valign="top" style="border-bottom:1px #666666; border-right:0px #666666; padding:2px;" align="center"><font style="font-size:14px"><?php echo $participant_details[$i]['participant_id']; ?></font></td>
                    
                </tr>
                <?php
					$item_details		=	$this->prereport_model->get_participant_item_details($participant_details[$i]['participant_id'],$fairId);
					$cnt=count($item_details);
					$l=1;
					
					foreach($item_details as $item)
					{
						if($l==$cnt)
							$style="style23";
						else 
							$style="style9";
							$dat_itme=datetophpmodel($item['start_time']);
							
						if(($item['exhibition']==2))
						{
						$exhibition_item_details		=	$this->prereport_model->get_participant_item_details($participant_details[$i]['participant_id'],$fairId,$item['exhibition']);
						$item['ground_name'] = $exhibition_item_details[0]['ground_name'];$dat_itme=datetophpmodel($exhibition_item_details[0]['start_time']);
						}
				?>
               	<tr>
                	<td colspan="2"  class="<?php echo $style; ?>">
                    	<table width="325">
                        	 <tr>
                                <td class="style55" width="165" valign="top" align="left"><?php echo ($item['exhibition']==2)?'Exhibition':($item['item_code'].'&nbsp;'.$item['item_name']); ?></td>
                                <td class="style55" width="160" valign="top" align="right"><?php echo $item['ground_name'].'&nbsp;on&nbsp;'.$dat_itme;?>&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <?php
				$l++;
					}
				?>
            </table>
            <?php }?>
         </td><td width="12">&nbsp;</td>
         <?php $i++;?>
         
         <td valign="top">
         	<?php if (@$participant_details[$i]['participant_id']){?>
        	<table border="1" width="275" >
            	<tr>
                 <?php
              	  if(@$file_path!=""){
				  ?>
                  <td rowspan="2"> <img src="<?php echo @$file_path?>" height="40"></td>
                  <?php 
				  }
				  else{
				  ?>
                   <td rowspan="2">&nbsp;</td>
                 <?php
				 }
				 ?>
                    <td class="style59">Kerala School <?php if($fairId == 4){echo '<br>';} echo $fair_name; ?> 2013-14</td>
  </tr>
                <tr>
                  
                    <td align="left" class="stylehy"><?php echo @$title.'<br>Venue&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.wordwrap(@$venue,30,'<br>'); ?><br></td>
                </tr>
            
                <tr bgcolor="#CCCCCC">
                    <td bgcolor="#E5E5E5" colspan="2" align="center" class="style2" style="border-bottom:1px #666666;border-top:1px #666666; border-right:0px #666666; padding:2px;">Participant's Card</td>
                </tr>
                <tr>
                    <td align="center">Reg. No</td>
                     <td rowspan="2" style="border-bottom:1px #666666; border-left:1.5px #666666; padding:2px;"><span class="style2"><?php echo wordwrap($participant_details[$i]['participant_name'],25,'<br/>'); ?></span><br>
                        <?php  echo wordwrap($participant_details[$i]['school_code'].'  '.@$participant_details[0]['school_name'],30,'<br/>'); ?><br>
                  <?php if($participant_details[$i]['is_teach']!='Y'){echo 'Class  :'.$participant_details[$i]['class'].'&nbsp;&nbsp;&nbsp;&nbsp;';}if($participant_details[$i]['is_teach']=='Y'){if($participant_details[$i]['gender']=='G'){echo 'Gender&nbsp;:&nbsp;F';} else{ echo 'Gender&nbsp;:&nbsp;M';} } else{echo 'Gender&nbsp;:&nbsp;'.$participant_details[$i]['gender'];} ?><br />
                        <?php echo 'Category :'.$fest[$participant_details[$i]['fest_id']]; ?>
                    </td>
                </tr>
                <tr>
                    <td  width="50"class="style1" valign="top" style="border-bottom:1px #666666; border-right:0px #666666; padding:2px;" align="center"><font style="font-size:14px"><?php echo $participant_details[$i]['participant_id']; ?></font></td>
                   
                </tr>
                <?php
					$item_details		=	$this->prereport_model->get_participant_item_details($participant_details[$i]['participant_id'],$fairId);
						$cnt=count($item_details);
						$l=1;
					
					foreach($item_details as $item)
					{
						if($l==$cnt)
							$style="style23";
						else 
							$style="style9";
							$dat_itme=datetophpmodel($item['start_time']);
							
						if(($item['exhibition']==2))
						{
						$exhibition_item_details		=	$this->prereport_model->get_participant_item_details($participant_details[$i]['participant_id'],$fairId,$item['exhibition']);
						$item['ground_name'] = $exhibition_item_details[0]['ground_name'];$dat_itme=datetophpmodel($exhibition_item_details[0]['start_time']);
						}
				?>
               	<tr>
                	<td colspan="2"  class="<?php echo $style; ?>">
                    	<table width="325">
                        	 <tr>
                                <td class="style55" width="165" valign="top" align="left"><?php  echo ($item['exhibition']==2)?'Exhibition':($item['item_code'].'&nbsp;'.$item['item_name']); ?></td>
                                <td class="style55" width="160" valign="top" align="right"><?php echo $item['ground_name'].'&nbsp;on&nbsp;'.$dat_itme;?>&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                
                <?php
				$l++;
					}
				?>
            </table>
            <?php }?>
         </td>
         <?php $i++;?>
         
      </tr>
      
      <tr>
      <td colspan="5" height="30">&nbsp;</td>
      </tr>
      
      <?php
}
?>
  </table>
  
</page>

