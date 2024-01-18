<!-- DB Connecction -->
<?php
require 'partials/_dbConnection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Forum </title>
</head>

<body style="background-color: aliceblue;" class="d-flex flex-column min-vh-100">

    <!-- header -->
    <?php
    require 'partials/_header.php';
    ?>

    <!-- Search Result -->
    <!-- mysql : alter table threads add FULLTEXT(`thread_title`, `thread_desc`); -->
    <!-- select mysql : select * from threads where match (thread_title, thread_desc) against (); -->

    <div class="container my-4">
        <div>
            <h3 class="d-inline">Search Result for</h3>
            <em>
                <h4 class="d-inline">'<?php echo $_GET['search']; ?>'</h4>
            </em>
        </div>

        <div class="pl-4 pt-4">
            <?php
            $key = $_GET['search'];
            $sql = "select * from threads where MATCH (thread_title, thread_desc) against ('$key');";
            $result = mysqli_query($con, $sql);

            $noresult = true;
            if ($result) {
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
            }

            if ($noresult) {
                echo '
            <div class="jumbotron jumbotron-fluid my-4">
            <div class="container">
                <h1 class="display-4">No Threads Found</h1>
                <p class="lead">Be the first person to ask Question.</p>
            </div>
            </div>            
            ';
            }
            ?>
        </div>
    </div>

    <!-- footer -->
    <?php
    require 'partials/_footer.php';
    ?>

</body>

</html>