<?php
include "connect.php";

$id = $_GET['id'];

$sql = "SELECT user_image, user_image_type FROM users WHERE user_id='" . $id . "'";
$result = mysqli_query($conn, $sql);

if(!$result){
    echo "bad";
}else{
    $image;
    $image_type;
    while($row = mysqli_fetch_assoc($result)){
        $image = $row['user_image'];
        $image_type = $row['user_image_type'];
    }

    header("Content-type: $image_type");
    echo $image;
}

?>