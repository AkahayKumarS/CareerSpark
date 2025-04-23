<?php
// Initialize the session
session_start();

// Database connection
include '../backend/config.php'; // Ensure this file exists and has correct DB credentials
include 'includes/header.php';
include "chatbot.php";

// Get the job ID from the URL
$jobId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch the specific job details
$sql = "SELECT * FROM knowledge_network WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $jobId);
$stmt->execute();
$result = $stmt->get_result();

// Fetch the job details
$jobDetails = $result->fetch_assoc();
?>

<style>
    /* Enhanced Job Details Styling */
    .hero-area {
        position: relative;
        color: white;
        padding: 100px 0;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    #job-details {
        background: #f4f7f6;
        padding: 50px 0;
    }

    .job-details-container {
        background: white;
        border-radius: 10px;
        padding: 40px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .job-details-container h3 {
        color: #06bbcc;
        margin-top: 30px;
        margin-bottom: 20px;
        position: relative;
        padding-left: 40px;
    }

    .job-details-container h3::before {
        content: '\f02d';
        font-family: 'Font Awesome 5 Free';
        position: absolute;
        left: 0;
        top: 0;
        color: #06bbcc;
        font-size: 30px;
        font-weight: 900;
    }

    .job-details-content {
        line-height: 1.8;
        color: #333;
    }

    .job-details-content ul {
        padding-left: 20px;
        margin-bottom: 20px;
        list-style-type: none;
        /* Remove default list styling */
    }

    .job-details-content ul li {
        margin-bottom: 10px;
        position: relative;
        padding-left: 0;
        /* Remove left padding */
    }

    .job-details-content ul li::before {
        content: '';
        /* Remove the blue tick icon */
    }

    .back-btn {
        margin-top: 20px;
        display: inline-block;
        background-color: #06bbcc;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .back-btn:hover {
        background-color: #0AC2D4;
        transform: translateY(-3px);
    }
</style>

<!-- Hero-area -->
<div class="hero-area section" style="background-color:#d1e7e8">
    <div class="bg-image bg-parallax overlay" style="background-image:url(./img/bgc2.jpg);"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-1 text-center">
                <h1 class="white-text"><?php echo htmlspecialchars($jobDetails['title'], ENT_QUOTES, 'UTF-8'); ?></h1>
            </div>
        </div>
    </div>
</div>
<!-- /Hero-area -->

<!-- Job Details -->
<div id="job-details" class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="job-details-container">
                    <div class="job-details-content">
                        <h3>Job Description</h3>
                        <p><?php echo nl2br(htmlspecialchars($jobDetails['description'], ENT_QUOTES, 'UTF-8')); ?></p>

                        <h3>Skills Required</h3>
                        <?php
                        $skills = explode("\n", $jobDetails['skills']);
                        echo '<ul>';
                        foreach ($skills as $skill) {
                            if (trim($skill)) {
                                echo '<li>' . htmlspecialchars(trim($skill), ENT_QUOTES, 'UTF-8') . '</li>';
                            }
                        }
                        echo '</ul>';
                        ?>

                        <h3>Educational Requirements</h3>
                        <?php
                        $education = explode("\n", $jobDetails['educational_requirements']);
                        echo '<ul>';
                        foreach ($education as $edu) {
                            if (trim($edu)) {
                                echo '<li>' . htmlspecialchars(trim($edu), ENT_QUOTES, 'UTF-8') . '</li>';
                            }
                        }
                        echo '</ul>';
                        ?>

                        <h3>Duties and Responsibilities</h3>
                        <?php
                        $duties = explode("\n", $jobDetails['duties']);
                        echo '<ul>';
                        foreach ($duties as $duty) {
                            if (trim($duty)) {
                                echo '<li>' . htmlspecialchars(trim($duty), ENT_QUOTES, 'UTF-8') . '</li>';
                            }
                        }
                        echo '</ul>';
                        ?>

                        <h3>Salary</h3>
                        <p><?php echo htmlspecialchars($jobDetails['salary'], ENT_QUOTES, 'UTF-8'); ?></p>

                        <h3>Companies Offering This Role</h3>
                        <?php
                        $companies = explode("\n", $jobDetails['companies']);
                        echo '<ul>';
                        foreach ($companies as $company) {
                            if (trim($company)) {
                                echo '<li>' . htmlspecialchars(trim($company), ENT_QUOTES, 'UTF-8') . '</li>';
                            }
                        }
                        echo '</ul>';
                        ?>

                        <a href="knowledgeNetwork.php" class="back-btn">
                            <i class="fas fa-arrow-left mr-2"></i> Back to Knowledge Network
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Job Details -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<?php include 'includes/footer.php'; ?>