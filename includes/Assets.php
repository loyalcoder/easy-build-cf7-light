<?php

namespace EasyBuildCF7Light;

if (!defined('ABSPATH')) {
    exit;
}
/**
 * Assets handler class
 * 
 * Handles registration and enqueuing of frontend and admin assets
 * 
 * @since 1.0.0
 */

class Assets
{
    /**
     * Initialize assets by registering hooks
     * 
     * @since 1.0.0
     */
    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'register_assets']);
        add_action('admin_enqueue_scripts', [$this, 'register_admin_assets']);
    }

    /**
     * Get frontend scripts
     *
     * @since 1.0.0
     * @return array
     */
    public function get_scripts()
    {
        return [
            'easy-build-cf7-light-script' => [
                'src'     => EASY_BUILD_CF7_LIGHT_ASSETS . '/js/frontend.js',
                'version' => filemtime(EASY_BUILD_CF7_LIGHT_PATH . '/assets/js/frontend.js'),
                'deps'    => ['jquery']
            ]
        ];
    }

    /**
     * Get frontend styles
     *
     * @since 1.0.0
     * @return array
     */
    public function get_styles()
    {
        return [
            'easy-build-cf7-light-style' => [
                'src'     => EASY_BUILD_CF7_LIGHT_ASSETS . '/dist/main.css',
                'version' => filemtime(EASY_BUILD_CF7_LIGHT_PATH . '/assets/dist/main.css'),
            ]
        ];
    }

    /**
     * Register and enqueue frontend assets
     * 
     * @since 1.0.0
     */
    public function register_assets()
    {
        $scripts = $this->get_scripts();
        $styles = $this->get_styles();

        foreach ($scripts as $handle => $script) {
            $deps = isset($script['deps']) ? $script['deps'] : false;
            $version = isset($script['version']) ? $script['version'] : EASY_BUILD_CF7_LIGHT_VERSION;

            wp_register_script($handle, $script['src'], $deps, $version, true);
        }
        foreach ($styles as $handle => $style) {
            $deps = isset($style['deps']) ? $style['deps'] : false;
            $version = isset($style['version']) ? $style['version'] : EASY_BUILD_CF7_LIGHT_VERSION;

            wp_register_style($handle, $style['src'], $deps, $version);
        }
        wp_enqueue_style('easy-build-cf7-light-style');
        $this->enqueue_linked_elementor_assets_for_cf7_shortcodes();
    }

    /**
     * Enqueue Elementor generated styles for linked builder templates.
     *
     * When a CF7 form is rendered via shortcode on a normal page, Elementor's
     * post-specific CSS for the mapped builder post is not loaded automatically.
     * This ensures the designed styles are applied outside Elementor preview.
     *
     * @since 1.0.4
     * @return void
     */
    private function enqueue_linked_elementor_assets_for_cf7_shortcodes()
    {
        if (!did_action('elementor/loaded')) {
            return;
        }

        $form_ids = [];

        // Primary: collect form ids from queried post and loop posts.
        foreach ($this->get_candidate_posts_for_shortcode_scan() as $candidate_post) {
            $shortcode_sources = $this->get_cf7_shortcode_sources_for_post($candidate_post);

            if (empty($shortcode_sources)) {
                continue;
            }

            foreach ($this->extract_cf7_form_ids_from_sources($shortcode_sources) as $form_id) {
                if ($form_id > 0) {
                    $form_ids[] = $form_id;
                }
            }
        }

        // Fallback: if shortcode source is outside regular post content (e.g. widget/template),
        // enqueue all mapped builder CSS so style never breaks.
        if (empty($form_ids)) {
            $this->enqueue_elementor_css_for_builder_posts($this->get_all_builder_post_ids());
            return;
        }

        $form_ids = array_values(array_unique($form_ids));
        $builder_post_ids = $this->get_builder_post_ids_by_cf7_form_ids($form_ids);
        $this->enqueue_elementor_css_for_builder_posts($builder_post_ids);
    }

    /**
     * Extract Contact Form 7 numeric IDs from shortcode source strings.
     *
     * @since 1.0.4
     * @param array<int, string> $shortcode_sources Source strings to scan.
     * @return array<int, int>
     */
    private function extract_cf7_form_ids_from_sources($shortcode_sources)
    {
        $shortcode_pattern = get_shortcode_regex(['contact-form-7']);
        $form_ids = [];

        foreach ($shortcode_sources as $source) {
            if (!preg_match_all('/' . $shortcode_pattern . '/', $source, $matches, PREG_SET_ORDER)) {
                continue;
            }

            foreach ($matches as $shortcode_match) {
                if (!isset($shortcode_match[3]) || 'contact-form-7' !== $shortcode_match[2]) {
                    continue;
                }

                $attributes = shortcode_parse_atts($shortcode_match[3]);
                if (!is_array($attributes)) {
                    continue;
                }

                $form_id = $this->resolve_cf7_form_id_from_shortcode_attributes($attributes);
                if ($form_id > 0) {
                    $form_ids[] = $form_id;
                }
            }
        }

        return array_values(array_unique($form_ids));
    }

    /**
     * Get post candidates where CF7 shortcodes may exist.
     *
     * @since 1.0.4
     * @return array<int, \WP_Post>
     */
    private function get_candidate_posts_for_shortcode_scan()
    {
        $posts = [];
        $queried_object = get_queried_object();

        if ($queried_object instanceof \WP_Post) {
            $posts[] = $queried_object;
        }

        global $wp_query;
        if (isset($wp_query->posts) && is_array($wp_query->posts)) {
            foreach ($wp_query->posts as $query_post) {
                if ($query_post instanceof \WP_Post) {
                    $posts[] = $query_post;
                }
            }
        }

        $unique_posts = [];
        foreach ($posts as $post) {
            $unique_posts[$post->ID] = $post;
        }

        return array_values($unique_posts);
    }

    /**
     * Resolve mapped builder post ids from Contact Form 7 ids.
     *
     * @since 1.0.4
     * @param array<int, int> $form_ids Contact Form 7 IDs.
     * @return array<int, int>
     */
    private function get_builder_post_ids_by_cf7_form_ids($form_ids)
    {
        $builder_post_ids = [];

        foreach ($form_ids as $form_id) {
            $builder_post_id = $this->get_builder_post_id_by_cf7_form($form_id);
            if ($builder_post_id > 0) {
                $builder_post_ids[] = $builder_post_id;
            }
        }

        return array_values(array_unique($builder_post_ids));
    }

    /**
     * Get all published builder post IDs.
     *
     * @since 1.0.4
     * @return array<int, int>
     */
    private function get_all_builder_post_ids()
    {
        $builder_posts = get_posts([
            'post_type'              => 'easy-build-cf7',
            'post_status'            => 'publish',
            'posts_per_page'         => -1,
            'fields'                 => 'ids',
            'no_found_rows'          => true,
            'update_post_meta_cache' => false,
            'update_post_term_cache' => false,
        ]);

        if (empty($builder_posts)) {
            return [];
        }

        return array_values(array_unique(array_map('absint', $builder_posts)));
    }

    /**
     * Enqueue Elementor CSS files for mapped builder posts.
     *
     * @since 1.0.4
     * @param array<int, int> $builder_post_ids Builder post ids.
     * @return void
     */
    private function enqueue_elementor_css_for_builder_posts($builder_post_ids)
    {
        if (empty($builder_post_ids)) {
            return;
        }

        $builder_post_ids = array_values(array_unique(array_map('absint', $builder_post_ids)));

        // Load Elementor base frontend styles once.
        if (isset(\Elementor\Plugin::$instance->frontend) && method_exists(\Elementor\Plugin::$instance->frontend, 'enqueue_styles')) {
            \Elementor\Plugin::$instance->frontend->enqueue_styles();
        }

        foreach ($builder_post_ids as $builder_post_id) {
            if (class_exists('\Elementor\Core\Files\CSS\Post')) {
                $elementor_css_file = new \Elementor\Core\Files\CSS\Post($builder_post_id);
                $elementor_css_file->enqueue();
            }
        }
    }

    /**
     * Get related builder post id by Contact Form 7 form id.
     *
     * @since 1.0.4
     * @param int $form_id Contact Form 7 form id.
     * @return int
     */
    private function get_builder_post_id_by_cf7_form($form_id)
    {
        $query = new \WP_Query([
            'post_type'              => 'easy-build-cf7',
            'post_status'            => 'publish',
            'posts_per_page'         => 1,
            'fields'                 => 'ids',
            'no_found_rows'          => true,
            'update_post_meta_cache' => false,
            'update_post_term_cache' => false,
            'meta_query'             => [
                [
                    'key'     => '_easy_build_cf7_form_id',
                    'value'   => (string) absint($form_id),
                    'compare' => '=',
                ],
            ],
        ]);

        if (empty($query->posts)) {
            return 0;
        }

        return absint($query->posts[0]);
    }

    /**
     * Resolve Contact Form 7 form id from shortcode attributes.
     *
     * Supports both numeric id and title-based shortcode usage.
     *
     * @since 1.0.4
     * @param array $attributes Shortcode attributes.
     * @return int
     */
    private function resolve_cf7_form_id_from_shortcode_attributes($attributes)
    {
        if (!is_array($attributes)) {
            return 0;
        }

        if (!empty($attributes['id'])) {
            $shortcode_id = sanitize_text_field(wp_unslash($attributes['id']));

            if (is_numeric($shortcode_id)) {
                return absint($shortcode_id);
            }

            $resolved_by_hash = $this->resolve_cf7_form_id_by_hash($shortcode_id);
            if ($resolved_by_hash > 0) {
                return $resolved_by_hash;
            }
        }

        if (!empty($attributes['title'])) {
            $resolved_by_title = $this->resolve_cf7_form_id_by_title(
                sanitize_text_field(wp_unslash($attributes['title']))
            );

            if ($resolved_by_title > 0) {
                return $resolved_by_title;
            }
        }

        return 0;
    }

    /**
     * Resolve Contact Form 7 numeric post ID by hash-based shortcode id.
     *
     * CF7 shortcode id often contains a 7-char hash prefix (e.g. 8fae16d).
     *
     * @since 1.0.4
     * @param string $hash_id Hash value from shortcode id attribute.
     * @return int
     */
    private function resolve_cf7_form_id_by_hash($hash_id)
    {
        $hash_id = trim((string) $hash_id);
        if ('' === $hash_id) {
            return 0;
        }

        $query = new \WP_Query([
            'post_type'              => 'wpcf7_contact_form',
            'post_status'            => 'any',
            'posts_per_page'         => 1,
            'fields'                 => 'ids',
            'no_found_rows'          => true,
            'update_post_meta_cache' => false,
            'update_post_term_cache' => false,
            'meta_query'             => [
                [
                    'key'     => '_hash',
                    'value'   => $hash_id,
                    'compare' => 'LIKE',
                ],
            ],
        ]);

        if (!empty($query->posts)) {
            return absint($query->posts[0]);
        }

        return 0;
    }

    /**
     * Resolve Contact Form 7 numeric post ID by form title.
     *
     * @since 1.0.4
     * @param string $title Contact form title.
     * @return int
     */
    private function resolve_cf7_form_id_by_title($title)
    {
        $title = trim((string) $title);
        if ('' === $title) {
            return 0;
        }

        $form_posts = get_posts([
            'post_type'              => 'wpcf7_contact_form',
            'post_status'            => 'any',
            'posts_per_page'         => -1,
            'fields'                 => 'ids',
            'no_found_rows'          => true,
            'update_post_meta_cache' => false,
            'update_post_term_cache' => false,
            's'                      => $title,
        ]);

        if (empty($form_posts)) {
            return 0;
        }

        foreach ($form_posts as $form_post_id) {
            $form_post_title = get_the_title($form_post_id);
            if (is_string($form_post_title) && 0 === strcasecmp($form_post_title, $title)) {
                return absint($form_post_id);
            }
        }

        return 0;
    }

    /**
     * Collect possible shortcode sources for a singular post.
     *
     * Supports both classic content and Elementor JSON data, so shortcode
     * styling still works when the shortcode is stored in Elementor widgets.
     *
     * @since 1.0.4
     * @param \WP_Post $post Current queried post object.
     * @return array<int, string>
     */
    private function get_cf7_shortcode_sources_for_post(\WP_Post $post)
    {
        $sources = [];

        if (!empty($post->post_content) && has_shortcode($post->post_content, 'contact-form-7')) {
            $sources[] = (string) $post->post_content;
        }

        $elementor_data = get_post_meta($post->ID, '_elementor_data', true);
        if (is_string($elementor_data) && false !== strpos($elementor_data, '[contact-form-7')) {
            $sources[] = $elementor_data;
        }

        return array_values(array_unique(array_filter($sources)));
    }

    /**
     * Register and enqueue admin assets
     * 
     * @since 1.0.0
     */
    public function register_admin_assets() 
    {
        $screen = get_current_screen();

        $allowed_admin = ['edit-easy-build-cf7', 'toplevel_page_wpcf7', 'easy-build-cf7'];
        // Only load on plugin admin pages
        if (in_array($screen->id, $allowed_admin)) {
            wp_enqueue_style(
                'easy-build-cf7-light-admin-style',
                EASY_BUILD_CF7_LIGHT_ASSETS . '/dist/admin.css',
                [],
                filemtime(EASY_BUILD_CF7_LIGHT_PATH . '/assets/dist/admin.css')
            );

            wp_enqueue_script(
                'easy-build-cf7-light-admin-script', 
                EASY_BUILD_CF7_LIGHT_ASSETS . '/dist/admin.bundle.js',
                ['jquery'],
                filemtime(EASY_BUILD_CF7_LIGHT_PATH . '/assets/dist/admin.bundle.js'),
                true
            );
            wp_enqueue_script(
                'easy-build-cf7-light-ajax', 
                EASY_BUILD_CF7_LIGHT_ASSETS . '/dist/adminAjax.bundle.js',
                ['jquery'],
                filemtime(EASY_BUILD_CF7_LIGHT_PATH . '/assets/dist/adminAjax.bundle.js'),
                true
            );
            wp_localize_script('easy-build-cf7-light-ajax', 'easyBuilderCf7lightObj', array(
                'ajaxurl' => admin_url('admin-ajax.php'),
                'nonce'   => wp_create_nonce('easy_build_cf7_light_ajax_nonce')
            ));
        }
        // Enqueue sync script only on Contact Form 7 admin page
        if ($screen->id === 'toplevel_page_wpcf7') {
            wp_enqueue_script(
                'easy-build-cf7-light-sync',
                EASY_BUILD_CF7_LIGHT_ASSETS . '/dist/sync.bundle.js',
                ['jquery'],
                filemtime(EASY_BUILD_CF7_LIGHT_PATH . '/assets/dist/sync.bundle.js'),
                true
            );
            wp_enqueue_style(
                'easy-build-cf7-light-sync-style',
                EASY_BUILD_CF7_LIGHT_ASSETS . '/dist/sync.css',
                [],
                filemtime(EASY_BUILD_CF7_LIGHT_PATH . '/assets/dist/sync.css')
            );
            wp_localize_script('easy-build-cf7-light-sync', 'easyBuilderCf7lightObj', array(
                'ajaxurl' => admin_url('admin-ajax.php'),
                'nonce'   => wp_create_nonce('easy_build_cf7_light_ajax_nonce')
            ));
        }

    } 
}
