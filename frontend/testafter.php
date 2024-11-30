<?php
session_start();
?>
<?php include 'includes/header.php'; ?>

<!-- Career Prediction Results Section -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Prediction Results</h6>
            <h1 class="mb-5">Your Ideal Career Path</h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Results Card -->
                <div class="bg-light p-4 rounded shadow wow fadeInUp" data-wow-delay="0.3s">
                    <h4 class="text-primary text-center mb-4">Congratulations!</h4>
                    <p class="text-center">Based on your input, we have identified the most suitable career role for
                        you. Below are the details of your ideal career path:</p>

                    <!-- Career Role -->
                    <div class="text-center mt-4">
                        <h2 class="text-primary">[Predicted Career Role]</h2>
                        <p class="mt-2 text-muted">This role matches your unique skill set and preferences.</p>
                    </div>

                    <!-- Career Details -->
                    <div class="mt-4">
                        <h5 class="text-primary">Career Highlights</h5>
                        <ul class="list-group">
                            <li class="list-group-item"><strong>Job Description:</strong> [Dynamic Job Description]</li>
                            <li class="list-group-item"><strong>Skills Required:</strong> [Dynamic Skills List]</li>
                            <li class="list-group-item"><strong>Educational Requirements:</strong> [Dynamic Education
                                Details]</li>
                            <li class="list-group-item"><strong>Duties & Responsibilities:</strong> [Dynamic
                                Responsibilities]</li>
                            <li class="list-group-item"><strong>Salary Range:</strong> [Dynamic Salary Details]</li>
                            <li class="list-group-item"><strong>Companies Hiring:</strong> [Dynamic Companies List]</li>
                        </ul>
                    </div>

                    <!-- Action Buttons -->
                    <div class="text-center mt-4">
                        <a href="courses.php" class="btn btn-primary py-2 px-4 me-2">Explore Courses</a>
                        <a href="profile.php" class="btn btn-secondary py-2 px-4">View Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Call-to-Action Section -->
<div class="container-xxl py-5 bg-primary text-white text-center">
    <div class="container">
        <h2 class="mb-4">Keep Learning, Keep Growing!</h2>
        <p class="mb-4">Discover courses and resources to enhance your skills and advance your career.</p>
        <a class="btn btn-light py-3 px-5" href="courses.php">Start Learning</a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>