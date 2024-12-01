<?php
// Initialize the session
session_start();

// Database connection
include '../backend/config.php'; // Ensure this file exists and has correct DB credentials

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

<!DOCTYPE html>
<html lang="en">
<?php include 'includes/header.php'; ?>

<!-- Hero-area -->
<div class="hero-area section">
    <div class="bg-image bg-parallax overlay" style="background-image:url(./img/bgc2.jpg);"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <h1 class="white-text"><?php echo htmlspecialchars($jobDetails['title'], ENT_QUOTES, 'UTF-8'); ?></h1>
            </div>
        </div>
    </div>
</div>
<!-- /Hero-area -->

<!-- Job Details -->
<div id="job-details" class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="blog-post">
                    <h3>Job Description</h3>
                    <p><?php echo nl2br(htmlspecialchars($jobDetails['description'], ENT_QUOTES, 'UTF-8')); ?></p>

                    <h3>Skills Required</h3>
                    <p><?php echo nl2br(htmlspecialchars($jobDetails['skills'], ENT_QUOTES, 'UTF-8')); ?></p>

                    <h3>Educational Requirements</h3>
                    <p><?php echo nl2br(htmlspecialchars($jobDetails['educational_requirements'], ENT_QUOTES, 'UTF-8')); ?></p>

                    <h3>Duties and Responsibilities</h3>
                    <p><?php echo nl2br(htmlspecialchars($jobDetails['duties'], ENT_QUOTES, 'UTF-8')); ?></p>

                    <h3>Salary</h3>
                    <p><?php echo htmlspecialchars($jobDetails['salary'], ENT_QUOTES, 'UTF-8'); ?></p>

                    <h3>Companies Offering This Role</h3>
                    <p><?php echo nl2br(htmlspecialchars($jobDetails['companies'], ENT_QUOTES, 'UTF-8')); ?></p>
                </div> <a href="knowledgeNetwork.php" class="btn btn-primary">Back </a>
            </div>
        </div>
    </div>
</div>
<!-- /Job Details -->

<?php include 'includes/footer.php'; ?>

</html>

<?php
// Close the statement and connection
$stmt->close();
$conn->close();
?>
