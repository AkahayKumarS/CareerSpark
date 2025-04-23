<?php
session_start();
?>
<?php
include 'includes/header.php';
include "chatbot.php";
?>

<!-- About Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <!-- Image Section -->
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                <div class="position-relative h-100">
                    <img class="img-fluid position-absolute w-100 h-100" src="img/about.png" alt="Career Guidance"
                        style="object-fit: cover;">
                </div>
            </div>
            <!-- Content Section -->
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                <h6 class="section-title bg-white text-start text-primary pe-3">About Us</h6>
                <h1 class="mb-4">Welcome to CareerSpark</h1>
                <p class="mb-4">At CareerSpark, we are committed to empowering individuals with the tools and insights
                    they need to make informed career decisions. Our platform uses advanced technology to deliver
                    personalized recommendations tailored to your unique skills and goals.</p>
                <p class="mb-4">Whether you’re a student exploring options or a professional seeking growth, CareerSpark
                    provides the resources and support to bridge the gap to your dream career.</p>
                <div class="row gy-2 gx-4 mb-4">
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Personalized Recommendations
                        </p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Skill Development Tools</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Industry Insights</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Career Roadmap Generation</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Comprehensive Resources</p>
                    </div>
                    <div class="col-sm-6">
                        <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Goal-Oriented Planning</p>
                    </div>
                </div>
                <a class="btn btn-primary py-3 px-5 mt-2" href="courses.php">Explore Courses</a>
            </div>
        </div>
    </div>
</div>
<!-- About End -->

<?php include 'includes/footer.php'; ?>