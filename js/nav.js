// Mobile navigation toggle
const navToggle = document.querySelector('.nav-toggle');
const navLinks = document.querySelector('.nav-links');

if (navToggle && navLinks) {
    navToggle.addEventListener('click', () => {
        navLinks.classList.toggle('active');
        navToggle.classList.toggle('active');
    });
}

// Add confetti animation styles
const confettiStyle = document.createElement('style');
confettiStyle.textContent = `
    @keyframes confetti-fall {
        0% {
            transform: translateY(0) rotate(0deg);
            opacity: 1;
        }
        100% {
            transform: translateY(100vh) rotate(720deg);
            opacity: 0;
        }
    }
    .confetti-piece {
        position: fixed;
        pointer-events: none;
        z-index: 9999;
    }
`;
document.head.appendChild(confettiStyle);

// Easter egg: Confetti on flower click (navbar)
const flowerImg = document.querySelector('.nav-logo-img');
if (flowerImg) {
    flowerImg.style.cursor = 'pointer';
    flowerImg.addEventListener('click', createConfetti);
}

// Easter egg: Confetti on hero flower click (home page)
const heroFlower = document.querySelector('.hero-ornament img');
if (heroFlower) {
    heroFlower.style.cursor = 'pointer';
    heroFlower.addEventListener('click', createConfetti);
}

function createConfetti() {
    const colors = ['#DBD6D0', '#8F958F', '#ffffff', '#a8a098', '#6b756b'];
    const waves = 5;
    const confettiPerWave = 50;
    
    for (let wave = 0; wave < waves; wave++) {
        setTimeout(function() {
            for (let i = 0; i < confettiPerWave; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti-piece';
                
                const size = Math.random() * 10 + 5;
                const left = Math.random() * 100;
                const delay = Math.random() * 0.3;
                const duration = Math.random() * 2 + 2;
                const color = colors[Math.floor(Math.random() * colors.length)];
                
                confetti.style.width = size + 'px';
                confetti.style.height = size + 'px';
                confetti.style.background = color;
                confetti.style.left = left + 'vw';
                confetti.style.top = '-20px';
                confetti.style.opacity = Math.random() * 0.7 + 0.3;
                confetti.style.borderRadius = Math.random() > 0.5 ? '50%' : '0';
                confetti.style.animation = 'confetti-fall ' + duration + 's linear ' + delay + 's forwards';
                
                document.body.appendChild(confetti);
                
                setTimeout(function() {
                    confetti.remove();
                }, (duration + delay) * 1000 + 100);
            }
        }, wave * 600);
    }
}
