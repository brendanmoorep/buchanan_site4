<?php
    $terms = get_the_terms($post->ID, 'property_type');
    $termIds = [];
    $termsAttr = '';
    if($terms){
        foreach ($terms as $term):
            array_push($termIds, $term->slug);
        endforeach;
     $termsAttr = join(",",$termIds);
    }
?>
<div style="" data-categories="[<?php echo $termsAttr; ?>]" class="portfolio-item dark <?php if(has_excerpt()) echo ' portfolio-item-has-excerpt'; ?>">
    <?php foreach( get_cfc_meta( 'project_details' ) as $key => $value ){ ?>
    <?php $photo_obj = get_cfc_field( 'project_details','images', false, $key ); ?>
	 <a class="portfolio-item-image" style="background-image: url('<?php echo $photo_obj['url']; ?>'); background-size: cover; background-position: undefined;" href="<?php the_permalink(); ?>">
        <?php break; }  ?>
			<div class="portfolio-item-overlay primary-color-bg"></div>
		<h3 class="portfolio-item-title">
			<?php the_title(); ?>
		</h3>
		<?php if(has_excerpt()): ?>
		<div class="portfolio-item-description">
			<?php //the_excerpt(); ?>
			<?php //cpotheme_edit(); ?>
		</div>
		<?php endif; ?>
	</a>
</div>