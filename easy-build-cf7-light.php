<?php

/**
 * Plugin Name:       Builder7 - Elementor Addon for Contact Form 7
 * Plugin URI:        https://builder7.loyalcoder.com
 * Description:       Seamlessly integrate Contact Form 7 forms with Elementor page builder. Design beautiful contact forms using Elementor's drag & drop interface, sync form fields automatically, and customize form layouts with Elementor widgets.
 * Version:           1.0.0
 * Author:            Loyalcoder
 * Author URI:        https://loyalcoder.com
 * Text Domain:       builder7
 * Requires Plugins: contact-form-7, elementor
 * Domain Path:       /languages
 * Requires at least: 5.0
 * Requires PHP:      7.4
 * Elementor tested up to: 3.18.3
 * Contact Form 7 tested up to: 5.8.4
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
final class Builder7
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
     * @return \Builder7
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
        define('BUILDER7_VERSION', self::version);
        define('BUILDER7_FILE', __FILE__);
        define('BUILDER7_PATH', __DIR__);
        define('BUILDER7_URL', plugins_url('', BUILDER7_FILE));
        define('BUILDER7_ASSETS', BUILDER7_URL . '/assets');
        define('BUILDER7_DIR_PATH', plugin_dir_path(__FILE__));
        define('BUILDER7_ELEMENTOR', BUILDER7_DIR_PATH . 'includes/Elementor/');
    }

    /**
     * Plugin information
     *
     * @return void
     */
    public function activate()
    {
        $installer = new \Builder7\Installer();

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
        new \Builder7\Assets();
        new \Builder7\Ajax_Handler();
        if (did_action('elementor/loaded')) {
            new \Builder7\Load_Elementor();
        }
        new \Builder7\Generator();
        if (is_admin()) {
            new \Builder7\Admin();
            new \Builder7\Sync();
        } 
    }
}
if(!function_exists('builder7')){
    /**
     * Initialize main plugin
     *
     * @return \Builder7
     */
    function builder7()
    {
        return Builder7::init();
    }
}
builder7();