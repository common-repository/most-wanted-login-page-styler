<?php
/**
 * Plugin Name: MOST_WANTED Login Page Styler
 * Description: The Login Page Customizations.
 * Version: 1.0.0
 * Author: MOST_WANTED
 * Author URI: https://mostwanted.lk/
 * Text Domain: yvk-login-styler
 *
 * @category Login
 * @author MOST_WANTED
 * @version 1.0.0
 */
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! class_exists( 'YVK_Login_Styler' ) ) :

/**
 * Main YVK_Login_Styler Class.
 *
 * @since  1.0
 */
final class YVK_Login_Styler {
	/**
	 * @var YVK_Login_Styler The one true YVK_Login_Styler
	 * @since  1.0
	 */
	private static $instance;

	/**
	 * Main YVK_Login_Styler Instance.
	 *
	 * Insures that only one instance of YVK_Login_Styler exists in memory at any one
	 * time. Also prevents needing to define globals all over the place.
	 *
	 * @since  1.0
	 * @static
	 * @staticvar array $instance
	 * @uses YVK_Login_Styler::setup_constants() Setup the constants needed.
	 * @uses YVK_Login_Styler::includes() Include the required files.
	 * @uses YVK_Login_Styler::load_textdomain() load the language files.
	 * @see YVK_Login_Styler()
	 * @return object|YVK_Login_Styler The one true YVK_Login_Styler
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof YVK_Login_Styler ) ) {
			self::$instance = new YVK_Login_Styler;
			self::$instance->setup_constants();

			// add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ) );

			self::$instance->includes();
			// self::$instance->roles         = new WIDGETOPTS_Roles();
		}
		return self::$instance;
	}

	/**
	 * Setup plugin constants.
	 *
	 * @access private
	 * @since 4.1
	 * @return void
	 */
	private function setup_constants() {

		// Plugin version.
		if ( ! defined( 'YVK_LOGIN_STYLER_PLUGIN_NAME' ) ) {
			define( 'YVK_LOGIN_STYLER_PLUGIN_NAME', 'YVK Login Styler' );
		}

		// Plugin version.
		if ( ! defined( 'YVK_LOGIN_STYLER_VERSION' ) ) {
			define( 'YVK_LOGIN_STYLER_VERSION', '1.0.0' );
		}

		// Plugin Folder Path.
		if ( ! defined( 'YVK_LOGIN_STYLER_PLUGIN_DIR' ) ) {
			define( 'YVK_LOGIN_STYLER_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
		}

		// Plugin Folder URL.
		if ( ! defined( 'YVK_LOGIN_STYLER_PLUGIN_URL' ) ) {
			define( 'YVK_LOGIN_STYLER_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
		}

		// Plugin Root File.
		if ( ! defined( 'YVK_LOGIN_STYLER_PLUGIN_FILE' ) ) {
			define( 'YVK_LOGIN_STYLER_PLUGIN_FILE', __FILE__ );
		}
	}

	/**
	 * Include required files.
	 *
	 * @access private
	 * @since 1.0
	 * @return void
	 */
	private function includes() {
		require_once YVK_LOGIN_STYLER_PLUGIN_DIR . 'includes/login-functions.php';
		if( is_admin() ){
			require_once YVK_LOGIN_STYLER_PLUGIN_DIR . 'includes/install.php';
			require_once YVK_LOGIN_STYLER_PLUGIN_DIR . 'includes/admin/settings.php';
		}
	}

}

endif; // End if class_exists check.

if( !function_exists( 'YVK_Login_Styler_FN' ) ){
	function YVK_Login_Styler_FN() {
		return YVK_Login_Styler::instance();
	}
	// Get Plugin Running.
	YVK_Login_Styler_FN();
}
?>
