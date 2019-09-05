<?php
//register.php
include 'connect.php';
include 'header.php';
 
 
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    echo 
    '<div class="col-lg-12">
        <ul class="list-group">
            <li class="list-group-item clearfix" style="text-align:center;">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bg-warning"><h3>Sign Up</h3></div>
            </li>
            <li class="list-group-item clearfix">
                <form class="form-horizontal" role="form" method="post" action="">
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="username">Username:</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="username" placeholder="Enter username (6 ~ 15 characters)" name="user_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="pwd">Password:</label>
                        <div class="col-lg-10">          
                            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="user_pass">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="re-pwd">Re-Password:</label>
                        <div class="col-lg-10">          
                            <input type="password" class="form-control" id="re-pwd" placeholder="Re-enter password" name="user_pass_check">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2" for="email">Email:</label>
                        <div class="col-lg-10">
                            <input type="email" class="form-control" id="email" placeholder="Enter email" name="user_email">
                        </div>
                    </div>
                    <div class="form-group">        
                        <div class="col-lg-offset-2 col-sm-offset-5 col-md-offset-5 col-xs-offset-5 col-lg-10 col-md-10 col-sm-10 col-xs-10" style="text-align:left;">
                            <button type="submit" class="btn btn-default">Submit</button>
                        </div>
                    </div>
                </form>
            </li>
        </ul>
    </div>';
}else{
    $errors = array();
     
    if(!empty($_POST['user_name'])){
        //the user name exists
        if(!ctype_alnum($_POST['user_name'])){
            $errors[] = 'The username can only contain letters and digits.';
        }
        
        if(strlen($_POST['user_name']) > 15){
            $errors[] = 'The username cannot be longer than 15 characters.';
        }

        if(strlen($_POST['user_name']) < 6){
            $errors[] = 'The username must be at least 6 characters.';
        }

    }else{
        $errors[] = 'The username field must not be empty.';
    }
     

    if(!empty($_POST['user_pass']) && !empty($_POST['user_pass_check'])){
    	//make sure password is right
        if($_POST['user_pass'] != $_POST['user_pass_check']){
            $errors[] = 'The two passwords did not match.';
        }
    }else{
        $errors[] = 'The password and reconfimation password fields must not be empty.';
    }
     
    if(!empty($errors)){
        //if have error!
        echo '
        <div class="col-lg-12">
            <ul class="list-group">
                <li class="list-group-item clearfix" style="text-align:center;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bg-warning"><h3>Sign Up</h3></div>
                </li>
                <li class="list-group-item clearfix" style="text-align:left;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bg-danger"><h4><span class="glyphicon glyphicon-exclamation-sign"></span> Some fields are filled incorrectly.</h4></div>
                </li>';

        foreach($errors as $key => $value){
            echo '
            <li class="list-group-item clearfix" style="text-align:left;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bg-danger"><p><span class="glyphicon glyphicon-remove"></span> ' . $value .'</p></div>
            </li>';
        }

        echo '
            </ul>
        </div>';

    }else{
        $sql = "INSERT INTO users(user_name, user_pass, user_email ,user_date, user_level, user_image, user_image_type, user_website, user_social_link, user_birthday, user_about_you, user_hometown, user_nickname)
                VALUES('" . mysqli_real_escape_string($conn, $_POST['user_name']) . "',
                       '" . sha1($_POST['user_pass']) . "',
                       '" . mysqli_real_escape_string($conn, $_POST['user_email']) . "',
                        NOW(),
                        0, '', '', '', '', '', '', '', '')";
                         
        $result = mysqli_query($conn, $sql);

        if(!$result){
            echo '<div class="col-lg-12">';
                echo '<div class="col-lg-12">';
                        echo '<ul class="list-group">';
                            echo '<li class="list-group-item clearfix" style="text-align:center;">';
                                echo '<div class="col-lg-12 bg-danger"><h4><span class="glyphicon glyphicon-exclamation-sign"></span> Something went wrong while registering. Please contact admin to fix this.</h4></div>';
                            echo '</li>';
                        echo '</ul>';
                echo '</div>';
            echo '</div>';
        }else{
            echo '<div class="col-lg-12">';
                echo '<div class="col-lg-12">';
                        echo '<ul class="list-group">';
                            echo '<li class="list-group-item clearfix" style="text-align:center;">';
                                echo '<div class="col-lg-12 bg-success"><h4>Congratulation! You can now <a href="signin.php"><span class="glyphicon glyphicon-log-in"></span> Sign In</a> and start posting! :-)</h4></div>';
                            echo '</li>';
                        echo '</ul>';
                echo '</div>';
            echo '</div>';
        }
        unset($_POST);
    }
}
 
include 'footer.php';
?>