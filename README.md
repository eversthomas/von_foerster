# von_foerster

**Ein minimalistisches Blank‑WordPress‑Theme**  
Sauberer, semantischer Code ohne unnötigen Ballast.

---

## 📦 Theme‑Daten

- **Version:** 1.0.0  
- **Autor:** Thomas Evers  
- **Theme URI:** https://tevers.de/  
- **License:** MIT (https://opensource.org/licenses/MIT)  
- **Text Domain:** von_foerster  
- **Tags:** clean, minimal, semantic, custom‑head, no‑bloat, no‑gutenberg  

---

## ✨ Beschreibung

„von_foerster“ ist ein minimalistisches Blank‑Theme für WordPress.  
Es liefert eine semantisch saubere HTML‑Grundstruktur ohne Standard‑WordPress‑Klassen, Hooks oder Automatismen.  
Alle Styles werden in SCSS organisiert und mit dem Plugin **wp‑scss** kompiliert.

---

## 🚀 Features

- **Sauberes Markup**  
  – Eigene Template‑Parts in `template-parts/` (head, header, navigation, sidebar, footer)  
- **Responsive Styles**  
  – SCSS‑Ordnerstruktur in `scss/`  
  – Kompiliert zu `main.css`  
- **Template‑Dateien**  
  – `index.php`, `single.php`, `page.php`, `archive.php`, `search.php`, `404.php`  
  – Spezielles Galerie‑Template: `template-galerie.php`  
- **Theme‑Support & Widgets**  
  – Beitragsbilder (`post-thumbnails`)  
  – Menüs und Sidebars via `inc/_setup.php`  
  – Customizer‑Einstellungen (Favicon, Logo, Header) in `inc/_customizer.php`  
  – Eigene Widgets (Kategorien, Medien‑Galerie) in `inc/_widgets.php` & `inc/_media-gallery.php`  
  – Custom Kommentare (`inc/_comments.php`)  
  – Hilfsfunktionen: ALT‑Text, Breadcrumb, Related Posts (`inc/_helpers.php`)  
  – Automatische Sitemap unter `/sitemap.xml` (`inc/_sitemap.php`)  

---

## ⚙️ Installation

1. In dein WordPress‑Verzeichnis kopieren:  

2. **Plugin installieren:**  
– **wp-scss** (kompiliert SCSS zu CSS)  
3. Theme im WordPress‑Backend aktivieren.  
4. (Optional) Customizer nutzen: Favicon, Logo, Header anpassen.

> **Hinweis:** Es werden **keine** Node‑Tools (npm, Gulp, Grunt o. Ä.) verwendet!

---

## 🛠 SCSS‑Struktur

- **scss/main.scss** – Einstiegspunkt  
- **partials:**  
- `_reset.scss`  
- `_base.scss`  
- `_layout.scss`  
- `_typo.scss`  
- `_helper.scss`  
- `_components.scss`  
- `_navi.scss`  

---

## 📱 PWA‑Manifest

Datei: `manifest.json`  
- Standalone‑Anzeige  
- Hintergrund: Weiß  
- Theme‑Farbe: Schwarz  
- Icons: `apple-touch-icon.png`  

---

## 📄 Lizenz

Dieses Theme steht unter der **MIT License**.  
Siehe [LICENSE](LICENSE) für Details.  

