<?php
namespace EasyBuildCF7Light;

if (!defined('ABSPATH')) {
    exit;
}
/**
 * Ajax handler class
 * 
 * Handles AJAX requests for form operations
 * 
 * @since 1.0.0
 */
class Ajax_Handler {
    /**
     * Initialize AJAX handlers
     * 
     * @since 1.0.0
     */
    public function __construct() {
        add_action('wp_ajax_get_cf7_forms', [$this, 'ajax_get_cf7_forms']);
        add_action('wp_ajax_create_cf7_builder_post', [$this, 'create_cf7_builder_post']); 
        add_action('wp_ajax_cf7_builder_sync', [$this, 'cf7_builder_sync']); 
    }

    /**
     * AJAX handler for getting CF7 forms
     * 
     * @since 1.0.0
     */
    public function ajax_get_cf7_forms() {
        wp_send_json($this->get_cf7_forms());
    }

    /**
     * Get all Contact Form 7 forms
     * 
     * @since 1.0.0
     * @return array Array of form data
     */
    public function get_cf7_forms() {
        $args = [
            'post_type'      => 'wpcf7_contact_form',
            'posts_per_page' => -1,
        ];
        
        $cf7_forms = get_posts($args);
        $forms = [];
        
        if ($cf7_forms) {
            foreach ($cf7_forms as $form) {
                $forms[] = [
                    'id'    => $form->ID,
                    'title' => $form->post_title,
                ];
            }
        }
        
        return $forms;
    }

    /**
     * AJAX handler for creating CF7 builder post
     * 
     * @since 1.0.0
     */
    public function create_cf7_builder_post() {
        check_ajax_referer('easy_build_cf7_light_ajax_nonce', 'nonce');
        if (!current_user_can('edit_posts')) {
            wp_send_json_error(esc_html__('You do not have permission to do this.', 'easy-build-cf7-light'));
            return;
        }
        
        $title = isset($_POST['title']) ? sanitize_text_field(wp_unslash($_POST['title'])) : '';
        $cf7_form_id = isset($_POST['cf7_form_id']) ? intval($_POST['cf7_form_id']) : 0;
        $post_id = wp_insert_post([
            'post_title'  => $title,
            'post_status' => 'publish',
            'post_type'   => 'cf7-builder'
        ]);
        if (is_wp_error($post_id)) {
            wp_send_json_error($post_id->get_error_message());
            return;
        }
        if(isset($_REQUEST['selected_layout']) && sanitize_text_field(wp_unslash($_REQUEST['selected_layout'])) !== ''){
            $selected_layout = sanitize_text_field(wp_unslash($_REQUEST['selected_layout']));
            $path = EASY_BUILD_CF7_LIGHT_PATH . '/assets/layout/'.$selected_layout.'/data.json';
            $layout_data = $this->get_layout_date($path);
            if ($post_id) {
                // Insert post meta
                add_post_meta($post_id, '_elementor_data', $layout_data['content']);
                add_post_meta($post_id, '_elementor_template_type', $layout_data['type']);
                add_post_meta($post_id, '_elementor_page_settings', $layout_data['page_settings']);
                add_post_meta($post_id, '_elementor_edit_mode', $layout_data['page_edit']);
                add_post_meta($post_id, '_elementor_version', $layout_data['elementor_version']);
            }
        }
        update_post_meta($post_id, '_cf7_form_id', $cf7_form_id);

        $edit_url = add_query_arg(
            [
                'post'   => $post_id,
                'action' => 'elementor',
            ],
            admin_url('post.php')
        );

        wp_send_json_success([
            'message' => esc_html__('Post created successfully.', 'easy-build-cf7-light'),
            'edit_url' => $edit_url
        ]);
    }

    /**
     * Get layout data from JSON file
     * 
     * @since 1.0.0
     * @param string $path Path to JSON file
     * @return array|null Layout data array or null if invalid
     */
    function get_layout_date($path) {
        require_once ABSPATH . 'wp-admin/includes/class-wp-filesystem-base.php';
        require_once ABSPATH . 'wp-admin/includes/class-wp-filesystem-direct.php';
        $filesystem = new \WP_Filesystem_Direct(true);
        $file_content = $filesystem->get_contents($path);
        
        if ($file_content) {
            $post_data = json_decode($file_content, true);
            
            if (is_array($post_data)) {
                return [
                    'title' => $post_data['title'] ?? 'Default Title',
                    'content' => wp_json_encode($post_data['content'] ?? []),
                    'type' => $post_data['type'] ?? 'page',
                    'page_settings' => $post_data['page_settings'] ?? [],
                    'page_edit' => 'builder',
                    'elementor_version' => '3.14.1'
                ];
            }
        }
        
        return null;
    }

    /**
     * AJAX handler for syncing CF7 builder form
     * 
     * @since 1.0.0
     */
    public function cf7_builder_sync() {
        check_ajax_referer('easy_build_cf7_light_ajax_nonce', 'nonce');
        $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
        $form_id = isset($_POST['form_id']) ? intval($_POST['form_id']) : 0;

        if (!$post_id || !$form_id) {
            if (!$post_id) {
                wp_send_json_error(esc_html__('Builder Id is missing', 'easy-build-cf7-light'));
            }
            if (!$form_id) {
                wp_send_json_error(esc_html__('You have not selected any form', 'easy-build-cf7-light')); 
            }
        }
        $result = easy_build_cf7_light_sync_form($post_id, $form_id);

        if ($result) {
            wp_send_json_success(esc_html__('Form synced successfully', 'easy-build-cf7-light'));
        } else {
            wp_send_json_error(esc_html__('Builder Content Not Found', 'easy-build-cf7-light'));
        }
        wp_die();
    }
}