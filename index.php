<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sadia Mostafa - Portfolio</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
   <style>
   /* Hamburger */
.hamburger {
    display: none;
    flex-direction: column;
    gap: 6px;
    cursor: pointer;
    z-index: 110;
}

.hamburger span {
    width: 28px;
    height: 3px;
    background: #00e0ff; /* neon cyan */
    border-radius: 2px;
    transition: all 0.3s ease;
}

/* Mobile menu */
@media (max-width: 768px) {
    .nav-menu {
        display: none;
        flex-direction: column;
        gap: 25px;
        position: fixed;
        top: 0;
        right: 0;
        width: 100%;
        height: 100vh;
        background: radial-gradient(circle at top left, rgba(10,20,40,0.95), rgba(5,5,20,0.95));
        backdrop-filter: blur(10px);
        color: #fff;
        padding-top: 120px;
        align-items: center;
        transition: transform 0.4s ease, opacity 0.4s ease;
        transform: translateX(100%);
        opacity: 0;
        z-index: 100;
    }

    .nav-menu.active {
        display: flex;
        transform: translateX(0);
        opacity: 1;
    }

    .nav-menu li a {
        color: #e0e0ff;
        font-size: 1.6rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .nav-menu li a:hover {
        color: #00e0ff;
        text-shadow: 0 0 8px #00e0ff, 0 0 16px #0077ff;
    }

    .hamburger {
        display: flex;
    }
}
/* Align container items */
.nav-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
}

/* Admin login corner button */
.admin-login a {
    font-size: 0.85rem;
    font-weight: 500;
    padding: 6px 12px;
    color: #fff;
    border: 1px solid #00e0ff;
    border-radius: 6px;
    text-decoration: none;
    transition: all 0.3s ease;
}

.admin-login a:hover {
    background: #00e0ff;
    color: #111;
    text-shadow: none;
}

/* Make sure it stays visible in mobile */
@media (max-width: 768px) {
    .admin-login {
        position: absolute;
        top: 20px;
        right: 60px; /* keep away from hamburger */
    }
    .admin-login a {
        font-size: 0.8rem;
        padding: 5px 10px;
    }
}
.admin-login{
    align-items: right;
}
</style>

</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">
                <span class="logo-text">Sadia</span>
                <span class="logo-accent">Mostafa</span>
            </div>
            <ul class="nav-menu">
                <li><a href="#home" class="nav-link">Home</a></li>
                <li><a href="#about" class="nav-link">About</a></li>
                <li><a href="#education" class="nav-link">Education</a></li>
                <li><a href="#skills" class="nav-link">Skills</a></li>
                <li><a href="#projects" class="nav-link">Projects</a></li>
                <li><a href="#certifications" class="nav-link">Certifications</a></li>
                <li><a href="#contact" class="nav-link">Contact</a></li>
            </ul>
             <div class="admin-login">
            <a href="login.php">Admin Dashboard</a>
        </div>

            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <!-- Your PHP files remain untouched -->
    <?php include 'home.php'; ?>
    <?php include 'about.php'; ?>
    <?php include 'education.php'; ?>
    <?php include 'skills.php'; ?>
    <?php include 'projects.php'; ?>
    <?php include 'certifications.php'; ?>
    <?php include 'contact.php'; ?>
    <?php include 'footer.php'; ?>

    <script>
        const hamburger = document.querySelector('.hamburger');
        const navMenu = document.querySelector('.nav-menu');

        hamburger.addEventListener('click', () => {
            navMenu.classList.toggle('active');
        });
    </script>
</body>
</html>
