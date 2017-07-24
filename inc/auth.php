<?php
	add_action( 'wp_ajax_nopriv_ajax_loginx_form', 'ajax_loginx_form' );
	add_action( 'wp_ajax_ajax_loginx_form', 'ajax_loginx_form' );

	function ajax_loginx_form(){
		if ( is_user_logged_in() ) {
				echo json_encode(array('loggedin'=>true, 'message'=>__('You are already logged in! redirecting...','wpestate')));
				exit();
		}
		//check_ajax_referer( 'login_ajax_nonce', 'security-login' );
		//check_ajax_referer( 'login_ajax_nonce_mobile', 'security' );
		if( !estate_verify_onetime_nonce_login($_POST['security-login'], 'login_ajax_nonce') ){
				//echo json_encode(array('loggedin'=>false, 'message'=>__('You are not submiting from site or you have too many atempts!','wpestate')));
			 // exit();
		}

		$allowed_html   =   array();
		$login_user  =  wp_kses ( $_POST['login_user'],$allowed_html ) ;
		$login_pwd   =  wp_kses ( $_POST['login_pwd'], $allowed_html) ;
		$ispop       =  intval ( $_POST['ispop'] );

		if ($login_user=='' || $login_pwd==''){
			echo json_encode(array('loggedin'=>false, 'message'=>__('Username and/or Password field is empty!','wpestate')));
			exit();
		}
		wp_clear_auth_cookie();
		$info                   = array();
		$info['user_login']     = $login_user;
		$info['user_password']  = $login_pwd;
		$info['remember']       = true;
		$user_signon            = wp_signon( $info, true );


		 if ( is_wp_error($user_signon) ){
				 echo json_encode(array('loggedin'=>false, 'message'=>__('Wrong username or password!','wpestate')));
		} else {
				global $current_user;
				wp_set_current_user( $user_signon->ID );
				do_action('set_current_user');
				$current_user = wp_get_current_user();
				echo json_encode(array('loggedin'=>true, 'newuser'=>$user_signon->ID, 'message'=>__('Login successful, redirecting...','wpestate')));
		}
		wp_die();
	}



	add_action( 'wp_ajax_nopriv_wpestate_ajax_facebook_login', 'wpestate_ajax_facebook_login' );
	add_action( 'wp_ajax_wpestate_ajax_facebook_login', 'wpestate_ajax_facebook_login' );

	function wpestate_ajax_facebook_login(){
		session_start();
		$facebook_api = esc_html ( get_option('wp_estate_facebook_api','') );
		$facebook_secret = esc_html ( get_option('wp_estate_facebook_secret','') );

		$fb = new Facebook\Facebook([
				'app_id'  => $facebook_api,
				'app_secret' => $facebook_secret,
				'default_graph_version' => 'v2.5',
		]);

		$helper = $fb->getRedirectLoginHelper();

		$permissions = ['email']; // optional

		print  $loginUrl = $helper->getLoginUrl(get_dashboard_profile_link(), $permissions);
		wp_die();
	}



	add_action( 'wp_ajax_nopriv_wpestate_ajax_google_login_oauth', 'wpestate_ajax_google_login_oauth' );
	add_action( 'wp_ajax_wpestate_ajax_google_login_oauth', 'wpestate_ajax_google_login_oauth' );

	function wpestate_ajax_google_login_oauth(){
			$google_client_id       =   esc_html ( get_option('wp_estate_google_oauth_api','') );
			$google_client_secret   =   esc_html ( get_option('wp_estate_google_oauth_client_secret','') );
			$google_redirect_url    =   get_dashboard_profile_link();
			$google_developer_key   =   esc_html ( get_option('wp_estate_google_api_key','') );

			require_once 'google/Google_Client.php';
			require_once 'google/contrib/Google_Oauth2Service.php';

			$gClient = new Google_Client();
			$gClient->setApplicationName('Login to WpResidence');
			$gClient->setClientId($google_client_id);
			$gClient->setClientSecret($google_client_secret);
			$gClient->setRedirectUri($google_redirect_url);
			$gClient->setDeveloperKey($google_developer_key);
			$gClient->setScopes('email');
			$google_oauthV2 = new Google_Oauth2Service($gClient);
			print $authUrl = ($gClient->createAuthUrl());
			die();
	}



	add_action( 'wp_ajax_nopriv_wpestate_ajax_register_user', 'wpestate_ajax_register_user' );
	add_action( 'wp_ajax_wpestate_ajax_register_user', 'wpestate_ajax_register_user' );

	function wpestate_ajax_register_user(){
		$allowed_html =   array();
		$user_email = trim( sanitize_text_field(wp_kses( $_POST['user_email_register'] ,$allowed_html) ) );
		$user_name  = trim( sanitize_text_field(wp_kses( $_POST['user_login_register'] ,$allowed_html) ) );
		$user_first_name = trim( sanitize_text_field(wp_kses( $_POST['user_first_name'] ,$allowed_html) ) );
		$user_last_name = trim( sanitize_text_field(wp_kses( $_POST['user_last_name'] ,$allowed_html) ) );

		if (preg_match("/^[0-9A-Za-z_]+$/", $user_name) == 0) {
				print __('Invalid username (do not use special characters or spaces)!','wpestate');
				die();
		}


		if ($user_email=='' || $user_name=='' ){
			print __('Username and/or Email field is empty!','wpestate');
			exit();
		}
		
		if ($user_first_name == '' || $user_last_name == '' ){
			print __( 'First Name and / or Last Name field is empty!', 'wellwhere' );
			exit();
		}

		if(filter_var($user_email,FILTER_VALIDATE_EMAIL) === false) {
			print __('The email doesn\'t look right !','wpestate');
			exit();
		}

		$domain = mb_substr(strrchr($user_email, "@"), 1);
		if( !checkdnsrr ($domain) ){
				print __('The email\'s domain doesn\'t look right.','wpestate');
				exit();
		}


		$user_id     =   username_exists( $user_name );
		if ($user_id){
			print __('Username already exists.  Please choose a new one.','wpestate');
			exit();
		}

		if ( !$user_id && email_exists($user_email) == false ) {
			$user_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
			$user_id = wp_create_user( $user_name, $user_password, $user_email );
			if ( is_wp_error($user_id) ){
					print_r($user_id);
			}else{
				print __('An email with the generated password was sent!','wpestate');
				// wp_new_user_notification( $user_id, 'both' );				
				send_user_credentials( $user_id, $user_password );
			}
		} else {
			print __('Email already exists.  Please choose a new one.','wpestate');
		}
		wp_die();
	}
?>
