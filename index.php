<?php
define('WEB_NAME', 'JETSADABET');

$str = substr(str_shuffle("0123456789"), 0, 5);
$array1 = (str_split($str));
$marked1 = $array1[0];
$marked2 = $array1[2];

$merged1 = j1($marked1, $array1);
$merged2 = j1($marked2, $array1, true);



// $set1 = array_shuffle($arr);
// $set2 = array_shuffle($arr);
$data = array(
  'row' => $str,
  'row_array' => $array1,
  'marked1' => $marked1,
  'marked2' => $marked2,
  'merged1' => $merged1,
  'merged2' => $merged2

);
e($data);


function j1($marked, $arr, $tail = false)
{
  $merged = array();
  $shuff = shuffle($arr);
  for($i=0; $i<3; $i++) :
      if(!$tail) $merged[] = $marked . $arr[$i];
      else $merged[] = $arr[$i]. $marked;
  endfor;

  return $merged;
}

function e($data)
{
  echo 'จับยี่กี ' . WEB_NAME . ' รอบที่ ' . sprintf("%02d",rand(0,88));
  echo '<br />---------------<br />';
  echo 'เด่น ' . $data['marked1'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;รอง ' . $data['marked2'] . '<br/>';
  echo $data['merged1'][0] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $data['merged1'][1] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'  . $data['merged1'][2];
  echo '<br />';
  echo $data['merged2'][0] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $data['merged2'][1] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'  . $data['merged2'][2];
  echo '<br /> WIN / ปักสิบบน-ล่าง<br/>';
  echo '===> ' . $data['row'] . ' <===';
  echo '<br />---------------<br />';
  echo 'หมูพู';
}

function p($d)
{
  echo '<pre>';
  print_r($d);
  echo '</pre><hr />';
}
