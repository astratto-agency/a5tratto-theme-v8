<?php
/*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
::::::::::::::    * A_SETTINGS WOOOCOMMERCE
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/


if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Conditional function detecting if the current user has an active subscription
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    function has_active_subscription($user_id = null)
    {
        // if the user_id is not set in function argument we get the current user ID
        if (null == $user_id)
            $user_id = get_current_user_id();

        // Get all active subscrptions for a user ID
        $active_subscriptions = get_posts(array(
            'numberposts' => -1,
            'meta_key' => '_customer_user',
            'meta_value' => $user_id,
            'post_type' => 'shop_subscription', // Subscription post type
            'post_status' => 'wcm-active', // Active subscription
        ));
        // if user has an active subscription
        if (!empty($active_subscriptions)) return true;
        else return false;
    }

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Conditionally checking and adding your subscription when a product is added to cart
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    add_action('woocommerce_add_to_cart', 'add_subscription_to_cart', 10, 6);
    function add_subscription_to_cart($cart_item_key, $product_id, $quantity, $variation_id, $variation, $cart_item_data)
    {

        // Here define your subscription product
        $subscription_id = '559';
        $found = false;

        if (is_admin() || has_active_subscription() || $product_id == $subscription_id) return;  // exit

        // Checking if subscription is already in cart
        foreach (WC()->cart->get_cart() as $cart_item) {
            if ($cart_item['product_id'] == $subscription_id) {
                $found = true;
                break;
            }
        }
        // if subscription is not found, we add it
        if (!$found)
            WC()->cart->add_to_cart($subscription_id);
    }


    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Add custom checkout field: woocommerce_review_order_before_submit
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    add_action('woocommerce_review_order_before_submit', 'my_custom_checkout_field_condizioni_generali');

    function my_custom_checkout_field_condizioni_generali()
    {
        echo '<div id="my_custom_checkout_field_condizioni_generali" class="col-12">';

        woocommerce_form_field('my_field_name_condizioni_generali', array(
            'type' => 'checkbox',
            'class' => array('input-checkbox'),
            'label' => __('Accetto termi e condizioni generali ( sendsrl.it/tec )'),
            'required' => true,
        ), WC()->checkout->get_value('my_field_name_condizioni_generali'));
        echo '</div> ';
    }

    add_action('woocommerce_review_order_before_submit', 'my_custom_checkout_field_privacy_policy');
    function my_custom_checkout_field_privacy_policy()
    {
        echo '<div id="my_custom_checkout_field_privacy_policy" class="col-12">';

        woocommerce_form_field('my_field_name_privacy_policy', array(
            'type' => 'checkbox',
            'class' => array('input-checkbox'),
            'label' => __('Dichiaro di aver preso visione della Privacy Policy ( sendsrl.it/tec )'),
            'required' => true,
        ), WC()->checkout->get_value('my_field_name_privacy_policy'));
        echo '</div> ';
    }

    add_action('woocommerce_review_order_before_submit', 'my_custom_checkout_field_informazioni_commerciali');
    function my_custom_checkout_field_informazioni_commerciali()
    {
        echo '<div id="my_custom_checkout_field_informazioni_commerciali" class="col-12">';

        woocommerce_form_field('my_field_name_informazioni_commerciali', array(
            'type' => 'checkbox',
            'class' => array('input-checkbox'),
            'label' => __('Acconsento a ricevere informazioni commerciali'),
        ), WC()->checkout->get_value('my_field_name_informazioni_commerciali'));
        echo '</div> ';
    }

    add_action('woocommerce_review_order_before_submit', 'my_custom_checkout_field_dati_terzi');
    function my_custom_checkout_field_dati_terzi()
    {
        echo '<div id="my_custom_checkout_field_dati_terzi" class="col-12">';

        woocommerce_form_field('my_field_name_dati_terzi', array(
            'type' => 'checkbox',
            'class' => array('input-checkbox'),
            'label' => __('Acconsento il trasferiemnto di dati a terzi'),
        ), WC()->checkout->get_value('my_field_name_dati_terzi'));
        echo '</div>';
    }


// Save the custom checkout field in the order meta, when checkbox has been checked
    add_action('woocommerce_checkout_update_order_meta', 'custom_checkout_field_update_order_meta', 10, 1);
    function custom_checkout_field_update_order_meta($order_id)
    {

        // if ( ! empty( $_POST['my_field_name'] ) )
        // update_post_meta( $order_id, 'my_field_name', $_POST['my_field_name'] );
        if (!empty($_POST['my_field_name_condizioni_generali']))
            update_post_meta($order_id, 'my_field_name_condizioni_generali', $_POST['my_field_name_condizioni_generali']);
        if (!empty($_POST['my_field_name_privacy_policy']))
            update_post_meta($order_id, 'my_field_name_privacy_policy', $_POST['my_field_name_privacy_policy']);
        if (!empty($_POST['my_field_name_informazioni_commerciali']))
            update_post_meta($order_id, 'my_field_name_informazioni_commerciali', $_POST['my_field_name_informazioni_commerciali']);
        if (!empty($_POST['my_field_name_dati_terzi']))
            update_post_meta($order_id, 'my_field_name_dati_terzi', $_POST['my_field_name_dati_terzi']);
    }

// Display the custom field result on the order edit page (backend) when checkbox has been checked
    add_action('woocommerce_admin_order_data_after_billing_address', 'display_custom_field_on_order_edit_pages', 10, 1);
    function display_custom_field_on_order_edit_pages($order)
    {
        $my_field_name = get_post_meta($order->get_id(), 'my_field_name', true);
        $my_field_name_condizioni_generali = get_post_meta($order->get_id(), 'my_field_name_condizioni_generali', true);
        $my_field_name_privacy_policy = get_post_meta($order->get_id(), 'my_field_name_privacy_policy', true);
        $my_field_name_informazioni_commerciali = get_post_meta($order->get_id(), 'my_field_name_informazioni_commerciali', true);
        $my_field_name_dati_terzi = get_post_meta($order->get_id(), 'my_field_name_dati_terzi', true);
        if ($my_field_name_condizioni_generali == 1)
            echo '<p><strong>Accetto termi e condizioni generali ( sendsrl.it/tec ): </strong> <span style="color:red;">Abilitiato</span></p><br>';
        if ($my_field_name_privacy_policy == 1)
            echo '<p><strong>Dichiaro di aver preso visione della Privacy Policy ( sendsrl.it/tec ): </strong> <span style="color:red;">Abilitiato</span></p><br>';
        if ($my_field_name_informazioni_commerciali == 1)
            echo '<p><strong>Acconsento a ricevere informazioni commerciali: </strong> <span style="color:red;">Abilitiato</span></p><br>';
        if ($my_field_name_dati_terzi == 1)
            echo '<p><strong>Acconsento il trasferiemnto di dati a terzi: </strong> <span style="color:red;">Abilitiato</span></p><br>';
    }

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Inseriemnto del Prezzo Totale se disponibile nel Prodotto
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/


    function show_sku_in_cart_items($item_name, $cart_item, $cart_item_key)
    {
        // The WC_Product object
        $product = $cart_item['data'];

        // Get the  SKU
        $prezzo_totale = $product->get_meta('prezzo_totale');
        $prezzo_scontato = $product->get_meta('prezzo_scontato');

        if ($prezzo_scontato) {
            $prezzo_effettivo = $prezzo_scontato;
        } else {
            $prezzo_effettivo = $prezzo_totale;
        }
        // When SKU doesn't exist
        if (empty($prezzo_totale))
            return $item_name;

        // Add SKU before
        if (is_cart()) {
            $item_name = '<b>Acconto </b><br>' . $item_name . '<br><small class="product-prezzo_totale">' . ' ( Totale del viaggio: ' . $prezzo_effettivo . ' €)</small><br>';
        } else {
            $item_name = '<b>Acconto </b><br>' . $item_name . '<br><small class="product-prezzo_totale">' . ' ( Totale del viaggio: ' . $prezzo_effettivo . ' €)</small><br>';
        }

        return $item_name;
    }

    add_filter('woocommerce_cart_item_name', 'show_sku_in_cart_items', 99, 3);

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Remove image zoom product
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/

    function remove_image_zoom_support()
    {
        /* remove image zoom hover */
        remove_theme_support('wc-product-gallery-zoom');
        /* remuve image zoom galley*/
        remove_theme_support('wc-product-gallery-lightbox');
    }

    add_action('wp', 'remove_image_zoom_support', 100);

    add_filter('woocommerce_single_product_image_thumbnail_html', 'wc_remove_link_on_thumbnails');

    function wc_remove_link_on_thumbnails($html)
    {
        return strip_tags($html, '<img>');
    }


    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Rename product data tabs
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    add_filter('woocommerce_product_tabs', 'woo_rename_tabs', 98);
    function woo_rename_tabs($tabs)
    {

        $tabs['description']['title'] = __('More Information');        // Rename the description tab
        $tabs['additional_information']['title'] = __('Product Data');    // Rename the additional information tab

        return $tabs;

    }

    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
    ::::::::::::::    * A_SETTINGS Utility function to get the childs array from a parent product category
    :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/


    function get_the_childs($product_category)
    {
        $taxonomy = 'product_cat';
        $parent = get_term_by('slug', sanitize_title($product_category), $taxonomy);
        return get_term_children($parent->term_id, $taxonomy);
    }


// Changing the add to cart button text
/*    add_filter('woocommerce_product_single_add_to_cart_text', 'product_cat_single_add_to_cart_button_text', 20, 1);
    function product_cat_single_add_to_cart_button_text($text)
    {
        global $product;
        if (has_term(get_the_childs('Viaggi'), 'product_cat', $product->get_id()))
            $text = __('PRENOTA ORA', 'woocommerce');
        elseif (has_term(get_the_childs('Membership'), 'product_cat', $product->get_id()))
            $text = __('ENTRA NELLA COMMUNITY', 'woocommerce');

        return $text;
    }*/
 
 


    function timber_set_product( $post ) {
        global $product;

        if ( is_woocommerce() ) {
            $product = wc_get_product( $post->ID );
        }
    }
}


