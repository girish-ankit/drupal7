<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
global $projects_categories;
?>
<div class="container">
  <div class="clearfix">
    <!-- Project Feed Filter -->
    <ul class="project-feed-filter text-center">
      <li><a href="#" class="btn btn-sm btn-default btn-primary" data-filter="*">All</a></li>
      <?php  foreach($projects_categories as $id => $category): ?>
        <li><a href="#" class="btn btn-sm btn-default" data-filter=".<?php print $id; ?>"><?php print $category; ?></a></li>
      <?php endforeach; ?>
    </ul>
    <!-- Project Feed Filter / End -->
  </div>
</div>
<div class = "project-feed project-feed__fullw isotope">
  <?php foreach ($rows as $id => $row): ?>
    <?php print $row; ?>
  <?php endforeach; ?>
</div>
