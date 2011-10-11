<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?php echo $head_title; ?></title>
		<?php if (isset($head_canonical)): ?><link rel="canonical" href="<?php echo $head_canonical; ?>"><?php endif; ?>
		<link rel="stylesheet" href="<?php echo base_url('public/css/application.css'); ?>">
	</head>
	<body>
		<div id="wrapper">
			<div id="wrapper2">
				<div id="top-menu">
					<div id="account">
						<ul>
							<li><a href="<?php echo base_url('login'); ?>" class="login">Sign in</a></li>
							<li><a href="<?php echo base_url('account/register'); ?>" class="register">Register</a></li>
						</ul>
					</div>
					<ul>
						<li><a href="<?php echo base_url(); ?>" class="login">Home</a></li>
						<li><a href="<?php echo base_url('projects'); ?>" class="login">Projects</a></li>
					</ul>
				</div>
				<div id="header">
					<div id="quick-search">
						<form action="<?php echo base_url('search'); ?>">
							<a href="<?php echo base_url('search'); ?>">Search</a>:
							<input class="small" id="q" name="q" size="20">
						</form>
					</div>
					<h1>Redmine-CI</h1>
				</div>
				<div class="nosidebar" id="main">
					<div id="sidebar"></div>
					<div id="content">
						<?php echo $content; ?>
					</div>
				</div>
				<div id="footer">Powered by <a href="">Redmine-CI</a></div>
			</div>
		</div>
	</body>
</html>