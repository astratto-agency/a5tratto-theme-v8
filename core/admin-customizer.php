<?php
/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
::::::::::::::    * A_SETTINGS Aggiorno il CSS nell’area amministratore
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

function admin_style()
{
    wp_enqueue_style('admin-styles', get_template_directory_uri() . '/assets/wp-admin.css');
    /*    wp_enqueue_script( 'admin-script', get_template_directory_uri().'/assets/wp-admin.js', array( 'jquery' ), '1.2.1' );*/
}

// Esegue la funzione admin_style() all’azione admin_enqueue_scripts di WP
add_action('admin_enqueue_scripts', 'admin_style');
/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
::::::::::::::    * A_SETTINGS Customizer admin menu bar
                    https://heera.it/customize-admin-menu-bar-in-wordpress
                    https://webriti.com/customizing-wordpress-admin-bar/
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

function add_my_own_logo($wp_admin_bar)
{
    $args = array(
        'id' => 'my-logo',
        'meta' => array('class' => 'my-logo', 'title' => 'logo')
    );
    $wp_admin_bar->add_node($args);
}

add_action('admin_bar_menu', 'add_my_own_logo', 1);


add_action('admin_menu', 'linked_url');
function linked_url()
{
    add_menu_page('linked_url', 'ASTRATTO', 'read', 'astratto_site', '', 'dashicons-format-chat', 1);
}

add_action('admin_menu', 'linkedurl_function');
function linkedurl_function()
{
    global $menu;
    $menu[1][2] = "https://www.astratto.agency";
}

function login_background_image()
{
    echo '<style type="text/css">
        body.login{ background: #0000E5!important; }
        .login #backtoblog a, 
        .login #nav a { color:#ffffff; }
</style>';
}

add_action('login_head', 'login_background_image');


function login_logo()
{ ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/logo-astratto-v2-w.png);
            background-size: 313px;
            height: 26px;
            width: 100%;
        }
    </style>
<?php }

add_action('login_enqueue_scripts', 'login_logo');


function login_logo_url_title()
{
    return 'https://www.astratto.agency';
}

add_filter('login_headerurl', 'login_logo_url_title');


// WordPress Custom Font @ Admin
function custom_admin_open_sans_font()
{
    /*    echo '<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">' . PHP_EOL;*/
    echo '<style>body, #wpadminbar *:not([class="ab-icon"]), .wp-core-ui, .media-menu, .media-frame *, .media-modal *{font-family:"Montserrat",sans-serif !important;}</style>' . PHP_EOL;
}

add_action('admin_head', 'custom_admin_open_sans_font');

// WordPress Custom Font @ Admin Frontend Toolbar
function custom_admin_open_sans_font_frontend_toolbar()
{
    if (current_user_can('administrator')) {
        /*        echo '<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">' . PHP_EOL;*/
        echo '<style>#wpadminbar *:not([class="ab-icon"]){font-family:"Montserrat",sans-serif !important;}</style>' . PHP_EOL;
    }
}

add_action('wp_head', 'custom_admin_open_sans_font_frontend_toolbar');

// WordPress Custom Font @ Admin Login
function custom_admin_open_sans_font_login_page()
{
    if (stripos($_SERVER["SCRIPT_NAME"], strrchr(wp_login_url(), '/')) !== false) {
        /*        echo '<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">' . PHP_EOL;*/
        echo '<style>body{font-family:"Montserrat",sans-serif !important;}</style>' . PHP_EOL;
    }
}

add_action('login_head', 'custom_admin_open_sans_font_login_page');