<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require "vendor/autoload.php";

$access_token = 'kzqzlfgem1Lz5p1c+YCdemj3CPoIQNgYAl2H8l5xBiolWxSwEkQAt928oav0MwNAJZFSPvcRaCxEsbFx9YMVdljG2vybayRKjyMrxaiLt+7gBuX2a+sNRmURstLtkRE4wRgmM6mo1EbhTvlnUs9CHQdB04t89/1O/w1cDnyilFU=';

$channelSecret = '4e47cd8160b5b54c68e9de710e8647af';

$pushID = 'Ud766ebb32103f4f5962851494f23b918';

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);

//$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello world');

$textMessageBuilder = [
  'to': $pushID,
  'messages': [
    'type' => 'flex',
    'altText' => 'This is Flex',
    'contents': {
      'type': 'bubble',
      'body': {
        'type': 'box',
        'layout': 'vertical',
        'contents': [
          {
            'type': 'button',
            'style': 'primary',
            'height': 'sm',
            'action': {
              'type': 'uri',
              'label': 'Add to Cart',
              'uri': 'https://developers.line.me'
            }
          }
        ]
      }
    }
  ]
];

$response = $bot->pushMessage($pushID, $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
