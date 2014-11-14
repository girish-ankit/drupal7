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
global $view_blog_counter;
if(!isset($view_blog_counter)) {
	$view_blog_counter = 0;
}
$images = $view->result[$view_blog_counter++]->field_field_images;
$icons = array('Standart' => 'fa fa-file', 'Gallery' => 'fa fa-picture-o', 'Image' => 'fa fa-camera', 'Video' => 'fa fa-film', 'Link' => 'fa fa-link', 'Quote' => 'fa fa-quote-left', 'Audio' => 'fa fa-music', 'Audio iFrame' => 'fa fa-music');
$image_style = isset($image_style) ? $image_style : 'blog_704_328';
$icon = isset($icon) ? $icon : true;
?>
<article class="entry entry__<?php print strtolower($fields['field_blog_type']->content); ?> <?php print $icon ? 'entry__with-icon' : ''; ?>">
	<?php if($icon): ?>
		<div class="entry-icon visible-md visible-lg">
			<i class="<?php print $icons[$fields['field_blog_type']->content]; ?>"></i>
		</div>
	<?php endif; ?>

	<?php if($fields['field_blog_type']->content == 'Quote'): ?>
		<div class="quote-holder">
			<div class="quote-inner">
				<p><?php print $fields['body']->content; ?></p>
			</div>
			<cite><?php print $fields['title']->content; ?></cite>
		</div>			
	<?php endif; ?>

	<header class="entry-header">
		<?php print $fields['field_blog_type']->content != 'Quote' ? '<h2>' . $fields['title']->content . '</h2>' : ''; ?>

		<?php if($fields['field_blog_type']->content == 'Link'): ?> 
			<span class="entry-url"><?php print $fields['body']->content; ?></span>
		<?php endif; ?>
		<div class="entry-meta">
			<span class="entry-date"><?php print $fields['created']->content; ?></span>
			<span class="entry-comments"><a href="#"><?php print $fields['comment_count']->content; ?> Comment<?php print $fields['created']->content ? 's' : '';?></a></span>
			<span class="entry-category"><?php print t('in'); ?> <?php print $fields['field_category']->content; ?></span>
			<span class="entry-author"><?php print t('by'); ?> <a href="#"><?php print $fields['name']->content; ?></a></span>
		</div>
	</header>
	<?php switch($fields['field_blog_type']->content):
		case 'Video': ?>
			<figure class="alignnone video-holder">
				<iframe src="<?php print $fields['field_video_iframe']->content; ?>" frameborder="0" width="612" height="343"  webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
			</figure>
		<?php break;
		case 'Gallery': ?>
			<?php if(!empty($images)): ?>
				<div class="owl-carousel owl-theme owl-slider thumbnail">
					<?php foreach($images as $image): ?>
						<div class="item">
							<a href="<?php print url('node/' . $fields['nid']->content);?>"><?php print theme('image_style', array('style_name' => $image_style, 'path' => $image['raw']['uri'])); ?></a>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; 
			break;
		case 'Standart':
		case 'Image':
			 if(!empty($images)): ?>
				<figure class="alignnone entry-thumb">
					<a href="<?php print url('node/' . $fields['nid']->content);?>">
						<?php print theme('image_style', array('style_name' => $image_style, 'path' => $images[0]['raw']['uri'])); ?></a>
				</figure>
			<?php endif; ?>
			<?php if($fields['body']->content): ?>
				<div class="excerpt">
					<?php print $fields['body']->content; ?>
				</div>
			<?php endif; ?>
		<?php break;
		case 'Audio': ?>
			<figure class="alignnone audio-holder">
				<audio controls="" preload="none" width="640" height="30" src="<?php print $fields['field_audio']->content; ?>"></audio>
			</figure>
		<?php break;
		case 'Audio iFrame': ?>
		  <figure class="alignnone audio-holder">
				<iframe width="100%" height="166" scrolling="no" frameborder="no" src="<?php print $fields['field_audio_iframe']->content; ?>"></iframe>
			</figure>			
		<?php break;
	endswitch; ?>

	<?php if(in_array($fields['field_blog_type']->content, array('Standart', 'Gallery'))): ?>
		<footer class="entry-footer">
			<?php print l('Read More', 'node/' . $fields['nid']->content, array('attributes' => array('class' => array('btn', 'btn-default'))));?>
		</footer>
	<?php endif; ?>
</article>