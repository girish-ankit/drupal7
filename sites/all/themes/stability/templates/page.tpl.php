<?php
/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/garland.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see template_process()
 */
?>
<div class="site-wrapper">
  
  <?php
    $header_version = arg(0) == 'home' && arg(1) == 'header' ? arg(2) : theme_get_setting('header');
    include "headers/header-{$header_version}.tpl.php";
  ?>

  <div class="main" role="main">

    <?php 
      if(!$is_front && arg(0) != 'home') {
        $sub_header_version = arg(2) == 'sub-header' ? arg(3) : theme_get_setting('sub_header');
        include 'sub-headers/sub-header-' . ($sub_header_version ? $sub_header_version : 1) . '.tpl.php';
      } ?>

    <?php
      if(function_exists('nikadevs_cms_page_layout') && variable_get('nikadevs_cms_layout_' . variable_get('theme_default', 'stability'), array()) != array()):
        print nikadevs_cms_page_layout(array('page' => $page, 'messages' => $messages, 'tabs' => $tabs));
      else: ?>
      <?php print render($page['top']); ?>    
      
      <section class="page-content">
        <div class="container contextual-links-region">

        <?php print $messages; ?>
        <?php print render($tabs); ?>
        <?php print render($page['content_top']); ?>  
        
        <div class = "row">
          <div class = "col-md-12">
            <?php print render($page['content']); ?>
          </div>
          <div class = "col-md-12">
            <?php print render($page['sidebar']); ?>
          </div>
        </div>

        <?php print render($page['bottom']); ?>  
        </div>
      </section>
      
      <?php print render($page['footer']); ?>
    <?php endif;?>

    <div class="footer-copyright">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 col-md-4">
            <?php print t('Copyright') . ' &copy; '. date('Y'); ?>  <a href="#"><?php print strtoupper(variable_get('site_name', 'STABILITY')); ?></a> &nbsp;| &nbsp; <?php print t('All Rights Reserved'); ?>
          </div>
          <div class="col-sm-6 col-md-8">
            <div class="social-links-wrapper">
              <span class="social-links-txt"><?php print t('Connect with us'); ?></span>
              <ul class="social-links social-links__dark">
                <?php if (theme_get_setting('social_links_facebook_enabled')): ?>
                  <li><a href="http://<?php print theme_get_setting('social_links_facebook_link'); ?>" ><i class="fa fa-facebook"></i></a></li>
                <?php endif; ?>
                <?php if (theme_get_setting('social_links_twitter_enabled')): ?>
                  <li><a href="http://<?php print theme_get_setting('social_links_twitter_link'); ?>"><i class="fa fa-twitter"></i></a></li>
                <?php endif; ?>          
                <?php if (theme_get_setting('social_links_instagram_enabled')): ?>
                  <li><a href="http://<?php print theme_get_setting('social_links_instagram_link'); ?>"><i class="fa fa-instagram"></i></a></li>
                <?php endif; ?>          
                <?php if (theme_get_setting('social_links_linkedin_enabled')): ?>
                  <li><a href="http://<?php print theme_get_setting('social_links_linkedin_link'); ?>"><i class="fa fa-linkedin"></i></a></li>
                <?php endif; ?>
                <?php if (theme_get_setting('social_links_xing_enabled')): ?>
                  <li><a href="http://<?php print theme_get_setting('social_links_xing_link'); ?>"><i class="fa fa-xing"></i></a></li>
                <?php endif; ?>
                <?php if (theme_get_setting('social_links_rss_enabled')): ?>
                  <li><a href="http://<?php print theme_get_setting('social_links_rss_link'); ?>" ><i class="fa fa-rss"></i></a></li>
                <?php endif; ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>