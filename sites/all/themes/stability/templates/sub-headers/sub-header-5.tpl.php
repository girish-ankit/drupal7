<?php
  $images = variable_get(variable_get('theme_default', 'none') . '_sub_headers', array());
?>
<section class="page-heading page-heading__lg page-heading__slideshow">
  <div class="tp-banner tp-banner-title slider">
    <ul class = "slides">
      <?php foreach($images as $image): ?>
        <li class = "slide">
          <?php print theme('image', array('path' => $image['image_path'])); ?>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <?php print render($title_prefix); ?>
        <h1><?php print $title;?></h1>
        <?php print render($title_suffix); ?>
        <?php print $breadcrumb; ?>
      </div>
    </div>
  </div>
</section>