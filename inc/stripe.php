<?php
  require_once( get_template_directory().'/vendor/autoload.php' );

  $stripe = array(
    "secret_key"      => get_field('stripe_secret_key', 'option'),
    "publishable_key" => get_field('stripe_publishable_key', 'option')
  );

  \Stripe\Stripe::setApiKey($stripe['secret_key']);

  add_action( 'wp_ajax_charge_source', 'charge_source' );
  add_action( 'wp_ajax_save_card', 'save_card' );
  add_action( 'wp_ajax_remove_card', 'remove_card' );

  function get_card_user( $card_id ) {
    $cards = get_posts(array(
      'p' => $card_id,
      'post_type' => 'card',
      'posts_per_page' => 1,
      'meta_key' => 'user_id',
      'meta_value' => $user_id
    ));

    if ( !empty( $cards ) ) {
      return $card = $cards[0];
    } else {
      return false;
    }
  }

  function remove_card() {
    if ( isset( $_POST['card_id'] ) ) {
      $user_id = get_current_user_id();
      $card_id = $_POST['card_id'];
      $card = get_card_user( $card_id );
      if ( $card ) {
        $source_id = get_post_meta( $card->ID, 'id', true);
        $customer_id = get_user_meta($user_id, 'customer_id', true);
        try {
          $customer = \Stripe\Customer::retrieve( $customer_id );
          $deleted = $customer->sources->retrieve( $source_id )->delete();
          wp_delete_post( $card->ID, true );
          wp_send_json_success($deleted);
        } catch (Exception $e) {
          wp_send_json_error( $e->getJsonBody()['error'] );
        }
      } else {
        wp_send_json_success('Wrong Card');
      }
    }
    // wp_send_json_success();
  }

  function charge_source() {
    if ( !isset( $_POST['card_id'] ) ) { return false; };

    $card_id = $_POST['card_id'];
    $user_id = get_current_user_id();
    $user_fullname = get_user_fullname( $user_id );
    $card = get_posts(array(
  		'p' => $card_id,
      'posts_per_page' => 1,
  		'post_type' => 'card',
  		'meta_key' => 'user_id',
  		'meta_value' => $user_id
  	));

    $card = $card[0];


    if ( $card ) {
      $source_id = get_post_meta( $card->ID, 'id', true );
      $customer_id = get_user_meta($user_id, 'customer_id', true);
      $basket = get_user_meta($user_id, '_basket', true);
      $ticket_pass = wp_generate_password( 7, false, false );
      if ( $customer_id & $source_id ) {
        try {
          $charge = \Stripe\Charge::create(array(
            "amount" => (int) $basket['basket_ticket_price'] * 100,
            "currency" => "chf",
            "customer" => $customer_id,
            "source" => $source_id,
            "description" => "Ticket for " . $basket['basket_ticket_entries'] . " in gym " . $basket['basket_gym_title']
          ));
          if ( $charge ) {
            $ticket_id = create_ticket( $user_id, $basket, $ticket_pass );
            try {
              $pdf_filename = create_pdf(
                $user_fullname,
                $basket['basket_gym_title'],
                $basket['basket_ticket_expire'],
                $basket['basket_ticket_entries'],
                $ticket_pass
              );
            } catch (Exception $e) {
              wp_send_json_error( array(
                'message' => $e->getMessage()
              ) );
            }

            assign_pdf_to_ticket($ticket_id, $pdf_filename);
            send_ticket_to_user( $user_id, $ticket_id );
            clear_basket( $user_id );
            wp_send_json_success( array(
              'pdf_filename' => $pdf_filename
            ) );
          }

        } catch (Exception $e) {
            wp_send_json_error( $e->getJsonBody()['error'] );
        }
      }
    }

    wp_die();
  }

  function insert_card( $user_id, $card ) {
    $post_name = $card->brand . " " . "****".$card->last4;
    $card = $card->__toArray(true);
    $meta_input = [];
    $meta_input['user_id'] = $user_id;
    foreach ($card as $meta_key => $meta_value) {
      $meta_input[$meta_key] = $meta_value;
    }
    $post_data = array(
      'post_type' => 'card',
      'post_title' => $post_name,
      'post_status' => 'publish',
      'meta_input' => $meta_input
    );
    wp_insert_post($post_data);
  }

  function save_card() {
    $request = $_POST;
    if ( is_user_logged_in() && $request['user_id'] == get_current_user_id() ) {
      $userdata = get_userdata($request['user_id'] );
      $user_id = $userdata->ID;
      $user_email = $userdata->user_email;
      $token = $request['stripe_token'];
      $token_id = $token['id'];
      $customer_id = get_user_meta($user_id, 'customer_id', true);


      // handleCustomer()
      if ( $customer_id ) {
        // custumer exists
        try {
          $customer = \Stripe\Customer::retrieve($customer_id);
          $new_card = $customer->sources->create( array( "source" => $token_id ) );
          $card_data = $new_card;
        } catch (Exception $e) {
          // Workaround for testing data.
          delete_user_meta( $user_id, 'customer_id');
          save_card();
        }
      } else {
        // new custumer exists
        try {
          $customer = \Stripe\Customer::create( array (
            "email" => $user_email,
            "source" => $token_id,
          ) );
          add_user_meta( $user_id, 'customer_id', $customer->id, true );
          $token_data = \Stripe\Token::retrieve("$token_id");
          $card_data = $token_data['card'];

        } catch (Exception $e) {
          wp_send_json_error( $e->getJsonBody()['error'] );
        }
      }
      insert_card( $user_id, $card_data);
    }
    wp_die();
  }

 ?>
