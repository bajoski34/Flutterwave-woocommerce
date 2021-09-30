<?php

/*
Plugin Name: Flutterwave
Plugin URI: https://flutterwave.com/ng
Description: Official WooCommerce Plugin for Flutterwave for Business
Version: 1.0.1
Author: Flutterwave Developers
Author URI: http://developer.flutterwave.com
License: MIT License
WC requires at least:   3.0.0
WC tested up to:        4.9.2
*/


if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

define( 'FLW_WC_PLUGIN_FILE', __FILE__ );
define( 'FLW_WC_DIR_PATH', plugin_dir_path( FLW_WC_PLUGIN_FILE ) );



  function flw_woocommerce_rave_init() {

    if ( !class_exists( 'WC_Payment_Gateway' ) ) return;

    require_once( FLW_WC_DIR_PATH . 'includes/class.flw_wc_payment_gateway.php' );
    require_once FLW_WC_DIR_PATH . 'classes/class-create-settings-routes.php';

    // include subscription if exists
    if ( class_exists( 'WC_Subscriptions_Order' ) && class_exists( 'WC_Payment_Gateway_CC' ) ) {

      require_once( FLW_WC_DIR_PATH . 'includes/class.flw_wc_subscription_payment.php' );
      
    }

    add_filter('woocommerce_payment_gateways', 'flw_woocommerce_add_rave_gateway', 99 );
  }
  add_action('plugins_loaded', 'flw_woocommerce_rave_init', 99);

  /**
   * Add the Settings link to the plugin
   *
   * @param  Array $links Existing links on the plugin page
   *
   * @return Array          Existing links with our settings link added
   */
  function flw_plugin_action_links( $links ) {

    $rave_settings_url = esc_url( get_admin_url( null, 'admin.php?page=wc-settings&tab=checkout&section=rave' ) );
    array_unshift( $links, "<a title='Rave Settings Page' href='$rave_settings_url'>Settings</a>" );

    return $links;

  }
  add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'flw_plugin_action_links' );

  /**
   * Add the Gateway to WooCommerce
   *
   * @param  Array $methods Existing gateways in WooCommerce
   *
   * @return Array          Gateway list with our gateway added
   */
  function flw_woocommerce_add_rave_gateway($methods) {

    if ( class_exists( 'WC_Subscriptions_Order' ) && class_exists( 'WC_Payment_Gateway_CC' ) ) {

      $methods[] = 'FLW_WC_Payment_Gateway_Subscriptions';

    } else {

      $methods[] = 'FLW_WC_Payment_Gateway';
    }

    return $methods;

  }

  add_action('admin_enqueue_scripts','flutterwave_admin_enqueue_scripts');

  function flutterwave_admin_enqueue_scripts($hook){

    if(!empty($hook) && $hook === "woocommerce_page_wc-settings"){
      wp_enqueue_style('woo-flw_css', plugins_url('assets/css/flw-admin.css', __FILE__));
      wp_enqueue_script('woo-flw_js', plugins_url('assets/js/flw-admin.js', __FILE__));
      wp_enqueue_script('woo-flw-react_js', plugins_url('dist/flw-admin-dev.js', __FILE__), [ 'jquery', 'wp-element' ], wp_rand(), true );
    }

    wp_localize_script( 'woo-flw-react_js', 'flutterwave_data', [
      'apiUrl' => home_url( '/wp-json' ),
      'nonce' => wp_create_nonce( 'wp_rest' ),
      'hook' => $hook,
      'logo_src' => plugins_url('src/icons/flutterwave-logo.svg', __FILE__) 
    ]);
    
  }




?>