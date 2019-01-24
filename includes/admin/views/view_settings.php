<?php
	$est = get_option('votacion_action',true);
	if(count($est) > 0){
		$votacion_tamano_boton = (isset($est['votacion_tamano_boton']) and !empty($est['votacion_tamano_boton']) ) ? $est['votacion_tamano_boton'] : "";

		$votacion_tamano_icono = (isset($est['votacion_tamano_icono']) and !empty($est['votacion_tamano_icono']) ) ? $est['votacion_tamano_icono'] : "";

		$votacion_color_fondo = (isset($est['votacion_color_fondo']) and !empty($est['votacion_color_fondo']) ) ? $est['votacion_color_fondo'] : "";

		$votacion_color_despues_votar = (isset($est['votacion_color_despues_votar']) and !empty($est['votacion_color_despues_votar']) ) ? $est['votacion_color_despues_votar'] : "";
		$votacion_color_fuente = (isset($est['votacion_color_fuente']) and !empty($est['votacion_color_fuente']) ) ? $est['votacion_color_fuente'] : "";

		$votacion_color_fuente_despues_votar = (isset($est['votacion_color_fuente_despues_votar']) and !empty($est['votacion_color_fuente_despues_votar']) ) ? $est['votacion_color_fuente_despues_votar'] : "";

		$votacion_color_borde_boton = (isset($est['votacion_color_borde_boton']) and !empty($est['votacion_color_borde_boton']) ) ? $est['votacion_color_borde_boton'] : "";

		$votacion_grosor_borde_boton = (isset($est['votacion_grosor_borde_boton']) and !empty($est['votacion_grosor_borde_boton']) ) ? $est['votacion_grosor_borde_boton'] : "";

		$votacion_recurrencia_votos = (isset($est['votacion_recurrencia_votos']) and !empty($est['votacion_recurrencia_votos']) ) ? $est['votacion_recurrencia_votos'] : "";

		$votacion_icono_voto_positivo = (isset($est['votacion_icono_voto_positivo']) and !empty($est['votacion_icono_voto_positivo']) ) ? $est['votacion_icono_voto_positivo'] : "";

		$votacion_icono_voto_negativo = (isset($est['votacion_icono_voto_negativo']) and !empty($est['votacion_icono_voto_negativo']) ) ? $est['votacion_icono_voto_negativo'] : "";
		
	}
?>
<style type="text/css">
	table{
		margin:20px auto;
		width: 50%;
		border:2px solid #ccc;
		padding: 5px;
		border-radius: 5px;
	}

	select{
		font-family: 'FontAwesome', 'Second Font name';
	}

	table tr td{
		padding:5px;
		text-align: center;
	}

	table tr td input, table tr td select{
		width: 100%;
	}
</style>
<form action="<?php echo admin_url('admin-post.php'); ?>" method="POST">
<table>
	<caption>
	<p><b style="color:red">Nota:</b> <span> Es necesario pegar el siguiente shortcode [votacion_botones] en cualquier parte de la pagina  para visualizar los botones de votacion</span></p>
	</caption>
	<input type="hidden" name="action" value="votacion_settings_action">
	<tr>
		<td colspan="2">
			<h3>Configuraci&oacute;n de los Botones</h3>
		</td>
	</tr>
	<tr>
		<td>Tama&ntilde;o Boton:</td>
		<td><input type="number" value="<?php echo $votacion_tamano_boton; ?>" name="votacion_tamano_boton"></td>
	</tr>
	<tr>
		<td>Tama&ntilde;o Icono:</td>
		<td><input type="number" value="<?php echo $votacion_tamano_icono; ?>" name="votacion_tamano_icono"></td>
	</tr>
	<tr>
		<td>Color de Fondo:</td>
		<td><input type="color" value="<?php echo $votacion_color_fondo; ?>" name="votacion_color_fondo"></td>
	</tr>
	<tr>
		<td>Color despues de Votar:</td>
		<td><input type="color" value="<?php echo $votacion_color_despues_votar; ?>" name="votacion_color_despues_votar"></td>
	</tr>
	<tr>
		<td>Color Fuente:</td>
		<td><input type="color" value="<?php echo $votacion_color_fuente; ?>" name="votacion_color_fuente"></td>
	</tr>
	<tr>
		<td>Color Fuente despues de Votar:</td>
		<td><input type="color" value="<?php echo $votacion_color_fuente_despues_votar; ?>" name="votacion_color_fuente_despues_votar"></td>
	</tr>
	<tr>
		<td>Color Borde del Boton</td>
		<td><input type="color" value="<?php echo $votacion_color_borde_boton; ?>" name="votacion_color_borde_boton"></td>
	</tr>
	<tr>
		<td>Grosor Borde del Boton:</td>
		<td><input type="number" value="<?php echo $votacion_grosor_borde_boton; ?>" name="votacion_grosor_borde_boton"></td>
	</tr>
	<tr>
		<td>Icono Voto Positivo</td>
		<td>
			<select id="votacion_icono_voto_positivo" name="votacion_icono_voto_positivo">
			  <option value="fa-thumbs-up">&#xf164;</option>
			  <option value="fa-smile-o">&#xf118;</option>
			</select>
		</td>
	</tr>
		<tr>
		<td>Icono Voto Negativo
		<td>
			<select id="votacion_icono_voto_negativo" name="votacion_icono_voto_negativo">
			  <option value="fa-thumbs-down">&#xf165;</option>
			  <option value="fa-frown-o">&#xf119;</option> 
			</select>
		</td>
	</tr>
	<tr>
		<td>
			Recurrencia de Voto:
			<p>Cantidad de horas en las cuales se activara los botones para votar en el mismo post</p>
		</td>
		<td><input type="number" value="<?php echo $votacion_recurrencia_votos; ?>" name="votacion_recurrencia_votos"><b>Horas</b></td>
	</tr>
	<tr>
		<td colspan="2"><button type="submit">Guardar</button></td>
	</tr>
</table>
</form>

<hr>
<div>
	<h3>Vista previa</h3>
	<p>Previsualizamos los botones de votaciones segun el diseño propuesto</p>
	<br>
	<?php echo do_shortcode('[votacion_botones]'); ?>

</div>


<script type="text/javascript">
	jQuery(document).ready(function(){

		jQuery("#votacion_icono_voto_positivo").val("<?php echo $votacion_icono_voto_positivo; ?>");
		jQuery("#votacion_icono_voto_negativo").val("<?php echo $votacion_icono_voto_negativo; ?>");

	});
</script>