<div id="header_bar">
  <div class="quicklinks">
    <ul>
       <li class="menupop myaccount menu_border" onmouseover="show_menu(this)" onmouseout="hide_menu(this)"><a href="<?php echo base_url();?>index.php/welcome/home" title="Home">Home</a>
      	<ul style="left: 0px; display:none">
        <?
      if($this->session->userdata('USER_GROUP') == 'A' && $this->session->userdata('USER_TYPE') == 3  && !is_import_data_finish ($this->session->userdata('SUB_DISTRICT'))){?>
					<li><a href="<?php echo base_url();?>import/import_data">Import CSV Data</a></li>                   
			<?php 
			} 
				
				?>
        
        
        
        
            <li><a href="<?php echo base_url().'index.php/welcome/change_password_afterlogin';?>"><b>Change Password</b></a></li>
        </ul>
      </li>
      <li class="menupop myaccount menu_border" onmouseover="show_menu(this)" onmouseout="hide_menu(this)"><a href="#"><span>Registrations</span></a>
        <ul style="left: 0px; display:none">
        	
                
        <?php if($this->session->userdata('USER_TYPE')==1){ ?>
        <li><a href="<?php echo base_url();?>index.php/welcome/admin_details"><b>District List</b></a></li>	
        <?php }?>
         <?php if($this->session->userdata('USER_TYPE')==2){ ?>
        <li><a href="<?php echo base_url();?>index.php/welcome/district_details"><b>Sub District List</b></a></li>	
        <?php }?>
        <?php if(($this->session->userdata('USER_TYPE')==2) || ($this->session->userdata('USER_TYPE')==1)){ ?>
        <li><a href="<?php echo base_url();?>index.php/school/school_master"><b>School Master</b></a></li>
        <?php }?>
        <?php if($this->session->userdata('USER_TYPE')==4){ ?>
        <li><a href="<?php echo base_url();?>index.php/admin/user_cluster/cluster_creation"><b>Create Cluster</b></a></li>
     	
        <?php }?>
        <?php if($this->session->userdata('USER_TYPE')==1){ ?>
        <li><a href="<?php echo base_url();?>index.php/admin/admin/user_creation" title="user creation"><b>Create / View users</b></a></li>
         <li><a href="<?php echo base_url();?>index.php/user/user_registration">User Registration</a></li>
        <?php }?>
              
        </ul>
      </li>
	  
      <li class="menupop myaccount menu_border" onmouseover="show_menu(this)" onmouseout="hide_menu(this)"><a href="#"><span>Downloads</span></a>
	  	<ul style="left: 0px; display:none">
			<li><a target="_blank" href="<?php echo base_url().'index.php/downloads/item_details/1';?>"><b>Item Codes Science Fair</b></a></li>	
         	<li><a target="_blank" href="<?php echo base_url().'index.php/downloads/item_details/2';?>"><b>Item Codes Mathematics Fair</b></a></li>
        	 <li><a target="_blank" href="<?php echo base_url().'index.php/downloads/item_details/3';?>"><b>Item Codes Social science Fair</b></a></li>
         	<li><a target="_blank" href="<?php echo base_url().'index.php/downloads/item_details/4';?>"><b>Item Codes Work Experience Fair</b></a></li>
        	 <li><a target="_blank" href="<?php echo base_url().'index.php/downloads/item_details/5';?>"><b>Item Codes IT Mela Fair</b></a></li>	
        	 <li><a target="_blank" href="../../sciencefair_manual.pdf"><b>Science Fair manual</b></a></li>
        </ul>
	  </li>
              
            
      <li class="menu_border"><a href="<?php echo base_url();?>index.php/welcome/logout"><b>Logout</b></a></li>
    </ul>
  </div>
</div>
<div class="clear" style="height:5px;">&nbsp;</div> 
