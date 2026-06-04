<?php
/**
 * Archive des projets.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<main id="main" class="site-main">
    <section class="portfolio-section">
        <div class="container">
            <header class="portfolio-section-header">
                <h1 class="portfolio-page-title">Mes projets</h1>
                <p class="portfolio-page-intro">
                    Une selection de realisations WordPress et developpement web.
                </p>
            </header>

            <?php if ( have_posts() ) : ?>
                <div class="portfolio-projects-grid">
                    <?php
                    while ( have_posts() ) :
                        the_post();
                        $context   = get_post_meta( get_the_ID(), '_portfolio_project_context', true );
                        $code_link = get_post_meta( get_the_ID(), '_portfolio_project_code_link', true );
                        $site_link = get_post_meta( get_the_ID(), '_portfolio_project_site_link', true );
                        ?>
                        <article class="portfolio-project-card">
                            <h2 class="portfolio-project-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>

                            <?php if ( $context ) : ?>
                                <p class="portfolio-project-context"><?php echo esc_html( $context ); ?></p>
                            <?php endif; ?>

                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="portfolio-project-thumb">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail( 'large' ); ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <div class="portfolio-project-description"><?php the_excerpt(); ?></div>
                            <div class="portfolio-project-links">
                                <a href="<?php the_permalink(); ?>">Voir le detail</a>
                                <?php if ( $code_link ) : ?>
                                    <a href="<?php echo esc_url( $code_link ); ?>" target="_blank" rel="noopener noreferrer">Voir le code</a>
                                <?php endif; ?>
                                <?php if ( $site_link ) : ?>
                                    <a href="<?php echo esc_url( $site_link ); ?>" target="_blank" rel="noopener noreferrer">Voir le site</a>
                                <?php endif; ?>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
            <?php else : ?>
                <p>Aucun projet publie pour le moment.</p>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php
get_footer();
