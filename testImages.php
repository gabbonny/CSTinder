<?php
    $msg = "";
    if(isset($_POST['submit'])){
        $profile = "images/".basename($_FILES['image']['name']);
        $db = mysqli_connect("localhost","root", "", "photos");
        
        $pic = $_FILES['image']['name'];
        
        $sql= "INSERT INTO images (image) VALUES ('$pic')";
        mysqli_query($db,$sql);
        
        if(move_uploaded_file($_FILES['image']['tmp_name'], $profile)){
            $msg = "Hello";
        }else {
            $msg = "Bye";
        }
        
    }

?>
<!DOCTYPE html>
<html>
 <body>
  <form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="size" value="10000000">
   <label for="file">Filename:</label>
     <input type="file" name="image" id="file"><br>
     <input type="submit" name="submit" value="Upload">
  </form>
 </body>
</html> 