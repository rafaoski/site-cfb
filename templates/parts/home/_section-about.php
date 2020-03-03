<?php namespace ProcessWire;

/**
 *
 * Section About
 *
 */
?>

<div class='container max-width-lg padding-y-md'>

	<h3 class='text-uppercase text-bold'>
		<a class='link text-xxl@md' href='<?= $item->url ?>'>
			<?= $item->title ?>
		</a>
		<span class='text-xxxl@md'>&bull;</span>
	</h3>

	<div class="grid grid-gap-md">

		<div class="col-5@md">

			<h3 class='padding-y-sm'>
				<?= $item->meta_title ?>
			</h3>
			<?= picture($item->images->first) ?>
			<p><?= $item->meta_description ?></p>

		</div>

		<div class="col content-right">
			<p>
				<?= sanitizer()->truncate($item->body, ['maxLength' => 400, 'keepTags' => ['img']]); ?>
			</p>
		</div>

	</div>

</div>
