<!DOCTYPE html>
<html>
<head>
  <title>Upload your files</title>
</head>
<body>
  <form enctype="multipart/form-data" action="upload.php" method="POST">
    <p>Upload your file</p>
    <input type="file" name="uploaded_file"></input><br />
    <input type="submit" value="Upload"></input>
  </form>
</body>
</html>
<?PHP
  if(!empty($_FILES['uploaded_file'])){
    $path = "uploads/";
    $path = $path . md5( $_FILES['uploaded_file']['name']).".".pathinfo($_FILES['uploaded_file']["name"], PATHINFO_EXTENSION);

    if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
      chmod($path,0644);
      echo "The file ". md5($_FILES['uploaded_file']['name']).".".pathinfo($_FILES['uploaded_file']["name"], PATHINFO_EXTENSION); 
      " has been uploaded";
    } else{
        echo "There was an error uploading the file, please try again!";
    }
  }
?>
