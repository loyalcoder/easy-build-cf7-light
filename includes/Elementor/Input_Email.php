<?php
namespace EasyBuildCF7Light\Elementor;

/**
 * Input Email Widget for Contact Form 7 Elementor Addon
 *
 * This class creates an email input field widget that can be used with Contact Form 7 forms
 * in the Elementor page builder.
 *
 * @package CF7_Elementor_Addon
 * @subpackage Elementor
 * @since 1.0.0
 */


use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Class Input_Email
 * 
 * Creates an email input field widget for Contact Form 7 forms
 *
 * @since 1.0.0
 */
class Input_Email extends Widget_Base
{
    /**
     * Get widget name.
     *
     * @since 1.0.0
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'builder-7-input-email';
    }

    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @return string Widget title.
     */
    public function get_title()
    {
        return esc_html__('Input Email', 'easy-build-cf7-light');
    }

    /**
     * Get widget icon.
     *
     * @since 1.0.0
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-email-field';
    }

    /**
     * Get widget categories.
     *
     * @since 1.0.0
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['builder_7_widgets'];
    }

    /**
     * Register widget controls.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Content', 'easy-build-cf7-light'),
            ]
        );

        // Field Name
        $this->add_control(
            'field_name',
            [
                'label' => esc_html__('Field Name', 'easy-build-cf7-light'),
                'type' => Controls_Manager::TEXT,
                'default' => 'email-'.wp_rand(100, 999),
            ]
        );
        // Required Field
        $this->add_control(
            'is_required',
            [
                'label' => esc_html__('Required', 'easy-build-cf7-light'),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'return_value' => 'required',
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
        // Field ID
        $this->add_control(
            'field_id',
            [
                'label' => esc_html__('Field ID', 'easy-build-cf7-light'),
                'type' => Controls_Manager::TEXT,
                'default' => 'email-field-id',
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
                'default' => esc_html__( 'Your Email', 'easy-build-cf7-light' ),
            ]
        );
        // Minlength
        $this->add_control(
            'minlength',
            [
                'label' => esc_html__('Min Length', 'easy-build-cf7-light'),
                'type' => Controls_Manager::NUMBER,
                'default' => '',
            ]
        );

        // Maxlength
        $this->add_control(
            'maxlength',
            [
                'label' => esc_html__('Max Length', 'easy-build-cf7-light'),
                'type' => Controls_Manager::NUMBER,
                'default' => '',
            ]
        );

        // Placeholder
        $this->add_control(
            'default_value',
            [
                'label' => esc_html__('Default Value', 'easy-build-cf7-light'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
            ]
        );

        // Use Default as Placeholder
        $this->add_control(
            'default_value_as_placeholder',
            [
                'label' => esc_html__('Use Default Value as Placeholder', 'easy-build-cf7-light'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();
        // style section
        // Input Style Section
        $this->start_controls_section(
            'section_input_style',
            [
                'label' => esc_html__('Input Style', 'easy-build-cf7-light'),
                'tab' => Controls_Manager::TAB_STYLE,
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

    $this->add_control(
        'input_background_color',
        [
            'label' => esc_html__('Background Color', 'easy-build-cf7-light'),
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
    $this->add_group_control(
        \Elementor\Group_Control_Box_Shadow::get_type(),
        [
            'name' => 'input_box_shadow',
            'label' => esc_html__('Box Shadow', 'easy-build-cf7-light'),
            'selector' => '{{WRAPPER}} .lcf7-form-control',
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
    $this->end_controls_section();

    // Input Focus Style Section
    $this->start_controls_section(
        'section_input_focus_style',
        [
            'label' => esc_html__('Input Focus Style', 'easy-build-cf7-light'),
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

    $this->add_control(
        'input_focus_background_color',
        [
            'label' => esc_html__('Background Color', 'easy-build-cf7-light'),
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
            'label' => esc_html__('Border Radius', 'easy-build-cf7-light'),
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
            'label' => esc_html__('Box Shadow', 'easy-build-cf7-light'),
            'selector' => '{{WRAPPER}} .lcf7-form-control:focus',
        ]
    );
    $this->end_controls_section();

    // Label Style Section
    $this->start_controls_section(
        'section_label_style',
        [
            'label' => esc_html__('Label Style', 'easy-build-cf7-light'),
            'tab' => Controls_Manager::TAB_STYLE,
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
    $this->end_controls_section();
    $this->start_controls_section(
        'section_layout',
        [
            'label' => esc_html__('Layout', 'easy-build-cf7-light'),
            'tab' => Controls_Manager::TAB_STYLE,
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

    /**
     * Render widget output on the frontend.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();

        // Prepare attributes
        $attributes = [];
        $attributes['type'] = 'email';
        $attributes['required'] = $settings['is_required'] === 'required' ? '*' : '';
        $attributes['field_name'] = $settings['field_name'];
        $attributes['id'] = $settings['field_id'];
        $attributes['class'] = 'builder-7 lcf7-form-control'.$settings['classes'];
        $attributes['minlength'] = $settings['minlength'];
        $attributes['maxlength'] = $settings['maxlength'];
        $attributes['placeholder'] = $settings['default_value_as_placeholder'] ? ' placeholder "'.$settings['default_value'].'"' : ' "'.$settings['default_value'].'"';
        $attributes['placeholder_preview'] = ' value="'.$settings['default_value'].'"';
        if($settings['default_value_as_placeholder']){
            $attributes['placeholder_preview'] = ' placeholder="'.$settings['default_value'].'"';
        }
        $attributes = array_filter($attributes);

        $parent_class = ['l-cf7-field-parent'];
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
             <div class="<?php echo esc_attr($parent_class_joined); ?>" data-custom-validation="<?php echo esc_attr($settings['custom_validation_message']); ?>">
             <?php if($settings['show_label']) { ?>
                <label for="<?php echo esc_attr($settings['field_id']); ?>"><?php echo esc_html($settings['label']); ?></label>
            <?php } ?>
                 <?php echo wp_kses( easy_build_cf7_light_generate_shortcode($attributes), easy_build_cf7_light_allow_form_attr());?>
            </div>
              
         <?php
         }
    }

    /**
     * Render widget content template.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function content_template()
    { 
    }
}
