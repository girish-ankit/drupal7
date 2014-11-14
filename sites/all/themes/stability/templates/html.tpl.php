<!DOCTYPE html>
<!--[if IE 7]>                  <html class="ie7 no-js" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>"<?php print $rdf_namespaces; ?>>     <![endif]-->
<!--[if lte IE 8]>              <html class="ie8 no-js" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>"<?php print $rdf_namespaces; ?>>     <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="not-ie no-js" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>"<?php print $rdf_namespaces; ?>>  <!--<![endif]-->
<head>

  <?php print $head; ?>

  <title><?php print $head_title; ?></title>
  <meta name="description" content="Stability - Responsive HTML5 Drupal Theme - 1.2">
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
<body class="<?php print $classes; ?>"<?php print $attributes; ?>>

  <?php print $page_top; ?>
  <?php print $page; ?>
  <?php print $page_bottom; ?>

  <?php print $scripts; ?>

</body>
</html>