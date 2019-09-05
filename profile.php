<?php
//profile.php
include "header.php";
include "connect.php";

if($_SESSION['signed_in'] == true){
	$sql = "SELECT 
				user_name, 
				user_email, 
				user_website, 
				user_social_link, 
				user_birthday, 
				user_about_you, 
				user_hometown, 
				user_nickname, 
				user_image_type 
			FROM 
				users 
			WHERE 
				user_id=" . $_GET['id'];

	$result = mysqli_query($conn, $sql);

	if(!$result){
		echo '<div class="col-lg-12">';
	        echo '<div class="col-lg-12">';
	                echo '<ul class="list-group">';
	                    echo '<li class="list-group-item clearfix" style="text-align:center;">';
	                        echo '<div class="col-lg-12 bg-danger"><h4><span class="glyphicon glyphicon-exclamation-sign"></span> ERROR retrieving user profile from database. Please contact admin to fix this.</h4></div>';
	                    echo '</li>';
	                echo '</ul>';
	        echo '</div>';
	    echo '</div>';
	}else{

		while($row = mysqli_fetch_assoc($result)){
			echo '
				<div class="col-lg-12">
					<div class="panel panel-info">
						<div class="panel panel-heading"><h4>Profile</h4></div>
						<div class="panel panel-body">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">';
							if($row['user_image_type'] == ""){
								echo '<img src="/forum/profile.png" alt="Profile Picture" class="img-responsive img-rounded center-block" style="height:250px;"/>';
							}else{
								echo '<img src="profile_picture.php?id=' . $_GET['id'] . '" class="img-responsive img-rounded center-block" style="height:250px;"/>';
							}
					echo   '</div>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							    <ul class="nav nav-tabs col-lg-12 col-md-12 col-sm-12 col-xs-12">
								    <li class="active"><a data-toggle="tab" href="#basic_info">Basic Info</a></li>
								    <li><a data-toggle="tab" href="#about_me">About Me</a></li>
								    <li><a data-toggle="tab" href="#social_network">Social</a></li>
								</ul>
								<div class="tab-content">
								    <div id="basic_info" class="tab-pane fade in active">
									    <ul class="list-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
									    	<li class="list-group-item clearfix" style="text-align:center;" id="basic_info">
												<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="text-align:right;"><h5>Member Name:</h5></div>
												<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" style="text-align:left;">
													<h5>' . $row['user_name'] . '</h5>
												</div>
											</li>
											<li class="list-group-item clearfix" style="text-align:center;">
												<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="text-align:right;"><h5>Nickname:</h5></div>
												<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" style="text-align:left;">
													<h5>' . $row['user_nickname'] . '</h5>
												</div>
											</li>
											<li class="list-group-item clearfix" style="text-align:center;">
												<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="text-align:right;"><h5>Birthday:</h5></div>
												<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" style="text-align:left;">
													<h5>' . $row['user_birthday'] . '</h5>
												</div>
											</li>
											<li class="list-group-item clearfix" style="text-align:center;">
												<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="text-align:right;"><h5>Email:</h5></div>
												<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" style="text-align:left;">
													<h5>' . $row['user_email'] . '</h5>
												</div>
											</li>
											<li class="list-group-item clearfix" style="text-align:center;">
												<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="text-align:right;"><h5>Hometown:</h5></div>
												<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" style="text-align:left;">
													<h5>' . $row['user_hometown'] . '</h5>
												</div>
											</li>
									    </ul>
								    </div>

								    <div id="about_me" class="tab-pane fade">
									    <ul class="list-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
									    	<li class="list-group-item clearfix" style="text-align:center;" id="about_me">
												<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="text-align:right;"><h5>About Me:</h5></div>
												<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" style="text-align:left;">
													<h5>' . $row['user_about_you'] . '</h5>
												</div>
											</li>
									    </ul>
								    </div>

								    <div id="social_network" class="tab-pane fade">
									    <ul class="list-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
									    	<li class="list-group-item clearfix" style="text-align:center;" id="social_network">
												<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="text-align:right;"><h5>Personal Website:</h5></div>
												<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" style="text-align:left;">
													<h5><a href="' . $row['user_website'] . '">' . $row['user_website'] . '</a></h5>
												</div>
											</li>
											<li class="list-group-item clearfix" style="text-align:center;">
												<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="text-align:right;"><h5>Personal Social-link:</h5></div>
												<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" style="text-align:left;">
													<h5><a href="' . $row['user_social_link'] . '">' . $row['user_social_link'] . '</a></h5>
												</div>
											</li>
									    </ul>
								    </div>
								</div>
							</div>
						</div>
					</div>
				</div>
			';
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

include "footer.php";

?>