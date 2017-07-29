<?php
  add_action( 'wp_ajax_nopriv_update_user_profie', 'update_user_profie' );
  add_action( 'wp_ajax_update_user_profie', 'update_user_profie' );
  function update_user_profie() {
    $fields = $_POST['fields'];
    $check = check_ajax_referer('nonce', "nonce", false);
    if ($check === false) {
      wp_send_json_error(array('message' => 'Security error'));
    }

    if ( !is_email( $fields['email'] ) ) {
      wp_send_json_error(array(
        'message' => __("Email is required")
      ));
    }


    // TODO. Check email, first and last name are exists;

    $user = wp_update_user(array(
      'ID'         => get_current_user_id(),
      'user_email' => $fields['email'],
      'first_name' => $fields['first_name'],
      'last_name'  => $fields['last_name']
    ));

    if (is_wp_error( $user )) {
      wp_send_json_error(array(
        'errors' => $user->errors
      ));
    }

    update_user_meta( $user, 'city', $fields['city'] );
    update_user_meta( $user, 'country', $fields['country'] );
    update_user_meta( $user, 'cp', $fields['cp'] );
    update_user_meta( $user, 'gender', $fields['gender'] );
    update_user_meta( $user, 'phone', $fields['phone'] );
    update_user_meta( $user, 'street', $fields['street'] );
    update_user_meta( $user, 'day', $fields['day'] );
    update_user_meta( $user, 'month', $fields['month'] );
    update_user_meta( $user, 'year', $fields['year'] );

    wp_send_json_success(array(
      'message' => __("Your profile has been updated")
    ));
    wp_die();
  }
?>
