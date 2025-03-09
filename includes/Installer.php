<?php

namespace EasyBuildCF7Light;

/**
 * Installer Class
 *
 * This class handles the installation and initialization tasks for the Easy Build CF7 Light plugin.
 * It is responsible for setting up initial plugin options, registering version information,
 * flushing rewrite rules, and performing any other necessary actions upon plugin activation.
 *
 * @package EasyBuildCF7Light
 */
class Installer
{
    /**
     * Initialize class functions
     *
     * This method is the main entry point for the Installer class. It is typically called
     * during plugin activation. It orchestrates the necessary installation steps, such as
     * adding plugin version information and flushing rewrite rules to ensure proper
     * functionality.
     *
     * @return void
     */
    public function run()
    {
        $this->add_version();
    }

    /**
     * Store plugin information
     *
     * This method is responsible for storing essential plugin information in the WordPress
     * options table. It records the installation timestamp when the plugin is first activated
     * and updates the plugin version on each activation or update. This allows the plugin
     * to track installation status and version changes over time.
     *
     * @return void
     */
    public function add_version()
    {
        $installed = get_option('easy_build_cf7_light_installed');

        // If the plugin is not yet marked as installed, record the installation timestamp.
        if (!$installed) {
            update_option('easy_build_cf7_light_installed', time());
        }

        // Update the plugin version in the options table to the current version.
        update_option('easy_build_cf7_light_version', EASY_BUILD_CF7_LIGHT_VERSION);
    }

}