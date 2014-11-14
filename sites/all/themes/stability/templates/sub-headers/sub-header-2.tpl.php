<section class="page-heading">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <?php print render($title_prefix); ?>
        <h1><?php print $title;?></h1>
        <?php print render($title_suffix); ?>
      </div>
      <div class="col-md-3 col-md-offset-3">
        <div class="search-form">
          <?php
            $search_form_box = module_invoke('search', 'block_view');
            $search_form_box['content']['#attributes']['id'] = 'search-form';
            print render($search_form_box);
          ?>
        </div>
      </div>
    </div>
  </div>
</section>