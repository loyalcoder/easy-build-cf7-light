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
            ],
            'easy-build-cf7-light-enquiry-script' => [
                'src'     => EASY_BUILD_CF7_LIGHT_ASSETS . '/dist/bundle.js',
                'version' => filemtime(EASY_BUILD_CF7_LIGHT_PATH . '/assets/dist/bundle.js'),
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
