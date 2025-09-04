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
        <div class="education-timeline">
            <?php while($row = $result->fetch_assoc()): ?>
            <div class="timeline-item animate">
                <div class="timeline-dot"></div>
                <div class="timeline-content">
                    <?php if(!empty($row['Image_url'])): ?>
                    <div class="timeline-image">
                        <img src="<?= htmlspecialchars($row['Image_url']) ?>" alt="Institution Logo">
                    </div>
                    <?php endif; ?>
                    <h3 class="timeline-title"><?= htmlspecialchars($row['Degree']) ?></h3>
                    <p class="timeline-institution"><?= htmlspecialchars($row['Institution']) ?></p>
                    <span class="timeline-date"><?= htmlspecialchars($row['Year']) ?></span>
                    <?php if(!empty($row['Description'])): ?>
                    <p class="timeline-description"><?= htmlspecialchars($row['Description']) ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<style>
/* Timeline Styles */
.education-timeline {
    max-width: 800px;
    margin: 0 auto;
    position: relative;
    padding: 2rem 0;
}

.education-timeline::before {
    content: '';
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    top: 0;
    bottom: 0;
    width: 2px;
    background: linear-gradient(to bottom, #4facfe, #00f2fe);
}

.timeline-item {
    position: relative;
    margin-bottom: 3rem;
    display: flex;
    justify-content: flex-end;
    padding-right: 50%;
    opacity: 0;
    transition: all 0.8s ease-out;
}

/* Odd items on left, slide from left */
.timeline-item:nth-child(odd) {
    justify-content: flex-end;
    padding-right: 50%;
    transform: translateX(-100px);
}

/* Even items on right, slide from right */
.timeline-item:nth-child(even) {
    justify-content: flex-start;
    padding-left: 50%;
    padding-right: 0;
    transform: translateX(100px);
}

/* Activate animation */
.timeline-item.active {
    opacity: 1;
    transform: translateX(0);
}

.timeline-dot {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    width: 20px;
    height: 20px;
    background: #4facfe;
    border-radius: 50%;
    border: 4px solid #fff;
    z-index: 1;
}

.timeline-content {
    background: #f9f9f9;
    padding: 1rem 1.5rem;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    max-width: 400px;
    position: relative;
    text-align: left;
}

.timeline-item:nth-child(even) .timeline-content {
    margin-left: 1rem;
}

.timeline-item:nth-child(odd) .timeline-content {
    margin-right: 1rem;
}

.timeline-image img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 50%;
    margin-bottom: 0.5rem;
}

.timeline-title {
    font-size: 1.2rem;
    margin-bottom: 0.3rem;
    color: #4facfe;
    font-weight: 600;
}

.timeline-institution {
    font-weight: 600;
    margin-bottom: 0.3rem;
    color: #333;
}

.timeline-date {
    font-size: 0.85rem;
    color: #00bcd4;
    font-weight: 600;
}

.timeline-description {
    margin-top: 0.5rem;
    color: #555;
    line-height: 1.5;
}
.timeline-content {
    background: #f9f9f9;
    padding: 2rem 2.5rem;      /* bigger padding */
    border-radius: 12px;
    box-shadow: 0 6px 25px rgba(0,0,0,0.2); /* bigger shadow */
    max-width: 600px;          /* increased from 500px */
    position: relative;
    text-align: left;
    font-size: 1.05rem;        /* slightly bigger font */
}

.timeline-image img {
    width: 100px;   /* bigger image */
    height: 100px;
    object-fit: cover;
    border-radius: 50%;
    margin-bottom: 1rem;
}

.timeline-item {
    margin-bottom: 5rem;  /* more space between items */
}

.timeline-title {
    font-size: 1.6rem;   /* bigger title */
}

.timeline-institution {
    font-size: 1.1rem;   /* bigger institution text */
}

.timeline-date {
    font-size: 0.95rem;  /* bigger date text */
}

.timeline-description {
    line-height: 1.8;    /* more readable spacing */
    font-size: 1rem;     /* slightly bigger description */
}

</style>

<script>
// Animate timeline items when they appear in viewport
const timelineItems = document.querySelectorAll('.timeline-item');

function checkTimelineItems() {
    const triggerBottom = window.innerHeight * 0.85;
    timelineItems.forEach(item => {
        const itemTop = item.getBoundingClientRect().top;
        if(itemTop < triggerBottom){
            item.classList.add('active');
        }
    });
}

window.addEventListener('scroll', checkTimelineItems);
window.addEventListener('load', checkTimelineItems);
</script>
