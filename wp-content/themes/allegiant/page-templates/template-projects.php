<?php /* Template Name: Projects */ ?>
<?php get_header(); ?>

<?php get_template_part('template-parts/element', 'page-header'); ?>

<div id="main" class="main">
	<div class="container">
		<section>
			<?php do_action('cpotheme_before_content'); ?>
			
			<?php if(have_posts()) while(have_posts()): the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="page-content">
					<?php the_content(); ?>
				</div>
			</div>
			<?php endwhile; ?>
            <div id="taxonomies-filter">
                <div class="section">
                    <span><b>Filter by:</b></span>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Project Type <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu project-filter">
                            <li><a data-filter="all" href="#">All Projects</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a data-filter="new" href="#">Current Projects</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a data-filter="archived" href="#">Old Projects</a></li>
                        </ul>
                    </div>
                </div>

                <div class="section categories-list">
                    <span><b>Categories:</b></span>
                    <?php
                    // cpotheme_secondary_menu('property_type', 'menu-portfolio');
                    $propertyTypes = get_terms('property_type', 'order=ASC&orderby=name');
                    if(sizeof($propertyTypes) > 0){
                        foreach($propertyTypes as $pt):
                            if($pt->slug !== "new" && $pt->slug !== "archived"){
                                echo '<button data-group="' . $pt->slug . '" type="button" class="taxonomy-filter btn btn-default ' . $pt->slug . '">' . $pt->name . '</button>';
                            }
                        endforeach;
                    }
                    ?>
                </div>
            </div>
			<?php if(get_query_var('paged')) $current_page = get_query_var('paged'); else $current_page = 1; ?>	
			<?php $query = new WP_Query('post_type=projects&paged='.$current_page.'&posts_per_page=16&order=ASC&orderby=menu_order'); ?>
            <?php

            ?>
			<?php if($query->posts): $feature_count = 0; ?>
			<section id="portfolio" class="portfolio">
               <div class="row">
                   <div class="my-shuffle">
                    <?php /*   <figure class="js-item column">
                        <div class="aspect aspect--16x9">
                            <div class="aspect__inner"><img src="https://images.unsplash.com/uploads/141310026617203b5980d/c86b8baa?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=600&amp;h=338&amp;fit=crop&amp;s=882e851a008e83b7a80d05bdc96aa817" obj.alt="obj.alt"/></div>
                        </div>
                    </figure>
                    <figure class="js-item column">
                        <div class="aspect aspect--16x9">
                            <div class="aspect__inner"><img src="https://images.unsplash.com/photo-1484402628941-0bb40fc029e7?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=600&amp;h=338&amp;fit=crop&amp;s=6237e62a10fa079d99b088b0db0144ac" obj.alt="obj.alt"/></div>
                        </div>
                    </figure>
                    <figure class="js-item column">
                        <div class="aspect aspect--16x9">
                            <div class="aspect__inner"><img src="https://images.unsplash.com/uploads/1413142095961484763cf/d141726c?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=600&amp;h=338&amp;fit=crop&amp;s=86dc2dcb74588b338dfbb15d959c5037" obj.alt="obj.alt"/></div>
                        </div>
                    </figure>
                    <figure class="js-item column">
                        <div class="aspect aspect--16x9">
                            <div class="aspect__inner"><img src="https://images.unsplash.com/photo-1465414829459-d228b58caf6e?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=600&amp;h=338&amp;fit=crop&amp;s=7ab1744fe016fb39feb2972244246359" obj.alt="obj.alt"/></div>
                        </div>
                    </figure>
                    <figure class="js-item column row-span">
                        <div class="aspect aspect--9x80">
                            <div class="aspect__inner"><img src="https://images.unsplash.com/photo-1416184008836-5486f3e2cf58?ixlib=rb-0.3.5&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=601&amp;h=676&amp;fit=crop&amp;s=5f1f1ffba05979d4248cc16d8eb82f0a" obj.alt="obj.alt"/></div>
                        </div>
                    </figure>
                    <div class="column my-sizer-element"></div>
                </div> */ ?>
                    <?php
                        foreach($query->posts as $post):
                            setup_postdata($post);
                            get_template_part('template-parts/element-shuffle-project', esc_attr('project'));
                        endforeach;
                    ?>
                       <div id="shuffle-sizer" class="col-md-4 col-sm-6 col-xs-12"></div>
                    </div>
               </div>
                <?php // cpotheme_grid($query->posts, 'element', 'project', 3, array('class' => 'column-fit')); ?>
            </section>
			<?php cpotheme_numbered_pagination($query); ?>
			<?php wp_reset_postdata(); ?>
			<?php endif; ?>
			
			<?php do_action('cpotheme_after_content'); ?>
		</section>
		<?php get_sidebar(); ?>
		<div class="clear"></div>
	</div>
</div>
<script>
    (function($){
        $( document ).ready(function() {
            var Shuffle = window.shuffle;
            var myShuffle = new Shuffle($('.my-shuffle'), {
                itemSelector: '.portfolio-item',
                sizer: '#shuffle-sizer',
                buffer: 1,
            });

            $('.categories-list button').click(function(e){
                $('#taxonomies-filter button').removeClass('active');
                $(this).toggleClass('active');
                var type = $(this).attr('data-group');
                myShuffle.filter(function (element) {
                    var groups = $(element).attr('data-groups');
                    return groups.indexOf(type) > 0;
                });
            });

            $('.project-filter a').click(function(e){
                $('#taxonomies-filter button').removeClass('active');
                var type = $(this).attr('data-filter');
                myShuffle.filter(function (element) {
                    var groups = $(element).attr('data-groups');
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
        });
    })(jQuery);
</script>
<?php get_footer(); ?>