<?php
session_start();
include '../backend/config.php';

// Check if admin
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Handle User Actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_user'])) {
        $user_id = $_POST['user_id'];

        // First delete from student_profiles
        $sql_profile = "DELETE FROM student_profiles WHERE user_id = ?";
        $stmt_profile = $conn->prepare($sql_profile);
        $stmt_profile->bind_param("i", $user_id);
        $stmt_profile->execute();

        // Then delete from users table
        $sql_user = "DELETE FROM users WHERE id = ?";
        $stmt_user = $conn->prepare($sql_user);
        $stmt_user->bind_param("i", $user_id);

        if ($stmt_user->execute()) {
            $message = "User deleted successfully!";
            $message_type = "success";
        } else {
            $message = "Error deleting user!";
            $message_type = "danger";
        }
    } elseif (isset($_POST['update_user_type'])) {
        $user_id = $_POST['user_id'];
        $user_type = $_POST['user_type'];

        $sql = "UPDATE users SET user_type = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $user_type, $user_id);

        if ($stmt->execute()) {
            $message = "User type updated successfully!";
            $message_type = "success";
        } else {
            $message = "Error updating user type!";
            $message_type = "danger";
        }
    }
}

// Fetch Users with education information and user type
$sql = "SELECT u.id, u.name, u.email, u.user_type, sp.highest_qualification 
        FROM users u 
        LEFT JOIN student_profiles sp ON u.id = sp.user_id";
$result = $conn->query($sql);
?>

<?php include 'includes/admin_navbar.php'; ?>

<div class="container py-5">
    <?php if (isset($message)): ?>
        <div class="alert alert-<?php echo $message_type; ?> text-center" id="alert-message">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <div class="bg-light p-4 rounded shadow mb-5">
        <div class="text-center mb-4">
            <h4 class="h3 mb-3 font-weight-normal">
                <i class="fas fa-users me-2 text-primary"></i>User Management
            </h4>
        </div>

        <!-- Users Table -->
        <div class="table-responsive">
            <table class="table table-hover" id="usersTable">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Education</th>
                        <th>User Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($user = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['name']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo htmlspecialchars($user['highest_qualification'] ?? 'Not specified'); ?></td>
                            <td>
                                <span class="badge bg-<?php echo $user['user_type'] === 'admin' ? 'danger' : 'primary'; ?>">
                                    <?php echo ucfirst($user['user_type']); ?>
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#editTypeModal<?php echo $user['id']; ?>">
                                    <i class="fas fa-user-edit"></i>
                                </button>
                                <form action="manage_users.php" method="POST" class="d-inline"
                                    onsubmit="return confirmDelete('<?php echo htmlspecialchars($user['name']); ?>')">
                                    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                    <button type="submit" name="delete_user" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit User Type Modal -->
                        <div class="modal fade" id="editTypeModal<?php echo $user['id']; ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="manage_users.php" method="POST">
                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                <i class="fas fa-user-edit me-2"></i>Update User Type
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">

                                            <div class="mb-3">
                                                <label class="form-label">
                                                    <i class="fas fa-user-tag me-2"></i>User Type
                                                </label>
                                                <select name="user_type" class="form-select">
                                                    <option value="student" <?php echo $user['user_type'] === 'student' ? 'selected' : ''; ?>>Student</option>
                                                    <option value="admin" <?php echo $user['user_type'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="update_user_type" class="btn btn-primary">Save
                                                Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<style>
    .table th {
        background-color: #f8f9fa;
    }

    .badge {
        font-size: 0.9em;
        padding: 0.5em 0.8em;
    }
</style>

<script>
    // Hide alert message after 3 seconds
    setTimeout(() => {
        const alertMessage = document.getElementById('alert-message');
        if (alertMessage) {
            alertMessage.style.display = 'none';
        }
    }, 3000);

    // Confirm delete
    function confirmDelete(userName) {
        return confirm(`Are you sure you want to delete the user "${userName}"? This action cannot be undone.`);
    }
</script>

<!-- JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Footer -->
<footer class="bg-light text-center py-4">
    <p class="m-0">&copy; CareerSpark 2024. All Rights Reserved.</p>
</footer>