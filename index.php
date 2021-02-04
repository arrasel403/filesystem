<?php
session_start();

//return to login if not logged in
if (!isset($_SESSION['user'])){
    header('location:login.php');
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home | Employee Database</title>
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
                <li class="active"><a href="index.php">Home</a></li>
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
            <?php if (isset($_SESSION['user'])) { ?>
                <li><a href="logout.php"><span class="glyphicon glyphicon-user"></span> Logout</a></li>
            <?php } else { ?>
                <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            <?php } ?>
        </ul>
    </div>
</nav>


<div class="container">
        <h2 style="text-align: center; text-transform: uppercase; text-decoration: underline darkblue;">Assignment</h2>

</div>

</body>
</html>

<?php } ?>