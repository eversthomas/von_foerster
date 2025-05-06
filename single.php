<?php
/**
 * Template: single.php
 * Zweck: Darstellung einzelner Blogbeiträge
 * @package von_foerster
 */
if (!defined('ABSPATH')) exit;
?>

<?php include_once 'template-parts/head.php'; ?>
<?php include_once 'template-parts/header.php'; ?>

<div id="content" role="region" aria-label="Einzelbeitrag">

  <main id="main-content">
    <div class="main-inner">
    <!-- Breadcrumbs -->
      <?php von_foerster_breadcrumb(); ?>

      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article class="single-post">
          <header>
            <h1><?php the_title(); ?></h1>
            <p class="meta">
              Veröffentlicht am <?php echo esc_html(get_the_date()); ?> von <?php the_author(); ?>
            </p>
          </header>

          <?php if (has_post_thumbnail()) : ?>
            <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'large')); ?>"
                 alt="<?php echo esc_attr(von_foerster_get_image_alt(get_post_thumbnail_id())); ?>">
          <?php endif; ?>

          <div class="content">
            <?php the_content(); ?>
          </div>

          <!-- Related Posts -->
          <?php von_foerster_related_posts(5); ?>
        </article>

        <!-- Kommentare -->
        <?php
        if (comments_open() || get_comments_number()) :
          comments_template();
        endif;
        ?>

        <!-- Beitragsnavigation -->
        <nav class="post-navigation" aria-label="Weitere Beiträge">
          <div class="nav-links">
            <div class="nav-previous"><?php previous_post_link('%link', '← %title'); ?></div>
            <div class="nav-next"><?php next_post_link('%link', '%title →'); ?></div>
          </div>
        </nav>

      <?php endwhile; endif; ?>

    </div>
  </main>

  <?php include_once 'template-parts/sidebar.php'; ?>
</div>

<?php include_once 'template-parts/footer.php'; ?>