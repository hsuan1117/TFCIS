<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  
  //Load RSA library
  require_once("lib/RSA.php");
  
  $rsa = new Rsa();
  echo "Public Key：<br>".$rsa->publicKey."<br>";
  echo "Private Key：<br>".$rsa->privateKey."<br>";
