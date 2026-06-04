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
        <div class="container">
            <span class="hero-kicker">Developpeur WordPress</span>
            <h1>Je cree des sites WordPress rapides, elegants et orientés conversion.</h1>
            <p>
                Theme sur mesure, performances, SEO technique et experience utilisateur.
                Objectif : un site pro qui inspire confiance des la premiere seconde.
            </p>
            <div class="hero-cta-row">
                <a href="#projets" class="portfolio-primary-btn">Voir mes projets</a>
                <a href="#devis" class="portfolio-secondary-btn">Demander un devis</a>
            </div>
        </div>
    </section>

    <section class="section-shell" id="competences">
        <div class="container">
            <div class="section-heading">
                <h2>Competences techniques</h2>
                <p>Stack orientee WordPress moderne, qualite de code et performance.</p>
            </div>

            <div class="skill-grid">
                <article class="skill-card">
                    <h3>Front-end</h3>
                    <ul>
                        <li>HTML5, CSS3, JavaScript (ES6)</li>
                        <li>Integration responsive pixel-perfect</li>
                        <li>Animations CSS/JS utiles et sobres</li>
                    </ul>
                </article>
                <article class="skill-card">
                    <h3>WordPress & PHP</h3>
                    <ul>
                        <li>Themes from scratch</li>
                        <li>Hooks, templates, architecture propre</li>
                        <li>Elementor, ACF, CPT</li>
                    </ul>
                </article>
                <article class="skill-card">
                    <h3>Back-office & data</h3>
                    <ul>
                        <li>MySQL et modelisation de contenu</li>
                        <li>Administration claire pour le client</li>
                        <li>Formulaires metier personnalises</li>
                    </ul>
                </article>
                <article class="skill-card">
                    <h3>SEO & performances</h3>
                    <ul>
                        <li>Core Web Vitals (LCP, CLS, TBT)</li>
                        <li>Optimisation images, CSS/JS, cache</li>
                        <li>Structure SEO technique et semantique</li>
                    </ul>
                </article>
            </div>
        </div>
    </section>

    <section class="section-shell" id="projets">
        <div class="container">
            <div class="section-heading">
                <h2>Projets recents</h2>
                <p>Nathalie Mota sera ton projet #1. Tu pourras en ajouter 2 autres facilement depuis l admin.</p>
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
