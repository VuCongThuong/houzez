<?php

//namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Homez_Elementor_Compare_Btn extends Elementor\Widget_Base {

	public function get_name() {
        return 'apus_element_compare_btn';
    }

	public function get_title() {
        return esc_html__( 'Apus Header Compare Button', 'homez' );
    }
    
	public function get_categories() {
        return [ 'homez-header-elements' ];
    }

	protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'homez' ),
                'tab' => Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => esc_html__( 'Alignment', 'homez' ),
                'type' => Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'homez' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'homez' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'homez' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                ],
            ]
        );

   		$this->add_control(
            'el_class',
            [
                'label'         => esc_html__( 'Extra class name', 'homez' ),
                'type'          => Elementor\Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'homez' ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__( 'Color', 'homez' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__( 'Color Text', 'homez' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-compare' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'text_hover_color',
            [
                'label' => esc_html__( 'Color Hover Text', 'homez' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn-compare:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .btn-compare:focus' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

    }

	protected function render() {
        $settings = $this->get_settings();

        extract( $settings );
        $compare_items = WP_RealEstate_Compare::get_compare_items();
        $compare_properties_page_id = wp_realestate_get_option('compare_properties_page_id');
        $compare_properties_page_id = WP_RealEstate_Mixes::get_lang_post_id($compare_properties_page_id);
        ?>
        <div class="widget-compare-btn <?php echo esc_attr($el_class); ?>">
            <a class="btn-compare" href="<?php echo esc_url( get_permalink( $compare_properties_page_id ) ); ?>" title="<?php esc_attr_e('Compare','homez'); ?>">
                <i class="flaticon-transfer-1"></i>
                <span class="count"><?php echo (!empty($compare_items) ? count($compare_items) : '0') ; ?></span>
            </a>
        </div>
        <?php
    }
}

Elementor\Plugin::instance()->widgets_manager->register( new Homez_Elementor_Compare_Btn );