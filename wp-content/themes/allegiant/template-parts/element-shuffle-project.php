<?php
    $terms = get_the_terms($post->ID, 'property_type');
    $termIds = [];
    $termsAttr = '';
    if($terms){
        foreach ($terms as $term):
            array_push($termIds, $term->slug);
        endforeach;
     $termsAttr = join("','",$termIds);
     $termsAttr = "'" . $termsAttr . "'";

    }
?>
<div data-groups="[<?php echo $termsAttr; ?>]" class="portfolio-item col-md-4 col-sm-6 col-xs-12">
    <?php foreach( get_cfc_meta( 'project_details' ) as $key => $value ): ?>
        <?php
                $photo_obj = get_cfc_field( 'project_details','images', false, $key );
        ?>
            <a class="portfolio-item-image" style="background-image: url('<?php echo $photo_obj['url']; ?>'); background-size: cover; background-position: undefined;" href="<?php the_permalink(); ?>">
                <div><h3 class="portfolio-item-title"><?php the_title(); ?></h3></div>
                <div class="portfolio-item-overlay primary-color-bg"></div>
            </a>
        <?php
                break;
            endforeach;
        ?>
</div>