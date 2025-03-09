<?php

namespace Builder7;
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
                'preview_url' => 'https://builder7.loyalcoder.com/information/',
                'data' => 'layout1.json',
                'preview_image' => 'preview.webp'
            ],
            [
                'id' => 'layout2', 
                'preview_url' => 'https://builder7.loyalcoder.com/contact/',
                'data' => 'layout2.json',
                'preview_image' => 'preview.webp'
            ],
            [
                'id' => 'layout3', 
                'preview_url' => 'https://builder7.loyalcoder.com/contact-us/',
                'data' => 'layout3.json',
                'preview_image' => 'preview.webp'
            ],
            [
                'id' => 'layout4', 
                'preview_url' => 'https://builder7.loyalcoder.com/contact-form-4/',
                'data' => 'layout4.json',
                'preview_image' => 'preview.webp'
            ],
            [
                'id' => 'layout5', 
                'preview_url' => 'https://builder7.loyalcoder.com/contact-form-5/',
                'data' => 'layout5.json',
                'preview_image' => 'preview.webp'
            ],
            [
                'id' => 'layout6', 
                'preview_url' => 'https://builder7.loyalcoder.com/applicant-data/',
                'data' => 'layout6.json',
                'preview_image' => 'preview.webp'
            ],
            [
                'id' => 'layout7', 
                'preview_url' => 'https://builder7.loyalcoder.com/contact-form-2/',
                'data' => 'layout7.json',
                'preview_image' => 'preview.webp'
            ],
            [
                'id' => 'layout8', 
                'preview_url' => 'https://builder7.loyalcoder.com/contact-form-3/',
                'data' => 'layout8.json',
                'preview_image' => 'preview.webp'
            ],
            [
                'id' => 'layout9', 
                'preview_url' => 'https://builder7.loyalcoder.com/appointment/',
                'data' => 'layout9.json',
                'preview_image' => 'preview.webp'
            ],
        ];
    }
}
