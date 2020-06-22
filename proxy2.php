<?php

header("Access-Control-Allow-Origin: *");
$file = "https://github.com/Koios1143/Koios1143-chat-bot/raw/master/data/maskdata_pos.csv";
$cache_file = 'content2.cache';
error_reporting(~0); ini_set('display_errors', 1);
function output($fresh,$f,$fc){
  $csv = "";
  if($fresh==1){
    $csv = file_get_contents(
      $fc
    );
  }else{
    $csv = file_get_contents(
      $f
    );
    file_put_contents(
      $fc, $csv
    );
  }
  $array2 = array();
  $array = array_map(
    "str_getcsv", 
    explode("\n", $csv)
  );
  foreach($array as $i => $key) {
    array_splice($array[$i],1,6);
  }
  for($i2=0;$i2<count($array)-1;$i2++) {
    $array2[$array[$i2][0]] = array(
      $array[$i2][1],
      $array[$i2][2]
    );
  }
  $json = json_encode(
    $array2, JSON_UNESCAPED_UNICODE
  );
  echo $json;
}


if(file_exists($cache_file)){
  if((time() - filemtime($cache_file))> 86400) {
    output(0,$file,$cache_file);
  }else{
    output(1,$file,$cache_file);
  }
} else {
  output(0,$file,$cache_file);
}
