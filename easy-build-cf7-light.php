<?php

/**
 * Plugin Name:       Easy Build CF7 Light
 * Plugin URI:        https://easy-build-cf7-light.loyalcoder.com
 * Description:       Seamlessly integrate Contact Form 7 forms with Elementor page builder. Design beautiful contact forms using Elementor's drag & drop interface, sync form fields automatically, and customize form layouts with Elementor widgets.
 * Version:           1.0.3
 * Author:            Loyalcoder
 * Author URI:        https://loyalcoder.com
 * Text Domain:       easy-build-cf7-light
 * Requires Plugins: contact-form-7, elementor
 * Domain Path:       /languages
 * Requires at least: 5.0
 * Requires PHP:      7.4
 * Elementor tested up to: 3.28.4
 * Contact Form 7 tested up to: 6.0.6
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */

if (!defined('ABSPATH')) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

/**
 * Main plugin class
 */
final class EasyBuildCF7Light
{
    /**
     * Plugin version
     * 
     * @var string
     */
    const version = '1.0.0';

    /**
     * contractor
     */
    private function __construct()
    {
        $this->define_constants();

        register_activation_hook(__FILE__, [$this, 'activate']);
        add_action('plugins_loaded', [$this, 'init_plugin']);
    }

    /**
     * Initialize singleton instance
     *
     * @return \EasyBuildCF7Light
     */
    public static function init()
    {
        static $instance = false;

        if (!$instance) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Define constants
     *
     * @return void
     */
    public function define_constants()
    {
        define('EASY_BUILD_CF7_LIGHT_VERSION', self::version);
        define('EASY_BUILD_CF7_LIGHT_FILE', __FILE__);
        define('EASY_BUILD_CF7_LIGHT_PATH', __DIR__);
        define('EASY_BUILD_CF7_LIGHT_URL', plugins_url('', EASY_BUILD_CF7_LIGHT_FILE));
        define('EASY_BUILD_CF7_LIGHT_ASSETS', EASY_BUILD_CF7_LIGHT_URL . '/assets');
        define('EASY_BUILD_CF7_LIGHT_DIR_PATH', plugin_dir_path(__FILE__));
        define('EASY_BUILD_CF7_LIGHT_ELEMENTOR', EASY_BUILD_CF7_LIGHT_DIR_PATH . 'includes/Elementor/');
    }

    /**
     * Plugin information
     *
     * @return void
     */
    public function activate()
    {
        $installer = new \EasyBuildCF7Light\Installer();

        $installer->run();
        delete_option( 'rewrite_rules' );
    }

    /**
     * Load plugin files
     *
     * @return void
     */
    public function init_plugin()
    {
        new \EasyBuildCF7Light\Assets();
        new \EasyBuildCF7Light\Ajax_Handler();
        if (did_action('elementor/loaded')) {
            new \EasyBuildCF7Light\Load_Elementor();
        }
        new \EasyBuildCF7Light\Generator();
        if (is_admin()) {
            new \EasyBuildCF7Light\Admin();
            new \EasyBuildCF7Light\Sync();
        } 
    }
}
if(!function_exists('easy_build_cf7_light')){
    /**
     * Initialize main plugin
     *
     * @return \EasyBuildCF7Light
     */
    function easy_build_cf7_light()
    {
        return EasyBuildCF7Light::init();
    }
}
easy_build_cf7_light();