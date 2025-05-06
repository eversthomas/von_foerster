<?php
/**
 * Datei: _sitemap.php
 * Zweck: Erzeugt eine einfache XML-Sitemap unter /sitemap.xml
 * Wird von functions.php eingebunden
 * @package von_foerster
 */

if (!defined('ABSPATH')) exit;

//
// 1. Sitemap-Endpunkt registrieren
//

add_action('init', function () {
  add_rewrite_rule('^sitemap\.xml$', 'index.php?sitemap=1', 'top');
});

//
// 2. Query-Variable zulassen
//

add_filter('query_vars', function ($vars) {
  $vars[] = 'sitemap';
  return $vars;
});

//
// 3. Sitemap-Ausgabe bei Aufruf von /sitemap.xml
//

add_action('template_redirect', function () {
  if (get_query_var('sitemap')) {
    header('Content-Type: application/xml; charset=utf-8');

    echo '<?xml version="1.0" encoding="UTF-8"?>';
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

    $posts = get_posts([
      'numberposts' => -1,
      'post_type'   => ['post', 'page'],
      'post_status' => 'publish'
    ]);

    foreach ($posts as $post) {
      echo '<url>';
      echo '<loc>' . esc_url(get_permalink($post)) . '</loc>';
      echo '<lastmod>' . get_the_modified_date('c', $post) . '</lastmod>';
      echo '<changefreq>weekly</changefreq>';
      echo '<priority>0.8</priority>';
      echo '</url>';
    }

    echo '</urlset>';
    exit;
  }
});