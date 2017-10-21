<?php get_header(); ?>

<?php //get_template_part('template-parts/element', 'page-header'); ?>

<?php if(have_posts()) while(have_posts()): the_post(); ?>
<div id="main" class="main">
	<div class="container-fluid">
        <div class="row">
            <section id="project-gallery" class="photos-area col-md-6">
                <!-- Slider -->
                <div id="header-carousel" class="carousel carousel-fade slide header-carousel" data-ride="carousel" data-interval="5000" data-pause="hover">

                    <!-- Slider Indicators -->
                    <a class="left carousel-control">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>

                    <div class="carousel-inner" role="listbox">
                        <?php  $images = get_cfc_meta( 'project_details' );?>
                        <?php
                        $i = 0;
                        foreach($images as $key => $value ): ?>
                            <?php $photo_obj = get_cfc_field( 'project_details','images', false, $key ); ?>
                            <div class="item <?php echo $i == 0 ? "active" : ""; ?>" style="background-image: url('<?php echo $photo_obj['url']; ?>'); background-size: cover;"></div>
                        <?php
                            $i++;
                            endforeach;
                        ?>
                    </div>
                    <div id="indicators-wrapper">
                        <div id="indicators-bg"></div>
                        <div class="carousel-indicators">
                            <?php
                            $i = 0;
                            foreach($images as $key => $value ): ?>
                                <?php $photo_obj = get_cfc_field( 'project_details','images', false, $key ); ?>
                                <div data-target="#header-carousel" data-slide-to="<?php echo $i; ?>" class="thumb <?php echo $i == 0 ? "active" : ""; ?>" onclick="goToSlide(<?php echo $i; ?>)" style="background-image: url('<?php echo $photo_obj['url']; ?>'); background-size: cover; background-position: undefined;"></div>
                                <?php
                                $i++;
                            endforeach;
                            ?>
                        </div>
                    </div>
                </div>
                <!-- End Slider -->
            </section>
            <section class="col-md-6">
                <div id="content" class="content">
                    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="page-content">
                            <h2><?php the_title(); ?></h2>
                            <h4><span class="glyphicon glyphicon-map-marker"></span><?php the_cfc_field('project_location', 'location'); ?></h4>
                            <?php the_content(); ?>
                        </div>
                    </div>
                    <div id="properties-wrapper">
                        <?php
                            $properties_meta = get_cfc_meta( 'properties' ); // all values in properties field custom meta box
                            echo !empty($properties_meta) ? '<h3 class="blue-heading">Available Properties</h3>' : '<p>There are currently no available properties for lease</p>';
                            foreach($properties_meta as $key => $value):
                                $property_image = get_cfc_field( 'properties','property_images', false, $key );
                            ?>
                                <article class="available-property col-md-12">
                                    <div class="property-image-wrapper" style="background-image: url('<?php echo $property_image['sizes']['medium']; ?>'); background-size: cover; background-position: undefined;">
                                        <span>For Lease</span>
                                    </div>
                                    <div class="col-md-8 col-md-offset-4">
                                        <h3><?php echo $properties_meta[$key]['properties_title']; ?></h3>
                                        <p><?php echo $properties_meta[$key]['properties_description']; ?></p>
                                        <div class="property-item">
                                            <?php echo isset($properties_meta[$key]['sqft']) ? '<div class="col-md-2"><div class="icon-wrapper"><span class="glyphicon glyphicon-th-large"></span></div><p>' . $properties_meta[$key]['sqft'] . ' sqft</p></div>' : ""; ?>
                                            <?php echo isset($properties_meta[$key]['rate']) ? '<div class="col-md-2"><div class="icon-wrapper"><span class="glyphicon glyphicon-usd"></span></div><p><span>$</span><span>' .  $properties_meta[$key]['rate'] . '</span> /mo</p></div>' : ""; ?>
                                            <div class="col-md-8">
                                                <div class="icon-wrapper"><span class="glyphicon glyphicon-map-marker"></span></div>
                                                <p><?php the_cfc_field('project_location', 'location'); ?></p>
                                            </div>
                                        </div>
                                        <div class="clear"></div>
                                        <div class="btn_wrapper"><a href="" class="property-contact-btn">Contact Info</a><span class="glyphicon glyphicon-arrow-right"></span></div>
                                    </div>
                                </article>
                        <?php
                            endforeach;
                        ?>
                    </div>
                    <div class="clear"></div>
                <?php endwhile; ?>
        </div>
        </section>
        </div>
	</div>
</div>
<div id="project-single-map"></div>
<script>
    function initMap() {
        var marker, map;
        var location = '<?php the_cfc_field('project_location', 'location') ; ?>';
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode( { 'address': location }, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                map = new google.maps.Map(document.getElementById('project-single-map'), {
                    zoom: 14,
                    center: results[0].geometry.location,
                    scrollwheel:  false,
                    styles : getMapTheme()
                });
                marker = new google.maps.Marker({
                    position: results[0].geometry.location,
                    map: map,
                    icon:'/wp-content/uploads/2017/06/diamond-light-1.png'
                });
                var infowindow = new google.maps.InfoWindow({
                    content: location
                });
                infowindow.open(map, marker);
            }
        });

    }
</script>
    <script>
        jQuery(".carousel-control.left").click(function() {
            jQuery("#header-carousel").carousel('pause');
            jQuery("#header-carousel").carousel('prev');
        });
        jQuery(".carousel-control.right").click(function() {
            jQuery("#header-carousel").carousel('pause');
            jQuery("#header-carousel").carousel('next');
        });
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDvsunr_JTCCR55es0vf3c8zO0kjwl35nk&callback=initMap"></script>
<?php get_footer(); ?>