<?php
  add_filter('author_link', 'my_author_url_with_id', 1000, 2);
  function my_author_url_with_id($link, $author_id) {
    $link_base = trailingslashit(get_option('home'));
    $link = "authors/$author_id";
    return $link_base . $link;
  }

  add_filter('author_rewrite_rules', 'my_author_url_with_id_rewrite_rules');
  function my_author_url_with_id_rewrite_rules($author_rewrite) {
    $author_rewrite = array();
    $author_rewrite["authors/([0-9]+)/page/?([0-9]+)/?$"] = 'index.php?author=$matches[1]&paged=$matches[2]';
    $author_rewrite["authors/([0-9]+)/?$"] = 'index.php?author=$matches[1]';
    return $author_rewrite;
  }
?>
