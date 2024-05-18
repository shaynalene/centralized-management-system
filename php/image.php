<?php 
include "../php/server.php"; 

    $file = $_FILES['image'];
    $filename = $file['name'];
    $image = file_get_contents($file['tmp_name']);

    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);

    $stmt = $conn->prepare("INSERT INTO images (filename, img) VALUES (?, ?)");
    $stmt->bind_param('ss', $filename, $image);
    $stmt->execute();
    $stmt->close();


    if($file_extension === 'png'){
        echo 'this is a png file';
        echo '<img src="data:image/png;base64,'.base64_encode($image).'"/>';
    }
    else if($file_extension === 'jpeg' || 'jpg'){
        echo 'this is a jpg file';
        echo '<img src="data:image/jpeg;base64,'.base64_encode($image).'"/>';
    }
    else{
        echo 'Invalid Format';
    }
    

?>