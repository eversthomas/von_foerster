<button class="menu-toggle" aria-controls="main-menu" aria-expanded="false">
      ☰ Menü
    </button>

    <nav id="main-menu" class="nav is-collapsed" aria-label="Hauptnavigation">
      <?php
        wp_nav_menu([
          'theme_location' => 'main_menu',
          'container'      => false,
          'menu_class'     => 'nav-list',
          'fallback_cb'    => false,
        ]);
      ?>
    </nav>