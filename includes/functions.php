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
