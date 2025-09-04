<?php
include 'backend/db.php';
$result = $conn->query("SELECT * FROM projects ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Projects</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
:root {
    --primary-bg: #1e1e2f;
    --secondary-bg: #252536;
    --text-primary: #ffffff;
    --text-secondary: #cccccc;
    --accent-color: #00d4ff;
    --border-radius-sm: 6px;
    --border-radius-md: 12px;
    --spacing-xs: 0.3rem;
    --spacing-sm: 0.8rem;
    --spacing-md: 1rem;
    --spacing-lg: 1.5rem;
    --transition-fast: 0.3s ease;
    --transition-medium: 0.4s ease;
    --shadow-soft: 0 6px 15px rgba(0,0,0,0.3);
    --shadow-hard: 0 15px 40px rgba(0,0,0,0.5);
    --font-size-xs: 0.8rem;
    --font-size-sm: 1rem;
    --font-size-md: 1.2rem;
    --font-size-lg: 1.5rem;
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

/* Projects Section */
.projects-grid {
    display: flex;
    flex-wrap: wrap;
    justify-content: center; /* center cards */
    gap: 2rem;
    margin-top: 2rem;
}

.project-card {
    background: var(--secondary-bg);
    border-radius: var(--border-radius-md);
    overflow: hidden;
    box-shadow: var(--shadow-soft);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: 1px solid rgba(255, 255, 255, 0.05);
    max-width: 350px; /* limit card width */
    flex: 1 1 300px; /* flex-grow, flex-shrink, basis */
    display: flex;
    flex-direction: column;
}

.project-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: var(--shadow-hard);
}

.project-image {
    position: relative;
    overflow: hidden;
    height: 220px;
}

.project-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.project-card:hover .project-image img {
    transform: scale(1.1);
}

.project-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 212, 255, 0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.project-card:hover .project-overlay {
    opacity: 1;
}

.project-links {
    display: flex;
    gap: 1rem;
}

.project-link {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 45px;
    height: 45px;
    background: #fff;
    color: var(--accent-color);
    border-radius: 50%;
    text-decoration: none;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    box-shadow: 0 3px 10px rgba(0,0,0,0.2);
}

.project-link:hover {
    transform: scale(1.2);
    background: var(--accent-color);
    color: var(--text-primary);
}

.project-content {
    padding: 1.2rem;
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.project-title {
    font-size: var(--font-size-lg);
    margin-bottom: 0.5rem;
    color: var(--text-primary);
}

.project-description {
    color: var(--text-secondary);
    margin-bottom: 1rem;
    line-height: 1.5;
    flex-grow: 1;
}

.project-tech {
    display: flex;
    flex-wrap: wrap;
    gap: 0.4rem;
}

.tech-tag {
    background: rgba(0,212,255,0.1);
    color: var(--accent-color);
    padding: 0.3rem 0.6rem;
    border-radius: var(--border-radius-sm);
    font-size: var(--font-size-xs);
    font-weight: 500;
    border: 1px solid rgba(0,212,255,0.3);
    transition: all 0.3s ease;
}

.tech-tag:hover {
    background: var(--accent-color);
    color: var(--text-primary);
    border-color: var(--accent-color);
    cursor: default;
}
</style>
</head>
<body>
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
                        <?php if(!empty($row['External_link'])): ?>
                        <a href="<?= htmlspecialchars($row['External_link']) ?>" class="project-link" target="_blank"><i class="fas fa-external-link-alt"></i></a>
                        <?php endif; ?>
                        <?php if(!empty($row['Github_link'])): ?>
                        <a href="<?= htmlspecialchars($row['Github_link']) ?>" class="project-link" target="_blank"><i class="fab fa-github"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="project-content">
                    <h3 class="project-title"><?= htmlspecialchars($row['Project_name']) ?></h3>
                    <p class="project-description"><?= htmlspecialchars($row['Description']) ?></p>
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
</body>
</html>
