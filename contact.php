<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iSecure - ContactUs</title>
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- header -->
    <?php
    require 'partials/_header.php';
    ?>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $title = $_POST['title'];
        $desc = $_POST['desc'];

        // INSERT INTO `contactus`(`id`, `name`, `email`, `mobile`, `title`, `descripton`, `time`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7])
        $sql = "INSERT INTO `contactus`(`id`, `name`, `email`, `mobile`, `title`, `descripton`, `time`) VALUES (NULL,'$name','$email','$mobile','$title','$desc',CURRENT_TIMESTAMP)";
        $result = mysqli_query($con, $sql);

        if ($result) {
            echo '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Holy guacamole!</strong> Your Enqury is Submitted successfully.
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
    }
    ?>

    <div class="container my-3">

        <!-- About us Image -->
        <img src="images/contactus.jpeg" alt="Contact us" width="1100" height="400">

        <h1 class="text-center my-5">Enquire Now</h1>
        <div class="container w-75">
            <form action="contact.php" method="POST">
                <div class="row">
                    <div class="mb-3 col">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" maxlength="30" required>
                    </div>
                    <div class="mb-3 col">
                        <input type="emial" class="form-control" id="email" name="email" placeholder="Your Email" required>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col">
                        <input type="number" class="form-control" id="mobile" name="mobile" placeholder="Your 10 Digit Mobile Number" minlength="10" maxlength="10" required>
                    </div>
                    <div class="mb-3 col">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Your Subject" maxlength="255" required>
                    </div>
                </div>
                <div class="mb-3">
                    <textarea class="form-control" id="desc" name="desc" rows="3" placeholder="Your Message"></textarea>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-outline-primary">Submit</button>
                </div>
            </form>
        </div>

    </div>

    <!-- footer -->
    <?php
    require 'partials/_footer.php';
    ?>

</body>

</html>