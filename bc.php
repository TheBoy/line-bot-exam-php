<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require "vendor/autoload.php";
include "cfg.inc.php";

$push_id = 'Cae9dd60f36bf563c94bc731e58857a8d';

$text = isset($_GET['text']) ? $_GET['text'] : NULL;

if($text != NULL)
{
  $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
  $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channel_secret]);
  $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($text);
  $response = $bot->pushMessage($push_id, $textMessageBuilder);
  echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
} else {
  echo 'null text';
}
