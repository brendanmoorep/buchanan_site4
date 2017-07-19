jQuery( document ).ready(function() {
    function isEntered(value){
        return !isNaN(parseInt(value));
    }
    var Shuffle = window.shuffle;
    var myShuffle = new Shuffle(jQuery('.shuffle-container'), {
        itemSelector: '.available-property',
        sizer: '#shuffle-sizer',
        buffer: 1,
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
