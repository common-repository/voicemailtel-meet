=== VoiceMailTel Meet ===

Contributors: voicemailteldev
Requires at least: 5.7.2
Tested up to:  5.8
Stable tag: 1.0.0
Requires PHP: 5.6.40
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

== Description ==

The account administrator must enter the API key which can be generated from the VoiceMailTel Meet Account https://meet.voicemailtel.com/.

Then he must add the meeting ID.

In order to make sure the integration is successful, the account administrator must enter the information correctly and press on the Check button. If the received status shows “Success”, the integration was successful.

After adding the necessary data, the “Save” button must be pressed in order to save the API Key and room ID which will be included in the generated shortcode.

The account admin can add this shortcode on multiple web pages, and the visitors of the pages will be able to join the admin`s conference room if the meeting is started by the admin. If the admin has not started the meeting the “Join” button will be disabled.

The shortcode can be added to the page using the following syntax: [publicVmt][/publicVmt].

The shortcode image set to the VoiceMailTel logo by default, but the admin can change the logo when needed, and also reset it to its default.

== Frequently Asked Questions ==

= How to generate API Key from VoiceMailTel Meet platform? =

After you sign in, you can got to Account Profile then select API Key Icon. 
After you open select Add API Key, write a name, select wordpress from Available Service then press Generate button.
Now you can copy to clipboard the API Key and add it to wordpress plugin.

= Where do you find room id? =

After you sign in, from the main page, go to Host Meeting, select edit personal meeting id, copy and paste it to wordpress plugin.

== Screenshots ==

1. Admin side of the plugin.
2. VoiceMailTel Meet https://meet.voicemailtel.com/
3. Select Account Profile then API Key icon.
4. Select Add API Key button.
5. Write a name, select an available service then Generate Key.
6. You can copy the API Key from the table.
7. Press host meeting button, then edit personal meeting id.
8. Copy personal meeting id.
9. Add API Key and personal meeting id to the plugin, Save button then you can Check room status.
10. If you check the room when is online, you will get a message that it is available.
11. You can add shortcode to any site and if the room is offline this is how it will look.
12. If room is online this is how the shortcode will look like.
13. Now users can join your meeting and they will be redirected to your room.
14. A user will be redirected to your meeting.

== Changelog == 

= 0.1 =
* Sanitized user input, validated and escaped data.

== Upgrade Notice ==

= 0.1 =
This version makes plugin more secure in case of input vulnerabilities.