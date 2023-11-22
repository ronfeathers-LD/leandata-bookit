<?php
/**
 * LeanData BookIt
 *
 * @package       LDBOOKIT
 * @author        Ron Feathers
 * @license       gplv2
 * @version       1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:   LeanData BookIt
 * Plugin URI:    https://mydomain.com
 * Description:   LeanData BookIt 
 * Version:       1.0.0
 * Author:        Ron Feathers
 * Author URI:    www.leandata.com
 * Text Domain:   leandata-bookit
 * Domain Path:   /languages
 * License:       GPLv2
 * License URI:   https://www.gnu.org/licenses/gpl-2.0.html
 *
 * You should have received a copy of the GNU General Public License
 * along with LeanData BookIt. If not, see <https://www.gnu.org/licenses/gpl-2.0.html/>.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * HELPER COMMENT START
 * 
 * This file contains the main information about the plugin.
 * It is used to register all components necessary to run the plugin.
 * 
 * The comment above contains all information about the plugin 
 * that are used by WordPress to differenciate the plugin and register it properly.
 * It also contains further PHPDocs parameter for a better documentation
 * 
 * The function LDBOOKIT() is the main function that you will be able to 
 * use throughout your plugin to extend the logic. Further information
 * about that is available within the sub classes.
 * 
 * HELPER COMMENT END
 */

// Plugin name
define( 'LDBOOKIT_NAME',			'LeanData BookIt' );

// Plugin version
define( 'LDBOOKIT_VERSION',		'1.0.0' );

// Plugin Root File
define( 'LDBOOKIT_PLUGIN_FILE',	__FILE__ );

// Plugin base
define( 'LDBOOKIT_PLUGIN_BASE',	plugin_basename( LDBOOKIT_PLUGIN_FILE ) );

// Plugin Folder Path
define( 'LDBOOKIT_PLUGIN_DIR',	plugin_dir_path( LDBOOKIT_PLUGIN_FILE ) );

// Plugin Folder URL
define( 'LDBOOKIT_PLUGIN_URL',	plugin_dir_url( LDBOOKIT_PLUGIN_FILE ) );

/**
 * Load the main class for the core functionality
 */
require_once LDBOOKIT_PLUGIN_DIR . 'core/class-leandata-bookit.php';

/**
 * The main function to load the only instance
 * of our master class.
 *
 * @author  Ron Feathers
 * @since   1.0.0
 * @return  object|Leandata_Bookit
 */
function LDBOOKIT() {
	return Leandata_Bookit::instance();
}

LDBOOKIT();




function Leandata_Bookit_menu() {
    add_menu_page('LeanData BookIt Settings', 'LeanData BookIt', 'manage_options', 'Leandata_Bookit', 'Leandata_Bookit_page', plugins_url( 'leandata-bookit/core/includes/img/ld-logo-26x26.png' ));
}
add_action('admin_menu', 'Leandata_Bookit_menu');

function Leandata_Bookit_page() {
    ?>
    <div class="wrap">
        <h2>LeanData BookIt Settings</h2>
        <form method="post" action="options.php">
            <?php
            settings_fields('Leandata_Bookit_settings');
            do_settings_sections('Leandata_Bookit');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

function Leandata_Bookit_settings() {
    //LeanData values
    register_setting('Leandata_Bookit_settings', 'bookit_salesforce_id');
    register_setting('Leandata_Bookit_settings', 'bookit_node_name');
    register_setting('Leandata_Bookit_settings', 'bookit_log_id');
    
    //Hubspot values
    register_setting('Leandata_Bookit_settings', 'hubspot_region');
    register_setting('Leandata_Bookit_settings', 'hubspot_portal_id');
    register_setting('Leandata_Bookit_settings', 'hubspot_form_id');

    add_settings_section('Leandata_Bookit', 'Plugin Settings', 'Leandata_Bookit_section', 'Leandata_Bookit');

    add_settings_field('bookit_salesforce_id', 'Salesforce ID','bookit_salesforce_id', 'Leandata_Bookit', 'Leandata_Bookit');
    add_settings_field('bookit_node_name', 'BookIt Node Name','bookit_node_name', 'Leandata_Bookit', 'Leandata_Bookit');
    add_settings_field('bookit_log_id', 'BookIt Log ID','bookit_log_id', 'Leandata_Bookit', 'Leandata_Bookit');

    add_settings_field('hubspot_region', 'HubSpot Region (NA1)', 'hubspot_region', 'Leandata_Bookit', 'Leandata_Bookit');
    add_settings_field('hubspot_portal_id', 'HubSpot Portal ID', 'hubspot_portal_id', 'Leandata_Bookit', 'Leandata_Bookit');
    add_settings_field('hubspot_form_id', 'HubSpot Form ID', 'hubspot_form_id', 'Leandata_Bookit', 'Leandata_Bookit');
}

function Leandata_Bookit_section() {
    echo '<p>Enter your plugin settings below:</p>';
}

function bookit_salesforce_id() {
    echo '<input type="text" name="bookit_salesforce_id" value="' . esc_attr(get_option('bookit_salesforce_id')) . '" />';
}

function bookit_node_name() {
    echo '<input type="text" name="bookit_node_name" value="' . esc_attr(get_option('bookit_node_name')) . '" />';
}

function bookit_log_id() {
    echo '<input type="text" name="bookit_log_id" value="' . esc_attr(get_option('bookit_log_id')) . '" />';
}

function hubspot_region() {
    echo '<input type="text" name="hubspot_region" value="' . esc_attr(get_option('hubspot_region')) . '" />';
}

function hubspot_form_id() {
    echo '<input type="text" name="hubspot_form_id" value="' . esc_attr(get_option('hubspot_form_id')) . '" />';
}

function hubspot_portal_id() {
    echo '<input type="text" name="hubspot_portal_id" value="' . esc_attr(get_option('hubspot_portal_id')) . '" />';
}
add_action('admin_init', 'Leandata_Bookit_settings');


function ld_bookit_shortcode($atts) {
    // Retrieve stored parameters
    $salesforce_id = get_option('salesforce_id');
    $hubspot_region = get_option('hubspot_region');
    $hubspot_portal_id = get_option('hubspot_portal_id');
    $hubspot_form_id = get_option('hubspot_form_id');
    $bookit_node_name = get_option('bookit_node_name');
    $bookit_log_id = get_option('bookit_log_id');

$output = '
    <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>
    <script>
    hbspt.forms.create({
      region: "'.$hubspot_region.'",
      portalId: "'.$hubspot_portal_id.'",
      formId: "'.$hubspot_form_id.'",
      onFormReady: ((form) => trySettingFormTarget(form)), //add this (also possible that this just needs to be trySettingFormTarget(form)
      onFormSubmitted: (() => LDBookItV2.submit()) //add this
    });
    </script>

    <script>
    function trySettingFormTarget(form) {
      if (LDBookItV2 && LDBookItV2.setFormTarget) {
        LDBookItV2.setFormTarget(form);
      }
      else {
        window.setTimeout(() => trySettingFormTarget(), 2000);
      }
    }
    var _ld_scriptEl = document.createElement("script");
    _ld_scriptEl.src = "https://cdn.leandata.com/js-snippet/ld-book-v2.js";
    _ld_scriptEl.addEventListener("load", function() {
    LDBookItV2.initialize("'.$salesforce_id.'", "'.$bookit_node_name.'", "'.$bookit_log_id.'");
    });
    document.body.appendChild(_ld_scriptEl);
    </script>';

    return $output;
}
add_shortcode('ld_bookit_shortcode','ld_bookit_shortcode');


