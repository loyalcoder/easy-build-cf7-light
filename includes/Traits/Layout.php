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
            ],
            [
                'id' => 'layout2',
                'preview_url' => EASY_BUILD_CF7_LIGHT_ASSETS . '/images/layouts/layout2/preview.webp', 
                'data' => EASY_BUILD_CF7_LIGHT_PATH . '/assets/layouts/layout2.json',
                'preview_image' => 'preview.webp'
            ],
            [
                'id' => 'layout3',
                'preview_url' => EASY_BUILD_CF7_LIGHT_ASSETS . '/images/layouts/layout3/preview.webp',
                'data' => EASY_BUILD_CF7_LIGHT_PATH . '/assets/layouts/layout3.json',
                'preview_image' => 'preview.webp'
            ],
            [
                'id' => 'layout4',
                'preview_url' => EASY_BUILD_CF7_LIGHT_ASSETS . '/images/layouts/layout4/preview.webp',
                'data' => EASY_BUILD_CF7_LIGHT_PATH . '/assets/layouts/layout4.json',
                'preview_image' => 'preview.webp'
            ],
            [
                'id' => 'layout5',
                'preview_url' => EASY_BUILD_CF7_LIGHT_ASSETS . '/images/layouts/layout5/preview.webp',
                'data' => EASY_BUILD_CF7_LIGHT_PATH . '/assets/layouts/layout5.json',
                'preview_image' => 'preview.webp'
            ],
            [
                'id' => 'layout6',
                'preview_url' => EASY_BUILD_CF7_LIGHT_ASSETS . '/images/layouts/layout6/preview.webp',
                'data' => EASY_BUILD_CF7_LIGHT_PATH . '/assets/layouts/layout6.json',
                'preview_image' => 'preview.webp'
            ],
            [
                'id' => 'layout7',
                'preview_url' => EASY_BUILD_CF7_LIGHT_ASSETS . '/images/layouts/layout7/preview.webp',
                'data' => EASY_BUILD_CF7_LIGHT_PATH . '/assets/layouts/layout7.json',
                'preview_image' => 'preview.webp'
            ],
            [
                'id' => 'layout8',
                'preview_url' => EASY_BUILD_CF7_LIGHT_ASSETS . '/images/layouts/layout8/preview.webp',
                'data' => EASY_BUILD_CF7_LIGHT_PATH . '/assets/layouts/layout8.json',
                'preview_image' => 'preview.webp'
            ],
            [
                'id' => 'layout9',
                'preview_url' => EASY_BUILD_CF7_LIGHT_ASSETS . '/images/layouts/layout9/preview.webp',
                'data' => EASY_BUILD_CF7_LIGHT_PATH . '/assets/layouts/layout9.json',
                'preview_image' => 'preview.webp'
            ],
        ];
    }
}
