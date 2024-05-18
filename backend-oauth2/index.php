<?php
	// TODO create your script to use the Withings public API with Oauth2 protocol
	if (isset($_GET['code'])) {
		$authorizationCode = $_GET['code'];
	
		$clientId = 'a16837aaa8f536b229ce20fa8e90a2739885b640ff67de7b84562b6fe0e27513';
		$clientSecret = '881b7dc5686e38894ef0cb27019ebc44e7daf72cc329fe914a43acee15774782';
		$redirectUri = 'http://localhost:7070';
	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://wbsapi.withings.net/v2/oauth2");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
			'action' => 'requesttoken',
			'grant_type' => 'authorization_code',
			'client_id' => $clientId,
			'client_secret' => $clientSecret,
			'code' => $authorizationCode,
			'redirect_uri' => $redirectUri
		]));
		$tokensRsp = curl_exec($ch);
		curl_close($ch);

		$tokensData = json_decode($tokensRsp, true);
	
		if (isset($tokensData['body']['access_token'])) {
			$accessToken = $tokensData['body']['access_token'];
	
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "https://wbsapi.withings.net/measure");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HTTPHEADER, [
				'Authorization: Bearer ' . $accessToken
			]);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
				'action' => 'getmeas',
    			'meastype' => 1,
    			'category' => 1,
				'access_token' => $accessToken
			]));
			$measuresRsp = curl_exec($ch);
			curl_close($ch);
	
			$measuresData = json_decode($measuresRsp, true);

			if (isset($measuresData['body']['measuregrps'])) {
				$X = 5; // change the number of measures to display
				$counter = 0;

				echo '<h1>Last ' . $X . ' weight measurements</h1>';
				echo '<table>';
				echo '<tr><th>Date</th><th>Weight (kg)</th></tr>';
				foreach ($measuresData['body']['measuregrps'] as $measureGroup) {
					if ($counter >= $X) break;
					$counter++;

					echo '<tr>';
					echo '<td>' . date('d/m/Y H:i:s', $measureGroup['date']) . '</td>';
					echo '<td>' . ($measureGroup['measures'][0]['value'] * pow(10, $measureGroup['measures'][0]['unit'])) . '</td>';
					echo '</tr>';
				}
				echo '</table>';
			} else {
				echo '<p>Error: No weight measurements found</p>';
			}
		} else {
			echo '<p>Error: Unable to get the access token, authorize again to refresh the authorization code</p>';
		}
	} else {
		echo '<p>Click on the link below to authorize the access to Withings data</p>';
	}
?>

<html>
	<head>
		<title>Withings Oauth2</title>
	</head>
	<body>
		<a href="https://account.withings.com/oauth2_user/authorize2?response_type=code&client_id=a16837aaa8f536b229ce20fa8e90a2739885b640ff67de7b84562b6fe0e27513&redirect_uri=http://localhost:7070&state=withings_test&scope=user.metrics&mode=demo">Authorize</a>
	</body>
</html>