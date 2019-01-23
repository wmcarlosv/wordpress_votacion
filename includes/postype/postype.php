<?php

	function votacion_post_type() {
	$labels = array(
		'name'               => __( 'Votaciones' ),
		'singular_name'      => __( 'Votacion' ),
		//'add_new'            => __( 'Add New Event' ),
		//'add_new_item'       => __( 'Add New Event' ),
		'//edit_item'          => __( 'Edit Event' ),
		//'new_item'           => __( 'Add New Event' ),
		'view_item'          => __( 'View Event' ),
		'search_items'       => __( 'Search Event' ),
		'not_found'          => __( 'No events found' ),
		'not_found_in_trash' => __( 'No events found in trash' )
	);
	
	/*$supports = array(
		'title',
		'editor',
		'thumbnail',
		'comments',
		'revisions',
	);*/

	$args = array(
		'labels'               => $labels,
		//'supports'             => $supports,
		'public'               => true,
		'capability_type'      => 'post',
		'rewrite'              => array( 'slug' => 'events' ),
		'has_archive'          => true,
		'menu_position'        => 30,
		'menu_icon'            => 'dashicons-star-filled',
		'register_meta_box_cb' => 'wpt_add_votacion_metaboxes',
	);
	register_post_type( 'votaciones', $args );
}

add_action( 'init', 'votacion_post_type' );

function wpt_add_votacion_metaboxes() {

	add_meta_box(
		'votacion_datos',
		'Datos de la Votacion',
		'votacion_datos',
		'votaciones'
		//'side',
		//'default'
	);

}

function votacion_datos() {

	global $post;
	// Nonce field to validate form request came from current site
	//wp_nonce_field( basename( __FILE__ ), 'event_fields' );
	// Get the location data if it's already been entered
	//$location = get_post_meta( $post->ID, 'location', true );
	// Output the field
	$data = get_post_meta( $post->ID, 'pm_votacion_estadistic', true );

	if(count($data) > 0){
		$votacion_ip = (isset($data['votacion_ip']) and !empty($data['votacion_ip'])) ? $data['votacion_ip'] : "";
		$votacion_fecha = (isset($data['votacion_fecha']) and !empty($data['votacion_fecha'])) ? $data['votacion_fecha'] : "";

		$votacion_tipo_votacion = (isset($data['votacion_tipo_votacion']) and !empty($data['votacion_tipo_votacion'])) ? $data['votacion_tipo_votacion'] : "";

		$votacion_url_post = (isset($data['votacion_url_post']) and !empty($data['votacion_url_post'])) ? $data['votacion_url_post'] : "";
	}
	?>
	<table>
		<tr>
			<td>Ip:</td>
			<td><input type="text" value="<?php echo $votacion_ip; ?>" name="votacion_ip"></td>
		</tr>
		<tr>
			<td>Fecha Votacion: </td>
			<td><input type="text" value="<?php echo $votacion_fecha; ?>" name="votacion_fecha"></td>
		</tr>
		<tr>
			<td>Tipo Votacion: </td>
			<td><input type="text" value="<?php echo $votacion_tipo_votacion ?>" name="votacion_tipo_votacion"></td>
		</tr>
		<tr>
			<td>Url post Votacion: </td>
			<td><textarea name="votacion_url_post"><?php echo $votacion_url_post; ?></textarea></td>
		</tr>
	</table>
	<?php
}