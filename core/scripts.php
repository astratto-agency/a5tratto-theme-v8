<?php

/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
::::::::::::::    * A_SETTINGS Remove query string from static resources
::::::::::::::      https://kinsta.com/it/knowledgebase/rimuovere-le-query-string-dalle-risorse-statiche/
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

function _remove_script_version($src)
{
    $parts = explode('?', $src);
    return $parts[0];
}

add_filter('script_loader_src', '_remove_script_version', 15, 1);
add_filter('style_loader_src', '_remove_script_version', 15, 1);


/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
::::::::::::::    * A_SETTINGS Add prefetching rules
::::::::::::::      https://authoritywebsiteincome.com/speed-up-wordpress-with-dns-prefetching/
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

function ism_dns_prefetch()
{
    echo '<meta http-equiv="x-dns-prefetch-control" content="on"><link rel="dns-prefetch" href="//code.jquery.com" />
<link rel="dns-prefetch" href="//fonts.gstatic.com" />
<link rel="dns-prefetch" href="//use.fontawesome.com" />
<link rel="dns-prefetch" href="//www.googletagmanager.com" />';
}

add_action('wp_head', 'ism_dns_prefetch', 0);

/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
::::::::::::::    * A_SETTINGS Imposto gli script che mi interessano come async & defer
::::::::::::::      in particolare google mappe.
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

function make_script_async($tag, $handle, $src)
{
    if ('googlemaps' != $handle) {
        return $tag;
    }

    return str_replace('<script', '<script async defer', $tag);
}

add_filter('script_loader_tag', 'make_script_async', 10, 3);

/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
::::::::::::::    * A_SETTINGS Carico la lista di CSS  e JS
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

function a5t_scripts()
{

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Autoload
    ::::::::::::::      jQuery is loaded using the same method from HTML5 Boilerplate:
    ::::::::::::::      It's kept in the header instead of footer to avoid conflicts with plugins.
    ::::::::::::::      Grab Google CDN's latest jQuery with a protocol relative URL; fallback to CDNJS if offline
    ::::::::::::::      Support added in init.php
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    if (!is_admin() && current_theme_supports('jquery-cdn')) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', 'https://code.jquery.com/jquery-1.11.3.min.js', array(), null, false);
        add_filter('script_loader_src', 'a5t_jquery_local_fallback', 10, 2);
    }
    wp_enqueue_script('jquery');

    wp_enqueue_script('jquery', '//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js');

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Popper
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    wp_enqueue_script('popper', get_template_directory_uri() . '/assets/popper/popper.min.js', array(), '2.9.2', true);

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Javascript for comments
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Attiva in base alla scalta Bootstrap 4.6.2 CSS JS
                        // Attiva libreria Bootstrap 4.6.2 CSS JS
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    if ($GLOBALS['assets_options']['A5T_SETTING_BOOTSTRAP']) {
        wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/bootstrap-4.6.2-dist/css/bootstrap.min.css');
        wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/bootstrap-4.6.2-dist/js/bootstrap.min.js', array(), '4.6.2', true);
    }

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Attiva in base alla scalta Fontawesome
                        // Attiva libreria Fontawesome fontawesome.com/icons
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    if ($GLOBALS['assets_options']['A5T_SETTING_FA']) {
        wp_enqueue_script('fa', 'https://use.fontawesome.com/releases/v5.15.1/js/all.js', array(), '5.15.1', true);
        wp_enqueue_style('fa', 'https://use.fontawesome.com/releases/v5.15.1/css/fontawesome.css');
        /*wp_enqueue_script('fab', 'https://use.fontawesome.com/releases/v5.15.1/js/brands.js', array(), '5.15.1', true);*/
        /*wp_enqueue_style('fab',  'https://use.fontawesome.com/releases/v5.15.1/css/brands.css');*/
    }

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Attiva in base alla scalta Animate CSS
                        // Attiva libreria Animate CSS animate.style
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    if ($GLOBALS['assets_options']['A5T_SETTING_ANIMATE']) {
        wp_enqueue_style('animate', get_template_directory_uri() . '/assets/animate-css/animate.css');
        wp_enqueue_script('viewportchecker', get_template_directory_uri() . '/assets/animate-css/viewportchecker.js');
    }

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Attiva in base alla scalta Hover CSS
                        // Attiva libreria Hover CSS ianlunn.github.io/Hover
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    if ($GLOBALS['assets_options']['A5T_SETTING_HOVER']) {
        wp_enqueue_style('hover', get_template_directory_uri() . '/assets/hover-css/css/hover.css');
    }

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Attiva in base alla scalta Owl Carousel CSS JS
                        // Attiva libreria Owl Carousel CSS JS owlcarousel2.github.io/OwlCarousel2
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    if ($GLOBALS['assets_options']['A5T_SETTING_OWL_CAROUSEL']) {
        wp_enqueue_style('owl_carousel', get_template_directory_uri() . '/assets/owl-carousel/owl.carousel.min.css');
        wp_enqueue_script('owl_carousel', get_template_directory_uri() . '/assets/owl-carousel/owl.carousel.min.js');
    }

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Attiva in base alla scalta Jarallax
                    // Attiva libreria Jarallax https://github.com/nk-o/jarallax
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    if ($GLOBALS['assets_options']['A5T_SETTING_JARALLAX']) {
        wp_enqueue_style('jarallax', get_template_directory_uri() . '/assets/jarallax-master/dist/jarallax.css');
        wp_enqueue_script('jarallax', get_template_directory_uri() . '/assets/jarallax-master/dist/jarallax.js', array(), '', true);
        wp_enqueue_script('jarallax_video', get_template_directory_uri() . '/assets/jarallax-master/dist/jarallax-video.js', array(), '', true);
        wp_enqueue_script('jarallax_elements', get_template_directory_uri() . '/assets/jarallax-master/dist/jarallax-element.js', array(), '', true);
    }

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Attiva in base alla scalta NProgress CSS JS
                        // Attiva libreria NProgress CSS JS https://ricostacruz.com/nprogress/
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    if ($GLOBALS['assets_options']['A5T_SETTING_NPROGRESS']) {
        wp_enqueue_style('nprogress', get_template_directory_uri() . '/assets/nprogress/nprogress.css');
        wp_enqueue_script('nprogress', get_template_directory_uri() . '/assets/nprogress/nprogress.js');
    }

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Attiva in base alla scalta Magic Mouse CSS JS
                        // Attiva libreria Magic Mouse CSS JS magicmousejs.web.app
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    if ($GLOBALS['assets_options']['A5T_SETTING_MAGIC_MOUSE']) {
        wp_enqueue_style('magic-mouse', get_template_directory_uri() . '/assets/magic-mouse-js/magic-mouse.css');
        wp_enqueue_script('magic-mouse', get_template_directory_uri() . '/assets/magic-mouse-js/magic_mouse.js');
    }

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Attiva in base alla scalta Butter JS
                        // Attiva libreria  Butter JS bcjdevelopment.github.io/butter.js
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    if ($GLOBALS['assets_options']['A5T_SETTING_BUTTER']) {
        wp_enqueue_script('butter', get_template_directory_uri() . '/assets/butter-js/butter.js');
    }

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Attiva in base alla scalta Cocoen CSS JS
                        // Attiva libreria Cocoen CSS JS github.com/jotform/before-after.js
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    if ($GLOBALS['assets_options']['A5T_SETTING_COCOEN']) {
        wp_enqueue_style('cocoen', get_template_directory_uri() . '/assets/cocoen/css/cocoen.min.css');
        wp_enqueue_script('cocoen', get_template_directory_uri() . '/assets/cocoen/js/cocoen.min.js');
    }


    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS CSS
                        // Carico lista percorsi CSS di terze parti in core/wp-config.php
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    foreach ($GLOBALS['A5T_SETTING_CSS'] as $nome => $percorso) {
        wp_enqueue_style($nome, $percorso);
    }

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS JS
                        // Carico lista percorsi JS di terze parti in core/wp-config.php
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    foreach ($GLOBALS['A5T_SETTING_JS'] as $nome => $percorso) {
        wp_enqueue_script($nome, $percorso);
    }

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Attiva in base alla scalta cookiechoices.js
                        // http://www.giovannifracasso.it/accettazione-cookies-privacy-banner/
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    if ($GLOBALS['assets_options']['A5T_SETTING_COOKIES']) {
        wp_enqueue_script('cookies', get_template_directory_uri() . '/assets/cookiechoices.js', array(), '1.0.0', true);
    }

}

add_action('wp_enqueue_scripts', 'a5t_scripts', 100);


function a5t_scripts_custom()
{
    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Carico style.css
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    wp_enqueue_style('style', get_template_directory_uri() . '/style.css');

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Carico style.css
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    wp_enqueue_style('main', get_template_directory_uri() . '/assets/main.css');

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Carico il CSS custom
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    wp_enqueue_style('custom', get_template_directory_uri() . '/assets/custom.css');

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Carico il JS custom
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    wp_enqueue_script('scripts', get_template_directory_uri() . '/assets/custom.js', array(), '1.0.0', true);

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Carico i Credits
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    wp_enqueue_script('credits', get_template_directory_uri() . '/assets/credits.js', array(), '1.0.0', true);

}

add_action('wp_enqueue_scripts', 'a5t_scripts_custom', 110);


/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
::::::::::::::    * A_SETTINGS Gestisco un sostituto per JQuery nel caso in cui il primo sia offline
::::::::::::::      http://wordpress.stackexchange.com/a/12450
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

function a5t_jquery_local_fallback($src, $handle = null)
{
    static $add_jquery_fallback = false;

    if ($add_jquery_fallback) {
        echo '<script>window.jQuery || document.write(\'<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"><\/script>\')</script>' . "\n";
        $add_jquery_fallback = false;
    }

    if ($handle === 'jquery') {
        $add_jquery_fallback = true;
    }

    return $src;
}

add_action('wp_head', 'a5t_jquery_local_fallback');


/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
::::::::::::::    * A_SETTINGS Cookies directive script
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/


function a5t_cookies()
{ ?>
    <script>
        document.addEventListener('DOMContentLoaded', function (event) {
            cookieChoices.showCookieConsentBar('<?php echo get_theme_mod("a5t_setting_pri_msg"); ?>', '<?php echo get_theme_mod("a5t_setting_pri_close"); ?>', '<?php echo get_theme_mod("a5t_setting_pri_title"); ?>', '<?php echo get_post_permalink(get_theme_mod("a5t_setting_pri_url")); ?>');
        });
    </script>
<?php }


if ($GLOBALS['assets_options']['A5T_SETTING_COOKIES']) {
    add_action('wp_footer', 'a5t_cookies', 20);
}

/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
::::::::::::::    * A_SETTINGS Google Analytics script
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

if (get_theme_mod('a5t_setting_analytics') != '') {
    function a5t_google_analytics()
    { ?>
        <!-- Google Analytics -->
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

            ga('create', '<?php echo get_theme_mod('a5t_setting_analytics'); ?>', 'auto');
            ga('send', 'pageview');
        </script>
        <!-- End Google Analytics -->
        <!-- Global Site Tag (gtag.js) - Google Analytics -->
        <script async
                src="https://www.googletagmanager.com/gtag/js?id=<?php echo get_theme_mod('a5t_setting_analytics'); ?>"></script>
        <script>
            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }

            gtag('js', new Date());

            gtag('config', '<?php echo get_theme_mod('a5t_setting_analytics'); ?>');
        </script>
    <?php }

    add_action('wp_head', 'a5t_google_analytics', 20);
}

/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
::::::::::::::    * A_SETTINGS Google Tag Manager
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
if (get_theme_mod('a5t_setting_gtag') != '') {


    function a5t_gtag_head_analytics()
    { ?>
        <!-- Google Tag Manager -->
        <script>(function (w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({
                    'gtm.start':
                        new Date().getTime(), event: 'gtm.js'
                });
                var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
                j.async = true;
                j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', '<?php echo get_theme_mod('a5t_setting_gtag'); ?>');
        </script>
        <!-- End Google Tag Manager -->
        <?php
    }

    add_action('wp_head', 'a5t_gtag_head_analytics', 20);


    function a5t_gtag_body_analytics()
    { ?>
        <!-- Google Tag Manager (noscript) -->
        <noscript>
            <iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo get_theme_mod('a5t_setting_gtag'); ?>"
                    height="0" width="0" style="display:none;visibility:hidden"></iframe>
        </noscript>
        <!-- End Google Tag Manager (noscript) -->
        <?php
    }

    add_action('after_body', 'a5t_gtag_body_analytics', 20);
}

/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
::::::::::::::    * A_SETTINGS Hotjar Tracking Code
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

if (get_theme_mod('a5t_setting_hotjar') != '') {
    function a5t_hotjar_analytics()
    { ?>
        <!-- Hotjar Tracking Code -->
        <script>

            (function (h, o, t, j, a, r) {
                h.hj = h.hj || function () {
                    (h.hj.q = h.hj.q || []).push(arguments)
                };
                h._hjSettings = {hjid:<?php echo get_theme_mod('a5t_setting_hotjar'); ?>, hjsv: 5};
                a = o.getElementsByTagName('head')[0];
                r = o.createElement('script');
                r.async = 1;
                r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
                a.appendChild(r);
            })(window, document, '//static.hotjar.com/c/hotjar-', '.js?sv=');
        </script>
    <?php }

    add_action('wp_footer', 'a5t_hotjar_analytics', 20);
}


/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
::::::::::::::    * A_SETTINGS Stampo log nome thempalte e versione
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

function a5t_theme_version()

{
    $theme = wp_get_theme();
    $theme_name = $theme->get('Name');
    $theme_version = $theme->get('Version');

    if (is_child_theme()) {
        $theme_parent = wp_get_theme()->parent();
        $theme_parent_name = $theme_parent->get('Name');
        $theme_parent_version = $theme_parent->get('Version');
        ?>
        <script>console.log('<?php echo $theme_parent_name . ' ' . $theme_parent_version ?>');</script>
        <script>console.log('<?php echo $theme_name . ' ' . $theme_version . ' => ' . $theme_parent_name . ' ' . $theme_parent_version ?>');</script>
        <?php
    } else {
        ?>
        <script>console.log('<?php echo $theme_name . ' -- ' . $theme_version ?>');</script>
        <?php
    }


}

add_action('wp_footer', 'a5t_theme_version', 22);

?>