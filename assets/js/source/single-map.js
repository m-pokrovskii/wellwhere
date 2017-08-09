const GM = (function($) {
  let map;
  let infowindow;
  const singleMap = $('.wellwhere-map');
  const clusterIcon = singleMap.attr('data-cluster-icon');
  const mapStyles = JSON.parse(mapData.styles);
  
  function init() {
      singleMap.each(function(){
        map = new_map( $(this) );
      });
  }

  function new_map( $el ) {
    let $markers = $el.find('.marker');
    const scrollwheel = $el.attr('data-scrollwheel') || false;
    let args = {
      zoom		: 16,
      center		: new google.maps.LatLng(0, 0),
      mapTypeId	: google.maps.MapTypeId.ROADMAP,
      scrollwheel: scrollwheel,
      streetViewControl: false,
      mapTypeControl: false,
      styles: mapStyles
    };


    // create map
    let map = new google.maps.Map( $el[0], args);


    // add a markers reference
    map.markers = [];


    // add markers
    $markers.each(function(){
        add_marker( $(this), map );
    });


    // center map
    center_map( map );

    // return
    return map;

  }

  function add_marker( $marker, map ) {
    let latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );
    const pin =  $marker.attr('data-icon');    


    // create marker
    let marker = new google.maps.Marker({
      position	: latlng,
      animation: google.maps.Animation.DROP,
      map			: map,
      icon: pin
    });

    // add to array
    map.markers.push( marker );

    // if marker contains HTML, add it to an infoWindow
    if( $marker.html() ) {
      // show info window when marker is clicked
      google.maps.event.addListener(marker, 'click', function() {
        if ( infowindow ) { infowindow.close() }
        infowindow = new InfoBubble({
          padding: 0,
          shadowStyle: 0,
          borderRadius: 0,
          borderColor: '#E0E0E0',
          disableAnimation: true,
          hideCloseButton: false,
          content:  $marker.html(),
        });
        infowindow.open( map, marker );
      });
    }

  }

  function center_map( map ) {
    let bounds = new google.maps.LatLngBounds();

    // loop through all markers and create bounds
    $.each( map.markers, function( i, marker ){

      let latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

      bounds.extend( latlng );

    });

    // only 1 marker?
    if( map.markers.length == 1 )
    {
      // set center of map
        map.setCenter( bounds.getCenter() );
        map.setZoom( 16 );
    }
    else
    {
      // fit to bounds
      map.fitBounds( bounds );
      let markerCluster = new MarkerClusterer(map, map.markers, {
        styles: [{
  				url: 'http://wellwhere.lm/wp-content/themes/wellwhere/assets/img/map-marker-red-round.png',
          height: 50,
          width: 50,
          textColor: "#fff",
          textSize: 14
  			}]
      });
    }

  }

  return {
    init: init
  }
})(jQuery);
GM.init();
