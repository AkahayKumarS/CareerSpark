<?php
require_once '../backend/config.php';
header('Content-Type: text/html');

// Get template and resume data
$data = json_decode(file_get_contents('php://input'), true);
$templateId = $data['template_id'] ?? 1;
$resumeId = $data['resume_id'] ?? null;

// Get resume data from database
if ($resumeId) {
    $stmt = $pdo->prepare("SELECT * FROM resumes WHERE resume_id = ?");
    $stmt->execute([$resumeId]);
    $resumeData = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    $resumeData = [
        'personal_info' => '{}',
        'education' => '[]',
        'experience' => '[]',
        'skills' => '[]',
        'color_scheme' => '#2bc5d4',
        'font_family' => 'Roboto'
    ];
}

// Get template name
$stmt = $pdo->prepare("SELECT template_name FROM resume_templates WHERE template_id = ?");
$stmt->execute([$templateId]);
$template = $stmt->fetch(PDO::FETCH_ASSOC);
$templateName = strtolower($template['template_name'] ?? 'modern');

// Include the template file
$templateFile = "templates/resume_templates/{$templateName}.php";
if (file_exists($templateFile)) {
    include $templateFile;
} else {
    echo '<div class="alert alert-danger">Template not found</div>';
}