<div id="header_bar">
  <div class="quicklinks">
    <ul>
        <li class="menupop myaccount menu_border" onmouseover="show_menu(this)" onmouseout="hide_menu(this)"><a href="<?php echo base_url();?>welcome" title="Home">Home</a>
      	<ul style="left: 0px; display:none">
            <?php
			  /* echo "<br /><br />.....".$this->session->userdata('USER_GROUP');
			   echo "<br /><br />-----".$this->session->userdata('USER_TYPE');		*/	   
				if($this->session->userdata('USER_GROUP') == 'A' && $this->session->userdata('USER_TYPE') == 3  ){?>
					<li><a href="<?php echo base_url();?>import/import_data">Import CSV Data</a></li>
			<?php 
				}
				if($this->session->userdata('USER_GROUP') == 'A' && $this->session->userdata('USER_TYPE') == 2){?>
					<li><a href="<?php echo base_url();?>import/import_data">Import Sub-District CSV Data</a></li>
			<?php
				}
		  		if($this->session->userdata('USER_GROUP') == 'A' or $this->session->userdata('USER_GROUP') == 'W'){?>
           			<li><a href="<?php echo base_url();?>admin/kalolsavam">Define Kalolsavam</a></li>
            <?php 
				}
			?>
            <li><a href="<?php echo base_url();?>login/change_password">Change Password</a></li>
        
        </ul>
      </li>
      <li class="menupop myaccount menu_border" onmouseover="show_menu(this)" onmouseout="hide_menu(this)"><a href="#"><span>Registrations</span></a>
        <ul style="left: 0px; display:none">
        	
            
          <?php if($this->session->userdata('USER_GROUP') == 'W'){?>
          	<li><a href="<?php echo base_url();?>user/admin_users">Admin Users</a></li>
          	<li><a href="<?php echo base_url();?>welcome/district_details">District List</a></li>
		  <?php }?>
          
          <?php
		  if($this->session->userdata('USER_GROUP') == 'A'){?>
         	 <li><a href="<?php echo base_url();?>user/user_registration">User Registration</a></li>
            <li><a href="<?php echo base_url();?>user/user_registration">User Registration</a></li>
          <?php }?>
          
          <?php if($this->session->userdata('USER_TYPE') == '2'){?>
          	<li><a href="<?php echo base_url();?>welcome/sub_district_details">Sub District List</a></li>
		  <?php }?>
          
          <?php if($this->Session_Model->check_user_permission(24) && $this->session->userdata('USER_GROUP') != 'W'){?>
          	<!--<li><a href="<?php echo base_url();?>user/user_cluster">Create Cluster</a></li>-->
            <li><a href="<?php echo base_url();?>welcome/cluster_details">Cluster School List</a></li>
		  <?php }?>
          
		  <?php
          if($this->Session_Model->check_user_permission(17) || $this->Session_Model->check_user_permission(2) || $this->Session_Model->check_user_permission(22)){?>
          	<li><a href="<?php echo base_url();?>schools/registration">School Entry</a></li>
		  <?php }?>
          
          <?php if($this->Session_Model->check_user_permission(23) || $this->Session_Model->check_user_permission(26)){?>
          	<li><a href="<?php echo base_url();?>schools/school_master">School Master</a></li>
		  <?php }?>
          
          
          <?php if($this->Session_Model->check_user_permission(20)){?>
          	<li><a href="<?php echo base_url();?>schools/special_order_entry">Special Order Entry</a></li>
		  <?php }?>
		  
          
		  <?php if($this->Session_Model->check_user_permission(3)){?>
		 <!-- <li><a href="<?php echo base_url();?>stage/allotment">Allotments</a></li>-->
		  <?php }?>
          
        </ul>
      </li>
      
      <li class="menupop myaccount menu_border" onmouseover="show_menu(this)" onmouseout="hide_menu(this)"><a href="#"><span>Stage</span></a>
        <ul style="left: 0px; display:none">
        	<?php if($this->Session_Model->check_user_permission(31)){?>
            <li><a href="<?php echo base_url();?>report/prereport/stageallot_duration" title="no. of Participant and duration...">Duration of Events(Festival)</a></li>
            <?php }?>
			<?php if($this->Session_Model->check_user_permission(19)){?>
            <li><a href="<?php echo base_url();?>stage/stage_details" title="Stage Master">Define Stage</a></li>
            <?php }?>
            <?php if($this->Session_Model->check_user_permission(3)){?>
            <li><a href="<?php echo base_url();?>stage/item_participant/participant_nodetails/" title="Stage Items">Stage allotment (Festivalwise)</a></li>
            <li><a href="<?php echo base_url();?>stage/allotment/" title="Stage Allotment">Stage Allotment</a></li>            
        	<?php }?>
        </ul>
     </li>
     
     <?php if ($this->General_Model->is_all_stage_alloted()){?>
      <li class="menupop myaccount menu_border" onmouseover="show_menu(this)" onmouseout="hide_menu(this)"><a href="#"><span>Pre Fest Report</span></a>
	  	<ul style="left: 0px; display:none">
			<?php if($this->Session_Model->check_user_permission(42)){?>
            <li><a href="<?php echo base_url();?>report/prereportpdf/eligible_school" target="_blank" title="Eligible Schools">Eligible School</a></li>
            <?php }?>
			<?php if($this->Session_Model->check_user_permission(27)){?>
            <li><a href="<?php echo base_url();?>report/prereport/list_school" title="List of participating schools with school code" >Participating Schools - Festival Wise</a></li>
            <li><a href="<?php echo base_url();?>report/prereportpdf/list_school_with_team/" title="School Contacts" target="_blank" >School Contacts</a></li>
			<?php }?>
            <!--<li><a href="<?php echo base_url();?>report/prereportpdf/schoolfestall" title="School details" target="_blank">Participating School(Complete)</a></li>-->
            <?php if($this->Session_Model->check_user_permission(29)){?>
            <li><a href="<?php echo base_url();?>report/prereport/itemwise_report_interface" title="Participants list item wise/All" >List of Participants - Item Wise</a></li>
            <?php }?>
            <?php if($this->Session_Model->check_user_permission(30)){?>
            <li><a href="<?php echo base_url();?>report/prereport/list_participants" title="Participant details school wise">List of Participants For Team Managers - schools</a></li>
            <?php }?>
            <?php if($this->Session_Model->check_user_permission(32)){?>
            <li><a href="<?php echo base_url();?>report/prereport/feedetails" title="Fee details for registration commitee">Fee Details of School For Registration</a></li>
            <?php }?>
            <?php if($this->Session_Model->check_user_permission(33)){?>
            <li><a href="<?php echo base_url();?>report/prereport/participant_cardindex" title="participant card">Participant Card (without photo)</a></li>
            <?php }?>
             <?php if($this->Session_Model->check_user_permission(33)){?>
            <li><a href="<?php echo base_url();?>report/prereport/participant_cardindex_photo" title="participant card">Participant Card (with photo)</a></li>
            <?php }?>            
            
            <?php if($this->Session_Model->check_user_permission(40)){?>
            <li><a href="<?php echo base_url();?>report/prereport/participant_limit_item_more" title="participant more than one item">Participants More than One Item</a></li>
            <li><a href="<?php echo base_url();?>report/prereport/team_list" title="Participants in Group Items">Team List</a></li>
            <?php }?>
            <?php if($this->Session_Model->check_user_permission(37)){?>
            <li><a href="<?php echo base_url();?>report/prereport/clashes_details_interface" title="clashes">Clash Report</a></li>
            <?php }?>
            <?php if($this->Session_Model->check_user_permission(38)){?>
            <li><a href="<?php echo base_url();?>report/prereport/clustor_report" title="cluster report">Cluster Report</a></li>
            <?php }?>
             <?php if($this->Session_Model->check_user_permission(39)){?>
            <li><a href="<?php echo base_url();?>report/prereport/stagereportdate" title="stage report">Stage Report</a></li>
            <?php }?>
            <?php if($this->Session_Model->check_user_permission(34)){?>            
            <li><a href="<?php echo base_url();?>report/prereport/callsheet_first" title="Call sheet">Call Sheet</a></li>
            <?php }?>
             <?php if($this->Session_Model->check_user_permission(41)){?>
            <li><a href="<?php echo base_url();?>report/prereport/timesheetinterface" title="Timesheet - Item Wise">Timesheet - Item Wise</a></li>
            <?php }?>
             <?php if($this->Session_Model->check_user_permission(35)){?> 
            <li><a href="<?php echo base_url();?>report/prereport/score_sheet_interfaces" title="score sheet">Score Sheet</a></li>
            <?php }?>  
            <?php if($this->Session_Model->check_user_permission(36)){?> 
            <li><a href="<?php echo base_url();?>report/prereport/tabulation_report_interface" title="Tabulation sheet">Tabulation Sheet</a></li>
            <?php }?>
            <?php if($this->Session_Model->check_user_permission(43)){?>       
            <li><a href="<?php echo base_url();?>report/prereport/appealed_part"  title="List of Participants by Appeal">List of Participants by Appeal</a></li>
			<?php }?>
            
			<?php if($this->Session_Model->check_user_permission(28)){?>
            <li><a href="<?php echo base_url();?>report/prereport/datewisepart" title="Date wise participants for press and food" >No. of Participants - Date Wise</a></li>
            <?php }?>
            
            
             <!--<li><a href="<?php echo base_url();?>report/prereport/team_manager_all" title="School details">List of Participants(complete)</a></li>-->
            
            
            <!--<li><a href="<?php echo base_url();?>report/prereportpdf/all_feedet_report_all" target="_blank" title="School details">Fee Details (complete)</a></li>-->
            
            
                     
            <!--<li><a href="<?php echo base_url();?>report/prereport/score_sheet_fest" title="score sheet">Score Sheet(Festival)</a></li>-->
            
            
            
            <!--<li><a href="<?php echo base_url();?>report/prereport/clustor_report_all" title="cluster report">Cluster Report(Festival)</a></li>-->
           
            <!--<li><a href="<?php echo base_url();?>report/prereport/stagereport_all" title="stage report">Stage Report(Festival)</a></li>-->
            
            <!--<li><a href="<?php echo base_url();?>report/prereport/participant_more_item" title="participant more than one item">Participants More than One Items(Festival)</a></li>-->
            
            
           
            
            
            <!--<li><a href="<?php echo base_url();?>report/prereport/appeal_courtorder"  title="Participant with court order">Participant with Court Order</a></li>-->
        </ul>
	  </li>
      
     
     
     
     <?php if($this->Session_Model->check_user_permission(12) or $this->Session_Model->check_user_permission(45) 
	 		or $this->Session_Model->check_user_permission(8)){?>
     <li class="menupop myaccount menu_border" onmouseover="show_menu(this)" onmouseout="hide_menu(this)"><a href="#"><span>Result</span></a>
        <ul style="left: 0px; display:none">
        	<?php if($this->Session_Model->check_user_permission(12)){?>
            <li><a href="<?php echo base_url();?>result/resultentry/" title="Result Entry">Result Entry</a></li>
			<li><a href="<?php echo base_url();?>result/resultentry/item_result_list/" title="Item Result List">Item Result List</a></li>
        	<?php }?>
			<?php if($this->Session_Model->check_user_permission(45)){?>
            <li><a href="<?php echo base_url();?>publishresult/resultindex/resultview/" title="Publish Result">Publish Result</a></li>
			<?php }?> 
            
             
        </ul>
     </li>
    
     <?php }?> 
     <?php if($this->Session_Model->check_user_permission(44) or $this->Session_Model->check_user_permission(46)){?> 
     <li class="menupop myaccount menu_border" onmouseover="show_menu(this)" onmouseout="hide_menu(this)"><a href="#"><span>Result Report</span></a>
        <ul style="left: 0px; display:none">
        	<?php if($this->Session_Model->check_user_permission(46)){?>
            <li><a href="<?php echo base_url();?>report/timefestreport/timefest_result_confidential/" title="Confidential Report">Confidential Result Report</a></li>
            <?php }?>
            <?php if($this->Session_Model->check_user_permission(44)){?>
            <li><a href="<?php echo base_url();?>report/afterresultreport/school_wise_result_interface"   title="Item Wise Point"> Item Wise Point  </a></li>
            <li><a href="<?php echo base_url();?>report/afterresultreportpdf/school_wise_result_all" target="_blank" title="school wise point">School Wise Point Report  </a></li>
            <!--<li><a href="<?php // echo base_url();?>report/resultindex/gradewise_interface"  title="Grade wise Result"> Grade Wise(School)  </a></li>-->
            <li><a href="<?php echo base_url();?>report/resultindex/rankwise_result" title="Rank wise Result">Rank Wise  </a></li>
        	<li><a href="<?php echo base_url();?>report/resultindex/gradewise_result" title="Grade wise Result">Grade Wise  </a></li>
         	<li><a href="<?php echo base_url();?>report/afterresultreportpdf/total_points" target="_blank" title="Full Result">All Result </a></li>
             <li><a href="<?php echo base_url();?>report/resultindex/report_press_timewise" target="_blank" title="Report for Press">Time wise Report</a></li>
       		<li><a href="<?php echo base_url();?>report/afterresultreport/status_of_kalolsavam_interface"  title="Kalolsavam Status">Status of Kalolsavam  </a></li>
        	<?php }?>
        </ul>
     </li>
     <?php }?> 
     
	  <!--<li class="menupop myaccount menu_border" onmouseover="show_menu(this)" onmouseout="hide_menu(this)"><a href="#"><span>Master Reports</span></a>
	  	<ul style="left: 0px; display:none">
			<li><a href="<?php echo base_url();?>report/masterreport/item_code" title="Item Code">Item Code</a></li>
		</ul>
	  </li>-->
     
      
        <?php if($this->Session_Model->check_user_permission(47) or $this->Session_Model->check_user_permission(48)){?>
		<li class="menupop myaccount menu_border" onmouseover="show_menu(this)" onmouseout="hide_menu(this)"><a href="#"><span>Certificate</span></a>
	  		<ul style="left: 0px; display:none">
            	<?php if($this->Session_Model->check_user_permission(47)){?>
                <li><a href="<?php echo base_url();?>certificate/certificate/" title="Certificate - Template" >Certificate - Template</a></li>
				<?php }?>
            	<?php if($this->Session_Model->check_user_permission(48) and $this->General_Model->is_certificate_template_set()){?>
                <li><a href="<?php echo base_url();?>certificate/certificate/list_item_wise" title="Certificate - Item Wise" >Certificate - Item Wise</a></li>
				<li><a href="<?php echo base_url();?>certificate/certificate/list_school_wise" title="Certificate - School Wise" >Certificate - School Wise</a></li>
				<li><a href="<?php echo base_url();?>certificate/certificate/list_reg_no_wise" title="Certificate - Regiser Number Wise" >Certificate - Reg No. Wise</a></li>
				<?php }?>
            </ul>
	  </li> 
	  <?php }?>
      <?php //if($this->General_Model->is_all_result_entered() and $this->Session_Model->check_user_permission(8)){?>
      <?php if($this->Session_Model->check_user_permission(8)){?>
      <li class="menupop myaccount menu_border" onmouseover="show_menu(this)" onmouseout="hide_menu(this)"><a href="#"><span>Export</span></a>
	  		<ul style="left: 0px; display:none">
            	<li><a href="<?php echo base_url();?>report/afterresultreport/higherlevel_result"  title="participant Eligible For Higher Level Competition">Higher Level Competition  </a></li>
				<li><a href="<?php echo base_url();?>export/export_district_data" title="Export Data for District Kalolsavam">Export Result Data</a></li>
            </ul>
	  </li>      
      <?php }?>
      <?php }//End of stage allot if clouse?>
       <li class="menupop myaccount menu_border" onmouseover="show_menu(this)" onmouseout="hide_menu(this)"><a href="#"><span>Downloads</span></a>
	  	<ul style="left: 0px; display:none">
			<li><a href="<?php echo base_url(false);?>doc/itemreport_pdf.pdf" title="Item Code" target="_blank">Item Code</a></li>
			<li><a href="<?php echo base_url(false);?>doc/kalolsavam.pdf" title="Manual" target="_blank">Kalolsavam Manual</a></li>
			<?php if($this->session->userdata('USER_TYPE') == '3'){?>
          	<li><a href="<?php echo base_url(false);?>doc/Guide_Subdistrict.pdf" target="_blank">User Guide</a></li>
            <li><a href="<?php echo base_url(false);?>doc/Guide_Subdistrict_revised.pdf" target="_blank">User Guide For Subdistrict Kalolsavam</a></li>
		    <?php }?>
            <?php if($this->session->userdata('USER_TYPE') == '5'){?>
          	<li><a href="<?php echo base_url(false);?>doc/Guide_Nodal_Centre.pdf" target="_blank">User Guide</a></li>
		    <?php }?>
            <!--<li><a href="<?php echo base_url(false);?>doc/Entry_Form.pdf" target="_blank">Entry Form</a></li>-->
        </ul>
	  </li>
      <li class="menupop myaccount menu_border" onmouseover="show_menu(this)" onmouseout="hide_menu(this)"><a href="#"><span>Upload Photos</span></a>      
      <ul style="left: 0px; display:none">
      <?php //if($this->session->userdata('USERID') != '5549'){  ?>
      <!-- <li><a href="<?php echo base_url();?>photos/photos/regnum_wise_photo_interface" title="Sub_dist Photo">Sub District Wise</a></li> -->
       <li><a href="<?php echo base_url();?>photos/photos/school_wise_photo_interface" title="School_Wise Photo">School Wise</a></li> 
       <li><a href="<?php echo base_url();?>photos/photos/regnum_wise_photo_interface" title="Individual Photo">Admission Number Wise</a></li> 
       <?php //}?>
        <!--<li><a href="<?php echo base_url(false);?>doc/Entry_Form.pdf" target="_blank">Entry Form</a></li>-->
      
      </ul>
      </li>
      
	   <li class="menu_border"><a href="<?php echo base_url();?>login/logout" title="Log out of this account">Logout</a></li>
    </ul>
  </div>
</div>
<div class="clear" style="height:5px;">&nbsp;</div> 
