<?php
	//shortcode
	function votacion_botons_cb( $atts ) {

		wp_enqueue_style('fontawasome');
		$vsettings = get_option("votacion_action");
		$post_id = get_the_ID();
		$positivas = 0;
		$negativas = 0;
		//Votaciones Realizadas
		$args = array(
			'post_type'=>'votaciones',
			'post_status'=>'publish',
			'orderby' => 'date',
            'order'   => 'DESC',
			'posts_per_page'=>-1
		);

		$votaciones = get_posts($args);
		//Validar Ip
		$ip_actual = getRealIpAddr();
		$fecha_hora_actual = new DateTime(date("Y-m-d H:m:s"));
		$cont_s = 0;
		$fecha_hora_ultimo_voto = "";
		$tipo_ultimo_voto = "";
		$puede_votar = true;

		//End validar IP
		foreach($votaciones as $key => $value)
		{
			$data = get_post_meta($votaciones[$key]->ID,'pm_votacion_estadistic', true);
			if($data['votacion_tipo_votacion'] == "positiva"){
				$positivas+=1;
			}else{
				$negativas+=1;
			}

			if($data['votacion_ip'] == $ip_actual){
				$cont_s++;
			}

			if($cont_s == 1){
				$fecha_hora_ultimo_voto = $data['votacion_fecha'];
				$tipo_ultimo_voto = $data['votacion_tipo_votacion'];
			}
		}

		$diferencia = $fecha_hora_actual->diff(new DateTime($fecha_hora_ultimo_voto));

		if($diferencia->h <= $vsettings['votacion_recurrencia_votos']){
			$puede_votar = false;
		}

		ob_start();
	?> 
	<style type="text/css">
		a{
			margin:0px !important;
			padding:0px !important;
		}
		

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
			margin:5px !important;
			background: <?php echo $vsettings['votacion_color_fondo']; ?>;
			font-size: <?php echo $vsettings['votacion_tamano_icono']; ?>px !important;
		}
	</style>
	<div class="contenedor-botones">
		<a href="#" data-type="positiva" class="btn-base votacion_positiva"><i class="fa <?php echo $vsettings['votacion_icono_voto_positivo'] ?>"></i> <b id="v_positivas"><?php echo $positivas; ?></b></a>

		<a href="#" data-type="negativa" class="btn-base votacion_negativa"><i class="fa <?php echo $vsettings['votacion_icono_voto_negativo'] ?>"></i> <b id="v_negativas"><?php echo $negativas; ?></b></a>
	</div>
	<script type="text/javascript">
		jQuery(document).ready(function(){
			<?php if($tipo_ultimo_voto == "positiva"){ ?>

				jQuery("a.votacion_positiva").css("background","<?php echo $vsettings['votacion_color_despues_votar']; ?>");

			<?php } else if($tipo_ultimo_voto == "negativa") { ?>
				jQuery("a.votacion_negativa").css("background","<?php echo $vsettings['votacion_color_despues_votar']; ?>");

			<?php }else{ ?>

				jQuery("a.btn-base").click(function(){
					var votacion_tipo_votacion = jQuery(this).attr("data-type");
					var votacion_ip = "<?php echo getRealIpAddr(); ?>";
					var votacion_fecha = "<?php echo date('Y-m-d H:m:s'); ?>";
					var votacion_url_post = "<?php echo esc_url(get_permalink()); ?>";

					jQuery.post("<?php echo admin_url('admin-ajax.php'); ?>",{ action : 'add_votacion','votacion_ip' : votacion_ip, 'votacion_fecha' : votacion_fecha, 'votacion_tipo_votacion' : votacion_tipo_votacion, 'votacion_url_post' : votacion_url_post  }, function( response ){
						var data = JSON.parse(response);
						jQuery("#v_positivas").html(data.positivos);
						jQuery("#v_negativas").html(data.negativos);
					});

					jQuery(this).css("background","<?php echo $vsettings['votacion_color_despues_votar']; ?>");
				});
				
			<?php } ?>				
		});
	</script>
	<?php
	return ob_get_clean();
	}

	add_shortcode( 'votacion_botones', 'votacion_botons_cb' );