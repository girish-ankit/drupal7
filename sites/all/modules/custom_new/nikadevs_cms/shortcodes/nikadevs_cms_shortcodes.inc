<?php

function theme_nikadevs_cms_shortcode_pricing_table_col($vars) {
  global $pricing_table_cols;
  $attrs = $vars['attrs'];
  $text = $vars['text'];
  if (!is_array($pricing_table_cols)) {
    $pricing_table_cols = array();
  }
  global $pricing_table_rows;
  $attrs = shortcode_attrs(array(
      'title' => 'Basic',
      'currency' => '$',
      'link' => '<front>',
      'button' => t('Buy now'),
      'price' => '00',
      'price_text' => '',
      'class' => '',
      'animation' => '',
      'delay' => ''
    ),
    $attrs
  );
  $attrs['class'] .= ' plan';
  $link = strpos($attrs['link'], '#') === FALSE ? url($attrs['link']) : $attrs['link'];
  $btn_class = strpos($attrs['class'], 'popular') !== FALSE ? 'btn-primary' : 'btn-default';
  $text = '<div ' . _nikadevs_cms_shortcode_attributes($attrs)  . '>
    <header class="pricing-head">
      <h3>' . $attrs['title'] . '</h3>
      <span class="price"><sup>' . $attrs['currency'] . '</sup> ' . $attrs['price'] . '</span>
      <small>' . $attrs['price_text'] . '</small>
    </header>
    <div class="pricing-body">
      <ul>
        ' . $pricing_table_rows . '
      </ul>
    </div>
    <footer class="pricing-footer">
      <a href="' . $link .  '" class="btn ' . $btn_class . '">' . $attrs['button'] . '</a>
    </footer>
  </div>';
  $pricing_table_cols []= $text;
  $pricing_table_rows = '';
  return '';
}
