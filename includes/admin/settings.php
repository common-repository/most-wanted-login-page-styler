<?php
/**
 * Admin Options Page
 * Login Page Styler
 *
 * @copyright   Copyright (c) 2017, Jeffrey Carandang
 * @since       1.0
*/
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Creates the admin submenu pages under the Settings menu and assigns their
 *
 * @since 1.0
 * @return void
 */
if( !function_exists( 'yvk_login_styler_options_link' ) ):
    function yvk_login_styler_options_link() {
        $iconPath = plugins_url( 'yvk-login-styler/assets/images/yvk-logo-small.png' );
        add_menu_page(
			__( 'Login Page Styler', 'yvk-login-styler' ),
			__( 'Login Page Styler', 'yvk-login-styler' ),
			'manage_options',
			'yvk_login_styler_plugin_settings',
			'yvk_login_styler_options_page',
            $iconPath,
            60
		);
	}
	add_action( 'admin_menu', 'yvk_login_styler_options_link' );
	add_action('admin_init', 'yvk_login_styler_options_cb');
endif;

if( !function_exists( 'yvk_login_styler_options_cb' ) ):
	function yvk_login_styler_options_cb(){
	    register_setting( 'yvk_login_styler_settings_group', 'yvk_login_styler_settings', 'yvk_login_styler_settings_sanitize');
	}
endif;

if( !function_exists( 'yvk_login_styler_options_scripts' ) ):
	function yvk_login_styler_options_scripts( $hook ) {
		if( 'toplevel_page_yvk_login_styler_plugin_settings' == $hook ){
			wp_enqueue_media();
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( array( 'wp-color-picker' ), false, true ); 
		}
	}
	add_action( 'admin_enqueue_scripts', 'yvk_login_styler_options_scripts' );
endif;


/**
 * Options Page
 *
 * Renders the options page contents.
 *
 * @since 1.0
 * @return void
 */
if( !function_exists( 'yvk_login_styler_options_page' ) ):
	function yvk_login_styler_options_page(){
		 $options = get_option( 'yvk_login_styler_settings' ); ?>
	     <div class="wrap">
			<h1>
                <?php _e( 'Login Page Styler', 'yvk-login-styler' ); ?>
                <span>
                    <small style="font-size: 9px">Developed by <a target="_blank" href="https://mostwanted.lk/">MOST_WANTED</a></small>
                </span>
			</h1>

			<div id="yvk-login-styler-settings-messages-container"></div>
			<div class="yvk-login-styler-settings-desc">
				<p><?php _e( 'Customize the login screen using the option provided below.', 'yvk-login-styler' );?></p>
			</div>

			<div id="poststuff" class="yvk-login-styler-poststuff">
				<div id="post-body" class="metabox-holder columns-2 hide-if-no-js">
					<div id="postbox-container-2" class="postbox-container">

						<div class="yvk-login-styler-container hide-if-no-js">
							<form method="post" action="options.php" id="yvk-login-styler-settings-form">
								<?php settings_fields( 'yvk_login_styler_settings_group' ); ?>
    							<?php do_settings_sections( 'yvk_login_styler_plugin_settings' ); ?>

								<table class="form-table yvk-login-styler-settings-table">
									<tr>
										<th scope="row">
											<label><?php _e( 'Logo Image', 'yvk-login-styler' );?></label>
										</th>
										<td>
											<button class="button button-primary yvk_login_styler_uploaded" data-field=".yvk_login_styler_logo_fld" data-preview=".yvk_login_styler_logo_preview" data-title="<?php _e( 'Select or Upload Logo', 'yvk-login-styler' );?>" data-text="<?php _e( 'Use as Logo', 'yvk-login-styler' );?>"><?php _e( 'Select or Upload Image', 'yvk-login-styler' );?></button>
											<?php if( is_array( $options ) && isset( $options['logo'] ) && !empty( $options['logo'] ) ): ?>
												&nbsp;&nbsp;<a href="#" class="yvk_login_styler_remove" data-field=".yvk_login_styler_logo_fld" data-preview=".yvk_login_styler_logo_preview"  ><?php _e( 'Remove', 'yvk-login-styler' );?></a>
											<?php endif; ?>
											<input type="hidden" class="yvk_login_styler_logo_fld" name="yvk_login_styler_settings[logo]" value="<?php echo ( is_array( $options ) && isset( $options['logo'] ) ) ? $options['logo'] : '';?>" />
											<div class="yvk_login_styler_logo_preview"><?php echo ( is_array( $options ) && isset( $options['logo'] ) && !empty( $options['logo'] ) ) ? '<img src="'. $options['logo'] .'">' : '';?></div>
										</td>
									</tr>
									<tr class="pro-feature">
										<th scope="row">
											<label><?php _e( 'Background', 'yvk-login-styler' );?></label>
										</th>
										<td>
											<div><input disabled type="text" class="color-picker" /></div><br/>
											<button disabled class="button button-primary yvk_login_styler_uploaded" ><?php _e( 'Select or Upload Image', 'yvk-login-styler' );?></button>
										</td>
									</tr>
								</table>
								<hr/>
								<table class="form-table yvk-login-styler-settings-table">
									<tr class="pro-feature">
										<th scope="row">
											<label><?php _e( 'Form Location', 'yvk-login-styler' );?></label>
										</th>
										<td>
											<select disabled>
												<option>Center</option>
												<option>Left</option>
												<option>Right</option>
											</select>

										</td>
									</tr>
									<tr class="pro-feature">
										<th scope="row">
											<label><?php _e( 'Form Background Color', 'yvk-login-styler' );?></label>
										</th>
										<td>
											<input disabled type="text" class="color-picker" />
										</td>
									</tr>
									<tr class="pro-feature">
										<th scope="row">
											<label><?php _e( 'Form label Color', 'yvk-login-styler' );?></label>
										</th>
										<td>
											<input disabled type="text"class="color-picker" />
										</td>
									</tr>
                                    <tr>
                                        <th scope="row">
                                            <label><?php _e( 'Custom label for User Name', 'yvk-login-styler' );?></label>
                                        </th>
                                        <td>
                                            <input type="text" class="widefat half-width" name="yvk_login_styler_settings[username]" value="<?php echo ( is_array( $options ) && isset( $options['username'] ) ) ? $options['username'] : '';?>"/>
											<div><small><?php _e( 'Keep this field empty to use the default label', 'yvk-login-styler' );?></small></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <label><?php _e( 'Custom label for Password', 'yvk-login-styler' );?></label>
                                        </th>
                                        <td>
                                            <input type="text" class="widefat half-width" name="yvk_login_styler_settings[password]" value="<?php echo ( is_array( $options ) && isset( $options['password'] ) ) ? $options['password']  : '';?>"/>
											<div><small><?php _e( 'Keep this field empty to use the default label', 'yvk-login-styler' );?></small></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <label><?php _e( 'Custom label for login button', 'yvk-login-styler' );?></label>
                                        </th>
                                        <td>
                                            <input type="text" class="widefat half-width" name="yvk_login_styler_settings[loginButton]" value="<?php echo ( is_array( $options ) && isset( $options['loginButton'] ) ) ? $options['loginButton'] : '';?>" />
											<div><small><?php _e( 'Keep this field empty to use the default label', 'yvk-login-styler' );?></small></div>
                                        </td>
                                    </tr>
									<tr class="pro-feature">
										<th scope="row">
											<label><?php _e( 'Login button Color', 'yvk-login-styler' );?></label>
										</th>
										<td>
											<input disabled type="text" class="color-picker" />
										</td>
									</tr>
									<tr class="pro-feature">
										<th scope="row">
											<label><?php _e( 'Login button font Color', 'yvk-login-styler' );?></label>
										</th>
										<td>
											<input disabled type="text" class="color-picker" />
										</td>
									</tr>
								</table>
								<hr/>
								<table class="form-table yvk-login-styler-settings-table">
									<tr class="pro-feature">
										<th scope="row">
											<label><?php _e( 'Custom CSS', 'yvk-login-styler' );?></label>
										</th>
										<td>
											<textarea disabled placeholder=".foo { background-color: #cccccc; } ..." class="widefat" rows="10"></textarea>
											<small><?php _e( 'Your custom css for the login page.', 'yvk-login-styler' );?></small>
										</td>
									</tr>
								</table>

								<?php
								if( function_exists('submit_button')) { submit_button(); } else { ?>
									<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e( 'Save Changes', 'yvk-login-styler' );?>"></p>
								<?php } ?>
							</form>

							</form>
						</div>
						<div class="yvk-login-styler-modal-background"></div>
					</div>
				</div>
			</div>
		</div>

		<style type="text/css">
			.yvk-login-styler-settings-table{
				width: 100%;
			}
			.yvk-login-styler-settings-table img{
				max-width: 100%;
			}
			.yvk_login_styler_image_preview{
				display: block;
				width: 100%;
			}
			.yvk_login_styler_image_preview img{
				padding: 15px 0;
			}
			.yvk_login_styler_remove{
				line-height: 25px;
				color: #a00;
			}
			.yvk_login_styler_logo_preview img{
				width: 84px;
				padding: 15px 0;
			}
			.yvk-login-styler-poststuff .postbox-container img{
                max-width: 320px;
                border: 0;
                width: auto;
                max-height: 84px;
			}
            .half-width {
                max-width: 320px;
            }
			.yvk-login-styler-settings-table .pro-feature td{
				opacity: 0.8;
				pointer-events: none;
			}

			.yvk-login-styler-settings-table .pro-feature td .wp-picker-container{
				opacity: 0.7;
				pointer-events: none;
			}

			.yvk-login-styler-settings-table .pro-feature label::after {
				content: 'PRO';
				padding: 2px 10px;
				margin: 0 10px;
				background: #30db5d;
				color: #fff;
				border-radius: 3px;
			}
		</style>

		<script type="text/javascript">
			jQuery( document ).ready( function(){
				jQuery(function() {
					jQuery('.color-picker').wpColorPicker();
				});

				var file__frame;

			    jQuery( 'body' ).on( 'click', '.yvk_login_styler_uploaded', function( event ){
			        event.preventDefault();

					var fld = jQuery( this ).attr( 'data-field' );
					var preview = jQuery( this ).attr( 'data-preview' );

			        // Create the media frame.
			        file__frame = wp.media.frames.items = wp.media({
    title: 'Add to Gallery',
    button: {
        text: 'Select'
    },
    library: {
            type: [ 'video', 'image' ]
    },
});

			        // When an image is selected, run a callback.
			        file__frame.on( 'select', function() {
			          // We set multiple to false so only get one image from the uploader
			          attachment = file__frame.state().get('selection').first().toJSON();
			          jQuery( fld ).val( attachment.url );
			          jQuery( preview ).html('<img src="'+ attachment.url +'" />');
			          // jQuery('#wpautbox_user_image_url').html('<img src="'+ attachment.url +'" width="120"/><br />');
			          // Do something with attachment.id and/or attachment.url here
			        });

			        // Finally, open the modal
			        file__frame.open();
			    });

				jQuery( '.yvk_login_styler_remove' ).on( 'click' ,function(e){

					var fld = jQuery( this ).attr( 'data-field' );
					var preview = jQuery( this ).attr( 'data-preview' );

			    	jQuery( fld ).val('');
			       	jQuery( preview ).html('');
					e.preventDefault();
					e.stopPropagation();
			    });
			} );
		</script>

	     <?php
	 }
 endif;
?>
