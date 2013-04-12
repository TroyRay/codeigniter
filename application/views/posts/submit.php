<article class="post">
	<h2 class="title"><?php echo $this->lang->line('gen_post_submit') ?></h2>
	<div class="content">
		<?php echo form_open_multipart('posts/submit') ?>
			<label for="title"><?php echo $this->lang->line('gen_title_label') ?></label>
			<br />
			<input type="input" name="title" value="<?php echo set_value('title'); ?>" />
			<?php echo form_error('title') ?>
			<br />
			<br />
			<label for="text"><?php echo $this->lang->line('gen_text_label') ?></label>
			<br />
			<textarea name="text"><?php echo set_value('text'); ?></textarea>
			<?php echo form_error('text') ?>
			<br />
			<br />
			<label for="userfile"><?php echo $this->lang->line('gen_image_label') ?></label>
			<br />
			<input type="file" name="userfile" size="20" />
			<?php
				// If there is an upload error, and one of the other inputs registered an error (or else this error will show just from loading the form) show the upload error.
				if (isset($upload_error['error'])) {
					if (form_error('title') || form_error('text'))
					{
						echo '<div class="error">' . $upload_error['error'] . '</div>';
					}
				}
			?>
			<br />
			<br />
			<input type="submit" name="submit" value="<?php echo $this->lang->line('gen_post_submit') ?>" /> 
		</form>
	</div>
</article>