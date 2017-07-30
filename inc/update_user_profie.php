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


    if ( $fields['first_name'] == "" ) {
      wp_send_json_error(array(
        'message' => __("First name is required")
      ));
    }

    if ( $fields['last_name'] == "" ) {
      wp_send_json_error(array(
        'message' => __("Last name is required")
      ));
    }

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

  add_action( 'wp_ajax_nopriv_upload_avatar', 'upload_avatar' );
  add_action( 'wp_ajax_upload_avatar', 'upload_avatar' );
  function upload_avatar() {
    $cuid = get_current_user_id();
    require_once( ABSPATH . 'wp-admin/includes/image.php' );
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
    require_once( ABSPATH . 'wp-admin/includes/media.php' );
    if ( !isset( $_FILES['profile_upload_avatar'] ) ) {
      wp_send_json_error(array(
        'error' => __("No image is represented")
      ));
    }

    $size_limit = 3 * (1024 * 1024);
    $image = $_FILES['profile_upload_avatar'];
    $image_type = exif_imagetype($image['tmp_name']);
    if ( $image_type !== 2 && $image_type !== 3 ) {
      wp_send_json_error(array(
        'error' => __("Only jpg / png is allowed ")
      ));
    }
    if ( $image['size'] > $size_limit  ) {
      wp_send_json_error(array(
        'error' => __("The image have to be less than 3mb")
      ));
    }

    $attachment_id = media_handle_upload('profile_upload_avatar', 0);
    if ( is_wp_error( $attachment_id ) )  {
      wp_send_json_error( $attachment_id );
    }
    else {
      update_user_meta( $cuid, 'avatar_id', $attachment_id );
      $user_avatar = wp_get_attachment_image_src( $attachment_id, 'user-avatar' );
      wp_send_json_success( array(
        'url' => $user_avatar[0],
        'message' => 'Yor avatar has been succesefuly updated'
      ) );

    }
  }

?>
