<?php
//create_cat.php
include 'header.php';
include 'connect.php';

//add_category 0 displaying all request
//add_category 1 adding request category (Accept)
//add_category 2 deny request

if($_SESSION['signed_in'] == true){
    if($_SERVER['REQUEST_METHOD'] != 'POST' && $_GET['request_categories_action'] == 0){
        //only admin can add category!
        if($_SESSION['user_level'] > 0){
            echo '
            <div class="col-lg-12">
                <ul class="list-group">
                    <li class="list-group-item clearfix" style="text-align:center;">
                        <div class="col-lg-12 col-xs-12 bg-warning"><h3>Add Category</h3></div>
                    </li>
                    <li class="list-group-item clearfix">
                        <form class="form-horizontal" role="form" method="post" action="">
                            <div class="form-group">
                                <label class="control-label col-lg-2 col-md-2 col-sm-2 col-xs-12" for="catname">Category Name:</label>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <input type="text" class="form-control" id="catname" placeholder="Enter category name" name="cat_name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-2 col-md-2 col-sm-2 col-xs-12" for="catdescription">Category Description:</label>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <textarea class="form-control" rows="5" id="catdescription" placeholder="Enter description" name="cat_description" style="resize:vertical;"></textarea>
                                </div>
                            </div>
                            <div class="form-group">        
                                <div class="col-lg-offset-2 col-sm-offset-5 col-md-offset-5 col-xs-offset-5 col-lg-10 col-md-12 col-sm-12 col-xs-12" style="text-align:left;">
                                    <button type="submit" class="btn btn-default">Add</button>
                                </div>
                            </div>
                        </form>
                    </li>
                </ul>
            </div>';

            //list out the category request
            $sql = 'SELECT
                        request_categories_id,
                        request_categories_name,
                        request_categories_description
                    FROM
                        request_categories';

            $result = mysqli_query($conn ,$sql);

            if(!$result){
                echo '<div class="col-lg-12">';
                    echo '<div class="col-lg-12">';
                            echo '<ul class="list-group">';
                                echo '<li class="list-group-item clearfix" style="text-align:center;">';
                                    echo '<div class="col-lg-12 bg-danger"><h4><span class="glyphicon glyphicon-exclamation-sign"></span> ERROR to display category requests.</h4></div>';
                                echo '</li>';
                            echo '</ul>';
                    echo '</div>';
                echo '</div>';

            }else{
                echo '<div class="col-lg-12">';
                    echo '<div class="col-lg-12">';
                        echo '<ul class="list-group">';
                            //request title
                            echo '<li class="list-group-item clearfix" style="text-align:center;">';
                                echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bg-warning"><h4>Request Category list</h4></div>';
                            echo '</li>';
                            //request table
                            echo '<li class="list-group-item clearfix" style="text-align:center;">';
                                echo '<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 bg-primary"><h6>Categories</h6></div>';
                                echo '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 bg-primary"><h6>Description</h6></div>';
                                echo '<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 bg-primary"><h6>Action<h6></div>';
                            echo '</li>';

                while($row = mysqli_fetch_assoc($result)){
                            echo '<li class="list-group-item clearfix">';
                                echo '<div class="col-lg-3 col-md-3 col-sm-3 col-xs-11" style="text-align:left; word-break:break-all;">' . $row['request_categories_name'] . '
                                </div>';
                                echo '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-11" style="text-align:left; word-break:break-all;">' . $row['request_categories_description'] . '
                                </div>';
                                echo '<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" style="text-align:left;">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><a href="/forum/create_cat.php?request_id=' . $row['request_categories_id'] . '&request_categories_action=1" class="btn btn-default btn-xs" role="button"><span class="glyphicon glyphicon-ok-sign"></span> Approve</a></div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><a href="/forum/create_cat.php?request_id=' . $row['request_categories_id'] . '&request_categories_action=2" class="btn btn-default btn-xs" role="button"><span class="glyphicon glyphicon-remove-sign"></span> Deny</a></div>
                                </div>';
                            echo '</li>';
                }
                echo '</ul></div></div>';
            }



        }else{
            //normal member requesting category, need to approve by admin
            echo '
            <div class="col-lg-12">
                <ul class="list-group">
                    <li class="list-group-item clearfix" style="text-align:center;">
                        <div class="col-lg-12 col-xs-12 bg-warning"><h3>Request to add Category</h3></div>
                    </li>
                    <li class="list-group-item clearfix">
                        <form class="form-horizontal" role="form" method="post" action="">
                            <div class="form-group">
                                <label class="control-label col-lg-2 col-md-2 col-sm-2 col-xs-12" for="catname">Category Name:</label>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <input type="text" class="form-control" id="catname" placeholder="Enter category name" name="request_categories_name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-lg-2 col-md-2 col-sm-2 col-xs-12" for="catdescription">Category Description:</label>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                    <textarea class="form-control" rows="5" id="catdescription" placeholder="Enter description" name="request_categories_description"></textarea>
                                </div>
                            </div>
                            <div class="form-group">        
                                <div class="col-lg-offset-2 col-sm-offset-5 col-md-offset-5 col-xs-offset-4 col-lg-10 col-md-12 col-sm-12 col-xs-12" style="text-align:left;">
                                    <button type="submit" class="btn btn-default">Send Request</button>
                                </div>
                            </div>
                        </form>
                    </li>
                </ul>
            </div>';
         }

    }else{
        if($_SESSION['user_level'] > 0){
            if($_GET['request_categories_action'] == 1 || $_GET['request_categories_action'] == 2){
                if($_GET['request_categories_action'] == 1){
                    //add request_category data into category and remove request_category data
                    $getSql = 'SELECT
                                request_categories_name,
                                request_categories_description
                            FROM
                                request_categories
                            WHERE
                                request_categories_id="' . $_GET['request_id'] . '"';

                    $result = mysqli_query($conn ,$getSql);

                    if(!$result){
                        echo '<div class="col-lg-12">';
                            echo '<div class="col-lg-12">';
                                    echo '<ul class="list-group">';
                                        echo '<li class="list-group-item clearfix" style="text-align:center;">';
                                            echo '<div class="col-lg-12 bg-danger"><h4><span class="glyphicon glyphicon-exclamation-sign"></span> ERROR retriving data from request_categories. (Approve phase)</h4></div>';
                                        echo '</li>';
                                    echo '</ul>';
                            echo '</div>';
                        echo '</div>';

                    }else{
                        $request_name;
                        $request_description;

                        while($row = mysqli_fetch_assoc($result)){
                            $request_name = $row['request_categories_name'];
                            $request_description = $row['request_categories_description'];
                        }

                        $sql = "INSERT INTO categories(cat_name, cat_description)
                           VALUES('" . mysqli_real_escape_string($conn ,$request_name) . "',
                                 '" . mysqli_real_escape_string($conn ,$request_description) . "')";

                        $result = mysqli_query($conn ,$sql);

                        if(!$result){
                            echo '<div class="col-lg-12">';
                                echo '<div class="col-lg-12">';
                                        echo '<ul class="list-group">';
                                            echo '<li class="list-group-item clearfix" style="text-align:center;">';
                                                echo '<div class="col-lg-12 bg-danger"><h4><span class="glyphicon glyphicon-exclamation-sign"></span> ERROR inserting data from request_category to category.</h4></div>';
                                            echo '</li>';
                                        echo '</ul>';
                                echo '</div>';
                            echo '</div>';
                        }else{
                            $removeSql = 'DELETE FROM request_categories
                                        WHERE request_categories_name="' . $request_name .'" AND 
                                                request_categories_description="' . $request_description . '"';

                            $result = mysqli_query($conn ,$removeSql);

                            if(!$result){
                                echo '<div class="col-lg-12">';
                                    echo '<div class="col-lg-12">';
                                            echo '<ul class="list-group">';
                                                echo '<li class="list-group-item clearfix" style="text-align:center;">';
                                                    echo '<div class="col-lg-12 bg-danger"><h4><span class="glyphicon glyphicon-exclamation-sign"></span> ERROR deleting data from request_category. (Approve phase)</h4></div>';
                                                echo '</li>';
                                            echo '</ul>';
                                    echo '</div>';
                                echo '</div>';
                            }else{
                                echo '<div class="col-lg-12">';
                                    echo '<div class="col-lg-12">';
                                            echo '<ul class="list-group">';
                                                echo '<li class="list-group-item clearfix" style="text-align:center;">';
                                                    $_GET['add_category_action'] = 0;
                                                    $_GET['request_id'] = 0;
                                                    echo '<div class="col-lg-12 bg-success"><h4>Successfully add to category.
                                                    Back to <a href="/forum/create_cat.php"><span class="glyphicon glyphicon-pencil"></span> Category</a> control panel.
                                                    </h4></div>';
                                                echo '</li>';
                                            echo '</ul>';
                                    echo '</div>';
                                echo '</div>';
                            }
                        }
                    }

                }else if ($_GET['request_categories_action'] == 2) {
                    //remove request_category data
                    $getSql = 'SELECT
                                request_categories_name,
                                request_categories_description
                            FROM
                                request_categories
                            WHERE
                                request_categories_id="' . $_GET['request_id'] . '"';

                    $result = mysqli_query($conn ,$getSql);

                    if(!$result){
                        echo '<div class="col-lg-12">';
                            echo '<div class="col-lg-12">';
                                    echo '<ul class="list-group">';
                                        echo '<li class="list-group-item clearfix" style="text-align:center;">';
                                            echo '<div class="col-lg-12 bg-danger"><h4><span class="glyphicon glyphicon-exclamation-sign"></span> ERROR retriving data from request_categories. (Deny phase)</h4></div>';
                                        echo '</li>';
                                    echo '</ul>';
                            echo '</div>';
                        echo '</div>';
                    }else{
                        $request_name;
                        $request_category;

                        while($row = mysqli_fetch_assoc($result)){
                            $request_name = $row['request_categories_name'];
                            $request_description = $row['request_categories_description'];
                        }

                        $removeSql = 'DELETE FROM request_categories
                                    WHERE request_categories_name="' . $request_name .'" AND 
                                            request_categories_description="' . $request_description . '"';

                        $result = mysqli_query($conn ,$removeSql);

                        if(!$result){
                            echo '<div class="col-lg-12">';
                                echo '<div class="col-lg-12">';
                                        echo '<ul class="list-group">';
                                            echo '<li class="list-group-item clearfix" style="text-align:center;">';
                                                echo '<div class="col-lg-12 bg-result"><h4><span class="glyphicon glyphicon-exclamation-sign"></span> ERROR deleting data from request_category. (Deny phase)</h4></div>';
                                            echo '</li>';
                                        echo '</ul>';
                                echo '</div>';
                            echo '</div>';
                        }else{
                            echo '<div class="col-lg-12">';
                                echo '<div class="col-lg-12">';
                                        echo '<ul class="list-group">';
                                            echo '<li class="list-group-item clearfix" style="text-align:center;">';
                                                $_GET['add_category_action'] = 0;
                                                $_GET['request_id'] = 0;
                                                echo '<div class="col-lg-12 bg-success"><h4>Successfully delete request.
                                                Back to <a href="/forum/create_cat.php"><span class="glyphicon glyphicon-pencil"></span> Category</a> control panel.
                                                </h4></div>';
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
                                        echo '<div class="col-lg-12 bg-danger"><h4><span class="glyphicon glyphicon-exclamation-sign"></span> ERROR while approving and denying request. (error code - not_1_nor_2)</h4></div>';
                                    echo '</li>';
                                echo '</ul>';
                        echo '</div>';
                    echo '</div>';
                }
            }else{
                $sql = "INSERT INTO categories(cat_name, cat_description)
                   VALUES('" . mysqli_real_escape_string($conn ,$_POST['cat_name']) . "',
                         '" . mysqli_real_escape_string($conn ,$_POST['cat_description']) . "')";

                $result = mysqli_query($conn ,$sql);

                if(!$result){
                    echo '<div class="col-lg-12">';
                        echo '<div class="col-lg-12">';
                                echo '<ul class="list-group">';
                                    echo '<li class="list-group-item clearfix" style="text-align:center;">';
                                        echo '<div class="col-lg-12 bg-danger"><h4><span class="glyphicon glyphicon-exclamation-sign"></span> ERROR while adding category.</h4></div>';
                                    echo '</li>';
                                echo '</ul>';
                        echo '</div>';
                    echo '</div>';
                }else{
                    echo '<div class="col-lg-12">';
                        echo '<div class="col-lg-12">';
                                echo '<ul class="list-group">';
                                    echo '<li class="list-group-item clearfix" style="text-align:center;">';
                                        echo '<div class="col-lg-12 bg-success"><h4><span class="glyphicon glyphicon-ok-sign"></span> New category has been added.</h4></div>';
                                    echo '</li>';
                                echo '</ul>';
                        echo '</div>';
                    echo '</div>';
                }
            }

        }else{
            $sql = "INSERT INTO request_categories(request_categories_name, request_categories_description)
               VALUES('" . mysqli_real_escape_string($conn ,$_POST['request_categories_name']) . "',
                     '" . mysqli_real_escape_string($conn ,$_POST['request_categories_description']) . "')";

            $result = mysqli_query($conn ,$sql);

            if(!$result){
                echo '<div class="col-lg-12">';
                    echo '<div class="col-lg-12">';
                        echo '<ul class="list-group">';
                            echo '<li class="list-group-item clearfix" style="text-align:center;">';
                                echo '<div class="col-lg-12 bg-danger"><h4><span class="glyphicon glyphicon-exclamation-sign"></span> Something when wrong while sending request. Please contact admin to fix this.</h4></div>';
                            echo '</li>';
                        echo '</ul>';
                    echo '</div>';
                echo '</div>';
            }else{
                echo '<div class="col-lg-12">';
                    echo '<div class="col-lg-12">';
                        echo '<ul class="list-group">';
                            echo '<li class="list-group-item clearfix" style="text-align:center;">';
                                echo '<div class="col-lg-12 bg-success"><h4><span class="glyphicon glyphicon-ok-sign"></span> Request has been sent. Please wait for reply.</h4></div>';
                            echo '</li>';
                        echo '</ul>';
                    echo '</div>';
                echo '</div>';  
            }
        }
    }
}else{
    echo '<div class="col-lg-12">';
        echo '<div class="col-lg-12">';
                echo '<ul class="list-group">';
                    echo '<li class="list-group-item clearfix" style="text-align:center;">';
                        echo '<div class="col-lg-12 bg-info"><h4>You must <a href="/forum/signin.php"><span class="glyphicon glyphicon-log-in"></span> Login</a> to perform further task.</h4></div>';
                    echo '</li>';
                echo '</ul>';
        echo '</div>';
    echo '</div>';
}

include 'footer.php';

?>
