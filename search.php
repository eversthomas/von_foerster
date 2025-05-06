<?php
/**
 * Template: search.php
 * Zweck: Ausgabe der Suchergebnisse
 * Wird verwendet bei Aufruf von ?s=...
 * @package von_foerster
 */
if (!defined('ABSPATH')) exit;
?>

<?php include_once 'template-parts/head.php'; ?>
<?php include_once 'template-parts/header.php'; ?>

<div id="content" role="region" aria-label="Suchergebnisse">

  <main id="main-content">
    <div class="main-inner">

      <h1>Suchergebnisse für „<?php echo esc_html(get_search_query()); ?>“</h1>

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
          </article>
        <?php endwhile; ?>

        <!-- Paginierung -->
        <nav class="pagination" aria-label="Beitragsnavigation">
          <?php
          global $wp_query;
          $total_pages = $wp_query->max_num_pages;
          if ($total_pages > 1) {
            echo paginate_links([
              'current'   => max(1, get_query_var('paged')),
              'total'     => $total_pages,
              'prev_text' => '←',
              'next_text' => '→',
              'type'      => 'list',
            ]);
          }
          ?>
        </nav>

      <?php else : ?>
        <p>Es wurden keine Beiträge gefunden, die zu deiner Suche passen.</p>
        <p>Bitte versuche es erneut mit einem anderen Begriff.</p>
      <?php endif; ?>

    </div>
  </main>

  <?php include_once 'template-parts/sidebar.php'; ?>
</div>

<?php include_once 'template-parts/footer.php'; ?>