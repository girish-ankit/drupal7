<?php 

function _nikadevs_cms_shortcode_attributes($attrs) {
  $allowed_attributes = array('animation' => 'data-animation', 'delay' => 'data-animation-delay', 'class' => 'class', 'href' => 'href', 'stellar_ratio' => 'data-stellar-ratio', 'background_ratio' => 'data-stellar-background-ratio');
  $output = '';
  foreach($attrs as $name => $value) {
    if(isset($allowed_attributes[$name])) { 
      $name = $allowed_attributes[$name];
      $value = trim($value);
      if ($value !== '') {
        $output .= " $name = '$value'";
      }
    }
  }
  return $output;
}

function nikadevs_cms_shortcode_quote($attrs, $text) {
  $author = '';
  if(isset($attrs['author'])) {
    $author .= '<div class="bq-author"' . _nikadevs_cms_shortcode_attributes($attrs) . '>
      <h6>' . $attrs['author'] . '</h6>
      <span class="bq-author-info">' . $attrs['position'] . '</span>
    </div>';
  }
  $attrs['class'] = isset($attrs['class']) ? $attrs['class'] : '';
  $attrs['class'] .= isset($attrs['author']) ? 'testimonial' : '';
  return '<blockquote ' . _nikadevs_cms_shortcode_attributes($attrs) . '>' . $text . '</blockquote>' . $author;
}

function nikadevs_cms_shortcode_quote_tip($format, $long) {
  $output = array();
  $output[] = '<p>All elements supports <strong>class</strong>, <strong>animation</strong> and <strong>delay</strong> attributes. Supports all <a href = "http://daneden.github.io/animate.css/">animation.css</a> values. Delay value in ms. ';
  $output[] = '<p><strong>Quote:</strong><br/>[quote author = "Author Name" position = "Position"]text[/quote]';
  if ($long) {
    $output[] = '<strong>author</strong> - Author name<br/>. <strong>position</strong> -  position name.</p>';
  }

  return implode(' ', $output);
}


function nikadevs_cms_shortcode_progress($attrs, $text) {
  $inner_class = (isset($attrs['class']) ? $attrs['class'] : '') ;
  $attrs['class'] = 'progress' . (isset($attrs['type']) ? ' progress-' . $attrs['type'] : '');
  $text .= '<div ' . _nikadevs_cms_shortcode_attributes($attrs) . '>
    <div class = "progress-bar ' . $inner_class  . '" role="progressbar" aria-valuenow="' . $attrs['percent'] . '" aria-valuemin="0" aria-valuemax="100" style="width: ' . $attrs['percent'] .'%;">
      <span class="progress-label">' . $attrs['title'] . '</span>
      ' . $attrs['percent'] .'%
    </div>
  </div>';
  return $text;
}

function nikadevs_cms_shortcode_progress_tip($format, $long) {
  $output = array();
  $output[] = '<p><strong>Progress bar:</strong><br/>[progress title = "Design" percent = "90" type = "striped"][/progress]</br>';
  $output[] = t('Types allowed: ') . '<strong>striped</strong> and <strong>striped active</strong><br/>';
  $output[] = t('Allowed classes:') . ' <strong>progress-bar-success</strong>, <strong>progress-bar-info</strong>, <strong>progress-bar-warning</strong>,<strong>progress-bar-danger</strong></p>';
  return implode(' ', $output);
}

function nikadevs_cms_shortcode_accordions($attrs, $text) {
  $attrs['class'] = 'panel-group ' . (isset($attrs['class']) ? $attrs['class'] : '');
  $text = '<div ' . _nikadevs_cms_shortcode_attributes($attrs)  . ' id = "accordion">' . $text . '</div>';
  return $text;
}

function nikadevs_cms_shortcode_accordions_tip($format, $long) {
  $output = array();
  $output[] = '<p><strong>Accordion:</strong><br/>[accordions]<br/>&nbsp;&nbsp;[accordion title = "Accordion Panel #1"]Text[/accordion]<br/>[/accordions]';
  return implode(' ', $output);
}

function nikadevs_cms_shortcode_accordion($attrs, $text) {
  global $accordion_count;
  $accordion_count++;
  $attrs['class'] = 'panel panel-default ' . (isset($attrs['class']) ? $attrs['class'] : '');
  $text = '<div ' . _nikadevs_cms_shortcode_attributes($attrs)  . '>
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" class = "' . (in_array('active', $attrs) ? '' : 'collapsed') . '" data-parent="#accordion" href="#accordion-' .  $accordion_count . '">
          ' . $attrs['title'] . '
        </a>
      </h4>
    </div>
    <div id="accordion-' . $accordion_count . '" class="panel-collapse collapse' . (in_array('active', $attrs) ? ' in' : '') . '">
      <div class="panel-body">
        ' . $text . '
      </div>
    </div>
  </div>';
  return $text;
}

function nikadevs_cms_shortcode_delimiter($attrs, $text) {
  $attrs['class'] = 'lg ' . (isset($attrs['class']) ? $attrs['class'] : '');
  $text = '<hr ' . _nikadevs_cms_shortcode_attributes($attrs)  . '/>';
  return $text;
}

function nikadevs_cms_shortcode_delimiter_tip($format, $long) {
  $output = array();
  $output[] = '<p><strong>Delimiter line:</strong><br/>[delimiter][/delimiter]</p>';
  return implode(' ', $output);
}

function nikadevs_cms_shortcode_spacer($attrs, $text) {
  $attrs['class'] = 'spacer ' . (isset($attrs['class']) ? $attrs['class'] : '');
  $text = '<div ' . _nikadevs_cms_shortcode_attributes($attrs)  . '/></div>';
  return $text;
}

function nikadevs_cms_shortcode_spacer_tip($format, $long) {
  $output = array();
  $output[] = '<p><strong>Spacer:</strong><br/>[spacer][/spacer]</p>';
  return implode(' ', $output);
}

function nikadevs_cms_shortcode_row($attrs, $text) {
  $attrs['class'] = 'row ' . (isset($attrs['class']) ? $attrs['class'] : '');
  $text = '<div ' . _nikadevs_cms_shortcode_attributes($attrs) .'>' . $text . '</div>';
  return $text;
}

function nikadevs_cms_shortcode_row_tip($format, $long) {
  $output = array();
  $output[] = '<p><strong>Responsive columns:</strong><br/>[row]<br/>[col phone = 12 tablet = 12 desktop = 6 wide = 6]Content with date[/col][/row]</br>';
  $output[] = 'Describe how many rows will take col in different devices: phone, tablet, desktop, wide. From 1 to 12 rows.</p>';
  return implode(' ', $output);
}

function nikadevs_cms_shortcode_col($attrs, $text) {
  $attrs['class'] = isset($attrs['class']) ? $attrs['class'] : '';
  if(isset($attrs['phone'])) {
    $attrs['class'] .= ' col-xs-' . $attrs['phone'];
  }
  if(isset($attrs['tablet'])) {
    $attrs['class'] .= ' col-sm-' . $attrs['tablet'];
  }
  if(isset($attrs['desktop'])) {
    $attrs['class'] .= ' col-md-' . $attrs['desktop'];
  }
  if(isset($attrs['wide'])) {
    $attrs['class'] .= ' col-lg-' . $attrs['wide'];
  }
  $text = '<div ' . _nikadevs_cms_shortcode_attributes($attrs) . '>' . $text . '</div>';
  return $text;
}

function nikadevs_cms_shortcode_message($attrs, $text) {
  $attrs['class'] = 'alert ' . (isset($attrs['class']) ? $attrs['class'] : '');
  $text = '<div ' . _nikadevs_cms_shortcode_attributes($attrs)  . '><button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-times"></i></button>' . $text . '</div>';
  return $text;
}

function nikadevs_cms_shortcode_message_tip($format, $long) {
  $output = array();
  $output[] = '<p><strong>Message box:</strong><br/>[message][/message]</br>';
  $output[] = 'Available classes: alert-danger, alert-info, alert-warning, alert-success, alert-dismissable.</p>';
  return implode(' ', $output);
}

function nikadevs_cms_shortcode_tabs($attrs, $text) {
  global $tab_content;
  $attrs['class'] = 'tabs ' . (isset($attrs['class']) ? $attrs['class'] : '');
  $text = '<div ' . _nikadevs_cms_shortcode_attributes($attrs)  . '>
    <ul class = "nav nav-tabs">' .
      $text .
    '</ul>
    <div class = "tab-content">' .
      $tab_content .
    '</div>
    </div>';
  $tab_content = '';
  return $text;
}

function nikadevs_cms_shortcode_tabs_tip($format, $long) {
  $output = array();
  $output[] = '<p><strong>Tabs:</strong><br/>[tabs]<br/>[tab title = "title" icon = "fa fa-user"]Text[/tab][/tabs]</br>';
  $output[] = 'Available variables: <strong>title</strong> - tabs of the title, <strong>icon</strong> - font class of the icon.</p>';
  return implode(' ', $output);
}

function nikadevs_cms_shortcode_tab($attrs, $text) {
  global $tab_counter;
  global $tab_content;
  $tab_counter++;
  $attrs['class'] = isset($attrs['class']) ? $attrs['class'] : '';
  $attrs['class'] .= $tab_counter == 1 ? ' active' : '';
  $class = shortcode_add_class($attrs['class']);
  $icon = isset($attrs['icon']) ? '<i class = "' . $attrs['icon'] .'"></i>' : '';
  $output = '<li ' . _nikadevs_cms_shortcode_attributes($attrs)  . '><a href = "#tab-' . $tab_counter . '" data-toggle = "tab">' . $icon . (isset($attrs['title']) ? $attrs['title'] : '') . '</a></li>';

  if($tab_counter == 1) {
    $class .= ' in';
  }
  $tab_content .= '<div class="tab-pane fade ' . $class .  '" id="tab-' . $tab_counter . '">' . $text . '</div>';

  return $output;
}

function nikadevs_cms_shortcode_button($attrs, $text) {
  $attrs['class'] = 'btn ' . (isset($attrs['class']) ? $attrs['class'] : '');
  $class = shortcode_add_class($attrs['class']);
  $attrs['href'] = strpos($attrs['link'], '#') === FALSE ? url($attrs['link']) : $attrs['link'];
  $text = '<a ' . _nikadevs_cms_shortcode_attributes($attrs)  . '>' . $text . '</a>';
  return $text;
}

function nikadevs_cms_shortcode_button_tip($format, $long) {
  $output = array();
  $output[] = '<p><strong>Button Link:</strong><br/>[button class="btn-lg btn-default" link = "contact"]Text[/button]</br>';
  $output[] = '<strong>link</strong> - URL to linked content.</br>';
  $output[] = 'Available size classes: <strong>btn-lg</strong> - Big, <strong>btn-sm</strong> - Small, by default - Medium.</br>';
  $output[] = 'Available color classes: <strong>btn-default</strong>, <strong>btn-primary</strong>, <strong>btn-info</strong>, <strong>btn-success</strong>, <strong>btn-warning</strong>, <strong>btn-danger</strong></p>';
  return implode(' ', $output);
}

function nikadevs_cms_shortcode_calltoaction($attrs, $text) {
  $attrs['class'] = 'call-to-action ' . (isset($attrs['class']) ? $attrs['class'] : '');
  $link = strpos($attrs['link'], '#') === FALSE ? url($attrs['link']) : $attrs['link'];
  $link_class = isset($attrs['link_class']) ? $attrs['link_class'] : 'btn-primary';
  $link_text = isset($attrs['link_text']) ? $attrs['link_text'] : t('Read More');
  $text = '<div ' . _nikadevs_cms_shortcode_attributes($attrs)  . '>
    <div class="cta-txt">
      ' . $text . '
    </div>
    <div class="cta-btn">
      <a class="btn ' . $link_class . '" href = "' . $link . '">' . $link_text . '</a>
    </div>
  </div>';
  return $text;
}

function nikadevs_cms_shortcode_calltoaction_tip($format, $long) {
  $output = array();
  $output[] = '<p><strong>Call to action:</strong><br/>[call_to_action class="centered" link = "contact" link_text = "Read More"]Text[/call_to_action]</br>';
  $output[] = '<strong>link</strong> - URL to linked content.</br>';
  $output[] = '<strong>link_text</strong> - Text on the link button. By default - "Read More"</br>';
  $output[] = '<strong>link_class</strong> - Link button classes (see button section). By default - "btn-primary"</br>';
  $output[] = 'Available classes: <strong>centered</strong> - Align text and link to center</p>';
  return implode(' ', $output);
}

function nikadevs_cms_shortcode_iconbox($attrs, $text) {
  $attrs['class'] = 'icon-box ' . (isset($attrs['class']) ? $attrs['class'] : '');
  $class = shortcode_add_class($attrs['class']);
  $text = '<div ' . _nikadevs_cms_shortcode_attributes($attrs)  . '>
    <div class="icon">
      <i class="' . $attrs['icon'] . '"></i>' .
      (isset($attrs['bg_icon']) || in_array('bg_icon', $attrs) ? '<i class="' . (isset($attrs['bg_icon']) ? $attrs['bg_icon'] : $attrs['icon']) . ' bg-icon"></i>': '') . '
    </div>
    <div class="icon-box-body">
      ' . $text . '
    </div>
  </div>';
  return $text;
}

function nikadevs_cms_shortcode_iconbox_tip($format, $long) {
  $output = array();
  $output[] = '<p><strong>Icon Box:</strong><br/>[icon_box class="centered" icon = "fa fa-user" big_icon]Text[/icon_box]</br>';
  $output[] = 'Available attributes: <strong>icon</strong> - Icon font class, <strong>bg_icon</strong> - Big half-transparent icon on the background</br>';
  $output[] = 'Available classes: <strong>centered</strong> - Align text and icon to center, <strong>circled</strong> - Round Icon, <strong>squared</strong> - Square styled icon, <strong>icon-box-animated</strong> - Mouse hover animation.</p>';
  return implode(' ', $output);
}

function nikadevs_cms_shortcode_pricing_table($attrs, $text) {
  global $pricing_table_cols;
  $attrs['class'] = 'pricing-table ' . (isset($attrs['class']) ? $attrs['class'] : '');
  $output = '<div class = "row"><div ' . _nikadevs_cms_shortcode_attributes($attrs)  . '>';
  $bootstrap_class = array(1 => 12, 2 => 6, 3 => 4, 4 => 3, 6 => 2);
  $col_class = $bootstrap_class[count($pricing_table_cols)];
  foreach($pricing_table_cols as $col) {
    $output .= '<div class = "col-md-' . $col_class . '">' . $col . '</div>';
  }
  $output .= '</div></div>';
  $pricing_table_cols = array();
  return $output;
}

function nikadevs_cms_shortcode_pricing_table_col($attrs, $text) {
  theme('nikadevs_cms_shortcode_pricing_table_col', array('attrs' => $attrs, 'text' => $text));
  return '';
}

function nikadevs_cms_shortcode_pricing_table_tip($format, $long) {
  $output = array();
  $output[] = '<p><strong>Pricing Table:</strong><br/>[pricing_table title = "Basic" class = "active" price = "19" currency = "$" price_text = "per month"]<br/>
  &nbsp;[pricing_table_row]Text[/pricing_table_row]<br/>
  [/pricing_table]</br>';
  $output[] = 'Available variables: <strong>title</strong> - Column title, <strong>price</strong>, <strong>currency</strong>, <strong>price_text</strong> - Price description, <strong>button</strong> - Link Button text, <strong>link</strong> - Button link.<br/>';
  $output[] = 'Available classes: <strong>popular</strong> - highlited column.</p>';
  return implode(' ', $output);
}

function nikadevs_cms_shortcode_pricing_table_row($attrs, $text) {
  global $pricing_table_rows;
  $attrs['class'] = isset($attrs['class']) ? $attrs['class'] : '';
  $pricing_table_rows .= '<li ' . _nikadevs_cms_shortcode_attributes($attrs)  . '>' . $text . '</li>';
  return '';
}

function nikadevs_cms_shortcode_dropcap($attrs, $text) {
  $attrs['class'] = 'dropcap ' . (isset($attrs['class']) ? $attrs['class'] : '');
  $text = '<span ' . _nikadevs_cms_shortcode_attributes($attrs)  . ' >' . $text . '</span>';
  return $text;
}

function nikadevs_cms_shortcode_dropcap_tip($format, $long) {
  $output = array();
  $output[] = '<p><strong>Dropcap:</strong><br/>[dropcap class="dropcap__rounded"]H[/dropcap]</br>';
  $output[] = 'Available size classes: <strong>dropcap__rounded</strong>Round Dropcap</p>';
  return implode(' ', $output);
}

function nikadevs_cms_shortcode_view($attrs, $text) {
  $attrs['class'] = isset($attrs['class']) ? $attrs['class'] : '';
  if (strpos($attrs['admin_url'], 'admin/structure/views/view') !== FALSE) {
    $view_name = substr($attrs['admin_url'], strpos($attrs['admin_url'], 'view/') + 5);
    $parts = explode('/', $view_name);
    $view_name = $parts[0];
    $view = isset($parts[2]) ? views_embed_view($view_name, $parts[2]) : views_embed_view($view_name);
  }
  $text = '<div ' . _nikadevs_cms_shortcode_attributes($attrs)  . '>' . $view . '</div>';
  return $text;
}

function nikadevs_cms_shortcode_view_tip($format, $long) {
  $output = array();
  $output[] = '<p><strong>View embed:</strong><br/>[view admin_url="admin/structure/views/view/blog"][/view]</br>';
  $output[] = '<strong>admin_url</strong> - Administrative url of required view display.</p>';
  return implode(' ', $output);
}

function nikadevs_cms_shortcode_block($attrs, $text) {
  $attrs['class'] = isset($attrs['class']) ? $attrs['class'] : '';
  if (strpos($attrs['admin_url'], 'admin/structure/block') !== FALSE) {
    $block_name = substr($attrs['admin_url'], strpos($attrs['admin_url'], '/manage/') + 8);
    $parts = explode('/', $block_name);
    $block_array = _nikadevs_render_block($parts[0], $parts[1]);
    $block = render($block_array);
  }
  $text = '<div ' . _nikadevs_cms_shortcode_attributes($attrs)  . '>' . $block . '</div>';
  return $text;
}

function nikadevs_cms_shortcode_block_tip($format, $long) {
  $output = array();
  $output[] = '<p><strong>Block:</strong><br/>[block admin_url = "admin/structure/block/manage/stability_cms/gmap/configure"][/block]</br>';
  $output[] = '<strong>admin_url</strong> - URL of the block edit page.</p>';
  return implode(' ', $output);
}

function nikadevs_cms_shortcode_featured_boxes($attrs, $text) {
  global $featured_boxes;
  $attrs['class'] = 'featured-section ' . (isset($attrs['class']) ? $attrs['class'] : '');
  if(strpos($attrs['class'], 'parallax-bg') !== FALSE) {
    $attrs['stellar_ratio'] = 2;
    $attrs['background_ratio'] = 0.5;
  }
  $output = '<section ' . _nikadevs_cms_shortcode_attributes($attrs)  . '><div class = "row">';
  $bootstrap_class = array(1 => 12, 2 => 6, 3 => 4, 4 => 3, 6 => 2);
  $col_class = $bootstrap_class[count($featured_boxes)];
  foreach($featured_boxes as $col) {
    $output .= '<div class = "col-sm-6 col-md-' . $col_class . '">' . $col . '</div>';
  }
  $output .= '</div></section>';
  $pricing_table_cols = array();
  return $output;
}

function nikadevs_cms_shortcode_featured_box($attrs, $text) {
  global $featured_boxes;
  if (!is_array($featured_boxes)) {
    $featured_boxes = array();
  }
  $attrs = shortcode_attrs(array(
      'title' => '',
      'subtitle' => '',
      'link' => '#',
      'icon' => '',
      'class' => ''
    ),
    $attrs
  );
  $attrs['class'] .= ' featured-item';
  $link = strpos($attrs['link'], '#') === FALSE ? url($attrs['link']) : $attrs['link'];
  $text = '<div ' . _nikadevs_cms_shortcode_attributes($attrs)  . '>
    <a href="' . $link .  '" class="featured-link">
      <div class="featured-desc">
        <h5 class="featured-subtitle">' . $attrs['subtitle'] . '</h5>
        <p>' . $text . '</p>
      </div>
      <div class="featured-main">
        <span class="featured-icon">
          <i class="' . $attrs['icon'] . '"></i>
        </span>
        <h3 class="featured-title">' . $attrs['title'] . '</h3>
      </div>
    </a>
  </div>';
  $featured_boxes[] = $text;
  return '';
}

function nikadevs_cms_shortcode_featured_boxes_tip($format, $long) {
  $output = array();
  $output[] = '<p><strong>Fatured Boxes:</strong><br/>[featured_boxes]<br/>
  &nbsp;[featured_box title = "Design" subtitle = "Donec id" icon = "fa fa-user"]Text[/featured_box]<br/>
  [/featured_boxes]</br>';
  $output[] = 'Available variables: <strong>title</strong>, <strong>subtitle</strong>, <strong>icon</strong></br>';
  $output[] = 'Available classes: <strong>parallax-bg</strong> - Use Parallax background</p>';
  return implode(' ', $output);
}

function nikadevs_cms_shortcode_video($attrs, $text) {
  $attrs['class'] = 'alignnone video-holder';
  $attrs['class'] .= isset($attrs['class']) ? ' ' . $attrs['class'] : '';
  $iframe_attrs = ($attrs['width'] ? 'width="' . $attrs['width'] .'"' : '') . ($attrs['height'] ? ' height ="' . $attrs['height'] . '"' : '');
  $text = '
  <figure  ' . _nikadevs_cms_shortcode_attributes($attrs)  . '>
    <iframe src="http://' . $text . '" frameborder="0" ' . $iframe_attrs . ' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
  </figure>';
  return $text;
}

function nikadevs_cms_shortcode_video_tip($format, $long) {
  $output = array();
  $output[] = '<p><strong>Video iFrame:</strong><br/>[video]player.vimeo.com/video/7449107[/video]</br>';
  $output[] = '<strong>iframe</strong> - Iframe URL of the video.</p>';
  return implode(' ', $output);
}

function nikadevs_cms_shortcode_shape_box($attrs, $text) {
  $attrs['class'] = 'shape-item';
  $attrs['class'] .= isset($attrs['class']) ? ' ' . $attrs['class'] : '';
  $link = strpos($attrs['link'], '#') === FALSE ? url($attrs['link']) : $attrs['link'];
  $styles = array(
    'line' => array(
      'data-path-hover' => 'm 180,34.57627 -180,0 L 0,0 180,0 z',
      'd' => 'M 180,160 0,218 0,0 180,0 z'
    ),
    'round' => array(
      'data-path-hover' => 'm 0,0 0,47.7775 c 24.580441,3.12569 55.897012,-8.199417 90,-8.199417 34.10299,0 65.41956,11.325107 90,8.199417 L 180,0 z',
      'd' => 'm 0,0 0,171.14385 c 24.580441,15.47138 55.897012,24.75772 90,24.75772 34.10299,0 65.41956,-9.28634 90,-24.75772 L 180,0 0,0 z'
    ),
    'triangle' => array(
      'data-path-hover' => 'M 0,0 0,38 90,58 180.5,38 180,0 z',
      'd' => 'M 0 0 L 0 182 L 90 126.5 L 180 182 L 180 0 L 0 0 z'
    ),
  );
  $attrs['style'] = isset($attrs['style']) && isset($styles[$attrs['style']]) ? $attrs['style'] : 'line';
  $style = $styles[$attrs['style']];
  $classes = array('line' => 'shape-effect1', 'round' => 'shape-effect2', 'triangle' => 'shape-effect3');
  $attrs['class'] .= ' ' . $classes[$attrs['style']];
  $text = '
    <a href="' . $link . '" ' . _nikadevs_cms_shortcode_attributes($attrs)  . ' data-path-hover="' . $style['data-path-hover'] . '">
      <figure>
        <img src="' . $attrs['image'] . '" alt="">
        <svg viewBox="0 0 180 320" preserveAspectRatio="none"><path d="' . $style['d'] . '"/></svg>
        <figcaption>
          <h3>' . $attrs['title'] . '</h3>
          <p>' . $text . '</p>
          <button class="btn btn-primary btn-sm">' . (isset($attrs['link_text']) ? $attrs['link_text'] : t('View')) . '</button>
        </figcaption>
      </figure>
    </a>';
  return $text;
}

function nikadevs_cms_shortcode_shape_box_tip($format, $long) {
  $output = array();
  $output[] = '<p><strong>Shape Box:</strong><br/>[shape_box title = "Title" image = "/lorem.img" style = "line" link = "contact" link_text = "view"]Description Text[/shape_box]</br>';
  $output[] = 'Available variables: <strong>title</strong>, <strong>link</strong>, <strong>link_text</strong>, <strong>image</strong> - Full Url to Image, <strong>style</strong> - <b>line</b>, <b>round</b>, <b>triangle</b></br>';
  return implode(' ', $output);
}