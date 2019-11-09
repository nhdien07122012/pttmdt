<?php
/*
Plugin Name: Userlike
Plugin URI: https://www.userlike.com
Description: Userlike Live Chat integration for Wordpress
Version: 2.0.3
Author: David Voswinkel <david.voswinkel@userlike.com>
Author URI: https://www.userlike.com
License: GPL2

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

class UserLike {
	static $is_enabled = false;
	static $json;
	static $plugin_dir;

	public static function init(){
		add_option("userlike_secret");
		load_plugin_textdomain('userlike', false, dirname(plugin_basename(__FILE__)));
		if(get_option("userlike_secret") && strlen(get_option("userlike_secret")) > 30 && !preg_match("/[^a-f0-9]/", get_option("userlike_secret")))
			self::$is_enabled = true;
		else
			self::$is_enabled = false;
		self::$plugin_dir = get_option('siteurl').'/'.PLUGINDIR.'/userlike/';
		if(function_exists('current_user_can') && current_user_can('manage_options')){
			add_action('admin_menu', array(__CLASS__, 'add_settings_page'));
			add_filter('plugin_action_links', array(__CLASS__, 'register_actions'), 10, 2);
		}

		if(self::$is_enabled){
			add_action('wp_footer', array(__CLASS__, 'insert_code'));
		} else {
			add_action('admin_notices', array(__CLASS__, 'admin_notice'));
		}
	}

	public static function insert_code(){
		/* Insert Userlike javascript code into the page */
		if(!self::$is_enabled) return false;
		$secret = get_option("userlike_secret");
		echo "<script src=\"https://s3-eu-west-1.amazonaws.com/userlike-cdn-widgets/".$secret.".js\"></script>";
	}

	public static function admin_notice(){
		if(!self::$is_enabled)
			echo '<div class="error"><p><strong>'.sprintf(__('Userlike integration has not been set up. Please go to the <a href="%s">plugin page</a> and enter your Userlike credentials to enable it.' ), admin_url('options-general.php?page=userlike')).'</strong></p></div>';
	}

	public static function add_settings_page(){
		add_action('admin_init', array(__CLASS__, 'register_settings'));
		add_submenu_page('options-general.php', 'Userlike', 'Userlike', 'manage_options', 'userlike', array(__CLASS__, 'settings_page'));
	}

	/* Helper Functions */

	public static function register_settings(){
		register_setting('userlike', 'userlike_secret');
		add_settings_section('userlike', 'Userlike', '', 'userlike');
	}

	public static function register_actions($links, $file){
		$this_plugin = plugin_basename(__FILE__);
		if($file == $this_plugin && function_exists('admin_url')){
			$settings_link = '<a href="'.admin_url('options-general.php?page=userlike').'">'.__('Settings', 'userlike').'</a>';
			array_unshift($links, $settings_link);
		}
		return($links);
	}

	public static function settings_page(){
		if(get_option("userlike_secret") && !self::$is_enabled){
			echo '<div id="setting-error-settings_error" class="error settings-error"><p><strong>Your credentials don\'t look like they are correct. Please make sure that your credentials are correct! <a href="#" onClick="return userlikeStartChat();">Click here for live help</a></strong></p></div>';
		}
		$plugin_dir = self::$plugin_dir;
		$in_userlike = true;
		require_once "userlike.admin.php";
	}
}

add_action('init', array('UserLike', 'init'));
