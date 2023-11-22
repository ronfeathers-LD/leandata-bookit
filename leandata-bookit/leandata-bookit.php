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
