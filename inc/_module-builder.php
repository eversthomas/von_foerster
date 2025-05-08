<?php
/*
Plugin Name: Modul Builder
Description: Modularer Inhalts-Builder mit benutzerdefinierten Feldern.
Version: 1.0
Author: Dein Name
*/

// 1. CPT 'modul' registrieren + eigene Taxonomie
add_action('init', function() {
    register_post_type('modul', [
        'labels' => [
            'name' => 'Module',
            'singular_name' => 'Modul',
        ],
        'public' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-screenoptions',
        'supports' => ['title', 'editor', 'thumbnail'],
        'taxonomies' => ['modulkategorie'],
    ]);

    register_taxonomy('modulkategorie', 'modul', [
        'label' => 'Modul-Kategorien',
        'public' => true,
        'hierarchical' => true,
        'rewrite' => ['slug' => 'modul-kategorie'],
        'show_admin_column' => true,
    ]);
});

// 2. Modultyp-Feld + dynamische Felder als Metabox
add_action('add_meta_boxes', function() {
    add_meta_box('modul_felder', 'Modul-Felder', 'modul_felder_callback', 'modul');
});

function modul_felder_callback($post) {
    $typ = get_post_meta($post->ID, '_modul_typ', true);
    $link = get_post_meta($post->ID, '_modul_link', true);
    $linktext = get_post_meta($post->ID, '_modul_linktext', true);
    $farbe = get_post_meta($post->ID, '_modul_farbe', true);
    $bild_id = get_post_meta($post->ID, '_modul_bild_id', true);
    $bild_url = $bild_id ? wp_get_attachment_url($bild_id) : '';
    ?>
    <p>
        <label>Modultyp:
            <select name="modul_typ" id="modul_typ">
                <option value="card" <?php selected($typ, 'card'); ?>>Card</option>
                <option value="text" <?php selected($typ, 'text'); ?>>Text</option>
                <option value="bild" <?php selected($typ, 'bild'); ?>>Bild</option>
            </select>
        </label>
    </p>
    <div id="felder_card" class="modul-feldgruppe">
        <p>
            <label>Link: <input type="text" name="modul_link" value="<?php echo esc_attr($link); ?>"></label>
        </p>
        <p>
            <label>Linktext: <input type="text" name="modul_linktext" value="<?php echo esc_attr($linktext); ?>"></label>
        </p>
        <p>
            <label>Farbe: <input type="text" name="modul_farbe" value="<?php echo esc_attr($farbe); ?>"></label>
        </p>
        <p>
            <label>Bild: <input type="hidden" name="modul_bild_id" id="modul_bild_id" value="<?php echo esc_attr($bild_id); ?>">
                <button type="button" class="button" id="bild_auswaehlen">Bild auswählen</button>
            </label><br>
            <img id="bild_vorschau" src="<?php echo esc_url($bild_url); ?>" style="max-width:200px; margin-top:10px; display:block;">
        </p>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const typSelect = document.getElementById('modul_typ');
            const feldgruppen = document.querySelectorAll('.modul-feldgruppe');

            function toggleFelder() {
                feldgruppen.forEach(f => f.style.display = 'none');
                const selected = typSelect.value;
                const feld = document.getElementById('felder_' + selected);
                if(feld) feld.style.display = 'block';
            }

            typSelect.addEventListener('change', toggleFelder);
            toggleFelder();

            const frame = wp.media({ title: 'Bild auswählen', multiple: false });
            const button = document.getElementById('bild_auswaehlen');
            const feld = document.getElementById('modul_bild_id');
            const vorschau = document.getElementById('bild_vorschau');

            button.addEventListener('click', function(e) {
                e.preventDefault();
                frame.open();
                frame.on('select', function() {
                    const attachment = frame.state().get('selection').first().toJSON();
                    feld.value = attachment.id;
                    vorschau.src = attachment.url;
                });
            });
        });
    </script>
    <?php
}

// 3. Metadaten speichern
add_action('save_post_modul', function($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    if (isset($_POST['modul_typ'])) update_post_meta($post_id, '_modul_typ', sanitize_text_field($_POST['modul_typ']));
    if (isset($_POST['modul_link'])) update_post_meta($post_id, '_modul_link', esc_url_raw($_POST['modul_link']));
    if (isset($_POST['modul_linktext'])) update_post_meta($post_id, '_modul_linktext', sanitize_text_field($_POST['modul_linktext']));
    if (isset($_POST['modul_farbe'])) update_post_meta($post_id, '_modul_farbe', sanitize_text_field($_POST['modul_farbe']));
    if (isset($_POST['modul_bild_id'])) update_post_meta($post_id, '_modul_bild_id', intval($_POST['modul_bild_id']));
});

// 4. Ausgabe-Funktion im Frontend mit optionalem Kategorie-Filter
function zeige_module($args = []) {
    $defaults = [
        'post_type' => 'modul',
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC',
    ];

    $query = new WP_Query(wp_parse_args($args, $defaults));

    if ($query->have_posts()) {
        echo '<div class="modul-container">';
        while ($query->have_posts()) {
            $query->the_post();
            $typ = get_post_meta(get_the_ID(), '_modul_typ', true);
            $link = get_post_meta(get_the_ID(), '_modul_link', true);
            $linktext = get_post_meta(get_the_ID(), '_modul_linktext', true);
            $farbe = get_post_meta(get_the_ID(), '_modul_farbe', true);
            $bild_id = get_post_meta(get_the_ID(), '_modul_bild_id', true);
            $bild_url = $bild_id ? wp_get_attachment_url($bild_id) : '';

            echo '<div class="modul modul-' . esc_attr($typ) . '" style="background-color:' . esc_attr($farbe) . '">';
            if ($bild_url) echo '<img src="' . esc_url($bild_url) . '" alt="">';
            echo '<h3>' . get_the_title() . '</h3>';
            echo '<div>' . get_the_content() . '</div>';
            if ($link) echo '<p><a href="' . esc_url($link) . '">' . esc_html($linktext ?: 'Mehr erfahren') . '</a></p>';
            echo '</div>';
        }
        echo '</div>';
        wp_reset_postdata();
    }
}

// 5. Shortcode zur Modul-Ausgabe mit Kategorieangabe
add_shortcode('module', function($atts) {
    $atts = shortcode_atts([
        'kategorie' => ''
    ], $atts, 'module');

    $args = [];
    if (!empty($atts['kategorie'])) {
        $args['tax_query'] = [
            [
                'taxonomy' => 'modulkategorie',
                'field' => 'slug',
                'terms' => sanitize_title($atts['kategorie']),
            ]
        ];
    }

    ob_start();
    zeige_module($args);
    return ob_get_clean();
});

/* usecase
  <div class="module">
    	<?php
        	zeige_module([
              'tax_query' => [
                [
                  'taxonomy' => 'modulkategorie',
                  'field'    => 'slug',
                  'terms'    => 'startseite',
                ],
              ]
            ]);
        ?>
    </div>

    or with shortcode: [module kategorie="startseite"]
*/
