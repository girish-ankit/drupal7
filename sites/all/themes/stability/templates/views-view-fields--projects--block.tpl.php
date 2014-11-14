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
?>
<div class="project-item">
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
			<span class="desc"><?php print $fields['field_categories']->content; ?></span>
		</div>
	</div>
</div>