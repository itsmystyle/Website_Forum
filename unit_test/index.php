<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Testing bootstrap!</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

	<style>
	
	</style>
</head>

<body>
	<div class="container" style="margin-top:2%;">
		<div class="row">
			<div class="col-lg-12">
				<form class="form-horizontal" role="form" method="post" action="" name="profile_setting_image" enctype="multipart/form-data">
	                <div class="form-group">
	                    <label class="control-label col-lg-3" for="pp">Profile Picture:</label>
	                    <div class="col-lg-9">          
	                        <input type="file" class="form-control" id="pp" name="image"></input>
	                        <button class="btn btn-default" type="submit" name="image_submit" value="ok">submit</button>
	                    </div>
	                </div>
	            </form>
			</div>
		</div>
	</div>
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

$file = $_FILES['image']['tmp_name'];
 
if(!isset($file)){
	echo "select image";
	echo '<img src=test.php?id=8>';
}else{
	$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
	$image_name = mysqli_real_escape_string($conn, $_FILES['image']['name']);
	$image_size = getimagesize($_FILES['image']['tmp_name']);
	$image_type = mysqli_real_escape_string($conn, $_FILES['image']['type']);

	echo $image_name." ";
	//echo $image. " ";

	if($image_size== false){
		echo "not image!";
	}else{
		$sql = "INSERT INTO unit_test_image (image_name, image_data, image_type) VALUES ('". $image_name ."', '" . $image . "', '" . $image_type . "')";

		$result = mysqli_query($conn, $sql);

		if(!$result){
			echo "fail!";
		}else{
			$lastid = mysqli_insert_id($conn);
			echo 'Successfully uploaded.<img src=test.php?id='. $lastid .'>';
		}
	}
}




?>


</body>

</html>