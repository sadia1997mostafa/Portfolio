<?php
include 'backend/db.php';
$result = $conn->query("SELECT * FROM certifications ORDER BY Id DESC");
?>
<!-- Certifications Section -->
<section id="certifications" class="certifications-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Certifications</h2>
            <div class="title-underline"></div>
        </div>
        <div class="certifications-grid">
            <?php while($row = $result->fetch_assoc()): ?>
            <div class="cert-card">
                <div class="cert-icon">
                    <img src="<?= htmlspecialchars($row['Image_url']) ?>" alt="Certification Image" style="width:48px;">
                </div>
                <h3 class="cert-title"><?= htmlspecialchars($row['Cert_name']) ?></h3>
                <p class="cert-issuer"><?= htmlspecialchars($row['Organization']) ?></p>
                <span class="cert-date"><?= htmlspecialchars($row['Date']) ?></span>
                <p class="cert-description"><?= htmlspecialchars($row['Description']) ?></p>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
