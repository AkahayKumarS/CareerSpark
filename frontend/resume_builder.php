<?php
session_start();
include '../backend/config.php';
include 'includes/header.php';
?>

<!-- Status Tracking Navigation -->
<div class="container-fluid py-2 bg-light border-bottom">
    <div class="container">
        <ul class="nav nav-pills nav-fill status-tracker">
            <li class="nav-item">
                <button class="nav-link active" data-section="personal">
                    <i class="fas fa-user"></i> Personal
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-section="education">
                    <i class="fas fa-graduation-cap"></i> Education
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-section="experience">
                    <i class="fas fa-briefcase"></i> Experience
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-section="skills">
                    <i class="fas fa-tools"></i> Skills
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-section="preview">
                    <i class="fas fa-eye"></i> Preview
                </button>
            </li>
        </ul>
    </div>
</div>

<div class="container-fluid py-5">
    <div class="row">
        <!-- Left Sidebar - Forms -->
        <div class="col-lg-3">
            <!-- Status Navigation -->
            <div class="card mb-3">
                <div class="card-body p-2">
                    <div class="nav flex-column nav-pills status-tracker">
                        <button class="nav-link active mb-2" data-section="personal">
                            <i class="fas fa-user"></i> Personal Information
                        </button>
                        <button class="nav-link mb-2" data-section="education">
                            <i class="fas fa-graduation-cap"></i> Education
                        </button>
                        <button class="nav-link mb-2" data-section="experience">
                            <i class="fas fa-briefcase"></i> Experience
                        </button>
                        <button class="nav-link mb-2" data-section="skills">
                            <i class="fas fa-tools"></i> Skills
                        </button>
                        <button class="nav-link mb-2" data-section="custom">
                            <i class="fas fa-plus-circle"></i> Add Custom Section
                        </button>
                    </div>
                </div>
            </div>

            <!-- Form Sections Container -->
            <div class="form-sections mb-4">
                <!-- Personal Information Section -->
                <div class="section active" id="personal-section">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Personal Information</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="fullName" name="personal[fullName]">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="personal[email]">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Phone</label>
                                    <input type="tel" class="form-control" id="phone" name="personal[phone]">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Location</label>
                                    <input type="text" class="form-control" id="location" name="personal[location]">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Professional Summary</label>
                                    <textarea class="form-control" id="summary" name="personal[summary]" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary float-end" onclick="nextSection('personal', 'education')">
                                Next <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Education Section -->
                <div class="section" id="education-section" style="display: none;">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Education</h5>
                            <div id="education-entries">
                                <div class="education-entry mb-3">
                                    <input type="text" class="form-control mb-2" placeholder="Degree/Course">
                                    <input type="text" class="form-control mb-2" placeholder="Institution">
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="text" class="form-control" placeholder="Start Year">
                                        </div>
                                        <div class="col-6">
                                            <input type="text" class="form-control" placeholder="End Year">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex gap-2 mb-3">
                                <button class="btn btn-outline-primary btn-sm" onclick="addEducationEntry()">
                                    <i class="fas fa-plus"></i> Add Education
                                </button>
                                <button class="btn btn-outline-danger btn-sm" onclick="removeLastEntry('education-entries')">
                                    <i class="fas fa-trash"></i> Remove Last
                                </button>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <button class="btn btn-secondary" onclick="prevSection('education', 'personal')">
                                <i class="fas fa-arrow-left"></i> Previous
                            </button>
                            <button class="btn btn-primary" onclick="nextSection('education', 'experience')">
                                Next <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Experience Section -->
                <div class="section" id="experience-section" style="display: none;">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Experience</h5>
                            <div id="experience-entries">
                                <div class="experience-entry mb-3">
                                    <input type="text" class="form-control mb-2" placeholder="Job Title">
                                    <input type="text" class="form-control mb-2" placeholder="Company">
                                    <textarea class="form-control mb-2" placeholder="Job Description"></textarea>
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="text" class="form-control" placeholder="Start Date">
                                        </div>
                                        <div class="col-6">
                                            <input type="text" class="form-control" placeholder="End Date">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-outline-primary btn-sm" onclick="addExperienceEntry()">
                                <i class="fas fa-plus"></i> Add Experience
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Skills Section -->
                <div class="section" id="skills-section" style="display: none;">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Skills</h5>
                            <div id="skills-container">
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" placeholder="Add a skill">
                                    <button class="btn btn-outline-primary" onclick="addSkill(this)">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <div class="skills-list">
                                    <!-- Skills will be added here -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Center - Resume Preview -->
        <div class="col-lg-6">
            <div class="resume-preview-wrapper">
                <div class="preview-actions mb-3">
                    <button class="btn btn-primary me-2" onclick="previewResume()">
                        <i class="fas fa-eye"></i> Preview
                    </button>
                    <button class="btn btn-secondary" id="download-resume">
                        <i class="fas fa-download"></i> Download resume
                    </button>
                </div>
                <div id="resume-preview" class="bg-white p-4">
                    <!-- Preview content -->
                </div>
            </div>
        </div>

        <!-- Right Sidebar - Customization -->
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header p-0">
                    <ul class="nav nav-tabs nav-fill" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#templates-tab">
                                <i class="fas fa-file-alt"></i> Templates
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#customize-tab">
                                <i class="fas fa-paint-brush"></i> Customize
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <!-- Templates Tab -->
                        <div class="tab-pane fade show active" id="templates-tab">
                            <div class="template-grid">
                                <div class="template-item" data-template="modern">
                                    <div class="template-preview">
                                        <img src="assets/img/templates/modern.png" alt="Modern Template">
                                        <div class="template-overlay">
                                            <button class="btn btn-sm btn-light">Select</button>
                                        </div>
                                    </div>
                                    <span>Modern</span>
                                </div>
                                <div class="template-item" data-template="classic">
                                    <div class="template-preview">
                                        <img src="assets/img/templates/classic.png" alt="Classic Template">
                                        <div class="template-overlay">
                                            <button class="btn btn-sm btn-light">Select</button>
                                        </div>
                                    </div>
                                    <span>Classic</span>
                                </div>
                                <div class="template-item" data-template="creative">
                                    <div class="template-preview">
                                        <img src="assets/img/templates/creative.png" alt="Creative Template">
                                        <div class="template-overlay">
                                            <button class="btn btn-sm btn-light">Select</button>
                                        </div>
                                    </div>
                                    <span>Creative</span>
                                </div>
                            </div>
                        </div>

                        <!-- Customize Tab -->
                        <div class="tab-pane fade" id="customize-tab">
                            <!-- Font Settings -->
                            <div class="mb-3">
                                <label class="form-label">Font Family</label>
                                <select class="form-select form-select-sm" id="font-family">
                                    <option value="Roboto">Roboto</option>
                                    <option value="Open Sans">Open Sans</option>
                                    <option value="Lato">Lato</option>
                                </select>
                            </div>

                            <!-- Color Scheme -->
                            <div class="mb-3">
                                <label class="form-label">Color Scheme</label>
                                <div class="color-swatches d-flex gap-2 mb-2">
                                    <button class="color-swatch" style="background: #2bc5d4" onclick="setColor('#2bc5d4')"></button>
                                    <button class="color-swatch" style="background: #1a97a3" onclick="setColor('#1a97a3')"></button>
                                    <button class="color-swatch" style="background: #f0fbfc" onclick="setColor('#f0fbfc')"></button>
                                </div>
                                <input type="color" class="form-control form-control-sm form-control-color w-100" id="custom-color">
                            </div>

                            <!-- Section Visibility -->
                            <div class="mb-3">
                                <label class="form-label">Show/Hide Sections</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="show-education" checked>
                                    <label class="form-check-label">Education</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="show-experience" checked>
                                    <label class="form-check-label">Experience</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="show-skills" checked>
                                    <label class="form-check-label">Skills</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
:root {
    --primary: #2bc5d4;
    --secondary: #1a97a3;
    --light: #f0fbfc;
}

.template-list {
    max-height: 600px;
    overflow-y: auto;
}

.template-thumbnail {
    cursor: pointer;
    transition: all 0.3s ease;
    border: 2px solid transparent;
    margin-bottom: 10px;
}

.template-thumbnail:hover,
.template-thumbnail.active {
    border-color: var(--primary);
    transform: translateY(-2px);
}

#resume-preview {
    height: calc(100vh - 200px);
    overflow-y: auto;
    background: white;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
}

.color-swatch {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    border: none;
    cursor: pointer;
    transition: transform 0.2s;
}

.color-swatch:hover {
    transform: scale(1.1);
}

.template-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 8px;
    margin-bottom: 1rem;
}

.template-item {
    text-align: center;
    cursor: pointer;
}

.template-preview {
    position: relative;
    border: 1px solid #dee2e6;
    border-radius: 4px;
    overflow: hidden;
    margin-bottom: 4px;
}

.template-preview img {
    width: 100%;
    height: 100px;
    object-fit: cover;
    display: block;
}

.template-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s;
}

.template-item:hover .template-overlay {
    opacity: 1;
}

.template-item span {
    font-size: 0.875rem;
    color: #6c757d;
}

.template-item.active .template-preview {
    border-color: var(--primary);
    box-shadow: 0 0 0 2px var(--primary);
}

.nav-tabs .nav-link {
    padding: 0.5rem;
    font-size: 0.875rem;
}

.form-check-input:checked {
    background-color: var(--primary);
    border-color: var(--primary);
}

.card-header .nav-tabs {
    border-bottom: none;
}

.card-header .nav-link {
    border: none;
    border-radius: 0;
}

.card-header .nav-link.active {
    background-color: #fff;
    border-bottom: 2px solid var(--primary);
}

.form-sections {
    height: calc(100vh - 200px);
    overflow-y: auto;
}

@media print {
    /* Reset Body and HTML */
    html, body {
        margin: 0;
        padding: 0;
        height: 100%;
        overflow: hidden;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }

    /* Hide Everything by Default */
    body * {
        visibility: hidden;
    }

    /* Show Only the Resume Preview */
    #resume-preview, #resume-preview * {
        visibility: visible;
    }

    #resume-preview {
        position: absolute;
        left: 50%;
        top: 0;
        transform: translateX(-50%);
        width: 90%;
        max-width: 800px;
        padding: 20px;
        margin: 0 auto;
        box-shadow: none;
        height: auto;
    }

    /* Hide UI Elements */
    .navbar, .footer, .preview-actions, .card-header, 
    .status-tracker, .form-sections, .customization-panel {
        display: none !important;
    }

    /* Page Settings */
    @page {
        size: A4;
        margin: 12mm;
    }
}
</style>
<script src="./js/resume-builder.js"></script>
<?php include 'includes/footer.php'; ?>