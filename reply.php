<?php
//reply.php
include 'connect.php';
include 'header.php';

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    header("Location: signout.php");
}else{
    if(!$_SESSION['signed_in']){
        echo '<div class="col-lg-12">';
            echo '<div class="col-lg-12">';
                    echo '<ul class="list-group">';
                        echo '<li class="list-group-item clearfix" style="text-align:center;">';
                            echo '<div class="col-lg-12 bg-info"><h4>You must <a href="/forum/signin.php"><span class="glyphicon glyphicon-log-in"></span> Login</a> to perform further task.</h4></div>';
                        echo '</li>';
                    echo '</ul>';
            echo '</div>';
        echo '</div>';
    }else{

        if(!empty($_FILES['reply_image']['tmp_name'])){
            $reply_image_type = mysqli_real_escape_string($conn, $_FILES['reply_image']['type']);
            if(substr($reply_image_type,0,5) != "image"){
                echo '<div class="col-lg-12">';
                    echo '<div class="col-lg-12">';
                            echo '<ul class="list-group">';
                                echo '<li class="list-group-item clearfix" style="text-align:center;">';
                                    echo '<div class="col-lg-12 bg-danger"><h4>Only images are allowed for image content. Back to <a href="create_topic.php"><span class="glyphicon glyphicon-pencil"></span> Topic</a> panel.</h4></div>';
                                echo '</li>';
                            echo '</ul>';
                    echo '</div>';
                echo '</div>';
                exit();
            }
        }

        if(empty($_POST['reply_content']) && empty($_FILES['reply_image']['tmp_name'])){
            echo '<div class="col-lg-12">';
                echo '<div class="col-lg-12">';
                        echo '<ul class="list-group">';
                            echo '<li class="list-group-item clearfix" style="text-align:center;">';
                                echo '<div class="col-lg-12 bg-danger"><h4>Reply contents cannot be empty. Back to <a href="topic.php?id=' . htmlentities($_GET['id']) . '">topic.</h4></div>';
                            echo '</li>';
                        echo '</ul>';
                echo '</div>';
            echo '</div>';
            exit();
        }

        if(!empty($_FILES['reply_image']['tmp_name'])){
            $reply_image = addslashes(file_get_contents($_FILES['reply_image']['tmp_name']));
            $reply_image_type = mysqli_real_escape_string($conn, $_FILES['reply_image']['type']);

            $sql = "INSERT INTO 
                        posts(post_content,
                              post_date,
                              post_topic,
                              post_by, 
                              post_image, 
                              post_image_type) 
                    VALUES ('" . mysqli_real_escape_string($conn, $_POST['reply_content']) . "',
                            NOW(),
                            " . mysqli_real_escape_string($conn, $_GET['id']) . ",
                            " . $_SESSION['user_id'] . ", 
                            '" . $reply_image . "', 
                            '" . $reply_image_type .  "'
                            )";

        }else{
            $sql = "INSERT INTO
                        posts(post_content,
                              post_date,
                              post_topic,
                              post_by, 
                              post_image,
                              post_image_type)
                    VALUES
                        ('" . mysqli_real_escape_string($conn, $_POST['reply_content']) . "',
                              NOW(),
                              " . mysqli_real_escape_string($conn, $_GET['id']) . ",
                              " . $_SESSION['user_id'] . ",'',''
                        )";
        }
                         
        $result = mysqli_query($conn, $sql);
                         
        if(!$result){
            echo '<div class="col-lg-12">';
                echo '<div class="col-lg-12">';
                        echo '<ul class="list-group">';
                            echo '<li class="list-group-item clearfix" style="text-align:center;">';
                                echo '<div class="col-lg-12 bg-danger"><h4><span class="glyphicon glyphicon-exclamation-sign"></span> Your reply cannot be post, please contact admin to fix this.</h4></div>';
                            echo '</li>';
                        echo '</ul>';
                echo '</div>';
            echo '</div>';
        }else{
            header("Location: topic.php?id=" . htmlentities($_GET['id']));
        }
    }
}
 
include 'footer.php';
?>