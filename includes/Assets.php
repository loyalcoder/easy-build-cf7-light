<?php

namespace Builder7;

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
            'builder7-script' => [
                'src'     => BUILDER7_ASSETS . '/js/frontend.js',
                'version' => filemtime(BUILDER7_PATH . '/assets/js/frontend.js'),
                'deps'    => ['jquery']
            ],
            'builder7-enquiry-script' => [
                'src'     => BUILDER7_ASSETS . '/dist/bundle.js',
                'version' => filemtime(BUILDER7_PATH . '/assets/dist/bundle.js'),
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
            'builder7-style' => [
                'src'     => BUILDER7_ASSETS . '/dist/main.css',
                'version' => filemtime(BUILDER7_PATH . '/assets/dist/main.css'),
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
            $version = isset($script['version']) ? $script['version'] : BUILDER7_VERSION;

            wp_register_script($handle, $script['src'], $deps, $version, true);
        }
        foreach ($styles as $handle => $style) {
            $deps = isset($style['deps']) ? $style['deps'] : false;
            $version = isset($style['version']) ? $style['version'] : BUILDER7_VERSION;

            wp_register_style($handle, $style['src'], $deps, $version);
        }
        wp_enqueue_style('builder7-style');
    }

    /**
     * Register and enqueue admin assets
     * 
     * @since 1.0.0
     */
    public function register_admin_assets() 
    {
        $screen = get_current_screen();

        $allowed_admin = ['edit-cf7-builder', 'toplevel_page_wpcf7', 'cf7-builder'];
        // Only load on plugin admin pages
        if (in_array($screen->id, $allowed_admin)) {
            wp_enqueue_style(
                'builder7-admin-style',
                BUILDER7_ASSETS . '/dist/admin.css',
                [],
                filemtime(BUILDER7_PATH . '/assets/dist/admin.css')
            );

            wp_enqueue_script(
                'builder7-admin-script', 
                BUILDER7_ASSETS . '/dist/admin.bundle.js',
                ['jquery'],
                filemtime(BUILDER7_PATH . '/assets/dist/admin.bundle.js'),
                true
            );
            wp_enqueue_script(
                'builder7Ajax', 
                BUILDER7_ASSETS . '/dist/adminAjax.bundle.js',
                ['jquery'],
                filemtime(BUILDER7_PATH . '/assets/dist/adminAjax.bundle.js'),
                true
            );
            wp_localize_script('builder7Ajax', 'builder7AjaxObject', array(
                'ajaxurl' => admin_url('admin-ajax.php'),
                'nonce'   => wp_create_nonce('builder7_ajax_nonce')
            ));
        }
        // Enqueue sync script only on Contact Form 7 admin page
        if ($screen->id === 'toplevel_page_wpcf7') {
            wp_enqueue_script(
                'builder7-sync',
                BUILDER7_ASSETS . '/dist/sync.bundle.js',
                ['jquery'],
                filemtime(BUILDER7_PATH . '/assets/dist/sync.bundle.js'),
                true
            );
            wp_enqueue_style(
                'builder7-sync-style',
                BUILDER7_ASSETS . '/dist/sync.css',
                [],
                filemtime(BUILDER7_PATH . '/assets/dist/sync.css')
            );
            wp_localize_script('builder7Ajax', 'builder7AjaxObject', array(
                'ajaxurl' => admin_url('admin-ajax.php'),
                'nonce'   => wp_create_nonce('builder7_ajax_nonce')
            ));
        }

    } 
}
