<?php // print_r($form) ?>

<?php print drupal_render($form['form_id']); ?>
<?php print drupal_render($form['form_build_id']); ?>

<?php // print drupal_render($form['links']) ?>
<?php print drupal_render($form['name']); ?>
<?php print drupal_render($form['pass']); ?>
<?php print drupal_render($form['actions']['submit']); ?>
<br />
<?php print drupal_render($form['fbconnect_button']); ?>
