<?php
/**
 * Portfolio Pro Functions
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function portfolio_pro_setup() {
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'elementor' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'gallery', 'caption' ) );
    register_nav_menus( array(
        'primary' => __( 'Menu Principal', 'portfolio-pro' ),
        'footer'  => __( 'Menu Footer', 'portfolio-pro' ),
    ) );
}
add_action( 'after_setup_theme', 'portfolio_pro_setup' );

function portfolio_pro_nav_fallback() {
    echo '<ul class="site-nav-list">';
    echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">Accueil</a></li>';
    echo '<li><a href="' . esc_url( get_post_type_archive_link( 'projet' ) ) . '">Projets</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/#competences' ) ) . '">Competences</a></li>';
    echo '<li><a href="' . esc_url( home_url( '/#devis' ) ) . '">Devis</a></li>';
    echo '</ul>';
}

function portfolio_pro_scripts() {
    wp_enqueue_style(
        'portfolio-pro-style',
        get_stylesheet_uri(),
        array(),
        '1.1.0'
    );

    wp_enqueue_script(
        'portfolio-pro-interactions',
        get_template_directory_uri() . '/theme-interactions.js',
        array(),
        '1.1.0',
        true
    );
}
add_action( 'wp_enqueue_scripts', 'portfolio_pro_scripts', 5 );

/**
 * Charge le fichier HTML du footer.
 * Utilise get_theme_file_path() (WP 4.7+) avec fallback sur get_template_directory().
 */
function portfolio_pro_load_footer_html() {
    $file = function_exists( 'get_theme_file_path' )
        ? get_theme_file_path( 'inc/footer-html.php' )
        : ( get_template_directory() . '/inc/footer-html.php' );
    if ( $file && is_readable( $file ) ) {
        require $file;
    }
}

/**
 * Affiche le footer sur les pages Elementor Canvas (après le contenu).
 */
function portfolio_pro_canvas_footer() {
    if ( defined( 'PORTFOLIO_PRO_FOOTER_LOADED' ) && PORTFOLIO_PRO_FOOTER_LOADED ) {
        return;
    }
    portfolio_pro_load_footer_html();
}
add_action( 'elementor/page_templates/canvas/after_content', 'portfolio_pro_canvas_footer' );

/**
 * Fallback : si footer.php n'a pas été chargé (ex. Canvas), afficher le footer en début de wp_footer.
 * On ne se base pas sur le template : si PORTFOLIO_PRO_FOOTER_LOADED n'est pas défini, le footer n'a pas été affiché.
 */
function portfolio_pro_footer_fallback_wp_footer() {
    if ( defined( 'PORTFOLIO_PRO_FOOTER_LOADED' ) && PORTFOLIO_PRO_FOOTER_LOADED ) {
        return;
    }
    portfolio_pro_load_footer_html();
}
add_action( 'wp_footer', 'portfolio_pro_footer_fallback_wp_footer', 1 );

/**
 * Enregistre le type de contenu "Projet" pour une gestion depuis l'admin.
 */
function portfolio_pro_register_project_cpt() {
    $labels = array(
        'name'               => __( 'Projets', 'portfolio-pro' ),
        'singular_name'      => __( 'Projet', 'portfolio-pro' ),
        'add_new'            => __( 'Ajouter', 'portfolio-pro' ),
        'add_new_item'       => __( 'Ajouter un projet', 'portfolio-pro' ),
        'edit_item'          => __( 'Modifier le projet', 'portfolio-pro' ),
        'new_item'           => __( 'Nouveau projet', 'portfolio-pro' ),
        'view_item'          => __( 'Voir le projet', 'portfolio-pro' ),
        'search_items'       => __( 'Rechercher des projets', 'portfolio-pro' ),
        'not_found'          => __( 'Aucun projet trouve', 'portfolio-pro' ),
        'not_found_in_trash' => __( 'Aucun projet dans la corbeille', 'portfolio-pro' ),
        'menu_name'          => __( 'Projets', 'portfolio-pro' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'show_in_rest'       => true,
        'menu_icon'          => 'dashicons-portfolio',
        'has_archive'        => true,
        'rewrite'            => array( 'slug' => 'projets' ),
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
    );

    register_post_type( 'projet', $args );
}
add_action( 'init', 'portfolio_pro_register_project_cpt' );

/**
 * Ajoute une metabox pour les infos du projet (contexte + liens).
 */
function portfolio_pro_project_metabox() {
    add_meta_box(
        'portfolio_project_details',
        __( 'Details du projet', 'portfolio-pro' ),
        'portfolio_pro_project_metabox_callback',
        'projet',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'portfolio_pro_project_metabox' );

function portfolio_pro_project_metabox_callback( $post ) {
    wp_nonce_field( 'portfolio_project_details_nonce', 'portfolio_project_details_nonce' );

    $context   = get_post_meta( $post->ID, '_portfolio_project_context', true );
    $code_link = get_post_meta( $post->ID, '_portfolio_project_code_link', true );
    $site_link = get_post_meta( $post->ID, '_portfolio_project_site_link', true );
    ?>
    <p>
        <label for="portfolio_project_context"><strong><?php esc_html_e( 'Contexte', 'portfolio-pro' ); ?></strong></label><br>
        <textarea id="portfolio_project_context" name="portfolio_project_context" rows="4" style="width:100%;"><?php echo esc_textarea( $context ); ?></textarea>
    </p>
    <p>
        <label for="portfolio_project_code_link"><strong><?php esc_html_e( 'Lien vers le code (GitHub, GitLab...)', 'portfolio-pro' ); ?></strong></label><br>
        <input id="portfolio_project_code_link" name="portfolio_project_code_link" type="url" style="width:100%;" value="<?php echo esc_attr( $code_link ); ?>">
    </p>
    <p>
        <label for="portfolio_project_site_link"><strong><?php esc_html_e( 'Lien vers le site (optionnel)', 'portfolio-pro' ); ?></strong></label><br>
        <input id="portfolio_project_site_link" name="portfolio_project_site_link" type="url" style="width:100%;" value="<?php echo esc_attr( $site_link ); ?>">
    </p>
    <?php
}

/**
 * Sauvegarde des champs custom du projet.
 */
function portfolio_pro_save_project_meta( $post_id ) {
    if ( ! isset( $_POST['portfolio_project_details_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['portfolio_project_details_nonce'] ) ), 'portfolio_project_details_nonce' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( isset( $_POST['portfolio_project_context'] ) ) {
        update_post_meta(
            $post_id,
            '_portfolio_project_context',
            sanitize_textarea_field( wp_unslash( $_POST['portfolio_project_context'] ) )
        );
    }

    if ( isset( $_POST['portfolio_project_code_link'] ) ) {
        update_post_meta(
            $post_id,
            '_portfolio_project_code_link',
            esc_url_raw( wp_unslash( $_POST['portfolio_project_code_link'] ) )
        );
    }

    if ( isset( $_POST['portfolio_project_site_link'] ) ) {
        update_post_meta(
            $post_id,
            '_portfolio_project_site_link',
            esc_url_raw( wp_unslash( $_POST['portfolio_project_site_link'] ) )
        );
    }
}
add_action( 'save_post_projet', 'portfolio_pro_save_project_meta' );

/**
 * Shortcode pour afficher la liste des projets dans une page.
 * Utilisation : [portfolio_projects limit="6"]
 */
function portfolio_pro_projects_shortcode( $atts ) {
    $atts = shortcode_atts(
        array(
            'limit' => 6,
        ),
        $atts,
        'portfolio_projects'
    );

    $query = new WP_Query(
        array(
            'post_type'      => 'projet',
            'posts_per_page' => (int) $atts['limit'],
            'post_status'    => 'publish',
        )
    );

    if ( ! $query->have_posts() ) {
        return '<p>Aucun projet pour le moment.</p>';
    }

    ob_start();
    ?>
    <div class="portfolio-projects-grid">
        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
            <article class="portfolio-project-card">
                <h3 class="portfolio-project-title"><?php the_title(); ?></h3>
                <?php
                $context   = get_post_meta( get_the_ID(), '_portfolio_project_context', true );
                $code_link = get_post_meta( get_the_ID(), '_portfolio_project_code_link', true );
                $site_link = get_post_meta( get_the_ID(), '_portfolio_project_site_link', true );
                ?>
                <?php if ( $context ) : ?>
                    <p class="portfolio-project-context"><?php echo esc_html( $context ); ?></p>
                <?php endif; ?>
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="portfolio-project-thumb">
                        <a href="<?php the_permalink(); ?>" aria-label="Voir le detail du projet <?php the_title_attribute(); ?>">
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
    <?php
    wp_reset_postdata();

    return ob_get_clean();
}
add_shortcode( 'portfolio_projects', 'portfolio_pro_projects_shortcode' );

/**
 * Shortcode formulaire devis.
 * Utilisation : [portfolio_quote_form]
 */
function portfolio_pro_quote_form_shortcode() {
    $feedback = '';
    $success  = false;

    if ( 'POST' === $_SERVER['REQUEST_METHOD'] && isset( $_POST['portfolio_quote_submit'] ) ) {
        if ( ! isset( $_POST['portfolio_quote_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['portfolio_quote_nonce'] ) ), 'portfolio_quote_action' ) ) {
            $feedback = 'Verification de securite invalide, merci de recommencer.';
        } else {
            $name         = isset( $_POST['quote_name'] ) ? sanitize_text_field( wp_unslash( $_POST['quote_name'] ) ) : '';
            $email        = isset( $_POST['quote_email'] ) ? sanitize_email( wp_unslash( $_POST['quote_email'] ) ) : '';
            $business     = isset( $_POST['quote_business'] ) ? sanitize_text_field( wp_unslash( $_POST['quote_business'] ) ) : '';
            $project_type = isset( $_POST['quote_project_type'] ) ? sanitize_text_field( wp_unslash( $_POST['quote_project_type'] ) ) : '';
            $pages        = isset( $_POST['quote_pages'] ) ? sanitize_text_field( wp_unslash( $_POST['quote_pages'] ) ) : '';
            $budget       = isset( $_POST['quote_budget'] ) ? sanitize_text_field( wp_unslash( $_POST['quote_budget'] ) ) : '';
            $deadline     = isset( $_POST['quote_deadline'] ) ? sanitize_text_field( wp_unslash( $_POST['quote_deadline'] ) ) : '';
            $priorities   = isset( $_POST['quote_priorities'] ) ? sanitize_textarea_field( wp_unslash( $_POST['quote_priorities'] ) ) : '';
            $message      = isset( $_POST['quote_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['quote_message'] ) ) : '';

            if ( empty( $name ) || empty( $email ) || empty( $project_type ) || empty( $message ) ) {
                $feedback = 'Merci de remplir au minimum nom, email, type de projet et description.';
            } elseif ( ! is_email( $email ) ) {
                $feedback = 'L email fourni n est pas valide.';
            } else {
                $to      = 'nicolasraux2@gmail.com';
                $subject = '[Portfolio] Nouvelle demande de devis - ' . $project_type;
                $body    = "Nouvelle demande de devis\n\n";
                $body   .= "Nom: {$name}\n";
                $body   .= "Email: {$email}\n";
                $body   .= "Entreprise: {$business}\n";
                $body   .= "Type de projet: {$project_type}\n";
                $body   .= "Nombre de pages: {$pages}\n";
                $body   .= "Budget estime: {$budget}\n";
                $body   .= "Delai souhaite: {$deadline}\n";
                $body   .= "Priorites SEO/performance/fonctionnalites:\n{$priorities}\n\n";
                $body   .= "Description detaillee:\n{$message}\n";

                $headers = array( 'Reply-To: ' . $name . ' <' . $email . '>' );
                $sent    = wp_mail( $to, $subject, $body, $headers );

                if ( $sent ) {
                    $success  = true;
                    $feedback = 'Merci, votre demande a bien ete envoyee. Je vous reponds rapidement.';
                } else {
                    $feedback = 'Erreur lors de l envoi. Merci de reessayer ou d envoyer un email direct a nicolasraux2@gmail.com.';
                }
            }
        }
    }

    ob_start();
    ?>
    <div class="portfolio-quote-form-wrap">
        <?php if ( $feedback ) : ?>
            <p class="portfolio-form-feedback <?php echo $success ? 'is-success' : 'is-error'; ?>"><?php echo esc_html( $feedback ); ?></p>
        <?php endif; ?>

        <form class="portfolio-quote-form" method="post" action="#devis">
            <?php wp_nonce_field( 'portfolio_quote_action', 'portfolio_quote_nonce' ); ?>

            <div class="portfolio-form-grid">
                <p>
                    <label for="quote_name">Nom *</label>
                    <input type="text" id="quote_name" name="quote_name" required value="<?php echo isset( $_POST['quote_name'] ) ? esc_attr( wp_unslash( $_POST['quote_name'] ) ) : ''; ?>">
                </p>
                <p>
                    <label for="quote_email">Email *</label>
                    <input type="email" id="quote_email" name="quote_email" required value="<?php echo isset( $_POST['quote_email'] ) ? esc_attr( wp_unslash( $_POST['quote_email'] ) ) : ''; ?>">
                </p>
                <p>
                    <label for="quote_business">Entreprise / activite</label>
                    <input type="text" id="quote_business" name="quote_business" value="<?php echo isset( $_POST['quote_business'] ) ? esc_attr( wp_unslash( $_POST['quote_business'] ) ) : ''; ?>">
                </p>
                <p>
                    <label for="quote_project_type">Type de projet *</label>
                    <select id="quote_project_type" name="quote_project_type" required>
                        <option value="">Selectionner</option>
                        <?php
                        $project_types = array(
                            'Site vitrine',
                            'Site WordPress sur mesure',
                            'Refonte de site',
                            'Optimisation SEO/performance',
                            'Maintenance',
                            'Autre',
                        );
                        $selected_type = isset( $_POST['quote_project_type'] ) ? sanitize_text_field( wp_unslash( $_POST['quote_project_type'] ) ) : '';
                        foreach ( $project_types as $type ) {
                            printf(
                                '<option value="%1$s" %2$s>%1$s</option>',
                                esc_attr( $type ),
                                selected( $selected_type, $type, false )
                            );
                        }
                        ?>
                    </select>
                </p>
                <p>
                    <label for="quote_pages">Nombre de pages estime</label>
                    <input type="text" id="quote_pages" name="quote_pages" placeholder="Ex: 5 a 10 pages" value="<?php echo isset( $_POST['quote_pages'] ) ? esc_attr( wp_unslash( $_POST['quote_pages'] ) ) : ''; ?>">
                </p>
                <p>
                    <label for="quote_budget">Budget estime</label>
                    <input type="text" id="quote_budget" name="quote_budget" placeholder="Ex: 1500-3000 EUR" value="<?php echo isset( $_POST['quote_budget'] ) ? esc_attr( wp_unslash( $_POST['quote_budget'] ) ) : ''; ?>">
                </p>
                <p>
                    <label for="quote_deadline">Delai souhaite</label>
                    <input type="text" id="quote_deadline" name="quote_deadline" placeholder="Ex: 4 semaines" value="<?php echo isset( $_POST['quote_deadline'] ) ? esc_attr( wp_unslash( $_POST['quote_deadline'] ) ) : ''; ?>">
                </p>
                <p>
                    <label for="quote_priorities">Priorites (SEO, perf, fonctionnalites)</label>
                    <textarea id="quote_priorities" name="quote_priorities" rows="4" placeholder="Ex: SEO local, Core Web Vitals, formulaire avance..."><?php echo isset( $_POST['quote_priorities'] ) ? esc_textarea( wp_unslash( $_POST['quote_priorities'] ) ) : ''; ?></textarea>
                </p>
            </div>

            <p>
                <label for="quote_message">Description du besoin *</label>
                <textarea id="quote_message" name="quote_message" rows="6" required placeholder="Decris votre besoin, vos objectifs, inspirations et contraintes..."><?php echo isset( $_POST['quote_message'] ) ? esc_textarea( wp_unslash( $_POST['quote_message'] ) ) : ''; ?></textarea>
            </p>

            <button type="submit" name="portfolio_quote_submit" class="portfolio-primary-btn">Envoyer la demande</button>
        </form>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'portfolio_quote_form', 'portfolio_pro_quote_form_shortcode' );
