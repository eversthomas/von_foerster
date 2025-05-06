<?php
/**
 * Datei: _helpers.php
 * Zweck: Allgemeine Hilfsfunktionen für Templates
 * Wird von functions.php eingebunden
 * @package von_foerster
 */

if (!defined('ABSPATH')) exit;

//
// 1. ALT-Text für Beitragsbilder ermitteln
//

function von_foerster_get_image_alt($attachment_id) {
  $alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);

  if (!$alt || trim($alt) === '') {
    $file = get_attached_file($attachment_id);
    if ($file) {
      $filename = basename($file);
      $alt = preg_replace('/\.[^.]+$/', '', $filename); // Dateiendung entfernen
      $alt = str_replace(['-', '_'], ' ', $alt); // etwas lesbarer machen
    }
  }

  return esc_attr($alt);
}

//
// 2. Breadcrumbs generieren (semantisch + schema.org)
//

function von_foerster_breadcrumb() {
  if (is_front_page()) return;

  echo '<nav class="breadcrumb" aria-label="Pfadnavigation">';
  echo '<ol itemscope itemtype="https://schema.org/BreadcrumbList">';

  // Startseite
  echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
  echo '<a itemprop="item" href="' . esc_url(home_url()) . '">';
  echo '<span itemprop="name">Startseite</span></a>';
  echo '<meta itemprop="position" content="1" />';
  echo '</li>';

  $position = 2;

  if (is_singular()) {
    $post = get_queried_object();
    $ancestors = get_post_ancestors($post);
    $ancestors = array_reverse($ancestors);

    foreach ($ancestors as $ancestor) {
      echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
      echo '<a itemprop="item" href="' . get_permalink($ancestor) . '">';
      echo '<span itemprop="name">' . get_the_title($ancestor) . '</span></a>';
      echo '<meta itemprop="position" content="' . $position++ . '" />';
      echo '</li>';
    }

    echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
  
    $full_title = get_the_title();
    $short_title = mb_strlen($full_title) > 40 
    ? mb_substr($full_title, 0, 37) . '…'
    : $full_title;

    echo '<span itemprop="name" title="' . esc_attr($full_title) . '">' . esc_html($short_title) . '</span>';
    echo '<meta itemprop="position" content="' . $position . '" />';
    echo '</li>';
  }

  elseif (is_category() || is_tag() || is_tax()) {
    $term = get_queried_object();
    echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
    echo '<span itemprop="name">' . esc_html($term->name) . '</span>';
    echo '<meta itemprop="position" content="' . $position . '" />';
    echo '</li>';
  }

  elseif (is_search()) {
    echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
    echo '<span itemprop="name">Suche nach „' . esc_html(get_search_query()) . '“</span>';
    echo '<meta itemprop="position" content="' . $position . '" />';
    echo '</li>';
  }

  elseif (is_404()) {
    echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
    echo '<span itemprop="name">Seite nicht gefunden</span>';
    echo '<meta itemprop="position" content="' . $position . '" />';
    echo '</li>';
  }

  echo '</ol>';
  echo '</nav>';
}

//
// 3. Related Posts auf Basis gemeinsamer Kategorien
//

function von_foerster_related_posts($count = 3) {
  global $post;

  if (!is_singular('post')) return;

  $categories = wp_get_post_categories($post->ID);

  if (!$categories) return;

  $args = [
    'category__in'         => $categories,
    'post__not_in'         => [$post->ID],
    'posts_per_page'       => $count,
    'ignore_sticky_posts'  => 1,
  ];

  $related = new WP_Query($args);

  if ($related->have_posts()) {
    echo '<section class="related-posts" aria-label="Ähnliche Beiträge">';
    echo '<h2>Ähnliche Beiträge</h2>';
    echo '<ul class="related-list">';

    while ($related->have_posts()) {
      $related->the_post();
      echo '<li class="related-item">';
      if (has_post_thumbnail()) {
        echo '<a href="' . esc_url(get_permalink()) . '">';
        echo get_the_post_thumbnail(null, 'thumbnail', [
          'alt' => von_foerster_get_image_alt(get_post_thumbnail_id())
        ]);
        echo '</a>';
      }
      echo '<a href="' . esc_url(get_permalink()) . '">';
      echo '<h3>' . get_the_title() . '</h3>';
      echo '</a>';
      echo '</li>';
    }

    echo '</ul>';
    echo '</section>';

    wp_reset_postdata();
  }
}