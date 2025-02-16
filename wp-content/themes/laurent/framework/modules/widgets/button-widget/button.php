<?php

if ( class_exists( 'LaurentCoreClassWidget' ) ) {
	class LaurentElatedClassButtonWidget extends LaurentCoreClassWidget {
		public function __construct() {
			parent::__construct(
				'eltdf_button_widget',
				esc_html__( 'Laurent Button Widget', 'laurent' ),
				array( 'description' => esc_html__( 'Add button element to widget areas', 'laurent' ) )
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
						'solid'   => esc_html__( 'Solid', 'laurent' ),
						'outline' => esc_html__( 'Outline', 'laurent' ),
						'simple'  => esc_html__( 'Simple', 'laurent' ),
						'special' => esc_html__( 'Special', 'laurent' )
					)
				),
				array(
					'type'        => 'dropdown',
					'name'        => 'size',
					'title'       => esc_html__( 'Size', 'laurent' ),
					'options'     => array(
						'small'  => esc_html__( 'Small', 'laurent' ),
						'medium' => esc_html__( 'Medium', 'laurent' ),
						'large'  => esc_html__( 'Large', 'laurent' ),
						'huge'   => esc_html__( 'Huge', 'laurent' )
					),
					'description' => esc_html__( 'This option is only available for solid, outline and special button type', 'laurent' )
				),
				array(
					'type'    => 'textfield',
					'name'    => 'text',
					'title'   => esc_html__( 'Text', 'laurent' ),
					'default' => esc_html__( 'Button Text', 'laurent' )
				),
				array(
					'type'  => 'textfield',
					'name'  => 'link',
					'title' => esc_html__( 'Link', 'laurent' )
				),
				array(
					'type'    => 'dropdown',
					'name'    => 'target',
					'title'   => esc_html__( 'Link Target', 'laurent' ),
					'options' => laurent_elated_get_link_target_array()
				),
				array(
					'type'  => 'colorpicker',
					'name'  => 'color',
					'title' => esc_html__( 'Color', 'laurent' )
				),
				array(
					'type'  => 'colorpicker',
					'name'  => 'hover_color',
					'title' => esc_html__( 'Hover Color', 'laurent' )
				),
				array(
					'type'        => 'colorpicker',
					'name'        => 'background_color',
					'title'       => esc_html__( 'Background Color', 'laurent' ),
					'description' => esc_html__( 'This option is only available for solid button type', 'laurent' )
				),
				array(
					'type'        => 'colorpicker',
					'name'        => 'hover_background_color',
					'title'       => esc_html__( 'Hover Background Color', 'laurent' ),
					'description' => esc_html__( 'This option is only available for solid button type', 'laurent' )
				),
				array(
					'type'        => 'colorpicker',
					'name'        => 'border_color',
					'title'       => esc_html__( 'Border Color', 'laurent' ),
					'description' => esc_html__( 'This option is only available for solid and outline button type', 'laurent' )
				),
				array(
					'type'        => 'colorpicker',
					'name'        => 'hover_border_color',
					'title'       => esc_html__( 'Hover Border Color', 'laurent' ),
					'description' => esc_html__( 'This option is only available for solid and outline button type', 'laurent' )
				),
				array(
					'type'        => 'textfield',
					'name'        => 'margin',
					'title'       => esc_html__( 'Margin', 'laurent' ),
					'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'laurent' )
				)
			);
		}
		
		public function widget( $args, $instance ) {
			$params = '';
			
			if ( ! is_array( $instance ) ) {
				$instance = array();
			}
			
			// Filter out all empty params
			$instance = array_filter( $instance, function ( $array_value ) {
				return trim( $array_value ) != '';
			} );
			
			// Default values
			if ( ! isset( $instance['text'] ) ) {
				$instance['text'] = 'Button Text';
			}
			
			// Generate shortcode params
			foreach ( $instance as $key => $value ) {
				$params .= " $key='$value' ";
			}
			
			echo '<div class="widget eltdf-button-widget">';
			echo do_shortcode( "[eltdf_button $params]" ); // XSS OK
			echo '</div>';
		}
	}
}