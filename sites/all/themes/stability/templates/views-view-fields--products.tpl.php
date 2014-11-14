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
<div class="project-item-inner">

	<?php if($fields['field_old_price']->content): ?>
		<a href="<?php print url('node/' . $fields['nid']->content); ?>"><span class="onsale"><?php print t('Sale!'); ?></span></a>
	<?php endif; ?>


	<figure class="alignnone project-img">
		<?php print $fields['uc_product_image']->content; ?>
		<div class="overlay">
			<div class="dlink"><?php print str_ireplace(t('Add to cart'), '&#xf07a', $fields['addtocartlink']->content); ?></div>
			<a href="<?php print url('node/' . $fields['nid']->content); ?>" class="zoom"><i class="fa fa-file-text-o"></i></a>
		</div>
	</figure>

	<div class="project-desc">
		<h4 class="title"><a href="<?php print url($fields['nid']->content); ?>"><?php print $fields['title']->content; ?></a></h4>
		<span class="price">
			<?php if($fields['field_old_price']->content): ?>
				<del><span class="amount"><?php print variable_get('uc_currency_sign', '') . $fields['field_old_price']->content; ?></span></del>
				<ins>
					<span class="amount"><?php print strip_tags($fields['display_price']->content); ?></span>
				</ins>
			<?php else: ?>
				<span class="amount"><?php print strip_tags($fields['display_price']->content); ?></span>
			<?php endif; ?>
		</span>
	</div>

</div>