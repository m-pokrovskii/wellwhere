import { Rating } from './ui-init.js';
import { Uri } from './ui-init.js';

const GM = (function($) {
	let map;
	let infowindow;
	let mapcluster;
	let is_fit_bounds = false;
	let inProcess = false;
	let isfirstTimeLoaded;

	const singleMap = $('.wellwhere-map');
	const clusterIcon = singleMap.attr('data-cluster-icon');
	const mapStyles = JSON.parse(mapData.styles);
	const listingItemsContainer = $('.ContainerListingItems');
	const listingsContainer = $('.ListingItems');

	
	function init() {
		$(window).on('hashchange', handleHashChange);
		firstTimeLoad();		

		singleMap.each(function(){
			map = new_map( $(this) );
			if ( $(this).is('[data-listing-map]') ) {
				handleMapMovement( map );
			}
		});
	}

	function firstTimeLoad() {
		$(document).ready(function() {
			const uriMap = $.uriAnchor.makeAnchorMap();
			isfirstTimeLoaded = true;
			handleHashChange();
			// console.log(uriMap);
			if (uriMap.rating) {
				$('.ListingFilter__rating-field').dropdown('set selected', uriMap.rating);
			}
			if (uriMap.gender) {
				$('.ListingFilter__gender-field').dropdown('set selected', uriMap.gender);
			}
			if (uriMap.activity) {
				const activityArray = uriMap.activity.split(',');
				$('.ListingFilter__activity-field').checkbox('uncheck');
				$.each(activityArray, function(index, val) {
					const checkbox = $('input[name="activity"][value="' + val + '"]');
					checkbox.parent('.ListingFilter__activity-field').checkbox('check');
				});
			}
		});
	}

	function handleHashChange(e) {
		const uriMap = $.uriAnchor.makeAnchorMap();
		if ( uriMap.type == 'map' || uriMap.type == 'filter' || uriMap.type == 'pagination' ) {
			listingsContainer.dimmer('show');
			// if ( inProcess ) { return } else { inProcess = true };
			$.ajax({
				url: data.adminAjax,
				type: 'GET',
				data: {        
				  action: 'get_gyms_by_uri',
				  uri: uriMap
				},
			})
			.done(function(r) {
				console.log(r);
				if (r.success) {
					dealListingItems(r.data.markers, r.data.pagination);
					clearAllMarkers();
					$.each(r.data.markers, function(index, el) {
						 add_marker( el.lat, el.lng, el.pin, el.html, map );
					});
					
					if ( uriMap.type == 'filter' || uriMap.type == 'pagination' || isfirstTimeLoaded == true ) {
						wellwhereFitBounds();	
					}
					if (mapcluster) {
						mapcluster.clearMarkers();
						mapcluster.addMarkers(map.markers);
					}  else {
						if (map.markers.length > 1) {
							mapcluster = cluster(map, map.markers);
						}
					}
				} else {
					removeListingItems();
					clearAllMarkers();
				}
			})
			.fail(function(e) {
				console.log(e.statusText);
			})
			.always(function() {
				isfirstTimeLoaded = false;
				inProcess         = false;
			});
		};
	}

	function handleMapMovement( map ) {
		google.maps.event.addListener(map, 'bounds_changed', mapMovement);
		// google.maps.event.addListener(map, 'dragend', mapMovement);
		// google.maps.event.addListener(map, 'zoom_changed', mapMovement);
	}

	function clearAllMarkers() {
		while(map.markers.length) { map.markers.pop().setMap(null); }
	}

	function dealListingItems( listingItems, $pagination ) {
		listingItemsContainer.html("");
		$.each(listingItems, function(index, item) {
			listingItemsContainer.append(item.listingItem);
		});
		Rating.init();
		if ($pagination) {
			listingItemsContainer.append($pagination);
		}
		listingsContainer.dimmer('hide');
	}


	function removeListingItems() {
		listingItemsContainer.html("");
	}

	function mapMovement() {
		let bounds = {};
		if ( is_fit_bounds ) { return; }
		bounds.lat_TR = map.getBounds().getNorthEast().lat();
		bounds.lng_TR = map.getBounds().getNorthEast().lng();
		bounds.lat_BL = map.getBounds().getSouthWest().lat();
		bounds.lng_BL = map.getBounds().getSouthWest().lng();		
		
		let mapUri = {
			type: 'map',
			map: 'listing',
			page: 1,
			_map: bounds
		}
		
		Uri.extend(mapUri);
	}

	function new_map( $el ) {
		let $markers = $el.find('.marker');
		const scrollwheel = $el.attr('data-scrollwheel') || false;
		let args = {
			zoom: 16,
			center: new google.maps.LatLng(0, 0),
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			scrollwheel: scrollwheel,
			streetViewControl: false,
			mapTypeControl: false,
			styles: mapStyles,
			// TODO. Probably need to remove
			gestureHandling: "greedy"
		};

		// create map
		map = new google.maps.Map( $el[0], args);

		// add a markers reference
		map.markers = [];

		// add markers
		$markers.each(function(){
			const lat = $(this).attr('data-lat');
			const lng = $(this).attr('data-lng');
			const pin = $(this).attr('data-icon');
			const markerHtml = $(this).html();
			// map.markers
			add_marker( lat, lng, pin, markerHtml, map );
		});

		wellwhereFitBounds();
		return map;
	}

	function add_marker( lat, lng, pin, markerHtml, map ) {
		const latlng = new google.maps.LatLng( lat, lng );
	
		// create marker
		let marker = new google.maps.Marker({
			position:  latlng,
			// animation: google.maps.Animation.DROP,
			map:       map,
			icon:      pin
		});

		// add to array
		map.markers.push( marker );

		// if marker contains HTML, add it to an infoWindow
		if( markerHtml ) {
			// show info window when marker is clicked
			google.maps.event.addListener(marker, 'click', function() {
				if ( infowindow ) { infowindow.close() }
				infowindow = new InfoBox({
					alignBottom: true,
					maxWidth: 343,
					pixelOffset: new google.maps.Size(-171, -80),
					closeBoxURL: data.url + "/assets/img/icon-svg-error.svg",
					content: markerHtml
				});
				infowindow.open( map, marker );
			});
		}

	}

	// function center_map( map ) {
	// 	let bounds = new google.maps.LatLngBounds();
	// 	// loop through all markers and create bounds
	// 	$.each( map.markers, function( i, marker ){

	// 		let latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

	// 		bounds.extend( latlng );

	// 	});

	// 	wellwhereFitBounds();
	// }

	function cluster(map, markers) {
		return new MarkerClusterer(map, markers, {
			styles: [{
				url: 'http://wellwhere.lm/wp-content/themes/wellwhere/assets/img/map-marker-red-round.png',
				height: 50,
				width: 50,
				textColor: "#fff",
				textSize: 14
			}]
		});
	}

	function wellwhereFitBounds() {
		is_fit_bounds = true;
		let bounds = new google.maps.LatLngBounds();
		// loop through all markers and create bounds
		$.each( map.markers, function( i, marker ){
			let latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );
			bounds.extend( latlng );
		});

		if( map.markers.length == 1 ) {
			// set center of map
			map.setCenter( bounds.getCenter() );
			map.setZoom( 16 );

			google.maps.event.addListenerOnce(map, 'idle', function() {
			    is_fit_bounds = false;  
			});
		}
		else {
			map.fitBounds( bounds );
			mapcluster = cluster(map, map.markers);

			google.maps.event.addListenerOnce(map, 'idle', function() {
			    is_fit_bounds = false;  
			});
		}
	}

	return {
		init: init
	}
})(jQuery);
GM.init();
