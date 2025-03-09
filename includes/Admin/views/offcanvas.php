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
    <h2 class="offcanvas-title"><?php echo esc_html__('Builder 7', 'builder7'); ?></h2>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x" viewBox="0 0 384 512"><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
    </button>
  </div>
  <div class="offcanvas-body">
    <div class="cf7-builder-container">
      <form action="" method="post" class="crete-post">
        <div class="cf7-builder-row">
          <label for="cf7-title"><?php echo esc_html__('Builder title', 'builder7'); ?></label>
          <input type="text" id="cf7-title" name="cf7-title" placeholder="Enter title">
        </div>
        
        <div class="cf7-builder-row">
          <label for="cf7-select"><?php echo esc_html__('Select Contact Form 7:', 'builder7'); ?></label>
          <select id="cf7-select" name="cf7-select">
            <option value=""><?php echo esc_html__('Select a form', 'builder7'); ?></option>
            <?php foreach (builder7_get_cf7_forms() as $form) : ?>
              <option value="<?php echo esc_attr($form['id']); ?>"><?php echo esc_html($form['title']); ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        
        <div class="cf7-builder-row">
          <a href="<?php echo esc_url(admin_url('admin.php?page=wpcf7')); ?>" target="_blank"><?php echo esc_html__('Create New Contact Form 7', 'builder7'); ?></a>
        </div>
        
        <input type="hidden" id="selected-layout" name="selected-layout" value="">
        
        <div class="layout-options">
          <h3><?php echo esc_html__('Select Layout', 'builder7'); ?></h3>
          <div class="layout-scroll-box">
              <div class="layout-row" >
                 <div class="layout-item" data-layout="">
                    <span><?php echo esc_html__('Start With Blank', 'builder7'); ?></span>
                </div>
              </div>
            <?php foreach ($layouts as $layout) : ?>
              <div class="layout-row">
                <div class="layout-item" data-layout="<?php echo esc_attr($layout['id']); ?>">
                  <img src="<?php echo esc_url(BUILDER7_ASSETS.'/layout/'.$layout['id'].'/'.$layout['preview_image']); ?>" alt="<?php echo esc_attr($layout['id']); ?>">
                  <a href="<?php echo esc_url($layout['preview_url']); ?>" target="_blank">
                    <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/></svg>
                      <?php echo esc_html__('Preview', 'builder7'); ?>
                    </span>
                  </a>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
        
        <button type="submit" id="cf7-builder-submit" class="button button-primary" disabled><?php echo esc_html__('Edit with Elementor', 'builder7'); ?></button>
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
        <button id="alert-button"><?php echo esc_html__('OK', 'builder7'); ?></button>
    </div>
</div>
