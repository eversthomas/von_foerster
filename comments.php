<?php
/**
 * Datei: comments.php
 * Zweck: Ausgabe des Kommentarbereichs inkl. Formular und Navigation
 * Wird eingebunden in: single.php
 * @package von_foerster
 */
if (!defined('ABSPATH')) exit;

if (post_password_required()) {
  return;
}
?>

<section id="comments" class="comments-section" aria-labelledby="comments-title">

  <?php if (have_comments()) : ?>
    <h2 id="comments-title">
      <?php
      $comments_number = get_comments_number();
      echo $comments_number === 1
        ? esc_html__('Ein Kommentar', 'von_foerster')
        : esc_html($comments_number . ' Kommentare');
      ?>
    </h2>

    <ol class="comment-list">
      <?php
      wp_list_comments([
        'style'    => 'ol',
        'callback' => 'von_foerster_comment',
      ]);
      ?>
    </ol>

    <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
      <nav class="comment-navigation" aria-label="Kommentarseiten">
        <?php paginate_comments_links([
          'prev_text' => '← Ältere',
          'next_text' => 'Neuere →',
        ]); ?>
      </nav>
    <?php endif; ?>

  <?php else : ?>
    <p class="no-comments">Noch keine Kommentare.</p>
  <?php endif; ?>

  <?php
comment_form([
  'title_reply'          => 'Kommentar schreiben',
  'label_submit'         => 'Absenden',
  'class_form'           => 'comment-form',
  'class_submit'         => 'submit-button',
  'comment_notes_before' => '',
  'comment_notes_after'  => '',
  'fields'               => [
    'author' => '
      <p class="comment-form-author">
        <label for="author">Name* <span class="sr-only">(Pflichtfeld)</span></label>
        <input id="author" name="author" type="text" required aria-required="true" aria-describedby="author-desc" />
        <small id="author-desc">Dein Name wird öffentlich angezeigt.</small>
      </p>',
    'email' => '
      <p class="comment-form-email">
        <label for="email">E-Mail* <span class="sr-only">(Pflichtfeld)</span></label>
        <input id="email" name="email" type="email" required aria-required="true" aria-describedby="email-desc" />
        <small id="email-desc">Wird nicht veröffentlicht.</small>
      </p>',
  ],
  'comment_field' => '
    <p class="comment-form-comment">
      <label for="comment">Kommentar*</label>
      <textarea id="comment" name="comment" rows="5" required aria-required="true"></textarea>
    </p>',
]);
?>

</section>