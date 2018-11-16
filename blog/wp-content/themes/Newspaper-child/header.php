<!doctype html >
<!--[if IE 8]>    <html class="ie8" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <!-- Google Analytics-->
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-93457624-1', 'auto');
        ga('send', 'pageview');
    </script>
    <!-- End Google Analytics -->
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-54T8LKQ');</script>
    <!-- End Google Tag Manager -->
	<title><?php wp_title('|', true, 'right'); ?></title>
	<meta charset="<?php bloginfo( 'charset' );?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta property=fb:app_id content=1672703593058979 />
<!--	<meta property=og:image content="https://www.pricedrummer.com.gh/img/site-logo/pricedrummer_logo_200x200.png"/>-->
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php
		wp_head(); /** we hook up in wp_booster @see td_wp_booster_functions::hook_wp_head */
	?>
</head>

<body <?php body_class() ?> itemscope="itemscope" itemtype="<?php echo td_global::$http_or_https?>://schema.org/WebPage">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-54T8LKQ"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<?php /* scroll to top */?>
<div class="td-scroll-up"><i class="td-icon-menu-up"></i></div>

<?php locate_template('parts/menu-mobile.php', true);?>
<?php locate_template('parts/search.php', true);?>


<div id="td-outer-wrap">
	<?php //this is closing in the footer.php file ?>

<?php
	/*
	 * loads the header template set in Theme Panel -> Header area
	 * the template files are located in ../parts/header
	 */
	td_api_header_style::_helper_show_header();
	
	do_action('td_wp_booster_after_header'); //used by unique articles