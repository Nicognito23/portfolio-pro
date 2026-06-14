<?php
/**
 * Home page portfolio.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<main id="main" class="site-main">
    <section class="home-hero section-shell" id="accueil">
    <div class="container hero-grid">
        <div class="hero-content">
            <div class="hero-badge">
                <span class="hero-badge-dot"></span>
                <span>Disponible pour nouveaux projets</span>
            </div>
            <h1>Je crée des sites <span class="hero-accent">WordPress</span> rapides, élégants et qui convertissent.</h1>
            <p class="hero-desc">Thème sur mesure · PHP · SCSS · JS vanilla · SEO technique.<br>Portfolio construit from scratch — sans page builder.</p>
            <div class="hero-cta-row">
                <a href="#projets" class="portfolio-primary-btn">Voir mes projets →</a>
                <a href="#devis" class="portfolio-secondary-btn">Demander un devis</a>
            </div>
            <div class="hero-stats">
                <div class="hero-stat">
                    <span class="hero-stat-number" data-target="2">0</span>
                    <span class="hero-stat-label">Projets livrés</span>
                </div>
                <div class="hero-stat-divider"></div>
                <div class="hero-stat">
                    <span class="hero-stat-number">100%</span>
                    <span class="hero-stat-label">Responsive</span>
                </div>
                <div class="hero-stat-divider"></div>
                <div class="hero-stat">
                    <span class="hero-stat-number">0</span>
                    <span class="hero-stat-label">Page builder</span>
                </div>
            </div>
        </div>

        <div class="hero-cards">
            <div class="hero-card hero-card-identity">
                <div class="hero-avatar">NR</div>
                <p class="hero-card-name">Nicolas Raux</p>
                <p class="hero-card-role">Développeur WordPress Junior</p>
                <p class="hero-card-location">📍 France · Remote</p>
            </div>

            <div class="hero-card hero-card-stack">
                <p class="hero-card-stack-label">STACK</p>
                <div class="hero-stack-logos">
                    <div class="hero-stack-item">
                        <img src="<?php echo esc_url( get_theme_file_uri( 'assets/img/wordpress.svg' ) ); ?>" alt="WordPress" width="32" height="32">
                        <span>WordPress</span>
                    </div>
                    <div class="hero-stack-item">
                        <img src="<?php echo esc_url( get_theme_file_uri( 'assets/img/php.svg' ) ); ?>" alt="PHP" width="32" height="32">
                        <span>PHP</span>
                    </div>
                    <div class="hero-stack-item">
                        <img src="<?php echo esc_url( get_theme_file_uri( 'assets/img/javascript.svg' ) ); ?>" alt="JavaScript" width="32" height="32">
                        <span>JS</span>
                    </div>
                    <div class="hero-stack-item">
                        <img src="<?php echo esc_url( get_theme_file_uri( 'assets/img/sass.svg' ) ); ?>" alt="SCSS" width="32" height="32">
                        <span>SCSS</span>
                    </div>
                    <div class="hero-stack-item">
                        <img src="<?php echo esc_url( get_theme_file_uri( 'assets/img/mysql.svg' ) ); ?>" alt="MySQL" width="32" height="32">
                        <span>MySQL</span>
                    </div>
                </div>
            </div>

            <div class="hero-card hero-card-formation">
                <span class="hero-formation-icon">⚡</span>
                <div>
                    <p class="hero-formation-title">Formation OpenClassrooms</p>
                    <p class="hero-formation-sub">Développeur WordPress · 2025</p>
                </div>
            </div>
        </div>
    </div>
</section>

   <section class="section-shell" id="competences">
    <div class="container">
        <div class="section-heading">
            <h2>Compétences techniques</h2>
            <p>Stack orientée WordPress moderne, qualité de code et performance.</p>
        </div>

        <div class="bento-grid">

            <article class="bento-card bento-card--frontend">
                <div class="bento-card-header">
                    <div class="bento-icon bento-icon--cyan">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
                    </div>
                    <h3>Front-end</h3>
                </div>
                <div class="bento-tags">
                    <span>HTML5</span>
                    <span>CSS3</span>
                    <span>JavaScript ES6</span>
                    <span>SCSS</span>
                    <span>Responsive</span>
                    <span>Animations CSS/JS</span>
                </div>
            </article>

            <article class="bento-card bento-card--wordpress">
                <div class="bento-card-header">
                    <div class="bento-icon bento-icon--blue">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15 15 0 0 1 0 20M12 2a15 15 0 0 0 0 20"/></svg>
                    </div>
                    <h3>WordPress & PHP</h3>
                </div>
                <div class="bento-tags">
                    <span>Thèmes from scratch</span>
                    <span>Hooks & templates</span>
                    <span>CPT</span>
                    <span>ACF</span>
                    <span>PHP</span>
                    <span>Elementor</span>
                </div>
            </article>

            <article class="bento-card bento-card--seo">
                <div class="bento-card-header">
                    <div class="bento-icon bento-icon--amber">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                    </div>
                    <h3>SEO & Performances</h3>
                </div>
                <div class="bento-bars">
                    <div class="bento-bar-item">
                        <div class="bento-bar-label">
                            <span>Core Web Vitals</span>
                            <span class="bento-bar-value">90+</span>
                        </div>
                        <div class="bento-bar-track">
                            <div class="bento-bar-fill" style="width:90%;background:var(--accent);"></div>
                        </div>
                    </div>
                    <div class="bento-bar-item">
                        <div class="bento-bar-label">
                            <span>SEO technique</span>
                            <span class="bento-bar-value">Solide</span>
                        </div>
                        <div class="bento-bar-track">
                            <div class="bento-bar-fill" style="width:75%;background:var(--accent-2);"></div>
                        </div>
                    </div>
                    <div class="bento-bar-item">
                        <div class="bento-bar-label">
                            <span>Optimisation images</span>
                            <span class="bento-bar-value">Bonne</span>
                        </div>
                        <div class="bento-bar-track">
                            <div class="bento-bar-fill" style="width:80%;background:var(--accent);"></div>
                        </div>
                    </div>
                </div>
                <div class="bento-tags bento-tags--small">
                    <span>LCP</span><span>CLS</span><span>TBT</span>
                </div>
            </article>

            <article class="bento-card bento-card--data">
                <div class="bento-card-header">
                    <div class="bento-icon bento-icon--green">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/><path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/></svg>
                    </div>
                    <h3>Back-office & data</h3>
                </div>
                <div class="bento-tags">
                    <span>MySQL</span>
                    <span>Modélisation de contenu</span>
                    <span>Admin client simplifié</span>
                    <span>Formulaires métier</span>
                </div>
            </article>

        </div>
    </div>
</section>

    <section class="section-shell" id="projets">
        <div class="container">
            <div class="section-heading">
            <h2>Projets récents</h2>
            <p>Réalisations WordPress développées from scratch.</p>
        </div>
            <?php echo do_shortcode( '[portfolio_projects limit="3"]' ); ?>
        </div>
    </section>

    <section class="section-shell" id="devis">
        <div class="container">
            <div class="section-heading">
                <h2>Parlons de ton projet</h2>
                <p>Ce formulaire me permet de recevoir un brief clair pour te proposer un devis precis.</p>
            </div>
            <?php echo do_shortcode( '[portfolio_quote_form]' ); ?>
        </div>
    </section>
</main>

<?php
get_footer();
