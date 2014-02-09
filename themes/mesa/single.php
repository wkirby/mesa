<?php include('header.php'); ?>
	
	<div class="container">
		<div class="alert alert-info alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<p>I AM <?php echo pathinfo($mesa->template, PATHINFO_BASENAME); ?></p>
		</div>
		
		<?php if (count($query->pages) > 0) : ?>
			<?php foreach ($query->pages as $post) : ?>
				<?php $post->setup(); ?>
				<h1><a href="<?php echo $post->permalink; ?>"><?php echo $post->title; ?></a></h1>
				<?php if ($post->author) : ?>
					<h4>By <?php echo $post->author; ?></h4>
				<?php endif; ?>
				<?php echo $post->content; ?>
				<hr/>
			<?php endforeach; ?>
		<?php else : ?>
			Sorry bro.
		<?php endif; ?>
	</div>

<?php include('footer.php'); ?>