<?php
/**
 * Implements hook_form_FORM_ID_alter().
 *
 * @param $form
 *   The form.
 * @param $form_state
 *   The form state.
 */
function stability_form_system_theme_settings_alter(&$form, &$form_state) {
  drupal_add_css(drupal_get_path('theme', 'stability') . '/css/theme-settings.css');
  $form['options'] = array(
    '#type' => 'vertical_tabs',
    '#default_tab' => 'main',
    '#weight' => '-10',
    '#title' => t('EnjoyIt Theme settings'),
  );

  if(module_exists('nikadevs_cms')) {
    $form['options']['nd_layout_builder'] = nikadevs_cms_layout_builder();
  }
  else {
    drupal_set_message('Enable NikaDevs CMS module to use layout builder.');
  }

  $form['options']['main'] = array(
    '#type' => 'fieldset',
    '#title' => t('Main settings'),
  );
  $form['options']['main']['home_title'] = array(
    '#type' => 'textfield',
    '#title' => t('Homepage Title'),
    '#default_value' => theme_get_setting('home_title') ? theme_get_setting('home_title') : t('Welcome to @sitename', array('@sitename' => variable_get('site_name', ''))),
  );
  $form['options']['main']['login_account_links'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable Login & Account Links'),
    '#default_value' => theme_get_setting('login_account_links'),
    '#description'   => t("Login or Account links placed on the top right header."),
  );
  $form['options']['main']['support'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable Support button'),
    '#default_value' => theme_get_setting('support'),
    '#description'   => t("Support button allow you send message to our support email. For user roles with checked permission 'Use NikaDevs CMS'."),
  );
  $form['options']['main']['retina'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable Retina Script'),
    '#default_value' => theme_get_setting('retina'),
    '#description'   => t("Only for retina displays and for manually added images. The script will check if the same image with suffix @2x exists and will show it."),
  );

  $form['options']['main']['header'] = array(
    '#type' => 'select',
    '#title' => t('Header Version'),
    '#options' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6),
    '#default_value' => theme_get_setting('header'),
  );
  $form['options']['main']['sub_header'] = array(
    '#type' => 'select',
    '#title' => t('Page Header Version'),
    '#options' => array(1 => t('Default'), 2 => t('Search'), 3 => t('Image'), 4 => t('Parallax'), 5 => t('Slideshow')),
    '#default_value' => theme_get_setting('sub_header'),
  );

  $images = variable_get(variable_get('theme_default', 'none') . '_sub_headers', array());  

  $form['options']['main']['images_wrap'] = array(
    '#type' => 'container',
    '#states' => array(
      'visible' => array(
        ':input[name="sub_header"], .a' => array('!value' => 1),
        ':input[name="sub_header"], .ab' => array('!value' => 2),
      )
    )
  );

  if($images) {
    $form['options']['main']['images_wrap']['sub_header_images'] = array(
      '#type' => 'vertical_tabs',
      '#title' => t('Sub Header images'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
      '#tree' => TRUE,
    );
    $i = 0;
    foreach ($images as $image_data) {
      $form['options']['main']['images_wrap']['sub_header_images'][] = array(
        '#type' => 'fieldset',
        '#title' => t('Sub Header Image !number', array('!number' => ++$i)),
        '#collapsible' => TRUE,
        '#collapsed' => FALSE,
        '#tree' => TRUE,
        'image' => _stability_banner_form($image_data),
      );
    }
  }
  $form['options']['main']['images_wrap']['image_upload'] = array(
    '#type' => 'file',
    '#title' => t('Upload a new header image'),
  );
  $form['#submit'][] = 'stability_settings_submit';
  $form['options']['main']['pager'] = array(
    '#type' => 'select',
    '#title' => t('Pagination Version'),
    '#options' => array(1 => t('Default'), 2 => t('Big'), 3 => t('Medium'), 4 => t('Small')),
    '#default_value' => theme_get_setting('pager'),
  );
  $form['options']['main']['maintenance_end'] = array(
    '#type' => 'textfield',
    '#title' => t('Maintenance Countdown end'),
    '#description' => t('Format: 19 June 2014 16:24:00'),
    '#default_value' => theme_get_setting('maintenance_end'),
  );
  $form['options']['main']['flickr_id'] = array(
    '#type' => 'textfield',
    '#title' => t('Flickr Id'),
    '#default_value' => theme_get_setting('flickr_id'),
  );

  $form['options']['contact'] = array(
    '#type' => 'fieldset',
    '#title' => t('Contacts'),
  );
  $form['options']['contact']['address'] = array(
    '#type' => 'textarea',
    '#rows' => 3,
    '#title' => t('Address'),
    '#default_value' => theme_get_setting('address'),
  );
  $form['options']['contact']['phones'] = array(
    '#type' => 'textarea',
    '#rows' => 3,
    '#title' => t('Phones numbers'),
    '#default_value' => theme_get_setting('phones'),
  );
  $form['options']['contact']['email'] = array(
    '#type' => 'textarea',
    '#rows' => 3,
    '#title' => t('Email'),
    '#default_value' => theme_get_setting('email'),
  );
  $form['options']['contact']['skype'] = array(
    '#type' => 'textarea',
    '#rows' => 3,
    '#title' => t('Skype names'),
    '#default_value' => theme_get_setting('skype'),
  );
  $form['options']['contact']['working_time'] = array(
    '#type' => 'textarea',
    '#rows' => 3,
    '#title' => t('Working Time'),
    '#default_value' => theme_get_setting('working_time'),
  );

  $form['options']['gmap'] = array(
    '#type' => 'fieldset',
    '#title' => t('Google Map Settings'),
  );
  $form['options']['gmap']['gmap_lat'] = array(
    '#type' => 'textfield',
    '#title' => t('Google Map Latitude'),
    '#default_value' => theme_get_setting('gmap_lat'),
    '#size' => 12
  );
  $form['options']['gmap']['gmap_lng'] = array(
    '#type' => 'textfield',
    '#title' => t('Google Map Longitude'),
    '#default_value' => theme_get_setting('gmap_lng'),
    '#size' => 12
  );
  $form['options']['gmap']['gmap_zoom'] = array(
    '#type' => 'textfield',
    '#title' => t('Google Map Zoom'),
    '#default_value' => theme_get_setting('gmap_zoom'),
    '#size' => 6
  );


  $form['options']['color'] = array(
    '#type' => 'fieldset',
    '#title' => t('Color & Layout'),
  );
  $form['options']['color']['skin'] = array(
    '#type' => 'radios',
    '#title' => t('Skin'),
    '#default_value' => theme_get_setting('skin'),
    '#options' => array('asbestos' => 'asbestos', 'blue' => 'blue', 'green' => 'green', 'orange' => 'orange', 'red' => 'red', 'silver' => 'silver', 'violet' => 'violet', 'yellow' => 'yellow')
  );
  $form['options']['color']['layout'] = array(
    '#type' => 'radios',
    '#title' => t('Layout'),
    '#default_value' => theme_get_setting('layout'),
    '#options' => array('wide' => 'Wide', 'boxed' => 'Boxed')
  );
  $form['options']['color']['pattern'] = array(
    '#type' => 'radios',
    '#title' => t('Pattern'),
    '#default_value' => theme_get_setting('pattern'),
    '#options' => array('brickwall' => 'brickwall', 'cream_pixels' => 'cream_pixels', 'grey_wash_wall' => 'grey_wash_wall', 'greyzz' => 'greyzz', 'mooning' => 'mooning',
      'p5' => 'p5', 'retina_wood' => 'retina_wood', 'shattered' => 'shattered', 'sos' => 'sos', 'squared_metal' => 'squared_metal', 'subtle_grunge' => 'subtle_grunge', 'binding_dark' => 'binding_dark'),
    '#description' => t('Background for "Boxed" layout.')
  );

  $form['options']['social_links'] = array(
    '#type' => 'fieldset',
    '#title' => t('Social Links'),
  );
  $form['options']['social_links']['social_links_facebook_enabled'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show Facebook link'),
    '#default_value' => theme_get_setting('social_links_facebook_enabled'),
  );
  $form['options']['social_links']['social_links_facebook_link'] = array(
    '#type' => 'textfield',
    '#title' => t('Facebook link'),
    '#default_value' => theme_get_setting('social_links_facebook_link'),
    '#states' => array(
      // Hide the options when the cancel notify checkbox is disabled.
      'visible' => array(
        ':input[name="social_links_facebook_enabled"]' => array('checked' => TRUE),
      ),
    ),
  );
  $form['options']['social_links']['social_links_twitter_enabled'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show Twitter link'),
    '#default_value' => theme_get_setting('social_links_twitter_enabled'),
  );
  $form['options']['social_links']['social_links_twitter_link'] = array(
    '#type' => 'textfield',
    '#title' => t('Twitter link'),
    '#default_value' => theme_get_setting('social_links_twitter_link'),
    '#states' => array(
      // Hide the options when the cancel notify checkbox is disabled.
      'visible' => array(
        ':input[name="social_links_twitter_enabled"]' => array('checked' => TRUE),
      ),
    ),
  );
  $form['options']['social_links']['social_links_instagram_enabled'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show Instagram link'),
    '#default_value' => theme_get_setting('social_links_instagram_enabled'),
  );
  $form['options']['social_links']['social_links_instagram_link'] = array(
    '#type' => 'textfield',
    '#title' => t('Instagram link'),
    '#default_value' => theme_get_setting('social_links_instagram_link'),
    '#states' => array(
      // Hide the options when the cancel notify checkbox is disabled.
      'visible' => array(
        ':input[name="social_links_instagram_enabled"]' => array('checked' => TRUE),
      ),
    ),
  );
  $form['options']['social_links']['social_links_linkedin_enabled'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show Linked Ins link'),
    '#default_value' => theme_get_setting('social_links_linkedin_enabled'),
  );
  $form['options']['social_links']['social_links_linkedin_link'] = array(
    '#type' => 'textfield',
    '#title' => t('Linked In link'),
    '#default_value' => theme_get_setting('social_links_linkedin_link'),
    '#states' => array(
      // Hide the options when the cancel notify checkbox is disabled.
      'visible' => array(
        ':input[name="social_links_linkedin_enabled"]' => array('checked' => TRUE),
      ),
    ),
  );
  $form['options']['social_links']['social_links_xing_enabled'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show Xing link'),
    '#default_value' => theme_get_setting('social_links_xing_enabled'),
  );
  $form['options']['social_links']['social_links_xing_link'] = array(
    '#type' => 'textfield',
    '#title' => t('Xing link'),
    '#default_value' => theme_get_setting('social_links_xing_link'),
    '#states' => array(
      // Hide the options when the cancel notify checkbox is disabled.
      'visible' => array(
        ':input[name="social_links_xing_enabled"]' => array('checked' => TRUE),
      ),
    ),
  );
  $form['options']['social_links']['social_links_rss_enabled'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show Rss link'),
    '#default_value' => theme_get_setting('social_links_rss_enabled'),
  );
  $form['options']['social_links']['social_links_rss_link'] = array(
    '#type' => 'textfield',
    '#title' => t('Rss link'),
    '#default_value' => theme_get_setting('social_links_rss_link'),
    '#states' => array(
      // Hide the options when the cancel notify checkbox is disabled.
      'visible' => array(
        ':input[name="social_links_rss_enabled"]' => array('checked' => TRUE),
      ),
    ),
  );
}

function _stability_banner_form($image_data) {
  $img_form = array();
  $img_form['image_preview'] = array(
    '#markup' => theme('image_style', array('style_name' => 'large', 'path' => $image_data['image_path'])),
  );
  $img_form['image_path'] = array(
    '#type' => 'hidden',
    '#value' => $image_data['image_path'],
  );
  $img_form['fid'] = array(
    '#type' => 'hidden',
    '#value' => isset($image_data['fid']) ? $image_data['fid'] : 0,
  );
  $img_form['image_delete'] = array(
    '#type' => 'checkbox',
    '#title' => t('Delete image'),
    '#default_value' => FALSE,
  );
  return $img_form;
}

/**
 * Save settings data.
 */
function stability_settings_submit($form, &$form_state) {
  $settings = array();

  if(isset($form_state['input']['sub_header_images'])) {
    foreach ($form_state['input']['sub_header_images'] as $image) {
      if (is_array($image)) {
        $image = $image['image'];
        if ($image['image_delete']) {
          $image['fid'] ? file_delete(file_load($image['fid'])) : file_unmanaged_delete($image['image_path']);
        } else {
          $settings[] = $image;
        }
      }
    }
  }
  if ($file = file_save_upload('image_upload', array(), 'public://')) {
    $settings[] = array('fid' => $file->fid, 'image_path' => $file->uri);
  }
  variable_set(variable_get('theme_default', 'none') . '_sub_headers', $settings);
}