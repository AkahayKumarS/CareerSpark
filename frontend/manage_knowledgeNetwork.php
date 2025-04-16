<?php
// Initialize session
session_start();

// Include database configuration
include '../backend/config.php';

// Handle Add Job
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_job'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $skills = $_POST['skills'];
    $educational_requirements = $_POST['educational_requirements'];
    $duties = $_POST['duties'];
    $salary = $_POST['salary'];
    $companies = $_POST['companies'];

    $stmt = $conn->prepare("INSERT INTO knowledge_network (title, description, skills, educational_requirements, duties, salary, companies) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $title, $description, $skills, $educational_requirements, $duties, $salary, $companies);
    if ($stmt->execute()) {
        $message = "Job added successfully!";
    } else {
        $message = "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Handle Edit Job
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_job'])) {
    error_log("Edit Job Triggered");
    $id = $_POST['id'];
    error_log("Job ID: $id");
    $title = $_POST['title'];
    $description = $_POST['description'];
    $skills = $_POST['skills'];
    $educational_requirements = $_POST['educational_requirements'];
    $duties = $_POST['duties'];
    $salary = $_POST['salary'];
    $companies = $_POST['companies'];

    $stmt = $conn->prepare("UPDATE knowledge_network SET title=?, description=?, skills=?, educational_requirements=?, duties=?, salary=?, companies=? WHERE id=?");
    $stmt->bind_param("sssssssi", $title, $description, $skills, $educational_requirements, $duties, $salary, $companies, $id);
    if ($stmt->execute()) {
        $message = "Job updated successfully!";
        error_log("Prepare failed: " . $conn->error);
    } else {
        $message = "Error: " . $stmt->error;
    }

    if (!$stmt) {
    } else {
        $stmt->bind_param("sssssssi", $title, $description, $skills, $educational_requirements, $duties, $salary, $companies, $id);
        if (!$stmt->execute()) {
            error_log("Execution failed: " . $stmt->error);
        }
    }
    $stmt->close();
}

// Handle Delete Job
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    $stmt = $conn->prepare("DELETE FROM knowledge_network WHERE id=?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $message = "Job deleted successfully!";
    } else {
        $message = "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Fetch All Jobs
$jobs = [];
$result = $conn->query("SELECT * FROM knowledge_network");
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $jobs[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'includes/admin_navbar.php'; ?>
<style>
    .job-add-form {
        max-width: 700px;
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

<?php if (isset($message)): ?>
    <div class="alert alert-success text-center" id="alert-message"><?php echo $message; ?></div>
<?php endif; ?>
<!-- Manage Knowledge Network -->
<div class="container py-5">
    <!-- Add New Job Form -->
    <form action="manage_knowledgeNetwork.php" method="POST" class="bg-light p-4 rounded shadow mb-5 job-add-form">
        <div class="text-center mb-4">
            <h4 class="h3 mb-3 font-weight-normal">
                <i class="fas fa-briefcase me-2 text-primary"></i>Add New Job
            </h4>
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">
                <i class="fas fa-heading text-primary me-2"></i>Job Title
            </label>
            <div class="input-group">
                <span class="input-group-text bg-light"><i class="fas fa-file-alt text-muted"></i></span>
                <input type="text" name="title" id="title" class="form-control" placeholder="Enter job title" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">
                <i class="fas fa-info-circle text-primary me-2"></i>Description
            </label>
            <textarea name="description" id="description" class="form-control" placeholder="Enter job description"
                required></textarea>
        </div>

        <div class="mb-3">
            <label for="skills" class="form-label">
                <i class="fas fa-tools text-primary me-2"></i>Skills
            </label>
            <textarea type="text" name="skills" id="skills" class="form-control" placeholder="Required skills"
                required></textarea>
        </div>

        <div class="mb-3">
            <label for="educational_requirements" class="form-label">
                <i class="fas fa-graduation-cap text-primary me-2"></i>Educational Requirements
            </label>
            <textarea type="text" name="educational_requirements" id="educational_requirements" class="form-control"
                placeholder="Enter educational requirements" required></textarea>
        </div>

        <div class="mb-3">
            <label for="duties" class="form-label">
                <i class="fas fa-tasks text-primary me-2"></i>Duties
            </label>
            <textarea name="duties" id="duties" class="form-control" placeholder="List the responsibilities"
                required></textarea>
        </div>

        <div class="mb-3">
            <label for="salary" class="form-label">
                <i class="fas fa-money-bill-wave text-primary me-2"></i>Salary
            </label>
            <input type="text" name="salary" id="salary" class="form-control" placeholder="Enter salary details"
                required>
        </div>

        <div class="mb-3">
            <label for="companies" class="form-label">
                <i class="fas fa-building text-primary me-2"></i>Companies
            </label>
            <textarea type="text" name="companies" id="companies" class="form-control"
                placeholder="Enter associated companies" required></textarea>
        </div>

        <div class="d-grid">
            <button type="submit" name="add_job" class="btn btn-primary btn-lg">
                <i class="fas fa-plus me-2"></i>Add Job
            </button>
        </div>

    </form>

    <!-- Job Listings -->
    <h4 class="mb-4">Manage Knowledge Network</h4>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Salary</th>
                <th>Companies</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jobs as $job): ?>
                <tr>
                    <td><?php echo $job['id']; ?></td>
                    <td><?php echo htmlspecialchars($job['title']); ?></td>
                    <td><?php echo htmlspecialchars($job['salary']); ?></td>
                    <td><?php echo htmlspecialchars($job['companies']); ?></td>
                    <td>
                        <!-- Edit -->
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                            data-bs-target="#editModal<?php echo $job['id']; ?>">Edit</button>
                        <!-- Delete -->
                        <a href="?delete_id=<?php echo $job['id']; ?>" class="btn btn-danger"
                            onclick="return confirm('Are you sure you want to delete this job?');">Delete</a>
                    </td>
                </tr>

                <!-- Edit Modal -->
                <div class="modal fade" id="editModal<?php echo $job['id']; ?>" tabindex="-1"
                    aria-labelledby="editModalLabel<?php echo $job['id']; ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="manage_knowledgeNetwork.php" method="POST">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel<?php echo $job['id']; ?>">Edit
                                        Job</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id" value="<?php echo $job['id']; ?>">

                                    <div class="mb-3">
                                        <label for="title" class="form-label">Job Title</label>
                                        <input type="text" name="title" id="title" class="form-control"
                                            value="<?php echo htmlspecialchars($job['title']); ?>" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" id="description" class="form-control"
                                            required><?php echo htmlspecialchars($job['description']); ?></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="skills" class="form-label">Skills</label>
                                        <input type="text" name="skills" id="skills" class="form-control"
                                            value="<?php echo htmlspecialchars($job['skills']); ?>" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="educational_requirements" class="form-label">Educational
                                            Requirements</label>
                                        <input type="text" name="educational_requirements" id="educational_requirements"
                                            class="form-control"
                                            value="<?php echo htmlspecialchars($job['educational_requirements']); ?>"
                                            required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="duties" class="form-label">Duties</label>
                                        <textarea name="duties" id="duties" class="form-control"
                                            required><?php echo htmlspecialchars($job['duties']); ?></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="salary" class="form-label">Salary</label>
                                        <input type="text" name="salary" id="salary" class="form-control"
                                            value="<?php echo htmlspecialchars($job['salary']); ?>" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="companies" class="form-label">Companies</label>
                                        <input type="text" name="companies" id="companies" class="form-control"
                                            value="<?php echo htmlspecialchars($job['companies']); ?>" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="edit_job" class="btn btn-primary">Save
                                        Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
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
</script>

<!-- /Manage Section -->

<!-- JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Footer -->
<footer class="bg-light text-center py-4">
    <p class="m-0">&copy; CareerSpark 2024. All Rights Reserved.</p>
</footer>

</html>

<?php
// Close connection
$conn->close();
?>