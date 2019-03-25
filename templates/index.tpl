<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cryptonate - Home</title>

    <!-- Bootstrap core CSS -->
    <link href="alt-data/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link rel="stylesheet" href="alt-data/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="alt-data/simple-line-icons/css/simple-line-icons.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="device-mockups/device-mockups.min.css">

    <!-- Custom styles for this template -->
    <link href="css/new-age.min.css" rel="stylesheet">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

</head>

<body id="page-top">

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Cryptonate</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    {if $is_logged_in}
                        <a class="nav-link js-scroll-trigger" href="/dashboard/">Dashboard</a>
                    {else}
                        <a class="nav-link js-scroll-trigger" href="/login">Login</a>
                    {/if}
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="/register">Sign Up</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<header class="masthead">
    <div class="container h-100">
        <div class="row h-100">
            <div class="col-lg-7 my-auto">
                <div class="header-content mx-auto">
                    <h1 class="mb-5">Cryptonate is the Ultimate Cryptocurrency donation tool for streamers!</h1>
                    <a href="/register" class="btn btn-outline btn-xl js-scroll-trigger">Sign up now, its free!</a>
                </div>
            </div>
            <div class="col-lg-5 my-auto">
                <div class="screen">
                    <!-- Demo image for screen mockup, you can put an image here, some HTML, an animation, video, or anything else! -->
                    <img src="img/cryptonate.png" class="img-fluid" alt="">
                </div>
                <div class="button">
                    <!-- You can hook the "home button" to some JavaScript events or just remove it -->
                </div>
            </div>
        </div>
    </div>
</header>
<section class="contact bg-primary" id="contact">
    <div class="container">
        <h2>We
            <i class="fa fa-heart"></i>
            new friends!</h2>
        <ul class="list-inline list-social">
            <li class="list-inline-item social-twitter">
                <a href="https://cryptonate.duper51.me/cryptonate_me">
                    <i class="fa fa-twitter"></i>
                </a>
            </li>
            <li class="list-inline-item social-facebook">
                <a href="#">
                    <i class="fa fa-facebook"></i>
                </a>
            </li>
            <li class="list-inline-item social-google-plus">
                <a href="#">
                    <i class="fa fa-google-plus"></i>
                </a>
            </li>
        </ul>
    </div>
</section>

<footer>
    <div class="container">
        <p>&copy; 2018 Cryptonate. All Rights Reserved.</p>
        <ul class="list-inline">
            <li class="list-inline-item">
                <a href="#">Privacy</a>
            </li>
            <li class="list-inline-item">
                <a href="#">Terms</a>
            </li>
            <li class="list-inline-item">
                <a href="https://cryptonate.freshdesk.com/support/solutions">FAQ</a>
            </li>
        </ul>
    </div>
</footer>

<!-- Bootstrap core JavaScript -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="alt-data/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Plugin JavaScript -->
<script src="alt-data/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for this template -->
<script src="js/new-age.min.js"></script>

</body>

</html>
