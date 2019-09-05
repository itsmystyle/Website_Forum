<?php
//signout.php
//unset and destroy session and redicrect to index.php
session_start();

session_unset();
session_destroy();
header("Location: index.php");

?>