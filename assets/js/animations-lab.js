/**
 * animations-lab.js
 * Chargé uniquement sur la page Animations (template page-animations.php).
 * Aucune dépendance externe — vanilla JS pur.
 * Détection tactile : pointer:coarse → versions mobile des animations 2, 3, 6
 */
document.addEventListener("DOMContentLoaded", function () {
 
 
  /* =========================================================
     0. HERO TERMINAL — phrases qui s'écrivent et s'effacent
  ========================================================= */
  var heroTermText = document.getElementById("anim-hero-terminal-text");
  if (heroTermText) {
    var heroPhrases = [
      "Aucune librairie externe utilisée.",
      "Vanilla JS + CSS pur uniquement.",
      "Passez la souris sur les démos.",
      "Utilisez le bouton Rejouer.",
      "8 animations — 5 JS · 3 SCSS."
    ];
    var htIdx     = 0;
    var htRunning = false;
 
    function htTypePhrase(phrase, cb) {
      var i = 0;
      heroTermText.textContent = "";
      function htTypeChar() {
        if (i < phrase.length) {
          heroTermText.textContent += phrase[i++];
          setTimeout(htTypeChar, 45 + Math.random() * 25);
        } else {
          setTimeout(function () { htErasePhrase(cb); }, 1600);
        }
      }
      htTypeChar();
    }
 
    function htErasePhrase(cb) {
      var text = heroTermText.textContent;
      var i    = text.length;
      function htEraseChar() {
        if (i > 0) {
          heroTermText.textContent = text.slice(0, --i);
          setTimeout(htEraseChar, 28);
        } else {
          setTimeout(cb, 300);
        }
      }
      htEraseChar();
    }
 
    function htLoop() {
      htTypePhrase(heroPhrases[htIdx], function () {
        htIdx = (htIdx + 1) % heroPhrases.length;
        htLoop();
      });
    }
 
    setTimeout(htLoop, 500);
  }
 
  // Détection mobile (écran tactile)
  var isTouchDevice = window.matchMedia("(pointer: coarse)").matches;
 
  /* =========================================================
     1. MORPHING TEXT — automatique (identique desktop/mobile)
  ========================================================= */
  var morphEl = document.getElementById("lab-morph");
  if (morphEl) {
    var words = ["Rapides", "Élégants", "Performants", "Responsives", "Optimisés"];
    var wIdx  = 0;
 
    function morphNext() {
      morphEl.style.transition = "opacity 0.3s ease, transform 0.3s ease";
      morphEl.style.opacity    = "0";
      morphEl.style.transform  = "translateY(-8px)";
      setTimeout(function () {
        wIdx = (wIdx + 1) % words.length;
        morphEl.textContent     = words[wIdx];
        morphEl.style.transform = "translateY(8px)";
        requestAnimationFrame(function () {
          morphEl.style.opacity   = "1";
          morphEl.style.transform = "translateY(0)";
        });
      }, 320);
    }
    setInterval(morphNext, 2400);
  }
 
  /* =========================================================
     2A. MAGNETIC BUTTON — desktop (souris)
     2B. RIPPLE EFFECT — mobile (tap)
  ========================================================= */
  var magZone = document.getElementById("lab-mag-zone");
  var magBtn  = document.getElementById("lab-mag-btn");
 
  if (magZone && magBtn) {
    if (!isTouchDevice) {
      // — Desktop : attraction magnétique
      magZone.addEventListener("mousemove", function (e) {
        var r    = magBtn.getBoundingClientRect();
        var cx   = r.left + r.width  / 2;
        var cy   = r.top  + r.height / 2;
        var dx   = e.clientX - cx;
        var dy   = e.clientY - cy;
        var dist = Math.sqrt(dx * dx + dy * dy);
        var RADIUS = 110;
        if (dist < RADIUS) {
          var pull = (RADIUS - dist) / RADIUS;
          magBtn.style.transform  = "translate(" + (dx * pull * 0.45) + "px," + (dy * pull * 0.45) + "px)";
          magBtn.style.boxShadow  = "0 8px 28px rgba(43,212,191," + (pull * 0.35) + ")";
        } else {
          magBtn.style.transform = "translate(0,0)";
          magBtn.style.boxShadow = "";
        }
      });
      magZone.addEventListener("mouseleave", function () {
        magBtn.style.transform = "translate(0,0)";
        magBtn.style.boxShadow = "";
      });
 
    } else {
      // — Mobile : ripple effect au tap
      magBtn.textContent = "Tapez ici →";
 
      magBtn.addEventListener("touchstart", function (e) {
        e.preventDefault();
        var touch = e.touches[0];
        var rect  = magBtn.getBoundingClientRect();
        var x     = touch.clientX - rect.left;
        var y     = touch.clientY - rect.top;
 
        // Créer le cercle ripple
        var ripple = document.createElement("span");
        ripple.style.cssText =
          "position:absolute;" +
          "width:8px;height:8px;" +
          "background:rgba(43,212,191,0.6);" +
          "border-radius:50%;" +
          "left:" + (x - 4) + "px;" +
          "top:" + (y - 4) + "px;" +
          "transform:scale(0);" +
          "pointer-events:none;" +
          "transition:transform 0.5s ease, opacity 0.5s ease;";
 
        var pos = window.getComputedStyle(magBtn).position;
        if (pos === "static") magBtn.style.position = "relative";
        magBtn.style.overflow = "hidden";
        magBtn.appendChild(ripple);
 
        requestAnimationFrame(function () {
          var size = Math.max(rect.width, rect.height) * 2.5;
          ripple.style.transform = "scale(" + size / 8 + ")";
          ripple.style.opacity   = "0";
        });
 
        setTimeout(function () { ripple.remove(); }, 600);
 
        // Feedback visuel bouton
        magBtn.style.transform = "scale(0.96)";
        setTimeout(function () { magBtn.style.transform = "scale(1)"; }, 150);
      }, { passive: false });
    }
  }
 
  /* =========================================================
     3A. 3D TILT CARD — desktop (souris)
     3B. GYROSCOPE TILT — mobile (orientation appareil)
  ========================================================= */
  var tiltZone = document.getElementById("lab-tilt-zone");
  var tiltCard = document.getElementById("lab-tilt-card");
  var tiltLabel = tiltCard ? tiltCard.querySelector(".lab-tilt-label") : null;
 
  if (tiltZone && tiltCard) {
    if (!isTouchDevice) {
      // — Desktop : rotation souris
      tiltZone.addEventListener("mousemove", function (e) {
        var r = tiltZone.getBoundingClientRect();
        var x = (e.clientX - r.left) / r.width  - 0.5;
        var y = (e.clientY - r.top)  / r.height - 0.5;
        tiltCard.style.transform = "rotateY(" + (x * 22) + "deg) rotateX(" + (-y * 22) + "deg) scale(1.06)";
        tiltCard.style.boxShadow = (x * 12) + "px " + (y * 12) + "px 32px rgba(43,212,191,0.18)";
      });
      tiltZone.addEventListener("mouseleave", function () {
        tiltCard.style.transform = "rotateY(0) rotateX(0) scale(1)";
        tiltCard.style.boxShadow = "none";
      });
 
    } else {
      // — Mobile : bounce ball (remplace 3D tilt)
      var bounceWrap = document.getElementById("lab-bounce-wrap");
      if (bounceWrap) {
        tiltCard.style.display   = "none";
        bounceWrap.style.display = "flex";
      }
      // Mettre à jour hint et infos
      var tiltHintEl  = document.getElementById("lab-tilt-hint");
      var tiltTitleEl = document.getElementById("lab-tilt-title");
      var tiltDescEl  = document.getElementById("lab-tilt-desc");
      if (tiltHintEl)  { tiltHintEl.className = "lab-hint lab-hint--auto"; tiltHintEl.innerHTML = "\u23F1 Automatique"; }
      if (tiltTitleEl) tiltTitleEl.textContent = "Bounce animation";
      if (tiltDescEl)  tiltDescEl.innerHTML = "Balle qui rebondit en boucle. <code>@keyframes</code> avec <code>cubic-bezier(0.33,0,0.66,0)</code> en <code>alternate</code> + ombre synchronisée.";
    }
  }
 
  /* =========================================================
     4. COUNTER — bouton rejouer + IntersectionObserver
  ========================================================= */
  var counterDemo   = document.getElementById("lab-counter-demo");
  var counterReplay = document.getElementById("lab-counter-replay");
 
  function easeOutCubic(t) { return 1 - Math.pow(1 - t, 3); }
 
  function animateCounter(el, target, duration) {
    el.textContent = "0";
    var start = Date.now();
    function tick() {
      var progress = Math.min((Date.now() - start) / duration, 1);
      el.textContent = Math.round(easeOutCubic(progress) * target);
      if (progress < 1) requestAnimationFrame(tick);
    }
    requestAnimationFrame(tick);
  }
 
  function runCounters() {
    if (!counterDemo) return;
    counterDemo.querySelectorAll(".lab-counter-num").forEach(function (el, i) {
      var target = parseInt(el.getAttribute("data-target"), 10) || 0;
      setTimeout(function () { animateCounter(el, target, 1400); }, i * 140);
    });
  }
 
  if (counterReplay) {
    counterReplay.addEventListener("click", function () {
      counterReplay.classList.add("is-spinning");
      runCounters();
      setTimeout(function () { counterReplay.classList.remove("is-spinning"); }, 1500);
    });
  }
 
  setTimeout(runCounters, 400);
 
  /* =========================================================
     5. STAGGER REVEAL — bouton rejouer
  ========================================================= */
  var staggerReplay = document.getElementById("lab-stagger-replay");
 
  function replayStagger() {
    var all = Array.prototype.slice.call(document.querySelectorAll(".lab-stagger-item"))
              .concat(Array.prototype.slice.call(document.querySelectorAll(".lab-stagger-bar")));
    all.forEach(function (el) { el.style.animationName = "none"; });
    requestAnimationFrame(function () {
      requestAnimationFrame(function () {
        all.forEach(function (el) { el.style.animationName = ""; });
      });
    });
  }
 
  if (staggerReplay) {
    staggerReplay.addEventListener("click", function () {
      staggerReplay.classList.add("is-spinning");
      replayStagger();
      setTimeout(function () { staggerReplay.classList.remove("is-spinning"); }, 900);
    });
  }
 
  /* =========================================================
     6A. GLITCH — desktop : auto + survol
     6B. GLITCH — mobile : auto + shake (DeviceMotion)
  ========================================================= */
  var glitchEl = document.getElementById("lab-glitch");
  if (glitchEl) {
    var glitching = false;
 
    function triggerGlitch() {
      if (glitching) return;
      glitching = true;
      glitchEl.classList.add("is-glitching");
      setTimeout(function () {
        glitchEl.classList.remove("is-glitching");
        glitching = false;
      }, 700);
    }
 
    // Auto toutes les 3s (desktop + mobile)
    setInterval(triggerGlitch, 3000);
 
    if (!isTouchDevice) {
      // — Desktop : survol
      var glitchZone = glitchEl.closest(".lab-card-demo");
      if (glitchZone) glitchZone.addEventListener("mouseenter", triggerGlitch);
 
    } else {
      // — Mobile : neon pulse (remplace glitch)
      var neonEl = document.getElementById("lab-neon-pulse");
      if (glitchEl) glitchEl.style.display    = "none";
      if (neonEl)   neonEl.style.display       = "block";
 
      // Mettre à jour hint et infos
      var glitchHintEl2 = document.getElementById("lab-glitch-hint");
      var glitchTitle2  = document.getElementById("lab-glitch-title");
      var glitchTag2    = document.getElementById("lab-glitch-tag");
      var glitchDesc2   = document.getElementById("lab-glitch-desc");
      if (glitchHintEl2) { glitchHintEl2.className = "lab-hint lab-hint--auto"; glitchHintEl2.innerHTML = "\u23F1 Automatique"; }
      if (glitchTitle2)  glitchTitle2.textContent = "Neon pulse";
      if (glitchTag2)    { glitchTag2.className = "lab-tag lab-tag--scss"; glitchTag2.textContent = "SCSS"; }
      if (glitchDesc2)   glitchDesc2.innerHTML = "Halo coloré qui pulse et change de couleur en boucle. <code>@keyframes</code> sur <code>text-shadow</code> avec 3 couleurs — cyan, bleu, amber.";
    }
  }
 
  /* =========================================================
     7. TYPEWRITER — auto + rejouer (identique desktop/mobile)
  ========================================================= */
  var typewriterEl     = document.getElementById("lab-typewriter");
  var typewriterReplay = document.getElementById("lab-typewriter-replay");
 
  if (typewriterEl) {
    var twPhrases = [
      "npm run sass:watch",
      "register_post_type()",
      "wp_enqueue_script()",
      "get_template_part()",
      "add_action( 'init' )"
    ];
    var twIdx     = 0;
    var twRunning = false;
 
    function typePhrase(phrase, cb) {
      var i = 0;
      typewriterEl.textContent = "";
      function typeChar() {
        if (i < phrase.length) {
          typewriterEl.textContent += phrase[i++];
          setTimeout(typeChar, 60 + Math.random() * 40);
        } else {
          setTimeout(function () { erasePhrase(cb); }, 1400);
        }
      }
      typeChar();
    }
 
    function erasePhrase(cb) {
      var text = typewriterEl.textContent;
      var i    = text.length;
      function eraseChar() {
        if (i > 0) {
          typewriterEl.textContent = text.slice(0, --i);
          setTimeout(eraseChar, 35);
        } else {
          setTimeout(cb, 300);
        }
      }
      eraseChar();
    }
 
    function twLoop() {
      typePhrase(twPhrases[twIdx], function () {
        twIdx = (twIdx + 1) % twPhrases.length;
        twLoop();
      });
    }
 
    function startTypewriter() {
      if (twRunning) return;
      twRunning = true;
      twIdx = 0;
      typewriterEl.textContent = "";
      twLoop();
    }
 
    setTimeout(startTypewriter, 600);
 
    if (typewriterReplay) {
      typewriterReplay.addEventListener("click", function () {
        typewriterReplay.classList.add("is-spinning");
        twRunning = false;
        typewriterEl.textContent = "";
        setTimeout(function () {
          startTypewriter();
          typewriterReplay.classList.remove("is-spinning");
        }, 200);
      });
    }
  }
 
  /* =========================================================
     8. LIQUID PROGRESS — auto-replay toutes les 5s
  ========================================================= */
  var liquidFills = document.querySelectorAll(".lab-liquid-fill");
 
  function replayLiquid() {
    liquidFills.forEach(function (el) {
      el.style.animation = "none";
      el.offsetHeight;
      el.style.animation = "";
    });
  }
 
  setInterval(replayLiquid, 5000);
 
});