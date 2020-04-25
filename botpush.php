<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require "vendor/autoload.php";

$access_token = 'kzqzlfgem1Lz5p1c+YCdemj3CPoIQNgYAl2H8l5xBiolWxSwEkQAt928oav0MwNAJZFSPvcRaCxEsbFx9YMVdljG2vybayRKjyMrxaiLt+7gBuX2a+sNRmURstLtkRE4wRgmM6mo1EbhTvlnUs9CHQdB04t89/1O/w1cDnyilFU=';
$channelSecret = '4e47cd8160b5b54c68e9de710e8647af';
$pushID = 'Ud766ebb32103f4f5962851494f23b918';

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
