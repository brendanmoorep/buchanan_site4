<?php /* Template Name: About Us */ ?>
<?php get_header(); ?>

<?php get_template_part('template-parts/element', 'page-header'); ?>
    <div id="about-us-page">
        <div class="container">
            <section id="content" class="content">
                <?php if(have_posts()) while(have_posts()): the_post(); ?>
                    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="page-content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </section>
            <?php //get_sidebar(); ?>
            <div class="clear"></div>
            <section class="services-container">
<!--                <div class="container">-->
<!--                    <div class="row">-->
<!--                        -->
                <?php if(get_query_var('paged')) $current_page = get_query_var('paged'); else $current_page = 1; ?>
                <?php $query = new WP_Query('post_type=cpo_service&paged='.$current_page.'&posts_per_page=-1&order=ASC&orderby=menu_order'); ?>
                    <section id="services" class="services">
                        <h2>Our Expertise</h2>
                        <?php cpotheme_grid($query->posts, 'element', 'service', 3); ?>
                    </section>
<!--                    </div>-->
<!--                </div>-->
            </section>
        </div>
     </div>
<?php get_footer(); ?>