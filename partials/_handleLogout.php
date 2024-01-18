<?php
session_start();

$showError = "false";
$showAlert = "false";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '_dbConnection.php';
    $_SESSION['loggedin'] = false;
    unset($_SESSION['uname']);

    $showAlert = "<strong></strong> you have successfully Logged out.";
}

$newURL = $_SERVER['HTTP_REFERER'];
if (strpos($newURL, '?') !== false) {
    $newURL .= '&alert=' . $showAlert . '&error=' . $showError;
} else {
    $newURL .= '?alert=' . $showAlert . '&error=' . $showError;
}


header('Location:' . $newURL);
