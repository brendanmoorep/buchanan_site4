<?php get_header(); ?>
<?php
//    function cpotheme_home_slider(){
//        //if(is_front_page()) get_template_part('template-parts/homepage', 'slider');
//    }
//    //Add homepage features
//    function cpotheme_home_features(){
//        //if(is_front_page()) get_template_part('template-parts/homepage', 'features');
//    }
//    //Add homepage tagline
//    function cpotheme_home_tagline(){
//        //if(is_front_page()) cpotheme_block('home_tagline', 'tagline dark', 'container');
//    }
//    //Add homepage portfolio
//    function cpotheme_home_portfolio(){
//        //if(is_front_page()) get_template_part('template-parts/homepage', 'portfolio');
//    }
//    //Add homepage services
//    function cpotheme_home_services(){
//        //if(is_front_page()) get_template_part('template-parts/homepage', 'services');
//    }
//    //Add homepage team
//    function cpotheme_home_team(){
//        //if(is_front_page()) get_template_part('template-parts/homepage', 'team');
//    }
//    //Add homepage testimonials
//    function cpotheme_home_testimonials(){
//        //if(is_front_page()) get_template_part('template-parts/homepage', 'testimonials');
//    }
//    //Add homepage clients
//    function cpotheme_home_clients(){
//        //if(is_front_page()) get_template_part('template-parts/homepage', 'clients');
//    }
?>
<?php
    get_template_part('template-parts/homepage', 'slider');
    get_template_part('template-parts/homepage', 'portfolio');
?>
    <div class="container-fluid bg-white">
        <div class="row">
            <hr>
        </div>
    </div>
<?php
    get_template_part('template-parts/homepage', 'news');
    get_template_part('template-parts/homepage', 'services');
?>
<?php get_footer(); ?>