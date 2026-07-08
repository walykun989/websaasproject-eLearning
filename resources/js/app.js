import './bootstrap';
import Alpine from 'alpinejs';

// Initialize Alpine.js
window.Alpine = Alpine;
Alpine.start();

// Preloader with Matrix Rain Animation (hacker style)
window.addEventListener('load', () => {
    const preloader = document.getElementById('preloader');
    const matrixRain = document.getElementById('matrix-rain');
    const body = document.getElementById('app-body');

    if (!preloader || !matrixRain) return;

    // Check if preloader has been shown in this session
    if (sessionStorage.getItem('preloaderShown')) {
        // Skip preloader, show content immediately
        if (preloader.parentNode) {
            preloader.parentNode.removeChild(preloader);
        }
        if (body) {
            body.classList.remove('overflow-hidden');
            body.style.overflow = 'auto';
        }
        return;
    }

    // Mark preloader as shown for this session
    sessionStorage.setItem('preloaderShown', 'true');

    const chars = '01アイウエオカキクケコサシスセソタチツテトナニヌネノABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@#$%^&*';
    const columns = Math.floor(window.innerWidth / 20);
    const columnElements = [];

    // Create Matrix rain columns
    const createMatrixRain = () => {
        for (let i = 0; i < columns; i++) {
            const column = document.createElement('div');
            column.className = 'matrix-column';
            column.style.left = `${i * 20}px`;

            const delay = Math.random() * 2000;
            const duration = 2000 + Math.random() * 1000;
            column.style.animationDelay = `${delay}ms`;
            column.style.animationDuration = `${duration}ms`;

            let text = '';
            const charCount = 20;
            for (let j = 0; j < charCount; j++) {
                text += chars[Math.floor(Math.random() * chars.length)] + '\n';
            }
            column.textContent = text;

            matrixRain.appendChild(column);
            columnElements.push(column);
        }
    };

    // Morph characters to create hacker decoding effect
    const morphCharacters = () => {
        columnElements.forEach(column => {
            const lines = column.textContent.split('\n');
            const morphedLines = lines.map(char => {
                // Randomly decide if this character should morph (30% chance)
                if (Math.random() < 0.3) {
                    return chars[Math.floor(Math.random() * chars.length)];
                }
                return char;
            });
            column.textContent = morphedLines.join('\n');
        });
    };

    // Start Matrix rain
    createMatrixRain();

    // Start morphing effect - changes characters every 80ms for rapid hacker effect
    const morphInterval = setInterval(morphCharacters, 80);

    // Fade out preloader after animation (3 seconds total)
    setTimeout(() => {
        clearInterval(morphInterval);
        matrixRain.style.opacity = '0';
        matrixRain.style.transition = 'opacity 0.5s ease';

        setTimeout(() => {
            preloader.classList.add('fade-out');
            if (body) {
                body.classList.remove('overflow-hidden');
                body.style.overflow = 'auto';
            }

            setTimeout(() => {
                if (preloader.parentNode) {
                    preloader.parentNode.removeChild(preloader);
                }
            }, 1000);
        }, 500);
    }, 3000);
});

// Magnetic Button Effect
document.addEventListener('DOMContentLoaded', () => {
    const magneticButtons = document.querySelectorAll('.btn-magnetic, .magnetic-btn, a[href*="checkout"], button[type="submit"]');

    magneticButtons.forEach(button => {
        button.addEventListener('mousemove', (e) => {
            const rect = button.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;

            const strength = 0.3;
            button.style.transform = `translate(${x * strength}px, ${y * strength}px) scale(1.05)`;
        });

        button.addEventListener('mouseleave', () => {
            button.style.transform = 'translate(0, 0) scale(1)';
        });
    });
});

// Smooth Scroll Reveal Animation
const observeElements = () => {
    const revealElements = document.querySelectorAll('.reveal-on-scroll, .card, .stats-card, .course-card');

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('revealed');
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    revealElements.forEach(el => {
        el.classList.add('reveal-on-scroll');
        observer.observe(el);
    });
};

// Initialize reveal animations setelah preloader selesai
setTimeout(observeElements, 2500);

// Smooth scrolling untuk internal links
document.addEventListener('click', (e) => {
    const target = e.target.closest('a[href^="#"]');
    if (target) {
        e.preventDefault();
        const id = target.getAttribute('href').slice(1);
        const element = document.getElementById(id);
        if (element) {
            element.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }
});
