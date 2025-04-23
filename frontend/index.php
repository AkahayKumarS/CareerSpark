<?php
session_start();
include 'includes/header.php';
include '../backend/config.php';
include "chatbot.php";
?>

<!DOCTYPE html>
<html lang="en">
<!-- Carousel Start -->
<div class="container-fluid p-0 mb-5">
    <div class="owl-carousel header-carousel position-relative">
        <!-- Slide 1 -->
        <div class="owl-carousel-item position-relative">
            <img class="img-fluid" src="img/slider-1.jpg" alt="Empowering Career Choices">
            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                style="background: rgba(24, 29, 56, .7);">
                <div class="container">
                    <div class="row justify-content-start">
                        <div class="col-sm-10 col-lg-8">
                            <h5 class="text-primary text-uppercase mb-3 animated slideInDown">Empowering Career Choices
                            </h5>
                            <h1 class="display-3 text-white animated slideInDown">Find Your Path to Success</h1>
                            <p class="fs-5 text-white mb-4 pb-2">Discover careers that align with your skills,
                                interests, and aspirations. CareerSpark provides personalized guidance to help you
                                achieve your dreams.</p>
                            <a href="about.php" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Learn
                                More</a>
                            <a href="register.php" class="btn btn-light py-md-3 px-md-5 animated slideInRight">Get
                                Started</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Slide 2 -->
        <div class="owl-carousel-item position-relative">
            <img class="img-fluid" src="img/slider-2.jpg" alt="Personalized Recommendations">
            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                style="background: rgba(24, 29, 56, .7);">
                <div class="container">
                    <div class="row justify-content-start">
                        <div class="col-sm-10 col-lg-8">
                            <h5 class="text-primary text-uppercase mb-3 animated slideInDown">Personalized
                                Recommendations</h5>
                            <h1 class="display-3 text-white animated slideInDown">Explore Your Future</h1>
                            <p class="fs-5 text-white mb-4 pb-2">Get tailored career suggestions and resources designed
                                just for you. CareerSpark guides you every step of the way.</p>
                            <a href="knowledgeNetwork.php"
                                class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Explore Careers</a>
                            <a href="register.php" class="btn btn-light py-md-3 px-md-5 animated slideInRight">Join
                                Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Carousel End -->

<?php include 'services.php'; ?>


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



<!-- Courses Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Courses</h6>
            <h1 class="mb-5">
                <?php
                // Display category title if selected
                echo isset($_GET['category'])
                    ? htmlspecialchars($_GET['category']) . " Courses"
                    : "Latest Courses";
                ?>
            </h1>
        </div>
        <div class="row g-4 justify-content-center">
            <?php
            // Fetch courses from the database
            if (isset($_GET['category']) && !empty($_GET['category'])) {
                $sql = "SELECT * FROM courses WHERE category = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $_GET['category']);
            } else {
                // For popular courses, limit to last 3 courses
                $sql = "SELECT * FROM courses ORDER BY id DESC LIMIT 3";
                $stmt = $conn->prepare($sql);
            }
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0):
                while ($course = $result->fetch_assoc()): ?>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="course-item bg-light shadow-sm rounded overflow-hidden">
                            <div class="position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="<?php echo htmlspecialchars($course['course_image']); ?>"
                                    alt="<?php echo htmlspecialchars($course['title']); ?>">
                                <div class="course-overlay position-absolute top-0 start-0 w-100 h-100 d-flex flex-column">
                                    <div class="course-badge d-flex justify-content-between p-3">
                                        <span
                                            class="badge <?php echo $course['is_premium'] ? 'bg-warning text-dark' : 'bg-info text-white'; ?> d-flex align-items-center">
                                            <?php echo $course['is_premium'] ?
                                                '<i class="fas fa-crown me-2"></i>Premium' :
                                                '<i class="fas fa-tag me-2"></i>Free'; ?>
                                        </span>
                                        <span class="badge bg-light text-dark d-flex align-items-center">
                                            <i class="fas fa-university me-2"></i>
                                            <?php echo htmlspecialchars($course['course_provider']); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center p-4 pb-0">
                                <h5 class="mb-3"><?php echo htmlspecialchars($course['title']); ?></h5>
                                <div class="mb-3 d-flex justify-content-center align-items-center">
                                    <span class="badge bg-light text-dark me-2">
                                        <i class="fas fa-book-open me-1"></i>
                                        <?php echo htmlspecialchars($course['category']); ?>
                                    </span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center p-4 pt-0">
                                <a href="<?php echo htmlspecialchars($course['course_link']); ?>" target="_blank"
                                    class="btn btn-primary px-3 py-2 d-flex align-items-center">
                                    <i class="fas fa-external-link-alt me-2"></i>
                                    Read More
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endwhile;
            else: ?>
                <p class="text-center">No courses available in this category.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<!-- Courses End -->

<!-- Add custom CSS for improved course card design -->
<style>
    .course-item {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .course-item:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    }

    .course-overlay {
        opacity: 0;
        transition: opacity 0.3s ease;
        background: rgba(0, 0, 0, 0.1);
    }

    .course-item:hover .course-overlay {
        opacity: 1;
    }

    .course-badge {
        z-index: 10;
    }

    .course-badge .badge {
        font-size: 0.8rem;
        font-weight: 500;
    }
</style>

<!-- Contact Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Contact Us</h6>
            <h1 class="mb-5">Contact For Any Query</h1>
        </div>
        <div class="row g-4">
            <!-- Contact Information -->
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <h5>Get In Touch</h5>
                <p class="mb-4">Reach out to us for any career guidance, platform-related queries, or feedback. We’re
                    here to help you spark your career growth.</p>
                <div class="d-flex align-items-center mb-3">
                    <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary"
                        style="width: 50px; height: 50px;">
                        <i class="fa fa-map-marker-alt text-white"></i>
                    </div>
                    <div class="ms-3">
                        <h5 class="text-primary">Office</h5>
                        <p class="mb-0">SJEC, Mangaluru</p>
                    </div>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary"
                        style="width: 50px; height: 50px;">
                        <i class="fa fa-phone-alt text-white"></i>
                    </div>
                    <div class="ms-3">
                        <h5 class="text-primary">Mobile</h5>
                        <p class="mb-0">+91 9108083054</p>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary"
                        style="width: 50px; height: 50px;">
                        <i class="fa fa-envelope-open text-white"></i>
                    </div>
                    <div class="ms-3">
                        <h5 class="text-primary">Email</h5>
                        <p class="mb-0">support@careerspark.com</p>
                    </div>
                </div>
            </div>

            <!-- Embedded Google Map -->
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <iframe class="position-relative rounded w-100 h-100"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5499.7789157950065!2d74.8996629940445!3d12.912158437121906!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ba359dfac132663%3A0xa7bf228838232d32!2sSt%20Joseph%20Engineering%20College!5e0!3m2!1sen!2sin!4v1732514007358!5m2!1sen!2sin"
                    frameborder="0" style="min-height: 300px; border:0;" allowfullscreen="" aria-hidden="false"
                    tabindex="0"></iframe>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-4 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                <form action="contact.php" method="POST">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Your Name"
                                    required>
                                <label for="name">Your Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Your Email" required>
                                <label for="email">Your Email</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="subject" name="subject"
                                    placeholder="Subject" required>
                                <label for="subject">Subject</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a message here" id="message"
                                    name="message" style="height: 150px" required></textarea>
                                <label for="message">Message</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-100 py-3" type="submit">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->

<!-- Include Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<?php include 'includes/footer.php'; ?>