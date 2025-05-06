# von_foerster

Ein minimalistisches, semantisch sauberes WordPress-Theme, das WordPress wie ein CMF nutzt – ohne Standardklassen, ohne Gutenberg, ohne Automatismen.

## ✨ Philosophie

**„von_foerster“** ist ein Theme für Entwickler*innen, die volle Kontrolle über ihren Code wollen – strukturiert, verständlich und auf das Wesentliche reduziert. Es verzichtet konsequent auf alle WordPress-Automatismen, um das Frontend so zu rendern, wie du es wirklich brauchst.

- Kein `wp_head`, kein `body_class`, kein `wp_footer`
- Kein Gutenberg – der Classic Editor wird vorausgesetzt
- Keine unnötigen Klassen oder Hooks im HTML
- SCSS-basiertes Styling, aber **kein Build-Tool notwendig**
- SEO, Barrierefreiheit und saubere Semantik im Fokus
- Ideal als Basis für eigene, individuelle CMS-ähnliche Projekte

---

## 📦 Theme-Struktur

```text
von_foerster/
├── style.css             ← Theme-Metadaten und SCSS-Kompendium
├── main.css              ← Automatisch kompiliertes CSS via wp-scss
├── functions.php         ← Strukturierte Funktionssammlung
├── inc/
│   ├── head.php          ← HTML-Head inklusive SEO-Metadaten und OG-Tags
│   ├── header.php        ← Header mit Logo, Navigation, Suche, Breadcrumb
│   ├── sidebar.php       ← Drei konfigurierbare Widgetbereiche
│   ├── footer.php        ← Footer mit Lizenzhinweis
├── templates/
│   ├── index.php         ← Blogübersicht
│   ├── single.php        ← Einzelbeitrag mit Kommentaren & Related Posts
│   ├── page.php          ← Seitenansicht
│   ├── archive.php       ← Kategorie-, Tag- und Autorenansicht
│   ├── search.php        ← Suchergebnisse
│   ├── 404.php           ← Fehlerseite
│   └── template-galerie.php ← Spezialtemplate für Bildergalerien
├── scripts/
│   └── navigation.js     ← Navigationstoggle
├── fonts/                ← Optional: Lokale Webfonts (z. B. Nunito Sans)
└── scss/                 ← SCSS-Struktur für individuelles Styling
