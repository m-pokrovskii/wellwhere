<?php
  add_action( 'wp_ajax_add_basket', 'add_basket' );
  add_action( 'wp_ajax_nopriv_add_basket', 'add_basket' );
  add_action( 'wp_ajax_remove_basket', 'remove_basket' );
  add_action( 'wp_ajax_nopriv_remove_basket', 'remove_basket' );

  function add_basket() {
    if ( is_user_logged_in() ) {
      if ( isset( $_POST['gym_id'] ) && isset( $_POST['ticket_id'] )) {
        $gym_id = $_POST['gym_id'];
        $gym = get_post($gym_id);
        $ticket_id = (int) $_POST['ticket_id'];

        $tickets = get_field('gym_tickets', $gym_id);
        $ticket_expire = ticket_available_for(
          $tickets[$ticket_id]['gym_ticket_value'],
          $tickets[$ticket_id]['gym_ticket_available_for'],
          $tickets[$ticket_id]['gym_ticket_period']['value']
        );
        $basket = array(
          'basket_gym_id' => $gym->ID,
          'basket_gym_title' => $gym->post_title,
          'basket_ticket_entries' => $tickets[$ticket_id]['gym_ticket_title'],
          'basket_ticket_price' => $tickets[$ticket_id]['gym_ticket_price'],
          'basket_ticket_value' => $tickets[$ticket_id]['gym_ticket_value'],
          'basket_ticket_period' => $tickets[$ticket_id]['gym_ticket_period']['value'],
          'basket_ticket_available_for' => $tickets[$ticket_id]['gym_ticket_available_for'],
          'basket_ticket_expire' => $ticket_expire
        );
        $user_id = get_current_user_id();
        update_user_meta( $user_id, '_basket', $basket);
        wp_send_json_success();
      }
    } else {
      wp_send_json_error( array(
        'is_user_logged_in' => false,
        'message' => 'Must be logged in')
      );
    }
  }

function remove_basket() {
  $user_id = get_current_user_id();
  delete_user_meta( $user_id, '_basket' );
  wp_send_json_success();
}
?>
