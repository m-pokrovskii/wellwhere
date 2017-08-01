<?php
	$curruser   = wp_get_current_user();
	$cuid       = $curruser->ID;
	$image_path = get_stylesheet_directory_uri() . "/assets";
	$now        = date('Y-m-d');
	$valid_tickets    = new WP_Query(array(
		'post_type'      => 'ticket',
		'posts_per_page' => '-1',
		'meta_query' => array(
			'relation' => 'AND',
			array(
				'key'   => 'user_id',
				'value' => $cuid
			),
			array(
				'key'     => 'expire',
				'type'    => 'DATE',
				'value'   => $now,
				'compare' => ">="
			)
		),
	));

	$expire_tickets    = new WP_Query(array(
		'post_type'      => 'ticket',
		'posts_per_page' => '-1',
		'meta_query' => array(
			'relation' => 'AND',
			array(
				'key'   => 'user_id',
				'value' => $cuid
			),
			array(
				'key'     => 'expire',
				'type'    => 'DATE',
				'value'   => $now,
				'compare' => "<"
			)
		),
	));
?>

<section id="pass" class="ProfilePage__pass-section ProfilPass">
	<h1 class="ProfilPass__headline">Pass</h1>
	<div class="ProfilPass__description">
		<?php _e('At nunc si ad aliquem bene nummatum tumentemque ideo honestus advena salutatum introieris, primitus tamquam exoptatus suscipieris et interrogatus multa coactusque mentiri.') ?>
	</div>
	<div class="PassLists">
		<?php if ( $valid_tickets->have_posts() ): ?>
			<div class="PassList -available">
				<div class="PassList__headline">Pass valables</div>
				<div class="PassRow -head">
					<div class="PassRow__icon"></div>
					<div class="PassRow__title">Salle</div>
					<div class="PassRow__date">expire le</div>
					<div class="PassRow__entries">Formule</div>
					<div class="PassRow__available-entries">entrées restantes</div>
					<div class="PassRow__button"></div>
				</div>
				<?php while ( $valid_tickets->have_posts() ) : $valid_tickets->the_post(); ?>
					<div class="PassRow">
						<?php 
							$gym_id = get_post_meta( $post->ID, 'gym_id', true);
							$ticlet_title = get_post_meta( $post->ID, 'ticket_title', true);
							$ticket_expire = get_post_meta( $post->ID, 'expire', true);
							$entries_available = get_post_meta( $post->ID, 'entries_available', true);
							$ticket_pdf_url = get_ticket_pdf_url( $post->ID );
							$gym = get_post( $gym_id );
						 ?>
						<div class="PassRow__icon">
							<a target="_blank" href="<?php echo $ticket_pdf_url ?>">
								<img src="<?php echo $image_path ?>/img/search-mini-icon.svg" alt="">
							</a>
						</div>
						<div class="PassRow__title"><?php echo $gym->post_title ?></div>
						<div class="PassRow__date"><?php echo wellwhere_date($ticket_expire) ?></div>
						<div class="PassRow__entries"><?php echo $ticlet_title ?></div>
						<div class="PassRow__available-entries"><?php echo ($entries_available) ? $entries_available : "–" ?></div>
					</div>
				<?php endwhile; ?>
			</div>
		<?php endif ?>
		<?php if ( $expire_tickets->have_posts() ): ?>
			<div class="PassList -expire">
				<div class="PassList__headline">Pass valables</div>
				<div class="PassRow -head">
					<div class="PassRow__icon"></div>
					<div class="PassRow__title">Salle</div>
					<div class="PassRow__date">expire le</div>
					<div class="PassRow__entries">Formule</div>
					<div class="PassRow__available-entries">entrées restantes</div>
					<div class="PassRow__button"></div>
				</div>
				<?php while ( $expire_tickets->have_posts() ) : $expire_tickets->the_post(); ?>
					<div class="PassRow">
						<?php 
							$gym_id = get_post_meta( $post->ID, 'gym_id', true);
							$ticlet_title = get_post_meta( $post->ID, 'ticket_title', true);
							$ticket_expire = get_post_meta( $post->ID, 'expire', true);
							$entries_available = get_post_meta( $post->ID, 'entries_available', true);
							$ticket_pdf_url = get_ticket_pdf_url( $post->ID );
							$gym = get_post( $gym_id );
						 ?>
						<div class="PassRow__icon">
							<a target="_blank" href="<?php echo $ticket_pdf_url ?>">
								<img src="<?php echo $image_path ?>/img/search-mini-icon.svg" alt="">
							</a>
						</div>
						<div class="PassRow__title"><?php echo $gym->post_title ?></div>
						<div class="PassRow__date"><?php echo wellwhere_date($ticket_expire) ?></div>
						<div class="PassRow__entries"><?php echo $ticlet_title ?></div>
						<div class="PassRow__available-entries"><?php echo ($entries_available) ? $entries_available : "–" ?></div>
					</div>
				<?php endwhile; ?>
			</div>
		<?php endif ?>
	</div>
</section>