<!DOCTYPE html>
<!--[if lt IE 7]>
<html lang="en" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html lang="en" class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html lang="en" class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html lang=en class=no-js> <!--<![endif]-->
<head>
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <!-- Google Analytics-->
    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                        (i[r].q = i[r].q || []).push(arguments)
                    }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-84419303-1', 'auto');
        ga('send', 'pageview');

    </script>
    <!-- End Google Analytics -->

    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.true;
            j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-54T8LKQ');</script>
    <!-- End Google Tag Manager -->
    <!-- Google Adsense -->
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>    
      (adsbygoogle = window.adsbygoogle || []).push({
        google_ad_client: "ca-pub-2224646482907163",
        enable_page_level_ads: true
      });
    </script>
    <!-- End Google Adsense -->

    <!-- Meta Description -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="http://gh.pricedrummer.com/img/site-logo/favicon.png">
    <meta name=viewport content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <meta property="og:image" content="http://gh.pricedrummer.com/img/site-logo/pricedrummer_logo_200x200.png"/>
    <meta property="og:site_name" content="PriceDrummer GH"/>
    <meta property="og:type" content=website/>
    <meta property="og:url" content="<?php echo e(url()->current()); ?>"/>
    <meta property="fb:app_id" content=1672703593058979/>
    <meta name="robots" content="index, follow">
    <meta name="msvalidate.01" content="2500E87B8FDB2C978101263D25B946B0"/>
    <link rel="canonical" href="/"/>
    <meta property="op:markup_version" content="v2.0">
    <meta name="copyright" content="(C) 2016 PriceDrummer., http://gh.pricedrummer.com"/>
<?php echo $__env->yieldContent('meta'); ?>

<!-- External stylesheets -->
    
    
    <link rel=stylesheet href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css"/>
    <link rel=stylesheet href="//cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.3/flexslider.min.css"/>
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css"/>

    <!-- Internal Stylesheets -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('/css/sweetalert.css')); ?>">
    <link rel=stylesheet href="<?php echo e(asset('/bower_components/angular-ui-bootstrap/dist/ui-bootstrap-csp.css')); ?>">
    
    <link rel=stylesheet href="<?php echo e(asset('/css/jssor_slider.css')); ?>">
    <link rel=stylesheet type="text/css" media=all href="<?php echo e(asset('/css/webslidemenu.css')); ?>">
    <link rel=stylesheet href="<?php echo e(asset('/css/nivo-slider.css')); ?>">
    <link rel=stylesheet href="<?php echo e(asset('/css/fancybox/jquery.fancybox.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/css/nouislider.css')); ?>">
    <link href="<?php echo e(asset('/css/thumbnail-slider.css')); ?>" rel=stylesheet type="text/css"/>
    <link rel=stylesheet href="<?php echo e(asset('/css/responsive.css')); ?>">
    <link rel='stylesheet' href="<?php echo e(asset('/css/app.css')); ?>">
    <link rel='stylesheet' href="<?php echo e(asset('/css/style.min.css')); ?>">
    <link rel='stylesheet' href="<?php echo e(asset('/css/jquery-ui.css')); ?>">

    <!-- External JavaScripts -->
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!-- Internal JavaScripts -->
    <script src="<?php echo e(asset('/js/sweetalert.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/js/pace.min.js')); ?>"></script>
    <script src="<?php echo e(asset('/js/nouislider.js')); ?>"></script>

</head>
<body>
<!--------------facebook widget-----------------------
    The code below is for facebook SDK plugin.
------------------------------------------------------>
<div id="fb-root"></div>
<script class="ng-scope">(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=163684300657390";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<!--------------end facebook widget------------------->

<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="//www.googletagmanager.com/ns.html?id=GTM-54T8LKQ"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->

<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->

<div class="mobile-header hidden-lg hidden-sm hidden-md">
    <div class="" style="width: 170px; padding-top: 5px;">
        <a href="/"><img src="<?php echo e(asset('/img/site-logo/pxdm_logo.png')); ?>" width=320 height=80 alt="PriceDrummer Logo"
                         title=PriceDrummer></a>
    </div>
</div>
<section class="header-area hidden-xs">
    <div class=header-top style="display:block;">
        <div class=container-fluid>
            <div class=row>
                <section class=container>
                    <div class="hidden-xs col-md-3 col-sm-12 col-sm-offset-4 col-lg-offset-0 col-md-offset-0 col-xs-offset-3 col-lg-offset-0">
                        <div class="top-message center-block">
                            <a onclick="closeMegaMenu()" href="/"><img src="<?php echo e(asset('/img/site-logo/pxdm_logo.png')); ?>"
                                                                       alt="PriceDrummer Logo" width=320 height=80></a>
                        </div>
                    </div>
                    <div class="col-md-9 hidden-sm hidden-xs" style="margin-top: 7px;">
                        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                        <!-- Desktop Leaderboard -->
                        <ins class="adsbygoogle"
                             style="display:inline-block;width:728px;height:90px"
                             data-ad-client="ca-pub-2224646482907163"
                             data-ad-slot="6301347739"></ins>
                        <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <div class=container-fluid>
        <div class=row>
            <div class="col-md-12 col-sm-12 col-xs-12 hidden-xs">
                <div class=header-middle>
                    <nav class=aling_li style="width:auto;margin-right: -15px;margin-left: -15px;">
                        <section class=container>
                            <ul id=menu>
                                <div class="row">
                                    <div class="col-md-5 col-sm-2">
                                        <ul>
                                            <li class="open_mega hidden-xs">
                                                <div id=nav-icon4 style="width:37px; height:45px;margin-left: -15px;">
                                                    <span></span>
                                                    <span></span>
                                                    <span></span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-7 col-sm-7">
                                        <li class="categorys-product-search hidden-xs">
                                            <div class=handle-header-form>
                                                <form autocomplete=off action="/search" method="GET"
                                                      id=search_form class=search-form-cat>
                                                    <div class="search-product form-group">
                                                        <input type=search class="form-control search-form "
                                                               id="home_serch_input"
                                                               name="search"
                                                               placeholder="I'm looking for..."/>
                                                        <button class=search-button value="Search" name="submit"
                                                                type=submit>
                                                            <i class="fa fa-search"></i>
                                                        </button>
                                                        <div class="Search-suggestions"
                                                             style="z-index: 999999;display: none;position: absolute;background-color: white;width: 600px;top: 37px;margin-left: 3px;border-radius: 0 0 3px 3px;">
                                                            <p style="display: block; padding: 10px;margin: 0;border-bottom: 1px solid #EEEEEE;">
                                                                <a href="" style="display: block;">wetwe</a>
                                                            </p>
                                                            <p style="display: block; padding: 10px;margin: 0;border-bottom: 1px solid #EEEEEE;">
                                                                <a href="" style="display: block;">wetwe</a>
                                                            </p>

                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </li>
                                    </div>
                                </div>
                            </ul>
                        </section>
                        <div class=container-fluid>
                            <div class=row>
                                <div id=mega style="display:none;" class=" hidden-xs">
                                    <div class=mega-icon-margin>
                                        <div class=row>
                                            <div class="col-md-4 col-sm-4">
                                                <div class=mega-menu-icons
                                                     style="text-align: center;margin-bottom: 20px;color: #FFFFFF;">
                                                    <a onclick="closeMegaMenu()" href="/about">
                                                        <i class="fa fa-info-circle fa-3x" style="color: #FFFFFF;"></i>
                                                        <h4 style="color: #FFFFFF;">About PriceDrummer
                                                        </h4>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4">
                                                <div class=mega-menu-icons
                                                     style="text-align: center;margin-bottom: 20px;color: #FFFFFF;">
                                                    <a onclick="closeMegaMenu()" target=_blank
                                                       href="http://blog.pricedrummer.com/">
                                                        <i class="fa fa-comments-o fa-3x" style="color: #FFFFFF;"></i>
                                                        <h4 style="color: #FFFFFF;">Blog</h4>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4">
                                                <div class=mega-menu-icons
                                                     style="text-align: center;margin-bottom: 20px;color: #FFFFFF;">
                                                    <a onclick="closeMegaMenu()" target=_blank href="#">
                                                        <i class="fa fa-comments fa-3x" aria-hidden=true
                                                           style="color: #FFFFFF;"></i>
                                                        <h4 style="color: #FFFFFF;">Forum</h4>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=row>
                                        <div id=mega_category>
                                            <?php $__currentLoopData = $mega_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div>
                                                    <div class="col-md-2 col-sm-3">
                                                        <div class="al_navContent cat-top">
                                                            <h3>
                                                                <a style="color: #FFFFFF;"
                                                                   href="/category/<?php echo e($category->category_ID); ?>/<?php echo e(spacelessUrl(lowercase( $category->name ))); ?>"><?php echo e($category->name); ?></a>
                                                            </h3>
                                                            <div class="nav-template nav-flyout-content nav-tpl-megamenu">
                                                                <?php $__currentLoopData = $category->category_children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category_lev3): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <a onclick="closeMegaMenu()"
                                                                       href="/filter/<?php echo e($category_lev3->category_ID); ?>/<?php echo e(spacelessUrl(lowercase( $category_lev3->name ))); ?>"
                                                                       class="nav-link nav-item">
                                                                        <i class="fa fa-folder-open"></i>
                                                                        <span class=nav-text><?php echo e($category_lev3->name); ?></span>
                                                                    </a>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                    <div class=row>
                                        <div class=col-lg-6>
                                        </div>
                                        <div class=col-lg-6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="col-xs-12 hidden-sm hidden-md hidden-lg">
    <div class=search-wrapper>
        <div class=search-content>
            

            <form autocomplete=off action="/search" method="GET" id="mobile_search_form">
                <i class="fa fa-search" aria-hidden=true style="position:absolute; top: 23px; left: 25px;"></i>
                <input type=search id="mobile_home_serch_input" placeholder="I'm looking for..." name="search"/>
                <div class="Search-suggestions"
                     style="z-index: 999999;background-color: white;border-radius: 0 0 3px 3px;margin-top: -3px;">
                </div>
            </form>
        </div>
    </div>
</div>

<?php echo $__env->yieldContent('content'); ?>

<section class=footer-area>
    <div class="container hidden-xs">
        <div class=row>
            <div class=footer-top>
                <div class="col-md-3 col-sm-6 hidden-xs">
                    <div class=single-footer>
                        <h3 class=footer-top-heading>Get To Know Us</h3>
                        <div class=footer-list>
                            <ul>
                                <li class=footer-list-item><a href="<?php echo e(url('/about')); ?>">About PriceDrummer</a></li>
                                <li class=footer-list-item><a href="/careers">Careers</a></li>
                                <li class=footer-list-item><a href="/all_categories">Category A-Z</a></li>
                                <li class=footer-list-item><a href="/press">Press</a></li>
                                <li class=footer-list-item><a href="/contact">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 hidden-xs">
                    <div class=single-footer>
                        <h3 class=footer-top-heading>Support</h3>
                        <div class=footer-list>
                            <ul>
                                <li class=footer-list-item><a href="/guides">How to use PriceDrummer</a></li>
                                <li class=footer-list-item><a href="/for_retailers">Sell on PriceDrummer</a></li>
                                <li class=footer-list-item><a href="/terms_policy">Terms of Use &amp; Privacy
                                        Policy</a></li>
                                <li class=footer-list-item><a href="/rules_regulations">Rules &amp; Regulations</a>
                                </li>
                                <li class=footer-list-item><a href="/faq">FAQ</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 hidden-xs">
                    <div class=single-footer>
                        <h3 class=footer-top-heading>Social</h3>
                        <div class=footer-list>
                            <ul>
                                <?php $__currentLoopData = $social_media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class=footer-list-item">
                                        <a target=_blank href="<?php echo e($link); ?>"><?php echo e($key); ?></a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 hidden-xs">
                    <div class=news-letter>
                        <h3 class="footer-top-heading newsletter-heading">send newsletter</h3>
                        <div class=newsletter-wrapper>
                            <div class=subscribe-inner>
                                <div style="display: none;" id=sub_output></div>
                                <form id="subscribe_form" action="<?php echo e(route('newsletter')); ?>" method="POST">
                                    <?php echo e(csrf_field()); ?>

                                    <input type="email" id="subscribe_email" name="subscribe_email" required
                                           placeholder="Enter your email here">
                                    <input type="submit" id="subscribe_btn" value="subscribe" class="sub-button">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=footer-bottom>
                <div class=container>
                    <div class=row>
                        <div class="col-md-3 hidden-sm hidden-xs">
                            <div class=logo-footer style="width: 80%; margin-top: 0px;">
                                <a href="/"><img src="<?php echo e(asset('/img/site-logo/pxdm_logo_bw.png')); ?>"
                                                 alt="PriceDrummer Logo" width=200
                                                 height=50/></a>
                            </div>
                        </div>
                        <div class="col-md-5 hidden-xs col-sm-8 col-sm-offset-2 col-md-offset-0">
                            <div class=footer-copyright>
                                <p>Copyright &copy; 2017 <a href="/">PriceDrummer</a>. All
                                    rights reserved</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-sm-offset-3 col-md-offset-0">
                            <div class="social-icon-footer pull-right">
                                <ul class=social-icons>
                                    <?php $__currentLoopData = $social_media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($loop->first): ?>
                                            <?php continue; ?>
                                        <?php else: ?>
                                            <li><a data-toggle=tooltip data-placement=top title="<?php echo e($key); ?>"
                                                   href="<?php echo e($link); ?>" target=_blank><i
                                                            class="fa fa-<?php echo e(lowercase($key)); ?>"></i></a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="hidden-lg hidden-sm hidden-md visible-xs">
        <div class=col-xs-12>
            <div class=mf-social-icons>
                <ul class=social-icons>
                    <?php $__currentLoopData = $social_media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><a data-toggle=tooltip data-placement=top title="<?php echo e($key); ?>"
                               href="<?php echo e($link); ?>" target=_blank><i class="fa fa-<?php echo e(lowercase($key)); ?>"></i></a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
            <div class=mf-navigation>
                <div class=mf-nav>
                    <span><a href="/guides">Help &amp; Support</a></span> | <span><a href="/about">More</a></span>
                </div>
            </div>
        </div>
    </div>
</section>

<script type='text/javascript' src="<?php echo e(asset('/js/app.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/js/price-slider.js')); ?>"></script>

<script type="text/javascript" src="<?php echo e(asset('/js/jquery.simpleLens.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/js/jquery.nivo.slider.pack.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/js/jquery.countdown.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/js/jquery.elevatezoom.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/js/wow.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/js/jquery.meanmenu.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/js/fancybox/jquery.fancybox.pack.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/js/jquery.scrollUp.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/js/jquery.mixitup.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/js/plugins.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/js/jquery.flexslider.js')); ?>"></script>

<script src="<?php echo e(asset('/js/jquery.twbsPagination.min.js')); ?>"></script>
<script src="<?php echo e(asset('/js/purl.js')); ?>"></script>
<script src="<?php echo e(asset('/js/bootstrap-offcanvas.js')); ?>"></script>


<script async type="text/javascript">
    $(document).ready(function () {
        $('ul.vertical_menu li a').click(function (e) {
            e.preventDefault();
            e.stopPropagation;
            $(this).closest('ul').find('.selected').removeClass('selected');
            $(this).parent().addClass('selected');
        });
    });
    $(document).ready(function () {
        $('#nav-icon4').click(function () {
            $('#mega').slideToggle("slow");
        });
    });
    $(document).ready(function () {
        $('#nav-icon4').click(function () {
            $(this).toggleClass('open');
        });
    });
    $(document).ready(function () {
        var showChar = 193;
        var ellipsestext = "...";
        var moretext = "more>>";
        var lesstext = "less";
        $('.more').each(function () {
            var content = $(this).html();
            if (content.length > showChar) {
                var c = content.substr(0, showChar);
                var h = content.substr(showChar - 1, content.length - showChar);
                var html = c + '<span class="moreelipses">' + ellipsestext + '</span>&nbsp;<span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
                $(this).html(html);
            }
        });
        $window = $(window);
        $window.scroll(function () {
            $scroll_position = $window.scrollTop();
            if ($scroll_position > 120) {
                $('.header-middle').addClass('sticky');
                header_height = $('.header-middle').innerHeight();
                $('body').css('padding-top', header_height);
            } else {
                $('body').css('padding-top', '0');
                $('.header-middle').removeClass('sticky');
            }
        });
    });
    $(document).ready(function () {
        $('#scroll_top').on('click', function (e) {
            e.preventDefault();
            $('html,body').animate({
                scrollTop: 0
            }, 500);
        });
    });

    function showSubCat(ele) {
        var cat_div = $(ele).find('.CategorySub');
        $(cat_div).removeClass('hide_sub-cat');
        cat_div.addClass('show_sub-cat');
    }
    ;

    function hideSubCat(ele) {
        var cat_div = $(ele).find('.CategorySub');
        $(cat_div).removeClass('show_sub-cat');
        cat_div.addClass('hide_sub-cat');
    }
    ;

    function startHomeSlider() {
        nslider.init();
    }
    startHomeSlider();
    function startThumbnailSlider() {
        mcThumbnailSlider.init();
    }
    $(function () {
        var imgParam = $("#img-param"),
                imgForm = $("#imageParameters");
        imgParam.click(function (evt) {
            evt.preventDefault();
            imgForm.submit();
        });
    });

    $(document).ready(function () {
        $.getJSON('https://ipinfo.io', function (data) {
            var ip = data['ip'],
                    country = data['country'],
                    city = data['city'],
                    location = data['loc'],
                    region = data['region'];
            $.ajax({
                url: '/api/GetClientIp.php',
                type: 'POST',
                data: {
                    ip: ip,
                    country: country,
                    city: city,
                    location: location,
                    region: region
                },
                success: function (data) {

                },
                error: function (status) {

                }
            });
        });
    });

    $(function () {
        var subscribe_email = $('#subscribe_email');
        $('#subscribe_form').submit(function (e) {
            e.preventDefault();
            console.log(token);
            var email = ($(subscribe_email).val()),
                    token = $('input[name=_token]').attr('value');

            $.ajax({
                type: 'POST',
                url: "<?php echo e(url('/newsletter')); ?>",
                data: {
                    _token: token,
                    email: email
                },
                success: function (response) {
                    var sub_output = $('#sub_output');
                    $(sub_output).css('display', 'block').text(response).fadeOut(5000);
                },
                error: function (error) {
                    var sub_output = $('#sub_output');
                    console.log(error.responseText);
                    $(sub_output).css('display', 'block').text(error.responseText).fadeOut(5000);
                }
            });
            $(subscribe_email).val('');
        });
    });


    //Function to build new query sreing from object provided
    function change_query_string(query_key, new_value) {
        var currentUrl = window.location.href;
        var parsedUrl = $.url(currentUrl);
        var params = parsedUrl.param();
        params[query_key] = new_value;
        var newUrl = "?" + $.param(params);
        var protocol = parsedUrl.attr('protocol');
        var host = parsedUrl.attr('host')
        var port = parsedUrl.attr('port')
        var path = parsedUrl.attr('path')
        return new_full_url = protocol + "://" + host + ":" + port + path + newUrl;
    }

    function change_query_string_with_link(query_key, new_value,url) {
        console.log(url);
        var currentUrl = url;
        var parsedUrl = $.url(currentUrl);
        var params = parsedUrl.param();
        params[query_key] = new_value;
        var newUrl = "?" + $.param(params);
        var protocol = parsedUrl.attr('protocol');
        var host = parsedUrl.attr('host')
        var port = parsedUrl.attr('port')
        var path = parsedUrl.attr('path')
        console.log(protocol + "://" + host + ":" + port + path + newUrl);
        return new_full_url = protocol + "://" + host + ":" + port + path + newUrl;
    }

    function change_query_string_obj(new_query_obj) {
        var currentUrl = window.location.href;
        var parsedUrl = $.url(currentUrl);
        var params = parsedUrl.param();
        //Update all the query key=> values provided in the object
        $.each(new_query_obj, function (query_key, query_value) {
            params[query_key] = query_value;
        });
        var newUrl = "?" + $.param(params);
        var protocol = parsedUrl.attr('protocol');
        var host = parsedUrl.attr('host')
        var port = parsedUrl.attr('port')
        var path = parsedUrl.attr('path')
        return new_full_url = protocol + "://" + host + ":" + port + path + newUrl;
    }

    function change_query_string_obj_with_link(new_query_obj,url) {
        var currentUrl = url;
        var parsedUrl = $.url(currentUrl);
        var params = parsedUrl.param();
        //Update all the query key=> values provided in the object
        $.each(new_query_obj, function (query_key, query_value) {
            params[query_key] = query_value;
        });
        var newUrl = "?" + $.param(params);
        var protocol = parsedUrl.attr('protocol');
        var host = parsedUrl.attr('host')
        var port = parsedUrl.attr('port')
        var path = parsedUrl.attr('path')
        return new_full_url = protocol + "://" + host + ":" + port + path + newUrl;
    }

    var timer;
    $('#home_serch_input').keyup(function () {
        clearTimeout(timer);
        timer = setTimeout(function (event) {
            var search_text = $('#home_serch_input').val();
            console.log('Search keypress ' + search_text);
            if (search_text.trim().length < 1) {
                console.log('No Search param');
                $('.Search-suggestions').hide();
            } else {
                $.ajax({
                    method: 'GET',
                    url: '/api/v1/productcompare/?search=' + search_text + '&limit=6',
                    success: function (response) {
                        data = response.data;
                        console.log(data);
                        //empty the search suggesion container
                        $('.Search-suggestions').html('');
                        $.each(data, function (index, value) {
                            var sc_id = value.sc_id;
                            var compare_id = value.id;
                            var url = "/compare/" + sc_id + "/" + compare_id;
                            $('.Search-suggestions').append('<p style="display: block; padding: 10px;margin: 0;border-bottom: 1px solid #EEEEEE;"><a href="' + url + '" style="display: block;">' + value.name + '</a></p>');
                        });
                        $('.Search-suggestions').show();
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            }


        }, 1000);
    });
    $('#mobile_home_serch_input').keyup(function () {
        clearTimeout(timer);
        timer = setTimeout(function (event) {
            var search_text = $('#mobile_home_serch_input').val();
            console.log('Search keypress ' + search_text);
            if (search_text.trim().length < 1) {
                console.log('No Search param');
                $('.Search-suggestions').hide();
            } else {
                $.ajax({
                    method: 'GET',
                    url: '/api/v1/productcompare/?search=' + search_text + '&limit=6',
                    success: function (response) {
                        data = response.data;
                        console.log(data);
                        //empty the search suggesion container
                        $('.Search-suggestions').html('');
                        $.each(data, function (index, value) {
                            var sc_id = value.sc_id;
                            var compare_id = value.id;
                            var url = "/compare/" + sc_id + "/" + compare_id;
                            $('.Search-suggestions').append('<p style="display: block; padding: 10px;margin: 0;border-bottom: 1px solid #EEEEEE;"><a href="' + url + '" style="display: block;">' + value.name + '</a></p>');
                        });
                        $('.Search-suggestions').show();
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            }


        }, 1000);
    });
</script>


<?php echo $__env->yieldContent('scripts'); ?>

</body>
</html>
