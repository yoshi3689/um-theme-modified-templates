<?php if ( ! defined( 'ABSPATH' ) ) exit;

/* Template: Profile 2 */

// Apply Ultimate Member Profile Layout Customizations.
if ( $args['template'] == 'profile-one' ) {

	remove_action( 'um_profile_header', 'um_profile_header', 9 );
	add_action( 'um_profile_layout_two', 'um_theme_below_profile_layout_two_image_open', 10 );
	add_action( 'um_profile_layout_two', 'um_theme_below_profile_layout_two_image_close', 30 );
	add_action( 'um_profile_header', 'um_theme_profile_layout_one_header', 12 );

	// Check if UM Followers extension is active.
	if ( class_exists( 'UM_Followers_API' ) ) {
		remove_action( 'um_profile_navbar', 'um_followers_add_profile_bar', 4 );
		add_action( 'um_profile_layout_one', 'um_followers_add_profile_bar', 20 );
	}

	// Check if UM Friends extensions is active.
	if ( class_exists( 'UM_Friends_API' ) ) {
		remove_action( 'um_before_profile_main_meta', 'um_friends_add_button' );
		remove_action('um_after_profile_header_name_args', 'um_friends_add_button_nocover', 90, 1 );
		add_action( 'um_profile_layout_one', 'um_theme_friend_box_profile', 23 );
		add_action( 'um_profile_layout_one', 'um_theme_friends_add_button', 21 );
	}

	// Check if Private Messages extension is active.
	if ( class_exists( 'UM_Messaging_API' ) ) {
		remove_action( 'um_profile_navbar', array( UM()->Messaging_API()->profile(), 'add_profile_bar' ), 5 );
		add_action( 'um_profile_layout_one', array( UM()->Messaging_API()->profile(), 'add_profile_bar' ), 22 );
	}
}

?>
<div class="um um-custom-profile-container <?php echo esc_attr( $this->get_class( $mode ) ); ?> um-<?php echo esc_attr( $form_id ); ?> um-role-<?php echo esc_attr( um_user( 'role' ) ); ?> ">
	<div class="um-form" data-mode="<?php echo esc_attr( $mode ) ?>">

		<?php
		/**
		 * UM hook
		 *
		 * @type action
		 * @title um_profile_before_header
		 * @description Some actions before profile form header
		 * @input_vars
		 * [{"var":"$args","type":"array","desc":"Profile form shortcode arguments"}]
		 * @change_log
		 * ["Since: 2.0"]
		 * @usage add_action( 'um_profile_before_header', 'function_name', 10, 1 );
		 * @example
		 * <?php
		 * add_action( 'um_profile_before_header', 'my_profile_before_header', 10, 1 );
		 * function my_profile_before_header( $args ) {
		 * 		// your code here
		 * }
		 * ?>
		 */
		do_action( 'um_profile_before_header', $args );

		if ( um_is_on_edit_profile() ) { ?>
			<form method="post" action="">
		<?php } ?>

		<div class="boot-row">
			<div class="boot-col-md-2 um-profile-one">

				<?php
				/**
				 * UM hook
				 *
				 * @type action
				 * @title um_profile_header
				 * @description Profile header area
				 * @input_vars
				 * [{"var":"$args","type":"array","desc":"Profile form shortcode arguments"}]
				 * @change_log
				 * ["Since: 2.0"]
				 * @usage add_action( 'um_profile_header', 'function_name', 10, 1 );
				 * @example
				 * <?php
				 * add_action( 'um_profile_header', 'my_profile_header', 10, 1 );
				 * function my_profile_header( $args ) {
				 *     // your code here
				 * }
				 * ?>
				 */
				do_action( 'um_profile_header', $args );

				/**
				 * UM theme hook
				 *
				 * @type action
				 * @title um_profile_layout_one
				 * @description Profile left area
				 * @usage add_action( 'um_profile_layout_one', 'function_name', 10, 1 );
				 * @example
				 * <?php
				 * add_action( 'um_profile_layout_one', 'my_profile_header', 10, 1 );
				 * function my_profile_layout() {
				 *     // your code here
				 * }
				 * ?>
				 */
				do_action( 'um_profile_layout_one' ); ?>

			</div>

			<div class="boot-col-md-10 um-profile-one-content">

				<?php um_fetch_user( um_get_requested_user() );?>

				<div class="um-profile-meta boot-d-none boot-d-sm-block">

				    <?php do_action( 'um_before_profile_main_meta', $args ); ?>

					<div class="um-main-meta">
						<?php if ( $args['show_name'] ) { ?>
							<div class="um-name">
								<a href="<?php echo esc_url( um_user_profile_url() ); ?>" title="<?php echo um_user( 'display_name' ); ?>">
									<?php echo um_user( 'display_name', 'html' ); ?>
								</a>

								<?php
								/**
								 * UM hook
								 *
								 * @type action
								 * @title um_after_profile_name_inline
								 * @description Insert after profile name some content
								 * @input_vars
								 * [{"var":"$args","type":"array","desc":"Form Arguments"}]
								 * @change_log
								 * ["Since: 2.0"]
								 * @usage add_action( 'um_after_profile_name_inline', 'function_name', 10, 1 );
								 * @example
								 * <?php
								 * add_action( 'um_after_profile_name_inline', 'my_after_profile_name_inline', 10, 1 );
								 * function my_after_profile_name_inline( $args ) {
								 *     // your code here
								 * }
								 * ?>
								 */
								do_action( 'um_after_profile_name_inline', $args ); ?>

							</div>
						<?php }

						/**
						 * UM hook
						 *
						 * @type action
						 * @title um_after_profile_header_name_args
						 * @description Insert after profile header name some content
						 * @input_vars
						 * [{"var":"$args","type":"array","desc":"Form Arguments"}]
						 * @change_log
						 * ["Since: 2.0"]
						 * @usage add_action( 'um_after_profile_header_name_args', 'function_name', 10, 1 );
						 * @example
						 * <?php
						 * add_action( 'um_after_profile_header_name_args', 'my_after_profile_header_name_args', 10, 1 );
						 * function my_after_profile_header_name_args( $args ) {
						 *     // your code here
						 * }
						 * ?>
						 */
						do_action( 'um_after_profile_header_name_args', $args );
						/**
						 * UM hook
						 *
						 * @type action
						 * @title um_after_profile_name_inline
						 * @description Insert after profile name some content
						 * @change_log
						 * ["Since: 2.0"]
						 * @usage add_action( 'um_after_profile_name_inline', 'function_name', 10 );
						 * @example
						 * <?php
						 * add_action( 'um_after_profile_name_inline', 'my_after_profile_name_inline', 10 );
						 * function my_after_profile_name_inline() {
						 *     // your code here
						 * }
						 * ?>
						 */
						do_action( 'um_after_profile_header_name' ); ?>
					</div>

					<?php if ( isset( $args['metafields'] ) && ! empty( $args['metafields'] ) ) { ?>
						<div class="um-meta">
							<?php echo UM()->profile()->show_meta( $args['metafields'], $args ); ?>
						</div>
					<?php }

					/**
					 * UM hook
					 *
					 * @type action
					 * @title um_after_header_meta
					 * @description Insert after header meta some content
					 * @input_vars
					 * [{"var":"$user_id","type":"int","desc":"User ID"},
					 * {"var":"$args","type":"array","desc":"Form Arguments"}]
					 * @change_log
					 * ["Since: 2.0"]
					 * @usage add_action( 'um_after_header_meta', 'function_name', 10, 2 );
					 * @example
					 * <?php
					 * add_action( 'um_after_header_meta', 'my_after_header_meta', 10, 2 );
					 * function my_after_header_meta( $user_id, $args ) {
					 *     // your code here
					 * }
					 * ?>
					 */
					do_action( 'um_after_header_meta', um_user( 'ID' ), $args ); ?>

				</div>

				<?php do_action( 'um_profile_layout_one_below_meta' );

				/**
				 * UM hook
				 *
				 * @type filter
				 * @title um_profile_navbar_classes
				 * @description Additional classes for profile navbar
				 * @input_vars
				 * [{"var":"$classes","type":"string","desc":"UM Posts Tab query"}]
				 * @change_log
				 * ["Since: 2.0"]
				 * @usage
				 * <?php add_filter( 'um_profile_navbar_classes', 'function_name', 10, 1 ); ?>
				 * @example
				 * <?php
				 * add_filter( 'um_profile_navbar_classes', 'my_profile_navbar_classes', 10, 1 );
				 * function my_profile_navbar_classes( $classes ) {
				 *     // your code here
				 *     return $classes;
				 * }
				 * ?>
				 */
				$classes = apply_filters( 'um_profile_navbar_classes', '' ); ?>

				<div class="um-profile-navbar <?php echo esc_attr( $classes ); ?>">
					<?php
					/**
					 * UM hook
					 *
					 * @type action
					 * @title um_profile_navbar
					 * @description Profile navigation bar
					 * @input_vars
					 * [{"var":"$args","type":"array","desc":"Profile form shortcode arguments"}]
					 * @change_log
					 * ["Since: 2.0"]
					 * @usage add_action( 'um_profile_navbar', 'function_name', 10, 1 );
					 * @example
					 * <?php
					 * add_action( 'um_profile_navbar', 'my_profile_navbar', 10, 1 );
					 * function my_profile_navbar( $args ) {
					 *     // your code here
					 * }
					 * ?>
					 */
					do_action( 'um_profile_navbar', $args ); ?>
					<div class="um-clear"></div>
				</div>

				<?php
				/**
				 * UM hook
				 *
				 * @type action
				 * @title um_profile_menu
				 * @description Profile menu
				 * @input_vars
				 * [{"var":"$args","type":"array","desc":"Profile form shortcode arguments"}]
				 * @change_log
				 * ["Since: 2.0"]
				 * @usage add_action( 'um_profile_menu', 'function_name', 10, 1 );
				 * @example
				 * <?php
				 * add_action( 'um_profile_menu', 'my_profile_navbar', 10, 1 );
				 * function my_profile_navbar( $args ) {
				 *     // your code here
				 * }
				 * ?>
				 */
				do_action( 'um_profile_menu', $args );

				if ( um_is_on_edit_profile() || UM()->user()->preview ) {
					$nav = 'main';
					$subnav = UM()->profile()->active_subnav();
					$subnav = ! empty( $subnav ) ? $subnav : 'default'; ?>

							<div class="um-profile-body <?php echo esc_attr( $nav . ' ' . $nav . '-' . $subnav ); ?>">

								<?php
								// Custom hook to display tabbed content
								/**
								 * UM hook
								 *
								 * @type action
								 * @title um_profile_content_{$nav}
								 * @description Custom hook to display tabbed content
								 * @input_vars
								 * [{"var":"$args","type":"array","desc":"Profile form shortcode arguments"}]
								 * @change_log
								 * ["Since: 2.0"]
								 * @usage add_action( 'um_profile_content_{$nav}', 'function_name', 10, 1 );
								 * @example
								 * <?php
								 * add_action( 'um_profile_content_{$nav}', 'my_profile_content', 10, 1 );
								 * function my_profile_content( $args ) {
								 *     // your code here
								 * }
								 * ?>
								 */
								do_action("um_profile_content_{$nav}", $args);

								/**
								 * UM hook
								 *
								 * @type action
								 * @title um_profile_content_{$nav}_{$subnav}
								 * @description Custom hook to display tabbed content
								 * @input_vars
								 * [{"var":"$args","type":"array","desc":"Profile form shortcode arguments"}]
								 * @change_log
								 * ["Since: 2.0"]
								 * @usage add_action( 'um_profile_content_{$nav}_{$subnav}', 'function_name', 10, 1 );
								 * @example
								 * <?php
								 * add_action( 'um_profile_content_{$nav}_{$subnav}', 'my_profile_content', 10, 1 );
								 * function my_profile_content( $args ) {
								 *     // your code here
								 * }
								 * ?>
								 */
								do_action( "um_profile_content_{$nav}_{$subnav}", $args ); ?>

							</div>
						</div>
					</div>
					<?php if ( ! UM()->user()->preview ) { ?>

					</form>

					<?php }
				} else {
					$menu_enabled = UM()->options()->get( 'profile_menu' );
					$tabs = UM()->profile()->tabs_active();

					$nav = UM()->profile()->active_tab();
					$subnav = UM()->profile()->active_subnav();
					$subnav = ! empty( $subnav ) ? $subnav : 'default';

					if ( $menu_enabled || ! empty( $tabs[ $nav ]['hidden'] ) ) { ?>
						<div class="um-profile-body <?php echo esc_attr( $nav . ' ' . $nav . '-' . $subnav ); ?>">

							<?php
								// Custom hook to display tabbed content
							/**
							 * UM hook
							 *
							 * @type action
							 * @title um_profile_content_{$nav}
							 * @description Custom hook to display tabbed content
							 * @input_vars
							 * [{"var":"$args","type":"array","desc":"Profile form shortcode arguments"}]
							 * @change_log
							 * ["Since: 2.0"]
							 * @usage add_action( 'um_profile_content_{$nav}', 'function_name', 10, 1 );
							 * @example
							 * <?php
							 * add_action( 'um_profile_content_{$nav}', 'my_profile_content', 10, 1 );
							 * function my_profile_content( $args ) {
							 *     // your code here
							 * }
							 * ?>
							 */
							do_action("um_profile_content_{$nav}", $args);

							/**
							 * UM hook
							 *
							 * @type action
							 * @title um_profile_content_{$nav}_{$subnav}
							 * @description Custom hook to display tabbed content
							 * @input_vars
							 * [{"var":"$args","type":"array","desc":"Profile form shortcode arguments"}]
							 * @change_log
							 * ["Since: 2.0"]
							 * @usage add_action( 'um_profile_content_{$nav}_{$subnav}', 'function_name', 10, 1 );
							 * @example
							 * <?php
							 * add_action( 'um_profile_content_{$nav}_{$subnav}', 'my_profile_content', 10, 1 );
							 * function my_profile_content( $args ) {
							 *     // your code here
							 * }
							 * ?>
							 */
							do_action( "um_profile_content_{$nav}_{$subnav}", $args ); ?>

						</div>
					<?php }

					do_action( 'um_profile_menu_after' ); ?>
					</div>
				</div>

				<?php } ?>

		<?php do_action( 'um_profile_footer', $args ); ?>
	</div>
</div>
