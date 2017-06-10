<div class="team-member">
	<?php the_post_thumbnail('portfolio', array('class' => 'team-member-image', 'title' => '')); ?>
	<div class="team-member-body">
		<h3 class="team-member-title"><?php the_title(); ?></h3>
		<div class="team-member-content">
			<?php the_excerpt(); ?>
            <a href="<?php the_permalink(); ?>">Read More</a>
		</div>
	</div>
</div>