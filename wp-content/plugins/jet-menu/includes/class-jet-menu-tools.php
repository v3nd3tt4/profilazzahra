<?php
/**
 * Class description
 *
 * @package   package_name
 * @author    Cherry Team
 * @license   GPL-2.0+
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Jet_Menu_Tools' ) ) {

	/**
	 * Define Jet_Menu_Tools class
	 */
	class Jet_Menu_Tools {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		private static $instance = null;

		/**
		 * Render Icon HTML
		 *
		 * @param  string $icon Icon slug to render.
		 * @return string
		 */
		public function get_icon_html( $icon = '' ) {
			$format = apply_filters( 'jet-menu/tools/icon-format', '<i class="jet-menu-icon fa %s"></i>', $icon );
			return sprintf( $format, esc_attr( $icon ) );
		}

		/**
		 * Render Icon HTML
		 *
		 * @param  string $icon      Icon slug to render.
		 * @param  string $icon_base Base icon class to render.
		 * @return string
		 */
		public function get_dropdown_arrow_html( $icon = '', $icon_base = 'fa' ) {
			$format = apply_filters(
				'jet-menu/tools/dropdown-arrow-format',
				'<i class="jet-dropdown-arrow %2$s %1$s"></i>',
				$icon,
				$icon_base
			);
			return sprintf( $format, esc_attr( $icon ), esc_attr( $icon_base ) );
		}

		/**
		 * Get menu badge HTML
		 *
		 * @param  string $badge Badge HTML.
		 * @return string
		 */
		public function get_badge_html( $badge = '', $depth = 0 ) {

			if ( 0 < $depth ) {
				$is_hidden = jet_menu_option_page()->get_option( 'jet-menu-sub-badge-hide', 'false' );
			} else {
				$is_hidden = jet_menu_option_page()->get_option( 'jet-menu-top-badge-hide', 'false' );
			}

			$hide_on_mobile = ( 'true' === $is_hidden ) ? ' jet-hide-mobile' : '';

			$format = apply_filters(
				'jet-menu/tools/badge-format',
				'<small class="jet-menu-badge%2$s"><span class="jet-menu-badge__inner">%1$s</span></small>',
				$badge,
				$depth
			);
			return sprintf( $format, esc_attr( $badge ), $hide_on_mobile );
		}

		/**
		 * Add menu item dynamic CSS
		 *
		 * @param integer $item_id [description]
		 * @param string  $wrapper [description]
		 */
		public function add_menu_css( $item_id = 0, $wrapper = '' ) {

			$settings   = jet_menu_settings_nav()->get_item_settings( $item_id );
			$css_scheme = apply_filters( 'jet-menu/item-css/sheme', array(
				'icon_color' => array(
					'selector' => '> a .jet-menu-icon:before',
					'rule'     => 'color',
					'value'    => '%1$s !important;',
				),
				'badge_color' => array(
					'selector' => '> a .jet-menu-badge .jet-menu-badge__inner',
					'rule'     => 'color',
					'value'    => '%1$s !important;',
				),
				'badge_bg_color' => array(
					'selector' => '> a .jet-menu-badge .jet-menu-badge__inner',
					'rule'     => 'background-color',
					'value'    => '%1$s !important;',
				),
				'item_padding' => array(
					'selector' => '> a',
					'rule'     => 'padding-%s',
					'value'    => '',
					'desktop'  => true,
				),
				'custom_mega_menu_width' => array(
					'selector' => '> .jet-sub-mega-menu',
					'rule'     => 'width',
					'value'    => '%1$spx !important;',
				),
				// for Vertical Mega Menu
				'mega_menu_width' => array(
					'selector' => '> .jet-custom-nav__mega-sub',
					'rule'     => 'width',
					'value'    => '%1$spx !important;',
				),
			) );

			foreach ( $css_scheme as $setting => $data ) {

				if ( empty( $settings[ $setting ] ) ) {
					continue;
				}

				$_wrapper = $wrapper;

				if ( isset( $data['desktop'] ) && true === $data['desktop'] ) {
					$_wrapper = '.jet-menu ' . $wrapper;
				}

				if ( is_array( $settings[ $setting ] ) && isset( $settings[ $setting ]['units'] ) ) {

					jet_menu_dynmic_css()->add_dimensions_css(
						array(
							'selector'  => sprintf( '%1$s %2$s', $_wrapper, $data['selector'] ),
							'rule'      => $data['rule'],
							'values'    => $settings[ $setting ],
							'important' => true,
						)
					);

				} else {

					if ( ! isset( $settings[ $setting ] ) || false === $settings[ $setting ] || 'false' === $settings[ $setting ] ) {
						continue;
					}

					jet_menu()->dynamic_css()->add_style(
						sprintf( '%1$s %2$s', $_wrapper, $data['selector'] ),
						array(
							$data['rule'] => sprintf( $data['value'], esc_attr( $settings[ $setting ] ) ),
						)
					);

				}
			}
		}

		/**
		 * [get_arrows_icons description]
		 * @return [type] [description]
		 */
		public function get_arrows_icons() {
			return apply_filters( 'jet-menu/arrow-icons', array(
				'fa-angle-down',
				'fa-angle-double-down',
				'fa-arrow-circle-down',
				'fa-arrow-down',
				'fa-caret-down',
				'fa-chevron-circle-down',
				'fa-chevron-down',
				'fa-long-arrow-down',
				'fa-angle-right',
				'fa-angle-double-right',
				'fa-arrow-circle-right',
				'fa-arrow-right',
				'fa-caret-right',
				'fa-chevron-circle-right',
				'fa-chevron-right',
				'fa-long-arrow-right',
				'fa-angle-left',
				'fa-angle-double-left',
				'fa-arrow-circle-left',
				'fa-arrow-left',
				'fa-caret-left',
				'fa-chevron-circle-left',
				'fa-chevron-left',
				'fa-long-arrow-left',
			) );
		}

		/**
		 * [get_elementor_templates_select_options description]
		 * @return [type] [description]
		 */
		public function get_elementor_templates_select_options() {

			if ( ! jet_menu()->has_elementor() ) {
				return array();
			}

			$templates = jet_menu()->elementor()->templates_manager->get_source( 'local' )->get_items();

			if ( ! $templates ) {
				return array();
			}

			$select_options[] = array(
				'label' => esc_html__( 'None', 'jet-menu' ),
				'value' => '',
			);

			foreach ( $templates as $key => $template ) {
				$select_options[] = array(
					'label' => $template['title'],
					'value' => $template['template_id'],
				);
			}

			return $select_options;

		}

		/**
		 * [my_wp_is_mobile description]
		 * @return [type] [description]
		 */
		public static function is_phone() {
			static $is_mobile;

			if ( isset($is_mobile) )
				return $is_mobile;

			if ( empty($_SERVER['HTTP_USER_AGENT']) ) {
				$is_mobile = false;
			} elseif (
				strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
				|| strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
				|| strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
				|| strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
				|| strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false ) {
					$is_mobile = true;
			} elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false && strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') == false) {
					$is_mobile = true;
			} elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') !== false) {
				$is_mobile = false;
			} else {
				$is_mobile = false;
			}

			return $is_mobile;
		}

		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @return object
		 */
		public static function get_instance() {

			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
			return self::$instance;
		}
	}

}

/**
 * Returns instance of Jet_Menu_Tools
 *
 * @return object
 */
function jet_menu_tools() {
	return Jet_Menu_Tools::get_instance();
}
