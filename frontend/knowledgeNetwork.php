<?php
// Initialize the session
session_start();

// Database connection
include '../backend/config.php'; // Ensure this file exists and has correct DB credentials
include 'includes/header.php';
include "chatbot.php";

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
<style>
    /* Enhanced Knowledge Network Styles */
    .hero-area {
        position: relative;
        color: white;
        padding: 100px 0;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .hero-area .bg-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        z-index: 0;
    }

    .hero-area .bg-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(24, 29, 56, 0.7);
        /* Dark overlay with desired color */
        z-index: 1;
    }

    .hero-area .container {
        position: relative;
        z-index: 2;
        /* Ensures content appears above overlay */
    }

    .search-container {
        max-width: 700px;
        margin: 0 auto;
        position: relative;
    }

    .search-container input {
        padding: 15px;
        border-radius: 5px 0 0 5px;
        border: none;
    }

    .search-container .btn {
        padding: 15px 25px;
        border-radius: 0 5px 5px 0;
        background-color: #06bbcc;
        border: none;
        transition: all 0.3s ease;
    }

    .search-container .btn:hover {
        background-color: #0AC2D4;
    }

    .blog-post {
        background: white;
        border-radius: 10px;
        padding: 25px;
        margin-bottom: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        position: relative;
    }

    .blog-post:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    .blog-post h2 {
        color: #06bbcc;
        margin-bottom: 15px;
        position: relative;
        padding-left: 40px;
    }

    .blog-post h2::before {
        content: '\f02d';
        /* book icon */
        font-family: 'Font Awesome 5 Free';
        position: absolute;
        left: 0;
        top: 0;
        color: #06bbcc;
        font-size: 30px;
        font-weight: 900;
    }

    .blog-post .btn {
        background-color: #06bbcc;
        border: none;
        transition: all 0.3s ease;
    }

    .blog-post .btn:hover {
        background-color: #0AC2D4;
        transform: translateY(-3px);
    }

    #blog {
        background: #f4f7f6;
        padding: 50px 0;
    }

    /* No results styling */
    .no-results {
        text-align: center;
        padding: 50px;
        background: white;
        border-radius: 10px;
    }

    .no-results i {
        color: #06bbcc;
        margin-bottom: 20px;
    }
</style>

<!-- Hero-area -->
<div class="hero-area section">
    <!-- Background Image -->
    <div class="bg-image" style="background-image:url(./img/cat-1.jpg);"></div>
    <div class="bg-overlay"></div> <!-- Dark overlay -->

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-1 text-center">
                <h1 class="white-text text-primary">Knowledge Network</h1>
                <p class="lead white-text mb-4">Explore and Discover Career Insights</p>

                <!-- Search Bar -->
                <div class="search-container">
                    <form method="POST" action="" class="d-flex">
                        <input type="text" name="search" class="form-control flex-grow-1"
                            placeholder="Search for job roles"
                            value="<?php echo htmlspecialchars($searchTerm, ENT_QUOTES, 'UTF-8'); ?>">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /Hero-area -->

<!-- Blog -->
<div id="blog" class="section">
    <div class="container">
        <div class="row">
            <div id="main" class="col-md-12">
                <?php
                if ($result && $result->num_rows > 0) {
                    // Fetch and display job details
                    while ($job = $result->fetch_assoc()) {
                        echo '<div class="blog-post">';
                        echo '<h2>' . htmlspecialchars($job['title'], ENT_QUOTES, 'UTF-8') . '</h2>';

                        // Display a truncated description
                        $shortDescription = substr($job['description'], 0, 200) . '...';
                        echo '<p>' . htmlspecialchars($shortDescription, ENT_QUOTES, 'UTF-8') . '</p>';

                        // "Read More" button with link to job details page
                        echo '<a href="jobDetails.php?id=' . htmlspecialchars($job['id'], ENT_QUOTES, 'UTF-8') . '" class="btn btn-primary">';
                        echo '<i class="fas fa-book-open mr-2"></i> Read More</a>';
                        echo '</div>';
                    }
                } else {
                    echo '<div class="no-results">';
                    echo '<i class="fas fa-search fa-4x"></i>';
                    echo '<h3>No Job Roles Found</h3>';
                    echo '<p>Try adjusting your search term.</p>';
                    echo '</div>';
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
// Close the connection
$conn->close();
?>