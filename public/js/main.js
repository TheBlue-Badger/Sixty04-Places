/* ============================================
   SIXTY04 PLACES Core JavaScript
   ============================================ */

document.addEventListener('DOMContentLoaded', () => {
  initNavbar();
  initMobileMenu();
  initScrollAnimations();
  initAccordion();
  initTestimonialCarousel();
  initSmoothScroll();
  initCurrencyToggle();
});

/* --- Sticky Navbar --- */
function initNavbar() {
  const navbar = document.querySelector('.navbar');
  if (!navbar) return;
  // Pages without a transparent hero (i.e. not the homepage) render the
  // navbar already "scrolled" (solid) — keep it solid, don't let scroll
  // position strip that away and leave white text on a light background.
  if (navbar.classList.contains('scrolled')) return;
  const onScroll = () => {
    navbar.classList.toggle('scrolled', window.scrollY > 50);
  };
  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();
}

/* --- Mobile Menu --- */
function initMobileMenu() {
  const toggle = document.getElementById('mobile-toggle');
  const menu = document.getElementById('mobile-menu');
  const close = document.getElementById('mobile-close');
  if (!toggle || !menu) return;
  const open = () => { menu.classList.add('active'); toggle.setAttribute('aria-expanded', 'true'); };
  const close_ = () => { menu.classList.remove('active'); toggle.setAttribute('aria-expanded', 'false'); };
  toggle.addEventListener('click', open);
  if (close) close.addEventListener('click', close_);
  menu.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', close_);
  });
}

/* --- Scroll Animations --- */
function initScrollAnimations() {
  const elements = document.querySelectorAll('.animate-on-scroll');
  if (!elements.length) return;
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
  elements.forEach(el => observer.observe(el));
}

/* --- Accordion --- */
function initAccordion() {
  document.querySelectorAll('.accordion-header').forEach(header => {
    header.addEventListener('click', () => {
      const item = header.parentElement;
      const content = item.querySelector('.accordion-content');
      const isActive = item.classList.contains('active');
      // Close all
      item.closest('.accordion')?.querySelectorAll('.accordion-item').forEach(i => {
        i.classList.remove('active');
        i.querySelector('.accordion-content').style.maxHeight = '0';
      });
      // Open clicked if was closed
      if (!isActive) {
        item.classList.add('active');
        content.style.maxHeight = content.scrollHeight + 'px';
      }
    });
  });
}

/* --- Testimonial Carousel --- */
function initTestimonialCarousel() {
  const track = document.querySelector('.testimonial-track');
  const dots = document.querySelectorAll('.testimonial-dot');
  if (!track || !dots.length) return;
  let current = 0;
  const cards = track.children;
  const total = Math.ceil(cards.length / getVisibleCount());

  function getVisibleCount() {
    if (window.innerWidth < 768) return 1;
    if (window.innerWidth < 1024) return 2;
    return 3;
  }

  function goTo(index) {
    current = index;
    const shift = -(current * (100 / getVisibleCount()));
    track.style.transform = `translateX(${shift}%)`;
    dots.forEach((d, i) => d.classList.toggle('active', i === current));
  }

  dots.forEach((dot, i) => dot.addEventListener('click', () => goTo(i)));

  // Auto advance
  setInterval(() => {
    current = (current + 1) % total;
    goTo(current);
  }, 5000);
}

/* --- Smooth Scroll --- */
function initSmoothScroll() {
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      const id = this.getAttribute('href');
      if (id === '#') return;
      const target = document.querySelector(id);
      if (target) {
        e.preventDefault();
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }
    });
  });
}

/* --- Currency Toggle --- */
function initCurrencyToggle() {
  const toggles = document.querySelectorAll('.currency-toggle button');
  if (!toggles.length) return;
  const rates = { ZAR: 1, USD: 0.055, EUR: 0.051, GBP: 0.043 };
  const symbols = { ZAR: 'R', USD: '$', EUR: '€', GBP: '£' };

  toggles.forEach(btn => {
    btn.addEventListener('click', () => {
      toggles.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      const currency = btn.dataset.currency;
      document.querySelectorAll('[data-price-zar]').forEach(el => {
        const zarPrice = parseFloat(el.dataset.priceZar);
        const converted = Math.round(zarPrice * rates[currency]);
        el.textContent = `${symbols[currency]}${converted.toLocaleString()}`;
      });
    });
  });
}

/* --- WhatsApp Link Generator --- */
function generateWhatsAppLink(message) {
  const phone = '27683282839';
  const encoded = encodeURIComponent(message);
  return `https://wa.me/${phone}?text=${encoded}`;
}

/* --- Form Helpers --- */
function validateEmail(email) {
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

function showNotification(message, type = 'success') {
  const existing = document.querySelector('.notification');
  if (existing) existing.remove();
  const div = document.createElement('div');
  div.className = `notification notification-${type}`;
  div.innerHTML = `<i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i> ${message}`;
  Object.assign(div.style, {
    position: 'fixed', top: '24px', right: '24px', zIndex: '9999',
    padding: '16px 24px', borderRadius: '12px', color: '#fff', fontWeight: '600',
    fontSize: '0.9rem', display: 'flex', alignItems: 'center', gap: '10px',
    boxShadow: '0 8px 30px rgba(0,0,0,0.2)',
    background: type === 'success' ? '#2d6a4f' : '#dc2626',
    animation: 'fadeInUp 0.4s ease'
  });
  document.body.appendChild(div);
  setTimeout(() => { div.style.opacity = '0'; setTimeout(() => div.remove(), 400); }, 4000);
}

/* --- Counter Animation --- */
function animateCounters() {
  document.querySelectorAll('[data-count]').forEach(el => {
    const target = parseInt(el.dataset.count);
    const suffix = el.dataset.suffix || '';
    let current = 0;
    const step = target / 60;
    const interval = setInterval(() => {
      current += step;
      if (current >= target) { current = target; clearInterval(interval); }
      el.textContent = Math.floor(current).toLocaleString() + suffix;
    }, 25);
  });
}

// Trigger counters when trust section is visible
const trustSection = document.querySelector('.trust-bar');
if (trustSection) {
  const counterObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        animateCounters();
        counterObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.3 });
  counterObserver.observe(trustSection);
}

/* --- Multi-Step Booking Form --- */
function initMultiStepForm() {
    const formContainer = document.getElementById('multi-step-form');
    if (!formContainer) return;

    const steps = document.querySelectorAll('.booking-step');
    const indicators = document.querySelectorAll('.step-indicator');
    const nextBtns = document.querySelectorAll('.btn-next');
    const prevBtns = document.querySelectorAll('.btn-prev');
    let currentStep = 0;

    function showStep(index) {
        steps.forEach((step, i) => {
            step.classList.toggle('active', i === index);
        });
        indicators.forEach((indicator, i) => {
            indicator.classList.toggle('active', i === index);
            indicator.classList.toggle('completed', i < index);
        });
        currentStep = index;
        window.scrollTo({ top: formContainer.offsetTop - 100, behavior: 'smooth' });
    }

    function validateStep(index) {
        const step = steps[index];
        const inputs = step.querySelectorAll('input[required], select[required]');
        let valid = true;
        inputs.forEach(input => {
            if (!input.value) {
                valid = false;
                input.style.borderColor = 'var(--red-500)';
            } else {
                input.style.borderColor = 'var(--gray-300)';
            }
        });
        if (!valid) showNotification('Please fill out all required fields.', 'error');
        return valid;
    }

    nextBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            if (validateStep(currentStep) && currentStep < steps.length - 1) {
                showStep(currentStep + 1);
            }
        });
    });

    prevBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            if (currentStep > 0) {
                showStep(currentStep - 1);
            }
        });
    });

    // Handle Payment Submit
    const paymentForm = document.getElementById('payment-form');
    const overlay = document.getElementById('processing-overlay');
    if (paymentForm && overlay) {
        paymentForm.addEventListener('submit', (e) => {
            e.preventDefault();
            if (!validateStep(currentStep)) return;
            
            overlay.classList.add('active');
            
            // Mock API delay
            setTimeout(() => {
                overlay.classList.remove('active');
                formContainer.innerHTML = `
                    <div class="text-center" style="padding: 40px 20px;">
                        <i class="fas fa-check-circle" style="font-size: 4rem; color: var(--green-500); margin-bottom: 24px;"></i>
                        <h2 style="margin-bottom: 16px;">Booking Confirmed!</h2>
                        <p style="color: var(--gray-600); margin-bottom: 24px;">Thank you for your payment. Your itinerary and receipt have been emailed to you.</p>
                        <a href="index.html" class="btn btn-primary">Return to Home</a>
                    </div>
                `;
            }, 2500);
        });
    }
}

// Ensure initMultiStepForm is called on DOMContentLoaded
document.addEventListener('DOMContentLoaded', () => {
    initMultiStepForm();
});

/* ============================================
   Payment Method Helpers
   ============================================ */

// Card type detection — highlights the correct network icon
function detectCardType(input) {
    // Auto-format with spaces every 4 digits
    let v = input.value.replace(/\D/g, '').substring(0, 16);
    input.value = v.replace(/(.{4})/g, '$1 ').trim();

    const num = v;
    const icon = document.getElementById('card-type-icon');
    if (!icon) return;

    const networks = {
        'icon-visa':       { regex: /^4/, fa: 'fab fa-cc-visa', color: '#1a1f71' },
        'icon-mastercard': { regex: /^5[1-5]|^2[2-7]/, fa: 'fab fa-cc-mastercard', color: '#eb001b' },
        'icon-amex':       { regex: /^3[47]/, fa: 'fab fa-cc-amex', color: '#007bc1' },
        'icon-discover':   { regex: /^6(?:011|5)/, fa: 'fab fa-cc-discover', color: '#ff6600' },
        'icon-diners':     { regex: /^3(?:0[0-5]|[68])/, fa: 'fab fa-cc-diners-club', color: '#004a97' },
        'icon-jcb':        { regex: /^35/, fa: 'fab fa-cc-jcb', color: '#003087' },
    };

    let matched = null;
    for (const [id, info] of Object.entries(networks)) {
        const el = document.getElementById(id);
        if (el) el.classList.remove('detected');
        if (num.length > 0 && info.regex.test(num)) {
            matched = { id, info };
        }
    }

    if (matched) {
        const el = document.getElementById(matched.id);
        if (el) el.classList.add('detected');
        icon.innerHTML = `<i class="${matched.info.fa}" style="font-size:1.7rem;color:${matched.info.color};"></i>`;
    } else {
        icon.innerHTML = `<i class="fas fa-credit-card" style="font-size:1.2rem;color:var(--gray-300);"></i>`;
    }
}

// Auto-format expiry MM / YY
function formatExpiry(input) {
    let v = input.value.replace(/\D/g, '').substring(0, 4);
    if (v.length >= 3) {
        v = v.substring(0, 2) + ' / ' + v.substring(2);
    } else if (v.length === 2 && !input.value.includes('/')) {
        v = v + ' / ';
    }
    input.value = v;
}

// Switch between Card and PayPal tabs
function switchPayTab(method) {
    const tabCard    = document.getElementById('tab-card');
    const tabPaypal  = document.getElementById('tab-paypal');
    const panelCard  = document.getElementById('panel-card');
    const panelPP    = document.getElementById('panel-paypal');
    const acceptedCards = document.getElementById('accepted-cards');
    const payBtn     = document.getElementById('pay-btn');
    const payLabel   = document.getElementById('pay-btn-label');

    if (method === 'card') {
        tabCard.classList.add('active');
        tabPaypal.classList.remove('active');
        panelCard.style.display = 'block';
        panelPP.style.display   = 'none';
        if (acceptedCards) acceptedCards.style.display = 'flex';
        if (payBtn)   { payBtn.classList.remove('paypal-mode'); }
        if (payLabel) { payLabel.textContent = 'Pay Securely Now'; }
    } else {
        tabPaypal.classList.add('active');
        tabCard.classList.remove('active');
        panelCard.style.display = 'none';
        panelPP.style.display   = 'block';
        if (acceptedCards) acceptedCards.style.display = 'none';
        if (payBtn)   { payBtn.classList.add('paypal-mode'); }
        if (payLabel) { payLabel.textContent = 'Continue to PayPal'; }
    }
}

