<?php

function ticker_pro_admin_style($hook) {

    if ($hook != 'toplevel_page_ticker-pro/ticker-pro') {
        return;
    }
    wp_enqueue_style('ticker_pro_admin_css', plugin_dir_url(__FILE__) . 'css/main.css');
    wp_enqueue_style('bootstrap_admin_css', plugin_dir_url(__FILE__) . 'css/bootstrap.min.css');

//    color picker
    wp_enqueue_style('bootstrap-colorpicker_css', plugin_dir_url(__FILE__) . 'color-picker/css/bootstrap-colorpicker.min.css');
    wp_enqueue_script('bootstrap-colorpicker_js', plugin_dir_url(__FILE__) . 'color-picker/js/bootstrap-colorpicker.min.js', array('jquery'), 2.5, true);
    wp_enqueue_script('bootstrap-colorpicker_activator_js', plugin_dir_url(__FILE__) . 'color-picker/js/bootstrap-colorpicker-activator.js', array('jquery'), null, true);
}

add_action('admin_enqueue_scripts', 'ticker_pro_admin_style');

function ticker_plugin_script() {

    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery_ticker', plugin_dir_url(__FILE__) . 'js/jquery.ticker.js', array('jquery'), 2.1, true);
}

add_action('init', 'ticker_plugin_script');

function ticker_init_script() {
    $option = get_option('ticker_pro_options');
    $itemSpeed = $option['itemSpeed'];
    $cursorSpeed = $option['cursorSpeed'];
    $pauseOnHover = $option['pauseOnHover'];
    $pauseOnHover ? $pauseOnHover = 'true' : $pauseOnHover = 'false';
    $finishOnHover = $option['finishOnHover'];

    $fade = $option['fade=$option'];
    $fadeInSpeed = $option['fadeInSpeed'];
    $fadeOutSpeed = $option['fadeOutSpeed'];
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('.ticker').ticker(
                    {
                        itemSpeed: <?php echo $itemSpeed ?>, // The pause on each ticker item before being replaced
                        cursorSpeed: <?php echo $cursorSpeed ?>, // Speed at which the characters are typed
                        pauseOnHover: <?php echo $pauseOnHover ?>, // Whether to pause when the mouse hovers over the ticker
                        finishOnHover: true, // Whether or not to complete the ticker item instantly when moused over
                        cursorOne: '_', // The symbol for the first part of the cursor
                        cursorTwo: '-', // The symbol for the second part of the cursor
                        fade: true, // Whether to fade between ticker items or not
                        fadeInSpeed: 600, // Speed of the fade-in animation
                        fadeOutSpeed: 300    // Speed of the fade-out animation
                    });
        });

    </script>

    <?php
}

add_action('wp_footer', 'ticker_init_script', 1000);

function ticker_style() {
    $option = get_option('ticker_pro_options');
    
    ?>
    <style>
        .ticker {
            width: 100%;
            margin: 10px auto;
            background-color: #f5f5f5;
        }
        /* The HTML list gets replaced with a single div,
           which contains the active ticker item, so you
           can easily style that as well */
        .ticker div {
            display: inline;
            word-wrap: break-word;

        }
        .ticker strong{
            background-color: #<?php echo $option['ticker_heading_bd'] ?>;
            padding: 2px 15px;
            border-radius: 0px 1000px 1000px 0px;
        }
    </style>  

    <?php
}

add_action('wp_head', 'ticker_style');
