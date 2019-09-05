<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>YuanCai's Forum</title>
    <link rel="stylesheet" href="style.css" type="text/css">

    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>

    <!-- Bootstrap! -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    session_start();
    error_reporting(0);
    
    ?>

    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">Preind</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="index.php">Home</a></li>
                <?php
                    echo '<li><a href="profile.php?id=' . $_SESSION['user_id'] . '">Profile</a></li>';
                ?>
                <li><a href="create_cat.php"><span class="glyphicon glyphicon-pencil"></span> Category</a></li>
                <li><a href="create_topic.php"><span class="glyphicon glyphicon-pencil"></span> Topic</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                    if($_SESSION['signed_in'] == true){
                        echo '<li><a href="setting.php?id=' . $_SESSION['user_id'] . '"><span class="glyphicon glyphicon-cog"></span> ' . $_SESSION['user_name'] . '</a></li>';
                        echo '<li><a href="signout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>';
                    }else{
                        echo '<li><a href="signin.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
                        echo '<li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>';
                    }
                ?>
            </ul>
        </div>
    </nav>

    <div class="container" id="mycontainer">
        <div class="row">
            <div class="col-lg-12">
                <div class="jumbotron" style="margin-top:1%;">
                    <h1>Priend</h1>
                    <p>Sign up now! Don't miss it =D</p>
                    <?php
                        if($_SESSION['signed_in'] == true){
                            echo '<a href="register.php" class="btn btn-default disabled" role="button">Sign Up</a>';
                        }else{
                            echo '<a href="register.php" class="btn btn-default" role="button">Sign Up</a>';
                        }
                    ?>
                </div>
            </div>
        </div>

        <div class="row">
 