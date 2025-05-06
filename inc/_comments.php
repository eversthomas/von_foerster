<?php
/**
 * Datei: _comments.php
 * Zweck: Eigene Kommentardarstellung (Callback-Funktion)
 * Wird von functions.php eingebunden
 * @package von_foerster
 */

if (!defined('ABSPATH')) exit;

/**
 * Callback für wp_list_comments() – strukturiert, barrierefrei & semantisch
 *
 * @param WP_Comment $comment
 * @param array $args
 * @param int $depth
 *
 * Anwendung im Template:
 * wp_list_comments([
 *   'style'    => 'ol',
 *   'callback' => 'von_foerster_comment',
 * ]);
 */
function von_foerster_comment($comment, $args, $depth) {
  $tag         = 'li';
  $author      = get_comment_author_link();
  $datetime    = get_comment_time('c');
  $date        = get_comment_date();
  $time        = get_comment_time();
  $comment_id  = get_comment_ID();
  $is_approved = $comment->comment_approved == '0';

  ?>
  <<?php echo $tag; ?> id="comment-<?php echo esc_attr($comment_id); ?>" <?php comment_class('comment'); ?>>

    <article class="comment-body" role="article" aria-label="Kommentar von <?php echo esc_attr(strip_tags($author)); ?>">

      <header class="comment-meta">
        <p class="comment-author"><?php echo $author; ?></p>
        <time datetime="<?php echo esc_attr($datetime); ?>" class="comment-date">
          <?php echo esc_html($date . ' um ' . $time); ?>
        </time>
      </header>

      <div class="comment-content">
        <?php if ($is_approved) : ?>
          <em><?php _e('Dein Kommentar wartet auf Moderation.', 'von_foerster'); ?></em>
        <?php endif; ?>

        <?php comment_text(); ?>
      </div>

      <div class="comment-reply">
        <?php
        comment_reply_link(array_merge($args, [
          'depth'     => $depth,
          'max_depth' => $args['max_depth'],
          'reply_text' => __('Antworten', 'von_foerster'),
        ]));
        ?>
      </div>

    </article>

  </<?php echo $tag; ?>>
  <?php
}