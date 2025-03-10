<?php

namespace EasyBuildCF7Light\Elementor;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

class Input_Number extends Widget_Base
{
    public function get_name()
    {
        return 'easy-build-cf7-light-input-number';
    }

    public function get_title()
    {
        return esc_html__('Input Number', 'easy-build-cf7-light');
    }
      /**
     * Get widget icon.
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-number-field';
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
        return ['input', 'number', 'field', 'easy-build-cf7-light'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => __('Content', 'easy-build-cf7-light'),
            ]
        );
        $this->add_control(
            'field_type',
            [
                'label'   => esc_html__('Field Type', 'easy-build-cf7-light'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'number' => esc_html__('Spinbox', 'easy-build-cf7-light'),
                    'range'  => esc_html__('Slider', 'easy-build-cf7-light'),
                ],
                'default' => 'number',
            ]
        );
        $this->add_control(
            'field_name',
            [
                'label'   => esc_html__( 'Field Name', 'easy-build-cf7-light' ),
                'type'    => Controls_Manager::TEXT,
                'default' => 'number-'.wp_rand(100, 999),
            ]
        );
        $this->add_control(
            'is_required',
            [
                'label'        => esc_html__( 'Required Field', 'easy-build-cf7-light' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'easy-build-cf7-light' ),
                'label_off'    => esc_html__( 'No', 'easy-build-cf7-light' ),
                'return_value' => 'required',
                'default'      => '',
            ]
        );
        $this->add_control(
            'custom_validation_message',
            [
                'label'       => esc_html__( 'Custom Validation Message', 'easy-build-cf7-light' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => '',
                'label_block' => true,
                'condition'   => [
                    'is_required' => 'required',
                ],
            ]
        );
        
        $this->add_control(
            'classes',
            [
                'label'       => esc_html__( 'Classes (space-separated)', 'easy-build-cf7-light' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => '',
                'description' => esc_html__( 'Enter classes prefixed with "class:", e.g. "cla1 cla2"', 'easy-build-cf7-light' ),
            ]
        );
        $this->add_control(
            'field_id',
            [
                'label'   => esc_html__( 'Field ID', 'easy-build-cf7-light' ),
                'type'    => Controls_Manager::TEXT,
                'default' => '',
            ]
        );
        $this->add_control(
            'show_label',   
            [
                'label'        => esc_html__( 'Show Label', 'easy-build-cf7-light' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'easy-build-cf7-light' ),
                'label_off'    => esc_html__( 'No', 'easy-build-cf7-light' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );
        $this->add_control(
            'label',
            [
                'label'     => esc_html__( 'Label', 'easy-build-cf7-light' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => 'Your Number',
                'condition' => [
                    'show_label' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'minlength',
            [
                'label'   => esc_html__( 'Min Length', 'easy-build-cf7-light' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 2,
                'min'     => 1,
                'max'     => 1000,
            ]
        );

        $this->add_control(
            'maxlength',
            [
                'label'   => esc_html__( 'Max Length', 'easy-build-cf7-light' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 500,
                'min'     => 1,
                'max'     => 1000,
            ]
        );

        $this->add_control(
            'default_value',
            [
                'label'   => esc_html__( 'Default Value', 'easy-build-cf7-light' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => '',
            ]
        );
        $this->end_controls_section();
    $this->start_controls_section(
        'range_style_section',
        [
            'label'     => esc_html__('Range Style', 'easy-build-cf7-light'),
            'tab'       => Controls_Manager::TAB_STYLE,
            'condition' => [
                'field_type' => 'range',
            ],
        ]
    );

    $this->add_control(
        'track_color',
        [
            'label'     => esc_html__('Track Color', 'easy-build-cf7-light'),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .lcf7-form-range::-webkit-slider-runnable-track' => 'background-color: {{VALUE}};',
                '{{WRAPPER}} .lcf7-form-range::-moz-range-track'              => 'background-color: {{VALUE}};',
            ],
            'default' => '#dee2e6',
        ]
    );

    $this->add_control(
        'thumb_color',
        [
            'label'     => esc_html__('Thumb Color', 'easy-build-cf7-light'),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .lcf7-form-range::-webkit-slider-thumb' => 'background-color: {{VALUE}};',
                '{{WRAPPER}} .lcf7-form-range::-moz-range-thumb'     => 'background-color: {{VALUE}};',
            ],
            'default' => '#0d6efd',
        ]
    );

    $this->add_control(
        'thumb_size',
        [
            'label'      => esc_html__('Thumb Size', 'easy-build-cf7-light'),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range'      => [
                'px' => [
                    'min'  => 10,
                    'max'  => 50,
                    'step' => 1,
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 16,
            ],
            'selectors' => [
                '{{WRAPPER}} .lcf7-form-range::-webkit-slider-thumb' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .lcf7-form-range::-moz-range-thumb'     => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $this->add_control(
        'track_height',
        [
            'label'      => esc_html__('Track Height', 'easy-build-cf7-light'),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range'      => [
                'px' => [
                    'min'  => 1,
                    'max'  => 20,
                    'step' => 1,
                ],
            ],
            'default' => [
                'unit' => 'px',
                'size' => 8,
            ],
            'selectors' => [
                '{{WRAPPER}} .lcf7-form-range::-webkit-slider-runnable-track' => 'height: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .lcf7-form-range::-moz-range-track'              => 'height: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $this->add_control(
        'track_border_radius',
        [
            'label'      => esc_html__('Track Border Radius', 'easy-build-cf7-light'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors'  => [
                '{{WRAPPER}} .lcf7-form-range::-webkit-slider-runnable-track' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                '{{WRAPPER}} .lcf7-form-range::-moz-range-track'              => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'default' => [
                'top'      => 1,
                'right'    => 1,
                'bottom'   => 1,
                'left'     => 1,
                'unit'     => 'rem',
                'isLinked' => true,
            ],
        ]
    );

    $this->add_control(
        'thumb_border_radius',
        [
            'label'      => esc_html__('Thumb Border Radius', 'easy-build-cf7-light'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors'  => [
                '{{WRAPPER}} .lcf7-form-range::-webkit-slider-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                '{{WRAPPER}} .lcf7-form-range::-moz-range-thumb'     => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'default' => [
                'top'      => 1,
                'right'    => 1,
                'bottom'   => 1,
                'left'     => 1,
                'unit'     => 'rem',
                'isLinked' => true,
            ],
        ]
    );

    $this->end_controls_section();
       // Input Style Section
     $this->start_controls_section(
        'section_input_style',
        [
        'label'     => esc_html__('Input Style', 'easy-build-cf7-light'),
        'tab'       => Controls_Manager::TAB_STYLE,
        'condition' => [
            'field_type' => 'number',
        ],
        ]
    );

    $this->add_control(
        'input_text_color',
        [
            'label'     => esc_html__('Text Color', 'easy-build-cf7-light'),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .lcf7-form-control' => 'color: {{VALUE}};',
            ],
        ]
    );
    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name'     => 'input_typography',
            'selector' => '{{WRAPPER}} .lcf7-form-control',
        ]
    );

    $this->add_control(
        'input_background_color',
        [
            'label'     => esc_html__('Background Color', 'easy-build-cf7-light'),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .lcf7-form-control' => 'background-color: {{VALUE}};',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name'     => 'input_border',
            'selector' => '{{WRAPPER}} .lcf7-form-control',
        ]
    );

    $this->add_responsive_control(
        'input_border_radius',
        [
            'label'      => esc_html__('Border Radius', 'easy-build-cf7-light'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors'  => [
                '{{WRAPPER}} .lcf7-form-control' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

        $this->add_responsive_control(
            'input_padding',
            [
                'label'      => esc_html__('Padding', 'easy-build-cf7-light'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .lcf7-form-control' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'input_box_shadow',
                'label'    => esc_html__('Box Shadow', 'easy-build-cf7-light'),
                'selector' => '{{WRAPPER}} .lcf7-form-control',
            ]
        );
        $this->add_responsive_control(
            'input_alignment',
            [
                'label'   => esc_html__('Alignment', 'easy-build-cf7-light'),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'easy-build-cf7-light'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'easy-build-cf7-light'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'easy-build-cf7-light'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default'   => 'left',
                'toggle'    => true,
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
            'label' => esc_html__('Input Focus Style', 'easy-build-cf7-light'),
            'tab'   => Controls_Manager::TAB_STYLE,
            'condition' => [
                'field_type' => 'number',
            ],
        ]
    );

    $this->add_control(
        'input_focus_text_color',
        [
            'label'     => esc_html__('Text Color', 'easy-build-cf7-light'),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .lcf7-form-control:focus' => 'color: {{VALUE}};',
            ],
        ]
    );

    $this->add_control(
        'input_focus_background_color',
        [
            'label'     => esc_html__('Background Color', 'easy-build-cf7-light'),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .lcf7-form-control:focus' => 'background-color: {{VALUE}};',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name'     => 'input_focus_border',
            'selector' => '{{WRAPPER}} .lcf7-form-control:focus',
        ]
    );

    $this->add_responsive_control(
        'input_focus_border_radius',
        [
            'label'      => esc_html__('Border Radius', 'easy-build-cf7-light'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors'  => [
                '{{WRAPPER}} .lcf7-form-control:focus' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name'     => 'input_focus_box_shadow',
            'label'    => esc_html__('Box Shadow', 'easy-build-cf7-light'),
            'selector' => '{{WRAPPER}} .lcf7-form-control:focus',
        ]
    );
    $this->end_controls_section();

  // Label Style Section
    $this->start_controls_section(
        'section_label_style',
        [
            'label'     => esc_html__('Label Style', 'easy-build-cf7-light'),
            'tab'       => Controls_Manager::TAB_STYLE,
            'condition' => [
                'show_label' => 'yes',
                'field_type' => 'number',
            ],
        ]
    );

    $this->add_control(
        'label_color',
        [
            'label'     => esc_html__('Text Color', 'easy-build-cf7-light'),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .l-cf7-field-parent label' => 'color: {{VALUE}};',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name'     => 'label_typography',
            'selector' => '{{WRAPPER}} .l-cf7-field-parent label',
        ]
    );

    $this->add_responsive_control(
        'label_margin',
        [
            'label'      => esc_html__('Margin', 'easy-build-cf7-light'),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors'  => [
                '{{WRAPPER}} .l-cf7-field-parent label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $this->add_responsive_control(
        'label_alignment',
        [
            'label'   => esc_html__('Alignment', 'easy-build-cf7-light'),
            'type'    => Controls_Manager::CHOOSE,
            'options' => [
                'left' => [
                    'title' => esc_html__('Left', 'easy-build-cf7-light'),
                    'icon'  => 'eicon-text-align-left',
                ],
                'center' => [
                    'title' => esc_html__('Center', 'easy-build-cf7-light'),
                    'icon'  => 'eicon-text-align-center',
                ],
                'right' => [
                    'title' => esc_html__('Right', 'easy-build-cf7-light'),
                    'icon'  => 'eicon-text-align-right',
                ],
            ],
            'default'   => 'left',
            'toggle'    => true,
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
            'label' => esc_html__('Layout', 'easy-build-cf7-light'),
            'tab'   => Controls_Manager::TAB_STYLE,
            'condition' => [
                'field_type' => 'number',
            ],
        ]
    );

    $this->add_responsive_control(
        'input_width',
        [
            'label'      => esc_html__('Input Width', 'easy-build-cf7-light'),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => ['px', '%'],
            'range'      => [
                'px' => [
                    'min'  => 0,
                    'max'  => 1000,
                    'step' => 1,
                ],
                '%' => [
                    'min'  => 0,
                    'max'  => 100,
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
            'label'      => esc_html__('Input Height', 'easy-build-cf7-light'),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => ['px', 'em'],
            'range'      => [
                'px' => [
                    'min'  => 0,
                    'max'  => 200,
                    'step' => 1,
                ],
                'em' => [
                    'min'  => 0,
                    'max'  => 12,
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
        $settings                 = $this->get_settings_for_display();
        $attributes               = [];
        $attributes['type']       = $settings['field_type'];
        $attributes['required']   = $settings['is_required'] === 'required' ? '*' : '';
        $attributes['field_name'] = $settings['field_name'];
        $attributes['id']         = $settings['field_id'];
        $attributes['class']      = 'cf7-e-addon ' . ($settings['field_type'] == 'range' ? 'lcf7-form-range' : 'lcf7-form-control');
        if (!empty($settings['classes'])) {
            $attributes['class'] .= ' ' . $settings['classes'];
        }
        $attributes['minlength_number'] = $settings['minlength'];
        $attributes['maxlength_number'] = $settings['maxlength'];
        if (!empty($settings['default_value'])) {
            $attributes['number_default'] = '"'.$settings['default_value'].'"';
        }
        $attributes          = array_filter($attributes);
        $parent_class        = ['l-cf7-field-parent'];
        $parent_class_joined = implode(' ', $parent_class);

        if(easy_build_cf7_light_is_preview()){ ?>
          <div class = "<?php echo esc_attr($parent_class_joined); ?>">
            <?php if($settings['show_label']) { ?>
                <label for = "<?php echo esc_attr($settings['field_id']); ?>"><?php echo esc_html($settings['label']); ?></label>
            <?php } ?>
                <?php echo wp_kses( easy_build_cf7_light_generate_cf7_html($attributes), easy_build_cf7_light_allow_form_attr());?>
           </div>
        <?php
        }else{ ?>
            <div class = "<?php echo esc_attr($parent_class_joined); ?>" data-custom-validation = "<?php echo esc_attr($settings['custom_validation_message']); ?>">
            <?php if($settings['show_label']) { ?>
                <label for = "<?php echo esc_attr($settings['field_id']); ?>"><?php echo esc_html($settings['label']); ?></label>
            <?php } ?>
                <?php echo wp_kses( easy_build_cf7_light_generate_cf7_shortcode($attributes), easy_build_cf7_light_allow_form_attr());?>
           </div>
             
        <?php
        }

    }

    protected function content_template()
    {  

    }
}
