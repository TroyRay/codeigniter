<?php
$site_link = site_url();
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>
		<?php
		if ( $this->uri->total_segments() === 0 )
			echo $this->lang->line('gen_ci_demo');
		else
			echo $title . ' - ' . $this->lang->line('gen_ci_demo');
		?>
	</title>
	<link rel="stylesheet"  href="<?php echo $site_link ?>css/style.css" type="text/css" media="all" />
</head>
<body>
<div id="wrapper">
	<header id="header" role="banner">
		<h1><?php echo $this->lang->line('gen_ci_demo') ?></h1>
		<nav id="navigation" role="navigation">
			<ul>
				<li><a href="<?php echo $site_link ?>" title="<?php echo ucfirst($this->lang->line('gen_home')) ?>"><?php echo ucfirst($this->lang->line('gen_home')) ?></a></li>
				<li><a href="<?php echo $site_link . 'about/' ?>" title="<?php echo ucfirst($this->lang->line('gen_about')) ?>"><?php echo ucfirst($this->lang->line('gen_about')) ?></a></li>
				<li><a href="<?php echo $site_link . 'posts/' ?>" title="<?php echo ucfirst($this->lang->line('gen_posts')) ?>"><?php echo ucfirst($this->lang->line('gen_posts')) ?></a></li>
				<li><a href="<?php echo $site_link . 'posts/submit/' ?>" title="<?php echo $this->lang->line('gen_post_asubmit') ?>"><?php echo $this->lang->line('gen_post_asubmit') ?></a></li>
			</ul>
		</nav>
	</header>
	<div id="main">