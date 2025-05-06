<?php
/**
 * Datei: _widgets.php
 * Zweck: Registrierung eigener Widgets
 * Wird von functions.php eingebunden
 * @package von_foerster
 */

if (!defined('ABSPATH')) exit;

//
// 1. Kategorie-Widget mit Anzeigeoptionen
//

class von_foerster_Category_Widget extends WP_Widget {

  public function __construct() {
    parent::__construct(
      'von_foerster_category_widget',
      __('Kategorien (von_foerster)', 'von_foerster'),
      ['description' => __('Zeigt Kategorien aus Beiträgen, mit optionaler Sortierung nach Häufigkeit.', 'von_foerster')]
    );
  }

  public function widget($args, $instance) {
    $title         = apply_filters('widget_title', $instance['title'] ?? 'Kategorien');
    $limit         = !empty($instance['limit']) ? absint($instance['limit']) : 10;
    $sort_by_count = !empty($instance['sort_by_count']);

    $orderby = $sort_by_count ? 'count' : 'name';
    $order   = $sort_by_count ? 'DESC'  : 'ASC';

    $categories = get_categories([
      'orderby'    => $orderby,
      'order'      => $order,
      'number'     => $limit,
      'hide_empty' => true,
    ]);

    if (!empty($categories)) {
      echo $args['before_widget'];
      if (!empty($title)) {
        echo $args['before_title'] . esc_html($title) . $args['after_title'];
      }

      echo '<ul class="category-widget">';
      foreach ($categories as $category) {
        echo '<li><a href="' . esc_url(get_category_link($category->term_id)) . '">' .
             esc_html($category->name) . '</a> <span class="post-count">(' . intval($category->count) . ')</span></li>';
      }
      echo '</ul>';

      echo $args['after_widget'];
    }
  }

  public function form($instance) {
    $title         = $instance['title'] ?? 'Kategorien';
    $limit         = $instance['limit'] ?? 10;
    $sort_by_count = !empty($instance['sort_by_count']);
    ?>
    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>">Titel:</label>
      <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
             name="<?php echo $this->get_field_name('title'); ?>" type="text"
             value="<?php echo esc_attr($title); ?>">
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('limit'); ?>">Anzahl:</label>
      <input class="tiny-text" id="<?php echo $this->get_field_id('limit'); ?>"
             name="<?php echo $this->get_field_name('limit'); ?>" type="number" step="1" min="1"
             value="<?php echo esc_attr($limit); ?>" size="3">
    </p>
    <p>
      <input class="checkbox" type="checkbox"
             <?php checked($sort_by_count); ?>
             id="<?php echo $this->get_field_id('sort_by_count'); ?>"
             name="<?php echo $this->get_field_name('sort_by_count'); ?>" />
      <label for="<?php echo $this->get_field_id('sort_by_count'); ?>">
        Nach Häufigkeit sortieren
      </label>
    </p>
    <?php
  }

  public function update($new_instance, $old_instance) {
    return [
      'title'         => sanitize_text_field($new_instance['title']),
      'limit'         => absint($new_instance['limit']),
      'sort_by_count' => !empty($new_instance['sort_by_count']),
    ];
  }
}

//
// 2. Galerie-Widget (nur Registrierung – Logik in _media-gallery.php)
//

class VonFoerster_Galerie_Widget extends WP_Widget {

  public function __construct() {
    parent::__construct(
      'vonfoerster_galerie_widget',
      __('Galerie-Widget (Tags)', 'von_foerster'),
      ['description' => __('Zeigt eine Galerie auf Basis von Stichwort-Tags an.', 'von_foerster')]
    );
  }

  public function widget($args, $instance) {
    $title = apply_filters('widget_title', $instance['title'] ?? '');
    $tags_raw = $instance['tags'] ?? '';
    $tags = array_filter(array_map('trim', explode(',', $tags_raw)));

    echo $args['before_widget'];

    if (!empty($title)) {
      echo $args['before_title'] . esc_html($title) . $args['after_title'];
    }

    if (!empty($tags)) {
      von_foerster_galerie_bilder($tags); // Funktion aus _media-gallery.php
    } else {
      echo '<p>Keine Galerie-Tags definiert.</p>';
    }

    echo $args['after_widget'];
  }

  public function form($instance) {
    $title = $instance['title'] ?? '';
    $tags  = $instance['tags'] ?? '';
    ?>
    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>">Titel:</label>
      <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
             name="<?php echo $this->get_field_name('title'); ?>" type="text"
             value="<?php echo esc_attr($title); ?>">
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('tags'); ?>">Galerie-Tags (kommagetrennt):</label>
      <input class="widefat" id="<?php echo $this->get_field_id('tags'); ?>"
             name="<?php echo $this->get_field_name('tags'); ?>" type="text"
             value="<?php echo esc_attr($tags); ?>">
    </p>
    <?php
  }

  public function update($new_instance, $old_instance) {
    return [
      'title' => sanitize_text_field($new_instance['title']),
      'tags'  => sanitize_text_field($new_instance['tags']),
    ];
  }
}

/**
 * Registrierung beider Widgets
 */
function von_foerster_register_widgets() {
  register_widget('von_foerster_Category_Widget');
  register_widget('VonFoerster_Galerie_Widget');
}
add_action('widgets_init', 'von_foerster_register_widgets');