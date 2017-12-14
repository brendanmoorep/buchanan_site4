<?php wp_reset_query(); ?>

<?php
    if($GLOBALS['SKIP_FEATURED_IMAGE'] == true){
        $header_image = '/wp-content/uploads/2017/05/hero1.jpg';
    }
    else if(has_post_thumbnail( $post->ID )){
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
        $header_image = $image[0];
    }else{
        $header_image = '/wp-content/uploads/2017/05/hero1.jpg';
    }
?>

<?php do_action('cpotheme_before_title'); ?>
<section id="pagetitle" class="pagetitle dark" style="background-image:url('<?php echo $header_image; ?>');"' >
    <?php if($header_image != ""): ?>
        <div class="title-overlay"></div>
    <?php endif; ?>
	<div class="container">
		<?php do_action('cpotheme_title'); ?>
        <?php  echo the_cfc_field( 'headercontent', 'header-content' );?>
	</div>
</section>
<?php do_action('cpotheme_after_title'); ?>
