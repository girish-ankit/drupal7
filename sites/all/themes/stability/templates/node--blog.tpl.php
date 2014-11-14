<?php
/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all, or
 *   print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct url of the current node.
 * - $terms: the themed list of taxonomy term links output from theme_links().
 * - $display_submitted: whether submission information should be displayed.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the following:
 *   - node: The current template type, i.e., "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type, i.e. story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode, e.g. 'full', 'teaser'...
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined, e.g. $node->body becomes $body. When needing to access
 * a field's raw values, developers/themers are strongly encouraged to use these
 * variables. Otherwise they will have to explicitly specify the desired field
 * language, e.g. $node->body['en'], thus overriding any language negotiation
 * rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 */
$icons = array('Standart' => 'fa fa-file', 'Gallery' => 'fa fa-picture-o', 'Image' => 'fa fa-camera', 'Video' => 'fa fa-film', 'Link' => 'fa fa-link', 'Quote' => 'fa fa-quote-left', 'Audio' => 'fa fa-music', 'Audio iFrame' => 'fa fa-music');
$fields = array('field_blog_type', 'field_images', 'field_category', 'field_video_iframe', 'field_audio', 'field_audio_iframe');
foreach($fields as $field) {
  $$field = _get_node_field($node, $field);
}
?>
<article class="entry entry__<?php print strtolower($field_blog_type[0]['value']); ?> entry__with-icon">
  <div class="entry-icon visible-md visible-lg">
    <i class="<?php print $icons[$field_blog_type[0]['value']]; ?>"></i>
  </div>

  <?php if($field_blog_type[0]['value'] == 'Quote'): ?>
    <div class="quote-holder">
      <div class="quote-inner">
        <p><?php print render($content['body']); ?></p>
      </div>
      <cite><?php print $title; ?></cite>
    </div>      
  <?php endif; ?>

  <header class="entry-header">
    <?php print $field_blog_type[0]['value'] != 'Quote' ? '<h2>' . $title . '</h2>' : ''; ?>

    <?php if($field_blog_type[0]['value'] == 'Link'): ?>
      <span class="entry-url"><?php print render($content['body']); ?></span>
    <?php endif; ?>
    <div class="entry-meta">
      <span class="entry-date"><?php print date('d/m/Y', $created); ?></span>
      <span class="entry-comments"><a href="#"><?php print $node->comment_count ; ?> Comment<?php print $node->comment_count  ? 's' : '';?></a></span>
      <?php if (isset($field_category[0]['value'])): ?><span class="entry-category"><?php print t('in'); ?> <?php print $field_category[0]['value']; ?></span><?php endif; ?>
      <span class="entry-author"><?php print t('by'); ?> <a href="#"><?php print $node->name; ?></a></span>
    </div>
  </header>

  <?php if($field_blog_type[0]['value'] == 'Video' && !empty($field_video_iframe)): ?>
    <figure class="alignnone video-holder">
      <iframe src="<?php print $field_video_iframe[0]['value']; ?>" frameborder="0" width="612" height="343" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
    </figure>
  <?php endif; ?>

  <?php if($field_blog_type[0]['value'] == 'Audio' && !empty($field_audio)): ?>
    <figure class="alignnone audio-holder">
      <audio controls="" preload="none" width="640" height="30" src="<?php print $field_audio[0]['uri']; ?>"></audio>
    </figure>
  <?php endif; ?>

  <?php if($field_blog_type[0]['value'] == 'Audio iFrame' && !empty($field_audio_iframe)): ?>
    <figure class="alignnone audio-holder">
      <iframe width="100%" height="166" scrolling="no" frameborder="no" src="<?php print $field_audio_iframe[0]['value']; ?>" ></iframe>
    </figure>     
  <?php endif; ?>

  <?php if($field_blog_type[0]['value'] == 'Gallery' && !empty($field_images)): ?>
    <div class="owl-carousel owl-theme owl-slider thumbnail">
      <?php foreach($field_images as $image): ?>
        <div class="item">
          <a href="<?php print $node_url; ?>"><?php print theme('image_style', array('style_name' => 'blog_704_328', 'path' => $image['uri'])); ?></a>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
    
  <?php if(in_array($field_blog_type[0]['value'], array('Standart', 'Image'))): ?>
    <?php if(!empty($field_images)): ?>
      <figure class="alignnone entry-thumb">
        <a href="<?php print $node_url; ?>">
          <?php print theme('image_style', array('style_name' => 'blog_704_328', 'path' => $field_images[0]['uri'])); ?></a>
      </figure>
    <?php endif; ?>
    <?php if(!empty($content['body'])): ?>
      <div class="excerpt">
        <?php print render($content['body']); ?>
      </div>
    <?php endif; ?>
  <?php endif; ?>

</article>

<?php print render($content['comments']); ?>