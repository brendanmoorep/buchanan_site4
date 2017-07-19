<?php /* Template Name: Properties */ ?>
<?php get_header(); ?>
<?php
$mapMarkers = [];
?>
<?php get_template_part('template-parts/element', 'page-header'); ?>
    <div class="gray-box-full-width">
        <div class="container">
                <div class="filter-section">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default">Price</button>
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="caret"></span> <span class="sr-only"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li class="price-filter"><a>Max <input type="number" data-filter-id="max" class="form-control" placeholder="$" /></a></li>
                            <li class="price-filter"><a>Min <input type="number" data-filter-id="min" class="form-control" placeholder="$" /></a></li>
                            <li role="separator" class="divider"></li>
                            <li class="price-sort" data-sort-type="asc"><a>Ascending <span class="glyphicon glyphicon-sort-by-attributes"></span></a></li>
                            <li class="price-sort" data-sort-type="desc"><a>Descending <span class="glyphicon glyphicon-sort-by-attributes-alt"></span></a></li>
                        </ul>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-default">Sq/Ft</button>
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="caret"></span> <span class="sr-only"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li class="size-filter"><a>Max <input type="number" data-filter-id="max" class="form-control" placeholder="sqft" /></a></li>
                            <li class="size-filter"><a>Min <input type="number" data-filter-id="min" class="form-control" placeholder="sqft" /></a></li>
                            <li role="separator" class="divider"></li>
                            <li class="size-sort" data-sort-type="asc"><a>Ascending</a></li>
                            <li class="size-sort" data-sort-type="desc"><a>Descending</a></li>
                        </ul>
                    </div>
                </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div>
                <section>
                    <?php $query = new WP_Query('post_type=projects&order=ASC&orderby=menu_order'); ?>
                    <?php if($query->posts): ?>
                        <section id="properties-page" class="properties">
                            <div class="row">
                                <div class="shuffle-container">
                                    <?php
                                        $i=0;
                                        foreach($query->posts as $post):
                                            setup_postdata($post);
                                            $properties_meta = get_cfc_meta( 'properties' );
                                             foreach($properties_meta as $key => $value):
                                                $property_image = get_cfc_field( 'properties','property_images', false, $key );
                                             ?>
                                         <div class="available-property <?php echo isset($properties_meta[$key]['property-type']) ? $properties_meta[$key]['property-type'] : ''; ?>"  data-sqft="<?php echo $properties_meta[$key]['sqft']; ?>" data-price="<?php echo $properties_meta[$key]['rate']; ?>">
                                             <div class="property-image-wrapper" style="background-image: url('<?php echo $property_image['sizes']['medium']; ?>'); background-size: cover; background-position: undefined;">
                                                 <?php
                                                    if(isset($properties_meta[$key]['availability-type'])){
                                                        echo '<span>For ' . $properties_meta[$key]['availability-type'] . '</span>';
                                                    }
                                                  ?>
                                             </div>
                                             <div class="col-md-8 col-md-offset-4">
                                                 <div class="text-content">
                                                    <h3><?php echo $properties_meta[$key]['properties_title']; ?></h3>
                                                    <p><?php echo $properties_meta[$key]['properties_description']; ?></p>
                                                 </div>
                                                 <div class="property-item">
                                                     <?php echo isset($properties_meta[$key]['sqft']) ? '<div class="col-md-2"><div class="icon-wrapper"><span class="glyphicon glyphicon-th-large"></span></div><p>' . $properties_meta[$key]['sqft'] . ' sqft</p></div>' : ""; ?>
                                                    <admin></admin> <?php echo isset($properties_meta[$key]['rate']) ? '<div class="col-md-2"><div class="icon-wrapper"><span class="glyphicon glyphicon-usd"></span></div><p><span>$</span><span>' .  $properties_meta[$key]['rate'] . '</span> /mo</p></div>' : ""; ?>
                                                     <div class="col-md-8">
                                                         <div class="icon-wrapper"><span class="glyphicon glyphicon-map-marker"></span></div>
                                                         <p><?php the_cfc_field('project_location', 'location'); ?></p>
                                                     </div>
                                                 </div>
                                                 <div class="clear"></div>
                                                 <div class="btn_wrapper"><a href="javascript:void(0);" class="property-contact-btn">Contact Info</a><span class="glyphicon glyphicon-arrow-right"></span></div>
                                             </div>
                                             <div class="clear"></div>
                                             <div class="property-contact-wrapper">
                                                <span class="glyphicon glyphicon-remove"></span>
                                                 <h3>Contact us about this property</h3>
                                                 <div class="row">
                                                     <?php if(isset($properties_meta[$key]['contact-name'])): ?>
                                                         <div class="col-md-4">
                                                             <span class="glyphicon glyphicon-user"></span>
                                                            <p><?php echo $properties_meta[$key]['contact-name']; ?></p>
                                                         </div>
                                                     <?php endif; ?>
                                                     <?php if(isset($properties_meta[$key]['contact-email'])): ?>
                                                         <div class="col-md-4">
                                                             <a href="mailto:<?php echo $properties_meta[$key]['contact-email']; ?>"><span class="glyphicon glyphicon-envelope"></span></a>
                                                             <p><a href="mailto:<?php echo $properties_meta[$key]['contact-email']; ?>"><?php echo $properties_meta[$key]['contact-email']; ?></a></p>
                                                         </div>
                                                     <?php endif; ?>
                                                     <?php if(isset($properties_meta[$key]['contact-phone-number'])): ?>
                                                         <div class="col-md-4">
                                                             <a href="tel:<?php echo $properties_meta[$key]['contact-phone-number']; ?>"><span class="glyphicon glyphicon-earphone"></span></a>
                                                             <p><a href="tel:<?php echo $properties_meta[$key]['contact-phone-number']; ?>"><?php echo $properties_meta[$key]['contact-phone-number']; ?></a></p>
                                                         </div>
                                                     <?php endif; ?>
                                                 </div>
                                                 <p><a href="<?php get_permalink(3579); ?>">Or visit our Contact Us Page <span class="glyphicon glyphicon-menu-right"></span></a></p>
                                             </div>
                                         </div>
                                    <?php
                                             if($i == 1 ) {
                                                 $i = 0;
                                                 // echo '<div class="clear"></div>';
                                             }else{
                                                 $i++;
                                             }
                                             endforeach;
                                         endforeach;
                                    ?>
                                    <span id="shuffle-sizer"></span>
                                </div>
                            </div>
                        </section>
                        <?php wp_reset_postdata(); ?>
                    <?php endif; ?>
                    <?php do_action('cpotheme_after_content'); ?>
                </section>
            </div>
        </div><!-- end container-fluid -->
    </div>
    <script type="text/javascript" src="/wp-content/themes/allegiant/buchananpartners/js/properties.js"></script>
<?php get_footer(); ?>