<?php
session_start();  // Start the session
session_unset();  // Unset all session variables
session_destroy();  // Destroy the session
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Center Modal Styles */
        .modal-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0, 0, 0, 0.6);
            z-index: 9999;
        }

        .modal-box {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            max-width: 400px;
            text-align: center;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.5s ease-out;
        }

        .modal-box h4 {
            margin-bottom: 15px;
            font-size: 1.5rem;
            color: #06bbcc;
        }

        .modal-box p {
            color: #333;
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
</head>

<body>
    <!-- Modal Message -->
    <div class="modal-container">
        <div class="modal-box">
            <h4>Logged Out Successfully</h4>
            <p>You have been logged out. Redirecting to the homepage...</p>
            <div class="spinner-border text-primary mt-3" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <!-- JavaScript for Redirect -->
    <script>
        setTimeout(() => {
            window.location.href = "../frontend/index.php"; // Redirect after 2 seconds
        }, 3000);
    </script>
</body>

</html>