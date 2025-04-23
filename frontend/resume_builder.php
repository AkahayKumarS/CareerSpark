<?php
session_start();
include '../backend/config.php';
include 'includes/header.php';
?>

<!-- Embedded External Page -->
<div class="container-fluid">
    <iframe src="http://localhost:8080/" width="100%" height="560px" style="border:none;"></iframe>
</div>

<?php include 'includes/footer.php'; ?>