<?php
include 'backend/db.php';
$result = $conn->query("SELECT * FROM projects ORDER BY id DESC");
?>
<!-- Projects Section -->
<section id="projects" class="projects-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Featured Projects</h2>
            <div class="title-underline"></div>
        </div>
        <div class="projects-grid">
            <?php while($row = $result->fetch_assoc()): ?>
            <div class="project-card">
                <div class="project-image">
                    <img src="<?= htmlspecialchars($row['Image_url']) ?>" alt="Project Image">
                    <div class="project-overlay">
                        <div class="project-links">
                            <a href="<?= htmlspecialchars($row['External_link']) ?>" class="project-link" target="_blank"><i class="fas fa-external-link-alt"></i></a>
                            <a href="<?= htmlspecialchars($row['Github_link']) ?>" class="project-link" target="_blank"><i class="fab fa-github"></i></a>
                        </div>
                    </div>
                </div>
                <div class="project-content">
                    <h3 class="project-title"><?= htmlspecialchars($row['Project_name']) ?></h3>
                    <p class="project-description">
                        <?= htmlspecialchars($row['Description']) ?>
                    </p>
                    <div class="project-tech">
                        <?php foreach (explode(',', $row['Tech_stack']) as $tech): ?>
                            <span class="tech-tag"><?= htmlspecialchars(trim($tech)) ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
