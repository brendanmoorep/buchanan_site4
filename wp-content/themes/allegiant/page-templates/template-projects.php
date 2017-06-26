<?php /* Template Name: Projects */ ?>
<?php get_header(); ?>
<?php
    $mapMarkers = [];
?>
<?php get_template_part('template-parts/element', 'page-header'); ?>
<div id="main" class="main">
    <div class="gray-box-full-width">
        <div class="container">
            <div class="row">
                <div id="taxonomies-filter">
                    <div class="section">
                        <span><b>Filter by:</b></span>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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

                    <div class="section categories-list">
                        <span><b>Categories:</b></span>
                        <?php
                        // cpotheme_secondary_menu('property_type', 'menu-portfolio');
                        $propertyTypes = get_terms('property_type', 'order=ASC&orderby=name');
                        if(sizeof($propertyTypes) > 0){
                            foreach($propertyTypes as $pt):
                                if($pt->slug !== "new" && $pt->slug !== "archived"){
                                    echo '<button data-group="' . $pt->slug . '" type="button" class="taxonomy-filter btn btn-default ' . $pt->slug . '">' . $pt->name . '</button>';
                                }
                            endforeach;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div id="projects-map-wrapper">
                    <div id="projects-map"></div>
                    <div id="content">
                        <h2>Buchanan Partners Projects</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                        <h4>Commercial</h4>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                        <h4>Residential</h4>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <section>
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
                                        $marker = array(
                                            'ID' => $post->ID,
                                            'title' => $post->post_title,
                                            'location'=> get_cfc_field('project_location', 'location', $post->ID),
                                            'categories' => $termsAttr,
                                            'link' => get_permalink()
                                        );
                                        $mapMarkers[$post->ID] = $marker;
                                    endforeach;
                                    ?>
                                    <div id="shuffle-sizer" class="col-md-6 col-sm-12"></div>
                                </div>
                            </div>
                        </section>
                        <?php wp_reset_postdata(); ?>
                    <?php endif; ?>

                    <?php do_action('cpotheme_after_content'); ?>
                </section>
            </div>
        </div>
    </div><!-- end container-fluid -->



</div>
<script>
    var map;
    var markers = <?php echo json_encode($mapMarkers); ?>;
</script>
<script type="text/javascript" src="/wp-content/themes/allegiant/buchananpartners/js/projects.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDvsunr_JTCCR55es0vf3c8zO0kjwl35nk&callback=initMap"></script>
<?php get_footer(); ?>