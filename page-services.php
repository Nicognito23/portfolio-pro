<?php
/**
 * Template : Page Services
 * Template Name: Services
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<main id="main" class="site-main">

    <!-- ===================== HERO ===================== -->
    <section class="section-shell services-hero-section">
        <div class="container">
            <div class="services-hero-split">

                <div class="services-hero">
                    <span class="services-hero-kicker">
                        <span class="about-hero-kicker-dot"></span>
                        Prestations
                    </span>
                    <h1 class="services-hero-title">
                        Des sites <span class="services-hero-accent">pensés pour convertir</span>,<br>
                        pas juste pour être beaux.
                    </h1>
                    <p class="services-hero-desc">
                        Chaque prestation est conçue autour de votre objectif. Que vous partiez de zéro
                        ou que vous souhaitiez moderniser l'existant, je vous propose une solution claire,
                        documentée et évolutive.
                    </p>
                </div>

                <div class="code-terminal" id="code-terminal" aria-hidden="true">
                    <div class="code-terminal-bar">
                        <span class="code-terminal-dot"></span>
                        <span class="code-terminal-dot"></span>
                        <span class="code-terminal-dot"></span>
                        <span class="code-terminal-title">portfolio-pro / functions.php</span>
                    </div>
                    <div class="code-terminal-body" id="code-terminal-body"></div>
                </div>

            </div>
        </div>
    </section>

    <!-- ===================== OFFRES ===================== -->
    <section class="section-shell">
        <div class="container">
            <div class="section-heading">
                <h2>Ce que je propose</h2>
                <p>Quatre prestations pour répondre aux besoins les plus courants.</p>
            </div>
            <div class="services-grid">

                <!-- Site vitrine — card featured -->
                <article class="svc-card svc-card--featured">
                    <div class="svc-card-header">
                        <div class="svc-icon svc-icon--cyan">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>
                        </div>
                        <span class="svc-badge">Le plus demandé</span>
                    </div>
                    <h3 class="svc-title">Site vitrine</h3>
                    <p class="svc-desc">Présence professionnelle soignée, pensée pour rassurer vos prospects et générer des prises de contact.</p>
                    <ul class="svc-checklist">
                        <li>Thème WordPress sur mesure, sans page builder</li>
                        <li>Design responsive mobile / tablette / desktop</li>
                        <li>SEO technique de base intégré dès la conception</li>
                        <li>Formulaire de contact avec envoi par email</li>
                        <li>Back-office simplifié pour modifier votre contenu</li>
                        <li>Hébergement et nom de domaine conseillés</li>
                    </ul>
                    <div class="svc-footer">
                        <div class="svc-pricing">
                            <span class="svc-price">À partir de 800 €<span class="svc-ht"> HT</span></span>
                            <span class="svc-delay">Délai : 3 à 5 semaines</span>
                        </div>
                        <a class="portfolio-primary-btn" href="<?php echo esc_url( home_url( '/#devis' ) ); ?>">
                            Demander un devis →
                        </a>
                    </div>
                </article>

                <!-- Refonte -->
                <article class="svc-card">
                    <div class="svc-card-header">
                        <div class="svc-icon svc-icon--blue">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="23 4 23 10 17 10"/><polyline points="1 20 1 14 7 14"/><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/></svg>
                        </div>
                    </div>
                    <h3 class="svc-title">Refonte de site</h3>
                    <p class="svc-desc">Votre site existe mais ne reflète plus votre image ou ses performances laissent à désirer. On repart sur de bonnes bases.</p>
                    <ul class="svc-checklist">
                        <li>Audit de l'existant — design, SEO, performance</li>
                        <li>Nouveau thème from scratch ou refonte partielle</li>
                        <li>Migration du contenu existant</li>
                        <li>Optimisation Core Web Vitals</li>
                        <li>Redirection 301 si changement d'URLs</li>
                    </ul>
                    <div class="svc-footer">
                        <div class="svc-pricing">
                            <span class="svc-price">À partir de 600 €<span class="svc-ht"> HT</span></span>
                            <span class="svc-delay">Délai : 2 à 4 semaines</span>
                        </div>
                        <a class="portfolio-secondary-btn svc-btn" href="<?php echo esc_url( home_url( '/#devis' ) ); ?>">
                            Demander un devis
                        </a>
                    </div>
                </article>

                <!-- SEO & Performances -->
                <article class="svc-card">
                    <div class="svc-card-header">
                        <div class="svc-icon svc-icon--amber">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                        </div>
                    </div>
                    <h3 class="svc-title">SEO & performances</h3>
                    <p class="svc-desc">Votre site est en ligne mais invisible sur Google. On identifie les blocages et on les corrige méthodiquement.</p>
                    <ul class="svc-checklist">
                        <li>Audit SEO technique complet</li>
                        <li>Optimisation des balises, titres et maillage interne</li>
                        <li>Amélioration des Core Web Vitals (LCP, CLS, TBT)</li>
                        <li>Optimisation des images et du chargement</li>
                        <li>Rapport et recommandations priorisées</li>
                    </ul>
                    <div class="svc-footer">
                        <div class="svc-pricing">
                            <span class="svc-price">À partir de 350 €<span class="svc-ht"> HT</span></span>
                            <span class="svc-delay">Délai : 1 à 2 semaines</span>
                        </div>
                        <a class="portfolio-secondary-btn svc-btn" href="<?php echo esc_url( home_url( '/#devis' ) ); ?>">
                            Demander un devis
                        </a>
                    </div>
                </article>

                <!-- Maintenance -->
                <article class="svc-card">
                    <div class="svc-card-header">
                        <div class="svc-icon svc-icon--green">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                        </div>
                    </div>
                    <h3 class="svc-title">Maintenance</h3>
                    <p class="svc-desc">Votre site tourne, on s'assure qu'il continue. Mises à jour, sauvegardes, surveillance et petites évolutions incluses.</p>
                    <ul class="svc-checklist">
                        <li>Mises à jour WordPress, thème et extensions</li>
                        <li>Sauvegardes régulières externalisées</li>
                        <li>Surveillance uptime et sécurité</li>
                        <li>Corrections de bugs incluses</li>
                        <li>Petites modifications de contenu incluses</li>
                    </ul>
                    <div class="svc-footer">
                        <div class="svc-pricing">
                            <span class="svc-price">À partir de 60 €<span class="svc-ht"> / mois</span></span>
                            <span class="svc-delay">Engagement mensuel</span>
                        </div>
                        <a class="portfolio-secondary-btn svc-btn" href="<?php echo esc_url( home_url( '/#devis' ) ); ?>">
                            Demander un devis
                        </a>
                    </div>
                </article>

            </div>
        </div>
    </section>

    <!-- ===================== FAQ ===================== -->
    <section class="section-shell">
        <div class="container">
            <div class="section-heading">
                <h2>Questions fréquentes</h2>
                <p>Ce que mes clients me demandent avant de démarrer.</p>
            </div>
            <div class="svc-faq" id="svc-faq">

                <div class="svc-faq-item">
                    <button class="svc-faq-q" aria-expanded="false">
                        <span>Puis-je modifier le contenu de mon site moi-même ?</span>
                        <svg class="svc-faq-chevron" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="svc-faq-a" hidden>
                        <p>Oui. Chaque site est livré avec un back-office WordPress simplifié. Vous pouvez modifier textes, images et pages sans toucher au code — même sans compétences techniques.</p>
                    </div>
                </div>

                <div class="svc-faq-item">
                    <button class="svc-faq-q" aria-expanded="false">
                        <span>Mon site sera-t-il bien référencé sur Google ?</span>
                        <svg class="svc-faq-chevron" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="svc-faq-a" hidden>
                        <p>Le SEO technique de base est intégré à chaque prestation : balises correctes, structure sémantique, vitesse optimisée, sitemap soumis à Google. Le référencement éditorial — rédiger du contenu optimisé — dépend de vous ou fait l'objet d'une prestation dédiée.</p>
                    </div>
                </div>

                <div class="svc-faq-item">
                    <button class="svc-faq-q" aria-expanded="false">
                        <span>Combien coûte réellement un site WordPress sur mesure ?</span>
                        <svg class="svc-faq-chevron" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="svc-faq-a" hidden>
                        <p>Les tarifs indiqués sont des points de départ. Le prix final dépend du nombre de pages, des fonctionnalités spécifiques et du niveau de personnalisation souhaité. Le devis est gratuit, détaillé et sans engagement.</p>
                    </div>
                </div>

                <div class="svc-faq-item">
                    <button class="svc-faq-q" aria-expanded="false">
                        <span>Vous travaillez uniquement en remote ?</span>
                        <svg class="svc-faq-chevron" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="svc-faq-a" hidden>
                        <p>Oui, 100% remote sur toute la France. Les échanges se font par email, visioconférence ou outils collaboratifs selon vos préférences. Cela ne change rien à la qualité du suivi.</p>
                    </div>
                </div>

                <div class="svc-faq-item">
                    <button class="svc-faq-q" aria-expanded="false">
                        <span>Que se passe-t-il après la livraison du site ?</span>
                        <svg class="svc-faq-chevron" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="svc-faq-a" hidden>
                        <p>Une période de garantie de 30 jours est incluse pour corriger tout bug ou imprévu post-livraison. Au-delà, une offre de maintenance mensuelle est disponible pour assurer la pérennité de votre site.</p>
                    </div>
                </div>

                <div class="svc-faq-item">
                    <button class="svc-faq-q" aria-expanded="false">
                        <span>Utilisez-vous des page builders comme Elementor ou Divi ?</span>
                        <svg class="svc-faq-chevron" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <div class="svc-faq-a" hidden>
                        <p>Non. Je développe des thèmes WordPress from scratch, en PHP, HTML, SCSS et JavaScript vanilla. Cela garantit un code propre, léger et performant — sans la dette technique des page builders. Si vous avez déjà un site Elementor et souhaitez le conserver, c'est également possible.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ===================== CTA PANEL ===================== -->
    <section class="section-shell">
        <div class="container">
            <div class="svc-cta-panel">
                <div class="svc-cta-text">
                    <h2>Votre projet est unique.</h2>
                    <p>Décrivez-le en quelques lignes et recevez une réponse sous 48h avec une estimation claire et sans engagement.</p>
                </div>
                <div class="svc-cta-btns">
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