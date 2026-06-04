<?php
/**
 * Pied de page du thème.
 * Ce fichier n'est pas chargé sur les pages Elementor Canvas ; le footer est alors injecté via wp_footer.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
define( 'PORTFOLIO_PRO_FOOTER_LOADED', true );

$footer_file = get_theme_file_path( 'inc/footer-html.php' );
if ( $footer_file && is_readable( $footer_file ) ) {
	require $footer_file;
}
wp_footer();
?>
</body>
</html>
