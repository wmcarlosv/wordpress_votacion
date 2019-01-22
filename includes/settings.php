<?php
	
	add_action( 'admin_menu', 'register_menu_security_sns' );
	function register_menu_security_sns() {
	  	add_menu_page(
	  		'Votacion Settings', 
	  		'Votacion Settings', 
	  		'manage_options', 
	  		'votacion_settings', 
	  		'est_callback', 
	  		'dashicons-welcome-widgets-menus', 
	  		90);

	}
	//--Dashboard
	function est_callback()
	{
		$url = EST_DIR_PATH.'includes/admin/views/view_settings.php';
		require_once $url;
	}
