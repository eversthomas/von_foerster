<?php
/**
 * Template: 404
 * Zweck: Darstellung der Fehlerseite „Seite nicht gefunden“
 * Wird verwendet, wenn keine andere Template-Datei greift
 * @package von_foerster
 */
if (!defined('ABSPATH')) exit;
?>

<?php include_once 'template-parts/head.php'; ?>
<?php include_once 'template-parts/header.php'; ?>

<div id="content" role="region" aria-label="Fehlerseite">

  <main id="main-content">
    <div class="main-inner">

      <section class="error-404 not-found">
        <h1>Seite nicht gefunden</h1>
        <p>Die angeforderte Seite konnte leider nicht gefunden werden.</p>

        <ul>
          <li><a href="<?php echo esc_url(home_url()); ?>">Zur Startseite</a></li>
          <li><a href="<?php echo esc_url(home_url('/blog')); ?>">Zu den aktuellen Beiträgen</a></li>
        </ul>

        <p>Oder versuch’s mit einer Suche:</p>

        <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
          <label for="s">Suchbegriff:</label>
          <input type="search" id="s" name="s" value="<?php echo esc_attr(get_search_query()); ?>" />
          <button type="submit">Suchen</button>
        </form>
      </section>

    </div>
  </main>

  <?php include_once 'template-parts/sidebar.php'; ?>
</div>

<?php include_once 'template-parts/footer.php'; ?>