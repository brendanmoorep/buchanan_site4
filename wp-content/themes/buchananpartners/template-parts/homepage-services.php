<?php $query = new WP_Query('post_type=cpo_service&order=ASC&orderby=menu_order&meta_key=service_featured&meta_value=1&numberposts=-1&posts_per_page=-1'); ?>
<?php if($query->posts): $feature_count = 0; ?>
<div id="services" class="services dark services-container">
	<div class="container">
		<h2 class="underline center">Our Services</h2>
		<?php cpotheme_grid($query->posts, 'element', 'service', 3); ?>
	</div>
</div>
<?php endif; ?>
