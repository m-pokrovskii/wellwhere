<?php 
add_action( 'wp_ajax_nopriv_get_gyms_by_uri', 'get_gyms_by_uri' );
add_action( 'wp_ajax_get_gyms_by_uri', 'get_gyms_by_uri' );

function get_precision($s) {
	return strlen($s);
}

function get_scale($s, $symbol = ".") {
	return strlen(substr(strrchr($lat, $symbol), 1));
}

function get_template_part_content( $template ) {
	ob_start();
	get_template_part( $template );
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

function include_template( $template, $query ) {	
	ob_start();
	$pagination_query = $query;
	include(locate_template($template));
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

function get_gyms_by_uri() {
	if ( isset( $_GET['uri'] ) ) {
		global $post;
		$uri      = $_GET['uri'];
		$markers  = array();
		$bounds   = ( isset($uri['_map']) ) ? $uri['_map'] : array();
		$activity = ( isset($uri['activity']) ) ? $uri['activity'] : array();
		$gender   = ( isset($uri['gender']) ) ? $uri['gender'] : array();
		$rating   = ( isset($uri['rating']) ) ? $uri['rating'] : "";
		$page     = ( isset($uri['page']) ) ? $uri['page'] : "1";

		if ($activity) {
			$activity_query = array(
				'taxonomy' => 'activity',
				'field'    => 'term_id',
				'terms'    => $activity,
			);
		}
		if ($gender) {
			$gender_query = array(
				'taxonomy' => 'age',
				'field'    => 'term_id',
				'terms'    => $gender,
			);
		}
		
		if ($rating) {
			$rating_query = array(
				'key'     => 'average_rating',
				'value'   => $rating,
				'compare' => '>=',
				'type'    => 'NUMERIC',
			);
		}

		if ($bounds['lat_BL'] && $bounds['lat_TR']) {
			$lat_query = array(
				'key'   => 'lat',
				'value' => array( $bounds['lat_BL'], $bounds['lat_TR'] ),
				'compare' => 'BETWEEN',
				'type' => 'decimal(18, 15)',
			);
		}

		if ($bounds['lng_BL'] && $bounds['lng_TR']) {
			$lat_query = array(
				'key'   => 'lng',
				'value' => array( $bounds['lng_BL'], $bounds['lng_TR'] ),
				'compare' => 'BETWEEN',
				'type' => 'decimal(18, 15)',
			);
		}

		$gyms = new WP_Query(array(
			'post_type' => 'gym',
			'posts_per_page' => 30,
			'paged' => $page,
			'tax_query' => array(
				'relation' => 'OR',
				$activity_query,
				$gender_query
			),
			'meta_query' => array(
				'relation' => 'AND',
				$rating_query,
				array(
					'relation' => 'AND',
					$lat_query,
					$lng_query,
				)
			)
		));
		if ( $gyms->have_posts() ) {
			while( $gyms->have_posts() ): 
			$gyms->the_post();
			$marker = array(
				'lat'  => get_post_meta( $post->ID, 'lat', true ),
				'lng'  => get_post_meta( $post->ID, 'lng', true ),
				'pin'  => get_field('google_map_pin', 'option')['url'],
				'html' => get_template_part_content('templates/gym_map_preview'),
				'listingItem' => get_template_part_content('templates/listing-item')
			);
			$markers[] = $marker;
			endwhile;
		}
		if ( $markers ) {
			wp_send_json_success( array(
				'markers' => $markers,
				'pagination' => include_template('templates/listing-pagination.php', $gyms)
			) );
		} else {
			wp_send_json_error( array('message' => 'No markers found') );
		}
	}
	wp_die();
}
?>