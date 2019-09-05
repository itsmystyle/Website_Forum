<?php
//topic.php
include 'connect.php';
include 'header.php';

$sql = "SELECT
            topic_id,
            topic_subject, 
            topic_by, 
            topic_date 
        FROM
            topics
        WHERE
            topic_id=" . mysqli_real_escape_string($conn, $_GET['id']);
 
$result = mysqli_query($conn, $sql);
 
if(!$result){
    echo '<div class="col-lg-12">';
        echo '<div class="col-lg-12">';
                echo '<ul class="list-group">';
                    echo '<li class="list-group-item clearfix" style="text-align:center;">';
                        echo '<div class="col-lg-12 bg-danger"><h4><span class="glyphicon glyphicon-exclamation-sign"></span> The topics could not be retrived, please contact admin to fix this.</h4></div>';
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
                            echo '<div class="col-lg-12 bg-danger"><h4><span class="glyphicon glyphicon-ban-circle"></span> This topic does not exist.</h4></div>';
                        echo '</li>';
                    echo '</ul>';
            echo '</div>';
        echo '</div>';

    }else{
        $title = "";

        while($row = mysqli_fetch_assoc($result)){
            $title = $row['topic_subject'];
        }
    
        $sql = "SELECT 
                    posts.post_id, 
                    posts.post_topic,
                    posts.post_content,
                    posts.post_date,
                    posts.post_by,
                    posts.post_image_type,
                    users.user_id,
                    users.user_name, 
                    users.user_image_type 
                FROM
                    posts
                LEFT JOIN
                    users
                ON
                    posts.post_by=users.user_id 
                WHERE
                    posts.post_topic=" . mysqli_real_escape_string($conn, $_GET['id']) . " ORDER BY posts.post_date ASC";
         
        $result = mysqli_query($conn, $sql);
         
        if(!$result){
            echo '<div class="col-lg-12">';
                echo '<div class="col-lg-12">';
                        echo '<ul class="list-group">';
                            echo '<li class="list-group-item clearfix" style="text-align:center;">';
                                echo '<div class="col-lg-12 bg-danger"><h4><span class="glyphicon glyphicon-exclamation-sign"></span> The posts could not be retrived, please contact admin to fix this.</h4></div>';
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
                                    echo '<div class="col-lg-12 bg-danger"><h4><span class="glyphicon glyphicon-ban-circle"></span> There are no post in this topic yet.</h4></div>';
                                echo '</li>';
                            echo '</ul>';
                    echo '</div>';
                echo '</div>';

            }else{
                $first_flag = true;

                echo '<div class="col-lg-12">';
                     
                while($row = mysqli_fetch_assoc($result)){
                    if($first_flag){
                        echo '<div class="col-lg-12">
                                <ul class="list-group">
                                    <li class="list-group-item clearfix" style="text-align:left;">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 bg-primary"><h4>Posted by</h4></div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 bg-primary"><h4>' . $title . '</h4></div>
                                    </li>
                                    <li class="list-group-item clearfix">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="background-color:#f6f6f6;">
                                            <div class="col-lg-12">';
                                                if($row['user_image_type'] == ""){
                                                    echo '<img src="/forum/profile.png" alt="Profile Picture" class="img-responsive img-rounded center-block" style="height:100px;"/>';
                                                }else{
                                                    echo '<img src="profile_picture.php?id=' . $row['user_id'] . '" class="img-responsive img-circle center-block" style="height:100px;"/>';
                                                }
                                            echo '</div>
                                            <div class="col-lg-12" style="text-align:center;">';
                                                echo '<a href="profile.php?id=' . $row['user_id'] . '"><h4>' . $row['user_name'] . '</h4></a>';
                                        echo '</div>
                                            <div class="col-lg-12" style="text-align:center;"><h5>on ' . $row['post_date'] .
                                        '</h5></div>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12" style="text-align:left;">';
                                            if($row['post_image_type'] == ""){
                                                echo $row['post_content'];
                                            }else{
                                                echo '<div class="col-lg-12">';
                                                    echo '<img src="post_picture.php?id=' . $row['post_id'] . '" alt="Post Content Picture" class="img-responsive img-rounded"/>';
                                                echo '</div>';
                                                echo '<div class="col-lg-12">';
                                                    echo '<p>'.$row['post_content'].'</p>';
                                                echo '</div>';
                                            }
                                        echo '</div>
                                    </li>
                                </ul>
                            </div>';

                        $first_flag = false;
                    }else{
                        echo '<div class="col-lg-12">
                                <ul class="list-group">
                                    <li class="list-group-item clearfix" style="text-align:left;">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 bg-primary"><h4>Posted by</h4></div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 bg-primary"><h4>Re: ' . $title . '</h4></div>
                                    </li>
                                    <li class="list-group-item clearfix">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="background-color:#f6f6f6;">
                                            <div class="col-lg-12">';
                                                if($row['user_image_type'] == ""){
                                                    echo '<img src="/forum/profile.png" alt="Profile Picture" class="img-responsive img-rounded center-block" style="height:100px;"/>';
                                                }else{
                                                    echo '<img src="profile_picture.php?id=' . $row['user_id'] . '" class="img-responsive img-circle center-block" style="height:100px;"/>';
                                                }
                                            echo '</div>
                                            <div class="col-lg-12" style="text-align:center;">';
                                                echo '<a href="profile.php?id=' . $row['user_id'] . '"><h4>' . $row['user_name'] . '</h4></a>';
                                        echo '</div>
                                            <div class="col-lg-12" style="text-align:center;"><h5>on ' . $row['post_date'] .
                                        '</h5></div>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12" style="text-align:left;">';
                                            if($row['post_image_type'] == ""){
                                                echo $row['post_content'];
                                            }else{
                                                echo '<div class="col-lg-12">';
                                                    echo '<img src="post_picture.php?id=' . $row['post_id'] . '" alt="Post Content Picture" class="img-responsive img-rounded"/>';
                                                echo '</div>';
                                                echo '<div class="col-lg-12">';
                                                    echo '<p>'.$row['post_content'].'</p>';
                                                echo '</div>';
                                            }
                                        echo '</div>
                                    </li>
                                </ul>
                            </div>';
                    }
                    $_SESSION['post_topic'] = $row['post_topic'];
                }

                echo '
                <div class="col-lg-12">
                    <ul class="list-group">
                        <li class="list-group-item clearfix" style="text-align:center;">
                            <div class="col-lg-12 col-xs-12 bg-info"><h3>Reply topic</h3></div>
                        </li>
                        <li class="list-group-item clearfix">
                            <form class="form-horizontal" role="form" method="post" action="reply.php?id=' . $_SESSION['post_topic'] . '" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label class="control-label col-lg-2 col-md-2 col-sm-2 col-xs-12" for="reply-content">Comment:</label>
                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                        <textarea class="form-control" rows="5" id="reply-content" placeholder="Enter comment" name="reply_content" style="resize:vertical;"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-2 col-md-2 col-sm-2 col-xs-12" for="image-content">Image:</label>
                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                        <input type="file" class="form-control" id="image-content" name="reply_image">
                                    </div>
                                </div>
                                <div class="form-group">        
                                    <div class="col-lg-offset-2 col-sm-offset-5 col-md-offset-5 col-xs-offset-5 col-lg-10 col-md-12 col-sm-12 col-xs-12" style="text-align:left;">
                                        <button type="submit" class="btn btn-default">Comment</button>
                                    </div>
                                </div>
                            </form>
                        </li>
                    </ul>
                </div>';
            }
        }
    }
}
 
include 'footer.php';
?>