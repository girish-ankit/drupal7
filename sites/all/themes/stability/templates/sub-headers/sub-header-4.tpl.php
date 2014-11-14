<?php
  $images = variable_get(variable_get('theme_default', 'none') . '_sub_headers', array());
  $image = $images[array_rand($images)];
?>
<section class="page-heading page-heading__image page-heading__lg parallax-bg" data-stellar-ratio="2" data-stellar-background-ratio="0.5" style = "background-image: url('<?php print file_create_url($image['image_path'])?>')">
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