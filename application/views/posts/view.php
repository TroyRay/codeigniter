<article class="post">
	<?php
	echo '<h1 class="title">' . $post_item['title'] . '</h1>';
	echo '<div class="content">';
	if ( ! $post_item['image'] == "")
		echo '<div class="post-image-wrap"><img src="' . $post_item['image'] . '" alt="' . $post_item['title'] . '" class="post-image" /></div>';
	echo $post_item['text'] . '</div>';
	?>
</article>