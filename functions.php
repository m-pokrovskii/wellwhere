<?php
	// TODO. Remove before production
	#flush_rewrite_rules();

	define( 'TICKETS_SITE_FOLDER', get_stylesheet_directory_uri() . '/tickets/' );
	define( 'TICKETS_ABSOLUTE_FOLDER', get_template_directory() . '/tickets/' );
	add_filter('rest_enabled', '_return_false');
	add_filter('rest_jsonp_enabled', '_return_false');

	require_once 'inc/mPDF-v6.1.0/vendor/autoload.php';
	require_once 'inc/search.php';
	require_once 'inc/auth.php';
	require_once 'inc/update_user_profie.php';
	require_once 'inc/author-rewrite-rules.php';
	require_once 'post-types/post-types.php';
	require_once 'taxonomies/taxonomies.php';
	require_once 'inc/stripe.php';
	require_once 'inc/basket.php';
	require_once 'inc/add_review.php';
	require_once 'inc/check_ticket.php';
	require_once 'inc/helpers.php';

	add_theme_support( 'menus' );
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'recommended-slider', 405, 250, array('center', 'center'));
	add_image_size( 'activity-sm', 400, 200, array('center', 'center'));
	add_image_size( 'activity', 738, 200, array('center', 'center'));
	add_image_size( 'listing', 343, 210, array('center', 'center'));
	add_image_size( 'single-hero', 1440, 580, array('center', 'center'));
	add_image_size( 'single-preview', 250, 110, true );
	add_image_size( 'gallery', 9999, 200, false);
	add_image_size( 'user-avatar-menu', 55, 55, array('center', 'center'));
	add_image_size( 'user-avatar', 155, 155, array('center', 'center'));
	add_image_size( 'comments-avatar', 180, 180, array('center', 'center'));




	if( function_exists('acf_add_options_page') ) {

		acf_add_options_page(array(
			'page_title' 	=> 'Theme General Settings',
			'menu_title'	=> 'Theme Settings',
			'menu_slug' 	=> 'theme-general-settings',
			'capability'	=> 'edit_posts',
			'redirect'		=> true
		));

		acf_add_options_sub_page(array(
			'page_title' 	=> 'API Settings',
			'menu_title'	=> 'API Settings',
			'parent_slug'	=> 'theme-general-settings',
		));

		acf_add_options_sub_page(array(
			'page_title' 	=> 'Google Map Settings',
			'menu_title'	=> 'Google Map Settings',
			'parent_slug'	=> 'theme-general-settings',
		));
	}

	function acf_google_api() {
		acf_update_setting('google_api_key', get_field('google_api_key', 'option'));
	}

	add_action('acf/init', 'acf_google_api');

	// Scripts
	function wellwhere_scripts() {
		global $post;
		$modifyed = WP_DEBUG ? filemtime( get_theme_file_path('/assets/css/app.css') ) : false;

		// Libs
		wp_deregister_script( 'jquery' );
		wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), false, false );
		// wp_enqueue_script( 'jquery', get_theme_file_uri('/assets/lib/jquery.min.js'), array(), false, false );

		// Google Maps
		if ( is_singular() || is_tax() )
		{
			wp_enqueue_script( 'gmaps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAtItTsEwFHGmNjVyjR-HMFLjTLZW-jGv8', array(), false, false );
			wp_enqueue_script( 'markerclusterer', get_theme_file_uri('/assets/lib/markerclusterer.js'), array(), false, false );
			wp_enqueue_script( 'infobubble-compiled', get_theme_file_uri('/assets/lib/infobubble-compiled.js'), array(), false, false );
			wp_enqueue_script( 'infobox_packed', get_theme_file_uri('/assets/lib/infobox_packed.js'), array(), false, false );
		}

		if ( $post && $post->post_parent == 89 && is_user_logged_in() ) {
			wp_enqueue_script( 'stripe', 'https://js.stripe.com/v3/', array(), false, true );
		}

		wp_enqueue_style( 'semantic', get_theme_file_uri( '/assets/lib/semantic/semantic.min.css' ), array(), null );
		wp_enqueue_script( 'semantic', get_theme_file_uri( '/assets/lib/semantic/semantic.min.js' ), array(), false, true );

		wp_enqueue_style( 'nprogress', get_theme_file_uri( '/assets/lib/nprogress/nprogress.css' ), array(), null );
		wp_enqueue_script( 'nprogress', get_theme_file_uri( '/assets/lib/nprogress/nprogress.js' ), array(), false, true );

		wp_enqueue_style( 'slick', get_theme_file_uri( '/assets/lib/slick/slick.css' ), array(), null );
		wp_enqueue_style( 'slick-theme', get_theme_file_uri( '/assets/lib/slick/slick-theme.css' ), array(), null );
		wp_enqueue_script( 'slick', get_theme_file_uri( '/assets/lib/slick/slick.min.js' ), array(), false, true );

		wp_enqueue_style( 'fancybox', get_theme_file_uri( '/assets/lib/fancybox/dist/jquery.fancybox.min.css' ), array(), null );
		wp_enqueue_script( 'fancybox', get_theme_file_uri( '/assets/lib/fancybox/dist/jquery.fancybox.min.js' ), array(), false, true );

		// App Css
		wp_enqueue_style( 'fonts', get_theme_file_uri( '/assets/css/fonts.css' ), array(), null );
		wp_enqueue_style( 'app', get_theme_file_uri('/assets/css/app.css'), array(), $modifyed);

		// App JS
		wp_enqueue_script( 'app', get_theme_file_uri( '/assets/js/app.js' ), array(), false, true );
		wp_localize_script('app', 'data', array(
			'url' => get_stylesheet_directory_uri(),
			'adminAjax' => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce('nonce'),
			'userId' => ( is_user_logged_in() ) ? get_current_user_id() : false,
			'google_api_key' => get_field('google_api_key', 'option'),
			'google_oauth_api' => get_field('google_oauth_api', 'option')
		));
		wp_localize_script('app', 'mapData', array(
			'styles' => get_field('map_styles', 'option'),
		));
	}
	add_action( 'wp_enqueue_scripts', 'wellwhere_scripts' );
?>
