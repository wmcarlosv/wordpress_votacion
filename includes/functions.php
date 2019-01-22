<?php

	//--ACCIONES Y FILTROS PARA USAR EN EL SISTEMA EN ESTA PAGINA DE FUNCIONES
	add_action('admin_post_votacion_settings_action','votacion_action_action_callback');
	add_action('admin_post_nopriv_votacion_settings_action','votacion_action_action_callback');
	function votacion_action_action_callback()
	{
		//guardaremos las opciones
		update_option('votacion_action',$_POST);
		wp_redirect('admin.php?page=votacion_settings&update=yes');
	}
	//cierre de la guardada de datos