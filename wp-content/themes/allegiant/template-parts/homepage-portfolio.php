<?php
            $featuredProjectsQuery = array(
                'post_type' => 'projects',
                'posts_per_page'=>-1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'property_type',
                        'terms' => 'featured',
                        'field'    => 'slug'

                    )
                )
            );
            $query = new WP_Query($featuredProjectsQuery);
?>
<?php if($query->posts): ?>
    <section id="homepage-projects" class="homepage-projects bg-white center">
        <h2 class="underline center">Featured Projects</h2>
        <div class="container">
            <div class="row">
                <?php
                foreach($query->posts as $post):
                    setup_postdata($post);
                     get_template_part('template-parts/element-homepage-project');

                endforeach;
                ?>
            </div>
        </div>
        <a href="<?php echo get_permalink( get_page_by_title( 'Projects' )); ?>" class="btn-transparent margin-top-45">View all Projects</a>
    </section>
    <?php wp_reset_postdata(); ?>
<?php endif; ?>