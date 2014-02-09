<?php include('header.php'); ?>
	
	<div class="container">
		<?php if ($query->hasPages()) : ?>
			<?php foreach ($query->pages as $post) : ?>
				<?php $post->setup(); ?>
				<h1><a href="<?php echo $post->permalink; ?>"><?php echo $post->title; ?></a></h1>
				<?php echo $post->content; ?>
				<hr/>
			<?php endforeach; ?>
		<?php else : ?>
			Sorry bro.
		<?php endif; ?>
	</div>

<?php include('footer.php'); ?>