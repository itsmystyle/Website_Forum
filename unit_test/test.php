<?php
$server = 'localhost';
$username   = 's103062161';
$password   = 'lonely_chai';
$database   = 's103062161';
$conn = mysqli_connect($server, $username,  $password);
 
if($conn == null){
    exit('Error: could not establish database connection');
}

if(!mysqli_select_db($conn, $database)){
    exit('Error: could not select the database');
}

$id = $_GET['id'];

$sql = "SELECT * FROM unit_test_image WHERE image_id='" . $id . "'";
$result = mysqli_query($conn, $sql);

if(!$result){
    echo "bad";
}else{
    $image;
    $image_type;
    while($row = mysqli_fetch_assoc($result)){
        $image = $row['image_data'];
        $image_type = $row['image_type'];
    }

    header("Content-type: $image_type");
    echo $image;
}

?>