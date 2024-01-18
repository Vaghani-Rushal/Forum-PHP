<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iSecure - About</title>
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- header -->
    <?php
    require 'partials/_header.php';
    ?>

    <div class="container my-3">

        <!-- About us Image -->
        <img src="images/aboutus.jpg" alt="About us" width="1000" height="500">

        <!-- Content -->
        <h1>About Us</h1>
        <p class="fs-5">The India-US Forum is a platform for both American and Indian leaders from across the spectrum to shape the future of India-US strategic partnership through consultation and collaboration. It is convened by the Ananta Centre and Ministry of External Affairs, Government of India. The discussions are held under Chatham House Rule and participation, by invitation only, is limited to select eminent personalities from each side.</p>


        <p class="d-inline-flex gap-1">
            <a class="btn btn-outline-primary text-center" data-bs-toggle="collapse" href="#collapseExample" role="link" aria-expanded="false" aria-controls="collapseExample">
                read more
            </a>
        </p>
        <div class="collapse" id="collapseExample">
            <div class="card card-body">
                <h2>Objective</h2>
                <ul>
                    <li>Forward looking discussions with specific action points.</li>
                    <li>New ideas for bilateral and multilateral cooperation</li>
                    <li>New ideas on how to expand relations for the long-term</li>
                    <li>Identify new areas of collaboration and ways to move beyond the potential roadblocks.</li>
                </ul>
            </div>
        </div>

    </div>
    <!-- footer -->
    <?php
    require 'partials/_footer.php';
    ?>

</body>

</html>