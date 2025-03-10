<?php
namespace EasyBuildCF7Light\Elementor;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Input_Submit Class
 * 
 * Creates a submit button widget for Contact Form 7 in Elementor.
 * This widget allows users to add and customize submit buttons with various styling options.
 *
 * @since 1.0.0
 * @package EasyBuildCF7Light
 * @subpackage Elementor
 */
class Input_Submit extends Widget_Base
{
    /**
     * Get widget name.
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'easy-build-cf7-light-input-submit';
    }

    /**
     * Get widget title.
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return esc_html__('Input Submit', 'easy-build-cf7-light');
    }

    /**
     * Get widget icon.
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-button';
    }

    /**
     * Get widget categories.
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['easy_build_cf7_light_widgets'];
    }

    /**
     * Get widget keywords.
     *
     * @return array Widget keywords.
     */
    public function get_keywords()
    {
        return ['submit', 'button', 'form', 'easy-build-cf7-light'];
    }

    /**
     * Register widget controls.
     *
     * @return void
     */
    protected function register_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Content', 'easy-build-cf7-light'),
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'easy-build-cf7-light'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Submit', 'easy-build-cf7-light'),
                'placeholder' => esc_html__('Enter button text', 'easy-build-cf7-light'),
            ]
        );

        $this->add_control(
            'field_id',
            [
                'label' => esc_html__('Field ID', 'easy-build-cf7-light'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
            ]
        );

        $this->add_control(
            'classes',
            [
                'label' => esc_html__('Classes (space-separated)', 'easy-build-cf7-light'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'description' => esc_html__('Enter classes prefixed with "class:", e.g. "class:button class:primary"', 'easy-build-cf7-light'),
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__('Button Style', 'easy-build-cf7-light'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'button_text_align',
            [
                'label' => esc_html__('Alignment', 'easy-build-cf7-light'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'easy-build-cf7-light'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'easy-build-cf7-light'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'easy-build-cf7-light'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .lcf7-input-submit-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        
        

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .lcf7-input-submit',
			]
		);

        $this->start_controls_tabs('button_style_tabs');

        // Normal tab
        $this->start_controls_tab(
            'button_style_normal',
            [
                'label' => esc_html__('Normal', 'easy-build-cf7-light'),
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => esc_html__('Text Color', 'easy-build-cf7-light'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lcf7-input-submit' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'button_background',
                'label' => esc_html__('Background', 'easy-build-cf7-light'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .lcf7-input-submit',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .lcf7-input-submit',
            ]
        );

        $this->add_responsive_control(
            'button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'easy-build-cf7-light'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .lcf7-input-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => esc_html__('Padding', 'easy-build-cf7-light'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .lcf7-input-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        // Hover tab
        $this->start_controls_tab(
            'button_style_hover',
            [
                'label' => esc_html__('Hover', 'easy-build-cf7-light'),
            ]
        );

        $this->add_control(
            'button_hover_text_color',
            [
                'label' => esc_html__('Text Color', 'easy-build-cf7-light'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lcf7-input-submit:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'button_hover_background',
                'label' => esc_html__('Background', 'easy-build-cf7-light'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .lcf7-input-submit:hover',
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'easy-build-cf7-light'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lcf7-input-submit:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    /**
     * Render widget output.
     *
     * @return void
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        
        $classes = !empty($settings['classes']) ? ' wpcf7-form-control lcf7-type-submit ' . $settings['classes'] : 'lcf7-input-submit type-submit';
        $id = !empty($settings['field_id']) ? ' id:' . $settings['field_id'] : '';
        $shortcode_class = ' class:lcf7-input-submit class:type-submit';
        if (!empty($settings['classes'])) {
            $class_array = explode(' ', $settings['classes']);
            $shortcode_class .= ' ' . implode(' ', array_map(function($class) {
                return 'class:' . $class;
            }, $class_array));
        }        
        // Check if we're in Elementor preview mode 
         // Output button inside a wrapper for alignment
        echo '<div class="lcf7-input-submit-wrapper">';
        if (easy_build_cf7_light_is_preview()) {
            
            echo wp_kses('<input type="submit" value="' . esc_attr($settings['button_text']) . '" class="' . esc_attr($classes) . '">', array(
                'input' => array(
                    'type' => array(),
                    'value' => array(),
                    'class' => array()
                )
            ));
        } else {
            echo wp_kses('[submit ' . $id . $shortcode_class . ' "' . esc_attr($settings['button_text']) . '" ]', easy_build_cf7_light_allow_form_attr());
        }
        echo '</div>';
    }
}
