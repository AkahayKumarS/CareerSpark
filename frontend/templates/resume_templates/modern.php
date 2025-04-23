<div class="resume-template modern">
    <?php 
    $personal = json_decode($resumeData['personal_info'], true);
    $education = json_decode($resumeData['education'], true);
    $experience = json_decode($resumeData['experience'], true);
    $skills = json_decode($resumeData['skills'], true);
    ?>
    
    <div class="header" style="color: <?php echo $resumeData['color_scheme']; ?>">
        <h1 class="name"><?php echo htmlspecialchars($personal['fullName'] ?? ''); ?></h1>
        <div class="contact-info">
            <span><i class="fas fa-envelope"></i> <?php echo htmlspecialchars($personal['email'] ?? ''); ?></span>
            <span><i class="fas fa-phone"></i> <?php echo htmlspecialchars($personal['phone'] ?? ''); ?></span>
            <span><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($personal['location'] ?? ''); ?></span>
        </div>
    </div>

    <div class="section education">
        <h2>Education</h2>
        <?php if (!empty($education)): foreach($education as $edu): ?>
            <div class="entry">
                <h3><?php echo htmlspecialchars($edu['degree']); ?></h3>
                <p><?php echo htmlspecialchars($edu['institution']); ?></p>
                <p><?php echo htmlspecialchars($edu['year']); ?></p>
            </div>
        <?php endforeach; endif; ?>
    </div>

    <div class="section experience">
        <h2>Experience</h2>
        <?php if (!empty($experience)): foreach($experience as $exp): ?>
            <div class="entry">
                <h3><?php echo htmlspecialchars($exp['title']); ?></h3>
                <p><?php echo htmlspecialchars($exp['company']); ?></p>
                <p><?php echo htmlspecialchars($exp['duration']); ?></p>
                <ul>
                    <?php foreach($exp['responsibilities'] as $resp): ?>
                        <li><?php echo htmlspecialchars($resp); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; endif; ?>
    </div>
</div>

<style>
.modern {
    font-family: <?php echo $resumeData['font_family']; ?>;
    color: #333;
    max-width: 800px;
    margin: 0 auto;
    padding: 2rem;
}

.modern .header {
    text-align: center;
    margin-bottom: 2rem;
    border-bottom: 2px solid <?php echo $resumeData['color_scheme']; ?>;
}

.modern .section {
    margin-bottom: 1.5rem;
}

.modern .section h2 {
    color: <?php echo $resumeData['color_scheme']; ?>;
    border-bottom: 1px solid #eee;
}

.modern .entry {
    margin-bottom: 1rem;
}
</style>