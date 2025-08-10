// Portfolio JavaScript - Interactive Features and Animations

document.addEventListener('DOMContentLoaded', function() {
    // Initialize all features
    initNavigation();
    initScrollEffects();
    initAnimations();
    initContactForm();
    initVideoControls();
    initSkillAnimations();
    initParallaxEffects();
});

// Navigation Functions
function initNavigation() {
    const hamburger = document.querySelector('.hamburger');
    const navMenu = document.querySelector('.nav-menu');
    const navLinks = document.querySelectorAll('.nav-link');

    // Mobile menu toggle
    hamburger?.addEventListener('click', function() {
        navMenu.classList.toggle('active');
        hamburger.classList.toggle('active');
    });

    // Close mobile menu when clicking on links
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            navMenu.classList.remove('active');
            hamburger.classList.remove('active');
        });
    });

    // Smooth scrolling for navigation links
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            
            if (targetSection) {
                const offsetTop = targetSection.offsetTop - 70; // Account for fixed navbar
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Active navigation highlighting
    window.addEventListener('scroll', updateActiveNavigation);
}

function updateActiveNavigation() {
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-link');
    const scrollPosition = window.scrollY + 100;

    sections.forEach(section => {
        const sectionTop = section.offsetTop;
        const sectionHeight = section.offsetHeight;
        const sectionId = section.getAttribute('id');

        if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === `#${sectionId}`) {
                    link.classList.add('active');
                }
            });
        }
    });
}

// Scroll Effects
function initScrollEffects() {
    const navbar = document.querySelector('.navbar');
    
    window.addEventListener('scroll', function() {
        if (window.scrollY > 100) {
            navbar.style.background = 'rgba(10, 10, 10, 0.98)';
            navbar.style.boxShadow = '0 2px 20px rgba(0, 0, 0, 0.3)';
        } else {
            navbar.style.background = 'rgba(10, 10, 10, 0.95)';
            navbar.style.boxShadow = 'none';
        }
    });

    // Reveal animations on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, observerOptions);

    // Observe elements for animation
    const animateElements = document.querySelectorAll('.project-card, .cert-card, .timeline-item, .skill-category');
    animateElements.forEach(el => {
        observer.observe(el);
    });
}

// Animations
function initAnimations() {
    // Typing animation for hero text
    const heroTitle = document.querySelector('.name-highlight');
    if (heroTitle) {
        typeWriter(heroTitle, heroTitle.textContent, 100);
    }

    // Counter animation for stats
    const statNumbers = document.querySelectorAll('.stat-number');
    const statsObserver = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                statsObserver.unobserve(entry.target);
            }
        });
    });

    statNumbers.forEach(stat => {
        statsObserver.observe(stat);
    });

    // Add CSS for scroll animations
    const style = document.createElement('style');
    style.textContent = `
        .project-card, .cert-card, .timeline-item, .skill-category {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        
        .project-card.animate-in, .cert-card.animate-in, 
        .timeline-item.animate-in, .skill-category.animate-in {
            opacity: 1;
            transform: translateY(0);
        }
        
        .nav-link.active {
            color: var(--accent-color);
        }
        
        .nav-link.active::after {
            width: 100%;
        }
        
        .hamburger.active span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }
        
        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }
        
        .hamburger.active span:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -6px);
        }
    `;
    document.head.appendChild(style);
}

function typeWriter(element, text, speed) {
    element.textContent = '';
    element.style.borderRight = '2px solid var(--accent-color)';
    element.style.animation = 'blink 1s infinite';
    
    let i = 0;
    function type() {
        if (i < text.length) {
            element.textContent += text.charAt(i);
            i++;
            setTimeout(type, speed);
        } else {
            element.style.borderRight = 'none';
            element.style.animation = 'none';
        }
    }
    
    // Add blink animation
    const blinkStyle = document.createElement('style');
    blinkStyle.textContent = `
        @keyframes blink {
            0%, 50% { border-color: transparent; }
            51%, 100% { border-color: var(--accent-color); }
        }
    `;
    document.head.appendChild(blinkStyle);
    
    setTimeout(type, 2000); // Start typing after 2 seconds
}

function animateCounter(element) {
    const target = parseInt(element.textContent.replace(/\D/g, ''));
    const suffix = element.textContent.replace(/\d/g, '');
    let current = 0;
    const increment = target / 100;
    const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
            element.textContent = target + suffix;
            clearInterval(timer);
        } else {
            element.textContent = Math.floor(current) + suffix;
        }
    }, 20);
}

// Skill Animations
function initSkillAnimations() {
    const skillLevels = document.querySelectorAll('.skill-level');
    
    const skillObserver = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const level = entry.target.getAttribute('data-level');
                entry.target.style.setProperty('--skill-width', level + '%');
                entry.target.classList.add('animate');
                skillObserver.unobserve(entry.target);
            }
        });
    });

    skillLevels.forEach(skill => {
        skillObserver.observe(skill);
    });
}

// Contact Form
function initContactForm() {
    const contactForm = document.getElementById('contactForm');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const formData = new FormData(this);
            const formObject = {};
            formData.forEach((value, key) => {
                formObject[key] = value;
            });
            
            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
            submitBtn.disabled = true;
            
            // Simulate form submission (replace with actual form handler)
            setTimeout(() => {
                showNotification('Message sent successfully!', 'success');
                this.reset();
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }, 2000);
        });
    }
}

function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <i class="fas fa-${type === 'success' ? 'check-circle' : 'info-circle'}"></i>
        <span>${message}</span>
        <button class="notification-close">&times;</button>
    `;
    
    // Add styles
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: ${type === 'success' ? 'var(--accent-color)' : 'var(--highlight-color)'};
        color: white;
        padding: 1rem 1.5rem;
        border-radius: var(--border-radius-md);
        display: flex;
        align-items: center;
        gap: 0.5rem;
        z-index: 10000;
        box-shadow: var(--shadow-hard);
        transform: translateX(100%);
        transition: transform 0.3s ease;
    `;
    
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
    }, 100);
    
    // Auto remove
    setTimeout(() => {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 5000);
    
    // Close button
    notification.querySelector('.notification-close').addEventListener('click', () => {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    });
}

// Portfolio JavaScript - Cinematic 3D Interactive Features

document.addEventListener('DOMContentLoaded', function() {
    // Initialize all features
    initCinematicEntrance();
    initNavigation();
    initScrollEffects();
    initAnimations();
    initContactForm();
    init3DInteractions();
    initSkillAnimations();
    initParallaxEffects();
    init3DRoom();
    init3DBook();
});

// Cinematic Entrance Effect
function initCinematicEntrance() {
    const room = document.querySelector('.room-3d');
    const homeContent = document.querySelector('.home-content');
    const body = document.body;
    
    // Prevent scrolling during entrance
    body.style.overflow = 'hidden';
    
    // Enable scrolling after entrance animation
    setTimeout(() => {
        body.style.overflow = 'auto';
    }, 8000);
    
    // Add entrance sound effect (optional)
    const playEntranceSound = () => {
        try {
            const audioContext = new (window.AudioContext || window.webkitAudioContext)();
            const oscillator = audioContext.createOscillator();
            const gainNode = audioContext.createGain();
            
            oscillator.connect(gainNode);
            gainNode.connect(audioContext.destination);
            
            oscillator.frequency.setValueAtTime(220, audioContext.currentTime);
            oscillator.frequency.exponentialRampToValueAtTime(440, audioContext.currentTime + 2);
            
            gainNode.gain.setValueAtTime(0, audioContext.currentTime);
            gainNode.gain.linearRampToValueAtTime(0.1, audioContext.currentTime + 0.5);
            gainNode.gain.exponentialRampToValueAtTime(0.01, audioContext.currentTime + 2);
            
            oscillator.start(audioContext.currentTime);
            oscillator.stop(audioContext.currentTime + 2);
        } catch (e) {
            console.log('Audio not supported');
        }
    };
    
    // Trigger entrance sequence
    setTimeout(() => {
        if (room) {
            room.style.animation = 'cinematicEntrance 4s ease-out forwards, roomFloat 20s infinite linear 4s';
        }
        // playEntranceSound(); // Uncomment if you want sound
    }, 500);
    
    // Add depth fog effect
    const fog = document.createElement('div');
    fog.className = 'entrance-fog';
    fog.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(ellipse at center, transparent 0%, rgba(0, 0, 0, 0.8) 100%);
        pointer-events: none;
        z-index: 5;
        opacity: 1;
        transition: opacity 3s ease;
    `;
    document.body.appendChild(fog);
    
    // Fade out fog
    setTimeout(() => {
        fog.style.opacity = '0';
        setTimeout(() => {
            document.body.removeChild(fog);
        }, 3000);
    }, 2000);
    
    // Add screen flash effect
    const flash = document.createElement('div');
    flash.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle, rgba(0, 212, 255, 0.1) 0%, transparent 70%);
        pointer-events: none;
        z-index: 15;
        opacity: 0;
        animation: screenFlash 0.5s ease 1s;
    `;
    document.body.appendChild(flash);
    
    // Add flash animation
    const flashStyle = document.createElement('style');
    flashStyle.textContent = `
        @keyframes screenFlash {
            0%, 100% { opacity: 0; }
            50% { opacity: 0.3; }
        }
    `;
    document.head.appendChild(flashStyle);
    
    setTimeout(() => {
        document.body.removeChild(flash);
    }, 2000);
}

// Enhanced 3D Room Interactions with Cinematic Control
function init3DRoom() {
    const room = document.querySelector('.room-3d');
    const homeSection = document.querySelector('.home-section');
    
    if (room && homeSection) {
        // Enhanced mouse interaction with depth sensitivity
        homeSection.addEventListener('mousemove', function(e) {
            // Only allow interaction after entrance animation
            setTimeout(() => {
                const x = (e.clientX / window.innerWidth) * 2 - 1;
                const y = (e.clientY / window.innerHeight) * 2 - 1;
                
                // More dramatic 3D movement
                room.style.transform = `
                    rotateY(${x * 15}deg) 
                    rotateX(${y * 8}deg) 
                    translateZ(${Math.abs(x) * 100}px)
                    scale(${1 + Math.abs(x) * 0.05})
                `;
                
                // Add dynamic lighting based on mouse position
                const leftWall = document.querySelector('.room-wall-left');
                const rightWall = document.querySelector('.room-wall-right');
                
                if (leftWall && rightWall) {
                    leftWall.style.opacity = 0.7 + (x * 0.2);
                    rightWall.style.opacity = 0.7 - (x * 0.2);
                }
            }, 8000);
        });
        
        // Reset on mouse leave with smooth transition
        homeSection.addEventListener('mouseleave', function() {
            room.style.transition = 'transform 1s ease';
            room.style.transform = 'rotateY(0deg) rotateX(0deg) translateZ(0px) scale(1)';
            
            setTimeout(() => {
                room.style.transition = '';
            }, 1000);
        });
        
        // Enhanced furniture interactions
        const furniture = document.querySelectorAll('.furniture');
        furniture.forEach((item, index) => {
            item.addEventListener('click', function() {
                // Different animation for each furniture piece
                const animations = [
                    'furnitureFloat 2s ease-in-out',
                    'furnitureRotate 2s ease-in-out',
                    'furnitureBounce 2s ease-in-out'
                ];
                
                this.style.animation = animations[index % animations.length];
                
                // Add particle effect
                createParticleEffect(this, 'click');
                
                setTimeout(() => {
                    this.style.animation = 'furnitureFloat 6s ease-in-out infinite';
                }, 2000);
            });
            
            // Hover effects
            item.addEventListener('mouseenter', function() {
                this.style.filter = 'brightness(1.3) drop-shadow(0 0 20px rgba(0, 212, 255, 0.5))';
            });
            
            item.addEventListener('mouseleave', function() {
                this.style.filter = 'none';
            });
        });
    }
}

// Particle Effect System
function createParticleEffect(element, type) {
    const rect = element.getBoundingClientRect();
    const particleCount = type === 'click' ? 15 : 8;
    
    for (let i = 0; i < particleCount; i++) {
        const particle = document.createElement('div');
        particle.style.cssText = `
            position: fixed;
            width: 4px;
            height: 4px;
            background: var(--accent-color);
            border-radius: 50%;
            pointer-events: none;
            z-index: 1000;
            left: ${rect.left + rect.width / 2}px;
            top: ${rect.top + rect.height / 2}px;
        `;
        
        document.body.appendChild(particle);
        
        // Animate particle
        const angle = (i / particleCount) * Math.PI * 2;
        const velocity = 50 + Math.random() * 100;
        const duration = 1000 + Math.random() * 500;
        
        particle.animate([
            { 
                transform: 'translate(0, 0) scale(1)',
                opacity: 1
            },
            { 
                transform: `translate(${Math.cos(angle) * velocity}px, ${Math.sin(angle) * velocity}px) scale(0)`,
                opacity: 0
            }
        ], {
            duration: duration,
            easing: 'cubic-bezier(0.25, 0.46, 0.45, 0.94)'
        }).onfinish = () => {
            document.body.removeChild(particle);
        };
    }
}

// Add new furniture animations
const furnitureStyles = document.createElement('style');
furnitureStyles.textContent = `
    @keyframes furnitureRotate {
        0%, 100% { transform: rotateY(0deg) rotateX(0deg); }
        50% { transform: rotateY(180deg) rotateX(10deg); }
    }
    
    @keyframes furnitureBounce {
        0%, 100% { transform: translateY(0px) scale(1); }
        25% { transform: translateY(-20px) scale(1.1); }
        50% { transform: translateY(-40px) scale(1.2); }
        75% { transform: translateY(-20px) scale(1.1); }
    }
`;
document.head.appendChild(furnitureStyles);

// 3D Book Interactions
function init3DBook() {
    const book = document.querySelector('.book-3d');
    const spheres = document.querySelectorAll('.sphere');
    
    if (book) {
        // Enhanced book interaction
        book.addEventListener('click', function() {
            this.style.animation = 'bookFlip 3s ease-in-out';
            
            // Trigger page flip animation
            const pages = document.querySelectorAll('.page');
            pages.forEach((page, index) => {
                setTimeout(() => {
                    page.style.animation = 'pageFlip 2s ease-in-out';
                }, index * 500);
            });
            
            setTimeout(() => {
                this.style.animation = 'bookFloat 8s infinite ease-in-out';
                pages.forEach(page => {
                    page.style.animation = 'pageFlip 6s infinite ease-in-out';
                });
            }, 3000);
        });
        
        // Advanced mouse tracking
        const aboutSection = document.querySelector('.about-section');
        aboutSection.addEventListener('mousemove', function(e) {
            const rect = this.getBoundingClientRect();
            const x = ((e.clientX - rect.left) / rect.width) * 2 - 1;
            const y = ((e.clientY - rect.top) / rect.height) * 2 - 1;
            
            book.style.transform = `
                rotateY(${x * 30}deg) 
                rotateX(${-y * 20}deg) 
                translateZ(${Math.abs(x) * 20}px)
                scale(${1 + Math.abs(x) * 0.1})
            `;
        });
    }
    
    // Knowledge spheres interactions
    spheres.forEach(sphere => {
        sphere.addEventListener('click', function() {
            const skill = this.getAttribute('data-skill');
            showSkillModal(skill);
        });
        
        sphere.addEventListener('mouseenter', function() {
            this.style.animation = 'sphereOrbit 2s infinite linear';
        });
        
        sphere.addEventListener('mouseleave', function() {
            this.style.animation = 'sphereOrbit 12s infinite linear';
        });
    });
}

// 3D Interactions
function init3DInteractions() {
    // Enhanced project card interactions
    const projectCards = document.querySelectorAll('.project-card');
    projectCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-20px) rotateX(10deg) rotateY(5deg) scale(1.05)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) rotateX(0) rotateY(0) scale(1)';
        });
        
        card.addEventListener('mousemove', function(e) {
            const rect = this.getBoundingClientRect();
            const x = ((e.clientX - rect.left) / rect.width) * 2 - 1;
            const y = ((e.clientY - rect.top) / rect.height) * 2 - 1;
            
            this.style.transform = `
                translateY(-20px) 
                rotateX(${-y * 15}deg) 
                rotateY(${x * 15}deg) 
                scale(1.05)
            `;
        });
    });
    
    // 3D Tech Icons Interaction
    const techIcons = document.querySelectorAll('.tech-icon');
    techIcons.forEach(icon => {
        icon.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.5) rotateY(180deg) translateZ(50px)';
            this.style.filter = 'drop-shadow(0 0 30px currentColor)';
        });
        
        icon.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1) rotateY(0deg) translateZ(0px)';
            this.style.filter = 'drop-shadow(0 0 20px rgba(0, 212, 255, 0.5))';
        });
    });
    
    // Floating cubes interaction
    const cubes = document.querySelectorAll('.cube');
    cubes.forEach(cube => {
        cube.addEventListener('click', function() {
            this.style.animation = 'cubeFloat 2s ease-in-out';
            setTimeout(() => {
                this.style.animation = 'cubeFloat 8s infinite ease-in-out';
            }, 2000);
        });
    });
}

// Show skill modal (enhanced)
function showSkillModal(skill) {
    const modal = document.createElement('div');
    modal.className = 'skill-modal';
    modal.innerHTML = `
        <div class="modal-content-3d">
            <div class="modal-header">
                <h3>${skill} Skills</h3>
                <button class="modal-close">&times;</button>
            </div>
            <div class="modal-body">
                <div class="skill-visualization">
                    <div class="skill-cube">
                        <div class="cube-face front">${skill}</div>
                        <div class="cube-face back">Expert</div>
                        <div class="cube-face right">Level</div>
                        <div class="cube-face left">High</div>
                        <div class="cube-face top">Pro</div>
                        <div class="cube-face bottom">Advanced</div>
                    </div>
                </div>
                <p>Specialized in ${skill.toLowerCase()} technologies and best practices.</p>
            </div>
        </div>
    `;
    
    // Add modal styles
    modal.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10000;
        backdrop-filter: blur(10px);
        opacity: 0;
        transition: opacity 0.3s ease;
    `;
    
    document.body.appendChild(modal);
    
    // Animate in
    setTimeout(() => {
        modal.style.opacity = '1';
    }, 10);
    
    // Close modal
    const closeBtn = modal.querySelector('.modal-close');
    closeBtn.addEventListener('click', () => {
        modal.style.opacity = '0';
        setTimeout(() => {
            document.body.removeChild(modal);
        }, 300);
    });
    
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.style.opacity = '0';
            setTimeout(() => {
                document.body.removeChild(modal);
            }, 300);
        }
    });
}

// Add new CSS for book flip animation
const bookStyles = document.createElement('style');
bookStyles.textContent = `
    @keyframes bookFlip {
        0% { transform: rotateY(0deg) rotateX(0deg); }
        25% { transform: rotateY(-90deg) rotateX(10deg); }
        50% { transform: rotateY(-180deg) rotateX(0deg); }
        75% { transform: rotateY(-270deg) rotateX(-10deg); }
        100% { transform: rotateY(-360deg) rotateX(0deg); }
    }
    
    .skill-modal .modal-content-3d {
        background: var(--secondary-bg);
        border-radius: var(--border-radius-md);
        padding: 2rem;
        max-width: 500px;
        transform-style: preserve-3d;
        transform: scale(0.8) rotateY(20deg);
        transition: transform 0.3s ease;
        border: 1px solid var(--accent-color);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
    }
    
    .skill-modal .modal-content-3d:hover {
        transform: scale(1) rotateY(0deg);
    }
    
    .skill-visualization {
        display: flex;
        justify-content: center;
        margin: 2rem 0;
        perspective: 800px;
    }
    
    .skill-cube {
        width: 100px;
        height: 100px;
        position: relative;
        transform-style: preserve-3d;
        animation: modalCubeRotate 4s infinite linear;
    }
    
    .skill-cube .cube-face {
        position: absolute;
        width: 100px;
        height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 0.8rem;
        border: 2px solid var(--accent-color);
        color: var(--text-primary);
    }
    
    .skill-cube .front { background: rgba(0, 212, 255, 0.2); transform: translateZ(50px); }
    .skill-cube .back { background: rgba(255, 107, 107, 0.2); transform: translateZ(-50px) rotateY(180deg); }
    .skill-cube .right { background: rgba(0, 212, 255, 0.2); transform: rotateY(90deg) translateZ(50px); }
    .skill-cube .left { background: rgba(255, 107, 107, 0.2); transform: rotateY(-90deg) translateZ(50px); }
    .skill-cube .top { background: rgba(0, 212, 255, 0.2); transform: rotateX(90deg) translateZ(50px); }
    .skill-cube .bottom { background: rgba(255, 107, 107, 0.2); transform: rotateX(-90deg) translateZ(50px); }
    
    @keyframes modalCubeRotate {
        0% { transform: rotateX(0deg) rotateY(0deg); }
        100% { transform: rotateX(360deg) rotateY(360deg); }
    }
    
    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid var(--accent-color);
    }
    
    .modal-close {
        background: none;
        border: none;
        color: var(--text-primary);
        font-size: 2rem;
        cursor: pointer;
        transition: color 0.3s ease;
    }
    
    .modal-close:hover {
        color: var(--highlight-color);
    }
`;
document.head.appendChild(bookStyles);

// Parallax Effects with 3D Enhancement
function initParallaxEffects() {
    const techIcons = document.querySelectorAll('.tech-icon');
    const cubes = document.querySelectorAll('.cube');
    const spheres = document.querySelectorAll('.sphere');
    
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const parallax = scrolled * 0.5;
        
        // 3D Tech Icons parallax
        techIcons.forEach((icon, index) => {
            const speed = (index + 1) * 0.3;
            const rotation = scrolled * 0.1;
            icon.style.transform = `
                translateY(${parallax * speed}px) 
                rotateY(${rotation}deg) 
                rotateX(${rotation * 0.5}deg)
            `;
        });
        
        // Floating cubes parallax
        cubes.forEach((cube, index) => {
            const speed = (index + 1) * 0.2;
            const rotation = scrolled * 0.05;
            cube.style.transform = `
                translateY(${parallax * speed}px) 
                rotateX(${rotation}deg) 
                rotateY(${rotation * 2}deg)
            `;
        });
        
        // Knowledge spheres parallax
        spheres.forEach((sphere, index) => {
            const speed = (index + 1) * 0.15;
            const rotation = scrolled * 0.02;
            sphere.style.transform = `
                translateY(${parallax * speed}px) 
                rotateY(${rotation * 3}deg)
            `;
        });
    });
}

// Enhanced 3D cursor effects
function init3DCursorEffects() {
    const cursor3D = document.createElement('div');
    cursor3D.className = 'cursor-3d';
    cursor3D.innerHTML = `
        <div class="cursor-dot"></div>
        <div class="cursor-ring"></div>
    `;
    
    cursor3D.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        pointer-events: none;
        z-index: 9999;
        mix-blend-mode: difference;
    `;
    
    const cursorStyles = document.createElement('style');
    cursorStyles.textContent = `
        .cursor-dot {
            width: 8px;
            height: 8px;
            background: var(--accent-color);
            border-radius: 50%;
            transform: translate(-50%, -50%);
        }
        
        .cursor-ring {
            position: absolute;
            top: 0;
            left: 0;
            width: 40px;
            height: 40px;
            border: 2px solid var(--accent-color);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.3s ease, height 0.3s ease;
            opacity: 0.5;
        }
        
        .cursor-3d.active .cursor-ring {
            width: 60px;
            height: 60px;
            border-color: var(--highlight-color);
        }
    `;
    
    document.head.appendChild(cursorStyles);
    document.body.appendChild(cursor3D);
    
    // Cursor movement
    document.addEventListener('mousemove', (e) => {
        cursor3D.style.left = e.clientX + 'px';
        cursor3D.style.top = e.clientY + 'px';
    });
    
    // Interactive elements
    const interactiveElements = document.querySelectorAll('a, button, .project-card, .cert-card, .skill-category, .book-3d, .sphere, .cube');
    interactiveElements.forEach(el => {
        el.addEventListener('mouseenter', () => {
            cursor3D.classList.add('active');
        });
        
        el.addEventListener('mouseleave', () => {
            cursor3D.classList.remove('active');
        });
    });
}

// Initialize 3D cursor effects
init3DCursorEffects();

// Utility Functions
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

function throttle(func, limit) {
    let inThrottle;
    return function() {
        const args = arguments;
        const context = this;
        if (!inThrottle) {
            func.apply(context, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    }
}

// Performance optimizations
window.addEventListener('scroll', throttle(updateActiveNavigation, 100));
window.addEventListener('resize', debounce(function() {
    // Handle resize events
    const navMenu = document.querySelector('.nav-menu');
    if (window.innerWidth > 768) {
        navMenu.classList.remove('active');
    }
}, 250));

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const navMenu = document.querySelector('.nav-menu');
        const hamburger = document.querySelector('.hamburger');
        navMenu.classList.remove('active');
        hamburger.classList.remove('active');
    }
});

// Preload critical images
function preloadImages() {
    const imageUrls = [
        'https://via.placeholder.com/400x250'
    ];
    
    imageUrls.forEach(url => {
        const img = new Image();
        img.src = url;
    });
}

// Initialize preloading
preloadImages();

// Add loading screen (optional)
window.addEventListener('load', function() {
    const loader = document.querySelector('.loader');
    if (loader) {
        loader.style.opacity = '0';
        setTimeout(() => {
            loader.style.display = 'none';
        }, 500);
    }
});

// Error handling for 3D elements
document.addEventListener('DOMContentLoaded', function() {
    // Check for 3D support
    const test3D = document.createElement('div');
    test3D.style.transform = 'translateZ(0)';
    const has3DSupport = test3D.style.transform !== '';
    
    if (!has3DSupport) {
        console.warn('3D transforms not supported, falling back to 2D');
        document.body.classList.add('no-3d-support');
    }
    
    // Fallback styles for non-3D browsers
    const fallbackStyles = document.createElement('style');
    fallbackStyles.textContent = `
        .no-3d-support .room-3d,
        .no-3d-support .book-3d,
        .no-3d-support .cube,
        .no-3d-support .sphere {
            transform: none !important;
            animation: none !important;
        }
        
        .no-3d-support .project-card:hover {
            transform: translateY(-10px) !important;
        }
        
        .no-3d-support .cert-card:hover {
            transform: translateY(-5px) !important;
        }
    `;
    document.head.appendChild(fallbackStyles);
});

// Performance optimization for 3D animations
function optimizePerformance() {
    // Reduce animations on low-performance devices
    if (navigator.hardwareConcurrency && navigator.hardwareConcurrency < 4) {
        const reducedMotionStyles = document.createElement('style');
        reducedMotionStyles.textContent = `
            .room-3d { animation-duration: 40s !important; }
            .cube { animation-duration: 16s !important; }
            .sphere { animation-duration: 24s !important; }
            .book-3d { animation-duration: 16s !important; }
        `;
        document.head.appendChild(reducedMotionStyles);
    }
    
    // Pause animations when page is not visible
    document.addEventListener('visibilitychange', function() {
        const animatedElements = document.querySelectorAll('.room-3d, .cube, .sphere, .book-3d');
        if (document.hidden) {
            animatedElements.forEach(el => {
                el.style.animationPlayState = 'paused';
            });
        } else {
            animatedElements.forEach(el => {
                el.style.animationPlayState = 'running';
            });
        }
    });
}

// Initialize performance optimizations
optimizePerformance();

console.log('🚀 3D Portfolio loaded successfully with enhanced interactions!');
