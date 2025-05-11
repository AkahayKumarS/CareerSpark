<?php
session_start();
include 'includes/header.php';
include '../backend/config.php';

$messageType = "";
$message = "";
$modalDisplay = false;
$redirectUrl = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate input
    if (empty($email) || empty($password)) {
        $messageType = "danger";
        $message = "Please fill out all fields.";
    } else {
        // Email validation regex
        $emailRegex = '/^[^\s@]+@[^\s@]+\.[^\s@]+$/';
        if (!preg_match($emailRegex, $email)) {
            $messageType = "danger";
            $message = "Please enter a valid email address.";
        } else {
            // Database query
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
                    $_SESSION['user_type'] = $user['user_type'];
                    setcookie("user_id", $_SESSION['user_id'], time() + 10800, "/", "", false, true); // Secure, HttpOnly cookie

                    $modalDisplay = true;

                    // Determine redirect URL based on user type
                    $redirectUrl = ($user['user_type'] === 'admin')
                        ? "../frontend/admin_dashboard.php"
                        : "../frontend/index.php";
                } else {
                    $messageType = "danger";
                    $message = "Invalid email or password.";
                }
            } else {
                $messageType = "danger";
                $message = "User not found.";
            }

            $stmt->close();
        }
    }

    $conn->close();
}
?>

<!-- Login Form -->

<div class="container-xxl py-5 login-page">
    <div class="container">
        <!-- Error Message Container -->
        <?php if (!empty($message) && $messageType === "danger"): ?>
            <div class="row justify-content-center mb-4">
                <div class="col-lg-6">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo htmlspecialchars($message); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="row justify-content-center">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="login-card">
                    <div class="login-header">
                        <h2 class="text-primary">Welcome Back</h2>
                        <p>Sign in to continue to CareerSpark</p>
                    </div>

                    <form action="login.php" method="POST" onsubmit="return validateLoginForm()" class="login-form">
                        <div class="form-group">
                            <label for="email" class="form-label">Email Address</label>
                            <div class="input-wrapper">
                                <i class="fas fa-envelope input-icon"></i>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter your email" required
                                    value="<?php echo htmlspecialchars($email ?? ''); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-wrapper">
                                <i class="fas fa-lock input-icon"></i>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Enter your password" required>
                                <span class="password-toggle" onclick="togglePasswordVisibility()">
                                    <i class="fas fa-eye-slash"></i>
                                </span>
                            </div>
                            <div class="forgot-password">
                                <a href="reset_password.php" class="text-primary">Forgot Password?</a>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary login-btn">Login</button>

                        <div class="signup-link">
                            <p>Don't have an account? <a href="register.php" class="text-primary">Register</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Existing Modal from Original Code Remains Unchanged -->
<?php if ($modalDisplay): ?>
    <!-- Success Modal (Original Code Remains Unchanged) -->
    <div id="successModal" style="
        position: fixed; 
        top: 0; 
        left: 0; 
        width: 100%; 
        height: 100%; 
        background: rgba(0, 0, 0, 0.6); 
        display: flex; 
        align-items: center; 
        justify-content: center; 
        z-index: 9999;
        opacity: 0;
        transition: opacity 0.3s ease;">
        <div style="
            background: #fff; 
            border-radius: 15px; 
            padding: 40px; 
            max-width: 450px; 
            width: 100%;
            text-align: center; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transform: scale(0.7);
            transition: all 0.3s ease;">
            <div style="
                width: 120px; 
                height: 120px; 
                background: linear-gradient(135deg, #06bbcc 0%, #0ac2d4 100%); 
                border-radius: 50%; 
                margin: 0 auto 25px;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 10px 20px rgba(6, 187, 204, 0.3);">
                <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" viewBox="0 0 24 24" fill="none"
                    stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
            </div>
            <h2 style="color: #06bbcc; margin-bottom: 15px; font-size: 1.8rem;">Login Successful</h2>
            <p style="color: #6c757d; margin-bottom: 25px;">Welcome back! You will be redirected to your dashboard.</p>
            <div style="
                background: #f0f9ff; 
                padding: 15px; 
                border-radius: 10px;
                border: 1px solid #b8e4ff;">
                <small style="color: #06bbcc;">Redirecting in 1 second...</small>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('successModal');

            // Trigger reflow to enable transition
            modal.offsetHeight;

            // Show modal
            modal.style.opacity = '1';
            modal.querySelector('div').style.transform = 'scale(1)';

            // Redirect after 1 second
            setTimeout(() => {
                <?php if (!empty($redirectUrl)): ?>
                    window.location.href = '<?php echo $redirectUrl; ?>';
                <?php endif; ?>
            }, 1000);
        });
    </script>
<?php endif; ?>

<style>
    /* Custom Login Page Styles */
    .login-page {
        /* background: linear-gradient(135deg, #f5f7fa 0%, #f5f7fa 100%); */
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 50px 0;
    }

    .login-card {
        margin-left: 25px;
        background: white;
        /* border-radius: 15px; */
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.19);
        padding: 40px;
        max-width: 500px;
        width: 100%;
        transition: all 0.3s ease;
    }

    .login-card:hover {
        box-shadow: 0 20px 45px rgba(0, 0, 0, 0.25);
        transform: translateY(-10px);
    }

    .login-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .login-header h2 {
        color: #2c3e50;
        margin-bottom: 10px;
        font-weight: 700;
    }

    .login-header p {
        color: #7f8c8d;
        font-size: 14px;
    }

    .form-group {
        margin-bottom: 20px;
        position: relative;
    }

    .input-wrapper {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #a9a9a9;
        transition: color 0.3s ease;
    }

    .form-control {
        padding-left: 45px;
        padding-right: 45px;
        border: 1.5px solid #e0e0e0;
        /* border-radius: 8px; */
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #06bbcc;
        box-shadow: 0 0 10px rgba(52, 152, 219, 0.2);
    }

    .form-control:focus+.input-icon {
        color: #06bbcc;
    }

    .password-toggle {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #a9a9a9;
        transition: color 0.3s ease;
    }

    .password-toggle:hover {
        color: #06bbcc;
    }

    .forgot-password {
        text-align: right;
        margin-top: 10px;
    }

    .login-btn {
        width: 100%;
        padding: 12px;
        border: none;
        /* border-radius: 8px; */
        transition: all 0.3s ease;
    }

    .login-btn:hover {

        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
    }

    .signup-link {
        text-align: center;
        margin-top: 20px;
        color: #7f8c8d;
    }
</style>

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

    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const icon = passwordInput.nextElementSibling.querySelector('i');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        }
    }

    // Auto-dismiss error messages after 2 seconds
    document.addEventListener('DOMContentLoaded', function () {
        const errorAlerts = document.querySelectorAll('.alert-danger');
        errorAlerts.forEach(alert => {
            setTimeout(() => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 2000);
        });
    });
</script>

<!-- Important: Add FontAwesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<?php include 'includes/footer.php'; ?>