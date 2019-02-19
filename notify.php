<?php // callback.php

require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

$access_token = 'kzqzlfgem1Lz5p1c+YCdemj3CPoIQNgYAl2H8l5xBiolWxSwEkQAt928oav0MwNAJZFSPvcRaCxEsbFx9YMVdljG2vybayRKjyMrxaiLt+7gBuX2a+sNRmURstLtkRE4wRgmM6mo1EbhTvlnUs9CHQdB04t89/1O/w1cDnyilFU=';
$channelSecret = '4e47cd8160b5b54c68e9de710e8647af';
$idPush = 'Ud766ebb32103f4f5962851494f23b918'
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);
$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello world');
$response = $bot->pushMessage($idPush, $textMessageBuilder);

echo "result: " . $response->getHTTPStatus() . ' ' . $response->getRawBody();
?>
