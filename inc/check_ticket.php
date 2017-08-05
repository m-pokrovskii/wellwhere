<?php 
	add_action( 'wp_ajax_nopriv_check_pass', 'check_pass' );
	add_action( 'wp_ajax_check_pass', 'check_pass' );
	function check_pass() {
		check_ajax_referer('nonce', 'nonce');
		if ( !isset( $_POST['pass'] ) ) {
			wp_send_json_error(array(
				'message' => __("Please enter a ticket's password")
			));
		}

		if ( !isset( $_POST['gym_pass'] ) ) {
			wp_send_json_error(array(
				'message' => __("Please enter a gym's password")
			));
		}

		$pass     = $_POST['pass'];
		$gym_pass = $_POST['gym_pass'];
		$gym_id   = is_valid_gym_pass( $gym_pass );

		// check that ticket belong to gym 

		if ( !$gym_id ) {
			wp_send_json_error(array(
				'message' => __("Not correct gym's password")
			));
		}


		$tickets = new WP_Query(array(
			'post_type'      => 'ticket',
			'posts_per_page' => 1,
			'meta_query' => array(
				'relatation' => 'AND',
				array(
					'key'       => 'ticket_pass',
					'value'     => $pass,
					'compare' => '='
				),
				array(
					'key'       => 'gym_id',
					'value'     => $gym_id,
					'compare' => '='
				),
			)
		));

		if ( $tickets->found_posts == 0 ) {
			wp_send_json_success(array(
				'type' => 'no found',
				'message' => __('No tickets found')
			));
		} else {
			$ticket         = $tickets->posts[0];
			$ticket_user_id = get_post_meta( $ticket->ID, 'user_id', true );
			$expire_date    = get_post_meta( $ticket->ID, 'expire', true );
			$ticket_holder  = get_user_fullname( $ticket_user_id );
			$entries_remain = get_post_meta( $ticket->ID, 'entries_available', true );
			
			if ( is_ticket_expire( $ticket ) ) {
				wp_send_json_success(array(
					'type' => 'expire',
					'holder' => $ticket_holder,
					'entries_remain' =>  $entries_remain,
					'expire_date' =>  $expire_date,
					'message' => __('This ticket is expired')
				));
			} else {
				use_ticket( $ticket );
				$entries_remain = get_post_meta( $ticket->ID, 'entries_available', true );
				wp_send_json_success(array(
					'type' => 'valid',
					'holder' => $ticket_holder,
					'entries_remain' =>  $entries_remain,
					'expire_date' =>  $expire_date,
					'message' => __('This ticket is valid')
				));
			}

		}
		wp_die();
	}

?>