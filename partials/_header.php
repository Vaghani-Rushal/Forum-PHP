<?php
session_start();

require 'plugins/bootstrap.php';
include '_dbConnection.php';
include '_loginModal.php';
include '_signupModal.php';
include '_logoutModal.php';

?>

<nav class="navbar navbar-expand-lg sticky-top navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/php tutorial/forum"> iSecure </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/php tutorial/forum">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Top Categories
                    </a>
                    <ul class="dropdown-menu">
                        <?php
                        $sql = "SELECT * From categories LIMIT 5";
                        $result = mysqli_query($con, $sql);

                        while ($row = mysqli_fetch_assoc($result)) {
                            $cid = $row['category_id'];
                            $cname = $row['category_name'];
                            // $cdescription = $row['category_description'];
                            echo '<li><a class="dropdown-item" href="threadlist.php?catid=' . $cid . '">' . $cname . '</a></li>';
                        }
                        ?>


                        <!-- <li>
                            <hr class="dropdown-divider">
                        </li> -->
                        <!-- <li><a class="dropdown-item" href="#">Something else here</a></li> -->
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php"> Contact </a>
                </li>
            </ul>
            <form class="form-inline mr-0" role="search" action="search.php" method="GET">
                <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-success" type="submit">Search</button>
            </form>
            <?php
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                echo '<h4 class="text-light ml-2 mt-1">' . $_SESSION['uname'] . '</h4>';
                echo '<button class="btn btn-outline-success mx-2 " type="button" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</button>';
            } else {
                echo '
                    <button class="btn btn-outline-success mx-2" type="button" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                    <button class="btn btn-outline-success " type="button" data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>    
                    ';
            }
            ?>


        </div>
    </div>
</nav>

<?php
include '_alertAndError.php';
?>