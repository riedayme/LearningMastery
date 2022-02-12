<div class="post-tags">
	<?php
	if ($post['tags']) {
		foreach ($post['tags'] as $tag) {
			echo "<a title='" . $tag['name'] . "' href='" . $tag['url'] . "'>" . $tag['name'] . "</a>";
		}
	}
	?>
</div>