<?php
/**
 * Page détail d'un projet.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();
?>

<main id="main" class="site-main">
    <?php while ( have_posts() ) : the_post();

        $context   = get_post_meta( get_the_ID(), '_portfolio_project_context', true );
        $code_link = get_post_meta( get_the_ID(), '_portfolio_project_code_link', true );
        $site_link = get_post_meta( get_the_ID(), '_portfolio_project_site_link', true );
    ?>

    <?php if ( has_post_thumbnail() ) : ?>
    <div class="single-projet-hero">
        <?php the_post_thumbnail( 'full' ); ?>
        <div class="single-projet-hero-overlay"></div>
    </div>
    <?php endif; ?>

    <section class="section-shell">
        <div class="container">
            <div class="single-projet-wrap">

                <header class="single-projet-header">
                    <?php if ( $context ) : ?>
                        <span class="single-projet-badge"><?php echo esc_html( $context ); ?></span>
                    <?php endif; ?>
                    <h1 class="single-projet-title"><?php the_title(); ?></h1>
                </header>

                <div class="single-projet-actions">
                    <?php if ( $site_link ) : ?>
                        <a href="<?php echo esc_url( $site_link ); ?>" target="_blank" rel="noopener noreferrer" class="portfolio-primary-btn">
                            Voir le site →
                        </a>
                    <?php endif; ?>
                    <?php if ( $code_link ) : ?>
                        <a href="<?php echo esc_url( $code_link ); ?>" target="_blank" rel="noopener noreferrer" class="portfolio-secondary-btn">
                            Voir le code
                        </a>
                    <?php endif; ?>
                    <a href="<?php echo esc_url( get_post_type_archive_link( 'projet' ) ); ?>" class="single-projet-back">
                        ← Retour aux projets
                    </a>
                </div>

                <div class="single-projet-content">
                    <?php the_content(); ?>
                </div>

                <div class="single-projet-footer">
                    <a href="<?php echo esc_url( get_post_type_archive_link( 'projet' ) ); ?>" class="portfolio-secondary-btn">
                        ← Retour aux projets
                    </a>
                </div>

            </div>
        </div>
    </section>

    <?php endwhile; ?>
</main>

<?php
get_footer();