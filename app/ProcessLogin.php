<?php
session_start();

    include_once('Employee.php');


    if (isset($_POST['login'])) {

        $user = new Employee();

        $employee_email = $_POST['email'];
        $employee_password = $_POST['pwd'];

        $auth = $user->login_process($employee_email,$employee_password);

        if(!$auth){
            $_SESSION['message'] = 'Invalid username or password';
            //$_SESSION['message'] = 'Invalid username or password';
            header('location: ../login.php');

        }
        else{
            $_SESSION['user'] = $auth;
            //$_SESSION['user_id'] = $auth['user_id'];
            header('location: ../index.php');
        }
    } else{

        $_SESSION['message'] = 'You need to login first';
        header('location:index.php');
    }