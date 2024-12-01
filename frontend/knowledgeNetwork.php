<?php
// Initialize the session
session_start();

// Database connection
include '../backend/config.php'; // Ensure this file exists and has correct DB credentials

// Default search term
$searchTerm = isset($_POST['search']) ? $_POST['search'] : '';

// Prepare the query based on the search term
if ($searchTerm) {
    $sql = "SELECT id, title, description FROM knowledge_network WHERE title LIKE ?";
    $stmt = $conn->prepare($sql);
    $searchParam = "%" . $searchTerm . "%";
    $stmt->bind_param("s", $searchParam);
} else {
    $sql = "SELECT id, title, description FROM knowledge_network";
    $stmt = $conn->prepare($sql);
}

// Execute the query
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'includes/header.php'; ?>

<!-- Hero-area -->
<div class="hero-area section">
    <!-- Background Image -->
    <div class="bg-image bg-parallax overlay" style="background-image:url(./img/bgc2.jpg);"></div>

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 text-center">
                <h1 class="white-text">Search for Job Roles</h1>
                
                <!-- Search Bar -->
                <form method="POST" action="">
                    <input 
                        type="text" 
                        name="search" 
                        class="form-control" 
                        placeholder="Search for job roles" 
                        value="<?php echo htmlspecialchars($searchTerm, ENT_QUOTES, 'UTF-8'); ?>"
                    >
                    <button type="submit" class="btn btn-primary mt-2">Search</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Hero-area -->

<!-- Blog -->
<div id="blog" class="section">
    <div class="container">
        <div class="row">
            <div id="main" class="col-md-9">
                <?php
                if ($result && $result->num_rows > 0) {
                    // Fetch and display job details
                    while ($job = $result->fetch_assoc()) {
                        echo '<div class="blog-post" style="margin-bottom: 20px;">';
                        echo '<h2>' . htmlspecialchars($job['title'], ENT_QUOTES, 'UTF-8') . '</h2>';

                        // Display a truncated description
                        $shortDescription = substr($job['description'], 0, 100) . '...';
                        echo '<p>' . htmlspecialchars($shortDescription, ENT_QUOTES, 'UTF-8') . '</p>';

                        // "Read More" button with link to job details page
                        echo '<a href="jobDetails.php?id=' . htmlspecialchars($job['id'], ENT_QUOTES, 'UTF-8') . '" class="btn btn-primary">Read More</a>';
                        
                        echo '</div>';
                    }
                } else {
                    echo '<p>No job roles found for your search.</p>';
                }
                ?>
            </div>
        </div>
    </div>
</div>
<!-- /Blog -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<?php include 'includes/footer.php'; ?>

</html>

<?php
// Close the statement and connection
$stmt->close();
$conn->close();
?>
