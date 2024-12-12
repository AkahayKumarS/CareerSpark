<?php
session_start();
include '../backend/config.php'; // Include DB connection

// Check if admin
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Handle Course Actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_course'])) {
        // Add Course
        $title = trim($_POST['title']);
        $category = trim($_POST['category']);
        $course_link = trim($_POST['course_link']);
        $is_premium = isset($_POST['is_premium']) ? 1 : 0;
        $course_image = trim($_POST['course_image']);
        $course_provider = trim($_POST['course_provider']); // New field
        $duration = trim($_POST['duration']);

        $sql = "INSERT INTO courses (title, category, course_link, is_premium, course_image, course_provider, duration) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssdssi", $title, $category, $course_link, $is_premium, $course_image, $course_provider, $duration);
        $stmt->execute();
        $message = "Course added successfully!";
    } elseif (isset($_POST['update_course'])) {
        // Update Course
        $id = $_POST['id'];
        $title = trim($_POST['title']);
        $category = trim($_POST['category']);
        $course_link = trim($_POST['course_link']);
        $is_premium = isset($_POST['is_premium']) ? 1 : 0;
        $course_image = trim($_POST['course_image']);
        $course_provider = trim($_POST['course_provider']); // New field
        $duration = trim($_POST['duration']);

        $sql = "UPDATE courses SET title = ?, category = ?, course_link = ?, is_premium = ?, course_image = ?, course_provider = ?, duration = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssdssii", $title, $category, $course_link, $is_premium, $course_image, $course_provider, $duration, $id);
        $stmt->execute();
        $message = "Course updated successfully!";
    } elseif (isset($_POST['delete_course'])) {
        // Delete Course
        $id = $_POST['id'];
        $sql = "DELETE FROM courses WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $message = "Course deleted successfully!";
    }
}

// Fetch Courses
$sql = "SELECT * FROM courses";
$result = $conn->query($sql);
?>

<?php include 'includes/admin_navbar.php'; ?>


<?php if (isset($message)): ?>
    <div class="alert alert-success text-center" id="alert-message"><?php echo $message; ?></div>
<?php endif; ?>

<div class="container py-5">

    <!-- Add Course Form -->
    <form action="manage_courses.php" method="POST" class="bg-light p-4 rounded shadow mb-5 course-add-form">
        <div class="text-center mb-4">
            <h4 class="h3 mb-3 font-weight-normal">
                <i class="fas fa-graduation-cap me-2 text-primary"></i>Add New Course
            </h4>
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">
                <i class="fas fa-book text-primary me-2"></i>Course Title
            </label>
            <div class="input-group">
                <span class="input-group-text bg-light"><i class="fas fa-heading text-muted"></i></span>
                <input type="text" name="title" id="title" class="form-control" placeholder="Enter course title"
                    required>
            </div>
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">
                <i class="fas fa-tags text-primary me-2"></i>Category
            </label>
            <div class="input-group">
                <span class="input-group-text bg-light"><i class="fas fa-layer-group text-muted"></i></span>
                <input type="text" name="category" id="category" class="form-control"
                    placeholder="Enter course category" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="course_provider" class="form-label">
                <i class="fas fa-university text-primary me-2"></i>Course Provider
            </label>
            <div class="input-group">
                <span class="input-group-text bg-light"><i class="fas fa-building text-muted"></i></span>
                <input type="text" name="course_provider" id="course_provider" class="form-control"
                    placeholder="Enter course provider (e.g., Coursera, Udemy)" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="duration" class="form-label">
                <i class="fas fa-clock text-primary me-2"></i>Course Duration (in weeks)
            </label>
            <div class="input-group">
                <span class="input-group-text bg-light"><i class="fas fa-hourglass-half text-muted"></i></span>
                <input type="number" name="duration" id="duration" class="form-control"
                    placeholder="Enter course duration" required>
            </div>
        </div>


        <div class="mb-3">
            <label for="course_link" class="form-label">
                <i class="fas fa-link text-primary me-2"></i>Course Link
            </label>
            <div class="input-group">
                <span class="input-group-text bg-light"><i class="fas fa-globe text-muted"></i></span>
                <input type="url" name="course_link" id="course_link" class="form-control"
                    placeholder="https://example.com/course" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="course_image" class="form-label">
                <i class="fas fa-image text-primary me-2"></i>Course Image URL
            </label>
            <div class="input-group">
                <span class="input-group-text bg-light"><i class="fas fa-camera text-muted"></i></span>
                <input type="url" name="course_image" id="course_image" class="form-control"
                    placeholder="https://example.com/course-image.jpg" required>
            </div>
        </div>

        <div class="form-check form-switch mb-3">
            <input class="form-check-input" type="checkbox" name="is_premium" id="is_premium">
            <label class="form-check-label" for="is_premium">
                <i class="fas fa-crown text-warning me-2"></i>Premium Course
            </label>
        </div>

        <div class="d-grid">
            <button type="submit" name="add_course" class="btn btn-primary btn-lg">
                <i class="fas fa-plus me-2"></i>Add Course
            </button>
        </div>
    </form>

    <!-- Note: This form requires FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        .course-add-form {
            max-width: 600px;
            margin: 0 auto;
            border: 1px solid #e0e0e0;
        }

        .input-group-text {
            background-color: #f8f9fa !important;
            border: 1px solid #ced4da;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
        }
    </style>

    <!-- Courses Table -->
    <h4 class="mb-4">Manage Courses</h4>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Category</th>
                <th>Provider</th>
                <th>Duration (Weeks)</th>
                <th>Course Link</th>
                <th>Premium</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($course = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $course['id']; ?></td>
                    <td><?php echo htmlspecialchars($course['title']); ?></td>
                    <td><?php echo htmlspecialchars($course['category']); ?></td>
                    <td><?php echo htmlspecialchars($course['course_provider']); ?></td>
                    <td><?php echo htmlspecialchars($course['duration']); ?></td>
                    <td><a href="<?php echo htmlspecialchars($course['course_link']); ?>" target="_blank">View Course</a>
                    </td>
                    <td><?php echo $course['is_premium'] ? 'Yes' : 'No'; ?></td>
                    <td><img src="<?php echo htmlspecialchars($course['course_image']); ?>" alt="Course Image" width="100">
                    </td>
                    <td>
                        <!-- Edit Button -->
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                            data-bs-target="#editModal<?php echo $course['id']; ?>">Edit</button>

                        <!-- Delete Form -->
                        <form action="manage_courses.php" method="POST" class="d-inline" onsubmit="return confirmDelete()">
                            <input type="hidden" name="id" value="<?php echo $course['id']; ?>">
                            <button type="submit" name="delete_course" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal<?php echo $course['id']; ?>" tabindex="-1"
                    aria-labelledby="editModalLabel<?php echo $course['id']; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="manage_courses.php" method="POST">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel<?php echo $course['id']; ?>">Edit Course</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id" value="<?php echo $course['id']; ?>">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Course Title</label>
                                        <input type="text" name="title" id="title" class="form-control"
                                            value="<?php echo htmlspecialchars($course['title']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="category" class="form-label">Category</label>
                                        <input type="text" name="category" id="category" class="form-control"
                                            value="<?php echo htmlspecialchars($course['category']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="course_provider" class="form-label">Course Provider</label>
                                        <input type="text" name="course_provider" id="course_provider" class="form-control"
                                            value="<?php echo htmlspecialchars($course['course_provider']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="duration" class="form-label">Course Duration (in weeks)</label>
                                        <input type="number" name="duration" id="duration" class="form-control"
                                            value="<?php echo htmlspecialchars($course['duration']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="course_link" class="form-label">Course Link</label>
                                        <input type="url" name="course_link" id="course_link" class="form-control"
                                            value="<?php echo htmlspecialchars($course['course_link']); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="course_image" class="form-label">Course Image URL</label>
                                        <input type="url" name="course_image" id="course_image" class="form-control"
                                            value="<?php echo htmlspecialchars($course['course_image']); ?>">
                                    </div>
                                    <div class="form-check mb-3">
                                        <input type="checkbox" name="is_premium" class="form-check-input" id="is_premium"
                                            <?php echo $course['is_premium'] ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="is_premium">Premium Course</label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="update_course" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script>
    // Hide the alert message after 3 seconds
    setTimeout(() => {
        const alertMessage = document.getElementById('alert-message');
        if (alertMessage) {
            alertMessage.style.display = 'none';
        }
    }, 2000);

    function confirmDelete() {
        return confirm('Are you sure you want to delete this course?');
    }
</script>

<!-- JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Footer -->
<footer class="bg-light text-center py-4">
    <p class="m-0">&copy; CareerSpark 2024. All Rights Reserved.</p>
</footer>