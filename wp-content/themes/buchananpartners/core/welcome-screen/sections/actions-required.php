<?php
/**
 * Actions required
 */
wp_enqueue_style( 'plugin-install' );
wp_enqueue_script( 'plugin-install' );
wp_enqueue_script( 'updates' );
?>

<div class="feature-section action-required demo-import-boxed" id="plugin-filter">

	<?php
	global $allegiant_required_actions, $allegiant_recommended_plugins;
	if ( ! empty( $allegiant_required_actions ) ):
		/* allegiant_show_required_actions is an array of true/false for each required action that was dismissed */
		$nr_actions_required = 0;
		$nr_action_dismissed = 0;
		$allegiant_show_required_actions = get_option( "allegiant_show_required_actions" );
		foreach ( $allegiant_required_actions as $allegiant_required_action_key => $allegiant_required_action_value ):
			$hidden = false;
			if ( @$allegiant_show_required_actions[ $allegiant_required_action_value['id'] ] === false ) {
				$hidden = true;
			}
			if ( @$allegiant_required_action_value['check'] ) {
				continue;
			}
			$nr_actions_required ++;
			if ( $hidden ) {
				$nr_action_dismissed ++;
			}
			
			?>
			<div class="allegiant-action-required-box">
				<?php if ( ! $hidden ): ?>
					<span data-action="dismiss" class="dashicons dashicons-visibility allegiant-required-action-button"
					      id="<?php echo esc_attr( $allegiant_required_action_value['id'] ); ?>"></span>
				<?php else: ?>
					<span data-action="add" class="dashicons dashicons-hidden allegiant-required-action-button"
					      id="<?php echo esc_attr( $allegiant_required_action_value['id'] ); ?>"></span>
				<?php endif; ?>
				<h3><?php if ( ! empty( $allegiant_required_action_value['title'] ) ): echo $allegiant_required_action_value['title']; endif; ?></h3>
				<p>
					<?php if ( ! empty( $allegiant_required_action_value['description'] ) ): echo $allegiant_required_action_value['description']; endif; ?>
					<?php if ( ! empty( $allegiant_required_action_value['help'] ) ): echo '<br/>' . $allegiant_required_action_value['help']; endif; ?>
				</p>
				<?php
				if ( ! empty( $allegiant_required_action_value['plugin_slug'] ) ) {
					$active = $this->check_active( $allegiant_required_action_value['plugin_slug'] );
					$url    = $this->create_action_link( $active['needs'], $allegiant_required_action_value['plugin_slug'] );
					$label  = '';
					switch ( $active['needs'] ) {
						case 'install':
							$class = 'install-now button';
							$label = __( 'Install', 'buchananpartners' );
							break;
						case 'activate':
							$class = 'activate-now button button-primary';
							$label = __( 'Activate', 'buchananpartners' );
							break;
						case 'deactivate':
							$class = 'deactivate-now button';
							$label = __( 'Deactivate', 'buchananpartners' );
							break;
					}
					?>
					<p class="plugin-card-<?php echo esc_attr( $allegiant_required_action_value['plugin_slug'] ) ?> action_button <?php echo ( $active['needs'] !== 'install' && $active['status'] ) ? 'active' : '' ?>">
						<a data-slug="<?php echo esc_attr( $allegiant_required_action_value['plugin_slug'] ) ?>"
						   class="<?php echo $class; ?>"
						   href="<?php echo esc_url( $url ) ?>"> <?php echo $label ?> </a>
					</p>
					<?php
				};
				?>
			</div>
			<?php
		endforeach;
	endif;
	$nr_recommended_plugins = 0;
	if ( $nr_actions_required == 0 || $nr_actions_required == $nr_action_dismissed ):

		$allegiant_show_recommended_plugins = get_option( "allegiant_show_recommended_plugins" );
		foreach ( $allegiant_recommended_plugins as $slug => $plugin_opt ) {
			
			if ( !$plugin_opt['recommended'] ) {
				continue;
			}

			if ( Allegiant_Notify_System::has_plugin( $slug ) ) {
				continue;
			}
			if ( $nr_recommended_plugins == 0 ) {
				echo '<h3 class="hooray">' . __( 'Hooray! There are no required actions for you right now. But you can make your theme more powerful with next actions: ', 'buchananpartners' ) . '</h3>';
			}

			$nr_recommended_plugins ++;
			echo '<div class="buchananpartners-action-required-box">';

			if ( !isset($allegiant_show_recommended_plugins[$slug]) || ( isset($allegiant_show_recommended_plugins[$slug]) && $allegiant_show_recommended_plugins[$slug] ) ): ?>
				<span data-action="dismiss" class="dashicons dashicons-visibility allegiant-recommended-plugin-button"
				      id="<?php echo esc_attr( $slug ); ?>"></span>
			<?php else: ?>
				<span data-action="add" class="dashicons dashicons-hidden allegiant-recommended-plugin-button"
				      id="<?php echo esc_attr( $slug ); ?>"></span>
			<?php endif;

			$active = $this->check_active( $slug );
			$url    = $this->create_action_link( $active['needs'], $slug );
			$info   = $this->call_plugin_api( $slug );
			$label  = '';
			$class = '';
			switch ( $active['needs'] ) {
				case 'install':
					$class = 'install-now button';
					$label = __( 'Install', 'buchananpartners' );
					break;
				case 'activate':
					$class = 'activate-now button button-primary';
					$label = __( 'Activate', 'buchananpartners' );
					break;
				case 'deactivate':
					$class = 'deactivate-now button';
					$label = __( 'Deactivate', 'buchananpartners' );
					break;
			}

			?>
			<h3><?php echo $label .': '.$info->name ?></h3>
			<p>
				<?php echo $info->short_description ?>
			</p>
			<p class="plugin-card-<?php echo esc_attr( $slug ) ?> action_button <?php echo ( $active['needs'] !== 'install' && $active['status'] ) ? 'active' : '' ?>">
				<a data-slug="<?php echo esc_attr( $slug ) ?>"
				   class="<?php echo $class; ?>"
				   href="<?php echo esc_url( $url ) ?>"> <?php echo $label ?> </a>
			</p>
			<?php

			echo '</div>';

		}

	endif;

	if ( $nr_recommended_plugins == 0 && $nr_actions_required == 0 ) {
		echo '<span class="hooray">' . __( 'Hooray! There are no required actions for you right now.', 'buchananpartners' ) . '</span>';
	}

	?>

</div>