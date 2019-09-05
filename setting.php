<?php
//setting.php

include "connect.php";
include "header.php";

if($_SESSION['signed_in'] == true){

	if($_SERVER['REQUEST_METHOD'] != 'POST'){
		echo '
			<div class="col-lg-12">
		        <ul class="list-group">
		            <li class="list-group-item clearfix" style="text-align:center;">
		                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bg-warning"><h3>Setting</h3></div>
		            </li>
		            <li class="list-group-item clearfix">
		            	<div class="col-lg-2 col-md-2 col-sm-2 panel panel-default">
	                    	<ul class="nav nav-pills nav-stacked">
	                    		<li ><a href="#account_setting">Account</a></li>
	                    		<li ><a href="#profile_setting">Profile</a></li>
	                    	</ul>
	                    </div>

	                    <div class="col-lg-10 col-md-10 col-sm-10 panel-group">
	                    	<div class="panel panel-info">
		                    	<div class="panel-heading" id="account_setting"><h4>Account<h4></div>
		                    	<div class="panel-body">
					                <form class="form-horizontal" role="form" method="post" action="" name="account_setting">
					                    <div class="form-group">
					                        <label class="control-label col-lg-3" for="newpwd">New Password:</label>
					                        <div class="col-lg-9">          
					                            <input type="password" class="form-control" id="newpwd" placeholder="Enter new password" name="user_pass">
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="control-label col-lg-3" for="newre-pwd">New Re-Password:</label>
					                        <div class="col-lg-9">          
					                            <input type="password" class="form-control" id="newre-pwd" placeholder="Re-enter new password" name="user_pass_check">
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="control-label col-lg-3" for="pwd">Old Password:</label>
					                        <div class="col-lg-9">          
					                            <input type="password" class="form-control" id="pwd" placeholder="Enter old password" name="user_old_pass">
					                        </div>
					                    </div>
					                    <div class="form-group">
					                        <label class="control-label col-lg-3" for="email">Email:</label>
					                        <div class="col-lg-9">
					                            <input type="email" class="form-control" id="email" placeholder="Enter email" name="user_email">
					                        </div>
					                    </div>
					                    <div class="form-group">        
					                        <div class="col-lg-offset-3 col-sm-offset-5 col-md-offset-5 col-xs-offset-5 col-lg-10 col-md-10 col-sm-10 col-xs-10" style="text-align:left;">
					                            <button type="submit" class="btn btn-default" name="account_setting_submit" value="1">Save</button>
					                        </div>
					                    </div>
					                </form>
				                </div>
			                </div>
		          
	                    	<div class="panel panel-info">
		                    	<div class="panel-heading" id="profile_setting"><h4>Profile<h4></div>
		                    	<div class="panel-body">
					                <form class="form-horizontal" role="form" method="post" action="" name="profile_setting" enctype="multipart/form-data">
					                    <div class="form-group">
					                        <label class="control-label col-lg-3" for="pp">Profile Picture:</label>
					                   
				                        	<div class="col-lg-6 col-md-8 col-sm-8 col-xs-8">          
				                            	<input type="file" class="form-control" id="pp" name="user_image">
				                            </div>
				                            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4" style="float:right;">
				                            	<button type="submit" class="btn btn-default" name="profile_picture_upload" value="1">Upload</button>
				                            </div>
					
					                    </div>
				                    </form>

				                    <form class="form-horizontal" role="form" method="post" action="">
					                    <div class="form-group">
					                        <label class="control-label col-lg-3" for="pw">Personal Website:</label>
					                        <div class="col-lg-9">          
					                            <input type="text" class="form-control" id="pw" placeholder="Enter website url" name="user_website">
					                        </div>
					                    </div>

					                    <div class="form-group">
					                        <label class="control-label col-lg-3" for="sl">Personal Social Link:</label>
					                        <div class="col-lg-9">          
					                            <input type="text" class="form-control" id="sl" placeholder="Enter social link url" name="user_social_link">
					                        </div>
					                    </div>

					                    <div class="form-group">
					                        <label class="control-label col-lg-3" for="bd">Birthday:</label>
					                        <div class="col-lg-9">
					                            <input type="text" class="form-control" id="bd" placeholder="Enter birthday (ex. Jan 1, 1970)" name="user_birthday">
					                        </div>
					                    </div>

					                    <div class="form-group">
					                        <label class="control-label col-lg-3" for="am">About Me:</label>
					                        <div class="col-lg-9">
		                                        <textarea class="form-control" rows="5" id="am" placeholder="Enter content" name="user_about_you" style="resize:vertical;"></textarea>
		                                    </div>
					                    </div>

					                    <div class="form-group">
					                        <label class="control-label col-lg-3" for="ht">Hometown:</label>
					                        <div class="col-lg-9">
					                            <input type="text" class="form-control" id="ht" placeholder="Enter your hometown" name="user_hometown">
					                        </div>
					                    </div>

					                    <div class="form-group">
					                        <label class="control-label col-lg-3" for="nn">Nickname:</label>
					                        <div class="col-lg-9">
					                            <input type="text" class="form-control" id="nn" placeholder="Enter your nickname" name="user_nickname">
					                        </div>
					                    </div>

					                    <div class="form-group">        
					                        <div class="col-lg-offset-3 col-sm-offset-5 col-md-offset-5 col-xs-offset-5 col-lg-10 col-md-10 col-sm-10 col-xs-10" style="text-align:left;">
					                            <button type="submit" class="btn btn-default" name="profile_setting_submit" value="1">Save</button>
					                        </div>
					                    </div>
					                </form>
				                </div>
			                </div>
		                </div>
		            </li>
		        </ul>
		    </div>
			';
	}else{
		//update data!
		if(!empty($_POST['account_setting_submit'])){

			$email_field = false;
			$password_field = false;
			$email_field_update = false;
			$password_field_update = false;

			if(!empty($_POST['user_email'])){
				$email_field = true;

				$sql = 'UPDATE 
							users
						SET 
							user_email="'. mysqli_real_escape_string($conn, $_POST['user_email']) .'"
						WHERE 
							user_id=' . $_GET['id'];

				$result = mysqli_query($conn, $sql);

				if(!$result){
					echo '<div class="col-lg-12">';
				        echo '<div class="col-lg-12">';
				                echo '<ul class="list-group">';
				                    echo '<li class="list-group-item clearfix" style="text-align:center;">';
				                        echo '<div class="col-lg-12 bg-danger"><h4><span class="glyphicon glyphicon-exclamation-sign"></span> ERROR updating email. Please contact admin to fix this.</h4></div>';
				                    echo '</li>';
				                echo '</ul>';
				        echo '</div>';
				    echo '</div>';

				}else{
					$email_field_update = true;
				}
			}

			if(!empty($_POST['user_old_pass'])){
				$password_field = true;

				$errors;

				$sql = "SELECT 
	                        user_id,
	                        user_name,
	                        user_level
	                    FROM
	                        users
	                    WHERE
	                        user_name = '" . mysqli_real_escape_string($conn, $_SESSION['user_name']) . "'
	                    AND
	                        user_pass = '" . sha1($_POST['user_old_pass']) . "'";
	                         
	            $result = mysqli_query($conn, $sql);

	            if(!$result){
	            	echo '<div class="col-lg-12">';
				        echo '<div class="col-lg-12">';
				                echo '<ul class="list-group">';
				                    echo '<li class="list-group-item clearfix" style="text-align:center;">';
				                        echo '<div class="col-lg-12 bg-danger"><h4><span class="glyphicon glyphicon-exclamation-sign"></span> ERROR getting old password. Please contact admin to fix this.</h4></div>';
				                    echo '</li>';
				                echo '</ul>';
				        echo '</div>';
				    echo '</div>';
	            }else{
	            	if(mysqli_num_rows($result) == 0){
	            		echo '<div class="col-lg-12">';
					        echo '<div class="col-lg-12">';
					                echo '<ul class="list-group">';
					                    echo '<li class="list-group-item clearfix" style="text-align:center;">';
					                        echo '<div class="col-lg-12 bg-danger"><h4><span class="glyphicon glyphicon-exclamation-sign"></span> Wrong old password. Back to <a href="setting.php?id=' . $_GET['id'] . '"><span class="glyphicon glyphicon-cog"></span> Setting</a> panel.</h4></div>';
					                    echo '</li>';
					                echo '</ul>';
					        echo '</div>';
					    echo '</div>';

	            	}else{
	            		if(!empty($_POST['user_pass']) && !empty($_POST['user_pass_check'])){
					    	//make sure password is right
					        if($_POST['user_pass'] != $_POST['user_pass_check']){
					            $errors = 'The two passwords did not match.';
					        }
					    }else{
					        $errors = 'The password and reconfimation password fields must not be empty.';
					    }

					    if(strlen($errors) > 0){
					    	echo '<div class="col-lg-12">';
						        echo '<div class="col-lg-12">';
						                echo '<ul class="list-group">';
						                    echo '<li class="list-group-item clearfix" style="text-align:center;">';
						                        echo '<div class="col-lg-12 bg-danger"><h4><span class="glyphicon glyphicon-exclamation-sign"></span> Error, ' . $errors . '. Back to <a href="setting.php?id=' . $_GET['id'] . '"><span class="glyphicon glyphicon-cog"></span> Setting</a> panel.</h4></div>';
						                    echo '</li>';
						                echo '</ul>';
						        echo '</div>';
						    echo '</div>';
					    }else{
					    	$sql = 'UPDATE 
								users
							SET 
								user_pass="'. sha1($_POST['user_pass']) .'"
							WHERE 
								user_id=' . $_GET['id'];

							$result = mysqli_query($conn, $sql);
							if(!$result){
								echo '<div class="col-lg-12">';
							        echo '<div class="col-lg-12">';
							                echo '<ul class="list-group">';
							                    echo '<li class="list-group-item clearfix" style="text-align:center;">';
							                        echo '<div class="col-lg-12 bg-danger"><h4><span class="glyphicon glyphicon-exclamation-sign"></span> ERROR updating password. Please contact admin to fix this.</h4></div>';
							                    echo '</li>';
							                echo '</ul>';
							        echo '</div>';
							    echo '</div>';
							}else{
								$password_field_update = true;
							}

					    }
	            	}
	            }
			}

			if(($email_field && $email_field_update) && ($password_field && $password_field_update)){
				echo '<div class="col-lg-12">';
			        echo '<div class="col-lg-12">';
			                echo '<ul class="list-group">';
			                    echo '<li class="list-group-item clearfix" style="text-align:center;">';
			                        echo '<div class="col-lg-12 bg-success"><h4>Succesfully updated your email and password. Back to <a href="setting.php?id=' . $_GET['id'] . '"><span class="glyphicon glyphicon-cog"></span> Setting</a> panel.</h4></div>';
			                    echo '</li>';
			                echo '</ul>';
			        echo '</div>';
			    echo '</div>';

			}else if(($email_field && $email_field_update) && !($password_field && $password_field_update)){
				echo '<div class="col-lg-12">';
			        echo '<div class="col-lg-12">';
			                echo '<ul class="list-group">';
			                    echo '<li class="list-group-item clearfix" style="text-align:center;">';
			                        echo '<div class="col-lg-12 bg-success"><h4>Succesfully updated your email. Back to <a href="setting.php?id=' . $_GET['id'] . '"><span class="glyphicon glyphicon-cog"></span> Setting</a> panel.</h4></div>';
			                    echo '</li>';
			                echo '</ul>';
			        echo '</div>';
			    echo '</div>';

			}else if(!($email_field && $email_field_update) && ($password_field && $password_field_update)){
				echo '<div class="col-lg-12">';
			        echo '<div class="col-lg-12">';
			                echo '<ul class="list-group">';
			                    echo '<li class="list-group-item clearfix" style="text-align:center;">';
			                        echo '<div class="col-lg-12 bg-success"><h4>Succesfully updated your password. Back to <a href="setting.php?id=' . $_GET['id'] . '"><span class="glyphicon glyphicon-cog"></span> Setting</a> panel.</h4></div>';
			                    echo '</li>';
			                echo '</ul>';
			        echo '</div>';
			    echo '</div>';
			}

		}

		if(!empty($_POST['profile_picture_upload'])){
			//image field
			if(!empty($_FILES['user_image']['tmp_name'])){
				$user_image = addslashes(file_get_contents($_FILES['user_image']['tmp_name']));
				$user_image_type = mysqli_real_escape_string($conn, $_FILES['user_image']['type']);

				if(substr($user_image_type,0,5) == "image"){
					$sql = 'UPDATE 
								users 
							SET 
								user_image="'. $user_image .'", 
								user_image_type="' . $user_image_type . '" 
							WHERE 
								user_id=' . $_GET['id'];

					$result = mysqli_query($conn, $sql);

					if(!$result){
						echo '<div class="col-lg-12">';
					        echo '<div class="col-lg-12">';
					                echo '<ul class="list-group">';
					                    echo '<li class="list-group-item clearfix" style="text-align:center;">';
					                        echo '<div class="col-lg-12 bg-danger"><h4><span class="glyphicon glyphicon-exclamation-sign"></span> Error on updating the profile picture.  Please contact admin to fix this.</h4></div>';
					                    echo '</li>';
					                echo '</ul>';
					        echo '</div>';
					    echo '</div>';
					}else{
						echo '<div class="col-lg-12">';
					        echo '<div class="col-lg-12">';
					                echo '<ul class="list-group">';
					                    echo '<li class="list-group-item clearfix" style="text-align:center;">';
					                        echo '<div class="col-lg-12 bg-success"><h4><span class="glyphicon glyphicon-exclamation-sign"></span> Succesfully uploaded profile picture. Back to <a href="setting.php?id=' . $_GET['id'] . '"><span class="glyphicon glyphicon-cog"></span> Setting</a> panel.</h4></div>';
					                    echo '</li>';
					                echo '</ul>';
					        echo '</div>';
					    echo '</div>';
					}

				}else{
					//error not image!
					echo '<div class="col-lg-12">';
				        echo '<div class="col-lg-12">';
				                echo '<ul class="list-group">';
				                    echo '<li class="list-group-item clearfix" style="text-align:center;">';
				                        echo '<div class="col-lg-12 bg-danger"><h4>Only images are allowed for profile picture. Back to <a href="setting.php?id=' . $_GET['id'] . '"><span class="glyphicon glyphicon-cog"></span> Setting</a> panel.</h4></div>';
				                    echo '</li>';
				                echo '</ul>';
				        echo '</div>';
				    echo '</div>';
				}
			}
		}

		if(!empty($_POST['profile_setting_submit'])){
			//website
			$user_website_update_field = false;
			$user_social_link_update_field = false;
			$user_birthday_update_field = false;
			$user_about_you_update_field = false;
			$user_hometown_update_field = false;
			$user_nickname_update_field = false;

			$count = 0;

			if(!empty($_POST['user_website'])){
				$sql = 'UPDATE 
							users
						SET 
							user_website="'. mysqli_real_escape_string($conn, $_POST['user_website']) .'"
						WHERE 
							user_id=' . $_GET['id'];

				$result = mysqli_query($conn, $sql);

				if(!$result){
					echo '<div class="col-lg-12">';
				        echo '<div class="col-lg-12">';
				                echo '<ul class="list-group">';
				                    echo '<li class="list-group-item clearfix" style="text-align:center;">';
				                        echo '<div class="col-lg-12 bg-danger"><h4><span class="glyphicon glyphicon-exclamation-sign"></span> ERROR updating website. Please contact admin to fix this.</h4></div>';
				                    echo '</li>';
				                echo '</ul>';
				        echo '</div>';
				    echo '</div>';

				}else{
					$user_website_update_field = true;
					$count++;
				}
			}

			//social link
			if(!empty($_POST['user_social_link'])){
				$sql = 'UPDATE 
							users
						SET 
							user_social_link="'. mysqli_real_escape_string($conn, $_POST['user_social_link']) .'"
						WHERE 
							user_id=' . $_GET['id'];

				$result = mysqli_query($conn, $sql);

				if(!$result){
					echo '<div class="col-lg-12">';
				        echo '<div class="col-lg-12">';
				                echo '<ul class="list-group">';
				                    echo '<li class="list-group-item clearfix" style="text-align:center;">';
				                        echo '<div class="col-lg-12 bg-danger"><h4><span class="glyphicon glyphicon-exclamation-sign"></span> ERROR updating social link. Please contact admin to fix this.</h4></div>';
				                    echo '</li>';
				                echo '</ul>';
				        echo '</div>';
				    echo '</div>';

				}else{
					$user_social_link_update_field = true;
					$count++;
				}
			}

			//birthday
			if(!empty($_POST['user_birthday'])){
				$sql = 'UPDATE 
							users
						SET 
							user_birthday="'. mysqli_real_escape_string($conn, $_POST['user_birthday']) .'"
						WHERE 
							user_id=' . $_GET['id'];

				$result = mysqli_query($conn, $sql);

				if(!$result){
					echo '<div class="col-lg-12">';
				        echo '<div class="col-lg-12">';
				                echo '<ul class="list-group">';
				                    echo '<li class="list-group-item clearfix" style="text-align:center;">';
				                        echo '<div class="col-lg-12 bg-danger"><h4><span class="glyphicon glyphicon-exclamation-sign"></span> ERROR updating birthday. Please contact admin to fix this.</h4></div>';
				                    echo '</li>';
				                echo '</ul>';
				        echo '</div>';
				    echo '</div>';

				}else{
					$user_birthday_update_field = true;
					$count++;
				}
			}

			//about you
			if(!empty($_POST['user_about_you'])){
				$sql = 'UPDATE 
							users
						SET 
							user_about_you="'. mysqli_real_escape_string($conn, $_POST['user_about_you']) .'"
						WHERE 
							user_id=' . $_GET['id'];

				$result = mysqli_query($conn, $sql);

				if(!$result){
					echo '<div class="col-lg-12">';
				        echo '<div class="col-lg-12">';
				                echo '<ul class="list-group">';
				                    echo '<li class="list-group-item clearfix" style="text-align:center;">';
				                        echo '<div class="col-lg-12 bg-danger"><h4><span class="glyphicon glyphicon-exclamation-sign"></span> ERROR updating about you. Please contact admin to fix this.</h4></div>';
				                    echo '</li>';
				                echo '</ul>';
				        echo '</div>';
				    echo '</div>';

				}else{
					$user_about_you_update_field = true;
					$count++;
				}
			}

			//hometown
			if(!empty($_POST['user_hometown'])){
				$sql = 'UPDATE 
							users
						SET 
							user_hometown="'. mysqli_real_escape_string($conn, $_POST['user_hometown']) .'"
						WHERE 
							user_id=' . $_GET['id'];

				$result = mysqli_query($conn, $sql);

				if(!$result){
					echo '<div class="col-lg-12">';
				        echo '<div class="col-lg-12">';
				                echo '<ul class="list-group">';
				                    echo '<li class="list-group-item clearfix" style="text-align:center;">';
				                        echo '<div class="col-lg-12 bg-danger"><h4><span class="glyphicon glyphicon-exclamation-sign"></span> ERROR updating hometown. Please contact admin to fix this.</h4></div>';
				                    echo '</li>';
				                echo '</ul>';
				        echo '</div>';
				    echo '</div>';

				}else{
					$user_hometown_update_field = true;
					$count++;
				}
			}

			//nickname
			if(!empty($_POST['user_nickname'])){
				$sql = 'UPDATE 
							users
						SET 
							user_nickname="'. mysqli_real_escape_string($conn, $_POST['user_nickname']) .'"
						WHERE 
							user_id=' . $_GET['id'];

				$result = mysqli_query($conn, $sql);

				if(!$result){
					echo '<div class="col-lg-12">';
				        echo '<div class="col-lg-12">';
				                echo '<ul class="list-group">';
				                    echo '<li class="list-group-item clearfix" style="text-align:center;">';
				                        echo '<div class="col-lg-12 bg-danger"><h4><span class="glyphicon glyphicon-exclamation-sign"></span> ERROR updating nickname. Please contact admin to fix this.</h4></div>';
				                    echo '</li>';
				                echo '</ul>';
				        echo '</div>';
				    echo '</div>';

				}else{
					$user_nickname_update_field = true;
					$count++;
				}
			}

			if($count > 0){
				$user_website_nametag = "website";
				$user_social_link_nametag = "social link";
				$user_birthday_nametag = "birthday";
				$user_about_you_nametag = "about you";
				$user_hometown_nametag = "hometown";
				$user_nickname_nametag = "nickname";

				echo '<div class="col-lg-12">';
			        echo '<div class="col-lg-12">';
			                echo '<ul class="list-group">';
			                    echo '<li class="list-group-item clearfix" style="text-align:center;">';
			                        echo '<div class="col-lg-12 bg-success"><h4>Succesfully updated your ';
			                        
			                        if($user_website_update_field && ($count > 1)){
			                        	echo $user_website_nametag.', ';
			                        	$count--;
			                        }else if($user_website_update_field && ($count == 1)){
			                        	echo $user_website_nametag;
			                        	$count--;
		                        	}
			                        
			                        if($user_social_link_update_field && ($count > 1)){
			                        	echo $user_social_link_nametag.', ';
			                        	$count--;
			                        }else if($user_social_link_update_field && ($count == 1)){
			                        	echo $user_social_link_nametag;
			                        	$count--;
		                        	}

		                        	if($user_birthday_update_field && ($count > 1)){
			                        	echo $user_birthday_nametag.', ';
			                        	$count--;
			                        }else if($user_birthday_update_field && ($count == 1)){
			                        	echo $user_birthday_nametag;
			                        	$count--;
		                        	}

		                        	if($user_about_you_update_field && ($count > 1)){
			                        	echo $user_about_you_nametag.', ';
			                        	$count--;
			                        }else if($user_about_you_update_field && ($count == 1)){
			                        	echo $user_about_you_nametag;
			                        	$count--;
		                        	}

		                        	if($user_hometown_update_field && ($count > 1)){
			                        	echo $user_hometown_nametag.', ';
			                        	$count--;
			                        }else if($user_hometown_update_field && ($count == 1)){
			                        	echo $user_hometown_nametag;
			                        	$count--;
		                        	}

		                        	if($user_nickname_update_field && ($count > 1)){
			                        	echo $user_nickname_nametag.', ';
			                        	$count--;
			                        }else if($user_nickname_update_field && ($count == 1)){
			                        	echo $user_nickname_nametag;
			                        	$count--;
		                        	}

			                        echo '. Back to <a href="setting.php?id=' . $_GET['id'] . '"><span class="glyphicon glyphicon-cog"></span> Setting</a> panel.</h4></div>';
			                    echo '</li>';
			                echo '</ul>';
			        echo '</div>';
			    echo '</div>';
			}
		}

		if(empty($_POST['account_setting_submit']) && empty($_POST['profile_setting_submit']) && empty($_POST['profile_picture_upload'])){
			echo '<div class="col-lg-12">';
		        echo '<div class="col-lg-12">';
		                echo '<ul class="list-group">';
		                    echo '<li class="list-group-item clearfix" style="text-align:center;">';
		                        echo '<div class="col-lg-12 bg-danger"><h4><span class="glyphicon glyphicon-exclamation-sign"></span> ERROR on updating data. Please contact admin to fix this.</h4></div>';
		                    echo '</li>';
		                echo '</ul>';
		        echo '</div>';
		    echo '</div>';
		}
	}

}else{
	echo '<div class="col-lg-12">';
        echo '<div class="col-lg-12">';
                echo '<ul class="list-group">';
                    echo '<li class="list-group-item clearfix" style="text-align:center;">';
                        echo '<div class="col-lg-12 bg-info"><h4>You must <a href="signin.php"><span class="glyphicon glyphicon-log-in"></span> Login</a> to perform further task.</h4></div>';
                    echo '</li>';
                echo '</ul>';
        echo '</div>';
    echo '</div>';
}

include "foother.php";

?>