<div class="team-member">
	<?php the_post_thumbnail('portfolio', array('class' => 'team-member-image', 'title' => '')); ?>
	<div class="team-member-body">
		<h3 class="team-member-title underline"><?php the_title(); ?></h3>
        <h4><?php the_cfc_field('team_details', 'member-title'); ?></h4>
		<div class="team-member-content">
			<?php the_excerpt(); ?>
            <a class="btn-transparent" href="<?php the_permalink(); ?>">Read More</a>
		</div>
	</div>
</div>