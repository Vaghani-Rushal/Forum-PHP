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

    <!-- Slider -->
    <div id="carouselExampleIndicators" class="carousel slide carousel-fade">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/slider1.jpeg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="images/slider2.jpeg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="images/slider3.jpeg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Categories cards Starts from here -->
    <div class="container">
        <h1 class="text-center my-2">iSecure - categories</h1>
        <div class="row">

        <?php
            $sql = "SELECT * From categories";
            $result = mysqli_query($con, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                $cid = $row['category_id'];
                $cname = $row['category_name'];
                $cdescription = $row['category_description'];

                echo '
                    <div class="col-md-4 my-3">
                        <div class="card" style="width: 18rem;">
                        <img src="images/' . $cname . '.jpg" class="card-img-top" alt="' . $cname . '">
                        <div class="card-body">
                            <h5 class="card-title"><a href="threadlist.php?catid=' . $cid . '">' . $cname . '</a></h5>
                            <p class="card-text">' . substr($cdescription, 0, 110) . '...</p>
                            <a href="threadlist.php?catid=' . $cid . '" class="btn btn-outline-primary">View Threads</a>
                        </div>
                        </div>
                    </div>
                ';
            } ?>

        </div>
    </div>

    <!-- footer -->
    <?php
    require 'partials/_footer.php';
    ?>

</body>

</html>