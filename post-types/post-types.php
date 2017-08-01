<?php

function gym_init() {
	register_post_type( 'gym', array(
		'labels'            => array(
			'name'                => __( 'Gyms', 'wellwhere' ),
			'singular_name'       => __( 'Gym', 'wellwhere' ),
			'all_items'           => __( 'All Gyms', 'wellwhere' ),
			'new_item'            => __( 'New Gym', 'wellwhere' ),
			'add_new'             => __( 'Add New', 'wellwhere' ),
			'add_new_item'        => __( 'Add New Gym', 'wellwhere' ),
			'edit_item'           => __( 'Edit Gym', 'wellwhere' ),
			'view_item'           => __( 'View Gym', 'wellwhere' ),
			'search_items'        => __( 'Search Gyms', 'wellwhere' ),
			'not_found'           => __( 'No Gyms found', 'wellwhere' ),
			'not_found_in_trash'  => __( 'No Gyms found in trash', 'wellwhere' ),
			'parent_item_colon'   => __( 'Parent Gym', 'wellwhere' ),
			'menu_name'           => __( 'Gyms', 'wellwhere' ),
		),
		'public'            => true,
		'hierarchical'      => false,
		'show_ui'           => true,
		'show_in_nav_menus' => true,
		'supports'          => array( 'title', 'editor', 'thumbnail', 'comments' ),
		'has_archive'       => true,
		'rewrite'           => true,
		'query_var'         => true,
		'menu_icon'         => 'dashicons-admin-post',
		'show_in_rest'      => false,
		'rest_base'         => 'gym',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

	register_post_type( 'card', array(
		'labels'            => array(
			'name'                => __( 'Cards', 'wellwhere' ),
			'singular_name'       => __( 'Card', 'wellwhere' ),
			'all_items'           => __( 'All Cards', 'wellwhere' ),
			'new_item'            => __( 'New Card', 'wellwhere' ),
			'add_new'             => __( 'Add New', 'wellwhere' ),
			'add_new_item'        => __( 'Add New Card', 'wellwhere' ),
			'edit_item'           => __( 'Edit Card', 'wellwhere' ),
			'view_item'           => __( 'View Card', 'wellwhere' ),
			'search_items'        => __( 'Search Cards', 'wellwhere' ),
			'not_found'           => __( 'No Cards found', 'wellwhere' ),
			'not_found_in_trash'  => __( 'No Cards found in trash', 'wellwhere' ),
			'parent_item_colon'   => __( 'Parent Card', 'wellwhere' ),
			'menu_name'           => __( 'Cards', 'wellwhere' ),
		),
		'public'            => false,
		'hierarchical'      => false,
		'show_ui'           => false,
		'supports'          => array( 'title'),
		'show_in_rest'      => false,
		'capabilities' => array(
		    'edit_post'          => 'update_core',
		    'read_post'          => 'update_core',
		    'delete_post'        => 'update_core',
		    'edit_posts'         => 'update_core',
		    'edit_others_posts'  => 'update_core',
		    'delete_posts'       => 'update_core',
		    'publish_posts'      => 'update_core',
		    'read_private_posts' => 'update_core'
		),
	) );

	register_post_type( 'ticket', array(
		'labels'            => array(
			'name'                => __( 'Tickets', 'wellwhere' ),
			'singular_name'       => __( 'Ticket', 'wellwhere' ),
			'all_items'           => __( 'All Tickets', 'wellwhere' ),
			'new_item'            => __( 'New Ticket', 'wellwhere' ),
			'add_new'             => __( 'Add New', 'wellwhere' ),
			'add_new_item'        => __( 'Add New Ticket', 'wellwhere' ),
			'edit_item'           => __( 'Edit Ticket', 'wellwhere' ),
			'view_item'           => __( 'View Ticket', 'wellwhere' ),
			'search_items'        => __( 'Search Tickets', 'wellwhere' ),
			'not_found'           => __( 'No Tickets found', 'wellwhere' ),
			'not_found_in_trash'  => __( 'No Tickets found in trash', 'wellwhere' ),
			'parent_item_colon'   => __( 'Parent Ticket', 'wellwhere' ),
			'menu_name'           => __( 'Tickets', 'wellwhere' ),
		),
		'public'            => false,
		'hierarchical'      => false,
		'show_ui'           => false,
		'supports'          => array( 'title', 'custom-fields'),
		'show_in_rest'      => false,
		'capabilities' => array(
				'edit_post'          => 'update_core',
				'read_post'          => 'update_core',
				'delete_post'        => 'update_core',
				'edit_posts'         => 'update_core',
				'edit_others_posts'  => 'update_core',
				'delete_posts'       => 'update_core',
				'publish_posts'      => 'update_core',
				'read_private_posts' => 'update_core'
		),
	) );

}
add_action( 'init', 'gym_init' );

function gym_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['gym'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Gym updated. <a target="_blank" href="%s">View Gym</a>', 'wellwhere'), esc_url( $permalink ) ),
		2 => __('Custom field updated.', 'wellwhere'),
		3 => __('Custom field deleted.', 'wellwhere'),
		4 => __('Gym updated.', 'wellwhere'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Gym restored to revision from %s', 'wellwhere'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Gym published. <a href="%s">View Gym</a>', 'wellwhere'), esc_url( $permalink ) ),
		7 => __('Gym saved.', 'wellwhere'),
		8 => sprintf( __('Gym submitted. <a target="_blank" href="%s">Preview Gym</a>', 'wellwhere'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9 => sprintf( __('Gym scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Gym</a>', 'wellwhere'),
		// translators: Publish box date format, see http://php.net/date
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		10 => sprintf( __('Gym draft updated. <a target="_blank" href="%s">Preview Gym</a>', 'wellwhere'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'gym_updated_messages' );
