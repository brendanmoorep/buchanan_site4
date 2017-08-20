<div class="portfolio-item col-md-4 col-sm-12">

    <?php foreach( get_cfc_meta( 'project_details' ) as $key => $value ): ?>
        <?php $photo_obj = get_cfc_field( 'project_details','images', false, $key ); ?>
            <span class="portfolio-item-image" style="background-image: url('<?php echo $photo_obj['url']; ?>'); background-size: cover; background-position: undefined;"></span>
            <div class="property-content center">
                <h3 class="portfolio-item-title underline light"><?php the_title(); ?></h3>
                <span class="glyphicon glyphicon-map-marker color-light-blue"></span>
                <h4 class="color-light-blue"><?php echo get_cfc_field('project_location', 'location', $post->ID) ?></h4>
                <?php the_excerpt(); ?>
                <a class="btn-transparent" href="<?php the_permalink(); ?>">Project Details</a>
            </div>
        <?php
                break;
            endforeach;
        ?>
</div>