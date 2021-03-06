<?php

namespace Stockholm\Shortcodes\ContentSlider;

use Stockholm\Shortcodes\Lib\ShortcodeInterface;

class ContentSlider implements ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'qode_content_slider';
		add_action( 'stockholm_qode_action_vc_map', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map( array(
				'name'            => esc_html__( 'Content Slider', 'stockholm-core' ),
				'base'            => $this->base,
				'icon'            => 'extended-custom-icon-qode icon-wpb-content-slider',
				'category'        => esc_html__( 'by SELECT', 'stockholm-core' ),
				'as_parent'       => array( 'only' => 'qode_content_slide' ),
				'content_element' => true,
				'js_view'         => 'VcColumnView',
				'params'          => array(
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__( 'Animation speed', 'stockholm-core' ),
						'admin_label' => true,
						'param_name'  => 'animation_speed',
						'value'       => '',
						'description' => esc_html__( 'Speed of slide animation in miliseconds', 'stockholm-core' )
					),
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__( 'Show Navigation Arrows', 'stockholm-core' ),
						'param_name'  => 'navigation_arrows',
						'value'       => array(
							esc_html__( 'No', 'stockholm-core' )  => 'no',
							esc_html__( 'Yes', 'stockholm-core' ) => 'yes'
						)
					)
				)
			)
		);
	}
	
	public function render( $atts, $content = null ) {
		$args = array(
			'animation_speed'    => '',
			'navigation_arrows'  => 'no',
			'pagination_bullets' => 'no'
		);
		$params = shortcode_atts( $args, $atts );
		extract( $params );
		
		$data_attr = $this->getDataParams( $params );
		
		$html = '';
		$html .= '<div class="qode-content-slider">';
		$html .= '<div class="qode-content-slider-slides qode-owl-slider" ' . stockholm_qode_get_inline_attrs( $data_attr ) . '>';
		$html .= do_shortcode( $content );
		$html .= '</div>';
		$html .= '</div>';
		
		return $html;
	}
	
	private function getDataParams( $params ) {
		$data_attr = array();
		
		if ( ! empty( $params['animation_speed'] ) ) {
			$data_attr['data-slider-speed-animation'] = $params['animation_speed'];
		}
		
		if ( ! empty( $params['navigation_arrows'] ) ) {
			$data_attr['data-enable-navigation'] = $params['navigation_arrows'];
		}
		
		if ( ! empty( $params['pagination_bullets'] ) ) {
			$data_attr['data-pagination'] = $params['pagination_bullets'];
		}
		
		return $data_attr;
	}
}