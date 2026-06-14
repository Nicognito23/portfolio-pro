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

    // JS et CSS animations-lab — chargés uniquement sur la page Animations
    if ( is_page_template( 'page-animations.php' ) ) {
        wp_enqueue_script(
            'portfolio-animations-lab',
            get_template_directory_uri() . '/assets/js/animations-lab.js',
            array(),
            '1.0.0',
            true
        );
    }
}
add_action( 'wp_enqueue_scripts', 'portfolio_pro_scripts', 5 );
 
/**
 * Charge le fichier HTML du footer.
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
 * Affiche le footer sur les pages Elementor Canvas.
 */
function portfolio_pro_canvas_footer() {
    if ( defined( 'PORTFOLIO_PRO_FOOTER_LOADED' ) && PORTFOLIO_PRO_FOOTER_LOADED ) {
        return;
    }
    portfolio_pro_load_footer_html();
}
add_action( 'elementor/page_templates/canvas/after_content', 'portfolio_pro_canvas_footer' );
 
/**
 * Fallback footer si footer.php n'a pas été chargé.
 */
function portfolio_pro_footer_fallback_wp_footer() {
    if ( defined( 'PORTFOLIO_PRO_FOOTER_LOADED' ) && PORTFOLIO_PRO_FOOTER_LOADED ) {
        return;
    }
    portfolio_pro_load_footer_html();
}
add_action( 'wp_footer', 'portfolio_pro_footer_fallback_wp_footer', 1 );
 
/**
 * Enregistre le type de contenu "Projet".
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
 * Metabox infos projet.
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
 * Shortcode projets — [portfolio_projects limit="3"]
 * Affiche une grille de cartes projets dynamiques depuis le CPT.
 */
function portfolio_pro_projects_shortcode( $atts ) {
    $atts = shortcode_atts(
        array( 'limit' => 3 ),
        $atts,
        'portfolio_projects'
    );
 
    $query = new WP_Query( array(
        'post_type'      => 'projet',
        'posts_per_page' => intval( $atts['limit'] ),
        'post_status'    => 'publish',
    ) );
 
    if ( ! $query->have_posts() ) {
        return '<p>Aucun projet publié pour le moment.</p>';
    }
 
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
 
    $html = '<div class="projects-grid">';
    $i    = 0;
 
    while ( $query->have_posts() ) {
        $query->the_post();
 
        $context   = get_post_meta( get_the_ID(), '_portfolio_project_context', true );
        $code_link = get_post_meta( get_the_ID(), '_portfolio_project_code_link', true );
        $site_link = get_post_meta( get_the_ID(), '_portfolio_project_site_link', true );
        $color     = $colors[ $i % count( $colors ) ];
 
        $html .= '<article class="project-card">';
 
        $html .= '<div class="project-card-thumb">';
        if ( has_post_thumbnail() ) {
            $html .= '<a href="' . esc_url( get_permalink() ) . '" aria-label="Voir le projet ' . esc_attr( get_the_title() ) . '">';
            $html .= get_the_post_thumbnail( get_the_ID(), 'large' );
            $html .= '</a>';
        } else {
            $html .= '<a href="' . esc_url( get_permalink() ) . '" class="project-card-thumb-placeholder" aria-label="Voir le projet ' . esc_attr( get_the_title() ) . '"></a>';
        }
        $html .= '</div>';
 
        if ( $context ) {
            $html .= '<div class="project-card-badge-row">';
            $html .= '<span class="project-card-badge" style="color:' . esc_attr( $color['accent'] ) . ';border-color:' . esc_attr( $color['border'] ) . ';background:' . esc_attr( $color['bg'] ) . ';">';
            $html .= esc_html( $context );
            $html .= '</span>';
            $html .= '</div>';
        }
 
        $html .= '<div class="project-card-body">';
        $html .= '<h3 class="project-card-title"><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></h3>';
        $html .= '<p class="project-card-excerpt">' . wp_trim_words( get_the_excerpt(), 20, '…' ) . '</p>';
 
        $html .= '<div class="project-card-actions">';
        $html .= '<a href="' . esc_url( get_permalink() ) . '" class="project-btn project-btn--primary" style="color:' . esc_attr( $color['accent'] ) . ';background:' . esc_attr( $color['bg'] ) . ';border-color:' . esc_attr( $color['border'] ) . ';">Voir le détail</a>';
 
        if ( $code_link ) {
            $html .= '<a href="' . esc_url( $code_link ) . '" target="_blank" rel="noopener noreferrer" class="project-btn project-btn--secondary">Voir le code</a>';
        }
        if ( $site_link ) {
            $html .= '<a href="' . esc_url( $site_link ) . '" target="_blank" rel="noopener noreferrer" class="project-btn project-btn--secondary">Voir le site</a>';
        }
        $html .= '</div>';
 
        $html .= '</div>';
        $html .= '</article>';
 
        $i++;
    }
 
    wp_reset_postdata();
 
    $html .= '</div>';
    $html .= '<div class="projects-cta"><a href="' . esc_url( home_url( '/projets' ) ) . '" class="portfolio-secondary-btn">Voir tous les projets →</a></div>';
 
    return $html;
}
add_shortcode( 'portfolio_projects', 'portfolio_pro_projects_shortcode' );
 
/**
 * Shortcode formulaire devis — [portfolio_quote_form]
 * Stepper 3 étapes : Type de projet → Détails & budget → Contact
 */
function portfolio_pro_quote_form_shortcode() {
    $feedback = '';
    $success  = false;
 
    // Récupération des valeurs soumises pour repopulation après erreur
    $posted_type     = '';
    $posted_budget   = '';
    $posted_deadline = '';
    $posted_pages    = '';
    $posted_message  = '';
    $posted_name     = '';
    $posted_email    = '';
    $posted_business = '';
 
    if ( 'POST' === $_SERVER['REQUEST_METHOD'] && isset( $_POST['portfolio_quote_submit'] ) ) {
        if ( ! isset( $_POST['portfolio_quote_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['portfolio_quote_nonce'] ) ), 'portfolio_quote_action' ) ) {
            $feedback = 'Vérification de sécurité invalide, merci de recommencer.';
        } else {
            $posted_name     = isset( $_POST['quote_name'] )         ? sanitize_text_field( wp_unslash( $_POST['quote_name'] ) )         : '';
            $posted_email    = isset( $_POST['quote_email'] )        ? sanitize_email( wp_unslash( $_POST['quote_email'] ) )              : '';
            $posted_business = isset( $_POST['quote_business'] )     ? sanitize_text_field( wp_unslash( $_POST['quote_business'] ) )     : '';
            $posted_type     = isset( $_POST['quote_project_type'] ) ? sanitize_text_field( wp_unslash( $_POST['quote_project_type'] ) ) : '';
            $posted_budget   = isset( $_POST['quote_budget'] )       ? sanitize_text_field( wp_unslash( $_POST['quote_budget'] ) )       : '';
            $posted_deadline = isset( $_POST['quote_deadline'] )     ? sanitize_text_field( wp_unslash( $_POST['quote_deadline'] ) )     : '';
            $posted_pages    = isset( $_POST['quote_pages'] )        ? sanitize_text_field( wp_unslash( $_POST['quote_pages'] ) )        : '';
            $posted_message  = isset( $_POST['quote_message'] )      ? sanitize_textarea_field( wp_unslash( $_POST['quote_message'] ) )  : '';
 
            if ( empty( $posted_name ) || empty( $posted_email ) || empty( $posted_type ) || empty( $posted_message ) ) {
                $feedback = 'Merci de remplir au minimum nom, email, type de projet et description.';
            } elseif ( ! is_email( $posted_email ) ) {
                $feedback = 'L\'email fourni n\'est pas valide.';
            } else {
                $to      = 'nicolasraux2@gmail.com';
                $subject = '[Portfolio] Nouvelle demande de devis — ' . $posted_type;
                $body    = "Nouvelle demande de devis\n\n";
                $body   .= "Nom : {$posted_name}\n";
                $body   .= "Email : {$posted_email}\n";
                $body   .= "Entreprise : {$posted_business}\n\n";
                $body   .= "Type de projet : {$posted_type}\n";
                $body   .= "Budget estimé : {$posted_budget}\n";
                $body   .= "Délai souhaité : {$posted_deadline}\n";
                $body   .= "Nombre de pages : {$posted_pages}\n\n";
                $body   .= "Description du besoin :\n{$posted_message}\n";
 
                $headers = array( 'Reply-To: ' . $posted_name . ' <' . $posted_email . '>' );
                $sent    = wp_mail( $to, $subject, $body, $headers );
 
                if ( $sent ) {
                    $success  = true;
                    $feedback = 'Merci, ta demande a bien été envoyée. Je te réponds rapidement !';
                } else {
                    $feedback = 'Erreur lors de l\'envoi. Merci de réessayer ou d\'envoyer un email à nicolasraux2@gmail.com.';
                }
            }
        }
    }
 
    // Types de projets avec icône SVG inline et sous-titre
    $project_types = array(
        array(
            'value'    => 'Site vitrine',
            'label'    => 'Site vitrine',
            'sub'      => 'Présence pro, visuellement soigné',
            'icon'     => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>',
        ),
        array(
            'value'    => 'Refonte de site',
            'label'    => 'Refonte',
            'sub'      => 'Moderniser un site existant',
            'icon'     => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="23 4 23 10 17 10"/><polyline points="1 20 1 14 7 14"/><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/></svg>',
        ),
        array(
            'value'    => 'Site e-commerce',
            'label'    => 'E-commerce',
            'sub'      => 'WooCommerce, boutique en ligne',
            'icon'     => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>',
        ),
        array(
            'value'    => 'Optimisation SEO/performance',
            'label'    => 'SEO & Perf',
            'sub'      => 'Audit et optimisation',
            'icon'     => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>',
        ),
        array(
            'value'    => 'Maintenance',
            'label'    => 'Maintenance',
            'sub'      => 'Suivi et mises à jour',
            'icon'     => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>',
        ),
        array(
            'value'    => 'Autre',
            'label'    => 'Autre',
            'sub'      => 'On en discute ensemble',
            'icon'     => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>',
        ),
    );
 
    $budget_options = array(
        'Moins de 500 €',
        '500 – 1 500 €',
        '1 500 – 3 000 €',
        '3 000 € +',
        'À définir',
    );
 
    ob_start();
    ?>
    <div class="quote-stepper-wrap" id="quote-stepper" data-step="1">
 
        <?php if ( $success ) : ?>
            <div class="quote-success">
                <div class="quote-success-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                </div>
                <h3>Demande envoyée !</h3>
                <p><?php echo esc_html( $feedback ); ?></p>
            </div>
        <?php else : ?>
 
            <?php if ( $feedback ) : ?>
                <p class="quote-feedback quote-feedback--error"><?php echo esc_html( $feedback ); ?></p>
            <?php endif; ?>
 
            <?php
            // Stepper header — réutilisé 3 fois via une fonction inline
            $steps = array(
                1 => 'Type de projet',
                2 => 'Détails & budget',
                3 => 'Contact',
            );
            ?>
 
            <form class="quote-form" method="post" action="#devis" id="quote-form" novalidate>
                <?php wp_nonce_field( 'portfolio_quote_action', 'portfolio_quote_nonce' ); ?>
 
                <!-- ===================== ÉTAPE 1 : TYPE DE PROJET ===================== -->
                <div class="quote-step" id="quote-step-1">
 
                    <div class="quote-stepper-header">
                        <div class="quote-step-item quote-step-item--active">
                            <div class="quote-bubble quote-bubble--active">1</div>
                            <span class="quote-step-label">Type de projet</span>
                        </div>
                        <div class="quote-connector"></div>
                        <div class="quote-step-item">
                            <div class="quote-bubble">2</div>
                            <span class="quote-step-label quote-step-label--muted">Détails & budget</span>
                        </div>
                        <div class="quote-connector"></div>
                        <div class="quote-step-item">
                            <div class="quote-bubble">3</div>
                            <span class="quote-step-label quote-step-label--muted">Contact</span>
                        </div>
                    </div>
 
                    <p class="quote-step-title">Quel type de projet as-tu ?</p>
 
                    <div class="quote-type-grid">
                        <?php foreach ( $project_types as $type ) : ?>
                            <label class="quote-type-card <?php echo ( $posted_type === $type['value'] ) ? 'is-selected' : ''; ?>">
                                <input
                                    type="radio"
                                    name="quote_project_type"
                                    value="<?php echo esc_attr( $type['value'] ); ?>"
                                    <?php checked( $posted_type, $type['value'] ); ?>
                                >
                                <div class="quote-type-icon"><?php echo $type['icon']; // SVG sûr, pas de user input ?></div>
                                <span class="quote-type-label"><?php echo esc_html( $type['label'] ); ?></span>
                                <span class="quote-type-sub"><?php echo esc_html( $type['sub'] ); ?></span>
                            </label>
                        <?php endforeach; ?>
                    </div>
 
                    <div class="quote-actions quote-actions--right">
                        <button type="button" class="quote-btn-next portfolio-primary-btn" data-next="2">
                            Suivant →
                        </button>
                    </div>
                </div>
 
                <!-- ===================== ÉTAPE 2 : DÉTAILS & BUDGET ===================== -->
                <div class="quote-step quote-step--hidden" id="quote-step-2">
 
                    <div class="quote-stepper-header">
                        <div class="quote-step-item quote-step-item--done">
                            <div class="quote-bubble quote-bubble--done">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                            </div>
                            <span class="quote-step-label quote-step-label--muted">Type de projet</span>
                        </div>
                        <div class="quote-connector quote-connector--done"></div>
                        <div class="quote-step-item quote-step-item--active">
                            <div class="quote-bubble quote-bubble--active">2</div>
                            <span class="quote-step-label">Détails & budget</span>
                        </div>
                        <div class="quote-connector"></div>
                        <div class="quote-step-item">
                            <div class="quote-bubble">3</div>
                            <span class="quote-step-label quote-step-label--muted">Contact</span>
                        </div>
                    </div>
 
                    <p class="quote-step-title">Dis-moi en plus sur ton projet</p>
 
                    <div class="quote-field-group">
                        <label class="quote-label">Budget estimé</label>
                        <div class="quote-pills" id="quote-budget-pills">
                            <?php foreach ( $budget_options as $opt ) : ?>
                                <button
                                    type="button"
                                    class="quote-pill <?php echo ( $posted_budget === $opt ) ? 'is-selected' : ''; ?>"
                                    data-value="<?php echo esc_attr( $opt ); ?>"
                                    data-field="quote_budget"
                                >
                                    <?php echo esc_html( $opt ); ?>
                                </button>
                            <?php endforeach; ?>
                        </div>
                        <input type="hidden" name="quote_budget" id="quote_budget" value="<?php echo esc_attr( $posted_budget ); ?>">
                    </div>
 
                    <div class="quote-row-2col">
                        <div class="quote-field-group">
                            <label class="quote-label" for="quote_deadline">Délai souhaité</label>
                            <input
                                type="text"
                                id="quote_deadline"
                                name="quote_deadline"
                                class="quote-input"
                                placeholder="Ex : 4 semaines"
                                value="<?php echo esc_attr( $posted_deadline ); ?>"
                            >
                        </div>
                        <div class="quote-field-group">
                            <label class="quote-label" for="quote_pages">Nombre de pages estimé</label>
                            <input
                                type="text"
                                id="quote_pages"
                                name="quote_pages"
                                class="quote-input"
                                placeholder="Ex : 5 à 10"
                                value="<?php echo esc_attr( $posted_pages ); ?>"
                            >
                        </div>
                    </div>
 
                    <div class="quote-field-group">
                        <label class="quote-label" for="quote_message">Description du besoin <span class="quote-required">*</span></label>
                        <textarea
                            id="quote_message"
                            name="quote_message"
                            class="quote-input quote-textarea"
                            rows="4"
                            placeholder="Objectifs, inspirations, contraintes…"
                        ><?php echo esc_textarea( $posted_message ); ?></textarea>
                    </div>
 
                    <div class="quote-actions">
                        <button type="button" class="quote-btn-back" data-back="1">← Retour</button>
                        <button type="button" class="quote-btn-next portfolio-primary-btn" data-next="3">Suivant →</button>
                    </div>
                </div>
 
                <!-- ===================== ÉTAPE 3 : CONTACT ===================== -->
                <div class="quote-step quote-step--hidden" id="quote-step-3">
 
                    <div class="quote-stepper-header">
                        <div class="quote-step-item quote-step-item--done">
                            <div class="quote-bubble quote-bubble--done">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                            </div>
                            <span class="quote-step-label quote-step-label--muted">Type de projet</span>
                        </div>
                        <div class="quote-connector quote-connector--done"></div>
                        <div class="quote-step-item quote-step-item--done">
                            <div class="quote-bubble quote-bubble--done">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                            </div>
                            <span class="quote-step-label quote-step-label--muted">Détails & budget</span>
                        </div>
                        <div class="quote-connector quote-connector--done"></div>
                        <div class="quote-step-item quote-step-item--active">
                            <div class="quote-bubble quote-bubble--active">3</div>
                            <span class="quote-step-label">Contact</span>
                        </div>
                    </div>
 
                    <p class="quote-step-title">Comment te joindre ?</p>
 
                    <div class="quote-row-2col">
                        <div class="quote-field-group">
                            <label class="quote-label" for="quote_name">Nom <span class="quote-required">*</span></label>
                            <input
                                type="text"
                                id="quote_name"
                                name="quote_name"
                                class="quote-input"
                                placeholder="Ton prénom et nom"
                                value="<?php echo esc_attr( $posted_name ); ?>"
                                required
                            >
                        </div>
                        <div class="quote-field-group">
                            <label class="quote-label" for="quote_email">Email <span class="quote-required">*</span></label>
                            <input
                                type="email"
                                id="quote_email"
                                name="quote_email"
                                class="quote-input"
                                placeholder="ton@email.com"
                                value="<?php echo esc_attr( $posted_email ); ?>"
                                required
                            >
                        </div>
                    </div>
 
                    <div class="quote-field-group">
                        <label class="quote-label" for="quote_business">Entreprise / activité</label>
                        <input
                            type="text"
                            id="quote_business"
                            name="quote_business"
                            class="quote-input"
                            placeholder="Optionnel"
                            value="<?php echo esc_attr( $posted_business ); ?>"
                        >
                    </div>
 
                    <div class="quote-recap" id="quote-recap">
                        <p class="quote-recap-title">Récapitulatif</p>
                        <div class="quote-recap-row">
                            <span class="quote-recap-key">Type</span>
                            <span class="quote-recap-val" id="recap-type"><?php echo esc_html( $posted_type ?: '—' ); ?></span>
                        </div>
                        <div class="quote-recap-row">
                            <span class="quote-recap-key">Budget</span>
                            <span class="quote-recap-val" id="recap-budget"><?php echo esc_html( $posted_budget ?: '—' ); ?></span>
                        </div>
                        <div class="quote-recap-row">
                            <span class="quote-recap-key">Délai</span>
                            <span class="quote-recap-val" id="recap-deadline"><?php echo esc_html( $posted_deadline ?: '—' ); ?></span>
                        </div>
                    </div>
 
                    <div class="quote-actions">
                        <button type="button" class="quote-btn-back" data-back="2">← Retour</button>
                        <button type="submit" name="portfolio_quote_submit" class="portfolio-primary-btn">
                            Envoyer la demande ✓
                        </button>
                    </div>
                </div>
 
            </form>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'portfolio_quote_form', 'portfolio_pro_quote_form_shortcode' );