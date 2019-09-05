<?php
//create_topic.php
include 'header.php';
include 'connect.php';


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
    if($_SERVER['REQUEST_METHOD'] != 'POST'){

        $sql = "SELECT
                    cat_id,
                    cat_name,
                    cat_description
                FROM
                    categories";
         
        $result = mysqli_query($conn, $sql);
         
        if(!$result){
            echo '<div class="col-lg-12">';
                echo '<div class="col-lg-12">';
                    echo '<ul class="list-group">';
                        echo '<li class="list-group-item clearfix" style="text-align:center;">';
                            echo '<div class="col-lg-12 bg-danger"><h4><span class="glyphicon glyphicon-exclamation-sign"></span> ERROR while selecting from database. Please contact admin to fix this.</h4></div>';
                        echo '</li>';
                    echo '</ul>';
                echo '</div>';
            echo '</div>';

        }else{
            
            if(mysqli_num_rows($result) == 0){
                //no category yet!
                if($_SESSION['user_level'] == 1){
                    echo '<div class="col-lg-12">';
                        echo '<div class="col-lg-12">';
                            echo '<ul class="list-group">';
                                echo '<li class="list-group-item clearfix" style="text-align:center;">';
                                    echo '<div class="col-lg-12 bg-warning"><h4><span class="glyphicon glyphicon-exclamation-sign"></span> You have not created categories yet.</h4></div>';
                                echo '</li>';
                            echo '</ul>';
                        echo '</div>';
                    echo '</div>';

                }else{
                    echo '<div class="col-lg-12">';
                        echo '<div class="col-lg-12">';
                            echo '<ul class="list-group">';
                                echo '<li class="list-group-item clearfix" style="text-align:center;">';
                                    echo '<div class="col-lg-12 bg-warning" style="word-break:break-all;"><h4><span class="glyphicon glyphicon-exclamation-sign"></span> Before you can post a topic, you must wait for admin to create some categories. Or you can request to make a category.</h4></div>';
                                echo '</li>';
                            echo '</ul>';
                        echo '</div>';
                    echo '</div>';
                }

            }else{

              echo 
                '<div class="col-lg-12">
                    <ul class="list-group">
                        <li class="list-group-item clearfix" style="text-align:center;">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bg-warning"><h3>Post a Topic</h3></div>
                        </li>
                        <li class="list-group-item clearfix">
                            <form class="form-horizontal" role="form" method="post" action="" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="control-label col-lg-2 col-md-2 col-sm-2 col-xs-12" for="subject">Subject:</label>
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                        <input type="text" class="form-control" id="subject" placeholder="Enter subject" name="topic_subject">
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                        <select class="form-control" name="topic_cat">';
                                        while($row = mysqli_fetch_assoc($result)){
                                            echo '<option value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
                                        }
                                  echo '</select>
                                    </div>';
                          echo '</div>
                                <div class="form-group">
                                    <label class="control-label col-lg-2 col-md-2 col-sm-2 col-xs-12" for="content">Content:</label>
                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                        <textarea class="form-control" rows="5" id="content" placeholder="Enter content" name="post_content" style="resize:vertical;"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-2 col-md-2 col-sm-2 col-xs-12" for="image-content">Image Content:</label>
                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                        <input type="file" class="form-control" id="image-content" name="post_image">
                                    </div>
                                </div>
                                <div class="form-group">        
                                    <div class="col-lg-offset-2 col-sm-offset-5 col-md-offset-5 col-xs-offset-4 col-lg-10 col-md-12 col-sm-12 col-xs-12" style="text-align:left;">
                                        <button type="submit" class="btn btn-default">Create topic</button>
                                    </div>
                                </div>
                            </form>
                        </li>
                    </ul>
                </div>';
            }
        }
    }else{

        if(!empty($_FILES['post_image']['tmp_name'])){
            $post_image_type = mysqli_real_escape_string($conn, $_FILES['post_image']['type']);
            if(substr($post_image_type,0,5) != "image"){
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

        if(empty($_POST['topic_subject']) || (empty($_POST['post_content']) && empty($_FILES['post_image']['tmp_name'])) ){
            echo '<div class="col-lg-12">';
                echo '<div class="col-lg-12">';
                        echo '<ul class="list-group">';
                            echo '<li class="list-group-item clearfix" style="text-align:center;">';
                                echo '<div class="col-lg-12 bg-danger"><h4>Topic subject or contents cannot be empty. Back to <a href="create_topic.php"><span class="glyphicon glyphicon-pencil"></span> Topic</a> panel.</h4></div>';
                            echo '</li>';
                        echo '</ul>';
                echo '</div>';
            echo '</div>';
            exit();
        }

        $sql = "INSERT INTO 
                    topics(topic_subject,
                           topic_date,
                           topic_cat,
                           topic_by)
               VALUES('" . mysqli_real_escape_string($conn, $_POST['topic_subject']) . "',
                           NOW(),
                           " . $_POST['topic_cat'] . ",
                           " . $_SESSION['user_id'] . "
                           )";
                  
        $result = mysqli_query($conn, $sql);

        $topicid = mysqli_insert_id($conn);

        if(!empty($_FILES['post_image']['tmp_name'])){
            $post_image = addslashes(file_get_contents($_FILES['post_image']['tmp_name']));
            $post_image_type = mysqli_real_escape_string($conn, $_FILES['post_image']['type']);

            $sql = "INSERT INTO
                        posts(post_content,
                              post_date,
                              post_topic,
                              post_by, 
                              post_image,
                              post_image_type)
                    VALUES
                        ('" . mysqli_real_escape_string($conn, $_POST['post_content']) . "',
                              NOW(),
                              " . $topicid . ",
                              " . $_SESSION['user_id'] . ",
                              '" . $post_image . "',
                              '" . $post_image_type . "'
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
                        ('" . mysqli_real_escape_string($conn, $_POST['post_content']) . "',
                              NOW(),
                              " . $topicid . ",
                              " . $_SESSION['user_id'] . ",'',''
                        )";
        }
        
        $result = mysqli_query($conn, $sql);
             
        if(!$result){
            echo '<div class="col-lg-12">';
                echo '<div class="col-lg-12">';
                    echo '<ul class="list-group">';
                        echo '<li class="list-group-item clearfix" style="text-align:center;">';
                            echo '<div class="col-lg-12 bg-danger"><h4><span class="glyphicon glyphicon-exclamation-sign"></span> ERROR occured while posting. Please contact admin to fix this.</h4></div>';
                        echo '</li>';
                    echo '</ul>';
                echo '</div>';
            echo '</div>';
            
        }else{
            echo '<div class="col-lg-12">';
                echo '<div class="col-lg-12">';
                    echo '<ul class="list-group">';
                        echo '<li class="list-group-item clearfix" style="text-align:center;">';
                            echo '<div class="col-lg-12 bg-success"><h4>You have successfully posted <a href="topic.php?id='. $topicid . '"><span class="glyphicon glyphicon-comment"></span> a new topic</a>.</h4></div>';
                        echo '</li>';
                    echo '</ul>';
                echo '</div>';
            echo '</div>';
        }
    }
}
 
include 'footer.php';
?>