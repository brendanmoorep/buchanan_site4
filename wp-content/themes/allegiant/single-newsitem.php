<?php get_header(); ?>
<?php $currentItemID = get_the_ID(); ?>
<?php get_template_part('template-parts/element', 'singlenewspage-header'); ?>
    <div id="main" class="main">
        <div class="container">
            <section id="content" class="content page-content">
                <?php do_action('cpotheme_before_content'); ?>
                <?php if(have_posts()) while(have_posts()): the_post(); ?>
                    <?php
                        $dateString = get_cfc_field('news_item_details', 'news-item-date', false);
                        $time = strtotime($dateString);
                        $post->date = $time;
                    ?>
                    <h2><?php the_title(); ?></h2>
                    <h3><?php echo date('F d, Y', $post->date); ?></h3>
                    <?php the_content(); ?>
                <?php endwhile; ?>
                <?php do_action('cpotheme_after_content'); ?>
            </section>
            <div class="sidebar">
                <h2 class="">Other News</h2>
        <?php
            $newsItems = [];
            $query = new WP_Query('post_type=newsitem&posts_per_page=-1');
            if($query->posts):
                $newsItems = [];
                foreach($query->posts as $post){
                    if($currentItemID !== $post->ID){
                        $dateString = get_cfc_field('news_item_details', 'news-item-date', false);
                        $time = strtotime($dateString);
                        $post->date = $time;
                        $newsItems[$time] = $post;
                    }
                }
                krsort($newsItems);
                foreach ($newsItems as $item):

         ?>
                    <article class="news-item">
                        <div class="news-item-date bg-light-blue color-white">
                            <div class="day">
                                <?php echo date('d', $item->date); ?>
                            </div>
                            <div class="month-year">
                                <?php echo date('M', $item->date); ?> <?php echo date('Y', $item->date); ?>
                            </div>
                        </div>
                        <a href="<?php the_permalink($item->ID); ?>"><h3 class="color-blue"><?php echo $item->post_title; ?></h3></a>
                        <p><?php echo $item->post_excerpt; ?></p>
                        <?php
                        //            $newsLink = get_cfc_field('news_item_details', 'news-item-link', $item->ID);
                        //            if($newsLink !== ""):
                        //                ?>
                        <!--                    <a href="--><?php //echo $newsLink; ?><!--" class="btn-transparent" target="_blank">Read More</a>-->
                        <!--                --><?php
                        //            endif;
                        ?>
                        <a href="<?php the_permalink($item->ID); ?>" class="btn-transparent">Read More</a>
                    </article>
          <?php
                endforeach;
              endif;
          ?>
            </div>
            <div class="clear"></div>
            <hr>
        </div>
    </div>

<?php get_footer(); ?>