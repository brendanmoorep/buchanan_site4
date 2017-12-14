function makeMarkerActive(id){
    removeMapMarkers(id);
    addMapMarker(markers[id], true);
    markers[id].infoWindow.open(map, markers[id].marker);
    map.panTo(markers[id].geoCodedLocation);
    //map.setCenter(markers[id].geoCodedLocation);
}

function makeMarkerInactive(id){
    removeMapMarkers(id);
    addMapMarker(markers[id], false);
    markers[id].infoWindow.close(map, markers[id].marker);
}

function addMarkerInfoWindow(post) {
    var marker = post.marker;
    var contentString = '<div class="info-window">' +
        '<h4>' + post.title + '</h4>' +
        '<p>' + post.location + '</p>' +
        '<a target="_blank" href="' + post.link + '">Property Details</a>';
    if(post.properties.length && post.properties.length > 0){
        contentString += '<span> | </span>';
        contentString += '<a target="_blank" href="' + post.link + '">' + post.properties.length + ' available properties</a>';
    }
    contentString += '<br />';
    contentString += '<a target="_blank" href="' + post.buchanan_properties_link + '">See all available properties</a>';
    contentString += '</div>';

    var infoWinTimeout;
    function closeInfoWindow(window){
        jQuery('.info-window').removeClass('active');
        setTimeout(function(){
            window.close();
        },300);
    }
    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });
    marker.addListener('mouseover', function() {
        infowindow.open(map, post.marker);
    });
    marker.addListener('mouseout', function() {
        infoWinTimeout = setTimeout(function(){
           closeInfoWindow(infowindow);
        }, 500);
    });
    google.maps.event.addListener(infowindow, 'domready', function(e){
        jQuery('.info-window').addClass('active');
        jQuery('.info-window').on('mouseenter', function(e){
            clearTimeout(infoWinTimeout);
        }).on('mouseleave', function(e){
            clearTimeout(infoWinTimeout);
            closeInfoWindow(infowindow);
        });
    });
    post.infoWindow = infowindow;

}

function addMapMarker(obj, ligthen){
    var marker = null;
    if(!obj.location || typeof obj.location !== 'string') return false;
    var icon = ligthen === true ? '/wp-content/uploads/2017/06/diamond-light-1.png' : '/wp-content/uploads/2017/06/diamond.png';
    if(obj.geoCodedLocation){
        marker = new google.maps.Marker({
            position: obj.geoCodedLocation,
            map: map,
            icon:icon
        });
        if(marker){
            obj.marker = marker;
            addMarkerInfoWindow(obj);
        }
    }else{
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode( { 'address': obj.location }, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                marker = new google.maps.Marker({
                    position: results[0].geometry.location,
                    map: map,
                    icon:icon
                });
                if(marker){
                    obj.marker = marker;
                    obj.geoCodedLocation = results[0].geometry.location;
                    addMarkerInfoWindow(obj)
                }
            }else{
                console.log('failed', obj.location, results, status);
                return false;
            }
        });
    }
}

function addMapMarkers(type){
    var marker;
    // for(var i = 0; i < markers.length; i++) {
    for(var key in markers) {
        var obj = markers[key];
        if(obj.location && obj.location !== ''){
            if(type){
                if(obj.categories.indexOf(type) > 0) {
                    marker = addMapMarker(obj);
                }
            }else{
                marker = addMapMarker(obj);
            }
        }
    }
}

function removeMapMarkers(id){
    if(id){
        var obj = markers[id];
        if(obj.marker && obj.marker.setMap){
            obj.marker.setMap(null);
            return;
        }
    }
    for(var key in markers) {
        var obj = markers[key];
        if(obj && obj.marker && obj.marker.setMap){
            obj.marker.setMap(null);
        }
    }
}

function filterMapMarkers(type){
    removeMapMarkers();
    addMapMarkers(type);
}

function removeMapInfoWindows(){
    for(var key in markers) {
        var obj = markers[key];
        if(obj.infoWindow){
            console.log(obj);
            makeMarkerInactive(obj.ID);
        }
    }
}

function initMap() {
    var uluru = {lat: 38.89511, lng: -77.03637};
    map = new google.maps.Map(document.getElementById('projects-map'), {
        zoom: 10,
        center: uluru,
        scrollwheel:  false,
        styles: [ { "featureType": "administrative", "elementType": "all", "stylers": [ { "visibility": "on" }, { "lightness": 33 } ] }, { "featureType": "administrative", "elementType": "labels", "stylers": [ { "saturation": "-100" } ] }, { "featureType": "administrative", "elementType": "labels.text", "stylers": [ { "gamma": "0.75" } ] }, { "featureType": "administrative.neighborhood", "elementType": "labels.text.fill", "stylers": [ { "lightness": "-37" } ] }, { "featureType": "landscape", "elementType": "geometry", "stylers": [ { "color": "#f9f9f9" } ] }, { "featureType": "landscape.man_made", "elementType": "geometry", "stylers": [ { "saturation": "-100" }, { "lightness": "40" }, { "visibility": "off" } ] }, { "featureType": "landscape.natural", "elementType": "labels.text.fill", "stylers": [ { "saturation": "-100" }, { "lightness": "-37" } ] }, { "featureType": "landscape.natural", "elementType": "labels.text.stroke", "stylers": [ { "saturation": "-100" }, { "lightness": "100" }, { "weight": "2" } ] }, { "featureType": "landscape.natural", "elementType": "labels.icon", "stylers": [ { "saturation": "-100" } ] }, { "featureType": "poi", "elementType": "geometry", "stylers": [ { "saturation": "-100" }, { "lightness": "80" } ] }, { "featureType": "poi", "elementType": "labels", "stylers": [ { "saturation": "-100" }, { "lightness": "0" } ] }, { "featureType": "poi.attraction", "elementType": "geometry", "stylers": [ { "lightness": "-4" }, { "saturation": "-100" } ] }, { "featureType": "poi.park", "elementType": "geometry", "stylers": [ { "color": "#c5dac6" }, { "visibility": "on" }, { "saturation": "-95" }, { "lightness": "62" } ] }, { "featureType": "poi.park", "elementType": "labels", "stylers": [ { "visibility": "on" }, { "lightness": 20 } ] }, { "featureType": "road", "elementType": "all", "stylers": [ { "lightness": 20 } ] }, { "featureType": "road", "elementType": "labels", "stylers": [ { "saturation": "-100" }, { "gamma": "1.00" } ] }, { "featureType": "road", "elementType": "labels.text", "stylers": [ { "gamma": "0.50" } ] }, { "featureType": "road", "elementType": "labels.icon", "stylers": [ { "saturation": "50" }, { "gamma": "0.2" } ] }, { "featureType": "road.highway", "elementType": "geometry", "stylers": [ { "color": "#40b9ff" }, { "saturation": "-100" } ] }, { "featureType": "road.highway", "elementType": "geometry.stroke", "stylers": [ { "lightness": "-13" } ] }, { "featureType": "road.highway", "elementType": "labels.icon", "stylers": [ { "lightness": "0" }, { "gamma": "1.09" } ] }, { "featureType": "road.arterial", "elementType": "geometry", "stylers": [ { "color": "#40b9ff" }, { "saturation": "-100" }, { "lightness": "47" } ] }, { "featureType": "road.arterial", "elementType": "geometry.stroke", "stylers": [ { "lightness": "-12" } ] }, { "featureType": "road.arterial", "elementType": "labels.icon", "stylers": [ { "saturation": "-100" } ] }, { "featureType": "road.local", "elementType": "geometry", "stylers": [ { "color": "#40b9ff" }, { "lightness": "77" } ] }, { "featureType": "road.local", "elementType": "geometry.fill", "stylers": [ { "lightness": "5" }, { "saturation": "100" } ] }, { "featureType": "road.local", "elementType": "geometry.stroke", "stylers": [ { "saturation": "100" }, { "lightness": "15" } ] }, { "featureType": "transit.station.airport", "elementType": "geometry", "stylers": [ { "lightness": "47" }, { "saturation": "-100" } ] }, { "featureType": "water", "elementType": "all", "stylers": [ { "visibility": "on" }, { "color": "#acbcc9" } ] }, { "featureType": "water", "elementType": "geometry", "stylers": [ { "saturation": "53" } ] }, { "featureType": "water", "elementType": "labels.text.fill", "stylers": [ { "lightness": "-42" }, { "saturation": "17" } ] }, { "featureType": "water", "elementType": "labels.text.stroke", "stylers": [ { "lightness": "61" } ] } ]
    });
    addMapMarkers();

    map.addListener('click', function() {
        removeMapInfoWindows();
    });
}

jQuery( document ).ready(function() {
    var Shuffle = window.shuffle;
    var myShuffle = new Shuffle(jQuery('.my-shuffle'), {
        itemSelector: '.portfolio-item',
        sizer: '#shuffle-sizer',
        buffer: 1,
    });

    jQuery('#clear-filters').click(function(){
        myShuffle.sort({});
        myShuffle.filter();
    });

    jQuery('.project-categories .category').click(function(e){
        jQuery('#taxonomies-filter button').removeClass('active');
        jQuery(this).toggleClass('active');
        var type = jQuery(this).attr('data-group');
        myShuffle.filter(function (element) {
            var groups = jQuery(element).attr('data-groups');
            return groups.indexOf(type) > 0;
        });
        filterMapMarkers(type);
    });

    jQuery('.project-filter a').click(function(e){
        jQuery('#taxonomies-filter button').removeClass('active');
        var type = jQuery(this).attr('data-filter');
        filterMapMarkers(type);
        myShuffle.filter(function (element) {
            var groups = jQuery(element).attr('data-groups');
            switch(type){
                case 'all':
                    return true;
                    break;

                case 'archived':
                    return groups.indexOf('archived') > 0;
                    break;

                case 'new':
                    return groups.indexOf('new') > 0;
                    break;
            }
        });
    });

    jQuery(".portfolio-item").mouseenter(function() {
        var id = jQuery(this).attr('data-project-id');
        makeMarkerActive(id);
    }).mouseleave(function() {
        var id = jQuery(this).attr('data-project-id');
        makeMarkerInactive(id);
    });

    jQuery('#projects-footer-menu .menu-mobile-toggle').click(function(){
       jQuery('#projects-footer-wrapper').toggleClass('active');
    });

});
