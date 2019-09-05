<?php
//category.php
include 'header.php';
include 'connect.php';
 
$sql = 'SELECT
            cat_id,
            cat_name,
            cat_description
        FROM
            categories
        WHERE
            cat_id=' . mysqli_real_escape_string($conn, $_GET['id']);
 
$result = mysqli_query($conn, $sql);
 
if(!$result){
    echo '<div class="col-lg-12">';
        echo '<div class="col-lg-12">';
                echo '<ul class="list-group">';
                    echo '<li class="list-group-item clearfix" style="text-align:center;">';
                        echo '<div class="col-lg-12 bg-danger"><h4><span class="glyphicon glyphicon-exclamation-sign"></span> The categories could not be retrived, please contact admin to fix this.</h4></div>';
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
                            echo '<div class="col-lg-12 bg-danger"><h4><span class="glyphicon glyphicon-ban-circle"></span> This category does not exist.</h4></div>';
                        echo '</li>';
                    echo '</ul>';
            echo '</div>';
        echo '</div>';
        
    }else{
        //prepare to display!

        echo '<div class="col-lg-12">';
            echo '<div class="col-lg-12">';
                echo '<ul class="list-group">';
        while($row = mysqli_fetch_assoc($result)){
                    echo '<li class="list-group-item clearfix" style="text-align:center;">';
                        echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bg-info"><h2>Topics in -' . $row['cat_name'] . '- category.</h2></div>';
                    echo '</li>';
        }

        $sql = 'SELECT  
                    topic_id,
                    topic_subject,
                    topic_date,
                    topic_by
                FROM
                    topics
                WHERE
                    topic_cat=' . mysqli_real_escape_string($conn, $_GET['id']) . ' ORDER BY topic_date DESC';
         
        $result = mysqli_query($conn, $sql);

        if(!$result){
            echo '
            </ul></div></div>';
            echo '<div class="col-lg-12">';
                echo '<div class="col-lg-12">';
                        echo '<ul class="list-group">';
                            echo '<li class="list-group-item clearfix" style="text-align:center;">';
                                echo '<div class="col-lg-12 bg-danger"><h4><span class="glyphicon glyphicon-ban-circle"></span> The topics in this category cannot be display. Please contact admin to fix this.</h4></div>';
                            echo '</li>';
                        echo '</ul>';
                echo '</div>';
            echo '</div>';

        }else{

            if(mysqli_num_rows($result) == 0){
                echo '<li class="list-group-item clearfix" style="text-align:center;">';
                    echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bg-info"><h5>There are no topics is this category yet.</h5></div>';
                echo '</li>';
                echo '
                </ul></div></div>';

            }else{
                echo '<li class="list-group-item clearfix" style="text-align:center;">';
                    echo '<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 bg-warning"><h5>Topics</h5></div>';
                    echo '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 bg-primary"><h5>Posted by<h5></div>';
                echo '</li>';

                while($row = mysqli_fetch_assoc($result)){
                    echo '<li class="list-group-item clearfix">';
                            echo '<div class="col-lg-8 col-sm-8 col-md-8" style="text-align:left;">';
                                echo '<div class="col-lg-12">';
                                    echo '<h3><a href="topic.php?id=' . $row['topic_id'] . '">' . $row['topic_subject'] . '</a></h3>';
                                echo '</div>';
                            echo '</div>';
                            echo '<div class="col-lg-4 col-sm-4 col-md-4" style="text-align:center;">';

                        $userSql = 'SELECT 
                                        user_name, 
                                        user_image_type 
                                    FROM 
                                        users 
                                    WHERE 
                                        user_id=' . $row['topic_by'];

                        $userResult = mysqli_query($conn, $userSql);

                        if(!$userResult){
                                echo '<div class="col-lg-12 bg-danger" style="word-break:break-all; text-align:left;">Error unable to find user.</div>';
                                echo '<div class="col-lg-12" style="word-break:break-all; text-align:left;">on ' . $row['topic_date'] . '</div>';
                            echo '</div>';
                        }else{
                            while($row_user = mysqli_fetch_assoc($userResult)){
                                if($row_user['user_image_type'] == ""){
                                    echo '<div class="col-lg-3 col-sm-3 col-md-3 col-xs-3" style="text-align:right;">
                                        <img src="/forum/profile.png" alt="Profile Picture" class="img-responsive img-thumbnail center-block" style="height:55px;"/>
                                     </div>';
                                }else{
                                    echo '<div class="col-lg-3 col-sm-3 col-md-3 col-xs-3" style="text-align:right;">
                                        <img src="profile_picture.php?id=' . $row['topic_by'] . '" alt="/forum/profile.png" class="img-responsive img-thumbnail center-block" style="height:55px;"/>
                                     </div>';
                                }
                                echo '<div class="col-lg-9 col-sm-9 col-md-9 col-xs-9">';
                                    echo '<div class="col-lg-12" style="word-break:break-all; text-align:left;">by <a href="profile.php?id=' . $row['topic_by'] . '">' . $row_user['user_name'] . '</a></div>';
                                    echo '<div class="col-lg-12" style="word-break:break-all; text-align:left;">on ' . $row['topic_date'] . '</div>';
                                echo '</div>';
                            }
                            echo '</div>';
                        echo '</li>';
                        }
                    }
                    echo '</ul></div></div>';
                }
            }

 }
}

include 'footer.php';

?>