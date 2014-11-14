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
?>
<div class="row">
  <div class="col-md-4">
    <figure class="alignnone">
      <?php print render($content['field_image']); ?>
    </figure>
    <ul class="social-links social-links__primary text-center">
      <?php if($content['field_facebook'][0]['#markup']): ?><li><a href="https://facebook.com/<?php $content['field_facebook'][0]['#markup']?>"><i class="fa fa-facebook"></i></a></li><?php endif;?>
      <?php if($content['field_twitter'][0]['#markup']): ?><li><a href="https://ftwitter.com/<?php $content['field_twitter'][0]['#markup']?>"><i class="fa fa-twitter"></i></a></li><?php endif;?>
      <?php if($content['field_linkedin'][0]['#markup']): ?><li><a href="https://linkedin.com/<?php $content['field_linkedin'][0]['#markup']?>"><i class="fa fa-linkedin"></i></a></li><?php endif;?>
      <?php if($content['field_instagram'][0]['#markup']): ?><li><a href="https://instagram.com/<?php $content['field_instagram'][0]['#markup']?>"><i class="fa fa-instagram"></i></a></li><?php endif;?>
    </ul>
  </div>
  <div class="col-md-8">
    <div class="spacer visible-sm visible-xs"></div>
    <hgroup class="team-single-head">
      <h2><?php print $title; ?></h2>
      <h5 class="text-muted"><?php print render($content['field_position'][0]['#markup']); ?>r</h5>
    </hgroup>
    <p><?php print render($content['body']); ?></p>
    <?php if(count(element_children($content['field_characteristics']))): ?>
      <div class="list">
        <ul>
          <?php foreach(element_children($content['field_characteristics']) as $i): ; ?>
            <li><?php print $content['field_characteristics'][$i]['#markup']; ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif;?>
  </div>
</div>

<hr class="lg">

<div class="title-accent">
  <h3><?php print t('My Skills'); ?></h3>
</div>

<div class="row">
  <div class = "col-md-12">
    <?php foreach(element_children($content['field_skills']) as $i): list($title, $percent) = explode('|', $content['field_skills'][$i]['#markup']); ?>
      <div class="progress">
        <div class="progress-bar" role="progressbar" aria-valuenow="<?php print $percent; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php print $percent; ?>%;">
          <span class="progress-label"><?php print $title; ?></span>
          <?php print $percent; ?>
        </div>
      </div>
      <div class="spacer visible-md visible-lg"></div>
    <?php endforeach; ?>
  </div>
</div>

<hr class="lg">