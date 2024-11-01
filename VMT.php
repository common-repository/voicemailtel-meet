<?php

/**
 * 
 * Plugin Name:     VoiceMailTel Meet
 * Plugin URI:      https://wordpress.org/plugins/voicemailtel-meet/
 * Description:     You can join conference from wordpress site and check online/offline status for a meeting room.
 * Author:          Voicemailtel
 * Author URI:      http://meet.voicemailtel.com
 * License:         GPLv2 or later
 * License URI:     https://www.gnu.org/licenses/gpl-2.0.html
 * Version:         1.0.0
 * 
 * 
 * */

if ( ! defined( 'WPINC' ) )
{
	die;
}

function activateVMTPlugin()
{
    require_once plugin_dir_path(__FILE__) . 'includes/VMTPluginActivator.php';
    VMTPluginActivator::activate();
}

function deactivateVMTPlugin()
{
    require_once plugin_dir_path(__FILE__) . 'includes/VMTPluginDeactivator.php';
    VMTPluginDeactivator::deactivate();   
}

register_activation_hook(__FILE__, 'activateVMTPlugin');

register_deactivation_hook(__FILE__, 'deactivateVMTPlugin');

add_action("admin_menu", "vmtMeetWpAddAdminMenu");

add_action('rest_api_init', function() {
    register_rest_route( 'pluginVMT/v1/', 'room-status', array(
    'methods' => 'GET',
    'callback' => 'vmtMeetWpCheckRoomAvailability',
  ) );
} );

function vmtMeetWpCheckRoomAvailability() {
    $url = get_option('apiBaseURL') . '/api/check-if-room-is-available';
    $args = array(
        'method'      => 'POST',
        'headers'     => array(
                'Content-Type' => 'application/json',
                "Access-Control-Allow-Origin" => '*',
                'ApiKey' => get_option('storedApiKey'),
                ),
        'body'        => json_encode(array('roomId' => get_option('storedRoomId'))),
    );
    $response = wp_remote_post($url, $args);

    return $response;
}

function vmtMeetWpAddAdminMenu()
{
    update_option('apiBaseURL', 'https://api2.voicemailtel.com');
    update_option('meetingUrl', 'https://meet.voicemailtel.com');
    add_menu_page("VMT", "VMT", 5, "voicemailtel-meet-settings", "vmtMeetWpMainMenuAdminVMT", plugins_url('includes/assets/images/videocamWhite1.png', __FILE__), 10);
}

require plugin_dir_path(__FILE__) . 'admin/VMTAdmin.php';
require plugin_dir_path(__FILE__) . 'public/VMTPublic.php';
    
function vmtMeetWpMainMenuAdminVMT()
{
    new VMTAdmin();
}

function vmtMeetWpAddPublicShortcode( $atts ) {
    new VMTPublic();
}

add_shortcode('publicVmt', 'vmtMeetWpAddPublicShortcode');
