<?php

namespace EasyBuildCF7Light\Elementor;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Input_Quiz Class
 * 
 * Creates a quiz input field widget for Contact Form 7 in Elementor.
 * This widget allows users to add and customize quiz fields with questions and answers.
 *
 * @since 1.0.0
 * @package EasyBuildCF7Light
 * @subpackage Elementor
 */
class Input_Quiz extends Widget_Base
{
    /**
     * Get widget name.
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'easy-build-cf7-light-input-quiz';
    }

    /**
     * Get widget title.
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return esc_html__('Input Quiz', 'easy-build-cf7-light');
    }

    /**
     * Get widget icon.
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-help';
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
        return ['quiz', 'input', 'form', 'easy-build-cf7-light', 'contact form 7'];
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
                'label' => esc_html__('Quiz', 'easy-build-cf7-light'),
            ]
        );

        $this->add_control(
            'field_name',
            [
                'label' => esc_html__('Field Name', 'easy-build-cf7-light'),
                'type' => Controls_Manager::TEXT,
                'default' => 'quiz-'.wp_rand(100, 999),
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
                'description' => esc_html__('Enter classes prefixed with "class:", e.g. "cla1 cla2"', 'easy-build-cf7-light'),
            ]
        );

        $this->add_control(
            'show_label',
            [
                'label' => esc_html__('Show Label', 'easy-build-cf7-light'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'easy-build-cf7-light'),
                'label_off' => esc_html__('No', 'easy-build-cf7-light'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'label',
            [
                'label' => esc_html__('Label', 'easy-build-cf7-light'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Quiz', 'easy-build-cf7-light'),
                'condition' => [
                    'show_label' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'field_question_and_answer',
            [
                'label' => esc_html__('Questions and Answers', 'easy-build-cf7-light'),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 5,
                'default' => esc_html__('The capital of Brazil? | Rio', 'easy-build-cf7-light'),
                'description' => esc_html__('One pipe-separated question-answer pair (question|answer) per line.', 'easy-build-cf7-light'),
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'section_label_style',
            [
                'label' => esc_html__('Label', 'easy-build-cf7-light'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_label' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'label_typography',
                'selector' => '{{WRAPPER}} .builder-7-field-parent label',
            ]
        );

        $this->add_control(
            'label_color',
            [
                'label' => esc_html__('Color', 'easy-build-cf7-light'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .builder-7-field-parent label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'label_margin',
            [
                'label' => esc_html__('Margin', 'easy-build-cf7-light'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .builder-7-field-parent label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_input_style',
            [
                'label' => esc_html__('Input', 'easy-build-cf7-light'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('input_style_tabs');

        $this->start_controls_tab(
            'input_style_normal',
            [
                'label' => esc_html__('Normal', 'easy-build-cf7-light'),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'input_background',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .lcf7-form-control',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'input_border',
                'selector' => '{{WRAPPER}} .lcf7-form-control',
            ]
        );

        $this->add_control(
            'input_text_color',
            [
                'label' => esc_html__('Text Color', 'easy-build-cf7-light'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lcf7-form-control' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'input_style_focus',
            [
                'label' => esc_html__('Focus', 'easy-build-cf7-light'),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'input_background_focus',
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .lcf7-form-control:focus',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'input_border_focus',
                'selector' => '{{WRAPPER}} .lcf7-form-control:focus',
            ]
        );

        $this->add_control(
            'input_text_color_focus',
            [
                'label' => esc_html__('Text Color', 'easy-build-cf7-light'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lcf7-form-control:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'input_padding',
            [
                'label' => esc_html__('Padding', 'easy-build-cf7-light'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .lcf7-form-control' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'input_border_radius',
            [
                'label' => esc_html__('Border Radius', 'easy-build-cf7-light'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .lcf7-form-control' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render widget output on the frontend.
     *
     * @return void
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $attributes = [];
        $attributes['type'] = 'text';
        $attributes['field_name'] = $settings['field_name'];
        $attributes['id'] = $settings['field_id'];
        $attributes['class']      = 'lcf7-e-addon lcf7-form-control';
        if (!empty($settings['classes'])) {
            $attributes['class'] .= ' ' . $settings['classes'];
        }
        $values_explode = explode("\n", $settings['field_question_and_answer']);
        $select_values = array_map('trim', $values_explode);
        $attributes['values_select'] = '"' . implode('" "', $select_values) . '"';

        $attributes = array_filter($attributes);
        $parent_class = ['builder-7-field-parent'];
        $parent_class_joined = implode(' ', $parent_class);
        
        if(easy_build_cf7_light_is_preview()){ ?>
            <div class="<?php echo esc_attr($parent_class_joined); ?>">
             <?php if($settings['show_label']) { ?>
                 <label for="<?php echo esc_attr($settings['field_id']); ?>"><?php echo esc_html($settings['label']); ?></label>
             <?php } ?>
                 <?php echo wp_kses( easy_build_cf7_light_generate_html($attributes), easy_build_cf7_light_allow_form_attr());?>
            </div>
         <?php
         }else{ ?>
             <div class="<?php echo esc_attr($parent_class_joined); ?>">
             <?php if($settings['show_label']) { ?>
                 <label for="<?php echo esc_attr($settings['field_id']); ?>"><?php echo esc_html($settings['label']); ?></label>
             <?php } ?>
                 <?php echo wp_kses( easy_build_cf7_light_generate_shortcode($attributes), easy_build_cf7_light_allow_form_attr());?>
            </div>
              
         <?php
         }
    }

    /**
     * Render widget output in the editor.
     *
     * @return void
     */
    protected function content_template()
    {
        
    }
}
