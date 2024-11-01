<?php

function vmtMeetWpPhpPublicDesign()
{
	$pathToImage = plugin_dir_path(__FILE__) . '../../admin/html/uploads/shortcodePhoto.png';
	$statusImage = plugin_dir_url(__FILE__) . '../../includes/assets/images/videocamWhite1.png';

	if(file_exists($pathToImage))
	{
		$shorcodeImage = plugin_dir_url(__FILE__) . '../../admin/html/uploads/shortcodePhoto.png';
	} 
	else
	{
		$shorcodeImage = plugin_dir_url(__FILE__) . '../../includes/assets/images/voicemailtel_logo_portal.gif';
	}
	
	$roomId = get_option('storedRoomId');
?>
	<script type="text/javascript" >
		const roomId = "<?php echo esc_html($roomId); ?>"
		const siteUrl = "<?php echo esc_url(get_site_url()); ?>";
		const meetBaseUrl = "<?php echo esc_html(get_option('meetingUrl')); ?>";
	</script>

	<div class="publicVmtMenu">
		<div class="publicJoinMeeting">
			<img class="publicPhoto" src="<?php echo esc_html($shorcodeImage); ?>">
			<div class="roomAndStatus">
				<div class="joinMeetingButton">
					<button class="publicJoinButton" type="submit" id="joinRoom">
						Join meeting
					</button>				
				</div>
			</div>
		</div>
	</div>

<?php } ?>