<?php
/**
 * Input File Widget
 * 
 * Adds a file upload input field widget for Contact Form 7 forms in Elementor.
 * Allows configuring file types, size limits, required status and styling.
 *
 * @package Builder7
 * @since 1.0.0
 * @requires Elementor
 * @requires Contact Form 7
 */

namespace Builder7\Elementor;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

class Input_File extends Widget_Base
{
    public function get_name()
    {
        return 'builder-7-input-file';
    }

    public function get_title()
    {
        return esc_html__('Input File', 'builder7');
    }
    /**
     * Get widget icon.
     *
     * @return string Widget icon.
     */
    public function get_icon() 
    {
        return 'eicon-document-file';
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
        return ['file', 'upload', 'input', 'form', 'builder-7', 'contact form 7'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('File', 'builder7'),
            ]
        );
        $this->add_control(
            'field_name',
            [
                'label' => esc_html__( 'Field Name', 'builder7' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'file-'.wp_rand(100, 999),
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
            'field_file_types',
            [
                'label' => esc_html__( 'Acceptable file types', 'builder7' ),
                'type' => Controls_Manager::TEXT,
                'description' => esc_html__( 'Pipe-separated file types list. You can use file extensions and MIME types.', 'builder7' ),
                'default' => esc_html__( 'audio/*|video/*|image/*', 'builder7' ),

            ]
        );
        $this->add_control(
            'field_file_size_limit',
            [
                'label' => esc_html__( 'File size limit', 'builder7' ),
                'type' => Controls_Manager::TEXT,
                'description' => esc_html__( 'In bytes. You can use kb and mb suffixes.', 'builder7' ),
                'default' => esc_html__( '1mb', 'builder7' ),
            ]
        );
        $this->end_controls_section();
        // Label styles
        $this->start_controls_section(
            'label_style_section',
            [
                'label' => esc_html__('Label', 'builder7'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'label_color',
            [
                'label' => esc_html__('Label Color', 'builder7'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} label' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'file_label_typography',
				'selector' => '{{WRAPPER}} label',
			]
		);

        $this->add_responsive_control(
            'label_margin',
            [
                'label' => esc_html__('Label Margin', 'builder7'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__('File Input Style', 'builder7'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'file_text_color',
            [
                'label'     => esc_html__('Text Color', 'builder7'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .lcf7-form-control' => 'color: {{VALUE}};',
                ],
            ]
        );    

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name'     => 'file_typography',
                'selector' => '{{WRAPPER}} .lcf7-form-control',
            ]
        );

    $this->add_control(
        'file_background_color',
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
            'name' => 'file_border',
            'selector' => '{{WRAPPER}} .lcf7-form-control',
        ]
    );

    $this->add_responsive_control(
        'file_border_radius',
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
        'file_padding',
        [
            'label' => esc_html__('Padding', 'builder7'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .lcf7-form-control' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->add_responsive_control(
        'file_margin',
        [
            'label' => esc_html__('Margin', 'builder7'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .lcf7-form-control' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $attributes = [];
        $attributes['type'] = 'file';
        $attributes['required'] = $settings['is_required'] === 'required' ? '*' : '';
        $attributes['field_name'] = $settings['field_name'];
        $attributes['id'] = $settings['field_id'];
        $attributes['class']      = 'cf7-e-addon lcf7-form-control';
        if (!empty($settings['classes'])) {
            $attributes['class'] .= ' ' . $settings['classes'];
        }
        $attributes['field_file_types'] = 'filetypes:'.$settings['field_file_types'];
        $attributes['field_file_size_limit'] = 'limit:'.$settings['field_file_size_limit'];

        $attributes = array_filter($attributes);
        $parent_class = ['b7-field-parent'];
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
