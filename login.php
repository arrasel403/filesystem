<?php
include 'vendor/autoload.php';
$data = new Employee();

$data->userCheck();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login | Employee Database</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Employee Database</a>
        </div>
        <ul class="nav navbar-nav">
            <?php if (isset($_SESSION['user'])) { ?>
                <li><a href="index.php">Home</a></li>
                <li><a href="allemployee.php">Employee</a></li>
                <li><a href="filesystem.php">FileSystem</a></li>
            <?php } ?>
            <!--            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>-->
            <!--                <ul class="dropdown-menu">-->
            <!--                    <li><a href="#">Page 1-1</a></li>-->
            <!--                    <li><a href="#">Page 1-2</a></li>-->
            <!--                    <li><a href="#">Page 1-3</a></li>-->
            <!--                </ul>-->
            <!--            </li>-->
            <!--            <li><a href="#">Page 2</a></li>-->
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <!--            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>-->
            <li class="active"><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        </ul>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <?php
            session_start();
            if(isset($_SESSION['message'])){
                ?>
                <div class="alert alert-info text-center">
                    <?php echo $_SESSION['message']; ?>
                </div>
                <?php

                unset($_SESSION['message']);
            }
            ?>
            <h2 style="text-align: center; text-transform: uppercase; margin: 30px 0px 20px 0px">Login Form</h2><br>
            <div style="border: 1px solid #cdcdcd; padding: 50px">
                <form class="form-horizontal" action="app/ProcessLogin.php" method="post">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">Email:</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="pwd">Password:</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" name="login" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-sm-3"></div>
    </div>
</div>

</body>
</html>