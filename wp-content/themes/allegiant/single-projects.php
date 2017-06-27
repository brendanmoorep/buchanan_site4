<?php get_header(); ?>

<?php //get_template_part('template-parts/element', 'page-header'); ?>

<?php if(have_posts()) while(have_posts()): the_post(); ?>
<div id="main" class="main">
	<div class="container-fluid">
        <div class="row">
            <section id="project-gallery" class="photos-area col-md-6">
                <!-- Slider -->
                <div id="header-carousel" class="carousel carousel-fade slide header-carousel" data-ride="carousel" data-interval="10000" data-pause="hover">

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
                            <h1><?php the_title(); ?></div></h1>
                        <?php the_content(); ?>
                    </div>
                    <div id="properties-wrapper">
                        <?php
                            $properties_meta = get_cfc_meta( 'properties' ); // all values in properties field custom meta box
                            foreach($properties_meta as $key => $value):
                                $property_image = get_cfc_field( 'properties','property_images', false, $key );
                                //debugg($property_image);
                            ?>
                                <article class="">
                                    <div>
                                        <h4><?php echo $properties_meta[$key]['properties_title']; ?></h4>
                                        <p><?php echo $properties_meta[$key]['properties_description']; ?></p>
                                        <img src="<?php echo $property_image['sizes']['medium']; ?>" />
                                    </div>
                                </article>
                        <?php
                                //debugg($property_image);
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

<?php get_footer(); ?>