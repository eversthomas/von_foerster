<?php
/**
 * functions.php
 * Hauptfunktionen für das Theme „von_foerster“
 * @package von_foerster
 */

// Sicherheit
if (!defined('ABSPATH')) exit;

// ▸ Setup: Theme-Funktionen, Menüs, Sidebars
require_once get_template_directory() . '/inc/_setup.php';

// ▸ Customizer-Einstellungen (Favicon, Logo, Header)
require_once get_template_directory() . '/inc/_customizer.php';

// ▸ Widgets (Kategorien, Galerie)
require_once get_template_directory() . '/inc/_widgets.php';

// ▸ Galerie-Tags & -Ausgabe im Medienmanager
require_once get_template_directory() . '/inc/_media-gallery.php';

// ▸ Kommentarfunktion (eigener Callback)
require_once get_template_directory() . '/inc/_comments.php';

// ▸ Hilfsfunktionen: ALT-Text, Breadcrumb, Related Posts
require_once get_template_directory() . '/inc/_helpers.php';

// ▸ Sitemap-Ausgabe unter /sitemap.xml
require_once get_template_directory() . '/inc/_sitemap.php';