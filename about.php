<!-- About Section -->
<!-- About Section -->
<section id="about" class="about-section">
  <div class="container">
    <div class="section-header">
      <h2 class="section-title">About Me</h2>
      <div class="title-underline"></div>
    </div>

    <div class="about-content">
      <div class="about-3d">
        <div class="book-3d">
          <div class="book-pages">
            <!-- Cover Page (always on left, orange design) -->
            <div class="page cover-page">
              <div class="page-front">
                <h2 class="book-title">My Journey</h2>
                <p class="book-author">Sadia Mostafa</p>
              </div>
              <div class="page-back"></div>
            </div>

            <!-- Page 1 -->
            <div class="page page-1">
              <div class="page-front">
                <h4>About Me</h4>
                <p>
                  I am a 3rd-year Computer Science student with 2 years of
                  development experience. Passionate about web, mobile, and
                  backend technologies, I enjoy turning ideas into real
                  projects.
                </p>
              </div>
              <div class="page-back"></div>
            </div>

            <!-- Page 2 -->
            <div class="page page-2">
              <div class="page-front">
                <h4>Skills</h4>
                <ul>
                  <li>MERN Stack, Laravel</li>
                  <li>React Native, Android (Java/Kotlin)</li>
                  <li>C, C++, Java, Python</li>
                  <li>Beginner in Machine Learning</li>
                </ul>
              </div>
              <div class="page-back"></div>
            </div>

            <!-- Page 3 -->
            <div class="page page-3">
              <div class="page-front">
                <h4>Projects</h4>
                <ul>
                  <li>Medicine Delivery App</li>
                  <li>E-commerce Platform</li>
                  <li>Portfolio Website</li>
                  <li>Food Delivery App</li>
                  <li>Academic: Computer Architecture & DLD</li>
                </ul>
              </div>
              <div class="page-back"></div>
            </div>

            <!-- Page 4 -->
            <div class="page page-4">
              <div class="page-front">
                <h4>Goals</h4>
                <p>
                  With 10+ projects completed, I aim to grow as a full-stack and
                  mobile developer while exploring machine learning and advanced
                  technologies.
                </p>
              </div>
              <div class="page-back"></div>
            </div>
          </div>
        </div>

        <!-- 3D Knowledge Spheres -->
        <div class="knowledge-spheres">
          <div class="sphere sphere-1" data-skill="Frontend">
            <div class="sphere-inner">
              <i class="fab fa-html5"></i>
            </div>
          </div>
          <div class="sphere sphere-2" data-skill="Backend">
            <div class="sphere-inner">
              <i class="fas fa-server"></i>
            </div>
          </div>
          <div class="sphere sphere-3" data-skill="Design">
            <div class="sphere-inner">
              <i class="fas fa-palette"></i>
            </div>
          </div>
        </div>
      </div>

      <!-- Right Text -->
      <div class="about-text">
        <h3 class="about-title">Passionate Developer & Creative Designer</h3>
        <p class="about-description">
          I'm a dedicated web developer with a passion for creating beautiful,
          functional, and user-friendly digital experiences. With expertise in
          modern web technologies and a keen eye for design, I bring ideas to
          life through code and creativity.
        </p>

        <div class="about-stats">
          <div class="stat-item">
            <span class="stat-number">50+</span>
            <span class="stat-label">Projects Completed</span>
          </div>
          <div class="stat-item">
            <span class="stat-number">3+</span>
            <span class="stat-label">Years Experience</span>
          </div>
          <div class="stat-item">
            <span class="stat-number">100%</span>
            <span class="stat-label">Client Satisfaction</span>
          </div>
        </div>

        <div class="about-buttons">
          <a href="#" class="btn btn-primary">
            <i class="fas fa-download"></i> Download CV
          </a>
          <a href="#contact" class="btn btn-outline">
            <i class="fas fa-coffee"></i> Let's Talk
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CSS -->
<style>
.book-3d {
  position: relative;
  width: 350px;
  height: 250px;
  perspective: 1500px;
}

.book-pages {
  position: relative;
  width: 100%;
  height: 100%;
  transform-style: preserve-3d;
}

.page {
  position: absolute;
  width: 100%;
  height: 100%;
  transform-style: preserve-3d;
}

.page-front,
.page-back {
  position: absolute;
  width: 100%;
  height: 100%;
  backface-visibility: hidden;
  padding: 20px;
  box-sizing: border-box;
  background: #fff;
  color: #333;
  border: 1px solid #ccc;
  border-radius: 4px;
}

/* Back faces flipped */
.page-back {
  transform: rotateY(180deg);
}

/* Cover page - fixed on left, orange design */
.cover-page {
  position: absolute;
  left: -300px; /* move whole cover 300px left */
  top: 0;
  width: 50%;
  height: 100%;
  transform: rotateY(0deg) !important;
  z-index: 10;
  pointer-events: none;
  background: linear-gradient(135deg, #ff7e00, #ffb347); /* orange gradient */
  border-right: 3px solid #cc6600;
  box-shadow: 2px 0 8px rgba(0,0,0,0.3);
}

.cover-page .page-front {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  font-family: "Georgia", serif;
  color: #fff;
  text-align: center;
}

.book-title {
  font-size: 24px;
  font-weight: bold;
  margin-bottom: 10px;
}

.book-author {
  font-size: 16px;
  opacity: 0.9;
}
.cover-page .page-front {
  background: linear-gradient(135deg, #ff7e00, #ffb347) !important;
  border: none;
}

</style>
