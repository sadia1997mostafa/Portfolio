<?php
include 'backend/db.php';
$result = $conn->query("SELECT * FROM certifications ORDER BY Id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Certifications</title>
<style>
:root {
    --primary-bg: #1e1e2f;
    --secondary-bg: #252536;
    --text-primary: #ffffff;
    --text-secondary: #cccccc;
    --accent-color: #00d4ff;
    --border-radius-md: 14px;
    --spacing-md: 1rem;
    --spacing-lg: 1.5rem;
    --transition-medium: 0.4s ease;
    --shadow-soft: 0 5px 15px rgba(0,0,0,0.3);
    --shadow-hard: 0 15px 40px rgba(0,0,0,0.5);
}

body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #12121b;
    color: var(--text-primary);
}

.container {
    width: 90%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem 0;
}

.section-header {
    text-align: center;
    margin-bottom: 2rem;
}

.section-title {
    font-size: 2rem;
    margin-bottom: 0.5rem;
}

.title-underline {
    width: 80px;
    height: 4px;
    background: var(--accent-color);
    margin: 0 auto;
    border-radius: 2px;
}

/* Certifications Grid */
.certifications-grid {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 2rem;
    margin-top: 2rem;
}

.cert-card {
    background: var(--secondary-bg);
    border-radius: var(--border-radius-md);
    width: 300px;             /* increased card width */
    height: 440px;            /* increased card height */
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    box-shadow: var(--shadow-soft);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: 1px solid rgba(255,255,255,0.05);
    overflow: hidden;
}

.cert-card:hover {
    transform: translateY(-6px) scale(1.03);
    box-shadow: var(--shadow-hard);
}

.cert-image {
    width: 100%;
    height: 75%;       /* image now takes 75% of card height */
    object-fit: cover;
    display: block;
}

.cert-content {
    padding: 0.6rem 0.8rem;  /* compact padding */
    display: flex;
    flex-direction: column;
    gap: 0.3rem;
    width: 100%;
}

.cert-title {
    font-size: 1.2rem;
    font-weight: 600;
    color: var(--text-primary);
    line-height: 1.2;
}

.cert-issuer {
    font-size: 0.95rem;
    color: var(--accent-color);
}

.cert-date {
    font-size: 0.85rem;
    color: var(--text-secondary);
}

.cert-description {
    font-size: 0.85rem;
    color: var(--text-secondary);
    line-height: 1.3;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .certifications-grid {
        flex-direction: column;
        align-items: center;
    }
    .cert-card {
        width: 90%;
        height: auto; /* auto height on mobile */
    }
    .cert-image {
        height: 250px; /* adjust mobile image height */
    }
}
</style>
</head>
<body>

<section id="certifications" class="certifications-section">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title">Certifications</h2>
            <div class="title-underline"></div>
        </div>
        <div class="certifications-grid">
            <?php while($row = $result->fetch_assoc()): ?>
            <div class="cert-card">
                <img class="cert-image" src="<?= htmlspecialchars($row['Image_url']) ?>" alt="Certification Image">
                <div class="cert-content">
                    <h3 class="cert-title"><?= htmlspecialchars($row['Cert_name']) ?></h3>
                    <p class="cert-issuer"><?= htmlspecialchars($row['Organization']) ?></p>
                    <span class="cert-date"><?= htmlspecialchars($row['Date']) ?></span>
                    <p class="cert-description"><?= htmlspecialchars($row['Description']) ?></p>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

</body>
</html>
