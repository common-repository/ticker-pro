<?php

function ticker_pro_6489_shortcode($atts) {
       $a = shortcode_atts( array(
        'tickertitle' => 'BREAKING NEWS:',
    ), $atts );

    global $wpdb;
    $table_name = $wpdb->prefix . 'ticker_pro_6489';
    $sql = "SELECT name FROM $table_name ORDER BY id DESC";
    $results = $wpdb->get_results($sql);
    ?>
    <div class="ticker">
        <strong><?php echo $a['tickertitle'] ?></strong>
        <ul>
            <?php foreach ($results as $result) { ?>
                <li><?php echo $result->name; ?></li>
            <?php } ?>

        </ul>
    </div>
    <?php
}
add_shortcode('ticker-pro', 'ticker_pro_6489_shortcode');

