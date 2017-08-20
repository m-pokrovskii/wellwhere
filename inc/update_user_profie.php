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

add_action( 'wp_ajax_nopriv_remove_avatar', 'remove_avatar' );
add_action( 'wp_ajax_remove_avatar', 'remove_avatar' );
function remove_avatar() {
	$cuid = get_current_user_id();
	$deleted =  delete_user_meta( $cuid, 'avatar_id' );
	if ( $deleted ) {
		wp_send_json_success( array(
			'message' => 'Avatar has been removed'
			) );
	} else {
		wp_send_json_error( array(
			'error' => "Can't remove avatar"
			) );
	}

}


add_action( 'wp_ajax_nopriv_save_favorite_gym', 'save_favorite_gym' );
add_action( 'wp_ajax_save_favorite_gym', 'save_favorite_gym' );
function save_favorite_gym() {
	if ( !is_user_logged_in() ) { wp_send_json_error(array('message' => 'Must be logged in')); }
	check_ajax_referer('nonce', 'nonce');
	$gym_id = $_POST['gym_id'];
	$cuid = get_current_user_id();

	$favorited_gyms = get_user_meta( $cuid, 'favorited_gym_id', false );
	if ( in_array( $gym_id, $favorited_gyms ) ) {
		$id = delete_user_meta( $cuid, 'favorited_gym_id', $gym_id );
		wp_send_json_success( array(
			'rating' => 0,
			'message' => __('Gym has been removed')
			) );
	} else {
		$id = add_user_meta( $cuid, 'favorited_gym_id', $gym_id );
		wp_send_json_success( array(
			'rating' => 1,
			'message' => __('Gym has been saved')
			) );
	}
}


add_action( 'wp_ajax_nopriv_load_more_favorites', 'load_more_favorites' );
add_action( 'wp_ajax_load_more_favorites', 'load_more_favorites' );

function load_more_favorites() {
	if ( isset( $_GET['favorites_per_page'] ) ) {
		$cuid               = get_current_user_id();
		$favorites_per_page = $_GET['favorites_per_page'];
		$offset             = $_GET['offset'];
		$favorites_gyms_ids = get_user_meta( $cuid, 'favorited_gym_id' );
		$favorites = new WP_Query(array(
			'post_type' => "gym",
			'post__in' => ( $favorites_gyms_ids ) ? $favorites_gyms_ids : array(0),
			'posts_per_page' => 1,
			'offset' => $offset,
		));
		if ( $favorites->posts ) {
			foreach ($favorites->posts as $favorite_post) {
				profile_favorites_template( $favorite_post );
			}
		} else {
			wp_send_json_error( array(
				'message' => 'No favorites'
				) );
		}
	}
	wp_die();
}  


?>
