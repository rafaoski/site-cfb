<?php namespace ProcessWire;

/**
 *
 * Section Hero
 *
 */
?>

<div class='container max-width-lg padding-top-xl padding-top-sm@md'>
	<h1 class='text-xxl text-bold text-center text-right@md letter-spacing-lg'>
		<span class='color-primary text-xxxl@md'>&bull;</span>
		<span class='text-xxl@md'><?= $item->meta_title ?></span>
	</h1>
	<h2 class='text-lg letter-spacing-lg margin-y-xxxs'>
		<?= $item->meta_description ?>
	</h2>
</div>

<?php if($item->body): ?>
<div class="container max-width-md margin-y-sm letter-spacing-lg bg padding-xs">
	<?= $item->body ?>
</div>
<?php endif; ?>

<div class="to-section text-center margin-y-md">
	<a class='link color-inherit btn btn--sm' href="#section-about" aria-label="scrool-down">
		<i data-feather='arrow-down' width='40' height='40' stroke-width='1'></i>
	</a>
</div>
