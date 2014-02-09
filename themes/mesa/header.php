<!DOCTYPE html>
<html>
<head>
	<title><?php echo $config->get('sitename'); ?></title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
	<style type="text/css">
		body {
			padding: 70px;
		}
	</style>
</head>
<body>
	
	<nav class="navbar navbar-fixed-top navbar-default" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo SITEURL; ?>">Mesa</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="/?type=posts">Post Archive</a></li>
					<li><a href="/?type=pages">Pages Archive</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container">
		<div class="alert alert-warning alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<?php echo $mesa->template; ?>
		</div>
	</div>