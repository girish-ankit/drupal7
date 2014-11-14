<header class="header header-menu-fullw">

  <div class="header-top">
    <div class="container">
      <div class="header-top-left">
        <?php print $header_top_menu_tree; ?>
      </div>
      <div class="header-top-right">
        <?php print $login_account_links; ?>
      </div>
    </div>
  </div>
  <div class="header-main">
    <div class="container">
      <!-- Logo -->
      <div class="logo">
        <?php if($logo): ?>
          <a href="<?php print $front_page; ?>"><img src="<?php print $logo; ?>" alt="<?php print $site_name; ?>"></a>
        <?php else: ?>
          <h1><a href="<?php print $front_page; ?>"><?php print $site_name; ?></a></h1>
        <?php endif; ?>
        <p class="tagline"><?php print $site_slogan; ?></p>
      </div>
      <!-- Logo / End -->

      <button type="button" class="navbar-toggle">
          <i class="fa fa-bars"></i>
        </button>

        <!-- Banner -->
        <div class="head-banner">
          <a href="/contact"><img src="<?php print base_path() . path_to_theme(); ?>/images/banner.jpg" alt=""></a>
        </div>
        <!-- Banner / End -->
    </div>
  </div>

    <!-- Navigation -->
  <nav class="nav-main">
    <div class="container">
      <ul data-breakpoint="992" class="flexnav">
       <?php 
          $main_menu_tree = module_exists('i18n') ? i18n_menu_translated_tree(variable_get('menu_main_links_source', 'main-menu')) : menu_tree(variable_get('menu_main_links_source', 'main-menu'));
          print drupal_render($main_menu_tree);
        ?>
        <li class="signin"><?php print l('user', 'Sign In'); ?></li>
      </ul>
    </div>
  </nav>
  <!-- Navigation / End -->
</header>