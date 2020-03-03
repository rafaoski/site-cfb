<?php namespace ProcessWire;

/**
 * Site Head
 *
 */

$favicon = setting('favicon');
$metaTitle = setting('metaTitle');
$metaDescription = setting('metaDescription');
?>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php if($favicon) echo "<link rel='icon' href='$favicon->url'/>\n"; ?>
<?php
	if (setting('noindex') || input()->pageNum > 1): // https://processwire.com/blog/posts/processwire-2.6.18-updates-pagination-and-seo/
?>
	<meta name='robots' content='noindex,follow'>
<?php endif;
	// https://weekly.pw/issue/222/
	if (config()->pagerHeadTags) {
		echo "\t" . config()->pagerHeadTags . "\n";
	}
?>
	<title id='html-title'><?= $metaTitle ?></title>
<?php
	if ($metaDescription):
?>
	<meta name="description" content="<?= $metaDescription ?>"/>
<?php endif ?>

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

<!-- Fonts https://fonts.google.com/?selection.family=Roboto|Syncopate&query=roboto -->
	<link href="https://fonts.googleapis.com/css?family=Nunito+Sans|Roboto&display=swap" rel="stylesheet">

<!-- CUSTOM CSS -->
	<style>
	/* Add a smooth scrolling effect to the document: */
		html {
			scroll-behavior: smooth;
		}
	/* fade-in effect on page load */
		body {
			animation: fadeInAnimation ease 1s;
			animation-iteration-count: 1;
			animation-fill-mode: forwards;
		}
		@keyframes fadeInAnimation {
			0% {
				opacity: 0;
			}
			100% {
				opacity: 1;
			}
		}
	/* Headroom header Effect */
		.headroom {
			will-change: transform;
			transition: transform 200ms linear;
		}
		.headroom--pinned {
			transform: translateY(0%);
			background: var(--color-contrast-lower);
		}
		.headroom--unpinned {
			transform: translateY(-100%);
		}
		.headroom--top {
			background: transparent;
		}
	/* Dark / Light Icon Switcher  */
		.mode svg {
			transition: all .3s ease;
		}
		.mode svg:hover {
			fill: var(--color-contrast-higher);
			stroke-width: 2;
		}
		#sun {
			display: none;
		}
		[data-theme="dark"]  #sun {
			display: inline;
		}
		[data-theme="dark"] #moon {
			display: none;
		}
	</style>
