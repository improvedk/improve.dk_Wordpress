<? function improve_comment($comment, $args, $depth) { $GLOBALS['comment'] = $comment; ?>
	<li <? if ($comment->comment_author_email == 'mark@improve.dk') : ?>class="mark"<? endif ?>>
		<a name="comment-<? comment_id() ?>"></a>
		<div class="author">
			<span class="name"><? comment_author_link() ?></span>
			<span class="date" title="<? comment_date('Y-m-d') ?> <? comment_time() ?>"><? comment_date('F j, Y') ?></span>	
			<? edit_comment_link('Edit', '<div class="edit">', '</div>'); ?>
		</div>
		<div class="comment">
			<? comment_text() ?>
		</div>
	</li>
<? } ?>

<div id="comments">
	<div class="commenttitle">Comments</div>
	<? if (have_comments()) : ?>
		<ul>
			<? wp_list_comments(array('callback' => 'improve_comment')); ?>
		</ul>
	<? endif ?>
	<?
		$commenter = wp_get_current_commenter();
			
		comment_form(array(
			'comment_notes_after' => '',
			'comment_notes_before' => '',
			'title_reply' => 'Leave a Comment',
			'fields' => array(
				'author' => '<p class="comment-form-author"><label for="author">Name</label><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30" aria-required="true" data-required="true" /></p>',
				'email' => '<p class="comment-form-email"><label for="email">Email</label><input id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" aria-required="true" data-required="true" data-type="email" /></p>',
				'url' => '<p class="comment-form-url"><label for="url">Website</label><input id="url" name="url" type="text" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" data-type="url" /></p>'
			),
			'comment_field' => '<p class="comment-form-comment"><label for="comment">Comment</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" data-required="true"></textarea></p>'
		));
	?>
</div>

<script>
	$(function() {
		$("form").parsley();
	});
</script>