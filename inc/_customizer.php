<?php
/**
 * Datei: _customizer.php
 * Zweck: Registrierung von Customizer-Einstellungen für dein Theme
 * Wird von functions.php eingebunden
 * @package von_foerster
 */

// Sicherheit
if (!defined('ABSPATH')) exit;

/**
 * Registriert Theme-spezifische Customizer-Felder
 */
function von_foerster_customize_register($wp_customize) {

  // Sektion: Theme-Einstellungen
  $wp_customize->add_section('von_foerster_theme_settings', [
    'title'    => __('Theme-Einstellungen', 'von_foerster'),
    'priority' => 30,
  ]);

  // Favicon
  $wp_customize->add_setting('von_foerster_favicon');
  $wp_customize->add_control(new WP_Customize_Image_Control(
    $wp_customize,
    'von_foerster_favicon',
    [
      'label'    => __('Favicon', 'von_foerster'),
      'section'  => 'von_foerster_theme_settings',
      'settings' => 'von_foerster_favicon',
    ]
  ));

  // Logo
  $wp_customize->add_setting('von_foerster_logo');
  $wp_customize->add_control(new WP_Customize_Image_Control(
    $wp_customize,
    'von_foerster_logo',
    [
      'label'    => __('Logo', 'von_foerster'),
      'section'  => 'von_foerster_theme_settings',
      'settings' => 'von_foerster_logo',
    ]
  ));

  // Maximale Logobreite (in px)
  $wp_customize->add_setting('von_foerster_logo_max_width', [
    'default'           => '',
    'sanitize_callback' => 'absint',
  ]);
  $wp_customize->add_control('von_foerster_logo_max_width', [
    'label'       => __('Maximale Logobreite (in Pixel)', 'von_foerster'),
    'type'        => 'number',
    'section'     => 'von_foerster_theme_settings',
    'input_attrs' => [
      'min' => 0,
      'step' => 1,
    ],
  ]);

  // Headerbild
  $wp_customize->add_setting('von_foerster_header_image');
  $wp_customize->add_control(new WP_Customize_Image_Control(
    $wp_customize,
    'von_foerster_header_image',
    [
      'label'    => __('Headerbild', 'von_foerster'),
      'section'  => 'von_foerster_theme_settings',
      'settings' => 'von_foerster_header_image',
    ]
  ));

  // Hintergrundfarbe Header
  $wp_customize->add_setting('von_foerster_header_bgcolor', [
    'default'   => '#ffffff',
    'transport' => 'refresh',
  ]);
  $wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'von_foerster_header_bgcolor',
    [
      'label'    => __('Hintergrundfarbe Header', 'von_foerster'),
      'section'  => 'von_foerster_theme_settings',
      'settings' => 'von_foerster_header_bgcolor',
    ]
  ));
}
add_action('customize_register', 'von_foerster_customize_register');

/**
 * Beispiel – so verwendest du die Einstellungen im Template:
 *
 * $logo = get_theme_mod('von_foerster_logo');
 * $favicon = get_theme_mod('von_foerster_favicon');
 * $bg = get_theme_mod('von_foerster_header_bgcolor');
 */