<?php
/**
 * Template: index.php
 * Zweck: Fallback-Template und Blog-Übersichtsseite
 * Wird verwendet, wenn keine spezifischere Template-Datei greift
 * @package von_foerster
 */
if (!defined('ABSPATH')) exit;
?>

<?php include_once 'template-parts/head.php'; ?>
<?php include_once 'template-parts/header.php'; ?>

<!-- Hauptbereich -->
<div class="grid" id="content" role="region" aria-label="Seiteninhalt">

  <main id="main-content">
    <div class="main-inner">

      <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
          <article class="post-preview">
            <header>
              <h2>
                <a href="<?php the_permalink(); ?>">
                  <?php the_title(); ?>
                </a>
              </h2>
            </header>

            <?php if (has_post_thumbnail()) : ?>
              <a href="<?php the_permalink(); ?>">
                <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'medium')); ?>"
                     alt="<?php echo esc_attr(von_foerster_get_image_alt(get_post_thumbnail_id())); ?>">
              </a>
            <?php endif; ?>

            <p><?php the_excerpt(); ?></p>

            <p class="meta">
              Veröffentlicht am <?php echo esc_html(get_the_date()); ?> von <?php the_author(); ?>
            </p>

            <a href="<?php the_permalink(); ?>">Weiterlesen →</a>
          </article>
        <?php endwhile; ?>
      <?php else : ?>
        <p>Keine Beiträge gefunden.</p>
      <?php endif; ?>

      <nav class="pagination" aria-label="Beitragsnavigation">
        <?php
        global $wp_query;
        $total_pages = $wp_query->max_num_pages;

        if ($total_pages > 1) {
          $current_page = max(1, get_query_var('paged'));

          echo paginate_links([
            'base'      => get_pagenum_link(1) . '%_%',
            'format'    => 'page/%#%/',
            'current'   => $current_page,
            'total'     => $total_pages,
            'prev_text' => '←',
            'next_text' => '→',
            'type'      => 'list', // erzeugt <ul><li>…</li></ul>
          ]);
        }
        ?>
      </nav>

    </div>
  </main>

  <?php include_once 'template-parts/sidebar.php'; ?>
</div>

<?php include_once 'template-parts/footer.php'; ?>