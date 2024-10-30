<?php
/**
 * Install Function
 *
 * @copyright   Copyright (c) 2017, Jeffrey Carandang
 * @since       1.0
*/
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

//add settings link on plugin page
if( !function_exists( 'yvk_login_styler_filter_plugin_actions' ) ){
  add_action( 'plugin_action_links_' . plugin_basename( YVK_LOGIN_STYLER_PLUGIN_FILE ) , 'yvk_login_styler_filter_plugin_actions' );
  function yvk_login_styler_filter_plugin_actions($links){
    $links[]  = '<a href="'. esc_url( admin_url( 'options-general.php?page=yvk_login_styler_plugin_settings' ) ) .'">' . __( 'Settings', 'yvk-login-styler' ) . '</a>';
    return $links;
  }
}

//register default values
if( !function_exists( 'yvk_login_styler_register_defaults' ) ){
	register_activation_hook( YVK_LOGIN_STYLER_PLUGIN_FILE, 'yvk_login_styler_register_defaults' );
  	add_action( 'plugins_loaded', 'yvk_login_styler_register_defaults' );
	function yvk_login_styler_register_defaults(){
		if( is_admin() ){

			if( !get_option( 'yvk_login_styler_installDate' ) ){
				add_option( 'yvk_login_styler_installDate', date( 'Y-m-d h:i:s' ) );
			}

		}
	}
}

?>
