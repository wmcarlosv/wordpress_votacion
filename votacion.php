<?php

/**
 * Plugin Name: Votacion
 * Plugin URI:  
 * Description: 
 * Version:     1.0
 * Author:      FamilyDev
 * Author URI:  https://www.familydev.com.ve/
 * Text Domain:	est
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Domain Path: /languages
 * 
 * */

define('EST_DIR_PATH', plugin_dir_path(__FILE__));
define('EST_DIR_URL', plugin_dir_url(__FILE__));
	class CDS_SC{
		public function __construct()
		{
			add_action('admin_enqueue_scripts',array($this,'est_register_scripts'));
			add_action('wp_enqueue_scripts',array($this,'est_register_scripts'));
			$this->includes();	
		}
		//funcion para registrar todos los scripts
		public static function est_register_scripts()
		{
			wp_register_style('style.css',EST_DIR_URL.'assets/css/style.css');
			wp_register_style('sweetalertcss',EST_DIR_URL.'assets/css/sweetalert.min.css');
			wp_register_style('fontawasome','https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css');
			wp_register_script('blockui',EST_DIR_URL.'assets/js/jquery.blockUI.js',array('jquery'));
			wp_register_script('sweetalertjs',EST_DIR_URL.'assets/js/sweetalert.js',array('jquery'));
			wp_register_script('jqueryui.js',EST_DIR_URL.'assets/js/jquery-ui.js',array('jquery','sweetalertjs','blockui'));
			wp_register_script('validate.js',EST_DIR_URL.'assets/js/validate.js',array('jquery','sweetalertjs','blockui'));
		}
		public function includes()
		{
		

			//ARCHIVO PARA MANIPULACION DE TABLAS EN LA BASE DE DATOS
			require_once EST_DIR_PATH.'includes/functions.php';
			//postypes
			require_once EST_DIR_PATH.'includes/postype/postype.php';
			//settings
			require_once EST_DIR_PATH.'includes/settings.php';
		
		}	
	}
new CDS_SC();