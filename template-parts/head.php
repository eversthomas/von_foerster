<?php
/**
 * Datei: inc/head.php
 * Zweck: Dynamisch generierter <head>-Bereich inkl. SEO, OG-Tags und Schema.org
 * Aufgerufen in: Alle Templates
 * @package von_foerster
 */
if (!defined('ABSPATH')) exit;
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <?php
    $site_name        = get_bloginfo('name');
    $site_description = get_bloginfo('description');
    $current_url      = esc_url((is_ssl() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
    $default_image    = get_template_directory_uri() . '/images/social-default.jpg';
    $logo             = get_theme_mod('von_foerster_logo');

    // Titel
    if (is_front_page()) {
      $title = "$site_name – $site_description";
    } elseif (is_singular()) {
      $title = get_the_title() . " – $site_name";
    } elseif (is_category()) {
      $title = single_cat_title('', false) . " – $site_name";
    } elseif (is_tag()) {
      $title = single_tag_title('', false) . " – $site_name";
    } elseif (is_search()) {
      $title = 'Suchergebnisse für „' . get_search_query() . "“ – $site_name";
    } elseif (is_404()) {
      $title = 'Seite nicht gefunden – ' . $site_name;
    } else {
      $title = trim(wp_title('–', false, 'right')) . " $site_name";
    }

    // Description
    $description = (is_singular() && has_excerpt()) ? get_the_excerpt() : $site_description;

    // OG-Bild
    $og_image = (is_singular() && has_post_thumbnail())
      ? get_the_post_thumbnail_url(null, 'large')
      : $default_image;

    // Autor
    $author_id = get_post_field('post_author', get_the_ID());
    $author = $author_id ? get_the_author_meta('display_name', $author_id) : $site_name;
  ?>

  <title><?php echo esc_html($title); ?></title>
  <meta name="description" content="<?php echo esc_attr($description); ?>">
  <meta name="robots" content="index, follow" />
  <meta name="theme-color" content="#000000" />
  <meta name="author" content="<?php echo esc_attr($author); ?>" />
  <link rel="canonical" href="<?php echo $current_url; ?>">

  <!-- Open Graph -->
  <meta property="og:title" content="<?php echo esc_attr($title); ?>" />
  <meta property="og:description" content="<?php echo esc_attr($description); ?>" />
  <meta property="og:image" content="<?php echo esc_url($og_image); ?>" />
  <meta property="og:url" content="<?php echo $current_url; ?>" />
  <meta property="og:type" content="<?php echo is_singular() ? 'article' : 'website'; ?>" />
  <meta property="og:locale" content="de_DE" />

  <!-- Schema.org JSON-LD -->
  <?php if (is_front_page()) : ?>
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "<?php echo esc_js($site_name); ?>",
    "url": "<?php echo esc_url(home_url()); ?>",
    "logo": "<?php echo esc_url($logo); ?>"
  }
  </script>
  <?php endif; ?>

  <?php if (is_singular()) : ?>
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Article",
    "mainEntityOfPage": {
      "@type": "WebPage",
      "@id": "<?php echo esc_url(get_permalink()); ?>"
    },
    "headline": "<?php echo esc_js(get_the_title()); ?>",
    "description": "<?php echo esc_js($description); ?>",
    "image": "<?php echo esc_url($og_image); ?>",
    "datePublished": "<?php echo esc_attr(get_the_date('c')); ?>",
    "dateModified": "<?php echo esc_attr(get_the_modified_date('c')); ?>",
    "author": {
      "@type": "Person",
      "name": "<?php echo esc_js($author); ?>"
    },
    "publisher": {
      "@type": "Organization",
      "name": "<?php echo esc_js($site_name); ?>",
      "logo": {
        "@type": "ImageObject",
        "url": "<?php echo esc_url($logo); ?>"
      }
    }
  }
  </script>
  <?php endif; ?>

  <!-- Manifest -->
  <link rel="manifest" href="/manifest.json" />

  <!-- Apple-Touch-Icon -->
  <link rel="apple-touch-icon" href="apple-touch-icon.png" />

  <!-- Favicon -->
  <?php
    $favicon = get_theme_mod('von_foerster_favicon');
    if ($favicon) {
      echo '<link rel="icon" href="' . esc_url($favicon) . '" type="image/png">';
    }
  ?>

  <!-- Stylesheet -->
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/main.css" />
</head>
<body>