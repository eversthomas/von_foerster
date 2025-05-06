<?php
/**
 * Template: Archivseite
 * Zweck: Ausgabe von Kategorie-, Tag-, Autoren- und Zeit-Archiven
 * @package von_foerster
 */
if (!defined('ABSPATH')) exit;
?>

<?php include_once 'template-parts/head.php'; ?>
<?php include_once 'template-parts/header.php'; ?>

<div id="content" role="region" aria-label="Archivübersicht">

  <?php von_foerster_breadcrumb(); ?>

  <main id="main-content">
    <div class="main-inner">

      <header class="archive-header">
        <h1>
          <?php
          if (is_category()) {
            single_cat_title();
          } elseif (is_tag()) {
            single_tag_title();
          } elseif (is_author()) {
            the_post(); // benötigt für get_the_author()
            echo 'Beiträge von ' . esc_html(get_the_author());
            rewind_posts(); // zurücksetzen für Loop
          } elseif (is_day()) {
            echo 'Archiv: ' . esc_html(get_the_date());
          } elseif (is_month()) {
            echo 'Archiv: ' . esc_html(get_the_date('F Y'));
          } elseif (is_year()) {
            echo 'Archiv: ' . esc_html(get_the_date('Y'));
          } else {
            echo 'Archiv';
          }
          ?>
        </h1>

        <?php
        if (is_category() || is_tag()) {
          $term = get_queried_object();
          if (!empty($term->description)) {
            echo '<p class="term-description">' . esc_html($term->description) . '</p>';
          }
        }
        ?>
      </header>

      <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
          <article class="post-preview">
            <header>
              <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            </header>

            <?php if (has_post_thumbnail()) : ?>
              <a href="<?php the_permalink(); ?>">
                <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'medium')); ?>"
                     alt="<?php echo esc_attr(von_foerster_get_image_alt(get_post_thumbnail_id())); ?>">
              </a>
            <?php endif; ?>

            <p><?php the_excerpt(); ?></p>
            <p class="meta">Veröffentlicht am <?php echo esc_html(get_the_date()); ?> von <?php the_author(); ?></p>
            <a href="<?php the_permalink(); ?>">Weiterlesen →</a>
          </article>
        <?php endwhile; ?>

        <nav class="pagination" aria-label="Beitragsnavigation">
          <?php
          global $wp_query;
          echo paginate_links([
            'current'   => max(1, get_query_var('paged')),
            'total'     => $wp_query->max_num_pages,
            'prev_text' => '←',
            'next_text' => '→',
            'type'      => 'list',
          ]);
          ?>
        </nav>

      <?php else : ?>
        <p>Keine Beiträge gefunden.</p>
      <?php endif; ?>

    </div>
  </main>

  <?php include_once 'template-parts/sidebar.php'; ?>
</div>

<?php include_once 'template-parts/footer.php'; ?>