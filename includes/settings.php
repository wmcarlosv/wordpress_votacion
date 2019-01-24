<?php
	
	add_action( 'admin_menu', 'register_menu_votaciones' );
	function register_menu_votaciones() {
	  	add_menu_page(
	  		'Votacion Settings', 
	  		'Votacion Settings', 
	  		'manage_options', 
	  		'votacion_settings', 
	  		'est_callback', 
	  		'dashicons-admin-generic', 
	  		90);

	}
	//--Dashboard
	function est_callback()
	{
		wp_enqueue_style('fontawasome');
		$url = EST_DIR_PATH.'includes/admin/views/view_settings.php';
		require_once $url;
	}
