<?php namespace ProcessWire;

// Get images
$images = page()->images;
?>

<div id="main-body">

	<div class="margin-bottom-md margin-lg@md padding-xxs bg bg-opacity-80%">
		<?= page()->body ?>
	</div>

	<div class='flex flex-center flex-wrap flex-gap-sm'>
	<?php
	// Start Loop
		foreach($images as $key => $img):
	?>
			<div class='card col-6@md'>
				<a class='bg card__link' href="#<?= $key ?>">
					<div class='grid grid-gap-xs flex flex-center padding-xs'>
						<div class="col@md">
							<h3 class='card__title'>
								<?= $img->title ?>
								<span class='color-primary'>&bull;</span>
							</h3>
							<img src="<?= $img->url ?>" alt="<?= $img->title ?>">
						</div>

						<div class='col'>
							<p><?= $img->textarea ?></p>
						</div>
					</div>
				</a>
				<a href="#_" class="lightbox" id="<?= $key ?>">
					<img src="<?= $img->url ?>">
				</a>
			</div>
	<?php
		endforeach;
	?>
	</div>

</div>