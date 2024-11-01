<?php

/*
  Plugin Name:Ticker Pro
  Plugin URI: https://wordpress.org/plugins/ticker-pro/
  Description:Ticker Pro probably the simplest and lightweight ticker in the world. Which display your ticker ony any page or post.
  Version: 3.0
  Author: Md Miraj Khan
  Author URI: https://www.upwork.com/o/profiles/users/_~012282969fe4714e35/
  License: License: GPLv2 or later

 */
/*
  This program is free software; you can redistribute it and/or
  modify it under the terms of the GNU General Public License
  as published by the Free Software Foundation; either version 2
  of the License, or (at your option) any later version.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

  Copyright 2005-2015 Automattic, Inc.
 */

// Make sure we don't expose any info if called directly
if (!function_exists('add_action')) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}
if (!function_exists('wp_get_current_user')) {
    include(ABSPATH . "wp-includes/pluggable.php");
}

define('TICKER_PRO_PLUGIN_DIR', plugin_dir_path(__FILE__));



require_once( TICKER_PRO_PLUGIN_DIR . '/includes/form-handler.php' );
require_once( TICKER_PRO_PLUGIN_DIR . '/includes/plugin_init.php' );
include_once( TICKER_PRO_PLUGIN_DIR . '/plugin_script.php');
require_once( TICKER_PRO_PLUGIN_DIR . '/includes/plugin_shortcode.php' );
require_once( TICKER_PRO_PLUGIN_DIR . '/includes/form-view.php' );
//require_once( TICKER_PRO_PLUGIN_DIR . '/includes/plugin-options.php' );



//Activation Hook
register_activation_hook(__FILE__, 'ticker_pro_6489_install');
//Deactivation Hook
//register_deactivation_hook(__FILE__, '');
//Uninstallhook
register_uninstall_hook(__FILE__, 'ticker_pro_6489_uninstall');





if (is_admin() && current_user_can('publish_pages')) {

// create custom plugin settings menu
    function ticker_pro_menu() {
        //create new top-level menu
        add_menu_page('My Cool Plugin Settings', 'Ticker Pro', 'administrator', __FILE__, 'ticker_pro_settings_page_view', 'dashicons-hammer');
    }

    add_action('admin_menu', 'ticker_pro_menu'); 
}
