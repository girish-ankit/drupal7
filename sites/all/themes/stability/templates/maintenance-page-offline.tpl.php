<!DOCTYPE html>
<!--[if IE 7]>                  <html class="ie7 no-js" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>"<?php print $rdf_namespaces; ?>>     <![endif]-->
<!--[if lte IE 8]>              <html class="ie8 no-js" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>"<?php print $rdf_namespaces; ?>>     <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="not-ie no-js" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>"<?php print $rdf_namespaces; ?>>  <!--<![endif]-->
<?php 
  // In case then we show maintenance page in demo view
  if(!isset($site_name)) {
    template_preprocess_page($variables);
    extract($variables);
  }
?>
<head>

  <?php print $head; ?>

  <title><?php print $head_title; ?></title>
  <meta name="description" content="Stability - Responsive HTML5 Drupal Theme - 1.0">
  <meta name="author" content="http://themeforest.net/user/NikaDevs">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- Mobile Specific Metas
  ================================================== -->
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">

  <?php print $styles; ?>

  <!-- Head Libs -->
  <script src="/<?php print path_to_theme(); ?>/vendor/modernizr.js"></script>

  <!--[if lt IE 9]>
    <link rel="stylesheet" href="/<?php print path_to_theme(); ?>/vendor/rs-plugin/css/settings-ie8.css" media="screen">
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <script src="/<?php print path_to_theme(); ?>/vendor/respond.min.js"></script>
  <![endif]-->

  <!--[if IE]>
    <link rel="stylesheet" href="<?php print path_to_theme(); ?>/css/ie.css">
  <![endif]-->

  <!-- Favicons
  ================================================== -->
  <link rel="apple-touch-icon" href="<?php print path_to_theme(); ?>/images/apple-touch-icon.png">
  <link rel="apple-touch-icon" sizes="72x72" href="<?php print path_to_theme(); ?>/images/apple-touch-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?php print path_to_theme(); ?>/images/apple-touch-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="144x144" href="<?php print path_to_theme(); ?>/images/apple-touch-icon-144x144.png">

</head>
<body class="<?php print $classes; ?>" <?php print $attributes;?>>

  <div class="site-wrapper">
    
    <!-- Header -->
    <header class="header header-coming-soon">

      <div class="header-main">
        <div class="container">
          <!-- Logo -->
          <div class="logo">
            <!-- <a href="index.html"><img src="images/logo.png" alt="Stability"></a> -->
            <h1><a href="<?php print $front_page; ?>"><?php print $site_name; ?></a></h1>
            <p class="tagline"><?php print $site_slogan; ?></p>
          </div>
          <!-- Logo / End --> 
        </div>
      </div>
      
    </header>
    <!-- Header / End -->

    <!-- Main -->
    <div class="main main__padd-top" role="main">

      <!-- Page Content -->
      <section class="nd-region">
        <div class="container">

          <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center">
              <h1><?php print t('Our Site is launching soon...'); ?></h1>

              <?php if ($messages): ?>
                <div id="messages"><div class="section clearfix">
                  <?php print $messages; ?>
                </div></div> <!-- /.section, /#messages -->
              <?php endif; ?>

              <?php print isset($content) ? $conten : t('Donec mattis ligula quis interdum sodales. Nam pharetra eros mauris. Vestibulum posuere id urna et accumsan. Suspendisse et dapibus nulla, in sodales dui.'); ?>
            </div>
          </div>

          <div id="countdown" class="countdown text-center" ms-user-select="none">
            <div class="row">
              <div class="col-md-3 col-lg-offset-2 col-lg-2 text-center">
                <input class="knob" id="days" data-readonly=true data-min="0" data-max="99" data-skin="tron" data-width="165" data-height="165" data-thickness="0.2" data-fgcolor="#2f2f2f">
                <span class="count-label">days</span>
              </div>
              
              <div class="col-md-3 col-lg-2">
                <input class="knob" id="hours" data-readonly=true data-min="0" data-max="24" data-skin="tron" data-width="165" data-height="165" data-thickness="0.2" data-fgcolor="#2f2f2f">
                <span class="count-label">hours</span>
              </div>
              
              <div class="col-md-3 col-lg-2">
                <input class="knob" id="mins" data-readonly=true data-min="0" data-max="60" data-skin="tron" data-width="165" data-height="165" data-thickness="0.2" data-fgcolor="#2f2f2f">
                <span class="count-label">minutes</span>
              </div>
              
              <div class="col-md-3 col-lg-2">
                <input class="knob" id="secs" data-readonly=true data-min="0" data-max="60" data-skin="tron" data-width="165" data-height="165" data-thickness="0.2" data-fgcolor="#2f2f2f">
                <span class="count-label">seconds</span>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-8 col-md-offset-2">
              <hr class="lg">
            </div>
          </div>

        </div>
      </section>
      <!-- Page Content / End -->

      <!-- Footer -->
      <footer class="footer footer__light" id="footer">
        <div class="footer-copyright">
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-md-4">
                <?php print t('Copyright') . ' &copy; '. date('Y'); ?>  <a href="<?php print $front_page;?>">STABILITY</a> &nbsp;| &nbsp; <?php print t('All Rights Reserved'); ?>
              </div>
              <div class="col-sm-6 col-md-8">
                <div class="social-links-wrapper">
                  <span class="social-links-txt"><?php print t('Connect with us'); ?></span>
                  <ul class="social-links">
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
      </footer>
      <!-- Footer / End -->
      
    </div>
    <!-- Main / End -->
  </div>
<!-- Javascript Files
  ================================================== -->
  <script src="/<?php print path_to_theme(); ?>/vendor/jquery-1.11.0.min.js"></script>
  <script src="/<?php print path_to_theme(); ?>/vendor/jquery-migrate-1.2.1.min.js"></script>
  <script src="/<?php print path_to_theme(); ?>/vendor/countdown/jquery.knob.js"></script>
  <script src="/<?php print path_to_theme(); ?>/vendor/countdown/countdown.js"></script>
  <script src="/<?php print path_to_theme(); ?>/vendor/countdown/ext.js"></script>

  <script>
      $(function() {

        // Put your date in the next format
        $('#countdown').countdown( { date: <?php print "'" . theme_get_setting("maintenance_end") . "'"; ?> } );

          $(".knob").knob({
              change : function (value) {
                  //console.log("change : " + value);
              },
              release : function (value) {
              },
              cancel : function () {
              },
              draw : function () {

                  // "tron" case
                  if(this.$.data('skin') == 'tron') {

                      var a = this.angle(this.cv)  // Angle
                          , sa = this.startAngle   // Previous start angle
                          , sat = this.startAngle  // Start angle
                          , ea                     // Previous end angle
                          , eat = sat + a          // End angle
                          , r = 1;

                      this.g.lineWidth = this.lineWidth;

                      this.o.cursor
                          && (sat = eat - 0.3)
                          && (eat = eat + 0.3);

                      if (this.o.displayPrevious) {
                          ea = this.startAngle + this.angle(this.v);
                          this.o.cursor
                              && (sa = ea - 0.3)
                              && (ea = ea + 0.3);
                          this.g.beginPath();
                          this.g.strokeStyle = this.pColor;
                          this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
                          this.g.stroke();
                      }

                      this.g.beginPath();
                      this.g.strokeStyle = r ? this.o.fgColor : this.fgColor ;
                      this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
                      this.g.stroke();

                      this.g.lineWidth = 2;
                      this.g.beginPath();
                      this.g.strokeStyle = this.o.fgColor;
                      this.g.arc( this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                      this.g.stroke();

                      return false;
                  }
              }
          });

          // Example of infinite knob, iPod click wheel
          var v, up=0,down=0,i=0
              ,$idir = $("div.idir")
              ,$ival = $("div.ival")
              ,incr = function() { i++; $idir.show().html("+").fadeOut(); $ival.html(i); }
              ,decr = function() { i--; $idir.show().html("-").fadeOut(); $ival.html(i); };
          $("input.infinite").knob( {
                              min : 0
                              , max : 20
                              , stopper : false
                              , change : function () {
                                              if(v > this.cv){
                                                  if(up){
                                                      decr();
                                                      up=0;
                                                  }else{up=1;down=0;}
                                              } else {
                                                  if(v < this.cv){
                                                      if(down){
                                                          incr();
                                                          down=0;
                                                      }else{down=1;up=0;}
                                                  }
                                              }
                                              v = this.cv;
                                          }
                              });
      });
  </script>


</body>
</html>
