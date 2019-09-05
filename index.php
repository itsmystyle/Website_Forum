<?php
//index.php
include 'header.php';
include 'connect.php';
 
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
                        echo '<div class="col-lg-12 bg-danger"><h4><span class="glyphicon glyphicon-exclamation-sign"></span> The categories could not be displayed, please contact admin to fix this.</h4></div>';
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
                            echo '<div class="col-lg-12 bg-warning"><h4>No categories yet. Use add category to request a category.</h4></div>';
                        echo '</li>';
                    echo '</ul>';
            echo '</div>';
        echo '</div>';
        
    }else{
        //prepare to display!
        echo '<div class="col-lg-12">';
            echo '<div class="col-lg-12">';
                echo '<ul class="list-group">';
                    echo '<li class="list-group-item clearfix" style="text-align:center;">';
                        echo '<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 bg-warning"><h5>Categories</h5></div>'; //9
                        echo '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 bg-primary"><h5>Lastest post<h5></div>'; //3
                    echo '</li>';
             
        while($row = mysqli_fetch_assoc($result)){
                    $sql = 'SELECT 
                                topic_id,
                                topic_by, 
                                topic_date, 
                                topic_subject 
                            FROM 
                                topics 
                            WHERE 
                                topic_cat=' . $row['cat_id'] . ' 
                            AND 
                                topic_date=(SELECT max(topic_date) FROM topics WHERE topic_cat=' . $row['cat_id'] . ')';

                    $result_latest_post = mysqli_query($conn, $sql);

                    if(!$result_latest_post){
                        echo '<div class="col-lg-12">';
                            echo '<div class="col-lg-12">';
                                    echo '<ul class="list-group">';
                                        echo '<li class="list-group-item clearfix" style="text-align:center;">';
                                            echo '<div class="col-lg-12 bg-danger"><h4><span class="glyphicon glyphicon-exclamation-sign"></span> Latest post could not be displayed, please contact admin to fix this.</h4></div>';
                                        echo '</li>';
                                    echo '</ul>';
                            echo '</div>';
                        echo '</div>';
                        exit;
                    }else{

                        echo '<li class="list-group-item clearfix">';
                            echo '<div class="col-lg-8 col-sm-8 col-md-8" style="text-align:left;">'; //9
                                echo '<div class="col-lg-12">';
                                    echo '<h3><a href="category.php?id=' . $row['cat_id'] . '">' . $row['cat_name'] . '</a></h3>';
                                echo '</div>';
                                echo '<div class="col-lg-12">';
                                    echo '<p>' . $row['cat_description'] . '</p>';
                                echo '</div>';
                            echo '</div>';

                        if(mysqli_num_rows($result_latest_post) == 0){
                            echo '<div class="col-lg-4" style="text-align:center;">'; //3
                                echo '<div class="col-lg-12" style="word-break:break-all; text-align:center;"><h5>No topic at this category yet.</h5></div>';
                            echo '</div>';
                        echo '</li>';

                        }else{
                            echo '<div class="col-lg-4 col-sm-4 col-md-4" style="text-align:center;">'; //3
                            while($row_latest_post = mysqli_fetch_assoc($result_latest_post)){
                                $getUserSql = 'SELECT 
                                                    user_name, 
                                                    user_image_type 
                                                FROM 
                                                    users 
                                                WHERE 
                                                    user_id=' . $row_latest_post['topic_by'];
                                $result_latest_post_user = mysqli_query($conn, $getUserSql);

                                if(!$result_latest_post_user){
                                    echo '<div class="col-lg-12" style="word-break:break-all; text-align:left;"><h5><a href="topic.php?id=' . $row_latest_post['topic_id'] . '">' . $row_latest_post['topic_subject'] . '</a></h5></div>';
                                    echo '<div class="col-lg-12 bg-danger" style="word-break:break-all; text-align:left;">Error unable to find user.</div>';
                                    echo '<div class="col-lg-12" style="word-break:break-all; text-align:left;">on ' . $row_latest_post['topic_date'] . '</div>';
                                }else{
                                    while($row_latest_post_user = mysqli_fetch_assoc($result_latest_post_user)){
                                    if($row_latest_post_user['user_image_type'] == ""){
                                        echo '<div class="col-lg-3 col-sm-3 col-md-3 col-xs-3" style="text-align:right;">
                                            <img src="/forum/profile.png" alt="Profile Picture" class="img-responsive img-thumbnail center-block" style="height:55px;"/>
                                         </div>';
                                    }else{
                                        echo '<div class="col-lg-3 col-sm-3 col-md-3 col-xs-3" style="text-align:right;">
                                            <img src="profile_picture.php?id=' . $row_latest_post['topic_by'] . '" alt="/forum/profile.png" class="img-responsive img-thumbnail center-block" style="height:55px;"/>
                                         </div>';
                                    }
                                    echo '<div class="col-lg-9 col-sm-9 col-md-9 col-xs-9">';
                                        echo '<div class="col-lg-12" style="word-break:break-all; text-align:left;"><h5><a href="topic.php?id=' . $row_latest_post['topic_id'] . '">' . $row_latest_post['topic_subject'] . '</a></h5></div>';
                                        echo '<div class="col-lg-12" style="word-break:break-all; text-align:left;">by <a href="profile.php?id=' . $row_latest_post['topic_by'] . '">' . $row_latest_post_user['user_name'] . '</a></div>';
                                        echo '<div class="col-lg-12" style="word-break:break-all; text-align:left;">on ' . $row_latest_post['topic_date'] . '</div>';
                                    echo '</div>';
                                    }
                                }
                            }
                            echo '</div>';
                        echo '</li>';
                        }
                    }                        
        }
        echo '</ul></div></div>';
    }
}
 
include 'footer.php';
?>