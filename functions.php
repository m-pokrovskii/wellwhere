<?php
	// TODO. Remove before production
	flush_rewrite_rules();
	require 'inc/search.php';
	require 'inc/helpers.php';
	require 'post-types/post-types.php';
	require 'taxonomies/taxonomies.php';

	add_theme_support( 'menus' );
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'recommended-slider', 405, 250, array('center', 'center'));
	add_image_size( 'activity-sm', 400, 200, array('center', 'center'));
	add_image_size( 'activity', 738, 200, array('center', 'center'));
	add_image_size( 'listing', 343, 210, array('center', 'center'));
	add_image_size( 'single-hero', 1440, 580, array('center', 'center'));
	add_image_size( 'single-preview', 250, 110, false );
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
			'redirect'		=> false
		));

		// acf_add_options_sub_page(array(
		// 	'page_title' 	=> 'Theme Header Settings',
		// 	'menu_title'	=> 'Header',
		// 	'parent_slug'	=> 'theme-general-settings',
		// ));
		//
		// acf_add_options_sub_page(array(
		// 	'page_title' 	=> 'Theme Footer Settings',
		// 	'menu_title'	=> 'Footer',
		// 	'parent_slug'	=> 'theme-general-settings',
		// ));

	}


	function my_acf_init() {
		acf_update_setting('google_api_key', 'AIzaSyAtItTsEwFHGmNjVyjR-HMFLjTLZW-jGv8');
	}

	add_action('acf/init', 'my_acf_init');

	// Scripts
	function wellwhere_scripts() {
		// TODO. Make conditions

		// Libs
		wp_deregister_script( 'jquery' );
		wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), false, false );
		// wp_enqueue_script( 'jquery', get_theme_file_uri('/assets/lib/jquery.min.js'), array(), false, false );

		// Google Maps
		if ( is_singular() || is_tax() )
		{
			wp_enqueue_script( 'gmaps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAtItTsEwFHGmNjVyjR-HMFLjTLZW-jGv8', array(), false, false );
			wp_enqueue_script( 'markerclusterer', get_theme_file_uri('/assets/lib/markerclusterer.js'), array(), false, false );
		}


		wp_enqueue_style( 'semantic', get_theme_file_uri( '/assets/lib/semantic/semantic.min.css' ), array(), null );
		wp_enqueue_script( 'semantic', get_theme_file_uri( '/assets/lib/semantic/semantic.min.js' ), array(), false, true );

		wp_enqueue_style( 'slick', get_theme_file_uri( '/assets/lib/slick/slick.css' ), array(), null );
		wp_enqueue_style( 'slick-theme', get_theme_file_uri( '/assets/lib/slick/slick-theme.css' ), array(), null );
		wp_enqueue_script( 'slick', get_theme_file_uri( '/assets/lib/slick/slick.min.js' ), array(), false, true );

		wp_enqueue_style( 'fancybox', get_theme_file_uri( '/assets/lib/fancybox/dist/jquery.fancybox.min.css' ), array(), null );
		wp_enqueue_script( 'fancybox', get_theme_file_uri( '/assets/lib/fancybox/dist/jquery.fancybox.min.js' ), array(), false, true );

		// App Css
		wp_enqueue_style( 'fonts', get_theme_file_uri( '/assets/css/fonts.css' ), array(), null );
		wp_enqueue_style( 'app', get_theme_file_uri('/assets/css/app.css') );

		// App JS
		wp_enqueue_script( 'app', get_theme_file_uri( '/assets/js/app.js' ), array(), false, true );
		wp_localize_script('app', 'data', array(
			'url' => get_stylesheet_directory_uri(),
			'adminAjax' => admin_url( 'admin-ajax.php' )
		));
		if ( is_singular() || is_tax() ) {
			wp_localize_script('app', 'mapData', array(
				'styles' => get_field('map_styles', 'option'),
			));
		}
	}
	add_action( 'wp_enqueue_scripts', 'wellwhere_scripts' );

?>
