<?php
/**
 * @file
 * Default simple view template to all the fields as a row.
 *
 * - $view: The view in use.
 * - $fields: an array of $field objects. Each one contains:
 *   - $field->content: The output of the field.
 *   - $field->raw: The raw data for the field, if it exists. This is NOT output safe.
 *   - $field->class: The safe class id to use.
 *   - $field->handler: The Views field handler object controlling this field. Do not use
 *     var_export to dump this object, as it can't handle the recursion.
 *   - $field->inline: Whether or not the field should be inline.
 *   - $field->inline_html: either div or span based on the above flag.
 *   - $field->wrapper_prefix: A complete wrapper containing the inline_html to use.
 *   - $field->wrapper_suffix: The closing tag for the wrapper.
 *   - $field->separator: an optional separator that may appear before a field.
 *   - $field->label: The wrap label text to use.
 *   - $field->label_html: The full HTML of the label to use including
 *     configured element type.
 * - $row: The raw result object from the query, with all data it fetched.
 *
 * @ingroup views_templates
 */
global $projects_categories;
$categories = array();
foreach(explode(' / ', $fields['field_categories']->content) as $category) {
	$category_id = preg_replace('/[^a-zA-Z0-9\']/', '-', $category);
	$projects_categories[$category_id] = $category;
	$categories[] = $category_id;
}
$columns_classes = array(3 => 4, 4 => 3, 2 => 6, 6 => 2);
$cols = $view->style_options['columns'];
$bootsrap_class = $columns_classes[$cols];
?>
<div class = "col-sm-6 col-md-<?php print $bootsrap_class; ?> project-item isotope-item <?php print implode(' ', $categories); ?>">
	<div class="project-item-inner">
		<figure class="alignnone project-img">
			<?php print $fields['field_images']->content; ?>
			<div class="overlay">
				<a href="<?php print url('node/' . $fields['nid']->content); ?>" class="dlink"><i class="fa fa-link"></i></a>
				<a href="<?php print file_create_url(file_default_scheme() . '://' . trim($fields['field_images_1']->content));?>" class="popup-link zoom"><i class="fa fa-search-plus"></i></a>
			</div>
		</figure>
		<div class="project-desc">
			<h4 class="title"><a href="<?php print url($fields['nid']->content); ?>"><?php print $fields['title']->content; ?></a></h4>
			<span class="desc"><?php print truncate_utf8($fields['field_categories']->content, 30, FALSE, TRUE); ?></span>
		</div>
	</div>
</div>