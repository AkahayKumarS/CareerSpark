<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Not authenticated']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$userId = $_SESSION['user_id'];

try {
    // Check if resume exists for user
    $stmt = $pdo->prepare("SELECT resume_id FROM resumes WHERE user_id = ?");
    $stmt->execute([$userId]);
    $existing = $stmt->fetch();

    if ($existing) {
        // Update existing resume
        $stmt = $pdo->prepare("UPDATE resumes SET 
            template_id = ?,
            resume_name = ?,
            personal_info = ?,
            education = ?,
            experience = ?,
            skills = ?,
            projects = ?,
            certifications = ?,
            languages = ?,
            interests = ?,
            color_scheme = ?,
            font_family = ?,
            updated_at = CURRENT_TIMESTAMP
            WHERE resume_id = ?");
            
        $stmt->execute([
            $data['template_id'],
            $data['resume_name'],
            json_encode($data['personal_info']),
            json_encode($data['education']),
            json_encode($data['experience']),
            json_encode($data['skills']),
            json_encode($data['projects']),
            json_encode($data['certifications']),
            json_encode($data['languages']),
            json_encode($data['interests']),
            $data['color_scheme'],
            $data['font_family'],
            $existing['resume_id']
        ]);
    } else {
        // Create new resume
        $stmt = $pdo->prepare("INSERT INTO resumes (
            user_id, template_id, resume_name, personal_info, education,
            experience, skills, projects, certifications, languages,
            interests, color_scheme, font_family
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        $stmt->execute([
            $userId,
            $data['template_id'],
            $data['resume_name'],
            json_encode($data['personal_info']),
            json_encode($data['education']),
            json_encode($data['experience']),
            json_encode($data['skills']),
            json_encode($data['projects']),
            json_encode($data['certifications']),
            json_encode($data['languages']),
            json_encode($data['interests']),
            $data['color_scheme'],
            $data['font_family']
        ]);
    }

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    error_log($e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Database error']);
}