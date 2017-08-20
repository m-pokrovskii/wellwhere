  <div class="ListingPagination">
    <?php
    	global $wp;
    	// echo str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) );
			echo paginate_links( array(
				'base'      => home_url( $wp->request ).'/#!page=%#%',
				'format'    => '?page=%#%',
				'total'     => $pagination_query->max_num_pages,
				'end_size'  => 4,
				'mid_size'  => 2,
				'type'      => 'list',
				'current'   => $pagination_query->query_vars['paged'] ? $pagination_query->query_vars['paged'] : 1,
				'prev_text' => '&larr;',
				'next_text' => '&rarr;',
				) );
		 ?>
  </div>
