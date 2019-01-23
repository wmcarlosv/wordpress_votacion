<?php
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
		<a href="#" data-type="positiva" class="btn-base votacion_positiva"><i class="fa <?php echo $vsettings['votacion_icono_voto_positivo'] ?>"></i> 0</a>

		<a href="#" data-type="negativa" class="btn-base votacion_negativa"><i class="fa <?php echo $vsettings['votacion_icono_voto_negativo'] ?>"></i> 0</a>
	</div>
	<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery("a.btn-base").click(function(){

				var votacion_usuario = "Carlos Vargas";
				var votacion_tipo_votacion = jQuery(this).attr("data-type");
				var votacion_ip = "<?php echo getRealIpAddr(); ?>";
				var votacion_fecha = "<?php echo date('Y-m-d H:m:s'); ?>";
				var votacion_url_post = "<?php echo esc_url(get_permalink()); ?>";

				jQuery.post("<?php echo admin_url('admin-ajax.php'); ?>",{ action : 'add_votacion', 'votacion_usuario' : votacion_usuario, 'votacion_ip' : votacion_ip, 'votacion_fecha' : votacion_fecha, 'votacion_tipo_votacion' : votacion_tipo_votacion, 'votacion_url_post' : votacion_url_post  }, function( response ){
					console.log( response );
				});

			});
		});
	</script>
	<?php
	return ob_get_clean();
	}

	add_shortcode( 'votacion_botones', 'votacion_botons_cb' );