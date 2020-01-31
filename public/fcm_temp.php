<?php

$curl = curl_init();

$header = [
	'Authorization: Key=AIzaSyBZrb6oGNR3AE37fzOf-B5JIafc7XdedaM',
	'Content-Type: Application/json',
];

$msg = [
	'title' => 'Title',
	'body' => 'Body',
];

$payload = [
	'registration_ids' => ['eKd7jMByFvkMSb9wD0p3zS:APA91bH1J5KbjfJ0OXjx3Ub9H1FXyjKu6jf5RlFUYpk9RRyltDUTJAtFANosuaLlCmKcgRs56B-CH4k8IKFVXCP5HZgkLJYIJ45lnkHRCyNuXMKnSCmHYvkEdl5dN27hoYVOQzACYOih'],
	'data' => $msg,
];

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode($payload),
  CURLOPT_HTTPHEADER => $header
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}