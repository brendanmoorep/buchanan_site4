<?php /* Template Name: Contact Us */ ?>
<?php get_header(); ?>

<?php //get_template_part('template-parts/element', 'page-header'); ?>
    <div id="contact-us-page" class="bg-white">
        <div id="contact-info" class="center color-blue">
            <div class="container">
                <div class="row">
                    <h1 class="underline color-white center"><?php the_title();?></h1>
                    <div class="col-xs-12 col-sm-3 col">
                        <div>
                            <div class="contact-icon color-white"><span class="glyphicon glyphicon-map-marker"></span></div>
                            <h3>Address</h3>
                            <?php the_cfc_field('contact_information', 'address'); ?>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-3 col">
                        <div>
                            <div class="contact-icon color-white"><span class="glyphicon glyphicon-earphone"></span></div>
                            <h3>Phone & Fax</h3>
                            <?php the_cfc_field('contact_information', 'phone'); ?>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-3 col">
                        <div>
                            <div class="contact-icon color-white"><span class="glyphicon">&#x2709;</span></div>
                            <h3>Email</h3>
                            <span class="color-blue"><?php the_cfc_field('contact_information', 'email'); ?></span>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-3 col">
                        <div>
                            <div class="contact-icon color-white"><span class="glyphicon glyphicon-wrench"></span></div>
                            <h4>Tenant Service Request Portal</h4>
                            <a class="color-blue btn-transparent margin-top-10" target="_blank" href="<?php the_cfc_field('contact_information', 'tenant-service-request-portal'); ?>">Request Service</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <?php echo do_shortcode( '[wpgmza id="1"]' ); ?>
            <div class="container" class="margin-top-35">
                <section id="content" class="content">
                    <?php do_action('cpotheme_before_content'); ?>
                    <?php if(have_posts()) while(have_posts()): the_post(); ?>
                        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <div class="page-content">
                                <?php the_content(); ?>
                                <?php cpotheme_post_pagination(); ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                    <?php do_action('cpotheme_after_content'); ?>
                </section>
                <?php //get_sidebar(); ?>
                <div class="clear"></div>
            </div>
        </div>
<?php get_footer(); ?>