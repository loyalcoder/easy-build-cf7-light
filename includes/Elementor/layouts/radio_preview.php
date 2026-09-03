<?php

if (!defined('ABSPATH')) {
    exit;
}

if (!function_exists('easy_build_cf7_light_render_radio_preview')) {
    /**
     * Render radio button preview markup in the Elementor editor.
     *
     * @param array  $settings      Widget settings.
     * @param array  $attributes    Field attributes.
     * @param string $layout_class  Layout class names.
     * @param array  $select_values Selectable radio values.
     * @return void
     */
    function easy_build_cf7_light_render_radio_preview($settings, $attributes, $layout_class, $select_values)
    {
        if (!is_array($settings) || !is_array($attributes) || !is_array($select_values)) {
            return;
        }

        $field_name   = isset($attributes['field_name']) ? (string) $attributes['field_name'] : '';
        $layout_class = (string) $layout_class;
        $show_label   = isset($settings['show_label']) && 'yes' === $settings['show_label'];
        $use_label    = isset($settings['first_item']) && 'yes' === $settings['first_item'];
        $values_count = count($select_values);
        ?>
        <div class="l-cf7-field-parent b7-field-parent easy-build-cf7-light-field-parent" data-custom-validation="">
            <?php if ($show_label) : ?>
                <label><?php echo esc_html((string) $settings['label']); ?></label>
            <?php endif; ?>
            <span class="wpcf7-form-control-wrap" data-name="<?php echo esc_attr($field_name); ?>">
                <span class="wpcf7-form-control wpcf7-radio easy-build-cf7-light-form-check <?php echo esc_attr($layout_class); ?>">
                    <?php foreach ($select_values as $easy_build_cf7_light_index => $easy_build_cf7_light_value) : ?>
                        <?php
                        $easy_build_cf7_light_item_class = '';
                        if (0 === $easy_build_cf7_light_index) {
                            $easy_build_cf7_light_item_class = ' first';
                        } elseif (($values_count - 1) === $easy_build_cf7_light_index) {
                            $easy_build_cf7_light_item_class = ' last';
                        }
                        ?>
                        <span class="wpcf7-list-item<?php echo esc_attr($easy_build_cf7_light_item_class); ?>">
                            <?php if ($use_label) : ?>
                                <label>
                                    <input type="radio" name="<?php echo esc_attr((string) $settings['field_name']); ?>" value="<?php echo esc_attr((string) $easy_build_cf7_light_value); ?>">
                                    <span class="wpcf7-list-item-label"><?php echo esc_html((string) $easy_build_cf7_light_value); ?></span>
                                </label>
                            <?php else : ?>
                                <input type="radio" name="<?php echo esc_attr((string) $settings['field_name']); ?>" value="<?php echo esc_attr((string) $easy_build_cf7_light_value); ?>">
                            <?php endif; ?>
                        </span>
                    <?php endforeach; ?>
                </span>
            </span>
        </div>
        <?php
    }
}
