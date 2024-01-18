<!-- DB Connecction -->
<?php
require 'partials/_dbConnection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Forum - Threads</title>
</head>

<body style="background-color: aliceblue;" class="d-flex flex-column min-vh-100">

    <!-- header -->
    <?php
    require 'partials/_header.php';
    ?>

    <!-- submitted Question upload in Database -->
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

            // echo 'post';
            $th_catid = $_GET['catid'];
            $th_title = $_POST['threadTitle'];
            $th_desc = $_POST['threadDesc'];

            $sql = "SELECT * FROM users WHERE user_name='" . $_SESSION['uname'] . "'";
            $result = mysqli_query($con, $sql);
            $num = mysqli_num_rows($result);
            if ($num == 1)
                $row = mysqli_fetch_assoc($result);

            $th_user_id = $row['user_id'];

            // INSERT INTO `threads` (`thread_id`, `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `created`) VALUES (NULL, '" . $th_title . "', '" . $th_desc . "', '" . (int)$th_catid . "', '0', CURRENT_TIMESTAMP)
            $sql = "INSERT INTO `threads` (`thread_id`, `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `created`) VALUES (NULL, '" . $th_title . "', '" . $th_desc . "', '" . $th_catid . "', '$th_user_id', CURRENT_TIMESTAMP)";
            $result = mysqli_query($con, $sql);

            if ($result) {
                echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Holy guacamole!</strong> Your thread is Posted successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ';
            } else {
                echo '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Something is wrong please try again letter.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            ';
            }
        } else {
            echo '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Please first Logged in to iSecure Account.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                ';
        }
    }
    ?>


    <!-- Add jumbotron here -->
    <div class="container mt-4">
        <div class="jumbotron">
            <?php
            $catid = $_GET['catid'];
            $sql = "SELECT * FROM categories WHERE category_id = $catid";
            $result = mysqli_query($con, $sql);

            $row = mysqli_fetch_assoc($result);
            $catName = $row['category_name'];
            $catDesc = $row['category_description'];

            echo '<h1 class="display-4">Welcome to ' . $catName . ' Forum</h1>
            <p class="lead">' . $catDesc . '</p>';
            ?>
            <hr class="my-4" style="height:2px; border-width:0; color:gray; background-color:gray">
            <p>
            <ul>
                <li>Do not spam.</li>
                <li>Do Not Bump Posts.</li>
                <li>Do Not Offer to Pay for Help.</li>
                <li>Do Not Offer to Work For Hire.</li>
                <li>Do Not Post About Commercial Products.</li>
                <li>Do Not Create Multiple Accounts (Sockpuppets)...</li>
            </ul>
            </p>
            <a class="btn btn-outline-primary btn-lg" href="#" role="button">Learn more</a>
        </div>
    </div>


    <!-- Ask Question Form start from here -->
    <div class="container">
        <h1> Ask Question </h1>

        <div class="jumbotron jumbotron-fluid py-4">
            <div class="container">
                <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
                    <div class="mb-3">
                        <label for="threadTitle" class="form-label">Problem Title</label>
                        <input type="text" class="form-control" id="threadTitle" name="threadTitle" aria-describedby="threadHelp" required>
                        <div id="threadHelp" class="form-text">Keep your title as short and clear as possible.</div>
                    </div>
                    <div class="mb-3">
                        <label for="threadDesc" class="form-label">Ellaborate Your Concern</label>
                        <textarea class="form-control" id="threadDesc" name="threadDesc" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>




    <!-- Browse Questions start from here -->
    <div class="container">
        <h1 class="py-2">Browse Questions</h1>

        <?php
        $catid = $_GET['catid'];
        $sql = "SELECT * FROM threads WHERE thread_cat_id = $catid";
        $result = mysqli_query($con, $sql);

        $noresult = true;

        while ($row = mysqli_fetch_assoc($result)) {
            $noresult = false;
            $thread_id = $row['thread_id'];
            $thread_title = $row['thread_title'];
            $thread_desc = $row['thread_desc'];
            $thread_time = $row['created'];
            $thread_user_id = $row['thread_user_id'];

            $sql2 = "SELECT * FROM users WHERE user_id=$thread_user_id";
            $result2 = mysqli_query($con, $sql2);
            $row2 = mysqli_fetch_assoc($result2);

            echo '
            <div class="d-flex my-4 ">
            <div class="flex-shrink-0">
                <a><img src="images/userDefault.png" alt="userDefault" width="50px" title="Asked by : ' . $row2['user_name'] . ' | On : ' . $thread_time . '"></a>
                
            </div>
            <div class="flex-grow-1 ms-3">
            <h5><a href="thread.php?threadid=' . $thread_id . '" class="text-dark">' . $thread_title . '</a></h5>
                ' . $thread_desc . '
            </div>
            </div>    
            ';
        }

        if ($noresult) {
            echo '
            <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-4">No Threads Found</h1>
                <p class="lead">Be the first person to ask Question.</p>
            </div>
            </div>            
            ';
        }
        ?>



    </div>


    <!-- footer -->
    <?php
    require 'partials/_footer.php';
    ?>

</body>

</html>