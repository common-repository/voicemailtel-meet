<?php

function vmtMeetWpSetShortcodeImage($field)
{
	$allowedExtensions = array('jpg', 'jpeg', 'png', 'bmp', 'gif');

	$imageName = sanitize_file_name($_FILES[$field]['name']);
	$imageType = sanitize_mime_type($_FILES[$field]['type']);
	$imageTmpNamePath = $_FILES[$field]['tmp_name'];
	$imageError = is_numeric($_FILES[$field]['error']) ? $_FILES[$field]['error'] : intval($_FILES[$field]['error']);
	$imageSize = is_numeric($_FILES[$field]['size']) ? $_FILES[$field]['size'] : intval($_FILES[$field]['size']);

	if ($imageError === 0) 
	{
		$imageExtension = pathinfo($imageName, PATHINFO_EXTENSION);
		if (in_array(strtolower($imageExtension), $allowedExtensions)) 
		{
			if ($imageSize < 125000) {
				$newImage = 'shortcodePhoto.png';
				$imageUploadPath = plugin_dir_path(__FILE__).'uploads/' . $newImage;
				move_uploaded_file($imageTmpNamePath, $imageUploadPath);
				$imageStatus = 'Shortcode image set!';
			}
			else
			{
				$imageStatus = 'Image too large!';
			}
		}
		else
		{
			$imageStatus = 'This type of file is not allowed!';
		}
	}
	else
	{
		$imageStatus = 'No image selected!';
	}

	return $imageStatus;
}

function vmtMeetWpStoreDataFromInputField($dataStored, $inputField)
{
	if (isset($_POST[$inputField])) 
	{
		update_option($dataStored, sanitize_text_field($_POST[$inputField]));
	}

	$apiKeyValue = get_option($dataStored, '');
}

function vmtMeetWpPhpAdminDesign()
{
	$imagePath = plugin_dir_url(__FILE__) . '../../includes/assets/images/voicemailtel_logo_portal.gif';

	vmtMeetWpStoreDataFromInputField('storedApiKey', 'apiKeyField');
	vmtMeetWpStoreDataFromInputField('storedRoomId', 'roomIdField');

	$apiKeyValue = get_option('storedApiKey', '');
	
	$roomIdValue = get_option('storedRoomId', '');

	$pathToImage = plugin_dir_path(__FILE__) . '../../admin/html/uploads/shortcodePhoto.png';

	$imageStatus = '';

	if(file_exists($pathToImage))
	{
		$shortcodeImageStatus = 'Shortcode image set!';
	}
	else
	{
		$shortcodeImageStatus = 'Default shortcode image set!';
	}

	if (isset($_POST['savePhoto']) && isset($_FILES['photoField'])) 
	{
		$shortcodeImageStatus = vmtMeetWpSetShortcodeImage('photoField');
	}

	if (isset($_POST['resetPhoto']))
	{
		if(file_exists($pathToImage))
		{
			unlink($pathToImage);
			$shortcodeImageStatus = 'Default shortcode image set!';
		}
		else
		{
			$shortcodeImageStatus = 'There is no image to reset!';
		}
	}
?>

<div class="mainMenu">
	<script type="text/javascript" >
		const baseUrl = "<?php echo esc_url(get_option('apiBaseURL')); ?>";
	</script>
	<img src="<?php echo esc_html($imagePath); ?>">
	<div class="shortcodeMenu">
		<div class="shortcodeSettings">
			<h1>Settings</h1>
			<form method="POST">
				<div class="inputAndTitle">
					<div class="apiTitle">
						API key:
					</div>
					<input  class="apiKeyInput" id="apiKey" type="text" value="<?php echo esc_html($apiKeyValue); ?>" name="apiKeyField">
				</div>
				<div class="roomIdAndTitle">	
					<div class="roomIdTitle">
						Personal Room ID:	
					</div>
					<input  class="roomIdInput" id="roomId" type="text" value="<?php echo esc_html($roomIdValue); ?>" name="roomIdField">
				</div>
				<div class="saveApiAndRoomId">
					<button class="saveApiAndRoomIdButton" type="submit" id="saveButton">Save</button>	
				</div>
			</form>
			<div class="checkConectivity">
				<button class="checkConectivityButton" type="submit" id="checkConnection">Check</button> 	
			</div>
		</div>
	</div>
	

	<div class="shortcodeSetPhoto">
		<h1>Change logo</h1>
		<form method="POST" enctype="multipart/form-data">
			<div class="photoShortcode">
				<div class="photoTitle">
					Upload photo:
				</div>
				<input  class="photoInput" id="photo" type="file" name="photoField">
			</div>
			<div class="savePhotoForm">
				<input class="photoInputButton" type="submit" id="shortcodePhotoButton" name="savePhoto" value="Save">
			</div>
			<?php echo esc_html($imageStatus); ?>
		</form>
		<div class="shortcodeResetPhoto">
			<form method="POST">
				<div class="resetImageBlock">
					<input class="resetShortcodePhoto" type="submit" name="resetPhoto" value="Reset">
					<?php echo esc_html($shortcodeImageStatus); ?>
				</div>
			</form>		
		</div>
	</div>
</div>

<div class="instructions">
	<h1>Instructions:</h1>

	<h2>How to use?</h2> 
	The account administrator must enter the API key which can be generated from the VoiceMailTel Meet Account.<br>

	Then he must add the meeting ID.<br>

	In order to make sure the integration is successful, the account administrator must enter the information correctly and press on the "Check" button.<br>

	If the received status shows "Success", the integration was successful.<br>

	After adding the necessary data, the "Save" button must be pressed in order to save the API Key and room ID which will be included in the generated shortcode.

	<h2>Shortcode instructions:</h2>

	The account admin can add this shortcode on multiple web pages, and the visitors of the pages will be able to join the admin`s conference room if the meeting is started by the admin. <br>

	If the admin has not started the meeting the “Join” button will be disabled. <br>

	The shortcode can be added to the page using the following syntax: [publicVmt][/publicVmt]. <br>

	The shortcode image set to the VoiceMailTel logo by default, but the admin can change the logo when needed, and also reset it to its default.
</div>

<?php 
 } ?>