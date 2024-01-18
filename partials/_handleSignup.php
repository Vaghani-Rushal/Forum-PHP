<?php
session_start();

$showError = "false";
$showAlert = "false";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '_dbConnection.php';

    $userName = $_POST['signupUname'];
    $password = $_POST['signupPassword'];
    $cpassword = $_POST['signupCpassword'];
    $vcIncode = $_POST['verificationInputCode'];

    $sql = "SELECT * FROM `users` WHERE `user_name`='$userName'";
    $result = mysqli_query($con, $sql);
    $num = mysqli_num_rows($result);

    if ($password !== $cpassword) {
        $showError = "Please Enter The same password !!!";
    } else if ($num != 0) {
        $showError = "User name already Taken !!! Please Try other";
    } else if ($vcIncode != $_SESSION['vcCode']) {
        $showError = "Incorrect verification code";
    } else {

        $hash = password_hash($password, PASSWORD_DEFAULT);
        // INSERT INTO `users`(`user_id`, `user_name`, `user_password`, `created`) VALUES ([value-1],[value-2],[value-3],[value-4])
        $sql = "INSERT INTO `users`(`user_id`, `user_name`, `user_password`, `created`) VALUES (NULL, '$userName', '$hash', CURRENT_TIMESTAMP)";
        $result = mysqli_query($con, $sql);

        if ($result) {
            $showAlert = "<strong>Holy guacamole!</strong> Account has been created successfuly.";
        } else {
            $showError = "<strong>Error!</strong> Something is wrong please try again letter.";
        }
    }

    $newURL = $_SERVER['HTTP_REFERER'];
    if (strpos($newURL, '?') !== false) {
        $newURL .= '&alert=' . $showAlert . '&error=' . $showError;
    } else {
        $newURL .= '?alert=' . $showAlert . '&error=' . $showError;
    }


    header('Location:' . $newURL);
}