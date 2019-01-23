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

	//shortcode
	function votacion_botons_cb( $atts ) {
		wp_enqueue_style('fontawasome');
		$vsettings = get_option("votacion_action");
		$post_id = get_the_ID();
		ob_start();
	?> 
	<style type="text/css">
		div.contenedor-botones{
			width:100%;
			padding:5px;
			overflow: hidden;
			height: auto;
		}
		a.btn-base{
			text-decoration: none;
			border:<?php echo $vsettings['votacion_grosor_borde_boton']."px solid ".$vsettings['votacion_color_borde_boton']; ?>!important;
			padding:<?php echo $vsettings['votacion_tamano_boton'] ?>px !important;
			display:block;
			border-radius: 10px;
			width: 100px;
			float:left;
			margin:5px;
			background: <?php echo $vsettings['votacion_color_fondo']; ?>;
			font-size: <?php echo $vsettings['votacion_tamano_icono']; ?>px !important;
		}
	</style>
	<div class="contenedor-botones">
		<a href="#" class="btn-base votacion_positiva"><i class="fa <?php echo $vsettings['votacion_icono_voto_positivo'] ?>"></i> 0</a>

		<a href="#" class="btn-base votacion_negativa"><i class="fa <?php echo $vsettings['votacion_icono_voto_negativo'] ?>"></i> 0</a>
	</div>
	<?php
	return ob_get_clean();
	}

	add_shortcode( 'votacion_botones', 'votacion_botons_cb' );