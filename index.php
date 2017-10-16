<?php
if (isset($_POST['submit'])) {
    // Clear all files from upload dir
  /*  $files = glob('upload/*'); 
    foreach ($files as $file) { 
        if (is_file($file))
            unlink($file);
    }
    */

    // Get File Details and upload to Upload dir
    $name = $_FILES['file']['name'];
    $temp_name = $_FILES['file']['tmp_name'];
    if (isset($name)) {
        if (!empty($name)) {
            $location = 'upload/';
            $storagename = 'data.csv';
            if (move_uploaded_file($temp_name, $location . $storagename)) {
                header("Location: table.php");
            }
        }
    } else {
        echo 'You should select a file to upload !!';
    }
}
?>

<!DOCTYPE html>  
<html>  
    <body>  
        <form action="index.php" 
              method="post" enctype="multipart/form-data">
            <label>Select CSV File:</label>
            <input type="file" name="file" />
            <br />
            <input type="submit" name="submit" value="Import" class="btn btn-info" /> 
        </form>
    </body>  
</html>