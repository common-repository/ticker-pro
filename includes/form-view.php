<?php

function ticker_pro_settings_page_view() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'ticker_pro_6489';
    $sql = "SELECT * FROM $table_name ORDER BY id DESC";
    $results = $wpdb->get_results($sql);
    ?>

    <!--    <head>
            <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        </head>-->
    <div class="containerpostbox " id="ticker_pro_container">
        <div class="row">
            <div class="col-md-1"></div>

            <!--------------------Options Sections---------------->
            <div class="col-md-4">
                <form method="POST" action>
                    <?php
                    wp_nonce_field('ticker_pro_nonce_options', 'ticker_pro_nonce');
                    $option = get_option('ticker_pro_options');
                    ?>
                    <h2>Ticker Pro Options</h2>
                    <table class="table">


                        <tr>
                            <th>
                                <label for="ticker_heading_bd">Ticker Heading Bacgroung</label>
                            </th>
                            <td>
                                <div id="ticker_heading_bd" class="input-group colorpicker-component">
                                    <input class="form-control"  type="text " required value="<?php echo $option['ticker_heading_bd'] ?>" name="ticker_pro[ticker_heading_bd]" class="form-control" />
                                    <span class="input-group-addon"><i></i></span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="itemSpeed">Ticker Item Speed</label>
                            </th>
                            <td>
                                <input type=""  class="form-control" required id="itemSpeed" name="ticker_pro[itemSpeed]" value="<?php echo $option['itemSpeed'] ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <th><label for="cursorSpeed">Ticker Cursor Speed</label></th>
                            <td>
                                <input id="cursorSpeed" class="form-control" required name="ticker_pro[cursorSpeed]" value="<?php echo $option['cursorSpeed'] ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="pauseOnHover">Ticker Pushe On Hover</label>
                            </th>
                            <td>
                                <input class="form-control" type="checkbox" id="pauseOnHover" name="ticker_pro[pauseOnHover]"  <?php echo checked($option['pauseOnHover']) ?> />
                            </td>
                        </tr>
                        <tr>

                            <td></td>
                            <td><?php submit_button(); ?></td>
                        </tr>
                    </table>
                </form>

            </div>
            <!--------------------Options section End----------------->

            <div class="col-md-1"></div>

            <!------------------------------Add section--------------------->
            <div class="col-md-5">
                <form  id="new_ticker" name="new_ticker" method="post" action>
                    <?php wp_nonce_field('ticker_pro_nonce_add', 'ticker_pro_nonce'); ?>
                    <div class="form-group">
                        <label  for="title">Add Ticker Text</label><br />
                        <input class="form-control" type="text" id="title" value=""tabindex="1" size="20" name="ticker_text" />
                    </div>
                    <input class="btn btn-primary" type="submit" value="Add" name="submit" />
                </form>

                <div class="edit_ticker">
                    <?php wp_nonce_field('edit_ticker'); ?>
                    <h3 class="text-center">All Tickers</h3>
                    <table class="table table-hover">
                        <?php foreach ($results as $result) {
                            ?>

                            <tr>
                                <td class="text-left" style="width: 100%"><?php echo $result->name ?></td>
                                <!--<td class="text-right"><input class="btn btn-warning" type="submit" name="edit_ticker" value="Edit"/></td>-->
                                <td class="text-right"><form  method="post" action> <?php wp_nonce_field('ticker_pro_nonce_delete', 'ticker_pro_nonce'); ?><input type="hidden" name="ticker_id" value="<?php echo $result->id ?>" /><input class="btn btn-danger" name="delete_ticker" type="submit" value="Delete" /></form></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
            <!------------------------------Add section en--------------------->

        </div>

    </div>

    <?php
}
