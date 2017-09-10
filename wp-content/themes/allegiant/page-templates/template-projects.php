<?php /* Template Name: Projects */ ?>
<?php $mapMarkers = []; ?>
<?php get_header(); ?>
<div class="gray-box-full-width">
    <div class="container">
        <div class="row">
            <div id="taxonomies-filter">
                <div class="section property-types">
                    <span><b>Filter by:</b></span>
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Project Type <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu project-filter">
                            <li><a data-filter="all" href="javascript:void(0);">All Projects</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a data-filter="new" href="javascript:void(0);">Current Projects</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a data-filter="archived" href="javascript:void(0);">Old Projects</a></li>
                        </ul>
                    </div>
                </div>

                <div class="section project-categories categories-list">
                    <span><b>Categories:</b></span>
                    <?php
                    // cpotheme_secondary_menu('property_type', 'menu-portfolio');
                    $propertyTypes = get_terms('property_type', 'order=ASC&orderby=name');
                    if(sizeof($propertyTypes) > 0){
                        foreach($propertyTypes as $pt):
                            if($pt->slug !== "new" && $pt->slug !== "archived" && $pt->slug !== "featured"){
                                echo '<button data-group="' . $pt->slug . '" type="button" class="category taxonomy-filter btn btn-primary ' . $pt->slug . '">' . $pt->name . '</button>';
                            }
                        endforeach;
                    }
                    ?>
                </div>
                <div class="section project-categories categories-list-mobile">
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Property Category <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu project-category-filter">
                            <?php
                                if(sizeof($propertyTypes) > 0){
                                    foreach($propertyTypes as $pt):
                                        if($pt->slug !== "new" && $pt->slug !== "archived" && $pt->slug !== "featured"){
                                            echo '<li><a class="' . $pt->slug . ' category" data-group="' . $pt->slug . '" href="javascript:void(0);">' . $pt->name . '</a></li>';
                                            //echo '<button data-group="' . $pt->slug . '" type="button" class="taxonomy-filter btn btn-primary ' . $pt->slug . '">' . $pt->name . '</button>';
                                        }
                                    endforeach;
                                }
                            ?>
                        </ul>
                    </div>
                </div>
                <span id="clear-filters">Clear All <span class="glyphicon glyphicon-remove-circle"></span></span>
            </div>
        </div>
    </div>
</div>
<div id="main" class="main">
    <div id="projects-map-wrapper">
        <div id="projects-map"></div>
    </div>
    <div id="projects-content-wrapper" class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-lg-6 col-md-offset-0 col-lg-offset-6">
                <?php $query = new WP_Query('post_type=projects&order=ASC&orderby=menu_order'); ?>
                <?php if($query->posts): ?>
                    <section id="portfolio" class="portfolio">
                        <div class="row">
                            <div class="my-shuffle">
                                <?php
                                foreach($query->posts as $post):
                                    setup_postdata($post);
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
                                    $post->termsAttr = $termsAttr;
                                    get_template_part('template-parts/element-shuffle-project', esc_attr('project'));
                                    $properties = get_cfc_meta( 'properties' );
                                    $marker = array(
                                        'ID' => $post->ID,
                                        'title' => $post->post_title,
                                        'location'=> get_cfc_field('project_location', 'location', $post->ID),
                                        'categories' => $termsAttr,
                                        'link' => get_permalink(),
                                        'properties' => $properties, // this will be empty array if none entered
                                        'buchanan_properties_link' => get_permalink(3639)
                                    );
                                    $mapMarkers[$post->ID] = $marker;
                                endforeach;
                                ?>
                                <div id="shuffle-sizer" class="col-xs-12 col-sm-6"></div>
                            </div>
                        </div>
                    </section>
                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>
                <?php do_action('cpotheme_after_content'); ?>
            </div>
        </div><!-- end row -->
    </div><!-- end container-fluid -->
</div>
<div id="projects-footer-wrapper">
    <span id="projects-footer-menu">
        <div class="menu-mobile-open menu-mobile-toggle"></div>
        <div class="menu-mobile-close menu-mobile-toggle"></div>
    </span>
    <?php get_footer(); ?>
</div>
<script>
    var map;
    var markers = <?php echo json_encode($mapMarkers); ?>;
</script>
<script type="text/javascript" src="/wp-content/themes/allegiant/buchananpartners/js/projects.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDvsunr_JTCCR55es0vf3c8zO0kjwl35nk&callback=initMap"></script>
