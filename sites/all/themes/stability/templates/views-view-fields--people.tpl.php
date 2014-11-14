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
<figure class="alignnone">
	<a href="<?php print url('node/' . $fields['nid']->content); ?>"><?php print $fields['field_image']->content; ?></a>
</figure>
<header class="team-head">
	<span class="team-head-info"><?php print $fields['field_position']->content; ?></span>
	<h4 class="team-name"><?php print $fields['title']->content; ?></h4>
	<ul class="team-social list-unstyled">
		<li>
			<i class="fa fa-envelope-o"></i><a href="mailto:<?php print $fields['field_email']->content; ?>"><?php print $fields['field_email']->content; ?></a>
		</li>
		<li>
			<i class="fa fa-skype"></i><a href="skype:<?php print $fields['field_skype']->content; ?>"><?php print $fields['field_skype']->content; ?></a>
		</li>
	</ul>
</header>
<div class="team-excerpt">
	<?php print $fields['body']->content; ?>
</div>