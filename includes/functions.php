<?php
// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    die;
}

/**
 * Functions for Easy Build CF7 Light
 *
 * This file contains helper functions for the Easy Build CF7 Light plugin.
 * It includes functions for generating CF7 shortcodes and HTML, checking preview mode,
 * syncing forms between Elementor and CF7, and other utility functions.
 *
 * @package EasyBuildCF7Light
 * @since 1.0.0
 */

if(!function_exists('easy_build_cf7_light_is_preview')){
    /**
     * Check if current page is being viewed in Elementor editor or preview mode
     * 
     * This function checks whether the current page is being edited in Elementor's editor
     * or being viewed in preview mode. This is useful for conditionally rendering different
     * content in the editor vs the frontend.
     *
     * @since 1.0.0
     * @return boolean True if in Elementor editor/preview mode, false otherwise
     */
    function easy_build_cf7_light_is_preview() {
        return \Elementor\Plugin::$instance->editor->is_edit_mode() || is_preview();
    }
}

if (!function_exists('easy_build_cf7_light_generate_shortcode')) {
    /**
     * Generates Contact Form 7 shortcode from attributes array
     * 
     * Takes an array of field attributes and generates the corresponding CF7 shortcode syntax.
     * Handles various field types like text, textarea, select etc and their attributes like
     * required, class, id, min/max length etc.
     *
     * @since 1.0.0
     * @param array $attributes Array of field attributes
     * @return string Generated CF7 shortcode
     */
    function easy_build_cf7_light_generate_shortcode( $attributes ) {
        // Rest of function body remains the same, just renamed
        $field_start = '['; 
        $field_end = ']'; 
        $field_attr = '';
        if(!empty($attributes)){
            foreach($attributes as $key => $value){
                switch($key){
                    case 'type':
                        $field_attr .= $value;
                        break;
                    case 'required':
                        $field_attr .= $value;
                        break;    
                    case 'field_name':
                        $field_attr .= ' ' . $value;
                        break;
                    case 'expects_submitter':
                        $field_attr .= ' ' . $value;
                        break;    
                    case 'id':
                        $field_attr .= ' id:' . $value;
                        break; 
                    case 'class':
                        $class_values = explode(' ', $value);
                        foreach ($class_values as $class) {
                            $field_attr .= ' class:' . $class;
                        }
                        break;
                    case 'minlength':
                        $field_attr .= ' minlength:' . $value;
                        break;
                    case 'maxlength':
                        $field_attr .= ' maxlength:' . $value;
                        break;
                    case 'minlength_number' :
                        $field_attr .= ' min:' . $value;
                        break;
                    case 'maxlength_number' :
                        $field_attr .= ' max:' . $value;
                        break;
                    case 'number_default':
                        $field_attr .= ' '.$value;
                        break; 
                    case 'placeholder':
                        $field_attr .= $value;
                        break;   
                    case 'placeholder_textarea':
                        $field_attr .= $value;
                        break;
                    case 'select_label'   :
                        $field_attr .= $value;
                        break;
                    case 'values_select'  :
                        $field_attr .= ' '.$value;
                        break;
                    case 'field_file_types'  :
                        $field_attr .= ' '.$value;
                        break;
                    case 'field_file_size_limit'  :
                        $field_attr .= ' '.$value;
                        break;
                    case 'checkbox_is_optional'  :
                        $field_attr .= ' '.$value;
                        break;
                    default:
                        break;
                }
            }
        }
        $filed_type = (isset($attributes['type']) && $attributes['type'] == 'textarea') ? $attributes['type']: '';
        $default_value = (isset($attributes['textarea_value']) && $attributes['textarea_value'] != '') ? $attributes['textarea_value']: '';
        if($filed_type == 'textarea') {
            if($default_value != '') {
                $field_end = ']' . $default_value . '[/textarea]';
            } 
        }
        $type_acceptance = (isset($attributes['type']) && $attributes['type'] == 'acceptance') ? $attributes['type']: '';
        
        if($type_acceptance == 'acceptance') {
            return '['.$field_attr.'] '.$attributes['field_condition'].' [/acceptance]';
        }
        return $field_start.$field_attr.$field_end;
    }
}

if (!function_exists('easy_build_cf7_light_allow_form_attr')) {
    /**
     * Defines allowed HTML attributes for form elements
     * 
     * @return array Array of allowed HTML attributes for form inputs
     */
    function easy_build_cf7_light_allow_form_attr() {
        $allowedposttags['input'] = [
            'type' => true,
            'required' => true,
            'field_name' => true,
            'class' => true,
            'minlength' => true,
            'maxlength' => true,
            'placeholder' => true,
            'name' => true,
            'id' => true,
            'value' => true,
            'size' => true,
            'pattern' => true,
            'readonly' => true,
            'disabled' => true,
            'autocomplete' => true,
            'autofocus' => true,
            'form' => true,
            'list' => true,
            'maxlength' => true,
            'min' => true,
            'max' => true,
            'multiple' => true,
            'step' => true,
            'title' => true,
            'aria-*' => true,
            'data-*' => true,
        ];
        return $allowedposttags;
    }
}

if (!function_exists('easy_build_cf7_light_generate_html')) {
    /**
     * Generates HTML for Contact Form 7 input fields
     * 
     * @param array $attributes Array of field attributes
     * @return string Generated HTML input element
     */
    function easy_build_cf7_light_generate_html( $attributes ) {
        $field_attr = '';
        if(!empty($attributes)){
            foreach($attributes as $key => $value){
                switch($key){
                    case 'type':
                        $field_attr .= ' type="' . $value . '"';
                        break;
                    case 'class':
                        $class_values = explode(' ', $value); 
                        $class_values_store = '';                   
                        foreach ($class_values as $class) {
                            $class_values_store .= ' '.$class;
                        }
                        $field_attr .= ' class="' . $class_values_store . '"';
                        break;
                    case 'placeholder_preview':
                        $field_attr .= $value;
                        break;
                    default:
                        break;
                }
            }
        }       
        return '<input' . $field_attr . '>';
    }
}

if (!function_exists('easy_build_cf7_light_get_forms')) {
    /**
     * Gets all Contact Form 7 forms
     * 
     * @return array Array of forms with id and title
     */
    function easy_build_cf7_light_get_forms() {
        $args = array(
            'post_type'      => 'wpcf7_contact_form',
            'posts_per_page' => -1,
        );
        
        $cf7_forms = get_posts($args);
        $forms = array();
        
        if ($cf7_forms) {
            foreach ($cf7_forms as $form) {
                $forms[] = array(
                    'id'    => $form->ID,
                    'title' => $form->post_title,
                );
            }
        }
        
        return $forms;
    }
}

if(!function_exists('easy_build_cf7_light_sync_form')){
    /**
     * Syncs Elementor content to Contact Form 7 form content
     * 
     * @param int $post_id The ID of the Elementor post/page
     * @param int $cf7_form_id The ID of the Contact Form 7 form
     * @return bool True if sync was successful, false otherwise
     */
    function easy_build_cf7_light_sync_form($post_id, $cf7_form_id){
        // Check if Elementor is active
        if (!did_action('elementor/loaded')) {
            return '';
        }
        $elementor_content = \Elementor\Plugin::$instance->frontend->get_builder_content($post_id, true);
        if (!empty($elementor_content) && !empty($cf7_form_id)) {
            update_post_meta($cf7_form_id, '_form', $elementor_content);
            return true;
        }
        return false;
    }
}

if (!function_exists('easy_build_cf7_light_is_builder_form_html')) {
    /**
     * Whether form HTML was generated by the Elementor builder.
     *
     * @since 1.0.5
     * @param string $form_html Contact Form 7 form template HTML.
     * @return bool
     */
    function easy_build_cf7_light_is_builder_form_html($form_html) {
        if (!is_string($form_html) || '' === $form_html) {
            return false;
        }

        return (
            false !== strpos($form_html, 'b7-field-parent')
            || false !== strpos($form_html, 'l-cf7-field-parent')
            || false !== strpos($form_html, 'builder-7-field-parent')
        );
    }
}

if (!function_exists('easy_build_cf7_light_disable_autop_for_builder_forms')) {
    /**
     * Disable CF7 autop on builder forms so labels do not get extra p/br gaps.
     *
     * @since 1.0.5
     * @param bool  $autop   Whether autop is enabled.
     * @param array $options Autop context options.
     * @return bool
     */
    function easy_build_cf7_light_disable_autop_for_builder_forms($autop, $options = array()) {
        $options = wp_parse_args($options, array('for' => 'form'));

        if ('form' !== $options['for']) {
            return $autop;
        }

        if (!class_exists('\WPCF7_ContactForm')) {
            return $autop;
        }

        $contact_form = \WPCF7_ContactForm::get_current();
        if (!$contact_form) {
            return $autop;
        }

        $form_html = $contact_form->prop('form');
        if (easy_build_cf7_light_is_builder_form_html($form_html)) {
            return false;
        }

        return $autop;
    }
}
add_filter('wpcf7_autop_or_not', 'easy_build_cf7_light_disable_autop_for_builder_forms', 10, 2);

if (!function_exists('easy_build_cf7_light_input_width_selectors')) {
    /**
     * Elementor width selectors that match both editor HTML and CF7 frontend wraps.
     *
     * Contact Form 7 wraps fields in `.wpcf7-form-control-wrap`. The wrap stays 100%
     * of the widget; the same width is applied to the control in editor and preview.
     *
     * @since 1.0.5
     * @param string|array $control_selector Control selector(s) relative to the widget wrapper.
     * @return array
     */
    function easy_build_cf7_light_input_width_selectors($control_selector = '.lcf7-form-control') {
        $selectors = is_array($control_selector) ? $control_selector : array($control_selector);
        $control_parts = array();
        $nested_parts  = array();

        foreach ($selectors as $selector) {
            $selector = ltrim((string) $selector);
            if ('' === $selector) {
                continue;
            }
            $control_parts[] = '{{WRAPPER}} ' . $selector;
            $nested_parts[]  = '{{WRAPPER}} .wpcf7-form-control-wrap ' . $selector;
        }

        if (empty($control_parts)) {
            return array();
        }

        return array(
            implode(', ', array_merge($control_parts, $nested_parts)) => 'width: {{SIZE}}{{UNIT}} !important; max-width: 100%; box-sizing: border-box;',
        );
    }
}

if (!function_exists('easy_build_cf7_light_field_margin_selectors')) {
    /**
     * Elementor margin selectors that apply to the field wrap on the CF7 frontend.
     *
     * @since 1.0.5
     * @param string|array $control_selector Control selector(s) relative to the widget wrapper.
     * @return array
     */
    function easy_build_cf7_light_field_margin_selectors($control_selector = '.lcf7-form-control') {
        $selectors = is_array($control_selector) ? $control_selector : array($control_selector);
        $control_parts = array();
        $nested_parts  = array();

        foreach ($selectors as $selector) {
            $selector = ltrim((string) $selector);
            if ('' === $selector) {
                continue;
            }
            $control_parts[] = '{{WRAPPER}} ' . $selector;
            $nested_parts[]  = '{{WRAPPER}} .wpcf7-form-control-wrap ' . $selector;
        }

        if (empty($control_parts)) {
            return array();
        }

        return array(
            implode(', ', $control_parts) => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            '{{WRAPPER}} .wpcf7-form-control-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            implode(', ', $nested_parts) => 'margin: 0;',
        );
    }
}

if (!function_exists('easy_build_cf7_light_label_margin_selectors')) {
    /**
     * Elementor selectors for field labels (not radio/checkbox option labels).
     *
     * Labels are forced to block so vertical dimension margins apply.
     *
     * @since 1.0.5
     * @return array
     */
    function easy_build_cf7_light_label_margin_selectors() {
        return array(
            '{{WRAPPER}} .b7-field-parent > label, {{WRAPPER}} .l-cf7-field-parent > label, {{WRAPPER}} .l-cf7-field-parent > p > label, {{WRAPPER}} .builder-7-field-parent > label, {{WRAPPER}} .easy-build-cf7-light-field-parent > label' => 'display: block; margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        );
    }
}
