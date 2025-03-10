<?php

namespace EasyBuildCF7Light;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Admin class for initializing plugin functionality
 * 
 * Handles admin menu, handlers and notices
 * 
 * @since 1.0.0
 */
class Admin
{
    use Layout;

    /**
     * Initializes the admin class
     * 
     * @since 1.0.0
     * @return void
     */
    public function __construct()
    {
        $this->initHandler();
        add_action('admin_notices', [$this, 'add_offcanvas']);
    }

    /**
     * Initializes the admin handler
     * 
     * @since 1.0.0
     * @return void
     */
    private function initHandler()
    {
        new Admin\Handler();
    }

    /**
     * Load admin content for Easy Build CF7 Light
     * 
     * @since 1.0.0
     * @return void
     */
    public function add_offcanvas()
    {
        $screen = get_current_screen();
        $layouts = $this->layout_list();
        $allowed_screens = ['wpcf7_contact_form'];

        if (isset($screen->id) && in_array($screen->id, $allowed_screens)) {
            include __DIR__ . '/Admin/views/offcanvas.php';
        }
    }
}
