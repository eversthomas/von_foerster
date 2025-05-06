<?php
/**
 * Datei: inc/footer.php
 * Zweck: Ausgabe des Seitenfußes
 * Aufgerufen in: Alle Templates
 * @package von_foerster
 */
if (!defined('ABSPATH')) exit;
?>

<!-- Footer -->
<footer role="contentinfo" aria-label="Fußbereich">
  <div class="footer-inner">
    <a href="<?php echo esc_url( __( 'https://wordpress.org/', '_s' ) ); ?>">
		<?php
			/* translators: %s: CMS name, i.e. WordPress. */
			printf( esc_html__( 'Proudly powered by %s', '_s' ), 'WordPress' );
		?>
	</a>
    <span class="sep"> | </span> Theme: <strong><?php echo wp_get_theme()->get('Name'); ?></strong> 
      von <a href="https://thomas-evers.info"><?php echo esc_html(wp_get_theme()->get('Author')); ?></a>
</footer>

<!-- scripts -->
<script src="<?php echo get_template_directory_uri(); ?>/scripts/main.js" defer></script>
</body>
</html>