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

    <!-- uploading Comments to DataBase -->
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {


            $thread_id = $_GET['threadid'];
            $comment_text = $_POST['commentText'];

            $sql = "SELECT * FROM users WHERE user_name='" . $_SESSION['uname'] . "'";
            $result = mysqli_query($con, $sql);
            $num = mysqli_num_rows($result);
            if ($num == 1)
                $row = mysqli_fetch_assoc($result);


            $comment_userId = $row['user_id'];

            // INSERT INTO `comments` (`comment_id`, `comment_text`, `thread_id`, `comment_user_id`, `comment_time`) VALUES (NULL, '$comment_text', '$thread_id', '$comment_userId', CURRENT_TIMESTAMP)
            $sql = "INSERT INTO `comments` (`comment_id`, `comment_text`, `thread_id`, `comment_user_id`, `comment_time`) VALUES (NULL, '$comment_text', '$thread_id', '$comment_userId', CURRENT_TIMESTAMP)";
            $result = mysqli_query($con, $sql);

            if ($result) {
                echo '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Holy guacamole!</strong> Your Comment is Posted successfully.
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
            $threadid = $_GET['threadid'];
            $sql = "SELECT * FROM threads WHERE thread_id = $threadid";
            $result = mysqli_query($con, $sql);

            $row = mysqli_fetch_assoc($result);
            $thread_title = $row['thread_title'];
            $thread_desc = $row['thread_desc'];
            $thread_user_id = $row['thread_user_id'];
            $created = $row['created'];

            echo '<h1 class="display-5 fw-normal"> ' . $thread_title . '</h1>
            <p class="lead">' . $thread_desc . '</p>';
            ?>
            <hr class="my-4" style="height:2px; border-width:0; color:gray; background-color:gray">
            <p>
                <?php
                $sql = "SELECT * FROM users WHERE user_id=$thread_user_id";
                $result = mysqli_query($con, $sql);
                $row = mysqli_fetch_assoc($result);
                echo '<b>Posted on</b> : ' . $created . '<br>
                    <b>Posted by</b> : ' . $row['user_name'];
                ?>

            </p>
        </div>
    </div>


    <!-- Add Comment Form Starts from here -->
    <div class="container">
        <h1> Post a Comment </h1>

        <div class="jumbotron jumbotron-fluid py-4">
            <div class="container">
                <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST">
                    <div class="mb-3">
                        <label for="commentText" class="form-label">Type Your Comment</label>
                        <textarea class="form-control" id="commentText" name="commentText" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Post Comment</button>
                </form>
            </div>
        </div>
    </div>


    <!-- Discussion Section starts from here -->
    <div class="container">
        <h1 class="py-2">Discussions</h1>

        <?php
        $noresult = true;

        $thread_id = $_GET['threadid'];
        // SELECT * FROM `comments` WHERE thread_id=$thread_id
        $sql = "SELECT * FROM `comments` WHERE thread_id=$thread_id";
        $result = mysqli_query($con, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $noresult = false;
            $comment_text = $row['comment_text'];
            $comment_userId = $row['comment_user_id'];
            $comment_time = $row['comment_time'];

            $sql2 = "SELECT * FROM users WHERE user_id=$comment_userId";
            $result2 = mysqli_query($con, $sql2);
            $row2 = mysqli_fetch_assoc($result2);

            echo '
            <div class="d-flex my-4 ">
            <div class="flex-shrink-0">
                <img src="images/userDefault.png" alt="userDefault" width="50px">
            </div>
            <div class="flex-grow-1 ms-3">
            <h5 class="d-inline">' . $row2["user_name"] . '</h5> ( ' . $comment_time . ' )</br>
                ' . $comment_text . '
            </div>
            </div>    
            ';
        }

        if ($noresult) {
            echo '
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">No Result Found</h1>
                    <p class="lead">Be the first person to Reply.</p>
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