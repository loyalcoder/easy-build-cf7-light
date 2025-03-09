<?php

namespace Builder7\Admin;
if (!defined('ABSPATH')) {
    exit;
}
/**
 * Handles settings and report pages
 */
class Settings
{

    /**
     * Renders the settings page template
     *
     * @return void
     */
    public function settings_page()
    {
        $this->render_template('settings');
    }

    /**
     * Renders the report page template
     *
     * @return void
     */
    public function report_page()
    {
        $this->render_template('report');
    }

    /**
     * Renders a template if it exists
     *
     * @param string $template_name Template name without extension
     * @return void
     */
    private function render_template(string $template_name)
    {
        $template_path = __DIR__ . "/views/{$template_name}.php";

        if (file_exists($template_path)) {
            include $template_path;
        }
    }
}
