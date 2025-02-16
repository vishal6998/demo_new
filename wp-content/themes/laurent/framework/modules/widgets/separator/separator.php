<?php

if ( class_exists( 'LaurentCoreClassWidget' ) ) {
	class LaurentElatedClassSeparatorWidget extends LaurentCoreClassWidget {
		public function __construct() {
			parent::__construct(
				'eltdf_separator_widget',
				esc_html__( 'Laurent Separator Widget', 'laurent' ),
				array( 'description' => esc_html__( 'Add a separator element to your widget areas', 'laurent' ) )
			);
			
			$this->setParams();
		}
		
		protected function setParams() {
			$this->params = array(
				array(
					'type'    => 'dropdown',
					'name'    => 'type',
					'title'   => esc_html__( 'Type', 'laurent' ),
					'options' => array(
						'normal'     => esc_html__( 'Normal', 'laurent' ),
						'full-width' => esc_html__( 'Full Width', 'laurent' )
					)
				),
				array(
					'type'    => 'dropdown',
					'name'    => 'position',
					'title'   => esc_html__( 'Position', 'laurent' ),
					'options' => array(
						'center' => esc_html__( 'Center', 'laurent' ),
						'left'   => esc_html__( 'Left', 'laurent' ),
						'right'  => esc_html__( 'Right', 'laurent' )
					)
				),
				array(
					'type'    => 'dropdown',
					'name'    => 'border_style',
					'title'   => esc_html__( 'Style', 'laurent' ),
					'options' => array(
						'solid'  => esc_html__( 'Solid', 'laurent' ),
						'dashed' => esc_html__( 'Dashed', 'laurent' ),
						'dotted' => esc_html__( 'Dotted', 'laurent' )
					)
				),
				array(
					'type'  => 'colorpicker',
					'name'  => 'color',
					'title' => esc_html__( 'Color', 'laurent' )
				),
				array(
					'type'  => 'textfield',
					'name'  => 'width',
					'title' => esc_html__( 'Width (px or %)', 'laurent' )
				),
				array(
					'type'  => 'textfield',
					'name'  => 'thickness',
					'title' => esc_html__( 'Thickness (px)', 'laurent' )
				),
				array(
					'type'  => 'textfield',
					'name'  => 'top_margin',
					'title' => esc_html__( 'Top Margin (px or %)', 'laurent' )
				),
				array(
					'type'  => 'textfield',
					'name'  => 'bottom_margin',
					'title' => esc_html__( 'Bottom Margin (px or %)', 'laurent' )
				)
			);
		}
		
		public function widget( $args, $instance ) {
			if ( ! is_array( $instance ) ) {
				$instance = array();
			}
			
			//prepare variables
			$params = '';
			
			//is instance empty?
			if ( is_array( $instance ) && count( $instance ) ) {
				//generate shortcode params
				foreach ( $instance as $key => $value ) {
					$params .= " $key='$value' ";
				}
			}
			
			echo '<div class="widget eltdf-separator-widget">';
			echo do_shortcode( "[eltdf_separator $params]" ); // XSS OK
			echo '</div>';
		}
	}
}