<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}
/**
 * Features
 */

$features = array(
	'slider-options' => array(
		'label'   	=> __( 'Slider options', 'buchananpartners' ),
		'cpo'     	=> '<span class="dashicons dashicons-no-alt"></span>',
		'cpo-pro'	=> '<span class="dashicons dashicons-yes"></span></i>'
	),
	'woocommerce' => array(
		'label'  	=> __( 'WooCommerce Integration', 'buchananpartners' ),
		'cpo'     	=> '<span class="dashicons dashicons-no-alt"></span>',
		'cpo-pro' 	=> '<span class="dashicons dashicons-yes"></span></i>'
	),
	'reorder-sections' => array(
		'label'       => __( 'Reorder Homepage Sections', 'buchananpartners' ),
		'cpo'     => '<span class="dashicons dashicons-no-alt"></span>',
		'cpo-pro' => '<span class="dashicons dashicons-yes"></span></i>'
	),
	'custom-colors'    => array(
		'label'       => __( 'Custom Colors', 'buchananpartners' ),
		'cpo'     => '<span class="dashicons dashicons-no-alt"></span>',
		'cpo-pro' => '<span class="dashicons dashicons-yes"></span></i>'
	),
	'typography'       => array(
		'label'       => __( 'Custom Typography', 'buchananpartners' ),
		'cpo'     => '<span class="dashicons dashicons-no-alt"></span>',
		'cpo-pro' => '<span class="dashicons dashicons-yes"></span></i>'
	),
	'tagline' => array(
		'label'   	=> __( 'Tagline', 'buchananpartners' ),
		'cpo'    	=> __( 'Minimal', 'buchananpartners' ),
		'cpo-pro' 	=> __( 'Improved', 'buchananpartners' )
	),
	'features' => array(
		'label'   	=> __( 'Extend the Features functionality with : Section Description and Features Columns', 'buchananpartners' ),
		'cpo'     => '<span class="dashicons dashicons-no-alt"></span>',
		'cpo-pro' => '<span class="dashicons dashicons-yes"></span></i>'
	),
	'portfolio' => array(
		'label'   	=> __( 'Extend the Portfolio functionality with : Section Description, Portfolio Columns & Related Portfolio Images', 'buchananpartners' ),
		'cpo'     => '<span class="dashicons dashicons-no-alt"></span>',
		'cpo-pro' => '<span class="dashicons dashicons-yes"></span></i>'
	),
	'services' => array(
		'label'   	=> __( 'Extend the Services functionality with : Section Description and Services Columns', 'buchananpartners' ),
		'cpo'     => '<span class="dashicons dashicons-no-alt"></span>',
		'cpo-pro' => '<span class="dashicons dashicons-yes"></span></i>'
	),
	'team' => array(
		'label'   	=> __( 'Extend the Team members functionality with : Section Description and Team Columns', 'buchananpartners' ),
		'cpo'     => '<span class="dashicons dashicons-no-alt"></span>',
		'cpo-pro' => '<span class="dashicons dashicons-yes"></span></i>'
	),
	'testimonials' => array(
		'label'   	=> __( 'Extend the Testimonials functionality with : Section Description and Testimonials Columns', 'buchananpartners' ),
		'cpo'     => '<span class="dashicons dashicons-no-alt"></span>',
		'cpo-pro' => '<span class="dashicons dashicons-yes"></span></i>'
	),
	'clients' => array(
		'label'   	=> __( 'Extend the Clients functionality with : Section Description and Clients Columns', 'buchananpartners' ),
		'cpo'     => '<span class="dashicons dashicons-no-alt"></span>',
		'cpo-pro' => '<span class="dashicons dashicons-yes"></span></i>'
	),
	'dedicated-support' => array(
		'label'       => __( 'Dedicated Support Team', 'buchananpartners' ),
		'cpo'     => '<span class="dashicons dashicons-no-alt"></span>',
		'cpo-pro' => '<span class="dashicons dashicons-yes"></span></i>'
	),
	'security-updates' => array(
		'label'       => __( 'Security updates & feature releases', 'buchananpartners' ),
		'cpo'     => '<span class="dashicons dashicons-no-alt"></span>',
		'cpo-pro' => '<span class="dashicons dashicons-yes"></span></i>'
	),
);
?>
<div class="featured-section features">
    <table class="free-pro-table">
        <thead>
        <tr>
            <th></th>
            <th><?php _e( 'Lite', 'buchananpartners' ) ?></th>
            <th><?php _e( 'PRO', 'buchananpartners' ) ?></th>
        </tr>
        </thead>
        <tbody>
		<?php foreach ( $features as $feature ): ?>
            <tr>
                <td class="feature">
                    <h3>
						<?php echo $feature['label']; ?>
                    </h3>
                </td>
                <td class="cpo-feature">
					<?php echo $feature['cpo']; ?>
                </td>
                <td class="cpo-pro-feature">
					<?php echo $feature['cpo-pro']; ?>
                </td>
            </tr>
		<?php endforeach; ?>
        <tr>
            <td></td>
            <td colspan="2" class="text-right"><a href="//www.cpothemes.com/theme/allegiant?utm_source=upsell&utm_medium=theme&utm_campaign=upsell" target="_blank"
                               class="button button-primary button-hero"><span class="dashicons dashicons-cart"></span><?php _e( 'Get Pro Now!', 'buchananpartners' ) ?></a></td>
        </tr>
        </tbody>
    </table>
</div>