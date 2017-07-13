<?php
  function dump($v) {
    echo '<pre>';
      print_r($v);
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

 ?>
