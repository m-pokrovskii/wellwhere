<?php get_header(); ?>
<div class="App">
	<?php get_template_part('templates/header') ?>
		<div class="ProfilePage">
			<?php get_template_part( 'templates/profile_aside' ); ?>
			<?php get_template_part( 'templates/profile_content' ); ?>
		</div>
	<?php get_template_part('templates/footer-single') ?>
</div>
<?php get_footer(); ?>
