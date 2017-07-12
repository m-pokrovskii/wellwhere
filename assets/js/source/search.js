// const content = [
//   { title: 'Andorra', zip: '12411', description: 'zip: 12411'  },
//   { title: 'United Arab Emirates', zip: '012' },
//   { title: 'Afghanistan' },
//   { title: 'Antigua' },
//   { title: 'Anguilla' },
//   { title: 'Albania' },
//   { title: 'Armenia' },
//   { title: 'Netherlands Antilles' },
//   { title: 'Angola' },
//   { title: 'Argentina' },
//   { title: 'American Samoa' },
//   { title: 'Austria' },
//   { title: 'Australia' },
//   { title: 'Aruba' },
//   { title: 'Aland Islands' },
//   { title: 'Azerbaijan' },
//   { title: 'Bosnia' },
//   { title: 'Barbados' },
//   { title: 'Bangladesh' },
//   { title: 'Belgium' },
//   { title: 'Burkina Faso' },
//   { title: 'Bulgaria' },
//   { title: 'Bahrain' },
//   { title: 'Burundi' }
//   // etc
// ];
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
