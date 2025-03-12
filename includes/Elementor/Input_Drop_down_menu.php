<?php

namespace EasyBuildCF7Light\Elementor;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

class Input_Drop_Down_Menu extends Widget_Base
{
    public function get_name()
    {
        return 'easy-build-cf7-light-input-drop-down-menu';
    }

    public function get_title()
    {
        return esc_html__('Input Drop-down menu', 'easy-build-cf7-light');
    }
    /**
     * Get widget style dependencies.
     *
     * @return array Array of style dependencies.
     */
    public function get_style_depends()
    {
        return ['cf7-elementor-addon-style'];
    }
     /**
     * Get widget icon.
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-select';
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
        return ['input', 'select', 'field', 'easy-build-cf7-light'];
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
                'label' => esc_html__('Content', 'easy-build-cf7-light'),
            ]
        );
        $this->add_control(
            'field_name',
            [
                'label' => esc_html__( 'Field Name', 'easy-build-cf7-light' ),
                'type' => Controls_Manager::TEXT,
                'default' =>  'select-' . wp_rand(100, 999),
            ]
        );
        $this->add_control(
            'is_required',
            [
                'label' => esc_html__( 'Required Field', 'easy-build-cf7-light' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'easy-build-cf7-light' ),
                'label_off' => esc_html__( 'No', 'easy-build-cf7-light' ),
                'return_value' => 'required',
                'default' => '',
            ]
        );
        $this->add_control(
            'custom_validation_message',
            [
                'label' => esc_html__( 'Custom Validation Message', 'easy-build-cf7-light' ),
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
                'default' => 'Choose Your Option',
                'condition' => [
                    'show_label' => 'yes',
                ],
            ]
        );

        $this->add_control(
			'selectable_values',
			[
				'label' => esc_html__( 'Selectable values', 'easy-build-cf7-light' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__("Option 1\nOption 2\nOption 3", 'easy-build-cf7-light')
			]
		);

        $this->add_control(
			'first_item',
			[
				'label' => esc_html__( ' Use the first item as a label.', 'easy-build-cf7-light' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'easy-build-cf7-light' ),
				'label_off' => esc_html__( 'Hide', 'easy-build-cf7-light' ),
				'return_value' => 'yes',
				'default' => '',
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

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'select_typography',
                'selector' => '{{WRAPPER}} .lcf7-form-select',
            ]
        );

        $this->add_control(
            'select_text_color',
            [
                'label' => esc_html__('Text Color', 'easy-build-cf7-light'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lcf7-form-select' => 'color: {{VALUE}};',
                ],
            ]
        );

    $this->add_control(
        'select_bg_color',
        [
            'label' => esc_html__('Background Color', 'easy-build-cf7-light'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .lcf7-form-select' => 'background-color: {{VALUE}};',
            ],
        ]
    );

    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'select_border',
            'selector' => '{{WRAPPER}} .lcf7-form-select',
        ]
    );

    $this->add_responsive_control(
        'select_border_radius',
        [
            'label' => esc_html__('Border Radius', 'easy-build-cf7-light'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors' => [
                '{{WRAPPER}} .lcf7-form-select' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'select_padding',
        [
            'label' => esc_html__('Padding', 'easy-build-cf7-light'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .lcf7-form-select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'select_margin',
        [
            'label' => esc_html__('Margin', 'easy-build-cf7-light'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .lcf7-form-select' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_control(
        'select_height',
        [
            'label' => esc_html__('Height', 'easy-build-cf7-light'),
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
                '{{WRAPPER}} .lcf7-form-select' => 'height: {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $this->add_control(
        'label_heading',
        [
            'label' => esc_html__('Label', 'easy-build-cf7-light'),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
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

    $this->add_control(
        'label_color',
        [
            'label' => esc_html__('Label Color', 'easy-build-cf7-light'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .l-cf7-field-parent label' => 'color: {{VALUE}};',
            ],
            'condition' => [
                'show_label' => 'yes',
            ],
        ]
    );

    $this->add_responsive_control(
        'label_margin',
        [
            'label' => esc_html__('Label Margin', 'easy-build-cf7-light'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .l-cf7-field-parent label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        $attributes['type'] = 'select';
        $attributes['required'] = $settings['is_required'] === 'required' ? '*' : '';
        $attributes['field_name'] = $settings['field_name'];
        $attributes['id'] = $settings['field_id'];
        $attributes['class']      = 'cf7-e-addon lcf7-form-select';
        if (!empty($settings['classes'])) {
            $attributes['class'] .= ' ' . $settings['classes'];
        }
        $attributes['select_label'] = $settings['first_item'] ? ' first_as_label ' : '';
        $values_explode = explode("\n", $settings['selectable_values']);
        $select_values = array_map('trim', $values_explode);
        $attributes['values_select'] = '"' . implode('" "', $select_values) . '"';
        $attributes = array_filter($attributes);
        $parent_class = ['l-cf7-field-parent'];
        $parent_class_joined = implode(' ', $parent_class);
             
        if(easy_build_cf7_light_is_preview()){ ?>
           <div class="<?php echo esc_attr($parent_class_joined); ?>">
           <?php if($settings['show_label']) { ?>
                <label for="<?php echo esc_attr($settings['field_id']); ?>"><?php echo esc_html($settings['label']); ?></label>
            <?php } ?>
                <select class="<?php echo esc_attr($attributes['class']); ?>" >
                <?php if(empty($select_values)) { ?>
                    <option value=""><?php echo esc_html__('Select an option', 'easy-build-cf7-light'); ?></option>
                <?php } else {
                    foreach($select_values as $value) { ?>
                        <option value="<?php echo esc_attr($value); ?>"><?php echo esc_html($value); ?></option>
                    <?php }
                } ?>
                </select>
           </div>
        <?php
        }else{ ?>
             <div class="<?php echo esc_attr($parent_class_joined); ?>" data-custom-validation="<?php echo esc_attr($settings['custom_validation_message']); ?>">
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
