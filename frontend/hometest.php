<?php
session_start();
?>
<?php include 'includes/header.php'; ?>

<!-- Hero Section Start -->
<div class="container-xxl pt-5 hero-section">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Career Prediction</h6>
            <h1 class="mb-5">Discover Your Ideal Career Path</h1>
        </div>
    </div>
</div>
<!-- Hero Section End -->

<!-- Form Section Start -->
<div class="container-xxl pb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form action="testapp.py" method="POST" class="bg-light p-4 rounded shadow wow fadeInUp"
                    data-wow-delay="0.3s">
                    <h4 class="text-primary text-center mb-4">Enter Your Skills</h4>

                    <!-- Skills Input -->
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="database" class="form-label">Database Fundamentals</label>
                            <input type="number" id="database" name="database" class="form-control"
                                placeholder="0 to 10" min="0" max="10" required>
                        </div>
                        <div class="col-md-6">
                            <label for="architecture" class="form-label">Computer Architecture</label>
                            <input type="number" id="architecture" name="architecture" class="form-control"
                                placeholder="0 to 10" min="0" max="10" required>
                        </div>
                        <div class="col-md-6">
                            <label for="networking" class="form-label">Networking</label>
                            <input type="number" id="networking" name="networking" class="form-control"
                                placeholder="0 to 10" min="0" max="10" required>
                        </div>
                        <div class="col-md-6">
                            <label for="development" class="form-label">Development</label>
                            <input type="number" id="development" name="development" class="form-control"
                                placeholder="0 to 10" min="0" max="10" required>
                        </div>
                        <div class="col-md-6">
                            <label for="cyber" class="form-label">Cyber Security</label>
                            <input type="number" id="cyber" name="cyber" class="form-control" placeholder="0 to 10"
                                min="0" max="10" required>
                        </div>
                        <div class="col-md-6">
                            <label for="ai" class="form-label">AI & Machine Learning</label>
                            <input type="number" id="ai" name="ai" class="form-control" placeholder="0 to 10" min="0"
                                max="10" required>
                        </div>
                        <div class="col-md-6">
                            <label for="graphics" class="form-label">Graphics Designing</label>
                            <input type="number" id="graphics" name="graphics" class="form-control"
                                placeholder="0 to 10" min="0" max="10" required>
                        </div>
                        <div class="col-md-6">
                            <label for="data_science" class="form-label">Data Science</label>
                            <input type="number" id="data_science" name="data_science" class="form-control"
                                placeholder="0 to 10" min="0" max="10" required>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary py-2 px-5">Predict Career</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Form Section End -->

<?php include 'includes/footer.php'; ?>