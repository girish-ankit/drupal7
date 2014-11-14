<div class="row">
  <div class="col-md-8 col-md-offset-2 text-center">
    <h2 class="error-title">404</h2>
    <h3><?php print t("We're sorry, but the page you were looking for doesn't exist."); ?></h3>
    <p class="error-desc"><?php print t('Please try using our search box below to look for information on the our site.'); ?></p>
  </div>
</div>

<div class="row">
  <div class="col-md-4 col-md-offset-4">
    <?php print render($search); ?>
  </div>
</div>

<div class="spacer-lg"></div>