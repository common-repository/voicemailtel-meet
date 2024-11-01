(function( $ ) {
	'use strict';

	checkRoomStatusAndUpdateButtonColor();

	setInterval(function() {
		checkRoomStatusAndUpdateButtonColor();
	}, 60000);

	$(document).on("click", "#joinRoom", function() {
		redirectIfRoomAvailable();
	});

	function checkRoomStatusAndUpdateButtonColor() {
		const URL = siteUrl + '/?rest_route=/pluginVMT/v1/room-status';
		var xhr = new XMLHttpRequest();
		try {
			xhr.open("GET", URL);
			xhr.send();
			xhr.onload = function() {
				const response = JSON.parse(xhr.responseText);
				const responseBody = JSON.parse(response.body);
				if (responseBody.success) {
					$("#joinRoom").css('background-color', '#3d94f6');
				} else {
					$("#joinRoom").css('background-color', '#505050');
				}
			}
		} catch(err) {
			console.log('A problem occurred...');
		}
	}

	function redirectIfRoomAvailable() {
		const URL = siteUrl + '/?rest_route=/pluginVMT/v1/room-status';
		var xhr = new XMLHttpRequest();
		try {
			xhr.open("GET", URL);
			xhr.send();
			xhr.onload = function() {
			const response = JSON.parse(xhr.responseText);
			const responseBody = JSON.parse(response.body);
			if (responseBody.success) {
				if (confirm('Room is available, you will be redirected to meeting!')) {
					window.open(buildMeetingURL(meetBaseUrl, roomId), '_blank');
				}
			} else {
				alert('Room not available!');
			}
		}
		} catch(err) {
			alert('A problem occurred...');
		}
	}

	function buildMeetingURL(baseUrl, personalMeetingId) {
		return baseUrl + '/j/' + personalMeetingId;
	}

})( jQuery );