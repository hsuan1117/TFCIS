<?php
header("Access-Control-Allow-Origin: *");
$file="https://data.nhi.gov.tw/resource/mask/maskdata.csv";

$cache_file = 'content.cache';
if(file_exists($cache_file)) {
  if(time() - filemtime($cache_file) > 60) {
     // too old , re-fetch
     $cache = file_get_contents($file);
     file_put_contents($cache_file, $cache);
     $csv= $cache;
     $array = array_map("str_getcsv", explode("\n", $csv));
     $json = json_encode($array,JSON_UNESCAPED_UNICODE);
     echo $json;
  } else {
     // cache is still fresh
     $csv= file_get_contents($cache_file);
     $array = array_map("str_getcsv", explode("\n", $csv));
     $json = json_encode($array,JSON_UNESCAPED_UNICODE);
     echo $json;
     header("Cache-OK: true");
  }
} else {
  // no cache, create one
  $cache = file_get_contents($file);
  file_put_contents($cache_file, $cache);
  $csv= $cache;
  $array = array_map("str_getcsv", explode("\n", $csv));
  $json = json_encode($array,JSON_UNESCAPED_UNICODE);
  echo $json;
}


