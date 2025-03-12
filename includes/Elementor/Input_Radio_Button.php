<?php

namespace EasyBuildCF7Light\Elementor;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Input_Radio_Button Class
 * 
 * Creates a radio button input field widget for Contact Form 7 in Elementor.
 * This widget allows users to add and customize radio button input fields with various styling options.
 *
 * @since 1.0.0
 * @package EasyBuildCF7Light
 * @subpackage Elementor
 */
class Input_Radio_Button extends Widget_Base
{
    public function get_name()
    {
        return 'easy-build-cf7-light-input-radio-button';
    }

    public function get_title()
    {
        return esc_html__('Input Radio Button', 'easy-build-cf7-light');
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
        return 'eicon-radio';
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
        return ['input', 'radio', 'field', 'easy-build-cf7-light'];
    }

    /**
     * Register widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
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
            'field_name',
            [
                'label' => esc_html__( 'Field Name', 'easy-build-cf7-light' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'radio-'.wp_rand(100, 999),
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
            'selectable_values',
            [
                'label' => esc_html__( 'Selectable values', 'easy-build-cf7-light' ),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__("Option 1\nOption 2\nOption 3", 'easy-build-cf7-light')
            ]
        );

        $this->add_control(
            'first_item',
            [
                'label' => esc_html__( 'Wrap each item with a label element.', 'easy-build-cf7-light' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'easy-build-cf7-light' ),
                'label_off' => esc_html__( 'Hide', 'easy-build-cf7-light' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'radio_style',
            [
                'label' => esc_html__('Radio Style', 'easy-build-cf7-light'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

           // Layout Control
           $this->add_responsive_control(
            'layout',
            [
                'label'   => esc_html__( 'Layout', 'easy-build-cf7-light' ),
                'type'    => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex' => [
                        'title' => esc_html__( 'Flex', 'easy-build-cf7-light' ),
                        'icon'  => 'eicon-gallery-grid',
                    ],
                    'column' => [
                        'title' => esc_html__( 'Column', 'easy-build-cf7-light' ),
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
				'label' => esc_html__( 'Item Gap', 'easy-build-cf7-light' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
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

        $this->add_responsive_control(
            'radio_size',
            [
                'label' => esc_html__('Radio Size', 'easy-build-cf7-light'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-radio input[type="radio"]' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'radio_checked_color',
            [
                'label' => esc_html__('Checked Color', 'easy-build-cf7-light'),
                'type' => Controls_Manager::COLOR,
                'default' => '#4054B2',
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-radio input[type="radio"]:checked' => 'accent-color: {{VALUE}};',
                ],
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'radio_typography',
                'label' => esc_html__('Typography', 'easy-build-cf7-light'),
                'selector' => '{{WRAPPER}} .wpcf7-radio .wpcf7-list-item-label',
            ]
        );

        $this->add_control(
            'radio_text_color',
            [
                'label' => esc_html__('Text Color', 'easy-build-cf7-light'),
                'type' => Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-radio .wpcf7-list-item-label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
			'option_checkbox_item_gap',
			[
				'label' => esc_html__( 'Option Gap', 'easy-build-cf7-light' ),
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
                'label' => esc_html__('Label', 'easy-build-cf7-light'),
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
                'label' => esc_html__('Label Color', 'easy-build-cf7-light'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  label' => 'color: {{VALUE}};',
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
                'selector' => '{{WRAPPER}}  label',
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
                    '{{WRAPPER}}  label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

        $layout_class = $settings['layout'] === 'flex' ? 'lcf7-d-flex' : 'lcf7-flex-direction-column';

        $attributes = [];
        $attributes['type'] = 'radio';
        $attributes['field_name'] = $settings['field_name'];
        $attributes['id'] = $settings['field_id'];
        $layout_class = $settings['layout'] === 'flex' ? 'lcf7-d-flex' : 'lcf7-d-flex lcf7-flex-direction-column';
        $attributes['class'] = 'easy-build-cf7-light-form-check '.$layout_class;
        if (!empty($settings['classes'])) {
            $attributes['class'] .= ' ' . $settings['classes'];
        }
        $attributes['select_label'] = $settings['first_item'] ? ' use_label_element ' : '';
        $values_explode = explode("\n", $settings['selectable_values']);
        $select_values = array_map('trim', $values_explode);
        $attributes['values_select'] = '"' . implode('" "', $select_values) . '"';
        $attributes = array_filter($attributes);
        $parent_class = ['easy-build-cf7-light-field-parent'];
        $parent_class_joined = implode(' ', $parent_class);
                
        if(easy_build_cf7_light_is_preview()){ ?>
          <?php include_once __DIR__.'/layouts/radio_preview.php'; ?>
        <?php
        }else{ ?>
            <div class="<?php echo esc_attr($parent_class_joined); ?>">
            <?php if($settings['show_label']) { ?>
                <label for="<?php echo esc_attr($settings['field_id']); ?>"><?php echo esc_html($settings['label']); ?></label>
            <?php } ?>
                <?php echo wp_kses(easy_build_cf7_light_generate_shortcode($attributes), easy_build_cf7_light_allow_form_attr()); ?>
           </div>
        <?php
        }
    }

    protected function content_template()
    {
        
    }
}
