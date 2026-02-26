<?php 
if (!defined('ABSPATH')) {
    exit;
}
?>
<div class="l-cf7-field-parent" data-custom-validation="">
    <?php if($settings['show_label']) { ?>
        <p><label for="<?php echo esc_attr($settings['field_id']); ?>"><?php echo esc_html($settings['label']); ?></label><br>
    <?php } ?>
    <span class="wpcf7-form-control-wrap" data-name="<?php echo esc_attr($attributes['field_name']); ?>">
        <span class="wpcf7-form-control wpcf7-radio easy-build-cf7-light-form-check <?php echo esc_attr($layout_class); ?>">
            <?php 
            foreach($select_values as $easy_build_cf7_light_index => $easy_build_cf7_light_value) {
                $easy_build_cf7_light_item_class = '';
                if($easy_build_cf7_light_index === 0) {
                    $easy_build_cf7_light_item_class = ' first';
                } else if($easy_build_cf7_light_index === count($select_values) - 1) {
                    $easy_build_cf7_light_item_class = ' last';
                }
            ?>
                <span class="wpcf7-list-item<?php echo esc_attr($easy_build_cf7_light_item_class); ?>">
                    <?php if ($settings['first_item'] === 'yes') { ?>
                        <label>
                            <input type="radio" name="<?php echo esc_attr($settings['field_name']); ?>" value="<?php echo esc_attr($easy_build_cf7_light_value); ?>">
                            <span class="wpcf7-list-item-label"><?php echo esc_html($easy_build_cf7_light_value); ?></span>
                        </label>
                    <?php } else { ?>
                        <input type="radio" name="<?php echo esc_attr($settings['field_name']); ?>" value="<?php echo esc_attr($easy_build_cf7_light_value); ?>">
                    <?php } ?>
                </span>
            <?php } ?>
        </span>
    </span>
    </p>
</div>