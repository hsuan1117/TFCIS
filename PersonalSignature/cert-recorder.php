<html>
  <h1>Only submit PUBLIC key</h1>
  <form action="cert-recorder.php" method="POST">
    <textarea name="cert"></textarea>
    <br>
    <input type="text" name="name" > 
    <br>
    <input type="hidden" name="req" value="yes"> 
  </form>
</html>
<?php
  if($_POST["req"]=="yes"){
    $DataFile = "data/T22.json";
    $data     = json_decode(file_get_contents($DataFile),true);
    
    if(array_key_exists($_POST["account"], $data)){
      //verify
      if(0){}
    }else{
      $data[$_POST["account"]] = base64_encode($_POST["cert"]);
    }
    
    file_put_contents($DataFile,json_encode($data));
  }
?>
