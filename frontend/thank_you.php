<?php
session_start();
?>
<?php include 'includes/header.php'; ?>

<!-- Thank You Start -->
<div class="container-xxl py-5">
    <div class="container text-center">
        <div class="wow fadeInUp" data-wow-delay="0.1s">
            <h1 class="display-4 text-primary mb-4">Thank You!</h1>
            <p class="fs-5 text-secondary mb-4">Your message has been successfully sent. We appreciate you contacting
                CareerSpark and will get back to you as soon as possible.</p>
            <a href="index.php" class="btn btn-primary py-3 px-5">Return to Home</a>
            <a href="contact.php" class="btn btn-outline-primary py-3 px-5 ms-2">Contact Again</a>
        </div>
        <div class="mt-5">
            <img class="img-fluid" src="img/thank_you.jpg" alt="Thank You" style="max-width: 30%;">
        </div>
    </div>
</div>
<!-- Thank You End -->

<?php include 'includes/footer.php'; ?>