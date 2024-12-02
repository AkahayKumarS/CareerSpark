<?php
session_start(); // Start the session

// Check if admin
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include 'includes/admin_navbar.php';
?>


<!-- Dashboard Content Start -->
<div class="dashboard-container">
    <h1 class="dashboard-heading text-primary">Welcome to the CareerSpark Admin Dashboard</h1>
    <div class="dashboard-cards">
        <div class="dashboard-card">
            <i class="fa fa-book"></i>
            <h5>Manage Courses</h5>
            <a href="manage_courses.php">Go to Courses</a>
        </div>
        <div class="dashboard-card">
            <i class="fa fa-brain"></i>
            <h5>Manage Knowledge Network</h5>
            <a href="manage_knowledgeNetwork.php">Go to knowledgeNetwork</a>
        </div>
        <div class="dashboard-card">
            <i class="fa fa-industry"></i>
            <h5>Manage Industry Information</h5>
            <a href="manage_industry.php">Go to Industry</a>
        </div>
        <div class="dashboard-card">
            <i class="fa fa-users"></i>
            <h5>Manage Users</h5>
            <a href="manage_users.php">Go to Users</a>
        </div>
        <div class="dashboard-card">
            <i class="fa fa-comments"></i>
            <h5>View Feedback</h5>
            <a href="feedback.php">View Feedback</a>
        </div>
    </div>
</div>
<!-- Dashboard Content End -->

<!-- Footer -->
<footer class="bg-light text-center py-4">
    <p class="m-0">&copy; CareerSpark 2024. All Rights Reserved.</p>
</footer>


<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>