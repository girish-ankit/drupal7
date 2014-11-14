<?php
/**
 * @file
 * stability_features.features.filter.inc
 */

/**
 * Implements hook_filter_default_formats().
 */
function stability_features_filter_default_formats() {
  $formats = array();

  // Exported format: Embed HTML.
  $formats['embed_html'] = array(
    'format' => 'embed_html',
    'name' => 'Embed HTML',
    'cache' => 0,
    'status' => 1,
    'weight' => -9,
    'filters' => array(
      'shortcode_dynamic' => array(
        'weight' => 0,
        'status' => 1,
        'settings' => array(
          'quote' => 1,
          'progress' => 1,
          'accordions' => 1,
          'accordion' => 1,
          'delimiter' => 1,
          'spacer' => 1,
          'row' => 1,
          'col' => 1,
          'message' => 1,
          'tabs' => 1,
          'tab' => 1,
          'button' => 1,
          'call_to_action' => 1,
          'icon_box' => 1,
          'pricing_table' => 1,
          'pricing_table_col' => 1,
          'pricing_table_row' => 1,
          'dropcap' => 1,
          'view' => 1,
          'block' => 1,
          'featured_boxes' => 1,
          'featured_box' => 1,
          'video' => 1,
          'shape_box' => 1,
        ),
      ),
      'shortcode_text_corrector' => array(
        'weight' => 0,
        'status' => 1,
        'settings' => array(),
      ),
    ),
  );

  // Exported format: Full HTML.
  $formats['full_html'] = array(
    'format' => 'full_html',
    'name' => 'Full HTML',
    'cache' => 1,
    'status' => 1,
    'weight' => -10,
    'filters' => array(
      'filter_url' => array(
        'weight' => 0,
        'status' => 1,
        'settings' => array(
          'filter_url_length' => 72,
        ),
      ),
      'shortcode' => array(
        'weight' => 0,
        'status' => 1,
        'settings' => array(
          'quote' => 1,
          'progress' => 1,
          'accordions' => 1,
          'accordion' => 1,
          'delimiter' => 1,
          'spacer' => 1,
          'row' => 1,
          'col' => 1,
          'message' => 1,
          'tabs' => 1,
          'tab' => 1,
          'button' => 1,
          'call_to_action' => 1,
          'icon_box' => 1,
          'pricing_table' => 1,
          'pricing_table_col' => 1,
          'pricing_table_row' => 1,
          'dropcap' => 1,
          'view' => 1,
          'block' => 1,
          'featured_boxes' => 1,
          'featured_box' => 1,
          'video' => 1,
          'shape_box' => 1,
        ),
      ),
      'shortcode_text_corrector' => array(
        'weight' => 0,
        'status' => 1,
        'settings' => array(),
      ),
    ),
  );

  return $formats;
}
