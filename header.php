<?php
	if( ( isset( $_GET['code'] ) && isset( $_GET['state'] ) ) ){
		$vsessionid = session_id();
		if ( empty( $vsessionid ) ) { session_name( 'PHPSESSID' ); session_start(); }
		facebook_login( $_GET );
	}
?>
<!doctype html>
<html>
<head>
		<meta charset="utf-8">
		<title><?php wp_title() ?></title>
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1 minimum-scale=1">
		<?php wp_head(); ?>
</head>
<body>
<?php get_template_part('templates/auth-modal') ?>
<script src="https://apis.google.com/js/api.js"></script>
