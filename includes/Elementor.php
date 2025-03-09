<?php

namespace Builder7;

use Elementor\Plugin;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Load Elementor integration class
 * 
 * Handles Elementor widget registration and category setup
 * 
 * @since 1.0.0
 */
class Load_Elementor
{
    /**
     * Initialize Elementor integration
     *
     * @since 1.0.0
     * @return void
     */
    public function __construct()
    {
        add_action('elementor/elements/categories_registered', [$this, 'register_category']);
        add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets']);
        add_action('elementor/editor/after_enqueue_scripts', [$this, 'custom_elementor_scripts']);
    }


    /**
     * Enqueue custom scripts for Elementor editor
     * 
     * @since 1.0.0
     * @return void
     */
    public function custom_elementor_scripts()
    {
        $scripts = $this->get_scripts();

        foreach ($scripts as $handle => $script) {
            $deps    = isset($script['deps']) ? $script['deps'] : false;
            $version = isset($script['version']) ? $script['version'] : BUILDER7_VERSION;
            wp_register_script($handle, $script['src'], $deps, $version, true);
            wp_enqueue_script($handle);
        }
    }

    /**
     * Register Elementor widget categories
     *
     * @param object $elementor Elementor instance
     *
     * @since 1.0.0
     * @return object
     */
    public function register_category($elementor)
    {
        global $post;

        // Add 'Builder 7 ShortCode' category for all post types
        $elementor->add_category(
            'builder-7-shortcode',
            [
                'title' => esc_html__('Builder 7 ShortCode', 'builder7'),
                'icon'  => 'eicon-font',
            ]
        );

        $elementor->add_category(
            'builder_7_widgets',
            [
                'title' => esc_html__('Builder 7', 'builder7'),
                'icon'  => 'eicon-font',
            ]
        );
        return $elementor;
    }

    /**
     * Register Elementor widgets
     *
     * @since 1.0.0
     * @return void
     */
    public function register_widgets()
    {
       // $this->includeWidgetsFiles();

        Plugin::instance()->widgets_manager->register(new Elementor\Input_Text());
        Plugin::instance()->widgets_manager->register(new Elementor\Input_Email());
        Plugin::instance()->widgets_manager->register(new Elementor\Input_Url());
        Plugin::instance()->widgets_manager->register(new Elementor\Input_Tel());
        Plugin::instance()->widgets_manager->register(new Elementor\Input_Number());
        Plugin::instance()->widgets_manager->register(new Elementor\Input_Date());
        Plugin::instance()->widgets_manager->register(new Elementor\Input_Textarea());
        Plugin::instance()->widgets_manager->register(new Elementor\Input_Drop_Down_Menu());
        Plugin::instance()->widgets_manager->register(new Elementor\Input_Checkboxes());
        Plugin::instance()->widgets_manager->register(new Elementor\Input_Radio_Button());
        Plugin::instance()->widgets_manager->register(new Elementor\Input_Acceptance());
        Plugin::instance()->widgets_manager->register(new Elementor\Input_Quiz());
        Plugin::instance()->widgets_manager->register(new Elementor\Input_File());
        Plugin::instance()->widgets_manager->register(new Elementor\Input_Submit());
        Plugin::instance()->widgets_manager->register(new Elementor\Contact_Form());
    }

    /**
     * Get widget scripts
     *
     * @since 1.0.0
     * @return array
     */
    public static function getWidgetScript()
    {
        return [];
    }

    /**
     * Get plugin scripts
     *
     * @since 1.0.0
     * @return array
     */
    public function get_scripts()
    {
        return [
            // 'builder7' => [
            //     'src'     => BUILDER7_ASSETS . '/js/builder7.js',
            //     'version' => filemtime(BUILDER7_PATH . '/assets/js/builder7.js'),
            //     'deps'    => ['jquery']
            // ],
        ];
    }

    /**
     * Get plugin styles
     *
     * @since 1.0.0
     * @return array
     */
    public function getStyles()
    {
        return [
            // 'builder7' => [
            //     'src'     => BUILDER7_ASSETS . '/css/builder7.css',
            //     'version' => filemtime(BUILDER7_PATH . '/assets/css/builder7.css'),
            // ]
        ];
    }

    /**
     * Get widget list
     *
     * @since 1.0.0
     * @return array
     */
    public static function getWidgetList()
    {
        return [
            'Hello_World',
        ];
    }

    /**
     * Include widget files
     *
     * @since 1.0.0
     * @return void
     */
    public function includeWidgetsFiles()
    {
        $scripts     = $this->get_scripts();
        $styles      = $this->getStyles();
        $widget_list = $this->getWidgetList();

        if (!count($widget_list)) {
            return;
        }

        foreach ($widget_list as $handle => $widget) {
            $file = BUILDER7_ELEMENTOR . $widget . '.php';
            if (file_exists($file)) {
                continue;
            }
            require_once $file;
        }

        foreach ($scripts as $handle => $script) {
            $deps    = isset($script['deps']) ? $script['deps'] : false;
            $version = isset($script['version']) ? $script['version'] : BUILDER7_VERSION;
            wp_register_script($handle, $script['src'], $deps, $version, true);
            // wp_enqueue_script($handle);
        }

        foreach ($styles as $handle => $style) {
            $deps = isset($style['deps']) ? $style['deps'] : false;
            $version = isset($style['version']) ? $style['version'] : BUILDER7_VERSION;
            wp_register_style($handle, $style['src'], $deps, $version);
            // wp_enqueue_style($handle);
        }
    }
}
