<?php
class LaurentCoreElementorPricingTable extends \Elementor\Widget_Base {

	public function get_name() {
		return 'eltdf_pricing_table'; 
	}

	public function get_title() {
		return esc_html__( 'Pricing Table', 'laurent-core' );
	}

	public function get_icon() {
		return 'laurent-elementor-custom-icon laurent-elementor-pricing-table';
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
			'number_of_columns',
			[
				'label'     => esc_html__( 'Number of Columns', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'' => esc_html__( 'Default', 'laurent-core'), 
					'one' => esc_html__( 'One', 'laurent-core'), 
					'two' => esc_html__( 'Two', 'laurent-core'), 
					'three' => esc_html__( 'Three', 'laurent-core'), 
					'four' => esc_html__( 'Four', 'laurent-core'), 
					'five' => esc_html__( 'Five', 'laurent-core'), 
					'six' => esc_html__( 'Six', 'laurent-core')
				),
				'default' => 'three'
			]
		);

		$this->add_control(
			'space_between_items',
			[
				'label'     => esc_html__( 'Space Between Items', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'huge' => esc_html__( 'Huge (40)', 'laurent-core'), 
					'large' => esc_html__( 'Large (25)', 'laurent-core'), 
					'medium' => esc_html__( 'Medium (20)', 'laurent-core'), 
					'normal' => esc_html__( 'Normal (15)', 'laurent-core'), 
					'small' => esc_html__( 'Small (10)', 'laurent-core'), 
					'tiny' => esc_html__( 'Tiny (5)', 'laurent-core'), 
					'no' => esc_html__( 'No (0)', 'laurent-core')
				),
				'default' => 'normal'
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'custom_class',
			[
				'label'     => esc_html__( 'Custom CSS Class', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'laurent-core' )
			]
		);

		$repeater->add_control(
			'set_active_item',
			[
				'label'     => esc_html__( 'Set Item As Active', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'no' => esc_html__( 'No', 'laurent-core'), 
					'yes' => esc_html__( 'Yes', 'laurent-core')
				),
				'default' => 'no'
			]
		);

		$repeater->add_control(
			'content_background_color',
			[
				'label'     => esc_html__( 'Content Background Color', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR
			]
		);

		$repeater->add_control(
			'title',
			[
				'label'     => esc_html__( 'Title', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$repeater->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Title Color', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'title!' => ''
				]
			]
		);

		$repeater->add_control(
			'title_border_color',
			[
				'label'     => esc_html__( 'Title Bottom Border Color', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'title!' => ''
				]
			]
		);

		$repeater->add_control(
			'price',
			[
				'label'     => esc_html__( 'Price', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$repeater->add_control(
			'price_color',
			[
				'label'     => esc_html__( 'Price Color', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'price!' => ''
				]
			]
		);

		$repeater->add_control(
			'currency',
			[
				'label'     => esc_html__( 'Currency', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Default mark is $', 'laurent-core' )
			]
		);

		$repeater->add_control(
			'currency_color',
			[
				'label'     => esc_html__( 'Currency Color', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'currency!' => ''
				]
			]
		);

		$repeater->add_control(
			'price_period',
			[
				'label'     => esc_html__( 'Price Period', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'description' => esc_html__( 'Default label is monthly', 'laurent-core' )
			]
		);

		$repeater->add_control(
			'price_period_color',
			[
				'label'     => esc_html__( 'Price Period Color', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'condition' => [
					'price_period!' => ''
				]
			]
		);

		$repeater->add_control(
			'button_text',
			[
				'label'     => esc_html__( 'Button Text', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT
			]
		);

		$repeater->add_control(
			'link',
			[
				'label'     => esc_html__( 'Button Link', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'condition' => [
					'button_text!' => ''
				]
			]
		);

		$repeater->add_control(
			'target',
			[
				'label'     => esc_html__( 'Link Target', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'_self' => esc_html__( 'Same Window', 'laurent-core'), 
					'_blank' => esc_html__( 'New Window', 'laurent-core')
				),
				'default' => '_self'
			]
		);

		$repeater->add_control(
			'button_type',
			[
				'label'     => esc_html__( 'Button Type', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'solid' => esc_html__( 'Solid', 'laurent-core'), 
					'outline' => esc_html__( 'Outline', 'laurent-core')
				),
				'default' => 'solid',
				'condition' => [
					'button_text!' => ''
				]
			]
		);

		$repeater->add_control(
			'content',
			[
				'label'     => esc_html__( 'Content', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::TEXTAREA
			]
		);

		$this->add_control(
			'pricing_table_item',
			[
				'label'     => esc_html__( 'Pricing Table Item', 'laurent-core' ),
				'type'      => \Elementor\Controls_Manager::REPEATER,
				'fields'     => $repeater->get_controls(),
				'title_field'     => esc_html__( 'Item', 'laurent-core' )
			]
		);


		$this->end_controls_section();
	}
	public function render() {

		$params = $this->get_settings_for_display();
		$holder_class = $this->getHolderClasses( $params );

		?>
        <div class="eltdf-pricing-tables eltdf-grid-list eltdf-disable-bottom-space clearfix  <?php echo esc_attr( $holder_class ); ?>">
            <div class="eltdf-pt-wrapper eltdf-outer-space">
                <?php foreach ( $params['pricing_table_item'] as $pti ) {

                    $pti['holder_classes']          = $this->getItemHolderClasses( $pti );
                    $pti['holder_styles']           = $this->getItemHolderStyles( $pti );
                    $pti['title_styles']            = $this->getItemTitleStyles( $pti );
                    $pti['price_styles']            = $this->getItemPriceStyles( $pti );
                    $pti['currency_styles']         = $this->getItemCurrencyStyles( $pti );
                    $pti['price_period_styles']     = $this->getItemPricePeriodStyles( $pti );

                    echo laurent_core_get_shortcode_module_template_part( 'templates/pricing-table-template', 'pricing-table', '', $pti );
                } ?>
            </div>
        </div>
    <?php }

	private function getHolderClasses( $params, $args ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['number_of_columns'] ) ? 'eltdf-' . $params['number_of_columns'] . '-columns' : '';
		$holderClasses[] = ! empty( $params['space_between_items'] ) ? 'eltdf-' . $params['space_between_items'] . '-space' : '';
		
		return implode( ' ', $holderClasses );
	}

    private function getItemHolderClasses( $params ) {
        $holderClasses = array();

        $holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
        $holderClasses[] = $params['set_active_item'] === 'yes' ? 'eltdf-pt-active-item' : '';

        return implode( ' ', $holderClasses );
    }

    private function getItemHolderStyles( $params ) {
        $itemStyle = array();

        if ( ! empty( $params['content_background_color'] ) ) {
            $itemStyle[] = 'background-color: ' . $params['content_background_color'];
        }

        return implode( ';', $itemStyle );
    }

    private function getItemTitleStyles( $params ) {
        $itemStyle = array();

        if ( ! empty( $params['title_color'] ) ) {
            $itemStyle[] = 'color: ' . $params['title_color'];
        }

        if ( ! empty( $params['title_border_color'] ) ) {
            $itemStyle[] = 'border-color: ' . $params['title_border_color'];
        }

        return implode( ';', $itemStyle );
    }

    private function getItemPriceStyles( $params ) {
        $itemStyle = array();

        if ( ! empty( $params['price_color'] ) ) {
            $itemStyle[] = 'color: ' . $params['price_color'];
        }

        return implode( ';', $itemStyle );
    }

    private function getItemCurrencyStyles( $params ) {
        $itemStyle = array();

        if ( ! empty( $params['currency_color'] ) ) {
            $itemStyle[] = 'color: ' . $params['currency_color'];
        }

        return implode( ';', $itemStyle );
    }

    private function getItemPricePeriodStyles( $params ) {
        $itemStyle = array();

        if ( ! empty( $params['price_period_color'] ) ) {
            $itemStyle[] = 'color: ' . $params['price_period_color'];
        }

        return implode( ';', $itemStyle );
    }

}
\Elementor\Plugin::instance()->widgets_manager->register( new LaurentCoreElementorPricingTable() );