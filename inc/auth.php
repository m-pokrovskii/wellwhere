<?php
	add_action( 'wp_ajax_nopriv_ajax_loginx_form', 'ajax_loginx_form' );
	add_action( 'wp_ajax_ajax_loginx_form', 'ajax_loginx_form' );

	function ajax_loginx_form(){
		if ( is_user_logged_in() ) {
				wp_send_json_success( array(
					'message' => __('You are already logged in! redirecting...', 'wellwhere')
				) );
		}
		if( !estate_verify_onetime_nonce_login($_POST['security_login'], 'login_ajax_nonce') ){
			 wp_send_json_error( array('message' => 'You are hacker!') );
		}

		$allowed_html = array();
		$login_email = wp_kses ( $_POST['login_email'], $allowed_html ) ;
		$login_password = wp_kses ( $_POST['login_password'], $allowed_html) ;

		if ( $login_email == "" || $login_password == "" ){
			wp_send_json_error( array( 'mesage' => __('Username and/or Password field is empty!', 'wellwhere') ) );
		}

		wp_clear_auth_cookie();

		$info                   = array();
		$info['user_login']     = $login_email;
		$info['user_password']  = $login_password;
		$info['remember']       = true;
		$user_signon            = wp_signon( $info, true );


		 if ( is_wp_error( $user_signon ) ){
				 wp_send_json_error( array('message' => __('Wrong username or password!', 'wellwhere') ) );
		} else {
				global $current_user;
				wp_set_current_user( $user_signon->ID );
				do_action('set_current_user');
				$current_user = wp_get_current_user();
				wp_send_json_success( array(
					'user_id' => $user_signon->ID,
					'message' => __('Login successful, redirecting...','wellwhere')
				) );
		}
	}



	add_action( 'wp_ajax_nopriv_wpestate_ajax_facebook_login', 'wpestate_ajax_facebook_login' );
	add_action( 'wp_ajax_wpestate_ajax_facebook_login', 'wpestate_ajax_facebook_login' );

	function wpestate_ajax_facebook_login(){
		session_start();
		require_once 'facebook_sdk5/Facebook/autoload.php';
		$facebook_api = esc_html ( get_field('facebook_app_id', 'option') );
		$facebook_secret = esc_html ( get_field('facebook_secret', 'option') );
		try {
			$fb = new Facebook\Facebook([
					'app_id'  => $facebook_api,
					'app_secret' => $facebook_secret,
					'default_graph_version' => 'v2.10',
			]);
			$helper = $fb->getRedirectLoginHelper();
			$permissions = ['email'];
			$url = $helper->getLoginUrl( home_url(), $permissions);
			wp_send_json_success( array(
				'url' => $url
			) );

		} catch (\Facebook\Exceptions\FacebookResponseException $e) {
			wp_send_json_error( $e->getMessage() );
		}

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
		$user_first_name = trim( sanitize_text_field(wp_kses( $_POST['user_first_name'] ,$allowed_html) ) );
		$user_last_name = trim( sanitize_text_field(wp_kses( $_POST['user_last_name'] ,$allowed_html) ) );

		if ( $user_email == "" ){
			wp_send_json_error( array(
				'message' => __( 'Email field is empty!','wellwhere')
			) );
		}

		if ( $user_first_name == '' || $user_last_name == '' ) {
			wp_send_json_error( array(
				'message' => __( 'First Name and / or Last Name field is empty!', 'wellwhere' )
			) );
		}

		if( filter_var( $user_email, FILTER_VALIDATE_EMAIL ) === false ) {
			wp_send_json_error( array(
				'message' => __('The email doesn\'t look right !','wellwhere')
			) );
		}

		$domain = mb_substr(strrchr($user_email, "@"), 1);
		if( !checkdnsrr ($domain) ) {
			wp_send_json_error( array(
				'message' => __('The email\'s domain doesn\'t look right.','wellwhere')
			) );
		}


		$user_id = email_exists( $user_email );
		if ( $user_id ) {
			wp_send_json_error( array(
				'message' => __('Email already exists.  Please choose a new one.','wellwhere')
			) );
		}

		if ( email_exists( $user_email ) == false ) {
			$user_password = wp_generate_password( $length = 12, $include_standard_special_chars = false );
			$user_id = wp_insert_user( array(
				'user_login' => $user_email,
		    'user_pass' => $user_password,
				'user_email' => $user_email,
				'first_name' => $user_first_name,
				'last_name' => $user_last_name
			));
			if ( is_wp_error( $user_id ) ){
				wp_send_json_error( $user_id );
			}else{
				send_user_credentials( $user_id, $user_password );
				wp_send_json_success( array(
					'message' => __('An email with the generated password was sent!','wellwhere')
				) );
			}
		} else {
			wp_send_json_error( array(
				'message' => __('Email already exists.  Please choose a new one.','wellwhere')
			) );
		}
		wp_die();
	}

	add_action( 'wp_ajax_nopriv_wpestate_ajax_forgot_pass', 'wpestate_ajax_forgot_pass' );
	add_action( 'wp_ajax_wpestate_ajax_forgot_pass', 'wpestate_ajax_forgot_pass' );

	function wpestate_ajax_forgot_pass(){
	    global $wpdb;
      $allowed_html   =   array();
      $forgot_email   =   sanitize_text_field( wp_kses( $_POST['forgot_email'], $allowed_html ) );

      check_ajax_referer( 'forgot_ajax_nonce', 'security-forgot' );
      if ( $forgot_email == '' ){
        wp_send_json_error( array(
					'message' => __('Email field is empty!','wellwhere')
				) );
      }

      $user_input = trim( $forgot_email );

      if ( strpos($user_input, '@') ) {
	      $user_data = get_user_by( 'email', $user_input );
	      if( empty($user_data ) ) {
	      // if( empty($user_data ) || isset( $user_data->caps['administrator'] ) ) {
					wp_send_json_error( array(
						'message' => __( 'Invalid E-mail address!','wellwhere' )
					) );
	      }
      }
      else {
        $user_data = get_user_by( 'login', $user_input );
        if( empty($user_data) ) {
        // if( empty($user_data) || isset( $user_data->caps['administrator'] ) ) {
					wp_send_json_error( array(
						'message' => __( 'Invalid username!','wellwhere' )
					) );
        }
      }

			$user_login = $user_data->user_login;
			$user_email = $user_data->user_email;

			$key = get_password_reset_key( $user_data );
			if ( is_wp_error( $key ) ) {
		    return $key;
			}

			$headers = 'From: No Reply <noreply@'.$_SERVER['HTTP_HOST'].'>' . "\r\n";

			$blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
			$title = sprintf( __('[%s] Password Reset'), $blogname );

			$message  = __('Someone has requested a password reset for the following account:') . "\r\n\r\n";
	    $message .= network_home_url( '/' ) . "\r\n\r\n";
	    $message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
	    $message .= __('If this was a mistake, just ignore this email and nothing will happen.') . "\r\n\r\n";
	    $message .= __('To reset your password, visit the following address:') . "\r\n\r\n";
	    $message .= '<' . network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') . ">\r\n";

			$send =  wp_mail($user_email, wp_specialchars_decode( $title ), $message, $headers);

			if ( $send ) {
				wp_send_json_success( array(
					'message' => __('We have just sent you an email with Password reset instructions.','wellwhere')
				) );
			} else {
				wp_send_json_error( array(
					'message' => __('The email could not be sent.', 'wellwhere')
				) );
			}
	}

	function facebook_login( $get_vars ){
			require_once 'facebook_sdk5/Facebook/autoload.php';
			$facebook_api    = esc_html ( get_field('facebook_app_id', 'option') );
			$facebook_secret = esc_html ( get_field('facebook_secret', 'option') );

	    $fb = new Facebook\Facebook([
	            'app_id'  => $facebook_api,
	            'app_secret' => $facebook_secret,
	            'default_graph_version' => 'v2.5',
	        ]);
	    $helper = $fb->getRedirectLoginHelper();
	    $secret = $facebook_secret;
	    try {
	        $accessToken = $helper->getAccessToken();
	    } catch(Facebook\Exceptions\FacebookResponseException $e) {
	         // When Graph returns an error
	        echo 'Graph returned an error: ' . $e->getMessage();
	    exit;
	    } catch(Facebook\Exceptions\FacebookSDKException $e) {
	        // When validation fails or other local issues
	        echo 'Facebook SDK returned an error: ' . $e->getMessage();
	        exit;
	    }


	    // Logged in
	    // var_dump($accessToken->getValue());

	    // The OAuth 2.0 client handler helps us manage access tokens
	    $oAuth2Client = $fb->getOAuth2Client();

	    // Get the access token metadata from /debug_token
	    $tokenMetadata = $oAuth2Client->debugToken($accessToken);
	    //echo '<h3>Metadata</h3>';
	    //var_dump($tokenMetadata);

	    // Validation (these will throw FacebookSDKException's when they fail)
	    $tokenMetadata->validateAppId($facebook_api);

	    // If you know the user ID this access token belongs to, you can validate it here
	    //$tokenMetadata->validateUserId('123');
	    $tokenMetadata->validateExpiration();

	    if (! $accessToken->isLongLived()) {
	        // Exchanges a short-lived access token for a long-lived one
	        try {
	          $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
	        } catch (Facebook\Exceptions\FacebookSDKException $e) {
	          echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
	          exit;
	        }
	    // echo '<h3>Long-lived</h3>';
	    // var_dump($accessToken->getValue());
	    }

	    $_SESSION['fb_access_token'] = (string) $accessToken;

	    try {
	        // Returns a `Facebook\FacebookResponse` object
	        $response = $fb->get('/me?fields=id,email,name,first_name,last_name', $accessToken);
	    } catch(Facebook\Exceptions\FacebookResponseException $e) {
	        echo 'Graph returned an error: ' . $e->getMessage();
	        exit;
	    } catch(Facebook\Exceptions\FacebookSDKException $e) {
	        echo 'Facebook SDK returned an error: ' . $e->getMessage();
	        exit;
	    }

	    $user = $response->getGraphUser();


	    if(isset($user['name'])){
	        $full_name = $user['name'];
	    }
	    if(isset($user['email'])){
	        $email = $user['email'];
	    }

			$user_password = wp_generate_password( $length = 12, $include_standard_special_chars = false );

	    $identity_code = $secret.$user['id'];
			if ( !email_exists( $email ) ) {
				$user_id = wp_insert_user( array(
					'user_login'    => $email,
					'user_pass'     => $user_password,
					'user_email'    => $email,
					'first_name'    => $user['first_name'],
					'last_name'     => $user['last_name'],
					'user_nicename' => $full_name
				));
			}

			$u = get_user_by('email', $email);

			// $info                  = array();
			// $info['user_login']    = $u->user_login;
			// $info['user_password'] = $u->user_pass;
			// $info['remember']      = true;
			//
			// $user_signon = wp_signon( $info, true );

			wp_clear_auth_cookie();
			wp_set_current_user ( $u->ID );
			wp_set_auth_cookie ( $u->ID, true );


			if ( is_wp_error( $user_signon ) ){
				// dump($user_signon->get_error_message());
				wp_redirect( esc_url(home_url() ) ); exit();
			} else {
					// TODO. Redirect to specific url
					wp_redirect( esc_url(home_url() ) ); exit();
			}
	}
?>
