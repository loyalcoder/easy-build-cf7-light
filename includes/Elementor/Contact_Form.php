<?php
namespace Builder7\Elementor;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Contact Form 7 Elementor Widget
 *
 * This class creates an Elementor widget for Contact Form 7 forms.
 *
 * @since 1.0.0
 */
class Contact_Form extends Widget_Base {

    /**
     * Get widget name.
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'builder7-contact-form';
    }

    /**
     * Get widget title.
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__('Contact Form 7', 'builder7');
    }

    /**
     * Get widget icon.
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-form-horizontal';
    }

    /**
     * Get widget style dependencies.
     *
     * @return array Array of style handles.
     */
    public function get_style_depends() {
        return [
            'builder7-style',
        ];
    }

    /**
     * Get widget script dependencies.
     *
     * @return array Array of script handles.
     */
    public function get_script_depends() {
        return [
            'builder7-script',
        ];
    }

    /**
     * Get widget categories.
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return ['builder-7-shortcode'];
    }

    /**
     * Register widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     */
    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'builder7'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'form_id',
            [
                'label' => esc_html__('Select Form', 'builder7'),
                'type' => Controls_Manager::SELECT,
                'options' => $this->get_cf7_forms(),
                'default' => '',
            ]
        );

        $this->end_controls_section();
        // Style Section for Success and Error Messages
        $this->start_controls_section(
            'message_styles_section',
            [
                'label' => esc_html__('Message Styles', 'builder7'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Success Message Styles
        $this->add_control(
            'success_message_heading',
            [
                'label' => esc_html__('Success Message', 'builder7'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'success_message_color',
            [
                'label' => esc_html__('Text Color', 'builder7'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 form.sent .wpcf7-response-output' => 'color: {{VALUE}};',
                ],
                'default' => '#46b450',
            ]
        );

        $this->add_control(
            'success_message_bg',
            [
                'label' => esc_html__('Background Color', 'builder7'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 form.sent .wpcf7-response-output' => 'background-color: {{VALUE}};',
                ],
                'default' => '#edfaef',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'success_message_border',
                'selector' => '{{WRAPPER}} .wpcf7 form.sent .wpcf7-response-output',
                'default' => [
                    'border_color' => '#46b450',
                ],
            ]
        );

        // Error Message Styles
        $this->add_control(
            'error_message_heading',
            [
                'label' => esc_html__('Error Message', 'builder7'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'error_message_color',
            [
                'label' => esc_html__('Text Color', 'builder7'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 form.invalid .wpcf7-response-output, {{WRAPPER}} .wpcf7 form.unaccepted .wpcf7-response-output, {{WRAPPER}} .wpcf7 form.payment-required .wpcf7-response-output' => 'color: {{VALUE}};',
                ],
                'default' => '#dc3232',
            ]
        );

        $this->add_control(
            'error_message_bg',
            [
                'label' => esc_html__('Background Color', 'builder7'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7 form.invalid .wpcf7-response-output, {{WRAPPER}} .wpcf7 form.unaccepted .wpcf7-response-output, {{WRAPPER}} .wpcf7 form.payment-required .wpcf7-response-output' => 'background-color: {{VALUE}};',
                ],
                'default' => '#fde8e8',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'error_message_border',
                'selector' => '{{WRAPPER}} .wpcf7 form.invalid .wpcf7-response-output, {{WRAPPER}} .wpcf7 form.unaccepted .wpcf7-response-output, {{WRAPPER}} .wpcf7 form.payment-required .wpcf7-response-output',
                'default' => [
                    'border_color' => '#dc3232',
                ],
            ]
        );

        // Common Message Styles
        $this->add_control(
            'message_spacing_heading',
            [
                'label' => esc_html__('Spacing', 'builder7'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'message_padding',
            [
                'label' => esc_html__('Padding', 'builder7'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-response-output' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => '12',
                    'right' => '15',
                    'bottom' => '12',
                    'left' => '15',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
            ]
        );

        $this->add_responsive_control(
            'message_margin',
            [
                'label' => esc_html__('Margin', 'builder7'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-response-output' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => '20',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'unit' => 'px',
                    'isLinked' => false,
                ],
            ]
        );

        $this->add_control(
            'message_border_radius',
            [
                'label' => esc_html__('Border Radius', 'builder7'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-response-output' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => '4',
                    'right' => '4',
                    'bottom' => '4',
                    'left' => '4',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Get available Contact Form 7 forms.
     *
     * @return array Array of form IDs and titles.
     */
    private function get_cf7_forms() {
        $forms = ['' => esc_html__('Select a Form', 'builder7')];
    
        $args = [
            'post_type'      => 'wpcf7_contact_form',
            'posts_per_page' => -1,
        ];
        $cf7_forms = get_posts($args);
    
        foreach ($cf7_forms as $form_post) {
            $form_id = $form_post->ID;
            $forms[$form_id] = $form_post->post_title . ' (ID: ' . $form_id . ')';
        }
    
        return $forms;
    }
    
    /**
     * Render widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        if (!empty($settings['form_id'])) {
            echo do_shortcode('[contact-form-7 id="' . esc_attr($settings['form_id']) . '"]');
        } else {
            echo '<p>' . esc_html__('Please select a Contact Form 7 form.', 'builder7') . '</p>';
        }
    }
}