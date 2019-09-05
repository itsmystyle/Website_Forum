<?php
//signin.php
include 'connect.php';
include 'header.php';

//first, check if the user is already signed in. If that is the case, there is no need to display this page
if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true){
    echo '<div class="col-lg-12">';
        echo '<div class="col-lg-12">';
                echo '<ul class="list-group">';
                    echo '<li class="list-group-item clearfix" style="text-align:center;">';
                        echo '<div class="col-lg-12 bg-info"><h4>You are already signed in, you can <a href="signout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a> if you want.</h4></div>';
                    echo '</li>';
                echo '</ul>';
        echo '</div>';
    echo '</div>';
}else{
    if($_SERVER['REQUEST_METHOD'] != 'POST'){

        echo 
        '<div class="col-lg-12">
            <ul class="list-group">
                <li class="list-group-item clearfix" style="text-align:center;">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bg-warning"><h3>Login</h3></div>
                </li>
                <li class="list-group-item clearfix">
                    <form class="form-horizontal" role="form" method="post" action="">
                        <div class="form-group">
                            <label class="control-label col-lg-2" for="username">Username:</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="username" placeholder="Enter username" name="user_name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2" for="pwd">Password:</label>
                            <div class="col-lg-10">          
                                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="user_pass">
                            </div>
                        </div>
                        <div class="form-group">        
                            <div class="col-lg-offset-2 col-sm-offset-5 col-md-offset-5 col-xs-offset-5 col-lg-10 col-md-10 col-sm-10 col-xs-10" style="text-align:left;">
                                <button type="submit" class="btn btn-default">Sign in</button>
                            </div>
                        </div>
                    </form>
                </li>
            </ul>
        </div>';

    }else{

        $errors = array(); /* declare the array for later use */
         
        if(empty($_POST['user_name'])){
            $errors[] = 'The username field must not be empty.';
        }
         
        if(empty($_POST['user_pass'])){
            $errors[] = 'The password field must not be empty.';
        }
         
        if(!empty($errors)){
            echo '
            <div class="col-lg-12">
                <ul class="list-group">
                    <li class="list-group-item clearfix" style="text-align:center;">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bg-warning"><h3>Login</h3></div>
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
            $sql = "SELECT 
                        user_id,
                        user_name,
                        user_level
                    FROM
                        users
                    WHERE
                        user_name = '" . mysqli_real_escape_string($conn, $_POST['user_name']) . "'
                    AND
                        user_pass = '" . sha1($_POST['user_pass']) . "'";
                         
            $result = mysqli_query($conn, $sql);

            if(!$result){
                echo '<div class="col-lg-12">';
                    echo '<div class="col-lg-12">';
                            echo '<ul class="list-group">';
                                echo '<li class="list-group-item clearfix" style="text-align:center;">';
                                    echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bg-danger"><h4><span class="glyphicon glyphicon-exclamation-sign"></span> Something went wrong while signing in. Please contact admin to fix this.</h4></div>';
                                echo '</li>';
                            echo '</ul>';
                    echo '</div>';
                echo '</div>';
                //echo mysql_error();
            }else{
                //the query was successfully executed
                //1. the query returned data, the user can be signed in
                //2. the query returned an empty result set, the credentials were wrong

                if(mysqli_num_rows($result) == 0){
                    echo '<div class="col-lg-12">';
                        echo '<div class="col-lg-12">';
                                echo '<ul class="list-group">';
                                    echo '<li class="list-group-item clearfix" style="text-align:center;">';
                                        echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bg-danger"><h4><span class="glyphicon glyphicon-exclamation-sign"></span> Either Username or Password is wrong. Please try again.</h4></div>';
                                    echo '</li>';
                                echo '</ul>';
                        echo '</div>';
                    echo '</div>';

                }else{
                    //set the $_SESSION['signed_in'] variable to TRUE
                    $_SESSION['signed_in'] = true;
                     
                    //we also put the user_id and user_name values in the $_SESSION, so we can use it at various pages
                    while($row = mysqli_fetch_assoc($result)){
                        $_SESSION['user_id']    = $row['user_id'];
                        $_SESSION['user_name']  = $row['user_name'];
                        $_SESSION['user_level'] = $row['user_level'];
                    }
                     
                    header("Location:index.php");
                }
            }
        }
    }
}
 
include 'footer.php';
?>