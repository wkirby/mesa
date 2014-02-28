<?php include('header.php'); ?>
	
	<div class="container">
		<?php if ( $page ) : ?>
			<?php _e($page->title, '<h1>%s</h1>'); ?>
			<?php echo $page->content; ?>
		<?php else : ?>
			Sorry bro.
		<?php endif; ?>
	</div>

<?php include('footer.php'); ?>