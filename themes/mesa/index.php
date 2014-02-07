<!DOCTYPE html>
<html>
<head>
	<title><?php echo $conf->get('sitename'); ?></title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
	<style type="text/css">
		body {
			padding: 20px;
		}
	</style>
</head>
<body>
	<div class="container">
		<nav class="navbar navbar-default" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="<?php echo $conf->get('url'); ?>">Mesa</a>
				</div>

				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li><a href="/?type=posts">Post Archive</a></li>
						<li><a href="/?type=pages">Pages Archive</a></li>
					</ul>
				</div>
			</div>
		</nav>

		<?php if ($mesa->is_single) : ?>
			<div class="alert alert-info alert-dismissable">
			  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<p>Just a heads up, this page is single.</p>
			</div>
		<?php endif; ?>
		
		<?php if (count($mesa->pages) > 0) : ?>
			<?php foreach ($mesa->pages as $post) : ?>
				<?php $post->setup(); ?>
				<h1><a href="<?php echo $post->permalink; ?>"><?php echo $post->title; ?></a></h1>
				<?php echo $post->content; ?>
				<hr/>
			<?php endforeach; ?>
		<?php else : ?>
			Sorry bro.
		<?php endif; ?>
	</div>

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://code.jquery.com/jquery.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
</body>
</html>