<?php
include 'backend/db.php';
$result = $conn->query("SELECT * FROM education ORDER BY Year DESC");
?>
<!-- Education Section -->
<section id="education" class="education-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Education</h2>
            <div class="title-underline"></div>
        </div>
        <div class="education-grid">
            <?php while($row = $result->fetch_assoc()): ?>
            <div class="education-card">
                <div class="education-image">
                    <img src="<?= htmlspecialchars($row['Image_url']) ?>" alt="Institution Logo">
                </div>
                <div class="education-content">
                    <h3 class="degree"><?= htmlspecialchars($row['Degree']) ?></h3>
                    <p class="institution"><?= htmlspecialchars($row['Institution']) ?></p>
                    <span class="year"><?= htmlspecialchars($row['Year']) ?></span>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
