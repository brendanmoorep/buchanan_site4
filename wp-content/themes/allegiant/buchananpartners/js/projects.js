function makeMarkerActive(id){
    removeMapMarkers(id);
    addMapMarker(markers[id], true);
    markers[id].infoWindow.open(map, markers[id].marker);
}

function makeMarkerInactive(id){
    removeMapMarkers(id);
    addMapMarker(markers[id], false);
    markers[id].infoWindow.close(map, markers[id].marker);
}

function addMarkerInfoWindow(post) {
    var marker = post.marker;
    console.log(post);
    var contentString = '<div class="info-window">' +
        '<h4>' + post.title + '</h4>' +
        '<p>' + post.location + '</p>' +
        '<a href="' + post.link + '">Property Details</a>' +
        '</div>';
    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });
    marker.addListener('mouseover', function() {
        infowindow.open(map, post.marker);
    });
    marker.addListener('mouseout', function() {
        infowindow.close(map, post.marker);
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
        obj.marker.setMap(null);
        return;
    }
    for(var key in markers) {
        var obj = markers[key];
        obj.marker.setMap(null);
    }
}

function filterMapMarkers(type){
    removeMapMarkers();
    addMapMarkers(type);
}

function initMap() {
    var uluru = {lat: 38.89511, lng: -77.03637};
    map = new google.maps.Map(document.getElementById('projects-map'), {
        zoom: 10,
        center: uluru,
        scrollwheel:  false
    });
    addMapMarkers();
}

jQuery( document ).ready(function() {
    var Shuffle = window.shuffle;
    var myShuffle = new Shuffle(jQuery('.my-shuffle'), {
        itemSelector: '.portfolio-item',
        sizer: '#shuffle-sizer',
        buffer: 1,
    });

    jQuery('.categories-list button').click(function(e){
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

});
