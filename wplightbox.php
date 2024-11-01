<?php
/*
Plugin Name: wplightbox
Plugin URI: http://wordpress.org/plugins/wplightbox/
Description: This plugin helps you make a simple lightbox without any dependencies. Just give links the wplightbox class and it will automatically become a lightbox.
Author: We-Serve-You ApS
Version: 1.0.3
Author URI: https://www.wplightbox.com
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
function wplightbox_insert_bottom() {
	$html = '
<div id="wplightbox-container" class="wplightbox-container" onclick="closewplightbox();">
  <div class="wplightbox-popup">

		<div class="wplightbox-close-btn">
			<img src="'.plugins_url('/assets/close.png',__FILE__).'">
		</div>
		<div style="clear:both;"></div>
				<div class="wplightbox-content">
					<iframe id="wplightbox-iframe" src="" frameborder="0"></iframe>
				</div>
  </div>
</div>
';
	echo $html;
}
add_action( 'wp_footer', 'wplightbox_insert_bottom', 100 );
add_action('wp_enqueue_scripts','wplightbox_init_frontend');

function wplightbox_init_frontend() {
    wp_enqueue_script( 'wplightbox-js', plugins_url( '/wplightbox.js', __FILE__ ),'','',true);
    wp_enqueue_style( 'wplightbox-css', plugins_url( '/wplightbox.css', __FILE__ ));
}
function wplightbox_create_menu(){
	add_menu_page('Liste', 'wplightbox', 'administrator',"wplightbox/settings.php", 'wplightbox_settings_page' , plugins_url('/assets/icon.png', __FILE__));
}
function wplightbox_settings_page(){
	include_once("settings.php");
}

add_action('admin_menu', 'wplightbox_create_menu');
