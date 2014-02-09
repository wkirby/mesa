<?php include('header.php'); ?>
	
	<div class="container">
		<?php if ($query->is_single) : ?>
			<div class="alert alert-info alert-dismissable">
			  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<p>Just a heads up, this page is single.</p>
			</div>
		<?php endif; ?>

		<?php if (count($query->pages) > 0) : ?>
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