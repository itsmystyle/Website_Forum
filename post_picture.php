<?php
include "connect.php";

$id = $_GET['id'];

$sql = "SELECT post_image, post_image_type FROM posts WHERE post_id='" . $id . "'";
$result = mysqli_query($conn, $sql);

if(!$result){
    echo "bad";
}else{
    $image;
    $image_type;
    while($row = mysqli_fetch_assoc($result)){
        $image = $row['post_image'];
        $image_type = $row['post_image_type'];
    }

    header("Content-type: $image_type");
    echo $image;
}

?>