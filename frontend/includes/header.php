<head>
    <meta charset="utf-8">
    <title>CareerSpark</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>
<!-- Spinner Start -->
<div id="spinner"
    class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<!-- Spinner End -->

<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <a href="index.php" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <h2 class="m-0 text-primary"><i class="fa fa-book me-3"></i>CareerSpark</h2>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="index.php" class="nav-item nav-link active">Home</a>
            <a href="about.php" class="nav-item nav-link">About</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Services</a>
                <div class="dropdown-menu fade-down m-0">
                    <a href="http://127.0.0.1:5000/" class="dropdown-item">Career Prediction</a>
                    <a href="blog.php" class="dropdown-item">Knowledge Network</a>
                    <a href="courses.php" class="dropdown-item">Courses</a>
                </div>
            </div>
            <a href="contact.php" class="nav-item nav-link">Contact</a>


            <!-- Login/Logout Button Start -->
            <?php
            // Check if the user is logged in, if not then redirect them to the login page
            if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true):
                ?>
                <a href="login.php" class="nav-item nav-link">Log in <i class="fa fa-sign-in-alt ms-1"></i></a>
            <?php else: ?>
                <a href="../backend/logout.php" class="nav-item nav-link">Log out <i
                        class="fa fa-sign-out-alt ms-1"></i></a>
            <?php endif; ?>
            <!-- Login/Logout Button End -->
            <a href="profile.php" class="btn btn-primary py-4 px-lg-4 d-none d-lg-block text-uppercase">Profile <i
                    class="bi bi-person-circle ms-2"></i>
            </a>

        </div>
    </div>
</nav>
<!-- Navbar End -->