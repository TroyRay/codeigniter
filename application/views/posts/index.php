<?php if ($posts == array()) :?>
	<article class="post">
		<h2 class="title">
			<?php echo $this->lang->line('gen_no_posts') ?>
		</h2>
		<div class="content">
			There are no posts yet. You can <a href="<?php echo site_url() . 'posts/submit/' ?>" title="<?php echo $this->lang->line('gen_post_asubmit') ?>"><?php echo $this->lang->line('gen_post_asubmit') ?></a> to the database with a title, text, and image.
		</div>
	</article>
<?php else: ?>
<?php foreach ($posts as $post_item) : ?>
	<article class="post">
		<h2 class="title">
			<a href="<?php echo site_url() ?>posts/<?php echo $post_item['slug'] ?>"><?php echo $post_item['title'] ?></a>
		</h2>
		<div class="content">
			<?php if ( ! $post_item['image'] == "") : ?>
				<img src="<?php echo $post_item['image'] ?>" alt="<?php echo $post_item['title'] ?>" class="post-thumb" />
			<?php endif; ?>
			<?php echo $post_item['text'] ?>
			<div class="clear"></div>
		</div>
	</article>
<?php endforeach ?>
<?php endif; ?>