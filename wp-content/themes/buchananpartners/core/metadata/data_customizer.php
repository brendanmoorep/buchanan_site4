<?php 

//Define customizer sections
if(!function_exists('cpotheme_metadata_panels')){
	function cpotheme_metadata_panels(){
		$data = array();
		
		$data['cpotheme_management'] = array(
		'title' => __('General Theme Options', 'buchananpartners'),
		'description' => __('Options that help you manage your theme better.', 'buchananpartners'),
		'priority' => 15);
		
		$data['cpotheme_layout'] = array(
		'title' => __('Layout', 'buchananpartners'),
		'description' => __('Here you can find settings that control the structure and positioning of specific elements within your website.', 'buchananpartners'),
		'priority' => 25);
		
		return apply_filters('cpotheme_customizer_panels', $data);
	}
}


//Define customizer sections
if(!function_exists('cpotheme_metadata_sections')){
	function cpotheme_metadata_sections(){
		$data = array();
		
		$data['epsilon-section-pro'] = array(
		'type' => 'epsilon-section-pro',
		'title'       => esc_html__( 'LITE vs PRO comparison', 'buchananpartners' ),
		'button_text' => esc_html__( 'Learn more', 'buchananpartners' ),
		'button_url'  => esc_url_raw( admin_url() . 'themes.php?page=cpotheme-welcome&tab=features' ),
		'priority'    => 0
		);

		
		$data['cpotheme_layout_general'] = array(
		'title' => __('Site Wide Structure', 'buchananpartners'),
		'capability' => 'edit_theme_options',
		'panel' => 'cpotheme_layout',
		'priority' => 25);
		
		$data['cpotheme_layout_home'] = array(
		'title' => __('Homepage', 'buchananpartners'),
		'capability' => 'edit_theme_options',
		'panel' => 'cpotheme_layout',
		'priority' => 50);
		
		if(defined('CPOTHEME_USE_SLIDES') && CPOTHEME_USE_SLIDES == true){
			$data['cpotheme_layout_slider'] = array(
			'title' => __('Slider', 'buchananpartners'),
			'capability' => 'edit_theme_options',
			'panel' => 'cpotheme_layout',
			'priority' => 50);
		}
		
		if(defined('CPOTHEME_USE_FEATURES') && CPOTHEME_USE_FEATURES == true){
			$data['cpotheme_layout_features'] = array(
			'title' => __('Features', 'buchananpartners'),
			'capability' => 'edit_theme_options',
			'panel' => 'cpotheme_layout',
			'priority' => 50);
		}
		
		if(defined('CPOTHEME_USE_PORTFOLIO') && CPOTHEME_USE_PORTFOLIO == true){
			$data['cpotheme_layout_portfolio'] = array(
			'title' => __('Portfolio', 'buchananpartners'),
			'capability' => 'edit_theme_options',
			'panel' => 'cpotheme_layout',
			'priority' => 50);
		}
		
		if(defined('CPOTHEME_USE_SERVICES') && CPOTHEME_USE_SERVICES == true){
			$data['cpotheme_layout_services'] = array(
			'title' => __('Services', 'buchananpartners'),
			'capability' => 'edit_theme_options',
			'panel' => 'cpotheme_layout',
			'priority' => 50);
		}
		
		if(defined('CPOTHEME_USE_TEAM') && CPOTHEME_USE_TEAM == true){
			$data['cpotheme_layout_team'] = array(
			'title' => __('Team Members', 'buchananpartners'),
			'capability' => 'edit_theme_options',
			'panel' => 'cpotheme_layout',
			'priority' => 50);
		}
		
		if(defined('CPOTHEME_USE_TESTIMONIALS') && CPOTHEME_USE_TESTIMONIALS == true){
			$data['cpotheme_layout_testimonials'] = array(
			'title' => __('Testimonials', 'buchananpartners'),
			'capability' => 'edit_theme_options',
			'panel' => 'cpotheme_layout',
			'priority' => 50);
		}
		
		if(defined('CPOTHEME_USE_CLIENTS') && CPOTHEME_USE_CLIENTS == true){
			$data['cpotheme_layout_clients'] = array(
			'title' => __('Clients', 'buchananpartners'),
			'capability' => 'edit_theme_options',
			'panel' => 'cpotheme_layout',
			'priority' => 50);
		}
		
		$data['cpotheme_typography'] = array(
		'title' => __('Typography', 'buchananpartners'),
		'description' => __('Custom typefaces for the entire site.', 'buchananpartners'),
		'capability' => 'edit_theme_options',
		'priority' => 45);

		$data['cpotheme_layout_posts'] = array(
		'title' => __('Blog Posts', 'buchananpartners'),
		'capability' => 'edit_theme_options',
		'panel' => 'cpotheme_layout',
		'priority' => 50);
		
		$data['cpotheme_typography'] = array(
		'title' => __('Typography', 'buchananpartners'),
		'capability' => 'edit_theme_options',
		'priority' => 45);
		
		return apply_filters('cpotheme_customizer_sections', $data);
	}
}


if(!function_exists('cpotheme_metadata_customizer')){
	function cpotheme_metadata_customizer($std = null){
		$data = array();
		
		$data['general_logo'] = array(
		'label' => __('Custom Logo', 'buchananpartners'),
		'description' => __('Insert the URL of an image to be used as a custom logo.', 'buchananpartners'),
		'section' => 'title_tagline',
		'sanitize' => 'esc_url',
		'type' => 'image',
		'partials' => '#logo .site-logo'
		);
		
		$data['general_logo_width'] = array(
		'label' => __('Logo Width (px)', 'buchananpartners'),
		'description' => __('Forces the logo to have a specified width.', 'buchananpartners'),
		'section' => 'title_tagline',
		'type' => 'text',
		'placeholder' => '(none)',
		'sanitize' => 'absint',
		'width' => '100px');
		
		$data['general_texttitle'] = array(
		'label' => __('Enable Text Title?', 'buchananpartners'),
		'description' => __('Activate this to display the site title as text.', 'buchananpartners'),
		'section' => 'title_tagline',
		'type' => 'checkbox',
		'sanitize' => 'cpotheme_sanitize_bool',
		'std' => false);
		
		//Layout
		$data['home_upsell'] = array(
		'section'      => 'cpotheme_layout_home',
		'type'		   => 'epsilon-upsell',
        'options'      => array(
            esc_html__( 'Improved Tagline', 'buchananpartners' ),
            esc_html__( 'Reorder Sections', 'buchananpartners' ),
        ),
        'requirements' => array(
            esc_html__( 'In the PRO version of Allegiant, the tagline transforms in a CTA section with buttons and descriptions.', 'buchananpartners' ),
            esc_html__( 'You can order Homepage sections anyway you want', 'buchananpartners' ),
        ),
        'button_url'   => esc_url_raw( get_admin_url() . 'themes.php?page=cpotheme-welcome&tab=features' ),
        'button_text'  => esc_html__( 'See PRO vs Lite', 'buchananpartners' ),
        'second_button_url'  => cpotheme_upgrade_link(),
        'second_button_text' => esc_html__( 'Get the PRO version!', 'buchananpartners' ),
        'separator' => '- or -'
		);		
		$data['home_tagline'] = array(
		'label' => __('Tagline Title', 'buchananpartners'),
		'section' => 'cpotheme_layout_home',
		'empty' => true,
		'multilingual' => true,
		'default' => __('Add your custom tagline here.', 'buchananpartners'),
		'sanitize' => 'wp_kses_post',
		'type' => 'textarea',
		'partials' => '#tagline .container'
		);

		
		//Homepage Slider
		if(defined('CPOTHEME_USE_SLIDES') && CPOTHEME_USE_SLIDES == true){
			$data['slider_settings'] = array(
			'label' => __('Slider Options', 'buchananpartners'),
			'description' => __('Customize the speed, timeout and effects of the homepage slider.', 'buchananpartners'),
			'section' => 'cpotheme_layout_slider',
			'type' => 'label');
		}
		
		//Homepage Features
		if(defined('CPOTHEME_USE_FEATURES') && CPOTHEME_USE_FEATURES == true){
			$data['features_upsell'] = array(
			'section'      => 'cpotheme_layout_features',
			'type'		   => 'epsilon-upsell',
	        'options'      => array(
	            esc_html__( 'Section Description', 'buchananpartners' ),
	            esc_html__( 'Features Columns', 'buchananpartners' ),
	        ),
	        'requirements' => array(
	            esc_html__( 'For each section, apart from title one you can also add a description for users to better understand your sections content', 'buchananpartners' ),
	            esc_html__( 'You can select on how many Columns you want to show your features.', 'buchananpartners' ),
	        ),
	        'button_url'   => cpotheme_upgrade_link(),
	        'button_text'  => esc_html__( 'Get the PRO version!', 'buchananpartners' ),
	        'button_url'   => esc_url_raw( get_admin_url() . 'themes.php?page=cpotheme-welcome&tab=features' ),
	        'button_text'  => esc_html__( 'See PRO vs Lite', 'buchananpartners' ),
	        'second_button_url'  => cpotheme_upgrade_link(),
	        'second_button_text' => esc_html__( 'Get the PRO version!', 'buchananpartners' ),
	        'separator' => '- or -'
			);
			$data['home_features'] = array(
			'label' => __('Features Description', 'buchananpartners'),
			'section' => 'cpotheme_layout_features',
			'empty' => true,
			'multilingual' => true,
			'default' => __('Our core features', 'buchananpartners'),
			'sanitize' => 'wp_kses_post',
			'type' => 'textarea',
			'partials' => '#features #features-heading'
			);
		}
		
		//Portfolio layout
		if(defined('CPOTHEME_USE_PORTFOLIO') && CPOTHEME_USE_PORTFOLIO == true){
			$data['portfolio_upsell'] = array(
			'section'      => 'cpotheme_layout_portfolio',
			'type'		   => 'epsilon-upsell',
	        'options'      => array(
	            esc_html__( 'Section Description', 'buchananpartners' ),
	            esc_html__( 'Portfolio Columns', 'buchananpartners' ),
	            esc_html__( 'Related Portfolios', 'buchananpartners' ),
	        ),
	        'requirements' => array(
	            esc_html__( 'For each section, apart from title one you can also add a description for users to better understand your sections content', 'buchananpartners' ),
	            esc_html__( 'You can select on how many Columns you want to show your portfolio.', 'buchananpartners' ),
	            esc_html__( 'You can enable related portfolio.', 'buchananpartners' ),
	        ),
	        'button_url'   => esc_url_raw( get_admin_url() . 'themes.php?page=cpotheme-welcome&tab=features' ),
	        'button_text'  => esc_html__( 'See PRO vs Lite', 'buchananpartners' ),
	        'second_button_url'  => cpotheme_upgrade_link(),
	        'second_button_text' => esc_html__( 'Get the PRO version!', 'buchananpartners' ),
	        'separator' => '- or -'
			);
			$data['home_portfolio'] = array(
			'label' => __('Portfolio Description', 'buchananpartners'),
			'section' => 'cpotheme_layout_portfolio',
			'empty' => true,
			'multilingual' => true,
			'default' => __('Take a look at our work', 'buchananpartners'),
			'sanitize' => 'wp_kses_post',
			'type' => 'textarea',
			'partials' => '#portfolio #portfolio-heading'
			);
		}
		
		//Services layout
		if(defined('CPOTHEME_USE_SERVICES') && CPOTHEME_USE_SERVICES == true){
			$data['services_upsell'] = array(
			'section'      => 'cpotheme_layout_services',
			'type'		   => 'epsilon-upsell',
	        'options'      => array(
	            esc_html__( 'Section Description', 'buchananpartners' ),
	            esc_html__( 'Services Columns', 'buchananpartners' ),
	        ),
	        'requirements' => array(
	            esc_html__( 'For each section, apart from title one you can also add a description for users to better understand your sections content', 'buchananpartners' ),
	            esc_html__( 'You can select on how many Columns you want to show your services.', 'buchananpartners' ),
	        ),
	        'button_url'   => esc_url_raw( get_admin_url() . 'themes.php?page=cpotheme-welcome&tab=features' ),
	        'button_text'  => esc_html__( 'See PRO vs Lite', 'buchananpartners' ),
	        'second_button_url'  => cpotheme_upgrade_link(),
	        'second_button_text' => esc_html__( 'Get the PRO version!', 'buchananpartners' ),
	        'separator' => '- or -'
			);
			$data['home_services'] = array(
			'label' => __('Services Description', 'buchananpartners'),
			'section' => 'cpotheme_layout_services',
			'empty' => true,
			'multilingual' => true,
			'default' => __('What we can offer you', 'buchananpartners'),
			'sanitize' => 'wp_kses_post',
			'type' => 'textarea',
			'partials' => '#services #services-heading'
			);
		}
		
		//Services layout
		if(defined('CPOTHEME_USE_TEAM') && CPOTHEME_USE_TEAM == true){
			$data['team_upsell'] = array(
			'section'      => 'cpotheme_layout_team',
			'type'		   => 'epsilon-upsell',
	        'options'      => array(
	            esc_html__( 'Section Description', 'buchananpartners' ),
	            esc_html__( 'Team Columns', 'buchananpartners' ),
	        ),
	        'requirements' => array(
	            esc_html__( 'For each section, apart from title one you can also add a description for users to better understand your sections content', 'buchananpartners' ),
	            esc_html__( 'You can select on how many Columns you want to show your team members.', 'buchananpartners' ),
	        ),
	        'button_url'   => esc_url_raw( get_admin_url() . 'themes.php?page=cpotheme-welcome&tab=features' ),
	        'button_text'  => esc_html__( 'See PRO vs Lite', 'buchananpartners' ),
	        'second_button_url'  => cpotheme_upgrade_link(),
	        'second_button_text' => esc_html__( 'Get the PRO version!', 'buchananpartners' ),
	        'separator' => '- or -'
			);
			$data['home_team'] = array(
			'label' => __('Team Members Description', 'buchananpartners'),
			'section' => 'cpotheme_layout_team',
			'empty' => true,
			'multilingual' => true,
			'default' => __('Meet our team', 'buchananpartners'),
			'sanitize' => 'wp_kses_post',
			'type' => 'textarea',
			'partials' => '#team #team-heading'
			);
		}
		
		//Testimonials
		if(defined('CPOTHEME_USE_TESTIMONIALS') && CPOTHEME_USE_TESTIMONIALS == true){
			$data['testimonials_upsell'] = array(
			'section'      => 'cpotheme_layout_testimonials',
			'type'		   => 'epsilon-upsell',
	        'options'      => array(
	            esc_html__( 'Section Description', 'buchananpartners' ),
	            esc_html__( 'Testimonials Columns', 'buchananpartners' ),
	        ),
	        'requirements' => array(
	            esc_html__( 'For each section, apart from title one you can also add a description for users to better understand your sections content', 'buchananpartners' ),
	            esc_html__( 'You can select on how many Columns you want to show your testimonials.', 'buchananpartners' ),
	        ),
	        'button_url'   => esc_url_raw( get_admin_url() . 'themes.php?page=cpotheme-welcome&tab=features' ),
	        'button_text'  => esc_html__( 'See PRO vs Lite', 'buchananpartners' ),
	        'second_button_url'  => cpotheme_upgrade_link(),
	        'second_button_text' => esc_html__( 'Get the PRO version!', 'buchananpartners' ),
	        'separator' => '- or -'
			);
			$data['home_testimonials'] = array(
			'label' => __('Testimonials Description', 'buchananpartners'),
			'section' => 'cpotheme_layout_testimonials',
			'empty' => true,
			'multilingual' => true,
			'default' => __('What they say about us', 'buchananpartners'),
			'sanitize' => 'wp_kses_post',
			'type' => 'textarea',
			'partials' => '#testimonials #testimonials-heading'
			);
		}
		
		//Clients
		if(defined('CPOTHEME_USE_CLIENTS') && CPOTHEME_USE_CLIENTS == true){
			$data['clients_upsell'] = array(
			'section'      => 'cpotheme_layout_clients',
			'type'		   => 'epsilon-upsell',
	        'options'      => array(
	            esc_html__( 'Section Description', 'buchananpartners' ),
	            esc_html__( 'Clients Columns', 'buchananpartners' ),
	        ),
	        'requirements' => array(
	            esc_html__( 'For each section, apart from title one you can also add a description for users to better understand your sections content', 'buchananpartners' ),
	            esc_html__( 'You can select on how many Columns you want to show your clients.', 'buchananpartners' ),
	        ),
	        'button_url'   => esc_url_raw( get_admin_url() . 'themes.php?page=cpotheme-welcome&tab=features' ),
	        'button_text'  => esc_html__( 'See PRO vs Lite', 'buchananpartners' ),
	        'second_button_url'  => cpotheme_upgrade_link(),
	        'second_button_text' => esc_html__( 'Get the PRO version!', 'buchananpartners' ),
	        'separator' => '- or -'
			);
			$data['home_clients'] = array(
			'label' => __('Clients Description', 'buchananpartners'),
			'section' => 'cpotheme_layout_clients',
			'empty' => true,
			'multilingual' => true,
			'default' => __('Featured clients', 'buchananpartners'),
			'sanitize' => 'wp_kses_post',
			'type' => 'textarea',
			'partials' => '#clients #clients-heading'
			);
		}
		
		//Blog Posts
		$data['home_posts'] = array(
		'label' => __('Enable Posts On Homepage', 'buchananpartners'),
		'section' => 'cpotheme_layout_posts',
		'type' => 'checkbox',
		'sanitize' => 'cpotheme_sanitize_bool',
		'default' => false);
		
		//Typography
		$data['type_settings'] = array(
		'label' => __('Typography Options', 'buchananpartners'),
		'description' => __('Select custom fonts for the headings, navigation, and body text of your site.', 'buchananpartners'),
		'section' => 'cpotheme_typography',
		'type' => 'label');
		
		//Colors
		$data['colors_upsell'] = array(
		'section'      => 'colors',
		'type'		   => 'epsilon-upsell',
		'priority'	   => 0,
        'options'      => array(
            esc_html__( 'Custom Colors', 'buchananpartners' ),
        ),
        'requirements' => array(
            esc_html__( 'You can change your site\'s colors directly from Customizer. Changes happen in real time.', 'buchananpartners' ),
        ),
        'button_url'   => esc_url_raw( get_admin_url() . 'themes.php?page=cpotheme-welcome&tab=features' ),
        'button_text'  => esc_html__( 'See PRO vs Lite', 'buchananpartners' ),
        'second_button_url'  => cpotheme_upgrade_link(),
        'second_button_text' => esc_html__( 'Get the PRO version!', 'buchananpartners' ),
        'separator' => '- or -'
		);
		$data['color_settings'] = array(
		'label' => __('Color Options', 'buchananpartners'),
		'description' => __('Customize the colors of primary and secondary elements, as well as headings, navigation, and text.', 'buchananpartners'),
		'section' => 'colors',
		'type' => 'label');

		
		return apply_filters('cpotheme_customizer_controls', $data);
	}
}
