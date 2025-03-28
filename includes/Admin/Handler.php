<?php

namespace EasyBuildCF7Light\Admin;
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Handler class for managing CF7 Builder admin functionality
 * 
 * This class handles the admin-side operations for the CF7 Builder plugin,
 * including custom column management in the post list table.
 * 
 * @since 1.0.0
 */
class Handler
{
    /**
     * Initialize the Handler class
     * 
     * Sets up filters and actions for managing custom columns
     * in the CF7 Builder post list table.
     *
     * @since 1.0.0
     * @return void
     */
    function __construct()
    {
        add_filter('manage_easy-build-cf7_posts_columns', [$this, 'add_cf7_builder_column']);
        add_action('manage_easy-build-cf7_posts_custom_column', [$this, 'render_cf7_builder_column'], 10, 2);
    }


    /**
     * Add CF7 builder column to post list before date column
     *
     * Adds two custom columns to the CF7 Builder post list table:
     * - Contact Form Title: Displays the associated CF7 form title
     * - Sync To CF7: Displays a sync button to synchronize with Contact Form 7
     * 
     * @since 1.0.0
     * @param array $columns Array of column names
     * @return array Modified array of column names
     */
    public function add_cf7_builder_column($columns)
    {
        $new_columns = [];
        $date_column_index = array_search('date', array_keys($columns));
        foreach ($columns as $key => $value) {
            if ($key === 'date') {
                $new_columns['cf7_form_title'] = esc_html__('Contact Form Title', 'easy-build-cf7-light');
                $new_columns['cf7_builder_sync'] = esc_html__('Sync To Cf7', 'easy-build-cf7-light');
            }
            $new_columns[$key] = $value;
        }
        return $new_columns;
    }

    /**
     * Render CF7 builder column content
     *
     * Renders the content for the custom columns:
     * - For cf7_form_title: Displays the associated CF7 form title
     * - For cf7_builder_sync: Displays a sync button with SVG icon
     *
     * @since 1.0.0
     * @param string $column_name The name of the column being rendered
     * @param int $post_id The ID of the current post
     * @return void
     */
    public function render_cf7_builder_column($column_name, $post_id)
    {
        if ($column_name === 'cf7_form_title') {
            $selected_form_id = get_post_meta($post_id, '_easy_build_cf7_form_id', true);
            if ($selected_form_id) {
                $form = get_post($selected_form_id);
                echo esc_html($form ? $form->post_title : '');
            }
        }
        
        if ($column_name === 'cf7_builder_sync') {
            $selected_form_id = get_post_meta($post_id, '_easy_build_cf7_form_id', true);
            ?>
            <a href="javascript:void(0)" type="button" class="button button-secondary cf7-builder-sync" data-post-id="<?php echo esc_attr($post_id); ?>" data-form-id="<?php echo esc_attr($selected_form_id); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000" height="20px" width="20px" version="1.1" id="Layer_1" viewBox="0 0 511.979 511.979" xml:space="preserve">
                    <g>
                        <g>
                            <g>
                                <path d="M42.667,255.998c0-70.778,57.222-128,128-128c0.057,0,0.112-0.008,0.169-0.009h118.984l-27.582,27.582     c-8.331,8.331-8.331,21.839,0,30.17c8.331,8.331,21.839,8.331,30.17,0l64-64c0.004-0.004,0.007-0.008,0.011-0.012     c0.492-0.493,0.959-1.012,1.402-1.551c0.203-0.247,0.379-0.507,0.568-0.76c0.227-0.304,0.463-0.601,0.674-0.917     c0.203-0.303,0.379-0.618,0.565-0.93c0.171-0.286,0.35-0.565,0.508-0.86c0.17-0.318,0.314-0.645,0.467-0.969     c0.145-0.307,0.298-0.609,0.428-0.923c0.13-0.315,0.235-0.636,0.35-0.956c0.121-0.337,0.25-0.67,0.355-1.015     c0.097-0.32,0.168-0.645,0.249-0.968c0.089-0.351,0.187-0.698,0.258-1.056c0.074-0.375,0.118-0.753,0.172-1.13     c0.044-0.311,0.104-0.618,0.135-0.933c0.138-1.4,0.138-2.811,0-4.211c-0.031-0.315-0.09-0.621-0.135-0.932     c-0.054-0.378-0.098-0.756-0.173-1.13c-0.071-0.358-0.169-0.704-0.258-1.055c-0.081-0.324-0.152-0.649-0.249-0.969     c-0.104-0.344-0.233-0.677-0.354-1.013c-0.115-0.32-0.22-0.642-0.35-0.957c-0.13-0.314-0.283-0.616-0.428-0.922     c-0.153-0.325-0.297-0.652-0.467-0.97c-0.157-0.294-0.337-0.573-0.507-0.859c-0.186-0.312-0.362-0.627-0.565-0.931     c-0.211-0.315-0.446-0.612-0.673-0.915c-0.19-0.254-0.367-0.515-0.57-0.762c-0.443-0.539-0.909-1.058-1.402-1.551     c-0.004-0.004-0.007-0.008-0.011-0.012l-64-64c-8.331-8.331-21.839-8.331-30.17,0c-8.331,8.331-8.331,21.839,0,30.17     l27.582,27.582H170.656c-0.077,0-0.152,0.011-0.229,0.012C76.196,85.464,0,161.736,0,255.998     c0,42.518,16.993,82.551,46.605,112.188c8.328,8.335,21.835,8.341,30.17,0.013c8.335-8.328,8.341-21.835,0.013-30.17     C55.074,316.297,42.667,287.066,42.667,255.998z"/>
                                <path d="M511.979,255.981c0-42.518-16.993-82.551-46.605-112.188c-8.328-8.335-21.835-8.341-30.17-0.013     c-8.335,8.328-8.341,21.835-0.013,30.17c21.713,21.732,34.121,50.963,34.121,82.031c0,70.778-57.222,128-128,128     c-0.057,0-0.112,0.008-0.169,0.009H222.159l27.582-27.582c8.331-8.331,8.331-21.839,0-30.17c-8.331-8.331-21.839-8.331-30.17,0     l-64,64c-0.004,0.004-0.006,0.008-0.01,0.011c-0.493,0.494-0.96,1.012-1.403,1.552c-0.203,0.247-0.379,0.507-0.569,0.761     c-0.227,0.303-0.462,0.6-0.673,0.915c-0.203,0.304-0.379,0.619-0.565,0.93c-0.171,0.286-0.35,0.565-0.508,0.86     c-0.17,0.317-0.313,0.643-0.466,0.967c-0.145,0.308-0.299,0.61-0.43,0.925c-0.13,0.314-0.234,0.634-0.349,0.952     c-0.122,0.338-0.251,0.672-0.356,1.018c-0.096,0.318-0.167,0.641-0.248,0.963c-0.089,0.353-0.188,0.702-0.259,1.061     c-0.074,0.372-0.117,0.747-0.171,1.122c-0.045,0.314-0.105,0.623-0.136,0.941c-0.068,0.693-0.105,1.387-0.105,2.083     c0,0.007-0.001,0.015-0.001,0.022s0.001,0.015,0.001,0.022c0.001,0.695,0.037,1.39,0.105,2.083     c0.031,0.318,0.091,0.627,0.136,0.94c0.054,0.375,0.098,0.75,0.171,1.122c0.071,0.359,0.17,0.708,0.259,1.061     c0.081,0.322,0.151,0.645,0.248,0.964c0.105,0.346,0.234,0.68,0.356,1.018c0.114,0.318,0.219,0.639,0.349,0.953     c0.131,0.316,0.284,0.618,0.43,0.926c0.152,0.323,0.296,0.649,0.465,0.966c0.158,0.295,0.338,0.575,0.509,0.861     c0.186,0.311,0.361,0.626,0.564,0.929c0.211,0.316,0.447,0.613,0.674,0.917c0.19,0.253,0.365,0.513,0.568,0.759     c0.446,0.544,0.916,1.067,1.413,1.563l64,64c8.331,8.331,21.839,8.331,30.17,0c8.331-8.331,8.331-21.839,0-30.17l-27.582-27.582     h119.163c0.077,0,0.152-0.011,0.229-0.012C435.783,426.515,511.979,350.243,511.979,255.981z"/>
                            </g>
                        </g>
                    </g>
                </svg>
            </a>
            <?php 
        }
    }
}