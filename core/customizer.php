<?php

/**
 * @param $wp_customize
 */
function a5t_customize_register($wp_customize)
{
    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS GENERAL SETTINGS
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $wp_customize->add_section('a5t_framework_general_settings', array(
        'title' => __('General settings', 'a5t_framework'),
        'priority' => 120,
    ));


    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Post IDs viewable in the back-end
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/


    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Logo
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    ) );

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Google Fonts
                        // Attiva Google Fonts per ogni riga fonts.google.com
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/


    $wp_customize->add_setting('a5t_setting_google_fonts', array(
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('a5t_setting_google_fonts', array(
        'type' => 'textarea',
        'section' => 'a5t_framework_general_settings',
        'label' => __('Google Fonts'),
        'description' => __('Attiva Google Fonts per ogni riga fonts.google.com'),
    ));


    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Attiva in base alla scalta Bootstrap 4.6.2 CSS JS
                        // Attiva libreria Bootstrap 4.6.2 CSS JS
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $wp_customize->add_setting('a5t_setting_bootstrap', array(
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('a5t_setting_bootstrap', array(
        'type' => 'checkbox',
        'section' => 'a5t_framework_general_settings',
        'label' => __('Activate Bootstrap 4.6.2'),
        'description' => __('Attiva libreria Bootstrap 4.6.2 css/js'),

    ));

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Attiva in base alla scalta Fontawesome
                        // Attiva libreria Fontawesome 5.15.1 fontawesome.com/icons
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $wp_customize->add_setting('a5t_setting_fa', array(
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('a5t_setting_fa', array(
        'type' => 'checkbox',
        'section' => 'a5t_framework_general_settings',
        'label' => __('Fontawesome '),
        'description' => __('Attiva libreria Fontawesome 5.15.1 fontawesome.com/icons'),
    ));

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Attiva in base alla scalta Animate CSS
                        // Attiva libreria Animate CSS animate.style
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $wp_customize->add_setting('a5t_setting_animate', array(
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('a5t_setting_animate', array(
        'type' => 'checkbox',
        'section' => 'a5t_framework_general_settings',
        'label' => __('Animate CSS'),
        'description' => __('Attiva libreria Animate CSS animate.style'),
    ));

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Attiva in base alla scalta Hover CSS
                        // Attiva libreria Hover CSS ianlunn.github.io/Hover
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $wp_customize->add_setting('a5t_setting_hover', array(
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('a5t_setting_hover', array(
        'type' => 'checkbox',
        'section' => 'a5t_framework_general_settings',
        'label' => __('Hover CSS'),
        'description' => __('Attiva libreria Hover CSS ianlunn.github.io/Hover'),
    ));

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS owl_carousel CSS
                        // Attiva libreria Owl Carousel CSS JS owlcarousel2.github.io/OwlCarousel2
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $wp_customize->add_setting('a5t_setting_owl_carousel', array(
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('a5t_setting_owl_carousel', array(
        'type' => 'checkbox',
        'section' => 'a5t_framework_general_settings',
        'label' => __('Owl Carousel CSS JS'),
        'description' => __('Attiva libreria Owl Carousel CSS JS owlcarousel2.github.io/OwlCarousel2'),

    ));

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS jarallax
                        // Attiva libreria Jarallax https://github.com/nk-o/jarallax
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $wp_customize->add_setting('a5t_setting_jarallax', array(
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('a5t_setting_jarallax', array(
        'type' => 'checkbox',
        'section' => 'a5t_framework_general_settings',
        'label' => __('Jarallax'),
        'description' => __('Attiva libreria Jarallax https://github.com/nk-o/jarallax'),

    ));

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Attiva in base alla scalta NProgress CSS JS
                        // Attiva libreria NProgress CSS JS https://ricostacruz.com/nprogress/
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $wp_customize->add_setting('a5t_setting_nprogress', array(
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('a5t_setting_nprogress', array(
        'type' => 'checkbox',
        'section' => 'a5t_framework_general_settings',
        'label' => __('NProgress CSS JS'),
        'description' => __('Attiva libreria NProgress CSS JS https://ricostacruz.com/nprogress/'),
    ));

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Attiva in base alla scalta Magic Mouse CSS JS
                        // Attiva libreria Magic Mouse CSS JS magicmousejs.web.app
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $wp_customize->add_setting('a5t_setting_magic_mouse', array(
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('a5t_setting_magic_mouse', array(
        'type' => 'checkbox',
        'section' => 'a5t_framework_general_settings',
        'label' => __('Magic Mouse CSS JS'),
        'description' => __('Attiva libreria Magic Mouse CSS JS magicmousejs.web.app'),
    ));

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Attiva in base alla scalta Butter JS
                        // Attiva libreria  Butter JS bcjdevelopment.github.io/butter.js
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $wp_customize->add_setting('a5t_setting_butter', array(
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('a5t_setting_butter', array(
        'type' => 'checkbox',
        'section' => 'a5t_framework_general_settings',
        'label' => __('Butter JS'),
        'description' => __('Attiva libreria  Butter JS bcjdevelopment.github.io/butter.js'),

    ));

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Attiva in base alla scalta Cocoen CSS JS
                        // Attiva libreria Cocoen CSS JS github.com/jotform/before-after.js
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $wp_customize->add_setting('a5t_setting_cocoen', array(
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('a5t_setting_cocoen', array(
        'type' => 'checkbox',
        'section' => 'a5t_framework_general_settings',
        'label' => __('Cocoen CSS JS'),
        'description' => __('Attiva libreria Cocoen CSS JS github.com/jotform/before-after.js'),

    ));


    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Go To Top Button
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $wp_customize->add_setting('a5t_setting_gototop', array(
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('a5t_setting_gototop', array(
        'type' => 'checkbox',
        'section' => 'a5t_framework_general_settings',
        'label' => __('Go To Top Button'),
    ));

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Cookies
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $wp_customize->add_setting('a5t_setting_cookies', array(
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('a5t_setting_cookies', array(
        'type' => 'checkbox',
        'section' => 'a5t_framework_general_settings',
        'label' => __('Cookies'),
    ));

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Disable Comments
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $wp_customize->add_setting('a5t_setting_comments', array(
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('a5t_setting_comments', array(
        'type' => 'checkbox',
        'section' => 'a5t_framework_general_settings',
        'label' => __('Disable comments'),
    ));


    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Container / Fluid
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $wp_customize->add_setting('a5t_setting_main_container', array(
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('a5t_setting_main_container', array(
        'type' => 'select',
        'section' => 'a5t_framework_general_settings',
        'label' => __('Main Container'),
        'description' => __('Scegli la tipologia di container'),
        'choices' => array(
            'container' => __('Section Boxed ( container )'),
            'container-fluid' => __('Section Full Width ( container-fluid )'),
        ),
    ));

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS TRACKING SETTINGS
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $wp_customize->add_section('a5t_framework_tracking_settings', array(
        'title' => __('Tracking settings', 'a5t_framework'),
        'priority' => 120,
    ));

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Google Analytics
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $wp_customize->add_setting('a5t_setting_analytics', array(
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('a5t_setting_analytics', array(
        'type' => 'text',
        'section' => 'a5t_framework_tracking_settings',
        'label' => __('Google Analytics UID'),
    ));

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Google Mps Apy
                    Inserisci API key di Google Maps console.cloud.google.com
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $wp_customize->add_setting('a5t_setting_maps', array(
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('a5t_setting_maps', array(
        'type' => 'text',
        'section' => 'a5t_framework_tracking_settings',
        'label' => __('GMaps API KEY'),
        'description' => __('Inserisci API key di Google Maps console.cloud.google.com'),
    ));

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Google Tag
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $wp_customize->add_setting('a5t_setting_gtag', array(
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('a5t_setting_gtag', array(
        'type' => 'text',
        'section' => 'a5t_framework_tracking_settings',
        'label' => __('Google Tag ID'),
    ));


    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Hot Jar
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $wp_customize->add_setting('a5t_setting_hotjar', array(
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('a5t_setting_hotjar', array(
        'type' => 'text',
        'section' => 'a5t_framework_tracking_settings',
        'label' => __('Hotjar ID'),
    ));


    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS COOKIES SETTINGS
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $wp_customize->add_section('a5t_framework_cookies_settings', array(
        'title' => __('Cookies settings', 'a5t_framework'),
        'priority' => 120,
    ));

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Privacy Message
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $wp_customize->add_setting('a5t_setting_pri_msg', array(
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('a5t_setting_pri_msg', array(
        'type' => 'textarea',
        'section' => 'a5t_framework_cookies_settings',
        'label' => __('Privacy Policy message'),
    ));

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Privacy close text
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $wp_customize->add_setting('a5t_setting_pri_close', array(
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('a5t_setting_pri_close', array(
        'type' => 'text',
        'section' => 'a5t_framework_cookies_settings',
        'label' => __('Close button message'),
    ));

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Privacy title
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $wp_customize->add_setting('a5t_setting_pri_title', array(
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('a5t_setting_pri_title', array(
        'type' => 'text',
        'section' => 'a5t_framework_cookies_settings',
        'label' => __('Privacy Policy title'),
    ));

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Privacy url
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $wp_customize->add_setting('a5t_setting_pri_url', array(
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('a5t_setting_pri_url', array(
        'type' => 'dropdown-pages',
        'section' => 'a5t_framework_cookies_settings',
        'label' => __('Privacy Policy URL'),
    ));

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS ADVANCED SETTINGS
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $wp_customize->add_section('a5t_framework_advanced_settings', array(
        'title' => __('Advanced settings', 'a5t_framework'),
        'priority' => 120,
    ));

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Privacy Message
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $wp_customize->add_setting('a5t_adv_twig', array(
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('a5t_adv_twig', array(
        'type' => 'checkbox',
        'section' => 'a5t_framework_advanced_settings',
        'label' => __('Twig'),
    ));

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS COOKIES SETTINGS
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $wp_customize->add_setting('a5t_adv_adminbar', array(
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('a5t_adv_adminbar', array(
        'type' => 'checkbox',
        'section' => 'a5t_framework_advanced_settings',
        'label' => __('Hide Admin Bar'),
    ));

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS COOKIES SETTINGS
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $wp_customize->add_section('a5t_framework_theme_fileds', array(
        'title' => __('Theme Fields', 'a5t_framework'),
        'priority' => 120,
    ));

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Intestazione Principale
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $wp_customize->add_setting('a5t_setting_intestazione', array(
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('a5t_setting_intestazione', array(
        'type' => 'text',
        'section' => 'a5t_framework_theme_fileds',
        'label' => __('Intestazione'),
    ));

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS P. IVA Principale
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    $wp_customize->add_setting('a5t_setting_piva', array(
        'capability' => 'edit_theme_options',
    ));
    $wp_customize->add_control('a5t_setting_piva', array(
        'type' => 'text',
        'section' => 'a5t_framework_theme_fileds',
        'label' => __('P. IVA'),
    ));


    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS THEME FIELDS
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    $wp_customize->add_section('a5t_framework_theme_fileds', [
        'title' => __('Theme Fields', 'a5t_framework'),
        'priority' => 120,
    ]);


    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Intestazione Principale
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    $wp_customize->add_setting('a5t_setting_intestazione', [
        'capability' => 'edit_theme_options',
    ]);
    $wp_customize->add_control('a5t_setting_intestazione', [
        'type' => 'text',
        'section' => 'a5t_framework_theme_fileds',
        'label' => __('Intestazione'),
    ]);

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS P. IVA Principale
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    $wp_customize->add_setting('a5t_setting_piva', [
        'capability' => 'edit_theme_options',
    ]);
    $wp_customize->add_control('a5t_setting_piva', [
        'type' => 'text',
        'section' => 'a5t_framework_theme_fileds',
        'label' => __('P. IVA'),
    ]);

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Numero Rea Principale
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    $wp_customize->add_setting('a5t_setting_rea', [
        'capability' => 'edit_theme_options',
    ]);
    $wp_customize->add_control('a5t_setting_rea', [
        'type' => 'text',
        'section' => 'a5t_framework_theme_fileds',
        'label' => __('N° REA'),
    ]);

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Cap Sociale Principale
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    $wp_customize->add_setting('a5t_setting_cap_soc', [
        'capability' => 'edit_theme_options',
    ]);
    $wp_customize->add_control('a5t_setting_cap_soc', [
        'type' => 'text',
        'section' => 'a5t_framework_theme_fileds',
        'label' => __('Capitale Sociale'),
    ]);

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Indirizzo 1 Principale
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    $wp_customize->add_setting('a5t_setting_indirizzo_1', [
        'capability' => 'edit_theme_options',
    ]);
    $wp_customize->add_control('a5t_setting_indirizzo_1', [
        'type' => 'text',
        'section' => 'a5t_framework_theme_fileds',
        'label' => __('Indirizzo 1'),
    ]);

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Indirizzo 2
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    $wp_customize->add_setting('a5t_setting_indirizzo_2', [
        'capability' => 'edit_theme_options',
    ]);
    $wp_customize->add_control('a5t_setting_indirizzo_2', [
        'type' => 'text',
        'section' => 'a5t_framework_theme_fileds',
        'label' => __('Indirizzo 2'),
    ]);

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Indirizzo 3
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    $wp_customize->add_setting('a5t_setting_indirizzo_3', [
        'capability' => 'edit_theme_options',
    ]);
    $wp_customize->add_control('a5t_setting_indirizzo_3', [
        'type' => 'text',
        'section' => 'a5t_framework_theme_fileds',
        'label' => __('Indirizzo 3'),
    ]);

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Telefono 1 Pricipale
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    $wp_customize->add_setting('a5t_setting_tel_1', [
        'capability' => 'edit_theme_options',
    ]);
    $wp_customize->add_control('a5t_setting_tel_1', [
        'type' => 'text',
        'section' => 'a5t_framework_theme_fileds',
        'label' => __('Telefono 1 Principale'),
    ]);

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Telefono 2
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    $wp_customize->add_setting('a5t_setting_tel_2', [
        'capability' => 'edit_theme_options',
    ]);
    $wp_customize->add_control('a5t_setting_tel_2', [
        'type' => 'text',
        'section' => 'a5t_framework_theme_fileds',
        'label' => __('Telefono 2'),
    ]);

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Fax Pricipale
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    $wp_customize->add_setting('a5t_setting_fax', [
        'capability' => 'edit_theme_options',
    ]);
    $wp_customize->add_control('a5t_setting_fax', [
        'type' => 'text',
        'section' => 'a5t_framework_theme_fileds',
        'label' => __('Fax'),
    ]);

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Mail 1 Principale
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    $wp_customize->add_setting('a5t_setting_mail_1', [
        'capability' => 'edit_theme_options',
    ]);
    $wp_customize->add_control('a5t_setting_mail_1', [
        'type' => 'text',
        'type' => 'text',
        'section' => 'a5t_framework_theme_fileds',
        'label' => __('Mail 1 Principale'),
    ]);

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Mail 2 Secondaria
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    $wp_customize->add_setting('a5t_setting_mail_2', [
        'capability' => 'edit_theme_options',
    ]);
    $wp_customize->add_control('a5t_setting_mail_2', [
        'type' => 'text',
        'section' => 'a5t_framework_theme_fileds',
        'label' => __('Mail 2 Secondaria'),
    ]);

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Mail 3
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    $wp_customize->add_setting('a5t_setting_mail_3', [
        'capability' => 'edit_theme_options',
    ]);
    $wp_customize->add_control('a5t_setting_mail_3', [
        'type' => 'text',
        'section' => 'a5t_framework_theme_fileds',
        'label' => __('Mail 3'),
    ]);

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS LInkedin
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    $wp_customize->add_setting('a5t_setting_linkedin', [
        'capability' => 'edit_theme_options',
    ]);
    $wp_customize->add_control('a5t_setting_linkedin', [
        'type' => 'text',
        'section' => 'a5t_framework_theme_fileds',
        'label' => __('Linkedin'),
    ]);

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Fecebook
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    $wp_customize->add_setting('a5t_setting_facebook', [
        'capability' => 'edit_theme_options',
    ]);
    $wp_customize->add_control('a5t_setting_facebook', [
        'type' => 'text',
        'section' => 'a5t_framework_theme_fileds',
        'label' => __('Facebook'),
    ]);

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Instagram
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    $wp_customize->add_setting('a5t_setting_instagram', [
        'capability' => 'edit_theme_options',
    ]);
    $wp_customize->add_control('a5t_setting_instagram', [
        'type' => 'text',
        'section' => 'a5t_framework_theme_fileds',
        'label' => __('Instagram'),
    ]);


}

add_action('customize_register', 'a5t_customize_register');