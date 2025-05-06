<?php
/**
 * Template Name: Galerie-Seite
 * Zweck: Individuelle Seitenvorlage zur Darstellung einer Galerie über ein Widget
 * @package von_foerster
 */
if (!defined('ABSPATH')) exit;
?>

<?php include_once 'template-parts/head.php'; ?>
<?php include_once 'template-parts/header.php'; ?>

<div id="content" role="region" aria-label="Galerieseite">

  <main id="main-content">
    <div class="main-inner">

      <article class="page">
        <header>
          <h1><?php the_title(); ?></h1>
        </header>

        <div class="content">
          <?php while (have_posts()) : the_post(); ?>
            <?php the_content(); ?>
          <?php endwhile; ?>
        </div>
      </article>

      <section class="galerie-widget-ausgabe" aria-label="Zugewiesene Galerie">
        <?php
        if (is_active_sidebar('sidebar-1')) {
          // Gibt das Galerie-Widget aus, wenn es z. B. in sidebar-1 liegt
          dynamic_sidebar('sidebar-1');
        } else {
          echo '<p>' . esc_html__('Keine Galerie konfiguriert.', 'von_foerster') . '</p>';
        }
        ?>
      </section>

    </div>
  </main>

  <?php include_once 'template-parts/sidebar.php'; ?>
</div>

<?php include_once 'template-parts/footer.php'; ?>