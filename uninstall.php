<?php 

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

delete_option('storedApiKey');
delete_option('storedRoomId');
delete_option('apiBaseURL');
delete_option('meetingUrl');