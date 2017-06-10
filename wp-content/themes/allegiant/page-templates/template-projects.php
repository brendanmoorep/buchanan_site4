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

			<?php
                cpotheme_secondary_menu('property_type', 'menu-portfolio');
            ?>

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