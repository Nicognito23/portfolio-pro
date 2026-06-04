<?php
/**
 * Page detail d'un projet.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<main id="main" class="site-main">
    <section class="portfolio-section">
        <div class="container">
            <?php
            while ( have_posts() ) :
                the_post();
                $context   = get_post_meta( get_the_ID(), '_portfolio_project_context', true );
                $code_link = get_post_meta( get_the_ID(), '_portfolio_project_code_link', true );
                $site_link = get_post_meta( get_the_ID(), '_portfolio_project_site_link', true );
                ?>
                <article class="portfolio-single-project">
                    <header class="portfolio-single-header">
                        <h1 class="portfolio-page-title"><?php the_title(); ?></h1>
                        <?php if ( $context ) : ?>
                            <p class="portfolio-project-context"><?php echo esc_html( $context ); ?></p>
                        <?php endif; ?>
                    </header>

                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="portfolio-single-thumb">
                            <?php the_post_thumbnail( 'large' ); ?>
                        </div>
                    <?php endif; ?>

                    <div class="portfolio-single-content">
                        <?php the_content(); ?>
                    </div>

                    <div class="portfolio-project-links">
                        <?php if ( $code_link ) : ?>
                            <a href="<?php echo esc_url( $code_link ); ?>" target="_blank" rel="noopener noreferrer">Voir le code</a>
                        <?php endif; ?>
                        <?php if ( $site_link ) : ?>
                            <a href="<?php echo esc_url( $site_link ); ?>" target="_blank" rel="noopener noreferrer">Voir le site</a>
                        <?php endif; ?>
                        <a href="<?php echo esc_url( get_post_type_archive_link( 'projet' ) ); ?>">Retour aux projets</a>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
    </section>
</main>

<?php
get_footer();
