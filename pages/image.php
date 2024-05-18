<?php 
include "../php/server.php"; 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>Upload your photo in jpeg, jfif, or png format.</p>
    <form action="../php/image.php" method="post" enctype="multipart/form-data">
    <input type="file" name="image" id="image" accept="image/*" required>
        <input type="submit" name="submit">
    </form>
</body>
</html>