<?php
/*
Plugin Name: MC Login Code
Plugin URI: https://mid-coast.com/mc-plugin-donations
Description: Adds a login code field to your Wordpress login form for better security. To set your code, find "MC Login Code" under the "Settings" tab in the left menu.
Version: 2.3.2
Author: Mike Hickcox
Author URI: https://Mid-Coast.com
License: GPLv3
License URI: https://www.gnu.org/licenses

    Copyright (C)2020  Mike Hickcox

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program. If not, see https://www.gnu.org/licenses.
*/

if ( ! defined( 'ABSPATH' ) ) exit;


	// ADD SETTINGS TO THE WORDPESS PLUGIN MENU

	add_action('admin_menu', 'mc6397lc_menu');
	function mc6397lc_menu() {
    add_submenu_page(
        'options-general.php',
        'MC Login Code',
        'MC Login Code',
        'manage_options',
        'mclogincode',
        'mc6397lc_page' );
}

	add_action('admin_init', 'mc6397lc_register_settings');
	function mc6397lc_register_settings() {
    register_setting('mc6397lc_LoginCode', 'mc6397lc_LoginCode', 'mc6397lc_LoginCode_validate');
}

	function mc6397lc_LoginCode_validate($mc6397lc_options) {
    if(isset($mc6397lc_options['code'])) {
        if(!empty($mc6397lc_options['code'])) {
   if(strlen($mc6397lc_options['code']) > 20) {
    add_settings_error('mc6397lc_LoginCode', 'mc6397lc_code', 'The Login Code cannot be longer than 20 characters.', $type = 'error');
    return false;
   } elseif(strlen($mc6397lc_options['code']) < 4) {
    add_settings_error('mc6397lc_LoginCode', 'mc6397lc_code', 'The Login Code cannot be shorter than 4 characters.', $type = 'error');
    return false;
   } else {
    add_settings_error('mc6397lc_LoginCode', 'mc6397lc_code', 'The Setting is Saved', $type = 'updated');
	include 'inc/mc6397lc_sendEmail.php';
   }
  } else {
   add_settings_error('mc6397lc_LoginCode', 'mc6397lc_code', 'The Login Code is Disabled.', $type = 'updated'); include 'inc/mc6397lc_sendEmail-2.php';
  }
    }

    return $mc6397lc_options;
}

	add_action('admin_notices', 'mc6397lc_admin_notices');
	function mc6397lc_admin_notices() {
 settings_errors();
}

	function mc6397lc_page() {
?>
	<div class="wrap">
 
	<img src="<?php echo plugin_dir_url( __FILE__ ) . 'assets/MC-LC-Head.jpg'; ?>">
 
	<h2>Set Your Login Code</h2>
	<span style = 'font-size: 15px'>
This code will be required in a new 3rd field on the WordPress login form.<br>
- When you save settings, and email confirmation will be sent to the website administrator.<br>
- To disable the login field on the login form, just leave this field blank.<br><br>
<em><strong>If you lose your code:</strong></em><br>1. Delete this plugin from your plugins folder using your host's CPanel File Manager, or FileZilla or similar program.<br>2. Log in as admin to your site and re-install the plugin.</span>

	<form method="post" action="options.php">
 <?php
    settings_fields( 'mc6397lc_LoginCode' );
    do_settings_sections( __FILE__ );

    $mc6397lc_options = get_option( 'mc6397lc_LoginCode' );


 ?>
	<table class="form-table">
	<tbody>
     <tr>
     <th scope="row">
     <label for="auth_field"><?php echo __('Login Code for this website: <br>
 (4 to 20 characters)', 'mclogincode') ?></label>
     </th>
     <td>
     <input type="text" name="mc6397lc_LoginCode[code]" id="auth_field" autocomplete="off" value="<?php echo (isset($mc6397lc_options['code']) && $mc6397lc_options['code'] != '') ? $mc6397lc_options['code'] : ''; ?>" min="4" max="20" />
     </td>
	 </tbody>
	 </table>
	 <?php submit_button(); ?>
	 </form>
	 </div>
<?php
}
	function do_mclogincode() {
	$mc6397lc_options = get_option( 'mc6397lc_LoginCode' );

	if(!empty($mc6397lc_options['code'])) {
	add_filter( 'login_form', function() {
	printf(
   '<p class="login-authenticate">
    <label for="auth_key">%s</label>
    <input type="text" name="mclogincode_auth_key" 
      id="mclogincode_auth_key" class="input" 
      value="" size="20" autocomplete="off" />
   </p>',
	esc_html__( 'Login Code', 'mclogincode' )
  );

 } );

	add_filter( 'authenticate', function( $user ) {
	$mc6397lc_options = get_option( 'mc6397lc_LoginCode' );

	$submit_code = filter_input( INPUT_POST, 'mclogincode_auth_key',
   FILTER_SANITIZE_STRING );
   
	if ( is_wp_error( $user ) ) {
	return $user;
  }

	$is_valid_mc6397lc_code = ! empty( $mc6397lc_options['code'] ) 
	&& ( $mc6397lc_options['code'] === $submit_code );
   
	if( ! $is_valid_mc6397lc_code )
	$user = new WP_Error(
    'invalid_mc6397lc_code',
    sprintf(
     '<strong>%s</strong>: %s',
     esc_html__( 'ERROR', 'mclogincode' ),
     esc_html__( 'Login Code is invalid or missing.', 'mclogincode' )
    )
   ); 

	return $user;

 }, 100 );

	add_action( 'login_head', function() { echo '<style type="text/css">div#login{padding: 4% 0 0;}</style>'; });
 
 }
 }
	do_mclogincode(); 



	// ADD SETTINGS LINK ON THE PLUGINS LIST PAGE

	function mc6397lc_LoginCode_link($links) { 
	$settings_link = '<a href="options-general.php?page=mclogincode">Settings</a>'; 
	array_unshift($links, $settings_link); 
	return $links; 
}
 
	$plugin = plugin_basename(__FILE__); 
	add_filter("plugin_action_links_$plugin", 'mc6397lc_LoginCode_link' );
