<?php

if (isset($_GET['alert'])) {

    $showAlert = $_GET['alert'];
    $showError = $_GET['error'];

    if ($showAlert != "false") {
        echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
            ' . $showAlert . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        $showAlert = false;
    } else if ($showError != "false") {
        echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
            ' . $showError . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        $showError = false;
    }
}
