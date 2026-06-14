<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header" id="site-header">
    <div class="container site-header-inner">
        <a class="site-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <span class="site-brand-mark">$</span>
            <span class="site-brand-text"><?php bloginfo( 'name' ); ?></span>
        </a>
 
        <button class="site-nav-toggle" type="button" aria-expanded="false" aria-controls="site-nav" aria-label="Ouvrir le menu">
            <svg class="nav-icon-open" width="18" height="14" viewBox="0 0 18 14" fill="none" aria-hidden="true">
                <rect y="0"  width="18" height="2" rx="1" fill="currentColor"/>
                <rect y="6"  width="18" height="2" rx="1" fill="currentColor"/>
                <rect y="12" width="18" height="2" rx="1" fill="currentColor"/>
            </svg>
            <svg class="nav-icon-close" width="14" height="14" viewBox="0 0 14 14" fill="none" aria-hidden="true" style="display:none">
                <line x1="1" y1="1" x2="13" y2="13" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                <line x1="13" y1="1" x2="1" y2="13" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
        </button>
 
        <div class="site-header-right">
            <nav class="site-nav" id="site-nav" aria-label="Navigation principale">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'primary',
                        'container'      => false,
                        'menu_class'     => 'site-nav-list',
                        'fallback_cb'    => 'portfolio_pro_nav_fallback',
                    )
                );
                ?>
            </nav>
 
            <a class="site-header-cta" href="<?php echo esc_url( home_url( '/#devis' ) ); ?>">Demander un devis</a>
        </div>
    </div>
</header>