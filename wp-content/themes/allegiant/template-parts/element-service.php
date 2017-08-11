<div class="service">
	<?php cpotheme_icon(get_post_meta(get_the_ID(), 'service_icon', true), 'service-icon'); ?>
	<div class="service-body">
		<h3 class="service-title"><?php the_title(); ?></h3>
		<div class="service-content">
			<?php the_excerpt(); ?>
		</div>
	</div>
</div>