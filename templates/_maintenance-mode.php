<?php namespace ProcessWire;

/**
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/HTTP/Status/503
 * @link https://yoast.com/http-503-site-maintenance-seo/
 *
 */
$home = setting('home');
$logo = setting('logo');
$favicon = setting('favicon');
$siteName = setting('siteName');
$options = setting('options');
if( page()->template != 'home' ) {
	session()->redirect( $home->url ); // Show only this page
}

$protocol = 'HTTP/1.0';

if ( $_SERVER['SERVER_PROTOCOL'] === 'HTTP/1.1' ) {
	$protocol = 'HTTP/1.1';
}

header( $protocol . ' 503 Service Unavailable', true, 503 );
header( 'Retry-After: 3600' );
?><!DOCTYPE html>
<html id='html' lang='<?= setting('lang') ?>' class='<?= setting('htmlClasses')->implode(' ') ?>'>
<head id='html-head'>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= setting('maintenance-mode') ?></title>
<?php if($favicon) echo "<link rel='icon' href='$favicon->url'/>\n"; ?>

<!-- Codyframe  https://codyhouse.co/ds/docs/framework -->
<script>document.getElementsByTagName("html")[0].className += " js";</script>
<script>
	if('CSS' in window && CSS.supports('color', 'var(--color-var)')) {
	document.write('<link rel="stylesheet" href="<?= urls('templates') ?>assets/css/style.css">');
	} else {
	document.write('<link rel="stylesheet" href="<?= urls('templates') ?>assets/css/style-fallback.css">');
	}
</script>
<noscript>
	<link rel="stylesheet" href="<?= urls('templates') ?>assets/css/style-fallback.css">
</noscript>

<!-- FONTS -->
<link href="https://fonts.googleapis.com/css?family=Nunito+Sans|Roboto&display=swap" rel="stylesheet">
</head>
<body id='html-body'>

<!-- HEADER -->
	<header id='header' class='text-center padding-xs'>
		<?php if($logo) echo "<img width='160' src='$logo->url' alt='$logo->description'>"; ?>
		<p class='site-name'><?= $siteName ?></p>
	</header>

<!-- MAIN -->
	<main id='main' class='padding-y-md'>
		<div class="container max-width-lg text-component padding-top-lg">
			<div class='text-center'>
				<h1 class='text-xxxl text-bold'><?= setting('maintenance-mode') ?></h1>
				<h2><?= setting('site-disabled') ?></h2>
			</div>
			<div id="body" class='margin-top-md'>
				<?= $options->body // Maintenance Info ?>
			</div>
		</div>
	</main>

<!-- FOOTER -->
	<footer id='footer' class='padding-y-lg bg-contrast-lower'>
		<div class="container max-width-lg">
			<div class="social-profiles margin-bottom-md">
				<ul class='flex flex-gap-sm flex-center flex-wrap'>
					<?php 	// Social Profiles
						files()->include('parts/_social-profiles');
					?>
				</ul>

				<h3 class='margin-top-xxs text-sm text-center text-underline'>
					<?= setting('we-sociable') ?>
				</h3>
			</div>

			<div class='flex flex-wrap justify-between flex-gap-sm color-contrast-medium'>
				<p class='copyright text-sm'>
					&copy;<?= date('Y') ?> &bull; <a class='color-contrast-medium' href='<?= $home->url ?>'><?= $siteName ?></a> &bull;
					<a
						class='text-uppercase color-contrast-medium'
						href='<?= setting('poweredUrl') ?>'
						target='_blank'
						rel='noreferrer noopener'
					>
						<?= setting('powered') ?>
					</a>
				</p>
			</div>
		</div>
	</footer>
	<!-- Feather icons https://github.com/feathericons/feather -->
	<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
	<script>
		feather.replace()
	</script>
</body>
</html>
