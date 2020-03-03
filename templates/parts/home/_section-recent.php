<?php namespace ProcessWire;

/**
 *
 * Section Recent Post
 *
 */
?>

<div class='container max-width-md'>
	<h3 class='text-uppercase text-bold'>
		<a class='link text-xxl@md' href='<?= $item->parent->url ?>'>
			<?= setting('in-blog') ?>
		</a>
		<span class='text-xxxl@md'>&bull;</span>
	</h3>

	<div class='padding-x-xxl@md'>
		<?= animatedCard($item)?>
	</div>
</div>
