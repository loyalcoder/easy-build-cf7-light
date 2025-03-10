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
            foreach($select_values as $index => $value) {
                $item_class = '';
                if($index === 0) {
                    $item_class = ' first';
                } else if($index === count($select_values) - 1) {
                    $item_class = ' last';
                }
            ?>
                <span class="wpcf7-list-item<?php echo esc_attr($item_class); ?>">
                    <?php if ($settings['first_item'] === 'yes') { ?>
                        <label>
                            <input type="radio" name="<?php echo esc_attr($settings['field_name']); ?>" value="<?php echo esc_attr($value); ?>">
                            <span class="wpcf7-list-item-label"><?php echo esc_html($value); ?></span>
                        </label>
                    <?php } else { ?>
                        <input type="radio" name="<?php echo esc_attr($settings['field_name']); ?>" value="<?php echo esc_attr($value); ?>">
                    <?php } ?>
                </span>
            <?php } ?>
        </span>
    </span>
    </p>
</div>