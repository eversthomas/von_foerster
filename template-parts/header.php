<?php
/**
 * Datei: inc/header.php
 * Zweck: Ausgabe des sichtbaren Seitenkopfs inkl. Logo, Titel, Suche, Breadcrumbs
 * Aufgerufen in: Alle Templates
 * @package von_foerster
 */
if (!defined('ABSPATH')) exit;
?>

<!-- Skip-Link (sichtbar bei Tastaturfokus) -->
<a href="#main-content" class="skip-link">Zum Hauptinhalt springen</a>

<?php
  $site_name   = get_bloginfo('name');
  $site_desc   = get_bloginfo('description');
  $bg_color    = get_theme_mod('von_foerster_header_bgcolor');
  $bg_image    = get_theme_mod('von_foerster_header_image');
  $logo        = get_theme_mod('von_foerster_logo');
  $logo_width  = get_theme_mod('von_foerster_logo_max_width');

  // Inline-Styles zusammensetzen
  $header_style = [];
  if ($bg_color) $header_style[] = 'background-color: ' . esc_attr($bg_color);
  if ($bg_image) $header_style[] = 'background-image: url(' . esc_url($bg_image) . ')';
?>

<header id="header" role="banner" style="<?php echo implode('; ', $header_style); ?>">
  <div class="header-inner">

    <div class="site-title">
      <h1><?php echo esc_html($site_name); ?></h1>
      <p><?php echo esc_html($site_desc); ?></p>

      <?php if ($logo) : ?>
        <?php $style = $logo_width ? 'style="max-width:' . esc_attr($logo_width) . 'px;"' : ''; ?>
        <img src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_attr($site_name); ?>" <?php echo $style; ?>>
      <?php endif; ?>

      <!-- Suchformular -->
      <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
        <label for="s">Suche:</label>
        <input type="search" id="s" name="s" value="<?php echo esc_attr(get_search_query()); ?>" />
        <button type="submit">Suchen</button>
      </form>
    </div>

    <!-- Hauptnavigation -->
	<?php include_once 'navigation.php'; ?>
    
  </div>
</header>