<?php namespace ProcessWire;

/**
 * Simply Navigation ( Lightweight simple navigation built with flexbox and vanilla JavaScript )
 * @link https://obscuredetour.github.io/simply-nav/
 *
 */

$home = setting('home');
$logo = setting('logo');
$siteName = setting('siteName');
?>

<button class="toggle-nav" type="button" aria-label='Open Menu'>
	<div class="burger -squeeze -offset" type="button">
		<span class="burger-lines"></span>
	</div>
</button>

<!-- LOGO -->
<a class='logo-link link' href="<?= $home->url ?>">
	<?php
		if($logo) echo "<img width='110' src='$logo->url' alt='$siteName'>";
		else echo "<span class='site-name text-bold text-lg font-secondary'>$siteName</span>";
	?>
</a>

<!-- NAVIGATION -->
<div class="nav-list" role="navigation">
	<ul class="list -left font-secondary flex@md" style='overflow-x: auto; white-space: nowrap;'>
		<?= simplyNav($home->and($home->children)) ?>
	<!-- BLOG RSS -->
		<li class='item'>
			<a class='link rss' href="<?= setting('blog')->url ?>rss/">
				<i class='inline-block' data-feather='rss' stroke-width='1'></i>
				<?= setting('rss') ?>
			</a>
		</li>
	</ul>
	<div class="list -right">
		<div class="overlay"></div>
	</div>
</div>

<?php
	// Lang Memu
		files()->include('parts/_lang-menu', ['home' => $home]);
?>

<!-- DARK / LIGHT MODE SWITCHER -->
<div class="mode flex flex-center margin-left-md@md">
	<label aria-hidden="true" class="mode__label" for="themeSwitch" style='width: 35px'>
		<i id='moon' data-feather='moon' stroke-width='1' width='35' height='35'></i>
		<i id='sun' data-feather='sun' stroke-width='1' width='35' height='35'></i>
		<input id="themeSwitch" class="mode__input" style='display: none' type="checkbox">
	</label>
</div>