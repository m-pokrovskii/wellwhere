<?php
	global $wp_query;
	$big = 99999;
 ?>
  <div class="ListingPagination">
    <?php
			echo paginate_links( array(
				'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'    => '?page=%#%',
				'total'     => $wp_query->max_num_pages,
				'end_size'  => 4,
				'mid_size'  => 2,
				'type'      => 'list',
				'current'   => get_query_var('paged') ? get_query_var('paged') : 1,
				'prev_text' => '&larr;',
				'next_text' => '&rarr;',
				) );
		 ?>
  </div>
