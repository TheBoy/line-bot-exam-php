<?php
$access_token = 'kzqzlfgem1Lz5p1c+YCdemj3CPoIQNgYAl2H8l5xBiolWxSwEkQAt928oav0MwNAJZFSPvcRaCxEsbFx9YMVdljG2vybayRKjyMrxaiLt+7gBuX2a+sNRmURstLtkRE4wRgmM6mo1EbhTvlnUs9CHQdB04t89/1O/w1cDnyilFU=';

$userId = 'Ud766ebb32103f4f5962851494f23b918';

$url = 'https://api.line.me/v2/bot/profile/'.$userId;

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
