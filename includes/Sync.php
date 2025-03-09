<?php

namespace EasyBuildCF7Light;

if (!defined('ABSPATH')) {
    exit;
}
class Sync {

    /**
     * Class constructor
     */
    public function __construct() {
        add_action('wp_ajax_cf7_builder_sync', [$this, 'handle_sync']);
        add_action('wpcf7_admin_footer', [$this, 'add_cf7_builder_edit_button_and_overlay']);
    }

    /**
     * Handle the AJAX sync request
     *
     * @return void
     */
    public function handle_sync() {
        // Verify nonce and permissions
        check_ajax_referer('builder7_ajax_nonce', 'nonce');

        if (!current_user_can('edit_posts')) {
            wp_send_json_error(['message' => esc_html__('Permission denied', 'easy-build-cf7-light')]);
        }

        // Get post IDs
        $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
        $form_id = isset($_POST['form_id']) ? intval($_POST['form_id']) : 0;

        if (!$post_id || !$form_id) {
            wp_send_json_error(['message' => esc_html__('Invalid post or form ID', 'easy-build-cf7-light')]);
        }

        // Get the form content from Elementor
        $result = builder7_sync_form($post_id, $form_id);

        if ($result) {
            wp_send_json_success(esc_html__('Form synced successfully', 'easy-build-cf7-light'));
        } else {
            wp_send_json_error(esc_html__('Builder Content Not Found', 'easy-build-cf7-light'));
        }
        wp_die();
    }

    public function add_cf7_builder_edit_button_and_overlay() {
        $screen = get_current_screen();
        if ($screen->id !== 'toplevel_page_wpcf7') {
            return;
        }
        $form_id = false;
        if (class_exists('WPCF7_ContactForm')) {
            $current_form = \WPCF7_ContactForm::get_current();
            if ($current_form) {
                $form_id = $current_form->id();
            }
        }
        if (!$form_id) {
            return;
        }

        // Find the corresponding CF7 Builder post
        $args = array(
            'post_type' => 'easy-build-cf7',
            'meta_key' => '_easy_build_cf7_form_id',
            'meta_value' => $form_id,
            'posts_per_page' => 1
        );
        $posts = get_posts($args);
        $builder_post_id = !empty($posts) ? $posts[0]->ID : 0;

        if (!$builder_post_id) {
            return; // No corresponding builder post found
        }
        // Generate the correct Elementor edit URL
        $edit_with_elementor_url = admin_url("post.php?post={$builder_post_id}&action=elementor");
        ?>
        <span class="cf7-builder-sync-url" data-elementor-url="<?php echo esc_url($edit_with_elementor_url); ?>"  data-post-id="<?php echo esc_attr($builder_post_id); ?>"  data-form-id="<?php echo esc_attr($form_id); ?>" style="display: none;"></span>
        <?php
    }    
}
