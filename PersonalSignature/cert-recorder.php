<html>
  <h1>Only submit PUBLIC key</h1>
  <form action="cert-recorder.php" method="POST">
    <textarea name="cert"></textarea>
    <br>
    <textarea name="signed"></textarea>
    <br>
    <input type="text" name="account" > 
    <br>
    <input type="submit" value="send">
    <br>
    <input type="hidden" name="req" value="yes"> 
  </form>
</html>
<?php
  $temp="";
  var_dump($_POST);
  if($_POST["req"]=="yes"){
    $DataFile = "data/T22.json";
    $data     = json_decode(file_get_contents($DataFile),true);
    var_dump($data);
    if(array_key_exists($_POST["account"], $data)){
      //verify
      if(openssl_verify(
        base64_decode($_POST["signed"]),
        base64_decode($_POST["sign_msg"]),
        base64_decode($data[$_POST["account"]]) 
      )){
        $data[$_POST["account"]] = base64_encode($_POST["cert"]);
      }
    }else{
      $data[$_POST["account"]] = base64_encode($_POST["cert"]);
    }
    
    file_put_contents($DataFile,json_encode($data));
  }
?>
