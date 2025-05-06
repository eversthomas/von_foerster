<?php
/**
 * Datei: _setup.php
 * Zweck: Registrierung grundlegender Theme-Funktionen
 * Wird von functions.php eingebunden
 * @package von_foerster
 */

// Sicherheit
if (!defined('ABSPATH')) exit;

/**
 * Beitragsbilder aktivieren
 */
add_theme_support('post-thumbnails');

/**
 * Zwei Menüs registrieren: Hauptmenü und Footermenü
 */
function von_foerster_register_menus() {
  register_nav_menus([
    'main_menu'   => __('Hauptmenü', 'von_foerster'),
    'footer_menu' => __('Footermenü', 'von_foerster'),
  ]);
}
add_action('after_setup_theme', 'von_foerster_register_menus');

/**
 * Widget-Bereiche (Sidebars) registrieren
 */
function von_foerster_register_sidebars() {
  remove_theme_support('widgets-block-editor'); // nur klassische Widgets

  for ($i = 1; $i <= 3; $i++) {
    register_sidebar([
      'name'          => "Widget-Bereich $i",
      'id'            => "sidebar-$i",
      'before_widget' => '<div class="widget">',
      'after_widget'  => '</div>',
      'before_title'  => '<h3 class="widget-title">',
      'after_title'   => '</h3>',
    ]);
  }
}
add_action('widgets_init', 'von_foerster_register_sidebars');

/**
 * Beispiel – so bindest du das Menü im Template ein:
 * <?php wp_nav_menu(['theme_location' => 'main_menu']); ?>
 *
 * Beispiel – so bindest du einen Widgetbereich ein:
 * <?php if (is_active_sidebar('sidebar-1')) dynamic_sidebar('sidebar-1'); ?>
 */