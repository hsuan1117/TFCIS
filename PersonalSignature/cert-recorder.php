<html>
  <h1>Only submit PUBLIC key</h1>
  <form action="cert-recorder.php" method="POST">
    <textarea name="cert"></textarea>
    <input type="hidden" name="req" value="yes"> 
  </form>
</html>
<?php
  if($_POST["req"]=="yes"){
    $DataFile = "data/T22.json";
    $data     = json_decode(file_get_contents($DataFile),true);
    
  }
?>
