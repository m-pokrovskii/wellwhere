const url = data.adminAjax + '?action=search&q={query}';
$('.HeroSearch__field, .Header__search, .SmMenu__search')
  .search({
    apiSettings: {
      action: 'search',
      cache: false,
      url : url,
    },
    fields: {
      actionURL: 'url'
    },
    searchFullText: false,
    searchFields   : [ 'title' ],
  });
