<?php
	if ( is_user_logged_in() ) {
		$curruser = wp_get_current_user();
		$avatar_url = wellwhere_avatar_url( $curruser->ID );
	}
 ?>
<div class="HeaderWrap">
	<div class="Header -md">
		<a href="/" class="Header__logo"></a>
		<div class="Header__search ui right icon loading">
			<input
			class="Header__input-search prompt"
			placeholder="<?php _e('Où voulez-vous vous entraîner?', 'wellwhere') ?>"
			type="text"
			name="headerSearch"
			id="headerSearch">
			<div class="ui fluid search">
				<div class="results"></div>
			</div>
		</div>
		<a href="<?php echo page_link_by_file('page-partnership.php') ?>" class="Header__ButtonPartner ButtonPartner">DEVENIR PARTENAIRE</a>
		<div class="Header__loginLink">
			<?php if ( is_user_logged_in() ): ?>
				<div class="LoggedInUserDropdown ui text menu">
						<div class="ui dropdown item">
							<span class="LoggedInUserDropdown__user-name">
								<?php echo "$curruser->first_name $curruser->last_name" ?>
							</span>
							<img class="LoggedInUserDropdown__avatar ui avatar image" src=" <?php echo $avatar_url ?>  ">
							<i class="dropdown icon"></i>
							<div class="menu">
								<a href="<?php echo page_link_by_file('page-profile.php') ?>" class="item"><?php _e("Profil") ?></a>
								<a href="<?php echo page_link_by_file('page-profile.php') ?>#comments" class="item"><?php _e("Commentaires") ?></a>
								<a href="<?php echo page_link_by_file('page-profile.php') ?>#pass" class="item"><?php _e("Pass") ?></a>
								<a href="<?php echo page_link_by_file('page-profile.php') ?>#favorites" class="item"><?php _e("Favorits") ?></a>
								<a href="<?php echo wp_logout_url( get_home_url() ) ?>" class="item">
									<?php echo __('Logout', 'wellwhere') ?>
								</a>
							</div>
						</div>
					</div>
			<?php else: ?>
				<a data-open-modal-auth href="">M'identifer</a>
			<?php endif; ?>
		</div>
	</div>
	<div class="Header -sm">
		<div class="Header__sm-opener SmOpener">
			<span></span>
			<span></span>
			<span></span>
			<span></span>
		</div>
		<div class="SmMenu">
			<?php if ( is_user_logged_in() ): ?>
				<div class="SmMenu__user">
					<div class="SmMenu__userAvatar" style="background-image: url('<?php echo $avatar_url ?>');"></div>
					<div class="SmMenu__userContent">
						<div class="SmMenu__userTitle">
							<?php echo "$curruser->first_name $curruser->last_name" ?> !
						</div>
						<div class="SmMenu__userDesc">
							<?php _e('Membre depuis le', 'wellwhere') ?>
							<?php
								echo date_format ( date_create( $curruser->user_registered ), "d.m.Y")
							 ?>
						</div>
					</div>
				</div>
			<?php endif; ?>
			<div class="SmMenu__search">
				<label class="SmMenu__searchLabel" for="SmMenu__searchField"><?php _e("Rechercher") ?></label>
				<div class="SmMenu__searchForm">
					<input class="SmMenu__searchField prompt"  placeholder="Où voulez-vous vous entrainer ?" type="text" name="SmMenu__searchField" value="">
				</div>
				<div class="ui fluid loading search">
					<div class="results"></div>
				</div>
			</div>
			<?php if ( is_user_logged_in() ): ?>
				<ul class="SmMenu__menu1 -logged-in">					
					<?php 
					  $mobile_user_profile_menu = wp_get_nav_menu_items('Mobile User Profile Logged In');
					?>
					<?php foreach ($mobile_user_profile_menu as $item): ?>
					 <li>
					   <a href="<?php echo $item->url ?>" class="item">
					     <?php echo $item->title ?>
					   </a>
					 </li> 
					<?php endforeach ?>
					<li>
						<a href="<?php echo wp_logout_url( get_home_url() ) ?>" class="item">
							<?php echo __('Logout', 'wellwhere') ?>
						</a>
					</li>
				</ul>
			<?php else: ?>
				<ul class="SmMenu__menu1 -logged-in">
					<li><a href="<?php echo esc_url( home_url() ) ?>"><?php _e('Accueil', 'wellwhere') ?></a></li>
					<li><a data-mobile-modal href="#LoginForm"><?php _e('Connexion', 'wellwhere') ?></a></li>
					<li><a data-mobile-modal href="#RegForm"><?php _e('Inscription', 'wellwhere') ?></a></li>
				</ul>
			<?php endif; ?>
			<ul class="SmMenu__menu2">
				<?php 
					$mobile_menu_pages = wp_get_nav_menu_items('Mobile Menu Pages');
				?>
				<?php foreach ($mobile_menu_pages as $page_item): ?>
					<li>
						<a href="<?php echo $page_item->url ?>">
							<?php echo $page_item->title ?>
						</a>
					</li>
				<?php endforeach ?>
			</ul>
			<?php if ( have_rows('social_links', 'option') ): ?>
				<ul class="SmMenu__socials">
					<?php while ( have_rows('social_links', 'option') ): the_row(); ?>
						<li class="SmMenu__socialsItem">
							<a href="<?php the_sub_field('url') ?>">
								<img src="<?php the_sub_field('icon') ?>" alt="">
							</a>
						</li>
					<?php endwhile; ?>
				</ul>
			<?php endif; ?>
		</div>
		<a href="/" class="Header__logo"></a>
	</div>
</div>
