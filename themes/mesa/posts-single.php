<?php include('header.php'); ?>
	
	<div class="container">
		<?php if ($query->hasPages()) : ?>
			<?php foreach ($query->pages as $post) : ?>
				<?php $post->setup(); ?>
				<h1><a href="<?php echo $post->permalink; ?>"><?php echo $post->title; ?></a></h1>

				<?php _e($post->author, '<h4>%s</h4>'); ?>
				<?php _e($post->date, '<h5>%s</h5>'); ?>

				<?php echo $post->content; ?>
			<?php endforeach; ?>
		<?php else : ?>
			Sorry bro.
		<?php endif; ?>
	</div>

<?php include('footer.php'); ?>