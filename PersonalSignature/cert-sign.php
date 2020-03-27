<?php
  if($_POST["req"] == "yes"){
    $str = $rsa->privateEncrypt('world', $rsa->privateKey);
    $str = base64_encode($str);;
    echo $str
  }
?>
