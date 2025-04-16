<?php
session_start();
include 'includes/header.php';
include '../backend/config.php'; // Database connection
include "chatbot.php";
?>

<!-- Categories Start -->
<div class="container-xxl py-5 category">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Categories</h6>
            <h1 class="mb-5">Course Categories</h1>
        </div>
        <div class="row g-3">
            <?php
            // Fetch unique categories from the database
            $categoryQuery = "SELECT DISTINCT category FROM courses";
            $categoryResult = $conn->query($categoryQuery);

            // Counter for row and column layout
            $counter = 0;

            while ($category = $categoryResult->fetch_assoc()):
                // Check to start a new row every 4 categories
                if ($counter % 4 == 0 && $counter > 0) {
                    echo '</div><div class="row g-3">'; // Close and open a new row
                }
                ?>
                <div class="col-lg-3 col-md-4 wow zoomIn" data-wow-delay="0.1s">
                    <a href="courses.php?category=<?php echo urlencode($category['category']); ?>"
                        class="btn btn-outline-primary w-100 text-center p-3" style="border-radius: 10px;">
                        <?php echo htmlspecialchars($category['category']); ?>
                    </a>
                </div>
                <?php
                $counter++; // Increment counter
            endwhile;
            ?>
        </div>
    </div>
</div>
<!-- Categories End -->

<!-- Courses Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Courses</h6>
            <h1 class="mb-5">
                <?php
                // Display category title if selected
                echo isset($_GET['category'])
                    ? htmlspecialchars($_GET['category']) . " Courses"
                    : "Latest Courses";
                ?>
            </h1>
        </div>
        <div class="row g-4 justify-content-center">
            <?php
            // Fetch courses from the database
            if (isset($_GET['category']) && !empty($_GET['category'])) {
                $sql = "SELECT * FROM courses WHERE category = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $_GET['category']);
            } else {
                // For popular courses, limit to last 3 courses
                $sql = "SELECT * FROM courses ORDER BY id DESC LIMIT 3";
                $stmt = $conn->prepare($sql);
            }
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0):
                while ($course = $result->fetch_assoc()): ?>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="course-item bg-light shadow-sm rounded overflow-hidden">
                            <div class="position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="<?php echo htmlspecialchars($course['course_image']); ?>"
                                    alt="<?php echo htmlspecialchars($course['title']); ?>">
                                <div class="course-overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column">
                                    <div class="course-badge d-flex justify-content-between p-3">
                                        <span
                                            class="badge <?php echo $course['is_premium'] ? 'bg-warning text-dark' : 'bg-info text-white'; ?> d-flex align-items-center">
                                            <?php echo $course['is_premium'] ?
                                                '<i class="fas fa-crown me-2"></i>Premium' :
                                                '<i class="fas fa-tag me-2"></i>Free'; ?>
                                        </span>
                                        <span class="badge bg-light text-dark d-flex align-items-center">
                                            <i class="fas fa-university me-2"></i>
                                            <?php echo htmlspecialchars($course['course_provider']); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center p-4 pb-0">
                                <h5 class="mb-3"><?php echo htmlspecialchars($course['title']); ?></h5>
                                <div class="mb-3 d-flex justify-content-center align-items-center">
                                    <span class="badge bg-light text-dark me-2">
                                        <i class="fas fa-book-open me-1"></i>
                                        <?php echo htmlspecialchars($course['category']); ?>
                                    </span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center p-4 pt-0">
                                <a href="<?php echo htmlspecialchars($course['course_link']); ?>" target="_blank"
                                    class="btn btn-primary px-3 py-2 d-flex align-items-center">
                                    <i class="fas fa-external-link-alt me-2"></i>
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endwhile;
            else: ?>
                <p class="text-center">No courses available in this category.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- Courses End -->

<!-- Add custom CSS for improved course card design -->
<style>
    .course-item {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .course-item:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }

    .course-overlay {
        opacity: 0;
        transition: opacity 0.3s ease;
        background: rgba(0, 0, 0, 0.1);
    }

    .course-item:hover .course-overlay {
        opacity: 1;
    }

    .course-badge {
        z-index: 10;
    }

    .course-badge .badge {
        font-size: 0.8rem;
        font-weight: 500;
    }
</style>

<!-- Include Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<?php include 'includes/footer.php'; ?>