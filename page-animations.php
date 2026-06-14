<?php
/**
 * Template : Page Animations Lab
 * Template Name: Animations
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
 
get_header();
 
$icon_clock  = '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>';
$icon_mouse  = '<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="7"/><line x1="12" y1="6" x2="12" y2="10"/></svg>';
$icon_replay = '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 4 23 10 17 10"/><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"/></svg>';
?>
 
<main id="main" class="site-main">
 
    <section class="section-shell section-shell--hero-anim">
        <div class="container">
            <div class="anim-hero">
                <span class="anim-hero-kicker">
                    <span class="about-hero-kicker-dot"></span>
                    Lab · Animations
                </span>
                <h1 class="anim-hero-title">
                    Micro-interactions <span class="anim-hero-accent">JS &amp; SCSS</span><br>
                    développées from scratch.
                </h1>
                <div class="anim-hero-terminal" id="anim-hero-terminal" aria-hidden="true">
                    <div class="anim-hero-terminal-bar">
                        <span class="anim-hero-terminal-dot"></span>
                        <span class="anim-hero-terminal-dot"></span>
                        <span class="anim-hero-terminal-dot"></span>
                    </div>
                    <div class="anim-hero-terminal-body">
                        <span class="anim-hero-terminal-prefix">// </span><span id="anim-hero-terminal-text"></span><span class="anim-hero-terminal-cursor">|</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
 
    <section class="section-shell">
        <div class="container">
            <div class="section-heading">
                <h2>Démos interactives</h2>
                <p>Huit animations — cinq en JS vanilla, trois en SCSS pur.</p>
            </div>
 
            <div class="lab-grid">
 
                <!-- 1. Morphing text -->
                <article class="lab-card">
                    <div class="lab-card-demo lab-card-demo--center">
                        <div class="morph-wrap">
                            <span class="morph-static">Je crée des sites&nbsp;</span>
                            <span class="morph-word" id="lab-morph">Rapides</span>
                        </div>
                    </div>
                    <div class="lab-ctrl">
                        <span class="lab-hint lab-hint--auto"><?php echo $icon_clock; ?> Automatique</span>
                    </div>
                    <div class="lab-card-info">
                        <div class="lab-card-header">
                            <h3 class="lab-card-title">Morphing text</h3>
                            <span class="lab-tag lab-tag--js">JS</span>
                        </div>
                        <p class="lab-card-desc">Un mot se dissout et se réassemble. <code>opacity</code> + <code>translateY</code> via <code>style</code> JS inline.</p>
                    </div>
                </article>
 
                <!-- 2. Magnetic button -->
                <article class="lab-card">
                    <div class="lab-card-demo lab-card-demo--center" id="lab-mag-zone">
                        <button class="lab-mag-btn" id="lab-mag-btn">Approchez la souris →</button>
                    </div>
                    <div class="lab-ctrl">
                        <span class="lab-hint lab-hint--mouse"><?php echo $icon_mouse; ?> Déplacez la souris dans la zone</span>
                    </div>
                    <div class="lab-card-info">
                        <div class="lab-card-header">
                            <h3 class="lab-card-title">Magnetic button</h3>
                            <span class="lab-tag lab-tag--js">JS</span>
                        </div>
                        <p class="lab-card-desc">Le bouton attire la souris dans un rayon de 110px. Distance euclidienne + <code>lerp</code> sur <code>translateX/Y</code>.</p>
                    </div>
                </article>
 
                <!-- 3. 3D Tilt (desktop) / Bounce ball (mobile) -->
                <article class="lab-card" id="lab-card-tilt">
                    <div class="lab-card-demo lab-card-demo--center" id="lab-tilt-zone">
                        <!-- Desktop -->
                        <div class="lab-tilt-card" id="lab-tilt-card">
                            <div class="lab-tilt-inner">
                                <span class="lab-tilt-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>
                                </span>
                                <p class="lab-tilt-label">Bougez la souris</p>
                            </div>
                        </div>
                        <!-- Mobile : bounce ball -->
                        <div class="lab-bounce-wrap" id="lab-bounce-wrap">
                            <div class="lab-bounce-ball"></div>
                            <div class="lab-bounce-shadow"></div>
                        </div>
                    </div>
                    <div class="lab-ctrl">
                        <span class="lab-hint lab-hint--mouse" id="lab-tilt-hint"><?php echo $icon_mouse; ?> Survolez la card</span>
                    </div>
                    <div class="lab-card-info">
                        <div class="lab-card-header">
                            <h3 class="lab-card-title" id="lab-tilt-title">3D Tilt card</h3>
                            <span class="lab-tag lab-tag--js">JS</span>
                        </div>
                        <p class="lab-card-desc" id="lab-tilt-desc">Rotation 3D selon la position curseur. <code>rotateX/Y</code> depuis <code>getBoundingClientRect</code> + <code>perspective</code> CSS.</p>
                    </div>
                </article>
 
                <!-- 4. Counter -->
                <article class="lab-card">
                    <div class="lab-card-demo lab-card-demo--center" id="lab-counter-demo">
                        <div class="lab-counter-wrap">
                            <div class="lab-counter-item">
                                <span class="lab-counter-num" data-target="98" id="lab-c1">0</span>
                                <span class="lab-counter-lbl">Perf score</span>
                            </div>
                            <div class="lab-counter-item">
                                <span class="lab-counter-num" data-target="100" id="lab-c2">0</span>
                                <span class="lab-counter-lbl">% Responsive</span>
                            </div>
                            <div class="lab-counter-item">
                                <span class="lab-counter-num" data-target="0" id="lab-c3">0</span>
                                <span class="lab-counter-lbl">Page builder</span>
                            </div>
                        </div>
                    </div>
                    <div class="lab-ctrl">
                        <span class="lab-hint lab-hint--auto"><?php echo $icon_clock; ?> Au chargement</span>
                        <button class="lab-replay-btn" id="lab-counter-replay" aria-label="Rejouer"><?php echo $icon_replay; ?> Rejouer</button>
                    </div>
                    <div class="lab-card-info">
                        <div class="lab-card-header">
                            <h3 class="lab-card-title">Counter animation</h3>
                            <span class="lab-tag lab-tag--js">JS</span>
                        </div>
                        <p class="lab-card-desc">Chiffres animés au chargement. Easing <code>ease-out cubic</code> via <code>requestAnimationFrame</code>.</p>
                    </div>
                </article>
 
                <!-- 5. Stagger reveal -->
                <article class="lab-card">
                    <div class="lab-card-demo lab-card-demo--center">
                        <div class="lab-stagger-wrap">
                            <div class="lab-stagger-item" style="--i:1">
                                <span class="lab-stagger-dot"></span>
                                <span class="lab-stagger-bar" style="width:82%"></span>
                            </div>
                            <div class="lab-stagger-item" style="--i:2">
                                <span class="lab-stagger-dot"></span>
                                <span class="lab-stagger-bar" style="width:64%"></span>
                            </div>
                            <div class="lab-stagger-item" style="--i:3">
                                <span class="lab-stagger-dot"></span>
                                <span class="lab-stagger-bar" style="width:74%"></span>
                            </div>
                            <div class="lab-stagger-item" style="--i:4">
                                <span class="lab-stagger-dot"></span>
                                <span class="lab-stagger-bar" style="width:55%"></span>
                            </div>
                        </div>
                    </div>
                    <div class="lab-ctrl">
                        <span class="lab-hint lab-hint--auto"><?php echo $icon_clock; ?> Au chargement</span>
                        <button class="lab-replay-btn" id="lab-stagger-replay" aria-label="Rejouer"><?php echo $icon_replay; ?> Rejouer</button>
                    </div>
                    <div class="lab-card-info">
                        <div class="lab-card-header">
                            <h3 class="lab-card-title">Stagger reveal</h3>
                            <span class="lab-tag lab-tag--scss">SCSS</span>
                        </div>
                        <p class="lab-card-desc">Apparition en cascade pure CSS. <code>animation-delay: calc(var(--i) * 120ms)</code> sur chaque enfant.</p>
                    </div>
                </article>
 
                <!-- 6. Glitch (desktop) / Neon pulse (mobile) -->
                <article class="lab-card">
                    <div class="lab-card-demo lab-card-demo--center">
                        <!-- Desktop : glitch -->
                        <h2 class="lab-glitch" data-text="Nicolas Raux" id="lab-glitch">Nicolas Raux</h2>
                        <!-- Mobile : neon pulse -->
                        <h2 class="lab-neon-pulse" id="lab-neon-pulse">Nicolas Raux</h2>
                    </div>
                    <div class="lab-ctrl">
                        <span class="lab-hint lab-hint--auto" id="lab-glitch-hint"><?php echo $icon_clock; ?> Auto + survol</span>
                    </div>
                    <div class="lab-card-info">
                        <div class="lab-card-header">
                            <h3 class="lab-card-title" id="lab-glitch-title">Glitch effect</h3>
                            <span class="lab-tag lab-tag--scss" id="lab-glitch-tag">SCSS + JS</span>
                        </div>
                        <p class="lab-card-desc" id="lab-glitch-desc">Décalage RGB sur <code>::before</code> / <code>::after</code> avec <code>clip-path</code> animé. Survol pour déclencher.</p>
                    </div>
                </article>
 
                <!-- 7. Typewriter -->
                <article class="lab-card">
                    <div class="lab-card-demo lab-card-demo--center">
                        <div class="lab-typewriter-wrap">
                            <span class="lab-typewriter-prefix">$ </span><span class="lab-typewriter-text" id="lab-typewriter"></span><span class="lab-typewriter-cursor">|</span>
                        </div>
                    </div>
                    <div class="lab-ctrl">
                        <span class="lab-hint lab-hint--auto"><?php echo $icon_clock; ?> Automatique</span>
                        <button class="lab-replay-btn" id="lab-typewriter-replay" aria-label="Rejouer"><?php echo $icon_replay; ?> Rejouer</button>
                    </div>
                    <div class="lab-card-info">
                        <div class="lab-card-header">
                            <h3 class="lab-card-title">Typewriter</h3>
                            <span class="lab-tag lab-tag--scss">SCSS + JS</span>
                        </div>
                        <p class="lab-card-desc">Texte tapé caractère par caractère. <code>setTimeout</code> récursif humanisé + curseur <code>@keyframes blink</code>.</p>
                    </div>
                </article>
 
                <!-- 8. Liquid progress -->
                <article class="lab-card">
                    <div class="lab-card-demo lab-card-demo--center">
                        <div class="lab-liquid-wrap">
                            <div class="lab-liquid-item">
                                <div class="lab-liquid-label">
                                    <span>Performance</span>
                                    <span class="lab-liquid-val">92%</span>
                                </div>
                                <div class="lab-liquid-track">
                                    <div class="lab-liquid-fill lab-liquid-fill--1"></div>
                                </div>
                            </div>
                            <div class="lab-liquid-item">
                                <div class="lab-liquid-label">
                                    <span>Accessibilité</span>
                                    <span class="lab-liquid-val">88%</span>
                                </div>
                                <div class="lab-liquid-track">
                                    <div class="lab-liquid-fill lab-liquid-fill--2"></div>
                                </div>
                            </div>
                            <div class="lab-liquid-item">
                                <div class="lab-liquid-label">
                                    <span>SEO</span>
                                    <span class="lab-liquid-val">95%</span>
                                </div>
                                <div class="lab-liquid-track">
                                    <div class="lab-liquid-fill lab-liquid-fill--3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="lab-ctrl">
                        <span class="lab-hint lab-hint--auto"><?php echo $icon_clock; ?> Automatique</span>
                    </div>
                    <div class="lab-card-info">
                        <div class="lab-card-header">
                            <h3 class="lab-card-title">Liquid progress</h3>
                            <span class="lab-tag lab-tag--scss">SCSS</span>
                        </div>
                        <p class="lab-card-desc">Barres avec vague liquide. <code>@keyframes</code> sur <code>border-radius</code> et <code>scaleX</code> d'un pseudo-élément <code>::after</code>.</p>
                    </div>
                </article>
 
            </div>
        </div>
    </section>
 
    <section class="section-shell">
        <div class="container">
            <div class="svc-cta-panel">
                <div class="svc-cta-text">
                    <h2>Ces animations dans votre projet ?</h2>
                    <p>Chaque micro-interaction peut être intégrée à votre site WordPress sur mesure. Discutons de ce qui correspond à votre image.</p>
                </div>
                <div class="svc-cta-btns">
                    <a class="portfolio-primary-btn" href="<?php echo esc_url( home_url( '/#devis' ) ); ?>">Demander un devis →</a>
                    <a class="portfolio-secondary-btn" href="<?php echo esc_url( home_url( '/services' ) ); ?>">Voir les prestations</a>
                </div>
            </div>
        </div>
    </section>
 
</main>
 
<?php get_footer();