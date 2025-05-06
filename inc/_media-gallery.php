<?php
/**
 * Datei: _media-gallery.php
 * Zweck: Galerie-Erweiterung über Medien-Metadaten (Tags)
 * Wird von functions.php eingebunden
 * @package von_foerster
 */

if (!defined('ABSPATH')) exit;

//
// 1. Feld „Galerie-Tags“ im Medien-Uploader hinzufügen
//

function von_foerster_add_gallery_field($form_fields, $post) {
  $wert = get_post_meta($post->ID, '_von_foerster_galerie_tags', true);

  $form_fields['von_foerster_galerie_tags'] = [
    'label' => __('Galerie-Tags', 'von_foerster'),
    'input' => 'text',
    'value' => $wert,
    'helps' => __('Kommagetrennte Stichworte wie: sommer, awo, 2024', 'von_foerster'),
  ];

  return $form_fields;
}
add_filter('attachment_fields_to_edit', 'von_foerster_add_gallery_field', 10, 2);

//
// 2. Feld speichern beim Speichern des Bilds
//

function von_foerster_save_gallery_field($post, $attachment) {
  if (isset($attachment['von_foerster_galerie_tags'])) {
    update_post_meta(
      $post['ID'],
      '_von_foerster_galerie_tags',
      sanitize_text_field($attachment['von_foerster_galerie_tags'])
    );
  }
  return $post;
}
add_filter('attachment_fields_to_save', 'von_foerster_save_gallery_field', 10, 2);

//
// 3. Ausgabe einer Galerie auf Basis definierter Tags
//

function von_foerster_galerie_bilder($tags = []) {
  if (empty($tags) || !is_array($tags)) {
    echo '<p>' . esc_html__('Keine Galerie-Tags definiert.', 'von_foerster') . '</p>';
    return;
  }

  $meta_query = ['relation' => 'OR'];
  foreach ($tags as $tag) {
    $meta_query[] = [
      'key'     => '_von_foerster_galerie_tags',
      'value'   => $tag,
      'compare' => 'LIKE',
    ];
  }

  $bilder = get_posts([
    'post_type'      => 'attachment',
    'post_mime_type' => 'image',
    'posts_per_page' => -1,
    'post_status'    => 'inherit',
    'meta_query'     => $meta_query,
    'orderby'        => 'date',
    'order'          => 'ASC',
  ]);

  if ($bilder) {
    echo '<div class="vonfoerster-gallery">';
    foreach ($bilder as $bild) {
      $url = wp_get_attachment_image_url($bild->ID, 'medium');
      $alt = get_post_meta($bild->ID, '_wp_attachment_image_alt', true);
      if (!$alt) {
        $alt = basename(get_attached_file($bild->ID));
        $alt = preg_replace('/\.[^.]+$/', '', $alt);
        $alt = str_replace(['-', '_'], ' ', $alt);
      }

      echo '<img src="' . esc_url($url) . '" alt="' . esc_attr($alt) . '">';
    }
    echo '</div>';
  } else {
    echo '<p>' . esc_html__('Keine passenden Bilder gefunden.', 'von_foerster') . '</p>';
  }
}