<?php 
  add_action( 'wp_ajax_add_review', 'add_review' );
  function add_review() {
  	$cuid = get_current_user_id();

  	$user_tickets = user_gym_tickets($cuid, $_POST['gym_id']);

  	if ( !$user_tickets ) {
  		wp_send_json_error( array(
  			'message' => 'This user cannot send review for this Gym'
  		) );
  	}

  	check_ajax_referer('nonce', 'nonce');
  	if ( !$_POST['review'] ) {
  		wp_send_json_error( array(
  			'message' => 'Review is required'
  		) );
  	}

  	if ( !$_POST['rating'] ) {
  		wp_send_json_error( array(
  			'message' => 'Rating is required'
  		) );
  	}

  	if ( $_POST['rating'] && ( $_POST['rating'] > 5 && $_POST['rating'] < 0 ) ) {
  		wp_send_json_error( array(
  			'message' => 'Wrong rating value'
  		) );
  	}

  	$id = wp_insert_post( array(
  		'post_type'    => 'review',
  		'post_title'   => $_POST['subject'],
  		'post_content' => $_POST['review'],
  		'post_status'  => 'publish',
  		'post_author'  => $cuid,
  		'meta_input'   => array(
  			'rating' => $_POST['rating'],
  			'gym_id' => $_POST['gym_id']
  			)
  	) );

  	if ( $id ) {

  		$average_rating = average_rating( $_POST['gym_id'] );

  		update_post_meta( $_POST['gym_id'], 'average_rating', $average_rating );

  		wp_send_json_success( array(
  			'message' => 'Review is submitted'	
			) );
  	} else {
  		wp_send_json_error( array(
  			'message'	 => 'Server Error'
			) );
  	}
  }

  add_action( 'wp_ajax_nopriv_load_more_review', 'load_more_review' );
  add_action( 'wp_ajax_load_more_review', 'load_more_review' );

  function load_more_review() {
    if ( isset($_GET['review_per_page']) && isset($_GET['gym_id']) ) {
      $review_per_page = $_GET['review_per_page'];
      $offset          = $_GET['offset'];
      $gym_id          = $_GET['gym_id'];

      $reviews = get_posts(array(
        'post_type' => "review",
        'posts_per_page' => $review_per_page,
        'offset' => $offset,
        'meta_key' => 'gym_id',
        'meat_value' => $gym_id
      ));
      if ( $reviews ) {
        foreach ($reviews as $review) {
          review_template( $review );
        }
      } else {
        wp_send_json_error( array(
          'message' => 'No reviews'
        ) );
      }
    }
    wp_die();
  }  

  add_action( 'wp_ajax_nopriv_load_more_profile_review', 'load_more_profile_review' );
  add_action( 'wp_ajax_load_more_profile_review', 'load_more_profile_review' );

	function load_more_profile_review() {
		if ( isset( $_GET['review_per_page'] ) && isset( $_GET['offset'] ) ) {
	  	$review_per_page = $_GET['review_per_page'];
	  	$offset          = $_GET['offset'];
      $cuid = get_current_user_id();

	  	$reviews = get_posts(array(
        'post_type' => 'review',
        'posts_per_page' => $review_per_page,
        'offset' => $offset,
        'author' => $cuid
      ));

	  	if ( $reviews ) {
	  		foreach ($reviews as $review) {
	  			profile_review_template( $review );
	  		}
	  	} else {
	  		wp_send_json_error( array(
	  			'message' => 'No reviews'
	  		) );
	  	}
	  }
	  wp_die();
	}  
?>