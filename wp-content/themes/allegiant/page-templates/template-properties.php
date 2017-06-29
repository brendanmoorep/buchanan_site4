<?php /* Template Name: Properties */ ?>
<?php get_header(); ?>
<?php
$mapMarkers = [];
?>
<?php get_template_part('template-parts/element', 'page-header'); ?>
    <div id="main" class="main">
    <div class="gray-box-full-width" style="display:none;">
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
    <div id="projects-content-wrapper" class="container">
        <div class="row">
            <div>
                <div id="projects-map-wrapper">
                    <div id="projects-map"></div>
                    <div id="content">

                    </div>
                </div>
                    <section>
                        <?php $query = new WP_Query('post_type=projects&order=ASC&orderby=menu_order'); ?>
                        <?php if($query->posts): ?>
                            <section id="properties" class="properties">
                                <div class="row">
                                        <?php
                                            foreach($query->posts as $post):
                                                setup_postdata($post);
                                                $properties_meta = get_cfc_meta( 'properties' );
                                                 foreach($properties_meta as $key => $value):
                                                    $property_image = get_cfc_field( 'properties','property_images', false, $key );
                                        ?>
                                                     <div class="col-md-12">
                                                         <article class="available-property">
                                                             <div class="property-image-wrapper" style="background-image: url('<?php echo $property_image['sizes']['medium']; ?>'); background-size: cover; background-position: undefined;">
                                                                 <span>For Lease</span>
                                                             </div>
                                                             <div class="col-md-8 col-md-offset-4">
                                                                 <div class="text-content">
                                                                    <h3><?php echo $properties_meta[$key]['properties_title']; ?></h3>
                                                                    <p><?php echo $properties_meta[$key]['properties_description']; ?></p>
                                                                 </div>
                                                                 <div class="property-item">
                                                                     <?php echo isset($properties_meta[$key]['sqft']) ? '<div class="col-md-2"><div class="icon-wrapper"><span class="glyphicon glyphicon-th-large"></span></div><p>' . $properties_meta[$key]['sqft'] . ' sqft</p></div>' : ""; ?>
                                                                     <?php echo isset($properties_meta[$key]['rate']) ? '<div class="col-md-2"><div class="icon-wrapper"><span class="glyphicon glyphicon-usd"></span></div><p><span>$</span><span>' .  $properties_meta[$key]['rate'] . '</span> /mo</p></div>' : ""; ?>
                                                                     <div class="col-md-8">
                                                                         <div class="icon-wrapper"><span class="glyphicon glyphicon-map-marker"></span></div>
                                                                         <p><?php the_cfc_field('project_location', 'location'); ?></p>
                                                                     </div>
                                                                 </div>
                                                                 <div class="clear"></div>
                                                                 <div class="btn_wrapper"><a href="" class="property-contact-btn">Contact Info</a><span class="glyphicon glyphicon-arrow-right"></span></div>
                                                             </div>
                                                             <div class="clear"></div>
                                                         </article>
                                                     </div>
                                        <?php
                                                 endforeach;
                                             endforeach;
                                        ?>
                                </div>
                            </section>
                            <?php wp_reset_postdata(); ?>
                        <?php endif; ?>

                        <?php do_action('cpotheme_after_content'); ?>
                    </section>
            </div>
        </div><!-- end container-fluid -->
    </div>
<?php get_footer(); ?>