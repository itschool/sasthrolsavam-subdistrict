
<?
 if (($this->session->userdata('USER_TYPE') == 4 or $this->session->userdata('USER_TYPE') == 2 or  $this->session->userdata('USER_GROUP') == 'W')) { ?>
 <div align="right">
 
 <A HREF="javascript:history.go(-1)"><img height="35" width="35" src="<?php echo base_url(false).'images/back_button.png';?>" title="Back"/></a>
 </div>
<? } ?> 	

<!--<div class="conthead">
                <h2>Cluster School List</h2>
 </div>-->
 <div class="content">
 <div class="container">
 
<?php echo form_open('', array('id' => 'clustschool','name' => 'clustschool'));


	if (($this->session->userdata('USER_TYPE') == 4 or $this->session->userdata('USER_TYPE') == 2 or  $this->session->userdata('USER_GROUP') == 'W'))
		{
			$cluster_flag	=	0;		
			if($this->session->userdata('USER_TYPE') == 2) {$col			=	2;}
			else { $col			=	3; }
		}
		else
		{
			$cluster_flag	=	1;	
			$col			=	2;	
		}
?>
<input type="hidden" name="hidSchoolId" id="hidSchoolId" value="1">
 <input name="base_url" type="hidden" id="base_url" value="<?php echo base_url();?>" />
<table width="100%" border="0"   cellspacing="1" cellpadding="4" align="center" class="heading_tab" style="margin-top:15px;">
	<tr>
    	<th colspan="17">
        	<?php print('Name&nbsp;:&nbsp;&nbsp;'.@$cluster[0]['name'].'&nbsp;&nbsp;&nbsp;&nbsp;Mobile&nbsp;:&nbsp;'.@$cluster[0]['mobile'].'&nbsp;&nbsp;&nbsp;&nbsp;E-mail&nbsp;:&nbsp;'.@$cluster[0]['email']);?>        </th>
	  </tr>
      <tr>
		<th colspan="12" >Cluster School List</th>
		<!--<th align="right" colspan="2">Print&nbsp;&nbsp;<img src="<?php echo base_url(false).'images/print_icon.png';?>" title="print" class="window_print" 
		onClick="javascript:printContent('print_content');return false;" /></th>-->
	</tr>
    <tr style="border-bottom:1px solid #CFCFCF;">
		<th width="1%" rowspan="2" align="left">SI.No</th>
		<th width="110" rowspan="2" align="left">&nbsp;School</th>
        <th colspan="<? echo $col; ?>" width="4%" align="center">Science</th>
        <th colspan="<? echo $col; ?>" width="4%" align="center">Maths</th>
        <th colspan="<? echo $col; ?>" width="4%" align="center">Social</th>
        <th colspan="<? echo $col; ?>" width="4%" align="center">Work expo</th>
        <th colspan="<? echo $col; ?>" width="4%" align="center">IT</th>
    </tr>
     <tr style="border-bottom:1px solid #CFCFCF;">
		<th width="3%" align="center">Entered</th>
        <th width="3%" align="center">&nbsp;Confirmed&nbsp;&nbsp;</th>
        <? if($col == 3) { ?><th width="3%" align="center"></th><? } ?>   
        <th width="3%" align="center">Entered</th>
        <th width="3%" align="center">&nbsp;Confirmed&nbsp;&nbsp;</th>
        <? if($col == 3) { ?><th width="1%" align="center"></th><? } ?>   
        <th width="1%" align="center">Entered</th>
        <th width="1%" align="center">&nbsp;Confirmed&nbsp;&nbsp;</th>
        <? if($col == 3){ ?><th width="1%" align="center"></th><? } ?>   
         <th width="1%" align="center">Entered</th>
        <th width="1%" align="center">&nbsp;Confirmed&nbsp;&nbsp;</th>
         <? if($col == 3) { ?><th width="1%" align="center"></th><? } ?>   
         <th width="1%" align="center">Entered</th>
        <th width="1%" align="center">&nbsp;Confirmed&nbsp;&nbsp;</th>
         <? if($col == 3) { ?><th width="1%" align="center"></th><? } ?>   
	</tr>
        <?php
		//var_dump($part);
		
		
		
		for($j=0;$j<count($school);$j++)
		{
			$flag=0;
			$science_data_entered			=	'No';
			$social_data_entered			=	'No';
			$maths_data_entered				=	'No';	
			$workexp_data_entered			=	'No';	
			$it_data_entered				=	'No';			
			$science_data_confirmed			=	'No';
			$social_data_confirmed			=	'No';
			$maths_data_confirmed			=	'No';	
			$workexp_data_confirmed			=	'No';	
			$it_data_confirmed				=	'No';	
			
			$schoolCode						=	$school[$j]['school_code'];
			if($this->Login_Model->if_school_data_entered($school[$j]['school_code'],1))
			{	
					$science_data_entered		= 	'Yes';
			}
			if($this->Login_Model->if_school_data_entered($school[$j]['school_code'],2))
			{
					$maths_data_entered			=	'Yes';
			}
			if($this->Login_Model->if_school_data_entered($school[$j]['school_code'],3))
			{
					$social_data_entered		=	'Yes';
			}
			if($this->Login_Model->if_school_data_entered($school[$j]['school_code'],4))
			{
					$workexp_data_entered		=	'Yes';
			}
			if($this->Login_Model->if_school_data_entered($school[$j]['school_code'],5))
			{
					$it_data_entered			=	'Yes';
			}
			
			
			
			if($this->Login_Model->if_school_data_confirmed($school[$j]['school_code'],'fairScience'))
			{	
					$science_data_confirmed		= 	'Yes';
			}
			if($this->Login_Model->if_school_data_confirmed($school[$j]['school_code'],'fairMathematics'))
			{
					$maths_data_confirmed		=	'Yes';
			}
			if($this->Login_Model->if_school_data_confirmed($school[$j]['school_code'],'fairSocialScience'))
			{
					$social_data_confirmed		=	'Yes';
			}
			if($this->Login_Model->if_school_data_confirmed($school[$j]['school_code'],'fairWorkExp'))
			{
					$workexp_data_confirmed		=	'Yes';
			}
			if($this->Login_Model->if_school_data_confirmed($school[$j]['school_code'],'fairITmela'))
			{
					$it_data_confirmed			=	'Yes';
			}
			
			
			
				
			if($j%2 == 0)
				$class	=	'alt';
			else
				$class	=	'altnext';
				
				
			if($school[$j]['is_finalize']=='Y')
					$finalize	=	'Yes';
				else if($school[$j]['is_finalize']=='N')
					$finalize	=	'No';
				else 
					$finalize	=	'No';
					
			$status = (empty($school[$j]['is_finalize']))? 'N' : $school[$j]['is_finalize'];
			?>
        <tr bgcolor="#F5F5F5"  style="border-bottom:1px solid #CFCFCF;height:20px;">
			<td align="left" ><?php echo ($j+1);?></td>
        	<td align="left" >
            
            	<?php if($this->session->userdata('USER_GROUP') != 'W'){?>
                
                    <a style="text-decoration:none" href="javascript:void(0)" onClick="javascript:goschooldet('<?php echo $school[$j]['school_code']?>')">
                    <?php echo $school[$j]['school_code'];  ?>&nbsp;-&nbsp;
                    <?php echo $school[$j]['school_name'];  ?></a>
                
                
                <?php } else { ?>
					<?php echo $school[$j]['school_code'];  ?>&nbsp;-&nbsp;
                    <?php echo $school[$j]['school_name'];  ?>
                <?php
					}
				?>                </td>               
                
                <td align="center"  width="3%">
                <? 
				
				if($science_data_entered == 'Yes') { ?>
                 <img src="<?php echo base_url(false).'images/icons/icon_tick.png';?>"/>
                
                <?
				 }else { ?>                 
                   <img src="<?php echo base_url(false).'images/icons/icon_delete.png';?>"/>                      
                 <? } ?>           	</td>
                
                 <td align="center"  width="3%">
            
                  <?php 
				   //echo $science_data_entered."---".$science_data_confirmed;
					if($science_data_entered == 'Yes' && $science_data_confirmed != 'Yes')
					{ 
					   if($cluster_flag	==	1) {		?>			
                     <a href="<?php echo base_url();?>index.php/welcome/confirmFair/<?php echo $schoolCode;?>/1"><img title="Confirm" src="<?php echo base_url(false).'images/icons/confirm_button.PNG';?>"/></a>
                      <?php  }
					  else { ?>
                      	<img src="<?php echo base_url(false).'images/icons/icon_delete.png';?>"/>                      
                      <? }
					
					} 
					else if($science_data_confirmed == 'Yes')
					{   ?> 				
					<a href="javascript:void(0)" onClick="javascript:goschooldet('<?php echo $schoolCode; ?>',1)"><img src="<?php echo base_url(false).'images/icons/icon_tick.png';?>"/></a>
                    <? } 
					else
					{?>  <img src="<?php echo base_url(false).'images/icons/icon_delete.png';?>"/>
					<? } ?>           	</td>
            
            <? if($cluster_flag	==	0 && ($this->session->userdata('USER_TYPE') == 4 || $this->session->userdata('USER_TYPE') == 1)) 
			{?>            
             	<td align="center"  width="3%"><?php 
				
				if($science_data_confirmed == 'Yes')
				{ ?>			
                     <a href="<?php 
                     
                     echo base_url();?>/index.php/welcome/resetFair/<?php echo $schoolCode;?>/1"> <img src="<?php echo base_url(false).'images/icons/reset.png';?>" title="Reset"/></a>
              <?php } ?>              </td>              
		<? }
		   ?>
          	
                
<td align="center"  width="3%">
                            
                    
                    <? if($maths_data_entered == 'Yes') { ?>
                 <img src="<?php echo base_url(false).'images/icons/icon_tick.png';?>"/>
                
                <?
				 }else { ?>                 
                   <img src="<?php echo base_url(false).'images/icons/icon_delete.png';?>"/>                      
                 <? } ?>       	  </td>
            
			<td align="center"  width="3%">	          
                   
           
            <?php 
					if($maths_data_entered == 'Yes' && $maths_data_confirmed != 'Yes')
					{
						if($cluster_flag	==	1) {		?>			
                     <a href="<?php echo base_url();?>index.php/welcome/confirmFair/<?php echo $schoolCode;?>/2"><img title="Confirm"  src="<?php echo base_url(false).'images/icons/confirm_button.PNG';?>"/></a>
                      <?php  }
					  else { ?>
                      	<img src="<?php echo base_url(false).'images/icons/icon_delete.png';?>"/>                      
                      <? }
					
					} 
					else if($maths_data_confirmed == 'Yes')
					{   ?> 				
					<a href="javascript:void(0)" onClick="javascript:goschooldet('<?php echo $schoolCode;?>',2)"><img src="<?php echo base_url(false).'images/icons/icon_tick.png';?>"/></a>
                    <? } 
					else
					{?>  <img src="<?php echo base_url(false).'images/icons/icon_delete.png';?>"/>
					<? } ?>          </td>
          
           <? if($cluster_flag	==	0 && ($this->session->userdata('USER_TYPE') == 4 || $this->session->userdata('USER_TYPE') == 1)) 
			{?>            
          		           
             	<td align="center"  width="1%"><?php 
				if($maths_data_confirmed == 'Yes')
				{ ?>			
                    <a href="<?php 
                     
                     echo base_url();?>/index.php/welcome/resetFair/<?php echo $schoolCode;?>/2"> <img src="<?php echo base_url(false).'images/icons/reset.png';?>" title="Reset"/></a>
              <?php } ?>              </td>       
		   <? } ?>
          
            
             <td align="center"  width="1%">
                                
                      <? if($social_data_entered == 'Yes') { ?>
                 <img src="<?php echo base_url(false).'images/icons/icon_tick.png';?>"/>
                
                <?
				 }else { ?>                 
                   <img src="<?php echo base_url(false).'images/icons/icon_delete.png';?>"/>                      
                 <? } ?>       	  </td>
            
			<td align="center"  width="1%">	          
           
        
            
             <?php 
					if($social_data_entered == 'Yes' && $social_data_confirmed != 'Yes')
					{
						if($cluster_flag	==	1) {		?>			
                     <a href="<?php echo base_url();?>index.php/welcome/confirmFair/<?php echo $schoolCode;?>/3"><img title="Confirm"  src="<?php echo base_url(false).'images/icons/confirm_button.PNG';?>"/></a>
                      <?php  }
					  else { ?>
                      	<img src="<?php echo base_url(false).'images/icons/icon_delete.png';?>"/>                      
                      <? }
					
					} 
					else if($social_data_confirmed == 'Yes')
					{   ?> 				
					<a href="javascript:void(0)" onClick="javascript:goschooldet('<?php echo $schoolCode; ?>',2)"><img src="<?php echo base_url(false).'images/icons/icon_tick.png';?>"/></a>
                    <? } 
					else
					{?>  <img src="<?php echo base_url(false).'images/icons/icon_delete.png';?>"/>
					<? } ?>            </td>
            
            
             <? if($cluster_flag	==	0 && ($this->session->userdata('USER_TYPE') == 4 || $this->session->userdata('USER_TYPE') == 1)) 
			{?>
           		 <td align="center"  width="1%"><?php 
				if($social_data_confirmed == 'Yes')
				{ ?>			
                    <a href="<?php 
                     
                     echo base_url();?>/index.php/welcome/resetFair/<?php echo $schoolCode;?>/3"> <img src="<?php echo base_url(false).'images/icons/reset.png';?>" title="Reset"/></a>
              <?php } ?>              </td>       
		   <? }?>            
            
            
             <td align="center"  width="1%">
                                
                      <? if($workexp_data_entered == 'Yes') { ?>
                 <img src="<?php echo base_url(false).'images/icons/icon_tick.png';?>"/>
                
                <?
				 }else { ?>                 
                   <img src="<?php echo base_url(false).'images/icons/icon_delete.png';?>"/>                      
                 <? } ?>       	  </td>
            
			<td align="center"  width="1%">	          
           
         
            
             <?php 
					if($workexp_data_entered == 'Yes' && $workexp_data_confirmed != 'Yes')
					{
						if($cluster_flag	==	1) {		?>			
                     <a href="<?php echo base_url();?>index.php/welcome/confirmFair/<?php echo $schoolCode;?>/4"><img  title="Confirm"  src="<?php echo base_url(false).'images/icons/confirm_button.PNG';?>"/></a>
                      <?php  }
					  else { ?>
                      	<img src="<?php echo base_url(false).'images/icons/icon_delete.png';?>"/>                      
                      <? }
					
					} 
					else if($workexp_data_confirmed == 'Yes')
					{   ?> 				
					<a href="javascript:void(0)" onClick="javascript:goschooldet('<?php echo $schoolCode; ?>',2)"><img src="<?php echo base_url(false).'images/icons/icon_tick.png';?>"/></a>
                    <? } 
					else
					{?>  <img src="<?php echo base_url(false).'images/icons/icon_delete.png';?>"/>
					<? } ?>            </td>
            
             <? if($cluster_flag	==	0 && ($this->session->userdata('USER_TYPE') == 4 || $this->session->userdata('USER_TYPE') == 1)) 
			{?>
                 <td align="center"  width="1%"><?php 
                    if($workexp_data_confirmed == 'Yes')
                    { ?>			
                         <a href="<?php 
                     
                     echo base_url();?>/index.php/welcome/resetFair/<?php echo $schoolCode;?>/4"> <img src="<?php echo base_url(false).'images/icons/reset.png';?>" title="Reset"/></a>
                  <?php } ?>                  </td>     
		   <? }?>
            
<td align="center"  width="1%">
                                      
                       <? if($it_data_entered == 'Yes') { ?>
                 <img src="<?php echo base_url(false).'images/icons/icon_tick.png';?>"/>
                
                <?
				 }else { ?>                 
                   <img src="<?php echo base_url(false).'images/icons/icon_delete.png';?>"/>                      
                 <? } ?>       	  </td>
            
			<td align="center"  width="1%">	          
                    
            
             <?php 
					if($it_data_entered == 'Yes' && $it_data_confirmed != 'Yes')
					{
						if($cluster_flag	==	1) {		?>			
                     <a href="<?php echo base_url();?>index.php/welcome/confirmFair/<?php echo $schoolCode;?>/5"><img  title="Confirm"  src="<?php echo base_url(false).'images/icons/confirm_button.PNG';?>"/></a>
                      <?php  }
					  else { ?>
                      	<img src="<?php echo base_url(false).'images/icons/icon_delete.png';?>"/>                      
                      <? }
					
					} 
					else if($it_data_confirmed == 'Yes')
					{   ?> 				
					<a href="javascript:void(0)" onClick="javascript:goschooldet('<?php echo $schoolCode; ?>',2)"><img src="<?php echo base_url(false).'images/icons/icon_tick.png';?>"/></a>
                    <? } 
					else
					{?>  <img src="<?php echo base_url(false).'images/icons/icon_delete.png';?>"/>
					<? } ?>            </td>
            
             <? if($cluster_flag	==	0 && ($this->session->userdata('USER_TYPE') == 4 || $this->session->userdata('USER_TYPE') == 1)) 
			{?>
               <td align="center"  width="1%"><?php 
                    if($it_data_confirmed == 'Yes')
                    { ?>			
                        <a href="<?php 
                     
                     echo base_url();?>/index.php/welcome/resetFair/<?php echo $schoolCode;?>/5"> <img src="<?php echo base_url(false).'images/icons/reset.png';?>" title="Reset"/></a>
                  <?php } ?>                  </td>    
		   <? } ?>
	  </tr>
        
        <?php
		$flag=0;
		}
		?>
</table>
<!-- print content starts here----------------------------------->
<div id="print_content" style="display:none;">
	<table width="100%" border="1" cellspacing="0" cellpadding="6" align="center" style="margin-top:15px;">
		<tr>
			<th colspan="4">
				<?php print('Name&nbsp;:&nbsp;&nbsp;'.$cluster[0]['name'].'&nbsp;&nbsp;&nbsp;&nbsp;Username:&nbsp;&nbsp;'.$cluster[0]['user_name'].'&nbsp;&nbsp;&nbsp;&nbsp;Mobile&nbsp;:&nbsp;'.$cluster[0]['mobile'].'&nbsp;&nbsp;&nbsp;&nbsp;E-mail&nbsp;:&nbsp;'.$cluster[0]['email']);?>
			</th>
		</tr>
		<tr>
			<th width="5%" align="left">SI.No</th>
			<th width="55%" align="left">School</th>
			<th width="20%" align="center">Data Entered</th>
			<th width="20%" align="center">Confirmed</th>
		</tr>
			<?php
			for($j=0;$j<count($school);$j++){
			$flag=0;
			for($k=0;$k<count($part);$k++){
					
					if($school[$j]['school_code']==$part[$k]['school_code']){
					 $entry='Yes';
					 $flag=1;
					}
				}
					if($flag==0)
						 $entry='No';
					 if($school[$j]['is_finalize']=='Y')
						$finalize='Yes';
					else if($school[$j]['is_finalize']=='N')
						$finalize='No';
					else 
						$finalize='No';
			
			?>
			<tr>
				<td align="left" ><?php echo ($j+1);?></td>
				<td align="left" >&nbsp;&nbsp;&nbsp;
					<?php echo $school[$j]['school_code'];  ?>&nbsp;-&nbsp;
					<?php echo $school[$j]['school_name'];  ?></td>
				<td align="center" ><?php echo $entry; ?>   </td>
				<td align="center" ><?php echo $finalize; ?>  </td>
			</tr>
		<?php
			$flag=0;
			}
		?>
	</table>
</div>
<!-- display content ends here --------------------------------------->
<?php
echo form_close();
?><br />

</div>
</div>