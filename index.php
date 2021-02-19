<?php
$targetDir= "upload/";
if(isset($_POST["submit"])){
    if($_FILES["fileToUpload"]["name"]){
        $targetFile = $targetDir.basename($_FILES["fileToUpload"]["name"]);
        $uploadOK = 1;
        $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

        if($check !==false ){
            echo "File is a image - " . $check["mime"]. ".";
            $uploadOK = 1;
        }else{
            echo "File is not an image.";
            $uploadOK = 0;
        }

        // Check if file already exists
        if (file_exists($targetFile )) {
          echo "Sorry, file already exists.";
          $uploadOK = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
          echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOK = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOK == 0) {
          echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
          } else {
            echo "Sorry, there was an error uploading your file.";
          }
        }
    }else{
        echo "Please choose image.";
    }
}

$files = scandir($targetDir);

?>
<!DOCTYPE html>
<head>
    <title>Gallery</title>
</head>
<body>
    <form action="index.php" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type = "file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
    </form>
    <div>
        <?php
          for($i = 2;$i<count($files);$i++){
            echo "<img src='".$targetDir.$files[$i]."' alt='Trulli' width='500' height='333'>";
          }
        ?>
    </div>
</body>
</html>

