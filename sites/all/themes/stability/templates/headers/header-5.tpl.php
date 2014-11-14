<header class="header header-centered header-menu-fullw header-top-clean">
  <div class="header-top">
    <div class="container">

      <div class="header-top-left">
        <?php print $header_top_menu_tree; ?>
      </div>
      <div class="header-top-right">
        <span class="info-item"><i class="fa fa-phone"></i><?php print theme_get_setting('phone'); ?></span>
        <span class="info-item"><i class="fa fa-envelope"></i> <a href="<?php print theme_get_setting('email'); ?>"><?php print theme_get_setting('email'); ?></a></span>
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
    </div>
  </div>

  <nav class="nav-main">
  <ul data-breakpoint="992" class="flexnav">
   <?php 
      $main_menu_tree = module_exists('i18n') ? i18n_menu_translated_tree(variable_get('menu_main_links_source', 'main-menu')) : menu_tree(variable_get('menu_main_links_source', 'main-menu'));
      print drupal_render($main_menu_tree);
    ?>
  </ul>
  </nav>

</header>