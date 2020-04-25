<?php // callback.php

require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');
include('cfg.inc.php');

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			$text = $event['message']['text']; // Get text sent
			$replyToken = $event['replyToken']; // Get replyToken
			$userId = $event['source']['userId']; // Get userID
			$responseText = NULL;

			// extract for number
			if(is_numeric($text) && $text != '')
			{
				$sql = '';
				for($i=1; $i<=5; $i++) {
					if(strpos($text, (string)$i) !== false)
					{
						$sql .= 't' . $i . '=1,';
					}
				}

				if($sql != '') {
					$sql = rtrim('INSERT INTO users SET userId = "'.$userId.'", ' . $sql, ',');
					db_save($sql);
					$responseText = 'บันทึกข้อมูลแล้ว';
				} else {
					$responseText = "ข้อมูลที่คุณส่งให้เราไม่ถูกต้อง!! เราอยากทราบเป้าหมายของคุณก่อน โดยหากคุณชอบมากกว่า 1 อย่าง สามารถส่งมาได้ทั้งหมด 1 = รัฐ, 2 = หุ้นไทย, 3 = หุ้นต่างประเทศ, 4 = ยี่กี, 5 = ยี่กี VIP";
				}
				
			} else {
				$responseText = "ข้อมูลที่คุณส่งให้เราไม่ถูกต้อง!! เราอยากทราบเป้าหมายของคุณก่อน โดยหากคุณชอบมากกว่า 1 อย่าง สามารถส่งมาได้ทั้งหมด 1 = รัฐ, 2 = หุ้นไทย, 3 = หุ้นต่างประเทศ, 4 = ยี่กี, 5 = ยี่กี VIP";
			}

			// reply message
			if($responseText) echo replyMessage($replyToken, $responseText);
		}
	}
}
echo "OK: ";

function replyMessage($replyToken, $message)
{
	// Build message to reply
	$messages = [
		'type' => 'text',
		'text' => $message
	];

	// Make a POST Request to Messaging API to reply to sender
	$url = 'https://api.line.me/v2/bot/message/reply';
	$data = [
		'replyToken' => $replyToken,
		'messages' => [$messages],
	];
	$post = json_encode($data);
	$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . LINE_ACCESS_TOKEN);

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	$result = curl_exec($ch);
	curl_close($ch);

	return $result;
}

function connect()
{
	$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	return $conn;
}

function disconnect($conn)
{
	$conn->close();
}

function query($conn, $q)
{
	$result = NULL;
	if (!$result = $conn -> query($q)) {
		echo("Error description: " . $conn -> error);
	}
	return $result;
}

function db_save($q)
{
	$conn = connect();
	$query = query($conn, $q);
	disconnect($conn);
	return $query;
}
