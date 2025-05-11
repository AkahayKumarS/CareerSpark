<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>CareerSpark Admin Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/CareerSparkFavicon.png" rel="icon">

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

    <style>
        .dashboard-container {
            margin: 20px;
        }

        .dashboard-heading {
            text-align: center;
            margin-bottom: 30px;
        }

        .dashboard-cards {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 20px;
        }

        .dashboard-card {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 10px;
            width: 300px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .dashboard-card i {
            font-size: 50px;
            color: #0056b3;
            margin-bottom: 10px;
        }

        .dashboard-card a {
            display: block;
            margin-top: 10px;
            font-weight: bold;
            color: #0056b3;
            text-decoration: none;
        }

        .dashboard-card a:hover {
            text-decoration: underline;
        }
    </style>

    <script>
        // Hide spinner after page load
        document.addEventListener("DOMContentLoaded", function () {
            const spinner = document.getElementById("spinner");
            if (spinner) {
                spinner.classList.remove("show");
            }
        });
    </script>
</head>

<body>
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
        <a href="admin_dashboard.php" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <!-- Replace book icon with CareerSpark logo -->
            <img src="./img/career_spark_logo.png" alt="CareerSpark Logo"
                style="height: 70px; width: 300px; margin-right: 10px;">
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="admin_dashboard.php" class="nav-item nav-link">Dashboard</a>
                <a href="manage_courses.php" class="nav-item nav-link">Courses</a>
                <a href="manage_knowledgeNetwork.php" class="nav-item nav-link">Knowledge Network</a>
                <a href="manage_users.php" class="nav-item nav-link">Users</a>
                <a href="../backend/logout.php"
                    class="btn btn-primary py-4 px-lg-4 d-none d-lg-block text-uppercase">Log out
                    <i class="fa fa-sign-out-alt ms-1"></i></a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->