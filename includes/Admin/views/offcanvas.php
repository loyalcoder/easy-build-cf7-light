<?php
  /**
   * Prevent direct access to this file.
   * Exit if accessed directly.
   */
  if (!defined('ABSPATH')) {
    exit;
  }
?>
<div class="offcanvas offcanvas-end" tabindex="-1" id="myCanvas">
  <div class="offcanvas-header">
    <h2 class="offcanvas-title"><?php echo esc_html__('Easy Build CF7', 'easy-build-cf7-light'); ?></h2>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x" viewBox="0 0 384 512"><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
    </button>
  </div>
  <div class="offcanvas-body">
    <div class="cf7-builder-container">
      <form action="" method="post" class="crete-post">
        <div class="cf7-builder-row">
          <label for="cf7-title"><?php echo esc_html__('Builder title', 'easy-build-cf7-light'); ?></label>
          <input type="text" id="cf7-title" name="cf7-title" placeholder="Enter title">
        </div>
        
        <div class="cf7-builder-row">
          <label for="cf7-select"><?php echo esc_html__('Select Contact Form 7:', 'easy-build-cf7-light'); ?></label>
          <select id="cf7-select" name="cf7-select">
            <option value=""><?php echo esc_html__('Select a form', 'easy-build-cf7-light'); ?></option>
            <?php foreach (easy_build_cf7_light_get_forms() as $form) : ?>
              <option value="<?php echo esc_attr($form['id']); ?>"><?php echo esc_html($form['title']); ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        
        <div class="cf7-builder-row">
          <a href="<?php echo esc_url(admin_url('admin.php?page=wpcf7')); ?>" target="_blank"><?php echo esc_html__('Create New Contact Form 7', 'easy-build-cf7-light'); ?></a>
        </div>
        
        <input type="hidden" id="selected-layout" name="selected-layout" value="">
        
        <div class="layout-options">
          <h3><?php echo esc_html__('Select Layout', 'easy-build-cf7-light'); ?></h3>
          <div class="layout-scroll-box">
              <div class="layout-row" >
                 <div class="layout-item" data-layout="">
                    <span><?php echo esc_html__('Start With Blank', 'easy-build-cf7-light'); ?></span>
                </div>
              </div>
            <?php foreach ($layouts as $layout) : ?>
              <div class="layout-row">
                <div class="layout-item" data-layout="<?php echo esc_attr($layout['id']); ?>">
                  <img src="<?php echo esc_url(EASY_BUILD_CF7_LIGHT_ASSETS.'/layout/'.$layout['id'].'/'.$layout['preview_image']); ?>" alt="<?php echo esc_attr($layout['id']); ?>">
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
        
        <button type="submit" id="cf7-builder-submit" class="button button-primary" disabled><?php echo esc_html__('Edit with Elementor', 'easy-build-cf7-light'); ?></button>
      </form>
      <div class="edit-with-elementor"></div>
    </div>
  </div>
</div>

<div id="custom-alert" class="custom-alert">
    <div class="alert-content">
        <div id="alert-icon" class="alert-icon"></div>
        <h2 id="alert-title"></h2>
        <p id="alert-message"></p>
        <button id="alert-button"><?php echo esc_html__('OK', 'easy-build-cf7-light'); ?></button>
    </div>
</div>
