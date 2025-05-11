<?php
session_start();  // Start the session
session_unset();  // Unset all session variables
session_destroy();  // Destroy the session
setcookie("user_id", "", time() - 10800, "/");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>

    <!-- Favicon -->
    <link href="../frontend/img/CareerSparkFavicon.png" rel="icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div id="logoutModal" style="
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
                background: linear-gradient(135deg, #06BBCC 0%, #0ac2d4 100%); 
                border-radius: 50%; 
                margin: 0 auto 25px;
                display: flex;
                align-items: center;
                justify-content: center;
                box-shadow: 0 10px 20px rgba(6, 187, 204, 0.3);">
                <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" viewBox="0 0 24 24" fill="none"
                    stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 17l5-5-5-5M19 12l-9 0M10 17H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h4" />
                </svg>
            </div>
            <h2 style="color: #06BBCC; margin-bottom: 15px; font-size: 1.8rem;">Logout Successful</h2>
            <p style="color: #6c757d; margin-bottom: 25px;">You have been successfully logged out. See you soon!</p>
            <div style="
                background: #f0f9ff; 
                padding: 15px; 
                border-radius: 10px;
                border: 1px solid #b8e4ff;">
                <small style="color: #06BBCC;">Redirecting in 3 seconds...</small>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('logoutModal');

            // Trigger reflow to enable transition
            modal.offsetHeight;

            // Show modal
            modal.style.opacity = '1';
            modal.querySelector('div').style.transform = 'scale(1)';

            // Redirect after 3 seconds
            setTimeout(() => {
                window.location.href = "../frontend/index.php";
            }, 3000);
        });
    </script>
</body>

</html>