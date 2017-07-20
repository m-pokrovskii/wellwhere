<?php
  function dump($v) {
    echo '<pre>';
      print_r($v);
    echo '</pre>';
  }

  function page_link_by_file( $filename ) {
    $page = new WP_Query(array(
      'post_type' => 'page',
      'meta_key' => '_wp_page_template',
      'meta_value' => $filename,
      'posts_per_page' => 1,
      'fields' => 'ids'
    ));
    $page_id = $page->posts[0];
    return get_permalink($page_id);
  }

  function the_active_step( $filename = "", $post ) {
    if ( is_active_step( $filename, $post ) ) {
      echo "-active";
    }
  }

  function is_active_step( $filename = "", $post = "" ) {
    $page_template = get_post_meta( $post->ID, $key = '_wp_page_template', true );
    if ( $page_template === $filename ) {
      return true;
    } else {
      return false;
    }
  }

  function clear_basket( $user_id ) {
		delete_user_meta($user_id, '_basket');
	}

	function create_ticket( $user_id, $basket ) {
		$post_title = $basket['basket_gym_title'] ." ". $basket['basket_ticket_entries'];
		$meta = array(
			'gym_id' => $basket['basket_gym_id'],
			'gym_title' => $basket['basket_gym_title'],
			'user_id' => $user_id,
			'expire' => $basket['basket_ticket_expire'],
			'ticket_title' => $basket['basket_ticket_entries'],
			'entries_available' => ( $basket['basket_ticket_period'] === 'entry' ) ? $basket['basket_ticket_value'] : false ,
			'validated' => false
		);
		wp_insert_post(array(
			'post_type' => 'ticket',
			'post_title' => $post_title,
			'post_status' => 'publish',
			'meta_input' => $meta
		));
	}

  function ticket_availability( $value ) {
  	$date = date_create();
  	date_add($date, date_interval_create_from_date_string( $value . ' days'));
  	return date_format($date, 'd/m/Y');
  }

  function ticket_available_for( $value, $available_for, $period ) {
  	$date = date_create();
  	if ( $period === 'entry' ) {
  		return ticket_availability($available_for);
  	} else {
  		return ticket_availability($value);
  	}
  }

  function get_card_image( $brand ) {
    if ( $brand == "Visa" ) {
      return get_stylesheet_directory_uri() . '/assets/img/visa.svg';
    } elseif ( $brand == "MasterCard" ) {
      return get_stylesheet_directory_uri() . '/assets/img/mastercard.svg';
    }
  }

 ?>
