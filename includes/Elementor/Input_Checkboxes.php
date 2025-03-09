<?php

namespace Builder7\Elementor;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

class Input_Checkboxes extends Widget_Base
{
    public function get_name()
    {
        return 'builder7-input-checkboxes';
    }

    public function get_title()
    {
        return esc_html__('Input Checkboxes', 'builder7');
    }
/**
     * Get widget style dependencies.
     *
     * @return array Array of style dependencies.
     */
    public function get_style_depends()
    {
        return ['builder7-style'];
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
        return ['builder_7_widgets'];
    }

    /**
     * Get widget keywords.
     *
     * @return array Widget keywords.
     */
    public function get_keywords()
    {
        return ['input', 'checkboxes', 'field', 'builder-7'];
    }

    /**
     * Register widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     */

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
                'default' =>  'checkbox-' . wp_rand(100, 999),
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
                'default' => 'First name',
                'condition' => [
                    'show_label' => 'yes',
                ],
            ]
        );

        $this->add_control(
			'selectable_values',
			[
				'label' => esc_html__( 'Selectable values', 'builder7' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__("Option 1\nOption 2\nOption 3", 'builder7')
			]
		);

        $this->add_control(
			'first_item',
			[
				'label' => esc_html__( 'Wrap each item with a label element.', 'builder7' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'builder7' ),
				'label_off' => esc_html__( 'Hide', 'builder7' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        $this->end_controls_section();
    $this->start_controls_section(
        'style_section',
        [
            'label' => esc_html__('Style', 'builder7'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_control(
        'checkbox_size',
        [
            'label' => esc_html__('Checkbox Size', 'builder7'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px', 'em'],
            'range' => [
                'px' => [
                    'min' => 10,
                    'max' => 50,
                ],
                'em' => [
                    'min' => 1,
                    'max' => 4,
                ]
            ],
            'default' => [
                'unit' => 'px',
                'size' => 16,
            ],
            'selectors' => [
                '{{WRAPPER}} .wpcf7-checkbox input[type="checkbox"]' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $this->add_control(
        'checkbox_color',
        [
            'label' => esc_html__('Checkbox Color', 'builder7'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .wpcf7-checkbox input[type="checkbox"]:checked' => 'accent-color: {{VALUE}};',
            ],
        ]
    );

    $this->add_control(
        'checkbox_text_color',
        [
            'label' => esc_html__('Text Color', 'builder7'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .wpcf7-list-item-label' => 'color: {{VALUE}};',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'checkbox_typography',
            'selector' => '{{WRAPPER}} .wpcf7-list-item-label',
        ]
    );
    $this->add_control(
        'layout',
        [
            'label'   => esc_html__( 'Layout', 'builder7' ),
            'type'    => \Elementor\Controls_Manager::CHOOSE,
            'options' => [
                'flex' => [
                    'title' => esc_html__( 'Flex', 'builder7' ),
                    'icon'  => 'eicon-gallery-grid',
                ],
                'column' => [
                    'title' => esc_html__( 'Column', 'builder7' ),
                    'icon'  => 'eicon-editor-list-ul',
                ],
            ],
            'default' => 'column',
            'toggle'  => true,
        ]
    );
    $this->add_responsive_control(
        'item_gap',
			[
				'label' => esc_html__( 'Item Gap', 'builder7' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 400,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				// 'default' => [
				// 	'unit' => 'px',
				// 	'size' => 20,
				// ],
				'selectors' => [
					'{{WRAPPER}}  .lcf7-flex-direction-column' => 'row-gap: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .lcf7-d-flex' => 'column-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
			'option_checkbox_item_gaps',
			[
				'label' => esc_html__( 'Option Gap', 'builder7' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 6,
				],
				'selectors' => [
					'{{WRAPPER}} .wpcf7-list-item' => 'gap: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .wpcf7-list-item label' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

    $this->add_control(
        'label_heading',
        [
            'label' => esc_html__('Label', 'builder7'),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
            'condition' => [
                'show_label' => 'yes',
            ],
        ]
    );

    $this->add_control(
        'label_color',
        [
            'label' => esc_html__('Label Color', 'builder7'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .l-cf7-field-parent label' => 'color: {{VALUE}};',
            ],
            'condition' => [
                'show_label' => 'yes',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Typography::get_type(),
        [
            'name' => 'label_typography',
            'selector' => '{{WRAPPER}} .l-cf7-field-parent label',
            'condition' => [
                'show_label' => 'yes',
            ],
        ]
    );

    $this->add_responsive_control(
        'label_margin',
        [
            'label' => esc_html__('Label Margin', 'builder7'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .l-cf7-field-parent .check-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'condition' => [
                'show_label' => 'yes',
            ],
        ]
    );

    $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $attributes = [];
        $attributes['type'] = 'checkbox';
        $attributes['required'] = $settings['is_required'] === 'required' ? '*' : '';
        $attributes['field_name'] = $settings['field_name'];
        $attributes['id'] = $settings['field_id'];
        $layout_class = $settings['layout'] === 'flex' ? 'lcf7-d-flex' : 'lcf7-d-flex lcf7-flex-direction-column';
        $attributes['class']      = 'cf7-e-addon lcf7-form-check '. $layout_class;
        if (!empty($settings['classes'])) {
            $attributes['class'] .= ' ' . $settings['classes'];
        }
        $attributes['select_label'] = $settings['first_item'] ? ' use_label_element ' : '';
        $values_explode = explode("\n", $settings['selectable_values']);
        $select_values = array_map('trim', $values_explode);
        $attributes['values_select'] = '"' . implode('" "', $select_values) . '"';
        $attributes = array_filter($attributes);
        $parent_class = ['l-cf7-field-parent'];
        $parent_class_joined = implode(' ', $parent_class);
        
        if(builder7_is_preview()){ ?>
           <div class="<?php echo esc_attr($parent_class_joined); ?>">
           <?php if($settings['show_label']) { ?>
                <p><label class="check-label" for="<?php echo esc_attr($settings['field_id']); ?>"><?php echo esc_html($settings['label']); ?></label><br>
            <?php } ?>
            <span class="wpcf7-form-control-wrap" data-name="<?php echo esc_attr($settings['field_name']); ?>">
                <span class="wpcf7-form-control wpcf7-checkbox <?php echo esc_attr($attributes['class']); ?>">
                    <?php foreach($select_values as $key => $value): 
                        $item_class = [];
                        if($key === 0) $item_class[] = 'first';
                        if($key === count($select_values)-1) $item_class[] = 'last';
                    ?>
                        <span class="wpcf7-list-item <?php echo esc_attr(implode(' ', $item_class)); ?>">
                            <?php if($settings['first_item'] === 'yes'){ ?>
                                 <label>
                                    <input type="checkbox" name="<?php echo esc_attr($settings['field_name']); ?>[]" value="<?php echo esc_attr($value); ?>">
                                    <span class="wpcf7-list-item-label"><?php echo esc_html($value); ?></span>
                                </label>
                            <?php }else{ ?>
                                <input type="checkbox" name="<?php echo esc_attr($settings['field_name']); ?>[]" value="<?php echo esc_attr($value); ?>">
                           <?php }?>
                        </span>
                    <?php endforeach; ?>
                </span>
            </span>
            </p>
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
