<?php
/**
 * Template: page.php
 * Zweck: Darstellung statischer Seiten
 * Wird verwendet für alle Seiten ohne eigenes Template
 * @package von_foerster
 */
if (!defined('ABSPATH')) exit;
?>

<?php include_once 'template-parts/head.php'; ?>
<?php include_once 'template-parts/header.php'; ?>

<div id="content" role="region" aria-label="Seiteninhalt">

  <main id="main-content">
    <div class="main-inner">
    	<!-- Breadcrumbs -->
      <?php von_foerster_breadcrumb(); ?>

      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article class="page-content">
          <header>
            <h1><?php the_title(); ?></h1>
          </header>

          <?php if (has_post_thumbnail()) : ?>
            <img src="<?php echo esc_url(get_the_post_thumbnail_url(null, 'large')); ?>"
                 alt="<?php echo esc_attr(von_foerster_get_image_alt(get_post_thumbnail_id())); ?>">
          <?php endif; ?>

          <div class="content">
            <?php the_content(); ?>
          </div>
        </article>
      <?php endwhile; endif; ?>

    </div>
  </main>

  <?php include_once 'template-parts/sidebar.php'; ?>
</div>

<?php include_once 'template-parts/footer.php'; ?>