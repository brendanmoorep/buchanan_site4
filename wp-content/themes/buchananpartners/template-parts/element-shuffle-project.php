<?php
    $groupClasses = str_replace(["','","['","']","'"], ' ', $post->termsAttr);
?>
<div data-project-id="<?php echo $post->ID; ?>" data-groups="[<?php echo $post->termsAttr; ?>]" class="portfolio-item col-xs-12 col-sm-6 <?php echo $groupClasses; ?>">

    <?php //foreach( get_cfc_meta( 'project_details' ) as $key => $value ): ?>
        <?php 
            //$photo_obj = get_cfc_field( 'project_details','images', false, $key ); 
            $featured_img_url = get_the_post_thumbnail_url($post->ID,'full');
        ?>
            <span class="portfolio-item-image" style="background-image: url('<?php echo $featured_img_url; ?>'); background-size: cover; background-position: undefined;"></span>
            <div class="property-content center">
                <h3 class="portfolio-item-title underline light"><?php the_title(); ?></h3>
                <span class="glyphicon glyphicon-map-marker color-light-blue"></span>
                <h4 class="color-light-blue"><?php echo get_cfc_field('project_location', 'location', $post->ID) ?></h4>
                <?php the_excerpt(); ?>
                <a class="btn-transparent" href="<?php the_permalink(); ?>">Project Details</a>
            </div>
        <?php
                //break;
            //endforeach;
        ?>
</div>