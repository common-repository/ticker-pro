<?php

global $ticker_pro_6489_db_version;
$ticker_pro_6489_db_version = '1.0';

function ticker_pro_6489_install() {
    global $wpdb;
    global $ticker_pro_6489_db_version;

    $table_name = $wpdb->prefix . 'ticker_pro_6489';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		name tinytext NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
    add_option('ticker_pro_6489_db_version', $ticker_pro_6489_db_version);

//    Insert initial data to a database
    if ($wpdb->get_results('SELECT * FROM ' . $table_name) == null) {

        $ticker_text = 'Dummy Ticker Text';
        $wpdb->insert(
                $table_name, array(
            'name' => $ticker_text,
        ));
    }



//    Option registration
$options = array(
        'itemSpeed' => '3000', // The pause on each ticker item before being replaced
        'cursorSpeed' => '50', // Speed at which the characters are typed
        'pauseOnHover' => true, // Whether to pause when the mouse hovers over the ticker
        'finishOnHover' => true, // Whether or not to complete the ticker item instantly when moused over
        'fadeInSpeed' => 600, // Speed of the fade-in animation
        'fadeOutSpeed' => 300,   // Speed of the fade-out animation
        'ticker_heading_bd'=>'ff0000'
    );
   
    update_option('ticker_pro_options',$options);
    
}

// Delete table when deactivate
function ticker_pro_6489_deactive() {
    
}

function ticker_pro_6489_uninstall() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'ticker_pro_6489';
    $ticker_pro_6489_db_version = '1.0';

    $sql = "DROP TABLE IF EXISTS $table_name;";
    $wpdb->query($sql);
    delete_option('$ticker_pro_6489_db_version');
}
