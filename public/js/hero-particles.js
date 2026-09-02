// hero-particles.js
// Vanilla JS particle system for #hero-anti-gravity canvas

// Configuration defaults
const DEFAULTS = {
  particleCount: 70,
  radius: 130, // repulsion radius in px
  baseSpeed: 0.3, // upward speed
  maxSpeed: 3,
  sizeRange: [1, 3], // radius in px
  colors: ['#e0f2f1', '#c8e6c9', '#a5d6a7'],
};

function initHeroParticles(containerId, options = {}) {
  console.log('initHeroParticles called for', containerId);
  const config = { ...DEFAULTS, ...options };
  const container = document.getElementById(containerId);
  if (!container) {
    console.warn('Container not found:', containerId);
    return;
  }
  const canvas = container.querySelector('canvas');
  if (!canvas) {
    console.warn('Canvas not found in container');
    return;
  }
  const ctx = canvas.getContext('2d');
  let width = container.clientWidth;
  let height = container.clientHeight;
  canvas.width = width;
  canvas.height = height;

  // Particle class
  class Particle {
    constructor() {
      this.reset(true);
    }
    reset(initial = false) {
      this.x = Math.random() * width;
      this.y = initial ? Math.random() * height : height + Math.random() * 20;
      this.vx = 0;
      this.vy = -config.baseSpeed - Math.random() * 0.2;
      this.size = config.sizeRange[0] + Math.random() * (config.sizeRange[1] - config.sizeRange[0]);
      this.color = config.colors[Math.floor(Math.random() * config.colors.length)];
    }
    update(mouse) {
      // Apply repulsion if within radius
      if (mouse) {
        const dx = this.x - mouse.x;
        const dy = this.y - mouse.y;
        const dist2 = dx * dx + dy * dy;
        const rad2 = config.radius * config.radius;
        if (dist2 < rad2) {
          const dist = Math.sqrt(dist2) || 1;
          const force = (1 - dist / config.radius) * config.maxSpeed;
          this.vx += (dx / dist) * force;
          this.vy += (dy / dist) * force;
        }
      }
      // Dampen velocities for smooth return
      this.vx *= 0.95;
      this.vy *= 0.95;
      // Apply upward drift
      this.y += this.vy;
      this.x += this.vx;
      // Reset when out of view
      if (this.y < -10) this.reset();
      if (this.x < -10 || this.x > width + 10) this.x = Math.random() * width;
    }
    draw(ctx) {
      ctx.beginPath();
      ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
      ctx.fillStyle = this.color;
      ctx.fill();
    }
  }

  const particles = Array.from({ length: config.particleCount }, () => new Particle());
  let mousePos = null;

  // Mouse handling
  container.addEventListener('mousemove', (e) => {
    const rect = canvas.getBoundingClientRect();
    mousePos = { x: e.clientX - rect.left, y: e.clientY - rect.top };
  });
  container.addEventListener('mouseleave', () => {
    mousePos = null;
  });

  // Resize handling
  function onResize() {
    width = container.clientWidth;
    height = container.clientHeight;
    canvas.width = width;
    canvas.height = height;
  }
  window.addEventListener('resize', onResize);

  // Animation loop
  function animate() {
    ctx.clearRect(0, 0, width, height);
    particles.forEach(p => {
      p.update(mousePos);
      p.draw(ctx);
    });
    requestAnimationFrame(animate);
  }
  console.log('Starting animation loop');
  animate();
}

// Export to global (for non‑module usage)
window.initHeroParticles = initHeroParticles;
