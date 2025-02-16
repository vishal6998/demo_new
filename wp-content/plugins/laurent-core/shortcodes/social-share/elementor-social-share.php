<?php
class LaurentCoreElementorSocialShare extends \Elementor\Widget_Base {

	public function get_name() {
		return 'eltdf_social_share'; 
	}

	public function get_title() {
		return esc_html__( 'Social Share', 'laurent-core' );
	}

	public function get_icon() {
		return 'laurent-elementor-custom-icon laurent-elementor-social-share';
	}

	public function get_categories() {
		return [ 'elated' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'general',
			[
				'label' => esc_html__( 'General', 'laurent-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'type',
			[
				'label'     => esc_html__( 'Type', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'list' => esc_html__( 'List', 'laurent-core'), 
					'dropdown' => esc_html__( 'Dropdown', 'laurent-core'), 
					'text' => esc_html__( 'Text', 'laurent-core')
				),
				'default' => 'list'
			]
		);

		$this->add_control(
			'dropdown_behavior',
			[
				'label'     => esc_html__( 'DropDown Hover Behavior', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'bottom' => esc_html__( 'On Bottom Animation', 'laurent-core'), 
					'right' => esc_html__( 'On Right Animation', 'laurent-core'), 
					'left' => esc_html__( 'On Left Animation', 'laurent-core')
				),
				'default' => 'bottom',
				'condition' => [
					'type' => array( 'dropdown' )
				]
			]
		);

		$this->add_control(
			'icon_type',
			[
				'label'     => esc_html__( 'Icons Type', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'font-awesome' => esc_html__( 'Font Awesome', 'laurent-core'), 
					'ion-icons' => esc_html__( 'Ion Icons', 'laurent-core')
				),
				'default' => 'ion-icons',
				'condition' => [
					'type' => array( 'list', 'dropdown' )
				]
			]
		);

		$this->add_control(
			'title',
			[
				'label'     => esc_html__( 'Social Share Title', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);


		$this->end_controls_section();
	}
	public function render() {

		$params = $this->get_settings_for_display();

		//Is social share enabled
		$params['enable_social_share'] = laurent_elated_options()->getOptionValue( 'enable_social_share' ) === 'yes';
		
		//Is social share enabled for post type
		$post_type         = str_replace( '-', '_', get_post_type() );
		$params['enabled'] = laurent_elated_options()->getOptionValue( 'enable_social_share_on_' . $post_type ) === 'yes';
		
		//Social Networks Data
		$params['networks'] = $this->getSocialNetworksParams( $params );
		
		$params['dropdown_class'] = ! empty( $params['dropdown_behavior'] ) ? 'eltdf-' . $params['dropdown_behavior'] : 'eltdf-' . $args['dropdown_behavior'];
		
		$html = '';
		
		if ( $params['enable_social_share'] && $params['enabled'] ) {
			$html = laurent_core_get_shortcode_module_template_part( 'templates/' . $params['type'], 'social-share', '', $params );
		}
		
		echo laurent_elated_get_module_part($html);
	}

	public function getSocialNetworks() {
		return $this->socialNetworks;
	}

	private function getSocialNetworksParams( $params ) {
		$networks   = array();
		$icons_type = $params['icon_type'];
		$type       = $params['type'];
		
		foreach ( $this->socialNetworks as $net ) {
			$html = '';
			
			if ( laurent_elated_options()->getOptionValue( 'enable_' . $net . '_share' ) == 'yes' ) {
				$image                 = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
				$params                = array(
					'name' => $net,
					'type' => $type
				);

				$params['link']        = $this->getSocialNetworkShareLink( $net, $image );

				if ($type == 'text') {
					$params['text']    = $this->getSocialNetworkText( $net );
				} else {
					$params['icon']    = $this->getSocialNetworkIcon( $net, $icons_type );
				}

				$params['custom_icon'] = ( laurent_elated_options()->getOptionValue( $net . '_icon' ) ) ? laurent_elated_options()->getOptionValue( $net . '_icon' ) : '';
				
				$html = laurent_core_get_shortcode_module_template_part( 'templates/parts/network', 'social-share', '', $params );
			}
			
			$networks[ $net ] = $html;
		}
		
		echo laurent_elated_get_module_part($networks);
	}

    private function getSocialNetworkShareLink($net, $image) {
        switch ($net) {
            case 'facebook':
	            if (wp_is_mobile()) {
		            $link = 'window.open(\'https://m.facebook.com/sharer.php?u=' . get_permalink() . '\');';
	            } else {
		            $link = 'window.open(\'https://www.facebook.com/sharer/sharer.php?u=' . get_permalink() . '\');';
	            }
                break;
            case 'twitter':
                $count_char = (isset($_SERVER['https'])) ? 23 : 22;
                $twitter_via = (laurent_elated_options()->getOptionValue('twitter_via') !== '') ? esc_attr__( ' via ', 'laurent-core' ) . laurent_elated_options()->getOptionValue('twitter_via') . ' ' : '';
	            $link =  'window.open(\'https://twitter.com/intent/tweet?text=' . urlencode( laurent_elated_the_excerpt_max_charlength( $count_char ) . $twitter_via ) . ' ' . get_permalink() . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');';
                break;
            case 'linkedin':
                $link = 'popUp=window.open(\'https://linkedin.com/shareArticle?mini=true&amp;url=' . urlencode(get_permalink()) . '&amp;title=' . urlencode(get_the_title()) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
                break;
            case 'tumblr':
                $link = 'popUp=window.open(\'https://www.tumblr.com/share/link?url=' . urlencode(get_permalink()) . '&amp;name=' . urlencode(get_the_title()) . '&amp;description=' . urlencode(get_the_excerpt()) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
                break;
            case 'pinterest':
                $link = 'popUp=window.open(\'https://pinterest.com/pin/create/button/?url=' . urlencode(get_permalink()) . '&amp;description=' . sanitize_title(get_the_title()) . '&amp;media=' . urlencode($image[0]) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
                break;
            case 'vk':
                $link = 'popUp=window.open(\'https://vkontakte.ru/share.php?url=' . urlencode(get_permalink()) . '&amp;title=' . urlencode(get_the_title()) . '&amp;description=' . urlencode(get_the_excerpt()) . '&amp;image=' . urlencode($image[0]) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
                break;
            default:
                $link = '';
        }

        return $link;
    }

	private function getSocialNetworkIcon( $net, $type ) {
		switch ( $net ) {
			case 'facebook':
				$icon = ( $type == 'ion-icons' ) ? 'ion-social-facebook-outline' : 'fab fa-facebook';
				break;
			case 'twitter':
				$icon = ( $type == 'ion-icons' ) ? 'ion-social-twitter-outline' : 'fab fa-twitter';
				break;
			case 'linkedin':
				$icon = ( $type == 'ion-icons' ) ? 'ion-social-linkedin-outline' : 'fab fa-linkedin';
				break;
			case 'tumblr':
				$icon = ( $type == 'ion-icons' ) ? 'ion-social-tumblr-outline' : 'fab fa-tumblr';
				break;
			case 'pinterest':
				$icon = ( $type == 'ion-icons' ) ? 'ion-social-pinterest-outline' : 'fab fa-pinterest';
				break;
			case 'vk':
				$icon = 'fab fa-vk';
				break;
			default:
				$icon = '';
		}
		
		return $icon;
	}

	private function getSocialNetworkText( $net ) {
		switch ( $net ) {
			case 'facebook':
				$text = esc_html__( 'fb', 'laurent-core');
				break;
			case 'twitter':
				$text = esc_html__( 'tw', 'laurent-core');
				break;
			case 'linkedin':
				$text = esc_html__( 'lnkd', 'laurent-core');
				break;
			case 'tumblr':
				$text = esc_html__( 'tmb', 'laurent-core');
				break;
			case 'pinterest':
				$text = esc_html__( 'pin', 'laurent-core');
				break;
			case 'vk':
				$text = esc_html__( 'vk', 'laurent-core');
				break;
			default:
				$text = '';
		}
		
		return $text;
	}

}
\Elementor\Plugin::instance()->widgets_manager->register( new LaurentCoreElementorSocialShare() );