<?php namespace ProcessWire;

/* _main.php template file, called after a page’s template file */
?><!DOCTYPE html>
<html id='html' lang='<?= setting('lang') ?>' class='<?= setting('htmlClasses')->implode(' ') ?>'>
<head id='html-head'>
<?php
// Basic seo, scripts, css files
	files()->include('parts/_head');
// Handle output of 'hreflang' link tags for multi-language
	files()->include('parts/_hreflang');
?>
</head>
<body id='html-body'>

<!-- HEADER -->
<header id='header' class='nav-wrapper position-fixed'>
	<nav class="nav">
		<?php files()->include('parts/_simply-nav') ?>
	</nav>
</header>

<!-- MAIN -->
<main id='main'<?= mainBg(page()->images->first, $class = "bg-image") ?>>

	<div id='main-header' class='container max-width-lg padding-top-xxl padding-top-xl@md'>
		<?= page()->render('title') // inside fields folder ( https://processwire.com/api/ref/page/render-field/ ) ?>
		<?= breadcrumb(page()) ?>
	</div>

	<div id='main-content' class='container max-width-lg padding-y-md'>
		<div class="grid grid-gap-md">
			<div id="main-body" class='col text-component'>
				<?= page()->body ?>
			</div>
			<div id="main-sidebar" class='col-3@md text-component' pw-optional></div>
		</div>
	</div>

</main>

<!-- FOOTER -->
<footer id='footer' class='bg-contrast-lower'>
	<div class="container padding-y-lg max-width-xxxl">

		<div id='search-form' class="search-form flex flex-center">
			<?php files()->include('parts/_search-form') ?>
		</div>

		<?php // Bottom Panel
			if(setting('bottomPanel')->count())
				files()->include('parts/_bottom-panel')
		?>

		<div class="social-profiles margin-y-md">
			<ul class='flex flex-gap-xxs flex-center flex-wrap'>
				<?php 	// Social Profiles
					files()->include('parts/_social-profiles');
				?>
			</ul>

			<h3 class='margin-top-xs text-sm text-center text-underline'>
				<?= setting('we-sociable') ?>
			</h3>
		</div>

		<div class="flex flex-wrap justify-between flex-gap-sm text-uppercase">
			<p class='copyright text-sm'>
				&copy;<?= date('Y') ?> &bull; <a class='link' href='<?= setting('home')->url ?>'><?= setting('siteName') ?></a> &bull;
				<a
					class='link text-uppercase color-contrast-medium'
					href='<?= setting('poweredUrl') ?>'
					target='_blank'
					rel='noreferrer noopener'
				>
					<?= setting('powered') ?>
				</a>
			</p>

			<a class='to-top link btn btn--subtle btn--sm' href="#html" aria-label="scrool-top">
				<i data-feather='arrow-up' stroke-width='1'></i>
				<?= setting('to-top') ?>
			</a>
		</div>

	</div>
</footer>

<?= debugRegions() // Display debugging info ?>
<?= editBtn(setting('edit'), page()) // Edit page link ?>

<!-- Codyframe https://codyhouse.co/ds/docs/framework -->
	<script src="<?= urls('templates') ?>assets/js/scripts.min.js"></script>

<!-- Headroom https://wicky.nillia.ms/headroom.js/ -->
	<script defer src="https://cdnjs.cloudflare.com/ajax/libs/headroom/0.11.0/headroom.min.js"></script>
	<script>
		window.addEventListener("load", function() {
			// select your header or whatever element you wish
			const header = document.querySelector("header");
			const headroom = new Headroom(header);
			headroom.init();
		});
	</script>

<!-- Feather icons https://github.com/feathericons/feather -->
	<script defer src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
	<script>
		window.addEventListener("load", function() {
			feather.replace()
		});
	</script>
</body>
</html>