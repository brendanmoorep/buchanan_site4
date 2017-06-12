<?php /* Template Name: Projects */ ?>
<?php get_header(); ?>

<?php get_template_part('template-parts/element', 'page-header'); ?>

<div id="main" class="main">
	<div class="container">
		<section id="content" class="content">
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
                        <ul class="dropdown-menu">
                            <li><a href="#">All Projects</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">Current Projects</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">Old Projects</a></li>
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
                                echo '<button id="taxonomy-filter" data-tax-type="' . $pt->slug . '" type="button" class="btn btn-default ' . $pt->slug . '">' . $pt->name . '</button>';
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
				<?php cpotheme_grid($query->posts, 'element', 'project', 3, array('class' => 'column-fit')); ?>
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

<?php get_footer(); ?>