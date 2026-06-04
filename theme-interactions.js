document.addEventListener("DOMContentLoaded", function () {
  document.body.classList.add("js-ready");

  /* =========================================================
     1. MENU MOBILE
  ========================================================= */
  var navToggle = document.querySelector(".site-nav-toggle");
  var nav = document.getElementById("site-nav");
  if (navToggle && nav) {
    navToggle.addEventListener("click", function () {
      var isOpen = nav.classList.toggle("is-open");
      navToggle.setAttribute("aria-expanded", isOpen ? "true" : "false");
    });
  }

  /* =========================================================
     2. REVEAL ON SCROLL (IntersectionObserver)
  ========================================================= */
  var revealSelector =
    ".portfolio-project-card, .portfolio-single-project, .about-card, .about-highlight, .about-stack-card, .about-cta-panel, .skill-card, .elementor-widget, .elementor-column";
  var revealTargets = document.querySelectorAll(revealSelector);

  if ("IntersectionObserver" in window) {
    var observer = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add("is-visible");
            observer.unobserve(entry.target);
          }
        });
      },
      {
        threshold: 0.12,
        rootMargin: "0px 0px -40px 0px",
      }
    );
    revealTargets.forEach(function (element) {
      element.classList.add("reveal-on-scroll");
      observer.observe(element);
    });
  } else {
    revealTargets.forEach(function (element) {
      element.classList.add("is-visible");
    });
  }

  /* =========================================================
     3. DÉGRADÉ AU SCROLL — variables et fonctions
  ========================================================= */
  var root   = document.documentElement;
  var stops1 = ["#0a1628", "#081932", "#061e30", "#091628", "#0a1628"];
  var stops2 = ["#10243b", "#0d2a3a", "#0a2535", "#0e2038", "#10243b"];

  function hexToRgb(hex) {
    var r = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return r
      ? { r: parseInt(r[1], 16), g: parseInt(r[2], 16), b: parseInt(r[3], 16) }
      : { r: 0, g: 0, b: 0 };
  }

  function lerpChannel(a, b, t) {
    return Math.round(a + (b - a) * t);
  }

  function getScrollColor(progress, stops) {
    var scaled = progress * (stops.length - 1);
    var idx    = Math.min(Math.floor(scaled), stops.length - 2);
    var t      = scaled - idx;
    var a      = hexToRgb(stops[idx]);
    var b      = hexToRgb(stops[idx + 1]);
    return (
      "rgb(" +
      lerpChannel(a.r, b.r, t) + "," +
      lerpChannel(a.g, b.g, t) + "," +
      lerpChannel(a.b, b.b, t) +
      ")"
    );
  }

  /* =========================================================
     4. SCROLL PROGRESS + HEADER SCROLLED + DÉGRADÉ
  ========================================================= */
  var onScroll = function () {
    var maxScroll = Math.max(document.body.scrollHeight - window.innerHeight, 1);
    var progress  = Math.min(window.scrollY / maxScroll, 1);

    root.style.setProperty("--scroll-progress", progress.toFixed(4));
    root.style.setProperty("--bg-1", getScrollColor(progress, stops1));
    root.style.setProperty("--bg-2", getScrollColor(progress, stops2));

    if (window.scrollY > 16) {
      document.body.classList.add("is-scrolled");
    } else {
      document.body.classList.remove("is-scrolled");
    }
  };

  onScroll();
  window.addEventListener("scroll", onScroll, { passive: true });

  /* =========================================================
     5. EFFET SPOTLIGHT (halo cyan qui suit la souris)
  ========================================================= */
  var spotlightSelector =
    ".skill-card, .portfolio-project-card, .about-card, .about-stack-card, .about-highlight";

  function attachSpotlight(card) {
    if (card.querySelector(".card-spotlight")) return;

    var halo = document.createElement("span");
    halo.className = "card-spotlight";
    halo.style.cssText =
      "position:absolute;" +
      "width:280px;height:280px;" +
      "border-radius:50%;" +
      "pointer-events:none;" +
      "background:radial-gradient(circle, rgba(43,212,191,0.18) 0%, transparent 65%);" +
      "transform:translate(-50%,-50%);" +
      "opacity:0;" +
      "transition:opacity 0.35s ease;" +
      "z-index:0;";

    var pos = window.getComputedStyle(card).position;
    if (pos === "static") card.style.position = "relative";
    card.style.overflow = "hidden";
    card.insertBefore(halo, card.firstChild);

    card.addEventListener("mouseenter", function () { halo.style.opacity = "1"; });
    card.addEventListener("mouseleave", function () { halo.style.opacity = "0"; });
    card.addEventListener("mousemove", function (e) {
      var rect = card.getBoundingClientRect();
      halo.style.left = (e.clientX - rect.left) + "px";
      halo.style.top  = (e.clientY - rect.top)  + "px";
    });
  }

  document.querySelectorAll(spotlightSelector).forEach(attachSpotlight);

  if ("MutationObserver" in window) {
    var mutObs = new MutationObserver(function (mutations) {
      mutations.forEach(function (m) {
        m.addedNodes.forEach(function (node) {
          if (node.nodeType !== 1) return;
          if (node.matches && node.matches(spotlightSelector)) attachSpotlight(node);
          if (node.querySelectorAll) node.querySelectorAll(spotlightSelector).forEach(attachSpotlight);
        });
      });
    });
    mutObs.observe(document.body, { childList: true, subtree: true });
  }
});