<?php
/**
 * Contenu HTML du footer (réutilisé par footer.php et par les pages Elementor Canvas).
 * C’est le seul fichier à modifier pour changer le pied de page.
 */
?>
<footer class="site-footer" id="site-footer">
	<div class="footer-main">
		<div class="container footer-grid">
			<div class="footer-col footer-identity">
				<p class="footer-label">Disponible pour nouveaux projets</p>
				<p class="footer-heading">Nicolas Raux</p>
				<p class="footer-desc">Developpeur WordPress freelance, specialisé themes sur mesure, performances et SEO technique.</p>
				<a class="footer-cta" href="<?php echo esc_url( home_url( '/#devis' ) ); ?>">Demander un devis</a>
			</div>

			<div class="footer-col footer-nav">
				<p class="footer-heading">Navigation</p>
				<ul class="footer-nav-list">
					<li>
						<svg class="footer-nav-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Accueil</a>
					</li>
					<li>
						<svg class="footer-nav-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
						<a href="<?php echo esc_url( home_url( '/projets' ) ); ?>">Projets</a>
					</li>
					<li>
						<svg class="footer-nav-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
						<a href="<?php echo esc_url( home_url( '/services' ) ); ?>">Services</a>
					</li>
					<li>
						<svg class="footer-nav-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
						<a href="<?php echo esc_url( home_url( '/animations' ) ); ?>">Animations</a>
					</li>
					<li>
						<svg class="footer-nav-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
						<a href="<?php echo esc_url( home_url( '/a-propos' ) ); ?>">À propos</a>
					</li>
				</ul>
			</div>

			<div class="footer-col footer-social">
				<p class="footer-heading">Contact rapide</p>
				<div class="footer-social-icons">
					<a href="https://github.com/Nicognito23" target="_blank" rel="noopener noreferrer" class="footer-social-link" aria-label="GitHub">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
					</a>
					<a href="https://www.linkedin.com/in/nicolas-raux-63606a21a/" target="_blank" rel="noopener noreferrer" class="footer-social-link" aria-label="LinkedIn">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
					</a>
					<a href="mailto:nicolasraux2@gmail.com" class="footer-social-link" aria-label="Email">
						<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
					</a>
				</div>
			</div>
		</div>
	</div>

	<div class="footer-copyright">
		<div class="container">
			<p class="footer-copyright-text">© 2026 Nicolas Raux - Développeur Web | Tous droits réservés</p>
		</div>
	</div>
</footer>
