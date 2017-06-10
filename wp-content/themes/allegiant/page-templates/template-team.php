<?php /* Template Name: Team */ ?>
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
            <?php
            $nonPrincipalArgs = array(
                'post_type' => 'cpo_team',
                'meta_query' => array(
                array(
                    'key' => 'team_founding_principal',
                    'compare' => 'NOT EXISTS',
                ),
                array(
                    'key' => 'team_featured',
                    'compare' => 'NOT EXISTS',
                )));
            ?>
            <?php $teamQuery = new WP_Query($nonPrincipalArgs); ?>
            <?php $foundersQuery = new WP_Query('post_type=cpo_team&order=ASC&orderby=menu_order&meta_key=team_founding_principal&meta_value=1&posts_per_page=-1'); ?>
            <?php $principlesQuery = new WP_Query('post_type=cpo_team&order=ASC&orderby=menu_order&meta_key=team_featured&meta_value=1&posts_per_page=-1'); ?>
			<?php if($foundersQuery->posts): $feature_count = 0; ?>
            <?php ?>
			<section id="team" class="team">
                <div id="founders">
                    <h3>Our Founders</h3>
                    <?php cpotheme_grid($foundersQuery->posts, 'element', 'team', 3); ?>
                </div>
                <div id="principles">
                    <h3>Our Principles</h3>
                    <?php cpotheme_grid($principlesQuery->posts, 'element', 'team', 4); ?>
                </div>
                <div id="the-team">
                    <h3>The Team</h3>
                    <?php cpotheme_grid($teamQuery->posts, 'element', 'team', 4); ?>
                </div>
                    <?php
//                    foreach ($foundersQuery->posts as $key => $post ):
//                        //$meta = get_post_meta($post->ID,null,true);
//                        //$data = maybe_unserialize($meta);
//                        debugg($post);
//                    endforeach;
                    ?>
			</section>
			<?php // cpotheme_numbered_pagination($query); ?>
			<?php wp_reset_postdata(); ?>
			<?php endif; ?>
			
			<?php do_action('cpotheme_after_content'); ?>
		</section>
		<?php // get_sidebar(); ?>
		<div class="clear"></div>
	</div>
</div>

<?php get_footer(); ?>