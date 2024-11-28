<?php
session_start();
include 'includes/header.php';
include '../backend/config.php';

$messageType = "";
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);

    // Validate email
    if (empty($email)) {
        $messageType = "danger";
        $message = "Please enter your email address.";
    } else {
        // Email validation regex
        $emailRegex = '/^[^\s@]+@[^\s@]+\.[^\s@]+$/';
        if (!preg_match($emailRegex, $email)) {
            $messageType = "danger";
            $message = "Please enter a valid email address.";
        } else {
            // Check if email exists
            $sql = "SELECT * FROM users WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                // Assume a function sendResetLink() is defined to send a password reset link
                $resetLink = "reset_link_example.com"; // Generate a real reset link
                sendResetLink($email, $resetLink);

                $messageType = "success";
                $message = "A password reset link has been sent to your email address.";
            } else {
                $messageType = "danger";
                $message = "Email address not found.";
            }

            $stmt->close();
        }
    }

    $conn->close();
}

function sendResetLink($email, $resetLink)
{
    // Placeholder function for sending email
    // Implement actual email sending logic here using mail() or a library like PHPMailer
}
?>

<!-- Reset Password Form -->
<div class="container-xxl py-5 login-page">
    <div class="container">
        <!-- Error/Success Message Container -->
        <?php if (!empty($message)): ?>
            <div class="row justify-content-center mb-4">
                <div class="col-lg-6">
                    <div class="alert alert-<?php echo htmlspecialchars($messageType); ?> alert-dismissible fade show"
                        role="alert">
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
                        <h2 class="text-primary">Reset Password</h2>
                        <p>Enter your email address to reset your password</p>
                    </div>

                    <form action="reset_password.php" method="POST" onsubmit="return validateResetForm()"
                        class="login-form">
                        <div class="form-group">
                            <label for="email" class="form-label">Email Address</label>
                            <div class="input-wrapper">
                                <i class="fas fa-envelope input-icon"></i>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter your email" required
                                    value="<?php echo htmlspecialchars($email ?? ''); ?>">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary login-btn">Send Reset Link</button>

                        <div class="signup-link">
                            <p>Remember your password? <a href="login.php" class="text-primary">Login</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function validateResetForm() {
        const email = document.getElementById('email').value.trim();
        if (email === '') {
            alert('Please enter your email address.');
            return false;
        }
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            alert('Please enter a valid email address.');
            return false;
        }
        return true;
    }

    // Auto-dismiss error/success messages after 3 seconds
    document.addEventListener('DOMContentLoaded', function () {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 3000);
        });
    });
</script>

<style>
    /* Custom Reset Password Page Styles */
    .login-page {
        background: linear-gradient(135deg, #f5f7fa 0%, #f5f7fa 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 50px 0;
    }

    .login-card {
        background: white;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        padding: 40px;
        max-width: 500px;
        width: 100%;
        transition: all 0.3s ease;
    }

    .login-card:hover {
        box-shadow: 0 20px 45px rgba(0, 0, 0, 0.15);
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
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #06bbcc;
        box-shadow: 0 0 10px rgba(52, 152, 219, 0.2);
    }

    .form-control:focus+.input-icon {
        color: #06bbcc;
    }

    .login-btn {
        width: 100%;
        padding: 12px;
        border: none;
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

<?php include 'includes/footer.php'; ?>