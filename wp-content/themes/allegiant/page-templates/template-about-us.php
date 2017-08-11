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
            <div id="bubbles">
                <div class="circle">
                    <h3>Founded in 1998</h3>
                    <div class="circle">
                        <h3>Over 1,200 active properies</h3>
                        <div class="circle">
                            <h3>Over 5 million sq/ft of commercial properties</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="services-container">
            <div class="container">
                    <?php if(get_query_var('paged')) $current_page = get_query_var('paged'); else $current_page = 1; ?>
                    <?php $query = new WP_Query('post_type=cpo_service&paged='.$current_page.'&posts_per_page=-1&order=ASC&orderby=menu_order'); ?>
                    <section id="services" class="services">
                        <h2 class="underline color-white center">Core Services</h2>
                        <?php cpotheme_grid($query->posts, 'element', 'service', 3); ?>
                    </section>
            </div>
        </div>
    </div>
<?php get_footer(); ?>