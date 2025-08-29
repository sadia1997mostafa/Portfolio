<?php
include 'backend/db.php';
$result = $conn->query("SELECT * FROM skills ORDER BY Id DESC");
?>
<!-- Skills Section -->
<section id="skills" class="skills-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Skills</h2>
            <div class="title-underline"></div>
        </div>
        <div class="skills-grid">
            <?php while($row = $result->fetch_assoc()): ?>
            <div class="skill-card">
                <div class="skill-image">
                    <img src="<?= htmlspecialchars($row['Image_url']) ?>" alt="Skill Icon">
                </div>
                <div class="skill-content">
                    <h3 class="skill-name"><?= htmlspecialchars($row['Skill']) ?></h3>
                    <span class="skill-level"><?= htmlspecialchars($row['Level']) ?></span>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
