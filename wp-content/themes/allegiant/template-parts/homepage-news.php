<?php
    $query = new WP_Query('post_type=news&posts_per_page=-1');
    if($query->posts):
    $newsItems = [];
    foreach($query->posts as $post){
        $dateString = get_cfc_field('news_item_details', 'news-item-date', false);
        $time = strtotime($dateString);
        $post->date = $time;
        $newsItems[$time] = $post;
    }
        krsort($newsItems);
?>
<div id="news" class="news">
    <h2 class="underline center">Recent News</h2>
	<div class="container">
        <?php
        foreach($newsItems as $item):
            //debugg($item);
?>
  <div class="col-md-4 col-sm-12">
    <article class="news-item">
        <div class="news-item-date bg-light-blue color-white">
            <div class="day">
                <?php echo date('d', $item->date); ?>
            </div>
            <div class="month-year">
                <?php echo date('M', $item->date); ?> <?php echo date('Y', $item->date); ?>
            </div>
         </div>
         <h3 class="color-blue"><?php echo $item->post_title; ?></h3>
         <p><?php echo $item->post_excerpt; ?></p>
        <?php
            $newsLink = get_cfc_field('news_item_details', 'news-item-link', $item->ID);
            if($newsLink !== ""):
                ?>
                    <a href="<?php echo $newsLink; ?>" class="btn-transparent" target="_blank">Read More</a>
                <?php
            endif;
        ?>
     </article>
  </div>
<?php
        endforeach;
?>
	</div>
</div>
<?php endif; ?>
