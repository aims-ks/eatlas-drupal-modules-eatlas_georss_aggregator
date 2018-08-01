<?php
/**
 * Original file: www/modules/node/node.tpl.php
 */
$logged = user_is_logged_in();
$edit_link = $node_url . '/edit';

$rss_link_field = field_get_items('node', $node, 'field_ea_rss_link');
if ($rss_link_field) {
	$rss_link_output = field_view_value('node', $node, 'field_ea_rss_link', $rss_link_field[0]);

	// Adjust the link on the title
	$node_url = render($rss_link_output);

	// Adjust the "Read more" link
	if (isset($content['links']['node']['#links']['node-readmore']['href'])) {
		$content['links']['node']['#links']['node-readmore']['href'] = $node_url;
	}
}

// This info do not make sense since the nodes
// are automatically created by the cron (admin)...
//     Submitted by admin on Sat, 19/04/2014 - 16:27
$display_submitted = FALSE;
?>
<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

	<?php print $user_picture; ?>

	<?php print render($title_prefix); ?>
	<?php if (!$page): ?>
		<h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a>
			<?php if ($logged && $edit_link): ?>
				<span class="edit-link"><a href="<?php print $edit_link; ?>">[edit]</a></span>
			<?php endif; ?>
		</h2>
	<?php endif; ?>
	<?php print render($title_suffix); ?>

	<?php if ($display_submitted): ?>
		<div class="submitted">
			<?php print $submitted; ?>
		</div>
	<?php endif; ?>

	<div class="content"<?php print $content_attributes; ?>>
		<?php
			// We hide the comments and links now so that we can render them later.
			hide($content['comments']);
			hide($content['links']);
			print render($content);
		?>
	</div>

	<?php print render($content['links']); ?>

	<?php print render($content['comments']); ?>

</div>
