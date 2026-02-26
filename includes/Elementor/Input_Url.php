<?php
/**
 * Input URL Widget for Easy Build CF7 Light
 *
 * This class creates a URL input field widget that can be used with Contact Form 7 forms
 * in the Elementor page builder. It provides extensive customization options for styling 
 * and functionality of the URL input field.
 *
 * @package EasyBuildCF7Light
 * @subpackage Elementor
 * @since 1.0.0
 */

namespace EasyBuildCF7Light\Elementor;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class Input_Url
 * 
 * Creates a URL input field widget with extensive customization options including:
 * - Field attributes (name, required, validation, etc)
 * - Styling (colors, typography, borders, etc)
 * - Layout options
 * - Label customization
 * - URL-specific validation
 *
 * @since 1.0.0
 */
class Input_Url extends Widget_Base
{
    public function get_name()
    {
        return 'easy-build-cf7-light-input-url';
    }

    public function get_title()
    {
        return esc_html__('Input Url', 'easy-build-cf7-light');
    }

    /**
     * Get widget icon.
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-url';
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

    public function get_keywords()
    {
        return ['url', 'input', 'link'];
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
                'label' => esc_html__( 'Field Name', 'easy-build-cf7-light' ),
                'type' => Controls_Manager::TEXT,
                'default' =>  'url-'.wp_rand(100, 999),
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
                'default' => 'Url',
                'condition' => [
                    'show_label' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'minlength',
            [
                'label' => esc_html__( 'Min Length', 'easy-build-cf7-light' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 2,
                'min' => 1,
                'max' => 1000,
            ]
        );

        $this->add_control(
            'maxlength',
            [
                'label' => esc_html__( 'Max Length', 'easy-build-cf7-light' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 500,
                'min' => 1,
                'max' => 1000,
            ]
        );

        $this->add_control(
            'default_value',
            [
                'label' => esc_html__( 'Default Value', 'easy-build-cf7-light' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'This is a placeholder',
            ]
        );
        $this->add_control(
            'default_value_as_placeholder',
            [
                'label' => esc_html__( 'Use Default Value as Placeholder', 'easy-build-cf7-light' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'easy-build-cf7-light' ),
                'label_off' => esc_html__( 'No', 'easy-build-cf7-light' ),
                'return_value' => 'placeholder',
                'default' => '',
            ]
        );
        $this->add_control(
            'expects_submitter',
            [
                'label' => esc_html__( 'Expects Submitter URL', 'easy-build-cf7-light' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'easy-build-cf7-light' ),
                'label_off' => esc_html__( 'No', 'easy-build-cf7-light' ),
                'return_value' => 'yes',
                'default' => '',
            ]
        );
        $this->end_controls_section();
         // Input Style Section
         $this->start_controls_section(
            'section_input_style',
            [
                'label' => esc_html__('Input', 'easy-build-cf7-light'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'input_alignment',
            [
                'label' => esc_html__('Alignment', 'easy-build-cf7-light'),
                'type' => Controls_Manager::CHOOSE,
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
                'default' => 'left',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .l-cf7-field-parent > input' => 'text-align: {{VALUE}};',
                ],
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
        $this->add_control(
            'input_placeholder_color',
            [
                'label' => esc_html__('Placeholder Color', 'easy-build-cf7-light'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lcf7-form-control::placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .lcf7-form-control::-webkit-input-placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .lcf7-form-control::-moz-placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .lcf7-form-control:-ms-input-placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .lcf7-form-control:-moz-placeholder' => 'color: {{VALUE}};',
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
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'input_background_color',
				'types' => [ 'classic', 'gradient', 'video' ],
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
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'input_box_shadow',
                'label' => esc_html__('Box Shadow', 'easy-build-cf7-light'),
                'selector' => '{{WRAPPER}} .lcf7-form-control',
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
        $this->add_responsive_control(
            'input_padding',
            [
                'label' => esc_html__('Padding', 'easy-build-cf7-light'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .lcf7-form-control' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
    $this->end_controls_section();

    // Input Focus Style Section
    $this->start_controls_section(
        'section_input_focus_style',
        [
            'label' => esc_html__('Input Focus', 'easy-build-cf7-light'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]
    );

    $this->add_control(
        'input_focus_text_color',
        [
            'label' => esc_html__('Text Color', 'easy-build-cf7-light'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .lcf7-form-control:focus' => 'color: {{VALUE}};',
            ],
        ]
    );
    $this->add_group_control(
        \Elementor\Group_Control_Background::get_type(),
        [
            'name' => 'input_focus_background_color',
            'types' => [ 'classic', 'gradient', 'video' ],
            'selector' => '{{WRAPPER}} .lcf7-form-control:focus',
        ]
    );
    $this->add_group_control(
        \Elementor\Group_Control_Border::get_type(),
        [
            'name' => 'input_focus_border',
            'selector' => '{{WRAPPER}} .lcf7-form-control:focus',
        ]
    );
    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'input_focus_box_shadow',
            'label' => esc_html__('Box Shadow', 'easy-build-cf7-light'),
            'selector' => '{{WRAPPER}} .lcf7-form-control:focus',
        ]
    );
    $this->add_responsive_control(
        'input_focus_border_radius',
        [
            'label' => esc_html__('Border Radius', 'easy-build-cf7-light'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%'],
            'selectors' => [
                '{{WRAPPER}} .lcf7-form-control:focus' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $this->end_controls_section();

    // Label Style Section
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
    $this->add_responsive_control(
        'label_alignment',
        [
            'label' => esc_html__('Alignment', 'easy-build-cf7-light'),
            'type' => Controls_Manager::CHOOSE,
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
    $this->add_control(
        'label_color',
        [
            'label' => esc_html__('Text Color', 'easy-build-cf7-light'),
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
            'label' => esc_html__('Margin', 'easy-build-cf7-light'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .l-cf7-field-parent label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    $this->end_controls_section();
    // Layout Section
    $this->start_controls_section(
        'section_layout',
        [
            'label' => esc_html__('Layout', 'easy-build-cf7-light'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]
    );
     $this->add_responsive_control(
            'container_direction',
            [
                'label' => esc_html__('Direction', 'easy-build-cf7-light'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'column' => [
                        'title' => esc_html__('Column', 'easy-build-cf7-light'),
                        'icon' => 'eicon-editor-list-ul',
                    ],
                    'row' => [
                        'title' => esc_html__('Row', 'easy-build-cf7-light'),
                        'icon' => 'eicon-ellipsis-h',
                    ],
                ],
                'default' => 'column',
                'toggle' => false,
                'selectors' => [
                    '{{WRAPPER}} .b7-field-parent' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'container_align_items',
            [
                'label' => esc_html__('Vertical Alignment', 'easy-build-cf7-light'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'flex-start' => esc_html__('Start', 'easy-build-cf7-light'),
                    'center' => esc_html__('Center', 'easy-build-cf7-light'),
                    'flex-end' => esc_html__('End', 'easy-build-cf7-light'),
                    'stretch' => esc_html__('Stretch', 'easy-build-cf7-light'),
                ],
                'default' => 'flex-start',
                'selectors' => [
                    '{{WRAPPER}} .b7-field-parent' => 'align-items: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'container_justify_content',
            [
                'label' => esc_html__('Justify Content', 'easy-build-cf7-light'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'flex-start' => esc_html__('Start', 'easy-build-cf7-light'),
                    'center' => esc_html__('Center', 'easy-build-cf7-light'),
                    'flex-end' => esc_html__('End', 'easy-build-cf7-light'),
                    'space-between' => esc_html__('Space Between', 'easy-build-cf7-light'),
                    'space-around' => esc_html__('Space Around', 'easy-build-cf7-light'),
                    'space-evenly' => esc_html__('Space Evenly', 'easy-build-cf7-light'),
                ],
                'default' => 'flex-start',
                'selectors' => [
                    '{{WRAPPER}} .b7-field-parent' => 'justify-content: {{VALUE}};',
                ],
            ]
        );
    $this->add_responsive_control(
        'input_width',
        [
            'label' => esc_html__('Input Width', 'easy-build-cf7-light'),
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
            'label' => esc_html__('Input Height', 'easy-build-cf7-light'),
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
        $attributes['type'] = 'url';
        $attributes['required'] = $settings['is_required'] === 'required' ? '*' : '';
        $attributes['field_name'] = $settings['field_name'];
        $attributes['expects_submitter'] = $settings['expects_submitter'] === 'yes' ? 'autocomplete:url' : '';
        $attributes['id'] = $settings['field_id'];
        $attributes['class'] = 'lcf7-e-addon b7-form-control lcf7-form-control '.$settings['classes'];
        $attributes['minlength'] = $settings['minlength'];
        $attributes['maxlength'] = $settings['maxlength'];
        $attributes['placeholder'] = $settings['default_value_as_placeholder'] ? ' placeholder "'.$settings['default_value'].'"' : ' "'.$settings['default_value'].'"';
        $attributes['placeholder_preview'] = ' value="'.$settings['default_value'].'"';
        if($settings['default_value_as_placeholder']){
            $attributes['placeholder_preview'] = ' placeholder="'.$settings['default_value'].'"';
        }
        $attributes = array_filter($attributes);
        $parent_class = ['b7-field-parent','l-cf7-field-parent','b7-flex'];
        $direction = isset($settings['container_direction']) ? $settings['container_direction'] : 'column';
        $parent_class[] = $direction === 'row' ? 'b7-flex-row' : 'b7-flex-column';
        $parent_styles = [];
        if (!empty($settings['container_align_items'])) {
            $parent_styles[] = 'align-items: ' . $settings['container_align_items'];
        }
        if (!empty($settings['container_justify_content'])) {
            $parent_styles[] = 'justify-content: ' . $settings['container_justify_content'];
        }
        $parent_style_attr = '';
        if (!empty($parent_styles)) {
            $parent_style_attr = ' style="' . esc_attr(implode('; ', $parent_styles) . ';') . '"';
        }
        $parent_class_joined = implode(' ', $parent_class);

        
        if(easy_build_cf7_light_is_preview()){ ?>
           <div class="<?php echo esc_attr($parent_class_joined); ?>"<?php echo ! empty( $parent_styles ) ? ' style="' . esc_attr( implode( '; ', $parent_styles ) . ';' ) . '"' : ''; ?>>
           <?php if($settings['show_label']) { ?>
                <label for="<?php echo esc_attr($settings['field_id']); ?>"><?php echo esc_html($settings['label']); ?></label>
            <?php } ?>
                <?php echo wp_kses( easy_build_cf7_light_generate_html($attributes), easy_build_cf7_light_allow_form_attr());?>
           </div>
        <?php
        }else{ ?>
            <div class="<?php echo esc_attr($parent_class_joined); ?>"<?php echo ! empty( $parent_styles ) ? ' style="' . esc_attr( implode( '; ', $parent_styles ) . ';' ) . '"' : ''; ?>>
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
