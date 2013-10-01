<?php
 //echo base_url()."index.php/welcome/admin_details";
	error_reporting ( E_ALL );

	if($this->session->userdata('USER_TYPE')==1){
	
	$menu = array 
	(
	
		1 => 	array 
				(
					'text'		=> 	'Home',
					'class'		=> 	'articles',
					'link'		=> 	base_url().'index.php/welcome/home',
					'show_condition'=>	TRUE,
					'parent'	=>	0
				),
				
		2 => 	array 
				(
					'text'		=> 	'District list',
					'class'		=> 	'articles',
					'link'		=> 	base_url().'index.php/welcome/admin_details',
					'show_condition'=>	TRUE,
					'parent'	=>	0
				),
				
		3 =>	array
				(
					'text'		=> 	'Registration',
					'class'		=> 	'users',
					'link'		=> 	'#',
					'show_condition'=>	TRUE,
					'parent'	=>	0
				),		
		4 =>	array
				(
					'text'		=> 	'School Master',
					'class'		=> 	'users',
					'link'		=> 	base_url().'index.php/school/school_master',
					'show_condition'=>	TRUE,
					'parent'	=>	3
				),
		
		5 =>	array
				(
					'text'		=> 	'Users',
					'class'		=> 	'users',
					'link'		=> 	base_url().'index.php/admin/admin/user_creation',
					'show_condition'=>	TRUE,
					'parent'	=>	3
				),
				
				
		6 => 	array 
				(
					'text'		=> 	'Downloads',
					'class'		=> 	'articles',
					'link'		=> 	'#',
					'show_condition'=>	TRUE,
					'parent'	=>	0
				),
				
		7 =>	array
				(
					'text'		=> 	'Item Codes Science Fair',
					'class'		=> 	'categories',
					'link'		=> 	base_url().'index.php/downloads/item_details/1',
					'show_condition'=>	TRUE,
					'parent'	=>	6
				),	
		8 =>	array
				(
					'text'		=> 	'Item Codes Mathematics Fair',
					'class'		=> 	'categories',
					'link'		=> 	base_url().'index.php/downloads/item_details/2',
					'show_condition'=>	TRUE,
					'parent'	=>	6
				),	
		9 =>	array
				(
					'text'		=> 	'Item Codes Social science Fair',
					'class'		=> 	'categories',
					'link'		=> 	base_url().'index.php/downloads/item_details/3',
					'show_condition'=>	TRUE,
					'parent'	=>	6
				),	
		10 =>	array
				(
					'text'		=> 	'Item Codes Work experience Fair',
					'class'		=> 	'categories',
					'link'		=> 	base_url().'index.php/downloads/item_details/4',
					'show_condition'=>	TRUE,
					'parent'	=>	6
				),	
		11 =>	array
				(
					'text'		=> 	'Item Codes IT Fair',
					'class'		=> 	'categories',
					'link'		=> 	base_url().'index.php/downloads/item_details/5',
					'show_condition'=>	TRUE,
					'parent'	=>	6
				),	
				
		12 =>	array
				(
					'text'		=> 	'Change Password',
					'class'		=> 	'password',
					'link'		=> 	base_url().'index.php/welcome/change_password_afterlogin',
					'show_condition'=>	TRUE,
					'parent'	=>	0
				),	
		13 =>	array
				(
					'text'		=> 	'Logout',
					'class'		=> 	'password',
					'link'		=> 	base_url().'index.php/welcome/logout',
					'show_condition'=>	TRUE,
					'parent'	=>	0
				)
				
		);	}	
				
		
				
	if($this->session->userdata('USER_TYPE')==2){
	
	$menu = array 
	(
	
		1 => 	array 
				(
					'text'		=> 	'Home',
					'class'		=> 	'articles',
					'link'		=> 	base_url().'index.php/welcome/home',
					'show_condition'=>	TRUE,
					'parent'	=>	0
				),
				
		2 => 	array 
				(
					'text'		=> 	'Sub District List',
					'class'		=> 	'articles',
					'link'		=> 	base_url().'index.php/welcome/district_details',
					'show_condition'=>	TRUE,
					'parent'	=>	0
				),
				
		3 =>	array
				(
					'text'		=> 	'Registration',
					'class'		=> 	'users',
					'link'		=> 	'#',
					'show_condition'=>	TRUE,
					'parent'	=>	0
				),		
		4 =>	array
				(
					'text'		=> 	'School Master',
					'class'		=> 	'users',
					'link'		=> 	base_url().'index.php/school/school_master',
					'show_condition'=>	TRUE,
					'parent'	=>	3
				),
		
		5 =>	array
				(
					'text'		=> 	'Users',
					'class'		=> 	'users',
					'link'		=> 	base_url().'index.php/admin/admin/user_creation',
					'show_condition'=>	TRUE,
					'parent'	=>	3
				),
				
				
		6 => 	array 
				(
					'text'		=> 	'Downloads',
					'class'		=> 	'articles',
					'link'		=> 	'#',
					'show_condition'=>	TRUE,
					'parent'	=>	0
				),
				
		7 =>	array
				(
					'text'		=> 	'Item Codes Science Fair',
					'class'		=> 	'categories',
					'link'		=> 	base_url().'index.php/downloads/item_details/1',
					'show_condition'=>	TRUE,
					'parent'	=>	6
				),	
		8 =>	array
				(
					'text'		=> 	'Item Codes Mathematics Fair',
					'class'		=> 	'categories',
					'link'		=> 	base_url().'index.php/downloads/item_details/2',
					'show_condition'=>	TRUE,
					'parent'	=>	6
				),	
		9 =>	array
				(
					'text'		=> 	'Item Codes Social science Fair',
					'class'		=> 	'categories',
					'link'		=> 	base_url().'index.php/downloads/item_details/3',
					'show_condition'=>	TRUE,
					'parent'	=>	6
				),	
		10 =>	array
				(
					'text'		=> 	'Item Codes Work experience Fair',
					'class'		=> 	'categories',
					'link'		=> 	base_url().'index.php/downloads/item_details/4',
					'show_condition'=>	TRUE,
					'parent'	=>	6
				),	
		11 =>	array
				(
					'text'		=> 	'Item Codes IT Fair',
					'class'		=> 	'categories',
					'link'		=> 	base_url().'index.php/downloads/item_details/5',
					'show_condition'=>	TRUE,
					'parent'	=>	6
				),	
				
		12 =>	array
				(
					'text'		=> 	'Change Password',
					'class'		=> 	'password',
					'link'		=> 	base_url().'index.php/welcome/change_password_afterlogin',
					'show_condition'=>	TRUE,
					'parent'	=>	0
				),	
		13 =>	array
				(
					'text'		=> 	'Logout',
					'class'		=> 	'password',
					'link'		=> 	base_url().'index.php/welcome/logout',
					'show_condition'=>	TRUE,
					'parent'	=>	0
				)
				
		);	}	
		
		
		if($this->session->userdata('USER_TYPE')==4){
	
	$menu = array 
	(
	
		1 => 	array 
				(
					'text'		=> 	'Home',
					'class'		=> 	'articles',
					'link'		=> 	base_url().'index.php/welcome/home',
					'show_condition'=>	TRUE,
					'parent'	=>	0
				),
				
						
		2 =>	array
				(
					'text'		=> 	'Registration',
					'class'		=> 	'users',
					'link'		=> 	'#',
					'show_condition'=>	TRUE,
					'parent'	=>	0
				),		
		3 =>	array
				(
					'text'		=> 	'Cluster Creation',
					'class'		=> 	'users',
					'link'		=> 	base_url().'index.php/admin/user_cluster/cluster_creation',
					'show_condition'=>	TRUE,
					'parent'	=>	2
				),
			
				
				
		4 => 	array 
				(
					'text'		=> 	'Downloads',
					'class'		=> 	'articles',
					'link'		=> 	'#',
					'show_condition'=>	TRUE,
					'parent'	=>	0
				),
				
		5 =>	array
				(
					'text'		=> 	'Item Codes Science Fair',
					'class'		=> 	'categories',
					'link'		=> 	base_url().'index.php/downloads/item_details/1',
					'show_condition'=>	TRUE,
					'parent'	=>	4
				),	
		6 =>	array
				(
					'text'		=> 	'Item Codes Mathematics Fair',
					'class'		=> 	'categories',
					'link'		=> 	base_url().'index.php/downloads/item_details/2',
					'show_condition'=>	TRUE,
					'parent'	=>	4
				),	
		7 =>	array
				(
					'text'		=> 	'Item Codes Social science Fair',
					'class'		=> 	'categories',
					'link'		=> 	base_url().'index.php/downloads/item_details/3',
					'show_condition'=>	TRUE,
					'parent'	=>	4
				),	
		8 =>	array
				(
					'text'		=> 	'Item Codes Work experience Fair',
					'class'		=> 	'categories',
					'link'		=> 	base_url().'index.php/downloads/item_details/4',
					'show_condition'=>	TRUE,
					'parent'	=>	4
				),	
		9 =>	array
				(
					'text'		=> 	'Item Codes IT Fair',
					'class'		=> 	'categories',
					'link'		=> 	base_url().'index.php/downloads/item_details/5',
					'show_condition'=>	TRUE,
					'parent'	=>	4
				),	
				
		10 =>	array
				(
					'text'		=> 	'Change Password',
					'class'		=> 	'password',
					'link'		=> 	base_url().'index.php/welcome/change_password_afterlogin',
					'show_condition'=>	TRUE,
					'parent'	=>	0
				),	
		11 =>	array
				(
					'text'		=> 	'Logout',
					'class'		=> 	'password',
					'link'		=> 	base_url().'index.php/welcome/logout',
					'show_condition'=>	TRUE,
					'parent'	=>	0
				)
				
		);	}	
	    
			
			
		if($this->session->userdata('USER_TYPE')==5){
	
	$menu = array 
	(
	
		1 => 	array 
				(
					'text'		=> 	'Home',
					'class'		=> 	'articles',
					'link'		=> 	base_url().'index.php/welcome/home',
					'show_condition'=>	TRUE,
					'parent'	=>	0
				),
								
		2 => 	array 
				(
					'text'		=> 	'Downloads',
					'class'		=> 	'articles',
					'link'		=> 	'#',
					'show_condition'=>	TRUE,
					'parent'	=>	0
				),
				
		3 =>	array
				(
					'text'		=> 	'Item Codes Science Fair',
					'class'		=> 	'categories',
					'link'		=> 	base_url().'index.php/downloads/item_details/1',
					'show_condition'=>	TRUE,
					'parent'	=>	2
				),	
		4 =>	array
				(
					'text'		=> 	'Item Codes Mathematics Fair',
					'class'		=> 	'categories',
					'link'		=> 	base_url().'index.php/downloads/item_details/2',
					'show_condition'=>	TRUE,
					'parent'	=>	2
				),	
		5 =>	array
				(
					'text'		=> 	'Item Codes Social science Fair',
					'class'		=> 	'categories',
					'link'		=> 	base_url().'index.php/downloads/item_details/3',
					'show_condition'=>	TRUE,
					'parent'	=>	2
				),	
		6 =>	array
				(
					'text'		=> 	'Item Codes Work experience Fair',
					'class'		=> 	'categories',
					'link'		=> 	base_url().'index.php/downloads/item_details/4',
					'show_condition'=>	TRUE,
					'parent'	=>	2
				),	
		7 =>	array
				(
					'text'		=> 	'Item Codes IT Fair',
					'class'		=> 	'categories',
					'link'		=> 	base_url().'index.php/downloads/item_details/5',
					'show_condition'=>	TRUE,
					'parent'	=>	2
				),	
				
		8 =>	array
				(
					'text'		=> 	'Change Password',
					'class'		=> 	'password',
					'link'		=> 	base_url().'index.php/welcome/change_password_afterlogin',
					'show_condition'=>	TRUE,
					'parent'	=>	0
				),	
		9 =>	array
				(
					'text'		=> 	'Logout',
					'class'		=> 	'password',
					'link'		=> 	base_url().'index.php/welcome/logout',
					'show_condition'=>	TRUE,
					'parent'	=>	0
				)
				
		);	}		
		/*3 =>	array
				(
					'text'		=> 	'Groups',
					'class'		=> 	'groups',
					'link'		=> 	'#',
					'show_condition'=>	TRUE,
					'parent'	=>	0
				),
		4 =>	array
				(
					'text'		=> 	'Settings',
					'class'		=> 	'settings',
					'link'		=> 	'#',
					'show_condition'=>	TRUE,
					'parent'	=>	0
				),
		5 =>	array
				(
					'text'		=> 	'Add new',
					'class'		=> 	'add_article',
					'link'		=> 	'#',
					'show_condition'=>	TRUE,
					'parent'	=>	1
				),
		6 =>	array
				(
					'text'		=> 	'Categories',
					'class'		=> 	'categories',
					'link'		=> 	'#',
					'show_condition'=>	TRUE,
					'parent'	=>	2
				),
		7 =>	array
				(
					'text'		=> 	'Add new',
					'class'		=> 	'add_user',
					'link'		=> 	'#',
					'show_condition'=>	TRUE,
					'parent'	=>	2
				),
		8 =>	array
				(
					'text'		=> 	'Delete',
					'class'		=> 	'delete',
					'link'		=> 	'#',
					'show_condition'=>	TRUE,
					'parent'	=>	1
				),
		9 =>	array
				(
					'text'		=> 	'Show',
					'class'		=> 	'show',
					'link'		=> 	'#',
					'show_condition'=>	TRUE,
					'parent'	=>	2
				),
		10 =>	array
				(
					'text'		=> 	'Last created',
					'class'		=> 	'last',
					'link'		=> 	'#',
					'show_condition'=>	TRUE,
					'parent'	=>	9
				),
		11 =>	array
				(
					'text'		=> 	'First created',
					'class'		=> 	'first',
					'link'		=> 	'#',
					'show_condition'=>	TRUE,
					'parent'	=>	9
				),
		12 =>	array
				(
					'text'		=> 	'All',
					'class'		=> 	'all',
					'link'		=> 	'#',
					'show_condition'=>	TRUE,
					'parent'	=>	9
				),
		13 =>	array
				(
					'text'		=> 	'None',
					'class'		=> 	'none',
					'link'		=> 	'#',
					'show_condition'=>	TRUE,
					'parent'	=>	9
				)*/
		
	

	function build_menu ( $menu )
	{
		$out = '<div class="container4">' . "\n";
		$out .= '	<div class="menu4">' . "\n";
		$out .= "\n".'<ul>' . "\n";
		
		for ( $i = 1; $i <= count ( $menu ); $i++ )
		{
			if ( is_array ( $menu [ $i ] ) ) {//must be by construction but let's keep the errors home
				if ( $menu [ $i ] [ 'show_condition' ] && $menu [ $i ] [ 'parent' ] == 0 ) {//are we allowed to see this menu?
					$out .= '<li class="' . $menu [ $i ] [ 'class' ] . '"><a href="' . $menu [ $i ] [ 'link' ] . '">';
					$out .= $menu [ $i ] [ 'text' ];
					$out .= '</a>';
					$out .= get_childs ( $menu, $i );
					$out .= '</li>' . "\n";
				}
			}
			else {
				die ( sprintf ( 'menu nr %s must be an array', $i ) );
			}
		}
		
		$out .= '</ul>'."\n";
		$out .= "\n\t" . '</div>';
		return $out . "\n\t" . '</div>';
	}
	
	function get_childs ( $menu, $el_id )
	{
		$has_subcats = FALSE;
		$out = '';
		$out .= "\n".'	<ul>' . "\n";
		for ( $i = 1; $i <= count ( $menu ); $i++ )
		{
			if ( $menu [ $i ] [ 'show_condition' ] && $menu [ $i ] [ 'parent' ] == $el_id ) {//are we allowed to see this menu?
				$has_subcats = TRUE;
				$add_class = ( get_childs ( $menu, $i ) != FALSE ) ? ' subsubl' : '';
				$out .= '		<li class="' . $menu [ $i ] [ 'class' ] . $add_class . '"><a href="' . $menu [ $i ] [ 'link' ] . '">';
				$out .= $menu [ $i ] [ 'text' ];
				$out .= '</a>';
				$out .= get_childs ( $menu, $i );
				$out .= '</li>' . "\n";
			}
		}
		$out .= '	</ul>'."\n";
		return ( $has_subcats ) ? $out : FALSE;
	}

?>	

	<div style="width:1000px;margin:0px auto">
		

		<?= build_menu ( $menu ) ?>

	</div>



























<!--<ul class="menub">
	<li ><a href="<?php echo base_url();?>index.php/welcome/home"><b>Home</b></a></li>
    
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
    <?php }?>
	<li><a href="#"><b>Downloads</b></a>
       <ul>
         <li><a target="_blank" href="<?php echo base_url().'index.php/downloads/item_details/1';?>"><b>Item Codes Science Fair</b></a></li>	
         <li><a target="_blank" href="<?php echo base_url().'index.php/downloads/item_details/2';?>"><b>Item Codes Mathematics Fair</b></a></li>
         <li><a target="_blank" href="<?php echo base_url().'index.php/downloads/item_details/3';?>"><b>Item Codes Social science Fair</b></a></li>
         <li><a target="_blank" href="<?php echo base_url().'index.php/downloads/item_details/4';?>"><b>Item Codes Work Experience Fair</b></a></li>
         <li><a target="_blank" href="<?php echo base_url().'index.php/downloads/item_details/5';?>"><b>Item Codes IT Mela Fair</b></a></li>	
         <li><a target="_blank" href="../../sciencefair_manual.pdf"><b>Science Fair manual</b></a></li>
       </ul>
     </li>		  
    <li><a href="<?php echo base_url().'index.php/welcome/change_password_afterlogin';?>"><b>Change Password</b></a></li>	
	<li><a href="<?php echo base_url();?>index.php/welcome/logout"><b>Logout</b></a></li>			
</ul>-->