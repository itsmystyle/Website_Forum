<?php
//connect.php
$server = 'localhost';
$username   = ''; //Database username
$password   = ''; //Database password
$database   = ''; //Database schema name
$conn = mysqli_connect($server, $username,  $password);
 
if($conn == null){
    exit('Error: could not establish database connection');
}

if(!mysqli_select_db($conn, $database)){
    exit('Error: could not select the database');
}
?>