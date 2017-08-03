<?php
if ( ! current_user_can( 'manage_options' ) ) {
	add_filter('show_admin_bar', '__return_false');
}

function dump( $v ) {
	echo '<pre>';
	print_r( $v );
	echo '</pre>';
}

function page_link_by_file( $filename ) {
	$page = new WP_Query(array(
		'post_type' => 'page',
		'meta_key' => '_wp_page_template',
		'meta_value' => $filename,
		'posts_per_page' => 1,
		'fields' => 'ids'
		));
	$page_id = $page->posts[0];
	return get_permalink($page_id);
}

function page_by_file( $filename ) {
	$page = new WP_Query(array(
		'post_type' => 'page',
		'meta_key' => '_wp_page_template',
		'meta_value' => $filename,
		'posts_per_page' => 1,
		'fields' => 'ids'
		));
	return $page->posts[0];
}

function the_active_step( $filename = "", $post ) {
	if ( is_active_step( $filename, $post ) ) {
		echo "-active";
	}
}

function is_active_step( $filename = "", $post = "" ) {
	$page_template = get_post_meta( $post->ID, $key = '_wp_page_template', true );
	if ( $page_template === $filename ) {
		return true;
	} else {
		return false;
	}
}

function clear_basket( $user_id ) {
	delete_user_meta($user_id, '_basket');
}

function create_ticket( $user_id, $basket, $ticket_pass ) {
	$post_title = $basket['basket_gym_title'] ." ". $basket['basket_ticket_entries'];
	$meta = array(
		'gym_id' => $basket['basket_gym_id'],
		'gym_title' => $basket['basket_gym_title'],
		'user_id' => $user_id,
		'expire' => $basket['basket_ticket_expire'],
		'ticket_title' => $basket['basket_ticket_entries'],
		'entries_available' => ( $basket['basket_ticket_period'] === 'entry' ) ? $basket['basket_ticket_value'] : false ,
		'ticket_pass' => $ticket_pass,
		'validated' => false
		);
	return wp_insert_post(array(
		'post_type' => 'ticket',
		'post_title' => $post_title,
		'post_status' => 'publish',
		'meta_input' => $meta
		));
}

function ticket_availability( $value ) {
	$date = date_create();
	date_add($date, date_interval_create_from_date_string( $value . ' days'));
	return date_format($date, 'Y-m-d');
}

function ticket_available_for( $value, $available_for, $period ) {
	$date = date_create();
	if ( $period === 'entry' ) {
		return ticket_availability($available_for);
	} else {
		return ticket_availability($value);
	}
}

function get_card_image( $brand ) {
	if ( $brand == "Visa" ) {
		return get_stylesheet_directory_uri() . '/assets/img/visa.svg';
	} elseif ( $brand == "MasterCard" ) {
		return get_stylesheet_directory_uri() . '/assets/img/mastercard.svg';
	}
}

function create_pdf( $user_name, $gym_name, $expire, $entries, $ticket_pass ) {
	$uniq_filename = uniqid();
	$mpdf = new mPDF('utf-8', 'A4');
	ob_start();
	include( __DIR__ . '/../templates/pass-pdf-template.php' );
	$template = ob_get_clean();
	$mpdf->WriteHTML($template);
	$mpdf->Output( __DIR__. '/../tickets/' . $uniq_filename . '.pdf','F' );
	return $uniq_filename;
}

function assign_pdf_to_ticket( $ticket_id, $filename ) {
	update_post_meta( $ticket_id, 'pdf_filename', $filename . '.pdf' );
}

function get_user_fullname( $user_id ) {
	$user = get_userdata($user_id);
	return $user->first_name ." ". $user->last_name;
}

function send_ticket_to_user( $user_id, $ticket_id ) {
	$user = get_userdata($user_id);
	$user_email = $user->user_email;
	$pdf = get_post_meta( $ticket_id, 'pdf_filename', true );
	$pdf_site_url = TICKETS_SITE_FOLDER . $pdf;
	$pdf_absolute_url = TICKETS_ABSOLUTE_FOLDER . $pdf;
	// TODO. Fields in admin
	$to = $user_email;
	$subject = "Ticket from " . get_bloginfo('name');
	$message = "Your ticket " . $pdf_site_url;
	$attachments = array( $pdf_absolute_url );
	$headers = 'From: No Reply <noreply@'.$_SERVER['HTTP_HOST'].'>' . "\r\n";

	$send =  @wp_mail($to, $subject, $message, $headers, $attachments);
}

function send_user_credentials( $user_id, $user_password ) {
	$user = new WP_User( $user_id );
	$sitename = get_bloginfo('name');
	$siteurl = get_bloginfo('url');

	$to = stripslashes( $user->user_email );
	$subject = "[ $sitename ] Your password info";
	$message .= "Greetings " . $user->first_name . " " . $user->last_name .".\r\n";
	$message .= "Thanks for registration." . "\r\n";
	$message .= "Your password is: " . $user_password . "\r\n";
	$message .= "$siteurl \r\n";
	$headers = 'From: No Reply <noreply@'.$_SERVER['HTTP_HOST'].'>' . "\r\n";

	$send =  @wp_mail($to, $subject, $message, $headers);
}


function create_onetime_nonce($action = -1) {
	$time = time();
	$nonce = wp_create_nonce($time.$action);
	return $nonce . '-' . $time;
}

function verify_onetime_nonce_login( $_nonce, $action = -1) {
	$parts = explode( '-', $_nonce );
	$nonce = $toadd_nonce = $parts[0];
	$generated = $parts[1];

	$nonce_life = 60*60;
	$expires    = (int) $generated + $nonce_life;
	$expires2   = (int) $generated + 120;
	$time       = time();

	if( ! wp_verify_nonce( $nonce, $generated.$action ) || $time > $expires ){
		return false;
	}

		//Get used nonces
	$used_nonces = get_option('_sh_used_nonces');

	if( isset( $used_nonces[$nonce] ) ) {
		return false;
	}

	if(is_array($used_nonces)){
		foreach ($used_nonces as $nonce=> $timestamp){
			if( $timestamp > $time ){
				break;
			}
			unset( $used_nonces[$nonce] );
		}
	}

		//Add nonce in the stack after 2min
	if($time > $expires2){
		$used_nonces[$toadd_nonce] = $expires;
		asort( $used_nonces );
		update_option( '_sh_used_nonces',$used_nonces );
	}
	return true;
}

function wellwhere_avatar_url( $user_id ) {
	$avatar_id = get_user_meta( $user_id, 'avatar_id', true );
	$user_avatar = wp_get_attachment_image_src( $avatar_id, 'user-avatar' );
	return $user_avatar[0];
}


function wellwhere_date( $d ) {
	return date( "d/m/Y", strtotime( $d ) );
}

function get_ticket_pdf_url( $ticket_id ) {
	return get_stylesheet_directory_uri() . '/tickets/' . get_post_meta( $ticket_id, 'pdf_filename', true);
}

function user_full_name( $user_id ) {
	$user = get_user_by('ID', $user_id);
	return "$user->first_name $user->last_name";
}

function average_rating( $gym_id ) {

	$reviews = get_posts(array(
		'post_type'      => 'review',
		'meta_key'       => 'gym_id',
		'meta_value'     => $gym_id,
		'posts_per_page' => -1,
	));

	if ( !$reviews ) return false;
	
	$count = count($reviews);
	$rating = 0;
	
	foreach ($reviews as $r) {
		$rating += (int)get_post_meta( $r->ID, 'rating', true );
	}
	
	$average_rating = round( $rating / $count );
	return $average_rating;
}

function user_gym_tickets( $user_id, $gym_id ) {
	$user_tickets = get_posts(array(
		'post_type' => 'ticket',
		'meta_query' => array(
			'relation' => 'AND',
			array(
				'key'   => 'gym_id',
				'value' => $gym_id
			),
			array(
				'key'   => 'user_id',
				'value' => $user_id
			),
		)
	));
	
	if ( $user_tickets ) {
		return true;
	} else {
		return false;
	}
}

function user_has_posted_review( $user_id, $gym_id ) {
	$reviews = get_posts(array(
		'post_type' => 'review',
		'author' => $user_id,
		'meta_key' => 'gym_id',
		'meta_value' => $gym_id
	));
	return $reviews;
}

function profile_review_template( $review ) {
	$rating = get_post_meta( $review->ID, 'rating', true );
	$gym_id = get_post_meta( $review->ID, 'gym_id', true );
	?>
	<div class="ProfileComments__item">
		<div class="ProfileComments__wrap-type-date">
			<div class="ProfileComments__type">Salle</div>
			<div class="ProfileComments__date"><?php echo get_the_date( "d/m/Y", $review->ID ) ?></div>
		</div>
		<div class="ProfileComments__title"><?php echo get_the_title( $gym_id ); ?></div>
		<div class="ProfileComments__note">Note</div>
		<div 
			data-rating = <?php echo $rating ?>
			class="GymRating ProfileComments__rating ui rating"></div>
		<div class="ProfileComments__commentaire">
			Commentaire
		</div>
		<?php if ($review->post_title): ?>
			<div class="ProfileComments__comment-title">
				<?php echo $review->post_title ?>
			</div>
		<?php endif ?>
		<div class="ProfileComments__comment-description">
			<?php echo $review->post_content ?>
		</div>
	</div>			
<?php }

function review_template( $review ) { ?>
	<div class="Comment Comments__item">
		<div class="Comment__meta">
			<div 
			class="Comment__avatar" 
			style="background-image: url(<?php echo wellwhere_avatar_url( $review->post_author ) ?>)"></div>
			<div class="Comment__name">
				<?php echo user_full_name( $review->post_author ) ?>
			</div>
		</div>
		<div class="Comment__body">
			<?php if ( $review->post_title ): ?>
				<div class="Comment__title">
					<?php echo $review->post_title ?>
				</div>						
			<?php endif ?>
			<div data-show-more class="Comment__description">
				<?php
				$desc = $review->post_content;
				$short_desc = "";
				if ( str_word_count( $desc ) > 60 ) {
					$short_desc = wp_trim_words( $desc, 60 );
				}
				?>
				<?php if ( $short_desc ): ?>
					<div class="Comment__description-short">
						<?php echo $short_desc; ?>
						<a class="Comment__read-more" data-show-more-link href="#">Lire plus.</a>
					</div>
					<div class="Comment__description-long">
						<?php echo wpautop( $desc ); ?>
					</div>
				<?php else: ?>
					<?php echo wpautop( $desc ); ?>
				<?php endif ?>
			</div>
		</div>
	</div>
<?php }

function get_gym_reviews_count( $gym_id ) {
	$reviews = get_posts(array(
		'post_type' => 'review',
		'meta_key' => 'gym_id',
		'meta_value' => $gym_id
	));
	if ( count($reviews) > 0 ) {
		return count($reviews);
	} else {
		return 0;
	}
}

?>