<?php

namespace EasyBuildCF7Light\Elementor;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

class Input_Acceptance extends Widget_Base
{
    public function get_name()
    {
        return 'easy-build-cf7-light-input-acceptance';
    }
    /**
     * Get widget title.
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return esc_html__('Input Acceptance', 'easy-build-cf7-light');
    }
    /**
     * Get widget icon.
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-checkbox';
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
        return ['input', 'checkboxes', 'acceptance', 'field', 'easy-build-cf7-light'];
    }


    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Content', 'easy-build-cf7-light'),
            ]
        );
        $this->add_control(
            'field_name',
            [
                'label'   => esc_html__( 'Field Name', 'easy-build-cf7-light' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'acceptance-' . wp_rand(100, 999),
            ]
        );
        $this->add_control(
            'checkbox_is_optional',
            [
                'label'        => esc_html__( ' This checkbox is optional.', 'easy-build-cf7-light' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'easy-build-cf7-light' ),
                'label_off'    => esc_html__( 'No', 'easy-build-cf7-light' ),
                'return_value' => 'optional',
                'default'      => 'optional',
            ]
        );
        $this->add_control(
            'classes',
            [
                'label' => esc_html__( 'Classes (space-separated)', 'easy-build-cf7-light' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'description' => esc_html__( 'Enter classes prefixed with "class:", e.g. "cla1 cla2"', 'easy-build-cf7-light' ),
            ]
        );
        $this->add_control(
            'field_id',
            [
                'label' => esc_html__( 'Field ID', 'easy-build-cf7-light' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
            ]
        );
        $this->add_control(
            'show_label',   
            [
                'label' => esc_html__( 'Show Label', 'easy-build-cf7-light' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'easy-build-cf7-light' ),
                'label_off' => esc_html__( 'No', 'easy-build-cf7-light' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'label',
            [
                'label' => esc_html__( 'Label', 'easy-build-cf7-light' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'First name',
                'condition' => [
                    'show_label' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'field_condition',
            [
                'label'   => esc_html__( 'Field Condition', 'easy-build-cf7-light' ),
                'type'    => Controls_Manager::TEXT,
                'placeholder'=>'Put the condition for consent here.',
                'default' => 'Put the condition for consent here.',
                'label_block' => true,
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__('Style', 'easy-build-cf7-light'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Label styles
        $this->add_control(
            'label_heading',
            [
                'label' => esc_html__('Label', 'easy-build-cf7-light'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'label_color',
            [
                'label' => esc_html__('Label Color', 'easy-build-cf7-light'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} label' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'label_typography',
				'selector' => '{{WRAPPER}} label',
			]
		);

        $this->add_responsive_control(
            'label_margin',
            [
                'label' => esc_html__('Label Margin', 'easy-build-cf7-light'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Checkbox styles
        $this->add_control(
            'checkbox_heading',
            [
                'label' => esc_html__('Checkbox', 'easy-build-cf7-light'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'checkbox_color',
            [
                'label' => esc_html__('Checkbox Color', 'easy-build-cf7-light'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-list-item input[type="checkbox"]' => 'accent-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'checkbox_size',
            [
                'label' => esc_html__('Checkbox Size', 'easy-build-cf7-light'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 3,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-list-item input[type="checkbox"]' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Text styles
        $this->add_control(
            'text_heading',
            [
                'label' => esc_html__('Acceptance Text', 'easy-build-cf7-light'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__('Text Color', 'easy-build-cf7-light'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-list-item .wpcf7-list-item-label' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'acceptance_text_typography',
				'selector' => '{{WRAPPER}} .wpcf7-list-item .wpcf7-list-item-label',
			]
		);
        $this->add_responsive_control(
            'text_gap',
            [
                'label' => esc_html__('Text Gap', 'easy-build-cf7-light'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 3,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-list-item .wpcf7-list-item-label' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'text_spacing',
            [
                'label' => esc_html__('Text Spacing', 'easy-build-cf7-light'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 3,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .lcf7-form-check' => 'margin: {{SIZE}}{{UNIT}} 0;',
                ],
            ]
        );


        $this->end_controls_section();
    }

    protected function render()
    {
        $settings                 = $this->get_settings_for_display();
        $attributes               = [];
        $attributes['type']       = 'acceptance';
        $attributes['field_name'] = $settings['field_name'];
        $attributes['id']         = $settings['field_id'];
        $attributes['class']      = 'cf7-e-addon lcf7-form-check';
        if (!empty($settings['classes'])) {
            $attributes['class'] .= ' ' . $settings['classes'];
        }
        $attributes['field_condition']      = $settings['field_condition'];
        $attributes['checkbox_is_optional'] = $settings['checkbox_is_optional'];
        $attributes                         = array_filter($attributes);
        $parent_class                       = ['b7-field-parent'];
        $parent_class_joined                = implode(' ', $parent_class);
        if(easy_build_cf7_light_is_preview()){ ?>
            <div class="<?php echo esc_attr($parent_class_joined); ?>">
            <?php if($settings['show_label']) { ?>
                <label for="<?php echo esc_attr($settings['field_id']); ?>"><?php echo esc_html($settings['label']); ?></label>
            <?php } ?>
                <p>
                    <span class="wpcf7-form-control-wrap" data-name="acceptance-226">
                        <span class="wpcf7-form-control wpcf7-acceptance">
                            <span class="wpcf7-list-item">
                                    <input type="checkbox" name="acceptance-226" value="1" aria-invalid="false" class="cf7-e-addon lcf7-form-check">
                                    <span class="wpcf7-list-item-label"><?php echo esc_html($settings['field_condition']); ?></span>
                            </span>
                        </span>
                    </span>
                </p>
           </div>
        <?php
        }else{ ?>
            <div class="<?php echo esc_attr($parent_class_joined); ?>" >
            <?php if($settings['show_label']) { ?>
                <label for="<?php echo esc_attr($settings['field_id']); ?>"><?php echo esc_html($settings['label']); ?></label>
            <?php } ?>
                <?php echo wp_kses( easy_build_cf7_light_generate_shortcode($attributes), easy_build_cf7_light_allow_form_attr());?>
           </div>
             
        <?php
        }

    }

    protected function content_template()
    {
        
    }
}
