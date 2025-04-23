<?php
session_start();

// Check if admin
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include 'includes/admin_navbar.php';
?>

<!-- Dashboard Content Start -->
<div class="dashboard-container">
    <h1 class="dashboard-heading text-primary mb-5">Welcome to the CareerSpark Admin Dashboard</h1>
    <div class="dashboard-cards">
        <div class="dashboard-card">
            <div class="card-icon">
                <i class="fa fa-book"></i>
            </div>
            <h5>Manage Courses</h5>
            <p class="card-description">Add, edit, and organize educational content</p>
            <a href="manage_courses.php" class="card-link">
                Go to Courses <i class="fa fa-arrow-right"></i>
            </a>
        </div>
        <div class="dashboard-card">
            <div class="card-icon">
                <i class="fa fa-brain"></i>
            </div>
            <h5>Manage Knowledge Network</h5>
            <p class="card-description">Structure learning pathways and connections</p>
            <a href="manage_knowledgeNetwork.php" class="card-link">
                Go to Knowledge Network <i class="fa fa-arrow-right"></i>
            </a>
        </div>
        <div class="dashboard-card">
            <div class="card-icon">
                <i class="fa fa-users"></i>
            </div>
            <h5>Manage Users</h5>
            <p class="card-description">Oversee user accounts and permissions</p>
            <a href="manage_users.php" class="card-link">
                Go to Users <i class="fa fa-arrow-right"></i>
            </a>
        </div>
    </div>
</div>
<!-- Dashboard Content End -->

<!-- Footer -->
<footer class="footer bg-light text-center py-4">
    <p class="m-0">&copy; CareerSpark 2024. All Rights Reserved.</p>
</footer>

<!-- Styles -->
<style>
    .dashboard-container {
        max-width: 1200px;
        margin: 3rem auto;
        padding: 2rem;
        background: #ffffff;
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    }

    .dashboard-heading {
        text-align: center;
        font-size: 2.5rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 3rem;
        padding-bottom: 1rem;
        border-bottom: 3px solid #e9ecef;
    }

    .dashboard-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        padding: 1rem;
    }

    .dashboard-card {
        background: #fff;
        border-radius: 12px;
        padding: 2rem;
        text-align: center;
        transition: all 0.3s ease;
        border: 1px solid #e9ecef;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }

    .card-icon {
        background: rgb(231, 230, 230);
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        transition: all 0.3s ease;
    }

    .dashboard-card:hover .card-icon {
        background: rgb(11, 31, 82);
        color: white;
    }

    .dashboard-card i {
        font-size: 2rem;
        color: rgb(28, 42, 77);
        transition: all 0.3s ease;
    }

    .dashboard-card:hover i {
        color: white;
    }

    .dashboard-card h5 {
        color: #2c3e50;
        font-size: 1.25rem;
        margin-bottom: 1rem;
        font-weight: 600;
    }

    .card-description {
        color: #6c757d;
        font-size: 0.9rem;
        margin-bottom: 1.5rem;
    }

    .card-link {
        display: inline-block;
        color: #007bff;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        padding: 0.5rem 1rem;
        border-radius: 5px;
    }

    .card-link:hover {
        background: #f8f9fa;
        color: #0056b3;
    }

    .card-link i {
        font-size: 0.9rem;
        margin-left: 0.5rem;
    }

    .footer {
        margin-top: 4rem;
        background: #f8f9fa;
        border-top: 1px solid #e9ecef;
        color: #6c757d;
    }

    @media (max-width: 768px) {
        .dashboard-container {
            margin: 1rem;
            padding: 1rem;
        }

        .dashboard-heading {
            font-size: 2rem;
        }

        .dashboard-cards {
            grid-template-columns: 1fr;
        }
    }
</style>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>