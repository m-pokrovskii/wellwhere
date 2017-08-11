<div class="Footer -home">
	<?php if ( have_rows('social_links', 'option') ): ?>
		<ul class="Footer__socials">
			<?php while ( have_rows('social_links', 'option') ): the_row(); ?>
				<li class="Footer__socialsItem">
					<a href="<?php the_sub_field('url') ?>">
						<img src="<?php the_sub_field('icon') ?>" alt="">
					</a>
				</li>
			<?php endwhile; ?>
		</ul>
	<?php endif; ?>
	<div class="Footer__copyright">
		<?php echo get_field('copyright', 'option') ?>
	</div>
</div>
