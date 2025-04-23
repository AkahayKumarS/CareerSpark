<?php
session_start();
include '../backend/config.php'; // Include database connection
include 'includes/header.php';
include "chatbot.php";

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch the current user ID
$user_id = $_SESSION['user_id'];

// Define the $isEditing variable based on URL query parameter
$isEditing = isset($_GET['edit']) && $_GET['edit'] === 'true';
$isProfileDataAvailable = false;

// Handle Form Submission for Profile Update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bio = trim($_POST['bio']);
    $address = trim($_POST['address']);
    $college = trim($_POST['college']);
    $highest_qualification = trim($_POST['highest_qualification']);
    $github_profile = trim($_POST['github_profile']);
    $linkedin_profile = trim($_POST['linkedin_profile']);
    $technical_skills = trim($_POST['technical_skills']);
    $hobbies = trim($_POST['hobbies']);

    // Handle profile picture upload
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../uploads/profile_pictures/';
        $filename = basename($_FILES['profile_picture']['name']);
        $target_file = $upload_dir . $filename;

        // Move the uploaded file to the uploads directory
        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_file)) {
            $profile_picture = $target_file;
        } else {
            $profile_picture = null;
        }
    } else {
        $profile_picture = null;
    }

    // Check if the profile already exists
    $sql_check = "SELECT * FROM student_profiles WHERE user_id = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("i", $user_id);
    $stmt_check->execute();
    $result = $stmt_check->get_result();

    if ($result->num_rows > 0) {
        // Update the existing profile
        $sql_update = "UPDATE student_profiles SET bio = ?, profile_picture = IFNULL(?, profile_picture), address = ?, college = ?, highest_qualification = ?, github_profile = ?, linkedin_profile = ?, technical_skills = ?, hobbies = ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql_update);
        $stmt->bind_param("sssssssssi", $bio, $profile_picture, $address, $college, $highest_qualification, $github_profile, $linkedin_profile, $technical_skills, $hobbies, $user_id);
    } else {
        // Insert a new profile
        $sql_insert = "INSERT INTO student_profiles (user_id, bio, profile_picture, address, college, highest_qualification, github_profile, linkedin_profile, technical_skills, hobbies) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql_insert);
        $stmt->bind_param("isssssssss", $user_id, $bio, $profile_picture, $address, $college, $highest_qualification, $github_profile, $linkedin_profile, $technical_skills, $hobbies);
    }

    if ($stmt->execute()) {
        echo "<div class='alert alert-success text-center alert-dismissible fade show' id='success-message' role='alert'>
                Profile updated successfully!
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
        $isProfileDataAvailable = true;
    } else {
        echo "<div class='alert alert-danger text-center alert-dismissible fade show' id='error-message' role='alert'>
                Error updating profile: " . $stmt->error . "
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    }
}

// Fetch the student profile data
$sql_fetch = "SELECT u.name, sp.* FROM users u LEFT JOIN student_profiles sp ON u.id = sp.user_id WHERE u.id = ?";
$stmt_fetch = $conn->prepare($sql_fetch);
$stmt_fetch->bind_param("i", $user_id);
$stmt_fetch->execute();
$profile = $stmt_fetch->get_result()->fetch_assoc();
?>

<!-- Profile Page -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <form action="profile.php" method="POST" enctype="multipart/form-data" class="profile-card bg-white shadow-lg rounded-4 p-5" id="profile-form">
                <!-- Profile Picture and Name Section -->
                <div class="row mb-4 align-items-center">
                    <div class="col-md-4 text-center">
                        <div class="position-relative profile-picture-container">
                            <?php if (!empty($profile['profile_picture'])): ?>
                                <img src="<?php echo $profile['profile_picture']; ?>" alt="Profile Picture" 
                                     class="img-fluid profile-picture shadow-sm" 
                                     style="width: 170px; height: 210px; object-fit: cover; border-radius: 50% / 40%;">
                            <?php else: ?>
                                <img src="../uploads/profile_pictures/defaultpfp.jpeg" alt="Default Picture" 
                                     class="img-fluid profile-picture shadow-sm" 
                                     style="width: 170px; height: 210px; object-fit: cover; border-radius: 50% / 40%;">
                            <?php endif; ?>
                            
                            <?php if ($isEditing): ?>
                                <label class="profile-picture-edit btn btn-primary btn-sm position-absolute bottom-0 end-0 m-2">
                                    <i class="bi bi-camera-fill"></i>
                                    <input type="file" name="profile_picture" class="d-none" accept="image/*">
                                </label>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="col-md-8">
                        <h2 class="mb-3 text-primary"><?php echo htmlspecialchars($profile['name'] ?? 'Student Name'); ?></h2>
                        
                        <!-- Bio Section -->
                        <div class="mb-3">
                            <label for="bio" class="form-label">
                                <i class="bi bi-person-lines-fill me-2 text-primary"></i>Bio
                            </label>
                            <?php echo $isEditing
                                ? "<textarea name='bio' id='bio' class='form-control' rows='3'>" . htmlspecialchars($profile['bio'] ?? '') . "</textarea>"
                                : "<div class='bg-light p-2 rounded'>" . htmlspecialchars($profile['bio'] ?? 'No bio available') . "</div>"; ?>
                        </div>
                    </div>
                </div>

                <!-- Profile Details Grid -->
                <div class="row g-4">
                    <?php 
                    $profile_fields = [
                        ['name' => 'address', 'icon' => 'bi-geo-alt-fill', 'label' => 'Address'],
                        ['name' => 'college', 'icon' => 'bi-building', 'label' => 'College'],
                        ['name' => 'highest_qualification', 'icon' => 'bi-award', 'label' => 'Highest Qualification'],
                        ['name' => 'technical_skills', 'icon' => 'bi-tools', 'label' => 'Technical Skills', 'type' => 'textarea']
                    ];

                    $profile_links = [
                        ['name' => 'github_profile', 'icon' => 'bi-github', 'label' => 'GitHub Profile'],
                        ['name' => 'linkedin_profile', 'icon' => 'bi-linkedin', 'label' => 'LinkedIn Profile']
                    ];

                    foreach ($profile_fields as $field): 
                    ?>
                    <div class="col-md-6">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body">
                                <h6 class="card-title">
                                    <i class="bi <?php echo $field['icon']; ?> me-2 text-primary"></i>
                                    <?php echo $field['label']; ?>
                                </h6>
                                <?php 
                                $field_type = $field['type'] ?? 'input';
                                $value = $profile[$field['name']] ?? '';
                                
                                if ($isEditing) {
                                    echo $field_type === 'textarea' 
                                        ? "<textarea name='{$field['name']}' class='form-control'>" . htmlspecialchars($value) . "</textarea>"
                                        : "<input type='text' name='{$field['name']}' class='form-control' value='" . htmlspecialchars($value) . "'>";
                                } else {
                                    echo "<div class='bg-light p-2 rounded'>" . 
                                        (empty($value) ? 'Not specified' : htmlspecialchars($value)) . 
                                        "</div>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>

                    <!-- GitHub and LinkedIn Profiles Side by Side -->
                    <div class="col-md-6">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body">
                                <h6 class="card-title">
                                    <i class="bi bi-github me-2 text-primary"></i>
                                    GitHub Profile
                                </h6>
                                <?php 
                                $github_value = $profile['github_profile'] ?? '';
                                
                                if ($isEditing) {
                                    echo "<input type='url' name='github_profile' class='form-control' value='" . htmlspecialchars($github_value) . "'>";
                                } else {
                                    echo empty($github_value) 
                                        ? "<div class='bg-light p-2 rounded'>Not specified</div>"
                                        : "<a href='" . htmlspecialchars($github_value) . "' target='_blank' class='btn btn-outline-primary w-100'>" . 
                                          "<i class='bi bi-github me-2'></i>View Profile</a>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body">
                                <h6 class="card-title">
                                    <i class="bi bi-linkedin me-2 text-primary"></i>
                                    LinkedIn Profile
                                </h6>
                                <?php 
                                $linkedin_value = $profile['linkedin_profile'] ?? '';
                                
                                if ($isEditing) {
                                    echo "<input type='url' name='linkedin_profile' class='form-control' value='" . htmlspecialchars($linkedin_value) . "'>";
                                } else {
                                    echo empty($linkedin_value) 
                                        ? "<div class='bg-light p-2 rounded'>Not specified</div>"
                                        : "<a href='" . htmlspecialchars($linkedin_value) . "' target='_blank' class='btn btn-outline-primary w-100'>" . 
                                          "<i class='bi bi-linkedin me-2'></i>View Profile</a>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <!-- Hobbies Section (Moved to the last) -->
                    <div class="col-md-12">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <h6 class="card-title">
                                    <i class="bi bi-heart-fill me-2 text-primary"></i>
                                    Hobbies
                                </h6>
                                <?php 
                                $hobbies_value = $profile['hobbies'] ?? '';
                                
                                if ($isEditing) {
                                    echo "<textarea name='hobbies' class='form-control'>" . htmlspecialchars($hobbies_value) . "</textarea>";
                                } else {
                                    echo "<div class='bg-light p-2 rounded'>" . 
                                        (empty($hobbies_value) ? 'Not specified' : htmlspecialchars($hobbies_value)) . 
                                        "</div>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="text-center mt-4">
                    <?php if ($isEditing): ?>
                        <button type="submit" class="btn btn-primary btn-lg px-5 py-2">
                            <i class="bi bi-save me-2"></i>Save Changes
                        </button>
                        <a href="profile.php" class="btn btn-outline-secondary btn-lg ms-3 px-5 py-2">
                            <i class="bi bi-x-circle me-2"></i>Cancel
                        </a>
                    <?php else: ?>
                        <a href="profile.php?edit=true" class="btn btn-primary btn-lg px-5 py-2">
                            <i class="bi bi-pencil me-2"></i>Edit Profile
                        </a>
                    <?php endif; ?>
                     <!-- Resume Generation Button -->
                     <!-- <button type="button" id="generate-resume" class="btn btn-success btn-lg ms-3 px-5 py-2">
    <i class="bi bi-file-earmark-pdf me-2"></i> Create Resume
</button> -->

                </div>
            </form>
        </div>
    </div>
</div>
<!-- Resume Preview Modal -->
<div class="modal fade" id="resumePreviewModal" tabindex="-1" aria-labelledby="resumePreviewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resumePreviewModalLabel">Resume Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="resume-preview"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="download-resume">Download Resume</button>
            </div>
        </div>
    </div>
</div>

<style>

.profile-picture-container {
    position: relative;
}

.profile-picture-edit {
    background-color: rgba(0,123,255,0.8);
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.profile-picture {
    transition: transform 0.3s ease;
}

.profile-picture:hover {
    transform: scale(1.05);
}
</style>

<!-- Include jsPDF library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
    // Handle profile picture preview
    document.querySelector('input[name="profile_picture"]')?.addEventListener('change', function(event) {
        const file = event.target.files[0];
        const reader = new FileReader();
        
        reader.onload = function(e) {
            document.querySelector('.profile-picture').src = e.target.result;
        }
        
        reader.readAsDataURL(file);
    });

    // Remove alert after 3 seconds
    setTimeout(() => {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => alert.remove());
    }, 2000);

    // Add event listener for the "Generate Resume" button click
document.getElementById('generate-resume').addEventListener('click', function() {
    // Navigate to the 'resume_builder' page
    window.location.href = 'resume_builder.php';  // Replace with your desired path
});


    // Handle resume download
    document.getElementById('download-resume').addEventListener('click', function() {
        const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Collect profile data
    const name = "<?php echo htmlspecialchars($profile['name'] ?? 'Student Name'); ?>";
    const bio = "<?php echo htmlspecialchars($profile['bio'] ?? 'No bio available'); ?>";
    const address = "<?php echo htmlspecialchars($profile['address'] ?? 'Not specified'); ?>";
    const college = "<?php echo htmlspecialchars($profile['college'] ?? 'Not specified'); ?>";
    const highestQualification = "<?php echo htmlspecialchars($profile['highest_qualification'] ?? 'Not specified'); ?>";
    const technicalSkills = "<?php echo htmlspecialchars($profile['technical_skills'] ?? 'Not specified'); ?>";
    const hobbies = "<?php echo htmlspecialchars($profile['hobbies'] ?? 'Not specified'); ?>";
    const github = "<?php echo htmlspecialchars($profile['github_profile'] ?? 'Not specified'); ?>";
    const linkedin = "<?php echo htmlspecialchars($profile['linkedin_profile'] ?? 'Not specified'); ?>";

    // Create PDF content
    doc.setFontSize(22);
    doc.text(name, 20, 20);

    doc.setFontSize(14);
    doc.text("Bio: " + bio, 20, 40);
    doc.text("Address: " + address, 20, 50);
    doc.text("College: " + college, 20, 60);
    doc.text("Highest Qualification: " + highestQualification, 20, 70);
    doc.text("Technical Skills: " + technicalSkills, 20, 80);
    doc.text("Hobbies: " + hobbies, 20, 90);

    if (github) {
        doc.text("GitHub: " + github, 20, 100);
    }
    if (linkedin) {
        doc.text("LinkedIn: " + linkedin, 20, 110);
    }
        doc.save(`${name}_Resume.pdf`);
    });
</script>
<?php include 'includes/footer.php'; ?>