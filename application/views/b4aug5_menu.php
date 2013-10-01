<?
//echo "<br /><br />--->".$this->session->userdata('USER_TYPE');
?>

<div id="header_bar">
  <div class="quicklinks">
    <ul>
       <li class="menupop myaccount menu_border" onmouseover="show_menu(this)" onmouseout="hide_menu(this)"><a href="<?php echo base_url();?>index.php/welcome/home" title="Home">Home</a>
      	<ul style="left: 0px; display:none">
       <!-- <li><a href="<?php echo base_url();?>index.php/welcome/clustdetails">Export</a></li>-->
             <?php
			  
				if($this->session->userdata('USER_TYPE') == 4  ){?>
					<li><a href="<?php echo base_url();?>index.php/welcome/import_interface">Import CSV Data</a></li>  
                    <li><a href="<?php echo base_url();?>index.php/import/backup_data">Backup Database</a></li>                  
			<?php 
				} 
				if($this->session->userdata('USER_GROUP') == 'A' && $this->session->userdata('USER_TYPE') == 2){?>
					<li><a href="<?php echo base_url();?>import/import_data">Import Sub-District CSV Data</a></li>
			<?php
				}
		  		if(($this->session->userdata('USER_GROUP') == 'A') or ($this->session->userdata('USER_GROUP') == 'W')){?>
           			<li><a href="<?php echo base_url();?>index.php/admin/sciencefair">Define Mela</a></li>
            <?php 
				}
			?>
         
            <li><a href="<?php echo base_url().'index.php/welcome/change_password_afterlogin';?>">Change Password</a></li>
        </ul>
      </li>
      <li class="menupop myaccount menu_border" onmouseover="show_menu(this)" onmouseout="hide_menu(this)"><a href="#"><span>Registrations</span></a>
        <ul style="left: 0px; display:none">
        	
                
       <?php if($this->session->userdata('USER_GROUP') == 'W'){?>
          	<li><a href="<?php echo base_url();?>index.php/admin/admin/user_creation">Admin Users</a></li>
          	<li><a href="<?php echo base_url();?>welcome/district_details">District List</a></li>
		  <?php }?>
          
          <?php
		   if($this->session->userdata('USER_GROUP') == 'A'){?>
         	 <li><a href="<?php echo base_url();?>index.php/user/user_registration">User Registration</a></li>
              
             
          <?php }?>
            	
          <?php if($this->session->userdata('USER_TYPE') == '2'){?>
          	<li><a href="<?php echo base_url();?>welcome/sub_district_details">Sub District List</a></li>
		  <?php }?>
          
          <?php if($this->Session_Model->check_user_permission(24) && $this->session->userdata('USER_GROUP') != 'W'){?>
          	<!--<li><a href="<?php echo base_url();?>user/user_cluster">Create Cluster</a></li>-->
            <!--<li><a href="<?php echo base_url();?>welcome/cluster_details">Cluster School List</a></li>-->
		  <?php }?>
           
		  <?php
          if($this->Session_Model->check_user_permission(17) || $this->Session_Model->check_user_permission(2) || $this->Session_Model->check_user_permission(22)){?>
          	<!--<li><a href="<?php echo base_url();?>schools/registration">School Entry</a></li>-->
		  <?php }?>
          
          <?php if($this->session->userdata('USER_GROUP') == 'A' || $this->Session_Model->check_user_permission(23) || $this->Session_Model->check_user_permission(26)){?>
          	<li><a href="<?php echo base_url();?>index.php/school/school_master">School Master</a></li>
		  <?php }?>
          
          
          <?php if($this->Session_Model->check_user_permission(20)){?>
          	<li><a href="<?php echo base_url();?>index.php/school/special_order_entry">Special Order Entry</a></li>
		  <?php }?>
		  
          
		  <?php if($this->Session_Model->check_user_permission(3)){?>
		 <!-- <li><a href="<?php echo base_url();?>stage/allotment">Allotments</a></li>-->
		  <?php }?>
              
        </ul>
      </li>
	  
      		           <li class="menupop myaccount menu_border" onmouseover="show_menu(this)" onmouseout="hide_menu(this)"><a href="#"><span>School Details</span></a>
        <ul style="left: 0px; display:none">
        <?php  if($this->session->userdata('USER_GROUP') == 'A'){ ?>
                
   <li><a href="<?php echo base_url();?>index.php/science/science_entry/school_details">Science Fair</a></li>
   <!-- <li><a href="<?php //echo base_url();?>index.php/maths/maths_entry">Mathematics Fair</a></li>
     <li><a href="<?php //echo base_url();?>index.php/socialscience/socialscience_entry">Social Sciene Fair</a></li>
      <li><a href="<?php //echo base_url();?>index.php/workexpo/worexpo_entry">Work Experience Fair</a></li>
      <li><a href="<?php //echo base_url();?>index.php/IT/IT_entry">IT Fair</a></li>-->
			
         <?php } ?>     
        </ul>
      </li>
      		
           <li class="menupop myaccount menu_border" onmouseover="show_menu(this)" onmouseout="hide_menu(this)"><a href="#"><span>Venue</span></a>
        <ul style="left: 0px; display:none">
        	
        <?php if($this->Session_Model->check_user_permission(19)){?>
            <li><a href="<?php echo base_url();?>index.php/ground/ground_details" title="Ground Master">Define Venue</a></li>
            <?php }?>
         <?php if($this->Session_Model->check_user_permission(3)){?>
            <li><a href="<?php echo base_url();?>index.php/ground/allotment" title="Ground Allotment">Venue Allotment</a></li>
            <li><a href="<?php echo base_url();?>index.php/ground/item_participant/participant_nodetails" title="Ground Items">Venue allotment (Fairwise)</a></li>
        <?php }?>
                       
      	<?php if($this->Session_Model->check_user_permission(31)){?>
            <li><a href="<?php echo base_url();?>index.php/report/prereport/groundallot_duration" title="no. of Participant and duration...">Duration of Events (Festival)</a></li>
            <?php }?>
			
            
              
        </ul>
      </li>
      
          <li class="menupop myaccount menu_border" onmouseover="show_menu(this)" onmouseout="hide_menu(this)"><a href="#"><span>Pre Mela Report</span></a>
        <ul style="left: 0px; display:none">
        	
                
      	<?php if($this->Session_Model->check_user_permission(42)){?>
            <li><a href="<?php echo base_url();?>index.php/report/prereportpdf/eligible_school" target="_blank" title="Eligible Schools">Eligible School</a></li>
            <?php }?>
			<?php if($this->Session_Model->check_user_permission(27)){?>
            <li><a href="<?php echo base_url();?>index.php/report/prereport/list_school" title="List of participating schools with school code" >Participating Schools - Fair Wise</a></li>
            <li><a href="<?php echo base_url();?>index.php/report/prereportpdf/list_school_with_team/" title="School Contacts" target="_blank" >School Contacts</a></li>
			<?php }?>
            <!--<li><a href="<?php echo base_url();?>report/prereportpdf/schoolfestall" title="School details" target="_blank">Participating School(Complete)</a></li>-->
            <?php if($this->Session_Model->check_user_permission(29)){?>
            <li><a href="<?php echo base_url();?>index.php/report/prereport/itemwise_report_interface" title="Participants list item wise/All" >List of Participants - Item Wise</a></li>
            <?php }?>
            <?php if($this->Session_Model->check_user_permission(30)){?>
            <li><a href="<?php echo base_url();?>index.php/report/prereport/list_participants" title="Participant details school wise">List of Participants For Team Managers - schools</a></li>
            <?php }?>
            <?php if($this->Session_Model->check_user_permission(32)){?>
            <!--<li><a href="<?php echo base_url();?>report/prereport/feedetails" title="Fee details for registration commitee">Fee Details of School For Registration</a></li>-->
            <?php }?>
            <?php if($this->Session_Model->check_user_permission(33)){?>
            <li><a href="<?php echo base_url();?>index.php/report/prereport/participant_cardindex" title="participant card">Participant Card </a></li>
            <?php }?>
         
            <?php if($this->Session_Model->check_user_permission(40)){?>
            <li><a href="<?php echo base_url();?>index.php/report/prereport/participant_limit_item_more" title="participant more than one item">Participants More than One Item</a></li>
            <li><a href="<?php echo base_url();?>index.php/report/prereport/team_list" title="Participants in Group Items">Team List</a></li>
            <?php }?>
            <?php if($this->Session_Model->check_user_permission(37)){?>
            <!--<li><a href="<?php echo base_url();?>report/prereport/clashes_details_interface" title="clashes">Clash Report</a></li>-->
            <?php }?>
            <?php if($this->Session_Model->check_user_permission(38)){?>
           <!-- <li><a href="<?php echo base_url();?>report/prereport/clustor_report" title="cluster report">Cluster Report</a></li>-->
            <?php }?>
             <?php if($this->Session_Model->check_user_permission(39)){?>
            <li><a href="<?php echo base_url();?>index.php/report/prereport/groundreportdate" title="venue report">Venue Report</a></li>
            <?php }?>
            <?php if($this->Session_Model->check_user_permission(34)){?>            
            <li><a href="<?php echo base_url();?>index.php/report/prereport/callsheet_first" title="Call sheet">Call Sheet</a></li>
            <?php }?>
             <?php if($this->Session_Model->check_user_permission(41)){?>
            <li><a href="<?php echo base_url();?>index.php/report/prereport/timesheetinterface" title="Timesheet - Item Wise">Timesheet - Item Wise</a></li>
            <?php }?>
             <?php if($this->Session_Model->check_user_permission(35)){?> 
            <li><a href="<?php echo base_url();?>index.php/report/prereport/score_sheet_interfaces" title="score sheet">Score Sheet</a></li>
            <?php }?>  
            <?php if($this->Session_Model->check_user_permission(36)){?> 
            <li><a href="<?php echo base_url();?>index.php/report/prereport/tabulation_report_interface" title="Tabulation sheet">Tabulation Sheet</a></li>
            <?php }?>
            <?php if($this->Session_Model->check_user_permission(43)){?>       
            <li><a href="<?php echo base_url();?>report/prereport/appealed_part"  title="List of Participants by Appeal">List of Participants by Appeal</a></li>
			<?php }?>
            
			<?php if($this->Session_Model->check_user_permission(28)){?>
            <li><a href="<?php echo base_url();?>index.php/report/prereport/datewisepart" title="Date wise participants for press and food" >No. of Participants - Date Wise</a></li>
            <?php }?>
              
        </ul>
      </li>
      
       <li class="menupop myaccount menu_border" onmouseover="show_menu(this)" onmouseout="hide_menu(this)"><a href="#"><span>Result</span></a>
	  	<ul style="left: 0px; display:none">
			<?php if($this->Session_Model->check_user_permission(12)){?>
            <li><a href="<?php echo base_url();?>index.php/result/resultentry/" title="Result Entry">Result Entry</a></li>
			<li><a href="<?php echo base_url();?>index.php/result/resultentry/item_result_list/" title="Item Result List">Item Result List</a></li>
        	<?php }?>
			<?php if($this->Session_Model->check_user_permission(45)){?>
            <li><a href="<?php echo base_url();?>index.php/publishresult/resultindex/resultview/" title="Publish Result">Publish Result</a></li>
			<?php }?> 
        </ul>
	  </li>
      
      
         <li class="menupop myaccount menu_border" onmouseover="show_menu(this)" onmouseout="hide_menu(this)"><a href="#"><span>Result Report</span></a>
	  	<ul style="left: 0px; display:none">
			<?php if($this->Session_Model->check_user_permission(46)){?>
            <li><a href="<?php echo base_url();?>index.php/report/timefestreport/timefest_result_confidential/" title="Confidential Report">Confidential Result Report</a></li>
            <?php }?>
            <?php if($this->Session_Model->check_user_permission(44)){?>
            <li><a href="<?php echo base_url();?>report/afterresultreport/school_wise_result_interface"   title="Item Wise Point"> Item Wise Point  </a></li>
            <li><a href="<?php echo base_url();?>report/afterresultreportpdf/school_wise_result_all" target="_blank" title="school wise point">School Wise Point Report  </a></li>
            <!--<li><a href="<?php // echo base_url();?>report/resultindex/gradewise_interface"  title="Grade wise Result"> Grade Wise(School)  </a></li>-->
            <li><a href="<?php echo base_url();?>report/resultindex/rankwise_result" title="Rank wise Result">Rank Wise  </a></li>
        	<li><a href="<?php echo base_url();?>report/resultindex/gradewise_result" title="Grade wise Result">Grade Wise  </a></li>
         	<li><a href="<?php echo base_url();?>report/afterresultreportpdf/total_points" target="_blank" title="Full Result">All Result </a></li>
             <li><a href="<?php echo base_url();?>report/resultindex/report_press_timewise" target="_blank" title="Report for Press">Time wise Report</a></li>
       		<li><a href="<?php echo base_url();?>report/afterresultreport/status_of_kalolsavam_interface"  title="Kalolsavam Status">Status of Sasthramela  </a></li>
        	<?php }?>
        </ul>
	  </li>
        <li class="menupop myaccount menu_border" onmouseover="show_menu(this)" onmouseout="hide_menu(this)"><a href="#"><span>Certificate</span></a>
	  	<ul style="left: 0px; display:none">
			<?php if($this->Session_Model->check_user_permission(47)){?>
            <li><a href="<?php echo base_url();?>index.php/certificate/certificate/" title="Certificate - Template" >Certificate - Template</a></li>
            <?php }?>
            <?php if($this->Session_Model->check_user_permission(48) ){ 
			// if($this->Session_Model->check_user_permission(48) and $this->General_Model->is_certificate_template_set()){}
			?>
			 <li><a href="<?php echo base_url();?>certificate/certificate/list_item_wise" title="Certificate - Item Wise" >Certificate - Item Wise</a></li>
				<li><a href="<?php echo base_url();?>certificate/certificate/list_school_wise" title="Certificate - School Wise" >Certificate - School Wise</a></li>
				<li><a href="<?php echo base_url();?>certificate/certificate/list_reg_no_wise" title="Certificate - Regiser Number Wise" >Certificate - Reg No. Wise</a></li>
				
				<?php 
			}?>
        </ul>
	  </li>

   
         <li class="menupop myaccount menu_border" onmouseover="show_menu(this)" onmouseout="hide_menu(this)"><a href="#"><span>Export</span></a>
	  	<ul style="left: 0px; display:none">
				<li><a href="<?php echo base_url();?>report/afterresultreport/higherlevel_result"  title="participant Eligible For Higher Level Competition">Higher Level Competition  </a></li>
				<li><a href="<?php echo base_url();?>export/export_district_data" title="Export Data for District Kalolsavam">Export Result Data</a></li>
        </ul>
	  </li>


      
      <li class="menupop myaccount menu_border" onmouseover="show_menu(this)" onmouseout="hide_menu(this)"><a href="#"><span>Downloads</span></a>
	  	<ul style="left: 0px; display:none">
			<li><a target="_blank" href="<?php echo base_url().'index.php/downloads/item_details/1';?>">Item Codes Science Fair</a></li>	
         	<li><a target="_blank" href="<?php echo base_url().'index.php/downloads/item_details/2';?>">Item Codes Mathematics Fair</a></li>
        	 <li><a target="_blank" href="<?php echo base_url().'index.php/downloads/item_details/3';?>">Item Codes Social science Fair</b></a></li>
         	<li><a target="_blank" href="<?php echo base_url().'index.php/downloads/item_details/4';?>">Item Codes Work Experience Fair</b></a></li>
        	 <li><a target="_blank" href="<?php echo base_url().'index.php/downloads/item_details/5';?>">Item Codes IT Mela Fair</a></li>	
        	 <li><a target="_blank" href="../../sciencefair_manual.pdf">Science Fair manual</a></li>
        </ul>
	  </li>
              
     
          
      <li class="menu_border"><a href="<?php echo base_url();?>index.php/welcome/logout">Logout</a></li>
    </ul>
  </div>
</div>
<div class="clear" style="height:5px;">&nbsp;</div> 
