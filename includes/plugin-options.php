<?php
 
/*
Plugin Name: My awesome plugin
Plugin URI: http://blog.samelh.com
Description: This is my awesome plugin, the first one I create btw :/
Author: Samuel Elh
Version: 0.1
Author URI: http://samelh.com
*/
 
add_action('admin_menu', function() {
    add_options_page( 'My awesome plugin settings', 'my awesome plugin', 'manage_options', 'my-awesome-plugin', 'my_awesome_plugin_page' );
});
 

 $options=array(
     'map_option_1'=>65,'map_option_2'=>65, 'map_option_3'=>658, 'map_option_4'=>674685, 'map_option_5'=>6, 'map_option_6'=>564
 );
add_action( 'admin_init', function() {
    
    register_setting( 'my-awesome-plugin-settings2', '$options' );

});
 
 
function my_awesome_plugin_page() {
  ?>
    <div class="wrap">
      <form action="options.php" method="post">
 
        <?php
          global $options;
          
          settings_fields( 'my-awesome-plugin-settings2' );
          do_settings_sections( 'my-awesome-plugin-settings' );
        ?>
        <table>
             
            <tr>
                <th>Your name</th>
                <td><input type="text" placeholder="Your name" name="map_option_1" value="<?php echo esc_attr( get_option('map_option_1') ); ?>" size="50" /></td>
            </tr>
            <tr>
                <th>Your biography</th>
                <td><textarea placeholder="Your bio" name="map_option_2" rows="5" cols="50"><?php echo esc_attr( get_option('map_option_2') ); ?></textarea></td>
            </tr>
 
            <tr>
                <th>Your age</th>
                <td>
 
                    <select name="map_option_3">
                        <option value="">&mdash; select &mdash;</option>
                        <option value="10-20" <?php echo esc_attr( get_option('map_option_3') ) == '10-20' ? 'selected="selected"' : ''; ?>>10-30</option>
                        <option value="20-30" <?php echo esc_attr( get_option('map_option_3') ) == '20-30' ? 'selected="selected"' : ''; ?>>20-30</option>
                        <option value="30-50" <?php echo esc_attr( get_option('map_option_3') ) == '30-50' ? 'selected="selected"' : ''; ?>>30-50</option>
                    </select>
 
                </td>
            </tr>
 
            <tr>
                <th>Your gender</th>
                <td>
                    <label>
                        <input type="radio" name="map_option_4" value="male" <?php echo esc_attr( get_option('map_option_4') ) == 'male' ? 'checked="checked"' : ''; ?> /> Male <br/>
                    </label>
                    <label>
                        <input type="radio" name="map_option_4" value="female" <?php echo esc_attr( get_option('map_option_4') ) == 'female' ? 'checked="checked"' : ''; ?> /> Female
                    </label>
                </td>
            </tr>
 
            <tr>
                <th>Do you love WordPress?</th>
                <td>
                    <label>
                        <input type="checkbox" name="map_option_5" <?php echo esc_attr( get_option('map_option_5') ) == 'on' ? 'checked="checked"' : ''; ?> />Yes, I love WordPress
                    </label><br/>
                    <label>
                        <input type="checkbox" name="map_option_6" <?php echo esc_attr( get_option('map_option_6') ) == 'on' ? 'checked="checked"' : ''; ?> />No, I love WordPress
                    </label>
                </td>
            </tr>
 
            <tr>
                <td><?php submit_button(); ?></td>
            </tr>
 
        </table>
 
      </form>
    </div>
  <?php
}
