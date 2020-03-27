<?php
  if($_POST["req"] == "yes"){
    $s = "";
    $str = openssl_sign('world', $s ,base64_decode($_POST["cert"]));
    $str = base64_encode($str);
    echo $str
  }
?>
