<?php
/**
 * Template page A propos.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<main id="main" class="site-main about-page">
    <section class="about-hero section-shell">
        <div class="container">
            <span class="hero-kicker">Developpeur front-end junior | WordPress</span>
            <h1>Je construis une presence web claire, moderne et evolutive.</h1>
            <p>
                En formation WordPress chez OpenClassrooms depuis mars 2025, je developpe des sites
                performants et bien references pour PME, startups, agences et particuliers.
            </p>
            <div class="hero-cta-row">
                <a class="portfolio-primary-btn" href="<?php echo esc_url( home_url( '/#devis' ) ); ?>">Demander un devis</a>
                <a class="portfolio-secondary-btn" href="mailto:nicolasraux2@gmail.com">Me contacter</a>
            </div>
        </div>
    </section>

    <section class="section-shell">
        <div class="container">
            <div class="about-grid">
                <article class="about-card">
                    <h2>Mon parcours</h2>
                    <ul class="about-timeline">
                        <li class="about-timeline-item">
                            <span>Depuis mars 2025</span>
                            <p>Formation Developpeur WordPress chez OpenClassrooms.</p>
                        </li>
                        <li class="about-timeline-item">
                            <span>Prochaine etape</span>
                            <p>Poursuite du parcours Integrateur Web pour renforcer mes bases front-end et accessibilite.</p>
                        </li>
                        <li class="about-timeline-item">
                            <span>Objectif</span>
                            <p>Collaborer avec de vrais clients et produire des sites utiles, rapides et memorables.</p>
                        </li>
                    </ul>
                </article>

                <article class="about-card">
                    <h2>Mes points forts</h2>
                    <div class="about-highlights">
                        <p class="about-highlight">SEO & referencement structurel</p>
                        <p class="about-highlight">Design soigne, moderne et coherent</p>
                        <p class="about-highlight">Communication claire et suivi transparent</p>
                        <p class="about-highlight">Collaboration 100% remote</p>
                        <p class="about-highlight">Adaptabilite: particuliers, PME, startups, agences</p>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="section-shell">
        <div class="container">
            <div class="section-heading">
                <h2>Stack technique</h2>
                <p>Un socle WordPress solide, complete par des pratiques front-end et performance.</p>
            </div>
            <div class="about-stack-grid">
                <article class="about-stack-card">
                    <h3>Front-end</h3>
                    <div class="about-stack-tags">
                        <span>HTML5</span>
                        <span>CSS3</span>
                        <span>JavaScript (ES6)</span>
                        <span>Integration responsive</span>
                    </div>
                </article>
                <article class="about-stack-card">
                    <h3>WordPress</h3>
                    <div class="about-stack-tags">
                        <span>WordPress</span>
                        <span>Elementor</span>
                        <span>Themes from scratch</span>
                        <span>ACF</span>
                        <span>CPT</span>
                    </div>
                </article>
                <article class="about-stack-card">
                    <h3>Back-end & data</h3>
                    <div class="about-stack-tags">
                        <span>PHP</span>
                        <span>MySQL</span>
                    </div>
                </article>
                <article class="about-stack-card">
                    <h3>Qualite web</h3>
                    <div class="about-stack-tags">
                        <span>Optimisation SEO</span>
                        <span>Performance web</span>
                        <span>Bonnes pratiques</span>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="section-shell">
        <div class="container">
            <div class="about-cta-panel">
                <h2>Parlons de ton projet</h2>
                <p>Je reponds rapidement pour clarifier ton besoin et te proposer une solution simple, evolutive et propre.</p>
                <div class="hero-cta-row">
                    <a class="portfolio-primary-btn" href="<?php echo esc_url( home_url( '/#devis' ) ); ?>">Demander un devis</a>
                    <a class="portfolio-secondary-btn" href="mailto:nicolasraux2@gmail.com">Me contacter pour echanger</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
