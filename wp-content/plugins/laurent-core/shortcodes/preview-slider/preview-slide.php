<?php
namespace LaurentCore\CPT\Shortcodes\PreviewSlider;

use LaurentCore\Lib;

class PreviewSlide implements Lib\ShortcodeInterface{
	private $base;

	function __construct() {
		$this->base = 'eltdf_preview_slide';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if(function_exists('vc_map')){
			vc_map( 
				array(
					'name' => esc_html__('Preview Slide', 'laurent-core'),
					'base' => $this->base,
					'as_child' => array('only' => 'eltdf_preview_slide'),
					'content_element' => true,
					'category' => esc_html__('by LAURENT', 'laurent-core'),
					'icon' => 'icon-wpb-preview-slide extended-custom-icon',
					'show_settings_on_create' => true,
					'params' => array(
						array(
							'type' => 'attach_image',
							'heading' => esc_html__('Monitor Image', 'laurent-core'),
							'param_name' => 'ps_laptop_image'
						),
						array(
							'type' => 'attach_image',
							'heading' => esc_html__('Tablet Image', 'laurent-core'),
							'param_name' => 'ps_tablet_image'
						),
						array(
							'type' => 'attach_image',
							'heading' => esc_html__('Phone Image', 'laurent-core'),
							'param_name' => 'ps_mobile_image'
						),
						array(
							'type' => 'textfield',
							'heading' => esc_html__('Link', 'laurent-core'),
							'param_name' => 'ps_link',
							'admin_label' => true
						),
						array(
							'type' => 'dropdown',
							'heading' => esc_html__('Link Target', 'laurent-core'),
							'param_name' => 'ps_target',
							'value' => array(
								esc_html__('Self', 'laurent-core') => '_self',
								esc_html__('Blank', 'laurent-core') => '_blank'
							),
							'save_always' => true
						)
					)
				)
			);			
		}
	}

	public function render($atts, $content = null) {
		$args = array(
			'ps_laptop_image'	=> '',
			'ps_tablet_image'	=> '',
			'ps_mobile_image'	=> '',
			'ps_link'				=> '',
			'ps_target'			=> '_self'
		);
		
		$params = shortcode_atts($args, $atts);
		extract($params);
		$params['content']= $content;

		$html = laurent_core_get_shortcode_module_template_part('templates/preview-slide-template', 'preview-slider', '', $params);

		return $html;
	}




}
