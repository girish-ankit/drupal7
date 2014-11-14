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
$entry_meta = '
<div class="entry-meta">
	<span class="entry-date">' . $fields['created']->content . ' </span>
	<span class="entry-comments"><a href="#">' . $fields['comment_count']->content . ' '.  t('Comment' . ($fields['created']->content ? 's' : '')) .' </a></span>
	<span class="entry-category">'. t('in') . ' ' . $fields['field_category']->content .'</span>
	<span class="entry-author">' . t('by') . ' ' . '<a href="#">' . $fields['name']->content . '</a></span>
</div>';
$footer = in_array($fields['field_blog_type']->content, array('Standart', 'Gallery')) ? 
	'<footer class="entry-footer">'. l('Read More', 'node/' . $fields['nid']->content, array('attributes' => array('class' => array('btn', 'btn-default')))) . '</footer>' : '';
// If standart post without image - mark it as Standart no Image
$type = $fields['field_blog_type']->content == 'Standart' && empty($images) ? 'Standart no Image' : $fields['field_blog_type']->content;
?>
<article class="entry entry__<?php print strtolower($fields['field_blog_type']->content); ?>">
	<?php switch($type):

		case 'Video':
		case 'Gallery':
		case 'Image':
		case 'Audio':
		case 'Audio iFrame':
		case 'Standart': ?>
			<div class="row">
				<div class="col-sm-5 col-md-5">
					
					<?php if(!empty($images) && count($images) > 1): ?>
						<div class="owl-carousel owl-theme owl-slider thumbnail">
							<?php foreach($images as $image): ?>
								<div class="item">
									<a href="<?php print url('node/' . $fields['nid']->content);?>"><?php print theme('image_style', array('style_name' => 'blog_280_270', 'path' => $image['raw']['uri'])); ?></a>
								</div>
							<?php endforeach; ?>
						</div>
					<?php elseif(!empty($images)):  ?>
						<figure class="alignnone entry-thumb">
							<a href="<?php print url('node/' . $fields['nid']->content);?>">
								<?php print theme('image_style', array('style_name' => $type == 'Standart' ? 'blog_280_270' : 'blog_281_157', 'path' => $images[0]['raw']['uri'])); ?></a>
						</figure>
					<?php elseif(!empty($fields['field_video_iframe']->content)): ?>
						<figure class="alignnone video-holder">
							<iframe src="<?php print $fields['field_video_iframe']->content; ?>" frameborder="0" width="612" height="343"  webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
						</figure>
					<?php elseif(!empty($fields['field_audio']->content)): ?>
						<figure class="alignnone audio-holder">
							<audio controls="" preload="none" width="640" height="30" src="<?php print $fields['field_audio']->content; ?>"></audio>
						</figure>
					<?php elseif(!empty($fields['field_audio_iframe']->content)): ?>
					  <figure class="alignnone audio-holder">
							<iframe width="100%" height="166" scrolling="no" frameborder="no" src="<?php print $fields['field_audio_iframe']->content; ?>"></iframe>
						</figure>
					<?php endif; ?>

				</div>
				<div class="col-sm-7 col-md-7">
					<header class="entry-header">
						<h2><?php print $fields['title']->content; ?></h2>
						<?php print $entry_meta; ?>
					</header>

					<?php if($fields['body']->content): ?>
						<div class="excerpt">
							<?php print $fields['body']->content; ?>
						</div>
					<?php endif; ?>

					<?php print $footer; ?>
				</div>
			</div>
		<?php break;

		case 'Link':?>
			<header class="entry-header">
				<h2><?php print $fields['title']->content; ?></h2>
				<span class="entry-url"><?php print $fields['body']->content; ?></span>
				<?php print $entry_meta; ?>
			</header>
		<?php break;

		case 'Quote': ?>
			<div class="quote-holder">
				<div class="quote-inner">
					<p><?php print $fields['body']->content; ?></p>
				</div>
				<cite><?php print strip_tags($fields['title']->content); ?></cite>
			</div>
			<?php print $entry_meta; ?>
		<?php	break;

		case 'Standart no Image': ?>
			<header class="entry-header">
				<h2><?php print $fields['title']->content; ?></h2>
				<?php print $entry_meta; ?>
			</header>
			<div class="excerpt">
				<?php print $fields['body']->content; ?>
			</div>
			<?php print $footer; ?>
		<?php	break;

	endswitch; ?>

</article>