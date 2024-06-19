<?php
function sendRequest($url, $method, $data)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

	if ($method !== 'GET')
	{
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	}

	$response = curl_exec($ch);

	if (curl_errno($ch))
	{
		echo 'Error:' . curl_error($ch);
	}

	curl_close($ch);

	return $response;
}

// HTTP Insert Request
$data = [
	'id' => '1',
	'first_name' => 'Ucil',
	'last_name' => 'Sugiyono',
	'address' => 'sabang sampai merauke',
	'phone' => '(+62)123456789',
	'email' => 'ucil@example.com',
	'note' => 'blabla'
];
$response = sendRequest('POST', 'http://localhost/simple-rest-api/api/users', $data);
echo "<h3>HTTP Insert Request</h3>\n" . $response;

// HTTP Select Request
$data = [
	'id' => 1
];
$response = sendRequest('GET', 'http://localhost/simple-rest-api/api/users', $data);
echo $response;
echo "<h3>HTTP Select Request</h3>\n" . $response;

// HTTP Select All Request
$response = sendRequest('GET', 'http://localhost/simple-rest-api/api/users', []);
echo $response;
echo "<h3>HTTP Select All Request</h3>\n" . $response;
