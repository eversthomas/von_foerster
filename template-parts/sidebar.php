<?php
/**
 * Datei: inc/sidebar.php
 * Zweck: Ausgabe der Sidebar mit bis zu drei Widget-Bereichen
 * Aufgerufen in: Alle Templates mit Sidebar
 * @package von_foerster
 */
if (!defined('ABSPATH')) exit;
?>

<aside role="complementary" aria-label="Zusätzliche Informationen">
  <div class="aside-inner">
  	<h3>Sidebar</h3>

    <?php if (is_active_sidebar('sidebar-1')) : ?>
      <section class="widget-area" id="sidebar-1" aria-label="Seitenleiste 1">
        <?php dynamic_sidebar('sidebar-1'); ?>
      </section>
    <?php endif; ?>

    <?php if (is_active_sidebar('sidebar-2')) : ?>
      <section class="widget-area" id="sidebar-2" aria-label="Seitenleiste 2">
        <?php dynamic_sidebar('sidebar-2'); ?>
      </section>
    <?php endif; ?>

    <?php if (is_active_sidebar('sidebar-3')) : ?>
      <section class="widget-area" id="sidebar-3" aria-label="Seitenleiste 3">
        <?php dynamic_sidebar('sidebar-3'); ?>
      </section>
    <?php endif; ?>

  </div>
</aside>