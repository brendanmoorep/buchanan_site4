<?php
    get_header();
    $GLOBALS['SKIP_FEATURED_IMAGE'] = false;
?>

<?php get_template_part('template-parts/element', 'page-header'); ?>

<div id="main" class="main">
	<div id="single-team-member" class="container">
		<?php cpotheme_post_media(get_the_ID(), 'image'); ?>
		<section id="content" class="content">
			<?php do_action('cpotheme_before_content'); ?>
			<?php if(have_posts()) while(have_posts()): the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="page-content">
                    <h2><?php the_title(); ?></h2>
                    <h4><?php echo get_post_meta($post->ID,'member-title',true); ?></h4>
					<?php the_content(); ?>
				</div>
				<?php cpotheme_post_pagination(); ?>
				<div class="clear"></div>
			</div>
			<?php endwhile; ?>
			
			<?php do_action('cpotheme_after_content'); ?>
		</section>
		<?php //get_sidebar(); ?>
		<div class="clear"></div>
	</div>
</div>

<?php get_footer(); ?>