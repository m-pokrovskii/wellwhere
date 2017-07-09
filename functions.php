<?php
	require 'post-types/gym.php';
	function wellwhere_scripts() {

		// Libs
		wp_deregister_script( 'jquery' );
		wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), false, true );

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

	}
	add_action( 'wp_enqueue_scripts', 'wellwhere_scripts' );
?>
