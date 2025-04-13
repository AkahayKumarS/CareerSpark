<?php
session_start();
include 'includes/header.php';
?>
<?php
include '../backend/config.php'; // Include database configuration
$message = ""; // Variable to store success or error message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validate passwords match
    if ($password !== $confirm_password) {
        $message = "<div class='alert alert-danger'>Passwords do not match.</div>";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Check if email already exists
        $sql_check = "SELECT * FROM users WHERE email = ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param("s", $email);
        $stmt_check->execute();
        $result = $stmt_check->get_result();

        if ($result->num_rows > 0) {
            $message = "<div class='alert alert-danger'>Email is already registered.</div>";
        } else {
            // Insert user into the database
            $sql_insert = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql_insert);
            $stmt->bind_param("sss", $name, $email, $hashed_password);

            if ($stmt->execute()) {
                $message = "<div class='alert alert-success'>Registration successful! <a href='login.php' class='text-primary'>Login here</a>.</div>";
            } else {
                $message = "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
            }

            $stmt->close();
        }
        $stmt_check->close();
    }

    $conn->close();
}
?>

<!-- Register Start -->
<div class="container-xxl py-5 register-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="register-card">
                    <div class="register-header">
                        <h2 class="text-primary">Create an Account</h2>
                        <p>Join CareerSpark and unlock your professional potential</p>
                    </div>

                    <?php if (!empty($message))
                        echo $message; ?>

                    <form action="register.php" method="POST" onsubmit="return validateRegisterForm()"
                        class="register-form">
                        <div class="form-group">
                            <label for="name" class="form-label">Full Name</label>
                            <div class="input-wrapper">
                                <i class="fas fa-user input-icon"></i>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter your full name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email Address</label>
                            <div class="input-wrapper">
                                <i class="fas fa-envelope input-icon"></i>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Enter your email" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-wrapper">
                                <i class="fas fa-lock input-icon"></i>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="Create a password" required>
                                <span class="password-toggle" onclick="togglePasswordVisibility('password')">
                                    <i class="fas fa-eye-slash"></i>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <div class="input-wrapper">
                                <i class="fas fa-lock input-icon"></i>
                                <input type="password" class="form-control" id="confirm_password"
                                    name="confirm_password" placeholder="Re-enter your password" required>
                                <span class="password-toggle" onclick="togglePasswordVisibility('confirm_password')">
                                    <i class="fas fa-eye-slash"></i>
                                </span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary register-btn">Register</button>
                        <p class="login-link">Already have an account? <a href="login.php"
                                class="text-primary">Login</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Register End -->

<!-- Success Modal -->
<div id="successModal" class="modal hidden">
    <div class="modal-content">
        <div class="icon-circle">
            <i class="check-icon">✔</i>
        </div>
        <h2>Thank You!</h2>
        <p>Your account has been successfully created. You can now log in to CareerSpark.</p>
        <button id="okButton" class="btn btn-success">OK</button>
    </div>
</div>

<!-- Modal Styles -->
<style>
    /* Modal Container */
    .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        background: rgba(0, 0, 0, 0.5);
        z-index: 9999;
    }

    .hidden {
        display: none;
    }

    /* Modal Content */
    .modal-content {
        width: 40%;
        background: #ffffff;
        padding: 30px 20px;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        text-align: center;
        animation: slideDown 0.6s ease-out, grow 0.3s ease-in 0.6s;
    }

    /* Icon Circle */
    .icon-circle {
        background: #28a745;
        width: 60px;
        height: 60px;
        margin: 0 auto 20px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .check-icon {
        color: #fff;
        font-size: 24px;
        font-weight: bold;
    }

    /* Text */
    h2 {
        color: #333;
        font-size: 24px;
        margin-bottom: 10px;
    }

    p {
        /* color: #666; */
        font-size: 16px;
        margin-bottom: 20px;
    }

    /* Button */
    .btn-success {
        background: #28a745;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    .btn-success:hover {
        background: #218838;
    }

    /* Animations */
    @keyframes slideDown {
        from {
            transform: translateY(-100px);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    @keyframes grow {
        from {
            transform: scale(0.8);
        }

        to {
            transform: scale(1);
        }
    }
</style>

<style>
    /* Custom Registration Page Styles */
    .register-page {
        /* background: linear-gradient(135deg, #f5f7fa 0%, #f5f7fa 100%); */
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 50px 0;
    }

    .register-card {
        background: white;
        /* border-radius: 15px; */
        margin-left: 25px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.19);
        padding: 40px;
        max-width: 500px;
        width: 100%;
        transition: all 0.3s ease;
    }

    .register-card:hover {
        box-shadow: 0 20px 45px rgba(0, 0, 0, 0.25);
        transform: translateY(-10px);
    }

    .register-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .register-header h2 {
        color: #2c3e50;
        margin-bottom: 10px;
        font-weight: 700;
    }

    .register-header p {
        color: #7f8c8d;
        font-size: 14px;
    }

    .form-group {
        margin-bottom: 20px;
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
        border: 1.5px solid #e0e0e0;
        /* border-radius: 8px; */
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #3498db;
        box-shadow: 0 0 10px rgba(52, 152, 219, 0.2);
    }

    .form-control:focus+.input-icon {
        color: #3498db;
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
        color: #3498db;
    }

    .register-btn {
        width: 100%;
        padding: 12px;
        border: none;
        /* border-radius: 8px; */
        transition: all 0.3s ease;
    }

    .register-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
    }

    .login-link {
        text-align: center;
        margin-top: 20px;
        color: #7f8c8d;
    }
</style>

<script>
    function validateRegisterForm() {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm_password').value;
        if (password !== confirmPassword) {
            alert('Passwords do not match.');
            return false;
        }
        return true;
    }

    function togglePasswordVisibility(inputId) {
        const passwordInput = document.getElementById(inputId);
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

    // Show the modal on success
    function showSuccessModal() {
        const modal = document.getElementById('successModal');
        modal.classList.remove('hidden');
    }

    // Redirect to login page on button click
    document.getElementById('okButton').addEventListener('click', function () {
        window.location.href = 'login.php';
    });

    // Simulate success modal after successful registration
    <?php if (!empty($message) && strpos($message, 'Registration successful!') !== false): ?>
        showSuccessModal();
    <?php endif; ?>
</script>

<!-- Important: Add FontAwesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<?php include 'includes/footer.php'; ?>