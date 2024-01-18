<?php
session_start();

$showError = "false";
$showAlert = "false";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '_dbConnection.php';

    $userName = $_POST['loginUname'];
    $password = $_POST['loginPassword'];

    $sql = "SELECT * FROM `users` WHERE `user_name`='$userName'";
    $result = mysqli_query($con, $sql);
    $num = mysqli_num_rows($result);

    if ($num == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['user_password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['uname'] = $userName;
            $showAlert = "<strong>Holy guacamole!</strong> you have successfully Logged in.";
        } else {
            $showError = "Password does not match!!! Please Enter The Correct password.";
        }
    } else {
        $showError = "User name does not exist !!!";
    }

    $newURL = $_SERVER['HTTP_REFERER'];
    if (strpos($newURL, '?') !== false) {
        $newURL .= '&alert=' . $showAlert . '&error=' . $showError;
    } else {
        $newURL .= '?alert=' . $showAlert . '&error=' . $showError;
    }


    header('Location:' . $newURL);
}
