<?php namespace ProcessWire;

/**
 *
 * Section Projects
 *
 */

// Set images limit
$limit = 3;
$images = $item->images("limit=$limit");
// Set columns
$col =
	[
		0 => '4',
		1 => '5',
		2 => '3'
	];
$i = 0;
?>

<div class='container max-width-lg'>

	<h3 class='text-xl text-uppercase text-bold'>
		<span class='text-xxxl@md'>&bull;</span>
		<a class='link text-xxl@md' href='<?= $item->url ?>'>
			<?= $item->title ?>
		</a>
	</h3>

	<p class='text-lg text-xxl@md text-center text-right@md margin-y-xxs'>
		<span class='bg-contrast-higher color-contrast-low'>
			<?= $item->meta_title ?>
		</span>
	</p>

<?php if($item->images && $item->images->count()): ?>
	<div class='flex flex-center flex-wrap flex-gap-sm'>
	<?php
	// Start Loop
		foreach($images as $key => $img):
	?>
			<div class='card col-<?= $col[$i] ?>@md'>
				<a class='card__link' href="#<?= $key ?>" >
					<div class="text-component padding-md">
						<h3 class='card__title'>
							<?= $img->title ?>
							<span class='color-primary'>&bull;</span>
						</h3>
						<img src="<?= $img->url ?>" alt='<?= $img->title ?>'>
					</div>
				</a>
				<a href="#_" class="lightbox" id="<?= $key ?>">
					<img src="<?= $img->url ?>">
				</a>
			</div>
	<?php
		$i++;
			endforeach;
	?>
	</div>
<?php endif; ?>
	<h4 class='text-sm text-md@md margin-y-xxs'>
		<?= $item->meta_description ?>
	</h4>
</div>

