<?php /* Template Name: Contact Us */ ?>
<?php get_header(); ?>

<?php get_template_part('template-parts/element', 'page-header'); ?>
    <div id="contact-us-page" class="white-overlay">
        <div id="contact-info" class="main-bg center">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-4">
                        <div class="contact-icon"><span class="glyphicon glyphicon-map-marker"></span></div>
                        <h3>Address</h3>
                        <?php the_cfc_field('contact_information', 'address'); ?>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                        <div class="contact-icon"><span class="glyphicon glyphicon-earphone"></span></div>
                        <h3>Phone & Fax</h3>
                        <?php the_cfc_field('contact_information', 'phone'); ?>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                        <div class="contact-icon"><span class="glyphicon">&#x2709;</span></div>
                        <h3>Email</h3>
                        <?php the_cfc_field('contact_information', 'email'); ?>
                    </div>
                </div>
            </div>
        </div>
            <?php echo do_shortcode( '[wpgmza id="1"]' ); ?>
            <div class="container">
                <section id="content" class="content">
                    <?php do_action('cpotheme_before_content'); ?>
                    <?php if(have_posts()) while(have_posts()): the_post(); ?>
                        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <div class="page-content">
                                <?php the_content(); ?>
                                <?php cpotheme_post_pagination(); ?>
                            </div>
                        </div>
                        <?php comments_template('', true); ?>
                    <?php endwhile; ?>
                    <?php do_action('cpotheme_after_content'); ?>
                </section>
                <?php //get_sidebar(); ?>
                <div class="clear"></div>
            </div>
        </div>
<?php get_footer(); ?>