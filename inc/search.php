<?php
  add_action( 'wp_ajax_search', 'ajax_search' );
  add_action( 'wp_ajax_nopriv_search', 'ajax_search' );

  function ajax_search() {
  	$query_string = $_GET['q'];
  	$return_array = [];

  	$city_canton_query = new WP_Term_Query(array(
  		'taxonomy' => array('city', 'canton'),
  		'name__like' => $query_string,
  		'fields' => 'ids'
  	));

  	$ids = $city_canton_query->get_terms();

    if ( empty($ids) ) {
      $ids = false;
    }

  	$zip_query = new WP_Term_Query(array(
  		'taxonomy' => array('zip'),
      'meta_query' => array(
        'relation' => 'OR',
    		 array(
    			 'key' => 'zip_zip',
    			 'value' => $query_string,
    			 'compare' => 'Like',
    		 ),
    		 array(
    			 'key' => 'zip_city',
    			 'value' => $ids,
    			 'compare' => 'IN',
    		 ),
    		 array(
    			 'key' => 'zip_canton',
    			 'value' => $ids,
    			 'compare' => 'IN',
    		 ),
  		),
  	));

  	foreach ($zip_query->get_terms() as $zip_term) {
  		$city_term = get_field('zip_city', $zip_term);
  		$canton_term = get_field('zip_canton', $zip_term);

  		if ( $canton_term ) {
  			$return_array[] = array(
  				'title' => $canton_term->name,
  				'url' => get_term_link($canton_term, $canton_term->taxonomy),
  				'tax' => $canton_term->taxonomy,
          'description' => $canton_term->description
  			);
  		}

  		if ( $city_term ) {
  			$return_array[] = array(
  				'title' => $city_term->name,
  				'url' => get_term_link($city_term, $city_term->taxonomy),
  				'tax' => $city_term->taxonomy,
          'description' => $city_term->description
  			);
  		}

  		$return_array[] = array(
  			'title' => $zip_term->name,
  			'url' => get_term_link($zip_term, $zip_term->taxonomy),
  			'tax' => $zip_term->taxonomy,
        'description' => $zip_term->description
  		);
  	}

    $results = [];
    $results['results'] = array_values(
      array_unique( $return_array, SORT_REGULAR )
    );
    // dump($results);
  	echo json_encode($results);
    wp_die();
  }
?>
