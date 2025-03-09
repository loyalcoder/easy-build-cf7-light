<?php

namespace Builder7\Elementor;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

class Input_Date extends Widget_Base
{
    public function get_name()
    {
        return 'builder-7-input-date';
    }

    public function get_title()
    {
        return esc_html__('Input Date', 'builder7');
    }
    /**
     * Get widget icon.
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-date';
    }

    /**
     * Get widget categories.
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['builder_7_widgets'];
    }

    /**
     * Get widget keywords.
     *
     * @return array Widget keywords.
     */
    public function get_keywords()
    {
        return ['input', 'date', 'field', 'builder-7'];
    }


    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Content', 'builder7'),
            ]
        );
        $this->add_control(
            'field_name',
            [
                'label' => esc_html__( 'Field Name', 'builder7' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'date-' . wp_rand(100, 999),
            ]
        );
        $this->add_control(
            'is_required',
            [
                'label' => esc_html__( 'Required Field', 'builder7' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'builder7' ),
                'label_off' => esc_html__( 'No', 'builder7' ),
                'return_value' => 'required',
                'default' => '',
            ]
        );
        $this->add_control(
            'custom_validation_message',
            [
                'label' => esc_html__( 'Custom Validation Message', 'builder7' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'label_block' => true,
                'condition' => [
                    'is_required' => 'required',
                ],
            ]
        );
        $this->add_control(
            'classes',
            [
                'label' => esc_html__( 'Classes (space-separated)', 'builder7' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'description' => esc_html__( 'Enter classes prefixed with "class:", e.g. "cla1 cla2"', 'builder7' ),
            ]
        );
        $this->add_control(
            'field_id',
            [
                'label' => esc_html__( 'Field ID', 'builder7' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
            ]
        );
        $this->add_control(
            'show_label',   
            [
                'label' => esc_html__( 'Show Label', 'builder7' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'builder7' ),
                'label_off' => esc_html__( 'No', 'builder7' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'label',
            [
                'label' => esc_html__( 'Label', 'builder7' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Date', 'builder7'),
                'condition' => [
                    'show_label' => 'yes',
                ],
            ]
        );
        $this->add_control(
			'date_time_option',
			[
				'label' => esc_html__( 'Range', 'builder7' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_control(
            'minlength',
            [
                'label' => esc_html__( 'Min', 'builder7' ),
				'type' => \Elementor\Controls_Manager::DATE_TIME,
                'picker_options' => [
                    'enableTime' => false
                ]
			]
		);

        $this->add_control(
            'maxlength',
            [
                'label' => esc_html__( 'Max', 'builder7' ),
				'type' => \Elementor\Controls_Manager::DATE_TIME,
                'picker_options' => [
                    'enableTime' => false
                ]
			]
		);
        $this->add_control(
			'default_value',
			[
				'label' => esc_html__( 'Default Value', 'builder7' ),
				'type' => \Elementor\Controls_Manager::DATE_TIME,
                'picker_options' => [
                    'enableTime' => false
                ]
			]
		);

        $this->end_controls_section();
        // Input Style Section
        $this->start_controls_section(
            'section_input_style',
            [
                'label' => esc_html__('Input Style', 'builder7'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'input_text_color',
            [
                'label' => esc_html__('Text Color', 'builder7'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lcf7-form-control' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'input_typography',
                'selector' => '{{WRAPPER}} .lcf7-form-control',
            ]
        );

    $this->add_control(
        'input_background_color',
        [
            'label' => esc_html__('Background Color', 'builder7'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .lcf7-form-control' => 'background-color: {{VALUE}};',
            ],
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
        'input_border_radius',
        [
            'label' => esc_html__('Border Radius', 'builder7'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors' => [
                '{{WRAPPER}} .lcf7-form-control' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'input_padding',
        [
            'label' => esc_html__('Padding', 'builder7'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .lcf7-form-control' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'input_box_shadow',
            'label' => esc_html__('Box Shadow', 'builder7'),
            'selector' => '{{WRAPPER}} .lcf7-form-control',
        ]
    );
    $this->add_control(
        'input_alignment',
        [
            'label' => esc_html__('Alignment', 'builder7'),
            'type' => Controls_Manager::CHOOSE,
            'options' => [
                'left' => [
                    'title' => esc_html__('Left', 'builder7'),
                    'icon' => 'eicon-text-align-left',
                ],
                'center' => [
                    'title' => esc_html__('Center', 'builder7'),
                    'icon' => 'eicon-text-align-center',
                ],
                'right' => [
                    'title' => esc_html__('Right', 'builder7'),
                    'icon' => 'eicon-text-align-right',
                ],
            ],
            'default' => 'left',
            'toggle' => true,
            'selectors' => [
                '{{WRAPPER}} .l-cf7-field-parent > input' => 'text-align: {{VALUE}};',
            ],
        ]
    );
    $this->end_controls_section();

    // Input Focus Style Section
    $this->start_controls_section(
        'section_input_focus_style',
        [
            'label' => esc_html__('Input Focus Style', 'builder7'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_control(
        'input_focus_text_color',
        [
            'label' => esc_html__('Text Color', 'builder7'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .lcf7-form-control:focus' => 'color: {{VALUE}};',
            ],
        ]
    );

    $this->add_control(
        'input_focus_background_color',
        [
            'label' => esc_html__('Background Color', 'builder7'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .lcf7-form-control:focus' => 'background-color: {{VALUE}};',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'input_focus_border',
            'selector' => '{{WRAPPER}} .lcf7-form-control:focus',
        ]
    );

    $this->add_responsive_control(
        'input_focus_border_radius',
        [
            'label' => esc_html__('Border Radius', 'builder7'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors' => [
                '{{WRAPPER}} .lcf7-form-control:focus' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'input_focus_box_shadow',
            'label' => esc_html__('Box Shadow', 'builder7'),
            'selector' => '{{WRAPPER}} .lcf7-form-control:focus',
        ]
    );
    $this->end_controls_section();

    // Label Style Section
    $this->start_controls_section(
        'section_label_style',
        [
            'label' => esc_html__('Label Style', 'builder7'),
            'tab' => Controls_Manager::TAB_STYLE,
            'condition' => [
                'show_label' => 'yes',
            ],
        ]
    );

    $this->add_control(
        'label_color',
        [
            'label' => esc_html__('Text Color', 'builder7'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .l-cf7-field-parent label' => 'color: {{VALUE}};',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'label_typography',
            'selector' => '{{WRAPPER}} .l-cf7-field-parent label',
        ]
    );

    $this->add_responsive_control(
        'label_margin',
        [
            'label' => esc_html__('Margin', 'builder7'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .l-cf7-field-parent label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $this->add_responsive_control(
        'label_alignment',
        [
            'label' => esc_html__('Alignment', 'builder7'),
            'type' => Controls_Manager::CHOOSE,
            'options' => [
                'left' => [
                    'title' => esc_html__('Left', 'builder7'),
                    'icon' => 'eicon-text-align-left',
                ],
                'center' => [
                    'title' => esc_html__('Center', 'builder7'),
                    'icon' => 'eicon-text-align-center',
                ],
                'right' => [
                    'title' => esc_html__('Right', 'builder7'),
                    'icon' => 'eicon-text-align-right',
                ],
            ],
            'default' => 'left',
            'toggle' => true,
            'selectors' => [
                '{{WRAPPER}} .l-cf7-field-parent' => 'text-align: {{VALUE}};',
            ],
            'condition' => [
                'show_label' => 'yes',
            ],
        ]
    );
    $this->end_controls_section();
    $this->start_controls_section(
        'section_layout',
        [
            'label' => esc_html__('Layout', 'builder7'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_responsive_control(
        'input_width',
        [
            'label' => esc_html__('Input Width', 'builder7'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                    'step' => 1,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .lcf7-form-control' => 'width: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'input_height',
        [
            'label' => esc_html__('Input Height', 'builder7'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px', 'em'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 200,
                    'step' => 1,
                ],
                'em' => [
                    'min' => 0,
                    'max' => 12,
                    'step' => 0.1,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .lcf7-form-control' => 'height: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $attributes = [];
        $attributes['type'] = 'date';
        $attributes['required'] = $settings['is_required'] === 'required' ? '*' : '';
        $attributes['field_name'] = $settings['field_name'];
        $attributes['id'] = $settings['field_id'];
        $attributes['class']      = 'cf7-e-addon lcf7-form-control';
        if (!empty($settings['classes'])) {
            $attributes['class'] .= ' ' . $settings['classes'];
        }
        $attributes['minlength_number'] = $settings['minlength'];
        $attributes['maxlength_number'] = $settings['maxlength'];
        if (!empty($settings['default_value'])) {
            $attributes['number_default'] = '"'.$settings['default_value'].'"';
        }
        $attributes = array_filter($attributes);
        $parent_class = ['l-cf7-field-parent'];
        $parent_class_joined = implode(' ', $parent_class);
        
        if(builder7_is_preview()){ ?>
           <div class="<?php echo esc_attr($parent_class_joined); ?>">
            <?php if($settings['show_label']) { ?>
                <label for="<?php echo esc_attr($settings['field_id']); ?>"><?php echo esc_html($settings['label']); ?></label>
            <?php } ?>
                <?php echo wp_kses( builder7_generate_cf7_html($attributes), builder7_allow_form_attr());?>
           </div>
        <?php
        }else{ ?>
            <div class="<?php echo esc_attr($parent_class_joined); ?>" data-custom-validation="<?php echo esc_attr($settings['custom_validation_message']); ?>">
            <?php if($settings['show_label']) { ?>
                <label for="<?php echo esc_attr($settings['field_id']); ?>"><?php echo esc_html($settings['label']); ?></label>
            <?php } ?>
                <?php echo wp_kses( builder7_generate_cf7_shortcode($attributes), builder7_allow_form_attr());?>
           </div>
             
        <?php
        }

    }

    protected function content_template()
    {
        
    }
}
