<?php
session_start();
include 'includes/header.php';
include '../backend/config.php';

$message = "";
$modalDisplay = false;
$redirectUrl = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_type'] = $user['user_type']; // Fetch and store user_type

            $message = "Login successful!";
            $modalDisplay = true;

            // Redirect based on user type
            if ($user['user_type'] === 'admin') {
                $redirectUrl = "../frontend/admin_dashboard.php"; // Admin dashboard
            } else {
                $redirectUrl = "../frontend/index.php"; // Student homepage
            }
        } else {
            $message = "Invalid password.";
            $modalDisplay = true;
        }
    } else {
        $message = "User not found.";
        $modalDisplay = true;
    }

    $stmt->close();
    $conn->close();
}
?>

<!-- Login Form -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="bg-light rounded p-5 shadow">
                    <h2 class="text-center text-primary mb-4">Login to Your Account</h2>
                    <form action="login.php" method="POST" onsubmit="return validateLoginForm()">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Enter your email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Enter your password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2">Login</button>
                        <p class="text-center mt-3">Don't have an account? <a href="register.php"
                                class="text-primary">Register</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if ($modalDisplay): ?>
    <!-- Attractive Centered Modal -->
    <div id="modal"
        style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.6); display: flex; align-items: center; justify-content: center; z-index: 9999;">
        <div
            style="background: #fff; border-radius: 10px; padding: 20px; max-width: 400px; text-align: center; box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2); animation: slideIn 0.5s;">
            <h4 style="margin-bottom: 15px; font-size: 1.5rem; color: #06bbcc;"><?php echo $message; ?></h4>
        </div>
    </div>

    <!-- Modal Animation & Timeout -->
    <script>
        setTimeout(() => {
            document.getElementById('modal').style.display = 'none';
            <?php if (!empty($redirectUrl))
                echo "window.location.href = '$redirectUrl';"; ?>
        }, 3000);

        // Animation for modal (CSS Keyframes)
        const style = document.createElement('style');
        style.innerHTML = `
                                                @keyframes slideIn {
                                                    from {
                                                        transform: translateY(-50px);
                                                        opacity: 0;
                                                    }
                                                    to {
                                                        transform: translateY(0);
                                                        opacity: 1;
                                                    }
                                                }
                                            `;
        document.head.appendChild(style);
    </script>
<?php endif; ?>

<script>
    function validateLoginForm() {
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value.trim();
        if (email === '' || password === '') {
            alert('Please fill out all fields.');
            return false;
        }
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            alert('Please enter a valid email address.');
            return false;
        }
        return true;
    }
</script>


<?php include 'includes/footer.php'; ?>