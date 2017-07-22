var mapsLoaded = false;

function googleMapsLoaded(){
    console.log('maps loaded');
    mapsLoaded = true;
}

jQuery( document ).ready(function() {
    var Shuffle = window.shuffle;
    function isEntered(value){
        return !isNaN(parseInt(value));
    }

    var myShuffle = new Shuffle(jQuery('.shuffle-container'), {
        itemSelector: '.available-property',
        sizer: '.properties #shuffle-sizer',
        isCentered:true
    });

    jQuery('.available-property .btn_wrapper a').click(function(e){
        e.preventDefault();
    });

    jQuery('.available-property .btn_wrapper').click(function(){
        jQuery(this).closest('.available-property').addClass('active');
    });

    jQuery('.property-contact-wrapper > span').click(function(){
        jQuery(this).closest('.available-property').removeClass('active');
    });

    /* CLEAR ALL FILTERS */
    jQuery('#clear-filters').click(function(){
       myShuffle.sort({});
       myShuffle.filter();
    });

    /* PRICE SORT / FILTER */
    jQuery('.price-sort').click(function(){
       var type = jQuery(this).attr('data-sort-type');
       var options = {
           reverse: type === 'desc',
           by: function(element){
               return element.getAttribute('data-price').toLowerCase();
           }
       }
        myShuffle.sort(options);
    });

    jQuery('.price-filter input').change(function(){
        var filterFunction;
        var maxVal = jQuery('.price-filter [data-filter-id="max"]').val();
        var minVal = jQuery('.price-filter [data-filter-id="min"]').val();
        if(isEntered(maxVal) && isEntered(minVal)){
            filterFunction = function(element){
                var price = parseInt(element.getAttribute('data-price'));
                return price >= minVal && price <= maxVal;
            }
        }else if(isEntered(minVal)){
            filterFunction = function(element){
                var price = parseInt(element.getAttribute('data-price'));
                return price >= minVal;
            }
        }else if(isEntered(maxVal)){
            filterFunction = function(element){
                var price = parseInt(element.getAttribute('data-price'));
                return price <= maxVal;
            }
        }

        myShuffle.filter(filterFunction);
    });

    /* SIZE SQFT SORT / FILTER */
    jQuery('.size-sort').click(function(){
        var type = jQuery(this).attr('data-sort-type');
        var options = {
            reverse: type === 'desc',
            by: function(element){
                return element.getAttribute('data-sqft').toLowerCase();
            }
        }
        myShuffle.sort(options);
    });

    jQuery('.size-filter input').change(function(){
        var filterFunction;
        var maxVal = jQuery('.size-filter [data-filter-id="max"]').val();
        var minVal = jQuery('.size-filter [data-filter-id="min"]').val();
        if(isEntered(maxVal) && isEntered(minVal)){
            filterFunction = function(element){
                var price = parseInt(element.getAttribute('data-sqft'));
                return price >= minVal && price <= maxVal;
            }
        }else if(isEntered(minVal)){
            filterFunction = function(element){
                var price = parseInt(element.getAttribute('data-sqft'));
                return price >= minVal;
            }
        }else if(isEntered(maxVal)){
            filterFunction = function(element){
                var price = parseInt(element.getAttribute('data-sqft'));
                return price <= maxVal;
            }
        }

        myShuffle.filter(filterFunction);
    });

    /* DISTANCE FROM ADDRESS */
    function sortPropertiesByDistance(){
        console.log('sort');
        myShuffle.sort({
            by: function(element){
                return element.getAttribute('data-distance');
            }
        })
    }

    jQuery('#zipcode-sort').change(function(geocoder){
        function getDistanceBetween(p1, p2){
            function getMiles(i) {
                return i*0.000621371192;
            }
            var rad = function(x) {
                return x * Math.PI / 180;
            };

            p2.lat = (typeof p2.lat === "function") ? p2.lat() : p2.lat;
            p2.lng = (typeof p2.lng === "function") ? p2.lng() : p2.lng;

            var R = 6378137; // Earth’s mean radius in meter
            var dLat = rad(p2.lat - p1.lat());
            var dLong = rad(p2.lng - p1.lng());
            var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(rad(p1.lat())) * Math.cos(rad(p2.lat)) *
                Math.sin(dLong / 2) * Math.sin(dLong / 2);
            var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            var d = R * c;
            return Math.round(getMiles(d)); // returns the distance in meter
        }
        function setLocationAttributes(property,geoCodedAddress, location){
            var distance = getDistanceBetween(geoCodedAddress, location);
            property.attr('data-distance', distance);
            property.find('.mileage-indicator').html('<div class="glyphicon glyphicon-map-marker padding-right"></div>' + distance + ' miles').show();
        }
        function getPropertiesLocations(geocoder, geoCodedAddress){
            var properties = jQuery('.available-property');
            var totalProperties = properties.length - 1;
            properties.each(function(i){
                var property = jQuery(this);
                if(property.attr('data-geolocation') !== undefined){
                    var location = JSON.parse(property.attr('data-geolocation'));
                    setLocationAttributes(property,geoCodedAddress, location);
                    if(i === totalProperties){
                        sortPropertiesByDistance();
                    }
                }else{
                    var address = property.attr('data-location');
                    geocoder.geocode( { 'address': address }, function(results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            var location = results[0].geometry.location;
                            property.attr('data-geoLocation', JSON.stringify({
                                lat : location.lat(),
                                lng : location.lng()
                            }));
                            setLocationAttributes(property,geoCodedAddress, location);
                            if(i === totalProperties){
                                sortPropertiesByDistance();
                            }
                        }else{
                            console.log('geocode failed',results, status);
                        }
                    });
                }
            });
        }
        var addressEntered = jQuery(this).val();
        if(mapsLoaded){
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode( { 'address': addressEntered }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    var geoCodedAddress = results[0].geometry.location;
                    getPropertiesLocations(geocoder,geoCodedAddress);
                }else{
                    alert('Please enter a valid address');
                }
            });
        }

    });

    /* PROPERTY TYPES FILTER */
    function createPropTypeFilter(types){
        function capFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }
        var wrapper = jQuery('#property-type-wrapper .dropdown-menu');
        for (var prop in types) {
            var li = ' <li class="type-filter '+ types[prop] +'" data-filter-type="' + types[prop] + '"><a>' + capFirstLetter(types[prop]) + '</a></li>';
            wrapper.append(li);
        }
    }

    function addPropTypeFilterEvents(){
        jQuery('#property-type-wrapper .dropdown-menu li').click(function () {
            var type = jQuery(this).attr('data-filter-type');
            myShuffle.filter(function(element){
                return element.getAttribute('data-property-type') === type;
            });
        })
    }

    //propertyTypes variable is set in template-properties.php as global var
    //propertyTypes = JSON.parse(propertyTypes);
    if(propertyTypes){
        createPropTypeFilter(propertyTypes);
        addPropTypeFilterEvents();
    }


    // jQuery('.categories-list button').click(function(e){
    //     jQuery('#taxonomies-filter button').removeClass('active');
    //     jQuery(this).toggleClass('active');
    //     var type = jQuery(this).attr('data-group');
    //     myShuffle.filter(function (element) {
    //         var groups = jQuery(element).attr('data-groups');
    //         return groups.indexOf(type) > 0;
    //     });
    //     filterMapMarkers(type);
    // });
    //
    // jQuery('.project-filter a').click(function(e){
    //     jQuery('#taxonomies-filter button').removeClass('active');
    //     var type = jQuery(this).attr('data-filter');
    //     filterMapMarkers(type);
    //     myShuffle.filter(function (element) {
    //         var groups = jQuery(element).attr('data-groups');
    //         switch(type){
    //             case 'all':
    //                 return true;
    //                 break;
    //
    //             case 'archived':
    //                 return groups.indexOf('archived') > 0;
    //                 break;
    //
    //             case 'new':
    //                 return groups.indexOf('new') > 0;
    //                 break;
    //         }
    //     });
    // });

    // jQuery(".portfolio-item").mouseenter(function() {
    //     var id = jQuery(this).attr('data-project-id');
    //     makeMarkerActive(id);
    // }).mouseleave(function() {
    //     var id = jQuery(this).attr('data-project-id');
    //     makeMarkerInactive(id);
    // });

});
