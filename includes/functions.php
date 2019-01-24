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

	//Registrar el Voto
	add_action('wp_ajax_add_votacion', 'add_votacion_cb' ); // executed when logged in
	add_action('wp_ajax_nopriv_add_votacion', 'add_votacion_cb' ); // executed when logged out

	function add_votacion_cb(){
		$args = array
		(
			'post_type'=>'votaciones',
			'post_title'=>'votacion de => '.getRealIpAddr(),
			'post_status'=>'publish',
			'post_content'=>''
		);

		$idpost = wp_insert_post($args);

		//con la id obtenida registras los meta
		update_post_meta($idpost,'pm_votacion_estadistic',$_POST);

		//Votaciones Realizadas
		$positivas = 0;
		$negativas = 0;
		$args = array(
			'post_type'=>'votaciones',
			'post_status'=>'publish',
			'posts_per_page'=>-1
		);

		$votaciones = get_posts($args);

		foreach($votaciones as $key => $value)
		{
			$data = get_post_meta($votaciones[$key]->ID,'pm_votacion_estadistic', true);
			if($data['id_post']==$_POST['id_post']){
			
				if($data['votacion_tipo_votacion'] == "positiva"){
					$positivas+=1;
				}else{
					$negativas+=1;
				}
			}
		}

		print json_encode(['positivos' => $positivas, 'negativos' => $negativas]);

		wp_die();
	}

	function getRealIpAddr()
	{
	    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
	    {
	      $ip=$_SERVER['HTTP_CLIENT_IP'];
	    }
	    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
	    {
	      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	    }
	    else
	    {
	      $ip=$_SERVER['REMOTE_ADDR'];
	    }
	    return $ip;
	}