<?php
/**
 * Input File Widget
 * 
 * Adds a file upload input field widget for Contact Form 7 forms in Elementor.
 * Allows configuring file types, size limits, required status and styling.
 *
 * @package EasyBuildCF7Light
 * @since 1.0.0
 * @requires Elementor
 * @requires Contact Form 7
 */

namespace EasyBuildCF7Light\Elementor;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

class Input_File extends Widget_Base
{
    public function get_name()
    {
        return 'easy-build-cf7-light-input-file';
    }

    public function get_title()
    {
        return esc_html__('Input File', 'easy-build-cf7-light');
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
        return ['easy_build_cf7_light_widgets'];
    }

    /**
     * Get widget keywords.
     *
     * @return array Widget keywords.
     */
    public function get_keywords()
    {
        return ['file', 'upload', 'input', 'form', 'easy-build-cf7-light', 'contact form 7'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('File', 'easy-build-cf7-light'),
            ]
        );
        $this->add_control(
            'field_name',
            [
                'label' => esc_html__( 'Field Name', 'easy-build-cf7-light' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'file-'.wp_rand(100, 999),
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
                'default' => 'First name',
                'condition' => [
                    'show_label' => 'yes',
                ],
            ]
        );
        $this->add_control(
            'field_file_types',
            [
                'label' => esc_html__( 'Acceptable file types', 'easy-build-cf7-light' ),
                'type' => Controls_Manager::TEXT,
                'description' => esc_html__( 'Pipe-separated file types list. You can use file extensions and MIME types.', 'easy-build-cf7-light' ),
                'default' => esc_html__( 'audio/*|video/*|image/*', 'easy-build-cf7-light' ),

            ]
        );
        $this->add_control(
            'field_file_size_limit',
            [
                'label' => esc_html__( 'File size limit', 'easy-build-cf7-light' ),
                'type' => Controls_Manager::TEXT,
                'description' => esc_html__( 'In bytes. You can use kb and mb suffixes.', 'easy-build-cf7-light' ),
                'default' => esc_html__( '1mb', 'easy-build-cf7-light' ),
            ]
        );
        $this->end_controls_section();
        // Label styles
        $this->start_controls_section(
            'label_style_section',
            [
                'label' => esc_html__('Label', 'easy-build-cf7-light'),
                'tab' => Controls_Manager::TAB_STYLE,
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
				'name' => 'file_label_typography',
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
        $this->end_controls_section();

        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__('File Input Style', 'easy-build-cf7-light'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'file_text_color',
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
                'name'     => 'file_typography',
                'selector' => '{{WRAPPER}} .lcf7-form-control',
            ]
        );

    $this->add_control(
        'file_background_color',
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
            'name' => 'file_border',
            'selector' => '{{WRAPPER}} .lcf7-form-control',
        ]
    );

    $this->add_responsive_control(
        'file_border_radius',
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
        'file_padding',
        [
            'label' => esc_html__('Padding', 'easy-build-cf7-light'),
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
            'label' => esc_html__('Margin', 'easy-build-cf7-light'),
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

    protected function content_template()
    {
        
    }
}
