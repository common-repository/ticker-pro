<?php
if (is_admin() && 'POST' == $_SERVER['REQUEST_METHOD'] && isset($_POST['ticker_pro_nonce'])) {

//    ---------------Add section Form Handaller------------
    if (!empty($_POST['ticker_text']) && wp_verify_nonce($_POST['ticker_pro_nonce'], 'ticker_pro_nonce_add')) {

        global $wpdb;
        $ticker_text = sanitize_text_field($_POST['ticker_text']);
        if ($ticker_text == false) {
            add_action('admin_notices', 'ticker_pro_error_massage');
        } else {
            $table_name = $wpdb->prefix . 'ticker_pro_6489';
            $wpdb->insert(
                    $table_name, array(
                'name' => $ticker_text,
                    )
            );
        }
    }elseif (!empty($_POST['delete_ticker']) && !empty($_POST['ticker_id']) && is_numeric($_POST['ticker_id']) && wp_verify_nonce($_POST['ticker_pro_nonce'], 'ticker_pro_nonce_delete')) {

        global $wpdb;
        $table_name = $wpdb->prefix . 'ticker_pro_6489';
        $ticker_id = $_POST['ticker_id'];
        $wpdb->delete($table_name, array('id' => $ticker_id), array('%d'));
    } elseif (empty($_POST['ticker_text']) && wp_verify_nonce($_POST['ticker_pro_nonce'], 'ticker_pro_nonce_add')) {
        add_action('admin_notices', 'ticker_pro_error_massage');
    }
    //    ---------------Add section Form Handaller End------------
    //    
//    -----------------Option section controll--------
    if (wp_verify_nonce($_POST['ticker_pro_nonce'], 'ticker_pro_nonce_options')) {
        $options = $_POST['ticker_pro'];
        
        $options['ticker_heading_bd']=trim($options['ticker_heading_bd'],"#");   //Triming hex color code
        
        
        if (empty($options['itemSpeed']) or empty($options['cursorSpeed']) or  !is_numeric($options['itemSpeed']) or !is_numeric($options['cursorSpeed']) or !ctype_xdigit($options['ticker_heading_bd']) or strlen($options['ticker_heading_bd'])!=6) {
            //Cheking the user input
                    
//             ---------Admin notice--------
            add_action('admin_notices', function() {
                ?>
                <div class="notice notice-success is-dismissible">
                    <p><?php _e('Please! Enter a valid text format', 'sample-text-domain'); ?></p>
                </div>
                <?php
            });
        } else {
//            Update options
     
    
           
            isset($options['pauseOnHover']) ? $options['pauseOnHover'] = true : $options['pauseOnHover'] = false;
            update_option('ticker_pro_options', $options);
        }
    }
    //    -----------------Option section controll ens--------
}

//-----------form handeller end

function ticker_pro_error_massage() {
    ?>
    <div class="notice notice-success is-dismissible">
        <p><?php _e('Please! Enter a valid text format', 'sample-text-domain'); ?></p>
    </div>
    <?php
}
