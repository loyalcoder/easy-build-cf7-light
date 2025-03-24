<?php

namespace EasyBuildCF7Light;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Layout trait for managing form layouts
 * 
 * Provides methods for retrieving available form layouts
 * 
 * @since 1.0.0
 */
trait Layout
{
    /**
     * Get list of available layouts
     *
     * @since 1.0.0
     * @return array Array of layout configurations
     */
    public function layout_list() {
        return [
            [
                'id' => 'layout1',
                'preview_url' => EASY_BUILD_CF7_LIGHT_ASSETS . '/images/layouts/layout1/preview.webp',
                'data' => EASY_BUILD_CF7_LIGHT_PATH . '/assets/layouts/layout1.json',
                'preview_image' => 'preview.webp'
            ]
        ];
    }
}
