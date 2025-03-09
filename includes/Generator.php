<?php

namespace Builder7;

if (!defined('ABSPATH')) {
    exit;
}
class Generator {
    /**
     * Constructor to initialize hooks.
     */
    public function __construct() {
        add_action('init', [$this, 'register_post_type']);
        add_action('add_meta_boxes', [$this, 'add_cf7_metabox']);
        add_action('add_meta_boxes', [$this, 'add_cf7_builder_metabox']);
        add_action('save_post', [$this, 'save_cf7_metabox_and_update_form']);
    }

    /**
     * Registers the 'cf7-elementor-builder' custom post type.
     */
    public function register_post_type() {
        register_post_type('cf7-builder', array(
            'labels' => array(
                'name'          => esc_html__('Builder7 Elementor Builder', 'builder7'),
                'singular_name' => esc_html__('Builder7 Elementor Builder', 'builder7'),
                'menu_name'     => esc_html__('Builder7', 'builder7'),
                'add_new'       => esc_html__('Add New', 'builder7'),
                'add_new_item'  => esc_html__('Add New Builder7', 'builder7'),
                'edit_item'     => esc_html__('Edit Builder7', 'builder7'),
                'new_item'      => esc_html__('New Builder7', 'builder7'),
                'view_item'     => esc_html__('View Builder7', 'builder7'),
                'search_items'  => esc_html__('Search Builder7', 'builder7'),
                'not_found'     => esc_html__('No Builder7 found', 'builder7'),
                'not_found_in_trash' => esc_html__('No Builder7 found in Trash', 'builder7'),
            ),
            'public'       => true,
            'show_ui'      => true, // Ensures the post type has a UI in the dashboard
            'show_in_menu' => true, // Displays it in the admin menu
            'menu_position' => 5,   // Position in the admin menu (below "Posts")
            'menu_icon'    => 'dashicons-welcome-widgets-menus', // Icon for the menu
            'has_archive'  => true,
            'supports'     => array('title', 'editor', 'elementor'),
        ));
    }

     /**
     * Adds a metabox for selecting a Contact Form 7 form.
     */
    public function add_cf7_metabox() {
        add_meta_box(
            'cf7_builder_metabox',
            esc_html__('Select Contact Form', 'builder7'),
            array($this, 'render_cf7_metabox'),
            'cf7-builder',
            'side',
            'default'
        );
    }

    /**
     * Adds a metabox to display builder title on Contact Form 7 edit screen
     */
    public function add_cf7_builder_metabox() {
        add_meta_box(
            'cf7_builder_display_metabox',
            esc_html__('Builder7 Pages', 'builder7'),
            array($this, 'render_cf7_builder_metabox'),
            'wpcf7_contact_form',
            'side',
            'default'
        );
    }

    /**
     * Renders the builder metabox content on CF7 edit screen
     */
    public function render_cf7_builder_metabox($post) {
        $args = array(
            'post_type' => 'cf7-builder',
            'meta_key' => '_cf7_form_id',
            'meta_value' => $post->ID,
            'posts_per_page' => -1
        );

        $builder_pages = get_posts($args);

        if (!empty($builder_pages)) {
            echo '<ul>';
            foreach ($builder_pages as $page) {
                printf(
                    '<li><a href="%s">%s</a></li>',
                    esc_url(get_edit_post_link($page->ID)),
                    esc_html($page->post_title)
                );
            }
            echo '</ul>';
        } else {
            echo '<p>' . esc_html__('No builder pages found for this form.', 'builder7') . '</p>';
        }
    }

    /**
     * Renders the metabox content.
     */
    public function render_cf7_metabox($post) {
        // Get all Contact Form 7 forms
        $forms = get_posts(array(
            'post_type' => 'wpcf7_contact_form',
            'numberposts' => -1,
        ));

        // Get the saved post meta value
        $selected_form_id = get_post_meta($post->ID, '_cf7_form_id', true);

        // Add a nonce for security
        wp_nonce_field('cf7_builder_metabox_nonce', 'cf7_builder_metabox_nonce_field');

        ?>
        <label for="cf7_form_id"><?php echo esc_html__('Select a Contact Form:', 'builder7'); ?></label>
        <select name="cf7_form_id" id="cf7_form_id" style="width: 100%;">
            <option value=""><?php echo esc_html__('Select a form', 'builder7'); ?></option>
            <?php foreach ($forms as $form) : ?>
                <option value="<?php echo esc_attr($form->ID); ?>" <?php selected($selected_form_id, $form->ID); ?>>
                    <?php echo esc_html($form->post_title); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php
    }

    /**
     * Saves the selected Contact Form 7 form ID.
     */
    public function save_cf7_metabox_and_update_form($post_id) {
        // Verify nonce
        if (!isset($_POST['cf7_builder_metabox_nonce_field']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['cf7_builder_metabox_nonce_field'])), 'cf7_builder_metabox_nonce')) {
            return;
        }

        // Check autosave
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // Check user permissions
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        // Save the selected Contact Form 7 ID
        $selected_form_id = isset($_POST['cf7_form_id']) ? sanitize_text_field(wp_unslash($_POST['cf7_form_id'])) : '';
        if ( $selected_form_id !== '' ) {
            update_post_meta($post_id, '_cf7_form_id', $selected_form_id);
        } else {
            return;
        }
        builder7_sync_form($post_id, $selected_form_id);
    } 
}
