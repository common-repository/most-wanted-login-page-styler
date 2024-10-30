<?php
/**
 * Handles hooks and actions for wp-login.php
 *
 */

if( !function_exists( 'yvk_login_styler_enqueue' ) ):
    add_action( 'login_enqueue_scripts', 'yvk_login_styler_enqueue', 10 );
    function yvk_login_styler_enqueue(){
        wp_enqueue_style( 'login-styler', YVK_LOGIN_STYLER_PLUGIN_URL . 'assets/css/yvk-login-styler.css', false );
    }
endif;

if( !function_exists( 'yvk_login_styler_head' ) ):
    add_action( 'login_head', 'yvk_login_styler_head' );
    function yvk_login_styler_head(){
        $options = get_option( 'yvk_login_styler_settings' );?>
    <?php
        if( is_array( $options ) && !empty( $options ) ){ ?>
            <style type="text/css">
                <?php 
                if( isset( $options['logo'] ) && !empty( $options['logo'] ) ){
                    echo 'body #login h1 a { background-image: url("'. $options['logo'] .'") !important; }';
                }
                ?>
            </style>
        <?php }
    }
endif;

if( !function_exists( 'yvk_login_styler_url' ) ):
    add_filter( 'login_headerurl', 'yvk_login_styler_url' );
    function yvk_login_styler_url( $url ){
        $options = get_option( 'yvk_login_styler_settings' );

        if( isset( $options['logo'] ) && !empty( $options['logo'] ) ){
            $url = esc_url( home_url( '/' ) );
        }

        return $url;
    }
endif;


if( !function_exists( 'yvk_login_styler_alt' ) ):
    add_filter( 'login_headertitle', 'yvk_login_styler_alt' );
    function yvk_login_styler_alt( $alt ){
        $options = get_option( 'yvk_login_styler_settings' );

        if( isset( $options['logo'] ) && !empty( $options['logo'] ) ){
            $alt = get_bloginfo( 'name' );
        }

        return $alt;
    }
endif;

if( !function_exists( 'login_label_change' ) ):
    add_filter('gettext', 'login_label_change', 10, 3);
    function login_label_change($translation, $orig, $domain) {
        $options = get_option( 'yvk_login_styler_settings' );
//        if( is_array( $options ) && !empty( $options ) ){
            if( isset( $options['username'] ) && !empty( $options['username'] ) ){
                $username = $options['username'];
                $emailUsername = $options['username'];
            }
            else {
                $username = 'Username';
                $emailUsername = 'Username or Email Address';
            }

            if( isset( $options['password'] ) && !empty( $options['password'] ) ){
                $password = $options['password'];
            }
            else {
                $password = 'Password';
            }
            if( isset( $options['loginButton'] ) && !empty( $options['loginButton'] ) ){
                $loginButton = $options['loginButton'];
            }
            else {
                $loginButton = 'Log In';
            }

            switch($orig) {
                case 'Username or Email Address':
                    $translation = $emailUsername;
                    break;
                case 'Username':
                    $translation = $username;
                    break;
                case 'Password':
                    $translation = $password;
                    break;
                case 'Log In':
                    $translation = $loginButton;
                    break;
            }
            return $translation;
//        }
    }

endif;