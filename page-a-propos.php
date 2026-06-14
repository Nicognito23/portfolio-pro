<?php
/**
 * Template page À propos.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<main id="main" class="site-main">

    <!-- ===================== SECTION 1 : HERO ===================== -->
    <section class="section-shell about-hero-section">
        <div class="container">
            <div class="about-hero-grid">

                <div class="about-hero-content">
                    <span class="about-hero-kicker">
                        <span class="about-hero-kicker-dot"></span>
                        Disponible pour nouveaux projets
                    </span>
                    <h1 class="about-hero-title">
                        Développeur WordPress junior —<br>
                        <span class="about-hero-accent">des sites qui servent vos objectifs.</span>
                    </h1>
                    <p class="about-hero-desc">
                        En formation chez OpenClassrooms depuis mars 2025, je crée des sites performants,
                        bien référencés et maintenables pour PME, startups, agences et particuliers.
                    </p>
                    <div class="hero-cta-row">
                        <a class="portfolio-primary-btn" href="<?php echo esc_url( home_url( '/#devis' ) ); ?>">
                            Demander un devis →
                        </a>
                        <a class="portfolio-secondary-btn" href="mailto:nicolasraux2@gmail.com">
                            Me contacter
                        </a>
                    </div>
                </div>

                <div class="about-id-card">
                    <div class="about-id-avatar">NR</div>
                    <p class="about-id-name">Nicolas Raux</p>
                    <p class="about-id-role">Développeur WordPress · Remote · France</p>
                    <div class="about-id-stats">
                        <div class="about-id-stat">
                            <span class="about-id-stat-val">2</span>
                            <span class="about-id-stat-lbl">Projets livrés</span>
                        </div>
                        <div class="about-id-stat">
                            <span class="about-id-stat-val">100%</span>
                            <span class="about-id-stat-lbl">Responsive</span>
                        </div>
                        <div class="about-id-stat">
                            <span class="about-id-stat-val">0</span>
                            <span class="about-id-stat-lbl">Page builder</span>
                        </div>
                        <div class="about-id-stat">
                            <span class="about-id-stat-val">SEO</span>
                            <span class="about-id-stat-lbl">Technique</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ===================== SECTION 2 : PARCOURS + POINTS FORTS ===================== -->
    <section class="section-shell">
        <div class="container">
            <div class="about-twin-grid">

                <div class="about-timeline-col">
                    <div class="section-heading">
                        <h2>Mon parcours</h2>
                        <p>Une progression structurée vers le freelance.</p>
                    </div>
                    <div class="about-timeline">
                        <div class="about-tl-item">
                            <div class="about-tl-dot">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                            </div>
                            <div class="about-tl-content">
                                <span class="about-tl-date">Mars 2025</span>
                                <p class="about-tl-text">Formation Développeur WordPress chez OpenClassrooms.</p>
                            </div>
                        </div>
                        <div class="about-tl-item">
                            <div class="about-tl-dot">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
                            </div>
                            <div class="about-tl-content">
                                <span class="about-tl-date">Prochaine étape</span>
                                <p class="about-tl-text">Parcours Intégrateur Web pour approfondir le front-end et l'accessibilité.</p>
                            </div>
                        </div>
                        <div class="about-tl-item about-tl-item--last">
                            <div class="about-tl-dot">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            </div>
                            <div class="about-tl-content">
                                <span class="about-tl-date">Objectif</span>
                                <p class="about-tl-text">Collaborer avec de vrais clients et produire des sites utiles, rapides et mémorables.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="about-strengths-col">
                    <div class="section-heading">
                        <h2>Points forts</h2>
                        <p>Ce que vous gagnez à travailler ensemble.</p>
                    </div>
                    <div class="about-strengths">
                        <div class="about-strength-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                            <span>SEO &amp; référencement structurel</span>
                        </div>
                        <div class="about-strength-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                            <span>Design soigné, moderne et cohérent</span>
                        </div>
                        <div class="about-strength-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                            <span>Communication claire et suivi transparent</span>
                        </div>
                        <div class="about-strength-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15 15 0 0 1 0 20M12 2a15 15 0 0 0 0 20"/></svg>
                            <span>Collaboration 100% remote</span>
                        </div>
                        <div class="about-strength-item">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            <span>Adapté aux PME, startups, agences et particuliers</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ===================== SECTION 3 : STACK ===================== -->
    <section class="section-shell">
        <div class="container">
            <div class="section-heading">
                <h2>Stack technique</h2>
                <p>Un socle WordPress solide, complété par des pratiques front-end et performance.</p>
            </div>
            <div class="about-stack-grid">

                <article class="about-stack-card">
                    <div class="about-stack-icon about-stack-icon--cyan">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
                    </div>
                    <h3>Front-end</h3>
                    <div class="about-stack-tags">
                        <span>HTML5</span><span>CSS3</span><span>JavaScript ES6</span><span>SCSS</span><span>Responsive</span>
                    </div>
                </article>

                <article class="about-stack-card">
                    <div class="about-stack-icon about-stack-icon--blue">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15 15 0 0 1 0 20M12 2a15 15 0 0 0 0 20"/></svg>
                    </div>
                    <h3>WordPress</h3>
                    <div class="about-stack-tags">
                        <span>Thèmes from scratch</span><span>CPT</span><span>ACF</span><span>Hooks</span><span>Elementor</span>
                    </div>
                </article>

                <article class="about-stack-card">
                    <div class="about-stack-icon about-stack-icon--amber">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/></svg>
                    </div>
                    <h3>Back-end & data</h3>
                    <div class="about-stack-tags">
                        <span>PHP</span><span>MySQL</span>
                    </div>
                </article>

                <article class="about-stack-card">
                    <div class="about-stack-icon about-stack-icon--green">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                    </div>
                    <h3>Qualité web</h3>
                    <div class="about-stack-tags">
                        <span>SEO technique</span><span>Core Web Vitals</span><span>Performance</span><span>Bonnes pratiques</span>
                    </div>
                </article>

            </div>
        </div>
    </section>

    <!-- ===================== SECTION 4 : CTA PANEL ===================== -->
    <section class="section-shell">
        <div class="container">
            <div class="about-cta-panel">
                <div class="about-cta-panel-text">
                    <h2>Parlons de votre projet</h2>
                    <p>Je vous réponds rapidement pour clarifier votre besoin et vous proposer une solution simple, évolutive et propre.</p>
                </div>
                <div class="about-cta-panel-btns">
                    <a class="portfolio-primary-btn" href="<?php echo esc_url( home_url( '/#devis' ) ); ?>">
                        Demander un devis →
                    </a>
                    <a class="portfolio-secondary-btn" href="mailto:nicolasraux2@gmail.com">
                        Me contacter
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
