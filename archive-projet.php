<?php
/**
 * Archive des projets.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

$colors = array(
    array(
        'accent' => '#2bd4bf',
        'bg'     => 'rgba(43,212,191,0.1)',
        'border' => 'rgba(43,212,191,0.2)',
    ),
    array(
        'accent' => '#4f7cff',
        'bg'     => 'rgba(79,124,255,0.1)',
        'border' => 'rgba(79,124,255,0.2)',
    ),
    array(
        'accent' => '#fac775',
        'bg'     => 'rgba(250,199,117,0.1)',
        'border' => 'rgba(250,199,117,0.2)',
    ),
);
?>

<main id="main" class="site-main">
    <section class="section-shell">
        <div class="container">

            <div class="section-heading">
                <h1>Mes projets</h1>
                <p>Réalisations WordPress développées from scratch.</p>
            </div>

            <?php if ( have_posts() ) : ?>
                <div class="projects-grid">
                    <?php
                    $i = 0;
                    while ( have_posts() ) :
                        the_post();
                        $context   = get_post_meta( get_the_ID(), '_portfolio_project_context', true );
                        $code_link = get_post_meta( get_the_ID(), '_portfolio_project_code_link', true );
                        $site_link = get_post_meta( get_the_ID(), '_portfolio_project_site_link', true );
                        $color     = $colors[ $i % count( $colors ) ];
                    ?>
                        <article class="project-card">

                            <div class="project-card-thumb">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <a href="<?php the_permalink(); ?>" aria-label="Voir le projet <?php the_title_attribute(); ?>">
                                        <?php the_post_thumbnail( 'large' ); ?>
                                    </a>
                                <?php else : ?>
                                    <a href="<?php the_permalink(); ?>" class="project-card-thumb-placeholder" aria-label="Voir le projet <?php the_title_attribute(); ?>"></a>
                                <?php endif; ?>
                            </div>

                            <?php if ( $context ) : ?>
                                <div class="project-card-badge-row">
                                    <span class="project-card-badge" style="color:<?php echo esc_attr( $color['accent'] ); ?>;border-color:<?php echo esc_attr( $color['border'] ); ?>;background:<?php echo esc_attr( $color['bg'] ); ?>;">
                                        <?php echo esc_html( $context ); ?>
                                    </span>
                                </div>
                            <?php endif; ?>

                            <div class="project-card-body">
                                <h2 class="project-card-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <p class="project-card-excerpt"><?php echo wp_trim_words( get_the_excerpt(), 20, '…' ); ?></p>

                                <div class="project-card-actions">
                                    <a href="<?php the_permalink(); ?>"
                                       class="project-btn project-btn--primary"
                                       style="color:<?php echo esc_attr( $color['accent'] ); ?>;background:<?php echo esc_attr( $color['bg'] ); ?>;border-color:<?php echo esc_attr( $color['border'] ); ?>;">
                                        Voir le détail
                                    </a>
                                    <?php if ( $code_link ) : ?>
                                        <a href="<?php echo esc_url( $code_link ); ?>" target="_blank" rel="noopener noreferrer" class="project-btn project-btn--secondary">
                                            Voir le code
                                        </a>
                                    <?php endif; ?>
                                    <?php if ( $site_link ) : ?>
                                        <a href="<?php echo esc_url( $site_link ); ?>" target="_blank" rel="noopener noreferrer" class="project-btn project-btn--secondary">
                                            Voir le site
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>

                        </article>
                    <?php
                        $i++;
                    endwhile;
                    ?>
                </div>

            <?php else : ?>
                <p class="project-card-excerpt">Aucun projet publié pour le moment.</p>
            <?php endif; ?>

        </div>
    </section>
</main>

<?php
get_footer();