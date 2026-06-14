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
      // Swap icônes hamburger / close
      var iconOpen  = navToggle.querySelector(".nav-icon-open");
      var iconClose = navToggle.querySelector(".nav-icon-close");
      if (iconOpen)  iconOpen.style.display  = isOpen ? "none"         : "";
      if (iconClose) iconClose.style.display = isOpen ? "inline-block" : "none";
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
 
  /* =========================================================
     6. STEPPER FORMULAIRE DEVIS
  ========================================================= */
  var stepperWrap = document.getElementById("quote-stepper");
  if (stepperWrap) {
 
    var currentStep = 1;
 
    // Navigation : Suivant
    stepperWrap.querySelectorAll(".quote-btn-next").forEach(function (btn) {
      btn.addEventListener("click", function () {
        var nextStep = parseInt(btn.getAttribute("data-next"), 10);
        if (!quoteValidateStep(currentStep)) return;
        quoteGoToStep(nextStep);
      });
    });
 
    // Navigation : Retour
    stepperWrap.querySelectorAll(".quote-btn-back").forEach(function (btn) {
      btn.addEventListener("click", function () {
        var backStep = parseInt(btn.getAttribute("data-back"), 10);
        quoteGoToStep(backStep);
      });
    });
 
    // Sélection des type-cards
    stepperWrap.querySelectorAll(".quote-type-card").forEach(function (card) {
      card.addEventListener("click", function () {
        stepperWrap.querySelectorAll(".quote-type-card").forEach(function (c) {
          c.classList.remove("is-selected");
        });
        card.classList.add("is-selected");
        var radio = card.querySelector("input[type='radio']");
        if (radio) radio.checked = true;
      });
    });
 
    // Sélection des pills budget
    stepperWrap.querySelectorAll(".quote-pill").forEach(function (pill) {
      pill.addEventListener("click", function () {
        stepperWrap.querySelectorAll(".quote-pill").forEach(function (p) {
          p.classList.remove("is-selected");
        });
        pill.classList.add("is-selected");
        var fieldId = pill.getAttribute("data-field");
        var hiddenInput = document.getElementById(fieldId);
        if (hiddenInput) hiddenInput.value = pill.getAttribute("data-value");
      });
    });
 
    function quoteGoToStep(step) {
      stepperWrap.querySelectorAll(".quote-step").forEach(function (s) {
        s.classList.add("quote-step--hidden");
      });
      var target = document.getElementById("quote-step-" + step);
      if (target) {
        target.classList.remove("quote-step--hidden");
        if (step === 3) quoteUpdateRecap();
        stepperWrap.scrollIntoView({ behavior: "smooth", block: "start" });
      }
      currentStep = step;
    }
 
    function quoteValidateStep(step) {
      if (step === 1) {
        var selected = stepperWrap.querySelector(".quote-type-card.is-selected");
        if (!selected) {
          quoteShowStepError(1, "Merci de sélectionner un type de projet.");
          return false;
        }
      }
      if (step === 2) {
        var message = document.getElementById("quote_message");
        if (message && message.value.trim() === "") {
          message.focus();
          message.style.borderColor = "rgba(255,80,80,0.6)";
          setTimeout(function () { message.style.borderColor = ""; }, 2000);
          return false;
        }
      }
      quoteRemoveStepError(step);
      return true;
    }
 
    function quoteShowStepError(step, msg) {
      var stepEl = document.getElementById("quote-step-" + step);
      if (!stepEl) return;
      var existing = stepEl.querySelector(".quote-step-error");
      if (existing) { existing.textContent = msg; return; }
      var err = document.createElement("p");
      err.className = "quote-step-error quote-feedback--error";
      err.textContent = msg;
      stepEl.querySelector(".quote-type-grid").insertAdjacentElement("afterend", err);
    }
 
    function quoteRemoveStepError(step) {
      var stepEl = document.getElementById("quote-step-" + step);
      if (!stepEl) return;
      var err = stepEl.querySelector(".quote-step-error");
      if (err) err.remove();
    }
 
    function quoteUpdateRecap() {
      var selectedCard = stepperWrap.querySelector(".quote-type-card.is-selected .quote-type-label");
      var recapType = document.getElementById("recap-type");
      if (recapType && selectedCard) recapType.textContent = selectedCard.textContent;
 
      var selectedPill = stepperWrap.querySelector(".quote-pill.is-selected");
      var recapBudget = document.getElementById("recap-budget");
      if (recapBudget) recapBudget.textContent = selectedPill ? selectedPill.textContent : "—";
 
      var deadlineInput = document.getElementById("quote_deadline");
      var recapDeadline = document.getElementById("recap-deadline");
      if (recapDeadline && deadlineInput) {
        recapDeadline.textContent = deadlineInput.value.trim() || "—";
      }
    }
  }
 
  /* =========================================================
     7. TERMINAL CODE ANIMATION — PAGE SERVICES
  ========================================================= */
  var terminalBody = document.getElementById("code-terminal-body");
  if (terminalBody) {
 
    var lines = [
      [
        { cls: "code-comment",  txt: "// Enregistrement du Custom Post Type" }
      ],
      [
        { cls: "code-keyword",  txt: "function " },
        { cls: "code-fn",       txt: "portfolio_register_cpt" },
        { cls: "code-plain",    txt: "() {" }
      ],
      [
        { cls: "code-plain",    txt: "  " },
        { cls: "code-fn",       txt: "register_post_type" },
        { cls: "code-plain",    txt: "( " },
        { cls: "code-string",   txt: "'projet'" },
        { cls: "code-plain",    txt: ", [" }
      ],
      [
        { cls: "code-plain",    txt: "    " },
        { cls: "code-string",   txt: "'public'" },
        { cls: "code-plain",    txt: "    => " },
        { cls: "code-value",    txt: "true" },
        { cls: "code-plain",    txt: "," }
      ],
      [
        { cls: "code-plain",    txt: "    " },
        { cls: "code-string",   txt: "'has_archive'" },
        { cls: "code-plain",    txt: " => " },
        { cls: "code-value",    txt: "true" },
        { cls: "code-plain",    txt: "," }
      ],
      [
        { cls: "code-plain",    txt: "    " },
        { cls: "code-string",   txt: "'supports'" },
        { cls: "code-plain",    txt: "  => [ " },
        { cls: "code-string",   txt: "'title'" },
        { cls: "code-plain",    txt: ", " },
        { cls: "code-string",   txt: "'editor'" },
        { cls: "code-plain",    txt: " ]," }
      ],
      [
        { cls: "code-plain",    txt: "  ] );" }
      ],
      [
        { cls: "code-plain",    txt: "}" }
      ],
      [
        { cls: "code-plain",    txt: "" }
      ],
      [
        { cls: "code-fn",       txt: "add_action" },
        { cls: "code-plain",    txt: "( " },
        { cls: "code-string",   txt: "'init'" },
        { cls: "code-plain",    txt: "," }
      ],
      [
        { cls: "code-plain",    txt: "  " },
        { cls: "code-string",   txt: "'portfolio_register_cpt'" },
        { cls: "code-plain",    txt: " );" }
      ],
      [
        { cls: "code-plain",    txt: "" }
      ],
      [
        { cls: "code-comment",  txt: "// Enqueue styles & scripts" }
      ],
      [
        { cls: "code-keyword",  txt: "function " },
        { cls: "code-fn",       txt: "portfolio_enqueue" },
        { cls: "code-plain",    txt: "() {" }
      ],
      [
        { cls: "code-plain",    txt: "  " },
        { cls: "code-fn",       txt: "wp_enqueue_style" },
        { cls: "code-plain",    txt: "(" }
      ],
      [
        { cls: "code-plain",    txt: "    " },
        { cls: "code-string",   txt: "'portfolio-style'" },
        { cls: "code-plain",    txt: "," }
      ],
      [
        { cls: "code-plain",    txt: "    " },
        { cls: "code-fn",       txt: "get_stylesheet_uri" },
        { cls: "code-plain",    txt: "()" }
      ],
      [
        { cls: "code-plain",    txt: "  );" }
      ],
      [
        { cls: "code-plain",    txt: "}" }
      ]
    ];
 
    var lineEls       = [];
    var charIdx       = 0;
    var lineIdx       = 0;
    var segIdx        = 0;
    var loopDelay     = 3500;
    var charDelay     = 28;
    var lineDelay     = 90;
    var cursor        = null;
    var terminalPaused = false;  // pause quand hors viewport
    var MAX_LINES     = 8;       // arrêt ligne 8 avant reset
 
    // Pause/reprise via IntersectionObserver
    if ("IntersectionObserver" in window) {
      var terminalObs = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          terminalPaused = !entry.isIntersecting;
        });
      }, { threshold: 0.1 });
      terminalObs.observe(terminalBody);
    }
 
    function buildLineEl(num) {
      var row = document.createElement("div");
      row.className = "code-line";
      var numEl = document.createElement("span");
      numEl.className = "code-line-num";
      numEl.textContent = num;
      row.appendChild(numEl);
      return row;
    }
 
    function placeCursor(parentEl) {
      if (cursor && cursor.parentNode) cursor.parentNode.removeChild(cursor);
      cursor = document.createElement("span");
      cursor.className = "code-cursor";
      parentEl.appendChild(cursor);
    }
 
    function typeNextChar() {
      // Si en pause, on attend et on re-tente
      if (terminalPaused) {
        setTimeout(typeNextChar, 200);
        return;
      }
 
      // Arrêt à MAX_LINES lignes puis pause longue avant reset
      if (lineIdx >= MAX_LINES) {
        if (cursor && cursor.parentNode) cursor.parentNode.removeChild(cursor);
        setTimeout(function () {
          if (terminalPaused) {
            setTimeout(typeNextChar, 200);
            return;
          }
          terminalBody.innerHTML = "";
          lineEls = [];
          lineIdx = 0;
          segIdx  = 0;
          charIdx = 0;
          setTimeout(typeNextChar, 400);
        }, loopDelay);
        return;
      }
 
      var segs    = lines[lineIdx];
      var seg     = segs[segIdx];
      var lineNum = lineIdx + 1;
 
      if (!lineEls[lineIdx]) {
        var rowEl = buildLineEl(lineNum);
        terminalBody.appendChild(rowEl);
        lineEls[lineIdx] = rowEl;
      }
 
      var rowEl = lineEls[lineIdx];
 
      if (seg.txt === "") {
        placeCursor(rowEl);
        lineIdx++;
        segIdx  = 0;
        charIdx = 0;
        setTimeout(typeNextChar, lineDelay);
        return;
      }
 
      var spans = rowEl.querySelectorAll("span:not(.code-line-num):not(.code-cursor)");
      var spanEl = spans[segIdx];
      if (!spanEl) {
        spanEl = document.createElement("span");
        spanEl.className = seg.cls;
        spanEl.textContent = "";
        rowEl.appendChild(spanEl);
      }
 
      spanEl.textContent = seg.txt.slice(0, charIdx + 1);
      placeCursor(spanEl);
      charIdx++;
 
      if (charIdx >= seg.txt.length) {
        segIdx++;
        charIdx = 0;
        if (segIdx >= segs.length) {
          lineIdx++;
          segIdx  = 0;
          charIdx = 0;
          setTimeout(typeNextChar, lineDelay);
        } else {
          setTimeout(typeNextChar, charDelay);
        }
      } else {
        setTimeout(typeNextChar, charDelay);
      }
    }
 
    setTimeout(typeNextChar, 600);
  }
 
  /* =========================================================
     8. FAQ ACCORDÉON — PAGE SERVICES
  ========================================================= */
  var faqWrap = document.getElementById("svc-faq");
  if (faqWrap) {
    faqWrap.querySelectorAll(".svc-faq-q").forEach(function (btn) {
      btn.addEventListener("click", function () {
        var item   = btn.closest(".svc-faq-item");
        var answer = item.querySelector(".svc-faq-a");
        var isOpen = btn.getAttribute("aria-expanded") === "true";
 
        faqWrap.querySelectorAll(".svc-faq-item").forEach(function (other) {
          other.querySelector(".svc-faq-q").setAttribute("aria-expanded", "false");
          other.querySelector(".svc-faq-a").hidden = true;
        });
 
        if (!isOpen) {
          btn.setAttribute("aria-expanded", "true");
          answer.hidden = false;
        }
      });
    });
  }
});