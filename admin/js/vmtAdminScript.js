(function( $ ) {
	'use strict';

	$(document).on("click", "#checkConnection", function() {
		checkConectivity($('#apiKey').val(), $('#roomId').val());
	});

	function checkConectivity(apiKey, personalMeetingId) {
		if (validateApiKey(apiKey) && validatePersonalMeetingId(personalMeetingId)) {
			try {
				const URL = baseUrl + '/api/check-if-room-is-available';
				const requestBody = JSON.stringify({"roomId" : personalMeetingId});
				var xhr = new XMLHttpRequest();
				xhr.open("POST", URL);
				xhr.setRequestHeader('ApiKey', apiKey);
				xhr.send(requestBody);
				xhr.onload = function() {
					const response = JSON.parse(xhr.responseText);
						alert(response.message);
				}
			} catch(err) {
				alert('Invalid api key or room id');
			}
		}
	}

	function validatePersonalMeetingId(personalMeetingId) {
		if (!personalMeetingId) {
			alert('Insert personal meeting ID!');
			return false
		}

		return true;
	}

	function validateApiKey(apiKey) {
		if (!apiKey || apiKey.length == 0) {
			alert('Insert API key!');
			return false
		}

		return true;
	}

})( jQuery );