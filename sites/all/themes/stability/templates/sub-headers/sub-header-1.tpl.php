<section class="page-heading">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <?php print render($title_prefix); ?>
        <h1><?php print $title;?></h1>
        <?php print render($title_suffix); ?>
      </div>
      <div class="col-md-6">
        <?php print $breadcrumb; ?>
      </div>
    </div>
  </div>
</section>