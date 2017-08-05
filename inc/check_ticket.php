<?php 
	add_action( 'wp_ajax_nopriv_check_pass', 'check_pass' );
	add_action( 'wp_ajax_check_pass', 'check_pass' );
	function check_pass() {
		check_ajax_referer('nonce', 'nonce');
		if ( !isset($_POST['pass']) ) {
			wp_send_json_error(array(
				'message' => __("Please enter a ticket's password")
			));
		}

		$pass = $_POST['pass'];

		$tickets = new WP_Query(array(
			'post_type'      => 'ticket',
			'posts_per_page' => 1,
			'meta_key'       => 'ticket_pass',
			'meta_value'     => $pass
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